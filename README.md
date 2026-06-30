<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

<h1 align="center">SMK Mitra Industri — Website Sekolah</h1>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-13.x-red?logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.3%2B-blue?logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-Database-orange?logo=mysql" alt="MySQL">
  <img src="https://img.shields.io/badge/TailwindCSS-4.x-38bdf8?logo=tailwindcss" alt="Tailwind">
  <img src="https://img.shields.io/badge/Vite-8.x-purple?logo=vite" alt="Vite">
</p>

---

## 📌 Tentang Proyek Ini

**SMK Mitra Industri** adalah aplikasi web profil sekolah yang dibangun menggunakan **Laravel 13** (framework PHP). Aplikasi ini dirancang sebagai website resmi SMK yang menampilkan informasi sekolah secara publik, sekaligus menyediakan **panel admin** untuk mengelola seluruh konten website secara dinamis tanpa perlu menyentuh kode.

### ✨ Fitur Utama

| Fitur | Keterangan |
|---|---|
| 🏠 **Halaman Publik** | Beranda, profil, visi-misi, jurusan, fasilitas, berita, kontak, PPDB, dll. |
| 🔐 **Panel Admin** | Dashboard untuk mengelola semua konten website |
| 📰 **Manajemen Berita** | CRUD berita/artikel sekolah |
| 🎓 **Data Alumni** | Kelola data alumni sekolah |
| 🏭 **Konten Jurusan** | Kelola halaman tiap jurusan secara dinamis |
| 📌 **Highlight** | Kelola highlight/unggulan yang tampil di beranda |
| 💬 **Pesan / Kontak** | Terima dan kelola pesan dari pengunjung website |
| 🎉 **Popup** | Tampilkan popup pengumuman ke pengunjung |
| 📄 **Page Sections** | Edit konten halaman secara dinamis (teks hero, deskripsi, dll.) |
| 📧 **Email (SMTP)** | Kirim notifikasi email via Gmail SMTP |

---

## 🛠️ Prasyarat (Requirements)

Sebelum memulai, pastikan sistem kamu sudah terinstall:

- **PHP** >= 8.3
- **Composer** (dependency manager PHP)
- **Node.js** >= 18 & **npm**
- **MySQL** (atau MariaDB)
- **Git**

---

## 🚀 Cara Setup (Instalasi)

### 1. Clone Repository

```bash
git clone https://github.com/Hanss-Dev/smk.git
cd smk
```

### 2. Install Dependency PHP

```bash
composer install
```

### 3. Salin File Environment

```bash
cp .env.example .env
```

> Di Windows, gunakan: `copy .env.example .env`

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Konfigurasi Database

Buka file `.env` dan sesuaikan pengaturan database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smk_mitra_industrimm2100   # Nama database kamu
DB_USERNAME=root                         # Username MySQL
DB_PASSWORD=                             # Password MySQL (kosong jika tidak ada)
```

> **Catatan:** Buat database baru di MySQL terlebih dahulu dengan nama yang sama seperti nilai `DB_DATABASE` di atas.

### 6. Jalankan Migrasi Database

```bash
php artisan migrate
```

### 7. (Opsional) Konfigurasi Email

Jika ingin mengaktifkan fitur pengiriman email, edit bagian berikut di `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=emailsekolah@gmail.com
MAIL_PASSWORD=xxxx xxxx xxxx xxxx    # App Password dari Google Account
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="emailsekolah@gmail.com"
MAIL_FROM_NAME="SmkMitraIndustri"
```

> Buat **App Password** Gmail di: https://myaccount.google.com/apppasswords

### 8. Install Dependency Node.js & Build Aset

```bash
npm install
npm run build
```

---

> **Shortcut Setup Otomatis:** Kamu bisa menjalankan semua langkah di atas (2–8) sekaligus dengan satu perintah:
> ```bash
> composer setup
> ```

---

## ▶️ Cara Menjalankan

### Mode Development (Direkomendasikan untuk lokal)

Jalankan server Laravel, queue worker, dan Vite dev server sekaligus dengan satu perintah:

```bash
composer dev
```

Perintah ini secara otomatis menjalankan:
- **`php artisan serve`** → server Laravel di `http://localhost:8000`
- **`php artisan queue:work`** → memproses antrian (email, notifikasi, dll.)
- **`npm run dev`** → Vite hot-reload untuk aset frontend (CSS & JS)

### Jalankan Secara Terpisah (Manual)

Jika ingin menjalankan masing-masing secara manual di terminal terpisah:

```bash
# Terminal 1 - Server Laravel
php artisan serve

# Terminal 2 - Queue Worker
php artisan queue:work

# Terminal 3 - Vite (frontend assets, hot-reload)
npm run dev
```

### Akses Aplikasi

| URL | Keterangan |
|---|---|
| `http://localhost:8000` | Website publik |
| `http://localhost:8000/admin/login` | Halaman login admin |
| `http://localhost:8000/admin/dashboard` | Dashboard admin (perlu login) |

---

## 🧪 Menjalankan Test

```bash
composer test
# atau langsung:
php artisan test
```

---

## 📁 Pengenalan Struktur Folder

