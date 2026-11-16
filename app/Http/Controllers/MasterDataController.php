<?php

namespace App\Http\Controllers;

use App\Models\ArsitekturFilosofi;
use App\Models\ArsitekturSimbol;
use App\Models\AuditLog;
use App\Models\Lingkungan;
use App\Models\OrganisasiKategorial;
use App\Models\Pastor;
use App\Models\PastorPelayanan;
use App\Models\ProfilParoki;
use App\Models\SakramenInformasi;
use App\Models\SejarahParoki;
use App\Models\Stasi;
use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    // ==========================================
    // 1. PROFIL PAROKI
    // ==========================================
    public function profil()
    {
        $profil = ProfilParoki::firstOrCreate(['id' => 1], [
            'nama_paroki' => 'Paroki Santo Paulus Wonosobo',
            'alamat' => 'Jl. Letjen S. Parman No. 2, Wonosobo',
        ]);
        return view('master.profil', compact('profil'));
    }

    public function profilUpdate(Request $request)
    {
        $profil = ProfilParoki::firstOrFail();
        $old = $profil->toArray();

        $data = $request->validate([
            'nama_paroki' => 'required|string|max:150',
            'keuskupan' => 'required|string|max:150',
            'pelindung' => 'required|string|max:100',
            'pesta_nama' => 'nullable|string|max:100',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:150',
            'whatsapp' => 'nullable|string|max:50',
            'deskripsi_singkat' => 'nullable|string',
            'sambutan_pastor' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'google_maps_embed' => 'nullable|string',
        ]);

        $profil->update($data);
        AuditLog::log('UPDATE', 'ProfilParoki', $profil->id, $old, $profil->toArray());

        return redirect()->route('master.profil')->with('success', 'Data Profil Paroki berhasil diperbarui.');
    }

    // ==========================================
    // 2. SEJARAH PAROKI
    // ==========================================
    public function sejarahIndex()
    {
        $sejarahs = SejarahParoki::orderBy('urutan', 'asc')->orderBy('tahun', 'asc')->get();
        return view('master.sejarah.index', compact('sejarahs'));
    }

    public function sejarahStore(Request $request)
    {
        $data = $request->validate([
            'tahun' => 'required|string|max:30',
            'judul_peristiwa' => 'required|string|max:200',
            'deskripsi' => 'required|string',
            'urutan' => 'nullable|integer',
        ]);

        $item = SejarahParoki::create($data);
        AuditLog::log('CREATE', 'SejarahParoki', $item->id, null, $item->toArray());

        return redirect()->route('master.sejarah.index')->with('success', 'Data linimasa sejarah berhasil ditambahkan.');
    }

    public function sejarahDestroy($id)
    {
        $item = SejarahParoki::findOrFail($id);
        $old = $item->toArray();
        $item->delete();

        AuditLog::log('DELETE', 'SejarahParoki', $id, $old, null);
        return redirect()->route('master.sejarah.index')->with('success', 'Peristiwa sejarah berhasil dihapus.');
    }

    // ==========================================
    // 3. ARSITEKTUR & 20 SIMBOL
    // ==========================================
    public function arsitektur()
    {
        $filosofi = ArsitekturFilosofi::firstOrCreate(['id' => 1], [
            'nama_arsitektur' => 'Joglo Pangrawit Ceblokan',
            'konsep_utama' => 'Garbha Griha / Goa Garba',
            'inkulturasi' => 'Penyatuan nilai arsitektur Jawa dengan teologi Katolik.',
            'deskripsi_lengkap' => 'Deskripsi arsitektur gereja.',
        ]);
        $simbols = ArsitekturSimbol::orderBy('nomor_simbol', 'asc')->get();

        return view('master.arsitektur', compact('filosofi', 'simbols'));
    }

    public function arsitekturFilosofiUpdate(Request $request)
    {
        $filosofi = ArsitekturFilosofi::firstOrFail();
        $old = $filosofi->toArray();

        $data = $request->validate([
            'nama_arsitektur' => 'required|string|max:150',
            'konsep_utama' => 'required|string|max:150',
            'inkulturasi' => 'required|string',
            'deskripsi_lengkap' => 'required|string',
        ]);

        $filosofi->update($data);
        AuditLog::log('UPDATE', 'ArsitekturFilosofi', $filosofi->id, $old, $filosofi->toArray());

        return redirect()->route('master.arsitektur')->with('success', 'Konsep filosofi arsitektur berhasil diperbarui.');
    }

    public function arsitekturSimbolUpdate(Request $request, $id)
    {
        $simbol = ArsitekturSimbol::findOrFail($id);
        $old = $simbol->toArray();

        $data = $request->validate([
            'nama_simbol' => 'required|string|max:150',
            'arti_filosofis' => 'required|string',
            'makna_teologis' => 'required|string',
            'lokasi_pada_gereja' => 'nullable|string|max:150',
        ]);

        $simbol->update($data);
        AuditLog::log('UPDATE', 'ArsitekturSimbol', $simbol->id, $old, $simbol->toArray());

        return redirect()->route('master.arsitektur')->with('success', 'Simbol arsitektur #' . $simbol->nomor_simbol . ' berhasil diperbarui.');
    }

    // ==========================================
    // 4. PASTOR & PENUGASAN
    // ==========================================
    public function pastorIndex()
    {
        $pastors = Pastor::with('pelayanans')->orderBy('urutan', 'asc')->get();
        return view('master.pastor.index', compact('pastors'));
    }

    public function pastorStore(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'gelar_sebutan' => 'nullable|string|max:50',
            'status_pelayanan' => 'required|in:aktif,purnatugas,almarhum,pindah',
            'keterangan' => 'nullable|string',
            'urutan' => 'nullable|integer',
        ]);

        $pastor = Pastor::create($data);
        AuditLog::log('CREATE', 'Pastor', $pastor->id, null, $pastor->toArray());

        return redirect()->route('master.pastor.index')->with('success', 'Data pastor berhasil ditambahkan.');
    }

    public function pastorPelayananStore(Request $request, $pastorId)
    {
        $pastor = Pastor::findOrFail($pastorId);

        $data = $request->validate([
            'jabatan' => 'required|string|max:100',
            'tahun_mulai' => 'required|integer|min:1900|max:2100',
            'tahun_selesai' => 'nullable|integer|gte:tahun_mulai',
            'catatan' => 'nullable|string',
        ]);

        $pelayanan = $pastor->pelayanans()->create($data);
        AuditLog::log('CREATE', 'PastorPelayanan', $pelayanan->id, null, $pelayanan->toArray());

        return redirect()->route('master.pastor.index')->with('success', 'Riwayat penugasan berhasil ditambahkan ke pastor terkait.');
    }

    // ==========================================
    // 5. LINGKUNGAN
    // ==========================================
    public function lingkunganIndex()
    {
        $lingkungans = Lingkungan::orderBy('nomor_lingkungan', 'asc')->get();
        return view('master.lingkungan.index', compact('lingkungans'));
    }

    public function lingkunganUpdate(Request $request, $id)
    {
        $lingkungan = Lingkungan::findOrFail($id);
        $old = $lingkungan->toArray();

        $data = $request->validate([
            'nama_lingkungan' => 'required|string|max:100',
            'nama_pelindung' => 'required|string|max:100',
            'wilayah' => 'nullable|string|max:100',
            'ketua_lingkungan' => 'nullable|string|max:150',
            'kontak' => 'nullable|string|max:50',
            'jumlah_kk' => 'nullable|integer',
            'keterangan' => 'nullable|string',
        ]);

        $lingkungan->update($data);
        AuditLog::log('UPDATE', 'Lingkungan', $lingkungan->id, $old, $lingkungan->toArray());

        return redirect()->route('master.lingkungan.index')->with('success', 'Data lingkungan berhasil diperbarui.');
    }

    // ==========================================
    // 6. STASI
    // ==========================================
    public function stasiIndex()
    {
        $stasis = Stasi::orderBy('nama_stasi', 'asc')->get();
        return view('master.stasi.index', compact('stasis'));
    }

    public function stasiUpdate(Request $request, $id)
    {
        $stasi = Stasi::findOrFail($id);
        $old = $stasi->toArray();

        $data = $request->validate([
            'nama_stasi' => 'required|string|max:150',
            'nama_pelindung' => 'required|string|max:100',
            'lokasi_desa_kecamatan' => 'required|string|max:200',
            'jarak_dari_pusat_km' => 'nullable|numeric',
            'ketua_stasi' => 'nullable|string|max:150',
            'kontak' => 'nullable|string|max:50',
            'kapasitas_umat' => 'nullable|integer',
            'keterangan' => 'nullable|string',
        ]);

        $stasi->update($data);
        AuditLog::log('UPDATE', 'Stasi', $stasi->id, $old, $stasi->toArray());

        return redirect()->route('master.stasi.index')->with('success', 'Data stasi berhasil diperbarui.');
    }

    // ==========================================
    // 7. ORGANISASI KATEGORIAL
    // ==========================================
    public function kategorialIndex()
    {
        $kategorials = OrganisasiKategorial::orderBy('urutan', 'asc')->get();
        return view('master.kategorial.index', compact('kategorials'));
    }

    public function kategorialUpdate(Request $request, $id)
    {
        $kategorial = OrganisasiKategorial::findOrFail($id);
        $old = $kategorial->toArray();

        $data = $request->validate([
            'nama_organisasi' => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'visi_misi' => 'nullable|string',
            'ketua' => 'nullable|string|max:150',
            'pembina' => 'nullable|string|max:150',
            'jadwal_kegiatan_rutin' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:50',
        ]);

        $kategorial->update($data);
        AuditLog::log('UPDATE', 'OrganisasiKategorial', $kategorial->id, $old, $kategorial->toArray());

        return redirect()->route('master.kategorial.index')->with('success', 'Data organisasi kategorial berhasil diperbarui.');
    }

    // ==========================================
    // 8. INFORMASI SAKRAMEN
    // ==========================================
    public function sakramenIndex()
    {
        $sakramens = SakramenInformasi::orderBy('urutan', 'asc')->get();
        return view('master.sakramen.index', compact('sakramens'));
    }

    public function sakramenUpdate(Request $request, $id)
    {
        $sakramen = SakramenInformasi::findOrFail($id);
        $old = $sakramen->toArray();

        $data = $request->validate([
            'nama_sakramen' => 'required|string|max:150',
            'deskripsi_teologis' => 'required|string',
            'persyaratan' => 'required|string',
            'prosedur_pelayanan' => 'required|string',
            'jadwal_pelayanan_rutin' => 'nullable|string',
            'kontak_layanan' => 'nullable|string|max:100',
        ]);

        $sakramen->update($data);
        AuditLog::log('UPDATE', 'SakramenInformasi', $sakramen->id, $old, $sakramen->toArray());

        return redirect()->route('master.sakramen.index')->with('success', 'Informasi panduan sakramen berhasil diperbarui.');
    }
}

