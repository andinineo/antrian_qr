# Antrian Online (PHP + MySQL)

Project sederhana sistem antrian online menggunakan PHP (native) dan MySQL.  
Cocok untuk dijalankan di XAMPP (Windows) atau LAMP stack.

## Fitur
- Pengguna ambil nomor antrian
- Admin memanggil nomor berikutnya / menyelesaikan nomor
- Layar display untuk monitor/TV (auto refresh)
- API sederhana untuk integrasi

## Instalasi (XAMPP)
1. Copy folder `antrian_qr` ke `C:\xampp\htdocs\antrian_qr` (atau folder htdocs kamu).
2. Import `sql/create_db.sql` lewat phpMyAdmin atau jalankan di MySQL:
   - Buka http://localhost/phpmyadmin
   - Buat dan import `create_db.sql`
3. Jalankan Apache & MySQL di XAMPP.
4. Buka:
   - Halaman pengguna: http://localhost/antrian_qr/index.php
   - Admin: http://localhost/antrian_qr/admin.php
   - Display: http://localhost/antrian_qr/display.php

## Catatan
- Untuk production: tambahkan otentikasi pada `admin.php`, gunakan prepared statements untuk keamanan, dan jangan gunakan akun root MySQL tanpa password.
- QR pada halaman dibuat via Google Chart API (hanya contoh).

## Cara push ke GitHub (singkat)
```bash
cd path/to/antrian_qr
git init
git add .
git commit -m "Initial commit - antrian online"
# Buat repo di GitHub lalu:
git remote add origin https://github.com/USERNAME/REPO.git
git branch -M main
git push -u origin main
