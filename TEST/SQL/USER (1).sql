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
-- Table structure for table `USER`
--

CREATE TABLE `USER` (
  `user_id` int(5) NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `Tel` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `user_password` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `gender` enum('Male','Female') CHARACTER SET utf8mb4 NOT NULL,
  `year_of_birth` varchar(4) CHARACTER SET utf8mb4 NOT NULL,
  `user_type` enum('Customer','Financial','Reception') CHARACTER SET utf8mb4 NOT NULL,
  `user_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `USER`
--

INSERT INTO `USER` (`user_id`, `first_name`, `last_name`, `Tel`, `email`, `user_password`, `gender`, `year_of_birth`, `user_type`, `user_image`) VALUES
(1, 'Siripakorn', 'Worrawunsunthara', '0968524738', 'r_fong@live.com', '123456', 'Male', '2012', 'Customer', '202104171394535081.jpg'),
(2, 'Weeravat', 'Buachoom', '0813515017', '62070271@it.kmitl.ac.th', '55555', 'Male', '2000', 'Financial', '20210427785670997.jpg'),
(3, 'FBIhunters', 'Siripakorn Inw', '0968524738', '62070280@it.kmitl.ac.th', '123456', 'Male', '2013', 'Customer', '20210501897720871.jpg'),
(4, 'Peter', 'Parker', '0555556969', 'peterparker@mail.com', '1234', 'Male', '2012', 'Reception', '202104171208074171.jpg'),
(5, 'Punlawat', 'Leechaoren', '0621455932', 'PunlawatLeecharoen@gmail.com', 'Plai8888', 'Male', '2543', 'Customer', '202104171208074171.jpg'),
(6, 'Panai', 'Katekeaw', '0222222222', '62070254@it.kmitl.ac.th', '0000', 'Male', '2000', 'Customer', '202104171956699559.jpg'),
(7, 'Punlawat', 'Leechaoren', '0621455932', '62070256@kmitl.ac.th', 'Plai8888', 'Male', '2543', 'Customer', '202104171685242582.jpg'),
(8, 'Wut', 'Jarusupat', '0123456789', '62070171@it.kmitl.ac.th', '1234', 'Male', '2001', 'Customer', '202104302103998903.jpg'),
(9, 'Buachoom', 'Weeravat', '0813515017', 'filmbuachoom@gmail.com', '1234', 'Male', '2077', 'Customer', '202104271523321995.jpg'),
(10, 'smith', 'ch', '0696969696', '62070276@it.kmitl.ac.th', '1234', 'Male', '2000', 'Customer', '202104281816332994.jpg'),
(11, 'Smith', 'Cheablam', '0123456789', 'deerturnback@mail.com', '1234', 'Female', '2015', 'Customer', '202105011234427619.jpg'),
(12, 'Sunny', 'hum', '1234567890', 'Sunny@gmail.com', '1234', 'Male', '1999', 'Customer', 'user_default.png'),
(13, 'Naruto', 'Usumaki', '0813515017', 'Naruto@gmail.com', '1234', 'Male', '1992', 'Customer', '20210501568131910.jpg'),
(14, 'Kachayothee', 'Cheablam', '0222222222', 'Kachayothee@gmail.com', '1234', 'Male', '2077', 'Customer', '20210501395051373.jpg'),
(15, 'John', 'Son', '0123456789', 'jonhson@hotmail.com', '1234', 'Male', '1998', 'Customer', 'user_default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `USER`
--
ALTER TABLE `USER`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
