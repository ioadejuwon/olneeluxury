-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 31, 2025 at 04:11 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bobthebuilder`
--

-- --------------------------------------------------------

--
-- Table structure for table `olnee_admin`
--

CREATE TABLE `olnee_admin` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verify` int(11) NOT NULL,
  `pword_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `olnee_admin`
--

INSERT INTO `olnee_admin` (`id`, `user_id`, `fname`, `lname`, `username`, `email`, `email_verify`, `pword_hash`, `created_at`) VALUES
(1, 'bQD9HtNYhW', 'Oluwasegun', 'Adejuwon', 'testuser', 'test@gmail.com', 0, '$2y$10$BnL/QO./XMmdad7Aw8rRF./21pJ0vkVaFUOyL13xMFt13SjUjqHY2', '2024-07-19 08:33:32'),
(2, '6ZBcqSI', 'Oluwasegun', 'Adejuwon', 'Terabyte', 'ioadejuwon@gmail.com', 0, '$2y$10$WNXL8LGqiHnjtwEHoLKxY.NyHdNnMDA.f3YTsUruxQ3txZw0hrdUe', '2025-02-14 11:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `olnee_cart`
--

CREATE TABLE `olnee_cart` (
  `id` int(11) NOT NULL,
  `cart_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productid` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `olnee_cart`
--

INSERT INTO `olnee_cart` (`id`, `cart_id`, `productid`, `product_img`, `quantity`, `price`, `created_at`) VALUES
(34, 'cart-a37-4d6', 'prod-AYR-s04', 'products/66a3e51f4ec445.73910591.jpg', 1, '2348.00', '2024-07-29 20:07:08'),
(35, 'cart-a37-4d6', 'prod-8zy-1fC', 'products/669ccd4bc689d2.73565156.jpg', 1, '90000.00', '2024-07-29 20:07:08');

-- --------------------------------------------------------

--
-- Table structure for table `olnee_categories`
--

CREATE TABLE `olnee_categories` (
  `id` int(11) NOT NULL,
  `categoryid` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `olnee_categories`
--

INSERT INTO `olnee_categories` (`id`, `categoryid`, `categoryName`, `created_at`) VALUES
(2, 'cat-7JA-fwe', 'Gym Wears', '2024-07-19 11:54:48'),
(5, 'cat-HtM-zBt', 'Shirts', '2024-07-19 22:41:50'),
(6, 'cat-FtG-dd4', 'Gowns', '2024-07-20 17:26:17'),
(13, 'cat-Srf-SdG', 'Bags', '2024-07-30 09:18:49'),
(14, 'cat-LxM-pXZ', 'shoes', '2024-08-08 14:45:46'),
(15, 'cat-hXY-bHw', 'None', '2025-02-14 11:44:00'),
(16, 'cat-vTa-231', 'dddddd', '2025-02-14 11:44:06'),
(17, 'cat-JNK-F1X', 'New Category', '2025-02-15 20:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `olnee_coupons`
--

CREATE TABLE `olnee_coupons` (
  `ID` int(11) NOT NULL,
  `user_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `couponName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `couponCode` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `couponType` int(11) NOT NULL,
  `couponValue` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `olnee_coupons`
--

INSERT INTO `olnee_coupons` (`ID`, `user_id`, `coupon_id`, `couponName`, `couponCode`, `couponType`, `couponValue`, `created_at`) VALUES
(1, 'bQD9HtNYhW', 'coupon-Yqbhc', 'Random', 'BOB', 1, 20, '2025-03-25 07:09:54'),
(2, 'bQD9HtNYhW', 'coupon-lQMAt', 'Random2', 'BOB2', 1, 30, '2025-03-25 07:16:31'),
(3, 'bQD9HtNYhW', 'coupon-eSTwW', 'Random3', 'BOB3', 1, 40, '2025-03-25 07:17:05'),
(4, 'bQD9HtNYhW', 'coupon-CM1bN', 'Random4', 'BOB4', 2, 10000, '2025-03-25 07:19:10'),
(5, 'bQD9HtNYhW', 'coupon-PZT8Q', 'Fixed Type', 'NEWUSER', 1, 40, '2025-03-25 10:24:30'),
(6, 'bQD9HtNYhW', 'coupon-m63zu', 'Percentage Off', 'USERS', 2, 10000, '2025-03-25 10:25:09'),
(7, 'bQD9HtNYhW', 'coupon-7vW4L', 'Random2', '2345', 2, 5432, '2025-03-25 10:26:15'),
(8, 'bQD9HtNYhW', 'coupon-iVYfj', '2435t3244', '2434t23454', 1, 435234, '2025-03-25 10:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `olnee_delivery`
--

CREATE TABLE `olnee_delivery` (
  `ID` int(11) NOT NULL,
  `user_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deliveryID` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deliveryName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deliveryCost` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `olnee_delivery`
