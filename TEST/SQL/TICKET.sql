-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2021 at 11:45 AM
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
-- Table structure for table `TICKET`
--

CREATE TABLE `TICKET` (
  `ticket_id` int(10) NOT NULL,
  `type` enum('Thai_kid','Thai_adult','Foreigner_Adult','Foreigner_kid') CHARACTER SET utf8 NOT NULL,
  `price` int(10) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TICKET`
--

INSERT INTO `TICKET` (`ticket_id`, `type`, `price`, `description`) VALUES
(1, 'Thai_kid', 30, 'สำหรับเด็กที่มีความสูงไม่เกิน 135 cm.'),
(2, 'Thai_adult', 150, 'สำหรับผู้ใหญ่ที่มีอายุ ยี่สิบปี บริบูรณ์ หรือความสูงเกิน 135 cm'),
(5, 'Foreigner_kid', 150, 'สำหรับเด็กต่างชาติ ที่มีความสูงไม่เกิน 135 cm.'),
(6, 'Foreigner_Adult', 250, 'สำหรับผู้ใหญ่ต่างชาติ ที่มีอายุ ยี่สิบปี บริบูรณ์ หรือความสูงเกิน 135 cm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `TICKET`
--
ALTER TABLE `TICKET`
  ADD PRIMARY KEY (`ticket_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `TICKET`
--
ALTER TABLE `TICKET`
  MODIFY `ticket_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
