# Dokumentasi Asumsi Teknis dan Butir Konfirmasi Informasi
## Website Profil dan Sistem Informasi Paroki Santo Paulus Wonosobo

Sesuai pedoman perancangan: *"Jika terdapat informasi yang belum tersedia, gunakan asumsi teknis yang paling aman dan masuk akal, dokumentasikan asumsi tersebut, dan tandai bagian yang perlu dikonfirmasi. Jangan mengarang data historis atau informasi faktual paroki."*

Berikut adalah catatan terperinci mengenai asumsi teknis yang digunakan serta informasi faktual yang perlu dikonfirmasi oleh pengurus paroki:

---

### 1. Asumsi Teknis yang Digunakan

1. **Format Identifikasi Stasi pada Jadwal Ekaristi**:
   - *Asumsi*: Atribut `stasi_id` pada tabel `jadwal_ekaristis` bernilai `NULL` untuk perayaan yang bertempat di **Gereja Paroki Santo Paulus Wonosobo (Gereja Utama)**, sedangkan perayaan di stasi luar paroki akan terisi dengan ID stasi terkait.
   - *Status*: Sangat aman dan konsisten dengan praktik terbaik basis data relasional.

2. **Dukungan Jadwal Misa Rutin vs Misa Insidental**:
   - *Asumsi*: Tabel `jadwal_ekaristis` memiliki kolom `hari` (untuk misa mingguan berulang) dan kolom `tanggal` (untuk misa hari raya khusus seperti Natal, Trihari Suci, dll.). Keduanya bersifat nullable bergantian tergantung tipe perayaan.
   - *Status*: Akomodatif terhadap kebutuhan jadwal liturgi nyata.

3. **Struktur Master Petugas Liturgi**:
   - *Asumsi*: Petugas liturgi dapat diisi nama kelompok lingkungan (misal: "Lingkungan Santo Ignatius") atau perorangan ("Bapak A & Ibu B"). Kolom `lingkungan_id` dibuat nullable agar tidak membatasi penugasan yang berasal dari organisasi kategorial atau relawan mandiri.
   - *Status*: Fleksibel untuk dinamika pastoral.

4. **Karakteristik Berkas Warta Paroki**:
   - *Asumsi*: Berkas warta paroki diunggah dalam format dokumen **PDF**, disimpan di direktori `storage/app/public/warta-paroki/` dan dicatat ukuran berkas serta jumlah unduhan untuk analitik pembaca.
   - *Status*: Standar industri web gereja modern.

5. **Sistem Autentikasi Pengguna**:
   - *Asumsi*: Setiap akun pengguna hanya memiliki satu role utama (`role_id` di tabel `users`). Tidak diperlukan tabel pivot multi-role yang rumit karena peran Admin, Romo, dan Komsos memiliki garis wewenang yang tegas dan terpisah.
   - *Status*: Sederhana, aman, dan mudah dimaintenance.

---

### 2. Informasi Faktual Paroki yang Perlu Dikonfirmasi Umat / Pengurus

Untuk pengisian data faktual saat produksi (*production seeding/entry*), beberapa data berikut perlu divalidasi langsung oleh Sekretariat Paroki:

1. **Daftar Nama Resmi 14 Lingkungan**:
   - Nama pelindung masing-masing dari 14 lingkungan (misal: Lingkungan St. Petrus, Lingkungan St. Maria, dll.) serta pembagian wilayah pastoralnya di Wonosobo.
2. **Daftar Nama Resmi 7 Stasi**:
   - Nama gereja/kapel dan lokasi desa/kecamatan ke-7 stasi (misal: Stasi Garung, Stasi Kejajar, Stasi Selomerto, dll.).
3. **Daftar Lengkap 20 Simbol Arsitektur**:
   - Dokumen katekese arsitektural resmi paroki yang merinci nama dan makna dari masing-masing 20 ornamen/simbol Joglo Pangrawit Ceblokan dan Goa Garba.
4. **Data Pastor Kepala dan Pastor Rekan**:
   - Nama imam yang saat ini bertugas aktif dan daftar pastor terdahulu yang pernah melayani di Paroki Santo Paulus Wonosobo beserta rentang tahun penugasannya.
5. **Jadwal Ekaristi Resmi**:
   - Jam pasti misa mingguan Sabtu sore dan Minggu pagi di Gereja Utama serta rotasi jadwal misa di stasi-stasi.
6. **Alamat Kontak Resmi**:
   - Nomor telepon kantor sekretariat, nomor WhatsApp pastoral, dan alamat email resmi paroki.

> **Catatan Integritas Data**: Pada data seeder awal, sistem **tidak mengarang** riwayat historis atau data fiktif umat, melainkan menyiapkan struktur wadah yang siap diisi melalui form master data di Admin/Romo Dashboard.

