# Data Dictionary Sistem Informasi Paroki Santo Paulus Wonosobo

Berikut adalah rincian kamus data (Data Dictionary) lengkap untuk seluruh 23 tabel dalam basis data sistem informasi Paroki Santo Paulus Wonosobo:

---

### 1. Tabel: `roles`
- **Fungsi**: Menyimpan daftar peran otorisasi sistem.
- **Index**: PRIMARY (`id`), UNIQUE (`name`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator unik peran |
| `name` | VARCHAR(50) | UK | No | - | Kode unik peran (`admin_sekretariat`, `romo_paroki`, `tim_komsos`, `guest`) |
| `display_name` | VARCHAR(100) | - | No | - | Nama tampilan peran untuk antarmuka |
| `deskripsi` | VARCHAR(255) | - | Yes | NULL | Penjelasan lingkup wewenang peran |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pencatatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan data |

---

### 2. Tabel: `users`
- **Fungsi**: Menyimpan data akun pengguna pengelola dashboard.
- **Index**: PRIMARY (`id`), UNIQUE (`email`), INDEX (`role_id`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator unik pengguna |
| `role_id` | BIGINT UNSIGNED | FK | No | - | Mengacu ke `roles.id` (RESTRICT) |
| `name` | VARCHAR(150) | - | No | - | Nama lengkap pengguna |
| `email` | VARCHAR(150) | UK | No | - | Alamat email unik untuk login |
| `password` | VARCHAR(255) | - | No | - | Hash bcrypt/argon2 kata sandi |
| `no_hp` | VARCHAR(30) | - | Yes | NULL | Nomor kontak WhatsApp/seluler |
| `status_aktif` | TINYINT(1) | - | No | 1 | Status akun aktif (1) atau dinonaktifkan (0) |
| `avatar` | VARCHAR(255) | - | Yes | NULL | Lokasi berkas foto profil |
| `remember_token` | VARCHAR(100) | - | Yes | NULL | Token sesi "ingat saya" Laravel |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pendaftaran akun |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan profil akun |

---

### 3. Tabel: `profil_paroki`
- **Fungsi**: Menyimpan data identitas resmi, alamat, kontak, dan visi-misi paroki (Single Row).
- **Index**: PRIMARY (`id`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator record profil |
| `nama_paroki` | VARCHAR(150) | - | No | Paroki Santo Paulus Wonosobo | Nama resmi gereja paroki |
| `keuskupan` | VARCHAR(150) | - | No | Keuskupan Purwokerto | Nama keuskupan induk |
| `pelindung` | VARCHAR(100) | - | No | Santo Paulus Rasul | Nama santo pelindung paroki |
| `pesta_nama` | VARCHAR(100) | - | Yes | 29 Juni | Tanggal perayaan pesta pelindung |
| `alamat` | TEXT | - | No | - | Alamat jalan lengkap gereja |
| `kelurahan` | VARCHAR(100) | - | Yes | Wonosobo Timur | Kelurahan lokasi gereja |
| `kecamatan` | VARCHAR(100) | - | Yes | Wonosobo | Kecamatan lokasi gereja |
| `kabupaten` | VARCHAR(100) | - | Yes | Wonosobo | Kabupaten lokasi gereja |
| `provinsi` | VARCHAR(100) | - | Yes | Jawa Tengah | Provinsi lokasi gereja |
| `kode_pos` | VARCHAR(10) | - | Yes | 56311 | Kode pos wilayah gereja |
| `telepon` | VARCHAR(50) | - | Yes | NULL | Nomor telepon resmi sekretariat |
| `email` | VARCHAR(150) | - | Yes | NULL | Alamat email resmi paroki |
| `whatsapp` | VARCHAR(50) | - | Yes | NULL | Nomor WhatsApp resmi layanan umat |
| `google_maps_embed` | TEXT | - | Yes | NULL | Kode embed iframe Google Maps |
| `latitude` | DECIMAL(10,8) | - | Yes | NULL | Titik koordinat latitude |
| `longitude` | DECIMAL(11,8) | - | Yes | NULL | Titik koordinat longitude |
| `deskripsi_singkat` | TEXT | - | Yes | NULL | Ringkasan profil untuk beranda |
| `sambutan_pastor` | TEXT | - | Yes | NULL | Kata sambutan Pastor Kepala Paroki |
| `visi` | TEXT | - | Yes | NULL | Visi pastoral paroki |
| `misi` | TEXT | - | Yes | NULL | Misi pastoral paroki |
| `foto_gereja_utama` | VARCHAR(255) | - | Yes | NULL | Foto utama gereja untuk hero section |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pencatatan awal |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan profil |

---

### 4. Tabel: `sejarah_parokis`
- **Fungsi**: Menyimpan linimasa peristiwa dan tonggak sejarah paroki.
- **Index**: PRIMARY (`id`), INDEX (`tahun`), INDEX (`urutan`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator unik peristiwa |
| `tahun` | VARCHAR(30) | - | No | - | Tahun atau rentang tahun peristiwa |
| `judul_peristiwa` | VARCHAR(200) | - | No | - | Judul tonggak sejarah |
| `deskripsi` | TEXT | - | No | - | Penjelasan uraian peristiwa sejarah |
| `foto` | VARCHAR(255) | - | Yes | NULL | Berkas foto arsip/dokumentasi sejarah |
| `urutan` | INT | - | No | 0 | Urutan penayangan linimasa |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu perubahan data |

---

### 5. Tabel: `arsitektur_filosofis`
- **Fungsi**: Menyimpan konsep filosofis arsitektur gereja Joglo Pangrawit Ceblokan dan Goa Garba.
- **Index**: PRIMARY (`id`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator filosofi |
| `nama_arsitektur` | VARCHAR(150) | - | No | Joglo Pangrawit Ceblokan | Nama tipe gaya arsitektur |
| `konsep_utama` | VARCHAR(150) | - | No | Garbha Griha / Goa Garba | Konsep filosofis ruang sakral |
| `inkulturasi` | TEXT | - | No | - | Uraian inkulturasi Jawa-Katolik |
| `deskripsi_lengkap` | LONGTEXT | - | No | - | Penjelasan arsitektur mendalam |
| `foto_arsitektur` | VARCHAR(255) | - | Yes | NULL | Foto visual arsitektur gereja |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan data |

---

### 6. Tabel: `arsitektur_simbols`
- **Fungsi**: Menyimpan 20 simbol arsitektur gereja secara rinci.
- **Index**: PRIMARY (`id`), UNIQUE (`nomor_simbol`), INDEX (`urutan`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator simbol |
| `nomor_simbol` | INT | UK | No | - | Nomor urut resmi simbol (1 s/d 20) |
| `nama_simbol` | VARCHAR(150) | - | No | - | Nama simbol arsitektur |
| `arti_filosofis` | TEXT | - | No | - | Makna filosofis budaya Jawa |
| `makna_teologis` | TEXT | - | No | - | Makna teologis kristiani |
| `lokasi_pada_gereja` | VARCHAR(150) | - | Yes | NULL | Posisi fisik simbol pada gereja |
| `foto_simbol` | VARCHAR(255) | - | Yes | NULL | Foto detail ornamen/simbol |
| `urutan` | INT | - | No | 0 | Urutan tampilan dalam website |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan data |

---

### 7. Tabel: `pastors`
- **Fungsi**: Menyimpan profil para imam/pastor.
- **Index**: PRIMARY (`id`), INDEX (`status_pelayanan`), INDEX (`urutan`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator unik pastor |
| `nama_lengkap` | VARCHAR(150) | - | No | - | Nama lengkap beserta gelar imam |
| `gelar_sebutan` | VARCHAR(50) | - | Yes | Romo | Gelar sapaan / tarekat (MSF/Pr) |
| `tahbisan_date` | DATE | - | Yes | NULL | Tanggal tahbisan imamat |
| `status_pelayanan` | ENUM | - | No | aktif | `aktif`, `purnatugas`, `almarhum`, `pindah` |
| `foto` | VARCHAR(255) | - | Yes | NULL | Foto profil pastor |
| `keterangan` | TEXT | - | Yes | NULL | Riwayat atau catatan khusus |
| `urutan` | INT | - | No | 0 | Urutan tampilan daftar pastor |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan data |

---

### 8. Tabel: `pastor_pelayanans`
- **Fungsi**: Menyimpan riwayat periode masa jabatan pelayanan imam di paroki.
- **Index**: PRIMARY (`id`), INDEX (`pastor_id`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator riwayat penugasan |
| `pastor_id` | BIGINT UNSIGNED | FK | No | - | Mengacu ke `pastors.id` (CASCADE) |
| `jabatan` | VARCHAR(100) | - | No | - | Jabatan (Pastor Kepala / Vikaris) |
| `tahun_mulai` | SMALLINT | - | No | - | Tahun awal bertugas di paroki |
| `tahun_selesai` | SMALLINT | - | Yes | NULL | Tahun selesai (NULL jika sedang bertugas) |
| `catatan` | TEXT | - | Yes | NULL | Catatan masa penugasan |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan data |

---

### 9. Tabel: `lingkungans`
- **Fungsi**: Menyimpan data induk 14 lingkungan di paroki.
- **Index**: PRIMARY (`id`), UNIQUE (`nomor_lingkungan`), INDEX (`wilayah`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator lingkungan |
| `nomor_lingkungan` | VARCHAR(20) | UK | No | - | Nomor/Kode lingkungan |
| `nama_lingkungan` | VARCHAR(100) | - | No | - | Nama lingkungan |
| `nama_pelindung` | VARCHAR(100) | - | No | - | Nama santo/santa pelindung |
| `wilayah` | VARCHAR(100) | - | Yes | NULL | Wilayah pengelompokan pastoral |
| `ketua_lingkungan` | VARCHAR(150) | - | Yes | NULL | Nama ketua lingkungan aktif |
| `kontak` | VARCHAR(50) | - | Yes | NULL | Kontak ketua/pengurus lingkungan |
| `jumlah_kk` | INT | - | Yes | NULL | Estimasi jumlah KK umat |
| `keterangan` | TEXT | - | Yes | NULL | Wilayah geografis cakupan |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan data |

---

### 10. Tabel: `stasis`
- **Fungsi**: Menyimpan data induk 7 stasi wilayah luar paroki.
- **Index**: PRIMARY (`id`), UNIQUE (`nama_stasi`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator stasi |
| `nama_stasi` | VARCHAR(150) | UK | No | - | Nama gereja/kapel stasi |
| `nama_pelindung` | VARCHAR(100) | - | No | - | Nama pelindung stasi |
| `lokasi_desa_kecamatan` | VARCHAR(200) | - | No | - | Lokasi desa dan kecamatan stasi |
| `jarak_dari_pusat_km` | DECIMAL(5,2) | - | Yes | NULL | Jarak fisik dari gereja paroki (km) |
| `ketua_stasi` | VARCHAR(150) | - | Yes | NULL | Nama ketua stasi aktif |
| `kontak` | VARCHAR(50) | - | Yes | NULL | Kontak pengurus stasi |
| `kapasitas_umat` | INT | - | Yes | NULL | Daya tampung gereja stasi |
| `foto_gereja_stasi` | VARCHAR(255) | - | Yes | NULL | Foto gedung kapel/gereja stasi |
| `keterangan` | TEXT | - | Yes | NULL | Catatan pastoral stasi |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan data |

---

### 11. Tabel: `organisasi_kategorials`
- **Fungsi**: Menyimpan data 7 kelompok kategorial paroki (OMK, WKRI, Monika, Legio, PDPKK, CFM, ME).
- **Index**: PRIMARY (`id`), UNIQUE (`kode_organisasi`), INDEX (`urutan`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator kategorial |
| `kode_organisasi` | VARCHAR(50) | UK | No | - | Kode unik (OMK, WKRI, CFM, dll.) |
| `nama_organisasi` | VARCHAR(150) | - | No | - | Nama lengkap organisasi kategorial |
| `deskripsi` | TEXT | - | No | - | Penjelasan bidang pelayanan |
| `visi_misi` | TEXT | - | Yes | NULL | Visi dan misi kategorial |
| `ketua` | VARCHAR(150) | - | Yes | NULL | Nama ketua/koordinator aktif |
| `pembina` | VARCHAR(150) | - | Yes | NULL | Moderator/pembina rohani |
| `jadwal_kegiatan_rutin` | VARCHAR(255) | - | Yes | NULL | Jadwal pertemuan rutin |
| `kontak` | VARCHAR(50) | - | Yes | NULL | Kontak pengurus kategorial |
| `logo` | VARCHAR(255) | - | Yes | NULL | Logo organisasi kategorial |
| `urutan` | INT | - | No | 0 | Urutan tampilan |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan data |

---

### 12. Tabel: `jadwal_ekaristis`
- **Fungsi**: Menyimpan jadwal perayaan Ekaristi (Gereja Utama dan Stasi).
- **Index**: PRIMARY (`id`), INDEX (`stasi_id`), INDEX (`tipe_perayaan`), INDEX (`hari`), INDEX (`tanggal`), INDEX (`is_aktif`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator jadwal misa |
| `stasi_id` | BIGINT UNSIGNED | FK | Yes | NULL | NULL = Gereja Utama, terisi = Stasi (RESTRICT) |
| `nama_perayaan` | VARCHAR(150) | - | No | - | Nama misa (cth: "Misa Mingguan Pagi") |
| `tipe_perayaan` | ENUM | - | No | mingguan | `harian`, `mingguan`, `hari_raya`, `khusus` |
| `lokasi_keterangan` | VARCHAR(150) | - | Yes | NULL | Keterangan lokasi spesifik |
| `hari` | VARCHAR(20) | - | Yes | NULL | Hari berulang (Senin s/d Minggu) |
| `tanggal` | DATE | - | Yes | NULL | Tanggal spesifik (untuk Hari Raya/Khusus) |
| `waktu_mulai` | TIME | - | No | - | Jam dimulainya perayaan |
| `waktu_selesai` | TIME | - | Yes | NULL | Estimasi jam selesai perayaan |
| `bahasa` | VARCHAR(50) | - | No | Bahasa Indonesia | Bahasa pengantar liturgi |
| `keterangan` | TEXT | - | Yes | NULL | Keterangan tambahan (cth: Misa Lansia) |
| `is_aktif` | TINYINT(1) | - | No | 1 | Penanda apakah jadwal aktif berlaku |
| `created_by` | BIGINT UNSIGNED | FK | Yes | NULL | User pembuat jadwal (SET NULL) |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan data |

---

### 13. Tabel: `liturgi_perans`
- **Fungsi**: Master jenis tugas liturgi gereja.
- **Index**: PRIMARY (`id`), UNIQUE (`nama_peran`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator peran liturgi |
| `nama_peran` | VARCHAR(100) | UK | No | - | Nama tugas (Lektor, Misdinar, Organis, dll.) |
| `deskripsi` | VARCHAR(255) | - | Yes | NULL | Penjelasan tugas liturgis |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan data |

---

### 14. Tabel: `jadwal_petugas_liturgis`
- **Fungsi**: Menyimpan alokasi penugasan petugas liturgi pada jadwal misa.
- **Index**: PRIMARY (`id`), INDEX (`jadwal_ekaristi_id`), INDEX (`liturgi_peran_id`), INDEX (`lingkungan_id`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator tugas liturgi |
| `jadwal_ekaristi_id` | BIGINT UNSIGNED | FK | No | - | Mengacu ke `jadwal_ekaristis.id` (CASCADE) |
| `liturgi_peran_id` | BIGINT UNSIGNED | FK | No | - | Mengacu ke `liturgi_perans.id` (RESTRICT) |
| `lingkungan_id` | BIGINT UNSIGNED | FK | Yes | NULL | Mengacu ke `lingkungans.id` (SET NULL) |
| `nama_petugas` | VARCHAR(150) | - | No | - | Nama kelompok atau nama individu petugas |
| `kontak` | VARCHAR(50) | - | Yes | NULL | Kontak koordinator petugas |
| `catatan` | TEXT | - | Yes | NULL | Catatan pakaian/petunjuk khusus |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan data |

---

### 15. Tabel: `agenda_kegiatans`
- **Fungsi**: Menyimpan kalender agenda pastoral paroki.
- **Index**: PRIMARY (`id`), UNIQUE (`slug`), INDEX (`tanggal_mulai`), INDEX (`is_aktif`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator agenda |
| `created_by` | BIGINT UNSIGNED | FK | Yes | NULL | User pembuat (RESTRICT) |
| `nama_kegiatan` | VARCHAR(200) | - | No | - | Nama kegiatan/acara |
| `slug` | VARCHAR(220) | UK | No | - | Slug URL ramah SEO |
| `kategori_kegiatan` | VARCHAR(100) | - | No | Pastoral | Jenis acara (Liturgi, Sosial, Retret) |
| `tanggal_mulai` | DATE | - | No | - | Tanggal dimulainya agenda |
| `tanggal_selesai` | DATE | - | Yes | NULL | Tanggal berakhir jika multitanggal |
| `waktu_mulai` | TIME | - | Yes | NULL | Waktu mulai agenda |
| `waktu_selesai` | TIME | - | Yes | NULL | Waktu selesai agenda |
| `lokasi` | VARCHAR(200) | - | No | - | Lokasi pelaksanaan acara |
| `deskripsi` | TEXT | - | No | - | Uraian lengkap agenda |
| `penyelenggara` | VARCHAR(150) | - | No | - | Panitia/seksi penyelenggara |
| `kontak_person` | VARCHAR(100) | - | Yes | NULL | Kontak informasi kegiatan |
| `gambar_poster` | VARCHAR(255) | - | Yes | NULL | Berkas poster kegiatan |
| `is_aktif` | TINYINT(1) | - | No | 1 | Status aktif publikasi |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan data |

---

### 16. Tabel: `kategori_beritas`
- **Fungsi**: Kategori taksonomi untuk berita paroki.
- **Index**: PRIMARY (`id`), UNIQUE (`slug`), INDEX (`urutan`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator kategori |
| `nama_kategori` | VARCHAR(100) | - | No | - | Nama kategori berita |
| `slug` | VARCHAR(120) | UK | No | - | Slug URL unik |
| `deskripsi` | VARCHAR(255) | - | Yes | NULL | Deskripsi singkat kategori |
| `urutan` | INT | - | No | 0 | Urutan penataan |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan data |

---

### 17. Tabel: `beritas`
- **Fungsi**: Menyimpan artikel berita paroki yang dikelola Tim Komsos.
- **Index**: PRIMARY (`id`), UNIQUE (`slug`), INDEX (`kategori_berita_id`), INDEX (`user_id`), INDEX (`status`), INDEX (`published_at`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator berita |
| `kategori_berita_id` | BIGINT UNSIGNED | FK | No | - | Mengacu ke `kategori_beritas.id` (RESTRICT) |
| `user_id` | BIGINT UNSIGNED | FK | No | - | Mengacu ke `users.id` (RESTRICT) |
| `judul` | VARCHAR(255) | - | No | - | Judul artikel warta |
| `slug` | VARCHAR(280) | UK | No | - | Slug URL unik |
| `ringkasan` | TEXT | - | Yes | NULL | Cuplikan singkat artikel |
| `isi` | LONGTEXT | - | No | - | Isi lengkap berita (format HTML/Markdown) |
| `gambar_sampul` | VARCHAR(255) | - | Yes | NULL | Berkas gambar sampul utama |
| `caption_gambar` | VARCHAR(255) | - | Yes | NULL | Keterangan foto sampul |
| `status` | ENUM | - | No | draft | Status publikasi: `draft`, `published` |
| `published_at` | TIMESTAMP | - | Yes | NULL | Tanggal dan jam terbit resmi |
| `view_count` | BIGINT UNSIGNED | - | No | 0 | Jumlah pembaca artikel |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu perubahan data |
| `deleted_at` | TIMESTAMP | - | Yes | NULL | Dukungan Soft Deletes |

---

### 18. Tabel: `renungans`
- **Fungsi**: Menyimpan renungan rohani dan sapaan gembala oleh Romo Paroki.
- **Index**: PRIMARY (`id`), UNIQUE (`slug`), INDEX (`user_id`), INDEX (`status`), INDEX (`tanggal_renungan`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator renungan |
| `user_id` | BIGINT UNSIGNED | FK | No | - | Mengacu ke `users.id` (Romo penulis) |
| `judul` | VARCHAR(255) | - | No | - | Judul renungan |
| `slug` | VARCHAR(280) | UK | No | - | Slug URL unik |
| `ayat_bacaan` | VARCHAR(150) | - | Yes | NULL | Rujukan perikop Kitab Suci |
| `tanggal_renungan` | DATE | - | No | - | Tanggal liturgi renungan |
| `isi` | LONGTEXT | - | No | - | Naskah renungan lengkap |
| `gambar_sampul` | VARCHAR(255) | - | Yes | NULL | Gambar ilustrasi renungan |
| `status` | ENUM | - | No | draft | Status publikasi: `draft`, `published` |
| `published_at` | TIMESTAMP | - | Yes | NULL | Waktu publikasi resmi |
| `view_count` | BIGINT UNSIGNED | - | No | 0 | Jumlah pembaca renungan |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan data |
| `deleted_at` | TIMESTAMP | - | Yes | NULL | Dukungan Soft Deletes |

---

### 19. Tabel: `warta_parokis`
- **Fungsi**: Menyimpan berkas digital Warta Paroki mingguan (PDF).
- **Index**: PRIMARY (`id`), INDEX (`user_id`), INDEX (`tanggal_terbit`), INDEX (`status`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator warta paroki |
| `user_id` | BIGINT UNSIGNED | FK | No | - | Pengunggah berkas (`users.id`) |
| `judul` | VARCHAR(200) | - | No | - | Judul lembar warta |
| `edisi` | VARCHAR(100) | - | No | - | Edisi minggu liturgi |
| `tanggal_terbit` | DATE | - | No | - | Tanggal terbit edisi |
| `deskripsi` | TEXT | - | Yes | NULL | Rangkuman isi edisi |
| `file_path` | VARCHAR(255) | - | No | - | Jalur berkas PDF dalam storage |
| `file_size_bytes` | BIGINT | - | Yes | NULL | Ukuran berkas PDF dalam byte |
| `download_count` | INT | - | No | 0 | Total unduhan umat |
| `status` | ENUM | - | No | draft | `draft`, `published` |
| `published_at` | TIMESTAMP | - | Yes | NULL | Waktu publikasi |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pengunggahan |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan |

---

### 20. Tabel: `galeri_albums`
- **Fungsi**: Wadah album dokumentasi kegiatan paroki.
- **Index**: PRIMARY (`id`), UNIQUE (`slug`), INDEX (`user_id`), INDEX (`status`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator album |
| `user_id` | BIGINT UNSIGNED | FK | No | - | Pembuat album (`users.id`) |
| `judul` | VARCHAR(200) | - | No | - | Nama album kegiatan |
| `slug` | VARCHAR(220) | UK | No | - | Slug URL unik album |
| `deskripsi` | TEXT | - | Yes | NULL | Uraian kegiatan dalam album |
| `tanggal_kegiatan` | DATE | - | Yes | NULL | Tanggal dokumentasi acara |
| `cover_foto` | VARCHAR(255) | - | Yes | NULL | Foto sampul album |
| `status` | ENUM | - | No | published | `draft`, `published` |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan data |

---

### 21. Tabel: `galeri_fotos`
- **Fungsi**: Menyimpan foto detail yang bernaung di dalam album.
- **Index**: PRIMARY (`id`), INDEX (`galeri_album_id`), INDEX (`urutan`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator foto |
| `galeri_album_id` | BIGINT UNSIGNED | FK | No | - | Mengacu ke `galeri_albums.id` (CASCADE) |
| `file_path` | VARCHAR(255) | - | No | - | Jalur berkas gambar foto |
| `caption` | VARCHAR(255) | - | Yes | NULL | Keterangan teks foto |
| `urutan` | INT | - | No | 0 | Urutan tampilan dalam album |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu unggah foto |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan data |

---

### 22. Tabel: `sakramen_informasis`
- **Fungsi**: Menyimpan informasi panduan katekese, syarat, dan prosedur 7 sakramen gereja (Informasi Murni, Tanpa Formulir Online).
- **Index**: PRIMARY (`id`), UNIQUE (`kode_sakramen`), INDEX (`urutan`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator sakramen |
| `kode_sakramen` | VARCHAR(50) | UK | No | - | Kode unik (cth: `baptis_bayi`, `perkawinan`, dll.) |
| `nama_sakramen` | VARCHAR(150) | - | No | - | Nama resmi sakramen |
| `deskripsi_teologis` | TEXT | - | No | - | Pengantar teologis sakramen |
| `persyaratan` | LONGTEXT | - | No | - | Daftar syarat dokumen fisik tatap muka |
| `prosedur_pelayanan` | LONGTEXT | - | No | - | Langkah-langkah pengurusan di sekretariat |
| `jadwal_pelayanan_rutin`| TEXT | - | Yes | NULL | Waktu pelaksanaan berkala |
| `kontak_layanan` | VARCHAR(100) | - | Yes | NULL | Kontak sekretariat terkait sakramen |
| `urutan` | INT | - | No | 0 | Urutan tampilan sakramen (1-7) |
| `created_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | - | Yes | CURRENT_TIMESTAMP | Waktu pembaruan data |

---

### 23. Tabel: `audit_logs`
- **Fungsi**: Rekam jejak audit keamanan operasional dan integritas Data Master.
- **Index**: PRIMARY (`id`), INDEX (`user_id`), INDEX (`aksi`), INDEX (`entitas`), INDEX (`entitas_id`), INDEX (`created_at`).

| Nama Kolom | Tipe Data | Key | Null | Default | Keterangan |
|---|---|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | No | AUTO_INCREMENT | Identifikator audit log |
| `user_id` | BIGINT UNSIGNED | FK | Yes | NULL | Pelaku aksi (`users.id`, SET NULL) |
| `role_name` | VARCHAR(50) | - | Yes | NULL | Snapshot role saat aksi dieksekusi |
| `aksi` | VARCHAR(50) | - | No | - | `CREATE`, `UPDATE`, `DELETE`, `PUBLISH`, `DRAFT` |
| `entitas` | VARCHAR(100) | - | No | - | Nama model entitas yang diubah |
| `entitas_id` | BIGINT UNSIGNED | - | Yes | NULL | ID record yang dikenai aksi |
| `data_lama` | JSON | - | Yes | NULL | Snapshot data sebelum mutasi |
| `data_baru` | JSON | - | Yes | NULL | Snapshot data sesudah mutasi |
| `ip_address` | VARCHAR(45) | - | Yes | NULL | Alamat IP pengguna |
| `user_agent` | TEXT | - | Yes | NULL | Browser / Client user agent |
| `created_at` | TIMESTAMP | - | No | CURRENT_TIMESTAMP | Waktu persis kejadian aksi |

