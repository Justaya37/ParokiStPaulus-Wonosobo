# Daftar Entitas Sistem Informasi Paroki Santo Paulus Wonosobo

Berikut adalah daftar lengkap entitas basis data yang dirancang untuk mendukung operasional public website dan admin dashboard RBAC:

---

### 1. Modul Manajemen Pengguna & Otorisasi
- **`roles`**
  - *Deskripsi*: Menyimpan data referensi peran otorisasi pengguna sistem.
  - *Sifat*: Master Referensi (Read-Mostly).
  - *Data Awal*: `admin_sekretariat`, `romo_paroki`, `tim_komsos`, `guest`.

- **`users`**
  - *Deskripsi*: Menyimpan kredensial dan profil akun pengelola sistem dashboard.
  - *Relasi*: Mengacu ke `roles` (`role_id` - Many-to-One).

---

### 2. Modul Data Master Paroki (Shared Master Data)
- **`profil_paroki`**
  - *Deskripsi*: Menyimpan identitas legal gereja, nama pelindung, keuskupan, alamat fisik, kontak sekretariat, koordinat GPS, visi-misi, serta foto utama gereja.
  - *Sifat*: Entitas Konfigurasi Tunggal (Single Row).

- **`sejarah_parokis`**
  - *Deskripsi*: Menyimpan linimasa peristiwa historis dan tonggak perkembangan berdirinya Paroki Santo Paulus Wonosobo dari waktu ke waktu.
  - *Karakteristik*: Memiliki atribut `tahun`, `judul_peristiwa`, `deskripsi`, `foto_dokumentasi`, `urutan`.

- **`arsitektur_filosofis`**
  - *Deskripsi*: Menyimpan narasi konsep arsitektur *Joglo Pangrawit Ceblokan*, filosofi ruang sakral *Garbha Griha / Goa Garba*, dan nilai inkulturasi budaya Jawa dalam tradisi liturgi Katolik.

- **`arsitektur_simbols`**
  - *Deskripsi*: Menyimpan katalog **20 simbol arsitektur gereja** (nomor 1 s/d 20), menjelaskan nama simbol, makna filosofis, nilai teologis kristiani, lokasi fisik pada bangunan gereja, dan foto detail.

- **`pastors`**
  - *Deskripsi*: Menyimpan data induk imam/pastor yang melayani atau pernah berkarya di Paroki Santo Paulus Wonosobo (nama lengkap, gelar/tarekat misal MSF/Pr, foto, status pelayanan).

- **`pastor_pelayanans`**
  - *Deskripsi*: Riwayat periode penugasan imam di paroki. Mendukung relasi One-to-Many dari entitas `pastors` untuk mengakomodasi pastor yang melayani dalam beberapa rentang masa jabatan berbeda.

- **`lingkungans`**
  - *Deskripsi*: Menyimpan data induk **14 lingkungan** yang ada di Paroki Santo Paulus Wonosobo (nomor lingkungan, nama pelindung, wilayah pastoral, ketua lingkungan, dan kontak).

- **`stasis`**
  - *Deskripsi*: Menyimpan data induk **7 stasi** wilayah pastoral Paroki Santo Paulus Wonosobo (nama stasi, nama pelindung, lokasi wilayah/desa, kapasitas umat, dan kontak).

- **`organisasi_kategorials`**
  - *Deskripsi*: Menyimpan profil resmi kelompok kategorial paroki: OMK, WKRI, PWK Santa Monika, Legio Mariae, PDPKK, CFM, dan ME.

- **`sakramen_informasis`**
  - *Deskripsi*: Menyimpan panduan katekese, persyaratan dokumen administratif tatap muka, dan alur prosedur pelayanan untuk 7 sakramen gereja (Baptis, Krisma, Ekaristi/Komuni Pertama, Rekonsiliasi/Tobat, Perkawinan, Imamat, Pengurapan Orang Sakit). **Tidak memuat formulir pendaftaran daring**.

---

### 3. Modul Liturgi & Ibadat
- **`jadwal_ekaristis`**
  - *Deskripsi*: Menyimpan jadwal perayaan Ekaristi (Harian, Mingguan, Hari Raya, Khusus) baik untuk Gereja Utama maupun Stasi.
  - *Relasi*: Atribut `stasi_id` bersifat opsional (Nullable). Jika `NULL`, merujuk ke Gereja Utama Paroki Santo Paulus Wonosobo.

- **`liturgi_perans`**
  - *Deskripsi*: Master referensi peran pelayanan liturgi (Lektor, Pemazmur, Misdinar, Organis, Dirigen, Kolektan, Prodiakon, Tata Tertib).

- **`jadwal_petugas_liturgis`**
  - *Deskripsi*: Menyimpan penugasan individu atau kelompok lingkungan untuk peran liturgi tertentu pada sesi Misa yang terdaftar di `jadwal_ekaristis`.

---

### 4. Modul Kegiatan & Pastoral
- **`agenda_kegiatans`**
  - *Deskripsi*: Kalender kegiatan pastoral, rapat dewan paroki, retret, misa lingkungan, dan kegiatan umum umat paroki.

---

### 5. Modul Publikasi & Media Komunikasi (Komsos & Romo)
- **`kategori_beritas`**
  - *Deskripsi*: Taksonomi kategori artikel berita (misal: Berita Paroki, Berita Lingkungan, Liputan Khusus, Komsos).

- **`beritas`**
  - *Deskripsi*: Artikel berita paroki yang dikelola oleh Tim Komsos / OMK dengan dukungan status draft/published dan penghitungan pembaca (view count). Mendukung Soft Deletes.

- **`renungans`**
  - *Deskripsi*: Refleksi iman, sapaan gembala, dan ulasan bacaan liturgi harian/mingguan yang ditulis langsung oleh Romo Paroki. Mendukung Soft Deletes.

- **`warta_parokis`**
  - *Deskripsi*: Arsip digital lembar warta paroki mingguan berupa berkas unduhan dokumen PDF resmi beserta metadata tanggal terbit dan ukuran berkas.

- **`galeri_albums`**
  - *Deskripsi*: Wadah album dokumentasi foto kegiatan pastoral paroki yang dikelola oleh Tim Komsos.

- **`galeri_fotos`**
  - *Deskripsi*: Rekaman berkas foto yang terhubung ke satu `galeri_albums` (relasi One-to-Many).

---

### 6. Modul Pengawasan & Akuntabilitas
- **`audit_logs`**
  - *Deskripsi*: Rekam jejak audit keamanan dan integritas data untuk mencatat operasi mutasi data (CREATE, UPDATE, DELETE, PUBLISH) terutama pada Data Master Paroki yang diakses bersama oleh Admin Sekretariat dan Romo Paroki.

