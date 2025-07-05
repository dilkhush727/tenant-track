-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2025 at 01:02 AM
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
-- Database: `tenanttrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(9) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `target_role` enum('all','tenant','landlord') NOT NULL DEFAULT 'all',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `message`, `target_role`, `created_at`) VALUES
(1, 'Announcement 1', 'This is Announcement 1', 'all', '2025-06-26 21:28:11'),
(2, 'Announcement 2', 'This is Announcement 2', 'landlord', '2025-06-26 21:28:44'),
(3, 'Announcement 3', 'This is Announcement 3', 'tenant', '2025-06-26 21:34:05'),
(4, 'Announcement 4', 'This is Announcement 4', 'landlord', '2025-06-26 21:34:25'),
(5, 'gdgf', 'dggdfgdg', 'all', '2025-06-29 10:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `leases`
--

CREATE TABLE `leases` (
  `id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `monthly_rent` decimal(10,2) NOT NULL,
  `agreement_file` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leases`
--

INSERT INTO `leases` (`id`, `tenant_id`, `property_id`, `start_date`, `end_date`, `monthly_rent`, `agreement_file`, `created_at`) VALUES
(1, 2, 3, '2024-01-01', '2025-12-31', 12002.00, '1750379754_78eceb885a1956250682.pdf', '2025-06-16 13:39:31'),
(2, 2, 3, '2025-07-01', '2025-12-31', 1200.00, NULL, '2025-06-16 22:06:44'),
(3, 2, 1, '2025-06-17', '2025-06-30', 1000.00, NULL, '2025-06-16 22:07:09'),
(4, 2, 3, '2025-06-11', '2025-07-03', 2122.00, NULL, '2025-06-16 22:16:30'),
(5, 2, 3, '2025-06-17', '2025-06-26', 2222.00, NULL, '2025-06-16 22:24:54'),
(6, 2, 1, '2025-06-19', '2025-06-21', 1200.00, '1750378853_7bdb74a6e792c30f8c99.pdf', '2025-06-20 00:20:53'),
(7, 2, 3, '2025-06-25', '2025-06-27', 1000.00, '1750379121_d3d6fb704f09eae59127.pdf', '2025-06-20 00:25:21'),
(8, 2, 3, '2025-06-24', '2025-07-10', 2122.00, '1751183422_4743698396d628fce0d2.pdf', '2025-06-29 07:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_requests`
--

CREATE TABLE `maintenance_requests` (
  `id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `issue_type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` enum('submitted','in_progress','resolved') NOT NULL DEFAULT 'submitted',
  `feedback` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `submitted_at` datetime NOT NULL,
  `resolved_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance_requests`
--

INSERT INTO `maintenance_requests` (`id`, `tenant_id`, `property_id`, `issue_type`, `description`, `status`, `feedback`, `image`, `submitted_at`, `resolved_at`) VALUES
(3, 2, 1, 'dsdsd', 'vcvxv', 'in_progress', 'OKOKOK', NULL, '2025-06-16 17:29:06', NULL),
(4, 2, 1, 'Electrical', 'Short Circuit', 'resolved', NULL, NULL, '2025-06-16 17:40:48', '2025-06-29 08:55:46'),
(5, 2, 1, 'Appliance', 'NA', 'submitted', NULL, NULL, '2025-06-16 21:30:34', NULL),
(6, 2, 1, 'Heating', 'Heat', 'in_progress', NULL, '1750377858_315c8c9b2d593ba10940.jpg', '2025-06-20 00:04:18', NULL),
(7, 2, 3, 'Appliance', 'hgghtyht', 'submitted', NULL, '1751175612_78d3c32f768ca57b49d7.jpg', '2025-06-29 05:40:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `message_type` varchar(100) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-06-15-153032', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1750001608, 1),
(2, '2025-06-15-153141', 'App\\Database\\Migrations\\CreatePropertiesTable', 'default', 'App', 1750001608, 1),
(3, '2025-06-15-153202', 'App\\Database\\Migrations\\CreateLeasesTable', 'default', 'App', 1750001608, 1),
(4, '2025-06-15-153230', 'App\\Database\\Migrations\\CreatePaymentsTable', 'default', 'App', 1750001609, 1),
(5, '2025-06-15-153249', 'App\\Database\\Migrations\\CreateMaintenanceRequestsTable', 'default', 'App', 1750001609, 1),
(6, '2025-06-15-153308', 'App\\Database\\Migrations\\CreateMessagesTable', 'default', 'App', 1750001609, 1),
(7, '2025-06-19-225839', 'App\\Database\\Migrations\\AddFeedbackToMaintenanceRequests', 'default', 'App', 1750373966, 2),
(8, '2025-06-19-235637', 'App\\Database\\Migrations\\AddImageToMaintenanceRequests', 'default', 'App', 1750377440, 3),
(9, '2025-06-26-184447', 'App\\Database\\Migrations\\CreateAnnouncementsTable', 'default', 'App', 1750963522, 4),
(10, '2025-06-26-230607', 'App\\Database\\Migrations\\CreateMessagesTable', 'default', 'App', 1750979484, 5),
(11, '2025-06-29-182712', 'App\\Database\\Migrations\\AddEmailVerificationFieldsToUsers', 'default', 'App', 1751221657, 6);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `lease_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date_paid` date NOT NULL,
  `method` varchar(50) NOT NULL,
  `status` enum('paid','failed','pending') NOT NULL DEFAULT 'pending',
  `receipt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `lease_id`, `amount`, `date_paid`, `method`, `status`, `receipt`) VALUES
