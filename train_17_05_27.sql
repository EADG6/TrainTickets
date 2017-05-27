-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-05-27 05:09:15
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
  `name` varchar(50) DEFAULT NULL,
  `page` varchar(20) DEFAULT NULL,
  `action` varchar(20) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `access`
--

INSERT INTO `access` (`id`, `name`, `page`, `action`, `role_id`) VALUES
(1, 'Creat New Ticket', 'ticket', 'new', 3),
(2, 'Check and Edit Ticket', 'ticket', 'all', 3),
(3, 'Create New Train', 'train', 'new', 2),
(4, 'Check and Edit Train', 'train', 'all', 2),
(5, 'Create New Customer', 'customer', 'new', 3),
(6, 'Check and Edit Customer', 'customer', 'all', 3),
(7, 'Create New Staff', 'staff', 'new', 2),
(8, 'Check and Edit Staff', 'staff', 'all', 2),
(9, 'Update Staff Role', 'staff', 'role', 1),
(10, 'Configure Role Access', 'staff', 'rolecfg', 1),
(11, 'Update Personal Profile', 'profile', 'all', 4);

-- --------------------------------------------------------

--
-- 表的结构 `cariage`
--

CREATE TABLE IF NOT EXISTS `cariage` (
  `id` int(11) NOT NULL,
  `cariage_type_id` int(11) DEFAULT NULL,
  `train_id` int(11) DEFAULT NULL,
  `train_cariage_num` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `cariage`
--

INSERT INTO `cariage` (`id`, `cariage_type_id`, `train_id`, `train_cariage_num`) VALUES
(1, 4, 1, 1),
(2, 4, 1, 2),
(3, 5, 1, 3),
(4, 5, 1, 4),
(5, 6, 1, 5),
(6, 4, 2, 1),
(7, 4, 2, 2),
(8, 5, 2, 3),
(9, 6, 2, 4),
(10, 4, 3, 1),
(11, 5, 3, 2),
(12, 6, 3, 3),
(13, 2, 4, 1),
(14, 2, 4, 2),
(15, 2, 5, 1),
(16, 2, 5, 2),
(17, 2, 6, 1),
(18, 2, 6, 2),
(19, 2, 7, 1),
(20, 2, 7, 2);

-- --------------------------------------------------------

--
-- 表的结构 `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `city`
--

INSERT INTO `city` (`id`, `city`) VALUES
(1, 'Chengdu'),
(2, 'Beijing'),
(3, 'Xian'),
(4, 'Shanghai');

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
  `tel` varchar(50) DEFAULT NULL,
  `IDcard` int(11) DEFAULT NULL,
  `birthplace` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `customer`
--

INSERT INTO `customer` (`id`, `firstname`, `lastname`, `sex`, `birthdate`, `tel`, `IDcard`, `birthplace`) VALUES
(1, 'Toby', 'Mao', 1, '1995-01-01', '123445667', 12345, 'Sichuan'),
(2, 'Kevin', 'He', 2, '1995-02-01', '123445667', 12346, 'Chongqing'),
(3, 'Hary', 'Li', 1, '1996-02-01', '123445667', 12347, 'Beijing'),
(4, 'Peter', 'Ren', 0, '1996-01-01', '123445667', 12348, 'Hubei');

-- --------------------------------------------------------

--
-- 表的结构 `paytype`
--

CREATE TABLE IF NOT EXISTS `paytype` (
  `id` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `paytype`
--

INSERT INTO `paytype` (`id`, `type`) VALUES
(1, 'Cash'),
(2, 'Bank Card'),
(3, 'Alipay'),
(4, 'Wechat');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `seats_type`
--

INSERT INTO `seats_type` (`id`, `seats_level`, `price`, `train_type_id`, `capacity`) VALUES
(1, 'Standing', 60, 1, 100),
(2, 'Seat', 80, 1, 80),
(3, 'Standing', 10, 2, 150),
(4, 'Seat', 20, 2, 100),
(5, 'Hard Sleeper', 30, 2, 60),
(6, 'Soft Sleeper', 40, 2, 40);

-- --------------------------------------------------------

--
-- 表的结构 `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `isstand` tinyint(1) NOT NULL DEFAULT '0',
  `godate` date NOT NULL,
  `cariage_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `price` double DEFAULT NULL,
  `paytype_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `tickets`
--

INSERT INTO `tickets` (`id`, `cus_id`, `isstand`, `godate`, `cariage_id`, `seat_id`, `price`, `paytype_id`) VALUES
(1, 1, 0, '2017-05-07', 1, 1, 200, 1),
(2, 2, 0, '2017-05-07', 1, 2, 200, 1),
(5, 3, 1, '2017-05-07', 1, 1, 400, 1),
(8, 2, 1, '2017-05-07', 1, 2, 400, 1),
(9, 4, 0, '2017-05-19', 15, 1, 480, 1),
(10, 2, 1, '2017-05-31', 17, 3, 300, 1),
(11, 3, 1, '2017-05-31', 17, 2, 300, 1),
(12, 2, 0, '2017-05-20', 17, 1, 400, 1),
(13, 3, 1, '2017-05-31', 15, 1, 480, 1),
(15, 3, 0, '2017-05-23', 9, 1, 160, 1),
(16, 1, 0, '2017-05-31', 17, 1, 400, 1),
(17, 2, 0, '2017-06-08', 19, 1, 1440, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `train`
--

INSERT INTO `train` (`id`, `name`, `start_city_id`, `end_city_id`, `hours`, `gotime`, `train_type_id`) VALUES
(1, 'K0012', 1, 2, 20, '08:30:00', 2),
(2, 'K0013', 1, 3, 8, '10:00:00', 2),
(3, 'K0014', 1, 4, 16, '18:00:00', 2),
(4, 'T0021', 2, 1, 10, '12:00:00', 1),
(5, 'T0023', 2, 3, 8, '14:00:00', 1),
(6, 'T0024', 2, 4, 5, '14:30:00', 1),
(7, 'T0012', 1, 2, 18, '12:30:00', 1);

-- --------------------------------------------------------

--
-- 表的结构 `train_type`
--

CREATE TABLE IF NOT EXISTS `train_type` (
  `id` int(11) NOT NULL,
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `train_type`
--

INSERT INTO `train_type` (`id`, `type`) VALUES
(1, 'High'),
(2, 'Slow');

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
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `pwd`, `salt`, `fname`, `lname`, `role_id`, `tel`, `email`) VALUES
(1, 'admin', 'bda1630a9b49f083d784709dad92ec60', 'oKm0lY2R', 'Marshall', 'Liu', 1, '12300444569', 'mars@gmail.com'),
(2, 'manager1', '978f145e82fee41e2bae6de5e97538f1', 'bxlP7a+C', 'Kev', 'He', 2, '12345', '12344@gmail.com'),
(3, 'worker1', '50903350968fbfccb51515c226cf9e5c', '6KlBSuTL', 'Tob', 'Mao', 3, '123455', '1324@gmail.com'),
(4, 'worker2', '019fd8e9f59638d77f78776c8f6d968d', '07tupg33', 'Tomas', 'Li', 3, '1', '1@e.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `paytype`
--
ALTER TABLE `paytype`
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
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `isstand` (`isstand`,`godate`,`cariage_id`,`seat_id`), ADD KEY `tickets_ibfk_1` (`cus_id`), ADD KEY `tickets_ibfk_3` (`cariage_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `cariage`
--
ALTER TABLE `cariage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `paytype`
--
ALTER TABLE `paytype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `seats_type`
--
ALTER TABLE `seats_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `train`
--
ALTER TABLE `train`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `train_type`
--
ALTER TABLE `train_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
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
