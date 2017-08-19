-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 19, 2017 at 02:16 PM
-- Server version: 10.0.31-MariaDB-0ubuntu0.16.04.2
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scan`
--
CREATE DATABASE IF NOT EXISTS `scan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `scan`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `user_level`) VALUES
(1, 'admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'mushagh@gmail.com', 'admin'),
(2, 'guard1', '4d9370bd0add9d927e0e372223dcc8ff2799ee052d5b712c929153bf38acb56c', 'guard1@gmail.com', 'guard');

-- --------------------------------------------------------

--
-- Table structure for table `public`
--

CREATE TABLE `public` (
  `ic` varchar(15) DEFAULT NULL,
  `masuk` varchar(15) DEFAULT NULL,
  `keluar` varchar(15) DEFAULT NULL,
  `tarikh` varchar(15) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `public`
--

INSERT INTO `public` (`ic`, `masuk`, `keluar`, `tarikh`, `status`) VALUES
('960117025308', '12:16:50 PM', '12:14:08 PM', '10-08-2017', 'pending'),
('960117025308', '12:17:37 PM', '12:17:30 PM', '10-08-2017', 'pending'),
('960117025308', '07:36:03 PM', '01:01:48 PM', '10-08-2017', 'pending'),
('960117025308', '', '08:28:53 PM', '12/08/2017', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ic` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_matrik` varchar(15) NOT NULL,
  `kelas` varchar(15) NOT NULL,
  `jabatan` varchar(15) NOT NULL,
  `kamsis` varchar(15) NOT NULL,
  `no_bilik` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ic`, `nama`, `no_matrik`, `kelas`, `jabatan`, `kamsis`, `no_bilik`) VALUES
('960117025308', 'JEMAH BT JEMAL', '01DNS14F1028', 'DNS6C', 'JTMK', 'DELIMA', 'D223');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `public`
--
ALTER TABLE `public`
  ADD KEY `fk_user` (`ic`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ic`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `public`
--
ALTER TABLE `public`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`ic`) REFERENCES `user` (`ic`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
