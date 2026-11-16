# Sistem Komponen Desain (Design System Components)
## Website Profil dan Sistem Informasi Paroki Santo Paulus Wonosobo

Berikut adalah spesifikasi komponen antarmuka terstandardisasi untuk menjamin konsistensi visual di seluruh Public Website dan Admin Dashboard:

---

### 1. Spacing, Radius, dan Bayangan (Elevation)
- **Base Grid**: 4px / 8px incremental scale (`8px`, `12px`, `16px`, `24px`, `32px`, `48px`, `64px`).
- **Border Radius**:
  - `rounded-sm`: `4px` (Badge, tag kecil).
  - `rounded-md`: `8px` (Form input, tombol, badge status).
  - `rounded-lg`: `12px` (Kartu jadwal, artikel berita, tabel kontainer).
  - `rounded-xl`: `16px` (Modal dialog, banner hero kontainer).
  - `rounded-full`: Pill badge dan avatar foto pastor.
- **Box Shadow (Elevation)**:
  - `shadow-sm`: `0 1px 2px rgba(53, 40, 32, 0.05)` (Form input, kartu standar).
  - `shadow-md`: `0 4px 12px rgba(53, 40, 32, 0.08)` (Kartu interaktif saat hover).
  - `shadow-lg`: `0 12px 24px rgba(53, 40, 32, 0.12)` (Modal dialog, dropdown menu).

---

### 2. Komponen Interaktif

#### A. Tombol (Buttons)
1. **Primary Button**:
   - Latar: `#5B4032` (Dark Brown), Teks: `#FFFEFC` (Soft White).
   - Hover: `#80634E` (Warm Brown).
   - Padding: `10px 20px` (Desktop), `12px 24px` (Touch target nyaman di ponsel).
2. **Secondary Button**:
   - Latar: `#EAE1D4` (Soft Beige), Border: `#DDD1C2` (Light Sand), Teks: `#352820`.
   - Hover: Latar `#DDD1C2`.
3. **Accent Gold Button**:
   - Latar: `#B69A68` (Muted Gold), Teks: `#FFFEFC`.
   - Hover: `#9E8354`.
4. **Danger Button**:
   - Latar: `#A8382B`, Teks: `#FFFEFC`.
   - Digunakan khusus pada aksi hapus data dengan dialog konfirmasi.

#### B. Formulir Masukan (Form Inputs)
- Latar Belakang: `#FFFEFC` (Soft White).
- Garis Tepi: `1px solid #DDD1C2` (Light Sand).
- State Focus: Border `#80634E` dengan outline ring halus `rgba(128, 99, 78, 0.2)`.
- Label: Teks tebal `#352820`, ukuran `14px`, disertai tanda asteris merah jika wajib diisi.
- Pesan Galat: Teks merah bata `#A8382B` di bawah input field.

#### C. Kartu (Cards)
- Latar Belakang: `#FFFEFC` berbingkai halus `#DDD1C2` atau `#EAE1D4`.
- Efek Hover: Transisi halus (*ease-in-out 200ms*) dengan sedikit elevasi (`translateY(-2px)`).
- Struktur: Header kartu dengan badge kategori, area konten isi, dan footer kartu dengan tanggal/penulis.

#### D. Lencana Status (Badges)
- **Published**: Latar `#E8F3E9`, Teks `#2E5E35` (Hijau Zaitun Lembut).
- **Draft**: Latar `#FEF5E7`, Teks `#9A6014` (Oranye Ochre Lembut).
- **Gereja Utama**: Latar `#EAE1D4`, Teks `#5B4032` (Cokelat Tua).
- **Stasi**: Latar `#E8EFF5`, Teks `#2B4A6F` (Biru Lembut).

#### E. Tabel Data (Data Tables)
- Header tabel berlatar `#EAE1D4` dengan teks tebal `#5B4032`.
- Baris tabel berselang-seling (*zebra-striping*) halus `#FFFEFC` dan `#FAF7F2`.
- Kolom aksi rapi di sisi kanan dengan tombol ikon (Lihat, Ubah, Hapus).
- Dilengkapi pembungkus *overflow-x-auto* untuk tampilan ponsel yang bebas rusak (*no layout break*).

