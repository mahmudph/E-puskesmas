-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 05, 2020 at 03:44 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_puskesmas`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(146, '2020-07-27-065618', 'App\\Database\\Migrations\\TblUser', 'default', 'App', 1599281129, 1),
(147, '2020-07-27-065723', 'App\\Database\\Migrations\\TblPuskesmas', 'default', 'App', 1599281129, 1),
(148, '2020-07-27-071927', 'App\\Database\\Migrations\\TblPendaftaran', 'default', 'App', 1599281129, 1),
(149, '2020-07-27-072650', 'App\\Database\\Migrations\\TblAntrian', 'default', 'App', 1599281129, 1),
(150, '2020-08-30-053302', 'App\\Database\\Migrations\\TblLaporan', 'default', 'App', 1599281129, 1),
(151, '2020-08-30-054029', 'App\\Database\\Migrations\\TblLaporanPasien', 'default', 'App', 1599281129, 1),
(152, '2020-09-03-134336', 'App\\Database\\Migrations\\TblPengumuman', 'default', 'App', 1599281129, 1),
(153, '2020-09-03-150901', 'App\\Database\\Migrations\\TblPenerimaPengumuman', 'default', 'App', 1599281129, 1),
(154, '2020-09-05-053750', 'App\\Database\\Migrations\\TblSettingAntrian', 'default', 'App', 1599284428, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_antrians`
--

