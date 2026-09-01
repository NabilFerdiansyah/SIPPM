# SIPPM — PG Rendeng
Sistem Informasi Pelaporan & Penanganan Kerusakan Mesin Giling (PG Rendeng · Sinergi Gula Nusantara)

Aplikasi ini dibangun dengan **Laravel 10** berdasarkan mockup `mockup-sippm-pgrendeng-v9.html`, mengikuti alur:

1. **Operator** melapor kerusakan/abnormalitas mesin
2. **Supervisor** memvalidasi (menyetujui/menolak) laporan
3. **Supervisor** menugaskan laporan yang tervalidasi ke **Teknisi**
4. **Teknisi** menangani & mencatat hasil penanganan
5. **Supervisor** melakukan validasi akhir lalu mengarsipkan laporan sebagai selesai

Setiap akun hanya punya satu peran (operator / supervisor / teknisi), dan menu-sidebar menyesuaikan otomatis sesuai peran yang login — sama seperti pada mockup.

---

## 1. Persyaratan

- **XAMPP** (Apache + MySQL/MariaDB + PHP ≥ 8.1) — https://www.apachefriends.org/
- **Composer** — https://getcomposer.org/
- PHP extension yang aktif di `php.ini` XAMPP: `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `gd` (biasanya sudah aktif secara default di XAMPP)

---

## 2. Cara Instalasi (XAMPP + Laravel)

### a. Salin folder project
Ekstrak isi ZIP ini ke dalam folder `htdocs` XAMPP, misalnya:

```
C:\xampp\htdocs\sippm
```

### b. Install dependency PHP (Composer)
Buka terminal / CMD di dalam folder project, lalu jalankan:

```bash
composer install
```

### c. Siapkan file environment (.env)
Salin `.env.example` menjadi `.env`:

```bash
copy .env.example .env      # Windows
cp .env.example .env        # Mac/Linux
```

Lalu generate application key:

```bash
php artisan key:generate
```

### d. Buat database di phpMyAdmin
1. Jalankan **Apache** dan **MySQL** dari XAMPP Control Panel
2. Buka `http://localhost/phpmyadmin`
3. Buat database baru bernama **`sippm_pgrendeng`** (collation `utf8mb4_unicode_ci`)
4. Pastikan pengaturan di file `.env` sesuai (default XAMPP tanpa password):

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sippm_pgrendeng
DB_USERNAME=root
DB_PASSWORD=
```

### e. Jalankan migrasi & seeder (buat tabel + akun demo)

```bash
php artisan migrate --seed
```

### f. Buat symbolic link untuk penyimpanan foto upload

```bash
php artisan storage:link
```

### g. Jalankan aplikasi

**Opsi 1 — via Artisan (paling mudah, tanpa perlu Virtual Host):**
```bash
php artisan serve
```
Buka `http://127.0.0.1:8000` di browser.

**Opsi 2 — via Apache XAMPP:**
Arahkan Document Root Apache (atau buat Virtual Host) ke folder `sippm/public`, lalu akses `http://localhost/sippm/public` atau domain Virtual Host yang dikonfigurasi.

---

## 3. Akun Demo (hasil seeder)

| Peran      | Username        | Kata Sandi |
|------------|-----------------|------------|
| Operator   | `andi.operator`   | `password` |
| Supervisor | `sri.supervisor`  | `password` |
| Teknisi    | `budi.teknisi`    | `password` |
| Teknisi    | `rudi.teknisi`    | `password` |

Seeder juga membuat beberapa contoh laporan pada berbagai tahap alur (baru, ditugaskan, menunggu validasi akhir, selesai, ditolak) agar tampilan dashboard langsung terisi data.

---

## 4. Struktur Fitur

**Operator**
- Dashboard (ringkasan status laporan)
- Buat Laporan Kerusakan (dengan kategori: mekanik/elektrik/instrumentasi + upload foto)
- Riwayat & Detail Laporan
- Profil Saya (ubah nama, no. HP, kata sandi)

**Supervisor**
- Dashboard
- Validasi Laporan (setujui / tolak beserta catatan)
- Penugasan Teknisi
- Validasi Akhir (selesaikan / kembalikan ke teknisi)
- Histori Laporan (yang sudah selesai/ditolak)
- Kelola Akun (tab Operator/Teknisi, aktif/nonaktifkan akun)
- Tambah Akun (auto-generate username & kata sandi sementara)
- Profil Saya

**Teknisi**
- Tugas Saya (dashboard tugas aktif)
- Detail Tugas → Mulai Penanganan
- Form Hasil Penanganan (tindakan, komponen diganti, waktu mulai/selesai, foto hasil)
- Riwayat Pekerjaan
- Profil Saya

---

## 5. Catatan Teknis

- Tampilan (CSS) diambil dari mockup asli (`public/css/app.css`) agar konsisten secara visual.
- Foto laporan & foto hasil disimpan di `storage/app/public/laporan` dan `storage/app/public/hasil` (diakses via `public/storage` setelah `php artisan storage:link`).
- Middleware `role:` (lihat `app/Http/Middleware/RoleMiddleware.php`) membatasi setiap grup route sesuai peran akun yang login.
- Folder `vendor/` **tidak disertakan** dalam ZIP ini (standar praktik Laravel) — jalankan `composer install` untuk mengunduhnya.

---

## 6. Troubleshooting

| Masalah | Solusi |
|---|---|
| `could not find driver` saat migrate | Aktifkan ekstensi `pdo_mysql` di `php.ini` XAMPP, lalu restart Apache |
| Foto tidak muncul | Pastikan sudah menjalankan `php artisan storage:link` |
| `419 Page Expired` saat submit form | Hapus cache/cookie, atau jalankan `php artisan config:clear` |
| Halaman blank / error 500 | Cek `storage/logs/laravel.log`, pastikan folder `storage/` dan `bootstrap/cache/` writable |

---

© 2026 PG Rendeng · Sinergi Gula Nusantara
