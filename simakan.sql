-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 17, 2022 at 10:57 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simakan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_nip` varchar(30) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_role` varchar(50) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 99,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 99,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_nip`, `admin_name`, `admin_password`, `admin_role`, `is_active`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, '12126951', 'Widiyanto Ramadhan', '9cd0430b6db2b011b1d6a81dc1dd5c6c', 'Kepala Sekolah', 1, 99, '2022-09-04 23:17:40', 1, '2022-09-06 18:07:27'),
(99, 'sa', 'Super Admin', 'sa', 'Super Admin', 1, 99, '2022-09-04 23:18:52', 99, '2022-09-04 23:18:52');

-- --------------------------------------------------------

--
-- Table structure for table `angket`
--

CREATE TABLE `angket` (
  `angket_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `angket_title` varchar(100) NOT NULL,
  `angket_description` text NOT NULL,
  `angket_start_date` datetime NOT NULL DEFAULT current_timestamp(),
  `angket_end_date` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 99,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 99,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `angket`
--

INSERT INTO `angket` (`angket_id`, `category_id`, `angket_title`, `angket_description`, `angket_start_date`, `angket_end_date`, `is_active`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 1, 'Angket Izin Pembelajaran Offline', 'Angket untuk izin pembelajaran offline di sekolah', '2022-09-05 02:33:39', '2022-09-05 02:33:39', 1, 99, '2022-09-05 02:33:39', 99, '2022-09-05 02:33:39'),
(2, 2, 'Instrumen Kinerja Guru', 'Angket untuk menilai kinerja guru', '2022-09-05 02:33:39', '2022-09-05 02:33:39', 1, 99, '2022-09-05 02:33:39', 99, '2022-09-05 02:33:39'),
(3, 2, 'Angket Minat Belajar Siswa', 'Angket untuk melihat minat belajar siswa di sekolah', '2022-09-05 02:34:15', '2022-09-05 02:34:15', 0, 99, '2022-09-05 02:34:15', 99, '2022-09-05 02:34:15'),
(4, 1, 'Izin Pelaksanaan Lomba 17 Agustus', 'Angket untuk izin pelaksanaan lomba 17 agustus di sekolah', '2022-09-07 02:34:15', '2022-09-30 00:00:00', 1, 99, '2022-09-05 02:34:15', 99, '2022-09-05 02:34:15'),
(9, 1, 'Test Angket', 'Deskripsi Angket', '2022-09-08 00:00:00', '2022-09-08 00:00:00', 1, 1, '2022-09-06 01:13:25', 1, '2022-09-06 02:00:36'),
(10, 1, 'Angket Baru', 'Ini adalah angket baru', '2022-09-08 00:00:00', '2022-09-30 00:00:00', 0, 1, '2022-09-08 13:57:39', 1, '2022-09-08 13:57:39'),
(11, 2, 'Test Angket 2', 'angket 2 testing ajah', '2022-09-08 00:00:00', '2022-09-30 00:00:00', 0, 1, '2022-09-08 14:12:21', 1, '2022-09-08 14:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `answer_id` int(11) NOT NULL,
  `angket_id` int(11) NOT NULL,
  `questionner_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `answer_value` varchar(1) NOT NULL,
  `score` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answer_id`, `angket_id`, `questionner_id`, `siswa_id`, `answer_value`, `score`, `is_active`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(4, 4, 7, 1, 'A', 8, 1, 1, '2022-09-07 23:18:23', 1, '2022-09-17 15:50:47'),
(5, 4, 8, 1, 'D', 10, 1, 1, '2022-09-07 23:22:56', 1, '2022-09-17 15:51:06'),
(6, 10, 9, 1, 'A', 0, 1, 1, '2022-09-08 14:03:55', 1, '2022-09-08 14:03:55'),
(7, 10, 10, 1, 'C', 0, 1, 1, '2022-09-08 14:03:59', 1, '2022-09-08 14:03:59'),
(8, 11, 11, 1, 'A', 0, 1, 1, '2022-09-08 14:13:10', 1, '2022-09-08 14:13:10'),
(9, 11, 12, 1, 'B', 0, 1, 1, '2022-09-08 14:13:13', 1, '2022-09-08 14:13:13'),
(10, 1, 13, 1, 'B', 4, 1, 1, '2022-09-17 15:42:14', 1, '2022-09-17 15:44:49');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_description` text NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 99,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 99,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `is_active`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Kesiswaan', 'Kesiswaan', 1, 99, '2022-09-05 02:59:17', 99, '2022-09-05 02:59:17'),
(2, 'Pengajaran', 'Pengajaran', 1, 99, '2022-09-05 02:59:50', 99, '2022-09-05 02:59:50');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `class_description` text NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 99,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 99,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `class_name`, `class_description`, `is_active`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'IX', 'IX', 1, 99, '2022-09-05 03:21:57', 99, '2022-09-05 03:21:57'),
(2, 'X', 'X', 1, 99, '2022-09-05 03:21:57', 99, '2022-09-05 03:21:57'),
(3, 'XI', 'XI', 1, 99, '2022-09-05 03:22:07', 99, '2022-09-05 03:22:07');

-- --------------------------------------------------------

--
-- Table structure for table `evaluasi`
--

CREATE TABLE `evaluasi` (
  `evaluasi_id` int(11) NOT NULL,
  `evaluasi_title` varchar(100) NOT NULL,
  `evaluasi_description` text NOT NULL,
  `angket_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 99,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 99,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `evaluasi`
--

INSERT INTO `evaluasi` (`evaluasi_id`, `evaluasi_title`, `evaluasi_description`, `angket_id`, `is_active`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(2, 'Kinerja guru harus lebih ditingkatkan', 'Kinerja guru harus lebih ditingkatkan lebih lanjut agar terlaksana pembelajaran yang kondusif', 2, 1, 1, '2022-09-08 04:40:46', 1, '2022-09-08 04:40:46');

-- --------------------------------------------------------

--
-- Table structure for table `questionner`
--

CREATE TABLE `questionner` (
  `questionner_id` int(11) NOT NULL,
  `angket_id` int(11) NOT NULL,
  `questionner_title` text NOT NULL,
  `questionner_type` enum('pg','essay') NOT NULL,
  `option_a` varchar(100) NOT NULL,
  `option_b` varchar(100) NOT NULL,
  `option_c` varchar(100) NOT NULL,
  `option_d` varchar(100) NOT NULL,
  `option_e` varchar(100) NOT NULL,
  `score_a` int(11) NOT NULL,
  `score_b` int(11) NOT NULL,
  `score_c` int(11) NOT NULL,
  `score_d` int(11) NOT NULL,
  `score_e` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 99,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 99,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questionner`
--

INSERT INTO `questionner` (`questionner_id`, `angket_id`, `questionner_title`, `questionner_type`, `option_a`, `option_b`, `option_c`, `option_d`, `option_e`, `score_a`, `score_b`, `score_c`, `score_d`, `score_e`, `is_active`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(6, 1, 'Apakah Anda setuju dengan pembelajaran offline?', 'pg', 'Ya, Setuju', 'Tidak Setuju', '', '', '', 0, 0, 0, 0, 0, 1, 1, '2022-09-07 00:24:49', 1, '2022-09-07 00:24:49'),
(7, 4, 'Apakah yang dimaksud dengan mobile dev?', 'pg', 'Pembuat aplikais mobile', 'Pengarang handal', 'Testing jawaban', 'Gatau ah males pengen beli trek', 'Jawabannya ada diujung langit', 8, 10, 5, 6, 6, 1, 1, '2022-09-07 04:40:24', 1, '2022-09-07 04:40:24'),
(8, 4, 'Apakah Setuju dengan lomba 17an?', 'pg', 'Ya, setuju', 'Tidak setuju', '', '', '', 10, 3, 2, 10, 0, 1, 1, '2022-09-07 18:27:05', 1, '2022-09-07 18:27:05'),
(9, 10, 'Test pertanyaan', 'pg', 'ok', 'yes', 'no', '', '', 0, 0, 0, 0, 0, 1, 1, '2022-09-08 13:58:06', 1, '2022-09-08 13:58:06'),
(10, 10, 'test pertanyaan ?', 'pg', 'jawaban a', 'jawaban b', 'jawaban c', 'jawaban d', 'jawaban e', 0, 0, 0, 0, 0, 1, 1, '2022-09-08 13:58:21', 1, '2022-09-08 13:58:21'),
(11, 11, 'test pertanyaan ?', 'pg', 'jawaban a', 'jawaban b', 'jawaban c', 'jawaban d', 'jawaban e', 0, 0, 0, 0, 0, 1, 1, '2022-09-08 14:12:34', 1, '2022-09-08 14:12:34'),
(12, 11, 'qwerty ?', 'pg', 'Ya, setuju', 'Tidak setuju', '', '', '', 0, 0, 0, 0, 0, 1, 1, '2022-09-08 14:12:48', 1, '2022-09-08 14:12:48'),
(13, 1, 'test', 'pg', 'jawaban a', 'jawaban b', 'jawaban c', 'jawaban d', 'jawaban e', 10, 4, 7, 6, 3, 1, 1, '2022-09-17 15:12:22', 1, '2022-09-17 15:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `responden`
--

CREATE TABLE `responden` (
  `responden_id` int(11) NOT NULL,
  `angket_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `is_doing` int(11) NOT NULL DEFAULT 0,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 99,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 99,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `responden`
--

INSERT INTO `responden` (`responden_id`, `angket_id`, `siswa_id`, `is_doing`, `is_active`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(10, 1, 1, 0, 1, 99, '2022-09-06 22:19:37', 99, '2022-09-06 22:19:37'),
(11, 1, 2, 1, 1, 99, '2022-09-06 22:19:37', 99, '2022-09-06 22:19:37'),
(12, 9, 1, 1, 1, 99, '2022-09-06 22:19:37', 1, '2022-09-08 01:12:38'),
(13, 9, 2, 0, 1, 99, '2022-09-06 22:19:37', 99, '2022-09-06 22:19:37'),
(14, 4, 1, 2, 1, 99, '2022-09-07 02:50:00', 1, '2022-09-07 23:47:52'),
(15, 10, 1, 1, 1, 99, '2022-09-08 13:58:27', 1, '2022-09-08 14:09:35'),
(16, 11, 1, 2, 1, 99, '2022-09-08 14:12:53', 1, '2022-09-08 14:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `siswa_id` int(11) NOT NULL,
  `siswa_nis` varchar(30) NOT NULL,
  `siswa_name` varchar(100) NOT NULL,
  `class_id` int(11) NOT NULL,
  `siswa_email` varchar(100) NOT NULL,
  `siswa_phone_number` varchar(15) NOT NULL,
  `siswa_password` varchar(100) NOT NULL,
  `siswa_images` varchar(100) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 99,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 99,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`siswa_id`, `siswa_nis`, `siswa_name`, `class_id`, `siswa_email`, `siswa_phone_number`, `siswa_password`, `siswa_images`, `is_active`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, '12123232', 'Widi Ramadhan', 1, 'widi@test.com', '083815613839', '9cd0430b6db2b011b1d6a81dc1dd5c6c', 'team-3.jpg', 1, 99, '2022-09-05 03:22:43', 1, '2022-09-08 02:51:57'),
(2, '12123233', 'Budi Dermawan', 1, 'budi@test.com', '083815613839', '9cd0430b6db2b011b1d6a81dc1dd5c6c', 'team-2.jpg', 1, 99, '2022-09-05 03:22:43', 99, '2022-09-05 03:22:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `angket`
--
ALTER TABLE `angket`
  ADD PRIMARY KEY (`angket_id`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `evaluasi`
--
ALTER TABLE `evaluasi`
  ADD PRIMARY KEY (`evaluasi_id`);

--
-- Indexes for table `questionner`
--
ALTER TABLE `questionner`
  ADD PRIMARY KEY (`questionner_id`);

--
-- Indexes for table `responden`
--
ALTER TABLE `responden`
  ADD PRIMARY KEY (`responden_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`siswa_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `angket`
--
ALTER TABLE `angket`
  MODIFY `angket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `evaluasi`
--
ALTER TABLE `evaluasi`
  MODIFY `evaluasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questionner`
--
ALTER TABLE `questionner`
  MODIFY `questionner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `responden`
--
ALTER TABLE `responden`
  MODIFY `responden_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `siswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
