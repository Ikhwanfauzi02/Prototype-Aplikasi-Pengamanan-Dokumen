-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 12:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kriptografi`
--

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id_file` int(11) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `file_name_source` varchar(255) DEFAULT NULL,
  `file_name_finish` varchar(255) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `file_size` float DEFAULT NULL,
  `password` varchar(16) DEFAULT NULL,
  `tgl_upload` timestamp NULL DEFAULT NULL,
  `status` enum('1','2') DEFAULT NULL,
  `waktu` varchar(6) DEFAULT NULL,
  `waktu_2` varchar(6) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `kunci` varchar(200) DEFAULT NULL,
  `kunci_tes` varchar(16) DEFAULT NULL,
  `password_tes` varchar(200) DEFAULT NULL,
  `tes_ava` varchar(20) DEFAULT NULL,
  `tes_en` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id_file`, `username`, `file_name_source`, `file_name_finish`, `file_url`, `file_size`, `password`, `tgl_upload`, `status`, `waktu`, `waktu_2`, `keterangan`, `kunci`, `kunci_tes`, `password_tes`, `tes_ava`, `tes_en`) VALUES
(55, 'admin', '5024-absensi-pengajian-mahasiswa.xlsx', '38367-absensi-pengajian-mahasiswa.rda', 'file_encrypt/38367-absensi-pengajian-mahasiswa.rda', 10.9014, 'c82e9e75b57970fb', '2024-07-20 01:22:59', '2', '0.3335', '0.3402', 'Fauzie031202', 'Fauzie031202', '3e8e160df2ae08ca', 'dobleh23412', '48.721794412607', '6.0469054612459'),
(56, 'admin', '28722-pdf-perhitungan-manualisasi-algoritma-aes.docx', '5000-pdf-perhitungan-manualisasi-algoritma-aes.rda', 'file_encrypt/5000-pdf-perhitungan-manualisasi-algoritma-aes.rda', 264.77, 'c82e9e75b57970fb', '2024-07-20 01:28:26', '2', '7.4865', '7.8771', 'Fauzie031202', 'Fauzie031202', '', '', '', ''),
(57, 'admin', '38499-bakso-bulat-dadakan-di-gorenganya.pptx', '80595-bakso-bulat-dadakan-di-gorenganya.rda', 'file_encrypt/80595-bakso-bulat-dadakan-di-gorenganya.rda', 116.525, 'c82e9e75b57970fb', '2024-07-20 01:31:09', '2', '3.2669', '3.7500', 'Fauzie031202', 'Fauzie031202', '', '', '', ''),
(58, 'admin', '66734-keamnan-data-dengan-aes.pdf', '53612-keamnan-data-dengan-aes.rda', 'file_encrypt/53612-keamnan-data-dengan-aes.rda', 798.05, 'c82e9e75b57970fb', '2024-07-20 01:35:21', '2', '21.767', '20.429', 'Fauzie031202', 'Fauzie031202', '', '', '', ''),
(59, 'admin', '61147-4067-13340-1-pb.pdf', '54526-4067-13340-1-pb.rda', 'file_encrypt/54526-4067-13340-1-pb.rda', 335.294, '2140fe317ddf3668', '2024-07-21 07:24:10', '2', '9.2384', '8.8328', 'kuncinya baksobulat221', 'baksobulat221', '70b954d88ca4795b', 'baksobulatdadakan21', '50.017293152057', '3.5849625007212'),
(60, 'admin', '69583-book1.xlsx', '19053-book1.rda', 'file_encrypt/19053-book1.rda', 10.3516, '25d55ad283aa400a', '2024-07-21 11:46:00', '2', '0.3897', '0.3868', '12345678', '12345678', '', '', '', ''),
(61, 'admin', '17843-4067-13340-1-pb-(2).pdf', '77801-4067-13340-1-pb-(2).rda', 'file_encrypt/77801-4067-13340-1-pb-(2).rda', 335.297, '2140fe317ddf3668', '2024-07-21 16:21:18', '1', '9.6038', '', 'baksobulat221', 'baksobulat221', '', '', '', ''),
(62, 'admin', '71979-tugas-akhir.docx', '83032-tugas-akhir.rda', 'file_encrypt/83032-tugas-akhir.rda', 12.1523, 'f893886220d9033b', '2024-07-22 02:17:10', '1', '0.4952', '', 'kuncinya fauziwae221', 'fauziwae221', '', '', '', ''),
(63, 'admin', '74644-5024-absensi-pengajian-mahasiswa.xlsx', '40697-5024-absensi-pengajian-mahasiswa.rda', 'file_encrypt/40697-5024-absensi-pengajian-mahasiswa.rda', 10.9062, '25d55ad283aa400a', '2024-07-26 18:02:14', '2', '0.3462', '0.3335', '12345678', '12345678', '', '', '', '6.1184186002246'),
(64, 'user', '64363-baksobulatdadakan.docx', '8759-baksobulatdadakan.rda', 'file_encrypt/8759-baksobulatdadakan.rda', 11.8535, '25d55ad283aa400a', '2024-07-28 05:24:08', '1', '0.6971', '', '12345678', '12345678', '432f45b44c432414', '12345678910', '49.183753293808', ''),
(65, 'user', '54349-kuis.docx', '31590-kuis.rda', 'file_encrypt/31590-kuis.rda', 13.582, '25d55ad283aa400a', '2024-07-28 05:25:38', '1', '0.4390', '', '12345678', '12345678', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(15) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `job_title` varchar(50) DEFAULT NULL,
  `join_date` timestamp NULL DEFAULT NULL,
  `last_activity` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `fullname`, `job_title`, `join_date`, `last_activity`) VALUES
('user', 'ee11cbb19052e40b07aac0ca060c23ee', 'Ikhwan', 'Mahasiswa', '2017-04-28 08:48:55', '2024-07-28 10:03:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id_file`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
