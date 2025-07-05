-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Des 2024 pada 04.52
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
-- Database: `dbkonveksi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_konveksi`
--

CREATE TABLE `admin_konveksi` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin_konveksi`
--

INSERT INTO `admin_konveksi` (`id`, `username`, `password`) VALUES
(2, 'admin', '$2y$10$K96hk9V/5PKPgF8xHYNi6uzhzwa4uVl6ESpFTAUTZ46Ni3/utRofG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto_produk`
--

CREATE TABLE `foto_produk` (
  `id_foto` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `foto_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `foto_produk`
--

INSERT INTO `foto_produk` (`id_foto`, `id_produk`, `foto_url`) VALUES
(7, 2, 'd257fe9f-a2a0-488b-a144-6fb12475a4b1.jpg'),
(8, 2, 'c178cf66-3b3f-408c-bf34-6a5ecbbffb49.jpg'),
(9, 2, 'f6c2d65f-8b6c-4a68-9153-8c4944dbe0a7.jpg'),
(10, 2, '9907a346-1b64-4651-8049-bf22e0f5de04.jpg'),
(11, 2, '261b6852-a228-4312-a852-3630aa7a1e15.jpg'),
(12, 2, '42f851bd-3d45-4c80-93ef-007dc4b01862.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto_warna`
--

CREATE TABLE `foto_warna` (
  `id_foto` int(11) NOT NULL,
  `id_warna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `foto_warna`
--

INSERT INTO `foto_warna` (`id_foto`, `id_warna`) VALUES
(7, 6),
(8, 7),
(9, 2),
(10, 1),
(11, 5),
(12, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_produk`
--

CREATE TABLE `jenis_produk` (
  `id_jenis` int(11) NOT NULL,
  `jenis_produk` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `portofolio`
--

CREATE TABLE `portofolio` (
  `id_portofolio` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `jenis_produk` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `ukuran` varchar(50) NOT NULL,
  `tanggal_upload` timestamp NOT NULL DEFAULT current_timestamp(),
  `thumbnail_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `jenis_produk`, `keterangan`, `harga`, `stok`, `ukuran`, `tanggal_upload`, `thumbnail_url`) VALUES
(2, 'KAOS POLO SHIRT KERAH PRIA POLOS - Polo', 'polo', 'Polo Shirt\r\n- Berbahan Pique 55% Cotton & 45% Polyester\r\n- Ketebalan 160 Gsm\r\n- Corak Rajutan Yang Khas Pada Permukaan Kainnya\r\n- Model Potongan Regular\r\n- Unisex Bisa Dipakai Pria / Wanita\r\n- Produk Lokal Dengan Kualitas International\r\n- Dibuat Di Indonesia', 78000.00, 200, '0', '2024-12-02 08:05:33', '9593ecb8-c755-4af7-9cb3-16e7bf208453.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `warna`
--

CREATE TABLE `warna` (
  `id_warna` int(11) NOT NULL,
  `warna` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `warna`
--

INSERT INTO `warna` (`id_warna`, `warna`) VALUES
(1, 'White'),
(2, 'Red'),
(3, 'Brown'),
(4, 'Blue'),
(5, 'Black'),
(6, 'Navy'),
(7, 'Grey');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_konveksi`
--
ALTER TABLE `admin_konveksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `foto_warna`
--
ALTER TABLE `foto_warna`
  ADD PRIMARY KEY (`id_foto`,`id_warna`),
  ADD KEY `id_warna` (`id_warna`);

--
-- Indeks untuk tabel `jenis_produk`
--
ALTER TABLE `jenis_produk`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `portofolio`
--
ALTER TABLE `portofolio`
  ADD PRIMARY KEY (`id_portofolio`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `warna`
--
ALTER TABLE `warna`
  ADD PRIMARY KEY (`id_warna`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_konveksi`
--
ALTER TABLE `admin_konveksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `foto_produk`
--
ALTER TABLE `foto_produk`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `jenis_produk`
--
ALTER TABLE `jenis_produk`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `portofolio`
--
ALTER TABLE `portofolio`
  MODIFY `id_portofolio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `warna`
--
ALTER TABLE `warna`
  MODIFY `id_warna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD CONSTRAINT `foto_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `foto_warna`
--
ALTER TABLE `foto_warna`
  ADD CONSTRAINT `foto_warna_ibfk_1` FOREIGN KEY (`id_foto`) REFERENCES `foto_produk` (`id_foto`) ON DELETE CASCADE,
  ADD CONSTRAINT `foto_warna_ibfk_2` FOREIGN KEY (`id_warna`) REFERENCES `warna` (`id_warna`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
