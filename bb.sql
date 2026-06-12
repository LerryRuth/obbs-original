-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2024 at 05:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bouquet`
--

CREATE TABLE `bouquet` (
  `bouquet_id` int(20) NOT NULL,
  `bouquet_name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` int(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `stock_quantity` int(40) NOT NULL,
  `search_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bouquet`
--

INSERT INTO `bouquet` (`bouquet_id`, `bouquet_name`, `description`, `price`, `image`, `stock_quantity`, `search_key`) VALUES
(1, 'Orchid', 'Cool', 10000, 'p10.jpg', 14, '0'),
(12, 'Lavendar', 'beauty', 16000, 'p20.jpg', 7, '0'),
(14, 'Rose', 'Romance', 14000, 'p14.jpg', 5, 'd'),
(16, 'Orchid', 'Uuu', 15000, 'p17.jpg', 5, 's');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(40) NOT NULL,
  `email` varchar(80) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(70) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `email`, `address`, `phone`, `password`) VALUES
(1, 'kyaw Su', 'kyaw@gmail.com', 'Taunggyi', '09661267270', '45678900'),
(2, 'kyaw Su', 'kyaw@gmail.com', 'Taunggyi', '09661267270', '00000000'),
(3, 'Hen', 'hen@gmail.com', 'Taunggyi', '09123456789', '00000000'),
(4, 'Gu', 'gu@gmail.com', 'Naypyitaw', '09689007502', '11111111'),
(5, 'Hennel', 'hennel@gmail.com', 'Taunggyi', '0123456789', '789789789');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(20) NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_address` varchar(200) NOT NULL,
  `delivery_status` int(5) NOT NULL,
  `order_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `orderitem_id` int(20) NOT NULL,
  `order_id` int(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  `price` int(200) NOT NULL,
  `bouquet_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`orderitem_id`, `order_id`, `quantity`, `price`, `bouquet_id`) VALUES
(1, 1, 2, 6000, 4),
(5, 3, 2, 5000, 3),
(6, 3, 2, 6000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(20) NOT NULL,
  `customer_id` int(20) NOT NULL,
  `bouquet_id` int(100) NOT NULL,
  `payment_id` int(100) NOT NULL,
  `status` int(6) NOT NULL,
  `delivery_date` date NOT NULL,
  `order_date` date NOT NULL,
  `total_amount` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `bouquet_id`, `payment_id`, `status`, `delivery_date`, `order_date`, `total_amount`) VALUES
(1, 1, 1, 1, 0, '2024-09-10', '2024-09-07', 12000),
(3, 2, 0, 0, 0, '2024-09-10', '2024-09-07', 22000);

-- --------------------------------------------------------

--
-- Stand-in structure for view `order_summary`
-- (See below for the actual view)
--
CREATE TABLE `order_summary` (
`order_id` int(20)
,`customer_name` varchar(40)
,`bouquet_name` varchar(200)
,`total_amount` int(225)
,`order_date` date
,`image_upload` varchar(200)
);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(100) NOT NULL,
  `order_id` int(20) NOT NULL,
  `image_upload` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `order_id`, `image_upload`) VALUES
(1, 1, 'src1.jpg');

-- --------------------------------------------------------

--
-- Structure for view `order_summary`
--
DROP TABLE IF EXISTS `order_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_summary`  AS SELECT `o`.`order_id` AS `order_id`, `c`.`customer_name` AS `customer_name`, `b`.`bouquet_name` AS `bouquet_name`, `o`.`total_amount` AS `total_amount`, `o`.`order_date` AS `order_date`, `p`.`image_upload` AS `image_upload` FROM ((((`orders` `o` join `customer` `c` on(`o`.`customer_id` = `c`.`customer_id`)) join `orderitem` `oi` on(`o`.`order_id` = `oi`.`order_id`)) join `bouquet` `b` on(`oi`.`bouquet_id` = `b`.`bouquet_id`)) left join `payment` `p` on(`o`.`order_id` = `p`.`order_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bouquet`
--
ALTER TABLE `bouquet`
  ADD PRIMARY KEY (`bouquet_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`orderitem_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bouquet`
--
ALTER TABLE `bouquet`
  MODIFY `bouquet_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `orderitem_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
