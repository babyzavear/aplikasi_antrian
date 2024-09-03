-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 25, 2024 at 04:46 AM
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
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `queue_antrian_admisi`
--

INSERT INTO `queue_antrian_admisi` (`id`, `tanggal`, `no_antrian`, `code_antrian`, `status`, `updated_date`) VALUES
(1, '2024-02-01', '001', 'A', '1', '2024-02-01 00:00:00'),
(2, '2024-02-01', '002', 'A', '1', '2024-02-01 00:00:00'),
(3, '2024-02-01', '003', 'A', '1', '2024-02-01 00:00:00'),
(4, '2024-02-01', '001', 'B', '1', '2024-02-01 00:00:00'),
(5, '2024-02-01', '004', 'A', '0', NULL),
(6, '2024-02-01', '002', 'B', '1', '2024-02-01 00:00:00'),
(7, '2024-02-01', '003', 'B', '0', NULL),
(8, '2024-02-01', '005', 'A', '0', NULL),
(9, '2024-02-01', '006', 'A', '0', NULL),
(10, '2024-02-01', '007', 'A', '0', NULL),
(11, '2024-02-01', '008', 'A', '0', NULL),
(12, '2024-02-01', '009', 'A', '0', NULL),
(13, '2024-02-01', '010', 'A', '0', NULL),
(14, '2024-02-01', '004', 'B', '0', NULL),
(15, '2024-02-01', '005', 'B', '0', NULL),
(16, '2024-02-01', '006', 'B', '0', NULL),
(17, '2024-02-01', '007', 'B', '0', NULL),
(18, '2024-02-01', '008', 'B', '0', NULL),
(19, '2024-02-01', '009', 'B', '0', NULL),
(20, '2024-02-01', '010', 'B', '0', NULL),
(21, '2024-02-01', '011', 'B', '0', NULL),
(22, '2024-02-01', '012', 'B', '0', NULL),
(23, '2024-02-01', '013', 'B', '0', NULL),
(24, '2024-02-01', '011', 'A', '0', NULL),
(25, '2024-02-01', '012', 'A', '0', NULL),
(26, '2024-02-01', '014', 'B', '0', NULL),
(27, '2024-02-01', '015', 'B', '0', NULL),
(28, '2024-02-01', '016', 'B', '0', NULL),
(29, '2024-02-01', '017', 'B', '0', NULL),
(30, '2024-02-01', '001', 'C', '0', NULL),
(31, '2024-02-01', '002', 'C', '0', NULL),
(32, '2024-02-01', '003', 'C', '0', NULL),
(33, '2024-02-13', '001', 'A', '1', '2024-02-13 00:00:00'),
(34, '2024-02-13', '001', 'B', '1', '2024-02-13 00:00:00'),
(35, '2024-02-13', '001', 'C', '0', NULL),
(36, '2024-02-13', '002', 'A', '1', '2024-02-13 00:00:00'),
(37, '2024-02-13', '003', 'A', '1', '2024-02-13 00:00:00'),
(52, '2024-08-23', '001', 'A', '1', '2024-08-23 19:05:47'),
(53, '2024-08-23', '002', 'A', '1', '2024-08-23 19:14:08'),
(54, '2024-08-23', '001', 'D', '1', '2024-08-23 22:28:06'),
(55, '2024-08-23', '001', 'B', '1', '2024-08-23 22:27:33'),
(56, '2024-08-23', '003', 'A', '1', '2024-08-23 19:26:15'),
(57, '2024-08-23', '004', 'A', '1', '2024-08-23 22:35:25'),
(58, '2024-08-23', '002', 'D', '1', '2024-08-23 22:41:55'),
(59, '2024-08-23', '002', 'B', '1', '2024-08-23 22:43:24'),
(60, '2024-08-23', '001', 'C', '0', NULL),
(62, '2024-08-24', '001', 'A', '1', '2024-08-24 15:51:41'),
(63, '2024-08-24', '001', 'B', '1', '2024-08-24 15:21:55'),
(64, '2024-08-24', '001', 'C', '1', '2024-08-24 15:54:18');

