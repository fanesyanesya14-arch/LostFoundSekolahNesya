# LostFoundSekolah

Aplikasi **LostFoundSekolah** merupakan aplikasi Lost and Found Sekolah yang dibuat untuk membantu proses pencatatan, penyimpanan, dan penampilan data barang yang ditemukan di lingkungan sekolah.

Project ini dibuat menggunakan **MIT App Inventor** untuk aplikasi mobile, **PHP** sebagai API/backend, **MySQL/MariaDB** sebagai database, dan **Web Admin berbasis PHP** untuk melihat rekapitulasi data serta melakukan cetak dan ekspor Excel.

## Fitur Utama

### Aplikasi Mobile
- Login pengguna
- Dashboard
- Input barang temuan
- Pengambilan foto menggunakan kamera HP
- Input nama barang
- Input lokasi penemuan
- Input keterangan barang
- Penyimpanan data ke database
- Upload foto barang
- Daftar barang yang sudah tersimpan
- Notifikasi proses berhasil/gagal

### Web Admin
- Login admin
- Dashboard rekapitulasi data barang
- Menampilkan foto barang
- Pencarian data barang
- Cetak rekapitulasi
- Ekspor data ke Excel

## Teknologi

| Teknologi | Fungsi |
|---|---|
| MIT App Inventor | Membuat aplikasi mobile Android |
| PHP | API/backend aplikasi |
| MySQL / MariaDB | Penyimpanan data |
| XAMPP | Menjalankan Apache dan MySQL secara lokal |
| HTML + CSS | Tampilan Web Admin |

## Struktur Project

```text
LostFoundSekolah/
├── mit_app_inventor/
│   └── LostFoundSekolahREALLYYY(1).aia
│
├── lost_found_api/
│   ├── koneksi.php
│   ├── login.php
│   ├── simpan.php
│   ├── upload_foto.php
│   ├── tampil.php
│   ├── cek.php
│   └── uploads/
│
├── lostfound_admin/
│   ├── config.php
│   ├── login.php
│   ├── index.php
│   ├── print.php
│   ├── export_excel.php
│   └── logout.php
│
├── sql/
│   └── db_lostfound_sekolah.sql
│
└── README.md
```

## Database

Nama database:

```text
db_lostfound_sekolah
```

Tabel utama:

```text
barang
```

Kolom tabel `barang`:

```text
id
nama_barang
lokasi
keterangan
foto
tanggal
```

Tabel login:

```text
users
```

## Akun Demo

Gunakan akun berikut untuk pengujian aplikasi dan Web Admin:

```text
Username : admin
Password : 12345
```

> Akun tersebut adalah akun demo untuk kebutuhan project.

## Cara Menjalankan Project

### 1. Menyiapkan Database

Buka XAMPP dan jalankan:

```text
Apache  → Start
MySQL   → Start
```

Buka:

```text
http://localhost/phpmyadmin
```

Import file:

```text
sql/db_lostfound_sekolah.sql
```

Database yang digunakan:

```text
db_lostfound_sekolah
```

### 2. Menyiapkan PHP API

Salin folder:

```text
lost_found_api
```

ke:

```text
C:\xampp\htdocs\
```

Sehingga menjadi:

```text
C:\xampp\htdocs\lost_found_api\
```

### 3. Menyiapkan Web Admin

Salin folder:

```text
lostfound_admin
```

ke:

```text
C:\xampp\htdocs\
```

Sehingga menjadi:

```text
C:\xampp\htdocs\lostfound_admin\
```

Buka Web Admin melalui:

```text
http://localhost/lostfound_admin/login.php
```

Login dengan:

```text
Username : admin
Password : 12345
```

### 4. Menjalankan Aplikasi Mobile

Import file:

```text
mit_app_inventor/LostFoundSekolahREALLYYY(1).aia
```

ke MIT App Inventor.

Untuk pengujian menggunakan HP dan server XAMPP pada jaringan lokal, alamat IP laptop harus menggunakan **IP laptop saat ini**.

Contoh:

```text
http://10.43.134.51/lost_found_api/
```

> IP lokal dapat berubah ketika koneksi Wi-Fi/hotspot berubah. Jika IP laptop berubah, alamat API pada aplikasi harus disesuaikan.

## Alur Aplikasi

```text
Login
  ↓
Dashboard
  ├── Input Barang
  │     ├── Ambil Foto
  │     ├── Nama Barang
  │     ├── Lokasi
  │     ├── Keterangan
  │     └── Simpan
  │
  └── Daftar Barang
        └── Menampilkan data dari MySQL
```

## Alur Penyimpanan Data

```text
MIT App Inventor
       ↓
PHP API
       ↓
MySQL / MariaDB
       ↓
db_lostfound_sekolah
       ↓
tabel barang
```

Untuk foto:

```text
MIT App Inventor
       ↓
upload_foto.php
       ↓
lost_found_api/uploads/
       ↓
nama file foto disimpan pada kolom foto
```

## Persyaratan Tugas

Menurut modul tugas yang digunakan, project mensyaratkan:
- minimal 3 layar, mencakup Login, Dashboard, dan Input Data;
- minimal satu sensor/hardware seperti Kamera, GPS, atau Barcode Scanner;
- backend/database eksternal menggunakan Firebase Realtime Database atau Web MySQL & PHP API;
- khusus pengguna MySQL, wajib menyertakan Web Admin HTML/PHP untuk rekapitulasi data serta fitur cetak/ekspor Excel.

Project LostFoundSekolah menggunakan:
- 4 layar;
- Kamera sebagai sensor/hardware;
- MySQL + PHP API;
- Web Admin dengan rekapitulasi, cetak, dan ekspor Excel.

## Catatan

Project ini ditujukan untuk penggunaan lokal saat pengembangan dan demonstrasi menggunakan XAMPP.

Untuk menjalankan aplikasi melalui HP, laptop dan HP harus berada pada jaringan yang dapat saling mengakses. Pastikan Apache dan MySQL sedang berjalan.

