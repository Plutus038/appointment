-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 03, 2017 at 02:43 PM
-- Server version: 5.6.34
-- PHP Version: 5.6.28-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `appointment`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('F','M') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'F-Female, M-Male',
  `available_start_time` timestamp NULL DEFAULT NULL,
  `available_end_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `doctors_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `uuid`, `name`, `email`, `department`, `gender`, `available_start_time`, `available_end_time`, `created_at`, `updated_at`) VALUES
(1, '9b9bc657-de6d-4000-ab2b-bb879f744e98', 'Vimala', 'Vimala.a@gmail.com', 'Dentist', 'F', '2017-05-22 14:32:42', '2017-05-22 14:32:42', '2017-07-03 02:18:35', '2017-07-03 02:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_06_23_091622_create_doctor_table', 1),
(4, '2017_06_23_094644_create_patient_appointment_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_appointments`
--

CREATE TABLE IF NOT EXISTS `patient_appointments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doctor_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `age` mediumint(9) DEFAULT NULL,
  `gender` enum('F','M') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'F-Female, M-Male',
  `appointment_time` timestamp NULL DEFAULT NULL,
  `status` enum('REQUEST','ACCEPTED','CANCELLED') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_appointments_doctor_id_foreign` (`doctor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `patient_appointments`
--

INSERT INTO `patient_appointments` (`id`, `uuid`, `doctor_id`, `name`, `reason`, `age`, `gender`, `appointment_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ffe877de-8530-4b57-96ec-8f94ff440e4c', 1, 'Guru', 'Head ache', 21, 'F', '2017-07-27 18:08:01', 'CANCELLED', '2017-07-03 02:30:50', '2017-07-03 03:40:27'),
(2, '270bc856-0bc8-4a15-b58e-9b357ae449c7', 1, 'Darfan', 'stomach pain', 21, 'F', '2017-07-27 18:08:01', 'ACCEPTED', '2017-07-03 03:37:29', '2017-07-03 03:40:27'),
(3, 'c280c99c-d849-4c65-814c-6ad15812bbf8', 1, 'jancy', 'stomach pain', 21, 'F', '2017-07-27 18:08:01', 'CANCELLED', '2017-07-03 03:37:39', '2017-07-03 03:40:27'),
(4, 'ca8a0a93-eb13-48e2-80e0-16f7e51dae4b', 1, 'jenifer', 'stomach pain', 21, 'F', '2017-07-27 18:08:01', 'CANCELLED', '2017-07-03 03:38:03', '2017-07-03 03:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient_appointments`
--
ALTER TABLE `patient_appointments`
  ADD CONSTRAINT `patient_appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
