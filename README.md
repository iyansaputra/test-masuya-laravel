# Technical Test - Backend Developer (PT Masuya Graha Trikencana)

Ini adalah submisi untuk tugas *technical test* posisi Backend Developer. Proyek ini berupa RESTful API yang dibangun menggunakan Laravel untuk mengelola produk, customer, dan transaksi penjualan.

## ✨ Fitur Utama
- **CRUD Produk:** Manajemen data master produk, termasuk validasi kode unik dan stok.
- **CRUD Customer:** Manajemen data master customer dengan validasi kode unik.
- **CRUD Transaksi:**
  - Pembuatan transaksi baru dengan format nomor invoice otomatis (`INV/YYMM/NNNN`) yang di-reset setiap bulan.
  - Validasi stok produk secara *real-time* saat transaksi dibuat.
  - Pengurangan stok produk secara otomatis setelah transaksi berhasil.
  - Perhitungan diskon bertingkat (`disc_1`, `disc_2`, `disc_3`).
- **Integritas Data:** Produk dan Customer tidak dapat dihapus jika sudah memiliki relasi dengan transaksi.
- **Arsitektur Profesional:** Dibangun menggunakan pola MVC dengan tambahan *Service Layer* untuk memisahkan logika bisnis yang kompleks dan *Form Request* untuk validasi yang bersih.

## 🚀 Teknologi yang Digunakan
- **Backend:** PHP 8.x, Laravel 11.x
- **Database:** MySQL
- **Dependency Manager:** Composer

## ⚙️ Cara Instalasi & Menjalankan Proyek

1.  **Clone Repository**
    ```bash
    git clone [[Link ke Repository GitHub Anda]](https://github.com/iyansaputra/test-masuya-laravel)
    cd TEST-MASUYA/backend
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    ```

3.  **Konfigurasi Environment**
    - Salin file `.env.example` menjadi `.env`.
      ```bash
      cp .env.example .env
      ```
    - Buat sebuah database baru di MySQL Anda (misalnya, `db_masuya_test`).
    - Buka file `.env` dan sesuaikan konfigurasi database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5.  **Jalankan Migrasi Database**
    Perintah ini akan membuat semua tabel yang dibutuhkan.
    ```bash
    php artisan migrate
    ```

6.  **Jalankan Server**
    ```bash
    php artisan serve
    ```
    API akan berjalan di `http://127.0.0.1:8000`.

## 🧪 Cara Pengujian
Pengujian API dapat dilakukan dengan mudah menggunakan koleksi Postman yang telah disediakan.

1.  Buka aplikasi Postman.
2.  Impor file **`postman_collection.json`** yang ada di direktori utama repository ini.
3.  Semua *endpoint* untuk fitur Produk, Customer, dan Transaksi akan tersedia dan siap untuk diuji.

---
*Dikerjakan oleh: Ahmad Sofian Aris Saputra*
