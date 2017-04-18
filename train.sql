-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-04-18 16:53:51
-- 服务器版本： 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `train`
--

-- --------------------------------------------------------

--
-- 表的结构 `cariage`
--

CREATE TABLE IF NOT EXISTS `cariage` (
  `id` int(11) NOT NULL,
  `cariage_type_id` int(11) DEFAULT NULL,
  `train_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `seats_type`
--

CREATE TABLE IF NOT EXISTS `seats_type` (
  `id` int(11) NOT NULL,
  `seats_level` varchar(20) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `train_type_id` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL,
  `cus_id` int(11) DEFAULT NULL,
  `seat_type_id` int(11) DEFAULT NULL,
  `godate` date DEFAULT NULL,
  `cariage_id` int(11) DEFAULT NULL,
  `seat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `train`
--

CREATE TABLE IF NOT EXISTS `train` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `start_city_id` int(11) DEFAULT NULL,
  `end_city_id` int(11) DEFAULT NULL,
  `hours` double DEFAULT NULL,
  `gotime` time DEFAULT NULL,
  `train_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `train_type`
--

CREATE TABLE IF NOT EXISTS `train_type` (
  `id` int(11) NOT NULL,
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cariage`
--
ALTER TABLE `cariage`
  ADD PRIMARY KEY (`id`), ADD KEY `cariage_type_id` (`cariage_type_id`), ADD KEY `train_id` (`train_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats_type`
--
ALTER TABLE `seats_type`
  ADD PRIMARY KEY (`id`), ADD KEY `train_type_id` (`train_type_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`), ADD KEY `cus_id` (`cus_id`), ADD KEY `seat_type_id` (`seat_type_id`), ADD KEY `cariage_id` (`cariage_id`);

--
-- Indexes for table `train`
--
ALTER TABLE `train`
  ADD PRIMARY KEY (`id`), ADD KEY `start_city_id` (`start_city_id`), ADD KEY `end_city_id` (`end_city_id`), ADD KEY `train_type_id` (`train_type_id`);

--
-- Indexes for table `train_type`
--
ALTER TABLE `train_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cariage`
--
ALTER TABLE `cariage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `seats_type`
--
ALTER TABLE `seats_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `train`
--
ALTER TABLE `train`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `train_type`
--
ALTER TABLE `train_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 限制导出的表
--

--
-- 限制表 `cariage`
--
ALTER TABLE `cariage`
ADD CONSTRAINT `cariage_ibfk_1` FOREIGN KEY (`cariage_type_id`) REFERENCES `seats_type` (`id`),
ADD CONSTRAINT `cariage_ibfk_2` FOREIGN KEY (`train_id`) REFERENCES `train` (`id`);

--
-- 限制表 `seats_type`
--
ALTER TABLE `seats_type`
ADD CONSTRAINT `seats_type_ibfk_1` FOREIGN KEY (`train_type_id`) REFERENCES `train_type` (`id`);

--
-- 限制表 `tickets`
--
ALTER TABLE `tickets`
ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`id`),
ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`seat_type_id`) REFERENCES `seats_type` (`id`),
ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`cariage_id`) REFERENCES `cariage` (`id`);

--
-- 限制表 `train`
--
ALTER TABLE `train`
ADD CONSTRAINT `train_ibfk_1` FOREIGN KEY (`start_city_id`) REFERENCES `city` (`id`),
ADD CONSTRAINT `train_ibfk_2` FOREIGN KEY (`end_city_id`) REFERENCES `city` (`id`),
ADD CONSTRAINT `train_ibfk_3` FOREIGN KEY (`train_type_id`) REFERENCES `train_type` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
