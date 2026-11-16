# Temuan dan Rekomendasi Desain Basis Data
## Website Profil dan Sistem Informasi Paroki Santo Paulus Wonosobo

Berikut adalah rangkuman temuan teknis dari hasil analisis kebutuhan serta rekomendasi perbaikan desain yang diterapkan:

---

### 1. Temuan Masalah & Resiko Desain Awal

1. **Resiko Duplikasi Data Master**:
   - *Temuan*: Terdapat potensi kesalahan implementasi di mana Admin dan Romo masing-masing dibuatkan tabel terpisah karena keduanya memiliki menu Data Master di dashboard masing-masing.
   - *Rekomendasi*: Seluruh data master dipusatkan pada satu set tabel tunggal (*Single Source of Truth*). Otorisasi bersama diatur pada Application Layer (Gate/Policy).

2. **Kompleksitas Simbol Arsitektur**:
   - *Temuan*: Paroki Santo Paulus Wonosobo memiliki 20 simbol arsitektur spesifik bercorak Joglo Pangrawit Ceblokan dan Goa Garba yang sarat makna inkulturasi Jawa-Katolik. Jika hanya disimpan sebagai teks paragraf pada satu artikel profil, informasi ini tidak terstruktur dan sulit ditampilkan secara interaktif di website.
   - *Rekomendasi*: Dibuatkan tabel khusus `arsitektur_simbols` yang memiliki atribut terstruktur (`nomor_simbol` 1–20, `nama_simbol`, `arti_filosofis`, `makna_teologis`, `lokasi_pada_gereja`, `foto_simbol`, dan `urutan`).

3. **Integritas Penugasan Pastor Multi-Periode**:
   - *Temuan*: Periode masa bakti pastor tidak linier. Seorang pastor dapat bertugas sebagai Vikaris di paroki pada tahun tertentu, lalu berpindah tugas, dan beberapa tahun kemudian kembali sebagai Pastor Kepala.
   - *Rekomendasi*: Normalisasi relasi One-to-Many antara `pastors` dan `pastor_pelayanans`.

4. **Pembedaan Jadwal Misa Gereja Utama vs 7 Stasi**:
   - *Temuan*: Jika jadwal stasi dipisah tabelnya, kode aplikasi akan terduplikasi. Jika disatukan tanpa Foreign Key nullable, akan ada keterikatan semu.
   - *Rekomendasi*: Gunakan satu tabel `jadwal_ekaristis` dengan kolom `stasi_id` nullable. Nilai `NULL` secara konsisten merepresentasikan **Gereja Utama Paroki Santo Paulus Wonosobo**.

5. **Ketegasan Batasan Fitur Sakramen**:
   - *Temuan*: Sering terjadi *scope creep* di mana sistem paroki tergoda membuat modul pendaftaran sakramen online, formulir unggah berkas akta lahir/baptis, dan mutasi kependudukan umat online.
   - *Rekomendasi*: Menghilangkan seluruh tabel formulir atau pendaftaran daring. Tabel `sakramen_informasis` murni hanya memuat panduan informasi katekese, daftar berkas persyaratan fisik tatap muka, dan alur pelayanan di sekretariat.

6. **Integritas Penghapusan (Foreign Key Constraints)**:
   - *Temuan*: Penggunaan `ON DELETE CASCADE` secara serampangan berbahaya bagi data historis gereja.
   - *Rekomendasi*:
     - Gunakan `RESTRICT` pada relasi penting seperti `roles -> users`, `kategori_beritas -> beritas`, `stasis -> jadwal_ekaristis`.
     - Gunakan `CASCADE` hanya pada *child records* yang tidak bermakna tanpa induknya (misal: `galeri_fotos` terhadap `galeri_albums`, `pastor_pelayanans` terhadap `pastors`, `jadwal_petugas_liturgis` terhadap `jadwal_ekaristis`).
     - Gunakan `SET NULL` pada `audit_logs.user_id` agar riwayat perubahan data tetap abadi jika user dihapus.

---

### 2. Rekomendasi Teknis Indexing & Optimasi Kueri

1. **Indeks Slug**: Kolom `slug` pada tabel `beritas`, `renungans`, `agenda_kegiatans`, `kategori_beritas`, dan `galeri_albums` diberi indeks unik (`UNIQUE`) untuk memastikan URL ramah SEO dapat di-query dengan kecepatan $O(1)$.
2. **Indeks Komposit Status & Tanggal**: Kolom `status` dan `published_at` / `tanggal` diindeks guna mempercepat kueri halaman depan public website (menghindari *full table scan*).
3. **Soft Deletes**: Diterapkan pada `beritas` dan `renungans` agar artikel atau sapaan gembala yang tidak sengaja terhapus dapat dipulihkan dengan aman.

