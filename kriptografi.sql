-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2024 at 06:27 AM
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
(45, 'admin', '16014-skripsifullfauzi-2.docx', '80347-skripsifullfauzi-2.rda', 'file_encrypt/80347-skripsifullfauzi-2.rda', 4378.69, '4c64d4acb8d9d0da', '2024-07-18 17:52:21', '1', '151.39', '', 'baksobulat03221', 'baksobulat03221', '', '', '', ''),
(46, 'admin', '69270-skripsifullfauzi-2.docx', '7161-skripsifullfauzi-2.rda', 'file_encrypt/7161-skripsifullfauzi-2.rda', 4378.69, '4c64d4acb8d9d0da', '2024-07-18 17:54:52', '1', '144.16', '', 'baksobulat03221', 'baksobulat03221', '', '', '', ''),
(47, 'admin', '79262-skripsifullfauzi-2.docx', '52979-skripsifullfauzi-2.rda', 'file_encrypt/52979-skripsifullfauzi-2.rda', 4378.69, 'fae3fdd769e79fa7', '2024-07-18 17:55:17', '1', '144.16', '', 'dobleh221', 'dobleh221', '', '', '', ''),
(48, 'admin', '2016-skripsifullfauzi-2.docx', '16232-skripsifullfauzi-2.rda', 'file_encrypt/16232-skripsifullfauzi-2.rda', 4378.69, 'fae3fdd769e79fa7', '2024-07-18 17:57:41', '1', '23.784', '', 'dobleh221', 'dobleh221', '', '', '', ''),
(49, 'admin', '38446-tang-aes.docx', '63530-tang-aes.rda', 'file_encrypt/63530-tang-aes.rda', 834.571, '0f1898441df65ef8', '2024-07-18 18:17:21', '2', '23.784', '23.404', 'dobleh12345', 'dobleh12345', '', '', '', ''),
(50, 'admin', '71077-skripsifullfauzi-2.docx', '86456-skripsifullfauzi-2.rda', 'file_encrypt/86456-skripsifullfauzi-2.rda', 4378.69, '9e6bec4c03d1f9eb', '2024-07-19 03:30:31', '1', '122.08', '', 'dobleh123', 'dobleh123', '', '', '', ''),
(51, 'admin', '61112-aplikasi-algoritma-untuk-pengamanan-file-pengarsipan.pdf', '40134-aplikasi-algoritma-untuk-pengamanan-file-pengarsipan.rda', 'file_encrypt/40134-aplikasi-algoritma-untuk-pengamanan-file-pengarsipan.rda', 264.422, '0f1898441df65ef8', '2024-07-19 03:34:50', '1', '7.3432', '0.0009', 'dobleh12345', 'dobleh12345', '', '', '', ''),
(52, 'admin', '55428-aplikasi-algoritma-untuk-pengamanan-file-pengarsipan.pdf', '50493-aplikasi-algoritma-untuk-pengamanan-file-pengarsipan.rda', 'file_encrypt/50493-aplikasi-algoritma-untuk-pengamanan-file-pengarsipan.rda', 264.422, '0f1898441df65ef8', '2024-07-19 03:53:07', '2', '7.4036', '7.2940', 'dobleh12345', 'dobleh12345', '', '', '', ''),
(44, 'admin', '25048-absensi-pengajian-mahasiswa.xlsx', '85839-absensi-pengajian-mahasiswa.rda', 'file_encrypt/85839-absensi-pengajian-mahasiswa.rda', 10.9014, 'b6ed9c9cc0c6c8d6', '2024-07-17 06:39:40', '2', '0.3377', '0.3442', 'baksobulat21', 'baksobulat21', 'e85f95a2efc40af5', 'fauzi031202', '49.684366045845', ''),
(32, 'admin', '84391-skripsifauzifull.docx', '78141-skripsifauzifull.rda', 'file_encrypt/78141-skripsifauzifull.rda', 3998.41, 'e807f1fcf82d132f', '2024-07-17 03:44:25', '1', '1.0822', '', 'skripsi saya saya enkripsi sebelum dikirim ke dosen', '1234567890', '', '', '', ''),
(33, 'admin', '71568-cv.docx', '55725-cv.rda', 'file_encrypt/55725-cv.rda', 36.7109, '25f9e794323b4538', '2024-07-17 04:14:26', '2', '1.0822', '1.0720', 'ini file cv saya', '123456789', '70b954d88ca4795b', 'baksobulatdadakan21', '98.864361702128', '5.8818621085832'),
(34, 'admin', '24188-contoh-cv-fix.docx', '47928-contoh-cv-fix.rda', 'file_encrypt/47928-contoh-cv-fix.rda', 44.1143, 'e85f95a2efc40af5', '2024-07-17 04:22:36', '2', '1.3113', '1.2943', 'ini cv fix saya', 'fauzi031202', '70b954d88ca4795b', 'baksobulatdadakan21', '98.906692634561', '5.3061706517092'),
(35, 'admin', '37411-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.pdf', '28543-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.rda', 'file_encrypt/28543-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.rda', 654.289, '7a5809b5d39783ee', '2024-07-17 06:20:34', '1', '18.961', '', 'ujicoba', 'gojosatoru1', '', '', '', ''),
(36, 'admin', '21251-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.pdf', '20043-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.rda', 'file_encrypt/20043-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.rda', 654.289, '7a5809b5d39783ee', '2024-07-17 06:20:53', '1', '18.097', '', 'ujicoba', 'gojosatoru1', '', '', '', ''),
(37, 'admin', '6059-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.pdf', '44113-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.rda', 'file_encrypt/44113-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.rda', 654.289, '7a5809b5d39783ee', '2024-07-17 06:21:11', '1', '18.865', '', 'ujicoba', 'gojosatoru1', '70b954d88ca4795b', 'baksobulatdadakan21', '49.989160447761', ''),
(38, 'admin', '57634-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.pdf', '58219-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.rda', 'file_encrypt/58219-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.rda', 654.289, '7a5809b5d39783ee', '2024-07-17 06:21:30', '1', '19.272', '', 'ujicoba', 'gojosatoru1', '', '', '', '7.3832812896492'),
(39, 'admin', '9437-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.pdf', '88853-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.rda', 'file_encrypt/88853-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.rda', 654.289, '7a5809b5d39783ee', '2024-07-17 06:21:49', '1', '18.871', '', 'ujicoba', 'gojosatoru1', '', '', '', '7.3832812896492'),
(40, 'admin', '63041-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.pdf', '75826-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.rda', 'file_encrypt/75826-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.rda', 654.289, '7a5809b5d39783ee', '2024-07-17 06:22:08', '1', '20.108', '', 'ujicoba', 'gojosatoru1', '', '', '', ''),
(41, 'admin', '71388-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.pdf', '50211-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.rda', 'file_encrypt/50211-(aes)-pebgaman-data-pengarsipan-perpustakaan-geologi-kelautan.rda', 654.289, '7a5809b5d39783ee', '2024-07-17 06:22:28', '1', '18.910', '0.0105', 'ujicoba', 'gojosatoru1', '', '', '', ''),
(42, 'admin', '32506-aes-256-cbc-dan-bae64.pdf', '47042-aes-256-cbc-dan-bae64.rda', 'file_encrypt/47042-aes-256-cbc-dan-bae64.rda', 968.823, 'c0d697b3766003bd', '2024-07-17 06:23:43', '1', '28.070', '', 'ujicoba', 'dobleh121', '', '', '', '5.5740323386882'),
(43, 'admin', '95211-absensi-pengajian-mahasiswa.xlsx', '38613-absensi-pengajian-mahasiswa.rda', 'file_encrypt/38613-absensi-pengajian-mahasiswa.rda', 10.9014, 'c0d697b3766003bd', '2024-07-17 06:27:31', '1', '0.4960', '0.0004', 'dobleh121', 'dobleh121', '70b954d88ca4795b', 'baksobulatdadakan21', '49.946275071633', '6.3170207033398');

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
  `last_activity` timestamp NULL DEFAULT NULL,
  `status` enum('1','2') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `fullname`, `job_title`, `join_date`, `last_activity`, `status`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Ikhwan', 'Mahasiswa', '2017-04-28 08:48:55', '2024-07-19 04:26:07', '1');

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
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
