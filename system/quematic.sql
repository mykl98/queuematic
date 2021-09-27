-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 27, 2021 at 05:12 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quematic`
--

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `idx` int(11) NOT NULL,
  `id` text NOT NULL,
  `description` text NOT NULL,
  `counter` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `idx` int(11) NOT NULL,
  `name` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`idx`, `name`, `value`) VALUES
(1, 'update', 'false'),
(2, 'name', ''),
(3, 'logo', ''),
(4, 'counter1name', 'Mayor\'s Office'),
(5, 'counter2name', 'Counter 2'),
(6, 'counter3name', 'Counter 3'),
(7, 'counter4name', 'Counter 4'),
(8, 'counter5name', 'Counter 5'),
(9, 'counter1prefix', 'A'),
(10, 'counter2prefix', 'B'),
(11, 'counter3prefix', 'C'),
(12, 'counter4prefix', 'D'),
(13, 'counter5prefix', 'E'),
(14, 'counter1serving', '1'),
(15, 'counter2serving', '0'),
(16, 'counter3serving', '0'),
(17, 'counter4serving', '0'),
(18, 'counter5serving', '0'),
(19, 'color', '#000080'),
(20, 'token', 'gPR5K9ift9ETKVbSFvnDV0PGuLo6u7ujvnRPuePiyFFanFbXWlwDkXmtNVIuDagGq0BWZvVwCI6m3vrVTuHgP7M3FRk653zQFcSs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`idx`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`idx`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
