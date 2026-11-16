<?php

use App\Http\Controllers\AdminSekretariatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RomoParokiController;
use App\Http\Controllers\TimKomsosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes: Paroki Santo Paulus Wonosobo
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. PUBLIC WEBSITE (GUEST / UMAT UMUM - READ ONLY)
// ==========================================
Route::name('public.')->group(function () {
    Route::get('/', [PublicController::class, 'index'])->name('index');
    Route::get('/profil-dan-sejarah', [PublicController::class, 'profil'])->name('profil');
    Route::get('/filosofi-arsitektur-dan-simbol', [PublicController::class, 'arsitektur'])->name('arsitektur');
    Route::get('/pastor', [PublicController::class, 'pastor'])->name('pastor');
    Route::get('/lingkungan-dan-stasi', [PublicController::class, 'lingkunganStasi'])->name('lingkungan_stasi');
    Route::get('/jadwal-ekaristi', [PublicController::class, 'jadwal'])->name('jadwal');
    Route::get('/agenda-kegiatan', [PublicController::class, 'agenda'])->name('agenda');
    Route::get('/agenda-kegiatan/{slug}', [PublicController::class, 'agendaDetail'])->name('agenda.detail');
    Route::get('/berita', [PublicController::class, 'berita'])->name('berita');
    Route::get('/berita/{slug}', [PublicController::class, 'beritaDetail'])->name('berita.detail');
    Route::get('/renungan-gembala', [PublicController::class, 'renungan'])->name('renungan');
    Route::get('/renungan-gembala/{slug}', [PublicController::class, 'renunganDetail'])->name('renungan.detail');
    Route::get('/warta-paroki', [PublicController::class, 'warta'])->name('warta');
    Route::get('/warta-paroki/{id}/unduh', [PublicController::class, 'wartaDownload'])->name('warta.download');
    Route::get('/galeri', [PublicController::class, 'galeri'])->name('galeri');
    Route::get('/galeri/{slug}', [PublicController::class, 'galeriDetail'])->name('galeri.detail');
    Route::get('/informasi-sakramen', [PublicController::class, 'sakramen'])->name('sakramen');
});

