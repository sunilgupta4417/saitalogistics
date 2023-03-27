-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2023 at 07:32 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logistics`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_name` varchar(255) DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `country_code`, `isActive`, `created_at`, `updated_at`) VALUES
(4, 'England', 'EN', 1, '2023-01-28 12:55:14', '2023-02-02 13:44:46'),
(6, 'South Africa', 'SA', 1, '2023-01-28 15:12:01', '2023-02-02 13:45:07'),
(7, 'VATICAN', 'VC', 1, '2023-01-28 15:12:55', '2023-01-28 15:12:55');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(15, '2023_01_28_073724_create_country_table', 2),
(17, '2023_01_28_153751_create_reason_table', 3),
(29, '2023_01_22_102952_create_vendor_masters_table', 4),
(30, '2023_01_22_103039_create_vendor_service_types_table', 5),
(31, '2023_01_22_103107_create_vendor_account_details_table', 6),
(32, '2023_01_22_103147_create_zone_masters_table', 7),
(33, '2023_01_22_102806_create_website_settings_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `reason`
--

CREATE TABLE `reason` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reason_code` varchar(255) DEFAULT NULL,
  `reason_text` varchar(255) DEFAULT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reason`
--

INSERT INTO `reason` (`id`, `reason_code`, `reason_text`, `isActive`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'RAC333', 'TEST 3333', 0, 1, '2023-01-28 14:22:21', '2023-01-28 15:05:34'),
(3, 'RAC 222', 'TEST 2', 1, 1, '2023-01-28 14:22:32', '2023-01-28 15:06:46'),
(4, 'RAC$555', '434555', 1, 1, '2023-01-28 14:43:29', '2023-01-28 15:06:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jatin', 'jatin@yopmail.com', NULL, '$2y$10$tcZpDiWDic2.52NvHTk.iOUzmDYkJV4mkky40YQVK07X46igP4h.K', NULL, '2023-01-28 05:10:06', '2023-01-28 05:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_account_details`
--

CREATE TABLE `vendor_account_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL DEFAULT 0 COMMENT 'vendor id',
  `token` varchar(255) DEFAULT NULL,
  `meter_no` varchar(255) DEFAULT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `account_no1` varchar(255) DEFAULT NULL,
  `environment` varchar(255) DEFAULT NULL,
  `isActive` varchar(255) NOT NULL DEFAULT '0' COMMENT '1=active, 0=inactive',
  `company_name` varchar(255) DEFAULT NULL,
  `gst_no` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `city_id` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `state_id` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address_3` varchar(255) DEFAULT NULL,
  `country_id` int(11) NOT NULL DEFAULT 0 COMMENT 'country id',
  `deleted_at` varchar(255) DEFAULT NULL COMMENT 'Delete date',
  `pickup_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_account_details`
--

INSERT INTO `vendor_account_details` (`id`, `vendor_id`, `token`, `meter_no`, `account_no`, `password`, `account_no1`, `environment`, `isActive`, `company_name`, `gst_no`, `pincode`, `contact_person`, `address_1`, `city_id`, `email_id`, `address_2`, `state_id`, `phone`, `address_3`, `country_id`, `deleted_at`, `pickup_address`, `created_at`, `updated_at`) VALUES
(1, 4, '2', '7895448', '364364', '123456', '5366', 'TEST', 'on', 'new york', '364645', '10001', 'new york', 'new york', 'new york', 'test@gmail.com', 'Texas Renaissance Festival, 21778 FM 1774, Todd Mission, TX 77363, USA', 'Texas', '7990782521', 'new york', 6, NULL, '1', '2023-02-02 14:47:34', '2023-02-03 14:36:16'),
(2, 1, '2', '7895448', '364364', '123456', '5366', 'TEST', 'on', 'new york', '364645', '10001', 'new york', 'new york', 'new york', 'test@gmail.com', 'Texas Renaissance Festival, 21778 FM 1774, Todd Mission, TX 77363, USA', 'Texas', '7990782521', 'new york', 6, '2023-02-03 16:56:11', '1', '2023-02-02 14:49:24', '2023-02-03 14:56:11'),
(3, 2, '2', '7895448', '364364', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', '5366', 'TEST', 'on', 'new york', '364645', '10001', 'new york', 'new york', 'new york', 'test@gmail.com', 'Texas Renaissance Festival, 21778 FM 1774, Todd Mission, TX 77363, USA', 'Texas', '7990782521', 'new york', 6, '2023-02-03 16:59:39', '1', '2023-02-02 14:58:45', '2023-02-03 14:59:39'),
(4, 4, '4', 'MET123', 'ACCUNT1201', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'ACCOUNT00222', 'LIVE', 'on', 'new york', 'GST', '10001', 'new york', 'new york', 'new york', 'test@gmail.com', '55, Music Concourse Drive, Golden Gate Park, San Francisco, San Francisco County, California, United States, 94118', 'California', '9510965177', 'new york', 6, NULL, '1', '2023-02-02 14:59:53', '2023-02-02 14:59:53'),
(5, 3, 'TOEKN-132456', '95109651477', '01010101010', '123456789', '2025412157124', 'LIVE', 'on', 'Jack Denial', '151FJHDBGJHD5', '3930001', 'Jacob', 'SMMKA', 'MANALO', 'manali@yopmail.com', 'MANALI', 'MP', '124515451524541', 'MAL', 7, NULL, '1', '2023-02-03 14:37:16', '2023-02-03 14:37:16');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_masters`
--

CREATE TABLE `vendor_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `vendor_code` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `gstin` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `city_id` varchar(255) DEFAULT NULL,
  `state_id` varchar(255) DEFAULT NULL,
  `country_id` varchar(255) DEFAULT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=active,0=inactive',
  `selfVendor` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=self vendor',
  `third_party_tracking` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=yes,0=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_masters`
--

INSERT INTO `vendor_masters` (`id`, `uuid`, `vendor_code`, `email`, `name`, `mobile_no`, `gstin`, `address1`, `address2`, `pincode`, `city_id`, `state_id`, `country_id`, `isActive`, `selfVendor`, `third_party_tracking`, `created_at`, `updated_at`) VALUES
(1, NULL, 'yrty', 'jatin@yopmail.com', 'ry', 'tyuuy', 'fdfdsr', 'iuyiyo', 'tytry', 'uytur', 'yturyu', 'iuodf', 'tyuyu7ii', 1, 1, 1, '2023-01-30 13:52:33', '2023-01-30 13:52:33'),
(2, NULL, NULL, 'test@gmail.com', 'new york', '7990782521', 'fgdg', 'new york', '5654', NULL, 'new york', 'new york', '6576', 1, 1, 1, '2023-01-30 14:02:53', '2023-01-30 14:02:53'),
(3, NULL, 'yrty', 'test@gmail.com', 'new york', '7990782521', 'GST IN', 'new york', 'ANK', '10001', 'new york', 'new york', 'INDIA', 1, 1, 1, '2023-01-30 14:15:34', '2023-01-30 14:15:34'),
(4, NULL, 'VEN 101', 'jatinpatel@yopmail.com', 'JATIN PATEL', '9510965177', '0147825003596595', 'ANJ', 'ANK 1', '393001', 'ANKLESHWAR', 'GUJ', '6', 1, 1, 1, '2023-01-30 14:23:13', '2023-01-30 14:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_service_types`
--

CREATE TABLE `vendor_service_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL DEFAULT 0 COMMENT 'vendor id',
  `forwarder` varchar(255) DEFAULT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `packagin_group` varchar(255) DEFAULT NULL,
  `mode` varchar(255) DEFAULT NULL,
  `isActive` tinyint(4) NOT NULL COMMENT '1=active,0=inactive',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `website_settings`
--

CREATE TABLE `website_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_key` varchar(255) DEFAULT NULL,
  `data_value` varchar(255) DEFAULT NULL,
  `data_extra1` varchar(255) DEFAULT NULL,
  `data_extra2` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `website_settings`
--

INSERT INTO `website_settings` (`id`, `data_key`, `data_value`, `data_extra1`, `data_extra2`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, '2023-02-04 04:16:50', '2023-02-04 04:16:50'),
(2, NULL, NULL, NULL, NULL, '2023-02-04 04:17:11', '2023-02-04 04:17:11'),
(3, 'company_code', 'CM1739', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(4, 'company_mobile_no', '9868404418', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(5, 'company_name', 'sattvic', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(6, 'company_email_id', 'sunildrishti@gmail.com', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(7, 'company_contact_person', 'Sunil MASTER', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(8, 'company_gstin', 'new york', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(9, 'company_pan', 'new york', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(10, 'company_address1', 'new york', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(11, 'company_website', 'Jatin One', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(12, 'company_address2', '55, Music Concourse Drive, Golden Gate Park, San Francisco, San Francisco County, California, United States, 94118', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(13, 'company_logo', 'user-06.jpg', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(14, 'company_pincode', '94118', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(15, 'company_country_id', 'United States', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(16, 'company_state_id', 'California', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(17, 'company_city_id', 'San Francisco', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(18, 'company_awb_start_from', 'Devid Miller', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(19, 'company_weight_unit', 'KGS', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(20, 'company_dashboard_img', 'user-06.jpg', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37'),
(21, 'company_bill_currency', 'CAD', NULL, NULL, '2023-02-04 04:20:48', '2023-02-04 04:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `zone_masters`
--

CREATE TABLE `zone_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL DEFAULT 0 COMMENT 'vendor master id',
  `service_name` varchar(255) DEFAULT NULL,
  `zone_name` varchar(255) DEFAULT NULL,
  `zone_type` varchar(255) DEFAULT NULL,
  `effctv_from` varchar(255) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zone_masters`
--

INSERT INTO `zone_masters` (`id`, `vendor_id`, `service_name`, `zone_name`, `zone_type`, `effctv_from`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'TEST aaaaaaaaaa', 'TEEST aaaa', 'Domestic', '02-02-2023', '2023-02-03 18:31:23', '2023-02-03 15:40:05', '2023-02-03 16:39:11'),
(2, 4, 'TEST 123', 'TEEST 3434', 'Domestic', '23-02-2023', NULL, '2023-02-03 15:41:09', '2023-02-03 15:41:09'),
(3, 2, 'TEST EDIZT', 'TEEST ee', 'Domestic', '02/22/2023 12:00 AM', NULL, '2023-02-03 16:35:20', '2023-02-03 16:35:20'),
(4, 4, 'Services', 'Zone Name', 'Domestic', '02/02/2023 12:00 AM', NULL, '2023-02-03 16:35:40', '2023-02-03 16:41:58'),
(5, 2, 'TEST', 'TEEST', 'International', '02-02-2023', '2023-02-03 18:42:09', '2023-02-03 16:35:50', '2023-02-03 16:42:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reason`
--
ALTER TABLE `reason`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendor_account_details`
--
ALTER TABLE `vendor_account_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_masters`
--
ALTER TABLE `vendor_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_service_types`
--
ALTER TABLE `vendor_service_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone_masters`
--
ALTER TABLE `zone_masters`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `reason`
--
ALTER TABLE `reason`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor_account_details`
--
ALTER TABLE `vendor_account_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vendor_masters`
--
ALTER TABLE `vendor_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendor_service_types`
--
ALTER TABLE `vendor_service_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `zone_masters`
--
ALTER TABLE `zone_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
