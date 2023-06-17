-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2022 at 01:53 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sekolahku`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id_account` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL,
  `foto_account` varchar(225) NOT NULL,
  `hak_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id_account`, `fullname`, `username`, `password`, `foto_account`, `hak_akses`) VALUES
(1, 'Steven', 'admin', '$2y$10$XtBlu3YhuL3eYdTltHjg8.BCh25o7yjuL3TyVt4AQStscmNuWJ2ie', 'codeigniter-3-5321221.png', 0),
(2, 'Hafia Muhshona', 'hafia', '$2y$10$6y4j.3C2muM.tjg3yU/i9u7ssH5ynmd8QzMtwoMhu9fT.17eZyRVi', 'gambar-upin-ipin-dan-mei-mei-10.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `backup_data`
--

CREATE TABLE `backup_data` (
  `id_backup_data` int(11) NOT NULL,
  `name_backup_data` varchar(225) NOT NULL,
  `tanggal_backup_data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backup_data`
--

INSERT INTO `backup_data` (`id_backup_data`, `name_backup_data`, `tanggal_backup_data`) VALUES
(12, 'backup-on-15-Dec-2022 16:57:22.zip', '2022-12-15 09:57:22'),
(13, 'backup-on-15-Dec-2022 16:57:24.zip', '2022-12-15 09:57:24'),
(14, 'backup-on-15-Dec-2022 18:34:29.zip', '2022-12-15 11:34:29'),
(15, 'backup-on-16-Dec-2022 13:27:47.zip', '2022-12-16 06:27:47'),
(16, 'backup-on-16-Dec-2022 13:43:35.zip', '2022-12-16 06:43:35'),
(17, 'backup-on-16-Dec-2022 13:43:37.zip', '2022-12-16 06:43:37'),
(18, 'backup-on-16-Dec-2022 15:17:04.zip', '2022-12-16 08:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `bayar_biaya_lain`
--

CREATE TABLE `bayar_biaya_lain` (
  `id_bayar_biaya_lain` int(11) NOT NULL,
  `id_siswa_biaya_lain` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `kode_bayar_biaya_lain` varchar(50) NOT NULL,
  `jumlah_bayar_biaya_lain` int(11) NOT NULL,
  `tanggal_bayar_biaya_lain` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `operator` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bayar_biaya_lain`
--

INSERT INTO `bayar_biaya_lain` (`id_bayar_biaya_lain`, `id_siswa_biaya_lain`, `id_siswa`, `kode_bayar_biaya_lain`, `jumlah_bayar_biaya_lain`, `tanggal_bayar_biaya_lain`, `operator`) VALUES
(27, 26, 156, 'KDBBL_1671108095', 25000, '2022-12-15 12:41:35', 'Hafia Muhshona'),
(29, 28, 156, 'KDBBL_1671166292', 10000, '2022-12-16 04:51:32', 'Hafia Muhshona');

-- --------------------------------------------------------

--
-- Table structure for table `biaya_lain`
--

CREATE TABLE `biaya_lain` (
  `id_biaya_lain` int(11) NOT NULL,
  `nama_biaya_lain` varchar(50) NOT NULL,
  `harga_biaya_lain` int(11) NOT NULL,
  `tanggal_biaya_lain` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `biaya_lain`
--

INSERT INTO `biaya_lain` (`id_biaya_lain`, `nama_biaya_lain`, `harga_biaya_lain`, `tanggal_biaya_lain`) VALUES
(4, 'Uang Infak', 10000, '2022-12-16 04:49:17'),
(5, 'Maulid', 25000, '2022-12-15 12:40:51'),
(6, 'Eskul', 25000, '2022-12-15 12:40:51'),
(7, 'Study Tour', 550000, '2022-12-17 10:07:08');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL,
  `harga_spp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `harga_spp`) VALUES
(9, 'animasi', 150000),
(10, 'TKR', 140000),
(11, 'TSM', 130000),
(12, 'IPA', 120000),
(15, 'Multimedia', 130000),
(16, 'IPS', 120000),
(17, 'Tataboga', 170000);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'X'),
(2, 'XI'),
(3, 'XII');

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukkan` int(11) NOT NULL,
  `kode_pemasukan` varchar(50) NOT NULL,
  `jumlah_pemasukan` int(11) NOT NULL,
  `type_pemasukan` varchar(50) NOT NULL,
  `tanggal_pemasukan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `operator` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukkan`, `kode_pemasukan`, `jumlah_pemasukan`, `type_pemasukan`, `tanggal_pemasukan`, `operator`) VALUES
(341, 'KDS_14710', 150000, 'spp', '2022-12-14 00:13:26', 'Hafia Muhshona'),
(342, 'KDS_14711', 150000, 'spp', '2022-12-13 00:13:40', 'Hafia Muhshona'),
(343, 'KDS_14712', 150000, 'spp', '2022-12-13 00:14:24', 'Hafia Muhshona'),
(344, 'KDS_14713', 150000, 'spp', '2022-12-14 00:14:06', 'Hafia Muhshona'),
(345, 'KDBS_1567124376', 450000, 'baju seragam', '2022-12-17 10:32:36', 'Hafia Muhshona'),
(346, 'KDBBL_1567124520', 25000, 'biaya lain', '2022-12-14 00:22:00', 'Hafia Muhshona'),
(347, 'KDS_15310', 150000, 'spp', '2022-12-15 12:28:24', 'Hafia Muhshona'),
(348, 'KDS_15311', 150000, 'spp', '2022-12-15 12:28:24', 'Hafia Muhshona'),
(349, 'KDS_15312', 150000, 'spp', '2022-12-15 12:28:24', 'Hafia Muhshona'),
(350, 'KDS_15313', 150000, 'spp', '2022-12-15 12:28:24', 'Hafia Muhshona'),
(351, 'KDS_15314', 150000, 'spp', '2022-12-15 12:28:24', 'Hafia Muhshona'),
(353, 'KDBBL_1671108095', 25000, 'biaya lain', '2022-12-15 12:41:35', 'Hafia Muhshona'),
(354, 'KDS_15610', 130000, 'spp', '2022-12-15 13:08:03', 'Hafia Muhshona'),
(355, 'KDS_15611', 130000, 'spp', '2022-12-15 13:08:03', 'Hafia Muhshona'),
(356, 'KDS_15612', 130000, 'spp', '2022-12-15 13:08:03', 'Hafia Muhshona'),
(357, 'KDS_15613', 130000, 'spp', '2022-12-15 13:08:03', 'Hafia Muhshona'),
(358, 'KDS_15420', 150000, 'spp', '2022-12-16 01:42:30', 'Hafia Muhshona'),
(359, 'KDS_15421', 150000, 'spp', '2022-12-16 01:42:30', 'Hafia Muhshona'),
(360, 'KDS_15422', 150000, 'spp', '2022-12-16 01:42:30', 'Hafia Muhshona'),
(361, 'KDS_15423', 150000, 'spp', '2022-12-16 01:42:30', 'Hafia Muhshona'),
(363, 'KDBBL_1671166292', 10000, 'biaya lain', '2022-12-16 04:51:32', 'Hafia Muhshona'),
(364, 'KDS_15614', 130000, 'spp', '2022-12-19 09:55:46', 'Hafia Muhshona'),
(365, 'KDS_15615', 130000, 'spp', '2022-12-19 09:55:46', 'Hafia Muhshona'),
(366, 'KDS_15315', 150000, 'spp', '2022-12-19 10:28:13', 'Hafia Muhshona'),
(367, 'KDS_15316', 150000, 'spp', '2022-12-19 10:31:50', 'Hafia Muhshona'),
(372, 'KDS_15210', 150000, 'spp', '2022-12-19 11:49:57', 'Hafia Muhshona'),
(373, 'KDS_15211', 150000, 'spp', '2022-12-19 11:50:07', 'Hafia Muhshona'),
(374, 'KDS_15212', 150000, 'spp', '2022-12-19 11:50:07', 'Hafia Muhshona');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `jumlah_pengeluaran` int(11) NOT NULL,
  `keterangan_pengeluaran` text NOT NULL,
  `tanggal_pengeluaran` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `operator` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `jumlah_pengeluaran`, `keterangan_pengeluaran`, `tanggal_pengeluaran`, `operator`) VALUES
(20, 3000000, 'Bakti sosial', '2022-12-17 10:09:42', 'Hafia Muhshona'),
(21, 5000000, 'Santunan Yatim', '2022-12-17 10:08:09', 'Hafia Muhshona');

-- --------------------------------------------------------

--
-- Table structure for table `seragam`
--

CREATE TABLE `seragam` (
  `id_seragam` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `kode_seragam` varchar(50) NOT NULL,
  `jumlah_seragam` int(11) NOT NULL,
  `tanggal_seragam` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `operator` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `value` text NOT NULL,
  `tanggal_setting` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `name`, `value`, `tanggal_setting`) VALUES
(3, 'harga_seragam', '450000', '2019-08-03 20:31:27'),
(4, 'broadcast', 'Di beritahukan kepada seluruh siswa yang belum membayar spp bulan ini segera membayar nya', '2019-08-14 14:24:02'),
(5, 'nama_sekolah', 'SEKOLAH PINTAR', '2022-12-17 10:02:37'),
(6, 'alamat_sekolah', 'Jl.Semeru  No.14, RT.02/RW.06, Babakan, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16128', '2022-12-15 13:02:17'),
(7, 'logo_sekolah', '161.png', '2022-12-15 13:04:33'),
(9, 'email_sekolah', 'Sekolahpintar@gmail.com', '2022-12-15 13:02:17'),
(10, 'no_telp_sekolah', '087721564766', '2019-08-13 04:24:17'),
(11, 'tentang_kami', '<p>\r\n\r\n</p><p><b>A.  VISI SEKOLAH</b></p>   <b><u></u></b>  “Berprestasi dilandasi Iman, Taqwa dan Berbudaya Lingkungan serta Berwawasan Global”<b></b><p><strong>B.  MISI SEKOLAH</strong></p><p>1.   Mewujudkan pendidikan untuk menghasilkan prestasi dan lulusa berkwalitas tinggi yang peduli dengan lingkungan hidup</p><p>2.   Mewujudkan sumber daya manusia yang beriman, produktif, kreatif, inofatif dan efektif</p><p>3.   Mewujudkan pengembangan inovasi pembelajaran sesuai tuntutan</p><p>4.   Mewujudkan sumber daya manusia yang peduli dalam mencegahan pencemaran, mencegahan kerusakan lingkungan dan melestarikan lingkungan hidup</p><p>5.   Mewujudkan sarana prasarana reprensentatif dan up to date</p><p>6.   Mewujudkan pengelolaan pendidikan yang professional</p><p>7.   Mewujudkan sistim penilaian yang berafiliasi</p><p>8.   Mewujudkan budaya yang berkualifikasi</p>\r\n\r\n<br><p></p><p></p><p><br></p><p><br></p><p><br></p>', '2022-12-15 13:02:17');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nisn` varchar(100) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `beasiswa` varchar(50) NOT NULL,
  `persen_spp` int(11) NOT NULL,
  `persen_biaya_lain` int(11) NOT NULL,
  `persen_baju_seragam` int(11) NOT NULL,
  `uang_seragam` int(11) NOT NULL,
  `foto_siswa` varchar(225) NOT NULL,
  `tanggal_siswa` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nisn`, `nama_siswa`, `id_kelas`, `id_jurusan`, `tempat_lahir`, `tanggal_lahir`, `beasiswa`, `persen_spp`, `persen_biaya_lain`, `persen_baju_seragam`, `uang_seragam`, `foto_siswa`, `tanggal_siswa`) VALUES
(152, '19210574', 'Adam febri febrian', 1, 9, 'Bogor', '2003-02-14', '', 0, 0, 0, 450000, '', '2022-12-19 11:03:01'),
(153, '19210323', 'Ade putra ramadhan', 1, 9, 'Bogor', '2002-10-12', '', 0, 0, 0, 450000, '', '2022-12-19 11:17:05'),
(154, '19210293', 'Dicky  M Hikam', 2, 16, 'Garut', '2002-06-13', '', 0, 0, 0, 450000, '', '2022-12-15 10:46:14'),
(156, '19210686', 'Rodrigo Xafier Savero', 1, 15, 'Bogor', '2004-01-24', '', 0, 0, 0, 450000, '', '2022-12-19 10:59:40'),
(157, '19210315', 'Andi Farhan Maulana', 2, 15, 'Jakarta', '2003-05-31', '', 0, 0, 0, 450000, '', '2022-12-19 11:39:03'),
(158, '19210123', 'Fiki hadi setiawan', 3, 15, 'Bogor', '2001-11-12', '', 0, 0, 0, 450000, '', '2022-12-19 11:37:37'),
(159, '19210107', 'Hafiz Kurnia', 2, 12, 'Bogor', '2003-01-07', '500000', 0, 0, 0, 450000, '', '2022-12-19 11:44:40'),
(200, '19210234', 'Lutfy Jagad', 2, 16, 'Tajurhalang', '2002-05-05', '', 0, 0, 0, 450000, '', '2022-12-19 11:26:55'),
(201, '19210345', 'Putri sabrina', 3, 12, 'Jakarta', '2001-01-12', '', 0, 0, 0, 450000, '', '2022-12-17 10:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_biaya_lain`
--

CREATE TABLE `siswa_biaya_lain` (
  `id_siswa_biaya_lain` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nama_biaya_lain` varchar(225) NOT NULL,
  `jumlah_biaya_lain` int(11) NOT NULL,
  `persen_biaya_lain` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa_biaya_lain`
--

INSERT INTO `siswa_biaya_lain` (`id_siswa_biaya_lain`, `id_siswa`, `nama_biaya_lain`, `jumlah_biaya_lain`, `persen_biaya_lain`) VALUES
(26, 156, 'Maulid', 25000, 0),
(28, 156, 'Uang Infak', 10000, 0),
(30, 153, 'Study Tour', 550000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE `spp` (
  `id_spp` int(11) NOT NULL,
  `kode_spp` varchar(50) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `jumlah_spp` int(11) NOT NULL,
  `persen_spp` int(11) NOT NULL,
  `tanggal_bayar_spp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_spp` int(11) NOT NULL,
  `operator` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spp`
--

INSERT INTO `spp` (`id_spp`, `kode_spp`, `id_siswa`, `id_kelas`, `bulan`, `jumlah_spp`, `persen_spp`, `tanggal_bayar_spp`, `status_spp`, `operator`) VALUES
(3454, 'KDS_15210', 152, 1, 'Juli', 150000, 0, '2022-12-19 11:49:57', 1, 'Hafia Muhshona'),
(3455, 'KDS_15211', 152, 1, 'Agustus', 150000, 0, '2022-12-19 11:50:07', 1, 'Hafia Muhshona'),
(3456, 'KDS_15212', 152, 1, 'September', 150000, 0, '2022-12-19 11:50:07', 1, 'Hafia Muhshona'),
(3457, 'KDS_15213', 152, 1, 'Oktober', 150000, 0, '2019-08-30 01:30:17', 0, ''),
(3458, 'KDS_15214', 152, 1, 'November', 150000, 0, '2019-08-30 01:30:17', 0, ''),
(3459, 'KDS_15215', 152, 1, 'Desember', 150000, 0, '2019-08-30 01:30:17', 0, ''),
(3460, 'KDS_15216', 152, 1, 'Januari', 150000, 0, '2019-08-30 01:30:17', 0, ''),
(3461, 'KDS_15217', 152, 1, 'Februari', 150000, 0, '2019-08-30 01:30:17', 0, ''),
(3462, 'KDS_15218', 152, 1, 'Maret', 150000, 0, '2019-08-30 01:30:17', 0, ''),
(3463, 'KDS_15219', 152, 1, 'April', 150000, 0, '2019-08-30 01:30:17', 0, ''),
(3464, 'KDS_152110', 152, 1, 'Mei', 150000, 0, '2019-08-30 01:30:17', 0, ''),
(3465, 'KDS_152111', 152, 1, 'Juni', 150000, 0, '2019-08-30 01:30:17', 0, ''),
(3466, 'KDS_15220', 152, 2, 'Juli', 250000, 0, '2022-12-15 01:30:17', 0, ''),
(3467, 'KDS_15221', 152, 2, 'Agustus', 150000, 0, '2019-08-30 01:30:17', 0, ''),
(3468, 'KDS_15222', 152, 2, 'September', 150000, 0, '2019-08-30 01:30:18', 0, ''),
(3469, 'KDS_15223', 152, 2, 'Oktober', 150000, 0, '2019-08-30 01:30:18', 0, ''),
(3470, 'KDS_15224', 152, 2, 'November', 150000, 0, '2019-08-30 01:30:18', 0, ''),
(3471, 'KDS_15225', 152, 2, 'Desember', 150000, 0, '2019-08-30 01:30:18', 0, ''),
(3472, 'KDS_15226', 152, 2, 'Januari', 150000, 0, '2019-08-30 01:30:18', 0, ''),
(3473, 'KDS_15227', 152, 2, 'Februari', 150000, 0, '2019-08-30 01:30:18', 0, ''),
(3474, 'KDS_15228', 152, 2, 'Maret', 150000, 0, '2019-08-30 01:30:18', 0, ''),
(3475, 'KDS_15229', 152, 2, 'April', 150000, 0, '2019-08-30 01:30:18', 0, ''),
(3476, 'KDS_152210', 152, 2, 'Mei', 150000, 0, '2019-08-30 01:30:18', 0, ''),
(3477, 'KDS_152211', 152, 2, 'Juni', 150000, 0, '2019-08-30 01:30:18', 0, ''),
(3478, 'KDS_15230', 152, 3, 'Juli', 150000, 0, '2019-08-30 01:30:18', 0, ''),
(3479, 'KDS_15231', 152, 3, 'Agustus', 150000, 0, '2019-08-30 01:30:18', 0, ''),
(3480, 'KDS_15232', 152, 3, 'September', 150000, 0, '2019-08-30 01:30:18', 0, ''),
(3481, 'KDS_15233', 152, 3, 'Oktober', 150000, 0, '2019-08-30 01:30:18', 0, ''),
(3482, 'KDS_15234', 152, 3, 'November', 150000, 0, '2019-08-30 01:30:18', 0, ''),
(3483, 'KDS_15235', 152, 3, 'Desember', 150000, 0, '2019-08-30 01:30:19', 0, ''),
(3484, 'KDS_15236', 152, 3, 'Januari', 150000, 0, '2019-08-30 01:30:19', 0, ''),
(3485, 'KDS_15237', 152, 3, 'Februari', 150000, 0, '2019-08-30 01:30:19', 0, ''),
(3486, 'KDS_15238', 152, 3, 'Maret', 150000, 0, '2019-08-30 01:30:19', 0, ''),
(3487, 'KDS_15239', 152, 3, 'April', 150000, 0, '2019-08-30 01:30:19', 0, ''),
(3488, 'KDS_152310', 152, 3, 'Mei', 150000, 0, '2019-08-30 01:30:19', 0, ''),
(3489, 'KDS_152311', 152, 3, 'Juni', 150000, 0, '2019-08-30 01:30:19', 0, ''),
(3490, 'KDS_15310', 153, 1, 'Juli', 150000, 0, '2022-12-15 12:28:24', 1, 'Hafia Muhshona'),
(3491, 'KDS_15311', 153, 1, 'Agustus', 150000, 0, '2022-12-15 12:28:24', 1, 'Hafia Muhshona'),
(3492, 'KDS_15312', 153, 1, 'September', 150000, 0, '2022-12-15 12:28:24', 1, 'Hafia Muhshona'),
(3493, 'KDS_15313', 153, 1, 'Oktober', 150000, 0, '2022-12-15 12:28:24', 1, 'Hafia Muhshona'),
(3494, 'KDS_15314', 153, 1, 'November', 150000, 0, '2022-12-15 12:28:24', 1, 'Hafia Muhshona'),
(3495, 'KDS_15315', 153, 1, 'Desember', 150000, 0, '2022-12-19 10:28:13', 1, 'Hafia Muhshona'),
(3496, 'KDS_15316', 153, 1, 'Januari', 150000, 0, '2022-12-19 10:31:50', 1, 'Hafia Muhshona'),
(3497, 'KDS_15317', 153, 1, 'Februari', 150000, 0, '2019-08-30 01:30:20', 0, ''),
(3498, 'KDS_15318', 153, 1, 'Maret', 150000, 0, '2019-08-30 01:30:20', 0, ''),
(3499, 'KDS_15319', 153, 1, 'April', 150000, 0, '2019-08-30 01:30:20', 0, ''),
(3500, 'KDS_153110', 153, 1, 'Mei', 150000, 0, '2019-08-30 01:30:20', 0, ''),
(3501, 'KDS_153111', 153, 1, 'Juni', 150000, 0, '2019-08-30 01:30:20', 0, ''),
(3502, 'KDS_15320', 153, 2, 'Juli', 150000, 0, '2019-08-30 01:30:20', 0, ''),
(3503, 'KDS_15321', 153, 2, 'Agustus', 150000, 0, '2019-08-30 01:30:20', 0, ''),
(3504, 'KDS_15322', 153, 2, 'September', 150000, 0, '2019-08-30 01:30:20', 0, ''),
(3505, 'KDS_15323', 153, 2, 'Oktober', 150000, 0, '2019-08-30 01:30:20', 0, ''),
(3506, 'KDS_15324', 153, 2, 'November', 150000, 0, '2019-08-30 01:30:20', 0, ''),
(3507, 'KDS_15325', 153, 2, 'Desember', 150000, 0, '2019-08-30 01:30:20', 0, ''),
(3508, 'KDS_15326', 153, 2, 'Januari', 150000, 0, '2019-08-30 01:30:20', 0, ''),
(3509, 'KDS_15327', 153, 2, 'Februari', 150000, 0, '2019-08-30 01:30:20', 0, ''),
(3510, 'KDS_15328', 153, 2, 'Maret', 150000, 0, '2019-08-30 01:30:20', 0, ''),
(3511, 'KDS_15329', 153, 2, 'April', 150000, 0, '2019-08-30 01:30:20', 0, ''),
(3512, 'KDS_153210', 153, 2, 'Mei', 150000, 0, '2019-08-30 01:30:20', 0, ''),
(3513, 'KDS_153211', 153, 2, 'Juni', 150000, 0, '2019-08-30 01:30:20', 0, ''),
(3514, 'KDS_15330', 153, 3, 'Juli', 150000, 0, '2019-08-30 01:30:21', 0, ''),
(3515, 'KDS_15331', 153, 3, 'Agustus', 150000, 0, '2019-08-30 01:30:21', 0, ''),
(3516, 'KDS_15332', 153, 3, 'September', 150000, 0, '2019-08-30 01:30:21', 0, ''),
(3517, 'KDS_15333', 153, 3, 'Oktober', 150000, 0, '2019-08-30 01:30:21', 0, ''),
(3518, 'KDS_15334', 153, 3, 'November', 150000, 0, '2019-08-30 01:30:21', 0, ''),
(3519, 'KDS_15335', 153, 3, 'Desember', 150000, 0, '2019-08-30 01:30:21', 0, ''),
(3520, 'KDS_15336', 153, 3, 'Januari', 150000, 0, '2019-08-30 01:30:21', 0, ''),
(3521, 'KDS_15337', 153, 3, 'Februari', 150000, 0, '2019-08-30 01:30:21', 0, ''),
(3522, 'KDS_15338', 153, 3, 'Maret', 150000, 0, '2019-08-30 01:30:21', 0, ''),
(3523, 'KDS_15339', 153, 3, 'April', 150000, 0, '2019-08-30 01:30:21', 0, ''),
(3524, 'KDS_153310', 153, 3, 'Mei', 150000, 0, '2019-08-30 01:30:21', 0, ''),
(3525, 'KDS_153311', 153, 3, 'Juni', 150000, 0, '2019-08-30 01:30:22', 0, ''),
(3526, 'KDS_15420', 154, 2, 'Juli', 150000, 0, '2022-12-16 01:42:30', 1, 'Hafia Muhshona'),
(3527, 'KDS_15421', 154, 2, 'Agustus', 150000, 0, '2022-12-16 01:42:30', 1, 'Hafia Muhshona'),
(3528, 'KDS_15422', 154, 2, 'September', 150000, 0, '2022-12-16 01:42:30', 1, 'Hafia Muhshona'),
(3529, 'KDS_15423', 154, 2, 'Oktober', 150000, 0, '2022-12-16 01:42:30', 1, 'Hafia Muhshona'),
(3530, 'KDS_15424', 154, 2, 'November', 150000, 0, '2019-08-30 01:30:22', 0, ''),
(3531, 'KDS_15425', 154, 2, 'Desember', 150000, 0, '2019-08-30 01:30:22', 0, ''),
(3532, 'KDS_15426', 154, 2, 'Januari', 150000, 0, '2019-08-30 01:30:22', 0, ''),
(3533, 'KDS_15427', 154, 2, 'Februari', 150000, 0, '2019-08-30 01:30:22', 0, ''),
(3534, 'KDS_15428', 154, 2, 'Maret', 150000, 0, '2019-08-30 01:30:22', 0, ''),
(3535, 'KDS_15429', 154, 2, 'April', 150000, 0, '2019-08-30 01:30:22', 0, ''),
(3536, 'KDS_154210', 154, 2, 'Mei', 150000, 0, '2019-08-30 01:30:22', 0, ''),
(3537, 'KDS_154211', 154, 2, 'Juni', 150000, 0, '2019-08-30 01:30:22', 0, ''),
(3538, 'KDS_15430', 154, 3, 'Juli', 150000, 0, '2019-08-30 01:30:22', 0, ''),
(3539, 'KDS_15431', 154, 3, 'Agustus', 150000, 0, '2019-08-30 01:30:22', 0, ''),
(3540, 'KDS_15432', 154, 3, 'September', 150000, 0, '2019-08-30 01:30:22', 0, ''),
(3541, 'KDS_15433', 154, 3, 'Oktober', 150000, 0, '2019-08-30 01:30:23', 0, ''),
(3542, 'KDS_15434', 154, 3, 'November', 150000, 0, '2019-08-30 01:30:23', 0, ''),
(3543, 'KDS_15435', 154, 3, 'Desember', 150000, 0, '2019-08-30 01:30:23', 0, ''),
(3544, 'KDS_15436', 154, 3, 'Januari', 150000, 0, '2019-08-30 01:30:23', 0, ''),
(3545, 'KDS_15437', 154, 3, 'Februari', 150000, 0, '2019-08-30 01:30:23', 0, ''),
(3546, 'KDS_15438', 154, 3, 'Maret', 150000, 0, '2019-08-30 01:30:23', 0, ''),
(3547, 'KDS_15439', 154, 3, 'April', 150000, 0, '2019-08-30 01:30:23', 0, ''),
(3548, 'KDS_154310', 154, 3, 'Mei', 150000, 0, '2019-08-30 01:30:23', 0, ''),
(3549, 'KDS_154311', 154, 3, 'Juni', 150000, 0, '2019-08-30 01:30:23', 0, ''),
(3550, 'KDS_15520', 155, 2, 'Juli', 140000, 0, '2019-08-30 01:30:23', 0, ''),
(3551, 'KDS_15521', 155, 2, 'Agustus', 140000, 0, '2019-08-30 01:30:23', 0, ''),
(3552, 'KDS_15522', 155, 2, 'September', 140000, 0, '2019-08-30 01:30:23', 0, ''),
(3553, 'KDS_15523', 155, 2, 'Oktober', 140000, 0, '2019-08-30 01:30:23', 0, ''),
(3554, 'KDS_15524', 155, 2, 'November', 140000, 0, '2019-08-30 01:30:23', 0, ''),
(3555, 'KDS_15525', 155, 2, 'Desember', 140000, 0, '2019-08-30 01:30:24', 0, ''),
(3556, 'KDS_15526', 155, 2, 'Januari', 140000, 0, '2019-08-30 01:30:24', 0, ''),
(3557, 'KDS_15527', 155, 2, 'Februari', 140000, 0, '2019-08-30 01:30:24', 0, ''),
(3558, 'KDS_15528', 155, 2, 'Maret', 140000, 0, '2019-08-30 01:30:24', 0, ''),
(3559, 'KDS_15529', 155, 2, 'April', 140000, 0, '2019-08-30 01:30:24', 0, ''),
(3560, 'KDS_155210', 155, 2, 'Mei', 140000, 0, '2019-08-30 01:30:24', 0, ''),
(3561, 'KDS_155211', 155, 2, 'Juni', 140000, 0, '2019-08-30 01:30:24', 0, ''),
(3562, 'KDS_15530', 155, 3, 'Juli', 140000, 0, '2019-08-30 01:30:24', 0, ''),
(3563, 'KDS_15531', 155, 3, 'Agustus', 140000, 0, '2019-08-30 01:30:24', 0, ''),
(3564, 'KDS_15532', 155, 3, 'September', 140000, 0, '2019-08-30 01:30:24', 0, ''),
(3565, 'KDS_15533', 155, 3, 'Oktober', 140000, 0, '2019-08-30 01:30:24', 0, ''),
(3566, 'KDS_15534', 155, 3, 'November', 140000, 0, '2019-08-30 01:30:24', 0, ''),
(3567, 'KDS_15535', 155, 3, 'Desember', 140000, 0, '2019-08-30 01:30:24', 0, ''),
(3568, 'KDS_15536', 155, 3, 'Januari', 140000, 0, '2019-08-30 01:30:25', 0, ''),
(3569, 'KDS_15537', 155, 3, 'Februari', 140000, 0, '2019-08-30 01:30:25', 0, ''),
(3570, 'KDS_15538', 155, 3, 'Maret', 140000, 0, '2019-08-30 01:30:25', 0, ''),
(3571, 'KDS_15539', 155, 3, 'April', 140000, 0, '2019-08-30 01:30:25', 0, ''),
(3572, 'KDS_155310', 155, 3, 'Mei', 140000, 0, '2019-08-30 01:30:25', 0, ''),
(3573, 'KDS_155311', 155, 3, 'Juni', 140000, 0, '2019-08-30 01:30:25', 0, ''),
(3574, 'KDS_15610', 156, 1, 'Juli', 130000, 0, '2022-12-15 13:08:03', 1, 'Hafia Muhshona'),
(3575, 'KDS_15611', 156, 1, 'Agustus', 130000, 0, '2022-12-15 13:08:03', 1, 'Hafia Muhshona'),
(3576, 'KDS_15612', 156, 1, 'September', 130000, 0, '2022-12-15 13:08:03', 1, 'Hafia Muhshona'),
(3577, 'KDS_15613', 156, 1, 'Oktober', 130000, 0, '2022-12-15 13:08:03', 1, 'Hafia Muhshona'),
(3578, 'KDS_15614', 156, 1, 'November', 130000, 0, '2022-12-19 09:55:46', 1, 'Hafia Muhshona'),
(3579, 'KDS_15615', 156, 1, 'Desember', 130000, 0, '2022-12-19 09:55:46', 1, 'Hafia Muhshona'),
(3580, 'KDS_15616', 156, 1, 'Januari', 130000, 0, '2019-08-30 01:30:25', 0, ''),
(3581, 'KDS_15617', 156, 1, 'Februari', 130000, 0, '2019-08-30 01:30:25', 0, ''),
(3582, 'KDS_15618', 156, 1, 'Maret', 130000, 0, '2019-08-30 01:30:26', 0, ''),
(3583, 'KDS_15619', 156, 1, 'April', 130000, 0, '2019-08-30 01:30:26', 0, ''),
(3584, 'KDS_156110', 156, 1, 'Mei', 130000, 0, '2019-08-30 01:30:26', 0, ''),
(3585, 'KDS_156111', 156, 1, 'Juni', 130000, 0, '2019-08-30 01:30:26', 0, ''),
(3586, 'KDS_15620', 156, 2, 'Juli', 130000, 0, '2019-08-30 01:30:26', 0, ''),
(3587, 'KDS_15621', 156, 2, 'Agustus', 130000, 0, '2019-08-30 01:30:26', 0, ''),
(3588, 'KDS_15622', 156, 2, 'September', 130000, 0, '2019-08-30 01:30:26', 0, ''),
(3589, 'KDS_15623', 156, 2, 'Oktober', 130000, 0, '2019-08-30 01:30:26', 0, ''),
(3590, 'KDS_15624', 156, 2, 'November', 130000, 0, '2019-08-30 01:30:26', 0, ''),
(3591, 'KDS_15625', 156, 2, 'Desember', 130000, 0, '2019-08-30 01:30:26', 0, ''),
(3592, 'KDS_15626', 156, 2, 'Januari', 130000, 0, '2019-08-30 01:30:26', 0, ''),
(3593, 'KDS_15627', 156, 2, 'Februari', 130000, 0, '2019-08-30 01:30:26', 0, ''),
(3594, 'KDS_15628', 156, 2, 'Maret', 130000, 0, '2019-08-30 01:30:26', 0, ''),
(3595, 'KDS_15629', 156, 2, 'April', 130000, 0, '2019-08-30 01:30:26', 0, ''),
(3596, 'KDS_156210', 156, 2, 'Mei', 130000, 0, '2019-08-30 01:30:26', 0, ''),
(3597, 'KDS_156211', 156, 2, 'Juni', 130000, 0, '2019-08-30 01:30:26', 0, ''),
(3598, 'KDS_15630', 156, 3, 'Juli', 130000, 0, '2019-08-30 01:30:26', 0, ''),
(3599, 'KDS_15631', 156, 3, 'Agustus', 130000, 0, '2019-08-30 01:30:27', 0, ''),
(3600, 'KDS_15632', 156, 3, 'September', 130000, 0, '2019-08-30 01:30:27', 0, ''),
(3601, 'KDS_15633', 156, 3, 'Oktober', 130000, 0, '2019-08-30 01:30:27', 0, ''),
(3602, 'KDS_15634', 156, 3, 'November', 130000, 0, '2019-08-30 01:30:27', 0, ''),
(3603, 'KDS_15635', 156, 3, 'Desember', 130000, 0, '2019-08-30 01:30:27', 0, ''),
(3604, 'KDS_15636', 156, 3, 'Januari', 130000, 0, '2019-08-30 01:30:27', 0, ''),
(3605, 'KDS_15637', 156, 3, 'Februari', 130000, 0, '2019-08-30 01:30:27', 0, ''),
(3606, 'KDS_15638', 156, 3, 'Maret', 130000, 0, '2019-08-30 01:30:27', 0, ''),
(3607, 'KDS_15639', 156, 3, 'April', 130000, 0, '2019-08-30 01:30:27', 0, ''),
(3608, 'KDS_156310', 156, 3, 'Mei', 130000, 0, '2019-08-30 01:30:27', 0, ''),
(3609, 'KDS_156311', 156, 3, 'Juni', 130000, 0, '2019-08-30 01:30:27', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tabungan`
--

CREATE TABLE `tabungan` (
  `id_tabungan` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `jumlah_tabungan` int(11) NOT NULL,
  `status_tabungan` int(11) NOT NULL,
  `tanggal_tabungan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `operator` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabungan`
--

INSERT INTO `tabungan` (`id_tabungan`, `id_siswa`, `jumlah_tabungan`, `status_tabungan`, `tanggal_tabungan`, `operator`) VALUES
(55, 156, 10000, 1, '2022-12-15 12:50:05', 'Hafia Muhshona'),
(56, 152, 35000, 1, '2022-12-15 12:53:19', 'Hafia Muhshona'),
(58, 153, 5000, 1, '2022-12-19 11:25:42', 'Hafia Muhshona');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_account`);

--
-- Indexes for table `backup_data`
--
ALTER TABLE `backup_data`
  ADD PRIMARY KEY (`id_backup_data`);

--
-- Indexes for table `bayar_biaya_lain`
--
ALTER TABLE `bayar_biaya_lain`
  ADD PRIMARY KEY (`id_bayar_biaya_lain`);

--
-- Indexes for table `biaya_lain`
--
ALTER TABLE `biaya_lain`
  ADD PRIMARY KEY (`id_biaya_lain`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukkan`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `seragam`
--
ALTER TABLE `seragam`
  ADD PRIMARY KEY (`id_seragam`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `siswa_biaya_lain`
--
ALTER TABLE `siswa_biaya_lain`
  ADD PRIMARY KEY (`id_siswa_biaya_lain`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- Indexes for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD PRIMARY KEY (`id_tabungan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id_account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `backup_data`
--
ALTER TABLE `backup_data`
  MODIFY `id_backup_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `bayar_biaya_lain`
--
ALTER TABLE `bayar_biaya_lain`
  MODIFY `id_bayar_biaya_lain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `biaya_lain`
--
ALTER TABLE `biaya_lain`
  MODIFY `id_biaya_lain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukkan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=375;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `seragam`
--
ALTER TABLE `seragam`
  MODIFY `id_seragam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `siswa_biaya_lain`
--
ALTER TABLE `siswa_biaya_lain`
  MODIFY `id_siswa_biaya_lain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `spp`
--
ALTER TABLE `spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3610;

--
-- AUTO_INCREMENT for table `tabungan`
--
ALTER TABLE `tabungan`
  MODIFY `id_tabungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
