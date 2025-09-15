# Loan Marketplace
Platform pinjaman online.

## System Requirements
- PHP ^8.2
- Composer
- MySQL

## How To Run It
- Clone project dengan `git clone https://github.com/nafbeckh/loan-marketplace.git`
- Masuk ke direktori `loan-marketplace` dengan `cd loan-marketplace`
- Install semua dependensi `composer install`
- Copy file `.env` dengan `cp .env.example .env`
- Generate key dengan `php artisan key:generate`
- Sesuaikan environtment di file `.env`
- Migrasi database `php artisan migrate --seed`
- Jalankan server `php artisan serv` dan `npm run build`
