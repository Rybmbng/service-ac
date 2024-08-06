-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jul 2024 pada 04.24
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
-- Database: `rozi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `datapelanggan`
--

CREATE TABLE `datapelanggan` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `notif` varchar(255) NOT NULL,
  `no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `datapelanggan`
--

INSERT INTO `datapelanggan` (`id`, `nama`, `tanggal`, `notif`, `no`) VALUES
('6776048774', 'BRIAN', '2024-07-09 02:08:53', 'yes', 13),
('1306429180', 'OJI', '2024-07-09 02:06:01', 'yes', 14),
('830764801', 'AE', '2024-07-09 02:06:05', 'yes', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dataservice`
--

CREATE TABLE `dataservice` (
  `no` int(11) NOT NULL,
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `diskon` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dataservice`
--

INSERT INTO `dataservice` (`no`, `id`, `nama`, `tanggal`, `diskon`, `status`) VALUES
(1, '1306429180', 'QORL', '2024-07-09 02:11:23', 'yes', 'Menunggu'),
(2, '6776048774', 'DMP', '2024-07-09 02:11:47', '', 'Menunggu'),
(3, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `langganan`
--

CREATE TABLE `langganan` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(255) NOT NULL,
  `noKartu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `noKartu`) VALUES
('6776048774', '9334C210'),
('1306429180', '13D4B1AA'),
('830764801', 'A0CE8332');

-- --------------------------------------------------------

--
-- Struktur dari tabel `proses`
--

CREATE TABLE `proses` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE `riwayat` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `diskon` varchar(255) NOT NULL,
  `jamMulai` varchar(255) NOT NULL,
  `jamSelesai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `riwayat`
--

INSERT INTO `riwayat` (`id`, `nama`, `diskon`, `jamMulai`, `jamSelesai`) VALUES
('1306429180', 'ROJI', 'yes', '2024-07-09 01:44:51', '2024-07-09 01:47:19'),
('6776048774', 'AM', '', '2024-07-09 01:43:51', '2024-07-09 01:47:38'),
('1306429180', 'NPM', '', '2024-07-09 01:51:08', '2024-07-09 02:06:01'),
('830764801', 'MD', '', '2024-07-09 01:53:25', '2024-07-09 02:06:05'),
('6776048774', 'D', '', '2024-07-09 01:56:17', '2024-07-09 02:06:08'),
('6776048774', 'EHEADGE', 'yes', '2024-07-09 02:07:44', '2024-07-09 02:08:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `selesai`
--

CREATE TABLE `selesai` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `datapelanggan`
--
ALTER TABLE `datapelanggan`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `dataservice`
--
ALTER TABLE `dataservice`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `datapelanggan`
--
ALTER TABLE `datapelanggan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `dataservice`
--
ALTER TABLE `dataservice`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