```
smk/
│
├── app/                          # Logika inti aplikasi (PHP)
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/            # Controller panel admin
│   │   │   │   ├── AuthController.php           # Login/logout admin
│   │   │   │   ├── DashboardController.php      # Dashboard admin
│   │   │   │   ├── NewsController.php           # CRUD berita
│   │   │   │   ├── AlumniController.php         # CRUD data alumni
│   │   │   │   ├── HighlightController.php      # CRUD highlight
│   │   │   │   ├── PesanController.php          # Kelola pesan kontak
│   │   │   │   ├── PopupController.php          # Kelola popup
│   │   │   │   ├── ContentJurusanController.php # Konten per jurusan
│   │   │   │   └── PageSectionController.php    # Edit section halaman
│   │   │   ├── HomeController.php               # Halaman beranda publik
│   │   │   ├── ContactController.php            # Form kontak publik
│   │   │   └── PublicNewsController.php         # Tampilan berita publik
│   │   └── Middleware/           # Middleware (autentikasi, dll.)
│   ├── Models/                   # Model Eloquent (representasi tabel DB)
│   │   ├── User.php              # Model user
│   │   ├── AdminUser.php         # Model admin
│   │   ├── News.php              # Model berita
│   │   ├── Alumni.php            # Model alumni
│   │   ├── Highlight.php         # Model highlight
│   │   ├── Pesan.php             # Model pesan kontak
│   │   ├── Popup.php             # Model popup
│   │   ├── ContentJurusan.php    # Model konten jurusan
│   │   └── PageSection.php       # Model section halaman dinamis
│   ├── Mail/                     # Kelas untuk pengiriman email
│   └── Providers/                # Service Provider Laravel
│
├── database/
│   ├── migrations/               # File migrasi skema database
│   ├── seeders/                  # Data awal (seed) database
│   └── factories/                # Factory untuk data dummy (testing)
│
├── resources/
│   └── views/                    # Template Blade (HTML + PHP)
│       ├── layouts/              # Layout utama (header, footer, navbar)
│       ├── admin/                # Semua tampilan panel admin
│       │   ├── login.blade.php
│       │   ├── dashboard.blade.php
│       │   ├── news/             # Halaman CRUD berita
│       │   ├── alumni/           # Halaman CRUD alumni
│       │   ├── highlight/        # Halaman CRUD highlight
│       │   ├── pesan/            # Halaman kelola pesan
│       │   ├── popup/            # Halaman kelola popup
│       │   └── content-jurusan/  # Halaman kelola konten jurusan
│       ├── index.blade.php       # Halaman beranda utama
│       ├── profile.blade.php     # Halaman profil sekolah
│       ├── tentangkami.blade.php # Halaman tentang kami
│       ├── visi-misi.blade.php   # Halaman visi & misi
│       ├── jurusan/              # Halaman per jurusan
│       ├── news.blade.php        # Daftar berita publik
│       ├── news-detail.blade.php # Detail berita
│       ├── fasilitas.blade.php   # Halaman fasilitas
│       ├── lab.blade.php         # Halaman laboratorium
│       ├── kontak.blade.php      # Halaman kontak
│       ├── ppdb.blade.php        # Halaman PPDB
│       ├── podcast.blade.php     # Halaman podcast
│       └── safety-riding.blade.php
│
├── routes/
│   ├── web.php                   # Definisi semua route (URL) aplikasi
│   └── console.php               # Perintah Artisan kustom
│
├── config/                       # File konfigurasi Laravel (database, mail, dll.)
├── public/                       # File yang diakses publik (index.php, upload, assets)
├── storage/                      # File upload pengguna, log, cache aplikasi
├── tests/                        # Unit & feature tests
├── bootstrap/                    # Bootstrap & cache framework
├── vendor/                       # Dependency PHP (diinstall Composer, jangan diedit)
├── node_modules/                 # Dependency JS (diinstall npm, jangan diedit)
│
├── .env                          # Konfigurasi environment AKTIF (jangan di-commit ke Git!)
├── .env.example                  # Template konfigurasi environment
├── composer.json                 # Daftar dependency PHP & scripts
├── package.json                  # Daftar dependency JavaScript
├── vite.config.js                # Konfigurasi Vite (bundler aset frontend)
└── artisan                       # CLI Laravel (entry point perintah php artisan)
```

---

## 🔧 Perintah Artisan yang Berguna

```bash
# Bersihkan semua cache (config, route, view)
php artisan optimize:clear

# Lihat semua route yang tersedia
php artisan route:list

# Refresh database (HATI-HATI: menghapus semua data!)
php artisan migrate:fresh

# Refresh database + isi data seed
php artisan migrate:fresh --seed

# Tampilkan log secara realtime di terminal
php artisan pail

# Buka REPL interaktif (untuk uji coba kode)
php artisan tinker

# Buat admin user pertama via Tinker
# php artisan tinker
# >>> \App\Models\AdminUser::create(['name'=>'Admin', 'email'=>'admin@smk.sch.id', 'password'=>bcrypt('password123')]);
```

---

## 🏗️ Tech Stack

| Teknologi | Versi | Kegunaan |
|---|---|---|
| **Laravel** | 13.x | PHP Framework utama (backend) |
| **PHP** | 8.3+ | Bahasa pemrograman backend |
| **MySQL** | — | Database relasional |
| **Blade** | — | Template engine bawaan Laravel |
| **Tailwind CSS** | 4.x | Framework CSS untuk styling frontend |
| **Vite** | 8.x | Bundler & dev server aset frontend |
| **Pest** | 4.x | Framework testing PHP |

---

## 📄 Lisensi

Proyek ini adalah milik **SMK Mitra Industri**. Seluruh kode diperuntukkan untuk keperluan internal sekolah.
