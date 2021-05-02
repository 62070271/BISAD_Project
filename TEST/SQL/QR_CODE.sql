-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2021 at 11:44 AM
-- Server version: 5.7.33-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freedbtech_BISADProject`
--

-- --------------------------------------------------------

--
-- Table structure for table `QR_CODE`
--

CREATE TABLE `QR_CODE` (
  `qr_id` int(7) NOT NULL,
  `confirm_id` int(7) NOT NULL,
  `qrcode_status` enum('0','1','2') CHARACTER SET utf8 NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `QR_CODE`
--

INSERT INTO `QR_CODE` (`qr_id`, `confirm_id`, `qrcode_status`, `qr_code`, `user_id`) VALUES
(44, 82, '1', '608e4c8c9c034.png', 3),
(45, 83, '0', '608e4eb2310b2.png', 9),
(46, 84, '2', '608e50b4cca85.png', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `QR_CODE`
--
ALTER TABLE `QR_CODE`
  ADD PRIMARY KEY (`qr_id`),
  ADD KEY `fk_confirm_slip` (`confirm_id`),
  ADD KEY `fk_qrcode_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `QR_CODE`
--
ALTER TABLE `QR_CODE`
  MODIFY `qr_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `QR_CODE`
--
ALTER TABLE `QR_CODE`
  ADD CONSTRAINT `fk_confirm_id` FOREIGN KEY (`confirm_id`) REFERENCES `CONFIRM_SLIP` (`confirm_id`),
  ADD CONSTRAINT `fk_user_id_qr` FOREIGN KEY (`user_id`) REFERENCES `USER` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
