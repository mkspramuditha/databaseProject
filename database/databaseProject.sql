-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2016 at 09:44 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `databaseproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `diseasedata`
--

CREATE TABLE `diseasedata` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `diseasedataid` varchar(255) NOT NULL,
  `symptoms` varchar(1023) NOT NULL,
  `description` varchar(1023) NOT NULL,
  `victimcount` int(11) NOT NULL,
  `locationid` varchar(255) NOT NULL,
  `entryid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diseasedata`
--

INSERT INTO `diseasedata` (`id`, `userid`, `diseasedataid`, `symptoms`, `description`, `victimcount`, `locationid`, `entryid`) VALUES
(1, 'shan', 'd01', 'puka ridenawa', 'thiyanawa', 213, '81000', 'e01');

-- --------------------------------------------------------

--
-- Table structure for table `entrydetails`
--

CREATE TABLE `entrydetails` (
  `id` int(11) NOT NULL,
  `entryid` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entrydetails`
--

INSERT INTO `entrydetails` (`id`, `entryid`, `datetime`) VALUES
(1, 'e01', '2016-12-20 00:00:00'),
(6, 'entry02', '2016-11-11 12:24:18');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `locationcode` varchar(255) NOT NULL,
  `locationname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `locationcode`, `locationname`) VALUES
(1, '81000', 'Matara'),
(7, '89000', 'Kurunagala');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `roleId` varchar(255) NOT NULL,
  `roleName` varchar(255) NOT NULL,
  `adminLevel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `roleId`, `roleName`, `adminLevel`) VALUES
(7, 'ro1', 'Maha baba', '45'),
(1, 'ROLE_ADMIN', 'Role Admin', '10');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `statusId` varchar(255) NOT NULL,
  `statusName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `statusId`, `statusName`) VALUES
(8, 'K', 'Karma');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `userid`, `firstname`, `middlename`, `lastname`, `phone`, `email`) VALUES
(5, 'shan', 'shan', 'pramuditha', 'pathirana', '4238947238', 'shan@shan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `roleid` varchar(255) DEFAULT NULL,
  `statusId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `roleid`, `statusId`) VALUES
(4321, 'nipunasudha', '324fsd43', 'nipuna.sudha@gmail.com', 'ROLE_ADMIN', 'K'),
(1, 'shan', '$2a$12$E.cl1EtTNTfziopSTbRp2uH8qJYgEDi9OeGDLErJBIqUa6Y.oxive', 'mkspramuditha@gmail.com', 'ROLE_ADMIN', 'K');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diseasedata`
--
ALTER TABLE `diseasedata`
  ADD PRIMARY KEY (`diseasedataid`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `entrydetails`
--
ALTER TABLE `entrydetails`
  ADD PRIMARY KEY (`entryid`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`locationcode`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleId`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`statusId`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diseasedata`
--
ALTER TABLE `diseasedata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `entrydetails`
--
ALTER TABLE `entrydetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4322;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
