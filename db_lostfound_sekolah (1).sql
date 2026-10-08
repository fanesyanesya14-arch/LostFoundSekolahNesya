-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Okt 2026 pada 15.51
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lostfound_sekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `lokasi`, `keterangan`, `foto`, `tanggal`) VALUES
(1, 'Dompet Hitam', 'Ruang Kelas 1A', 'Dompet ditemukan di dekat meja guru.', NULL, '2026-10-07 12:56:45'),
(2, 'Kunci Motor', 'Parkiran Sekolah', 'Satu buah kunci dengan gantungan biru.', NULL, '2026-10-07 12:56:45'),
(3, 'ppp', 'pppp', 'ppppp', 'barang_3_1791379413.jpg', '2026-10-07 20:23:33'),
(4, 'taa', 'kelas', 'warna merah', 'barang_4_1791379434.jpg', '2026-10-07 20:23:53'),
(5, 'tajsjsjsjzj', 'kelas', 'warna merah', 'barang_5_1791379440.jpg', '2026-10-07 20:24:00'),
(6, 'tajsjsjsjzj', 'kelasnrnendj', 'warna merah ndnsjjx', 'barang_6_1791379449.jpg', '2026-10-07 20:24:08'),
(7, 'tajsjsjsjzj', 'kelasnrnendj', 'warna merah ndnsjjx', 'barang_7_1791379474.jpg', '2026-10-07 20:24:34'),
(8, 'Tas Hitam', 'Kelas 3A', 'diteruskan dibawah meja', 'barang_8_1791379592.jpg', '2026-10-07 20:26:32'),
(9, 'jdjddj', 'dhdhdujd', 'dhdhjdd', 'barang_9_1791379757.jpg', '2026-10-07 20:29:16'),
(10, 'bsksnsj', 'shsjjd', 'sbsns', 'barang_10_1791379809.jpg', '2026-10-07 20:30:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`) VALUES
(1, 'admin', '12345');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_users_username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
