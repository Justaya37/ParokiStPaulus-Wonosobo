# Penjelasan Relasi, Kardinalitas, dan Kebijakan Integritas Data

Dokumen ini menjelaskan secara mendalam setiap relasi antar-entitas, kardinalitas, pemetaan Foreign Key, serta aturan `ON DELETE` dan `ON UPDATE`.

---

### 1. Relasi `roles` -> `users`
- **Kardinalitas**: One-to-Many (`roles` 1 : N `users`).
- **Foreign Key**: `users.role_id` mereferensikan `roles.id`.
- **Aturan Integritas**:
  - `ON UPDATE CASCADE`
  - `ON DELETE RESTRICT`
- **Rasional**: Akun pengguna terikat tepat pada satu role aktif. Penghapusan role master yang masih memiliki pengguna terdaftar dilarang (`RESTRICT`) guna mencegah akun tanpa hak akses atau anomali otorisasi.

---

### 2. Relasi `users` -> `beritas`
- **Kardinalitas**: One-to-Many (`users` 1 : N `beritas`).
- **Foreign Key**: `beritas.user_id` mereferensikan `users.id`.
- **Aturan Integritas**:
  - `ON UPDATE CASCADE`
  - `ON DELETE RESTRICT`
- **Rasional**: Menjaga atribusi kepenulisan warta oleh Tim Komsos. Jika seorang user komsos dinonaktifkan/dihapus, artikel berita yang telah diterbitkan tetap terlindungi sejarah kepenulisannya.

---

### 3. Relasi `kategori_beritas` -> `beritas`
- **Kardinalitas**: One-to-Many (`kategori_beritas` 1 : N `beritas`).
- **Foreign Key**: `beritas.kategori_berita_id` mereferensikan `kategori_beritas.id`.
- **Aturan Integritas**:
  - `ON UPDATE CASCADE`
  - `ON DELETE RESTRICT`
- **Rasional**: Mencegah penghapusan kategori berita jika masih terdapat artikel yang bernaung di bawah kategori tersebut. Komsos harus memindahkan artikel ke kategori lain terlebih dahulu.

---

### 4. Relasi `users` -> `renungans`
- **Kardinalitas**: One-to-Many (`users` 1 : N `renungans`).
- **Foreign Key**: `renungans.user_id` mereferensikan `users.id`.
- **Aturan Integritas**:
  - `ON UPDATE CASCADE`
  - `ON DELETE RESTRICT`
- **Rasional**: Menjamin otentisitas karya gembala Romo Paroki.

---

### 5. Relasi `pastors` -> `pastor_pelayanans`
- **Kardinalitas**: One-to-Many (`pastors` 1 : N `pastor_pelayanans`).
- **Foreign Key**: `pastor_pelayanans.pastor_id` mereferensikan `pastors.id`.
- **Aturan Integritas**:
  - `ON UPDATE CASCADE`
  - `ON DELETE CASCADE`
- **Rasional**: Entitas `pastor_pelayanans` merupakan *weak entity* yang eksistensinya bergantung penuh pada master `pastors`. Jika record pastor dihapus, seluruh linimasa penugasan pastor tersebut ikut terhapus secara bersih.

---

### 6. Relasi `stasis` -> `jadwal_ekaristis`
- **Kardinalitas**: One-to-Many Opsional (`stasis` 1 : N `jadwal_ekaristis`).
- **Foreign Key**: `jadwal_ekaristis.stasi_id` mereferensikan `stasis.id` (`NULLABLE`).
- **Aturan Semantik & Integritas**:
  - `stasi_id IS NULL`: Misa berlangsung di **Gereja Utama Paroki Santo Paulus Wonosobo**.
  - `stasi_id IS NOT NULL`: Misa berlangsung di gedung gereja stasi terkait.
  - `ON UPDATE CASCADE`
  - `ON DELETE RESTRICT`
- **Rasional**: Kebijakan `RESTRICT` memastikan data master stasi tidak dapat dihapus jika masih ada jadwal misa yang aktif terasosiasi dengannya.

