-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2024 at 10:07 AM
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
-- Database: `aplikasi_antrian_v3`
--

-- --------------------------------------------------------

--
-- Table structure for table `queue_antrian_admisi`
--

CREATE TABLE `queue_antrian_admisi` (
  `id` bigint(20) NOT NULL,
  `tanggal` date NOT NULL,
  `no_antrian` varchar(3) NOT NULL,
  `code_antrian` char(5) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `updated_date` datetime DEFAULT NULL,
  `antrian` varchar(255) NOT NULL,
  `loket` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `queue_penggilan_antrian`
--

CREATE TABLE `queue_penggilan_antrian` (
  `id` bigint(20) NOT NULL,
  `antrian` varchar(255) DEFAULT NULL,
  `loket` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `queue_setting`
--

CREATE TABLE `queue_setting` (
  `id` int(11) NOT NULL,
  `nama_instansi` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telpon` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `running_text` varchar(255) DEFAULT NULL,
  `youtube_id` varchar(255) DEFAULT NULL,
  `list_loket` longtext DEFAULT NULL,
  `list_type_antrian` longtext DEFAULT NULL,
  `warna_primary` varchar(255) DEFAULT NULL,
  `warna_secondary` varchar(255) DEFAULT NULL,
  `warna_accent` varchar(255) DEFAULT NULL,
  `warna_background` varchar(255) DEFAULT NULL,
  `warna_text` varchar(255) DEFAULT NULL,
  `printer` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `queue_setting`
--

INSERT INTO `queue_setting` (`id`, `nama_instansi`, `logo`, `alamat`, `telpon`, `email`, `running_text`, `youtube_id`, `list_loket`, `list_type_antrian`, `warna_primary`, `warna_secondary`, `warna_accent`, `warna_background`, `warna_text`, `printer`) VALUES
(1, 'KANTOR PERTANAHAN KOTA BEKASI<br>PROVINSI JAWA BARAT', 'Lambang_Kabupaten_Tanggamus.png', 'Jl. Chairil Anwar No.25 Margahayu Bekasi Timur Kota Bekasi, Jawa Barat 17113', '(021) 88342741', '-', 'SELAMAT DATANG DI ATR - BPN KOTA BEKASI', '2Yz6DylfdvE', '[{\"no_loket\":\"1\",\"nama_loket\":\"1\",\"handle_type_antrian\":\"[\\\"A\\\"]\"},{\"no_loket\":\"2\",\"nama_loket\":\"2\",\"handle_type_antrian\":\"[\\\"B\\\"]\"},{\"no_loket\":\"3\",\"nama_loket\":\"3\",\"handle_type_antrian\":\"[\\\"C\\\"]\"}]', '[{\"type_antrian\":\"NON KUASA (PRIORITAS)\",\"code_antrian\":\"A\"},{\"type_antrian\":\"KUASA\",\"code_antrian\":\"B\"},{\"type_antrian\":\"PENYERAHAN\",\"code_antrian\":\"C\"}]', '#00a30b', '#c39292', '#6083a9', '#b4e9cf', '#ffffff', '[{\"ip_komputer_printer\":\"172.24.45.27\",\"port_komputer_printer\":\"3000\"}]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `queue_antrian_admisi`
--
ALTER TABLE `queue_antrian_admisi`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `Fk_queue_antrian_admisi_type` (`code_antrian`);

--
-- Indexes for table `queue_penggilan_antrian`
--
ALTER TABLE `queue_penggilan_antrian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fk_antrian` (`antrian`);

--
-- Indexes for table `queue_setting`
--
ALTER TABLE `queue_setting`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `queue_antrian_admisi`
--
ALTER TABLE `queue_antrian_admisi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `queue_penggilan_antrian`
--
ALTER TABLE `queue_penggilan_antrian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `queue_setting`
--
ALTER TABLE `queue_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
