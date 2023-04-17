-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 12:49 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `fooditems`
--

CREATE TABLE `fooditems` (
  `id` int(11) NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `itemType` varchar(10) NOT NULL,
  `price` int(11) NOT NULL,
  `discountedPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `loginform`
--

CREATE TABLE `loginform` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` varchar(3) NOT NULL DEFAULT 'NO',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loginform`
--

INSERT INTO `loginform` (`id`, `fullname`, `username`, `email`, `password`, `admin`, `created_at`) VALUES
(1, 'aaaa aaaa', 'aaaaaaaa', 'aaaaaaaa@gmail.com', '$2y$10$3hhYBmGCh4QCZElRxTD/7u9Llipkr/LDZhXEYHryXXJnZOwf0y.aC', 'YES', '2023-03-27 18:06:22'),
(2, 'bbbb bbbb', 'bbbbbbbb', 'bbbbbbbb@gmail.com', '$2y$10$Tj2x2U0suKybCnvBaSHCEexGpMWjVA5zKyMNe0vd5FMx.bwZNPmWy', 'NO', '2023-03-27 18:06:46'),
(3, 'cccc cccc', 'cccccccc', 'cccccccc@gmail.com', '$2y$10$blW1fND8aVPqgey2nnASAe02dvq9rG.p8tRM0z47tb.nryoYPnk3i', 'NO', '2023-03-27 18:07:36'),
(4, 'dddd dddd', 'dddddddd', 'dddddddd@gmail.com', '$2y$10$kyx3GkjkDkqDYvDUkVu7n.S0KdVWF6J7.4jFixtPKAWXKF6WKFpui', 'NO', '2023-03-27 18:11:47');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `item` varchar(50) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `details` varchar(50) NOT NULL DEFAULT 'Confirmed',
  `order_time` datetime NOT NULL DEFAULT current_timestamp(),
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fooditems`
--
ALTER TABLE `fooditems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loginform`
--
ALTER TABLE `loginform`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fooditems`
--
ALTER TABLE `fooditems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
