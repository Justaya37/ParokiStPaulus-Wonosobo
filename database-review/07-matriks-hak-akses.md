# Matriks Hak Akses & Kebijakan Otorisasi Backend (RBAC)
## Website Profil dan Sistem Informasi Paroki Santo Paulus Wonosobo

Sistem menerapkan Role-Based Access Control (RBAC) ketat yang divalidasi pada lapisan backend (Middleware & Form Request Policy) dan bukan sekadar penyembunyian antarmuka pada sisi frontend.

---

### 1. Matriks Akses Antar-Modul

| Modul | Guest / Umat | Admin Sekretariat | Romo Paroki | Tim Komsos / OMK |
|---|---|---|---|---|
| **Public Website** (Semua Halaman Publik) | **Read** | **Read** | **Read** | **Read** |
| **Manajemen Pengguna** (`users`, `roles`) | - | **CRUD** | - | - |
| **Jadwal Ekaristi** (`jadwal_ekaristis`) | **Read** (Published) | **CRUD** | **Read** | - |
| **Petugas Liturgi** (`jadwal_petugas_liturgis`, `liturgi_perans`) | **Read** | **CRUD** | **Read** | - |
| **Agenda Kegiatan** (`agenda_kegiatans`) | **Read** (Aktif) | **CRUD** | **Read** | - |
| **Data Master Paroki** (Profil, Sejarah, Arsitektur, Simbol, Pastor, Lingkungan, Stasi, Kategorial, Info Sakramen) | **Read** | **CRUD** *(Shared Master)* | **CRUD** *(Shared Master)* | - |
| **Renungan / Sapaan Gembala** (`renungans`) | **Read** (Published) | **Read** | **CRUD** (Draft & Publish) | **Read** |
| **Berita Paroki** (`beritas`) | **Read** (Published) | **Read** | **Read** | **CRUD** (Draft & Publish) |
| **Kategori Berita** (`kategori_beritas`) | **Read** | **Read** | **Read** | **CRUD** |
| **Warta Paroki** (`warta_parokis`) | **Read** (Published/Download) | **CRUD** | **Read** | **Read** |
| **Galeri Foto & Album** (`galeri_albums`, `galeri_fotos`) | **Read** (Published) | **Read** | **Read** | **CRUD** |
| **Audit Log** (`audit_logs`) | - | **Read** | **Read** | - |

---

### 2. Penjelasan Kebijakan Otorisasi per Role

#### A. Role: Guest / Umat Umum
- **Autentikasi**: Tidak memerlukan autentikasi login (akses bebas).
- **Lingkup**: Hanya memiliki izin membaca (*Read*) pada seluruh halaman publik.
- **Filter Ketat**: Konten berstatus `draft` (Berita, Renungan, Warta Paroki) dan jadwal/agenda non-aktif secara otomatis difilter di query scope Eloquent dan **tidak pernah di-render** untuk publik.

#### B. Role: Admin Sekretariat
- **Autentikasi**: Memerlukan sesi login aktif dengan role `admin_sekretariat`.
- **Lingkup**:
  - Pengelolaan data akun dan hak akses pengguna (`users`).
  - Pengelolaan tata kelola liturgis: Jadwal Ekaristi (Gereja Utama dan 7 Stasi), penugasan Petugas Liturgi, dan Agenda Kegiatan paroki.
  - Pengunggahan dan pengelolaan Warta Paroki berkas PDF.
  - Pengelolaan penuh terhadap **Data Master Paroki**.
  - Akses baca catatan *Audit Log*.

#### C. Role: Romo Paroki
- **Autentikasi**: Memerlukan sesi login aktif dengan role `romo_paroki`.
- **Lingkup**:
  - Pengelolaan penuh konten Renungan / Sapaan Gembala: menulis, menyimpan draft, mengedit, menghapus, dan menerbitkan (*publish*).
  - Pengelolaan penuh terhadap **Data Master Paroki** yang sama persis dengan Admin Sekretariat.
  - Akses baca terhadap modul operasional lainnya (Jadwal, Berita, Warta, Audit Log) untuk fungsi supervisi pastoral.

#### D. Role: Tim Komsos / OMK
- **Autentikasi**: Memerlukan sesi login aktif dengan role `tim_komsos`.
- **Lingkup**:
  - Menulis, mengubah, menghapus, dan mempublikasikan Berita Paroki beserta kategorinya.
  - Mengelola Album Galeri dan mengunggah/menata foto dokumentasi kegiatan paroki.
  - **Larangan Keras**: Tidak memiliki akses ke manajemen akun, administrasi sekretariat (Jadwal/Liturgi/Warta), maupun Data Master Paroki.

---

### 3. Implementasi Teknis Otorisasi Backend Laravel
Otorisasi tidak hanya mengandalkan penyembunyian tombol/menu pada Blade template, melainkan diproteksi secara bertingkat:
1. **Middleware `role:...`**: Mencegah request HTTP dari aktor yang tidak berwenang pada level router sebelum masuk ke Controller.
2. **Laravel Policy / Gate**: Memvalidasi kepemilikan dan kewenangan aksi spesifik (misal: hanya Romo yang dapat memanggil aksi `publish` renungan).
3. **Penyimpanan Jejak Audit**: Setiap aksi mutasi pada Data Master secara otomatis mencatat user ID dan role ke dalam tabel `audit_logs`.

