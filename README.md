# 📚 Sistem Informasi Perpustakaan Digital

Aplikasi manajemen perpustakaan berbasis web yang dikembangkan menggunakan **Laravel 11**. Aplikasi ini dirancang untuk mempermudah proses peminjaman buku fisik, manajemen koleksi, dan pembuatan laporan bagi admin.

## ✨ Fitur Utama
* **Multi-Role Access**: Login untuk Admin, Petugas, dan Peminjam.
* **Manajemen Buku**: CRUD buku lengkap dengan kategori.
* **Alur Peminjaman Realistis**:
    * Minimal peminjaman 1 minggu.
    * Sistem konfirmasi pengembalian oleh peminjam.
    * **ACC/Verifikasi Pengembalian** oleh Admin (untuk buku fisik).
    * Otomatisasi status pengembalian jika melewati tenggat waktu.
* **Laporan Pintar**:
    * Filter laporan berdasarkan rentang tanggal.
    * Filter laporan berdasarkan status (Dipinjam, Menunggu di ACC, Selesai).
    * Fitur cetak laporan (Print-friendly).
* **Keamanan**:
    * Middleware Role-based Access Control.
    * Prevent Back History (Memaksa login ulang setelah logout).

## 🛠️ Teknologi yang Digunakan
* **Framework**: Laravel 11
* **Database**: MySQL / MariaDB
* **Styling**: Bootstrap 5
* **Language**: PHP 8.3

## 🤖 Database
![Database]<img width="707" height="501" alt="Image" src="https://github.com/user-attachments/assets/a6f05f50-aa77-4d26-802c-bee73d3d406e" />

## 🚀 Cara Instalasi

1.  **Clone Repository**
    ```bash
    git clone [https://github.com/username/perpus-digital.git](https://github.com/username/perpus-digital.git)
    cd perpus-digital
    ```

2.  **Instal Dependensi**
    ```bash
    composer install
    npm install && npm run dev
    ```

3.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Migrasi Database**
    ```bash
    php artisan migrate --seed
    ```

5.  **Jalankan Server**
    ```bash
    php artisan serve
    ```

## 📖 Akun Demo Default
| Role | Name | Password |
| :--- | :--- | :--- |
| Admin | admin | password |
| Petugas | petugas | password |
| Peminjam | raehan | password |

## 📝 Catatan Penting (Business Logic)
Aplikasi ini menggunakan status khusus **"Menunggu di ACC"**. Saat peminjam mengembalikan buku lewat sistem, status tidak langsung "Selesai". Petugas harus memverifikasi kondisi fisik buku terlebih dahulu melalui halaman **Laporan** sebelum menekan tombol **ACC Kembali**.
