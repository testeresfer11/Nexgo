-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 13, 2024 at 02:37 AM
-- Server version: 10.6.19-MariaDB-cll-lve
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Nexgo-ride`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `B5B_number` varchar(100) DEFAULT NULL,
  `account_number` varchar(100) DEFAULT NULL,
  `paypal_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `user_id`, `full_name`, `B5B_number`, `account_number`, `paypal_id`, `created_at`, `updated_at`) VALUES
(1, 342, 'EO', 'ABCD', '123456', 'Normy.ose@gmail.com', '2024-12-08 16:21:24', '2024-12-08 16:26:18'),
(2, 366, 'Willy', '277227', '49485846349194', NULL, '2024-12-12 11:52:06', '2024-12-12 11:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `ride_id` bigint(20) UNSIGNED NOT NULL,
  `passenger_id` bigint(20) UNSIGNED NOT NULL,
  `booking_date` timestamp NULL DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `seat_count` int(11) DEFAULT NULL,
  `departure_location` varchar(255) DEFAULT NULL,
  `departure_distance` varchar(255) DEFAULT '0',
  `arrival_location` varchar(255) DEFAULT NULL,
  `arrival_distance` varchar(255) DEFAULT '0',
  `total_time_estimation` varchar(255) DEFAULT NULL,
  `departure_time` varchar(255) DEFAULT NULL,
  `arrival_time` varchar(255) DEFAULT NULL,
  `departure_lat` varchar(255) DEFAULT NULL,
  `departure_long` varchar(255) DEFAULT NULL,
  `arrival_lat` varchar(255) DEFAULT NULL,
  `arrival_long` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `platform_amount` decimal(10,0) DEFAULT NULL,
  `cancel_before_24` tinyint(1) DEFAULT 0,
  `cancel_after_24` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `ride_id`, `passenger_id`, `booking_date`, `status`, `seat_count`, `departure_location`, `departure_distance`, `arrival_location`, `arrival_distance`, `total_time_estimation`, `departure_time`, `arrival_time`, `departure_lat`, `departure_long`, `arrival_lat`, `arrival_long`, `created_at`, `updated_at`, `amount`, `platform_amount`, `cancel_before_24`, `cancel_after_24`) VALUES
