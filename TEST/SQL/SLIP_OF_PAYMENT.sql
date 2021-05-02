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
-- Table structure for table `SLIP_OF_PAYMENT`
--

CREATE TABLE `SLIP_OF_PAYMENT` (
  `slip_id` int(7) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `time_stamp` date NOT NULL,
  `is_check` enum('0','1') NOT NULL,
  `order_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SLIP_OF_PAYMENT`
--

INSERT INTO `SLIP_OF_PAYMENT` (`slip_id`, `picture`, `time_stamp`, `is_check`, `order_id`) VALUES
(95, '202105021631693614.jpg', '2021-05-02', '1', 148),
(96, '202105021573708961.jpg', '2021-05-02', '1', 150),
(97, '202105021174847055.png', '2021-05-02', '1', 149),
(98, '20210502804077608.png', '2021-05-02', '1', 151),
(99, '2021050293790947.png', '2021-05-02', '0', 153),
(100, '202105022023655164.png', '2021-05-02', '0', 154),
(101, '202105021838057092.png', '2021-05-02', '0', 156);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `SLIP_OF_PAYMENT`
--
ALTER TABLE `SLIP_OF_PAYMENT`
  ADD PRIMARY KEY (`slip_id`),
  ADD KEY `fk_slip_order_id` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `SLIP_OF_PAYMENT`
--
ALTER TABLE `SLIP_OF_PAYMENT`
  MODIFY `slip_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `SLIP_OF_PAYMENT`
--
ALTER TABLE `SLIP_OF_PAYMENT`
  ADD CONSTRAINT `fk_order_id_slip` FOREIGN KEY (`order_id`) REFERENCES `ORDERS` (`order_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
