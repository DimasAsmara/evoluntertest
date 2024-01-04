-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2023 at 08:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_volunteer`
--

-- --------------------------------------------------------

--
-- Table structure for table `intansi`
--

CREATE TABLE `intansi` (
  `id_intansi` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `kode` varchar(200) DEFAULT NULL,
  `kuota` int(11) DEFAULT NULL,
  `member` int(11) DEFAULT NULL,
  `auto_approve` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intansi`
--

INSERT INTO `intansi` (`id_intansi`, `nama`, `kode`, `kuota`, `member`, `auto_approve`) VALUES
(1, 'TESTING', 'CALEG%', 1000, 10, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `nama`) VALUES
(1, 'Kedung Kandang');

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id_kelurahan` int(11) NOT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `id_intansi` int(11) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `jumlah_rw` int(11) DEFAULT NULL,
  `jumlah_rt` int(11) DEFAULT NULL,
  `jumlah_tps` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`id_kelurahan`, `id_kecamatan`, `id_intansi`, `nama`, `jumlah_rw`, `jumlah_rt`, `jumlah_tps`) VALUES
(13, NULL, 1, 'Kelurahan 1', NULL, NULL, NULL),
(14, NULL, 1, 'Kelurahan 2', NULL, NULL, NULL),
(15, NULL, 1, 'Kelurahan 3', 2, 3, NULL),
(64, NULL, 1, 'KELURAHAN BARU 1', 4, 3, 10),
(65, NULL, 1, 'KELURAHAN BARU 3', 5, 2, 5),
(66, NULL, 1, 'KELURAHAN BARU 4', 6, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id_penduduk` int(11) NOT NULL,
  `id_kelurahan` int(11) DEFAULT NULL,
  `id_intansi` int(11) DEFAULT NULL,
  `id_tps` int(11) DEFAULT NULL,
  `nik` varchar(100) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `notelp` varchar(200) DEFAULT NULL,
  `umur` int(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `gender` enum('L','P') DEFAULT NULL,
  `rt` int(11) DEFAULT NULL,
  `rw` int(11) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto_ktp` varchar(200) DEFAULT NULL,
  `foto_pendukung` varchar(200) DEFAULT NULL,
  `new_data` enum('Y','N') NOT NULL DEFAULT 'N',
  `status` tinyint(4) DEFAULT 1 COMMENT '1 = belum di datangi, 2 = sudah di datangi',
  `taken_by` int(11) DEFAULT NULL,
  `taken_date` datetime DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp(),
  `create_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id_penduduk`, `id_kelurahan`, `id_intansi`, `id_tps`, `nik`, `nama`, `notelp`, `umur`, `email`, `gender`, `rt`, `rw`, `alamat`, `foto_ktp`, `foto_pendukung`, `new_data`, `status`, `taken_by`, `taken_date`, `create_date`, `create_by`) VALUES
(331, 14, 1, 38, '1211214141314', 'Penduduk 1', '081704141', 40, NULL, 'P', 1, 10, 'dvyqbv', '65421f27939aa1.png', '65421f27939aa.png', 'N', 2, 5, '2023-11-01 16:49:27', '2023-10-10 23:29:12', 5),
(332, 14, 1, 78, '244543266543', 'Penduduk 2', '0898930040', 10, NULL, 'L', 5, 7, 'Jl. Kesemsem manja', '65421f536242d1.png', '65421f536242d.png', 'N', 2, 5, '2023-11-01 16:50:11', '2023-10-13 16:23:23', 5),
(333, 14, 1, 24, '125432345432', 'Penduduk 3', '01900510', 40, NULL, 'L', 1, 3, NULL, '65421e66dea381.png', '65421e66dea38.png', 'N', 1, 5, '2023-11-01 16:46:14', '2023-10-13 16:25:06', 5);

-- --------------------------------------------------------

--
-- Table structure for table `penugasan`
--

CREATE TABLE `penugasan` (
  `id_user` int(11) DEFAULT NULL,
  `id_kelurahan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penugasan`
--

INSERT INTO `penugasan` (`id_user`, `id_kelurahan`) VALUES
(1, 13),
(16, 13),
(17, 14),
(33, 14),
(17, 13),
(27, 13),
(28, 13),
(29, 13),
(30, 13),
(31, 13),
(132, 14),
(132, 15),
(133, 14),
(133, 15),
(134, 14),
(134, 15),
(135, 14),
(135, 15),
(136, 14),
(136, 15),
(16, 14),
(31, 14),
(1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `tps`
--

CREATE TABLE `tps` (
  `id_tps` int(11) NOT NULL,
  `id_intansi` int(11) DEFAULT NULL,
  `id_kelurahan` int(11) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tps`
--

INSERT INTO `tps` (`id_tps`, `id_intansi`, `id_kelurahan`, `nama`) VALUES
(24, 1, 13, 'TPS 1'),
(25, 1, 13, 'TPS 2'),
(26, 1, 13, 'TPS 3'),
(38, 1, 14, 'TPS 1'),
(39, 1, 14, 'TPS 2'),
(40, 1, 14, 'TPS 3'),
(45, 1, 13, 'TPS 4'),
(46, 1, 13, 'TPS 5'),
(47, 1, 13, 'TPS 6'),
(68, 1, 64, 'TPS 1'),
(69, 1, 64, 'TPS 2'),
(70, 1, 64, 'TPS 3'),
(71, 1, 64, 'TPS 4'),
(72, 1, 64, 'TPS 5'),
(73, 1, 64, 'TPS 6'),
(74, 1, 64, 'TPS 7'),
(75, 1, 64, 'TPS 8'),
(76, 1, 64, 'TPS 9'),
(77, 1, 64, 'TPS 10'),
(78, 1, 65, 'TPS 1'),
(79, 1, 65, 'TPS 2'),
(80, 1, 65, 'TPS 3'),
(81, 1, 65, 'TPS 4'),
(82, 1, 65, 'TPS 5'),
(83, 1, 66, 'TPS 1'),
(84, 1, 66, 'TPS 2'),
(85, 1, 66, 'TPS 3'),
(86, 1, 66, 'TPS 4');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_intansi` int(11) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `notelp` varchar(200) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `role` tinyint(4) DEFAULT 1 COMMENT '1 = relawan, 2 = admin',
  `create_by` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp(),
  `block` enum('Y','N') DEFAULT 'N',
  `block_by` int(11) DEFAULT NULL,
  `block_date` datetime DEFAULT NULL,
  `block_reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_intansi`, `nama`, `email`, `notelp`, `foto`, `password`, `role`, `create_by`, `create_date`, `block`, `block_by`, `block_date`, `block_reason`) VALUES
(1, 1, 'jeje', 'jjeje1303@gmail.com', '081333811057', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 1, '2023-09-08 15:20:24', 'N', NULL, NULL, NULL),
(5, 1, 'Superadmin', 'admin@gmail.com', '081333811057', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 2, NULL, '2023-09-09 20:34:56', 'N', NULL, NULL, NULL),
(16, 1, 'Saka Dana Asmara', 'sakadana2003@gmail.com', '0812345678', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 5, '2023-09-18 02:36:08', 'N', NULL, NULL, NULL),
(17, 1, 'Aris Narayana Adi Putra', 'aris@gmail.com', '0877733333', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 5, '2023-09-18 02:37:35', 'N', NULL, NULL, NULL),
(18, 1, 'Moh Ramadhan', 'rama@gmail.com', '08123452345', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 5, '2023-09-18 02:40:23', 'Y', 5, '2023-10-05 17:54:34', ''),
(19, 1, 'Zefan Tirza C', 'zeze@gmail.com', '0812223134114', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 5, '2023-09-18 02:44:25', 'Y', 5, '2023-10-05 17:54:34', ''),
(27, 1, 'Relawan 1', 'relawan1@gmail.com', '0811111111', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 5, '2023-09-21 14:35:46', 'N', NULL, NULL, NULL),
(28, 1, 'Relawan 2', 'relawan2@gmail.com', '0822222222', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 5, '2023-09-21 14:36:21', 'N', NULL, NULL, NULL),
(29, 1, 'Relawan 3', 'relawan3@gmail.com', '0833333333', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 5, '2023-09-21 14:37:11', 'N', NULL, NULL, NULL),
(30, 1, 'Relawan 4', 'relawan4@gmail.com', '0844444444', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 5, '2023-09-21 14:38:18', 'N', NULL, NULL, NULL),
(31, 1, 'Relawan 5', 'relawan5@gmail.com', '0855555555', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 5, '2023-09-21 14:38:51', 'N', NULL, NULL, ''),
(33, 1, 'a', 'b@gmail.com', '08111231141', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 5, '2023-10-05 15:28:53', 'Y', 5, '2023-10-05 17:50:02', ''),
(132, 1, 'RELAWAN TAMBAHAN 1', 'reltamb1@gmail.com', '881111111', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 5, '2023-10-07 12:30:34', 'N', NULL, NULL, NULL),
(133, 1, 'RELAWAN TAMBAHAN 2', 'reltamb2@gmail.com', '882222222', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 5, '2023-10-07 12:30:34', 'N', NULL, NULL, NULL),
(134, 1, 'RELAWAN TAMBAHAN 3', 'reltamb3@gmail.com', '883333333', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 5, '2023-10-07 12:30:34', 'N', NULL, NULL, NULL),
(135, 1, 'RELAWAN TAMBAHAN 4', 'reltamb4@gmail.com', '884444444', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 5, '2023-10-07 12:30:34', 'N', NULL, NULL, NULL),
(136, 1, 'RELAWAN TAMBAHAN 5', 'reltamb5@gmail.com', '885555555', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 5, '2023-10-07 12:30:34', 'N', NULL, NULL, NULL),
(137, 1, 'RELAWAN TAMBAHAN 6', 'reltamb6@gmail.com', '886666666', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 5, '2023-10-07 12:30:34', 'N', NULL, NULL, NULL),
(138, 1, 'RELAWAN TAMBAHAN 7', 'reltamb7@gmail.com', '887777777', '652aa872dce96.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 1, 5, '2023-10-07 12:30:34', 'N', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `intansi`
--
ALTER TABLE `intansi`
  ADD PRIMARY KEY (`id_intansi`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id_kelurahan`),
  ADD KEY `id_kecamatan` (`id_kecamatan`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id_penduduk`),
  ADD KEY `create_by` (`create_by`),
  ADD KEY `taken_by` (`taken_by`),
  ADD KEY `id_kelurahan` (`id_kelurahan`),
  ADD KEY `id_intansi` (`id_intansi`),
  ADD KEY `penduduk_ibfk_5` (`id_tps`);

--
-- Indexes for table `penugasan`
--
ALTER TABLE `penugasan`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kelurahan` (`id_kelurahan`);

--
-- Indexes for table `tps`
--
ALTER TABLE `tps`
  ADD PRIMARY KEY (`id_tps`),
  ADD KEY `id_kelurahan` (`id_kelurahan`),
  ADD KEY `id_intansi` (`id_intansi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `create_by` (`create_by`),
  ADD KEY `id_intansi` (`id_intansi`),
  ADD KEY `block_by` (`block_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `intansi`
--
ALTER TABLE `intansi`
  MODIFY `id_intansi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `id_kelurahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id_penduduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;

--
-- AUTO_INCREMENT for table `tps`
--
ALTER TABLE `tps`
  MODIFY `id_tps` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD CONSTRAINT `kelurahan_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD CONSTRAINT `penduduk_ibfk_1` FOREIGN KEY (`create_by`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `penduduk_ibfk_2` FOREIGN KEY (`taken_by`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `penduduk_ibfk_3` FOREIGN KEY (`id_kelurahan`) REFERENCES `kelurahan` (`id_kelurahan`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `penduduk_ibfk_4` FOREIGN KEY (`id_intansi`) REFERENCES `intansi` (`id_intansi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penduduk_ibfk_5` FOREIGN KEY (`id_tps`) REFERENCES `tps` (`id_tps`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `penugasan`
--
ALTER TABLE `penugasan`
  ADD CONSTRAINT `penugasan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penugasan_ibfk_2` FOREIGN KEY (`id_kelurahan`) REFERENCES `kelurahan` (`id_kelurahan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tps`
--
ALTER TABLE `tps`
  ADD CONSTRAINT `tps_ibfk_1` FOREIGN KEY (`id_kelurahan`) REFERENCES `kelurahan` (`id_kelurahan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tps_ibfk_2` FOREIGN KEY (`id_intansi`) REFERENCES `intansi` (`id_intansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`create_by`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_intansi`) REFERENCES `intansi` (`id_intansi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`block_by`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
