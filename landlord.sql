-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2022 at 06:25 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `landlord`
--

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `id` tinyint(4) NOT NULL,
  `total_amt` varchar(255) DEFAULT NULL,
  `rooms` varchar(255) DEFAULT NULL,
  `expenses` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `archives`
--

INSERT INTO `archives` (`id`, `total_amt`, `rooms`, `expenses`, `updated_at`, `created_at`) VALUES
(1, '96793', '23,22,21,20,19,18,17,14,11,10,4,3', '13,12,11,10,9,8,7,6,5,4,3,2,1', '2022-10-14 22:25:32', '2022-10-14 22:25:32'),
(2, '300', '26,25,24', '14', '2022-10-14 22:27:29', '2022-10-14 22:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` tinyint(4) NOT NULL,
  `user_id` tinyint(4) DEFAULT NULL,
  `date` date NOT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `is_archived` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `user_id`, `date`, `amount`, `is_archived`, `updated_at`, `created_at`) VALUES
(1, 4, '2022-10-12', '44', 1, '2022-10-14 22:25:32', '2022-10-14 09:16:33'),
(2, 3, '2022-10-26', '34', 1, '2022-10-14 22:25:32', '2022-10-14 09:16:45'),
(3, 4, '2022-10-10', '3243', 1, '2022-10-14 22:25:32', '2022-10-14 09:17:22'),
(4, 3, '2022-10-11', '15', 1, '2022-10-14 22:25:32', '2022-10-14 09:39:08'),
(5, 4, '2022-10-10', '23', 1, '2022-10-14 22:25:32', '2022-10-14 09:52:57'),
(6, 4, '2022-10-11', '45', 1, '2022-10-14 22:25:32', '2022-10-14 09:56:43'),
(7, 3, '2022-10-19', '1', 1, '2022-10-14 22:25:32', '2022-10-14 10:16:46'),
(8, 4, '2022-10-11', '324', 1, '2022-10-14 22:25:32', '2022-10-14 10:37:10'),
(9, 3, '2022-10-19', '34', 1, '2022-10-14 22:25:32', '2022-10-14 10:37:35'),
(10, 3, '2022-10-19', '250', 1, '2022-10-14 22:25:32', '2022-10-14 10:44:18'),
(11, 4, '2022-10-12', '200', 1, '2022-10-14 22:25:32', '2022-10-14 10:48:06'),
(12, 4, '2022-10-19', '1', 1, '2022-10-14 22:25:32', '2022-10-14 11:08:54'),
(13, 3, '2022-10-11', '1', 1, '2022-10-14 22:25:32', '2022-10-14 11:09:35'),
(14, 4, '2022-10-11', '50', 1, '2022-10-14 22:27:29', '2022-10-15 03:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `room_number` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `is_archived` tinyint(4) NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `user_id`, `room_number`, `amount`, `date`, `is_archived`, `updated_at`, `created_at`) VALUES
(3, 4, '265', '25000', '2022-10-26', 1, '2022-10-14 22:25:32', '2022-10-13 05:49:46'),
(4, 4, '852', '3600', '2022-10-26', 1, '2022-10-14 22:25:32', '2022-10-13 05:55:05'),
(10, 4, '4534', '34534', '2022-10-19', 1, '2022-10-14 22:25:32', '2022-10-14 01:30:22'),
(11, 4, '3425', '34534', '2022-10-04', 1, '2022-10-14 22:25:32', '2022-10-14 01:41:39'),
(14, 4, '1111', '1212', '2022-10-19', 1, '2022-10-14 22:25:32', '2022-10-14 02:02:10'),
(17, 3, '23', '234', '2022-10-25', 1, '2022-10-14 22:25:32', '2022-10-14 04:26:49'),
(18, 4, '34', '32', '2022-10-11', 1, '2022-10-14 22:25:32', '2022-10-14 04:40:57'),
(19, 3, '35', '58', '2022-10-11', 1, '2022-10-14 22:25:32', '2022-10-14 05:30:13'),
(20, 4, '36', '1000', '2022-10-11', 1, '2022-10-14 22:25:32', '2022-10-14 05:30:30'),
(21, 4, '37', '500', '2022-10-11', 1, '2022-10-14 22:25:32', '2022-10-14 05:31:36'),
(22, 4, '38', '204', '2022-10-11', 1, '2022-10-14 22:25:32', '2022-10-14 05:32:18'),
(23, 4, '39', '100', '2022-10-18', 1, '2022-10-14 22:25:32', '2022-10-14 05:38:41'),
(24, 4, '24', '254', '2022-10-18', 1, '2022-10-14 22:27:29', '2022-10-14 22:25:58'),
(25, 4, '25', '46', '2022-10-17', 1, '2022-10-14 22:27:29', '2022-10-14 22:26:10'),
(26, 4, '5', '50', '2022-10-19', 1, '2022-10-14 22:27:29', '2022-10-14 22:26:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL COMMENT '1->admin, 2->manager, 3->employee',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `first_name`, `last_name`, `email`, `password`, `mobile`, `updated_at`, `created_at`) VALUES
(1, 1, 'Admin', NULL, 'admin@gmail.com', '$2y$10$N4Ed6OQEVd.HlcWCc3J4peXwJAN0JW2ZivZdOMqZSaWFNjHBLNd4.', NULL, '2022-10-13 05:27:18', '2022-10-13 05:27:18'),
(3, 2, 'Anurag', 'Kumar', 'anu@gm.com', '$2y$10$4Lh4svM5M0bIhwDUNE3AOuXLRiDffkm26.OifxLdyPJSxhfj9MccG', '85749623133', '2022-10-13 04:02:37', '2022-10-13 03:18:33'),
(4, 2, 'Abhi', 'Jhalani', 'abhi@gm.com', '$2y$10$9HQXdlSzuqX4qgOisY7vtev38QxE98N70OaCTb8pGMMhs8yUNgzqq', '857496231', '2022-10-13 03:18:56', '2022-10-13 03:18:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
