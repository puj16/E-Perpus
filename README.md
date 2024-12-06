<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Tentang E-Perpus PSDKU Polinema

E-perpus PSDKU Polinema merupakan website yang bertujuan untuk memudahkan akses perpustakaan untuk mahasiswa maupun dosen polinema psdku kediri.

## Fitur

- **Katalog**: Pengguna dapat mencari, menelusuri, dan melihat daftar e-book, jurnal, serta laporan yang tersedia.
- **Peminjaman**: Pengguna meminjam bahan dengan batas waktu 1 minggu dan dapat membaca melalui borrowed list. Stok terbatas.
- **Perpanjangan**: Masa peminjaman dapat diperpanjang sekali sesuai batas yang ditentukan.
- **Borrowed List**: Daftar bahan yang dipinjam dan hanya dapat dibaca oleh pengguna.
- **Pengembalian**: Bahan yang dikembalikan akan hilang dari borrowed list. Pengembalian otomatis dilakukan jika waktu peminjaman terlampaui.
- **Pelaporan**: menampilkan informasi peminjaman dan pengembalian dalam bentuk laporan dan grafik bagi pustakawan


## Akses Website

Website e-perpus psdku polinema dapat diakses melalui [E-Perpus PSDKU Polinema](https://e-perpuspsdkupolinema.my.id/ )

> aplikasi website e-perpus bisa juga diakses melalui server lokal.

## Instalasi dan Akses Lokal

Instalasi dan akses lokal

1.	Clone repositori dari github dengan menjalankan kode:
   ```bash
   git clone https://github.com/puj16/E-Perpus.git
   ```
2.	Masuk ke direktori proyek dengan menjalankan cd nama_proyek
3.	Instal semua dependency PHP yang diperlukan jalankan perintah 
   ```bash
   composer install
   ```
4.	Salin file .env.example menjadi .env bisa juga dengan menjalankan perintah cp .env.example .env
5.	Edit file env sesuai dengan project
6.	Jalankan perintah berikut, untuk membuat application key
   ```bash
   php artisan key:generate
   ```
7.	Aktifkan web server
8.	Jalankan perintah berikut di terminal direktori file yang sudah diclone untuk membuat tabel di database dan mengisi data awal.
   ```bash
   php artisan migrate 
   ```
9.	Jalankan server local dengan mengetikkan perintah php artisan serve
10.	Akses halaman registrasi untuk menambahkan akun dan lakukan login
11.	Modifikasi role user dengan mengubah nilai pada kolom role di tabel user pada database anda
12.	User pustakawan dapat melaukan kelola untuk data user, kategori, penerbit, penulis, buku, serta mendapatkan informasi terkait peminjaman dan pengembalian.
13.	User member dapat melakukan peminjaman, perpanjangan peminjaman, membaca buku atau dokumen, mengedit profil, melihat histori peminjaman dan melakukan pengembalian.


We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