-- --------------------------------------------------------

--
-- Table structure for table `queue_penggilan_antrian`
--

CREATE TABLE `queue_penggilan_antrian` (
  `id` bigint(20) NOT NULL,
  `antrian` varchar(255) DEFAULT NULL,
  `loket` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `queue_penggilan_antrian`
--

INSERT INTO `queue_penggilan_antrian` (`id`, `antrian`, `loket`) VALUES
(60, 'A002', 'Loket 1'),
(61, 'A002', 'Loket 1'),
(62, 'A002', 'Loket 1'),
(63, 'A002', 'Loket 1'),
(64, 'A002', 'Loket 1'),
(65, 'A002', 'Loket 1'),
(66, 'A002', 'Loket 1'),
(67, 'A002', 'Loket 1'),
(68, 'A002', 'Loket 1'),
(69, 'A002', 'Loket 1'),
(70, 'A002', 'Loket 1'),
(71, 'A002', 'Loket 1'),
(72, 'A002', 'Loket 1'),
(73, 'A002', 'Loket 1'),
(74, 'A002', 'Loket 1'),
(75, 'A002', 'Loket 1'),
(76, 'A002', 'Loket 1'),
(77, 'A002', 'Loket 1'),
(78, 'A003', 'Loket 1'),
(79, 'A003', 'Loket 1'),
(80, 'A003', 'Loket 1'),
(81, 'A002', 'Loket 1'),
(82, 'A003', 'Loket 1'),
(83, 'A003', 'Loket 1'),
(84, 'A003', 'Loket 1'),
(85, 'A002', 'Loket 1'),
(86, 'A003', 'Loket 1'),
(87, 'A003', 'Loket 1'),
(88, 'A003', 'Loket 1'),
(89, 'A003', 'Loket 1'),
(90, 'A003', 'Loket 1'),
(91, 'A003', 'Loket 1'),
(92, 'A003', 'Loket 1'),
(93, 'A003', 'Loket 1'),
(94, 'A003', 'Loket 1'),
(95, 'A003', 'Loket 1'),
(96, 'A003', 'Loket 1'),
(97, 'A003', 'Loket 1'),
(98, 'A003', 'Loket 1'),
(99, 'A002', 'Loket 1'),
(100, 'A003', 'Loket 1'),
(101, 'A003', 'Loket 1'),
(102, 'A002', 'Loket 1'),
(103, 'A002', 'Loket 1'),
(104, 'A003', 'Loket 1'),
(105, 'A004', 'Loket 2'),
(106, 'A004', 'Loket 2'),
(107, 'A004', 'Loket 2'),
(108, 'A004', 'Loket 2'),
(109, 'A004', 'Loket 2'),
(110, 'A004', 'Loket 2'),
(111, 'A004', 'Loket 1'),
(112, 'A004', 'Loket 2'),
(113, 'A004', 'Loket 1'),
(114, 'A004', 'Loket 2'),
(115, 'A004', 'Loket 2'),
(116, 'A004', 'Loket 2'),
(117, 'A004', 'Loket 2'),
(118, 'A004', 'Loket 1'),
(119, 'A005', 'Loket 1'),
(120, 'A005', 'Loket 1'),
(121, 'A004', 'Loket 1'),
(122, 'A005', 'Loket 1'),
(123, 'A005', 'Loket 1'),
(124, 'A005', 'Loket 1'),
(125, 'A005', 'Loket 1'),
(126, 'A005', 'Loket 1'),
(127, 'A005', 'Loket 1'),
(128, 'A005', 'Loket 1'),
(129, 'A005', 'Loket 1'),
(130, 'A005', 'Loket 1'),
(131, 'A005', 'Loket 1'),
(132, 'A005', 'Loket 1'),
(133, 'A005', 'Loket 1'),
(134, 'A005', 'Loket 1'),
(156, 'A001', '1'),
(157, 'A001', '1'),
(158, 'B001', '2'),
(159, 'B001', '2'),
(160, 'A001', '1'),
(161, 'A001', '1'),
(162, 'A001', '1'),
(163, 'A001', '1'),
(164, 'A002', '1'),
(165, 'A002', '1'),
(166, 'A002', '1'),
(167, 'A002', '1'),
(168, 'A002', '1'),
(169, 'A002', '1'),
(170, 'A002', '1'),
(171, 'A003', '1'),
(172, 'A004', '1'),
(173, 'B001', '2'),
(174, 'B001', '2'),
(175, 'D001', '4'),
(176, 'A004', '1'),
(177, 'D002', '4'),
(178, 'D002', '4'),
(179, 'B002', '2'),
(180, 'A001', '1'),
(181, 'B001', '2'),
(182, 'C001', '4'),
(183, 'A001', '1'),
(184, 'A001', '1'),
(185, 'B001', '2'),
(186, 'B001', '2'),
(187, 'B001', '2'),
(188, 'B001', '2'),
(189, 'A001', '1'),
(190, 'C001', '4');

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
(1, 'KANTOR PERTANAHAN KOTA BEKASI<br>PROVINSI JAWA BARAT', 'Lambang_Kabupaten_Tanggamus.png', 'Jl. Chairil Anwar No.25 Margahayu Bekasi Timur Kota Bekasi, Jawa Barat 17113', '(021) 88342741', '-', 'SELAMAT DATANG DI ATR -BPN KOTA BEKASI', 'RqLI3MWotD0', '[{\"no_loket\":\"1\",\"nama_loket\":\"1\",\"handle_type_antrian\":\"[\\\"A\\\"]\"},{\"no_loket\":\"2\",\"nama_loket\":\"2\",\"handle_type_antrian\":\"[\\\"B\\\"]\"},{\"no_loket\":\"3\",\"nama_loket\":\"3\",\"handle_type_antrian\":\"[\\\"B\\\"]\"},{\"no_loket\":\"4\",\"nama_loket\":\"4\",\"handle_type_antrian\":\"[\\\"C\\\"]\"},{\"no_loket\":\"5\",\"nama_loket\":\"5\",\"handle_type_antrian\":\"[\\\"C\\\"]\"},{\"no_loket\":\"6\",\"nama_loket\":\"6\",\"handle_type_antrian\":\"[\\\"D\\\"]\"},{\"no_loket\":\"7\",\"nama_loket\":\"7\",\"handle_type_antrian\":\"[\\\"E\\\"]\"},{\"no_loket\":\"8\",\"nama_loket\":\"8\",\"handle_type_antrian\":\"[\\\"F\\\"]\"},{\"no_loket\":\"9\",\"nama_loket\":\"9\",\"handle_type_antrian\":\"[\\\"G\\\"]\"},{\"no_loket\":\"10\",\"nama_loket\":\"10\",\"handle_type_antrian\":\"[\\\"H\\\"]\"}]', '[{\"type_antrian\":\"NON KUASA (PRIORITAS)\",\"code_antrian\":\"A\"},{\"type_antrian\":\"KUASA\",\"code_antrian\":\"B\"},{\"type_antrian\":\"PENYERAHAN\",\"code_antrian\":\"C\"},{\"type_antrian\":\"PLOTTING\",\"code_antrian\":\"D\"},{\"type_antrian\":\"INFORMASI\",\"code_antrian\":\"E\"},{\"type_antrian\":\"PERJANJIAN ONLINE\",\"code_antrian\":\"F\"},{\"type_antrian\":\"KONSULTASI\",\"code_antrian\":\"G\"},{\"type_antrian\":\"PENDAFTARAN\",\"code_antrian\":\"H\"}]', '#3c94d7', '#c39292', '#6083a9', '#eff5f2', '#ffffff', '[{\"ip_komputer_printer\":\"192.168.200.189\",\"port_komputer_printer\":\"3000\"}]');

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `queue_penggilan_antrian`
--
ALTER TABLE `queue_penggilan_antrian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `queue_setting`
--
ALTER TABLE `queue_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
