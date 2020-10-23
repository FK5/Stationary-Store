-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Oct 23, 2020 at 04:01 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `full_name`, `email`, `phone`, `username`, `password`, `image_url`, `access`) VALUES
(1, 'Anthony Anthoine', 'anthonyanthoine@gmail.com', '71000000', 'anthony', '123', '{\"path\":\"d4.jpg\"}', 1),
(2, 'noooo', 'no', 'no', 'no', '$2y$10$H1/5Nv2oeS7/tioQAd5sJettnsN/B7w2porsO3mxIum2l3UuGlU4e', '{\"path\":\"d5.jpg\"}', 1),
(3, 'test', 'fouk@gmail.com', 'asdas', 'sadasd', '$2y$10$Y6A4o1TNv1fqnm2kk6powO9TMfC1J2sZQJG/lRR/K585EQdrNV.Te', '', 1),
(4, 'zcx', 'cxz', 'zxc', 'ankdvndfn', '$2y$10$5s23Mazx1q1ARPDZy.IrWu59vhLSQEPgNBZBkhZ1wePzpzwt/7g/q', '', 1),
(5, 'zcx', 'cxz', 'zxc', 'ankdvndfnsdadasd', '$2y$10$H1/5Nv2oeS7/tioQAd5sJettnsN/B7w2porsO3mxIum2l3UuGlU4e', '', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
(8, 2, '2020-10-23');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `cost_price`, `price`, `description`, `barcode`, `quantity`, `image_url`, `flag_service`) VALUES
(1, 'Uni-ball Signo Pen', 4000, 5000, 'Uni-ball Signo RT1 0.38 mm Blue Black Gel', 'A-0010-Z', 495, '{\"path\":\"Uni-ball Signo RT1 0.38 mm Blue Black Gel.jpg\"}', 0),
(2, 'Zebra Sarasa Pen', 3000, 4000, 'Zebra Sarasa Clip 0.4mm', 'A-0020-Z', 300, '{\"path\":\"Zebra Sarasa Clip 0.4mm.jpg\"}', 0),
(3, 'Pilot Hi-Tec-C Pen', 3500, 4500, 'Pilot Hi-Tec-C 0.3mm Grip Black', 'A-0030-Z', 340, '{\"path\":\"Pilot Hi-Tec-C 0.3mm Grip Black.jpg\"}', 0),
(4, 'A4 papers', 10000, 15000, 'Double A4 papers 500 sheets', 'A-0040-Z', 90, '{\"path\":\"A4 paper.jpg\"}', 0),
(5, 'Print 1 paper', 100, 500, 'Print any NON COLORED 1 paper', 'A-0050-Z', 0, '{\"path\":\"print-A4.jpg\"}', 1),
(6, 'Print 5 papers', 500, 2000, 'Print any NON COLORED 5 papers', 'A-0060-Z', 0, '{\"path\":\"print-A4.jpg\"}', 1),
(7, 'Print 10 papers', 1000, 5000, 'Print any NON COLORED 10 papers', 'A-0070-Z', 0, '{\"path\":\"print-A4.jpg\"}', 1);

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
(3, 5, 7, 31500),
(3, 8, 60, 270000),
(4, 8, 10, 150000);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `full_name`, `email`, `phone`, `username`, `password`, `role`, `access`, `image_url`) VALUES
(1, 'Daisy Abou Jaoude', 'dasiyaboude@gmail.com', '71000000', 'daisy', '123', 1, 1, ''),
(2, 'Barack Obamas', 'barackobama@hotmail.com', '71000001', 'obama', '123', 2, 1, '{\"path\":\"barack-obama.jpg\"}'),
(3, 'Donald Trump', 'dtrump@gmail.com', '71000002', 'trump', '123', 3, 1, '{\"path\":\"donald-trump.jpg\"}'),
(4, 'Dimitri Jones', 'djones@gmail.com', '71000004', 'djones', '123', 3, 0, '{\"path\":\"2.jpg\"}'),
(5, 'Angela Richards', 'arichards@gmail.com', '71000005', 'richards', '123', 3, 0, '{\"path\":\"3.png\"}'),
(6, 'Matt Murdock', 'MMdock@outlook.com', '71000005', 'matt', '123', 3, 0, '{\"path\":\"3.jpg\"}'),
(7, 'Alecko Galecki', 'aleckigalecki@gmail.com', '71000006', 'aleck', '123', 3, 0, '{\"path\":\"3.png\"}'),
(8, 'Sara Fowler', 'sfowler@outlook.com', '71000007', 'sarahf', '123', 3, 0, '{\"path\":\"4.jpg\"}'),
(9, 'Samir Chang', 'schangz@hotmail.com', '71000008', 'samirc', '123', 3, 0, '{\"path\":\"5.jpg\"}'),
(10, 'Michelle Yu', 'michelleyu@gmail.com', '71000009', 'michelle', '123', 3, 0, '{\"path\":\"6.jpg\"}'),
(11, 'Mary Bullocks', 'marybullocks@outlook.com', '71000010', 'maryb', '123', 3, 1, '{\"path\":\"7.jpg\"}'),
(12, 'Veronica Anderson', 'vanderson@gmail.com', '71000011', 'veronica', '123', 2, 0, '{\"path\":\"8.jpg\"}');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `customer_order_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`customer_id`);

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
