-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2023 at 03:57 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testpahse`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'malik', 'ketuk@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '2023-03-31 07:35:25'),
(2, 'malik2', 'beqiv@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '2023-03-31 07:55:59'),
(3, 'riguveridy', 'aminmudassir9@gmail.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '2023-03-31 09:26:07'),
(4, 'muwyvoz', 'dyromopu@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '2023-03-31 12:21:47'),
(5, 'zawoke', 'zolifyd@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '2023-03-31 13:21:59'),
(6, 'wobenacy', 'vasepano@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '2023-03-31 13:49:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
