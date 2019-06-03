-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2019 at 05:08 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `part_b`
--

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE `listing` (
  `id` int(11) NOT NULL,
  `list_name` varchar(45) DEFAULT NULL,
  `distance` float DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`id`, `list_name`, `distance`, `user_id`) VALUES
(1, 'Pantai Seafood Restaurant', 1.9, 1),
(2, 'Signature By The Hill @ the Roof', 2.4, 1),
(3, 'Cinnamon Coffee House', 2.6, 2),
(4, 'Village Park Restaurant', 3, 2),
(5, 'Ticklish Ribs & Wiches', 4.2, 1),
(6, 'myBurgerLab Sunway', 7.7, 1),
(7, 'the BULB COFFEE', 2.4, 2),
(8, 'PappaRich', 2.5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `encrypted_password` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `type` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `encrypted_password`, `token`, `type`) VALUES
(1, 'loweiquan@gmail.com', '$2y$10$O/zZqHj10.UnmpnSv7Zsw.eeLBPB6NHgxLmlOnoOTk.9S80Z5Roly', '26f0c3cb6f78f4bbb55a9680783272d3', 'u'),
(2, 'admin@admin.com', '$2y$10$6IY7Blb9eDQ8WGPolO4EveW7VamaRxKxnxT05wU.XAXaU99vyIu0m', '839641bb36fb48596aac3b2b509de9e0', 'a'),
(3, 'aaa@gmail.com', '$2y$10$w8wQzucCaDgbdFhMFapZ4.aWLgnPkxPv90CX4Br4YT6zeat82VXp6', 'e8bb07e19c0829b54322537179bcbb48', 'u');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `listing`
--
ALTER TABLE `listing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `listing`
--
ALTER TABLE `listing`
  ADD CONSTRAINT `listing_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
