-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Agu 2026 pada 06.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tesapk1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrasi bmkg sleman`
--

CREATE TABLE `administrasi bmkg sleman` (
  `Nomor` int(11) NOT NULL,
  `Tanggal Surat` date DEFAULT NULL,
  `Tanggal Terima Surat` date DEFAULT NULL,
  `Nomor Surat` varchar(50) NOT NULL,
  `Jenis Surat` varchar(25) NOT NULL,
  `Deskripsi Surat` varchar(25) NOT NULL,
  `Asal Surat` varchar(255) NOT NULL,
  `Banyak Surat` int(11) NOT NULL,
  `Tindak Lanjut KASGEOF` varchar(255) NOT NULL,
  `Tindak Lanjut Datin Mitigasi` varchar(255) NOT NULL,
  `CP Pengirim Surat` varchar(20) NOT NULL,
  `File Surat` varchar(255) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `administrasi bmkg sleman`
--

INSERT INTO `administrasi bmkg sleman` (`Nomor`, `Tanggal Surat`, `Tanggal Terima Surat`, `Nomor Surat`, `Jenis Surat`, `Deskripsi Surat`, `Asal Surat`, `Banyak Surat`, `Tindak Lanjut KASGEOF`, `Tindak Lanjut Datin Mitigasi`, `CP Pengirim Surat`, `File Surat`, `Status`) VALUES
(17, '2026-08-05', '2026-08-06', 'HM.02.02/003', 'keluar', 'Surat Administrasi', 'Leader miratel yogya Yanuar Dukito ', 1, 'Mohon Ditindak Lanjuti', 'Disiapkan Wuri acc ka_tim mitigasi', 'Fian R 08520035055', '6a71dd2cabf34-modul 1 didan.png', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `User id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`User id`, `email`, `password`) VALUES
(1, 'fahmiabdul93@gmail.com', 'Haters93'),
(2, 'mahamaha77@gmail.com', 'abdoel88'),
(3, 'ilhamaulana44@gmail.com', 'wibi88');

-- --------------------------------------------------------

--
-- Struktur dari tabel `register`
--

CREATE TABLE `register` (
  `First Name` text NOT NULL,
  `Last Name` text NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Confirm Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `register`
--

INSERT INTO `register` (`First Name`, `Last Name`, `Email`, `Password`, `Confirm Password`) VALUES
('fahmi', 'abdullah', 'widiyati1504@gmail.com', 'haters93', ''),
('wibi', 'nandya', 'wibinandya@gmail.com', 'abdul93', ''),
('wibi', 'ya', 'wibiya88@gmail.com', 'abdul93', ''),
('agikgak', 'gokgok', 'agikgak88@gmail.com', 'abdul99', ''),
('ami ', 'ganteng', 'amiganteng88@gmail.com', 'abdul88', 'abdul88'),
('yahahah', 'ayo', 'inikitamau@gmail.com', 'abdul00', 'abdul00'),
('tikus', 'kantor', 'mahamaha77@gmail.com', 'abdoel88', 'abdoel88'),
('ilham', 'maulana', 'ilhamaulana44@gmail.com', 'wibi88', 'wibi88');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat keluar`
--

CREATE TABLE `surat keluar` (
  `Nomor Surat` int(11) NOT NULL,
  `Nama Surat` varchar(11) NOT NULL,
  `Tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `Tertuju` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `File Surat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat masuk`
--

CREATE TABLE `surat masuk` (
  `Nomor Surat` int(11) NOT NULL,
  `Nama Surat` varchar(255) NOT NULL,
  `Tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `Penerima` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `File Surat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `administrasi bmkg sleman`
--
ALTER TABLE `administrasi bmkg sleman`
  ADD PRIMARY KEY (`Nomor`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`User id`);

--
-- Indeks untuk tabel `surat keluar`
--
ALTER TABLE `surat keluar`
  ADD PRIMARY KEY (`Nomor Surat`);

--
-- Indeks untuk tabel `surat masuk`
--
ALTER TABLE `surat masuk`
  ADD PRIMARY KEY (`Nomor Surat`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `administrasi bmkg sleman`
--
ALTER TABLE `administrasi bmkg sleman`
  MODIFY `Nomor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `User id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `surat keluar`
--
ALTER TABLE `surat keluar`
  MODIFY `Nomor Surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `surat masuk`
--
ALTER TABLE `surat masuk`
  MODIFY `Nomor Surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
