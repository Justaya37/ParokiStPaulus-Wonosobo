# Ringkasan Evaluasi Kebutuhan & Arsitektur Database
## Website Profil dan Sistem Informasi Paroki Santo Paulus Wonosobo

### 1. Konteks dan Tujuan Sistem
Sistem ini dibangun untuk memenuhi dua kebutuhan utama Paroki Santo Paulus Wonosobo:
1. **Public Website Profil Paroki**: Portal informasi publik yang dapat diakses oleh umat dan masyarakat umum tanpa memerlukan autentikasi (Guest Read-Only), menyajikan profil, sejarah, inkulturasi arsitektur Joglo Pangrawit Ceblokan, 20 simbol arsitektur, data pastor, lingkungan (14 lingkungan), stasi (7 stasi), organisasi kategorial, jadwal Ekaristi, agenda kegiatan, warta paroki (PDF), berita paroki, renungan gembala, galeri foto, dan panduan persyaratan sakramen (tanpa registrasi daring).
2. **Admin Dashboard Berbasis Role (RBAC)**: Ruang kerja terotorisasi untuk 3 aktor internal:
   - **Admin Sekretariat**: Mengelola administrasi peribadatan (Jadwal Ekaristi, Petugas Liturgi, Agenda), pengelolaan pengguna, publikasi Warta Paroki, serta Data Master Paroki.
   - **Romo Paroki**: Menulis dan menerbitkan Renungan/Sapaan Gembala (draft & published), serta memiliki akses CRUD penuh ke Data Master Paroki yang **sama persis** dengan Admin Sekretariat (Single Source of Truth).
   - **Tim Komsos / OMK**: Mengelola publikasi Berita & Kategorinya serta Album & Foto Galeri. Dibatasi secara ketat dari manajemen pengguna, administrasi sekretariat, dan Data Master.

Arsitektur yang digunakan adalah **Monolith** berbasis **Laravel 12 / PHP 8.4** dengan basis data relasional **MySQL**.

---

### 2. Evaluasi Kebutuhan dan Identifikasi Masalah Desain Awal
Berdasarkan analisis kebutuhan sistem paroki, ditemukan beberapa poin kritis yang harus diselesaikan pada desain basis data:

1. **Pemisahan Filosofi dan Simbol Arsitektur**:
   - *Masalah*: Gereja Paroki Santo Paulus Wonosobo memiliki keunikan arsitektur *Joglo Pangrawit Ceblokan* dengan konsep filosofis *Garbha Griha / Goa Garba* (inkulturasi Jawa-Katolik), serta memiliki **20 simbol arsitektur spesifik**.
   - *Solusi*: Memisahkan narasi filosofi arsitektur ke tabel `arsitektur_filosofis` dan 20 simbol ke tabel terpisah `arsitektur_simbols` dengan relasi One-to-Many atau tabel katalog simbol berurutan (`nomor_simbol` 1 s/d 20).

2. **Diferensiasi Jadwal Ekaristi (Gereja Utama vs. 7 Stasi)**:
   - *Masalah*: Paroki mengelola perayaan Ekaristi di Gereja Utama dan di 7 stasi wilayah luar. Jika dibuat tabel terpisah, terjadi redundansi struktur; jika disatukan tanpa penanganan FK yang tepat, dapat menimbulkan anomali.
   - *Solusi*: Menggunakan satu tabel `jadwal_ekaristis` dengan atribut `stasi_id` bertipe `UNSIGNED BIGINT NULL`. Jika `stasi_id IS NULL`, jadwal tersebut secara semantik merujuk pada **Gereja Utama Paroki Santo Paulus Wonosobo**. Jika terisi, merujuk pada ID stasi terkait. Dilengkapi indeks komposit untuk optimasi kueri jadwal berdasarkan waktu dan stasi.

3. **Multi-Periode Pelayanan Pastor**:
   - *Masalah*: Seorang imam/pastor dapat bertugas di paroki lebih dari satu kali periode dalam rentang tahun berbeda (misalnya sebagai Pastor Rekan pada tahun 2010–2013, kemudian kembali bertugas sebagai Pastor Kepala pada tahun 2022–sekarang).
   - *Solusi*: Normalisasi 3NF dengan memisahkan profil pastor (`pastors`) dari riwayat masa penugasannya (`pastor_pelayanans`).

