-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 27, 2017 at 04:17 PM
-- Server version: 10.0.29-MariaDB-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1

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
-- Table structure for table `public`
--

CREATE TABLE `public` (
  `ic` varchar(15) DEFAULT NULL,
  `masuk` varchar(15) DEFAULT NULL,
  `keluar` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `kamsis` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

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
