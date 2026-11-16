# Aksesibilitas Web & Pengalaman Pengguna (Web Accessibility & UX)
## Website Profil dan Sistem Informasi Paroki Santo Paulus Wonosobo

Sistem mematuhi standar **WCAG 2.1 Level AA (Web Content Accessibility Guidelines)** untuk menjamin aksesibilitas bagi seluruh umat, termasuk lansia dan penyandang disabilitas:

---

### 1. Rasio Kontras Warna (Color Contrast Ratio)
- Teks utama `Deep Brown (#352820)` di atas latar belakang `Warm Cream (#F7F3EC)` menghasilkan rasio kontras **10.8 : 1** (jauh melampaui standar minimal WCAG AA yaitu 4.5:1).
- Teks tombol putih `Soft White (#FFFEFC)` di atas `Dark Brown (#5B4032)` menghasilkan rasio kontras **8.9 : 1**.
- Warna tidak pernah dijadikan sebagai satu-satunya penanda status. Indikator status (seperti Draft atau Published) selalu menyertakan teks tertulis dan ikon penjelas.

---

### 2. Keterbacaan dan Aksesibilitas Font
- Ukuran font tubuh terkecil pada ponsel adalah `15px - 16px`, memastikan umat lansia dapat membaca warta tanpa harus memperbesar layar manual.
- Menggunakan tipografi yang mendukung karakter aksara Latin dan diakritik Indonesia secara sempurna.

---

### 3. Aksesibilitas Keyboard & Pembaca Layar (Screen Readers)
- Elemen interaktif memiliki *focus indicator* yang terlihat jelas (cincin fokus berwarna cokelat hangat).
- Seluruh gambar konten (foto pastor, foto 20 simbol gereja, poster agenda) dilengkapi atribut `alt` yang deskriptif dan bermakna.
- Formulir menggunakan tag `<label for="...">` eksplisit yang terhubung secara semantik dengan elemen `<input>` atau `<select>`.
- Tombol aksi yang hanya menggunakan ikon selalu dilengkapi atribut `aria-label` atau `title`.

---

### 4. Umpan Balik Pengguna & Konfirmasi Aksi (User Feedback)
- **Konfirmasi Penghapusan Data**: Setiap aksi penghapusan di dashboard wajib memunculkan dialog konfirmasi untuk mencegah hilangnya data secara tidak sengaja.
- **Notifikasi Operasi**: Menampilkan pesan sukses berwarna hijau zaitun setelah operasi tambah/ubah data berhasil dilakukan.
- **Empty State**: Ketika tabel atau daftar belum memiliki data, sistem menampilkan ilustrasi dan pesan panduan ramah (*helpful empty state*) alih-alih layar kosong yang membingungkan.
- **Loading State**: Tombol formulir secara visual menonaktifkan diri saat proses pengiriman data sedang berlangsung guna mencegah *double-submitting*.

