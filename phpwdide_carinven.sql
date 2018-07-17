-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 17, 2018 at 08:43 PM
-- Server version: 5.6.39
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpwdide_carinven`
--

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `createdat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedat` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`, `status`, `createdat`, `modifiedat`) VALUES
(1, 'Maruti', 1, '2018-07-15 17:36:59', '2018-07-15 12:06:59'),
(2, 'Tata', 1, '2018-07-15 18:22:02', '2018-07-15 12:52:02'),
(3, 'Honda', 1, '2018-07-15 18:27:29', '2018-07-15 12:57:29'),
(4, 'Hyundai', 1, '2018-07-15 18:29:47', '2018-07-15 12:59:47'),
(5, 'BMW', 1, '2018-07-15 18:31:49', '2018-07-15 13:01:49'),
(6, 'Wolkswagon', 1, '2018-07-15 18:33:39', '2018-07-15 13:03:39'),
(7, 'Mercedes', 1, '2018-07-15 18:34:49', '2018-07-15 13:04:49'),
(8, 'Volvo', 1, '2018-07-16 17:10:29', '2018-07-17 12:40:29');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `manufacturerid` int(11) NOT NULL,
  `price` varchar(50) NOT NULL,
  `fueltype` varchar(50) NOT NULL,
  `mileage` varchar(50) NOT NULL,
  `engine` varchar(50) NOT NULL,
  `transmission` varchar(50) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createdat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedat` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `name`, `manufacturerid`, `price`, `fueltype`, `mileage`, `engine`, `transmission`, `weight`, `status`, `createdat`, `modifiedat`) VALUES
(1, 'Honda BRV', 3, '15000', 'Disel', '12', '1500', 'automatic', '123', 1, '2018-07-17 20:30:18', '2018-07-17 15:00:17'),
(2, 'Honda Amaze', 3, '50000', 'Petrol', '15', '1500', 'Automatic', '150', 1, '2018-07-17 20:39:04', '2018-07-17 15:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `modelimages`
--

CREATE TABLE `modelimages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `modelid` int(11) DEFAULT NULL,
  `session` varchar(50) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `createdat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedat` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modelimages`
--

INSERT INTO `modelimages` (`id`, `name`, `image_name`, `modelid`, `session`, `image_path`, `status`, `createdat`, `modifiedat`) VALUES
(1, 'images.jpg', 'img_20180717_150002.jpg', 1, '43_145840', 'uploads//img_20180717_150002.jpg', 1, '2018-07-17 20:30:02', '2018-07-17 15:00:17'),
(2, 'Honda-WRV-Exterior-118956.jpg', 'img_20180717_150003.jpg', 1, '43_145840', 'uploads//img_20180717_150003.jpg', 1, '2018-07-17 20:30:03', '2018-07-17 15:00:17'),
(3, 'honda-amaze-2018-front-angle-low-view_640x480.jpg', 'img_20180717_150902.jpg', 2, '36_150837', 'uploads//img_20180717_150902.jpg', 1, '2018-07-17 20:39:02', '2018-07-17 15:09:04'),
(4, 'honda-amaze-new-right_600x300.jpg', 'img_20180717_150902.jpg', 2, '36_150837', 'uploads//img_20180717_150902.jpg', 1, '2018-07-17 20:39:02', '2018-07-17 15:09:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modelimages`
--
ALTER TABLE `modelimages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `modelimages`
--
ALTER TABLE `modelimages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
