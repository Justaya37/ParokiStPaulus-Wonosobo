# Perancangan UI/UX: Romo Dashboard (Sapaan Gembala & Data Master)
## Website Profil dan Sistem Informasi Paroki Santo Paulus Wonosobo

Dashboard Romo Paroki dirancang khusus untuk kenyamanan pastoral Romo dalam menulis karya refleksi iman serta mengawasi dan mengelola Data Master paroki.

---

### 1. Karakteristik Desain Dashboard Romo
- Antarmuka yang tenang, bersih, bebas gangguan (*distraction-free writing experience*).
- Sidebar menggunakan skema warna identitas paroki yang sama (`Dark Brown #5B4032`).
- Hanya menampilkan menu yang menjadi wewenang Romo Paroki, menghilangkan menu administratif yang tidak relevan (seperti manajemen pengguna atau warta paroki).

---

### 2. Menu Navigasi Romo Paroki

1. **Dashboard Utama**:
   - Ringkasan sapaan renungan: Total Renungan Ditulis, Renungan Terbit (*Published*), Draft Renungan Tersimpan.
   - Akses cepat: *"Tulis Renungan Baru"*.
   - Kalender liturgi dan jadwal misa paroki hari ini.
2. **Renungan / Sapaan Gembala**:
   - Daftar renungan yang ditulis oleh Romo dengan status `Draft` atau `Published`.
   - **Form Editor Renungan**:
     - Judul Renungan.
     - Ayat Bacaan Kitab Suci (misal: "Mat 5:1-12").
     - Tanggal Renungan Liturgi.
     - Gambar Ilustrasi Sampul (opsional).
     - Area Teks Isi Renungan (format teks kaya dengan spacing nyaman).
     - Tombol Aksi: *"Simpan sebagai Draft"* dan *"Terbitkan Sekarang (Publish)"*.
3. **Data Master Paroki (Shared Master Source)**:
   - Romo Paroki memiliki hak akses CRUD penuh terhadap **sumber data master yang sama persis** dengan Admin Sekretariat:
     - Profil Paroki & Sambutan Gembala.
     - Sejarah Paroki.
     - Filosofi Arsitektur & 20 Simbol Arsitektur.
     - Data Pastor & Periode Penugasan.
     - Data Lingkungan (14) & Stasi (7).
     - Organisasi Kategorial (7).
     - Informasi Katekese & Persyaratan 7 Sakramen.
   - Perubahan data master oleh Romo secara otomatis terekam dalam tabel `audit_logs`.
4. **Supervisi Liturgi & Jadwal (Read-Only)**:
   - Romo dapat memantau jadwal Ekaristi dan susunan petugas liturgi yang telah disusun sekretariat.

