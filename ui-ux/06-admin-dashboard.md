# Perancangan UI/UX: Admin Dashboard (Sekretariat)
## Website Profil dan Sistem Informasi Paroki Santo Paulus Wonosobo

Admin Dashboard dirancang untuk efisiensi tinggi, navigasi yang intuitif, dan keamanan operasional sekretariat paroki.

---

### 1. Struktur Tata Letak Dashboard (Dashboard Shell Layout)
- **Sidebar Kiri (Fixed Desktop, Drawer Mobile)**:
  - Berwarna dominan `Dark Brown (#5B4032)` dengan kontras teks putih lembut.
  - Header sidebar menampilkan logo gereja dan nama sistem: *"Sekretariat Paroki St. Paulus"*.
  - Indikator menu aktif beraksen *Muted Gold (#B69A68)*.
- **Topbar Atas**:
  - Tombol hamburger (buka/tutup navigasi mobile).
  - Tautan cepat "Lihat Website Publik" (membuka tab baru).
  - Profil pengguna login (nama admin, badge peran, foto/avatar).
  - Tombol Logout aman dengan proteksi CSRF form POST.
- **Area Konten Utama**:
  - Breadcrumb navigasi di bagian atas.
  - Flash alerts notifikasi sukses/gagal beranimasi lembut.
  - Header halaman dengan judul tegas dan tombol aksi utama (*Primary Button*).
  - Kartu statistik dan tabel ringkasan data.

---

### 2. Menu Navigasi Admin Sekretariat
Sesuai matriks hak akses, Admin Sekretariat memiliki akses penuh terhadap modul administrasi:

1. **Dashboard Utama**:
   - Kartu statistik ringkas: Total Jadwal Misa Aktif, Total Agenda Bulan Ini, Total Warta Terbit, Total Lingkungan (14), Total Stasi (7).
   - Pintasan cepat pembuatan jadwal misa baru atau unggah warta paroki.
2. **Jadwal Ekaristi**:
   - Tabel manajemen seluruh sesi misa (Gereja Utama dan Stasi).
   - Form input: Pilihan stasi (opsional / NULL untuk Gereja Utama), nama perayaan, tipe perayaan, hari/tanggal, jam mulai, bahasa, keterangan, dan status aktif.
3. **Petugas Liturgi**:
   - Pengaturan penugasan lektor, pemazmur, misdinar, dan paduan suara lingkungan pada jadwal misa terkait.
4. **Agenda Kegiatan**:
   - Manajemen kalender acara pastoral paroki (nama kegiatan, tanggal mulai & selesai, lokasi, gambar poster).
5. **Warta Paroki**:
   - Pengunggahan berkas digital PDF warta paroki mingguan, nomor edisi, tanggal edisi, dan status publikasi.
6. **Data Master Paroki (Shared Master)**:
   - Profil & Kontak Paroki (Visi, Misi, Alamat, Koordinat, Sambutan).
   - Sejarah Paroki (Manajemen linimasa tonggak peristiwa).
   - Filosofi Arsitektur & 20 Simbol Arsitektur (Edit nama, makna filosofis & teologis simbol 1-20).
   - Data Pastor & Riwayat Masa Bakti Penugasan.
   - Data 14 Lingkungan Paroki.
   - Data 7 Stasi Paroki.
   - Profil 7 Organisasi Kategorial.
   - Panduan Persyaratan 7 Sakramen.
7. **Manajemen Pengguna (User Management)**:
   - Manajemen akun pengelola sistem: pembuatan akun staf sekretariat, akun romo, dan akun komsos; reset password aman; aktifasi/non-aktifkan akun.
8. **Audit Log**:
   - Rekam jejak seluruh mutasi data penting yang dilakukan oleh Admin dan Romo (waktu, aksi, modul, user pelaku, detail perubahan).

