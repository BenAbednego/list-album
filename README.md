# 📸 Private Shared Photo Album & Memory Vault

> **Solusi galeri foto digital privat yang memungkinkan pengguna (pasangan, keluarga, atau tim dekat) berbagi akun dan saling mengelola album foto bersama secara privat dan aman.**

---

## 🎯 Latar Belakang & Tujuan Project

Di era digital saat ini, berbagi foto kenangan bersama orang terdekat (pasangan, keluarga, atau sahabat) seringkali dihadapkan pada beberapa kendala:
- **Penyimpanan Cloud Publik Terbatas/Berbayar:** Layanan cloud seperti Google Photos atau iCloud seringkali membutuhkan biaya langganan bulanan jika kuota habis.
- **Masalah Privasi:** Mengunggah ke media sosial publik seperti Instagram tidak selalu nyaman untuk momen-momen yang bersifat personal dan privat.
- **Kebutuhan Kolaborasi Sederhana:** Keinginan untuk memiliki satu ruang galeri bersama tempat kedua belah pihak bisa **saling menambah album dan mengunggah foto kenangan sendiri-sendiri** hanya dengan berbagi akses akun (Email & Password).

**Project ini dibuat sebagai jawaban atas kebutuhan tersebut.** 

Dengan aplikasi ini, pengguna dapat membuat satu akun bersama (*shared account*). Siapa saja yang memegang kredensial (Email & Password) akun tersebut dari perangkat mana pun dapat masuk ke galeri privat yang sama, membuat album foto baru, dan mengabadikan momen penting bersama tanpa campur tangan pihak ketiga.

---

## ✨ Fitur Utama

- 🔐 **Shared Private Authentication**: Sistem login aman berbasis akun bersama. Cukup gunakan 1 pasang Email & Password untuk diakses oleh orang-orang terpercaya.
- 📁 **Dynamic Album Management**: Buat, ubah nama, dan hapus album foto dengan mudah sesuai kategori (misal: *"Liburan Bali"*, *"Wisuda 2026"*, *"Tugas Kelompok"*).
- 🖼️ **Photo Collection & Storyteller**: Unggah foto dengan dukungan judul, tanggal momen diambil, dan deskripsi cerita di balik foto tersebut.
- 🔍 **Live Instant Search**: Cari foto favorit secara instan tanpa perlu me-refresh halaman web.
- 🎨 **Warm Studio Aesthetic UI**: Desain antarmuka modern yang tenang, estetik, ramah di mata (*Warm Cream & Amber Theme*), dirancang agar warna foto tetap menonjol.
- 🗄️ **Zero-Config File Database**: Menggunakan SQLite yang menjamin data tersimpan secara permanen dalam bentuk berkas lokal tanpa perlu setup database server yang rumit.

---

## 🏗️ Teknologi yang Digunakan

Aplikasi ini dibangun menggunakan arsitektur modern yang ringan dan cepat:

- **Framework**: [Laravel 11](https://laravel.com/) (PHP MVC Architecture)
- **Frontend & Styles**: HTML5, Vanilla CSS (Custom Design System with Variables), Vite
- **Database**: [SQLite](https://www.sqlite.org/) (File-based Local Database)
- **Security**: Laravel Authentication, Session Management, CSRF Protection, Mass Assignment Protection (`$fillable`).

---

## 🚀 Cara Menjalankan Project di Lokal

### 1. Prasyarat Sistem
Pastikan komputer Anda sudah terinstal:
- **PHP** (v8.2 atau lebih baru) & **Composer**
- **Node.js** & **npm**

### 2. Langkah Setup Pertama Kali
```bash
# 1. Clone repositori ini
git clone https://github.com/username/list-album.git
cd list-album

# 2. Copy file environment
cp .env.example .env

# 3. Install dependensi PHP & Node
composer install
npm install

# 4. Generate Application Key
php artisan key:generate

# 5. Siapkan Database SQLite & Migrasi Tabel
touch database/database.sqlite
php artisan migrate
```

### 3. Menjalankan Server Aplikasi
Jalankan **2 perintah ini di 2 tab terminal terpisah**:

* **Terminal 1 (Backend Server):**
  ```bash
  php artisan serve
  ```
* **Terminal 2 (Frontend Assets Compiler):**
  ```bash
  npm run dev
  ```

Buka browser dan akses ke: 👉 **`http://127.0.0.1:8000`**

---

## 🤝 Cara Penggunaan untuk Berbagi Akses

1. Buka `http://127.0.0.1:8000/register` di browser Anda untuk membuat akun pertama kali.
2. Bagikan **Email & Password** akun tersebut ke pasangan, teman, atau anggota keluarga Anda.
3. Mereka dapat melakukan **Login** dari perangkat mereka masing-masing menggunakan akun yang sama.
4. Kalian berdua kini dapat **saling membuat album, mengunggah foto, dan melihat galeri kenangan bersama secara privat**!

---

*Dibuat dengan ❤️ untuk kemudahan mengabadikan momen kenangan bersama.*
