# 🎵 StagePass — Sistem Pemesanan Tiket Konser

## Akun Demo
| Role     | Email                    | Password  |
|----------|--------------------------|-----------|
| Admin    | admin@stagepass.com      | admin123  |
| Customer | user@stagepass.com       | user123   |

## Setup (sama seperti BrewHouse)

```bash
# 1. Buat project Laravel baru
composer create-project laravel/laravel StagePass
cd StagePass

# 2. Copy semua file dari ZIP ini ke project

# 3. Edit bootstrap/app.php — tambahkan middleware alias:
# $middleware->alias(['is_admin' => \App\Http\Middleware\IsAdmin::class]);

# 4. Edit .env
# DB_CONNECTION=mysql
# DB_DATABASE=stagepass
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Buat database 'stagepass' di phpMyAdmin

# 6. Jalankan
php artisan migrate:fresh --seed
php artisan serve
```

## Fitur
- ✅ Login & Register (customer/admin)
- ✅ Lihat daftar konser dengan filter & search
- ✅ Detail konser + beli tiket
- ✅ E-Ticket dengan kode unik
- ✅ Riwayat tiket & batalkan tiket
- ✅ Admin: CRUD konser, kelola pesanan & user
- ✅ Validasi input di semua form
- ✅ Relasi tabel: users → orders → concerts

## Relasi Database
```
users ──< orders >── concerts
```
