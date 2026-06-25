# 🎵 StagePass  ( Sistem Pemesanan Tiket Konser )

Website pemesanan tiket konser yang digunakan untuk pembelian tiket konser secara online serta pengelolaan data konser dan pesanan oleh admin melalui dashboard.

## Deskripsi Proyek

StagePass merupakan aplikasi web yang dikembangkan menggunakan framework Laravel dengan arsitektur MVC (Model-View-Controller).

Sistem menyediakan fitur pencarian konser, pemesanan tiket online, pengelolaan pesanan, serta dashboard admin untuk mengelola data konser, pengguna, dan transaksi.

Proyek ini dibuat sebagai tugas Ujian Akhir Semester Pemrograman Berbasis Web (PBW).


## Fitur Utama

### Customer

* Melihat daftar konser
* Mencari konser berdasarkan nama artis atau konser
* Filter konser berdasarkan genre
* Melihat detail konser
* Membeli tiket konser
* Mengisi data diri pemesan
* Memilih metode pembayaran
* Melihat tiket yang telah dibeli
* Mengunduh tiket dalam format PDF

### Admin

* Dashboard statistik
* Melihat total konser, pesanan, pendapatan, dan pengguna
* Manajemen konser (Create, Read, Update, Delete)
* Manajemen pesanan
* Manajemen pengguna

## Database

### Entitas Utama

* Users
* Concerts
* Orders

### Relasi

* User dapat memiliki banyak Order
* Concert dapat memiliki banyak Order
* Setiap Order terhubung dengan satu User dan satu Concert


## Akun Demo

### Admin

- Email: admin@stagepass.com
- Password: admin123

### Customer

- Registrasi akun melalui halaman Register
- Login menggunakan akun yang telah dibuat

## Teknologi yang Digunakan

* Laravel
* PHP
* MySQL
* Bootstrap
* Blade Template Engine


## Cara Menjalankan Project

1. Clone repository

```bash
git clone https://github.com/cutwynona/UASPBW_CutWynonaAndromeda_2497.git
```

2. Buka project menggunakan Visual Studio Code

3. Buka Terminal pada folder project

4. Jalankan server Laravel

```bash
php artisan serve
```

5. Buka browser dan akses

```bash
http://127.0.0.1:8000
```


## Screenshot Aplikasi

* Dashboard Admin
 <img width="952" height="438" alt="Screenshot 2026-06-24 184700" src="https://github.com/user-attachments/assets/4f347747-1d86-4c86-ba26-9e4a7e0c4cee" />
 
* Halaman Daftar Konser
  <img width="935" height="434" alt="image" src="https://github.com/user-attachments/assets/80d7c39c-1bd6-498d-bd9b-5552fe954668" />

* Detail Konser
  <img width="947" height="440" alt="image" src="https://github.com/user-attachments/assets/468a612b-99cb-46f3-b5d0-ffb2257f31b7" />

* Form Pemesanan Tiket
  <img width="932" height="442" alt="image" src="https://github.com/user-attachments/assets/ef8a4c78-1e07-462b-b3ae-fc34180320f0" />
  
* Tiket
  
  <img width="929" height="440" alt="image" src="https://github.com/user-attachments/assets/c5b6ae90-805c-4e47-8153-abb3a10af925" />



## Author

Cut Wynona Andromeda

UAS Pemrograman Berbasis Web (PBW)
