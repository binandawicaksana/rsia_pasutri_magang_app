# Monitoring Magang RSIA Pasutri (Laravel 11)

Aktor: **Admin**, **Pembimbing Lapangan**, **Peserta Magang**.

## Cara pasang
1. Buat proyek baru dan pasang Breeze (untuk login/logout):
   ```bash
   composer create-project laravel/laravel monitoring-magang
   cd monitoring-magang
   composer require laravel/breeze --dev
   php artisan breeze:install blade
   ```
2. Salin isi folder ini ke proyek (timpa `routes/web.php`, `app/Models/User.php`, `database/seeders/DatabaseSeeder.php`).
3. Daftarkan alias middleware di `bootstrap/app.php`:
   ```php
   ->withMiddleware(function (Middleware $middleware) {
       $middleware->alias(['role' => \App\Http\Middleware\RoleMiddleware::class]);
   })
   ```
4. Di `app/Providers/RouteServiceProvider` / Breeze, pastikan redirect setelah login ke `/dashboard` (default Breeze sudah benar).
5. Atur `.env` (DB), lalu:
   ```bash
   php artisan migrate --seed
   php artisan storage:link   # agar foto kegiatan dan logo bisa ditampilkan
   php artisan serve
   ```

## Akun demo (kata sandi: `password`)
| Role | Email |
|---|---|
| Admin | admin@magang.test |
| Pembimbing | pembimbing@magang.test |
| Peserta | peserta@magang.test |

## Database siap pakai
Folder `database/` berisi dua pilihan database yang sudah terisi tabel dan akun demo:
- `database.sqlite`: letakkan di `database/database.sqlite`, set `DB_CONNECTION=sqlite` di `.env`. Tidak perlu `migrate`.
- `monitoring_magang.sql`: untuk MySQL/MariaDB. Impor lewat phpMyAdmin (atau `mysql -u root -p < database/monitoring_magang.sql`), lalu set `DB_CONNECTION=mysql` dan `DB_DATABASE=monitoring_magang` di `.env`.

Keduanya sudah mencatat daftar migration, sehingga `php artisan migrate` tidak membuat ulang tabel. Jalankan tetap `php artisan storage:link`. Ganti kata sandi akun demo sebelum dipakai sungguhan.

## Cetak logbook
Tombol **Cetak logbook** ada di dashboard peserta, halaman peserta milik pembimbing, dan daftar peserta admin (`/cetak/logbook/{peserta}`). Halaman cetak berukuran A4 dengan kop rumah sakit (nama dan logo dari Pengaturan), identitas peserta, tabel kegiatan lengkap dengan foto, dan kolom tanda tangan peserta dan pembimbing. Bisa difilter tanggal dan status (bawaan: hanya yang disetujui). Klik **Cetak / Simpan PDF**, lalu pilih printer atau "Simpan sebagai PDF". Akses dibatasi: admin semua peserta, pembimbing hanya bimbingannya, peserta hanya miliknya.

Agar nama bulan tampil dalam bahasa Indonesia, set `APP_LOCALE=id` di `.env`.

## Pengaturan (khusus admin)
Menu **Pengaturan** di navbar hanya tampil untuk admin, dan route `/admin/pengaturan` dilindungi middleware `role:admin` (pembimbing dan peserta mendapat 403). Isinya: nama rumah sakit, logo, buka/tutup pengiriman laporan, batas mundur tanggal laporan, dan ukuran maksimal foto. Nilai bawaan ada di `App\Models\Setting::DEFAULTS`.

## Alur peserta
Peserta hanya mengisi satu formulir: **tanggal, nama, kegiatan, keterangan, dan foto** (maks 2 MB). Pembimbing meninjau (setujui/tolak + catatan) lalu memberi nilai akhir. Admin mengelola akun dan penugasan pembimbing.

## Halaman login
`resources/views/auth/login.blade.php` menggantikan tampilan login bawaan Breeze (logika autentikasi tetap dari Breeze). Kotak akun demo hanya muncul saat `APP_ENV=local`. Setelah login, user diarahkan ke `/dashboard` lalu ke halaman sesuai role.

## Catatan
- Registrasi publik bawaan Breeze sebaiknya dinonaktifkan (hapus route register) karena akun dibuat oleh admin.
- Halaman Breeze `resources/views/dashboard.blade.php` tidak dipakai; `/dashboard` mengarahkan sesuai role.

## Project package
This archive includes the Laravel 11 application skeleton files needed to run the existing Monitoring Magang code. The existing Blade/CSS/JS/UI files are preserved.

After extracting:
```bash
composer install
php artisan storage:link
php artisan serve
```
The included `database/database.sqlite` already contains the demo data. If you prefer a clean database, use `php artisan migrate --seed` after removing the existing SQLite database.