// ==========================================
// 2. AUTENTIKASI (LOGIN & LOGOUT)
// ==========================================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// 3. TEROTENTIKASI (DASHBOARD AREA)
// ==========================================
Route::middleware(['auth'])->prefix('dashboard')->group(function () {

    // Beranda Dashboard (Semua Role Terdaftar)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // ==========================================
    // A. MODUL ADMIN SEKRETARIAT
    // ==========================================
    Route::middleware(['role:admin_sekretariat'])->prefix('admin')->name('admin.')->group(function () {
        // Jadwal Ekaristi
        Route::get('/jadwal-ekaristi', [AdminSekretariatController::class, 'jadwalIndex'])->name('jadwal.index');
        Route::post('/jadwal-ekaristi', [AdminSekretariatController::class, 'jadwalStore'])->name('jadwal.store');
        Route::put('/jadwal-ekaristi/{id}', [AdminSekretariatController::class, 'jadwalUpdate'])->name('jadwal.update');
        Route::delete('/jadwal-ekaristi/{id}', [AdminSekretariatController::class, 'jadwalDestroy'])->name('jadwal.destroy');

        // Petugas Liturgi
        Route::get('/petugas-liturgi', [AdminSekretariatController::class, 'petugasIndex'])->name('petugas.index');
        Route::post('/petugas-liturgi', [AdminSekretariatController::class, 'petugasStore'])->name('petugas.store');
        Route::delete('/petugas-liturgi/{id}', [AdminSekretariatController::class, 'petugasDestroy'])->name('petugas.destroy');

        // Agenda Kegiatan
        Route::get('/agenda-kegiatan', [AdminSekretariatController::class, 'agendaIndex'])->name('agenda.index');
        Route::post('/agenda-kegiatan', [AdminSekretariatController::class, 'agendaStore'])->name('agenda.store');
        Route::delete('/agenda-kegiatan/{id}', [AdminSekretariatController::class, 'agendaDestroy'])->name('agenda.destroy');

        // Warta Paroki
        Route::get('/warta-paroki', [AdminSekretariatController::class, 'wartaIndex'])->name('warta.index');
        Route::post('/warta-paroki', [AdminSekretariatController::class, 'wartaStore'])->name('warta.store');
        Route::delete('/warta-paroki/{id}', [AdminSekretariatController::class, 'wartaDestroy'])->name('warta.destroy');

        // Manajemen Pengguna
        Route::get('/manajemen-pengguna', [AdminSekretariatController::class, 'usersIndex'])->name('users.index');
        Route::post('/manajemen-pengguna', [AdminSekretariatController::class, 'usersStore'])->name('users.store');
        Route::post('/manajemen-pengguna/{id}/toggle', [AdminSekretariatController::class, 'usersToggleStatus'])->name('users.toggle');

        // Audit Logs
        Route::get('/audit-logs', [AdminSekretariatController::class, 'auditLogs'])->name('audit_logs');
    });

    // ==========================================
    // B. MODUL ROMO PAROKI
    // ==========================================
    Route::middleware(['role:romo_paroki'])->prefix('romo')->name('romo.')->group(function () {
        Route::get('/renungan', [RomoParokiController::class, 'renunganIndex'])->name('renungan.index');
        Route::get('/renungan/tulis', [RomoParokiController::class, 'renunganCreate'])->name('renungan.create');
        Route::post('/renungan', [RomoParokiController::class, 'renunganStore'])->name('renungan.store');
        Route::get('/renungan/{id}/edit', [RomoParokiController::class, 'renunganEdit'])->name('renungan.edit');
        Route::put('/renungan/{id}', [RomoParokiController::class, 'renunganUpdate'])->name('renungan.update');
        Route::delete('/renungan/{id}', [RomoParokiController::class, 'renunganDestroy'])->name('renungan.destroy');
    });

    // ==========================================
    // C. SHARED DATA MASTER PAROKI (ADMIN & ROMO)
    // ==========================================
    Route::middleware(['role:admin_sekretariat,romo_paroki'])->prefix('master-data')->name('master.')->group(function () {
        // Profil
        Route::get('/profil-paroki', [MasterDataController::class, 'profil'])->name('profil');
        Route::put('/profil-paroki', [MasterDataController::class, 'profilUpdate'])->name('profil.update');

        // Sejarah
        Route::get('/sejarah-paroki', [MasterDataController::class, 'sejarahIndex'])->name('sejarah.index');
        Route::post('/sejarah-paroki', [MasterDataController::class, 'sejarahStore'])->name('sejarah.store');
        Route::delete('/sejarah-paroki/{id}', [MasterDataController::class, 'sejarahDestroy'])->name('sejarah.destroy');

        // Arsitektur & Simbol
        Route::get('/arsitektur-dan-simbol', [MasterDataController::class, 'arsitektur'])->name('arsitektur');
        Route::put('/arsitektur-filosofi', [MasterDataController::class, 'arsitekturFilosofiUpdate'])->name('arsitektur.update');
        Route::put('/arsitektur-simbol/{id}', [MasterDataController::class, 'arsitekturSimbolUpdate'])->name('simbol.update');

        // Pastor & Penugasan
        Route::get('/pastor', [MasterDataController::class, 'pastorIndex'])->name('pastor.index');
        Route::post('/pastor', [MasterDataController::class, 'pastorStore'])->name('pastor.store');
        Route::post('/pastor/{pastorId}/pelayanan', [MasterDataController::class, 'pastorPelayananStore'])->name('pastor.pelayanan.store');

        // Lingkungan (14)
        Route::get('/lingkungan', [MasterDataController::class, 'lingkunganIndex'])->name('lingkungan.index');
        Route::put('/lingkungan/{id}', [MasterDataController::class, 'lingkunganUpdate'])->name('lingkungan.update');

        // Stasi (7)
        Route::get('/stasi', [MasterDataController::class, 'stasiIndex'])->name('stasi.index');
        Route::put('/stasi/{id}', [MasterDataController::class, 'stasiUpdate'])->name('stasi.update');

        // Organisasi Kategorial (7)
        Route::get('/organisasi-kategorial', [MasterDataController::class, 'kategorialIndex'])->name('kategorial.index');
        Route::put('/organisasi-kategorial/{id}', [MasterDataController::class, 'kategorialUpdate'])->name('kategorial.update');

        // Informasi Sakramen (7)
        Route::get('/informasi-sakramen', [MasterDataController::class, 'sakramenIndex'])->name('sakramen.index');
        Route::put('/informasi-sakramen/{id}', [MasterDataController::class, 'sakramenUpdate'])->name('sakramen.update');
    });

    // ==========================================
    // D. MODUL TIM KOMSOS / OMK
    // ==========================================
    Route::middleware(['role:tim_komsos'])->prefix('komsos')->name('komsos.')->group(function () {
        // Berita
        Route::get('/berita', [TimKomsosController::class, 'beritaIndex'])->name('berita.index');
        Route::get('/berita/tulis', [TimKomsosController::class, 'beritaCreate'])->name('berita.create');
        Route::post('/berita', [TimKomsosController::class, 'beritaStore'])->name('berita.store');
        Route::get('/berita/{id}/edit', [TimKomsosController::class, 'beritaEdit'])->name('berita.edit');
        Route::put('/berita/{id}', [TimKomsosController::class, 'beritaUpdate'])->name('berita.update');
        Route::delete('/berita/{id}', [TimKomsosController::class, 'beritaDestroy'])->name('berita.destroy');

        // Kategori Berita
        Route::get('/kategori-berita', [TimKomsosController::class, 'kategoriIndex'])->name('kategori.index');
        Route::post('/kategori-berita', [TimKomsosController::class, 'kategoriStore'])->name('kategori.store');
        Route::delete('/kategori-berita/{id}', [TimKomsosController::class, 'kategoriDestroy'])->name('kategori.destroy');

        // Galeri & Foto
        Route::get('/galeri', [TimKomsosController::class, 'galeriIndex'])->name('galeri.index');
        Route::post('/galeri', [TimKomsosController::class, 'galeriStore'])->name('galeri.store');
        Route::get('/galeri/{id}', [TimKomsosController::class, 'galeriShow'])->name('galeri.show');
        Route::post('/galeri/{albumId}/upload', [TimKomsosController::class, 'galeriFotoUpload'])->name('galeri.upload');
        Route::delete('/galeri/foto/{fotoId}', [TimKomsosController::class, 'galeriFotoDestroy'])->name('galeri.foto.destroy');
    });

});
