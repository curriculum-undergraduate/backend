-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Apr 19, 2022 at 07:16 AM
-- Server version: 5.7.37
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lumintu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `batch_id` int(11) NOT NULL,
  `batch_name` varchar(255) NOT NULL,
  `batch_start_date` date NOT NULL,
  `batch_end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batch_id`, `batch_name`, `batch_start_date`, `batch_end_date`) VALUES
(1, 'Batch 1', '2022-05-10', '2022-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Lecture'),
(3, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(0, 'Unassigned'),
(1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '0',
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_full_name` varchar(255) DEFAULT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_dob` date DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_gender` varchar(255) DEFAULT NULL,
  `user_phone` varchar(255) DEFAULT NULL,
  `user_profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `role_id`, `status_id`, `user_email`, `user_password`, `user_full_name`, `user_username`, `user_dob`, `user_address`, `user_gender`, `user_phone`, `user_profile_picture`) VALUES
(1, 1, 1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '', 'admin', NULL, NULL, NULL, NULL, NULL),
(45, 3, 0, 'theisandatu@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'antheiz', NULL, NULL, NULL, NULL, NULL),
(46, 3, 0, 'devaldicaliesta@gmail.com', '64457c3aef4eb727a67062cf588431cb7ef13820', '', 'devaldicaliestaa', NULL, NULL, NULL, NULL, NULL),
(47, 3, 0, 'Joko@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'Joko', NULL, NULL, NULL, NULL, NULL),
(48, 3, 0, 'Ilham@gmail.com', 'b5c4b61cd4987f090187f8c2c549ab91', '', 'Ilham', NULL, NULL, NULL, NULL, NULL),
(49, 3, 0, 'bedu@gmail.com', 'f6492a96e8e0986e072df3b36471644736eebad4', '', 'bedu', NULL, NULL, NULL, NULL, NULL),
(55, 3, 0, 'theissentani@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '', 'antheis', NULL, NULL, NULL, NULL, NULL),
(56, 3, 0, 'rio@gmail.com', '7fb1491b9476040c4790b96ba9221db49a879c8e', '', 'rio', NULL, NULL, NULL, NULL, NULL),
(57, 3, 0, 'asin@gmail.com', '62130e1b1e81120c6344cc4e661f9e4b', '', 'Asin', NULL, NULL, NULL, NULL, NULL),
(58, 3, 0, 'Asam@gmail.com', '958989e2bc36fee94a97c75df013a07e', '', 'Asam', NULL, NULL, NULL, NULL, NULL),
(59, 2, 0, 'Garam@gmail.com', '7765c876e97b476e94a1a9076a4493af', '', 'Garam', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_batch`
--

CREATE TABLE `user_batch` (
  `user_batch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`batch_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `user_batch`
--
ALTER TABLE `user_batch`
  ADD PRIMARY KEY (`user_batch_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `batch_id` (`batch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `user_batch`
--
ALTER TABLE `user_batch`
  MODIFY `user_batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_batch`
--
ALTER TABLE `user_batch`
  ADD CONSTRAINT `user_batch_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_batch_ibfk_2` FOREIGN KEY (`batch_id`) REFERENCES `batch` (`batch_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
