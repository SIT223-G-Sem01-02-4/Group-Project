-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2021 at 12:23 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phplogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(50) NOT NULL DEFAULT '',
  `rememberme` varchar(255) NOT NULL DEFAULT '',
  `role` enum('Member','Admin') NOT NULL DEFAULT 'Member',
  `make` char(20) DEFAULT NULL COMMENT 'The users vehicle make',
  `model` varchar(30) DEFAULT NULL COMMENT 'The users vehicle model',
  `reset` varchar(50) NOT NULL DEFAULT '',
  `ip` varchar(255) NOT NULL DEFAULT '',
  `2FA_code` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`, `activation_code`, `rememberme`, `role`, `make`, `model`, `reset`, `ip`, `2FA_code`) VALUES
(1, 'admin', '$2y$10$ZU7Jq5yZ1U/ifeJoJzvLbenjRyJVkSzmQKQc.X0KDPkfR3qs/iA7O', 'sit223checkyourcar@gmail.com', 'activated', '$2y$10$e5fgkzr.dBxS5q/KMMhj8eGeokE4.5Ee1bsRTZ0xY5tWPw2IyJJ6y', 'Admin', 'Holden', 'Barina', '', '127.0.0.1', '199306'),
(2, 'member', '$2y$10$de/u88RtGXqCYQ8ePYayGuUfvMAp4ljY9B09iGzGWlyjHM13qpaES', 'member@example.com', 'activated', '', 'Member', 'Audi', 'r8', '', '', ''),
(3, 'test', '$2y$10$KmAqJwTDcFoSV.3bDDyp4eOzmwIiD/JXIEPk2J60lgWvASD9YL/t.', 'test@example.com', 'activated', '', 'Member', 'Toyota', 'Yaris', '', '', '6B6C68'),
(4, 'test2', '$2y$10$a6Qq5U5wujt1RVzq.IksHOEnpJnBNseswOKE0MbkYM0FifY3xceSS', 'lukec.adobe@gmail.com', 'activated', '', 'Member', NULL, NULL, '60ab7069cd323', '127.0.0.1', '731C06');

-- --------------------------------------------------------

--
-- Table structure for table `faultsandrecalls`
--

CREATE TABLE `faultsandrecalls` (
  `id` int(11) NOT NULL COMMENT 'This Faults and Recalls ID',
  `timestamp` date NOT NULL DEFAULT current_timestamp() COMMENT 'Fault/Recall Date',
  `type` enum('Fault','Recall') NOT NULL DEFAULT 'Fault' COMMENT 'Fault or Recall',
  `description` varchar(535) DEFAULT NULL COMMENT 'Fault/Recall Description',
  `make` enum('Audi','BMW','Ferrari','Ford','Holden','Holden','Lexus','Mazda','Tesla','Toyota','Volkswagon') NOT NULL,
  `model` varchar(30) NOT NULL COMMENT 'The vehicle model of the make'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faultsandrecalls`
--

INSERT INTO `faultsandrecalls` (`id`, `timestamp`, `type`, `description`, `make`, `model`) VALUES
(4, '2021-05-23', 'Recall', 'AAAAAA', 'Holden', 'Captiva'),
(5, '2021-05-23', 'Recall', 'Faulty Seatbelt', 'Audi', 'R8'),
(6, '2021-05-23', 'Fault', 'Faulty brakes', 'Audi', 'R8'),
(7, '2021-05-23', 'Fault', 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', 'Audi', 'ss'),
(8, '2021-05-24', 'Fault', 'Dodgy Engine', 'Holden', 'Commodore');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `attempts_left` tinyint(1) NOT NULL DEFAULT 5,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faultsandrecalls`
--
ALTER TABLE `faultsandrecalls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ip_address` (`ip_address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faultsandrecalls`
--
ALTER TABLE `faultsandrecalls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'This Faults and Recalls ID', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
