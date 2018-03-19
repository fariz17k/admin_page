-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2018 at 03:58 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id_job` int(11) NOT NULL,
  `nomor` varchar(55) NOT NULL,
  `tanggal` date NOT NULL,
  `store` varchar(100) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `kategori` varchar(55) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id_job`, `nomor`, `tanggal`, `store`, `alamat`, `kategori`, `keterangan`) VALUES
(1, '1007', '2019-04-03', 'Store 1', 'di gandaria I', 'Maintenace', 'Belum'),
(4, '1002', '2018-03-14', 'Pondok Indah II', 'Pondok Indah', 'Standby', 'Sudah'),
(7, '12345 ', '2018-04-10', 'Store 1', 'gandaria', 'Maintenace', 'Sudah'),
(8, '1003', '2018-03-22', 'store 1', 'jl. merah', 'Maintenance', 'belum'),
(9, '1008', '2018-03-31', 'store 1', 'gulukz', 'Maintenance', 'Belum'),
(10, '2552', '2018-02-26', 'store 1', 'Jl. Cipete raya', 'Maintenance', 'Sudah'),
(11, '1235', '2017-03-05', 'store 3', 'Jl. Radio Dalem', 'Maintenance', 'nyimeng laaa'),
(12, '4755', '2055-05-05', 'store 4', 'Jl. Bahari', 'Standby', 'Siap');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id_job`),
  ADD UNIQUE KEY `nomor` (`nomor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id_job` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
