-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2026 at 12:17 PM
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
-- Database: `smart_emergency_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'System Admin', 'admin@gmail.com', '$2y$10$J3.1XBPMJRZBz2tyZzuyr.ah/Z9XRrN.V0GXaePGW4iggYwnQMcLe', '2026-09-13 06:34:24');

-- --------------------------------------------------------

--
-- Table structure for table `citizens`
--

CREATE TABLE `citizens` (
  `citizen_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citizens`
--

INSERT INTO `citizens` (`citizen_id`, `name`, `email`, `password`, `phone`, `address`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Rahim Ahmed', 'rahim@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCj5j0gk8V5h3xQ1hJm', '01700000001', 'Dhanmondi, Dhaka', 23.7465000, 90.3760000, 'Active', '2026-09-13 04:08:27', '2026-09-13 04:08:27'),
(2, 'Test Citizen', 'testcitizen@gmail.com', '$2y$10$T4CDOq8Rvj2MTog3qyMtXeSt1K6DGj1OfM2MMknNiHuPxFIF/IGHK', '01711111111', 'Dhaka', NULL, NULL, 'Active', '2026-09-13 04:32:50', '2026-09-13 04:32:50'),
(5, 'Test Citizen', 'testcitizen2@gmail.com', '$2y$10$g3hPXs3g07tzuPaZdU00VOMyWvzoKwC7HCZLdeIwmfsfd6zmrE33u', '01711111111', 'Dhaka', NULL, NULL, 'Active', '2026-09-13 04:36:18', '2026-09-13 04:36:18'),
(6, 'Citizen Local', 'citizen@gmail.com', '$2y$10$bsH16Su5cnMno6FcVe2bNeLaUKxxBnX5eGvABs1P.jG3irVaGNoia', '01814571678', 'Dhaka, Bangladesh', NULL, NULL, 'Active', '2026-09-13 05:26:05', '2026-09-13 05:26:05');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_requests`
--

CREATE TABLE `emergency_requests` (
  `request_id` int(10) UNSIGNED NOT NULL,
  `citizen_id` int(10) UNSIGNED NOT NULL,
  `provider_id` int(10) UNSIGNED DEFAULT NULL,
  `service_type` varchar(50) NOT NULL,
  `emergency_type` varchar(100) NOT NULL,
  `people_count` int(10) UNSIGNED DEFAULT 1,
  `vehicles_requested` int(10) UNSIGNED DEFAULT 1,
  `location` varchar(150) NOT NULL,
  `details` text DEFAULT NULL,
  `wheelchair_required` tinyint(1) DEFAULT 0,
  `wheelchair_count` int(10) UNSIGNED DEFAULT 0,
  `injury_present` tinyint(1) DEFAULT 0,
  `injury_level` enum('Minor','Moderate','Severe','Critical') DEFAULT NULL,
  `injury_description` text DEFAULT NULL,
  `status` enum('Pending','Accepted','On The Way','Completed','Rejected','Cancelled') DEFAULT 'Pending',
  `request_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `accepted_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_requests`
--

INSERT INTO `emergency_requests` (`request_id`, `citizen_id`, `provider_id`, `service_type`, `emergency_type`, `people_count`, `vehicles_requested`, `location`, `details`, `wheelchair_required`, `wheelchair_count`, `injury_present`, `injury_level`, `injury_description`, `status`, `request_time`, `accepted_at`, `completed_at`, `updated_at`, `latitude`, `longitude`) VALUES
(6, 6, 1, 'Ambulance', 'Accident', 4, 2, 'banani', 'Nothing', 1, 2, 0, '', '', 'Pending', '2026-09-13 09:53:43', NULL, NULL, '2026-09-13 09:53:43', 23.922131656135196, 90.45231105731082),
(7, 6, 2, 'Fire Service', 'Medical Emergency', 4, 3, 'Savar', 'Death', 1, 2, 0, '', '', 'Rejected', '2026-09-13 10:01:37', NULL, NULL, '2026-09-13 10:07:30', 23.922135293708543, 90.45230367325343),
(8, 6, 2, 'Fire Service', 'Fire', 4, 1, 'Khilkhet', 'Nothing serious', 1, 1, 0, '', '', 'Completed', '2026-09-13 10:06:19', '2026-09-13 16:07:28', '2026-09-13 16:07:31', '2026-09-13 10:07:31', 23.922135293708543, 90.45230367325343);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `receiver` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(20) DEFAULT 'Unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `organization_id` int(10) UNSIGNED NOT NULL,
  `organization_name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`organization_id`, `organization_name`, `email`, `password`, `phone`, `address`, `status`, `created_at`) VALUES
