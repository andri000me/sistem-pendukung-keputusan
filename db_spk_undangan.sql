-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Bulan Mei 2020 pada 05.07
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk_undangan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw`
--

CREATE TABLE `saw` (
  `Alternatif` varchar(120) NOT NULL,
  `waktu` decimal(13,2) NOT NULL,
  `desain` decimal(13,2) NOT NULL,
  `Organisasi` decimal(13,2) NOT NULL,
  `Total` decimal(13,2) DEFAULT NULL,
  `Rangking` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `saw`
--

INSERT INTO `saw` (`Alternatif`, `waktu`, `desain`, `Organisasi`, `Total`, `Rangking`) VALUES
('adlan', '3.36', '5.00', '2.64', '11.00', 2),
('jazuli', '6.00', '1.00', '8.00', '15.00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_alternatif`
--

CREATE TABLE `tbl_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `kode_alternatif` varchar(20) DEFAULT NULL,
  `alternatif` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_alternatif`
--

INSERT INTO `tbl_alternatif` (`id_alternatif`, `kode_alternatif`, `alternatif`) VALUES
(45, 'A0001', 'adlan'),
(46, 'A0002', 'jazuli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(20) NOT NULL,
  `kriteria` varchar(50) NOT NULL,
  `sifat` varchar(20) NOT NULL,
  `bobot` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kriteria`
--

INSERT INTO `tbl_kriteria` (`id_kriteria`, `kode_kriteria`, `kriteria`, `sifat`, `bobot`) VALUES
(8, 'K0003', 'waktu', 'Cost', 6),
(10, 'K0004', 'desain', 'Benefit', 5),
(11, 'K0005', 'Organisasi', 'Benefit', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_nilai_alternatif`
--

CREATE TABLE `tbl_nilai_alternatif` (
  `id` int(11) NOT NULL,
  `kode_kriteria` varchar(20) DEFAULT NULL,
  `kode_alternatif` varchar(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_nilai_alternatif`
--

INSERT INTO `tbl_nilai_alternatif` (`id`, `kode_kriteria`, `kode_alternatif`, `nilai`) VALUES
(75, 'K0003', 'A0001', 9),
(76, 'K0004', 'A0001', 1),
(77, 'K0005', 'A0001', 3),
(78, 'K0003', 'A0002', 9),
(79, 'K0004', 'A0002', 5),
(80, 'K0005', 'A0002', 3),
(81, 'K0003', 'A0003', 5),
(82, 'K0004', 'A0003', 5),
(83, 'K0005', 'A0003', 1),
(84, 'K0003', 'A0001', 9),
(85, 'K0004', 'A0001', 5),
(86, 'K0005', 'A0001', 1),
(87, 'K0003', 'A0002', 5),
(88, 'K0004', 'A0002', 1),
(89, 'K0005', 'A0002', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sub_kriteria`
--

CREATE TABLE `tbl_sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(20) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_sub_kriteria`
--

INSERT INTO `tbl_sub_kriteria` (`id_sub_kriteria`, `kode_kriteria`, `keterangan`, `nilai`) VALUES
(8, 'K0003', 'uregen', 9),
(9, 'K0003', 'sedang', 5),
(13, 'K0003', 'tidak urgen', 1),
(14, 'K0004', 'sudah ada', 5),
(15, 'K0004', 'belum ada', 1),
(16, 'K0005', 'a', 1),
(17, 'K0005', 'b', 2),
(18, 'K0005', 'c', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(225) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `email`, `no_hp`, `nama`, `level`) VALUES
(1, 'admin', '$2y$10$62rP8vBwRE5nxWCml6eRGuKInu5rwWfBhJVypNAShrahi.b0zg.gu', 'adlanjazuli25@gmail.com', '085782697667', 'Administrator', 'admin'),
(2, 'user', '$2y$10$oMpTo8CJh0hWv8UVtU/Dge4cC.JymrUDjPHNPfkFF5E2EDlHTIuOO', '', '', 'user', 'user'),
(4, 'adad', '$2y$10$3crN0Cmf8/FU.JLuzUtaPeirbCros0bUoVKcNYGnm7IpIGCT31SDa', '', '', 'adad', 'user'),
(5, 'adlan', '$2y$10$qP05lJaZ/XRdrFH.7Hnm9Oiv5rJoN/kKiIXxREb1ASICiMNS/r6ri', '', '', 'adlan', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `tbl_nilai_alternatif`
--
ALTER TABLE `tbl_nilai_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_sub_kriteria`
--
ALTER TABLE `tbl_sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`,`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `tbl_nilai_alternatif`
--
ALTER TABLE `tbl_nilai_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `tbl_sub_kriteria`
--
ALTER TABLE `tbl_sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