---

### 7. Relasi `jadwal_ekaristis` -> `jadwal_petugas_liturgis`
- **Kardinalitas**: One-to-Many (`jadwal_ekaristis` 1 : N `jadwal_petugas_liturgis`).
- **Foreign Key**: `jadwal_petugas_liturgis.jadwal_ekaristi_id` mereferensikan `jadwal_ekaristis.id`.
- **Aturan Integritas**:
  - `ON UPDATE CASCADE`
  - `ON DELETE CASCADE`
- **Rasional**: Jadwal petugas adalah detail komposisi dari satu sesi misa. Jika suatu sesi jadwal misa ditiadakan atau dihapus, alokasi petugas pada sesi tersebut ikut dibersihkan secara otomatis.

---

### 8. Relasi `liturgi_perans` -> `jadwal_petugas_liturgis`
- **Kardinalitas**: One-to-Many (`liturgi_perans` 1 : N `jadwal_petugas_liturgis`).
- **Foreign Key**: `jadwal_petugas_liturgis.liturgi_peran_id` mereferensikan `liturgi_perans.id`.
- **Aturan Integritas**:
  - `ON UPDATE CASCADE`
  - `ON DELETE RESTRICT`
- **Rasional**: Master peran liturgi (Lektor, Organis, Misdinar, dll.) adalah data referensi baku yang dilarang dihapus apabila sedang dipakai dalam jadwal misa.

---

### 9. Relasi `lingkungans` -> `jadwal_petugas_liturgis`
- **Kardinalitas**: One-to-Many Opsional (`lingkungans` 1 : N `jadwal_petugas_liturgis`).
- **Foreign Key**: `jadwal_petugas_liturgis.lingkungan_id` mereferensikan `lingkungans.id` (`NULLABLE`).
- **Aturan Integritas**:
  - `ON UPDATE CASCADE`
  - `ON DELETE SET NULL`
- **Rasional**: Tugas liturgi dapat diberikan atas nama kelompok lingkungan tertentu (misal: "Koor Lingkungan St. Maria"), namun juga dapat diberikan kepada perseorangan/kelompok kategorial independen (`lingkungan_id = NULL`). Jika data lingkungan diubah, data penugasan tetap aman.

---

### 10. Relasi `galeri_albums` -> `galeri_fotos`
- **Kardinalitas**: One-to-Many (`galeri_albums` 1 : N `galeri_fotos`).
- **Foreign Key**: `galeri_fotos.galeri_album_id` mereferensikan `galeri_albums.id`.
- **Aturan Integritas**:
  - `ON UPDATE CASCADE`
  - `ON DELETE CASCADE`
- **Rasional**: Foto-foto galeri berada di dalam sebuah album. Apabila album dihapus, seluruh foto di dalamnya ikut terhapus dari basis data.

---

### 11. Relasi `users` -> `audit_logs`
- **Kardinalitas**: One-to-Many Opsional (`users` 1 : N `audit_logs`).
- **Foreign Key**: `audit_logs.user_id` mereferensikan `users.id` (`NULLABLE`).
- **Aturan Integritas**:
  - `ON UPDATE CASCADE`
  - `ON DELETE SET NULL`
- **Rasional**: Log audit tidak boleh hilang meskipun akun user terkait di kemudian hari dihapus dari sistem. Kolom snapshot `role_name` disimpan secara redundan di tabel audit log untuk menjamin informasi pelaku tetap terlacak.

---

### 12. Prinsip Shared Data Master (Admin & Romo)
- **Implementasi**: Entitas master paroki (`profil_paroki`, `sejarah_parokis`, `arsitektur_filosofis`, `arsitektur_simbols`, `pastors`, `pastor_pelayanans`, `lingkungans`, `stasis`, `organisasi_kategorials`, `sakramen_informasis`) **tidak memiliki Foreign Key ke role tertentu**.
- Kedua role mengacu pada tabel fisik yang identik di basis data, dan hak akses diatur sepenuhnya pada lapisan otorisasi Laravel (Policy & Middleware).

