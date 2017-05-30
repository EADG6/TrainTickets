-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2017-05-30 15:10:35
-- 服务器版本： 10.0.17-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `train`
--

-- --------------------------------------------------------

--
-- 表的结构 `cariage`
--

CREATE TABLE `cariage` (
  `id` int(11) NOT NULL,
  `cariage_type_id` int(11) DEFAULT NULL,
  `train_id` int(11) DEFAULT NULL,
  `train_cariage_num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(17, 2, 6, 1),
(18, 2, 6, 2),
(19, 2, 7, 1),
(20, 2, 7, 2),
(31, 2, 22, 1),
(32, 2, 22, 2),
(33, 2, 22, 3),
(40, 2, 24, 1),
(41, 2, 24, 2),
(42, 5, 25, 1),
(43, 5, 25, 2),
(44, 5, 25, 3),
(45, 4, 25, 1),
(46, 6, 25, 1),
(47, 6, 26, 1),
(48, 6, 26, 2),
(49, 4, 26, 1),
(50, 5, 26, 1),
(51, 5, 26, 2),
(52, 5, 26, 3),
(53, 5, 26, 4),
(54, 5, 26, 5),
(55, 4, 27, 1),
(56, 4, 27, 2),
(57, 4, 27, 3),
(58, 4, 27, 4),
(59, 5, 27, 1),
(60, 6, 27, 1),
(62, 2, 28, 1),
(63, 2, 29, 1),
(64, 2, 29, 2),
(65, 2, 29, 3),
(66, 2, 30, 1),
(67, 2, 30, 2),
(68, 4, 31, 1),
(69, 4, 31, 2),
(70, 4, 31, 3),
(71, 5, 31, 1),
(72, 6, 31, 1),
(73, 4, 32, 1),
(74, 4, 32, 2),
(75, 5, 32, 1),
(76, 5, 32, 2),
(77, 6, 32, 1),
(78, 6, 32, 2),
(79, 4, 33, 1),
(80, 4, 33, 2),
(81, 5, 33, 1),
(82, 6, 33, 1),
(83, 2, 34, 1),
(84, 2, 24, 2),
(85, 2, 34, 3),
(86, 2, 35, 1),
(87, 2, 35, 2),
(88, 2, 35, 3),
(89, 2, 35, 4),
(90, 2, 35, 5),
(91, 2, 36, 1),
(92, 2, 27, 1),
(93, 2, 37, 2),
(94, 4, 38, 1),
(95, 4, 38, 2),
(96, 5, 38, 1),
(97, 6, 38, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cariage`
--
ALTER TABLE `cariage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cariage_type_id` (`cariage_type_id`),
  ADD KEY `train_id` (`train_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cariage`
--
ALTER TABLE `cariage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- 限制导出的表
--

--
-- 限制表 `cariage`
--
ALTER TABLE `cariage`
  ADD CONSTRAINT `cariage_ibfk_1` FOREIGN KEY (`cariage_type_id`) REFERENCES `seats_type` (`id`),
  ADD CONSTRAINT `cariage_ibfk_2` FOREIGN KEY (`train_id`) REFERENCES `train` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
