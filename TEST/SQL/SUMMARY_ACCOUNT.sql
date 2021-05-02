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
-- Table structure for table `SUMMARY_ACCOUNT`
--

CREATE TABLE `SUMMARY_ACCOUNT` (
  `summary_id` int(5) NOT NULL,
  `confirm_id` int(5) NOT NULL,
  `date_booking` date NOT NULL,
  `income` float(8,2) NOT NULL,
  `count_of_sale_ticket` int(8) NOT NULL,
  `count_thai_kid_ticket` int(8) NOT NULL,
  `count_thai_adult_ticket` int(8) NOT NULL,
  `count_foreigner_kid_ticket` int(8) NOT NULL,
  `count_foreigner_adult_ticket` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `SUMMARY_ACCOUNT`
--

INSERT INTO `SUMMARY_ACCOUNT` (`summary_id`, `confirm_id`, `date_booking`, `income`, `count_of_sale_ticket`, `count_thai_kid_ticket`, `count_thai_adult_ticket`, `count_foreigner_kid_ticket`, `count_foreigner_adult_ticket`) VALUES
(34, 82, '2021-05-03', 192.60, 2, 1, 1, 0, 0),
(35, 83, '2021-05-02', 353.10, 3, 1, 2, 0, 0),
(36, 84, '2021-05-01', 481.50, 3, 0, 3, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `SUMMARY_ACCOUNT`
--
ALTER TABLE `SUMMARY_ACCOUNT`
  ADD PRIMARY KEY (`summary_id`),
  ADD KEY `fk_confirm_id` (`confirm_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `SUMMARY_ACCOUNT`
--
ALTER TABLE `SUMMARY_ACCOUNT`
  MODIFY `summary_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `SUMMARY_ACCOUNT`
--
ALTER TABLE `SUMMARY_ACCOUNT`
  ADD CONSTRAINT `fk_confirm_id_summary` FOREIGN KEY (`confirm_id`) REFERENCES `CONFIRM_SLIP` (`confirm_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
