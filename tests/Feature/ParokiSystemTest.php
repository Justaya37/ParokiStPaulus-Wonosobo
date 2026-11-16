<?php

namespace Tests\Feature;

use App\Models\AuditLog;
use App\Models\Berita;
use App\Models\JadwalEkaristi;
use App\Models\KategoriBerita;
use App\Models\ProfilParoki;
use App\Models\Renungan;
use App\Models\Role;
use App\Models\User;
use Tests\TestCase;

class ParokiSystemTest extends TestCase
{
    public function test_public_pages_return_successful_response(): void
    {
        $routes = [
            '/',
            '/profil-dan-sejarah',
            '/filosofi-arsitektur-dan-simbol',
            '/pastor',
            '/lingkungan-dan-stasi',
            '/jadwal-ekaristi',
            '/agenda-kegiatan',
            '/berita',
            '/renungan-gembala',
            '/warta-paroki',
            '/galeri',
            '/informasi-sakramen',
            '/login',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);
        }

        $homeResponse = $this->get('/');
        $homeResponse->assertSee('images/logo-paroki.png');
        $homeResponse->assertSee('images/logo-omk.png');
        $homeResponse->assertSee('images/gereja-tampak-depan.jpg');
        $homeResponse->assertSee('rel="icon" type="image/png"', false);
        $homeResponse->assertSee('rel="shortcut icon"', false);
        $homeResponse->assertSee('PAROKI SANTO PAULUS');
        $homeResponse->assertSee('WONOSOBO');
        $homeResponse->assertSee('Akses Cepat');
        $homeResponse->assertSee('fa-chevron-down');
        $homeResponse->assertSee('Lembar Warta Paroki (PDF)');
        $homeResponse->assertSee('20 Simbol Arsitektur Joglo');
    }

    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_access_admin_modules(): void
    {
        $admin = User::whereHas('role', fn($q) => $q->where('name', 'admin_sekretariat'))->first();
        $this->assertNotNull($admin);

        $dashboard = $this->actingAs($admin)->get('/dashboard');
        $dashboard->assertStatus(200);
        $dashboard->assertSee('images/logo-paroki.png');
        $dashboard->assertSee('images/logo-omk.png');
        $dashboard->assertSee('rel="icon" type="image/png"', false);
        $dashboard->assertSee('rel="shortcut icon"', false);
        $dashboard->assertSee('ST. PAULUS');
        $dashboard->assertSee('WONOSOBO ADMIN');

        $response = $this->actingAs($admin)->get('/dashboard/admin/jadwal-ekaristi');
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->get('/dashboard/admin/manajemen-pengguna');
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->get('/dashboard/master-data/profil-paroki');
        $response->assertStatus(200);
    }

    public function test_komsos_cannot_access_admin_or_master_data(): void
    {
        $komsos = User::whereHas('role', fn($q) => $q->where('name', 'tim_komsos'))->first();
        $this->assertNotNull($komsos);

        $response = $this->actingAs($komsos)->get('/dashboard/admin/jadwal-ekaristi');
        $response->assertStatus(403);

        $response = $this->actingAs($komsos)->get('/dashboard/master-data/profil-paroki');
        $response->assertStatus(403);

        $response = $this->actingAs($komsos)->get('/dashboard/komsos/berita');
        $response->assertStatus(200);
    }

    public function test_romo_can_access_shared_master_data_and_renungan(): void
    {
        $romo = User::whereHas('role', fn($q) => $q->where('name', 'romo_paroki'))->first();
        $this->assertNotNull($romo);

        $response = $this->actingAs($romo)->get('/dashboard/romo/renungan');
        $response->assertStatus(200);

        // Romo accesses the SAME shared master data
        $response = $this->actingAs($romo)->get('/dashboard/master-data/profil-paroki');
        $response->assertStatus(200);

        // But Romo cannot access admin user management
        $response = $this->actingAs($romo)->get('/dashboard/admin/manajemen-pengguna');
        $response->assertStatus(403);
    }

    public function test_admin_can_create_and_delete_jadwal_ekaristi(): void
    {
        $admin = User::whereHas('role', fn($q) => $q->where('name', 'admin_sekretariat'))->first();

        $response = $this->actingAs($admin)->post('/dashboard/admin/jadwal-ekaristi', [
            'nama_perayaan' => 'Misa Uji Coba Otomatis',
            'tipe_perayaan' => 'mingguan',
            'stasi_id' => null, // Gereja Utama
            'hari' => 'Minggu',
            'waktu_mulai' => '07:00',
            'bahasa' => 'Bahasa Indonesia',
            'is_aktif' => '1',
        ]);

        $response->assertRedirect('/dashboard/admin/jadwal-ekaristi');
        $this->assertDatabaseHas('jadwal_ekaristis', [
            'nama_perayaan' => 'Misa Uji Coba Otomatis',
            'stasi_id' => null,
        ]);

        $jadwal = JadwalEkaristi::where('nama_perayaan', 'Misa Uji Coba Otomatis')->first();
        $deleteResponse = $this->actingAs($admin)->delete('/dashboard/admin/jadwal-ekaristi/' . $jadwal->id);
        $deleteResponse->assertRedirect('/dashboard/admin/jadwal-ekaristi');
        $this->assertDatabaseMissing('jadwal_ekaristis', ['id' => $jadwal->id]);
    }

    public function test_romo_can_create_renungan(): void
    {
        $romo = User::whereHas('role', fn($q) => $q->where('name', 'romo_paroki'))->first();

        $response = $this->actingAs($romo)->post('/dashboard/romo/renungan', [
            'judul' => 'Kasih yang Menghidupkan',
            'ayat_bacaan' => '1 Korintus 13:1-13',
            'tanggal_renungan' => date('Y-m-d'),
            'isi' => 'Kasih itu sabar, kasih itu murah hati; ia tidak cemburu...',
            'status' => 'published',
        ]);

        $response->assertRedirect('/dashboard/romo/renungan');
        $this->assertDatabaseHas('renungans', [
            'judul' => 'Kasih yang Menghidupkan',
            'status' => 'published',
        ]);
    }

    public function test_komsos_can_create_berita(): void
    {
        $komsos = User::whereHas('role', fn($q) => $q->where('name', 'tim_komsos'))->first();
        $kategori = KategoriBerita::first();

        $response = $this->actingAs($komsos)->post('/dashboard/komsos/berita', [
            'judul' => 'Liputan Kegiatan Rekoleksi Pemuda Paroki',
            'kategori_berita_id' => $kategori->id,
            'ringkasan' => 'Kegiatan berlangsung penuh semangat sukacita.',
            'isi' => 'Seluruh orang muda katolik berkumpul bersama memuji Tuhan...',
            'status' => 'published',
        ]);

        $response->assertRedirect('/dashboard/komsos/berita');
        $this->assertDatabaseHas('beritas', [
            'judul' => 'Liputan Kegiatan Rekoleksi Pemuda Paroki',
            'status' => 'published',
        ]);
    }

    public function test_audit_log_records_master_data_changes(): void
    {
        $admin = User::whereHas('role', fn($q) => $q->where('name', 'admin_sekretariat'))->first();
        
        $initialAuditCount = AuditLog::count();

        $this->actingAs($admin)->put('/dashboard/master-data/profil-paroki', [
            'nama_paroki' => 'Paroki Santo Paulus Wonosobo',
            'keuskupan' => 'Keuskupan Purwokerto',
            'pelindung' => 'Santo Paulus Rasul',
            'pesta_nama' => '29 Juni',
            'alamat' => 'Jl. Letjen S. Parman No. 2, Wonosobo, Jawa Tengah',
            'telepon' => '(0286) 321xxx',
            'email' => 'sekretariat@parokiwonosobo.org',
            'whatsapp' => '081234567890',
            'deskripsi_singkat' => 'Gereja Paroki Santo Paulus Wonosobo berakar kuat dalam iman dan budaya.',
        ]);

        $this->assertGreaterThan($initialAuditCount, AuditLog::count());
    }

    public function test_galeri_thumbnails_and_proportions_render_properly(): void
    {
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('galeri-grid-3');
        $homeResponse->assertSee('aspect-4-3');
        $homeResponse->assertSee('storage/galeri/xmPBncaayVXCF9D2ynpxZWSmDCZ8MH42J4d8Yv2u.jpg');

        $galeriList = $this->get('/galeri');
        $galeriList->assertStatus(200);
        $galeriList->assertSee('galeri-grid-3');
        $galeriList->assertSee('aspect-4-3');
        $galeriList->assertSee('storage/galeri/xmPBncaayVXCF9D2ynpxZWSmDCZ8MH42J4d8Yv2u.jpg');

        $album = \App\Models\GaleriAlbum::where('status', 'published')->first();
        if ($album) {
            $detailResponse = $this->get('/galeri/' . $album->slug);
            $detailResponse->assertStatus(200);
            $detailResponse->assertSee('storage/galeri/xmPBncaayVXCF9D2ynpxZWSmDCZ8MH42J4d8Yv2u.jpg');
            $detailResponse->assertSee('galeriLightbox');
        }
    }
}
