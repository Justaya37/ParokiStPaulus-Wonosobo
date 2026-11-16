# Pedoman Desain Responsif (Responsive Guidelines)
## Website Profil dan Sistem Informasi Paroki Santo Paulus Wonosobo

Sistem dibangun menggunakan pendekatan **Mobile-First Responsive Web Design** untuk menjamin pengalaman pengguna yang sempurna di berbagai perangkat:

---

### 1. Titik Henti Layar (Breakpoints)

| Breakpoint | Rentang Resolusi | Perangkat Sasaran | Karakteristik Tata Letak |
|---|---|---|---|
| **Mobile (xs/sm)** | `< 640px` | Smartphone (iPhone, Android) | 1 kolom vertikal penuh, hamburger menu, floating action |
| **Tablet (md)** | `641px - 1024px`| iPad, Tablet Android | 2 kolom dinamis, drawer sidebar, kartu berdampingan |
| **Desktop (lg)** | `1025px - 1280px`| Laptop, Monitor Kerja | Navbar horizontal lengkap, sidebar dashboard fixed |
| **Wide Desktop (xl)**| `> 1280px` | Monitor Resolusi Tinggi | Kontainer terpusat `max-w-7xl`, margin lega, grid 3-4 kolom |

---

### 2. Penanganan Khusus Elemen Antarmuka pada Ponsel (Mobile)

1. **Jadwal Ekaristi**:
   - Pada desktop, disajikan dalam kartu komparasi atau tabel bersisian.
   - Pada ponsel, tabel diubah menjadi kartu vertikal terpisah (*card stack*) dengan penanda waktu besar dan jelas sehingga umat yang sedang di perjalanan dapat memeriksa jam misa dalam sekali lirik.
2. **Navigasi Hamburger & Drawer**:
   - Menu navigasi mobile terbuka halus dari sisi samping dengan latar belakang redup (*backdrop blur*), memudahkan penutupan dengan sentuhan luar.
3. **Ukuran Area Sentuh (Touch Target Size)**:
   - Seluruh tombol interaktif, tautan menu, dan ikon aksi memiliki ukuran minimal `44px x 44px` sesuai pedoman Apple HIG dan Android Material Design, mencegah salah sentuh (*accidental clicks*).
4. **Pencegahan Geser Horizontal Rusak (No Horizontal Overflow)**:
   - Seluruh kontainer menggunakan `box-sizing: border-box`, `max-w-full`, dan gambar menggunakan `height: auto; max-width: 100%`.
   - Tabel dashboard dibungkus dalam kontainer ber-scrolling terkontrol (`overflow-x: auto`) dengan indikator bayangan tepi.

