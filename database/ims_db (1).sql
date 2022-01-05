-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2022 at 01:02 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `active`) VALUES
(4, 'color', 1),
(6, 'Size', 1),
(7, 'test element2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_value`
--

CREATE TABLE `attribute_value` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `attribute_parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attribute_value`
--

INSERT INTO `attribute_value` (`id`, `value`, `attribute_parent_id`) VALUES
(5, 'Blue', 2),
(6, 'White', 2),
(7, 'M', 3),
(8, 'L', 3),
(9, 'Green', 2),
(10, 'Black', 2),
(12, 'Grey', 2),
(13, 'S', 3),
(17, 'yellow', 4),
(20, 'small', 6),
(21, 'medium', 6),
(22, 'large', 6);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `active`) VALUES
(15, 'Computers', 1),
(16, 'Clothes', 1),
(17, 'Mobile', 1),
(19, 'Sample', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `active`) VALUES
(7, 'Electronic', 1),
(8, 'Dress', 1),
(9, 'Sample Category', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clinics`
--

CREATE TABLE `clinics` (
  `id` int(11) NOT NULL,
  `clinic_name` text NOT NULL,
  `clinic_address` varchar(255) NOT NULL,
  `addedby` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinics`
--

INSERT INTO `clinics` (`id`, `clinic_name`, `clinic_address`, `addedby`) VALUES
(1, 'Clinic 1', 'Philippines', 'khe'),
(2, 'Clinic 2', 'Philippines', 'Khe'),
(5, 'Clinic 3', '123', '');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `service_charge_value` varchar(255) NOT NULL,
  `vat_charge_value` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `service_charge_value`, `vat_charge_value`, `address`, `phone`, `country`, `message`, `currency`) VALUES
(1, 'Webrider', '13', '10', 'Madrid', '758676851', 'sri lanka', 'hello everyone one', 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `permission`) VALUES
(1, 'Administrator', 'a:36:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:11:\"createBrand\";i:9;s:11:\"updateBrand\";i:10;s:9:\"viewBrand\";i:11;s:11:\"deleteBrand\";i:12;s:14:\"createCategory\";i:13;s:14:\"updateCategory\";i:14;s:12:\"viewCategory\";i:15;s:14:\"deleteCategory\";i:16;s:11:\"createStore\";i:17;s:11:\"updateStore\";i:18;s:9:\"viewStore\";i:19;s:11:\"deleteStore\";i:20;s:15:\"createAttribute\";i:21;s:15:\"updateAttribute\";i:22;s:13:\"viewAttribute\";i:23;s:15:\"deleteAttribute\";i:24;s:13:\"createProduct\";i:25;s:13:\"updateProduct\";i:26;s:11:\"viewProduct\";i:27;s:13:\"deleteProduct\";i:28;s:11:\"createOrder\";i:29;s:11:\"updateOrder\";i:30;s:9:\"viewOrder\";i:31;s:11:\"deleteOrder\";i:32;s:11:\"viewReports\";i:33;s:13:\"updateCompany\";i:34;s:11:\"viewProfile\";i:35;s:13:\"updateSetting\";}'),
(5, 'Testing', 'a:19:{i:0;s:11:\"createBrand\";i:1;s:11:\"updateBrand\";i:2;s:9:\"viewBrand\";i:3;s:14:\"createCategory\";i:4;s:14:\"updateCategory\";i:5;s:12:\"viewCategory\";i:6;s:11:\"createStore\";i:7;s:11:\"updateStore\";i:8;s:9:\"viewStore\";i:9;s:15:\"createAttribute\";i:10;s:15:\"updateAttribute\";i:11;s:13:\"viewAttribute\";i:12;s:13:\"createProduct\";i:13;s:13:\"updateProduct\";i:14;s:11:\"viewProduct\";i:15;s:11:\"createOrder\";i:16;s:11:\"updateOrder\";i:17;s:9:\"viewOrder\";i:18;s:13:\"updateCompany\";}');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `gross_amount` varchar(255) NOT NULL,
  `service_charge_rate` varchar(255) NOT NULL,
  `service_charge` varchar(255) NOT NULL,
  `vat_charge_rate` varchar(255) NOT NULL,
  `vat_charge` varchar(255) NOT NULL,
  `net_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `paid_status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `bill_no`, `customer_name`, `customer_address`, `customer_phone`, `date_time`, `gross_amount`, `service_charge_rate`, `service_charge`, `vat_charge_rate`, `vat_charge`, `net_amount`, `discount`, `paid_status`, `user_id`) VALUES
