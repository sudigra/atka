-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07 Apr 2018 pada 11.45
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tumbuh`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id_app` int(11) NOT NULL,
  `nama_tempat` longtext NOT NULL,
  `alamat` longtext NOT NULL,
  `ket` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aplikasi`
--

INSERT INTO `aplikasi` (`id_app`, `nama_tempat`, `alamat`, `ket`) VALUES
(1, 'Uji Coba Aplikasi', 'Jl. Aplikasi No.1 Dusun MySql, Desa Apache, Kec. Pemrograman, Kab. WebSite, Prop. Programer ', 'Telp. 085730131035 E-mail : surya.adi.nugraha93@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `identitas`
--

CREATE TABLE `identitas` (
  `id_anak` int(11) NOT NULL,
  `nama_anak` varchar(100) NOT NULL,
  `jenkel` varchar(10) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `alamat` longtext NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tanggal_periksa` date NOT NULL,
  `umur` int(11) NOT NULL,
  `bb` int(11) NOT NULL,
  `tb` int(11) NOT NULL,
  `lk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `identitas`
--

INSERT INTO `identitas` (`id_anak`, `nama_anak`, `jenkel`, `nama_ayah`, `nama_ibu`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `tanggal_periksa`, `umur`, `bb`, `tb`, `lk`) VALUES
(1, 'Surya Adi Nugraha', 'Laki-laki', ' Nur Malik', 'Siti Marliyah', 'Desa besuk gurah kediri', 'KEDIRI', '2011-07-15', '2018-04-02', 82, 20, 80, 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kpsp`
--

CREATE TABLE `kpsp` (
  `id_kpsp` int(11) NOT NULL,
  `isi_kpsp` longtext NOT NULL,
  `kemampuan` longtext NOT NULL,
  `jika_tidak` longtext NOT NULL,
  `umur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kpsp`
--

INSERT INTO `kpsp` (`id_kpsp`, `isi_kpsp`, `kemampuan`, `jika_tidak`, `umur`) VALUES
(1, 'Pada waktu bayi telentang, apakah masing-masing lengan dan tungkai bergerak dengan mudah?', 'Gerak kasar', 'aa', 3),
(2, 'Pada waktu bayi telentang, apakah ia melihat dan menatap wajah anda?', 'Sosialisasi & kemandirian', 'aa', 3),
(3, 'Apakah bayi dapat mengeluarkan suara-suara lain (ngoceh) disamping menangis?', 'Bicara & bahasa', 'a', 3),
(4, 'Pada waktu bayi telentang, apakah ia dapat mengikuti gerakan anda dengan menggerakkan kepalanya?', 'Gerak halus', 'aa', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nam_pengguna` varchar(100) NOT NULL,
  `ket` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`username`, `password`, `nam_pengguna`, `ket`) VALUES
('admin', 'admin', 'Administrator Program', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengukuran`
--

CREATE TABLE `pengukuran` (
  `id_ukur` int(11) NOT NULL,
  `jenkel` varchar(10) NOT NULL,
  `tinggi_badan` varchar(11) NOT NULL,
  `kurus_sekali` varchar(11) NOT NULL,
  `kurus` varchar(11) NOT NULL,
  `normal` varchar(11) NOT NULL,
  `gemuk` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `pengukuran`
--

INSERT INTO `pengukuran` (`id_ukur`, `jenkel`, `tinggi_badan`, `kurus_sekali`, `kurus`, `normal`, `gemuk`) VALUES
(1, 'Laki-laki', '55.0', '1.9', '2.7', '6.7', '6.8'),
(2, 'Laki-laki', '55.5', '2.1', '2.8', '6.9', '7.0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tdd`
--

CREATE TABLE `tdd` (
  `id_tdd` int(11) NOT NULL,
  `isi_tdd` longtext NOT NULL,
  `jika_tidak` longtext NOT NULL,
  `umur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tdd`
--

INSERT INTO `tdd` (`id_tdd`, `isi_tdd`, `jika_tidak`, `umur`) VALUES
(1, 'Pada waktu bayi tidur kemudian anda berbicara atau membuat kegaduhan, apakah bayi akan bergerak atau terbangun dari tidurnya?', 'asdasd', 6),
(2, 'Pada waktu bayi tidur telentang dan anda duduk di dekat kepala bayi pada posisi yang tidak terlihat oleh bayi, kemudian anda bertepuk tangan dengan keras, apakah bayi terkejut atau menegakkan tubuh sambil mengangkat kaki tangannya ke atas?', 'iya', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id_app`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id_anak`);

--
-- Indexes for table `kpsp`
--
ALTER TABLE `kpsp`
  ADD PRIMARY KEY (`id_kpsp`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pengukuran`
--
ALTER TABLE `pengukuran`
  ADD PRIMARY KEY (`id_ukur`);

--
-- Indexes for table `tdd`
--
ALTER TABLE `tdd`
  ADD PRIMARY KEY (`id_tdd`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id_app` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id_anak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kpsp`
--
ALTER TABLE `kpsp`
  MODIFY `id_kpsp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pengukuran`
--
ALTER TABLE `pengukuran`
  MODIFY `id_ukur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tdd`
--
ALTER TABLE `tdd`
  MODIFY `id_tdd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
