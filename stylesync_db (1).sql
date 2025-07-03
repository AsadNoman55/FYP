-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2025 at 03:31 AM
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
-- Database: `stylesync_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `appointment_date` datetime NOT NULL,
  `total_bill` decimal(10,2) NOT NULL DEFAULT 0.00,
  `service_status` enum('pending','confirmed','completed','cancelled') DEFAULT 'pending',
  `payment_status` enum('pending','paid') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `service_id`, `branch_id`, `employee_id`, `appointment_date`, `total_bill`, `service_status`, `payment_status`) VALUES
(1, 2, 1, 1, 4, '2025-05-06 10:00:00', 2000.00, 'completed', 'pending'),
(2, 2, 1, 1, 4, '2025-05-07 14:30:00', 2000.00, 'completed', 'pending'),
(3, 1, 1, 1, 4, '2025-05-08 11:15:00', 2000.00, 'completed', 'paid'),
(4, 2, 1, 1, 4, '2025-05-09 16:45:00', 2000.00, 'cancelled', 'pending'),
(5, 1, 1, 1, 4, '2025-05-10 09:30:00', 2000.00, 'cancelled', 'paid'),
(6, 2, 1, 1, 4, '2025-05-16 14:30:00', 2000.00, 'cancelled', 'paid'),
(7, 2, 1, 1, 4, '2025-05-08 19:00:00', 2000.00, 'completed', 'paid'),
(8, 2, 1, 1, 4, '2025-05-11 15:30:00', 2000.00, 'cancelled', 'pending'),
(9, 2, 1, 1, 4, '2025-05-29 16:00:00', 2000.00, 'completed', 'paid'),
(10, 2, 1, 1, 4, '2025-05-12 11:00:00', 2000.00, 'completed', 'pending'),
(11, 2, 1, 1, 4, '2025-05-14 12:00:00', 2000.00, 'completed', 'paid'),
(12, 2, 1, 1, 4, '2025-05-14 14:30:00', 2000.00, 'cancelled', 'pending'),
(13, 2, 1, 1, 4, '2025-05-07 14:00:00', 2000.00, 'pending', 'paid'),
(14, 2, 1, 1, 4, '2025-05-08 14:30:00', 2000.00, 'cancelled', 'paid'),
(15, 2, 1, 1, 11, '2025-05-08 11:00:00', 2000.00, 'pending', 'paid'),
(16, 2, 1, 1, 11, '2025-05-14 14:00:00', 2000.00, 'cancelled', 'paid'),
(17, 2, 1, 1, 4, '2025-05-14 13:00:00', 2000.00, 'cancelled', 'pending'),
(18, 2, 1, 1, 4, '2025-06-12 12:30:00', 2000.00, 'completed', 'paid'),
(19, 2, 1, 1, 11, '2025-05-07 09:30:00', 2000.00, 'pending', 'paid'),
(20, 2, 1, 1, 11, '2025-05-09 12:30:00', 2000.00, 'cancelled', 'paid'),
(23, 8, 8, 1, 13, '2025-05-13 12:30:00', 10000.00, 'completed', 'paid'),
(24, 8, 1, 1, 4, '2025-05-13 12:00:00', 2000.00, 'pending', 'paid'),
(25, 8, 1, 1, 4, '2025-05-13 12:30:00', 2000.00, 'pending', 'paid'),
(26, 2, 6, 1, 11, '2025-05-28 15:30:00', 3000.00, 'cancelled', 'paid'),
(27, 9, 1, 1, 4, '2025-05-29 11:00:00', 2000.00, 'cancelled', 'paid'),
(28, 9, 1, 1, 4, '2025-05-29 12:30:00', 2000.00, 'completed', 'paid'),
(29, 10, 1, 1, 11, '2025-05-30 11:00:00', 2000.00, 'pending', 'paid'),
(30, 2, 1, 1, 4, '2025-05-29 11:00:00', 2000.00, 'cancelled', 'paid'),
(31, 2, 1, 1, 4, '2025-05-29 09:00:00', 2000.00, 'cancelled', 'paid'),
(32, 2, 6, 1, 11, '2025-05-30 13:00:00', 3000.00, 'cancelled', 'paid'),
(33, 2, 6, 1, 13, '2025-05-30 12:30:00', 3000.00, 'cancelled', 'paid'),
(34, 2, 8, 1, 11, '2025-05-30 15:30:00', 10000.00, 'cancelled', 'paid'),
(35, 2, 1, 1, 4, '2025-05-29 14:00:00', 2000.00, 'cancelled', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `status` varchar(20) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `address`, `city`, `phone`, `status`) VALUES
(1, 'Jhang Mor Bhakkar Branch', 'Near Jhang Mor Opposite Rescue Office Bhakkar', 'Bhakkar', '03000000002', 'active'),
(2, 'Darya Khan Branch', 'Near THQ Hospital Darya Khan', 'Bhakkar', '03000000003', 'active'),
(12, 'Muaaz Ali Branch', 'Mandi Town Bhakkar', 'Bhakkar', '03000000008', 'active'),
(14, 'Muslim Kot Branch', 'Muslim Kot', 'Bhakkar', '03000000000', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `experience` int(11) NOT NULL DEFAULT 0,
  `total_bookings` int(11) NOT NULL DEFAULT 0,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `full_name`, `gender`, `experience`, `total_bookings`, `branch_id`) VALUES
(4, 'Haji Mushtaq', 'Male', 4, 62, 1),
(11, 'ksn', 'Male', 2, 8, 1),
(13, 'ALi', 'Male', 3, 2, 1),
(14, 'Ahmad', 'Female', 2, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` enum('card','cash','online') NOT NULL,
  `status` enum('pending','completed','failed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `appointment_id`, `amount`, `payment_date`, `payment_method`, `status`) VALUES
(1, 2, 6, 2000.00, '2025-05-05 20:35:42', 'online', 'completed'),
(2, 2, 7, 2000.00, '2025-05-05 20:45:10', 'online', 'completed'),
(3, 2, 9, 2000.00, '2025-05-05 21:05:34', 'online', 'completed'),
(4, 2, 11, 2000.00, '2025-05-06 04:10:30', 'online', 'completed'),
(5, 2, 13, 2000.00, '2025-05-06 05:01:30', 'online', 'completed'),
(6, 2, 14, 2000.00, '2025-05-06 12:44:05', 'online', 'completed'),
(7, 2, 15, 2000.00, '2025-05-07 07:15:01', 'online', 'completed'),
(8, 2, 16, 2000.00, '2025-05-07 07:16:10', 'online', 'completed'),
(9, 2, 18, 2000.00, '2025-05-07 09:27:47', 'online', 'completed'),
(10, 2, 19, 2000.00, '2025-05-07 09:37:39', 'online', 'completed'),
(11, 2, 20, 2000.00, '2025-05-07 20:09:02', 'online', 'completed'),
(14, 8, 23, 10000.00, '2025-05-12 11:39:45', 'online', 'completed'),
(15, 8, 24, 2000.00, '2025-05-12 11:45:45', 'online', 'completed'),
(16, 8, 25, 2000.00, '2025-05-12 11:46:36', 'online', 'completed'),
(17, 2, 26, 3000.00, '2025-05-27 03:15:46', 'online', 'completed'),
(18, 9, 27, 2000.00, '2025-05-28 07:18:23', 'online', 'completed'),
(19, 9, 28, 2000.00, '2025-05-28 07:19:27', 'online', 'completed'),
(20, 10, 29, 2000.00, '2025-05-28 07:30:40', 'online', 'completed'),
(21, 2, 30, 2000.00, '2025-05-28 18:47:04', 'online', 'completed'),
(22, 2, 31, 2000.00, '2025-05-28 19:05:38', 'online', 'completed'),
(23, 2, 32, 3000.00, '2025-05-28 19:39:20', 'online', 'completed'),
(24, 2, 33, 3000.00, '2025-05-28 19:52:46', 'online', 'completed'),
(25, 2, 34, 10000.00, '2025-05-28 20:06:27', 'online', 'completed'),
(26, 2, 35, 2000.00, '2025-05-28 20:21:09', 'online', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `duration` int(11) NOT NULL DEFAULT 30,
  `price` decimal(10,2) NOT NULL,
  `peak_price` decimal(10,2) DEFAULT NULL,
  `offpeak_price` decimal(10,2) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT 0.00,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `branch_id`, `description`, `duration`, `price`, `peak_price`, `offpeak_price`, `discount`, `status`) VALUES
(1, 'Hair Cutting', 1, 'Hair cutting service involves professionally trimming and styling hair to suit the client\'s preferences, enhance appearance, and maintain healthy hair.', 30, 2000.00, 2500.00, 1500.00, 0.00, 'active'),
(6, 'Waxing', 1, 'Remove your Hair with Premium Wax.', 30, 3000.00, 3500.00, 2500.00, 0.00, 'active'),
(8, 'Massage', 1, 'Masage', 60, 10000.00, 12000.00, 9000.00, 0.00, 'active'),
(9, 'Hair Cutting', 2, 'Hair cutting', 30, 400.00, 500.00, 350.00, 0.00, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('super_admin','branch_admin','customer') DEFAULT 'customer',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `branch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `password`, `role`, `status`, `branch_id`, `created_at`) VALUES
(1, 'admin', 'admin@salon.com', '0000000000', '$2y$10$Ha6txvcISCK0sGwD1YYIwOgeXmIjMg.OZ0if2yvbq9ZVYNx4qss7W', 'super_admin', 'active', NULL, '2025-03-21 14:29:16'),
(2, 'Mubashir', 'mubashir@example.com', '03000000000', '$2y$10$tAZ/AiIPSnX8PfnQ2zSRHe/bojzEK818c/UFHb7mKbeG7zEitxv2m', 'customer', 'active', NULL, '2025-03-23 02:54:34'),
(7, 'Muhammad Ismaeel', 'ismaeel@example.com', '03000000006', '$2y$10$xrnn1CloA6BPZiBGnWhA9udQfYPmmjkzaITnk99.vg6glJHIcV412', 'customer', 'active', NULL, '2025-05-11 14:23:36'),
(8, 'Zain ALi', 'zainali@example.com', '0300000007', '$2y$10$c99/uX76ECeBKsvTW3WxmOHI5512Pxmbl1DuXbhpGR7wOVnpRa7ki', 'customer', 'active', NULL, '2025-05-12 11:30:41'),
(9, 'Hammad', 'sial@example.com', '0300000000', '$2y$10$JrKB9i.UCvcXOUO66gboK.PbLNIY9WU4GPFDqdqZIk/I/LN0icWha', 'customer', 'active', NULL, '2025-05-28 07:10:34'),
(10, 'Asad', 'asad@example.com', '0300000000', '$2y$10$EBGDavv9PPzGLZ/5Chk6tur5A4UnskJ7NWT074DiCDZZ0a97lNc9e', 'customer', 'active', NULL, '2025-05-28 07:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout_time` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `appointments_ibfk_4` (`employee_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `appointment_id` (`appointment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_ibfk_1` (`branch_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `appointments_ibfk_4` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