--

INSERT INTO `olnee_delivery` (`ID`, `user_id`, `deliveryID`, `deliveryName`, `deliveryCost`, `created_at`) VALUES
(9, 'bQD9HtNYhW', 'del--erW9xwErEV', 'tvfc', '54322.00', '2025-03-19 22:20:33'),
(13, 'bQD9HtNYhW', 'del--NuoZMTPNRj', 'Mainland', '3000.00', '2025-03-19 22:23:47'),
(14, 'bQD9HtNYhW', 'del--n26iKgz0Yz', 'Lagos', '4000.00', '2025-03-19 22:23:55'),
(15, 'bQD9HtNYhW', 'del--3t88iSxkYR', 'Ife', '700.00', '2025-03-19 22:24:05'),
(16, 'bQD9HtNYhW', 'del--ygKQXKkfpy', 'DHL - Lagos', '7000.00', '2025-03-19 22:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `olnee_orders`
--

CREATE TABLE `olnee_orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `shipping` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `paymentOption` int(3) NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `olnee_orders`
--

INSERT INTO `olnee_orders` (`id`, `order_id`, `first_name`, `last_name`, `email`, `phone`, `country`, `state`, `city`, `street`, `notes`, `subtotal`, `discount`, `shipping`, `total`, `paymentOption`, `status`, `created_at`) VALUES
(74, 'order-jO3I-TwIi', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '4000.00', '0.00', '54322.00', '58322.00', 4, 'Pending', '2025-03-24 15:46:03'),
(75, 'order-Gfj8-ezek', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 1, 'Pending', '2025-03-24 20:28:36'),
(76, 'order-SDNU-ELAN', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 2, 'Pending', '2025-03-24 20:29:02'),
(77, 'order-99fO-O6ks', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 2, 'Failed', '2025-03-24 20:29:58'),
(78, 'order-emSt-h4Rc', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 2, 'Pending', '2025-03-24 20:31:41'),
(79, 'order-Hf2y-Poo2', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 2, 'Pending', '2025-03-24 20:32:28'),
(80, 'order-3Uql-xjwX', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 2, 'Pending', '2025-03-24 20:32:47'),
(81, 'order-cuhi-LbDS', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 2, 'Pending', '2025-03-24 20:33:59'),
(82, 'order-F8gf-3SPA', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 2, 'Pending', '2025-03-24 20:34:31'),
(83, 'order-45vp-8QyW', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 2, 'Pending', '2025-03-24 20:38:48'),
(84, 'order-OVqQ-B95e', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 3, 'Pending', '2025-03-24 20:38:59'),
(85, 'order-gNwu-sIYn', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 20:39:06'),
(86, 'order-E2UH-1top', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 1, 'Pending', '2025-03-24 20:39:50'),
(87, 'order-uiqX-o8ui', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 1, 'Pending', '2025-03-24 20:40:09'),
(88, 'order-RfLR-vucU', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 2, 'Pending', '2025-03-24 20:41:00'),
(89, 'order-NTkI-Qnkr', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 2, 'Pending', '2025-03-24 20:41:03'),
(90, 'order-fwZN-td4X', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 2, 'Failed', '2025-03-24 20:42:30'),
(91, 'order-ffqx-l5dn', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 2, 'Pending', '2025-03-24 20:43:48'),
(92, 'order-i1tH-Lpal', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 1, 'Pending', '2025-03-24 20:43:56'),
(93, 'order-0QW7-Oqko', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 3, 'Pending', '2025-03-24 20:44:24'),
(94, 'order-tjqg-Kirg', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 20:44:28'),
(95, 'order-lWGj-cKj0', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 2, 'Pending', '2025-03-24 20:52:36'),
(96, 'order-oFiM-XdVT', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 2, 'Pending', '2025-03-24 20:52:55'),
(97, 'order-IrVy-y4h4', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '0.00', '1500.00', 2, 'Pending', '2025-03-24 20:53:41'),
(98, 'order-GTjQ-24IE', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '0.00', '1500.00', 1, 'Failed', '2025-03-24 20:56:41'),
(99, 'order-jHpu-oxzy', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:20:58'),
(100, 'order-VA9H-PIiN', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:21:08'),
(101, 'order-dloz-0VqQ', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:21:24'),
(102, 'order-XeSb-ayGr', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:21:36'),
(103, 'order-8saC-sdvk', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:21:47'),
(104, 'order-obpQ-m3gL', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:23:37'),
(105, 'order-Xk0T-VKnK', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:23:38'),
(106, 'order-87qO-I9Ul', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:25:47'),
(107, 'order-WlVA-3ILb', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:27:05'),
(108, 'order-7ZGN-sgVF', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:31:05'),
(109, 'order-0RMl-7zXj', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:31:37'),
(110, 'order-Alta-0Jpj', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:31:57'),
(111, 'order-PoDL-hK4s', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:32:08'),
(112, 'order-nerJ-BLjl', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:32:39'),
(113, 'order-vziM-LAsA', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:33:24'),
(114, 'order-1QNt-C8WH', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:35:18'),
(115, 'order-frX1-LiCK', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:48:16'),
(116, 'order-PhpL-uatv', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:49:44'),
(117, 'order-GugH-bzNm', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 21:51:22'),
(118, 'order-hLyx-nXae', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 22:10:01'),
(119, 'order-BlMS-jslI', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '1500.00', '0.00', '700.00', '2200.00', 4, 'Pending', '2025-03-24 22:12:05'),
(120, 'order-oqZA-9Yjm', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '5500.00', '0.00', '7000.00', '12500.00', 4, 'Pending', '2025-03-24 22:13:07'),
(121, 'order-jQQi-bUZn', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '5500.00', '0.00', '0.00', '5500.00', 4, 'Pending', '2025-03-24 22:18:47'),
(122, 'order-Yey6-B9ev', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '5500.00', '0.00', '4000.00', '9500.00', 4, 'Pending', '2025-03-24 22:19:10'),
(123, 'order-Fct9-4Odw', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '5500.00', '0.00', '4000.00', '9500.00', 1, 'Pending', '2025-03-24 22:19:40'),
(124, 'order-zEiA-O1YV', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '5500.00', '0.00', '4000.00', '9500.00', 1, 'Pending', '2025-03-24 22:19:42'),
(125, 'order-crwx-m27E', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '5500.00', '0.00', '4000.00', '9500.00', 2, 'Pending', '2025-03-24 22:19:57'),
(126, 'order-8n2b-jmoU', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '5500.00', '0.00', '4000.00', '9500.00', 3, 'Pending', '2025-03-24 22:20:09'),
(127, 'order-GlJT-Oicy', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '5500.00', '0.00', '4000.00', '9500.00', 2, 'Pending', '2025-03-24 23:13:17'),
(128, 'order-kbRW-uYcv', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '10500.00', '10000.00', '3000.00', '3500.00', 4, 'Pending', '2025-03-25 12:32:18'),
(129, 'order-dVK2-l3o0', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '10500.00', '10000.00', '700.00', '1200.00', 4, 'Pending', '2025-03-25 12:38:24'),
(130, 'order-6UBc-CE6d', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '4000.00', '800.00', '700.00', '3900.00', 1, 'Failed', '2025-03-25 12:49:39'),
(131, 'order-hfEx-kaIo', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '4000.00', '800.00', '4000.00', '7200.00', 1, 'Failed', '2025-03-25 12:54:22'),
(132, 'order-m8DF-bmEI', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '4000.00', '800.00', '700.00', '3900.00', 4, 'Pending', '2025-03-25 12:59:04'),
(133, 'order-vX2W-i5xm', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '4000.00', '800.00', '700.00', '3900.00', 4, 'Pending', '2025-03-25 12:59:07'),
(134, 'order-yMdY-z7u3', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '4000.00', '800.00', '700.00', '3900.00', 4, 'Pending', '2025-03-25 13:00:25'),
(135, 'order-PdXa-acK5', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '4000.00', '800.00', '700.00', '3900.00', 4, 'Pending', '2025-03-25 13:00:30'),
(136, 'order-UcK5-lPaI', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '4000.00', '800.00', '700.00', '3900.00', 4, 'Pending', '2025-03-25 13:00:36'),
(137, 'order-YpYi-AvAc', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '4000.00', '800.00', '700.00', '3900.00', 4, 'Pending', '2025-03-25 13:02:31'),
(138, 'order-KSNa-Ft33', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '4000.00', '800.00', '700.00', '3900.00', 4, 'Pending', '2025-03-25 13:02:52'),
(139, 'order-9JOv-TnNW', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '4000.00', '800.00', '700.00', '3900.00', 4, 'Pending', '2025-03-25 13:05:30'),
(140, 'order-AgrX-omwC', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '4000.00', '800.00', '700.00', '3900.00', 4, 'Pending', '2025-03-25 13:20:03'),
(141, 'order-Ud8B-KOx9', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '4000.00', '800.00', '700.00', '3900.00', 4, 'Pending', '2025-03-25 13:24:29'),
(142, 'order-Ve91-u7xn', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '4000.00', '800.00', '700.00', '3900.00', 4, 'Pending', '2025-03-25 13:25:31'),
(143, 'order-pCMw-3o42', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '500.00', '0.00', '700.00', '1200.00', 4, 'Pending', '2025-03-25 13:33:14'),
(144, 'order-zYlj-9xdV', 'Isaac', 'Adejuwon', 'ioadejuwon@gmail.com', '08108806808', 'NG', 'Osun State', 'Ile Ife', '29 Odaranle Street, Oluwalose Quarters', 'tttfffff', '5000.00', '0.00', '700.00', '5700.00', 4, 'Pending', '2025-03-25 13:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `olnee_order_items`
--

CREATE TABLE `olnee_order_items` (
  `id` int(11) NOT NULL,
  `order_id` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `olnee_order_items`
--

INSERT INTO `olnee_order_items` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `price`, `created_at`) VALUES
(79, 'order-60ky-5Qj4', 'prod-L67-cP3', 'Product 1', 2, '500.00', '2025-03-24 15:02:47'),
(80, 'order-60ky-5Qj4', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 15:02:47'),
(81, 'order-60ky-5Qj4', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-24 15:02:47'),
(82, 'order-OERD-LW3J', 'prod-L67-cP3', 'Product 1', 2, '500.00', '2025-03-24 15:30:12'),
(83, 'order-OERD-LW3J', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 15:30:12'),
(84, 'order-OERD-LW3J', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-24 15:30:12'),
(85, 'order-wPND-yf7O', 'prod-L67-cP3', 'Product 1', 2, '500.00', '2025-03-24 15:30:50'),
(86, 'order-wPND-yf7O', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 15:30:50'),
(87, 'order-wPND-yf7O', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-24 15:30:50'),
(88, 'order-ItjO-QZJo', 'prod-L67-cP3', 'Product 1', 2, '500.00', '2025-03-24 15:31:03'),
(89, 'order-ItjO-QZJo', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 15:31:03'),
(90, 'order-ItjO-QZJo', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-24 15:31:03'),
(91, 'order-KUbY-2hsz', 'prod-L67-cP3', 'Product 1', 2, '500.00', '2025-03-24 15:31:09'),
(92, 'order-KUbY-2hsz', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 15:31:09'),
(93, 'order-KUbY-2hsz', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-24 15:31:09'),
(94, 'order-rvDR-Y9Mo', 'prod-L67-cP3', 'Product 1', 2, '500.00', '2025-03-24 15:33:16'),
(95, 'order-rvDR-Y9Mo', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 15:33:16'),
(96, 'order-rvDR-Y9Mo', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-24 15:33:16'),
(97, 'order-wWV7-WNKr', 'prod-L67-cP3', 'Product 1', 2, '500.00', '2025-03-24 15:43:22'),
(98, 'order-wWV7-WNKr', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 15:43:22'),
(99, 'order-wWV7-WNKr', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-24 15:43:22'),
(100, 'order-bMod-2bkK', 'prod-L67-cP3', 'Product 1', 2, '500.00', '2025-03-24 15:43:39'),
(101, 'order-bMod-2bkK', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 15:43:39'),
(102, 'order-bMod-2bkK', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-24 15:43:39'),
(103, 'order-gDzs-h5J7', 'prod-L67-cP3', 'Product 1', 2, '500.00', '2025-03-24 15:43:55'),
(104, 'order-gDzs-h5J7', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 15:43:55'),
(105, 'order-gDzs-h5J7', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-24 15:43:55'),
(106, 'order-mYP3-wGTy', 'prod-L67-cP3', 'Product 1', 2, '500.00', '2025-03-24 15:44:05'),
(107, 'order-mYP3-wGTy', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 15:44:05'),
(108, 'order-mYP3-wGTy', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-24 15:44:05'),
(109, 'order-wrex-Qs1g', 'prod-L67-cP3', 'Product 1', 2, '500.00', '2025-03-24 15:44:48'),
(110, 'order-wrex-Qs1g', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 15:44:48'),
(111, 'order-wrex-Qs1g', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-24 15:44:48'),
(112, 'order-jO3I-TwIi', 'prod-L67-cP3', 'Product 1', 2, '500.00', '2025-03-24 15:46:03'),
(113, 'order-jO3I-TwIi', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 15:46:03'),
(114, 'order-jO3I-TwIi', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-24 15:46:03'),
(115, 'order-Gfj8-ezek', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:28:36'),
(116, 'order-Gfj8-ezek', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:28:36'),
(117, 'order-SDNU-ELAN', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:29:02'),
(118, 'order-SDNU-ELAN', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:29:02'),
(119, 'order-99fO-O6ks', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:29:58'),
(120, 'order-99fO-O6ks', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:29:58'),
(121, 'order-emSt-h4Rc', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:31:41'),
(122, 'order-emSt-h4Rc', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:31:41'),
(123, 'order-Hf2y-Poo2', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:32:28'),
(124, 'order-Hf2y-Poo2', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:32:28'),
(125, 'order-3Uql-xjwX', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:32:47'),
(126, 'order-3Uql-xjwX', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:32:47'),
(127, 'order-cuhi-LbDS', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:33:59'),
(128, 'order-cuhi-LbDS', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:33:59'),
(129, 'order-F8gf-3SPA', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:34:31'),
(130, 'order-F8gf-3SPA', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:34:31'),
(131, 'order-45vp-8QyW', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:38:48'),
(132, 'order-45vp-8QyW', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:38:48'),
(133, 'order-OVqQ-B95e', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:38:59'),
(134, 'order-OVqQ-B95e', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:38:59'),
(135, 'order-gNwu-sIYn', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:39:06'),
(136, 'order-gNwu-sIYn', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:39:06'),
(137, 'order-E2UH-1top', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:39:50'),
(138, 'order-E2UH-1top', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:39:50'),
(139, 'order-uiqX-o8ui', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:40:09'),
(140, 'order-uiqX-o8ui', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:40:09'),
(141, 'order-RfLR-vucU', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:41:00'),
(142, 'order-RfLR-vucU', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:41:00'),
(143, 'order-NTkI-Qnkr', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:41:03'),
(144, 'order-NTkI-Qnkr', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:41:03'),
(145, 'order-fwZN-td4X', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:42:30'),
(146, 'order-fwZN-td4X', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:42:30'),
(147, 'order-ffqx-l5dn', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:43:48'),
(148, 'order-ffqx-l5dn', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:43:48'),
(149, 'order-i1tH-Lpal', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:43:56'),
(150, 'order-i1tH-Lpal', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:43:56'),
(151, 'order-0QW7-Oqko', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:44:24'),
(152, 'order-0QW7-Oqko', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:44:24'),
(153, 'order-tjqg-Kirg', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:44:28'),
(154, 'order-tjqg-Kirg', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:44:28'),
(155, 'order-lWGj-cKj0', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:52:36'),
(156, 'order-lWGj-cKj0', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:52:36'),
(157, 'order-oFiM-XdVT', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:52:55'),
(158, 'order-oFiM-XdVT', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:52:55'),
(159, 'order-IrVy-y4h4', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:53:41'),
(160, 'order-IrVy-y4h4', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:53:41'),
(161, 'order-GTjQ-24IE', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 20:56:41'),
(162, 'order-GTjQ-24IE', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 20:56:41'),
(163, 'order-jHpu-oxzy', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:20:58'),
(164, 'order-jHpu-oxzy', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:20:58'),
(165, 'order-VA9H-PIiN', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:21:08'),
(166, 'order-VA9H-PIiN', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:21:08'),
(167, 'order-dloz-0VqQ', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:21:24'),
(168, 'order-dloz-0VqQ', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:21:24'),
(169, 'order-XeSb-ayGr', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:21:36'),
(170, 'order-XeSb-ayGr', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:21:36'),
(171, 'order-8saC-sdvk', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:21:47'),
(172, 'order-8saC-sdvk', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:21:47'),
(173, 'order-obpQ-m3gL', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:23:37'),
(174, 'order-obpQ-m3gL', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:23:37'),
(175, 'order-Xk0T-VKnK', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:23:38'),
(176, 'order-Xk0T-VKnK', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:23:38'),
(177, 'order-87qO-I9Ul', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:25:47'),
(178, 'order-87qO-I9Ul', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:25:47'),
(179, 'order-WlVA-3ILb', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:27:05'),
(180, 'order-WlVA-3ILb', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:27:05'),
(181, 'order-7ZGN-sgVF', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:31:05'),
(182, 'order-7ZGN-sgVF', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:31:05'),
(183, 'order-0RMl-7zXj', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:31:37'),
(184, 'order-0RMl-7zXj', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:31:37'),
(185, 'order-Alta-0Jpj', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:31:57'),
(186, 'order-Alta-0Jpj', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:31:57'),
(187, 'order-PoDL-hK4s', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:32:08'),
(188, 'order-PoDL-hK4s', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:32:08'),
(189, 'order-nerJ-BLjl', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:32:39'),
(190, 'order-nerJ-BLjl', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:32:39'),
(191, 'order-vziM-LAsA', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:33:24'),
(192, 'order-vziM-LAsA', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:33:24'),
(193, 'order-1QNt-C8WH', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:35:18'),
(194, 'order-1QNt-C8WH', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:35:18'),
(195, 'order-frX1-LiCK', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:48:16'),
(196, 'order-frX1-LiCK', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:48:16'),
(197, 'order-PhpL-uatv', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:49:44'),
(198, 'order-PhpL-uatv', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:49:44'),
(199, 'order-GugH-bzNm', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 21:51:22'),
(200, 'order-GugH-bzNm', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 21:51:22'),
(201, 'order-hLyx-nXae', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 22:10:01'),
(202, 'order-hLyx-nXae', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 22:10:01'),
(203, 'order-BlMS-jslI', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-24 22:12:05'),
(204, 'order-BlMS-jslI', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 22:12:05'),
(205, 'order-oqZA-9Yjm', 'prod-L67-cP3', 'Product 1', 9, '500.00', '2025-03-24 22:13:07'),
(206, 'order-oqZA-9Yjm', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 22:13:07'),
(207, 'order-jQQi-bUZn', 'prod-L67-cP3', 'Product 1', 9, '500.00', '2025-03-24 22:18:47'),
(208, 'order-jQQi-bUZn', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 22:18:47'),
(209, 'order-Yey6-B9ev', 'prod-L67-cP3', 'Product 1', 9, '500.00', '2025-03-24 22:19:10'),
(210, 'order-Yey6-B9ev', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 22:19:10'),
(211, 'order-Fct9-4Odw', 'prod-L67-cP3', 'Product 1', 9, '500.00', '2025-03-24 22:19:40'),
(212, 'order-Fct9-4Odw', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 22:19:40'),
(213, 'order-zEiA-O1YV', 'prod-L67-cP3', 'Product 1', 9, '500.00', '2025-03-24 22:19:42'),
(214, 'order-zEiA-O1YV', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 22:19:42'),
(215, 'order-crwx-m27E', 'prod-L67-cP3', 'Product 1', 9, '500.00', '2025-03-24 22:19:57'),
(216, 'order-crwx-m27E', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 22:19:57'),
(217, 'order-8n2b-jmoU', 'prod-L67-cP3', 'Product 1', 9, '500.00', '2025-03-24 22:20:09'),
(218, 'order-8n2b-jmoU', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 22:20:09'),
(219, 'order-GlJT-Oicy', 'prod-L67-cP3', 'Product 1', 9, '500.00', '2025-03-24 23:13:17'),
(220, 'order-GlJT-Oicy', 'prod-L67-cP33', 'Product 2', 1, '1000.00', '2025-03-24 23:13:17'),
(221, 'order-kbRW-uYcv', 'prod-L67-cP3', 'Product 1', 11, '500.00', '2025-03-25 12:32:18'),
(222, 'order-kbRW-uYcv', 'prod-L67-cP33', 'Product 2', 5, '1000.00', '2025-03-25 12:32:18'),
(223, 'order-dVK2-l3o0', 'prod-L67-cP3', 'Product 1', 11, '500.00', '2025-03-25 12:38:24'),
(224, 'order-dVK2-l3o0', 'prod-L67-cP33', 'Product 2', 5, '1000.00', '2025-03-25 12:38:24'),
(225, 'order-6UBc-CE6d', 'prod-L67-cP33', 'Product 2', 2, '1000.00', '2025-03-25 12:49:39'),
(226, 'order-6UBc-CE6d', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-25 12:49:39'),
(227, 'order-hfEx-kaIo', 'prod-L67-cP33', 'Product 2', 2, '1000.00', '2025-03-25 12:54:22'),
(228, 'order-hfEx-kaIo', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-25 12:54:22'),
(229, 'order-m8DF-bmEI', 'prod-L67-cP33', 'Product 2', 2, '1000.00', '2025-03-25 12:59:04'),
(230, 'order-m8DF-bmEI', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-25 12:59:04'),
(231, 'order-vX2W-i5xm', 'prod-L67-cP33', 'Product 2', 2, '1000.00', '2025-03-25 12:59:07'),
(232, 'order-vX2W-i5xm', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-25 12:59:07'),
(233, 'order-yMdY-z7u3', 'prod-L67-cP33', 'Product 2', 2, '1000.00', '2025-03-25 13:00:25'),
(234, 'order-yMdY-z7u3', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-25 13:00:25'),
(235, 'order-PdXa-acK5', 'prod-L67-cP33', 'Product 2', 2, '1000.00', '2025-03-25 13:00:30'),
(236, 'order-PdXa-acK5', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-25 13:00:30'),
(237, 'order-UcK5-lPaI', 'prod-L67-cP33', 'Product 2', 2, '1000.00', '2025-03-25 13:00:36'),
(238, 'order-UcK5-lPaI', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-25 13:00:36'),
(239, 'order-YpYi-AvAc', 'prod-L67-cP33', 'Product 2', 2, '1000.00', '2025-03-25 13:02:31'),
(240, 'order-YpYi-AvAc', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-25 13:02:31'),
(241, 'order-KSNa-Ft33', 'prod-L67-cP33', 'Product 2', 2, '1000.00', '2025-03-25 13:02:52'),
(242, 'order-KSNa-Ft33', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-25 13:02:52'),
(243, 'order-9JOv-TnNW', 'prod-L67-cP33', 'Product 2', 2, '1000.00', '2025-03-25 13:05:30'),
(244, 'order-9JOv-TnNW', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-25 13:05:30'),
(245, 'order-AgrX-omwC', 'prod-L67-cP33', 'Product 2', 2, '1000.00', '2025-03-25 13:20:03'),
(246, 'order-AgrX-omwC', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-25 13:20:03'),
(247, 'order-Ud8B-KOx9', 'prod-L67-cP33', 'Product 2', 2, '1000.00', '2025-03-25 13:24:29'),
(248, 'order-Ud8B-KOx9', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-25 13:24:29'),
(249, 'order-Ve91-u7xn', 'prod-L67-cP33', 'Product 2', 2, '1000.00', '2025-03-25 13:25:31'),
(250, 'order-Ve91-u7xn', 'prod-L67-cP34', 'Product 3', 1, '2000.00', '2025-03-25 13:25:31'),
(251, 'order-pCMw-3o42', 'prod-L67-cP3', 'Product 1', 1, '500.00', '2025-03-25 13:33:14'),
(252, 'order-zYlj-9xdV', 'prod-L67-cP37', 'Product 6', 1, '5000.00', '2025-03-25 13:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `olnee_storedata`
--

CREATE TABLE `olnee_storedata` (
  `ID` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deliveryPolicy` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `returnPolicy` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phonenumber` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `olnee_storedata`
--

INSERT INTO `olnee_storedata` (`ID`, `email`, `deliveryPolicy`, `returnPolicy`, `phonenumber`, `store_address`, `state`, `country`, `created_at`) VALUES
(1, 'test@gmail.com', 'All orders shipped with DHL.\r\n\r\nFree shipping is available on orders above ₦500,000.\r\n\r\nAll orders are shipped with a DHL tracking number.', 'Items returned within 14 days of their original shipment date in same as new condition will be eligible for a full refund or store credit.\r\n\r\nRefunds will be charged back to the original form of payment used for purchase.\r\n\r\nCustomer is responsible for shipping charges when making returns and shipping/handling fees of original purchase is non-refundable.\r\n\r\nAll sale items are final purchases.', '234', NULL, NULL, NULL, '2025-02-17 07:19:53');

-- --------------------------------------------------------

--
-- Table structure for table `olnee_users`
--

CREATE TABLE `olnee_users` (
  `ID` int(11) NOT NULL,
  `user_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `countryCode` int(5) DEFAULT NULL,
  `phoneNo` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pwordhash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verify` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `olnee_users`
--

INSERT INTO `olnee_users` (`ID`, `user_id`, `fname`, `lname`, `email`, `countryCode`, `phoneNo`, `address`, `state`, `country`, `about`, `pwordhash`, `verify`, `created_at`) VALUES
(25, 'swlQ8yf', 'Oluwasegun', 'Adejuwon', 'usertest@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$TP3kRfWlDs25pZxpFLr.1eQN/j2u9ipMBBD2mzwM0EwW33VksMI7W', 0, '2025-02-18 16:10:11'),
(26, '0NDMDdh', 'Oreoluwa', 'Adejuwon', 'ioadejuwon@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$cZsbml7p1QgKqjYkW5b.d.RDq4goF/mCVox741ieSvjfx5qh5BUgG', 0, '2025-02-20 09:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `productid` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `producttitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `productcategory` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_price` decimal(10,2) NOT NULL,
  `shortdescription` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productdescription` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productid`, `producttitle`, `user_id`, `qty`, `productcategory`, `price`, `discount_price`, `shortdescription`, `productdescription`, `created_at`) VALUES
(49, 'prod-L67-cP3', 'Product 1', 'bQD9HtNYhW', 200, 'cat-7JA-fwe', '500.00', '12345.00', 'Must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound.', 'Must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound 2.', '2025-02-05 14:25:58'),
(54, 'prod-L67-cP33', 'Product 2', 'bQD9HtNYhW', 200, 'cat-HtM-zBt', '1000.00', '12345.00', 'Must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound.', 'Must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound 2.', '2025-02-04 14:20:02'),
(55, 'prod-L67-cP34', 'Product 3', 'bQD9HtNYhW', 200, 'cat-FtG-dd4', '2000.00', '12345000.00', 'Must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound.', 'Must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound 2.', '2025-02-06 14:25:58'),
(57, 'prod-L67-cP35', 'Product 4', 'bQD9HtNYhW', 200, 'cat-Srf-SdG', '3000.00', '12345.00', 'Must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound.', 'Must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound 2.', '2025-02-15 14:25:58'),
(58, 'prod-L67-cP36', 'Product 5', 'bQD9HtNYhW', 200, 'cat-HtM-zBt', '4000.00', '12345.00', 'Must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound.', 'Must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound 2.', '2025-02-15 14:25:58'),
(59, 'prod-L67-cP37', 'Product 6', 'bQD9HtNYhW', 200, 'cat-hXY-bHw', '5000.00', '12345.00', 'Must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound.', 'Must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound 2.', '2025-02-15 14:25:58'),
(60, 'prod-L67-cP38', 'Product 7', 'bQD9HtNYhW', 200, 'cat-vTa-231', '6000.00', '12345.00', 'Must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound.', 'Must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound 2.', '2025-02-15 14:25:58'),
(61, 'prod-L67-cP39', 'Product 8', 'bQD9HtNYhW', 200, 'cat-JNK-F1X', '7000.00', '12345.00', 'Must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound.', 'Must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound 2.', '2025-02-15 14:25:58'),
(62, 'prod-XFV-Crc', 'Product 9', 'bQD9HtNYhW', 1234, 'cat-LxM-pXZ', '8000.00', '532356.00', 'abcveh ', 'abcveh ', '2025-02-16 20:09:22');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_id` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `img_id`, `image_path`, `thumbnail`) VALUES
(106, 'prod-L67-cP3', 'img-n9P-HZo', 'products/prod-L67-cP3img-n9P-HZo.jpg', 1),
(109, 'prod-L67-cP34', 'img-WgR-hn5', 'products/prod-L67-cP34img-WgR-hn5.jpg', 1),
(111, 'prod-L67-cP36', 'img-i6Z-j4A', 'products/prod-L67-cP36img-i6Z-j4A.jpg', 1),
(112, 'prod-L67-cP3', 'img-VfA-7JZ', 'products/prod-L67-cP3img-VfA-7JZ.jpg', 0),
(113, 'prod-L67-cP33', 'img-FgR-FjF', 'products/prod-L67-cP33img-FgR-FjF.jpg', 1),
(114, 'prod-L67-cP33', 'img-bix-bXK', 'products/prod-L67-cP33img-bix-bXK.jpg', 0),
(115, 'prod-L67-cP35', 'img-gQ1-4TW', 'products/prod-L67-cP35img-gQ1-4TW.jpg', 1),
(116, 'prod-L67-cP34', 'img-tEj-yzd', 'products/prod-L67-cP34img-tEj-yzd.jpg', 0),
(117, 'prod-L67-cP37', 'img-ASX-iiv', 'products/prod-L67-cP37img-ASX-iiv.jpg', 1),
(118, 'prod-L67-cP38', 'img-4QR-4yO', 'products/prod-L67-cP38img-4QR-4yO.jpg', 1),
(119, 'prod-L67-cP39', 'img-0U1-ZTz', 'products/prod-L67-cP39img-0U1-ZTz.jpg', 1),
(120, 'prod-L67-cP39', 'img-liB-Gc3', 'products/prod-L67-cP39img-liB-Gc3.jpg', 0),
(121, 'prod-XFV-Crc', 'img-aea-Rpk', 'products/prod-XFV-Crc-img-aea-Rpk.jpg', 1),
(122, 'prod-XFV-Crc', 'img-gMh-93q', 'products/prod-XFV-Crc-img-gMh-93q.jpg', 0),
(123, 'prod-XFV-Crc', 'img-brz-lvX', 'products/prod-XFV-Crc-img-brz-lvX.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `olnee_admin`
--
ALTER TABLE `olnee_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `olnee_cart`
--
ALTER TABLE `olnee_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `olnee_categories`
--
ALTER TABLE `olnee_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `olnee_coupons`
--
ALTER TABLE `olnee_coupons`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `olnee_delivery`
--
ALTER TABLE `olnee_delivery`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `olnee_orders`
--
ALTER TABLE `olnee_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `olnee_order_items`
--
ALTER TABLE `olnee_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `olnee_storedata`
--
ALTER TABLE `olnee_storedata`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `olnee_users`
--
ALTER TABLE `olnee_users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `olnee_admin`
--
ALTER TABLE `olnee_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `olnee_cart`
--
ALTER TABLE `olnee_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `olnee_categories`
--
ALTER TABLE `olnee_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `olnee_coupons`
--
ALTER TABLE `olnee_coupons`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `olnee_delivery`
--
ALTER TABLE `olnee_delivery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `olnee_orders`
--
ALTER TABLE `olnee_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `olnee_order_items`
--
ALTER TABLE `olnee_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `olnee_storedata`
--
ALTER TABLE `olnee_storedata`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `olnee_users`
--
ALTER TABLE `olnee_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
