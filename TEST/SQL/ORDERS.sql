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
-- Table structure for table `ORDERS`
--

CREATE TABLE `ORDERS` (
  `order_id` int(10) NOT NULL,
  `booking_date` date NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `status` enum('In_progress','Complete','Fail','Unpaid') NOT NULL,
  `total_quantity` int(7) NOT NULL,
  `total_price_and_vat` float(10,2) NOT NULL,
  `user_id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ORDERS`
--

INSERT INTO `ORDERS` (`order_id`, `booking_date`, `total_price`, `status`, `total_quantity`, `total_price_and_vat`, `user_id`) VALUES
(148, '2021-05-03', 180.00, 'Complete', 2, 192.60, 3),
(149, '2021-05-02', 330.00, 'Fail', 3, 353.10, 9),
(150, '2021-05-11', 400.00, 'Fail', 2, 428.00, 3),
(151, '2021-05-01', 450.00, 'Fail', 3, 481.50, 9),
(152, '2021-05-03', 1780.00, 'Unpaid', 10, 1904.60, 3),
(153, '2021-05-15', 330.00, 'In_progress', 3, 353.10, 11),
(154, '2021-05-03', 300.00, 'In_progress', 2, 321.00, 11),
(155, '2021-05-03', 580.00, 'Unpaid', 4, 620.60, 3),
(156, '2021-05-03', 330.00, 'In_progress', 3, 353.10, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ORDERS`
--
ALTER TABLE `ORDERS`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `USER` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
