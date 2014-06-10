-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2014 at 10:53 AM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventory_ft`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `id_brg` varchar(20) NOT NULL,
  `barcode` varchar(30) DEFAULT NULL,
  `id_jenis_barang` varchar(10) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  PRIMARY KEY (`id_brg`),
  UNIQUE KEY `barcode` (`barcode`),
  KEY `jenis_barang_barang_fk` (`id_jenis_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_brg`, `barcode`, `id_jenis_barang`, `satuan`, `nama_barang`) VALUES
('B01', '036000291452', 'JB02', 'Rim', 'Kertas HVS Sidu'),
('B02', '9771234567003', 'JB02', 'Buah', 'Pena Pilot');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pagu`
--

CREATE TABLE IF NOT EXISTS `detail_pagu` (
  `id_detail_pagu` int(10) NOT NULL AUTO_INCREMENT,
  `id_pagu_barang` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_brg` varchar(20) NOT NULL,
  PRIMARY KEY (`id_detail_pagu`),
  KEY `pagu_brg_detail_pagu_fk` (`id_pagu_barang`),
  KEY `barang_detail_pagu_fk` (`id_brg`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `detail_pagu`
--

INSERT INTO `detail_pagu` (`id_detail_pagu`, `id_pagu_barang`, `jumlah`, `id_brg`) VALUES
(16, 'P01', 5, 'B01'),
(17, 'P01', 5, 'B02');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengadaan`
--

CREATE TABLE IF NOT EXISTS `detail_pengadaan` (
  `id_detail_pengadaan` int(30) NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(30) NOT NULL,
  `id_brg` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_brg` double NOT NULL,
  PRIMARY KEY (`id_detail_pengadaan`),
  KEY `pengadaan_brg_detail_pengadaan_fk` (`no_faktur`),
  KEY `barang_detail_pengadaan_fk` (`id_brg`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `detail_pengadaan`
--

INSERT INTO `detail_pengadaan` (`id_detail_pengadaan`, `no_faktur`, `id_brg`, `jumlah`, `harga_brg`) VALUES
(10, 'F01', 'B02', 10, 1500),
(11, 'F01', 'B01', 10, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengeluaran`
--

CREATE TABLE IF NOT EXISTS `detail_pengeluaran` (
  `id_detail_pengeluaran` int(10) NOT NULL AUTO_INCREMENT,
  `no_pengeluaran` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_brg` varchar(20) NOT NULL,
  PRIMARY KEY (`id_detail_pengeluaran`),
  KEY `pengeluaran_brg_detail_pengeluaran_fk` (`no_pengeluaran`),
  KEY `barang_detail_pengeluaran_fk` (`id_brg`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `detail_pengeluaran`
--

INSERT INTO `detail_pengeluaran` (`id_detail_pengeluaran`, `no_pengeluaran`, `jumlah`, `id_brg`) VALUES
(15, 'PE01', 2, 'B01'),
(16, 'PE01', 2, 'B02');

-- --------------------------------------------------------

--
-- Table structure for table `detail_permintaan`
--

CREATE TABLE IF NOT EXISTS `detail_permintaan` (
  `id_detail_permintaan` int(10) NOT NULL AUTO_INCREMENT,
  `no_permintaan_barang` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_brg` varchar(20) NOT NULL,
  PRIMARY KEY (`id_detail_permintaan`),
  KEY `permintaan_brg_detail_permintaan_fk` (`no_permintaan_barang`),
  KEY `barang_detail_permintaan_fk` (`id_brg`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `detail_permintaan`
--

INSERT INTO `detail_permintaan` (`id_detail_permintaan`, `no_permintaan_barang`, `jumlah`, `id_brg`) VALUES
(20, 'P02', 2, 'B01'),
(21, 'P02', 2, 'B02'),
(22, 'P03', 2, 'B01'),
(24, 'P03', 3, 'B02');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE IF NOT EXISTS `jenis_barang` (
  `id_jenis` varchar(10) NOT NULL,
  `jenis_brg` varchar(30) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id_jenis`, `jenis_brg`) VALUES
('JB01', 'Bahan Pratikum'),
('JB02', 'ATK');

-- --------------------------------------------------------

--
-- Table structure for table `pagu_brg`
--

CREATE TABLE IF NOT EXISTS `pagu_brg` (
  `id_pagu_barang` varchar(10) NOT NULL,
  `kode_akun_user` int(10) NOT NULL,
  PRIMARY KEY (`id_pagu_barang`),
  KEY `user_pagu_brg_fk` (`kode_akun_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pagu_brg`
--

INSERT INTO `pagu_brg` (`id_pagu_barang`, `kode_akun_user`) VALUES
('P01', 7);

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan_brg`
--

CREATE TABLE IF NOT EXISTS `pengadaan_brg` (
  `no_faktur` varchar(30) NOT NULL,
  `tanggal_pengadaan` date NOT NULL,
  `id_rekanan` varchar(10) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  PRIMARY KEY (`no_faktur`),
  KEY `rekanan_pengadaan_brg_fk` (`id_rekanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengadaan_brg`
--

INSERT INTO `pengadaan_brg` (`no_faktur`, `tanggal_pengadaan`, `id_rekanan`, `keterangan`) VALUES
('F01', '2014-06-09', 'R01', 'Keperluan Barang ATK');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran_brg`
--

CREATE TABLE IF NOT EXISTS `pengeluaran_brg` (
  `no_pengeluaran_barang` varchar(10) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `no_permintaan_barang` varchar(10) NOT NULL,
  PRIMARY KEY (`no_pengeluaran_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran_brg`
--

INSERT INTO `pengeluaran_brg` (`no_pengeluaran_barang`, `tanggal_pengeluaran`, `keterangan`, `no_permintaan_barang`) VALUES
('PE01', '2014-06-09', 'Permintaan Atk', 'P02');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_brg`
--

CREATE TABLE IF NOT EXISTS `permintaan_brg` (
  `no_permintaan_barang` varchar(10) NOT NULL,
  `kode_akun` int(10) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tanggal_permintaan_barang` date NOT NULL,
  PRIMARY KEY (`no_permintaan_barang`),
  KEY `user_permintaan_brg_fk` (`kode_akun`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_brg`
--

INSERT INTO `permintaan_brg` (`no_permintaan_barang`, `kode_akun`, `keterangan`, `tanggal_permintaan_barang`) VALUES
('P01', 4, 'Butuh bahan Atk', '2014-06-09'),
('P02', 7, 'Butuh Bahan Atk', '2014-06-09'),
('P03', 7, 'Test', '2014-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `rekanan`
--

CREATE TABLE IF NOT EXISTS `rekanan` (
  `id_rekanan` varchar(10) NOT NULL,
  `rekanan` varchar(30) NOT NULL,
  `telp` int(11) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  PRIMARY KEY (`id_rekanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekanan`
--

INSERT INTO `rekanan` (`id_rekanan`, `rekanan`, `telp`, `alamat`) VALUES
('R01', 'Marijan', 898942363, 'Padang'),
('R02', 'Pa net', 2147483647, 'Padang');

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja`
--

CREATE TABLE IF NOT EXISTS `unit_kerja` (
  `id_unit_kerja` varchar(10) NOT NULL,
  `unit_kerja` varchar(30) NOT NULL,
  PRIMARY KEY (`id_unit_kerja`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_kerja`
--

INSERT INTO `unit_kerja` (`id_unit_kerja`, `unit_kerja`) VALUES
('11', 'Dekanat'),
('22', 'Teknik Elektro'),
('33', 'Teknik Sipil'),
('44', 'KTU'),
('55', 'Gudang');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `kode_akun` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `id_unit_kerja` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `nama_penanggungjawab` varchar(25) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`kode_akun`),
  UNIQUE KEY `username` (`username`),
  KEY `unit_kerja_user_fk` (`id_unit_kerja`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kode_akun`, `username`, `id_unit_kerja`, `password`, `nama_penanggungjawab`, `role`) VALUES
(1, 'kaur', '11', 'MTIzNDU=', 'Kepala Urusan', 'admin'),
(3, 'gudang', '55', 'MTIzNDU=', 'Kepala Gudang', 'gudang'),
(4, 'sipil', '33', 'MTIzNDU=', 'Iqbal', 'user'),
(7, 'elektro', '22', 'MTIzNDU=', 'Andre', 'user');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `jenis_barang_barang_fk` FOREIGN KEY (`id_jenis_barang`) REFERENCES `jenis_barang` (`id_jenis`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detail_pagu`
--
ALTER TABLE `detail_pagu`
  ADD CONSTRAINT `barang_detail_pagu_fk` FOREIGN KEY (`id_brg`) REFERENCES `barang` (`id_brg`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pagu_brg_detail_pagu_fk` FOREIGN KEY (`id_pagu_barang`) REFERENCES `pagu_brg` (`id_pagu_barang`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detail_pengadaan`
--
ALTER TABLE `detail_pengadaan`
  ADD CONSTRAINT `barang_detail_pengadaan_fk` FOREIGN KEY (`id_brg`) REFERENCES `barang` (`id_brg`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pengadaan_brg_detail_pengadaan_fk` FOREIGN KEY (`no_faktur`) REFERENCES `pengadaan_brg` (`no_faktur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detail_pengeluaran`
--
ALTER TABLE `detail_pengeluaran`
  ADD CONSTRAINT `barang_detail_pengeluaran_fk` FOREIGN KEY (`id_brg`) REFERENCES `barang` (`id_brg`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `detail_pengeluaran_ibfk_1` FOREIGN KEY (`no_pengeluaran`) REFERENCES `pengeluaran_brg` (`no_pengeluaran_barang`);

--
-- Constraints for table `detail_permintaan`
--
ALTER TABLE `detail_permintaan`
  ADD CONSTRAINT `barang_detail_permintaan_fk` FOREIGN KEY (`id_brg`) REFERENCES `barang` (`id_brg`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `permintaan_brg_detail_permintaan_fk` FOREIGN KEY (`no_permintaan_barang`) REFERENCES `permintaan_brg` (`no_permintaan_barang`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pagu_brg`
--
ALTER TABLE `pagu_brg`
  ADD CONSTRAINT `pagu_brg_ibfk_1` FOREIGN KEY (`kode_akun_user`) REFERENCES `user` (`kode_akun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengadaan_brg`
--
ALTER TABLE `pengadaan_brg`
  ADD CONSTRAINT `rekanan_pengadaan_brg_fk` FOREIGN KEY (`id_rekanan`) REFERENCES `rekanan` (`id_rekanan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `permintaan_brg`
--
ALTER TABLE `permintaan_brg`
  ADD CONSTRAINT `permintaan_brg_ibfk_1` FOREIGN KEY (`kode_akun`) REFERENCES `user` (`kode_akun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `unit_kerja_user_fk` FOREIGN KEY (`id_unit_kerja`) REFERENCES `unit_kerja` (`id_unit_kerja`) ON DELETE NO ACTION ON UPDATE NO ACTION;
