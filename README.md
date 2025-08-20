# GudangKu 📦: Sistem Manajemen Gudang Sederhana

Aplikasi berbasis web untuk mencatat keluar masuk barang dan memantau stok gudang secara efektif. Proyek ini dikembangkan menggunakan **CodeIgniter 4** dengan _frontend_ **AdminLTE** dan database **MySQL**.

## Daftar Isi
---
- [Fitur Aplikasi](#fitur-aplikasi)
- [Struktur Proyek](#struktur-proyek)
- [Struktur Database](#struktur-database)
- [Petunjuk Instalasi & Setup](#petunjuk-instalasi--setup)
- [Tantangan dan Solusi](#tantangan-dan-solusi)
- [Tangkapan Layar (Screenshots)](#tangkapan-layar-screenshots)

## Fitur Aplikasi
---
Aplikasi ini dirancang untuk memenuhi semua kebutuhan fungsional yang diberikan dalam studi kasus, dengan penekanan pada logika bisnis yang kuat dan _user experience_ yang baik.

1.  **Dashboard:**
    -   Menampilkan ringkasan data penting, seperti jumlah jenis barang, total kategori, barang masuk/keluar hari ini, dan daftar barang dengan stok menipis (< 5 unit).

2.  **Manajemen Barang & Kategori:**
    -   _CRUD_ (Create, Read, Update, Delete) untuk data barang dan kategori.
    -   Dilengkapi validasi untuk memastikan **stok tidak boleh minus** dan **kode barang tidak boleh duplikat**.
    -   Menerapkan integritas referensial: data tidak dapat dihapus jika sudah digunakan di transaksi lain.

3.  **Manajemen Vendor:**
    -   Fitur _CRUD_ untuk mengelola data pemasok.
    -   Integrasi dengan modul pembelian untuk memudahkan pencatatan transaksi.

4.  **Manajemen Pembelian (Purchase):**
    -   Mencatat transaksi pembelian secara rinci, termasuk vendor, tanggal, pembeli, dan detail item.
    -   Setiap transaksi memiliki **status (`Pending` atau `Selesai`)**. Aksi **Edit** dan **Hapus** hanya dapat dilakukan pada transaksi berstatus `Pending` untuk menjaga integritas data.

5.  **Transaksi Barang Masuk:**
    -   Menyediakan halaman terpisah untuk memproses barang masuk.
    -   Hanya menampilkan transaksi pembelian berstatus `Pending` yang siap dikonfirmasi.
    -   Setelah konfirmasi, **stok barang otomatis bertambah** dan status pembelian berubah menjadi `Selesai`.

6.  **Transaksi Barang Keluar:**
    -   Mencatat setiap barang yang keluar dari gudang.
    -   **Stok barang otomatis berkurang** setelah transaksi berhasil.
    -   Validasi ketat memastikan jumlah yang dikeluarkan tidak melebihi stok yang tersedia.

7.  **Laporan:**
    -   Menyediakan laporan terperinci dengan filter rentang tanggal:
        -   Laporan Barang Masuk.
        -   Laporan Barang Keluar.
        -   Laporan Stok Terkini, dengan indikator visual untuk stok yang menipis.

## Struktur Proyek
---
Proyek ini dibangun di atas arsitektur **Model-View-Controller (MVC)** dari CodeIgniter 4, dengan struktur folder standar yang telah disesuaikan untuk kemudahan pengembangan dan pemeliharaan.

/SISTEM-GUDANG
├── app/
│   ├── Controllers/     // Berisi semua logika bisnis dan routing permintaan
│   ├── Models/          // Berisi semua interaksi dengan database dan logika data
│   ├── Views/           // Berisi semua file antarmuka pengguna (UI)
│   ├── Config/          // Konfigurasi aplikasi (database, routing, dll.)
│   └── Database/        // Berisi file migrasi atau seeds database
│
├── public/              // Folder publik untuk aset (CSS, JS, gambar)
│   ├── adminlte/
│   └── img/
│
├── writable/            // Folder untuk cache, log, dan sesi
├── vendor/              // Dependensi yang diinstal oleh Composer
└── README.md

## Struktur Database
---
Implementasi database disesuaikan dari ERD sederhana yang diberikan untuk mengakomodasi kebutuhan bisnis yang lebih kompleks, khususnya pada modul Pembelian dan Barang Masuk.

-   `categories`: Data kategori barang.
-   `vendors`: Data pemasok.
-   `products`: Master data barang, termasuk `category_id` dan `stock` terkini.
-   `purchases`: _Header_ transaksi pembelian, berelasi dengan `vendors`. Mencakup `status` (`Pending`, `Selesai`).
-   `purchase_details`: Detail item untuk setiap transaksi pembelian. Berelasi dengan `purchases` dan `products`.
-   `incoming_transactions`: Mencatat barang masuk. Berelasi dengan `purchase_id` untuk melacak asal barang masuk.
-   `outgoing_transactions`: Mencatat barang keluar. Berelasi langsung dengan `products`.

## Petunjuk Instalasi & Setup
---
Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda.

### Prasyarat
-   PHP 7.4 atau lebih tinggi
-   MySQL
-   Composer

### Langkah-langkah
1.  **Clone Repositori:**
    ```bash
    git clone https://github.com/zulkarnainizul/sistem-gudang-ci4
    cd SISTEM-GUDANG
    ```

2.  **Instal Dependensi Composer:**
    ```bash
    composer install
    ```

3.  **Setup Database:**
    -   Buat database baru di MySQL dengan nama: `db_gudang`.
    -   Import file `db_gudang.sql` yang ada di _root_ direktori proyek ini ke dalam database yang baru dibuat.

4.  **Konfigurasi Environment:**
    -   Salin file `.env.example` menjadi `.env`.
    -   Buka file `.env` dan sesuaikan konfigurasi database dengan kredensial lokal Anda:
        ```env
        database.default.hostname = localhost
        database.default.database = db_gudang
        database.default.username = root
        database.default.password =
        ```

5.  **Jalankan Aplikasi:**
    -   Dari terminal, jalankan _server_ bawaan CodeIgniter:
    ```bash
    php spark serve
    ```
    -   Aplikasi akan dapat diakses di `http://localhost:8080`.

## Tantangan dan Solusi
---
Pengerjaan proyek ini dalam waktu 3 hari menuntut ketajaman logika dan pengambilan keputusan yang cepat, terutama saat menyikapi perbedaan antara soal dan kebutuhan fungsional yang lebih dalam.

1.  **Penyesuaian Desain Database & ERD:**
    -   **Tantangan:** Soal hanya memberikan tabel `Incoming Items` dan `Outgoing Items` yang berelasi langsung dengan `Products`. Namun, fungsionalitas "barang masuk harus berasal dari pembelian" tidak bisa diimplementasikan dengan ERD sederhana tersebut.
    -   **Solusi:** Saya memutuskan untuk membuat tabel tambahan: `purchases` dan `purchase_details`. Tabel `purchases` berfungsi sebagai _header_ transaksi pembelian, sementara `purchase_details` menyimpan detail item per transaksi. Relasi `incoming_transactions` kemudian diarahkan ke `purchase`, memastikan setiap barang masuk memiliki riwayat pembelian yang jelas.

2.  **Penerapan Logika Bisnis yang Kompleks:**
    -   **Tantangan:** Menghubungkan proses `Pembelian`, `Barang Masuk`, dan pembaruan `Stok` secara konsisten.
    -   **Solusi:** Saya mengimplementasikan **status (`Pending` dan `Selesai`)** pada tabel `purchases`. Peningkatan stok tidak dilakukan saat pembelian, tetapi hanya saat transaksi `Barang Masuk` diproses dan statusnya diubah menjadi `Selesai`. Pendekatan ini mencerminkan alur proses bisnis riil.

3.  **Validasi dan Integritas Data:**
    -   **Tantangan:** Mencegah ketidakkonsistenan data, seperti stok minus atau data yang terhapus secara tidak sengaja.
    -   **Solusi:**
        -   **Database Transactions:** Digunakan pada proses krusial (misalnya, update stok) untuk memastikan semua operasi berhasil atau gagal bersamaan.
        -   **Validasi Form:** Menerapkan validasi di sisi _server_ (CodeIgniter) dan sisi _klien_ (JavaScript) untuk memastikan input data sesuai.
        -   **Integritas Relasi:** Menerapkan batasan pada penghapusan data untuk mencegah penghapusan data _master_ yang sudah digunakan.

Secara keseluruhan, proyek ini tidak hanya memenuhi persyaratan fungsional, tetapi juga menampilkan pemahaman yang mendalam tentang arsitektur perangkat lunak, logika bisnis, dan praktik _clean code_.