CREATE TABLE `tbl_antrians` (
  `id` int(6) NOT NULL,
  `id_pendaftaran` int(6) NOT NULL,
  `no_antrian` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_antrians`
--

INSERT INTO `tbl_antrians` (`id`, `id_pendaftaran`, `no_antrian`) VALUES
(2, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laporans`
--

CREATE TABLE `tbl_laporans` (
  `id` int(6) NOT NULL,
  `id_puskesmas` int(6) NOT NULL,
  `tgl_laporan` datetime(6) NOT NULL,
  `status_baca` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_laporans`
--

INSERT INTO `tbl_laporans` (`id`, `id_puskesmas`, `tgl_laporan`, `status_baca`) VALUES
(13, 1, '2020-09-05 00:00:00.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laporan_pasiens`
--

CREATE TABLE `tbl_laporan_pasiens` (
  `id` int(6) UNSIGNED NOT NULL,
  `id_laporan` int(6) NOT NULL,
  `id_pendaftar` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_laporan_pasiens`
--

INSERT INTO `tbl_laporan_pasiens` (`id`, `id_laporan`, `id_pendaftar`) VALUES
(16, 13, 8),
(17, 13, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendaftarans`
--

CREATE TABLE `tbl_pendaftarans` (
  `id` int(6) NOT NULL,
  `id_user` int(6) NOT NULL,
  `id_puskesmas` int(6) NOT NULL,
  `tgl_daftar` datetime(6) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `tgl_digunakan` datetime(6) DEFAULT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_pendaftarans`
--

INSERT INTO `tbl_pendaftarans` (`id`, `id_user`, `id_puskesmas`, `tgl_daftar`, `nama`, `no_hp`, `tgl_digunakan`, `keterangan`) VALUES
(8, 3, 1, '2020-09-05 00:00:00.000000', 'andika', '085269337753', '2020-09-26 00:00:00.000000', 'aku daftar'),
(9, 2, 1, '2020-09-02 00:00:00.000000', 'mahmud', '08555555', '2020-09-11 00:00:00.000000', 'konsultasi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penerima_pengumumans`
--

CREATE TABLE `tbl_penerima_pengumumans` (
  `id` int(6) NOT NULL,
  `id_puskes` int(6) NOT NULL,
  `id_pengumuman` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_penerima_pengumumans`
--

INSERT INTO `tbl_penerima_pengumumans` (`id`, `id_puskes`, `id_pengumuman`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengumumans`
--

CREATE TABLE `tbl_pengumumans` (
  `id` int(6) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `tgl_pengumuman` datetime(6) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_pengumumans`
--

INSERT INTO `tbl_pengumumans` (`id`, `judul`, `tgl_pengumuman`, `isi`) VALUES
(1, 'pengumpulan datat', '2020-09-05 00:00:00.000000', 'sdfsldflsdfajsdflsd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_puskesmas`
--

CREATE TABLE `tbl_puskesmas` (
  `id` int(6) NOT NULL,
  `nama_puskesmas` varchar(50) NOT NULL,
  `alamat_puskesmas` text NOT NULL,
  `status` varchar(11) NOT NULL,
  `token_aktifasi` varchar(25) NOT NULL,
  `admin_puskesmas` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_puskesmas`
--

INSERT INTO `tbl_puskesmas` (`id`, `nama_puskesmas`, `alamat_puskesmas`, `status`, `token_aktifasi`, `admin_puskesmas`) VALUES
(1, 'makarti jaya', 'makrti jaya jalan senopati ', 'belum terak', '6eea9b7ef19179a06954edd0f', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting_antrians`
--

CREATE TABLE `tbl_setting_antrians` (
  `id` int(6) NOT NULL,
  `id_puskes` int(6) NOT NULL,
  `jmlh_antrian` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_setting_antrians`
--

INSERT INTO `tbl_setting_antrians` (`id`, `id_puskes`, `jmlh_antrian`) VALUES
(1, 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(6) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tgl_lahir` datetime(6) NOT NULL,
  `desa` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `user_level` int(1) NOT NULL DEFAULT '3',
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `nama`, `email`, `jenis_kelamin`, `tgl_lahir`, `desa`, `alamat`, `user_level`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'L', '2000-02-15 00:00:00.000000', '', 'palembang city', 1, '$2y$10$t9ELaEA4V2gdCL841jM2oOrdmgUtIUUDjoKq3Xs1GCV'),
(2, 'mahmudbae', 'mahmud@gmail.com', 'p', '2020-09-12 00:00:00.000000', 'pandowo harjo', 'pandowo harjo', 3, '$2y$10$aW5AUwJddYrqzZQPazTwde0pJSk3fQqrcoUPQM9Rnuc'),
(3, 'andikabae', 'andika@gmail.com', 'p', '2020-09-12 00:00:00.000000', 'pandowo harjo', 'dusun 2 desa pandowo harjo', 3, '$2y$10$L11iThBKeDw5Ng.ZKso.BeDMSqnRLdSK8x5kfH2G9O4'),
(4, 'adminbae', 'adminbae@gmail.com', 'p', '2020-12-03 00:00:00.000000', 'pandowo harjo', 'makrti jaya', 2, '$2y$10$xLpvUp0/LW5xHlW9YQ6TpupRlk8Auc2zs7knHLT7FSK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_antrians`
--
ALTER TABLE `tbl_antrians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_antrians_id_pendaftaran_foreign` (`id_pendaftaran`);

--
-- Indexes for table `tbl_laporans`
--
ALTER TABLE `tbl_laporans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_laporans_id_puskesmas_foreign` (`id_puskesmas`);

--
-- Indexes for table `tbl_laporan_pasiens`
--
ALTER TABLE `tbl_laporan_pasiens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_laporan_pasiens_id_laporan_foreign` (`id_laporan`),
  ADD KEY `tbl_laporan_pasiens_id_pendaftar_foreign` (`id_pendaftar`);

--
-- Indexes for table `tbl_pendaftarans`
--
ALTER TABLE `tbl_pendaftarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_pendaftarans_id_user_foreign` (`id_user`),
  ADD KEY `tbl_pendaftarans_id_puskesmas_foreign` (`id_puskesmas`);

--
-- Indexes for table `tbl_penerima_pengumumans`
--
ALTER TABLE `tbl_penerima_pengumumans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_penerima_pengumumans_id_puskes_foreign` (`id_puskes`),
  ADD KEY `tbl_penerima_pengumumans_id_pengumuman_foreign` (`id_pengumuman`);

--
-- Indexes for table `tbl_pengumumans`
--
ALTER TABLE `tbl_pengumumans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_puskesmas`
--
ALTER TABLE `tbl_puskesmas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_puskesmas_admin_puskesmas_foreign` (`admin_puskesmas`);

--
-- Indexes for table `tbl_setting_antrians`
--
ALTER TABLE `tbl_setting_antrians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_setting_antrians_id_puskes_foreign` (`id_puskes`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `tbl_antrians`
--
ALTER TABLE `tbl_antrians`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_laporans`
--
ALTER TABLE `tbl_laporans`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_laporan_pasiens`
--
ALTER TABLE `tbl_laporan_pasiens`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_pendaftarans`
--
ALTER TABLE `tbl_pendaftarans`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_penerima_pengumumans`
--
ALTER TABLE `tbl_penerima_pengumumans`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_pengumumans`
--
ALTER TABLE `tbl_pengumumans`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_puskesmas`
--
ALTER TABLE `tbl_puskesmas`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_setting_antrians`
--
ALTER TABLE `tbl_setting_antrians`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_antrians`
--
ALTER TABLE `tbl_antrians`
  ADD CONSTRAINT `tbl_antrians_id_pendaftaran_foreign` FOREIGN KEY (`id_pendaftaran`) REFERENCES `tbl_pendaftarans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_laporans`
--
ALTER TABLE `tbl_laporans`
  ADD CONSTRAINT `tbl_laporans_id_puskesmas_foreign` FOREIGN KEY (`id_puskesmas`) REFERENCES `tbl_puskesmas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_laporan_pasiens`
--
ALTER TABLE `tbl_laporan_pasiens`
  ADD CONSTRAINT `tbl_laporan_pasiens_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `tbl_laporans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_laporan_pasiens_id_pendaftar_foreign` FOREIGN KEY (`id_pendaftar`) REFERENCES `tbl_pendaftarans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pendaftarans`
--
ALTER TABLE `tbl_pendaftarans`
  ADD CONSTRAINT `tbl_pendaftarans_id_puskesmas_foreign` FOREIGN KEY (`id_puskesmas`) REFERENCES `tbl_puskesmas` (`id`),
  ADD CONSTRAINT `tbl_pendaftarans_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `tbl_penerima_pengumumans`
--
ALTER TABLE `tbl_penerima_pengumumans`
  ADD CONSTRAINT `tbl_penerima_pengumumans_id_pengumuman_foreign` FOREIGN KEY (`id_pengumuman`) REFERENCES `tbl_pengumumans` (`id`),
  ADD CONSTRAINT `tbl_penerima_pengumumans_id_puskes_foreign` FOREIGN KEY (`id_puskes`) REFERENCES `tbl_puskesmas` (`id`);

--
-- Constraints for table `tbl_puskesmas`
--
ALTER TABLE `tbl_puskesmas`
  ADD CONSTRAINT `tbl_puskesmas_admin_puskesmas_foreign` FOREIGN KEY (`admin_puskesmas`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `tbl_setting_antrians`
--
ALTER TABLE `tbl_setting_antrians`
  ADD CONSTRAINT `tbl_setting_antrians_id_puskes_foreign` FOREIGN KEY (`id_puskes`) REFERENCES `tbl_puskesmas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
