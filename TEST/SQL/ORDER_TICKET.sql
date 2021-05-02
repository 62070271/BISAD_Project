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
-- Table structure for table `ORDER_TICKET`
--

CREATE TABLE `ORDER_TICKET` (
  `order_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORDER_TICKET`
--

INSERT INTO `ORDER_TICKET` (`order_id`, `ticket_id`, `quantity`) VALUES
(148, 1, 1),
(148, 2, 1),
(149, 1, 1),
(149, 2, 2),
(150, 5, 1),
(150, 6, 1),
(151, 2, 3),
(152, 1, 1),
(152, 2, 2),
(152, 5, 3),
(152, 6, 4),
(153, 1, 1),
(153, 2, 2),
(154, 5, 2),
(155, 1, 1),
(155, 2, 1),
(155, 5, 1),
(155, 6, 1),
(156, 1, 1),
(156, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ORDER_TICKET`
--
ALTER TABLE `ORDER_TICKET`
  ADD PRIMARY KEY (`order_id`,`ticket_id`),
  ADD KEY `fk_ticket_id` (`ticket_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ORDER_TICKET`
--
ALTER TABLE `ORDER_TICKET`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `ORDERS` (`order_id`),
  ADD CONSTRAINT `fk_ticket_id` FOREIGN KEY (`ticket_id`) REFERENCES `TICKET` (`ticket_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