(1, 3, 1000.00, '2025-06-16', 'Interac', 'paid', '1751185589_3c22546696df82cda65f.pdf'),
(2, 2, 1100.00, '2025-06-16', 'Interac', 'paid', '1750540237_17461353aa2e6e00fe92.pdf'),
(3, 1, 1000.00, '2025-06-26', 'Interac', 'paid', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `landlord_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT 1,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `landlord_id`, `address`, `type`, `availability`, `description`, `image`, `created_at`) VALUES
(1, 1, '124 Main St', 'House', 1, 'Test property 2', '', '2025-06-16 13:28:56'),
(3, 1, '16 Bonnycastle St', 'Apartment', 1, 'Monde Apartment- Toronto', NULL, '2025-06-16 21:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('tenant','landlord','admin') NOT NULL,
  `status` enum('pending','active','disabled') NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT 0,
  `verification_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`, `created_at`, `updated_at`, `email_verified`, `verification_token`) VALUES
(1, 'Dilkhush Landlord', 'dilkhushyadav2@gmail.com', '$2y$10$tlD7/oClC0SBEGtswHsXselxHeLgBOXoXOQgLRCowuBwL2RHEmVqy', 'landlord', 'active', '2025-06-15 19:06:29', '2025-06-29 10:24:31', 0, NULL),
(2, 'Dilkhush', 'dilkhush727@gmail.com', '$2y$10$tlD7/oClC0SBEGtswHsXselxHeLgBOXoXOQgLRCowuBwL2RHEmVqy', 'tenant', 'active', '2025-06-16 02:54:34', '2025-06-29 10:13:46', 0, NULL),
(3, 'Super Admin', 'admin@tenanttrack.com', '$2y$10$iFEDBdxCfOfYSJVX8ATl/eE5xYnwKetD0bz0qJxjbpC3I7TW9J6cW', 'admin', 'active', '2025-06-16 03:21:41', '2025-06-29 10:08:03', 0, NULL),
(15, 'Dilkhush', 'dilkhushyadav@gmail.com', '$2y$10$aDvNzYi4fDQGXUpqOeCtFObrOmaeDbKgd.QTC0tJzGJPpx6bQxkOC', 'tenant', 'active', '2025-06-29 19:12:34', '2025-06-29 19:12:34', 0, '1b5992cc5ffa3090e7deec8b7fe6fab46cef57af98b85a9d8be7baff9c59f8da');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leases`
--
ALTER TABLE `leases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leases_tenant_id_foreign` (`tenant_id`),
  ADD KEY `leases_property_id_foreign` (`property_id`);

--
-- Indexes for table `maintenance_requests`
--
ALTER TABLE `maintenance_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenance_requests_tenant_id_foreign` (`tenant_id`),
  ADD KEY `maintenance_requests_property_id_foreign` (`property_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_lease_id_foreign` (`lease_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `properties_landlord_id_foreign` (`landlord_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leases`
--
ALTER TABLE `leases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `maintenance_requests`
--
ALTER TABLE `maintenance_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leases`
--
ALTER TABLE `leases`
  ADD CONSTRAINT `leases_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leases_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenance_requests`
--
ALTER TABLE `maintenance_requests`
  ADD CONSTRAINT `maintenance_requests_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maintenance_requests_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_lease_id_foreign` FOREIGN KEY (`lease_id`) REFERENCES `leases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_landlord_id_foreign` FOREIGN KEY (`landlord_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
