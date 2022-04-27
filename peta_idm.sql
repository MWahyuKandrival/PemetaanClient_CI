-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2022 at 08:13 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peta_idm`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nama_client` varchar(50) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `negara` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `domain` varchar(50) NOT NULL,
  `status_kerja_sama` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `nama_client`, `pic`, `alamat`, `negara`, `region`, `email`, `no_hp`, `domain`, `status_kerja_sama`) VALUES
(943752156, 'Gedung Sate22', 'BUMN', 'Jln. Diponegoro ', 'Indonesia', 'Jawa Barat', 'gedungsate2@gmail.go.id', '888888', 'gedungsate.com', 'Berakhir'),
(943752157, 'Inovindo web 2', 'Novi ', 'Jl Batu sari', 'Indonesia', 'Jawa Barat', 'novipengusaha@gmail.com', '88888', 'inovindo.com', 'Aktif'),
(943752158, 'Politeknik Caltex Riau 2', 'Chevron', 'Jln. Umban sari', 'Indonesia', 'Riau', 'pcr@pcr.ac.id', '8888', 'pcr.ac.id', 'Aktif'),
(943752160, 'Nanyang Politeknik 2', 'Nanyang', 'Downtown core district', 'Singapore', 'North East region', 'nanyang@nanyang.ac,sg', '9898989', 'nanyang.ac.sg', 'Berakhir'),
(943752174, 'Justus Steack  2', 'Pak Nico', 'Jln. Buah batu no 1, ', 'Indonesia', 'Jawa Barat', 'steackhouse@gmail.com', '898888888', 'steackhouse.com', 'Aktif'),
(943752176, 'Test 2', 'Test', 'Test', 'Indonesia', 'Test', 'test@GMAIL.COM', '88', 'test.com', 'Aktif'),
(943752183, 'BADUT AGUNG 2', 'BUMN', 'Jln. Diponegoro', 'Indonesia', 'Jawa barat', 'agung@test.com', '8888', 'domain.com', 'Aktif'),
(943752184, 'BADUT AGUNG 22', 'BUMN', 'Jln. Diponegoro', 'Indonesia', 'Jawa barat', 'agung2@test.com', '8888', 'domain.com', 'Aktif'),
(943752185, 'Gedung Sate22', 'BUMN', 'Jln. Diponegoro ', 'Indonesia', 'Jawa Barat', 'gedungsate2@gmail.go.id', '888888', 'gedungsate.com', 'Berakhir'),
(943752186, 'Diah', 'BUMN', 'Test', 'Amerika', 'Washington DC', 'Diah@gmail.com', '888', 'domain.com', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `kode_projek` int(11) NOT NULL,
  `nama_projek` varchar(50) NOT NULL,
  `domain` varchar(50) NOT NULL,
  `package` varchar(20) NOT NULL,
  `id_client` int(11) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `ketua_projek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`kode_projek`, `nama_projek`, `domain`, `package`, `id_client`, `latitude`, `longitude`, `start_date`, `end_date`, `status`, `ketua_projek`) VALUES
(3, 'Projek Sate', 'sate.com', 'Bronze', 943752156, '-6.902208569132329', '107.61869609673788', '2019-04-01', '2021-04-01', 'Berakhir', 'Doni Romdoni'),
(4, 'Projek PCR 2', 'projek.pcr.ac.id', 'Bronze', 943752158, '0.5704815921134163', '101.42547191017734', '2017-04-01', '2019-04-01', 'Berakhir', 'Doni Romdoni'),
(5, 'Projek Inovindo', 'inovindo.com', 'Gold', 943752157, '-6.98176551083958', '107.67401879673884', '2016-04-01', '2023-04-01', 'Aktif', 'Doni Romdoni'),
(6, 'Projek Sate 2', 'pcr.co.id', 'Bronze', 943752158, '0.5704815921134163', '101.42547191017734', '2019-04-01', '2021-04-01', 'Berakhir', 'Doni Romdoni'),
(7, 'SISTIFO', 'nanyang.ac.sg', 'Gold', 943752160, '1.3801966906470826', '103.84840152602492', '2019-01-01', '2022-04-18', 'Berakhir', 'Doni Romdoni'),
(14, 'Test', 'Test', 'Silver', 943752158, '0.5704815921134163', '101.42547191017734', '2021-11-11', '2022-11-11', 'Aktif', 'Doi'),
(16, 'Steack House Informasi', 'steackhouse.com', 'Platinum', 943752174, '-6.902208569132329', '107.61869609673788', '2022-02-11', '2022-04-18', 'Berakhir', 'Doni Romdoni'),
(19, 'Test Informasi', 'test.com', 'Platinum', 943752176, '10.847513', '122.582164', '2022-04-20', '2023-04-20', 'Aktif', 'Doi'),
(20, 'Test 2', 'Test', 'Silver', 943752176, '2.718365', '113.27807', '2022-04-20', '2023-04-20', 'Aktif', 'Doi'),
(21, 'Test update', 'Test update.com', 'Platinum', 943752174, '18.66218523534874', '109.77697956288756', '2021-04-20', '2023-04-20', 'Aktif', 'Doi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `role`) VALUES
(2, 'admin', 'admin@gmail.com', '$2y$10$O9LdsSkDqdT1MWQVsfF5h.aKX6nbK9R9hHxccj.rqDls1AvqEiZxO', 'Admin'),
(3, 'tes', 'tes@gmail.com', '$2y$10$8KbPZ1fkGnDkkA8ox334meg1iKYUNbJKgDmEjJ.uzrnhLMgYuvAii', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`kode_projek`),
  ADD KEY `fk_projek_client` (`id_client`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=943752187;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `kode_projek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `fk_projek_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
