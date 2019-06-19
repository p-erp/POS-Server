-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2019 at 08:44 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jm_sales`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(33) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_added` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_added`) VALUES
(4, 'Pork', ''),
(5, 'Chicken', ''),
(6, 'Grocery', '');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(35) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_contact_number` varchar(35) NOT NULL,
  `customer_username` varchar(255) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `customer_date_created` varchar(255) NOT NULL,
  `customer_image` varchar(655) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers_sale`
--

CREATE TABLE `customers_sale` (
  `customers_sales_id` int(35) NOT NULL,
  `customer_username` varchar(35) NOT NULL,
  `customer_transaction_date` varchar(355) NOT NULL,
  `customer_amount_sales` double(35,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(35) NOT NULL,
  `inventory_item_name` varchar(255) NOT NULL,
  `stock` int(35) NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `inventory_item_name`, `stock`, `updated_by`) VALUES
(18, 'liempo', 106, 'noName'),
(19, 'legs', 181, 'noName'),
(20, 'wings', 193, 'noName'),
(21, 'hotdog', 84, 'noName'),
(22, 'groc', 203, 'noName'),
(23, 'xdff', 49, 'noName'),
(24, 'cffgg', 521, 'noName');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(33) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` double(35,2) NOT NULL,
  `item_desc` varchar(255) NOT NULL,
  `item_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `category_name`, `item_name`, `item_price`, `item_desc`, `item_image`) VALUES
(18, 'Pork', 'liempo', 210.00, 'liepo', 'noImage.png'),
(19, 'Chicken', 'legs', 210.00, 'lgs', 'noImage.png'),
(20, 'Chicken', 'wings', 145.00, 'ffff', 'noImage.png'),
(21, 'Grocery', 'hotdog', 145.00, 'hotdogs', 'noImage.png'),
(22, 'Grocery', 'groc', 210.00, 'groc', 'noImage.png'),
(23, 'Grocery', 'xdff', 555.00, 'fft', 'noImage.png'),
(24, 'Grocery', 'cffgg', 888.00, 'vgggggg', 'cffgg_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `monthly_capital`
--

CREATE TABLE `monthly_capital` (
  `capital_id` int(35) NOT NULL,
  `month` varchar(35) NOT NULL,
  `capital_month` double(35,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `receipt_id` int(35) NOT NULL,
  `receipt_date` varchar(255) NOT NULL,
  `receipt_inChange` varchar(255) NOT NULL,
  `receipt_deviceID` varchar(255) NOT NULL,
  `receipt_itemName` varchar(255) NOT NULL,
  `receipt_itemPrice` double(35,2) NOT NULL,
  `receipt_itemQuantity` double(35,2) NOT NULL,
  `receipt_itemTotal` double(35,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(35) NOT NULL,
  `sales_day` varchar(35) NOT NULL,
  `sales_month` varchar(35) NOT NULL,
  `sales_year` varchar(35) NOT NULL,
  `sales_item_name` varchar(255) NOT NULL,
  `sales_item_price` double(35,2) NOT NULL,
  `sales_item_quantity` double(35,2) NOT NULL,
  `sales_item_total` double(35,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `sales_day`, `sales_month`, `sales_year`, `sales_item_name`, `sales_item_price`, `sales_item_quantity`, `sales_item_total`) VALUES
(24, '14', 'June', '2019', 'porkchop', 210.00, 23.00, 4830.00),
(25, '14', 'June', '2019', 'legs', 210.00, 8.00, 1680.00),
(26, '14', 'June', '2019', 'liempo', 210.00, 7.00, 1470.00),
(27, '14', 'June', '2019', 'porkchop', 210.00, 11.00, 2310.00),
(28, '14', 'June', '2019', 'porkchop', 210.00, 4.00, 840.00),
(29, '14', 'June', '2019', 'liempo', 210.00, 1.00, 210.00),
(30, '14', 'June', '2019', 'hotdog', 145.00, 1.00, 145.00),
(31, '14', 'June', '2019', 'porkchop', 210.00, 4.00, 840.00),
(32, '14', 'June', '2019', 'legs', 210.00, 1.00, 210.00),
(33, '14', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(34, '14', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(35, '14', 'June', '2019', 'liempo', 210.00, 1.00, 210.00),
(36, '14', 'June', '2019', 'porkchop', 210.00, 2.00, 420.00),
(37, '14', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(38, '14', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(39, '14', 'June', '2019', 'porkchop', 210.00, 4.00, 840.00),
(40, '14', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(41, '14', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(42, '14', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(43, '14', 'June', '2019', 'liempo', 210.00, 5.00, 1050.00),
(44, '14', 'June', '2019', 'liempo', 210.00, 5.00, 1050.00),
(45, '14', 'June', '2019', 'legs', 210.00, 1.00, 210.00),
(46, '14', 'June', '2019', 'porkchop', 210.00, 3.00, 630.00),
(47, '14', 'June', '2019', 'liempo', 210.00, 1.00, 210.00),
(48, '14', 'June', '2019', 'hotdog', 145.00, 2.00, 290.00),
(49, '16', 'June', '2019', 'liempo', 210.00, 9.00, 1890.00),
(50, '16', 'June', '2019', 'porkchop', 210.00, 5.00, 1050.00),
(51, '16', 'June', '2019', 'porkchop', 210.00, 3.00, 630.00),
(52, '16', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(53, '16', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(54, '16', 'June', '2019', 'liempo', 210.00, 5.00, 1050.00),
(55, '16', 'June', '2019', 'wings', 145.00, 1.00, 145.00),
(56, '16', 'June', '2019', 'wings', 145.00, 1.00, 145.00),
(57, '16', 'June', '2019', 'liempo', 210.00, 1.00, 210.00),
(58, '16', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(59, '16', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(60, '16', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(61, '16', 'June', '2019', 'porkchop', 210.00, 3.00, 630.00),
(62, '16', 'June', '2019', 'liempo', 210.00, 1.00, 210.00),
(63, '16', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(64, '16', 'June', '2019', 'liempo', 210.00, 1.00, 210.00),
(65, '16', 'June', '2019', 'liempo', 210.00, 1.00, 210.00),
(66, '16', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(67, '16', 'June', '2019', 'porkchop', 210.00, 8.00, 1680.00),
(68, '16', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(69, '16', 'June', '2019', 'liempo', 210.00, 2.00, 420.00),
(70, '16', 'June', '2019', 'hotdog', 145.00, 1.00, 145.00),
(71, '16', 'June', '2019', 'wings', 145.00, 1.00, 145.00),
(72, '16', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(73, '16', 'June', '2019', 'liempo', 210.00, 5.00, 1050.00),
(74, '16', 'June', '2019', 'porkchop', 210.00, 4.00, 840.00),
(75, '16', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(76, '16', 'June', '2019', 'liempo', 210.00, 3.00, 630.00),
(77, '16', 'June', '2019', 'wings', 145.00, 1.00, 145.00),
(78, '16', 'June', '2019', 'liempo', 210.00, 1.00, 210.00),
(79, '16', 'June', '2019', 'wings', 145.00, 1.00, 145.00),
(80, '17', 'June', '2019', 'porkchop', 210.00, 3.00, 630.00),
(81, '17', 'June', '2019', 'liempo', 210.00, 1.00, 210.00),
(82, '17', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(83, '17', 'June', '2019', 'liempo', 210.00, 2.00, 420.00),
(84, '17', 'June', '2019', 'porkchop', 210.00, 2.00, 420.00),
(85, '17', 'June', '2019', 'porkchop', 210.00, 3.00, 630.00),
(86, '17', 'June', '2019', 'porkchop', 210.00, 2.00, 420.00),
(87, '17', 'June', '2019', 'porkchop', 210.00, 2.00, 420.00),
(88, '17', 'June', '2019', 'liempo', 210.00, 2.00, 420.00),
(89, '17', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(90, '17', 'June', '2019', 'wings', 145.00, 2.00, 290.00),
(91, '17', 'June', '2019', 'porkchop', 210.00, 2.00, 420.00),
(92, '17', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(93, '17', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(94, '17', 'June', '2019', 'porkchop', 210.00, 2.00, 420.00),
(95, '17', 'June', '2019', 'hotdog', 145.00, 2.00, 290.00),
(96, '17', 'June', '2019', 'porkchop', 210.00, 2.00, 420.00),
(97, '17', 'June', '2019', 'liempo', 210.00, 2.00, 420.00),
(98, '17', 'June', '2019', 'porkchop', 210.00, 2.00, 420.00),
(99, '17', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(100, '17', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(101, '17', 'June', '2019', 'porkchop', 210.00, 2.00, 420.00),
(102, '17', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(103, '17', 'June', '2019', 'wings', 145.00, 1.00, 145.00),
(104, '17', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(105, '17', 'June', '2019', 'porkchop', 210.00, 2.00, 420.00),
(106, '17', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(107, '17', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(108, '17', 'June', '2019', 'porkchop', 210.00, 2.00, 420.00),
(109, '17', 'June', '2019', 'porkchop', 210.00, 4.00, 840.00),
(110, '17', 'June', '2019', 'legs', 210.00, 3.00, 630.00),
(111, '17', 'June', '2019', 'liempo', 210.00, 1.00, 210.00),
(112, '17', 'June', '2019', 'hotdog', 145.00, 1.00, 145.00),
(113, '17', 'June', '2019', 'porkchop', 210.00, 2.00, 420.00),
(114, '17', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(115, '17', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(116, '17', 'June', '2019', 'porkchop', 210.00, 4.00, 840.00),
(117, '17', 'June', '2019', 'cffgg', 888.00, 30.00, 26640.00),
(118, '17', 'June', '2019', 'hotdog', 145.00, 1.00, 145.00),
(119, '17', 'June', '2019', 'cffgg', 888.00, 1.00, 888.00),
(120, '17', 'June', '2019', 'groc', 210.00, 3.00, 630.00),
(121, '17', 'June', '2019', 'xdff', 555.00, 1.00, 555.00),
(122, '17', 'June', '2019', 'hotdog', 145.00, 1.00, 145.00),
(123, '17', 'June', '2019', 'cffgg', 888.00, 2.00, 1776.00),
(124, '17', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(125, '17', 'June', '2019', 'liempo', 210.00, 1.00, 210.00),
(126, '17', 'June', '2019', 'groc', 210.00, 1.00, 210.00),
(127, '17', 'June', '2019', 'hotdog', 145.00, 1.00, 145.00),
(128, '17', 'June', '2019', 'porkchop', 210.00, 1.00, 210.00),
(129, '18', 'June', '2019', 'cffgg', 888.00, 1.00, 888.00),
(130, '18', 'June', '2019', 'hotdog', 145.00, 2.00, 290.00),
(131, '18', 'June', '2019', 'groc', 210.00, 3.00, 630.00),
(132, '18', 'June', '2019', 'liempo', 210.00, 1.00, 210.00),
(133, '18', 'June', '2019', 'liempo', 210.00, 1.00, 210.00),
(134, '18', 'June', '2019', 'wings', 145.00, 1.00, 145.00),
(135, '18', 'June', '2019', 'wings', 145.00, 1.00, 145.00),
(136, '18', 'June', '2019', 'liempo', 210.00, 1.00, 210.00),
(137, '19', 'June', '2019', 'liempo', 210.00, 3.00, 630.00);

-- --------------------------------------------------------

--
-- Table structure for table `temp_cart`
--

CREATE TABLE `temp_cart` (
  `cart_id` int(35) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_quantity` double(35,2) NOT NULL,
  `item_price` double(35,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_cart`
--

INSERT INTO `temp_cart` (`cart_id`, `customer_id`, `item_name`, `item_quantity`, `item_price`) VALUES
(2, 20190619, 'liempo', 1.00, 210.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(30) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `age` varchar(30) NOT NULL,
  `contact_number` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `age`, `contact_number`, `address`, `username`, `password`) VALUES
(1, 'mark', 'rosario', '2', '09997094471', 'pas8g', 'haripazha', '123'),
(2, 'yuhan', 'jaycee', '23', '01295259', 'pasig', 'yuhan', 'yuhan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customers_sale`
--
ALTER TABLE `customers_sale`
  ADD PRIMARY KEY (`customers_sales_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `monthly_capital`
--
ALTER TABLE `monthly_capital`
  ADD PRIMARY KEY (`capital_id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `temp_cart`
--
ALTER TABLE `temp_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(33) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(35) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers_sale`
--
ALTER TABLE `customers_sale`
  MODIFY `customers_sales_id` int(35) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(35) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(33) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `monthly_capital`
--
ALTER TABLE `monthly_capital`
  MODIFY `capital_id` int(35) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `receipt_id` int(35) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(35) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `temp_cart`
--
ALTER TABLE `temp_cart`
  MODIFY `cart_id` int(35) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
