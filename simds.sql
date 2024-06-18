-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 09:18 AM
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
-- Database: `simds`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `teacher_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `user_id`, `nama`, `teacher_id`) VALUES
(1, 10, 'Toni Spd.Mpd.', '123456789'),
(2, 16, '', ''),
(3, 18, '', ''),
(4, 20, '', ''),
(5, 22, '', ''),
(6, 25, '', ''),
(7, 27, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_mengajar`
--

CREATE TABLE `jadwal_mengajar` (
  `id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `hari` varchar(255) NOT NULL,
  `jam` varchar(255) NOT NULL,
  `mapel` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_mengajar`
--

INSERT INTO `jadwal_mengajar` (`id`, `guru_id`, `hari`, `jam`, `mapel`, `kelas`) VALUES
(1, 1, 'Senin', '07:00 - 09:00', 'Bahasa Indonesia', '9B'),
(2, 1, 'Senin', '09:00 - 11:00', 'IPA', '9B'),
(3, 1, 'Senin', '12:30 - 14:30', 'Matematika', '9B'),
(4, 1, 'Selasa', '07:00 - 09:00', 'Bahasa Inggris', '9B'),
(5, 1, 'Selasa', '09:00 - 11:00', 'PJOK', '9B'),
(6, 1, 'Selasa', '12:30 - 14:30', 'IPS', '9B'),
(7, 1, 'Rabu', '07:00 - 09:00', 'Matematika', '9B'),
(8, 1, 'Rabu', '09:00 - 11:00', 'PPKN', '9B'),
(9, 1, 'Rabu', '12:30 - 14:30', 'Seni Budaya', '9B'),
(10, 1, 'Kamis', '07.00 - 09.00', 'IPA', '9B'),
(11, 1, 'Kamis', '09.00 - 11.00', 'IPS', '9B'),
(12, 1, 'Kamis', '12.30 - 14.30', 'Bahasa indonesia', '9B'),
(13, 1, 'Jumat', '07.00 - 09.00', 'PPKN', '9B'),
(14, 1, 'Jumat', '09.00 - 11.00', 'Pendidikan Agama', '9B');

-- --------------------------------------------------------

--
-- Table structure for table `lapor`
--

CREATE TABLE `lapor` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `laporan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lapor`
--

INSERT INTO `lapor` (`id`, `email`, `judul`, `laporan`) VALUES
(1, 'adyatmakevin@gmail.com', 'bug cetak raport', 'bug'),
(2, 'yamakun@gmail.com', 'bug cetak raport', 'bug nya adalah ketika, maka, akhirnya');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_raport`
--

CREATE TABLE `nilai_raport` (
  `id` int(11) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `mapel` varchar(255) DEFAULT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_raport`
--

INSERT INTO `nilai_raport` (`id`, `nisn`, `mapel`, `nilai`) VALUES
(1, '234325', NULL, 67),
(2, '22231', NULL, 70),
(3, '', NULL, 80),
(4, '', NULL, 0),
(5, '', NULL, 0),
(6, '22454', NULL, 78),
(7, '2253', NULL, 90),
(8, '44444', NULL, 90),
(9, '44444', 'Pendidikan Agama', 80),
(10, '44444', 'Bahasa Indonesia', 67),
(11, '44444', 'Ilmu Pengetahuan Sosial', 80),
(12, '5555', 'Pendidikan Agama', 90),
(13, '5555', 'Pendidikan Pancasila dan Kewarganegaraan', 85),
(14, '5555', 'Bahasa Indonesia', 80),
(15, '5555', 'Matematika', 87),
(16, '4555', 'Pendidikan Agama', 90),
(17, '4555', 'Pendidikan Pancasila dan Kewarganegaraan', 80),
(18, '4555', 'Bahasa Indonesia', 76),
(19, '4555', 'Matematika', 90),
(20, '353', 'Pendidikan Agama', 90),
(21, '34234', 'Bahasa Indonesia', 90);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `ttl` varchar(100) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `riwayat_penyakit` text NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `no_ijazah` varchar(50) NOT NULL,
  `nilai` varchar(20) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `alamat_ortu` text NOT NULL,
  `no_tlp_ayah` varchar(20) NOT NULL,
  `no_tlp_ibu` varchar(20) NOT NULL,
  `pekerjaan_ayah` varchar(100) NOT NULL,
  `pekerjaan_ibu` varchar(100) NOT NULL,
  `pendidikan_ayah` varchar(50) NOT NULL,
  `pendidikan_ibu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nama`, `nisn`, `nik`, `alamat`, `ttl`, `agama`, `riwayat_penyakit`, `asal_sekolah`, `alamat_sekolah`, `no_ijazah`, `nilai`, `nama_ayah`, `nama_ibu`, `alamat_ortu`, `no_tlp_ayah`, `no_tlp_ibu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `pendidikan_ayah`, `pendidikan_ibu`) VALUES
(1, 'Fasi', '22231', '51212732', 'asc', 'Situbondo 2 mei 2004', 'asd', 'asc', 'asd', 'asc', '1231', '12', 'asdad', 'asda', 'qas', '1231', '123', 'adads', 'dvs', 'dasds', 'dasds'),
(2, 'Fadil', '234325', '12312', 'Situbondo', 'Situbondo 2 mei 2004', 'islam', 'Tidak ada', 'SMAN 1 BESUKI', 'Besuki', '4323', '98', 'ayah', 'ibu', 'Situbondo', '00023', '42342', 'Pekerjaan', 'Pekerjaan', 'Pendidikan', 'Pendidikan'),
(13, 'yama', '2253', '2365375363883637', 'Gresik, Jalan veteran No 67', 'Gresik, 18 November 1999', 'islam ', 'tidak ada', 'SDN Sukolilo 34', 'Sukolilo, pasar gelap No 34', '367353356363', '80', 'Yanto', 'Nur', 'Gedangan, jalan anggrek no 56', '08367356536', '08265336334', 'karyawan swasta', 'ibu rumah tangga', 'SMA Sederajat', 'SMA Sederajat'),
(14, 'udin', '44444', '3768363373', 'Bojonegoro, kalitidu no 56', 'Bojonegoro, 7 Maret 1999', 'Islam', 'Tidak ada ', 'fasa', '2342342', '42342342', '87', '4353', '34534', '345345', '45345', '45345', 'pekerjaan', 'pekerjaan', 'pendidikan', 'pendidikan'),
(19, 'nana', '34234', '44444444', 'alamat', '543', 'islam', 'tidak ada', 'asal', 'alamay', '6545', '99', 'asa', 'sed', 'dasdasd', '67576', '67575', 'ada', 'ada', 'adaada', 'bnasas');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('siswa','guru','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'yama@gmail.com', '123', 'admin'),
(5, 'Adyatma', '$2y$10$ftmKVWGqDC8Fsm/dhUFBzu6YqucxEFdsjcH2vO1hZ0N79ZnvyN.Py', 'siswa'),
(7, 'roji', '$2y$10$ZvjNLNe.4LuBt1Ov7rCDMON2ZZDiZTs508WlJHKHTUhhSVrT6uxbK', 'admin'),
(8, 'Fadil', '$2y$10$bOrZP63wg4gI8.vbRxAvI.pgxCbz/Olhv7vgLamBdyTy/5Aoyd37G', 'siswa'),
(10, 'Toni', '$2y$10$m/WNo.wNFDQxdhytHpbeU.LHNQxpc.iWEOJi8.nQKfPucUhBI2NZe', 'guru'),
(11, 'ya', '$2y$10$r8J02GtRO1ZhWHX/YkEuVuRsQfhp452VFk8vDc0h4.tojOm0Hh.O.', 'siswa'),
(12, 'yama', '$2y$10$DAynNP1AUHpMS7N.vDoGMOkDbZzhTkwrPnzJNWuJ5oB2TFii9SVju', 'siswa'),
(13, 'y', '$2y$10$ifgN9II2h49fu9BDLOc6FOnX5tVP.XUDrDy7qs2nCsOA9QgM2N3Pi', 'siswa'),
(14, 'yamakun', '$2y$10$8ZpRkaMktSb3zIUJSDWzcuJWABsa2SZvNLGcqp.JlDcURZLUvuOdi', 'siswa'),
(15, 'u', '$2y$10$kRZGsjXb9WyuwwbM7m7fXeyluv.CXyCuDVjBiwBQFc8Tgxjot1rl.', 'siswa'),
(16, 'n', '$2y$10$axrmCc7sgUJTqmtB/NMw2OxgUDkEBLsXyeo63zGYcTN12.cw8pbMq', 'guru'),
(17, 'mm', '$2y$10$Md4iAgh.Mjsz9tFfpNl2Pe3hSWzvmfqGXdldOrAU3WuCr5sSXcyB6', 'siswa'),
(18, 'h', '$2y$10$nvTM6u.pUgvD8RSZgvWJO.eo4T8orzZsaxesVJ6UYdh0pHS5lbtPG', 'guru'),
(19, 'ml', '$2y$10$nmxBzeFBDmpni/yefkZQIuPgzhmektz.3eBDd1Zu6Wcp38EdFNiPW', 'siswa'),
(20, 'kssd', '$2y$10$aH4FjAAHDp41OVdymCyAsexnW39nKGB2a4wwKSkGvrfCqp5XFO6ru', 'guru'),
(21, 'mc', '$2y$10$xgdzGvLqcAsBaf4vsniD7.eOkoB6me8V/c5eZ62VWRTDvIN/b/Wfi', 'siswa'),
(22, 'asddw', '$2y$10$.y6bqTXhnjo0RTjr2ADpN.z1pa.0MpthrxXIs4i5faWw2eAZJ5Ypq', 'guru'),
(23, 'kj', '$2y$10$DhrJjgBewQIOp2e4wgmpwOUcNT7zI0lzBFJ4cqxylRYzHUTuPo.a6', 'siswa'),
(24, 'vv', '$2y$10$FwbbQohTbD6.sxrTBNM7xuGCsETxxb0/xXBXbSPT.FkfXSH4ZiDe.', 'siswa'),
(25, 'vvr', '$2y$10$TVZ9xZ0f9BsYeIoGAypJ6.hq4fXlexEwmPkNll8iVWqKDaPAfHhrO', 'guru'),
(26, 'fff', '$2y$10$.P/epWGS9PNyGzzeDyHi3u77Ud3hBvVGfaq.ZdjQm51EaD6ubVgCy', 'siswa'),
(27, 'ng', '$2y$10$uo4a2ec4hfJjB/JUZGObEeFBzmJ4FbimB4liEco6lCccemkghjjxO', 'guru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indexes for table `lapor`
--
ALTER TABLE `lapor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_raport`
--
ALTER TABLE `nilai_raport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `lapor`
--
ALTER TABLE `lapor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nilai_raport`
--
ALTER TABLE `nilai_raport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  ADD CONSTRAINT `jadwal_mengajar_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
