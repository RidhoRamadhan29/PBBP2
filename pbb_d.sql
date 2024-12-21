-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2024 at 10:12 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pbb_d`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `id_arsip` int(11) NOT NULL,
  `id_penagihan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_arsip` varchar(50) DEFAULT NULL,
  `tgl_arsip` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `arsip`
--

INSERT INTO `arsip` (`id_arsip`, `id_penagihan`, `id_user`, `status_arsip`, `tgl_arsip`) VALUES
(7, 7, 1, '0', '2024-03-23');

-- --------------------------------------------------------

--
-- Table structure for table `pelayanan`
--

CREATE TABLE `pelayanan` (
  `id_pelayanan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_wp` varchar(50) DEFAULT NULL,
  `nik_wp` varchar(50) DEFAULT NULL,
  `jenis_pendaftaran` varchar(20) DEFAULT NULL,
  `alashak` varchar(30) DEFAULT NULL,
  `upload_doc_pbb` varchar(200) DEFAULT NULL,
  `status_pelayanan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelayanan`
--

INSERT INTO `pelayanan` (`id_pelayanan`, `id_user`, `nama_wp`, `nik_wp`, `jenis_pendaftaran`, `alashak`, `upload_doc_pbb`, `status_pelayanan`) VALUES
(44, 1, 'ridhoo', '5271062911010002', 'Jeni01', 'alas001', 'ridhoo-5271062911010002-65ff3fd4da2a1-2024-03-23.pdf', '1');

-- --------------------------------------------------------

--
-- Table structure for table `penagihan`
--

CREATE TABLE `penagihan` (
  `id_penagihan` int(11) NOT NULL,
  `id_penetapan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_penagihan` varchar(50) DEFAULT NULL,
  `tgl_penagihan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penagihan`
--

INSERT INTO `penagihan` (`id_penagihan`, `id_penetapan`, `id_user`, `status_penagihan`, `tgl_penagihan`) VALUES
(7, 8, 1, '0', '2024-03-23');

-- --------------------------------------------------------

--
-- Table structure for table `pendataan`
--

CREATE TABLE `pendataan` (
  `id_pendataan` int(11) NOT NULL,
  `id_pelayanan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_pendataan` varchar(50) DEFAULT NULL,
  `tgl_pendataan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendataan`
--

INSERT INTO `pendataan` (`id_pendataan`, `id_pelayanan`, `id_user`, `status_pendataan`, `tgl_pendataan`) VALUES
(14, 44, 1, '0', '2024-03-23');

-- --------------------------------------------------------

--
-- Table structure for table `penetapan`
--

CREATE TABLE `penetapan` (
  `id_penetapan` int(11) NOT NULL,
  `id_pendataan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_penetapan` varchar(50) DEFAULT NULL,
  `tgl_penetapan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penetapan`
--

INSERT INTO `penetapan` (`id_penetapan`, `id_pendataan`, `id_user`, `status_penetapan`, `tgl_penetapan`) VALUES
(8, 14, 1, '0', '2024-03-23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `username`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'rido', 'rido@sss.com', 'rido', 'default.jpg', '$2y$10$LzB6hFMbHr0kQKW2p9Fm9OUzU.oq1/dnMSJVroj0n1z8Myof53yBG', 1, 1, 1560266129),
(2, 'arsya', 'arsya@xxx.com', 'arsya', 'default.jpg', '$2y$10$LzB6hFMbHr0kQKW2p9Fm9OUzU.oq1/dnMSJVroj0n1z8Myof53yBG', 2, 1, 1560266129);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(7, 3, 2),
(12, 1, 5),
(13, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(6, 'Menu Aset');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'ADMINISTRATOR'),
(2, 'USER'),
(3, 'PELAYANAN'),
(4, 'PENDATAAN'),
(5, 'PENETAPAN'),
(6, 'PENAGIHAN');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `icon` varchar(128) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(6, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(7, 2, 'Change Password', 'user/changepass', 'fas fa-fw fa-key', 1),
(17, 6, 'PELAYANAN', 'pelayanan', 'fas fa-fw fa-folder', 1),
(18, 6, 'PENDATAAN', 'pendataan', 'fas fa-fw fa-folder', 1),
(19, 6, 'PENETAPAN', 'penetapan', 'fas fa-fw fa-folder', 1),
(20, 6, 'PENAGIHAN', 'penagihan', 'fas fa-fw fa-folder', 1),
(21, 6, 'ARSIP', 'arsip', 'fas fa-fw fa-folder', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `token` varchar(128) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(1, 'hha157058@gmail.com', 'w2xQ7drhmG1dIIPWpLBatTabuLqsAM28BgYhFF9exDM=', 1684137022);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id_arsip`),
  ADD KEY `FK_USER_5` (`id_user`),
  ADD KEY `FK_VALIDASI_PENAGIHAN` (`id_penagihan`);

--
-- Indexes for table `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD PRIMARY KEY (`id_pelayanan`),
  ADD KEY `FK_USER_1` (`id_user`);

--
-- Indexes for table `penagihan`
--
ALTER TABLE `penagihan`
  ADD PRIMARY KEY (`id_penagihan`),
  ADD KEY `FK_USER_4` (`id_user`),
  ADD KEY `FK_VALIDASI_PENETAPAN` (`id_penetapan`);

--
-- Indexes for table `pendataan`
--
ALTER TABLE `pendataan`
  ADD PRIMARY KEY (`id_pendataan`),
  ADD KEY `FK_USER_2` (`id_user`),
  ADD KEY `FK_VALIDASI_PELAYANAN` (`id_pelayanan`);

--
-- Indexes for table `penetapan`
--
ALTER TABLE `penetapan`
  ADD PRIMARY KEY (`id_penetapan`),
  ADD KEY `FK_USER_3` (`id_user`),
  ADD KEY `FK_VALIDASI_PENDATAAN` (`id_pendataan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ROLE` (`role_id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arsip`
--
ALTER TABLE `arsip`
  MODIFY `id_arsip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelayanan`
--
ALTER TABLE `pelayanan`
  MODIFY `id_pelayanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `penagihan`
--
ALTER TABLE `penagihan`
  MODIFY `id_penagihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pendataan`
--
ALTER TABLE `pendataan`
  MODIFY `id_pendataan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `penetapan`
--
ALTER TABLE `penetapan`
  MODIFY `id_penetapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arsip`
--
ALTER TABLE `arsip`
  ADD CONSTRAINT `FK_USER_5` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_VALIDASI_PENAGIHAN` FOREIGN KEY (`id_penagihan`) REFERENCES `penagihan` (`id_penagihan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD CONSTRAINT `FK_USER_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penagihan`
--
ALTER TABLE `penagihan`
  ADD CONSTRAINT `FK_USER_4` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_VALIDASI_PENETAPAN` FOREIGN KEY (`id_penetapan`) REFERENCES `penetapan` (`id_penetapan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pendataan`
--
ALTER TABLE `pendataan`
  ADD CONSTRAINT `FK_USER_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_VALIDASI_PELAYANAN` FOREIGN KEY (`id_pelayanan`) REFERENCES `pelayanan` (`id_pelayanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penetapan`
--
ALTER TABLE `penetapan`
  ADD CONSTRAINT `FK_USER_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_VALIDASI_PENDATAAN` FOREIGN KEY (`id_pendataan`) REFERENCES `pendataan` (`id_pendataan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_ROLE` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
