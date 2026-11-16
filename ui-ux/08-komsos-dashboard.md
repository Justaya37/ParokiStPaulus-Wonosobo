# Perancangan UI/UX: Komsos Dashboard (Media & Publikasi)
## Website Profil dan Sistem Informasi Paroki Santo Paulus Wonosobo

Dashboard Tim Komsos / OMK difokuskan pada pengelolaan warta berita paroki dan album dokumentasi foto kegiatan pastoral.

---

### 1. Karakteristik Desain Dashboard Komsos
- Desain visual berorientasi media (*media-centric*).
- Menampilkan pratinjau thumbnail gambar secara jelas pada tabel berita dan galeri foto.
- **Isolasi Wewenang Ketat**: Menu akun pengguna, administrasi jadwal/liturgi, dan Data Master paroki sama sekali tidak ditampilkan dan diblokir secara backend.

---

### 2. Menu Navigasi Tim Komsos / OMK

1. **Dashboard Utama**:
   - Statistik media: Total Berita Terbit, Draft Berita, Total Album Galeri, Total Foto Tersimpan.
   - Akses cepat: *"Tulis Berita Baru"* dan *"Buat Album Foto Baru"*.
2. **Berita Paroki**:
   - Tabel katalog berita: Judul, Kategori, Penulis, Tanggal Terbit, Status (`Draft` / `Published`), dan Jumlah Pembaca (*View Count*).
   - **Form Editor Berita**:
     - Judul Berita.
     - Kategori Berita (dropdown memilih kategori).
     - Gambar Sampul Utama & Keterangan Foto (*caption*).
     - Cuplikan Ringkasan Berita (*lead paragraph*).
     - Isi Berita Lengkap.
     - Pilihan Status: Simpan Draft atau Terbitkan Langsung.
3. **Kategori Berita**:
   - Manajemen taksonomi kategori: penambahan kategori baru (misal: "Liputan OMK", "Warta Lingkungan", dll.), pengurutan, dan deskripsi kategori.
4. **Galeri Foto & Album**:
   - Manajemen album kegiatan pastoral paroki (nama album, tanggal kegiatan, deskripsi, foto sampul).
   - Pengelolaan foto di dalam album: pengunggahan banyak foto (*multiple photo upload*), pengisian caption foto, dan penataan urutan foto.

