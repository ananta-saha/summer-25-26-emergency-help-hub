-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2026 at 07:44 AM
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
-- Table structure for table `citizens`
--

CREATE TABLE `citizens` (
  `citizen_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citizens`
--

INSERT INTO `citizens` (`citizen_id`, `name`, `email`, `password`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Rahim Ahmed', 'rahim@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCj5j0gk8V5h3xQ1hJm', '01700000001', 'Dhanmondi, Dhaka', 'Active', '2026-09-10 05:43:44', '2026-09-10 05:43:44');

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
  `people_count` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `vehicles_requested` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `location` varchar(150) NOT NULL,
  `details` text DEFAULT NULL,
  `wheelchair_required` tinyint(1) NOT NULL DEFAULT 0,
  `wheelchair_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `injury_present` tinyint(1) NOT NULL DEFAULT 0,
  `injury_level` enum('Minor','Moderate','Severe','Critical') DEFAULT NULL,
  `injury_description` text DEFAULT NULL,
  `status` enum('Pending','Accepted','On The Way','Completed','Rejected','Cancelled') NOT NULL DEFAULT 'Pending',
  `request_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provider_availability`
--

CREATE TABLE `provider_availability` (
  `availability_id` int(10) UNSIGNED NOT NULL,
  `provider_id` int(10) UNSIGNED NOT NULL,
  `availability_status` enum('Available','Busy','Offline') NOT NULL DEFAULT 'Offline',
  `working_from` time DEFAULT NULL,
  `working_to` time DEFAULT NULL,
  `is_24_hours` tinyint(1) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provider_availability`
--

INSERT INTO `provider_availability` (`availability_id`, `provider_id`, `availability_status`, `working_from`, `working_to`, `is_24_hours`, `updated_at`) VALUES
(1, 1, 'Available', '00:00:00', '23:59:59', 1, '2026-09-10 05:43:45');

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

--
-- Dumping data for table `service_areas`
--

INSERT INTO `service_areas` (`area_id`, `provider_id`, `base_area`, `service_range_km`, `covered_areas`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dhanmondi', 10, 'Dhanmondi, Kalabagan, Mohammadpur, Farmgate', '2026-09-10 05:43:45', '2026-09-10 05:43:45');

-- --------------------------------------------------------

--
-- Table structure for table `service_providers`
--

CREATE TABLE `service_providers` (
  `provider_id` int(10) UNSIGNED NOT NULL,
  `provider_name` varchar(150) NOT NULL,
  `service_type` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `status` enum('Pending','Verified','Rejected','Inactive') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_providers`
--

INSERT INTO `service_providers` (`provider_id`, `provider_name`, `service_type`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ABC Ambulance Service', 'Ambulance', '01700000004', 'Dhanmondi, Dhaka', 'Verified', '2026-09-10 05:43:45', '2026-09-10 05:43:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `citizens`
--
ALTER TABLE `citizens`
  ADD PRIMARY KEY (`citizen_id`),
  ADD UNIQUE KEY `unique_citizen_email` (`email`);

--
-- Indexes for table `emergency_requests`
--
ALTER TABLE `emergency_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `idx_request_citizen` (`citizen_id`),
  ADD KEY `idx_request_provider` (`provider_id`);

--
-- Indexes for table `provider_availability`
--
ALTER TABLE `provider_availability`
  ADD PRIMARY KEY (`availability_id`),
  ADD UNIQUE KEY `unique_provider_availability` (`provider_id`);

--
-- Indexes for table `service_areas`
--
ALTER TABLE `service_areas`
  ADD PRIMARY KEY (`area_id`),
  ADD UNIQUE KEY `unique_provider_area` (`provider_id`);

--
-- Indexes for table `service_providers`
--
ALTER TABLE `service_providers`
  ADD PRIMARY KEY (`provider_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `citizens`
--
ALTER TABLE `citizens`
  MODIFY `citizen_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emergency_requests`
--
ALTER TABLE `emergency_requests`
  MODIFY `request_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provider_availability`
--
ALTER TABLE `provider_availability`
  MODIFY `availability_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_areas`
--
ALTER TABLE `service_areas`
  MODIFY `area_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_providers`
--
ALTER TABLE `service_providers`
  MODIFY `provider_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emergency_requests`
--
ALTER TABLE `emergency_requests`
  ADD CONSTRAINT `fk_request_citizen` FOREIGN KEY (`citizen_id`) REFERENCES `citizens` (`citizen_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_request_provider` FOREIGN KEY (`provider_id`) REFERENCES `service_providers` (`provider_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `provider_availability`
--
ALTER TABLE `provider_availability`
  ADD CONSTRAINT `fk_availability_provider` FOREIGN KEY (`provider_id`) REFERENCES `service_providers` (`provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_areas`
--
ALTER TABLE `service_areas`
  ADD CONSTRAINT `fk_area_provider` FOREIGN KEY (`provider_id`) REFERENCES `service_providers` (`provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- ============================================
-- ORGANIZATION TABLE
-- ============================================

CREATE TABLE IF NOT EXISTS organizations (
    organization_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    organization_name VARCHAR(150) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT DEFAULT NULL,
    status ENUM('Active', 'Inactive') NOT NULL DEFAULT 'Active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
);


-- ============================================
-- ORGANIZATION EMERGENCY SERVICES
-- ============================================

CREATE TABLE IF NOT EXISTS organization_services (
    service_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    organization_id INT UNSIGNED NOT NULL,
    service_name VARCHAR(150) NOT NULL,
    service_type VARCHAR(50) NOT NULL,
    hotline VARCHAR(30) NOT NULL,
    coverage_area VARCHAR(150) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_org_service_organization
        FOREIGN KEY (organization_id)
        REFERENCES organizations(organization_id)
        ON DELETE CASCADE
);


-- ============================================
-- ORGANIZATION PROVIDERS
-- ============================================

CREATE TABLE IF NOT EXISTS organization_providers (
    organization_provider_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    organization_id INT UNSIGNED NOT NULL,

    provider_name VARCHAR(150) NOT NULL,
    provider_email VARCHAR(100) NOT NULL,
    provider_contact VARCHAR(20) NOT NULL,

    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,

    provider_type VARCHAR(50) NOT NULL,

    status ENUM('Active', 'Inactive')
        NOT NULL DEFAULT 'Active',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_org_provider_organization
        FOREIGN KEY (organization_id)
        REFERENCES organizations(organization_id)
        ON DELETE CASCADE
);


-- ============================================
-- ORGANIZATION FUND / DONATION
-- ============================================

CREATE TABLE IF NOT EXISTS organization_donations (
    donation_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    organization_id INT UNSIGNED NOT NULL,

    donor_name VARCHAR(150) NOT NULL,

    amount DECIMAL(12,2) NOT NULL,

    purpose VARCHAR(255) NOT NULL,

    received_at DATE NOT NULL,

    status ENUM('Received', 'Allocated')
        NOT NULL DEFAULT 'Received',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_org_donation_organization
        FOREIGN KEY (organization_id)
        REFERENCES organizations(organization_id)
        ON DELETE CASCADE
);
INSERT INTO organizations
(
    organization_name,
    email,
    password,
    phone,
    address,
    status
)
VALUES
(
    'Emergency Help Organization',
    'organization@gmail.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCj5j0gk8V5h3xQ1hJm',
    '01700000010',
    'Dhaka, Bangladesh',
    'Active'
);