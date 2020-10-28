-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Oct 28, 2020 at 01:18 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(250) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image_url` varchar(150) NOT NULL,
  `access` tinyint(1) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `full_name`, `email`, `phone`, `username`, `password`, `image_url`, `access`) VALUES
(1, 'Anthony Anthoine', 'anthonyanthoine@gmail.com', '71000000', 'anthony', '$2y$10$H1/5Nv2oeS7/tioQAd5sJettnsN/B7w2porsO3mxIum2l3UuGlU4e', '{\"path\":\"d4.jpg\"}', 1),
(2, 'noooo', 'no', 'no', 'no', '$2y$10$H1/5Nv2oeS7/tioQAd5sJettnsN/B7w2porsO3mxIum2l3UuGlU4e', '{\"path\":\"d5.jpg\"}', 1),
(6, 'joseph abdo', 'sadS@adfd.com', '12345', 'test', '$2y$10$BFA8EGV4GodmSGrgmBHO6OyaITOj7jcgA6nltFIkCTBHdQ9G5JVqe', '{\"path\":\"d4.jpg\"}\r\n', 1),
(13, 'test', '123', '213', 'testc', '$2y$10$QlWGdY8uUCbWUPMriQ1ZHOyFWOyoieBrKs1Owh6dPofCpWZGQZ9Ri', '{\"path\":\"1.jpg\"}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

DROP TABLE IF EXISTS `customer_order`;
CREATE TABLE IF NOT EXISTS `customer_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` int(11) NOT NULL,
  `date_ordered` date NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `customer`, `date_ordered`) VALUES
(1, 1, '2020-10-14'),
(3, 2, '2020-10-16'),
(4, 2, '2020-10-16'),
(5, 2, '2020-10-16'),
(6, 1, '2020-10-17'),
(7, 2, '2020-10-23'),
(8, 2, '2020-10-23'),
(9, 6, '2020-10-24'),
(10, 1, '2020-10-27'),
(11, 1, '2020-10-27');

-- --------------------------------------------------------

--
-- Table structure for table `customer_product`
--

DROP TABLE IF EXISTS `customer_product`;
CREATE TABLE IF NOT EXISTS `customer_product` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role` int(11) NOT NULL,
  `access` tinyint(1) NOT NULL,
  `image_url` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`employee_id`),
  KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_bill`
--

DROP TABLE IF EXISTS `employee_bill`;
CREATE TABLE IF NOT EXISTS `employee_bill` (
  `employee_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  PRIMARY KEY (`employee_id`,`bill_id`),
  KEY `bill_id` (`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_order`
--

DROP TABLE IF EXISTS `employee_order`;
CREATE TABLE IF NOT EXISTS `employee_order` (
  `employee_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`employee_id`,`order_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `manager_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role` int(11) NOT NULL,
  `access` tinyint(1) NOT NULL,
  `image_url` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`manager_id`),
  KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manager_bill`
--

DROP TABLE IF EXISTS `manager_bill`;
CREATE TABLE IF NOT EXISTS `manager_bill` (
  `manger_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  PRIMARY KEY (`manger_id`,`bill_id`),
  KEY `bill_id` (`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manager_product`
--

DROP TABLE IF EXISTS `manager_product`;
CREATE TABLE IF NOT EXISTS `manager_product` (
  `manager_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`manager_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manager_report`
--

DROP TABLE IF EXISTS `manager_report`;
CREATE TABLE IF NOT EXISTS `manager_report` (
  `manager_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  PRIMARY KEY (`manager_id`,`report_id`),
  KEY `report_id` (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(150) NOT NULL,
  `cost_price` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  `barcode` varchar(150) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image_url` varchar(150) NOT NULL,
  `flag_service` tinyint(1) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `cost_price`, `price`, `description`, `barcode`, `quantity`, `image_url`, `flag_service`) VALUES
(1, 'Uni-ball Signo Pen', 4500, 5500, 'Uni-ball Signo RT1 0.38 mm Blue Black Gel', 'A-0010-Z', 485, '{\"path\":\"Uni-ball Signo RT1 0.38 mm Blue Black Gel.jpg\"}', 0),
(2, 'Zebra Sarasa Pen', 3000, 4000, 'Zebra Sarasa Clip 0.4mm', 'A-0020-Z', 275, '{\"path\":\"Zebra Sarasa Clip 0.4mm.jpg\"}', 0),
(3, 'Pilot Hi-Tec-C Pen', 3500, 4500, 'Pilot Hi-Tec-C 0.3mm Grip Black', 'A-0030-Z', 300, '{\"path\":\"Pilot Hi-Tec-C 0.3mm Grip Black.jpg\"}', 0),
(4, 'A4 papers', 10000, 15000, 'Double A4 papers 500 sheets', 'A-0040-Z', 80, '{\"path\":\"A4 paper.jpg\"}', 0),
(5, 'Print 1 paper', 100, 500, 'Print any NON COLORED 1 paper', 'A-0050-Z', 0, '{\"path\":\"print-A4.jpg\"}', 1),
(6, 'Print 5 papers', 500, 2000, 'Print any NON COLORED 5 papers', 'A-0060-Z', 0, '{\"path\":\"print-A4.jpg\"}', 1),
(7, 'Print 10 papers', 1000, 5000, 'Print any NON COLORED 10 papers', 'A-0070-Z', 0, '{\"path\":\"print-A4.jpg\"}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_bill`
--

DROP TABLE IF EXISTS `product_bill`;
CREATE TABLE IF NOT EXISTS `product_bill` (
  `product_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`bill_id`),
  KEY `bill_id` (`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

DROP TABLE IF EXISTS `product_order`;
CREATE TABLE IF NOT EXISTS `product_order` (
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`order_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`product_id`, `order_id`, `quantity`, `price`) VALUES
(1, 5, 2, 10000),
(1, 6, 66, 330000),
(1, 7, 5, 25000),
(1, 11, 10, 55000),
(2, 10, 25, 100000),
(3, 5, 7, 31500),
(3, 8, 60, 270000),
(3, 9, 5, 22500),
(3, 10, 35, 157500),
(4, 8, 10, 150000),
(4, 9, 10, 150000);

--
-- Triggers `product_order`
--
DROP TRIGGER IF EXISTS `decreaseQuantity`;
DELIMITER $$
CREATE TRIGGER `decreaseQuantity` BEFORE INSERT ON `product_order` FOR EACH ROW UPDATE product p SET p.quantity = p.quantity - NEW.quantity WHERE p.product_id = NEW.product_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `report_url` varchar(250) NOT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(150) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'manager'),
(3, 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role` int(11) NOT NULL,
  `access` tinyint(1) NOT NULL,
  `image_url` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `full_name`, `email`, `phone`, `username`, `password`, `role`, `access`, `image_url`) VALUES
(1, 'Daisy Abou Jaoude', 'dasiyaboude@gmail.com', '71000000', 'daisy', '$2y$10$xmz.9zHdWRExja1Yz056JeLGZ3zuto47LjbftPOCG9L8XdQMK4EGS', 1, 1, '{\"path\":\"daisy1603824356.jpg\"}'),
(2, 'Barack Obamas', 'barackobama@hotmail.com', '71000001', 'obama', '$2y$10$xmz.9zHdWRExja1Yz056JeLGZ3zuto47LjbftPOCG9L8XdQMK4EGS', 2, 1, '{\"path\":\"obama1603718579.jpg\"}'),
(3, 'Donald Trump', 'dtrump@gmail.com', '71000002', 'trump', '$2y$10$xmz.9zHdWRExja1Yz056JeLGZ3zuto47LjbftPOCG9L8XdQMK4EGS', 3, 1, '{\"path\":\"donald-trump.jpg\"}'),
(4, 'Dimitri Jones', 'djones@gmail.com', '71000004', 'djones', '$2y$10$xmz.9zHdWRExja1Yz056JeLGZ3zuto47LjbftPOCG9L8XdQMK4EGS', 3, 1, '{\"path\":\"2.jpg\"}'),
(5, 'Angela Richards', 'arichards@gmail.com', '71000005', 'richards', '$2y$10$xmz.9zHdWRExja1Yz056JeLGZ3zuto47LjbftPOCG9L8XdQMK4EGS', 3, 0, '{\"path\":\"3.png\"}'),
(6, 'Matt Murdock', 'MMdock@outlook.com', '71000005', 'matt', '$2y$10$xmz.9zHdWRExja1Yz056JeLGZ3zuto47LjbftPOCG9L8XdQMK4EGS', 3, 0, '{\"path\":\"3.jpg\"}'),
(7, 'Alecko Galecki', 'aleckigalecki@gmail.com', '71000006', 'aleck', '$2y$10$xmz.9zHdWRExja1Yz056JeLGZ3zuto47LjbftPOCG9L8XdQMK4EGS', 3, 0, '{\"path\":\"3.png\"}'),
(8, 'Sara Fowler', 'sfowler@outlook.com', '71000007', 'sarahf', '$2y$10$xmz.9zHdWRExja1Yz056JeLGZ3zuto47LjbftPOCG9L8XdQMK4EGS', 3, 0, '{\"path\":\"4.jpg\"}'),
(9, 'Samir Chang', 'schangz@hotmail.com', '71000008', 'samirc', '$2y$10$xmz.9zHdWRExja1Yz056JeLGZ3zuto47LjbftPOCG9L8XdQMK4EGS', 3, 0, '{\"path\":\"5.jpg\"}'),
(10, 'Michelle Yu', 'michelleyu@gmail.com', '71000009', 'michelle', '$2y$10$xmz.9zHdWRExja1Yz056JeLGZ3zuto47LjbftPOCG9L8XdQMK4EGS', 3, 0, '{\"path\":\"6.jpg\"}'),
(11, 'Mary Bullocks', 'marybullocks@outlook.com', '71000010', 'maryb', '$2y$10$xmz.9zHdWRExja1Yz056JeLGZ3zuto47LjbftPOCG9L8XdQMK4EGS', 3, 1, '{\"path\":\"maryb1603723929.jpg\"}'),
(12, 'Veronica Anderson', 'vanderson@gmail.com', '71000011', 'veronica', '$2y$10$xmz.9zHdWRExja1Yz056JeLGZ3zuto47LjbftPOCG9L8XdQMK4EGS', 2, 0, '{\"path\":\"8.jpg\"}'),
(15, 'test4', '123', '123', 'test4', '$2y$10$xmz.9zHdWRExja1Yz056JeLGZ3zuto47LjbftPOCG9L8XdQMK4EGS', 2, 0, ''),
(16, 'sds', 'dfs', 'dfs', 'teste', '$2y$10$4hLLw1k.r7l.QQTbdytL7OudeeAk.L12tU2XxLnKL4WQfxC4zfTPC', 2, 0, '{\"path\":\"1.jpg\"}');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `customer_order_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `customer_product`
--
ALTER TABLE `customer_product`
  ADD CONSTRAINT `customer_product_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_bill`
--
ALTER TABLE `employee_bill`
  ADD CONSTRAINT `employee_bill_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_bill_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_order`
--
ALTER TABLE `employee_order`
  ADD CONSTRAINT `employee_order_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_order_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `customer_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manager_bill`
--
ALTER TABLE `manager_bill`
  ADD CONSTRAINT `manager_bill_ibfk_1` FOREIGN KEY (`manger_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manager_bill_ibfk_2` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manager_product`
--
ALTER TABLE `manager_product`
  ADD CONSTRAINT `manager_product_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manager_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manager_report`
--
ALTER TABLE `manager_report`
  ADD CONSTRAINT `manager_report_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manager_report_ibfk_2` FOREIGN KEY (`report_id`) REFERENCES `report` (`report_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_bill`
--
ALTER TABLE `product_bill`
  ADD CONSTRAINT `product_bill_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_bill_ibfk_2` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `product_order_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `product_order_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `customer_order` (`order_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