(1, 'Emergency Help Organization', 'organization@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCj5j0gk8V5h3xQ1hJm', '01700000005', 'Dhaka', 'Approved', '2026-09-13 04:08:27'),
(2, 'Emergency Care Organization', 'organizer@gmail.com', '$2y$10$IhZKQMVYBV7yxrCgYBoFAOYclZsUSO8yEBi7ml0uOcHUYNErtYEjW', '01811111188', 'Uttara, Dhaka', 'Pending', '2026-09-13 04:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `organization_donations`
--

CREATE TABLE `organization_donations` (
  `donation_id` int(10) UNSIGNED NOT NULL,
  `organization_id` int(10) UNSIGNED NOT NULL,
  `donor_name` varchar(150) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `received_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Received') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organization_donations`
--

INSERT INTO `organization_donations` (`donation_id`, `organization_id`, `donor_name`, `amount`, `purpose`, `received_at`, `status`) VALUES
(1, 2, 'Antor singh', 10000.00, 'Donate', '2026-09-11 18:00:00', 'Received');

-- --------------------------------------------------------

--
-- Table structure for table `organization_providers`
--

CREATE TABLE `organization_providers` (
  `organization_provider_id` int(10) UNSIGNED NOT NULL,
  `organization_id` int(10) UNSIGNED NOT NULL,
  `provider_name` varchar(150) NOT NULL,
  `provider_email` varchar(100) DEFAULT NULL,
  `provider_contact` varchar(20) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `provider_type` varchar(100) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organization_providers`
--

INSERT INTO `organization_providers` (`organization_provider_id`, `organization_id`, `provider_name`, `provider_email`, `provider_contact`, `username`, `password`, `provider_type`, `status`) VALUES
(1, 2, 'ABC Ambulance Service', 'provider9@gmail.com', '01700000000', 'Ankon Mia', '$2y$10$MTA1X14urnoBBgzXqj7hceNWgl0m2weTsqzxD3UwwiY0y9S53YUx2', 'Ambulance', '');

-- --------------------------------------------------------

--
-- Table structure for table `organization_reviews`
--

CREATE TABLE `organization_reviews` (
  `review_id` int(10) UNSIGNED NOT NULL,
  `organization_id` int(10) UNSIGNED NOT NULL,
  `provider_id` int(10) UNSIGNED DEFAULT NULL,
  `citizen_id` int(10) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_services`
--

CREATE TABLE `organization_services` (
  `service_id` int(10) UNSIGNED NOT NULL,
  `organization_id` int(10) UNSIGNED NOT NULL,
  `service_name` varchar(150) NOT NULL,
  `service_type` varchar(100) DEFAULT NULL,
  `hotline` varchar(20) DEFAULT NULL,
  `coverage_area` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organization_services`
--

INSERT INTO `organization_services` (`service_id`, `organization_id`, `service_name`, `service_type`, `hotline`, `coverage_area`) VALUES
(1, 2, 'Emergency Ambulance', 'Ambulance', '999', 'Dhaka City');

-- --------------------------------------------------------

--
-- Table structure for table `provider_availability`
--

CREATE TABLE `provider_availability` (
  `availability_id` int(10) UNSIGNED NOT NULL,
  `provider_id` int(10) UNSIGNED NOT NULL,
  `availability_status` enum('Available','Busy','Offline') DEFAULT 'Offline',
  `working_from` time DEFAULT NULL,
  `working_to` time DEFAULT NULL,
  `is_24_hours` tinyint(1) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_areas`
--

CREATE TABLE `service_areas` (
  `area_id` int(10) UNSIGNED NOT NULL,
  `provider_id` int(10) UNSIGNED NOT NULL,
  `base_area` varchar(150) NOT NULL,
  `service_range_km` int(10) UNSIGNED NOT NULL,
  `covered_areas` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_providers`
--

CREATE TABLE `service_providers` (
  `provider_id` int(10) UNSIGNED NOT NULL,
  `provider_name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `service_type` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `status` enum('Pending','Verified','Rejected','Inactive') DEFAULT 'Pending',
  `availability_status` enum('Available','Busy','Offline') DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `service_range` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_providers`
--

INSERT INTO `service_providers` (`provider_id`, `provider_name`, `email`, `password`, `service_type`, `phone`, `address`, `latitude`, `longitude`, `status`, `availability_status`, `created_at`, `updated_at`, `service_range`) VALUES
(1, 'emergency provider', 'provider@gmail.com', '$2y$10$kwcDeJY1Cisb4CIK/6kcW.gITE03hmkYhBJv1.Vn3vbM1mdT13Ide', 'Ambulance', '01707144666', 'Uttara, Dhaka', 23.81030000, 90.41250000, 'Verified', 'Available', '2026-09-13 09:47:06', '2026-09-13 09:50:54', 50),
(2, 'Emergency Provider2', 'provider2@gmail.com', '$2y$10$RAEXYy7uXvIIQf9nrnHvsu1hCO2RYSAPWTzmSGISYKxOhNHSLukDm', 'Fire Service', '01707144667', 'Banani', 23.81030000, 90.41250000, 'Verified', 'Available', '2026-09-13 09:57:30', '2026-09-13 10:07:31', 50),
(3, 'Dhaka Police Emergency', 'provider3@gmail.com', '$2y$10$Bwo03DGDkKgbNScFzhvG7e.xHJfHkEnijod/jjae6BLboK5BCvpsi', 'Police', '01707144668', 'Kuril Bissoroad', 23.81030000, 90.41250000, 'Verified', 'Available', '2026-09-13 10:10:06', '2026-09-13 10:13:58', 50),
(4, 'City Emergency Hospital', 'provider4@gmail.com', '$2y$10$88vYH6Acoey26LN4pT4k7uXwpizk4UNh1QGyqFACCPYN66CRYcF6C', 'Hospital', '01707144669', 'Farrmgate', 23.81030000, 90.41250000, 'Verified', 'Available', '2026-09-13 10:11:36', '2026-09-13 10:13:58', 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `citizens`
--
ALTER TABLE `citizens`
  ADD PRIMARY KEY (`citizen_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `emergency_requests`
--
ALTER TABLE `emergency_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `citizen_id` (`citizen_id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`organization_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `organization_donations`
--
ALTER TABLE `organization_donations`
  ADD PRIMARY KEY (`donation_id`),
  ADD KEY `organization_id` (`organization_id`);

--
-- Indexes for table `organization_providers`
--
ALTER TABLE `organization_providers`
  ADD PRIMARY KEY (`organization_provider_id`),
  ADD KEY `organization_id` (`organization_id`);

--
-- Indexes for table `organization_reviews`
--
ALTER TABLE `organization_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_review_organization` (`organization_id`),
  ADD KEY `fk_review_citizen` (`citizen_id`),
  ADD KEY `fk_review_provider` (`provider_id`);

--
-- Indexes for table `organization_services`
--
ALTER TABLE `organization_services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `organization_id` (`organization_id`);

--
-- Indexes for table `provider_availability`
--
ALTER TABLE `provider_availability`
  ADD PRIMARY KEY (`availability_id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `service_areas`
--
ALTER TABLE `service_areas`
  ADD PRIMARY KEY (`area_id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `service_providers`
--
ALTER TABLE `service_providers`
  ADD PRIMARY KEY (`provider_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `citizens`
--
ALTER TABLE `citizens`
  MODIFY `citizen_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `emergency_requests`
--
ALTER TABLE `emergency_requests`
  MODIFY `request_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `organization_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `organization_donations`
--
ALTER TABLE `organization_donations`
  MODIFY `donation_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `organization_providers`
--
ALTER TABLE `organization_providers`
  MODIFY `organization_provider_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `organization_reviews`
--
ALTER TABLE `organization_reviews`
  MODIFY `review_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organization_services`
--
ALTER TABLE `organization_services`
  MODIFY `service_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `provider_availability`
--
ALTER TABLE `provider_availability`
  MODIFY `availability_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_areas`
--
ALTER TABLE `service_areas`
  MODIFY `area_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_providers`
--
ALTER TABLE `service_providers`
  MODIFY `provider_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emergency_requests`
--
ALTER TABLE `emergency_requests`
  ADD CONSTRAINT `emergency_requests_ibfk_1` FOREIGN KEY (`citizen_id`) REFERENCES `citizens` (`citizen_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emergency_requests_ibfk_2` FOREIGN KEY (`provider_id`) REFERENCES `service_providers` (`provider_id`) ON DELETE SET NULL;

--
-- Constraints for table `organization_donations`
--
ALTER TABLE `organization_donations`
  ADD CONSTRAINT `organization_donations_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`organization_id`) ON DELETE CASCADE;

--
-- Constraints for table `organization_providers`
--
ALTER TABLE `organization_providers`
  ADD CONSTRAINT `organization_providers_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`organization_id`) ON DELETE CASCADE;

--
-- Constraints for table `organization_reviews`
--
ALTER TABLE `organization_reviews`
  ADD CONSTRAINT `fk_review_citizen` FOREIGN KEY (`citizen_id`) REFERENCES `citizens` (`citizen_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_review_organization` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`organization_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_review_provider` FOREIGN KEY (`provider_id`) REFERENCES `organization_providers` (`organization_provider_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `organization_services`
--
ALTER TABLE `organization_services`
  ADD CONSTRAINT `organization_services_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`organization_id`) ON DELETE CASCADE;

--
-- Constraints for table `provider_availability`
--
ALTER TABLE `provider_availability`
  ADD CONSTRAINT `provider_availability_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `service_providers` (`provider_id`) ON DELETE CASCADE;

--
-- Constraints for table `service_areas`
--
ALTER TABLE `service_areas`
  ADD CONSTRAINT `service_areas_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `service_providers` (`provider_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