(1, 4, 309, '2024-12-06 19:30:00', 'cancelled', 1, 'Bennelong Point, Sydney NSW 2000, Australia', '1.39', 'Melbourne Airport, Melbourne Airport, VIC', '19.28', '18h51', '2024-12-06 12:30:00', '2024-12-07 06:21:00', '-33.86', '151.22', '-37.67', '144.84', '2024-12-05 19:36:37', '2024-12-12 10:45:40', 49, 6, 0, 1),
(2, 5, 310, '2024-12-06 19:59:03', 'rejected', 1, 'Adelaide Airport, Netley, SA', '0.00', 'Brisbane Airport, Brisbane Airport, QLD', '10.91', '51h29 minutes', '2024-12-06 12:51:00', '2024-12-08 05:21:00', '-34.95', '138.53', '-27.39', '153.12', '2024-12-05 19:59:03', '2024-12-05 14:31:59', 112, 15, 0, 0),
(3, 11, 309, '2024-12-06 15:30:00', 'rejected', 1, 'Albury', '3.73', '210 Elizabeth St, Melbourne VIC 3000', '19.27', '5h56', '2024-12-06 22:15:15', '2024-12-07 02:20:00', '-36.0737293', '146.9135418', '-37.8136186', '144.963086', '2024-12-05 23:28:09', '2024-12-05 17:59:07', 17, 2, 0, 0),
(4, 14, 310, '2024-12-09 15:30:00', 'completed', 1, 'Adelaide Airport (ADL), Sir Richard Williams Ave, Adelaide Airport SA 5950', '0.00', 'Brisbane Airport (BNE), Airport Dr, Brisbane Airport QLD 4008', '0.00', '51h30', '2024-12-09 08:30:00', '2024-12-11 00:59:00', '-34.946237', '138.5312017', '-27.3946264', '153.1236707', '2024-12-06 00:48:07', '2024-12-11 06:00:04', 135, 18, 0, 0),
(5, 13, 310, '2024-12-06 01:51:08', 'rejected', 1, 'Bennelong Point, Sydney NSW 2000, Australia', '1.39', 'Melbourne Airport, Melbourne Airport, VIC', '19.28', '18h51 minutes', '2024-12-06 15:59:00', '2024-12-07 09:50:00', '-37.67', '144.84', '-33.86', '151.22', '2024-12-06 01:51:10', '2024-12-05 20:24:03', 58, 8, 0, 0),
(6, 16, 310, '2024-12-07 02:45:00', 'payment_pending', 1, 'Melbourne Airport, Melbourne Airport, VIC', '19.28', 'Sydney Opera House, Sydney, NSW', '1.39', '21h42', '2024-12-06 19:45:00', '2024-12-07 13:36:00', '-37.67', '144.84', '-33.86', '151.22', '2024-12-06 17:46:45', '2024-12-06 17:46:45', 49, 6, 0, 0),
(16, 29, 337, '2024-12-09 00:19:33', 'rejected', 3, 'Bennelong Point, Sydney NSW 2000, Australia', '1.39', 'Canberra Airport', '6.30', '7h12 minutes', '2024-12-08 21:23:00', '2024-12-09 04:35:00', '-35.31', '149.19', '-33.86', '151.22', '2024-12-07 00:19:34', '2024-12-06 19:17:41', 69, 9, 0, 0),
(17, 16, 335, '2024-12-07 02:45:00', 'payment_pending', 1, 'Melbourne Airport, Melbourne Airport, VIC', '19.28', 'Sydney Opera House, Sydney, NSW', '1.39', '21h42', '2024-12-06 19:45:00', '2024-12-07 13:36:00', '-37.67', '144.84', '-33.86', '151.22', '2024-12-07 00:20:08', '2024-12-07 00:20:08', 49, 6, 0, 0),
(18, 29, 337, '2024-12-09 04:23:00', 'rejected', 1, 'Bennelong Point, Sydney NSW 2000, Australia', '0.56', 'Albury Airport', '0.42', '10h2', '2024-12-08 21:23:00', '2024-12-09 07:11:29', '-33.86', '151.22', '-36.07', '146.95', '2024-12-07 00:38:07', '2024-12-06 19:17:03', 35, 5, 0, 0),
(20, 30, 337, '2024-12-09 00:51:52', 'rejected', 1, 'Sydney Opera House, Sydney, NSW', '1.39', 'Canberra Airport', '6.30', '7h12 minutes', '2024-12-08 17:48:00', '2024-12-09 01:00:00', '-35.31', '149.19', '-33.86', '151.22', '2024-12-07 00:51:53', '2024-12-06 19:33:20', 17, 2, 0, 0),
(21, 31, 337, '2024-12-09 01:06:30', 'rejected', 3, '121 Airport Dr, East Albury NSW 2640, Australia', '5.02', 'Canberra Airport, Canberra Airport, ACT', '8.05', '8h34 minutes', '2024-12-08 18:04:00', '2024-12-08 23:32:00', '-36.07', '146.95', '-35.31', '149.19', '2024-12-07 01:06:31', '2024-12-06 19:37:32', 69, 9, 0, 0),
(22, 31, 337, '2024-12-09 01:08:14', 'rejected', 1, '121 Airport Dr, East Albury NSW 2640, Australia', '5.02', 'Canberra Airport, Canberra Airport, ACT', '8.05', '8h34 minutes', '2024-12-08 18:04:00', '2024-12-08 23:32:00', '-36.07', '146.95', '-35.31', '149.19', '2024-12-07 01:08:15', '2024-12-06 19:50:10', 23, 3, 0, 0),
(23, 30, 338, NULL, 'payment_pending', 2, 'Sydney Opera House, Sydney, NSW', '1.39', 'Canberra Airport', '6.3', '7h12 minutes', '2024-12-08 17:48:00', '2024-12-09 01:00:00', '-35.31', '149.19', '-33.86', '151.22', '2024-12-07 01:19:07', '2024-12-07 01:19:07', 35, 5, 0, 0),
(24, 32, 337, '2024-12-09 01:24:37', 'completed', 1, 'Canberra Airport, Canberra Airport, ACT', '8.05', 'Albury Airport, East Albury, NSW', '5.02', '8h33 minutes', '2024-12-08 22:26:00', '2024-12-09 03:54:00', '-35.31', '149.19', '-36.07', '146.95', '2024-12-07 01:22:10', '2024-12-09 06:00:03', 17, 2, 0, 0),
(33, 39, 338, '2024-12-10 23:40:05', 'rejected', 1, 'Airport Dr, Brisbane Airport QLD 4008, Australia', '10.91', 'Adelaide Airport, Netley, SA', '0.00', '51h15 minutes', '2024-12-10 16:39:00', '2024-12-12 09:09:00', '-27.39', '153.12', '-34.95', '138.53', '2024-12-09 23:40:04', '2024-12-09 18:10:50', 112, 15, 0, 0),
(34, 40, 310, '2024-12-10 23:47:57', 'rejected', 1, 'Melbourne Airport (MEL), Arrival Dr, Melbourne Airport VIC 3045', '28.24', 'Sydney Airport (SYD), Mascot NSW 2020', '12.23', '18h38 minutes', '2024-12-17 08:30:00', '2024-12-18 02:08:00', '-37.6699188', '144.8403449', '-33.9500314', '151.1816944', '2024-12-09 23:47:56', '2024-12-09 18:19:12', 48, 6, 0, 0),
(35, 41, 310, '2024-12-10 15:30:00', 'rejected', 4, 'By appointment only, Albury NSW 2640', '3.73', '3 Petrie Plaza, Canberra ACT 2601', '6.31', '8h26', '2024-12-10 08:30:00', '2024-12-10 13:58:00', '-36.0737293', '146.9135418', '-35.2801347', '149.1311399', '2024-12-10 00:40:38', '2024-12-09 19:20:21', 69, 9, 0, 0),
(36, 43, 310, '2024-12-10 13:59:00', 'rejected', 1, 'P49H 6F Canberra ACT', '6.43', 'By appointment only, Albury NSW 2640', '3.73', '8h26', '2024-12-10 06:59:00', '2024-12-10 12:26:00', '-35.2818948', '149.1286507', '-36.0737293', '146.9135418', '2024-12-10 01:00:20', '2024-12-09 19:31:19', 12, 2, 0, 0),
(37, 44, 339, '2024-12-10 01:03:47', 'rejected', 1, 'Melbourne Airport, Melbourne Airport, VIC', '28.24', 'Albury Airport, East Albury, NSW', '5.02', '6h27 minutes', '2024-12-10 18:02:00', '2024-12-11 00:29:00', '-37.67', '144.84', '-36.07', '146.95', '2024-12-10 01:03:47', '2024-12-09 19:34:44', 23, 3, 0, 0),
(38, 47, 309, '2024-12-12 00:25:00', 'cancelled', 1, 'Adelaide Airport, Netley, SA', '0.43', 'Brisbane Airport, Brisbane Airport, QLD', '0.63', '51h28', '2024-12-11 17:25:00', '2024-12-13 09:55:00', '-34.95', '138.53', '-27.39', '153.12', '2024-12-11 00:27:47', '2024-12-10 20:08:38', 112, 15, 1, 0),
(40, 47, 309, '2024-12-12 02:01:42', 'completed', 1, 'Adelaide Airport, Netley, SA', '7.76', 'Brisbane Airport, Brisbane Airport, QLD', '15.94', '51h28 minutes', '2024-12-11 17:25:00', '2024-12-13 09:55:00', '-34.95', '138.53', '-27.39', '153.12', '2024-12-11 02:01:41', '2024-12-13 12:10:48', 112, 15, 0, 0),
(41, 49, 310, '2024-12-12 02:14:49', 'payment_pending', 1, '121 Airport Dr, East Albury NSW 2640, Australia', '5.02', 'Canberra Airport, Canberra Airport, ACT', '8.05', '8h34 minutes', '2024-12-11 19:13:00', '2024-12-12 00:41:00', '-36.07', '146.95', '-35.31', '149.19', '2024-12-11 02:14:48', '2024-12-11 02:14:48', 15, 2, 0, 0),
(42, 49, 310, '2024-12-12 02:13:00', 'payment_pending', 1, '121 Airport Dr, East Albury NSW 2640, Australia', '0.42', 'Canberra Airport, Canberra Airport, ACT', '0.60', '8h34', '2024-12-11 19:13:00', '2024-12-12 00:41:00', '-36.07', '146.95', '-35.31', '149.19', '2024-12-11 02:17:09', '2024-12-11 02:17:09', 15, 2, 0, 0),
(49, 54, 309, '2024-12-13 16:47:00', 'cancelled', 1, '14 Tolmer Tce, Keith, SA', '0.29', 'Commercial East St, Kaniva, VIC', '0.31', '2h13', '2024-12-13 09:47:00', '2024-12-13 11:55:00', '-36.10', '140.35', '-36.38', '141.24', '2024-12-12 16:59:45', '2024-12-12 11:34:39', 8, 1, 1, 0),
(50, 55, 373, '2024-12-12 17:27:09', 'completed', 1, 'Sydney', '0.00', 'Melbourne', '0.00', '18h50 minutes', '2024-12-13 08:30:00', '2024-12-14 02:20:00', '-33.8688197', '151.2092955', '-37.8136276', '144.9630576', '2024-12-12 17:27:07', '2024-12-12 17:37:20', 49, 6, 0, 0),
(56, 67, 377, '2024-12-13 00:22:00', 'cancelled', 3, '14 Tolmer Tce, Keith, SA', '0.29', 'Commercial East St, Kaniva, VIC', '0.31', '2h13', '2024-12-12 17:22:00', '2024-12-12 18:30:00', '-36.10', '140.35', '-36.38', '141.24', '2024-12-12 22:20:00', '2024-12-12 16:54:33', 17, 2, 0, 1),
(57, 68, 366, '2024-12-13 22:28:00', 'cancelled', 1, 'Carnegie Mellon University - Australia, Adelaide, SA', '0.18', 'Commercial East St, Kaniva, VIC', '0.31', '7h52', '2024-12-13 15:28:00', '2024-12-13 22:39:00', '-34.93', '138.60', '-36.38', '141.24', '2024-12-12 22:31:51', '2024-12-12 17:17:24', 21, 3, 1, 0),
(58, 69, 366, '2024-12-22 22:29:00', 'cancelled', 3, 'Sir Richard Williams Avenue, Netley, SA', '5.69', 'Commercial East St, Kaniva, VIC', '0.31', '8h2', '2024-12-22 15:29:00', '2024-12-22 22:46:00', '-34.94', '138.54', '-36.38', '141.24', '2024-12-12 22:38:04', '2024-12-12 17:09:36', 62, 8, 1, 0),
(59, 71, 379, '2024-12-19 23:29:49', 'rejected', 1, 'Albury NSW, Australia', '0.81', '161 London Cct, City, ACT', '0.39', '5h28 minutes', '2024-12-15 18:00:00', '2024-12-15 23:28:00', '-36.07', '146.91', '-35.28', '149.13', '2024-12-12 22:45:56', '2024-12-12 18:02:04', 23, 3, 0, 0),
(60, 70, 380, '2024-12-14 16:30:00', 'rejected', 1, '210 Elizabeth St, Melbourne VIC 3000', '0.00', '110-140 King St, Sydney NSW 2000', '0.00', '18h50', '2024-12-14 09:30:00', '2024-12-15 03:20:00', '-37.8136186', '144.963086', '-33.8688222', '151.20931', '2024-12-12 22:45:58', '2024-12-12 18:02:03', 52, 7, 0, 0),
(61, 72, 309, '2024-12-13 08:00:00', 'cancelled', 3, '160 Albert St, Brisbane, QLD', '0.40', 'Sheridan St, Cairns City, QLD', '0.11', '42h29', '2024-12-13 01:00:00', '2024-12-14 11:45:00', '-27.47', '153.03', '-16.92', '145.77', '2024-12-12 22:53:34', '2024-12-12 17:24:44', 290, 38, 0, 1),
(62, 73, 379, '2024-12-20 00:20:14', 'rejected', 1, 'Albury NSW, Australia', '0.81', '161 London Cct, City, ACT', '0.39', '5h28 minutes', '2024-12-15 17:19:00', '2024-12-15 22:47:00', '-36.07', '146.91', '-35.28', '149.13', '2024-12-13 00:20:13', '2024-12-12 18:54:21', 15, 2, 0, 0),
(63, 73, 309, '2024-12-20 00:21:52', 'rejected', 3, 'Albury NSW, Australia', '0.81', '161 London Cct, City, ACT', '0.39', '5h28 minutes', '2024-12-15 17:19:00', '2024-12-15 22:47:00', '-36.07', '146.91', '-35.28', '149.13', '2024-12-13 00:21:52', '2024-12-12 18:54:29', 45, 6, 0, 0),
(64, 74, 379, '2024-12-13 01:15:19', 'rejected', 1, 'Adelaide SA, Australia', '0.20', 'Melbourne VIC, Australia', '1.16', '16h19 minutes', '2024-12-30 18:04:00', '2024-12-31 10:23:00', '-34.93', '138.6', '-37.81', '144.96', '2024-12-13 01:05:13', '2024-12-12 19:47:00', 46, 6, 1, 0),
(65, 74, 309, '2024-12-13 01:06:45', 'rejected', 2, 'Adelaide SA, Australia', '0.20', 'Melbourne VIC, Australia', '1.16', '16h19 minutes', '2024-12-30 18:04:00', '2024-12-31 10:23:00', '-34.93', '138.6', '-37.81', '144.96', '2024-12-13 01:06:44', '2024-12-12 19:47:15', 92, 12, 0, 0),
(66, 75, 385, '2024-12-13 00:00:00', 'rejected', 1, '25 Milton Pde, Bundoora, VIC', '0.58', '1 Fenton Way, Kew, VIC', '6.45', '0h24', '2024-12-12 17:00:00', '2024-12-12 17:20:00', '-37.69', '145.06', '-37.81', '145.03', '2024-12-12 22:52:02', '2024-12-12 21:54:32', 1, 0, 0, 0),
(67, 75, 386, '2024-12-13 01:00:00', 'rejected', 1, '25 Milton Pde, Bundoora, VIC', '5.41', '1 Fenton Way, Kew, VIC', '2.60', '0h24', '2024-12-12 18:00:00', '2024-12-12 18:20:00', '-37.69', '145.06', '-37.81', '145.03', '2024-12-12 23:21:56', '2024-12-12 22:29:13', 1, 0, 0, 0),
(68, 76, 386, '2024-12-15 00:31:00', 'cancelled', 1, '39 Ryan St, Brunswick East, VIC', '1.61', '62 Grattan St, Carlton, VIC', '0.28', '0h5', '2024-12-14 17:31:00', '2024-12-14 17:36:00', '-37.77', '144.98', '-37.80', '144.97', '2024-12-13 00:35:30', '2024-12-13 00:07:38', 1, 0, 0, 1),
(69, 76, 385, '2024-12-13 05:00:00', 'rejected', 1, '39 Ryan St, Brunswick East, VIC', '0.30', '62 Grattan St, Carlton, VIC', '5.25', '0h5', '2024-12-12 22:00:00', '2024-12-12 22:05:00', '-37.77', '144.98', '-37.80', '144.97', '2024-12-13 01:04:19', '2024-12-13 00:26:36', 1, 0, 0, 0),
(70, 77, 387, '2024-12-13 17:00:00', 'cancelled', 1, '3 Bank St, Lara, VIC', '0.45', '225 Heaths Rd, Werribee, VIC', '2.59', '1h43', '2024-12-13 10:00:00', '2024-12-13 10:43:00', '-38.02', '144.40', '-37.88', '144.68', '2024-12-13 01:37:31', '2024-12-13 00:40:20', 1, 0, 0, 1),
(71, 79, 380, '2024-12-14 17:11:00', 'rejected', 2, '215 Lawrence St, Wodonga, VIC', '0.48', '13 Tor St, Gundagai, NSW', '0.42', '4h39', '2024-12-14 10:11:00', '2024-12-14 14:13:00', '-36.12', '146.88', '-35.06', '148.10', '2024-12-13 17:13:19', '2024-12-13 11:50:18', 23, 3, 0, 0),
(72, 80, 380, '2024-12-15 17:42:00', 'cancelled', 1, '215 Lawrence St, Wodonga, VIC', '0.48', '13 Tor St, Gundagai, NSW', '0.42', '4h39', '2024-12-15 10:42:00', '2024-12-15 14:44:00', '-36.12', '146.88', '-35.06', '148.10', '2024-12-13 17:44:09', '2024-12-13 12:25:52', 13, 2, 0, 1),
(73, 80, 310, '2024-12-14 07:49:00', 'rejected', 1, '215 Lawrence St, Wodonga, VIC', '0.48', '13 Tor St, Gundagai, NSW', '0.42', '4h39', '2024-12-14 00:49:00', '2024-12-14 04:51:00', '-36.12', '146.88', '-35.06', '148.10', '2024-12-13 17:53:26', '2024-12-13 12:34:23', 13, 2, 0, 0),
(74, 81, 309, '2024-12-15 18:15:00', 'cancelled', 1, 'Blende St, Broken Hill, NSW', '0.09', '7–9 Opal St, Lightning Ridge, NSW', '0.26', '22h31', '2024-12-15 11:15:00', '2024-12-16 04:20:00', '-31.96', '141.46', '-29.43', '147.98', '2024-12-13 18:19:37', '2024-12-13 13:03:18', 48, 6, 1, 0),
(75, 81, 310, '2024-12-15 18:15:00', 'cancelled', 1, 'Blende St, Broken Hill, NSW', '0.09', 'Cobar', '0.43', '8h18', '2024-12-15 11:15:00', '2024-12-15 17:13:14', '-31.96', '141.46', '-31.50', '145.84', '2024-12-13 18:21:43', '2024-12-13 13:36:41', 29, 4, 1, 0),
(76, 81, 377, '2024-12-15 18:15:00', 'rejected', 1, 'Cobar', '0.43', 'Nyngan', '0.13', '2h22', '2024-12-15 22:40:21', '2024-12-15 20:29:36', '-31.50', '145.84', '-31.56', '147.19', '2024-12-13 18:25:25', '2024-12-13 13:00:42', 9, 1, 0, 0),
(77, 81, 380, '2024-12-15 18:15:00', 'cancelled', 1, 'Nyngan', '0.13', '7–9 Opal St, Lightning Ridge, NSW', '0.26', '5h42', '2024-12-16 01:56:43', '2024-12-16 04:20:00', '-31.56', '147.19', '-29.43', '147.98', '2024-12-13 18:27:48', '2024-12-13 13:19:31', 17, 2, 1, 0),
(78, 82, 366, '2024-12-15 19:10:00', 'rejected', 1, 'Cobar', '0.43', 'Nyngan', '0.13', '2h22', '2024-12-15 23:35:21', '2024-12-15 21:24:36', '-31.50', '145.84', '-31.56', '147.19', '2024-12-13 19:48:25', '2024-12-13 14:31:45', 9, 1, 0, 0),
(79, 82, 379, '2024-12-15 19:49:28', 'rejected', 1, 'Blende St, Broken Hill, NSW', '0.09', 'Cobar', '0.43', '11h25 minutes', '2024-12-15 12:10:00', '2024-12-15 23:35:00', '-31.5', '145.84', '-31.96', '141.46', '2024-12-13 19:49:28', '2024-12-13 14:25:57', 29, 4, 0, 0),
(80, 82, 380, '2024-12-15 19:10:00', 'cancelled', 1, 'Cobar', '0.43', 'Lightning Ridge NSW 2834, Australia', '0.26', '8h13', '2024-12-15 23:35:21', '2024-12-16 05:15:00', '-31.50', '145.84', '-29.43', '147.98', '2024-12-13 19:49:31', '2024-12-13 14:27:11', 22, 3, 1, 0),
(81, 82, 377, '2024-12-15 19:10:00', 'cancelled', 1, 'Nyngan', '0.13', 'Lightning Ridge NSW 2834, Australia', '0.26', '5h42', '2024-12-16 02:51:43', '2024-12-16 05:15:00', '-31.56', '147.19', '-29.43', '147.98', '2024-12-13 19:50:41', '2024-12-13 14:29:46', 17, 2, 1, 0),
(82, 83, 380, '2024-12-20 16:30:00', 'rejected', 1, '210 Elizabeth St, Melbourne VIC 3000', '0.00', 'Albury', '0.00', '5h56', '2024-12-20 09:30:00', '2024-12-20 13:32:35', '-37.8136186', '144.963086', '-36.0737293', '146.9135418', '2024-12-13 21:25:08', '2024-12-13 16:00:44', 23, 3, 0, 0),
(83, 83, 310, '2024-12-20 16:30:00', 'cancelled', 1, 'Albury', '0.00', 'Canberra', '0.00', '6h8', '2024-12-20 17:36:08', '2024-12-20 20:11:54', '-36.0737293', '146.9135418', '-35.2801846', '149.1310324', '2024-12-13 21:25:54', '2024-12-13 16:02:25', 17, 2, 1, 0),
(84, 83, 377, '2024-12-20 16:30:00', 'rejected', 1, 'Canberra', '0.00', '110-140 King St, Sydney NSW 2000', '0.00', '5h9', '2024-12-21 02:02:25', '2024-12-21 03:20:00', '-35.2801846', '149.1310324', '-33.8688222', '151.20931', '2024-12-13 21:25:54', '2024-12-13 16:10:19', 23, 3, 0, 0),
(85, 83, 309, '2024-12-20 16:30:00', 'rejected', 1, '210 Elizabeth St, Melbourne VIC 3000', '0.00', '110-140 King St, Sydney NSW 2000', '0.00', '21h54', '2024-12-20 09:30:00', '2024-12-21 03:20:00', '-37.8136186', '144.963086', '-33.8688222', '151.20931', '2024-12-13 21:28:23', '2024-12-13 16:10:27', 58, 8, 0, 0),
(86, 84, 377, '2024-12-13 22:15:00', 'completed', 1, 'By appointment only, Albury NSW 2640', '0.00', '3 Petrie Plaza, Canberra ACT 2601', '0.01', '8h26', '2024-12-13 15:15:00', '2024-12-13 20:43:00', '-36.0737293', '146.9135418', '-35.2801347', '149.1311399', '2024-12-13 21:45:41', '2024-12-13 16:24:55', 15, 2, 0, 0),
(87, 84, 310, '2024-12-13 22:15:00', 'completed', 1, 'By appointment only, Albury NSW 2640', '0.00', '3 Petrie Plaza, Canberra ACT 2601', '0.01', '8h26', '2024-12-13 15:15:00', '2024-12-13 20:43:00', '-36.0737293', '146.9135418', '-35.2801347', '149.1311399', '2024-12-13 21:45:51', '2024-12-13 16:25:09', 15, 2, 0, 0),
(88, 84, 309, '2024-12-13 22:15:00', 'completed', 1, 'By appointment only, Albury NSW 2640', '0.00', '3 Petrie Plaza, Canberra ACT 2601', '0.01', '8h26', '2024-12-13 15:15:00', '2024-12-13 20:43:00', '-36.0737293', '146.9135418', '-35.2801347', '149.1311399', '2024-12-13 21:46:25', '2024-12-13 16:25:22', 15, 2, 0, 0),
(89, 85, 377, '2024-12-14 03:47:00', 'cancelled', 1, 'Broken Hill NSW 2880, Australia', '0.09', 'Albury NSW, Australia', '0.52', '20h54', '2024-12-13 20:47:00', '2024-12-14 13:45:00', '-31.96', '141.46', '-36.07', '146.91', '2024-12-13 21:48:18', '2024-12-13 16:19:28', 47, 6, 0, 1),
(90, 86, 380, '2024-12-14 15:30:00', 'cancelled', 1, '3 Roe St, Perth WA 6000', '0.03', '167 Albert St, Brisbane City QLD 4000', '0.01', '108h9', '2024-12-14 08:30:00', '2024-12-18 02:39:00', '-31.9513357', '115.861407', '-27.4705069', '153.0260841', '2024-12-13 21:55:52', '2024-12-13 16:27:26', 248, 32, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('location_38.183.10.255', 'O:29:\"Stevebauman\\Location\\Position\":16:{s:2:\"ip\";s:13:\"38.183.10.255\";s:6:\"driver\";s:34:\"Stevebauman\\Location\\Drivers\\IpApi\";s:11:\"countryName\";s:5:\"India\";s:12:\"currencyCode\";s:3:\"INR\";s:11:\"countryCode\";s:2:\"IN\";s:10:\"regionCode\";s:2:\"CH\";s:10:\"regionName\";s:10:\"Chandigarh\";s:8:\"cityName\";s:10:\"Chandigarh\";s:7:\"zipCode\";s:6:\"140603\";s:7:\"isoCode\";N;s:10:\"postalCode\";N;s:8:\"latitude\";s:7:\"30.7339\";s:9:\"longitude\";s:7:\"76.7889\";s:9:\"metroCode\";N;s:8:\"areaCode\";s:2:\"CH\";s:8:\"timezone\";s:12:\"Asia/Kolkata\";}', 1733982726),
('location_83.137.6.190', 'O:29:\"Stevebauman\\Location\\Position\":16:{s:2:\"ip\";s:12:\"83.137.6.190\";s:6:\"driver\";s:34:\"Stevebauman\\Location\\Drivers\\IpApi\";s:11:\"countryName\";s:11:\"Switzerland\";s:12:\"currencyCode\";s:3:\"CHF\";s:11:\"countryCode\";s:2:\"CH\";s:10:\"regionCode\";s:2:\"GE\";s:10:\"regionName\";s:6:\"Geneva\";s:8:\"cityName\";s:6:\"Geneva\";s:7:\"zipCode\";s:4:\"1200\";s:7:\"isoCode\";N;s:10:\"postalCode\";N;s:8:\"latitude\";s:7:\"46.2022\";s:9:\"longitude\";s:7:\"6.14569\";s:9:\"metroCode\";N;s:8:\"areaCode\";s:2:\"GE\";s:8:\"timezone\";s:13:\"Europe/Zurich\";}', 1733653199);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `make` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `license_plate` varchar(20) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `seats` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `user_id`, `make`, `model`, `year`, `license_plate`, `color`, `seats`, `created_at`, `updated_at`, `type`, `deleted_at`) VALUES
(1, 310, 'Toyota', 'Yaris', 2000, NULL, 'Blue', NULL, '2024-12-05 19:55:22', '2024-12-05 20:00:50', 'Minivan', '2024-12-05 20:00:50'),
(2, 310, 'Honda', 'Civic GX', 2023, NULL, 'Orange', NULL, '2024-12-05 20:01:20', '2024-12-05 20:01:20', 'Pickup', NULL),
(3, 335, 'Mahindra', 'Thar', 1990, 'testament', 'Black', NULL, '2024-12-06 18:36:37', '2024-12-06 18:39:03', 'SUV', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_tokens`
--

CREATE TABLE `chat_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ride_id` bigint(20) UNSIGNED DEFAULT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `chat_token` varchar(255) NOT NULL,
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `blocked_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `chat_tokens`
--

INSERT INTO `chat_tokens` (`id`, `ride_id`, `driver_id`, `user_id`, `chat_token`, `is_blocked`, `blocked_by`, `created_at`, `updated_at`) VALUES
(1, NULL, 309, 310, 'CHe4ae4103158e4bfd8993eea002665236', 0, NULL, '2024-12-05 19:26:25', '2024-12-11 19:16:37'),
(2, NULL, 337, 335, 'CH1c31a0307db741f980a4d410a5857630', 0, NULL, '2024-12-06 16:32:19', '2024-12-06 16:32:19'),
(3, NULL, 309, 335, 'CH1b339c20ca8b40c99584362c83496771', 0, NULL, '2024-12-06 16:37:52', '2024-12-06 16:37:52'),
(4, NULL, 335, 338, 'CHcf3b8db862984eb398b5aeb7864781a3', 0, NULL, '2024-12-06 17:14:06', '2024-12-06 17:14:06'),
(8, NULL, 309, 338, 'CH1298bf2e530f4557b6694261bb832a06', 0, NULL, '2024-12-10 16:33:58', '2024-12-10 16:55:24'),
(10, NULL, 379, 380, 'CH993c56d8f9044eaf96efbd16292fcf1b', 0, NULL, '2024-12-12 19:24:33', '2024-12-12 19:24:33');

-- --------------------------------------------------------

--
-- Table structure for table `content_pages`
--

CREATE TABLE `content_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_pages`
--

INSERT INTO `content_pages` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'privacy_policy', '<span style=\"font-weight: normal;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span>', 1, '2024-07-31 03:45:12', '2024-09-10 05:26:15'),
(6, 'terms_and_conditions', '<u>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</u>', 1, '2024-07-31 03:45:13', '2024-09-10 05:26:02'),
(7, 'About us', '<span style=\"font-weight: normal;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span>', 1, '2024-07-31 03:45:13', '2024-09-10 05:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `template_name` varchar(255) NOT NULL,
  `template` longtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `subject`, `template_name`, `template`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Email Address Verification', 'Otp_Verification', '<!doctype html>\n                <html>\n                <head>\n                    <title>{{$companyName}}</title>\n                    <meta charset=\"utf-8\">\n                    <meta name=\"viewport\" content=\"width=device-width\">\n                    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n                    <meta name=\"x-apple-disable-message-reformatting\">\n                    <meta http-equiv=\"Content-Type\" content=\"text/html charset=UTF-8\" />\n                    <link href=\"https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap\" rel=\"stylesheet\" />\n                    <!--–[if mso]-->\n                    <style type=\"text/css\">body, td,p {\n                        font-family: Helvetica, Arial, sans-serif !important;\n                        }\n                    </style>\n                </head>\n                <body>\n                    <table style=\"margin: auto;background:#f5f5f5;\" role=\"presentation\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"600\">\n                        <tbody>\n                            <tr>\n                                <td style=\"padding: 1.5em 2.5em 1.5em 2.5em; background-color:#79a1e1;\" valign=\"top\" align=\"center\">\n                                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"230\">\n                                        <tbody>\n                                            <tr>\n                                                \n                                            </tr>\n                                        </tbody>\n                                    </table>\n                                </td>\n                            </tr>\n                            <tr>\n                                <td valign=\"top\" align=\"center\" style=\"background-color:#79a1e1;padding:0px 10px 0;\">\n                                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"540\">\n                                        <tbody>\n                                            <tr>\n                                                <td valign=\"top\" style=\"padding: 0em 2em 1em;background:#ffffff;\" valign=\"middle\">\n                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n                                                </td>\n                                            </tr>\n                                        </tbody>\n                                    </table>\n                                </td>\n                            </tr>\n                            <!-- end tr -->\n                            <tr>\n                                <td style=\"padding: 0em 2em 1.5em; background:#f5f5f5;\" valign=\"middle\">\n                                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"540\">\n                                        <tbody>\n                                            <tr>\n                                                <td valign=\"top\" style=\"padding: 0em 2.5em 2em;background:#ffffff;\">\n                                                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                                                        <tbody>\n                                                            <tr>\n                                                                <td valign=\"top\" style=\"text-align: left; color: #000000; font-size: 18px; padding-top: 0; line-height: 1.4; font-weight: bold;font-family: Helvetica, Arial, sans-serif;\">\n                                                                    Hello {{$name}},\n                                                                </td>\n                                                            </tr>\n                                                             <tr>\n                                                                <td valign=\"top\" style=\"text-align: left; color: #000000; font-size: 16px; padding:15px 0 15px; line-height: 1.4; font-weight: 400;font-family: Helvetica, Arial, sans-serif;\">\n                                                                    Welcome to {{$COMPANYNAME}}\n                                                                </td>\n                                                            </tr>\n                                                            <tr>\n                                                                <td valign=\"top\" style=\"text-align: left; color: #000000; font-size: 16px; padding:15px 0 15px; line-height: 1.4; font-weight: 400;font-family: Helvetica, Arial, sans-serif;\">\n                                                                    Please verify your email address via enter otp.\n                                                                </td>\n                                                            </tr>\n                                                            \n                                                            \n                                                             <tr>\n                                                                <td valign=\"top\" style=\"text-align: left; color: #000000; font-size: 16px; padding-top: 0px; line-height: 1.4; font-weight: 400;font-family: Helvetica, Arial, sans-serif;word-break: break-all;\">\n                                                                    <p style=\"text-align: left;\">Verification OTP:- {{$otp}}</p>\n                                                                </td>\n                                                            </tr>\n                                  \n                                                            <tr>\n                                                                <td valign=\"top\" style=\"text-align: left; color: #000000; font-size: 16px; padding-top: 30px; line-height: 1.4; font-weight: 400;font-family: Helvetica, Arial, sans-serif;\">\n                                                                    Thanks<br><strong>{{$COMPANYNAME}} Team</strong>\n                                                                </td>\n                                                            </tr>\n                                                        </tbody>\n                                                    </table>\n                                                </td>\n                                            </tr>\n                                        </tbody>\n                                    </table>\n                                </td>\n                            </tr>\n\n                            <tr>\n                                <td style=\"padding: 15px 20px 15px;background:#79a1e1;\" align=\"center\">\n                                    <p style=\"margin: 0; font-size: 12px;font-family: Helvetica, Arial, sans-serif;\">&copy; {{YEAR}} <a style=\"color: #141637;\" >{{$COMPANYNAME}}</a>. All Rights Reserved</p>\n                                </td>\n                            </tr>\n                        </tbody>\n                    </table>\n                </body>\n            </html>', 1, '2024-08-28 05:46:49', '2024-08-28 05:46:49'),
(2, 'Account Created', 'welcome', '<!doctype html>\n<html>\n   <head>\n      <title>{{$companyName}}</title>\n      <meta charset=\"utf-8\">\n      <meta name=\"viewport\" content=\"width=device-width\">\n      <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n      <meta name=\"x-apple-disable-message-reformatting\">\n      <meta http-equiv=\"Content-Type\" content=\"text/html charset=UTF-8\" />\n      <link href=\"https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap\" rel=\"stylesheet\" />\n      <!--–[if mso]-->\n      <style type=\"text/css\">body, td,p {\n         font-family: Helvetica, Arial, sans-serif !important;\n         }\n      </style>\n   </head>\n   <body>\n      <table style=\"margin: auto;background:#f5f5f5;\" role=\"presentation\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"600\">\n         <tbody>\n            <tr>\n               <td style=\"padding: 1.5em 2.5em 1.5em 2.5em; background-color:#79a1e1;\" valign=\"top\" align=\"center\">\n                  <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"230\">\n                     <tbody>\n                        <tr>\n                        </tr>\n                     </tbody>\n                  </table>\n               </td>\n            </tr>\n            <tr>\n               <td valign=\"top\" align=\"center\" style=\"background-color:#79a1e1;padding:0px 10px 0;\">\n                  <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"540\">\n                     <tbody>\n                        <tr>\n                           <td valign=\"top\" style=\"padding: 0em 2em 1em;background:#ffffff;\" valign=\"middle\">\n                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n                           </td>\n                        </tr>\n                     </tbody>\n                  </table>\n               </td>\n            </tr>\n            <!-- end tr -->\n            <tr>\n               <td style=\"padding: 0em 2em 1.5em; background:#f5f5f5;\" valign=\"middle\">\n                  <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"540\">\n                     <tbody>\n                        <tr>\n                           <td valign=\"top\" style=\"padding: 0em 2.5em 2em;background:#ffffff;\">\n                              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                                 <tbody>\n                                    <tr>\n                                       <td valign=\"top\" style=\"text-align: left; color: #000000; font-size: 18px; padding-top: 0; line-height: 1.4; font-weight: bold;font-family: Helvetica, Arial, sans-serif;\">\n                                          Hello {{$name}},\n                                       </td>\n                                    </tr>\n                                    <tr>\n                                       <td valign=\"top\" style=\"text-align: left; color: #000000; font-size: 16px; padding:15px 0 15px; line-height: 1.4; font-weight: 400;font-family: Helvetica, Arial, sans-serif;\">\n                                          Welcome to {{$COMPANYNAME}}\n                                       </td>\n                                    </tr>\n                                    <tr>\n                                       <td valign=\"top\" style=\"text-align: left; color: #000000; font-size: 16px; padding:15px 0 15px; line-height: 1.4; font-weight: 400;font-family: Helvetica, Arial, sans-serif;\">\n                                          <p>Your account has been created by admin.</p>\n                                          <p>Here are your login credentials:</p>\n                                          <p>Email: {{$email}}</p>\n                                          <p>Password: {{$password}}</p>\n                                          <p><strong>Important:</strong> Please change your password after your first login.</p>\n                                       </td>\n                                    </tr>\n                                    <tr>\n                                       <td valign=\"top\" style=\"text-align: left; color: #000000; font-size: 16px; padding-top: 30px; line-height: 1.4; font-weight: 400;font-family: Helvetica, Arial, sans-serif;\">\n                                          Thanks<br><strong>{{$COMPANYNAME}} Team</strong>\n                                       </td>\n                                    </tr>\n                                 </tbody>\n                              </table>\n                           </td>\n                        </tr>\n                     </tbody>\n                  </table>\n               </td>\n            </tr>\n            <tr>\n               <td style=\"padding: 15px 20px 15px;background:#79a1e1;\" align=\"center\">\n                  <p style=\"margin: 0; font-size: 12px;font-family: Helvetica, Arial, sans-serif;\">&copy; {{YEAR}} <a style=\"color: #141637;\" >{{$COMPANYNAME}}</a>. All Rights Reserved</p>\n               </td>\n            </tr>\n         </tbody>\n      </table>\n   </body>\n</html>', 1, '2024-08-28 05:46:49', '2024-08-28 05:46:49'),
(3, 'Reset New Password', 'Forget_password', '<!DOCTYPE html>\n<html>\n<head>\n    <title>{{$companyName}}</title>\n    <meta charset=\"utf-8\">\n    <meta name=\"viewport\" content=\"width=device-width\">\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n    <meta name=\"x-apple-disable-message-reformatting\">\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\n    <link href=\"https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400;1,700&display=swap\" rel=\"stylesheet\" />\n    <!--[if mso]>\n    <style type=\"text/css\">\n        body, td, p {\n            font-family: Helvetica, Arial, sans-serif !important;\n        }\n    </style>\n    <![endif]-->\n</head>\n<body>\n    <table style=\"margin: auto; background: linear-gradient(96.8deg, #6316DB -0.73%, #350C75 -0.73%, #11998E 148.47%);\" role=\"presentation\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"600\">\n        <tbody>\n            <tr>\n                <td style=\"padding: 1.5em 2.5em; background-color: #linear-gradient(96.8deg, #6316DB -0.73%, #350C75 -0.73%, #11998E 148.47%);;\" valign=\"top\" align=\"center\">\n                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"230\">\n                        <tbody>\n                            <tr>\n                                \n                            </tr>\n                        </tbody>\n                    </table>\n                </td>\n            </tr>\n            <tr>\n                <td valign=\"top\" align=\"center\" style=\"background-color: #linear-gradient(96.8deg, #6316DB -0.73%, #350C75 -0.73%, #11998E 148.47%);; padding: 0px 10px;\">\n                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"540\">\n                        <tbody>\n                            <tr>\n                                <td valign=\"top\" style=\"padding: 0em 2em 1em; background: #ffffff;\" valign=\"middle\">\n                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n                                </td>\n                            </tr>\n                        </tbody>\n                    </table>\n                </td>\n            </tr>\n            <!-- end tr -->\n            <tr>\n                <td style=\"padding: 0em 2em 1.5em; background: #f5f5f5;\" valign=\"middle\">\n                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"540\">\n                        <tbody>\n                            <tr>\n                                <td valign=\"top\" style=\"padding: 0em 2.5em 2em; background: #ffffff;\">\n                                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                                        <tbody>\n                                            <tr>\n                                                <td valign=\"top\" style=\"text-align: left; color: #000000; font-size: 18px; padding-top: 0; line-height: 1.4; font-weight: bold; font-family: Helvetica, Arial, sans-serif;\">\n                                                    Hello {{$name}},\n                                                </td>\n                                            </tr>\n                                            <tr>\n                                                <td valign=\"top\" style=\"text-align: left; color: #000000; font-size: 16px; padding: 15px 0 15px; line-height: 1.4; font-weight: 400; font-family: Helvetica, Arial, sans-serif;\">\n                                                    Welcome to {{$COMPANYNAME}}\n                                                </td>\n                                            </tr>\n                                            <tr>\n                                                <td valign=\"top\" style=\"text-align: left; color: #000000; font-size: 16px; padding: 15px 0 15px; line-height: 1.4; font-weight: 400; font-family: Helvetica, Arial, sans-serif;\">\n                                                    Click here to reset password.\n                                                </td>\n                                            </tr>\n                                            <tr>\n                                                <td>\n                                                    <button style=\"background-color: #linear-gradient(96.8deg, #6316DB -0.73%, #350C75 -0.73%, #11998E 148.47%); color: #ffffff; padding: 10px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border: none; border-radius: 12px;\"><a href=\"{{$token}}\" target=\"_blank\">Click Here</a></button>\n                                                </td>\n                                            </tr>\n                                            <tr>\n                                                <td valign=\"top\" style=\"text-align: left; color: #000000; font-size: 16px; padding-top: 0px; line-height: 1.4; font-weight: 400; font-family: Helvetica, Arial, sans-serif; word-break: break-all;\">\n                                                    <p style=\"text-align: left;\">Or copy the url for reset password</p>\n                                                </td>\n                                            </tr>\n                                            <tr>\n                                                <td valign=\"top\" style=\"text-align: left; color: #000000; font-size: 16px; padding-top: 0px; line-height: 1.4; font-weight: 400; font-family: Helvetica, Arial, sans-serif; word-break: break-all;\">\n                                                    <p style=\"text-align: left;\">Reset Url:- {{$token}}</p>\n                                                </td>\n                                            </tr>\n                                            <tr>\n                                                <td valign=\"top\" style=\"text-align: left; color: #000000; font-size: 16px; padding-top: 30px; line-height: 1.4; font-weight: 400; font-family: Helvetica, Arial, sans-serif;\">\n                                                    Thanks<br><strong>{{$COMPANYNAME}} Team</strong>\n                                                </td>\n                                            </tr>\n                                        </tbody>\n                                    </table>\n                                </td>\n                            </tr>\n                        </tbody>\n                    </table>\n                </td>\n            </tr>\n            <tr>\n                <td style=\"padding: 15px 20px 15px; background: #linear-gradient(96.8deg, #6316DB -0.73%, #350C75 -0.73%, #11998E 148.47%);;\" align=\"center\">\n                    <p style=\"margin: 0; font-size: 12px; font-family: Helvetica, Arial, sans-serif;\">&copy; {{YEAR}} <a style=\"color: #141637;\" >{{$COMPANYNAME}}</a>. All Rights Reserved</p>\n                </td>\n            </tr>\n        </tbody>\n    </table>\n</body>\n</html>\n', 1, '2024-08-28 05:46:49', '2024-08-28 05:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fares`
--

CREATE TABLE `fares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `base_fare` decimal(8,2) NOT NULL,
  `cost_per_kilometer` decimal(8,2) NOT NULL,
  `cost_per_minute` decimal(8,2) DEFAULT NULL,
  `service_type` varchar(255) DEFAULT NULL,
  `car_id` bigint(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(50) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `country_code` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `commission` varchar(50) DEFAULT NULL,
  `platform_fee` varchar(50) DEFAULT NULL,
  `per_km_price` varchar(50) DEFAULT NULL,
  `app_url` text DEFAULT NULL,
  `google_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `logo`, `email`, `country_code`, `phone`, `address`, `created_at`, `updated_at`, `commission`, `platform_fee`, `per_km_price`, `app_url`, `google_url`) VALUES
(1, 'Nexgo', '1726138425.png', 'contact@Nexgo.com.au', NULL, '07009951634', NULL, '2024-09-12 05:23:45', '2024-12-08 16:33:59', NULL, '15', '0.06', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ride_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_07_11_055638_create_cars_table', 1),
(5, '2024_07_11_060435_create_rides_table', 1),
(6, '2024_07_11_062026_create_bookings_table', 1),
(7, '2024_07_11_062640_create_payments_table', 1),
(8, '2024_07_11_063153_create_reviews_table', 1),
(9, '2024_07_11_064052_create_messages_table', 1),
(10, '2024_07_11_064548_create_notifications_table', 1),
(11, '2024_07_11_070220_create_otp_management_table', 1),
(12, '2024_07_11_100718_create_personal_access_tokens_table', 1),
(13, '2024_07_11_103003_add_first_name_on_users_table', 1),
(14, '2024_07_12_071122_add_country_code_on_users_table', 1),
(15, '2024_07_16_060302_create_general_settings_table', 1),
(16, '2024_07_16_110237_add_dob_to_users_table', 1),
(17, '2024_07_18_053452_add_id_card_on_users_tablele', 1),
(18, '2024_07_18_070833_create_vechiles_table', 1),
(19, '2024_07_19_072821_add_type_column_cars_table', 1),
(20, '2024_07_22_070124_create_policies_table', 1),
(21, '2024_07_24_070346_add_seat_booked_ride_table', 1),
(22, '2024_07_25_093416_add_status_on_ride_table', 2),
(23, '2024_07_26_062648_add_deleted_at_on_cars_table', 2),
(24, '2024_07_29_113110_add_preferences_on_users_table', 3),
(25, '2024_07_31_045752_add_stopovers_passenger_options_on_rides', 4),
(26, '2024_07_31_085953_create_user_notifications_table', 4),
(27, '2024_08_01_065748_change_nupassword_nullable_on_user', 4),
(28, '2024_08_01_070506_create_providers_table', 4),
(29, '2024_08_02_051115_create_fares_table', 4),
(30, '2024_08_05_072717_create_countries_table', 5),
(31, '2024_08_12_114955_add_transaction_id_on_table_paymnments', 6),
(32, '2024_08_23_104044_create_reports_table', 7),
(33, '2024_08_23_105214_create_user_reports_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `read_status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `type`, `message`, `timestamp`, `read_status`, `created_at`, `updated_at`) VALUES
(4, 306, 'user registration', 'New User registered', '2024-12-04 19:18:49', 0, '2024-12-04 19:18:56', '2024-12-04 19:18:56'),
(5, 307, 'user registration', 'New User registered', '2024-12-04 19:19:56', 0, '2024-12-04 19:20:03', '2024-12-04 19:20:03'),
(6, 308, 'user registration', 'New User registered', '2024-12-04 19:25:09', 0, '2024-12-04 19:25:17', '2024-12-04 19:25:17'),
(7, 309, 'user registration', 'New User registered', '2024-12-05 11:29:08', 0, '2024-12-05 11:29:15', '2024-12-05 11:29:15'),
(8, 309, 'Document Approval Request', 'New document Verify Requested.', '2024-12-05 11:42:39', 0, '2024-12-05 11:42:39', '2024-12-05 11:42:39'),
(9, 310, 'user registration', 'New User registered', '2024-12-05 12:07:00', 0, '2024-12-05 12:07:16', '2024-12-05 12:07:16'),
(10, 310, 'Document Approval Request', 'New document Verify Requested.', '2024-12-05 12:10:54', 0, '2024-12-05 12:10:54', '2024-12-05 12:10:54'),
(11, 311, 'user registration', 'New User registered', '2024-12-05 12:38:36', 0, '2024-12-05 12:38:43', '2024-12-05 12:38:43'),
(12, 310, 'Document Approval Request', 'New document Verify Requested.', '2024-12-05 13:00:43', 0, '2024-12-05 13:00:43', '2024-12-05 13:00:43'),
(13, 312, 'user registration', 'New User registered', '2024-12-05 15:42:58', 0, '2024-12-05 15:43:04', '2024-12-05 15:43:04'),
(14, 313, 'user registration', 'New User registered', '2024-12-05 15:44:54', 0, '2024-12-05 15:45:00', '2024-12-05 15:45:00'),
(15, 314, 'user registration', 'New User registered', '2024-12-05 15:52:56', 0, '2024-12-05 15:53:03', '2024-12-05 15:53:03'),
(16, 315, 'user registration', 'New User registered', '2024-12-05 15:54:36', 0, '2024-12-05 15:54:43', '2024-12-05 15:54:43'),
(17, 316, 'user registration', 'New User registered', '2024-12-05 15:59:19', 0, '2024-12-05 15:59:26', '2024-12-05 15:59:26'),
(20, 319, 'user registration', 'New User registered', '2024-12-05 17:18:45', 0, '2024-12-05 17:18:55', '2024-12-05 17:18:55'),
(24, 323, 'user registration', 'New User registered', '2024-12-05 17:45:55', 0, '2024-12-05 17:46:02', '2024-12-05 17:46:02'),
(25, 324, 'user registration', 'New User registered', '2024-12-05 17:47:50', 0, '2024-12-05 17:47:57', '2024-12-05 17:47:57'),
(29, 332, 'user registration', 'New User registered', '2024-12-05 18:36:50', 0, '2024-12-05 18:36:57', '2024-12-05 18:36:57'),
(32, 334, 'user registration', 'New User registered', '2024-12-06 12:05:19', 0, '2024-12-06 12:05:27', '2024-12-06 12:05:27'),
(33, 334, 'Document Approval Request', 'New document Verify Requested.', '2024-12-06 12:09:01', 0, '2024-12-06 12:09:01', '2024-12-06 12:09:01'),
(34, 335, 'user registration', 'New User registered', '2024-12-06 15:50:44', 0, '2024-12-06 15:51:01', '2024-12-06 15:51:01'),
(35, 336, 'user registration', 'New User registered', '2024-12-06 15:55:59', 0, '2024-12-06 15:56:06', '2024-12-06 15:56:06'),
(36, 337, 'user registration', 'New User registered', '2024-12-06 15:57:18', 0, '2024-12-06 15:57:26', '2024-12-06 15:57:26'),
(37, 338, 'user registration', 'New User registered', '2024-12-06 17:09:41', 0, '2024-12-06 17:09:48', '2024-12-06 17:09:48'),
(38, 335, 'Document Approval Request', 'New document Verify Requested.', '2024-12-06 17:52:24', 0, '2024-12-06 17:52:24', '2024-12-06 17:52:24'),
(39, 337, 'Document Approval Request', 'New document Verify Requested.', '2024-12-06 17:52:33', 0, '2024-12-06 17:52:33', '2024-12-06 17:52:33'),
(40, 339, 'user registration', 'New User registered', '2024-12-06 19:13:18', 0, '2024-12-06 19:13:25', '2024-12-06 19:13:25'),
(41, 339, 'Document Approval Request', 'New document Verify Requested.', '2024-12-06 20:05:23', 0, '2024-12-06 20:05:23', '2024-12-06 20:05:23'),
(42, 341, 'user registration', 'New User registered', '2024-12-06 21:30:20', 0, '2024-12-06 21:30:28', '2024-12-06 21:30:28'),
(46, 341, 'Document Approval Request', 'New document Verify Requested.', '2024-12-08 01:59:01', 0, '2024-12-08 01:59:01', '2024-12-08 01:59:01'),
(51, 348, 'user registration', 'New User registered', '2024-12-11 20:18:50', 0, '2024-12-11 20:18:57', '2024-12-11 20:18:57'),
(52, 349, 'user registration', 'New User registered', '2024-12-11 20:19:49', 0, '2024-12-11 20:19:56', '2024-12-11 20:19:56'),
(53, 350, 'user registration', 'New User registered', '2024-12-11 20:26:24', 0, '2024-12-11 20:26:32', '2024-12-11 20:26:32'),
(54, 351, 'user registration', 'New User registered', '2024-12-11 20:28:20', 0, '2024-12-11 20:28:29', '2024-12-11 20:28:29'),
(58, 366, 'user registration', 'New User registered', '2024-12-12 11:39:08', 0, '2024-12-12 11:39:15', '2024-12-12 11:39:15'),
(59, 370, 'user registration', 'New User registered', '2024-12-12 11:43:36', 0, '2024-12-12 11:43:44', '2024-12-12 11:43:44'),
(60, 373, 'user registration', 'New User registered', '2024-12-12 11:55:02', 0, '2024-12-12 11:55:10', '2024-12-12 11:55:10'),
(61, 377, 'user registration', 'New User registered', '2024-12-12 12:02:26', 0, '2024-12-12 12:02:33', '2024-12-12 12:02:33'),
(62, 377, 'Document Approval Request', 'New document Verify Requested.', '2024-12-12 16:57:15', 0, '2024-12-12 16:57:15', '2024-12-12 16:57:15'),
(63, 379, 'user registration', 'New User registered', '2024-12-12 16:57:38', 0, '2024-12-12 16:57:45', '2024-12-12 16:57:45'),
(64, 380, 'user registration', 'New User registered', '2024-12-12 16:57:40', 0, '2024-12-12 16:57:52', '2024-12-12 16:57:52'),
(65, 379, 'Document Approval Request', 'New document Verify Requested.', '2024-12-12 17:04:29', 0, '2024-12-12 17:04:29', '2024-12-12 17:04:29'),
(66, 380, 'Document Approval Request', 'New document Verify Requested.', '2024-12-12 17:04:36', 0, '2024-12-12 17:04:36', '2024-12-12 17:04:36'),
(67, 383, 'user registration', 'New User registered', '2024-12-12 20:55:08', 0, '2024-12-12 20:55:15', '2024-12-12 20:55:15'),
(68, 383, 'Document Approval Request', 'New document Verify Requested.', '2024-12-12 20:58:35', 0, '2024-12-12 20:58:35', '2024-12-12 20:58:35'),
(69, 384, 'user registration', 'New User registered', '2024-12-12 21:45:21', 0, '2024-12-12 21:45:28', '2024-12-12 21:45:28'),
(70, 385, 'user registration', 'New User registered', '2024-12-12 21:47:29', 0, '2024-12-12 21:47:36', '2024-12-12 21:47:36'),
(71, 386, 'user registration', 'New User registered', '2024-12-12 22:15:26', 0, '2024-12-12 22:15:34', '2024-12-12 22:15:34'),
(72, 387, 'user registration', 'New User registered', '2024-12-13 00:33:28', 0, '2024-12-13 00:33:40', '2024-12-13 00:33:40');

-- --------------------------------------------------------

--
-- Table structure for table `otp_management`
--

CREATE TABLE `otp_management` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otp_management`
--

INSERT INTO `otp_management` (`id`, `email`, `otp`, `created_at`, `updated_at`) VALUES
(1, 'preetiattri39@gmail.com', 1416, '2024-12-04 19:00:38', '2024-12-05 18:36:57'),
(2, 'pm@esferasoft.com', 2330, '2024-12-04 19:06:04', '2024-12-05 12:38:43'),
(3, 'developer@esferasoft.com', 9498, '2024-12-04 19:25:17', '2024-12-04 19:25:17'),
(6, 'androidtest@yopmail.com', 6875, '2024-12-05 15:43:04', '2024-12-05 15:43:04'),
(7, 'ankushchambiyal2+test@gmail.com', 8970, '2024-12-05 15:45:00', '2024-12-05 15:45:00'),
(8, 'ankushchambiyal2+16@gmail.com', 1418, '2024-12-05 15:53:03', '2024-12-05 15:53:35'),
(9, 'ankushchambiyal2@gmail.com', 4133, '2024-12-05 15:54:43', '2024-12-05 17:18:55'),
(10, 'developer+12@esferasoft.com', 5017, '2024-12-05 15:59:26', '2024-12-05 15:59:26'),
(11, 'sam@yopmail.com', 4906, '2024-12-05 16:06:55', '2024-12-05 17:47:57'),
(12, 'geekup.possible@gmail.com', 1795, '2024-12-05 17:33:43', '2024-12-05 18:32:14'),
(16, 'achambiyal4+16@yopmail.com', 1123, '2024-12-06 15:56:06', '2024-12-06 15:56:06'),
(28, 'crislive@yopmail.com', 7662, '2024-12-11 20:18:57', '2024-12-11 20:18:57'),
(29, 'jameslive@yopmail.com', 7047, '2024-12-11 20:19:56', '2024-12-11 20:19:56'),
(37, 'boat@yopmail.com', 4596, '2024-12-12 11:53:33', '2024-12-12 11:53:33'),
(44, 'John.head1@outlook.com', 4248, '2024-12-12 21:45:28', '2024-12-12 21:45:28');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@yopmail.com', 'E0xoTVai', '2024-09-05 07:38:48'),
('preeti@yopmail.com', 'H0V91uG5', '2024-09-05 07:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `refunded_amount` decimal(10,2) DEFAULT NULL,
  `divided_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_date` timestamp NULL DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `paypal_captureId` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `refund_id` varchar(255) DEFAULT NULL,
  `is_refunded` tinyint(4) DEFAULT 0,
  `is_automatic_refunded` tinyint(1) DEFAULT 0,
  `refund_status` tinyint(1) DEFAULT 0,
  `payment_slip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `booking_id`, `amount`, `refunded_amount`, `divided_amount`, `payment_date`, `payment_method`, `status`, `created_at`, `paypal_captureId`, `updated_at`, `transaction_id`, `refund_id`, `is_refunded`, `is_automatic_refunded`, `refund_status`, `payment_slip`) VALUES
(1, 1, 49.00, 24.50, 0.00, '2024-12-05 18:02:35', 'paypal', 'COMPLETED', '2024-12-05 19:36:37', '1XN521910V409172M', '2024-12-12 10:46:50', '4H3362968M3154211', NULL, 0, 0, 0, NULL),
(2, 2, 112.00, NULL, 0.00, '2024-12-05 14:29:40', 'stripe', 'succeeded', '2024-12-05 19:59:03', NULL, '2024-12-05 14:29:40', 'ch_3QSZVIRo3sAQpLlz0QFFjmwO', NULL, 0, 0, 0, NULL),
(3, 3, 17.00, NULL, 0.00, '2024-12-05 17:58:19', 'stripe', 'succeeded', '2024-12-05 23:28:09', NULL, '2024-12-05 17:58:19', 'ch_3QSclCRo3sAQpLlz19LPpBQG', NULL, 0, 0, 0, NULL),
(4, 4, 135.00, NULL, 0.00, '2024-12-05 19:25:22', 'stripe', 'succeeded', '2024-12-06 00:48:07', NULL, '2024-12-05 19:25:22', 'ch_3QSe7SRo3sAQpLlz0beNFZ0x', NULL, 0, 0, 0, NULL),
(5, 5, 58.00, NULL, 0.00, '2024-12-05 20:21:28', 'stripe', 'succeeded', '2024-12-06 01:51:10', NULL, '2024-12-05 20:21:28', 'ch_3QSezjRo3sAQpLlz0xFboUmN', NULL, 0, 0, 0, NULL),
(6, 6, 49.00, NULL, 0.00, NULL, NULL, 'pending', '2024-12-06 17:46:45', NULL, '2024-12-06 22:55:48', NULL, NULL, 0, 0, 0, NULL),
(16, 16, 69.00, NULL, 0.00, '2024-12-06 18:52:30', 'stripe', 'succeeded', '2024-12-07 00:19:34', NULL, '2024-12-06 18:52:30', 'ch_3QT05BRo3sAQpLlz0G9n2gY1', NULL, 0, 0, 0, NULL),
(17, 17, 49.00, NULL, 0.00, NULL, NULL, 'pending', '2024-12-07 00:20:08', NULL, '2024-12-07 00:20:08', NULL, NULL, 0, 0, 0, NULL),
(18, 18, 35.00, NULL, 0.00, '2024-12-06 19:08:14', 'stripe', 'succeeded', '2024-12-07 00:38:07', NULL, '2024-12-06 19:08:14', 'ch_3QT0KPRo3sAQpLlz0ka0rAtM', NULL, 0, 0, 0, NULL),
(20, 20, 17.00, NULL, 0.00, '2024-12-06 19:21:58', 'stripe', 'succeeded', '2024-12-07 00:51:53', NULL, '2024-12-06 19:21:58', 'ch_3QT0XiRo3sAQpLlz1Bd4JATG', NULL, 0, 0, 0, NULL),
(21, 21, 69.00, NULL, 0.00, '2024-12-06 19:36:35', 'stripe', 'succeeded', '2024-12-07 01:06:31', NULL, '2024-12-06 19:36:35', 'ch_3QT0lrRo3sAQpLlz1944Axtb', NULL, 0, 0, 0, NULL),
(22, 22, 23.00, NULL, 0.00, '2024-12-06 19:38:19', 'stripe', 'succeeded', '2024-12-07 01:08:15', NULL, '2024-12-06 19:38:19', 'ch_3QT0nXRo3sAQpLlz0F7zUrud', NULL, 0, 0, 0, NULL),
(23, 23, 35.00, NULL, 0.00, NULL, NULL, 'pending', '2024-12-07 01:19:07', NULL, '2024-12-07 01:19:32', NULL, NULL, 0, 0, 0, NULL),
(24, 24, 17.00, NULL, 0.00, '2024-12-06 19:54:42', 'stripe', 'succeeded', '2024-12-07 01:22:10', NULL, '2024-12-06 19:54:42', 'ch_3QT13ORo3sAQpLlz1QIKjhcC', NULL, 0, 0, 0, NULL),
(33, 33, 112.00, NULL, 0.00, '2024-12-09 18:10:11', 'stripe', 'succeeded', '2024-12-09 23:40:04', NULL, '2024-12-09 18:10:11', 'ch_3QU4qsRo3sAQpLlz0bhcB2H3', NULL, 0, 0, 0, NULL),
(34, 34, 48.00, NULL, 0.00, '2024-12-09 18:18:25', 'stripe', 'succeeded', '2024-12-09 23:47:56', NULL, '2024-12-09 18:18:25', 'ch_3QU4yrRo3sAQpLlz1ClzGFl2', NULL, 0, 0, 0, NULL),
(35, 35, 69.00, NULL, 0.00, '2024-12-09 19:19:48', 'stripe', 'succeeded', '2024-12-10 00:40:38', NULL, '2024-12-09 19:19:48', 'ch_3QU5wGRo3sAQpLlz0xyeAjTs', NULL, 0, 0, 0, NULL),
(36, 36, 12.00, NULL, 0.00, '2024-12-09 19:30:27', 'stripe', 'succeeded', '2024-12-10 01:00:20', NULL, '2024-12-09 19:30:27', 'ch_3QU66YRo3sAQpLlz183hTmHC', NULL, 0, 0, 0, NULL),
(37, 37, 23.00, NULL, 0.00, '2024-12-09 19:34:13', 'stripe', 'succeeded', '2024-12-10 01:03:47', NULL, '2024-12-09 19:34:13', 'ch_3QU6ACRo3sAQpLlz0zqKpTOs', NULL, 0, 0, 0, NULL),
(38, 38, 112.00, 82.00, 0.00, '2024-12-10 19:37:28', 'stripe', 'succeeded', '2024-12-11 00:27:47', NULL, '2024-12-10 20:25:29', 'ch_3QUSgtRo3sAQpLlz0tZ1DrrF', NULL, 1, 0, 1, '1733914640.png'),
(40, 40, 112.00, NULL, 0.00, '2024-12-10 20:31:46', 'stripe', 'succeeded', '2024-12-11 02:01:41', NULL, '2024-12-10 20:31:46', 'ch_3QUTXRRo3sAQpLlz0awNG8Zg', NULL, 0, 0, 0, NULL),
(41, 41, 15.00, NULL, 0.00, NULL, NULL, 'pending', '2024-12-11 02:14:48', NULL, '2024-12-11 02:14:48', NULL, NULL, 0, 0, 0, NULL),
(42, 42, 15.00, NULL, 0.00, NULL, NULL, 'pending', '2024-12-11 02:17:09', NULL, '2024-12-11 02:17:09', NULL, NULL, 0, 0, 0, NULL),
(49, 49, 8.00, 8.00, 0.00, '2024-12-12 11:30:19', 'stripe', 'succeeded', '2024-12-12 16:59:45', NULL, '2024-12-12 11:34:39', 'ch_3QV42YRo3sAQpLlz0R8cxCRG', NULL, 0, 0, 0, NULL),
(50, 50, 49.00, NULL, 0.00, '2024-12-12 12:00:06', 'stripe', 'succeeded', '2024-12-12 17:27:07', NULL, '2024-12-12 12:00:06', 'ch_3QV4VNRo3sAQpLlz1w5a1YHj', NULL, 0, 0, 0, NULL),
(56, 56, 17.00, 7.23, 8.50, '2024-12-12 16:50:15', 'stripe', 'succeeded', '2024-12-12 22:20:00', NULL, '2024-12-12 16:54:33', 'ch_3QV92BRo3sAQpLlz1v5uHpDd', NULL, 0, 0, 0, NULL),
(57, 57, 21.00, 17.85, 17.85, '2024-12-12 17:16:24', 'stripe', 'succeeded', '2024-12-12 22:31:51', NULL, '2024-12-12 17:17:24', 'ch_3QV9RTRo3sAQpLlz0LlrlZY8', NULL, 0, 0, 0, NULL),
(58, 58, 62.00, 52.70, 52.70, '2024-12-12 17:08:11', 'stripe', 'succeeded', '2024-12-12 22:38:04', NULL, '2024-12-12 17:09:36', 'ch_3QV9JWRo3sAQpLlz1SHWGsVH', NULL, 0, 0, 0, NULL),
(59, 59, 23.00, 23.00, 0.00, '2024-12-12 17:59:56', 'stripe', 'succeeded', '2024-12-12 22:45:56', NULL, '2024-12-12 18:02:05', 'ch_3QVA7bRo3sAQpLlz0kuFLm89', NULL, 1, 1, 1, NULL),
(60, 60, 52.00, 52.00, 0.00, '2024-12-12 17:59:58', 'stripe', 'succeeded', '2024-12-12 22:45:58', NULL, '2024-12-12 18:02:04', 'ch_3QVA7dRo3sAQpLlz0dcOztdY', NULL, 1, 1, 1, NULL),
(61, 61, 290.00, 123.25, 145.00, '2024-12-12 17:23:42', 'stripe', 'succeeded', '2024-12-12 22:53:34', NULL, '2024-12-12 17:24:44', 'ch_3QV9YXRo3sAQpLlz1PovKuQo', NULL, 0, 0, 0, NULL),
(62, 62, 15.00, 15.00, 0.00, '2024-12-12 18:50:18', 'stripe', 'succeeded', '2024-12-13 00:20:13', NULL, '2024-12-12 18:54:22', 'ch_3QVAuMRo3sAQpLlz1qLQILCD', NULL, 1, 1, 1, NULL),
(63, 63, 45.00, 45.00, 0.00, '2024-12-12 18:51:57', 'stripe', 'succeeded', '2024-12-13 00:21:52', NULL, '2024-12-12 18:54:30', 'ch_3QVAvxRo3sAQpLlz1YZlysok', NULL, 1, 1, 1, NULL),
(64, 64, 46.00, 46.00, 39.10, '2024-12-12 19:45:23', 'stripe', 'succeeded', '2024-12-13 01:05:13', NULL, '2024-12-12 19:47:01', 'ch_3QVBleRo3sAQpLlz1vL6A7XB', NULL, 1, 1, 1, NULL),
(65, 65, 92.00, 92.00, 0.00, '2024-12-12 19:36:49', 'stripe', 'succeeded', '2024-12-13 01:06:44', NULL, '2024-12-12 19:47:16', 'ch_3QVBdMRo3sAQpLlz1x9W0fT6', NULL, 1, 1, 1, NULL),
(66, 66, 1.00, NULL, 0.00, '2024-12-12 21:53:14', 'stripe', 'succeeded', '2024-12-12 22:52:02', NULL, '2024-12-12 21:53:14', 'ch_3QVDlMRo3sAQpLlz1d0FwPrq', NULL, 0, 0, 0, NULL),
(67, 67, 1.00, 1.00, 0.00, '2024-12-12 22:23:23', 'stripe', 'succeeded', '2024-12-12 23:21:56', NULL, '2024-12-12 22:29:14', 'ch_3QVEEXRo3sAQpLlz13ewYPAj', NULL, 1, 1, 1, NULL),
(68, 68, 1.00, 0.43, 0.50, '2024-12-12 23:36:04', 'stripe', 'succeeded', '2024-12-13 00:35:30', NULL, '2024-12-13 00:15:25', 'ch_3QVFMsRo3sAQpLlz0RgXZlO4', NULL, 0, 0, 0, NULL),
(69, 69, 1.00, 1.00, 0.00, '2024-12-13 00:04:37', 'stripe', 'succeeded', '2024-12-13 01:04:19', NULL, '2024-12-13 00:26:38', 'ch_3QVFoWRo3sAQpLlz1mREcJRw', NULL, 1, 1, 1, NULL),
(70, 70, 1.00, 0.43, 0.50, '2024-12-13 00:38:15', 'stripe', 'succeeded', '2024-12-13 01:37:31', NULL, '2024-12-13 00:40:20', 'ch_3QVGL3Ro3sAQpLlz0rzOucrb', NULL, 0, 0, 0, NULL),
(71, 71, 23.00, 23.00, 0.00, '2024-12-13 11:47:01', 'stripe', 'succeeded', '2024-12-13 17:13:19', NULL, '2024-12-13 11:50:19', 'ch_3QVQmGRo3sAQpLlz0TEH6eAR', NULL, 1, 1, 1, NULL),
(72, 72, 13.00, 5.53, 6.50, '2024-12-13 12:14:50', 'stripe', 'succeeded', '2024-12-13 17:44:09', NULL, '2024-12-13 12:25:52', 'ch_3QVRDBRo3sAQpLlz1YVIJMcZ', NULL, 0, 0, 0, NULL),
(73, 73, 13.00, 13.00, 0.00, '2024-12-13 12:23:51', 'stripe', 'succeeded', '2024-12-13 17:53:26', NULL, '2024-12-13 12:34:24', 'ch_3QVRLuRo3sAQpLlz1xlmaWzN', NULL, 1, 1, 1, NULL),
(74, 74, 48.00, 40.80, 40.80, '2024-12-13 12:49:45', 'stripe', 'succeeded', '2024-12-13 18:19:37', NULL, '2024-12-13 13:14:35', 'ch_3QVRkyRo3sAQpLlz08KQN3as', NULL, 0, 0, 0, NULL),
(75, 75, 29.00, 24.65, 24.65, '2024-12-13 12:52:22', 'stripe', 'succeeded', '2024-12-13 18:21:43', NULL, '2024-12-13 13:36:41', 'ch_3QVRnWRo3sAQpLlz0JkpMuTc', NULL, 0, 0, 0, NULL),
(76, 76, 9.00, 9.00, 0.00, '2024-12-13 12:55:32', 'stripe', 'succeeded', '2024-12-13 18:25:25', NULL, '2024-12-13 13:00:43', 'ch_3QVRqZRo3sAQpLlz0dRaTFwO', NULL, 1, 1, 1, NULL),
(78, 78, 9.00, 9.00, 0.00, '2024-12-13 14:18:33', 'stripe', 'succeeded', '2024-12-13 19:48:25', NULL, '2024-12-13 14:31:46', 'ch_3QVT8uRo3sAQpLlz1d5OjB7g', NULL, 1, 1, 1, NULL),
(79, 79, 29.00, 29.00, 0.00, '2024-12-13 14:19:34', 'stripe', 'succeeded', '2024-12-13 19:49:28', NULL, '2024-12-13 14:25:58', 'ch_3QVT9uRo3sAQpLlz1uUIccdX', NULL, 1, 1, 1, NULL),
(80, 80, 22.00, 18.70, 18.70, '2024-12-13 14:19:36', 'stripe', 'succeeded', '2024-12-13 19:49:31', NULL, '2024-12-13 14:27:11', 'ch_3QVT9wRo3sAQpLlz1o4NzG6P', NULL, 0, 0, 0, NULL),
(81, 81, 17.00, 14.45, 14.45, '2024-12-13 14:20:59', 'stripe', 'succeeded', '2024-12-13 19:50:41', NULL, '2024-12-13 14:29:46', 'ch_3QVTBGRo3sAQpLlz1mEZJpkR', NULL, 0, 0, 0, NULL),
(82, 82, 23.00, 23.00, 0.00, '2024-12-13 15:55:16', 'stripe', 'succeeded', '2024-12-13 21:25:08', NULL, '2024-12-13 16:00:45', 'ch_3QVUeVRo3sAQpLlz0rRNihxZ', NULL, 1, 1, 1, NULL),
(83, 83, 17.00, 14.45, 14.45, '2024-12-13 15:56:12', 'stripe', 'succeeded', '2024-12-13 21:25:54', NULL, '2024-12-13 16:02:25', 'ch_3QVUfQRo3sAQpLlz0ag7DFtt', NULL, 0, 0, 0, NULL),
(84, 84, 23.00, 23.00, 0.00, '2024-12-13 15:56:12', 'stripe', 'succeeded', '2024-12-13 21:25:54', NULL, '2024-12-13 16:10:20', 'ch_3QVUfQRo3sAQpLlz0WxLCR5A', NULL, 1, 1, 1, NULL),
(85, 85, 58.00, 58.00, 0.00, '2024-12-13 15:58:29', 'stripe', 'succeeded', '2024-12-13 21:28:23', NULL, '2024-12-13 16:10:28', 'ch_3QVUhdRo3sAQpLlz1e9jozYU', NULL, 1, 1, 1, NULL),
(86, 86, 15.00, NULL, 0.00, '2024-12-13 16:15:47', 'stripe', 'succeeded', '2024-12-13 21:45:41', NULL, '2024-12-13 16:15:47', 'ch_3QVUyNRo3sAQpLlz0B8U3lxY', NULL, 0, 0, 0, NULL),
(87, 87, 15.00, NULL, 0.00, '2024-12-13 16:15:58', 'stripe', 'succeeded', '2024-12-13 21:45:51', NULL, '2024-12-13 16:15:58', 'ch_3QVUyXRo3sAQpLlz1BevdG35', NULL, 0, 0, 0, NULL),
(88, 88, 15.00, NULL, 0.00, '2024-12-13 16:16:31', 'stripe', 'succeeded', '2024-12-13 21:46:25', NULL, '2024-12-13 16:16:31', 'ch_3QVUz4Ro3sAQpLlz0yuld98b', NULL, 0, 0, 0, NULL),
(89, 89, 47.00, 19.98, 23.50, '2024-12-13 16:18:25', 'stripe', 'succeeded', '2024-12-13 21:48:18', NULL, '2024-12-13 16:19:28', 'ch_3QVV0uRo3sAQpLlz02E3M621', NULL, 0, 0, 0, NULL),
(90, 90, 248.00, 105.40, 124.00, '2024-12-13 16:26:20', 'stripe', 'succeeded', '2024-12-13 21:55:52', NULL, '2024-12-13 16:27:26', 'ch_3QVV8ZRo3sAQpLlz1OXPponB', NULL, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

CREATE TABLE `payouts` (
  `id` int(11) NOT NULL,
  `ride_id` bigint(20) UNSIGNED DEFAULT NULL,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `amount_paid_by_admin` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_slip` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `platform_fee` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payouts`
--

INSERT INTO `payouts` (`id`, `ride_id`, `driver_id`, `amount`, `total`, `status`, `amount_paid_by_admin`, `created_at`, `updated_at`, `payment_slip`, `payment_method`, `payment_date`, `platform_fee`) VALUES
(18, 76, 383, 0.43, 1.00, 'pending', NULL, '2024-12-13 00:07:38', '2024-12-13 00:07:38', NULL, NULL, NULL, NULL),
(19, 76, 383, 0.43, 1.00, 'pending', NULL, '2024-12-13 00:08:50', '2024-12-13 00:08:50', NULL, NULL, NULL, NULL),
(20, 76, 383, 0.43, 1.00, 'pending', NULL, '2024-12-13 00:15:25', '2024-12-13 00:15:25', NULL, NULL, NULL, NULL),
(21, 77, 383, 0.43, 1.00, 'pending', NULL, '2024-12-13 00:40:20', '2024-12-13 00:40:20', NULL, NULL, NULL, NULL),
(23, 47, 310, 97.00, 112.00, 'pending', NULL, '2024-12-13 12:10:48', '2024-12-13 12:10:48', NULL, NULL, NULL, NULL),
(24, 80, 366, 5.53, 13.00, 'pending', NULL, '2024-12-13 12:25:52', '2024-12-13 12:25:52', NULL, NULL, NULL, NULL),
(25, 85, 310, 19.98, 47.00, 'pending', NULL, '2024-12-13 16:19:28', '2024-12-13 16:19:28', NULL, NULL, NULL, NULL),
(26, 84, 379, 39.00, 45.00, 'pending', NULL, '2024-12-13 16:24:55', '2024-12-13 16:24:55', NULL, NULL, NULL, NULL),
(27, 84, 379, 39.00, 45.00, 'pending', NULL, '2024-12-13 16:25:09', '2024-12-13 16:25:09', NULL, NULL, NULL, NULL),
(28, 84, 379, 39.00, 45.00, 'pending', NULL, '2024-12-13 16:25:22', '2024-12-13 16:25:22', NULL, NULL, NULL, NULL),
(29, 86, 310, 105.40, 248.00, 'pending', NULL, '2024-12-13 16:27:26', '2024-12-13 16:27:26', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(146, 'App\\Models\\User', 343, 'AuthToken', '2dd13256f52c2ecd2793baeb36883d8bce764301a4427c7cc549e3a5e4363876', '[\"*\"]', NULL, NULL, '2024-12-10 21:27:17', '2024-12-10 21:27:17'),
(149, 'App\\Models\\User', 342, 'AuthToken', 'fa9584dca8cb66d7112440b8bc25b5c119638030de1b7a2f331a5181fabba647', '[\"*\"]', NULL, NULL, '2024-12-10 21:41:33', '2024-12-10 21:41:33'),
(185, 'App\\Models\\User', 350, 'AuthToken', 'c7945764cbf2d084dc094416d679f9d561ca1bd6a980cd2e794b1cd0bc9a666f', '[\"*\"]', NULL, NULL, '2024-12-11 20:29:41', '2024-12-11 20:29:41'),
(193, 'App\\Models\\User', 353, 'AuthToken', '9de7d9fa11cbc1797513c3ff5e7f1204a855d33a7693577a75f84d8496609c4a', '[\"*\"]', NULL, NULL, '2024-12-11 23:48:12', '2024-12-11 23:48:12'),
(196, 'App\\Models\\User', 281, 'AuthToken', 'f612b647b3a00812be26e50e3ac3887df90764640cd28c7ef54410869bef7fb9', '[\"*\"]', NULL, NULL, '2024-12-12 11:21:04', '2024-12-12 11:21:04'),
(198, 'App\\Models\\User', 363, 'AuthToken', '11f6125182cda1c3a8b323e52990a5cbe9a59efd6349aca3214e48a00fccd393', '[\"*\"]', NULL, NULL, '2024-12-12 11:30:52', '2024-12-12 11:30:52'),
(199, 'App\\Models\\User', 345, 'AuthToken', '0c02bfc9473359876f15a6cd6fb6c55d849185b75fcad17451daf61071ce6a6f', '[\"*\"]', NULL, NULL, '2024-12-12 11:30:54', '2024-12-12 11:30:54'),
(200, 'App\\Models\\User', 363, 'AuthToken', '975bcb6431cac2bd4d6c60a7e8b8e5fac5564b64be1c7ea405889fc50170d4c6', '[\"*\"]', NULL, NULL, '2024-12-12 11:31:04', '2024-12-12 11:31:04'),
(201, 'App\\Models\\User', 363, 'AuthToken', '6c12d6fff2697e8c5ccd8c9a9bee4b70940a6b09db9f010af122e48c7696945c', '[\"*\"]', NULL, NULL, '2024-12-12 11:31:11', '2024-12-12 11:31:11'),
(202, 'App\\Models\\User', 363, 'AuthToken', '76de15ea77474df2264bc9e93d49688713a0d11d4189d306e4b9cc39be57cf9a', '[\"*\"]', NULL, NULL, '2024-12-12 11:31:52', '2024-12-12 11:31:52'),
(215, 'App\\Models\\User', 308, 'AuthToken', '27be5829b4dea1afce21dba85cce32ea4fbd97f592d27be0cc9e0e75d664e01d', '[\"*\"]', NULL, NULL, '2024-12-12 13:17:54', '2024-12-12 13:17:54'),
(216, 'App\\Models\\User', 308, 'AuthToken', '80ed10d9ff9e3af65ef1ec4fe4bca41b531b24262f48403d95cb9000d8a46fad', '[\"*\"]', NULL, NULL, '2024-12-12 13:18:10', '2024-12-12 13:18:10'),
(233, 'App\\Models\\User', 381, 'AuthToken', '017135e4d1eb24bd5b8135f3cbc5ae50656ea07e57753a63b5c5dbaa8f29c9ef', '[\"*\"]', NULL, NULL, '2024-12-12 18:20:49', '2024-12-12 18:20:49'),
(234, 'App\\Models\\User', 381, 'AuthToken', 'b86c823339d074657c4524c7b025f435b893f4d1436539584548e696267938e4', '[\"*\"]', NULL, NULL, '2024-12-12 18:20:59', '2024-12-12 18:20:59'),
(235, 'App\\Models\\User', 381, 'AuthToken', '9e5928b5196483c27756ba38f62fcd2f168dc462e7bc2104db8f12a8fb421a0a', '[\"*\"]', NULL, NULL, '2024-12-12 18:21:01', '2024-12-12 18:21:01'),
(236, 'App\\Models\\User', 381, 'AuthToken', '8b9fbe9a2d7a49070007c48b35ee007396cb4cbbe3379e7d41c64be12b2340c9', '[\"*\"]', NULL, NULL, '2024-12-12 18:21:04', '2024-12-12 18:21:04'),
(237, 'App\\Models\\User', 381, 'AuthToken', '6b8678e72b32afe92de70de9a10907b78df11771f0870da99688b1351106bd6e', '[\"*\"]', NULL, NULL, '2024-12-12 18:21:10', '2024-12-12 18:21:10'),
(238, 'App\\Models\\User', 381, 'AuthToken', 'c5c3fff8f4ea0dcfc3c802324e67d62d1006ffeab70116df3e89f776cc34c66d', '[\"*\"]', NULL, NULL, '2024-12-12 18:21:13', '2024-12-12 18:21:13'),
(239, 'App\\Models\\User', 382, 'AuthToken', 'bfa468b0ce80110ba6bf470c86545b51374ae2f2289048ca1df4d4bb0c286f1c', '[\"*\"]', NULL, NULL, '2024-12-12 18:21:54', '2024-12-12 18:21:54'),
(240, 'App\\Models\\User', 382, 'AuthToken', '498111c29228f6136d65e3d49ef297f96a316b7c2510a896e1069a61e8398d8a', '[\"*\"]', NULL, NULL, '2024-12-12 18:21:57', '2024-12-12 18:21:57'),
(260, 'App\\Models\\User', 341, 'AuthToken', '9a520338b4466f787e266331371b26041630b70bfcab1a63a50f2ae3c0134f0e', '[\"*\"]', NULL, NULL, '2024-12-12 19:46:04', '2024-12-12 19:46:04'),
(262, 'App\\Models\\User', 383, 'AuthToken', '420b1af7b425253b78490f3f8181cadf89711c842b113a1124918acb77f914bc', '[\"*\"]', NULL, NULL, '2024-12-12 20:57:10', '2024-12-12 20:57:10'),
(267, 'App\\Models\\User', 341, 'AuthToken', 'ba3f0a07831658bc89da11ecc41b191e3ff711e164b5d64da6575d376105ec06', '[\"*\"]', NULL, NULL, '2024-12-13 05:23:00', '2024-12-13 05:23:00'),
(268, 'App\\Models\\User', 385, 'AuthToken', '762c9c10e97b21ec2f53a2f7ecccacb98ab01125f1b3db3b199dd217fa2bdfc6', '[\"*\"]', NULL, NULL, '2024-12-13 05:25:59', '2024-12-13 05:25:59'),
(284, 'App\\Models\\User', 377, 'AuthToken', '47fe3e2fd8c93323370766c3f6968c292e3be5ae0a81d96a69e1e3a4e084bff8', '[\"*\"]', NULL, NULL, '2024-12-13 14:19:43', '2024-12-13 14:19:43'),
(290, 'App\\Models\\User', 309, 'AuthToken', 'd136e1d5faeb6d492647f23c53f0155c61d05f5264dda830b1eac6240316b466', '[\"*\"]', NULL, NULL, '2024-12-13 16:03:48', '2024-12-13 16:03:48'),
(295, 'App\\Models\\User', 380, 'AuthToken', '00a64cab06b1ace93a16f60b5e1466c4303ebb883e402d0c0b7d41522deb42a2', '[\"*\"]', NULL, NULL, '2024-12-13 16:35:45', '2024-12-13 16:35:45'),
(296, 'App\\Models\\User', 310, 'AuthToken', '2a43c3ef86bd4abd4dfb99be19767087c60df05c7aa5e29aab83edc84bc10b00', '[\"*\"]', NULL, NULL, '2024-12-13 16:36:15', '2024-12-13 16:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE `policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `policies`
--

INSERT INTO `policies` (`id`, `type`, `content`, `created_at`, `updated_at`) VALUES
(1, 'terms', 'Initial terms and conditions content.', '2024-07-24 04:13:31', '2024-07-24 04:13:31'),
(2, 'privacy', 'Initial privacy policy content.', '2024-07-24 04:13:31', '2024-07-24 04:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(255) NOT NULL,
  `provider_id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refund_payments`
--

CREATE TABLE `refund_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `refunded_amount` decimal(10,2) DEFAULT NULL,
  `refunded_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `refund_payments`
--

INSERT INTO `refund_payments` (`id`, `payment_id`, `refunded_amount`, `refunded_id`, `status`, `created_at`, `updated_at`, `payment_method`, `payment_date`) VALUES
(1, '2', 97.00, 're_3QSZVIRo3sAQpLlz05SUrxXt', 'refunded', '2024-12-05 14:30:58', '2024-12-05 14:30:58', NULL, NULL),
(3, '1', 43.00, 're_3QSZDtRo3sAQpLlz1QUEntyp', 'refunded', '2024-12-05 15:33:32', '2024-12-05 15:33:32', NULL, NULL),
(4, '3', 17.00, 're_3QSclCRo3sAQpLlz1Hlmi8rP', 'refunded', '2024-12-05 18:13:49', '2024-12-05 18:13:49', NULL, NULL),
(5, '4', 135.00, 're_3QSe7SRo3sAQpLlz0uPrjUxw', 'refunded', '2024-12-05 19:24:18', '2024-12-12 18:11:16', NULL, NULL),
(6, '18', 35.00, 're_3QT0KPRo3sAQpLlz0AS7Np8u', 'refunded', '2024-12-06 19:17:04', '2024-12-06 19:17:04', NULL, NULL),
(7, '16', 69.00, 're_3QT05BRo3sAQpLlz0BFmdI0I', 'refunded', '2024-12-06 19:17:42', '2024-12-06 19:17:42', NULL, NULL),
(9, '19', 52.00, 're_3QT0VtRo3sAQpLlz1AHFXOGY', 'refunded', '2024-12-06 19:33:14', '2024-12-06 19:33:14', NULL, NULL),
(10, '20', 17.00, 're_3QT0XiRo3sAQpLlz1nqMKB3C', 'refunded', '2024-12-06 19:33:21', '2024-12-06 19:33:21', NULL, NULL),
(11, '21', 69.00, 're_3QT0lrRo3sAQpLlz12B2H63c', 'refunded', '2024-12-06 19:50:04', '2024-12-06 19:50:04', NULL, NULL),
(12, '22', 23.00, 're_3QT0nXRo3sAQpLlz0z4faJYD', 'refunded', '2024-12-06 19:50:11', '2024-12-06 19:50:11', NULL, NULL),
(13, '25', 1.00, '0T359516X65017505', 'refunded', '2024-12-07 22:07:43', '2024-12-07 22:07:43', NULL, NULL),
(14, '27', 1.00, '14X90195G78217826', 'refunded', '2024-12-08 17:29:49', '2024-12-08 17:29:49', NULL, NULL),
(16, '32', 112.00, 're_3QU4bgRo3sAQpLlz0XrpwtbK', 'refunded', '2024-12-09 18:01:00', '2024-12-09 18:01:00', NULL, NULL),
(20, '33', 112.00, 're_3QU4qsRo3sAQpLlz0yNubNc3', 'refunded', '2024-12-09 18:12:12', '2024-12-09 18:12:12', NULL, NULL),
(21, '36', 12.00, 're_3QU66YRo3sAQpLlz1ZfeWRbj', 'refunded', '2024-12-09 19:31:20', '2024-12-09 19:31:20', NULL, NULL),
(22, '37', 23.00, 're_3QU6ACRo3sAQpLlz0bnN5OlC', 'refunded', '2024-12-09 19:34:45', '2024-12-09 19:34:45', NULL, NULL),
(25, '31', 1.00, NULL, 'refunded', '2024-12-10 16:09:25', '2024-12-10 16:09:25', 'paypal', '2024-12-12'),
(26, '39', 0.00, NULL, 'refund_failed', '2024-12-11 15:44:41', '2024-12-11 15:44:41', NULL, NULL),
(27, '38', 82.00, NULL, 'refunded', '2024-12-11 17:57:20', '2024-12-11 17:57:20', 'bank_transfer', '2024-12-26'),
(28, '51', 7.00, 're_3QV4m2Ro3sAQpLlz0fg1eAas', 'refunded', '2024-12-12 12:46:39', '2024-12-12 12:46:39', NULL, NULL),
(29, '52', 14.00, 're_3QV5BqRo3sAQpLlz15xJobhs', 'refunded', '2024-12-12 12:46:47', '2024-12-12 12:46:47', NULL, NULL),
(30, '60', 52.00, 're_3QVA7dRo3sAQpLlz0CpYbb8e', 'refunded', '2024-12-12 18:02:04', '2024-12-12 18:02:04', NULL, NULL),
(31, '59', 23.00, 're_3QVA7bRo3sAQpLlz0wgCWrG5', 'refunded', '2024-12-12 18:02:05', '2024-12-12 18:02:05', NULL, NULL),
(32, '49', 8.00, 're_3QV42YRo3sAQpLlz04aW2375', 'refunded', '2024-12-12 18:10:50', '2024-12-12 18:10:50', NULL, NULL),
(33, '62', 15.00, 're_3QVAuMRo3sAQpLlz1hj7IBzT', 'refunded', '2024-12-12 18:54:22', '2024-12-12 18:54:22', NULL, NULL),
(34, '63', 45.00, 're_3QVAvxRo3sAQpLlz1OdzZveF', 'refunded', '2024-12-12 18:54:30', '2024-12-12 18:54:30', NULL, NULL),
(35, '64', 46.00, 're_3QVBleRo3sAQpLlz1g3fHGx3', 'refunded', '2024-12-12 19:47:01', '2024-12-12 19:47:01', NULL, NULL),
(36, '65', 92.00, 're_3QVBdMRo3sAQpLlz1XnfdsTz', 'refunded', '2024-12-12 19:47:16', '2024-12-12 19:47:16', NULL, NULL),
(37, '67', 1.00, 're_3QVEEXRo3sAQpLlz1TrOuGKV', 'refunded', '2024-12-12 22:29:14', '2024-12-12 22:29:14', NULL, NULL),
(38, '69', 1.00, 're_3QVFoWRo3sAQpLlz19XddjSj', 'refunded', '2024-12-13 00:26:38', '2024-12-13 00:26:38', NULL, NULL),
(39, '71', 23.00, 're_3QVQmGRo3sAQpLlz0RPCEiNP', 'refunded', '2024-12-13 11:50:19', '2024-12-13 11:50:19', NULL, NULL),
(40, '73', 13.00, 're_3QVRLuRo3sAQpLlz1ajHWrqN', 'refunded', '2024-12-13 12:34:24', '2024-12-13 12:34:24', NULL, NULL),
(41, '74', 48.00, 're_3QVRkyRo3sAQpLlz02CjhTDK', 'refunded', '2024-12-13 12:59:51', '2024-12-13 12:59:51', NULL, NULL),
(42, '76', 9.00, 're_3QVRqZRo3sAQpLlz0TfpHql2', 'refunded', '2024-12-13 13:00:43', '2024-12-13 13:00:43', NULL, NULL),
(43, '79', 29.00, 're_3QVT9uRo3sAQpLlz1IU4t8Lr', 'refunded', '2024-12-13 14:25:58', '2024-12-13 14:25:58', NULL, NULL),
(44, '78', 9.00, 're_3QVT8uRo3sAQpLlz1szmpZAk', 'refunded', '2024-12-13 14:31:46', '2024-12-13 14:31:46', NULL, NULL),
(45, '82', 23.00, 're_3QVUeVRo3sAQpLlz0h2DVDSd', 'refunded', '2024-12-13 16:00:45', '2024-12-13 16:00:45', NULL, NULL),
(46, '84', 23.00, 're_3QVUfQRo3sAQpLlz0Xvxu87f', 'refunded', '2024-12-13 16:10:20', '2024-12-13 16:10:20', NULL, NULL),
(47, '85', 58.00, 're_3QVUhdRo3sAQpLlz1WDPP3pI', 'refunded', '2024-12-13 16:10:28', '2024-12-13 16:10:28', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Fraudulent activity', '2024-09-30 17:49:49', NULL),
(2, 'Dangerous or inappropriate behaviour', '2024-09-30 17:49:49', NULL),
(3, 'Problem on the profile', '2024-09-30 17:49:49', NULL),
(4, 'Price or payment method questionable', '2024-09-30 17:49:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` bigint(20) UNSIGNED NOT NULL,
  `ride_id` bigint(20) UNSIGNED NOT NULL,
  `reviewer_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `rating` double DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `review_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rides`
--

CREATE TABLE `rides` (
  `ride_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED DEFAULT NULL,
  `departure_city` text DEFAULT NULL,
  `departure_lat` varchar(100) DEFAULT NULL,
  `departure_long` varchar(100) DEFAULT NULL,
  `arrival_city` text DEFAULT NULL,
  `arrival_lat` varchar(100) DEFAULT NULL,
  `arrival_long` varchar(100) DEFAULT NULL,
  `departure_time` timestamp NULL DEFAULT NULL,
  `arrival_time` timestamp NULL DEFAULT NULL,
  `price_per_seat` decimal(8,2) DEFAULT NULL,
  `destination_to_stopover1_price` decimal(8,2) DEFAULT NULL,
  `destination_to_stopover2_price` decimal(8,2) DEFAULT NULL,
  `stopover1_to_stopover2_price` decimal(8,2) DEFAULT NULL,
  `stopover2_to_arrival_price` decimal(8,2) DEFAULT NULL,
  `stopover1_to_arrival_price` decimal(8,2) DEFAULT NULL,
  `available_seats` int(11) DEFAULT NULL,
  `luggage_size` varchar(50) DEFAULT NULL,
  `smoking_allowed` varchar(255) DEFAULT NULL,
  `pets_allowed` varchar(255) DEFAULT NULL,
  `music_preference` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `seat_booked` int(11) DEFAULT 0,
  `status` int(11) DEFAULT 0 COMMENT '1-active, 2-completed, 3-cancelled',
  `max_two_back` tinyint(1) NOT NULL DEFAULT 0,
  `women_only` tinyint(1) NOT NULL DEFAULT 0,
  `stopovers` varchar(255) DEFAULT '[]',
  `stopover1` varchar(255) DEFAULT NULL,
  `stopover1_lat` varchar(255) DEFAULT NULL,
  `stopover1_long` varchar(255) DEFAULT NULL,
  `stopover2` varchar(255) DEFAULT NULL,
  `stopover2_lat` varchar(255) DEFAULT NULL,
  `stopover2_long` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rides`
--

INSERT INTO `rides` (`ride_id`, `driver_id`, `car_id`, `departure_city`, `departure_lat`, `departure_long`, `arrival_city`, `arrival_lat`, `arrival_long`, `departure_time`, `arrival_time`, `price_per_seat`, `destination_to_stopover1_price`, `destination_to_stopover2_price`, `stopover1_to_stopover2_price`, `stopover2_to_arrival_price`, `stopover1_to_arrival_price`, `available_seats`, `luggage_size`, `smoking_allowed`, `pets_allowed`, `music_preference`, `description`, `created_at`, `updated_at`, `seat_booked`, `status`, `max_two_back`, `women_only`, `stopovers`, `stopover1`, `stopover1_lat`, `stopover1_long`, `stopover2`, `stopover2_lat`, `stopover2_long`, `type`) VALUES
(1, 310, NULL, 'Adelaide Airport, Netley, SA', '-34.95', '138.53', 'Brisbane Airport, Brisbane Airport, QLD', '-27.39', '153.12', '2024-12-06 18:39:00', '2024-12-08 11:09:00', 99.00, NULL, NULL, NULL, NULL, NULL, 3, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-05 13:13:59', '2024-12-05 13:16:10', 0, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(2, 309, NULL, 'Sydney Opera House, Sydney, NSW', '-33.86', '151.22', 'Melbourne Airport, Melbourne Airport, VIC', '-37.67', '144.84', '2024-12-06 18:48:00', '2024-12-07 12:39:00', 43.00, NULL, NULL, NULL, NULL, NULL, 2, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-05 13:19:04', '2024-12-05 13:28:58', 0, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(3, 310, NULL, 'Melbourne Airport, Melbourne Airport, VIC', '-37.67', '144.84', 'Adelaide Airport, Netley, SA', '-34.95', '138.53', '2024-12-06 19:09:00', '2024-12-07 11:10:00', 39.00, NULL, NULL, NULL, NULL, NULL, 3, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-05 13:39:42', '2024-12-05 13:51:20', 0, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(4, 310, NULL, 'Bennelong Point, Sydney NSW 2000, Australia', '-33.86', '151.22', 'Melbourne Airport, Melbourne Airport, VIC', '-37.67', '144.84', '2024-12-06 19:30:00', '2024-12-07 13:21:00', 43.00, NULL, NULL, NULL, NULL, NULL, 3, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-05 14:01:07', '2024-12-12 10:46:50', -3, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(5, 309, NULL, 'Adelaide Airport, Netley, SA', '-34.95', '138.53', 'Brisbane Airport, Brisbane Airport, QLD', '-27.39', '153.12', '2024-12-06 19:51:00', '2024-12-08 12:21:00', 97.00, NULL, NULL, NULL, NULL, NULL, 4, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-05 14:21:35', '2024-12-05 14:32:07', 0, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(6, 309, NULL, '129-135 Oleander St, Holloways Beach QLD 4878, Australia', '-16.84', '145.74', 'Adelaide Airport, Netley, SA', '-34.95', '138.53', '2024-12-06 21:07:00', '2024-12-09 02:32:00', 130.00, NULL, NULL, NULL, NULL, NULL, 4, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-05 15:37:27', '2024-12-05 15:37:46', 0, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(7, 309, NULL, 'Sir Richard Williams Ave, Adelaide Airport SA 5950, Australia', '-34.95', '138.53', 'Brisbane Airport, Brisbane Airport, QLD', '-27.39', '153.12', '2024-12-07 21:16:00', '2024-12-09 13:46:00', 97.00, 63.00, NULL, NULL, NULL, 67.00, 4, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-05 15:46:48', '2024-12-09 06:00:03', 0, 2, 1, 1, '[]', 'Albury Airport', '-36.0694684', '146.9546249', NULL, NULL, NULL, 'secure'),
(8, 309, NULL, 'Sir Richard Williams Ave, Adelaide Airport SA 5950, Australia', '-34.95', '138.53', '133 Oleander St, Holloways Beach, QLD', '-16.84', '145.74', '2024-12-06 21:21:00', '2024-12-09 02:46:00', 128.00, NULL, NULL, NULL, NULL, NULL, 3, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-05 15:51:45', '2024-12-09 06:00:03', 0, 2, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(9, 309, NULL, 'Melbourne Airport, Melbourne Airport, VIC', '-37.67', '144.84', 'Adelaide Airport, Netley, SA', '-34.95', '138.53', '2024-12-06 21:36:00', '2024-12-07 13:37:00', 40.00, NULL, NULL, NULL, NULL, NULL, 3, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-05 16:06:55', '2024-12-08 06:00:13', 0, 2, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(10, 310, NULL, 'Cairns Airport, Aeroglen, QLD', '-16.88', '145.75', 'Brisbane Airport, Brisbane Airport, QLD', '-27.39', '153.12', '2024-12-07 21:46:00', '2024-12-09 08:34:00', 84.00, 147.00, NULL, NULL, NULL, NULL, 4, '10 kg', NULL, NULL, NULL, NULL, '2024-12-05 16:16:56', '2024-12-05 20:08:41', 0, 3, 1, 1, '[]', 'Albury', '-36.0737293', '146.9135418', NULL, NULL, NULL, 'secure'),
(11, 310, NULL, '110-140 King St, Sydney NSW 2000', '-33.8688222', '151.20931', '210 Elizabeth St, Melbourne VIC 3000', '-37.8136186', '144.963086', '2024-12-06 15:30:00', '2024-12-07 09:20:00', 52.00, 28.00, NULL, NULL, NULL, 25.00, 4, 'null', NULL, NULL, NULL, NULL, '2024-12-05 16:21:01', '2024-12-05 18:14:00', 0, 3, 0, 0, '[]', 'Albury', '-36.0737293', '146.9135418', NULL, NULL, NULL, 'secure'),
(12, 309, NULL, 'Adelaide Airport, Netley, SA', '-34.95', '138.53', 'Brisbane Airport, Brisbane Airport, QLD', '-27.39', '153.12', '2024-12-06 22:10:00', '2024-12-08 14:40:00', 98.00, NULL, NULL, NULL, NULL, NULL, 3, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-05 16:40:22', '2024-12-08 06:00:13', 0, 2, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'instant'),
(13, 309, NULL, 'Bennelong Point, Sydney NSW 2000, Australia', '-33.86', '151.22', 'Melbourne Airport, Melbourne Airport, VIC', '-37.67', '144.84', '2024-12-06 22:59:00', '2024-12-07 16:50:00', 50.00, 44.00, NULL, NULL, NULL, 0.00, 3, '10 kg', NULL, NULL, NULL, NULL, '2024-12-05 17:29:33', '2024-12-08 06:00:13', 0, 2, 1, 1, '[]', 'Albury Airport', '-36.07', '146.95', NULL, NULL, NULL, 'secure'),
(14, 309, NULL, 'Adelaide Airport (ADL), Sir Richard Williams Ave, Adelaide Airport SA 5950', '-34.946237', '138.5312017', 'Brisbane Airport (BNE), Airport Dr, Brisbane Airport QLD 4008', '-27.3946264', '153.1236707', '2024-12-09 15:30:00', '2024-12-11 07:59:00', 117.00, 25.00, NULL, NULL, NULL, 79.00, 2, 'null', NULL, NULL, NULL, 'test ride', '2024-12-05 19:14:37', '2024-12-11 06:00:04', 1, 2, 0, 0, '[]', 'Broken Hill', '-31.9595859', '141.4608138', NULL, NULL, NULL, 'secure'),
(15, 310, 2, 'Sydney Opera House, Sydney, NSW', '-33.86', '151.22', 'Melbourne Airport, Melbourne Airport, VIC', '-37.67', '144.84', '2024-12-07 02:35:00', '2024-12-07 20:26:00', 43.00, NULL, NULL, NULL, NULL, NULL, 1, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-05 21:06:04', '2024-12-06 11:24:19', 0, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(16, 309, NULL, 'Melbourne Airport, Melbourne Airport, VIC', '-37.67', '144.84', 'Sydney Opera House, Sydney, NSW', '-33.86', '151.22', '2024-12-07 02:45:00', '2024-12-07 20:36:00', 43.00, NULL, NULL, NULL, NULL, NULL, 1, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-05 21:15:36', '2024-12-08 06:00:13', 0, 2, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(21, 310, 2, 'Brisbane Airport, Brisbane Airport, QLD', '-27.39', '153.12', 'Adelaide Airport, Netley, SA', '-34.95', '138.53', '2024-12-15 18:05:00', '2024-12-17 10:35:00', 97.00, 57.00, NULL, NULL, NULL, 44.00, 3, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-06 12:35:34', '2024-12-09 18:04:35', 0, 3, 1, 1, '[]', 'Naradhan Public School', '-33.62', '146.33', NULL, NULL, NULL, 'secure'),
(22, 310, 2, 'Naradhan Public School, Naradhan, NSW', '-33.62', '146.33', '11 Mid Western Hwy, Rankins Springs, NSW', '-33.84', '146.26', '2024-12-07 18:07:00', '2024-12-07 18:44:00', 5.00, NULL, NULL, NULL, NULL, NULL, 4, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-06 12:37:30', '2024-12-08 06:00:13', 0, 2, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(23, 337, NULL, '210 Elizabeth St, Melbourne VIC 3000', '-37.8136186', '144.963086', 'Hyde Park North, Sydney NSW 2000', '-33.8705507', '151.2106193', '2024-12-07 15:30:00', '2024-12-08 09:20:00', 50.00, 20.00, 30.00, 15.00, 20.00, 31.00, 4, 'null', NULL, NULL, NULL, 'this is my first ride. \nI am new to this platform', '2024-12-06 16:12:41', '2024-12-08 06:00:13', 0, 2, 1, 0, '[]', 'Albury', '-36.0737293', '146.9135418', 'Canberra', '-35.2801846', '149.1310324', 'secure'),
(29, 335, 3, 'Bennelong Point, Sydney NSW 2000, Australia', '-33.86', '151.22', 'Melbourne Airport, Melbourne Airport, VIC', '-37.67', '144.84', '2024-12-09 04:23:00', '2024-12-09 22:14:00', 50.00, 20.00, 30.00, 15.00, 20.00, 30.00, 3, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-06 18:47:40', '2024-12-06 19:18:01', 3, 3, 1, 1, '[]', 'Canberra Airport', '-35.31', '149.19', 'Albury Airport', '-36.07', '146.95', 'secure'),
(30, 335, 3, 'Sydney Opera House, Sydney, NSW', '-33.86', '151.22', 'Melbourne Airport, Melbourne Airport, VIC', '-37.67', '144.84', '2024-12-09 00:48:00', '2024-12-09 18:39:00', 48.00, 15.00, 28.00, 13.00, 16.00, 28.00, 3, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-06 19:19:20', '2024-12-06 19:33:33', 0, 3, 1, 1, '[]', 'Canberra Airport', '-35.31', '149.19', 'Albury Airport', '-36.07', '146.95', 'secure'),
(31, 335, 3, '121 Airport Dr, East Albury NSW 2640, Australia', '-36.07', '146.95', 'Canberra Airport, Canberra Airport, ACT', '-35.31', '149.19', '2024-12-09 01:04:00', '2024-12-09 06:32:00', 20.00, NULL, NULL, NULL, NULL, NULL, 4, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-06 19:34:20', '2024-12-06 19:50:19', 0, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(32, 335, 3, 'Canberra Airport, Canberra Airport, ACT', '-35.31', '149.19', 'Albury Airport, East Albury, NSW', '-36.07', '146.95', '2024-12-09 05:26:00', '2024-12-09 10:54:00', 15.00, NULL, NULL, NULL, NULL, NULL, 4, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-06 19:51:20', '2024-12-09 06:00:03', 1, 2, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(35, 341, NULL, '73-77 Yarra St, Geelong VIC 3220', '-38.1496998', '144.3627453', '136 Noga Ave, Keilor East VIC 3033', '-37.7397184', '144.865451', '2024-12-22 15:30:00', '2024-12-22 17:05:00', 1.00, 1.00, NULL, NULL, NULL, 1.00, 4, NULL, '0', '0', NULL, 'Tsating on Andriod.\n- Publish ridé\n- Book and pay for ridé', '2024-12-08 02:06:02', '2024-12-08 02:06:02', 0, 0, 0, 0, '[]', 'Werribee', '-37.89971970000001', '144.6642029', NULL, NULL, NULL, 'secure'),
(39, 310, 2, 'Airport Dr, Brisbane Airport QLD 4008, Australia', '-27.39', '153.12', 'Adelaide Airport, Netley, SA', '-34.95', '138.53', '2024-12-10 23:39:00', '2024-12-12 16:09:00', 97.00, NULL, NULL, NULL, NULL, NULL, 2, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-09 18:09:22', '2024-12-12 06:00:03', 0, 2, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(40, 309, NULL, 'Melbourne Airport (MEL), Arrival Dr, Melbourne Airport VIC 3045', '-37.6699188', '144.8403449', 'Sydney Airport (SYD), Mascot NSW 2020', '-33.9500314', '151.1816944', '2024-12-17 15:30:00', '2024-12-18 09:08:00', 42.00, NULL, NULL, NULL, NULL, NULL, 2, NULL, '0', '0', NULL, NULL, '2024-12-09 18:14:58', '2024-12-09 18:20:34', 0, 3, 0, 0, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(41, 339, NULL, 'By appointment only, Albury NSW 2640', '-36.0737293', '146.9135418', '3 Petrie Plaza, Canberra ACT 2601', '-35.2801347', '149.1311399', '2024-12-10 15:30:00', '2024-12-10 20:58:00', 15.00, NULL, NULL, NULL, NULL, NULL, 4, NULL, '0', '0', NULL, NULL, '2024-12-09 19:09:05', '2024-12-09 19:21:41', 0, 3, 0, 0, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(42, 339, NULL, 'By appointment only, Albury NSW 2640', '-36.0737293', '146.9135418', '3 Petrie Plaza, Canberra ACT 2601', '-35.2801347', '149.1311399', '2024-12-10 13:30:00', '2024-12-10 18:58:00', 13.00, NULL, NULL, NULL, NULL, NULL, 1, NULL, '0', '0', NULL, NULL, '2024-12-09 19:26:19', '2024-12-09 19:26:52', 0, 3, 0, 0, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(43, 339, NULL, 'P49H+6F Canberra ACT', '-35.2818948', '149.1286507', 'By appointment only, Albury NSW 2640', '-36.0737293', '146.9135418', '2024-12-10 13:59:00', '2024-12-10 19:26:00', 10.00, NULL, NULL, NULL, NULL, NULL, 2, NULL, '0', '0', NULL, NULL, '2024-12-09 19:29:40', '2024-12-09 19:31:26', 0, 3, 0, 0, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(44, 310, 2, 'Melbourne Airport, Melbourne Airport, VIC', '-37.67', '144.84', 'Albury Airport, East Albury, NSW', '-36.07', '146.95', '2024-12-11 01:02:00', '2024-12-11 07:29:00', 20.00, NULL, NULL, NULL, NULL, NULL, 2, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-09 19:33:13', '2024-12-09 19:34:53', 0, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(45, 309, NULL, '3 Roe St, Perth WA 6000', '-31.9513357', '115.861407', '167 Albert St, Brisbane City QLD 4000', '-27.4705069', '153.0260841', '2024-12-10 15:30:00', '2024-12-14 09:39:00', 216.00, NULL, NULL, NULL, NULL, NULL, 2, NULL, '0', '0', NULL, NULL, '2024-12-09 20:05:37', '2024-12-09 20:05:54', 0, 3, 0, 0, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(46, 309, NULL, '121 Airport Dr, East Albury NSW 2640, Australia', '-36.07', '146.95', 'Canberra Airport, Canberra Airport, ACT', '-35.31', '149.19', '2024-12-12 22:02:00', '2024-12-13 03:30:00', 13.00, NULL, NULL, NULL, NULL, NULL, 1, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-10 16:32:21', '2024-12-10 19:11:47', 0, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(47, 310, 2, 'Adelaide Airport, Netley, SA', '-34.95', '138.53', 'Brisbane Airport, Brisbane Airport, QLD', '-27.39', '153.12', '2024-12-12 00:25:00', '2024-12-13 16:55:00', 97.00, NULL, NULL, NULL, NULL, NULL, 3, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-10 18:55:52', '2024-12-13 12:10:48', -9, 2, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'instant'),
(49, 309, NULL, '121 Airport Dr, East Albury NSW 2640, Australia', '-36.07', '146.95', 'Canberra Airport, Canberra Airport, ACT', '-35.31', '149.19', '2024-12-12 02:13:00', '2024-12-12 07:41:00', 13.00, NULL, NULL, NULL, NULL, NULL, 2, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-10 20:43:35', '2024-12-12 06:00:03', 0, 2, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'instant'),
(52, 310, 2, 'Albury NSW, Australia', '-36.07', '146.91', 'Canberra ACT, Australia', '-35.28', '149.13', '2024-12-15 01:36:00', '2024-12-15 07:04:00', 13.00, NULL, NULL, NULL, NULL, NULL, 1, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-11 20:06:43', '2024-12-11 20:14:24', 0, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(54, 310, 2, '14 Tolmer Tce, Keith, SA', '-36.10', '140.35', 'Commercial East St, Kaniva, VIC', '-36.38', '141.24', '2024-12-13 16:47:00', '2024-12-13 18:55:00', 7.00, NULL, NULL, NULL, NULL, NULL, 2, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-12 11:17:53', '2024-12-13 12:09:54', -1, 2, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(55, 370, NULL, 'Sydney', '-33.8688197', '151.2092955', 'Melbourne', '-37.8136276', '144.9630576', '2024-12-12 15:30:00', '2024-12-12 09:20:00', 43.00, NULL, NULL, NULL, NULL, NULL, 4, NULL, '0', '0', NULL, NULL, '2024-12-12 11:52:25', '2024-12-12 17:37:20', 1, 2, 0, 0, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(56, 366, NULL, 'Keith SA 5267, Australia', '-36.10', '140.35', 'Commercial East St, Kaniva, VIC', '-36.38', '141.24', '2024-12-14 17:29:00', '2024-12-14 19:37:00', 6.00, NULL, NULL, NULL, NULL, NULL, 4, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-12 11:59:49', '2024-12-12 12:46:54', 2, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(57, 310, 2, '14 Tolmer Tce, Keith, SA', '-36.10', '140.35', 'Commercial East St, Kaniva, VIC', '-36.38', '141.24', '2024-12-13 00:01:00', '2024-12-13 02:09:00', 4.00, NULL, NULL, NULL, NULL, NULL, 3, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-12 13:32:07', '2024-12-12 17:27:41', -2, 2, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(65, 366, NULL, 'Commercial East St, Kaniva, VIC', '-36.38', '141.24', '14 Tolmer Tce, Keith, SA', '-36.10', '140.35', '2024-12-12 22:15:00', '2024-12-13 00:23:00', 6.00, NULL, NULL, NULL, NULL, NULL, 4, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-12 15:47:22', '2024-12-12 17:27:41', 0, 2, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'instant'),
(67, 366, NULL, '14 Tolmer Tce, Keith, SA', '-36.10', '140.35', 'Commercial East St, Kaniva, VIC', '-36.38', '141.24', '2024-12-13 00:22:00', '2024-12-13 01:30:00', 5.00, NULL, NULL, NULL, NULL, NULL, 3, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-12 15:52:32', '2024-12-12 17:27:41', -6, 2, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'instant'),
(68, 377, NULL, 'Carnegie Mellon University - Australia, Adelaide, SA', '-34.93', '138.60', 'Commercial East St, Kaniva, VIC', '-36.38', '141.24', '2024-12-13 22:28:00', '2024-12-14 05:39:00', 18.00, NULL, NULL, NULL, NULL, NULL, 4, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-12 16:58:53', '2024-12-12 17:17:24', -5, 0, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(69, 377, NULL, 'Sir Richard Williams Avenue, Netley, SA', '-34.94', '138.54', 'Commercial East St, Kaniva, VIC', '-36.38', '141.24', '2024-12-22 22:29:00', '2024-12-23 05:46:00', 18.00, NULL, NULL, NULL, NULL, NULL, 4, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-12 16:59:49', '2024-12-12 17:09:36', 0, 1, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'instant'),
(70, 379, NULL, '210 Elizabeth St, Melbourne VIC 3000', '-37.8136186', '144.963086', '110-140 King St, Sydney NSW 2000', '-33.8688222', '151.20931', '2024-12-14 16:30:00', '2024-12-15 10:20:00', 45.00, NULL, NULL, NULL, NULL, NULL, 3, NULL, '0', '0', NULL, NULL, '2024-12-12 17:10:20', '2024-12-12 18:02:12', 1, 3, 0, 0, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(71, 380, NULL, 'Albury NSW, Australia', '-36.07', '146.91', '161 London Cct, City, ACT', '-35.28', '149.13', '2024-12-16 01:00:00', '2024-12-16 06:28:00', 20.00, NULL, NULL, NULL, NULL, NULL, 3, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-12 17:11:44', '2024-12-12 18:02:19', 1, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(72, 366, NULL, '160 Albert St, Brisbane, QLD', '-27.47', '153.03', 'Sheridan St, Cairns City, QLD', '-16.92', '145.77', '2024-12-13 08:00:00', '2024-12-14 18:45:00', 84.00, NULL, NULL, NULL, NULL, NULL, 4, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-12 17:21:39', '2024-12-12 17:24:44', 0, 1, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'instant'),
(73, 380, NULL, 'Albury NSW, Australia', '-36.07', '146.91', '161 London Cct, City, ACT', '-35.28', '149.13', '2024-12-16 00:19:00', '2024-12-16 05:47:00', 13.00, NULL, NULL, NULL, NULL, NULL, 4, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-12 18:49:57', '2024-12-12 18:54:38', 4, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(74, 380, NULL, 'Adelaide SA, Australia', '-34.93', '138.60', 'Melbourne VIC, Australia', '-37.81', '144.96', '2024-12-31 01:04:00', '2024-12-31 17:23:00', 40.00, NULL, NULL, NULL, NULL, NULL, 3, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-12 19:35:01', '2024-12-12 19:47:23', 3, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(75, 383, NULL, '25 Milton Pde, Bundoora, VIC', '-37.69', '145.06', '1 Fenton Way, Kew, VIC', '-37.81', '145.03', '2024-12-13 01:00:00', '2024-12-13 01:20:00', 1.00, NULL, NULL, NULL, NULL, NULL, 2, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, 'Testing Scenario 2:\n- Driver Rejects Booking Request ✅\nTesting Scenario 3:\n- Driver accept and then cancel ride', '2024-12-12 21:43:03', '2024-12-12 22:29:22', 1, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(76, 383, NULL, '39 Ryan St, Brunswick East, VIC', '-37.77', '144.98', '62 Grattan St, Carlton, VIC', '-37.80', '144.97', '2024-12-13 05:00:00', '2024-12-13 05:05:00', 1.00, NULL, NULL, NULL, NULL, NULL, 2, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, 'Test Scenario 4:\n- Passenger book a ride, and cancels >24hrs before departure ✅\n- Passenger book a ride, and cancels <24hrs before departure', '2024-12-12 23:34:00', '2024-12-13 00:26:46', -2, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'instant'),
(77, 383, NULL, '3 Bank St, Lara, VIC', '-38.02', '144.40', '225 Heaths Rd, Werribee, VIC', '-37.88', '144.68', '2024-12-13 17:00:00', '2024-12-13 17:43:00', 1.00, NULL, NULL, NULL, NULL, NULL, 2, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, 'Testing passenger cancelling ride <24hrs.', '2024-12-13 00:29:45', '2024-12-13 00:53:16', 0, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'instant'),
(78, 366, NULL, '102 Laidlaw St, Yass, NSW', '-34.83', '148.91', '215 Lawrence St, Wodonga, VIC', '-36.12', '146.88', '2024-12-14 17:01:00', '2024-12-14 22:50:00', 15.00, NULL, NULL, NULL, NULL, NULL, 4, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-13 11:32:11', '2024-12-13 11:39:23', 0, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(79, 366, NULL, '215 Lawrence St, Wodonga, VIC', '-36.12', '146.88', '13 Tor St, Gundagai, NSW', '-35.06', '148.10', '2024-12-14 17:11:00', '2024-12-14 21:13:00', 10.00, NULL, NULL, NULL, NULL, NULL, 4, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-13 11:41:37', '2024-12-13 11:50:27', 2, 3, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(80, 366, NULL, '215 Lawrence St, Wodonga, VIC', '-36.12', '146.88', '13 Tor St, Gundagai, NSW', '-35.06', '148.10', '2024-12-14 07:49:00', '2024-12-14 11:51:00', 11.00, NULL, NULL, NULL, NULL, NULL, 4, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-13 12:12:31', '2024-12-13 12:25:52', -2, 0, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'secure'),
(81, 366, NULL, 'Blende St, Broken Hill, NSW', '-31.96', '141.46', '7–9 Opal St, Lightning Ridge, NSW', '-29.43', '147.98', '2024-12-15 18:15:00', '2024-12-16 11:20:00', 42.00, 25.00, 33.00, 8.00, 15.00, 19.00, 4, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-13 12:48:29', '2024-12-13 13:36:41', -5, 0, 1, 1, '[]', 'Cobar', '-31.50', '145.84', 'Nyngan', '-31.56', '147.19', 'secure'),
(82, 310, 2, 'Blende St, Broken Hill, NSW', '-31.96', '141.46', 'Lightning Ridge NSW 2834, Australia', '-29.43', '147.98', '2024-12-15 19:10:00', '2024-12-16 12:15:00', 43.00, 25.00, 33.00, 8.00, 15.00, 19.00, 3, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, 'This is final test ride.', '2024-12-13 13:41:03', '2024-12-13 14:31:53', -1, 3, 1, 1, '[]', 'Cobar', '-31.50', '145.84', 'Nyngan', '-31.56', '147.19', 'secure'),
(83, 379, NULL, '210 Elizabeth St, Melbourne VIC 3000', '-37.8136186', '144.963086', '110-140 King St, Sydney NSW 2000', '-33.8688222', '151.20931', '2024-12-20 16:30:00', '2024-12-21 10:20:00', 50.00, 20.00, 30.00, 15.00, 20.00, 32.00, 4, NULL, '0', '0', NULL, 'This is for testing purpose', '2024-12-13 15:53:44', '2024-12-13 16:10:36', 1, 3, 0, 0, '[]', 'Albury', '-36.0737293', '146.9135418', 'Canberra', '-35.2801846', '149.1310324', 'secure'),
(84, 379, NULL, 'By appointment only, Albury NSW 2640', '-36.0737293', '146.9135418', '3 Petrie Plaza, Canberra ACT 2601', '-35.2801347', '149.1311399', '2024-12-13 22:15:00', '2024-12-14 03:12:00', 13.00, NULL, NULL, NULL, NULL, NULL, 3, NULL, '0', '0', NULL, NULL, '2024-12-13 16:14:57', '2024-12-13 16:24:55', 3, 2, 0, 0, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'instant'),
(85, 310, 2, 'Broken Hill NSW 2880, Australia', '-31.96', '141.46', 'Albury NSW, Australia', '-36.07', '146.91', '2024-12-14 03:18:00', '2024-12-14 03:20:00', 41.00, NULL, NULL, NULL, NULL, NULL, 2, '10 kg', 'Not Allowed', 'Avoid pets at home', NULL, NULL, '2024-12-13 16:17:46', '2024-12-13 16:21:28', 0, 2, 1, 1, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'instant'),
(86, 310, 2, '3 Roe St, Perth WA 6000', '-31.9513357', '115.861407', '167 Albert St, Brisbane City QLD 4000', '-27.4705069', '153.0260841', '2024-12-14 15:30:00', '2024-12-18 09:39:00', 216.00, NULL, NULL, NULL, NULL, NULL, 2, NULL, 'No cigarettes, please', 'No pets in the car', 'I’ll jam depending on the mood', NULL, '2024-12-13 16:24:20', '2024-12-13 16:31:54', 0, 3, 0, 0, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'instant'),
(87, 310, 2, '314 Little Collins Street, Level 2 Royal Arcade, Melbourne VIC 3000', '-37.8149439', '144.9642851', '3 Petrie Plaza, Canberra ACT 2601', '-35.2801347', '149.1311399', '2024-12-16 15:30:00', '2024-12-17 03:10:00', 28.00, NULL, NULL, NULL, NULL, NULL, 3, NULL, 'No cigarettes, please', 'No pets in the car', 'I’ll jam depending on the mood', NULL, '2024-12-13 16:33:27', '2024-12-13 16:33:27', 0, 1, 0, 0, '[]', NULL, NULL, NULL, NULL, NULL, NULL, 'instant');

-- --------------------------------------------------------

--
-- Table structure for table `ride_alerts`
--

CREATE TABLE `ride_alerts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `departure_time` date NOT NULL,
  `departure_city` varchar(255) NOT NULL,
  `arrival_city` varchar(255) DEFAULT NULL,
  `user_departure_lat` double DEFAULT NULL,
  `user_departure_long` double DEFAULT NULL,
  `user_arrival_lat` double DEFAULT NULL,
  `user_arrival_long` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ride_alerts`
--

INSERT INTO `ride_alerts` (`id`, `user_id`, `departure_time`, `departure_city`, `arrival_city`, `user_departure_lat`, `user_departure_long`, `user_arrival_lat`, `user_arrival_long`, `created_at`, `updated_at`) VALUES
(1, 310, '2024-12-05', 'Sydney', 'Melbourne', -33.8688197, 151.2092955, -37.8136276, 144.9630576, '2024-12-05 20:17:44', '2024-12-05 20:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `search_histories`
--

CREATE TABLE `search_histories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `departure_city` text DEFAULT NULL,
  `departure_lat` varchar(100) DEFAULT NULL,
  `departure_long` varchar(100) DEFAULT NULL,
  `arrival_city` text DEFAULT NULL,
  `arrival_lat` varchar(100) DEFAULT NULL,
  `arrival_long` varchar(100) DEFAULT NULL,
  `departure_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('i4yeh1loUfyLsZ6OUxDpyhhvzitdgkaqloo3eC5i', 1, '122.176.132.193', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMUxXdHdVdjBseFVCVk12QTdJd2dCT1lXOUNmVU9za2F1Z0dCT1hKQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHBzOi8vcmlkZS5kcml2dnkuY29tLmF1L2FkbWluL3BheW91dC9wYXlvdXQtbGlzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1734082383),
('io6nqyVWT9OYG4f5LTYv3UQOlePWzUlaLm7XZu2d', 1, '159.21.68.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidkpEc3NBMVhsY2pjTVJzTlF3Yms1VnhVM254b3dlZjdLWm1OS2xadyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHBzOi8vcmlkZS5kcml2dnkuY29tLmF1L2FkbWluL3BheW91dC9yZWZ1bmQtbGlzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1734025949),
('mB1V4YFJlYrClazxGYF0iX4mrmn39IQSg8yQaaXH', 1, '122.176.132.193', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieERuTzVLOHNabTFwRzg4Y0g1RmdyMDMwUFdaaFV0UlhCMmJucktOViI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NjoiaHR0cHM6Ly9yaWRlLmRyaXZ2eS5jb20uYXUvYWRtaW4vZG9jdW1lbnQvbGlzdCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQyOiJodHRwczovL3JpZGUuZHJpdnZ5LmNvbS5hdS9hZG1pbi9yaWRlL2xpc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1734070609),
('R9WZNOKE8kwhqhE6QzT3Ow973yVtAE6rrwYEYIMs', 1, '159.21.68.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiU3lOQkwzUHZFT2haVG5CQ01Kd3BMbDNqWHF3SFdGRWJWbzNLOHVIciI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MToiaHR0cHM6Ly9yaWRlLmRyaXZ2eS5jb20uYXUvYWRtaW4vcGF5b3V0L3JlZnVuZC1saXN0Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHBzOi8vcmlkZS5kcml2dnkuY29tLmF1L2FkbWluL3BheW91dC9wYXlvdXQtbGlzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1734042653),
('zmijP4Mdfxbj6d910pnVuuCG1zzeJczcKISQ97EM', NULL, '49.43.101.205', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOE9VZlBmRWNnRUFnYjl0YmsxUGwwZVBUYWJCZnFmQmc2eGNKQ2NJYyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NjoiaHR0cHM6Ly9yaWRlLmRyaXZ2eS5jb20uYXUvYWRtaW4vdXNlci92aWV3LzMwOSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMyOiJodHRwczovL3JpZGUuZHJpdnZ5LmNvbS5hdS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1734065927);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `bio` longtext DEFAULT NULL,
  `rating` double DEFAULT NULL,
  `role_id` int(11) DEFAULT 1 COMMENT '1-User, 2-Admin',
  `join_date` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT 1 COMMENT '1-Active, 1-Inactive',
  `phone_otp` int(11) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `verify_id` varchar(255) DEFAULT '1' COMMENT '1-pending,2-verified,3-rejected',
  `chattiness` varchar(50) DEFAULT NULL,
  `music` varchar(50) DEFAULT NULL,
  `smoking` varchar(255) DEFAULT NULL,
  `pets` varchar(255) DEFAULT NULL,
  `phone_verfied_at` timestamp NULL DEFAULT NULL,
  `phone_otp_expires_at` timestamp NULL DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `stripe_connect_account_id` varchar(255) DEFAULT NULL,
  `fcm_token` text DEFAULT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `is_notification_ride` tinyint(1) DEFAULT 1,
  `is_notification_plan` tinyint(1) DEFAULT 0,
  `is_notification_message` tinyint(1) DEFAULT 0,
  `is_email_plan` tinyint(1) DEFAULT 0,
  `is_email_message` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `email_verified_at`, `password`, `country_code`, `phone_number`, `profile_picture`, `bio`, `rating`, `role_id`, `join_date`, `status`, `phone_otp`, `last_login`, `deleted_at`, `remember_token`, `created_at`, `updated_at`, `first_name`, `last_name`, `dob`, `id_card`, `verify_id`, `chattiness`, `music`, `smoking`, `pets`, `phone_verfied_at`, `phone_otp_expires_at`, `customer_id`, `stripe_connect_account_id`, `fcm_token`, `device_type`, `provider`, `provider_id`, `is_notification_ride`, `is_notification_plan`, `is_notification_message`, `is_email_plan`, `is_email_message`) VALUES
(1, 'admin@yopmail.com', NULL, '$2y$12$WUzvsNdGifYTNjKlLUEaseMKp6pCCfw6uEDrAd4HOqLdPnPG2yw8C', NULL, '7584896584', '1726138684.png', 'This is a Test Descriptions', NULL, 2, NULL, 1, NULL, NULL, NULL, NULL, '2024-07-23 22:43:30', '2024-11-23 20:12:01', 'Nexgo', 'Admin', NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0),
(282, 'johnson@yopmail.com', NULL, '$2y$12$q4nDuf4HviSzffS96CFT9OHXiLUc.a2smgrqbyX4bcX1.KwIQXFyy', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-03 18:54:45', '2024-12-03 18:54:45', 'Michal', 'Johnson', '1998-12-03', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0),
(283, 'michal@yopmail.com', NULL, '$2y$12$XV3Q2iBEbXid4Imu7xG5.u2rF/AiLt0qIAxd5OrKpsRwJxzO4xwKa', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-03 18:57:15', '2024-12-05 12:09:48', 'Michal', 'Johnson', '1998-12-03', NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0),
(284, 'michal1@yopmail.com', NULL, '$2y$12$zZgiHf2I1EDBXC.OOd.qAeGetq6aDuTT1FTr/akH23IgYqdqg7EXW', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-03 18:58:32', '2024-12-03 18:58:32', 'Michal', 'Johnson', '1998-12-03', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0),
(285, 'michal2@yopmail.com', NULL, '$2y$12$NgPI2uwD3k8buCNH2CYYH.VT5OOWVa2evIBySQqJV4i0pZARCsGU2', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-03 19:01:15', '2024-12-03 19:01:15', 'Michal', 'Johnson', '1998-12-03', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0),
(292, 'boat@yopmail.com', NULL, '$2y$12$DdUrhYzcpPyHZ6PQcQqAA.QsKQsY.0e0LOdaAZ8BTxYt8psyoh6ma', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-03 20:04:45', '2024-12-03 20:04:45', 'Jordan', 'Singh', '2006-12-01', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0),
(294, 'jordan@yopmail.com', NULL, '$2y$12$E0s35rnNUHHnKjSzdL/wqO9SlVoE/DnhOALm4DUFhfBukHp/A78Ki', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-03 20:08:22', '2024-12-03 20:08:22', 'Jordan', 'Singh', '2006-12-01', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0),
(295, 'harrysingh321321@gmail.com', NULL, '$2y$12$u.OCkPKnComQ5AqzBMcpbePd35ouieC.qbbVLjGmeme3JJc5Or1EG', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-03 20:09:53', '2024-12-03 20:09:53', 'Harry', 'Singh', '2006-12-03', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0),
(297, 'harrysingh32@gmail.com', NULL, '$2y$12$IwN83RBSYqMV4CvZnBOxMOMVVUWuyrNgb7ckdv25ZN/TySPoRUEv2', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-03 20:11:38', '2024-12-05 12:24:20', 'Harry', 'Singh', '2006-12-03', NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0),
(308, 'developer@esferasoft.com', NULL, '$2y$12$IPlSsBPYy6AGJffK9DnOAO8KOexMzQ9VfDe2wBWrVHHVi.uqmRAVS', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-04 19:25:09', '2024-12-12 13:17:54', 'Michal', 'Johnson', '1998-12-03', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cS0B10HlSvSYMZo4ROzaCr:APA91bHx_gxHGEn3m0hJ0TkMMY6t5JGhaAx09m2ZLYEJ8uiOFtwYhCNFd8ZxPIy-eplthdoKGWV08F8bPmqYidVGjgVXL8FRD2VAmM1TEghW37mEu_HNnwc', 'android', NULL, NULL, 0, 0, 0, 0, 0),
(309, 'williams@yopmail.com', '2024-12-05 11:32:03', '$2y$12$e0b8HdSgiz6T6WUES1X5qOEGrnUb7lMNWKrnayf1Nhrj0XYfd.xIm', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-05 11:29:08', '2024-12-13 16:03:48', 'Kane', 'Williams', '2001-12-05', '1733373759.jpg', '2', NULL, NULL, NULL, 'I only accept certain kind of pets', NULL, NULL, 'cus_RNCT4ucDLerbhX', NULL, 'co8GAC4zhkUKo1QNSBUsi0:APA91bHEytAHUsZ4kb7g9J3Zt1PXRR2Rs2kZ7CBFqNrhBusxutUpucjXX6wepDmScFmfzy5P55ZJaijmzS7b7qWZMWYBktW1aispV3TUUb7gymGp0UllzXo', 'ios', NULL, NULL, 0, 0, 0, 0, 0),
(310, 'southee@yopmail.com', '2024-12-05 12:08:53', '$2y$12$0SiTa5sRjiH5SECKfRWKq.wGJuit9ZOmlmZjZo8kTgCiy6vD2Fu9O', '+91', '8591939994', '1733402659.jpg', 'This is the test bio', NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-05 12:07:00', '2024-12-13 16:36:15', 'Tim', 'Southee', '2000-12-03', '1733378443.jpg', '2', 'I’m a chatterbox!', 'I’ll jam depending on the mood', 'No cigarettes, please', 'No pets in the car', '2024-12-05 19:45:49', NULL, 'cus_RMocGW7I0hZMHn', NULL, 'evx7_wO1QtiktEzScEMO3r:APA91bGlm5rGek8TPs60utLunNXGwPm0tNTT46cNwe-WL4DqvoUxkVtTtu7yTU6HUpSHdjMQhNs7oYy-P-j5pXkjk1HDZSQJReKXiLdCXmOQhtuf7-agJSU', 'android', NULL, NULL, 1, 0, 0, 0, 1),
(311, 'pm@esferasoft.com', NULL, '$2y$12$6R5LuHWmtOaoSAvXhIywDevb0ZydiSZSQNGN4zEWp9mt9GTJ2B7IC', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-05 12:38:36', '2024-12-05 12:38:36', 'Michal', 'Johnson', '1998-12-03', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0),
(312, 'androidtest@yopmail.com', NULL, '$2y$12$WsaePWsdBgA5c/vt.8fTu.ar03.UCY1R/NjPRbCIq7kOVWNaDKSIq', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, '2024-12-05 16:03:41', NULL, '2024-12-05 15:42:58', '2024-12-05 16:03:41', 'Android', 'Test', '2000-12-05', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0),
(313, 'ankushchambiyal2+test@gmail.com', NULL, '$2y$12$7rCdWMr8E4yTg/OcsoM8BOSvNIKHhV3BypRd6Ckhv.mGQrFfoFZpC', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, '2024-12-05 16:03:13', NULL, '2024-12-05 15:44:54', '2024-12-05 16:03:13', 'Android', 'Test', '1988-12-05', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0),
(314, 'ankushchambiyal2+16@gmail.com', NULL, '$2y$12$ndGwlXf8XwISMs.yp7fcZutcE5aeD9uY3gWqJrk3rrNMsUHu19sHe', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, '2024-12-05 16:03:07', NULL, '2024-12-05 15:52:56', '2024-12-05 16:03:07', 'Android', 'Test', '2003-12-05', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0),
(315, 'ankushchambiyal24@gmail.com', NULL, '$2y$12$RbTaVsPqh.MUPQTHA5q5uuJhoHHmo71mcNW9mMZWdeWihGcVybyQC', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, '2024-12-05 16:03:33', NULL, '2024-12-05 15:54:36', '2024-12-05 16:03:33', 'Android', 'Test', '2002-12-05', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0),
(316, 'developer+12@esferasoft.com', NULL, '$2y$12$K1VJhmghxPZHTbvcDifgQeTVuWK.iOFZjkkeBdagzU9d6PEgfox6C', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, '2024-12-05 16:03:24', NULL, '2024-12-05 15:59:19', '2024-12-05 16:03:24', 'Test', 'Dev', '1996-12-05', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0),
(319, 'ankushchambiyal2@gmail.com', NULL, '$2y$12$5AoxCbrN/uxQ3GrrkcQAiupOUW2vwfmm/tiE3tiSZaqfH0D.8VO3y', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, '2024-12-06 15:49:23', NULL, '2024-12-05 17:18:45', '2024-12-06 15:49:23', 'Michal', 'Johnson', '1998-12-03', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0),
(332, 'preetiattri39@gmail.com', NULL, '$2y$12$sMahhrT2U/MygJK.JaNAM.DRacw5n0Xw8CN.z9rh79Wey8kNiE5PG', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-05 18:36:50', '2024-12-05 18:36:50', 'Michal', 'Johnson', '1998-12-03', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0),
(334, 'anderson@yopmail.com', '2024-12-06 12:06:49', '$2y$12$uB5WEPG.LqqbKnLQS3oOBO75u6U9VLcERoIKfD/BiY6qCAS3MTYne', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-06 12:05:19', '2024-12-06 12:13:58', 'James', 'Anderson', '2000-12-06', '1733461741.jpg', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 1),
(335, 'achambiyal4@gmail.com', '2024-12-06 15:53:29', '$2y$12$GBgjksx1GbrNE8YSgNUGt.xM5e54AT/wCXZv8RCUtaagJU58xbaD6', '91', '8627865347', '1733482547.jpg', 'This is test', NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-06 15:50:44', '2024-12-06 20:02:47', 'Ios', 'Test', '2000-12-06', '1733482344.jpg', '2', 'I’m chatty when I feel comfortable', NULL, NULL, 'No pets in the car', '2024-12-06 16:07:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 1),
(336, 'achambiyal416@yopmail.com', NULL, '$2y$12$kYxc9/9NwTKkxz4AcXWR.eR/xQkUuZnBqvlilR7IIiBBVghSuJjKW', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-06 15:55:59', '2024-12-06 15:55:59', 'Test', 'Android', '2003-12-06', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 1),
(337, 'achambiyal416@gmail.com', '2024-12-06 16:01:27', '$2y$12$OqMzSqpjnizDxarOaBgbrekEAC8CumB3AfmCG.q0GemVE9jB0jOWa', '+91', '8196865347', '1733483247.jpg', 'this is test', NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-06 15:57:18', '2024-12-06 19:56:41', 'Test', 'Android', '2002-12-06', '1733482353.jpg', '2', NULL, NULL, NULL, NULL, '2024-12-06 16:09:24', NULL, 'cus_RLgr9vZ0qJoCGA', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 1),
(338, 'starc@yopmail.com', '2024-12-06 17:11:09', '$2y$12$KGkgI3hw8yrl0xhTSQOkAe2CGmbVRvhjfJ1Vhg3wlrrgzJbc8Bs8a', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-06 17:09:41', '2024-12-10 17:44:02', 'Mitchel', 'Starc', '1999-12-06', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 'cus_RMoEsfo6pGHmzG', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 1),
(339, 'ankush@yopmail.com', '2024-12-06 19:14:45', '$2y$12$sBWmnW2v1NlgefQyiBpuu.543VBTPNKfrwgoUWYS5raIgBBCQYpqO', NULL, NULL, '1733490294.jpg', NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-06 19:13:18', '2024-12-09 19:39:38', 'Ankush', 'Test', '2003-12-06', '1733490323.jpg', '2', NULL, NULL, NULL, NULL, NULL, NULL, 'cus_RMpp4p3GFcuFOr', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 1),
(340, 'caroline.treyer@gmail.com', '2024-12-06 21:26:40', '$2y$12$DEFz0JrzvjPwzf40Lri.L.E17sSBu5iq4zt9lF2BGn1IW7xfBBHlO', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-06 21:26:40', '2024-12-12 19:45:52', 'Caroline', 'Oseghale', NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'google', '107897164006876556364', 1, 0, 0, 0, 1),
(341, 'carol.oseghale@gmail.com', '2024-12-06 21:32:30', '$2y$12$0HiDejeVSljxzKG7AZ2LO.ZKGRaiTVT6FzQZhKLF0LUXvveFrXEgW', '+41', '772232509', NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-06 21:30:20', '2024-12-13 05:24:37', 'Caroline', 'Oseghale', '1994-06-30', '1733597941.jpg', '2', 'I’m chatty when I feel comfortable', 'Music all the time', 'Cigarette inside the car is ok', 'I love pets', '2024-12-08 02:03:18', NULL, 'cus_RNLhOwhrIRED1S', NULL, 'fV_odeeJRxWIrycN9r5rOg:APA91bFw0EiVgn8CI7SEaEjRdYsO58Ia6CZnIHJZbvJAIlGIbaDjy0wrpI73RuqDmZkjmgJBlObx6feILDzM7UinD97b9_EBlZE6E0UceWy0A3N8eouAKYo', 'android', NULL, NULL, 1, 0, 0, 0, 1),
(348, 'crislive@yopmail.com', NULL, '$2y$12$sU0IP1fQkPYpYEReG102JON4Xn9yvvUu.w9tnm5Q9qfMh6YoJt2tu', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-11 20:18:50', '2024-12-11 20:18:50', 'Cris', 'Live', '2002-12-11', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 1),
(349, 'jameslive@yopmail.com', NULL, '$2y$12$msAiwHCotDwY5TdjVojQvu6CHhEIsNLboYVkxYGS6iEZReNkU9ol6', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-11 20:19:49', '2024-12-11 20:19:49', 'James', 'Live', '2001-12-11', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 1),
(350, 'john2@yopmail.com', '2024-12-11 20:28:51', '$2y$12$da4Yf7wSIWjIDgRXzpdXKOOGpKL/xmkxx5oUmaoLnqzPfmGYzlnBa', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-11 20:26:24', '2024-12-11 20:29:41', 'John', '2', '2000-12-11', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cUANMrw6TPStj69zN7_Dyw:APA91bHPPbY6Znq3WH1fjTePf9XrRtt_Ssn32PBPRyFB4iK-yrd04OidAMJyQqCl7Aw0mDiGOL3bGm-XJew44VbTy-0O0Zn6f8jQe0Xl1Pe_u35608UfLi8', 'android', NULL, NULL, 1, 0, 0, 0, 1),
(351, 'john3@yopmail.com', '2024-12-11 20:29:56', '$2y$12$RIbyJB7jwb6sXkVCgP.X/Od29Kno1jAgqCRRqRvvwWzNmJnDJMf4y', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-11 20:28:20', '2024-12-12 11:14:12', 'John', 'Test', '2004-12-11', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 1),
(366, 'willyiOS@yopmail.com', '2024-12-12 12:30:57', '$2y$12$zfMMBhGvVCDgiomOgYkD7OYYNcIMMkfdjK2HQ.xLNpxq3Y7E2/AUC', '91', '7009951618', NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-12 11:39:08', '2024-12-13 14:19:27', 'David', 'Willy', '2001-12-12', NULL, '1', NULL, NULL, NULL, NULL, '2024-12-12 11:46:56', NULL, 'cus_RNrjN298TjCejl', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 1),
(370, 'abhi@yopmail.com', '2024-12-12 11:47:51', '$2y$12$z/2XKn4WVHulSNwsCfY.kOsstxY7WhCkZjAQEtMRr21GwnLRfW5Re', '+91', '9876237313', NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-12 11:43:36', '2024-12-12 19:00:42', 'Test', 'Singh', '2006-12-12', NULL, '1', NULL, NULL, NULL, NULL, '2024-12-12 11:51:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 1),
(373, 'jass@yopmail.com', '2024-12-12 11:56:31', '$2y$12$nBLbQdFtoXWaBhe/x9.j3eqzvo/QWqksQz3Kac71lKXPjNwA5zoKG', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-12 11:55:02', '2024-12-13 13:36:11', 'Test', 'Singh', '2006-12-12', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 'cus_RNqBuPGz8hWjKl', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 1),
(377, 'userios@yopmail.com', '2024-12-12 12:03:57', '$2y$12$xSxEx/CR2bNeHjhCqknAUuXUfhoPeFLqBo3f9V8ziV6SZs1WpDpWG', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-12 12:02:26', '2024-12-13 14:19:43', 'User', 'Ios', '2004-12-23', '1733997435.jpg', '2', NULL, NULL, NULL, NULL, NULL, NULL, 'cus_RNqIFsSkghBgce', NULL, 'cxJGqWeVyEFrvh3yLfCX7m:APA91bHHVZuPFCs--vZZp63rYkmKAboaz1uYP8pC6xb_Zzj9WYJuWWy9TxOOLSGjfwDGry3iXKHofqBdfuqAWeoQr9THnJoiWYKpqrPFv9Vpo-VmsByn6Ow', 'ios', NULL, NULL, 1, 0, 0, 0, 1),
(379, 'androidankush@yopmail.com', '2024-12-12 17:01:02', '$2y$12$os4B6kYgkGZRAYe9OuD1YeZ.ke3nDUtR0DPa4H1yf/W3JM7feWU3e', NULL, NULL, '1734074608.jpg', NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-12 16:57:38', '2024-12-13 16:20:18', 'Android', 'Ankush', '2003-12-12', '1733997869.jpg', '2', NULL, NULL, NULL, NULL, NULL, NULL, 'cus_RNvQuN2RYUQdlf', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 1),
(380, 'iosankush@yopmail.com', '2024-12-12 17:01:03', '$2y$12$2fpw3LOSiVpAuNwoHvbBSuT12rH1iyUzvCYCOS7/YTr63m2G74SVa', NULL, NULL, '1734074599.jpg', NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-12 16:57:40', '2024-12-13 16:35:45', 'Ios', 'Ankush', '1999-12-12', '1733997876.jpg', '2', NULL, NULL, NULL, NULL, NULL, NULL, 'cus_RNvQdP6Wudc4f2', NULL, 'cdgeLwfL4URjoIQSmI5csg:APA91bFvZHu50l2AkGqDMzXLya4PEouurIFbQHMvt123KKmczMEEUpK6HRbkRHtL3ysqtFvSpTHr5H-lPsZZZeQ3APQzwYVGSr9CJIYzJyP0HEa7t8-xl2I', 'ios', NULL, NULL, 1, 0, 0, 0, 1),
(382, 'testsingh28@gmail.com', '2024-12-12 18:21:54', '$2y$12$0AgssaoQGjpouD5g1prcMOqiAlUQqvI5XfS2kKOOGFh1lrLddTH3q', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-12 18:21:54', '2024-12-12 18:21:54', 'test', 'singh', NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cS0B10HlSvSYMZo4ROzaCr:APA91bHx_gxHGEn3m0hJ0TkMMY6t5JGhaAx09m2ZLYEJ8uiOFtwYhCNFd8ZxPIy-eplthdoKGWV08F8bPmqYidVGjgVXL8FRD2VAmM1TEghW37mEu_HNnwc', 'android', 'google', '113080473227651226409', 1, 0, 0, 0, 1),
(383, 'nomen.ose@outlook.com', '2024-12-12 20:56:49', '$2y$12$bHZW9yoAXVuTMDcpHoDj7ewIyWD9FtzDZGev4IgsNVHkG8Zb8PI0i', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-12 20:55:08', '2024-12-12 21:39:29', 'Normy Driver', 'Test', '1996-12-12', '1734011915.jpg', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'd5dGnx1X8UUxteGqdFgPNR:APA91bHd22ZFClnlWogSfso1LaCJ0H6LQ_9xOaeVd-ms5lEH00uypADrkrCqUas7pw3d1zKpHj2FvANFhjTHu-pJBBgBLtUEqWfkfTMs-8n1clZZ-gak3UM', 'ios', NULL, NULL, 1, 0, 0, 0, 1),
(384, 'John.head1@outlook.com', NULL, '$2y$12$PxJXr6cdSP6qaihN./sUduAO2kse3TLhCIYOBoTvH2NK/wRJkhDu.', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-12 21:45:21', '2024-12-12 21:45:21', 'John Pass', 'Test', '2004-12-12', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 1),
(385, 'Jon.head1@outlook.com', '2024-12-12 21:49:06', '$2y$12$7xKtuvoXIf8cpFEFUEXrfegh/IcJfPRuh0on1AbOBDRtQ88oEEL.K', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-12 21:47:29', '2024-12-13 05:25:59', 'Jon Pass', 'Test', '1990-12-12', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 'cus_RNzkAhKkHtxwP0', NULL, 'eN1EJBY-SEA6jtzkhzzFiL:APA91bEXkor2-9SHhkWCF1XaEuEDBktjM5wzzHlYElGXDpSl6WqGuOb3qW_u4zCa1upvGgpre52my_93G8ij81uUd1ljMz8n_c5fp_ZJW-ir3bWNEhXVw5U', 'ios', NULL, NULL, 1, 0, 0, 0, 1),
(386, 'petaose@live.com', '2024-12-12 22:17:34', '$2y$12$LMiu9RSofPsbNBLzUeOn0ORptmEPOzsINmiMOKx4CVM8my7pDDddu', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-12 22:15:26', '2024-12-12 23:59:18', 'Peta Pass', 'Test', '1988-09-12', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 'cus_RO0EgEdzsaqjq3', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 1),
(387, 'blackjacky.ose@gmail.com', '2024-12-13 00:35:00', '$2y$12$a3DjYq4InbV5T3jSWfflHexRmozTn1DXAEDggvIN4jtmRejv4HMSi', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2024-12-13 00:33:28', '2024-12-13 05:24:35', 'Pass Tester', 'Test', '1995-12-03', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 'cus_RO2PiCci6iRkUc', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) NOT NULL,
  `your_rides` tinyint(1) NOT NULL DEFAULT 0,
  `news_gifts` tinyint(1) NOT NULL DEFAULT 0,
  `messages` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_reports`
--

CREATE TABLE `user_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `passenger_id` bigint(20) UNSIGNED NOT NULL,
  `ride_id` bigint(20) UNSIGNED NOT NULL,
  `report_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_reports`
--

INSERT INTO `user_reports` (`id`, `driver_id`, `passenger_id`, `ride_id`, `report_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(119, 310, 309, 4, 1, 'this is reports test', 1, '2024-12-05 19:12:08', '2024-12-12 17:52:55'),
(122, 310, 309, 4, 3, 'There is a problem in the ride.', 0, '2024-12-12 17:59:37', '2024-12-12 17:59:37'),
(123, 309, 310, 14, 1, 'android report', 1, '2024-12-12 18:07:52', '2024-12-12 18:11:15'),
(124, 310, 309, 54, 1, 'iOS report', 1, '2024-12-12 18:07:53', '2024-12-12 18:10:49');

-- --------------------------------------------------------

--
-- Table structure for table `vechiles`
--

CREATE TABLE `vechiles` (
  `vechile_id` bigint(20) UNSIGNED NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vechiles`
--

INSERT INTO `vechiles` (`vechile_id`, `make`, `model`, `type`, `color`, `created_at`, `updated_at`) VALUES
(2, 'BMW', '1 series, 3 series, 325, 330, 5 series, 525, 650, 7 series, 745, 750, 760, 8 series, Alpina B7, M, M Roadster, M3, M5, M6, X3, X5, X5M, X6, X6M, Z3, Z4, Z4M, Z4M Roadster, Z8', 'Sedan, Hatchback, Van, SUV, Pickup', 'Grey, Black, White, Blue, Red, Silver, Orange, Green, Bronze, Yellow', '2024-07-24 11:13:31', '2024-11-05 05:37:31'),
(3, 'Honda', 'Accord, Accord Crosstour, Civic, Civic GX, Civic Si, Crosstour, CR-V, CR-X, CR-Z, Del Sol, Element, FCX Clarity, Fit, Insight, Odyssey, Passport, Pilot, Prelude, Ridgeline, S2000', 'Sedan, Hatchback, Van, SUV, Pickup', 'Grey, Black, White, Blue, Red, Sliver, Orange, Green, Bronze, Yellow', '2024-07-24 11:13:31', '2024-11-05 05:37:08'),
(4, 'Hyundai', 'i30, Accent, Azera, Elantra, Entourage, Equus, Excel, Genesis, Genesis Coupe, HED-5, Santa Fe, Scoupe, Sonata, Tiburon, Tucson, Veloster, Veracruz, XG300, XG350', 'Sedan, Hatchback, Van, SUV, Pickup', 'Grey, Black, White, Blue, Red, Sliver, Orange, Green, Bronze, Yellow', '2024-07-24 11:13:31', '2024-11-24 03:20:11'),
(5, 'Mahindra', 'Scorpio, XUV300, XUV700, Thar, Bolero, Thar Roxx', 'SUV', 'Red, Black, White, Blue, Grey', '2024-09-03 06:50:50', '2024-11-05 05:37:47'),
(6, 'Toyota', 'Corolla, Camry, Avalon, Mirai, Yaris, RAV4, Highlander, 4Runner, Land Cruiser, Sequoia, C-HR, Tacoma, Tundra, Hilux, Prius, Prius Prime, RAV4 Hybrid, Highlander Hybrid, Corolla Hybrid, bZ4X, Sienna, GR Supra, GR86', 'Sedan, Hatchback, Coupe, SUV/Crossover, Minivan, Pickup Truck, Hybrid/Electric, Convertible', 'White, Black, Silver, Grey, Blue, Red, Green, Brown, Yellow', '2024-10-03 22:32:37', '2024-11-05 05:39:03'),
(7, 'Mazda', 'Mazda3, Mazda6, Mazda2, Mazda CX-3, Mazda CX-30, Mazda CX-5, Mazda CX-50, Mazda CX-9, Mazda, MX-30, Mazda MX-5 Miata', 'Sedan, Hatchback, Crossover SUV, Compact SUV, Electric SUV, Convertible', 'White, Black, Grey, Silver, Red, Blue, Brown, Green', '2024-10-03 22:48:37', '2024-11-05 05:39:30'),
(8, 'Nissan', 'Altima, Maxima, Sentra, Versa, Leaf, Qashqai, Rogue, Murano, Pathfinder, X-Trail, Kicks, Armada, Patrol, Juke, Titan, Frontier, Navara, GT-R, 370Z, 400Z, Ariya', 'Sedan, Hatchback, Coupe, SUV/Crossover, Electric/Hybrid, Pickup Truck, Sports Car, Convertible', 'White, Black, Silver, Grey, Blue, Red, Green, Orange, Yellow', '2024-10-05 22:15:07', '2024-11-07 10:07:55'),
(9, 'Tesla', 'Tesla Model S, Tesla Model 3, Tesla Model X, Tesla Model Y, Tesla Cybertruck, Tesla Roadster, Tesla Semi', 'Sedan, SUV/Crossover, Pickup Truck, Sports Car, Semi-truck', 'White, Black, Silver, Blue, Red', '2024-10-05 22:19:51', '2024-11-05 05:39:42'),
(10, 'Audi', 'Audi A1, Audi A2, Audi A3, Audi A4, Audi A6, Audi A8, Audi Q2, Audi Q3, Audi Q5, Audi Q7, Audi Q8, Audi TT, Audi S series, Audi RS series, Audi R8, Audi e-tron, Audi Q4 e-tron, Audi e-tron GT', 'Sedan, Hatchback, Coupes, SUV/Crossover, Convertible/Roadster Sports, Electric', 'White, Black, Silver, Grey, Blue, Red, Yellow, Green, Brown', '2024-10-05 22:25:00', '2024-11-05 05:42:42'),
(11, 'Ford', 'Fiesta, Focus, Fusion, Taurus, EcoSport, Escape, Edge, Explorer, Expedition, Bronco, Bronco Sport, Ranger, F-150, Super Duty, Maverick, Mustang, GT, Mustang Mach-E, F-150 Lightning, E-Transit', 'Sedan, Hatchback, SUV, Pickup Truck, Sports, Electric, Van', 'White, Black, Silver, Grey, Blue, Red, Orange, Green, Yellow, Brown, Tan', '2024-10-05 22:31:49', '2024-11-05 05:42:25'),
(12, 'Mitsubishi', 'Mirage,  Attrage, Outlander,  Outlander PHEV,  Eclipse Cross, ASX, Pajero Sport, Pajero, Triton, i-MiEV', 'Sedan, Hatchback, SUV, Pickup Truck, EV, Plug-in Hybrid', 'Black, Red, Blue, White, Silver, Grey, Brown, Green, Orange', '2024-10-05 22:38:32', '2024-11-05 05:42:08'),
(13, 'Holden', 'Commodore, Cruze, Astra, Caprice, Captiva, Equinox, Acadia, Trailblazer, Ute, Colorado, Rodeo, Special Vehicles (HSV), Monaro', 'Sedan, Hatchback, SUV, Ute, Performance, Coupe', 'White, Yellow, Black, Red, Blue, Green, Silver, Grey, Orange', '2024-10-05 22:41:44', '2024-11-05 05:41:43'),
(14, 'Kia', 'Rio, Forte, Stinger, K5, Cadenza, Seltos, Sportage, Sorento, Telluride, Soul, Carnival, EV6, Niro, Soul EV, Sorento Hybrid/PHEV', 'Sedan, Hatchback, SUV, Minivan/MPV, EV, Hybrid/PHEV', 'Black, Silver, Grey, Blue, White, Red, Green, Orange, Yellow, Brown, Beige', '2024-10-05 22:46:26', '2024-11-05 05:41:22'),
(15, 'Honda', 'Civic, Accord, Insight, City, HR-V, CR-V, Pilot, Passport, Element, Odyssey, Clarity, CR-V Hybrid, Accord Hybrid, Civic Type R, NSX', 'Sedan, Hatchback, SUV, Minivan, Hybrid/EV, Performance', 'White, Black, Silver, Grey, Red, Blue, Green, Orange, Yellow', '2024-10-05 22:49:51', '2024-11-05 05:41:02'),
(16, 'Subaru', 'Impreza, WRX, Legacy, Crosstrek, Forester, Outback, Ascent, BRZ, WRX STI, Crosstrek Hybrid, Solterra', 'Sedan, Hatchback, SUV, Sports, Hybrid/EV', 'White, Black, Silver, Grey, Red, Blue, Green, Orange, Yellow, Brown, Beige', '2024-10-05 22:52:25', '2024-11-05 05:36:31'),
(17, 'MG', 'ZS, Hector, Marvel R, GS, MG3, MG5 EV, MG6, ZS EV, MG4 EV', 'SUV, Hatchback, Sedan, EV', 'White, Black, Silver, Grey, Blue, Red, Green, Orange, Yellow', '2024-10-05 22:55:33', '2024-11-05 05:36:09'),
(18, 'Alfa Romero', 'Giulia, Giulia Quadrifoglio, Stelvio, 4C, GTV, 4C, GTV, 8C Competizione', 'Sedan, SUV, Coupe, Sports', 'White, Black, Silver, Grey, Blue, Red, Green, Orange, Yellow', '2024-10-05 23:01:10', '2024-11-05 05:40:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `bookings_ride_id_foreign` (`ride_id`),
  ADD KEY `bookings_passenger_id_foreign` (`passenger_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `cars_user_id_foreign` (`user_id`);

--
-- Indexes for table `chat_tokens`
--
ALTER TABLE `chat_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ride_id` (`ride_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `content_pages`
--
ALTER TABLE `content_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fares`
--
ALTER TABLE `fares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `ride_id` (`ride_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `otp_management`
--
ALTER TABLE `otp_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payments_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ride_id` (`ride_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `providers_user_id_foreign` (`user_id`);

--
-- Indexes for table `refund_payments`
--
ALTER TABLE `refund_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `reviews_ride_id_foreign` (`ride_id`),
  ADD KEY `reviews_reviewer_id_foreign` (`reviewer_id`);

--
-- Indexes for table `rides`
--
ALTER TABLE `rides`
  ADD PRIMARY KEY (`ride_id`),
  ADD KEY `rides_driver_id_foreign` (`driver_id`),
  ADD KEY `rides_car_id_foreign` (`car_id`);

--
-- Indexes for table `ride_alerts`
--
ALTER TABLE `ride_alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `search_histories`
--
ALTER TABLE `search_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_reports`
--
ALTER TABLE `user_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_reports_driver_id_foreign` (`driver_id`),
  ADD KEY `user_reports_passenger_id_foreign` (`passenger_id`),
  ADD KEY `user_reports_ride_id_foreign` (`ride_id`),
  ADD KEY `user_reports_report_id_foreign` (`report_id`);

--
-- Indexes for table `vechiles`
--
ALTER TABLE `vechiles`
  ADD PRIMARY KEY (`vechile_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chat_tokens`
--
ALTER TABLE `chat_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `content_pages`
--
ALTER TABLE `content_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fares`
--
ALTER TABLE `fares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `otp_management`
--
ALTER TABLE `otp_management`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `payouts`
--
ALTER TABLE `payouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refund_payments`
--
ALTER TABLE `refund_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rides`
--
ALTER TABLE `rides`
  MODIFY `ride_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `ride_alerts`
--
ALTER TABLE `ride_alerts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `search_histories`
--
ALTER TABLE `search_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=388;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_reports`
--
ALTER TABLE `user_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `vechiles`
--
ALTER TABLE `vechiles`
  MODIFY `vechile_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_passenger_id_foreign` FOREIGN KEY (`passenger_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ride_id_foreign` FOREIGN KEY (`ride_id`) REFERENCES `rides` (`ride_id`) ON DELETE CASCADE;

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_tokens`
--
ALTER TABLE `chat_tokens`
  ADD CONSTRAINT `chat_tokens_ibfk_1` FOREIGN KEY (`ride_id`) REFERENCES `rides` (`ride_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_tokens_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_tokens_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`ride_id`) REFERENCES `rides` (`ride_id`),
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE;

--
-- Constraints for table `payouts`
--
ALTER TABLE `payouts`
  ADD CONSTRAINT `payouts_ibfk_1` FOREIGN KEY (`ride_id`) REFERENCES `rides` (`ride_id`),
  ADD CONSTRAINT `payouts_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `providers`
--
ALTER TABLE `providers`
  ADD CONSTRAINT `providers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ride_id_foreign` FOREIGN KEY (`ride_id`) REFERENCES `rides` (`ride_id`) ON DELETE CASCADE;

--
-- Constraints for table `rides`
--
ALTER TABLE `rides`
  ADD CONSTRAINT `rides_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rides_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ride_alerts`
--
ALTER TABLE `ride_alerts`
  ADD CONSTRAINT `ride_alerts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD CONSTRAINT `user_notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_reports`
--
ALTER TABLE `user_reports`
  ADD CONSTRAINT `user_reports_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_reports_passenger_id_foreign` FOREIGN KEY (`passenger_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_reports_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_reports_ride_id_foreign` FOREIGN KEY (`ride_id`) REFERENCES `rides` (`ride_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
