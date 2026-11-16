# Rekomendasi Urutan Eksekusi Migration Laravel
## Website Profil dan Sistem Informasi Paroki Santo Paulus Wonosobo

Untuk menghindari kesalahan *foreign key constraint violation* atau dependensi sirkular saat menjalankan `php artisan migrate`, urutan berkas migration diatur secara terstruktur mengikuti hierarki keterikatan tabel:

---

### 1. Daftar dan Urutan Eksekusi Berkas Migration

| No | Berkas Migration | Tabel yang Dibuat | Dependensi Tabel Induk |
|---|---|---|---|
| 01 | `0001_01_01_000000_create_roles_and_users_table.php` | `roles`, `users`, `password_reset_tokens`, `sessions` | - |
| 02 | `0001_01_01_000001_create_cache_table.php` | `cache`, `cache_locks` | - |
| 03 | `0001_01_01_000002_create_jobs_table.php` | `jobs`, `job_batches`, `failed_jobs` | - |
| 04 | `2026_01_01_000010_create_profil_and_sejarah_paroki_tables.php` | `profil_paroki`, `sejarah_parokis` | - |
| 05 | `2026_01_01_000020_create_arsitektur_filosofi_and_simbol_tables.php` | `arsitektur_filosofis`, `arsitektur_simbols` | - |
| 06 | `2026_01_01_000030_create_pastors_and_pelayanans_tables.php` | `pastors`, `pastor_pelayanans` | `pastors` |
| 07 | `2026_01_01_000040_create_lingkungans_and_stasis_tables.php` | `lingkungans`, `stasis` | - |
| 08 | `2026_01_01_000050_create_organisasi_kategorials_table.php` | `organisasi_kategorials` | - |
| 09 | `2026_01_01_000060_create_jadwal_ekaristis_table.php` | `jadwal_ekaristis` | `stasis`, `users` |
| 10 | `2026_01_01_000070_create_petugas_liturgi_tables.php` | `liturgi_perans`, `jadwal_petugas_liturgis` | `jadwal_ekaristis`, `liturgi_perans`, `lingkungans` |
| 11 | `2026_01_01_000080_create_agenda_kegiatans_table.php` | `agenda_kegiatans` | `users` |
| 12 | `2026_01_01_000090_create_beritas_and_kategoris_tables.php` | `kategori_beritas`, `beritas` | `kategori_beritas`, `users` |
| 13 | `2026_01_01_000100_create_renungans_table.php` | `renungans` | `users` |
| 14 | `2026_01_01_000110_create_warta_parokis_table.php` | `warta_parokis` | `users` |
| 15 | `2026_01_01_000120_create_galeris_and_fotos_tables.php` | `galeri_albums`, `galeri_fotos` | `users`, `galeri_albums` |
| 16 | `2026_01_01_000130_create_sakramen_informasis_table.php` | `sakramen_informasis` | - |
| 17 | `2026_01_01_000140_create_audit_logs_table.php` | `audit_logs` | `users` |

---

### 2. Kaidah Kunci dalam Implementasi Migration
1. **Penyatuan `roles` sebelum `users`**: Tabel `roles` dibuat dalam berkas migration pertama tepat sebelum tabel `users` dibuat, sehingga klausa `$table->foreignId('role_id')->constrained('roles')` dapat dieksekusi dengan aman tanpa kegagalan.
2. **Karakter Kolom InnoDB MySQL**: Seluruh tabel menggunakan *Engine* InnoDB dan character set `utf8mb4` dengan collation `utf8mb4_unicode_ci` untuk mendukung karakter aksara Jawa maupun simbol khusus secara sempurna.
3. **Pemberian Indeks Spesifik**: Kolom-kolom kunci pencarian seperti `slug`, `status`, `published_at`, `nomor_simbol`, dan foreign keys selalu dilengkapi indeks eksplisit.

