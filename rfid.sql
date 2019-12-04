-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2019 at 08:15 AM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rfid`
--

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE IF NOT EXISTS `labels` (
`id` int(11) NOT NULL,
  `roll_id` varchar(16) CHARACTER SET utf8 NOT NULL,
  `declared_qty` int(4) NOT NULL DEFAULT '3500',
  `real_qty` int(4) NOT NULL,
  `lost` int(3) NOT NULL,
  `lost_clb` int(3) NOT NULL,
  `invalid` int(4) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `printed` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`id`, `roll_id`, `declared_qty`, `real_qty`, `lost`, `lost_clb`, `invalid`, `time`, `printed`) VALUES
(6, 'Lot No. 2', 3500, 3458, 12, 63, 0, '2019-10-30 11:34:32', 1),
(7, 'Lot No. 3', 3500, 3499, 15, 50, 0, '2019-10-30 11:34:34', 1),
(8, 'Lot No. 4', 3500, 3488, 15, 50, 0, '2019-10-30 13:35:03', 1),
(9, '123', 3500, 3490, 50, 20, 0, '2019-11-05 12:52:15', 1),
(10, '223', 3500, 3490, 20, 20, 0, '2019-11-05 13:18:21', 1),
(11, 'Lot No.5', 3500, 3500, 100, 100, 0, '2019-11-06 08:45:13', 1),
(12, 'Lot No. 6', 3500, 3492, 15, 80, 0, '2019-11-13 08:12:20', 1),
(13, 'Lot No. 6', 3500, 3490, 10, 50, 100, '2019-11-14 11:47:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `create_date`) VALUES
(1, 'preparacija', '$2y$10$1XovyTAyWodO3zPh7wsA4e0yoUvOWz/TFMavG7xuuVW.eujnjW1a6', '2019-10-30 12:53:17'),
(2, 'admin', '$2y$10$UAVNxCM1PB7q.zUvAuOzDOG5r./GGUGXnfaRZDzw6SFXYn/zlKP1i', '2019-10-30 12:53:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `labels`
--
ALTER TABLE `labels`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
