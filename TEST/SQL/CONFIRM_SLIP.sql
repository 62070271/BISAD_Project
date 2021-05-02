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
-- Table structure for table `CONFIRM_SLIP`
--

CREATE TABLE `CONFIRM_SLIP` (
  `confirm_id` int(11) NOT NULL,
  `slip_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CONFIRM_SLIP`
--

INSERT INTO `CONFIRM_SLIP` (`confirm_id`, `slip_id`) VALUES
(82, 95),
(83, 97),
(84, 98);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CONFIRM_SLIP`
--
ALTER TABLE `CONFIRM_SLIP`
  ADD PRIMARY KEY (`confirm_id`),
  ADD KEY `fk_slip_id` (`slip_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CONFIRM_SLIP`
--
ALTER TABLE `CONFIRM_SLIP`
  MODIFY `confirm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `CONFIRM_SLIP`
--
ALTER TABLE `CONFIRM_SLIP`
  ADD CONSTRAINT `fk_slip_id` FOREIGN KEY (`slip_id`) REFERENCES `SLIP_OF_PAYMENT` (`slip_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
