# Panduan Implementasi Teknis & Pemeliharaan Sistem
## Website Profil dan Sistem Informasi Paroki Santo Paulus Wonosobo

Panduan ini ditujukan bagi pengembang, administrator sistem, dan tim teknis Paroki Santo Paulus Wonosobo dalam menjalankan, menguji, dan merawat sistem.

---

### 1. Prasyarat Lingkungan Server / Hosting
- **Sistem Operasi**: Linux Ubuntu 22.04 LTS / 24.04 LTS atau Windows Server (Laragon / XAMPP untuk lokal).
- **PHP**: Versi 8.2 atau 8.4 (ekstensi aktif: `pdo_mysql`, `mbstring`, `openssl`, `bcmath`, `curl`, `fileinfo`, `gd`, `zip`).
- **MySQL / MariaDB**: MySQL 8.0+ atau MariaDB 10.6+.
- **Web Server**: Nginx atau Apache HTTPD dengan mod_rewrite aktif.
- **Node.js**: Node.js 18+ & NPM (untuk kompilasi aset front-end jika diperlukan).

---

### 2. Langkah Instalasi & Konfigurasi Basis Data

1. **Konfigurasi Lingkungan (`.env`)**:
   Pastikan berkas `.env` telah disesuaikan dengan kredensial database lokal:
   ```env
   APP_NAME="Paroki Santo Paulus Wonosobo"
   APP_ENV=local
   APP_KEY=base64:...
   APP_DEBUG=true
   APP_URL=http://localhost:8000
   APP_TIMEZONE=Asia/Jakarta
   APP_LOCALE=id

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_paroki_stpaulus
   DB_USERNAME=root
   DB_PASSWORD=
   ```

2. **Membuat Basis Data di MySQL**:
   ```sql
   CREATE DATABASE IF NOT EXISTS db_paroki_stpaulus
   CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

3. **Menjalankan Migration**:
   ```bash
   php artisan migrate
   ```

4. **Menjalankan Seeder Data Awal**:
   ```bash
   php artisan db:seed
   ```
   *Catatan*: Seeder akan mengisi data referensi:
   - 4 Role otorisasi (`admin_sekretariat`, `romo_paroki`, `tim_komsos`, `guest`).
   - Akun pengguna administratif awal.
   - Master Data: 14 Lingkungan, 7 Stasi, 7 Organisasi Kategorial, Profil Paroki, Filosofi Arsitektur & 20 Simbol Arsitektur, serta Master Peran Liturgi.

5. **Membuat Symlink Berkas Storage**:
   ```bash
   php artisan storage:link
   ```

---

### 3. Keamanan Akun dan Kata Sandi

1. **Kredensial Awal**: Akun awal yang dibuat melalui seeder menggunakan hashing bcrypt dengan faktor kerja (*work factor*) standar 12 rounds.
2. **Penggantian Kata Sandi**: Administrator wajib segera mengganti kata sandi awal saat pertama kali masuk ke sistem sebelum dideploy ke lingkungan produksi.
3. **Pencatatan Audit**: Setiap perubahan pada Data Master paroki akan secara otomatis terekam pada tabel `audit_logs`.

