# Antrian QR

Sistem Antrian Online dengan fitur QR dan login admin.

## Fitur
- Ambil nomor antrian secara online
- Layar display antrian
- Login admin untuk memanggil & melihat daftar antrian
- Reset antrian setiap hari

## Struktur Folder
- `public/` → Berisi halaman publik seperti ambil nomor & display
- `admin/` → Panel admin untuk panggil, lihat antrian
- `auth/` → Login & logout
- `config/` → Koneksi database & session
- `sql/` → Skrip SQL untuk membuat database & tabel

## Instalasi
1. Jalankan **XAMPP** → aktifkan Apache & MySQL  
2. Copy folder `antrian_qr` ke `htdocs/`  
3. Import `sql/create_db.sql` melalui phpMyAdmin  
4. Akses `http://localhost/antrian_qr/public/index.php` untuk ambil nomor  
5. Login admin di `http://localhost/antrian_qr/auth/login.php` (after kamu buat data user di database)

## Pengaturan Tambahan
- Pastikan folder `css/`, `js/` dan `images/` sudah di-set permission jika diperlukan  
- Untuk keamanan: gunakan `password_hash` & `password_verify` di PHP  
- Bersihkan input user untuk mencegah SQL injection

## Cara Push ke GitHub
```bash
git init
git remote add origin https://github.com/USERNAME/antrian_qr.git
git add .
git commit -m "Menambahkan project antrian QR dengan login admin"
git branch -M main
git push -u origin main