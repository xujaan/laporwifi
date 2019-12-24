-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2019 at 11:05 AM
-- Server version: 10.3.13-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laporwifi`
--

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(15) NOT NULL,
  `id_mahasiswa` bigint(16) DEFAULT NULL,
  `lokasi_laporan` varchar(200) DEFAULT NULL,
  `jenis_laporan` varchar(50) NOT NULL,
  `isi_laporan` text DEFAULT NULL,
  `waktu_laporan` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `id_mahasiswa`, `lokasi_laporan`, `jenis_laporan`, `isi_laporan`, `waktu_laporan`) VALUES
(8, 201610130311121, '4.16 GKB 4', 'Jaringan lambat', 'Kecepatan kurang dari 100kb', '2019-12-24 09:21:02'),
(9, 201610130311121, 'RUANG 5.20 GKB 4', 'Tidak dapat menyambung ke Wifi', 'Susah menyambung ke hotspot', '2019-12-24 09:28:19'),
(10, 201610520111003, 'Gazebo Perpustakaan', 'Jaringan lambat', 'Jaringan sangat lambat pada sore hari', '2019-12-24 09:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` bigint(16) NOT NULL,
  `nama_mahasiswa` varchar(50) DEFAULT NULL,
  `fakultas_mahasiswa` varchar(50) DEFAULT NULL,
  `jurusan_mahasiswa` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `fakultas_mahasiswa`, `jurusan_mahasiswa`) VALUES
(201610130311121, 'Ahmad Akhus Syuj\'an', ' Teknik', ' Teknik Elektro'),
(201610520111003, 'Abdul Karim', 'Pascasarjana', ' Doktor Pendidikan Agama Islam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` bigint(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201610520111004;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
