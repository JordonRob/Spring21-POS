-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2021 at 11:10 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `securepos`
--
CREATE DATABASE IF NOT EXISTS `securepos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `securepos`;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
  `COID` int(11) NOT NULL,
  `PID` int(11) NOT NULL,
  `VID` int(11) NOT NULL,
  `cname` text NOT NULL,
  `coupon_sku` varchar(20) NOT NULL,
  `amount_deducted` double NOT NULL,
  `date_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `EID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee_log`
--

DROP TABLE IF EXISTS `employee_log`;
CREATE TABLE `employee_log` (
  `ELID` int(11) NOT NULL,
  `EID` int(11) NOT NULL,
  `action` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_log`
--

DROP TABLE IF EXISTS `inventory_log`;
CREATE TABLE `inventory_log` (
  `ILID` int(11) NOT NULL,
  `EID` int(11) NOT NULL,
  `PID` int(11) NOT NULL,
  `action` tinytext NOT NULL,
  `quantity` int(11) NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `PID` int(11) NOT NULL,
  `pname` text NOT NULL,
  `sku` varchar(20) NOT NULL,
  `VID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `ws_cost` double NOT NULL,
  `rt_cost` double NOT NULL,
  `is_taxable` tinyint(1) NOT NULL,
  `is_perishable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products_new`
--

DROP TABLE IF EXISTS `products_new`;
CREATE TABLE `products_new` (
  `name` varchar(255) NOT NULL,
  `code` int(100) NOT NULL,
  `price` double(10,2) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_new`
--

INSERT INTO `products_new` (`name`, `code`, `price`, `quantity`) VALUES
('Pear', 156583, 1.25, 10),
('Apple', 324454, 1.25, 10),
('Pretzel', 667424, 2.00, 10),
('Cherries', 9834616, 4.00, 10);

-- --------------------------------------------------------

--
-- Table structure for table `products_sold`
--

DROP TABLE IF EXISTS `products_sold`;
CREATE TABLE `products_sold` (
  `PSID` int(11) NOT NULL,
  `TID` int(11) NOT NULL,
  `PID` int(11) NOT NULL,
  `COID` int(11) NOT NULL,
  `is_returned` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

DROP TABLE IF EXISTS `returns`;
CREATE TABLE `returns` (
  `RID` int(11) NOT NULL,
  `PID` int(11) NOT NULL,
  `TID` int(11) NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `EID` int(11) NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

DROP TABLE IF EXISTS `taxes`;
CREATE TABLE `taxes` (
  `TXID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `TID` int(11) NOT NULL,
  `THID` int(11) NOT NULL,
  `EID` int(11) NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `TXID` int(11) NOT NULL,
  `subtotal` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `is_management` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `is_management`, `password`) VALUES
(1, 'ADMIN', 'USER', 1, '$2y$10$ZajwR3Iv0zXo7ffSzuL9Z..o4.oJWMqz87B5JnePbiT3PRc2mraRG'),
(2, 'Test', 'User', 0, '$2y$10$UgWQW2ZTFDe1YJ3gj/jT8.8A1yUjJC1BDxMl2wUN1.Kj3RAjF2J2.');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE `vendors` (
  `VID` int(11) NOT NULL,
  `company` tinytext NOT NULL,
  `EIN` tinytext NOT NULL,
  `street1` varchar(100) NOT NULL,
  `street2` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `fax` varchar(25) NOT NULL,
  `contact` varchar(75) NOT NULL,
  `email` varchar(75) NOT NULL,
  `website` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`COID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EID`);

--
-- Indexes for table `employee_log`
--
ALTER TABLE `employee_log`
  ADD PRIMARY KEY (`ELID`),
  ADD KEY `EID` (`EID`);

--
-- Indexes for table `inventory_log`
--
ALTER TABLE `inventory_log`
  ADD PRIMARY KEY (`ILID`),
  ADD KEY `EID` (`EID`),
  ADD KEY `PID` (`PID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PID`),
  ADD KEY `VID` (`VID`);

--
-- Indexes for table `products_new`
--
ALTER TABLE `products_new`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `PIDC` (`code`);

--
-- Indexes for table `products_sold`
--
ALTER TABLE `products_sold`
  ADD PRIMARY KEY (`PSID`),
  ADD KEY `TID` (`TID`),
  ADD KEY `PID` (`PID`),
  ADD KEY `COID` (`COID`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`RID`),
  ADD KEY `PID` (`PID`),
  ADD KEY `TID` (`TID`),
  ADD KEY `EID` (`EID`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`TXID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`TID`),
  ADD KEY `THID` (`THID`),
  ADD KEY `EID` (`EID`),
  ADD KEY `TXID` (`TXID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`VID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `COID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `EID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_log`
--
ALTER TABLE `employee_log`
  MODIFY `ELID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_log`
--
ALTER TABLE `inventory_log`
  MODIFY `ILID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_new`
--
ALTER TABLE `products_new`
  MODIFY `code` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9834617;

--
-- AUTO_INCREMENT for table `products_sold`
--
ALTER TABLE `products_sold`
  MODIFY `PSID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `RID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `TXID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `TID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `VID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupons_ibfk_1` FOREIGN KEY (`PID`) REFERENCES `products` (`PID`),
  ADD CONSTRAINT `coupons_ibfk_2` FOREIGN KEY (`VID`) REFERENCES `vendors` (`VID`),
  ADD CONSTRAINT `coupons_ibfk_3` FOREIGN KEY (`PID`) REFERENCES `products` (`PID`),
  ADD CONSTRAINT `coupons_ibfk_4` FOREIGN KEY (`VID`) REFERENCES `vendors` (`VID`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`EID`) REFERENCES `employee_log` (`ELID`);

--
-- Constraints for table `inventory_log`
--
ALTER TABLE `inventory_log`
  ADD CONSTRAINT `inventory_log_ibfk_1` FOREIGN KEY (`EID`) REFERENCES `employees` (`EID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`VID`) REFERENCES `vendors` (`VID`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`PID`) REFERENCES `inventory_log` (`PID`);

--
-- Constraints for table `products_sold`
--
ALTER TABLE `products_sold`
  ADD CONSTRAINT `products_sold_ibfk_1` FOREIGN KEY (`TID`) REFERENCES `transactions` (`TID`),
  ADD CONSTRAINT `products_sold_ibfk_2` FOREIGN KEY (`PID`) REFERENCES `products` (`PID`),
  ADD CONSTRAINT `products_sold_ibfk_3` FOREIGN KEY (`COID`) REFERENCES `coupons` (`COID`);

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_ibfk_1` FOREIGN KEY (`TID`) REFERENCES `transactions` (`TID`),
  ADD CONSTRAINT `returns_ibfk_2` FOREIGN KEY (`PID`) REFERENCES `products` (`PID`),
  ADD CONSTRAINT `returns_ibfk_3` FOREIGN KEY (`EID`) REFERENCES `employees` (`EID`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`TID`) REFERENCES `products_sold` (`TID`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`EID`) REFERENCES `employees` (`EID`),
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`TXID`) REFERENCES `taxes` (`TXID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
