-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2018 at 06:53 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erporate`
--

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `id_meja` int(2) NOT NULL,
  `nama_meja` varchar(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id_meja`, `nama_meja`, `status`) VALUES
(1, 'meja1', 0),
(2, 'meja2', 0),
(3, 'meja3', 0),
(4, 'meja4', 0),
(5, 'meja5', 0),
(6, 'meja6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(2) NOT NULL,
  `nama_menu` varchar(25) NOT NULL,
  `kategori` varchar(10) NOT NULL,
  `harga` int(6) NOT NULL,
  `stok` int(2) NOT NULL,
  `gambar` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `kategori`, `harga`, `stok`, `gambar`) VALUES
(1, 'Nasi Goreng', 'makanan', 8000, 0, 'goreng.jpg'),
(2, 'nasi rendang', 'makanan', 13000, 5, 'rendang.jpg'),
(4, 'Es Teh', 'Minuman', 5000, 3, 'esteh.jpg'),
(5, 'Es Jeruk', 'minuman', 3500, 0, 'jeruk.png'),
(6, 'Ayam Bakar', 'makanan', 13000, 3, 'default.png'),
(7, 'Jus mangga', 'minuman', 2000, 10, 'default.png'),
(8, 'test', 'makanan', 20000, 4, 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(2) NOT NULL,
  `kd_pesanan` char(15) NOT NULL,
  `nama_menu` varchar(25) NOT NULL,
  `harga` int(6) NOT NULL,
  `qty` int(2) NOT NULL,
  `nmr_meja` int(1) NOT NULL,
  `nm_pelayan` varchar(20) NOT NULL,
  `status_byr` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `kd_pesanan`, `nama_menu`, `harga`, `qty`, `nmr_meja`, `nm_pelayan`, `status_byr`) VALUES
(1, 'ERP23102018-001', 'Ayam Bakar', 13000, 10, 3, 'pelayan1', 1),
(2, 'ERP23102018-002', 'Nasi Goreng', 8000, 3, 2, 'pelayan1', 1),
(3, 'ERP23102018-002', 'Es Jeruk', 3500, 3, 2, 'pelayan1', 1),
(4, 'ERP23102018-003', 'Ayam Bakar', 13000, 2, 5, 'pelayan2', 1),
(5, 'ERP23102018-003', 'Es Jeruk', 3500, 2, 5, 'pelayan2', 1),
(6, 'ERP23102018-004', 'Es Teh', 5000, 2, 4, 'pelayan2', 1),
(7, 'ERP23102018-005', 'Nasi Goreng', 8000, 5, 1, 'pelayan2', 1),
(8, 'ERP23102018-006', 'nasi rendang', 13000, 4, 1, 'pelayan2', 1),
(9, 'ERP23102018-006', 'Ayam Bakar', 13000, 1, 1, 'pelayan2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(2) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`) VALUES
(1, 'pelayan1', '12345', 'pelayan'),
(2, 'pelayan2', '54321', 'pelayan'),
(3, 'kasir123', 'kasir', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `id_meja` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
