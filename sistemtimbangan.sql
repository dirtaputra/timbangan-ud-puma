-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2017 at 04:37 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistemtimbangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(255) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `keterangan` text NOT NULL,
  `masa` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `jenis`, `keterangan`, `masa`) VALUES
(2, 'makroni', 'Pasta', 'murah', 0),
(4, 'Shampo', 'Cair', 'bahan alami', 0),
(9, 'busa', 'Padat', 'mahal', 0),
(14, 'sdf', 'Pasta', 'sdf', 0),
(16, 'as', 'Cair', 'as ku b', 0);

-- --------------------------------------------------------

--
-- Table structure for table `log_delete_transaksi`
--

CREATE TABLE `log_delete_transaksi` (
  `SPTA` varchar(200) NOT NULL,
  `id_kelompok_tani` int(200) NOT NULL,
  `id_master_tarif` int(200) NOT NULL,
  `no_kendaraan` varchar(200) NOT NULL,
  `id_nama_petani` int(200) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_hari_ini` datetime NOT NULL,
  `netto` float NOT NULL,
  `harga` int(200) NOT NULL,
  `total_harga` int(200) NOT NULL,
  `date_delete` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_nama_kelompok_tani`
--

CREATE TABLE `master_nama_kelompok_tani` (
  `id` int(11) NOT NULL,
  `nama_kelompok` varchar(200) NOT NULL,
  `tanggal_buat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_nama_kelompok_tani`
--

INSERT INTO `master_nama_kelompok_tani` (`id`, `nama_kelompok`, `tanggal_buat`) VALUES
(2, '93829384', '2017-08-24 07:21:45'),
(3, '4563223', '2017-08-24 07:22:03'),
(4, '2354345', '2017-08-24 07:22:19');

-- --------------------------------------------------------

--
-- Table structure for table `master_no_kendaraan`
--

CREATE TABLE `master_no_kendaraan` (
  `id` int(11) NOT NULL,
  `no_kendaraan` varchar(200) NOT NULL,
  `tanggal_buat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_no_kendaraan`
--

INSERT INTO `master_no_kendaraan` (`id`, `no_kendaraan`, `tanggal_buat`) VALUES
(1, '5438', '2017-08-22 10:04:46'),
(2, '5434', '2017-08-22 10:05:23'),
(3, '5678', '2017-08-25 14:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `master_petani`
--

CREATE TABLE `master_petani` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `tanggal_buat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_petani`
--

INSERT INTO `master_petani` (`id`, `nama`, `tanggal_buat`) VALUES
(1, 'muhammad sulton', '2017-08-29 09:26:32'),
(2, 'Reni astutik', '2017-08-30 09:57:35');

-- --------------------------------------------------------

--
-- Table structure for table `master_tarif`
--

CREATE TABLE `master_tarif` (
  `id` int(11) NOT NULL,
  `tanggal_tarif` date NOT NULL,
  `varietas` varchar(120) DEFAULT NULL,
  `tarif` int(200) NOT NULL,
  `tanggal_buat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_tarif`
--

INSERT INTO `master_tarif` (`id`, `tanggal_tarif`, `varietas`, `tarif`, `tanggal_buat`) VALUES
(4, '2017-08-18', '300', 49999, '2017-08-29 11:25:44'),
(5, '2017-08-10', 'MA', 80000, '2017-09-02 10:51:21'),
(7, '2017-09-02', '', 49999, '2017-09-04 18:32:56'),
(10, '2017-08-10', 'H1 MM', 150000, '2017-09-07 10:09:10'),
(11, '2017-08-02', '', 100000, '2017-09-08 10:09:39');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `SPTA` varchar(200) NOT NULL,
  `id_kelompok_tani` int(200) NOT NULL,
  `id_master_tarif` int(200) NOT NULL,
  `no_kendaraan` varchar(200) NOT NULL,
  `id_nama_petani` int(200) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_hari_ini` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `netto` float NOT NULL,
  `harga` int(200) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`SPTA`, `id_kelompok_tani`, `id_master_tarif`, `no_kendaraan`, `id_nama_petani`, `tanggal_masuk`, `tanggal_hari_ini`, `netto`, `harga`, `total_harga`) VALUES
('000001', 2, 5, 'M 2342 EE', 2, '2017-08-17', '2017-09-07 13:24:50', 1, 80000, 80000),
('000002', 3, 7, 'M 2342 KL', 2, '2017-09-07', '2017-09-07 13:26:41', 3, 49999, 149997);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` int(7) NOT NULL DEFAULT '0' COMMENT '0 = admin , 1 = pegawai',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '0 = non aktiv, 1 = aktiv',
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `email`, `type`, `status`, `avatar`) VALUES
(1, 'Bagus', 'admin', '15f0591bd5980b0ff82cb8c9b57a81c3d4e2e20f', 'bagus@gmail.com', 0, 1, ''),
(2, 'Rio saputra', 'rio', '7f0537cc930333d3c6067ba9ffb1baed8f6931e2', 'rio@gmail.com', 1, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_nama_kelompok_tani`
--
ALTER TABLE `master_nama_kelompok_tani`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_no_kendaraan`
--
ALTER TABLE `master_no_kendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_petani`
--
ALTER TABLE `master_petani`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_tarif`
--
ALTER TABLE `master_tarif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`SPTA`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `master_nama_kelompok_tani`
--
ALTER TABLE `master_nama_kelompok_tani`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `master_no_kendaraan`
--
ALTER TABLE `master_no_kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `master_petani`
--
ALTER TABLE `master_petani`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `master_tarif`
--
ALTER TABLE `master_tarif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
