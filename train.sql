-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-05-05 19:07:46
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
-- 表的结构 `access`
--

CREATE TABLE IF NOT EXISTS `access` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `access` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

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
-- 表的结构 `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`id`, `name`, `pid`) VALUES
(1, 'Super Administrator', 0),
(2, 'Manager', 1),
(3, 'Worker', 2),
(4, 'Unvalidated', 4);

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

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `salt` varchar(50) NOT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `tel` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `lastloginip` varchar(30) DEFAULT NULL,
  `lastlogindate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `pwd`, `salt`, `fname`, `lname`, `role_id`, `tel`, `email`, `lastloginip`, `lastlogindate`) VALUES
(1, 'admin', 'bda1630a9b49f083d784709dad92ec60', 'oKm0lY2R', 'Marshall', 'Liu', 1, '12300444569', 'mars@gmail.com', '127.0.0.1', '2017-05-05 01:04:29'),
(2, 'manager1', '978f145e82fee41e2bae6de5e97538f1', 'bxlP7a+C', 'Kev', 'He', 2, '12345', '12344@gmail.com', '::1', '2017-03-14 16:06:34'),
(3, 'worker1', '50903350968fbfccb51515c226cf9e5c', '6KlBSuTL', 'Tob', 'Mao', 3, '123455', '1324@gmail.com', '::1', '2017-03-16 23:49:00'),
(4, 'worker2', '019fd8e9f59638d77f78776c8f6d968d', '07tupg33', 'Tomas', 'Li', 3, '1', '1@e.com', '', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`id`), ADD KEY `role_id` (`role_id`);

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
-- Indexes for table `role`
--
ALTER TABLE `role`
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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`), ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
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
-- 限制表 `access`
--
ALTER TABLE `access`
ADD CONSTRAINT `access_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

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

--
-- 限制表 `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
