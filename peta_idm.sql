-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2022 at 04:16 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

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
  `owner` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `negara` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `domain` varchar(50) NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `mulai_kerja_sama` date DEFAULT NULL,
  `henti_kerja_sama` date DEFAULT NULL,
  `status_kerja_sama` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `nama_client`, `owner`, `alamat`, `negara`, `region`, `email`, `no_hp`, `domain`, `latitude`, `longitude`, `mulai_kerja_sama`, `henti_kerja_sama`, `status_kerja_sama`) VALUES
(943752156, 'Gedung Sate', 'BUMN', 'Jln. Diponegoro ', 'Indonesia', 'Jawa Barat', 'gedungsate@gmail.go.id', '0888888', 'gedungsate.com', '-6.90062282242416', '107.6197138895795', NULL, NULL, NULL),
(943752157, 'Inovindo web', 'Novi ', 'Jl Batu sari', 'Indonesia', 'Jawa Barat', 'novipengusaha@gmail.com', '088888', 'inovindo.com', '-6.981648368742416', '107.67407244110632', NULL, NULL, NULL),
(943752158, 'Politeknik Caltex Riau', 'Chevron', 'Jln. Umban sari', 'Indonesia', 'Riau', 'pcr@pcr.ac.id', '08888', 'pcr.ac.id', '0.5702455694186912', '101.42558992756356', NULL, NULL, NULL),
(943752159, 'Petronas Twin tower', 'Petronas', 'Concourse level', 'Malaysia', 'Kuala Lumpur', 'twintower@gmail.com', '0888888', 'twintower.com', '3.158409817741703', '101.7117064263871', NULL, NULL, NULL),
(943752160, 'Nanyang Politeknik', 'Nanyang', 'Downtown core district', 'Singapore', 'North East region', 'nanyang@nanyang.ac,sg', '09898989', 'nanyang.ac.sg', '1.3813196067814155', '103.84909538931907', NULL, NULL, NULL);

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
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `ketua_projek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`kode_projek`, `nama_projek`, `domain`, `package`, `id_client`, `start_date`, `end_date`, `status`, `ketua_projek`) VALUES
(1, 'Projek 1', 'kode.pcr.ac.id', 'Silver', 943752158, '2019-04-01', '2023-04-01', 'Berakhir', 'Doni Romdoni'),
(2, 'Projek Luar Negeri 1', 'twintower.com', 'Gold', 943752159, '2020-04-01', '2022-08-01', 'Aktif', 'Doni Romdoni'),
(3, 'Projek Sate', 'sate.com', 'Bronze', 943752156, '2019-04-01', '2021-04-01', 'Berakhir', 'Doni Romdoni'),
(4, 'Projek PCR 2', 'projek.pcr.ac.id', 'Bronze', 943752158, '2017-04-01', '2019-04-01', 'Aktif', 'Doni Romdoni'),
(5, 'Projek Inovindo', 'inovindo.com', 'Gold', 943752157, '2016-04-01', '2023-04-01', 'Aktif', 'Doni Romdoni'),
(6, 'Projek Sate 2', 'pcr.co.id', 'Bronze', 943752158, '2019-04-01', '2021-04-01', 'Berakhir', 'Doni Romdoni'),
(7, 'SISTIFO', 'nanyang.ac.sg', 'Gold', 943752160, '2019-01-01', '2022-01-01', 'Berakhir', 'Doni Romdoni');

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
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=943752164;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `kode_projek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
