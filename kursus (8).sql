-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 01:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kursus`
--

-- --------------------------------------------------------

--
-- Table structure for table `kursus`
--

CREATE TABLE `kursus` (
  `id_kursus` int(11) NOT NULL,
  `nama_kursus` varchar(255) DEFAULT NULL,
  `durasi_kursus` int(11) DEFAULT NULL,
  `biaya_kursus` decimal(10,2) DEFAULT NULL,
  `deskripsi_kursus` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kursus`
--

INSERT INTO `kursus` (`id_kursus`, `nama_kursus`, `durasi_kursus`, `biaya_kursus`, `deskripsi_kursus`) VALUES
(1, 'Beginner', 30, 300000.00, 'Kursus Jenis Beginner'),
(2, 'Advance', 30, 600000.00, 'Kursus Jenis Advance'),
(3, 'Expert', 30, 800000.00, 'Kursus Jenis Expert');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `username`, `password`, `role`, `alamat`, `email`, `login_time`) VALUES
(1, 'Ahmad Surya', 'ahmads', 'password1', 'peserta', 'Jl. Merdeka No.1, Jakarta', 'ahmad.surya@gmail.com', '2024-05-26 09:22:34'),
(2, 'Dewi Lestari', 'dewil', 'password2', 'peserta', 'Jl. Sudirman No.10, Bandung', 'dewi.lestari@yahoo.com', '2024-05-26 08:12:03'),
(3, 'Budi Santoso', 'budis', 'password3', 'peserta', 'Jl. Diponegoro No.5, Surabaya', 'budi.santoso@hotmail.com', '2024-05-26 08:15:14'),
(4, 'Siti Aminah', 'sitia', 'password4', 'peserta', 'Jl. Gajah Mada No.3, Yogyakarta', 'siti.aminah@outlook.com', '2024-05-26 07:25:50'),
(5, 'Rizky Hidayat', 'rizkyh', 'password5', 'peserta', 'Jl. Mataram No.7, Semarang', 'rizky.hidayat@gmail.com', '2024-05-26 07:28:19'),
(6, 'Intan Permata', 'intanp', 'password6', 'user', 'Jl. Braga No.12, Bandung', 'intan.permata@yahoo.com', '2024-05-26 07:57:30'),
(7, 'Agus Wijaya', 'agusw', 'password7', 'user', 'Jl. Jenderal Soedirman No.8, Medan', 'agus.wijaya@hotmail.com', '2024-05-26 09:12:07'),
(8, 'Lina Hartati', 'linah', 'password8', 'user', 'Jl. Pemuda No.9, Surabaya', 'lina.hartati@outlook.com', '2024-05-25 11:00:00'),
(9, 'Hendra Kusuma', 'hendrak', 'password9', 'user', 'Jl. Thamrin No.11, Jakarta', 'hendra.kusuma@gmail.com', '2024-05-25 12:45:00'),
(10, 'Maya Sari', 'mayas', 'password10', 'user', 'Jl. Cendana No.4, Bogor', 'maya.sari@yahoo.com', '2024-05-25 14:15:00'),
(151107, 'rasya', 'admin', 'skomdahebat', 'admin', 'sekardangan', 'rasya23darkness@gmail.com', '2024-05-26 07:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `nomor_telepon` int(11) NOT NULL,
  `nama_pengguna` varchar(255) DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `id_kursus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`nomor_telepon`, `nama_pengguna`, `id_pengguna`, `id_kursus`) VALUES
(31, 'ahmad', 1, 1),
(331, 'dewi', 2, 2),
(3131, 'budi', 3, 3),
(3311, 'siti', 4, 3),
(331151, 'Rizky', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `nomor_telepon` int(11) DEFAULT NULL,
  `id_kursus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `nomor_telepon`, `id_kursus`) VALUES
(157, 3131, 3),
(631, 31, 1),
(653, 3311, 3),
(734, 331151, 1),
(748, 331, 2);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id_video` int(11) NOT NULL,
  `id_kursus` int(11) DEFAULT NULL,
  `judul_video` varchar(255) DEFAULT NULL,
  `deskripsi_video` text DEFAULT NULL,
  `link_video` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id_video`, `id_kursus`, `judul_video`, `deskripsi_video`, `link_video`) VALUES
(11977758, 1, 'Css Dasar', 'Kursus tentang css', 'https://www.youtube.com/embed/5wRmBDyPZCI'),
(17171828, 1, 'Html Pemula', 'Kursus tentang html', 'https://www.youtube.com/embed/0oA1Z6UKM5M'),
(18542432, 3, 'Java', 'Kursus tentang Java', 'https://www.youtube.com/embed/jiUxHm9l1KY'),
(23123474, 2, 'Php ', 'Kursus tentang php', 'https://www.youtube.com/embed/l1W2OwV5rgY'),
(38473966, 3, 'Java', 'Kursus tentang Java', 'https://www.youtube.com/embed/uHyfQV0kbgo'),
(48526566, 1, 'Html dan css', 'Kursus tentang html dan css', 'https://www.youtube.com/embed/wriGST3vp5M'),
(58872446, 2, 'Javascript Dasar', 'Kursus tentang Javascript', 'https://www.youtube.com/embed/RUTV_5m4VeI'),
(67343338, 3, 'Python', 'Kursus tentang python', 'https://www.youtube.com/embed/iA8lLwmtKQM'),
(68945714, 3, 'C', 'Kursus tentang C', 'https://www.youtube.com/embed/nrbBmoINqtk'),
(71329711, 1, 'Html dan css', 'Kursus tentang html dan css', 'https://www.youtube.com/embed/HGTJBPNC-Gw'),
(74272948, 2, 'Php dasar', 'Kursus tentang php', 'https://www.youtube.com/embed/QJMTprXtPa0'),
(77951352, 1, 'Html ', 'Kursus tentang html', 'https://www.youtube.com/embed/71a2zeC71gk'),
(79545595, 3, 'Python', 'Kursus tentang python', 'https://www.youtube.com/embed/kqtD5dpn9C8'),
(95557334, 2, 'Mysql Dasar', 'Kursus tentang Mysql', 'https://www.youtube.com/embed/IlGj7XYf36I'),
(95982355, 2, 'Javascript', 'Kursus tentang Javascript', 'https://www.youtube.com/embed/sNLadea-tLU');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kursus`
--
ALTER TABLE `kursus`
  ADD PRIMARY KEY (`id_kursus`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`nomor_telepon`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_kursus` (`id_kursus`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `nomor_telepon` (`nomor_telepon`),
  ADD KEY `id_kursus` (`id_kursus`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id_video`),
  ADD KEY `id_kursus` (`id_kursus`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6641;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`),
  ADD CONSTRAINT `peserta_ibfk_2` FOREIGN KEY (`id_kursus`) REFERENCES `kursus` (`id_kursus`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`nomor_telepon`) REFERENCES `peserta` (`nomor_telepon`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_kursus`) REFERENCES `kursus` (`id_kursus`);

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`id_kursus`) REFERENCES `kursus` (`id_kursus`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