4. **Petugas Liturgi dan Jadwal Misa**:
   - *Masalah*: Setiap perayaan Ekaristi memerlukan petugas liturgi yang berbeda-beda (Lektor, Pemazmur, Misdinar, Organis, Kolektan, dll.) dan sering kali ditugaskan per kelompok lingkungan atau nama perorangan.
   - *Solusi*: Entitas `liturgi_perans` sebagai master peran, dan `jadwal_petugas_liturgis` sebagai tabel penugasan yang merelasikan `jadwal_ekaristi_id`, `liturgi_peran_id`, dan opsional `lingkungan_id`.

5. **Akses Data Master Tunggal (Shared Master Data)**:
   - *Prinsip Ketat*: Admin Sekretariat dan Romo Paroki mengelola sumber Data Master yang sama persis (Profil, Sejarah, Arsitektur, Pastor, Lingkungan, Stasi, Kategorial, Informasi Sakramen). Tidak boleh ada duplikasi tabel data master per role.

6. **Peniadaan Pendaftaran Sakramen Online**:
   - *Ketentuan*: Website hanya menyediakan informasi jenis sakramen, persyaratan administratif, katekese singkat, dan prosedur pelayanan tatap muka di sekretariat. Tidak ada tabel pendaftaran, registrasi, formulir unggah dokumen pribadi, ataupun mutasi data sakramen umat.

7. **Audit Log Perubahan Data Master**:
   - *Solusi*: Menyediakan tabel `audit_logs` untuk merekam jejak audit (siapa, kapan, modul apa, aksi apa, data sebelum dan sesudah perubahan) guna menjaga akuntabilitas perubahan data master dan konten penting oleh Admin dan Romo.

---

### 3. Matriks Entitas Terpilih
Sistem diuraikan menjadi **16 entitas relasional** terpadu:
1. `roles`: Master peran pengguna (Admin Sekretariat, Romo Paroki, Tim Komsos/OMK, Guest).
2. `users`: Akun pengguna dashboard dengan Foreign Key tunggal ke `roles`.
3. `profil_paroki`: Informasi identitas, alamat, kontak, koordinat geografis, visi-misi paroki.
4. `sejarah_parokis`: Linimasa tonggak sejarah dan perkembangan Paroki Santo Paulus Wonosobo.
5. `arsitektur_filosofis`: Konsep arsitektur Joglo Pangrawit Ceblokan & inkulturasi Goa Garba.
6. `arsitektur_simbols`: 20 simbol arsitektur gereja beserta makna teologis dan filosofisnya.
7. `pastors`: Data induk imam/pastor yang pernah dan sedang melayani.
8. `pastor_pelayanans`: Riwayat periode penugasan imam di paroki.
9. `lingkungans`: Data 14 lingkungan paroki beserta nama pelindung dan kontak.
10. `stasis`: Data 7 stasi luar paroki beserta lokasi dan kapasitas.
11. `organisasi_kategorials`: 7 organisasi kategorial resmi (OMK, WKRI, Monika, Legio, PDPKK, CFM, ME).
12. `jadwal_ekaristis`: Jadwal misa harian, mingguan, hari raya (Gereja Utama & Stasi).
13. `liturgi_perans`: Master peran petugas liturgi (Lektor, Pemazmur, Misdinar, dll.).
14. `jadwal_petugas_liturgis`: Penugasan petugas liturgi pada jadwal misa terkait.
15. `agenda_kegiatans`: Kalender agenda kegiatan pastoral paroki.
16. `kategori_beritas`: Kategori artikel berita paroki.
17. `beritas`: Artikel berita dan warta kegiatan oleh Tim Komsos.
18. `renungans`: Sapaan gembala dan refleksi rohani oleh Romo Paroki.
19. `warta_parokis`: Publikasi lembar Warta Paroki mingguan/bulanan (berkas PDF).
20. `galeri_albums`: Album kegiatan paroki.
21. `galeri_fotos`: Foto-foto dokumentasi kegiatan dalam album.
22. `sakramen_informasis`: Panduan teologis, persyaratan, dan prosedur 7 sakramen gereja.
23. `audit_logs`: Pencatatan aktivitas CRUD dan perubahan data penting.

