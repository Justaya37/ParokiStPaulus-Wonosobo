# Pemeriksaan Normalisasi Basis Data (1NF, 2NF, 3NF)
## Website Profil dan Sistem Informasi Paroki Santo Paulus Wonosobo

Proses normalisasi dilakukan secara terstruktur untuk menjamin keutuhan data (*data integrity*), menghilangkan redundansi yang tidak perlu, mencegah anomali penyisipan (*insertion anomaly*), anomali pembaruan (*update anomaly*), dan anomali penghapusan (*deletion anomaly*).

---

### 1. Bentuk Normal Pertama (First Normal Form - 1NF)

#### Persyaratan 1NF:
1. Setiap tabel harus memiliki Primary Key yang unik.
2. Setiap atribut/kolom hanya boleh berisi nilai skalar atomik (tidak boleh ada multivalue attributes atau koma bersambung dalam satu sel).
3. Tidak boleh ada kelompok data berulang (*repeating groups*).

#### Hasil Evaluasi & Penerapan pada Sistem:
- **Pemisahan Simbol Arsitektur**: Pada konsep awal yang sering dijumpai, 20 simbol gereja sering kali digabungkan dalam kolom teks panjang berulang atau field JSON di tabel arsitektur. Hal ini melanggar 1NF. Pada rancangan final, dibuat tabel terpisah `arsitektur_simbols` di mana setiap baris mewakili **satu simbol spesifik** dengan `nomor_simbol` (1 s/d 20).
- **Pemisahan Foto Galeri**: Foto tidak disimpan sebagai array teks di tabel album, melainkan dipecah ke tabel atomik `galeri_fotos` yang memiliki kunci `id` dan mereferensikan `galeri_album_id`.
- **Pemisahan Petugas Liturgi**: Tidak ada kolom gabungan seperti `petugas_misa: "Lektor: Anton, Pemazmur: Budi"`. Seluruh penugasan dipecah menjadi baris atomik pada tabel `jadwal_petugas_liturgis`.
- **Hasil 1NF**: Seluruh 23 tabel telah memenuhi kriteria 1NF dengan Primary Key bertipe `BIGINT UNSIGNED AUTO_INCREMENT` dan atribut atomik.

---

### 2. Bentuk Normal Kedua (Second Normal Form - 2NF)

#### Persyaratan 2NF:
1. Memenuhi seluruh syarat 1NF.
2. Tidak boleh ada ketergantungan fungsional sebagian (*partial dependency*), di mana atribut non-kunci hanya bergantung pada sebagian dari *composite primary key*.

#### Hasil Evaluasi & Penerapan pada Sistem:
- Seluruh tabel menggunakan **Surrogate Primary Key** tunggal (`id`). Karena tidak ada tabel yang menggunakan Composite Primary Key murni sebagai penentu atribut lainnya, maka ketergantungan sebagian secara otomatis **tidak terjadi**.
- **Kasus Pastor dan Riwayat Penugasan**: Jika masa jabatan digabung dalam tabel `pastors` dengan composite key `(pastor_id, tahun_mulai)`, atribut seperti nama pastor, tanggal tahbisan, dan foto hanya bergantung pada `pastor_id` (partial dependency). Oleh karena itu, dipisahkan menjadi `pastors` (master profil pastor) dan `pastor_pelayanans` (entitas riwayat penugasan), di mana atribut `jabatan`, `tahun_mulai`, dan `tahun_selesai` bergantung penuh pada `pastor_pelayanans.id`.
- **Hasil 2NF**: Seluruh entitas memenuhi 2NF secara penuh.

---

### 3. Bentuk Normal Ketiga (Third Normal Form - 3NF)

#### Persyaratan 3NF:
1. Memenuhi seluruh syarat 2NF.
2. Tidak boleh ada ketergantungan transitif (*transitive dependency*), di mana atribut non-kunci bergantung pada atribut non-kunci lainnya ($X \rightarrow Y$ dan $Y \rightarrow Z$).

#### Hasil Evaluasi & Penerapan pada Sistem:
- **Kasus Kategori Berita**: Jika nama kategori dan deskripsi kategori disimpan di dalam tabel `beritas`, maka `beritas.id -> kategori_id -> nama_kategori`. Perubahan nama kategori akan memicu anomali pembaruan di ribuan baris berita. Dengan memisahkan `kategori_beritas` ke tabel tersendiri, dependensi transitif dihilangkan.
- **Kasus Peran Liturgi**: Jika nama peran tugas (Lektor, Misdinar, Organis) disimpan langsung di tabel penugasan, maka dependensi transitif terjadi. Dengan adanya master `liturgi_perans`, penugasan hanya menyimpan `liturgi_peran_id`.
- **Kasus Stasi dan Jadwal Misa**: Jadwal misa tidak menyimpan data lokasi desa/kecamatan atau kapasitas stasi. Jadwal hanya menyimpan `stasi_id` (nullable). Data detail stasi tetap berada di tabel `stasis`.
- **Kasus Role dan Pengguna**: Data peran (`name`, `display_name`, `deskripsi`) diisolasi di tabel `roles`, bukan diulang pada tabel `users`.

---

### 4. Justifikasi Kasus Khusus / Denormalisasi Terkendali

Pada tabel tertentu, dilakukan pertimbangan teknis khusus:
1. **Atribut `role_name` pada `audit_logs`**:
   - Secara teoritis, nama role dapat diambil via `audit_logs.user_id -> users.role_id -> roles.name`.
   - Namun, jika user di kemudian hari dihapus (`user_id` menjadi `NULL`), atau jika role user berubah di masa depan, catatan historis audit akan kehilangan konteks aslinya. Oleh karena itu, penyimpanan snapshot `role_name` pada `audit_logs` sengaja dipertahankan demi validitas bukti audit hukum (*forensic audit log trail*).
2. **Atribut `view_count` dan `download_count`**:
   - Penghitungan pembaca berita/renungan dan unduhan warta paroki disimpan sebagai kolom counter integer langsung pada tabel terkait, guna menghindari overhead komputasi agregasi kueri log pada traffic tinggi.

