# E-commerce ATK (Alat Tulis Kantor) 🌸

A premium e-commerce platform for stationery and office supplies built with **Laravel 12** and **Tailwind CSS**. This project features a unique "Pale Pink" (Pink Pucet) aesthetic and is fully localized in **Bahasa Indonesia**.

## ✨ Fitur Utama

- **Premium Design**: Tema "Pale Pink" yang elegan dengan animasi halus dan layout responsif.
- **Manajemen Stok Aman**: Menggunakan database transactions dan row-level locking (`SELECT FOR UPDATE`) untuk mencegah *overselling*.
- **Sistem Keranjang Pintar**: Pengguna dapat memilih item tertentu dalam keranjang untuk di-*checkout*.
- **Panel Admin Lengkap**: Kelola kategori, produk (dengan multi-image upload), pesanan, dan pengguna.
- **Otomatisasi Gambar**: Gambar produk otomatis di-*resize* ke ukuran kartu (400x400) dan thumbnail (150x150) menggunakan Intervention Image.
- **Pelacakan Pesanan**: Histori status pesanan yang detail untuk pelanggan.
- **Nota Digital**: Invoice/Nota yang dapat dicetak langsung dari browser.

## 🚀 Prasyarat

Sebelum memulai, pastikan Anda telah menginstal:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL atau PostgreSQL

## 🛠️ Instalasi

1. **Clone repositori:**
   ```bash
   git clone <repository-url>
   cd ukk-atk
   ```

2. **Instal dependensi PHP:**
   ```bash
   composer install
   ```

3. **Instal dependensi JavaScript:**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment:**
   Salin file `.env.example` menjadi `.env` dan atur koneksi database Anda.
   ```bash
   cp .env.example .env
   ```

5. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

6. **Migrasi dan Seed Database:**
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Link Storage:**
   ```bash
   php artisan storage:link
   ```

## 💻 Menjalankan Aplikasi

Jalankan server pengembangan Laravel:
```bash
php artisan serve
```

Jalankan Vite untuk kompilasi aset:
```bash
npm run dev
```

Aplikasi dapat diakses di `http://localhost:8000`.

## 🔐 Akun Demo

| Role | Email | Password |
| :--- | :--- | :--- |
| **Administrator** | `admin@atk.com` | `password` |
| **Pelanggan** | `user@atk.com` | `password` |

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12
- **Frontend**: Tailwind CSS, Alpine.js (via Laravel Breeze)
- **Image Processing**: Intervention Image
- **Database**: MySQL/PostgreSQL

---
Dibuat dengan ❤️ untuk solusi alat tulis kantor yang lebih estetik.