(4, 'BILPR-239D', 'Shafraz', 'kolombo', '0778650336', '1526279725', '450000.00', '13', '58500.00', '10', '45000.00', '553500.00', '', 2, 1),
(5, 'BILPR-0266', 'Chris', 'California', '05552242', '1526358119', '761700.00', '13', '99021.00', '10', '76170.00', '936891.00', '', 2, 1),
(6, 'BILPR-4A66', 'John Smith', 'Saple Address', '2345678', '1606799361', '3400.00', '13', '442.00', '10', '340.00', '4182.00', '', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_item`
--

CREATE TABLE `orders_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_item`
--

INSERT INTO `orders_item` (`id`, `order_id`, `product_id`, `qty`, `rate`, `amount`) VALUES
(6, 4, 8, '3', '150000', '450000.00'),
(7, 5, 11, '13', '900', '11700.00'),
(8, 5, 10, '5', '150000', '750000.00'),
(9, 6, 12, '1', '2500', '2500.00'),
(10, 6, 11, '1', '900', '900.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `attribute_value_id` text DEFAULT NULL,
  `brand_id` text NOT NULL,
  `category_id` text NOT NULL,
  `store_id` int(11) NOT NULL,
  `availability` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `price`, `qty`, `image`, `description`, `attribute_value_id`, `brand_id`, `category_id`, `store_id`, `availability`) VALUES
(10, 'Mac', '', '150000', '39', 'assets/images/product_image/5afa5fe395f9d.jpg', '<p>sample <br></p>', '[\"17\",\"20\"]', '[\"15\"]', '[\"7\"]', 5, 1),
(11, 'Rubuke', '', '900', '36', 'assets/images/product_image/5afa6026d808e.jpg', '<p>sample<br></p>', '[\"17\",\"21\"]', '[\"15\"]', '[\"7\"]', 5, 1),
(12, 'Sample Product', '', '2500', '49', 'assets/images/product_image/5fc5cf759483c.png', '<p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rutrum nisi sed est tempor dapibus. Sed auctor porttitor ligula a hendrerit. Praesent lacus eros, pulvinar vitae ante vel, gravida ullamcorper nunc. Sed ac dolor lorem. Quisque felis magna, varius eu malesuada non, sollicitudin nec eros. Praesent pellentesque quam tellus, non dignissim erat sollicitudin sit amet. Sed suscipit tellus sit amet sem vehicula mattis. Quisque bibendum ac quam eget auctor. Pellentesque facilisis nisl mauris, vel venenatis leo varius id. Cras semper convallis tincidunt. Nam ut pulvinar justo, sed vestibulum lectus. Praesent iaculis sem at molestie mattis. Mauris sodales, ipsum a cursus pellentesque, turpis tellus ultricies velit, nec vestibulum turpis risus ac lorem.\r\n\r\n<br></p>', '[\"17\",\"21\"]', '[\"16\",\"19\"]', '[\"9\"]', 7, 1),
(13, 'test', '', '1', '1', '<p>You did not select a file to upload.</p>', '<p>test<br></p>', '[\"17\",\"20\"]', '[\"19\"]', '[\"8\"]', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `active`) VALUES
(5, 'colombo', 1),
(6, 'kandy', 1),
(7, 'Sample Warehouse', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `phone`, `gender`) VALUES
(1, 'super admin', '$2y$10$yfi5nUQGXUZtMdl27dWAyOd/jMOmATBpiUvJDmUu9hJ5Ro6BE5wsK', 'admin@admin.com', 'john', 'doe', '65646546', 1),
(11, 'shafraz', '$2y$10$LK91ERpEJxortR86lkDjwu7MClazgIrvDqehqOnq5ZKm30elKAkUa', 'shafraz@gmail.com', 'mohamed', 'nizam', '0778650669', 1),
(12, 'jsmith', '$2y$10$WLS.lZeiEfyXYfR0l/wkXeRRuqazsgIAMC9//L44J4KkZGbbqcKYC', 'jsmith@sample.com', 'John', 'Smith', '2345678', 1),
(13, 'khe123123', '$2y$10$WswJ5zRoLNme2/TSEmh9X.XffvNynh3h2Cuf/fC2kjaOwRRK7rHmW', 'kyleharveyeclevia@gmail.com', 'Kyle', 'Eclevia', '9157759045', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(7, 6, 4),
(8, 7, 4),
(9, 8, 4),
(10, 9, 5),
(11, 10, 5),
(12, 11, 5),
(13, 12, 5),
(14, 13, 5);

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `sub_description` varchar(255) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `qty_requested` int(11) NOT NULL,
  `qty_issued` int(11) NOT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `remarks` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vaccines`
--

INSERT INTO `vaccines` (`id`, `description`, `sub_description`, `total_quantity`, `qty_requested`, `qty_issued`, `expiration_date`, `remarks`) VALUES
(12, 'Test Vax', 'For testing only', 0, 0, 0, NULL, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines_disposed`
--

CREATE TABLE `vaccines_disposed` (
  `id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `disposed_date` datetime NOT NULL DEFAULT current_timestamp(),
  `disposed_by` text NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vaccines_disposed`
--

INSERT INTO `vaccines_disposed` (`id`, `vaccine_id`, `quantity`, `disposed_date`, `disposed_by`, `remarks`) VALUES
(3, 12, 50, '2022-01-04 22:40:03', 'John,Doe', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines_issued`
--

CREATE TABLE `vaccines_issued` (
  `id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `issued_date` datetime NOT NULL DEFAULT current_timestamp(),
  `issued_by` text NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vaccines_issued`
--

INSERT INTO `vaccines_issued` (`id`, `vaccine_id`, `quantity`, `issued_date`, `issued_by`, `clinic_id`, `remarks`) VALUES
(19, 12, 1, '2022-01-04 23:33:24', 'John,Doe', 1, 'test'),
(20, 12, 20, '2022-01-04 23:34:08', 'John,Doe', 1, 'Test'),
(21, 12, 10, '2022-01-04 23:37:13', 'John,Doe', 5, 'eqw'),
(22, 12, 10, '2022-01-05 19:22:46', 'John,Doe', 1, 'eqw'),
(23, 12, 10, '2022-01-05 19:22:58', 'John,Doe', 5, 'eqw');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines_per_location`
--

CREATE TABLE `vaccines_per_location` (
  `id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `location` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vaccines_per_location`
--

INSERT INTO `vaccines_per_location` (`id`, `vaccine_id`, `location`, `quantity`, `address`) VALUES
(1, 1, 'AMC 1', 50, 'Candelaria'),
(2, 1, 'AMC 2', 30, 'Dampay');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines_received`
--

CREATE TABLE `vaccines_received` (
  `id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `quantity_received` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `receive_date` datetime NOT NULL DEFAULT current_timestamp(),
  `received_by` text NOT NULL,
  `from_id` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `expiration_date` date DEFAULT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vaccines_received`
--

INSERT INTO `vaccines_received` (`id`, `vaccine_id`, `quantity_received`, `quantity`, `receive_date`, `received_by`, `from_id`, `remarks`, `expiration_date`, `status`) VALUES
(29, 12, 50, 0, '2022-01-04 22:36:27', 'John,Doe', 0, 'ewq', '2022-01-04', ''),
(30, 12, 1, 0, '2022-01-04 23:21:21', 'John,Doe', 0, 'ewqeqw', '2022-01-13', ''),
(31, 12, 30, 0, '2022-01-04 23:33:54', 'John,Doe', 0, '123', '2022-01-06', ''),
(32, 12, 20, 0, '2022-01-05 19:21:38', 'John,Doe', 0, 'Test', '2022-01-08', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clinics`
--
ALTER TABLE `clinics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccines_disposed`
--
ALTER TABLE `vaccines_disposed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccines_issued`
--
ALTER TABLE `vaccines_issued`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccines_per_location`
--
ALTER TABLE `vaccines_per_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccines_received`
--
ALTER TABLE `vaccines_received`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `clinics`
--
ALTER TABLE `clinics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders_item`
--
ALTER TABLE `orders_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vaccines_disposed`
--
ALTER TABLE `vaccines_disposed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vaccines_issued`
--
ALTER TABLE `vaccines_issued`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `vaccines_per_location`
--
ALTER TABLE `vaccines_per_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vaccines_received`
--
ALTER TABLE `vaccines_received`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
