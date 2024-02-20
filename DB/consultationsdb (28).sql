-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 20, 2024 at 05:58 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `consultationsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `record` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `answer_reject_reason` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer_state` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selectedservice_id` bigint UNSIGNED DEFAULT NULL,
  `updateuser_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `record`, `content`, `answer_reject_reason`, `answer_state`, `selectedservice_id`, `updateuser_id`, `created_at`, `updated_at`) VALUES
(1, 'rec.mp3', 'بحاجة الى جلسات', NULL, 'wait', 33, NULL, '2024-01-18 20:06:28', NULL),
(2, 'sdsd.mp3', 'casvasc', NULL, 'wait', 33, NULL, '2024-01-18 20:06:28', NULL),
(3, 'sdsd.mp3', 'laaassttt', NULL, 'wait', 34, NULL, '2024-02-18 20:06:28', NULL),
(4, 'sdsd.mp3', 'casvasc', NULL, 'reject', 34, NULL, '2024-01-18 20:06:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cashtransfers`
--

DROP TABLE IF EXISTS `cashtransfers`;
CREATE TABLE IF NOT EXISTS `cashtransfers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `cash` decimal(8,2) DEFAULT NULL,
  `cashtype` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fromtype` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totype` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` bigint UNSIGNED DEFAULT NULL,
  `expert_id` bigint UNSIGNED DEFAULT NULL,
  `pointtransfer_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` datetime DEFAULT NULL,
  `gender` int DEFAULT NULL,
  `marital_status` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` text COLLATE utf8mb4_unicode_ci,
  `points_balance` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updateuser_id` bigint UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_mobile_unique` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `user_name`, `password`, `mobile`, `email`, `nationality`, `birthdate`, `gender`, `marital_status`, `image`, `token`, `points_balance`, `created_at`, `updated_at`, `updateuser_id`, `is_active`) VALUES
(10, 'احمد', NULL, '0533494872', 'dfc@uy.com', 'syr', '2000-01-20 00:00:00', 1, 'single', '5947810.webp', NULL, 16400, '2024-01-18 20:06:28', '2024-02-07 14:21:33', NULL, 1),
(12, 'احمد2', NULL, '0533494777', 'dfc@uy.com', 'syr', '2005-01-05 00:00:00', 1, 'single', '8576212.webp', NULL, 0, '2024-01-18 20:27:48', '2024-01-18 20:27:48', NULL, 1),
(13, 'احمد3', NULL, '0533497777', 'dfc@uy.com', 'syr', '2005-05-01 00:00:00', 1, 'single', '9227313.webp', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luY2xpZW50IiwiaWF0IjoxNzA3NDA3MTU3LCJuYmYiOjE3MDc0MDcxNTcsImp0aSI6IkZvUFZYMllrT2VqMHJ1TjkiLCJzdWIiOiIxMyIsInBydiI6IjQxZWZiN2JhZDdmNmY2MzJlMjQwNWJkM2E3OTNiOGE2YmRlYzY3NzcifQ.rWvpuHg5-DBfWxrubaCDIUXlBgOJcRfyhqHhZZpliXA', 0, '2024-01-18 20:29:12', '2024-02-08 13:45:57', NULL, 1),
(14, 'raghad', NULL, '021458700000', 'ra@email.com', 'syria', '2000-05-18 00:00:00', 2, 'single', '9782114.webp', NULL, 0, '2024-02-01 07:12:20', '2024-02-01 07:12:21', NULL, 1),
(15, 'tesyyyt', NULL, '213777777777', 'hhel@hh.lo', 'الجزائر', '2024-02-16 00:00:00', 2, NULL, '7137915.webp', NULL, 0, '2024-02-15 22:08:38', '2024-02-15 22:08:38', NULL, 1),
(16, 'dina test', NULL, '213111111111', 'dina@gmail.com', 'الجزائر', '2024-01-01 00:00:00', 2, 'Married', '8632416.webp', NULL, 0, '2024-02-16 17:31:55', '2024-02-16 17:31:55', NULL, 1),
(17, 'ahmadd', NULL, '213944917252', 'abc@xyz.com', 'سوريا', '2000-10-20 00:00:00', 1, 'married', '4385517.webp', NULL, 0, '2024-02-17 12:09:04', '2024-02-19 13:59:22', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `point_balance` decimal(8,2) DEFAULT '0.00',
  `point_profit` decimal(8,2) DEFAULT '0.00',
  `cash_balance` decimal(8,2) DEFAULT '0.00',
  `cash_profit` decimal(8,2) DEFAULT '0.00',
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `point_balance`, `point_profit`, `cash_balance`, `cash_profit`, `notes`, `created_at`, `updated_at`) VALUES
(1, '0.00', '0.00', '0.00', '0.00', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `experts`
--

DROP TABLE IF EXISTS `experts`;
CREATE TABLE IF NOT EXISTS `experts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` datetime DEFAULT NULL,
  `gender` int DEFAULT NULL,
  `marital_status` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `points_balance` int DEFAULT '0',
  `cash_balance` decimal(8,2) DEFAULT '0.00',
  `cash_balance_todate` decimal(8,2) DEFAULT '0.00',
  `rates` decimal(8,2) DEFAULT '0.00',
  `desc` text COLLATE utf8mb4_unicode_ci,
  `call_cost` int DEFAULT '0',
  `token` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `answer_speed` decimal(8,2) DEFAULT NULL,
  `first_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `record` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `experts_user_name_unique` (`user_name`),
  UNIQUE KEY `experts_mobile_unique` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experts`
--

INSERT INTO `experts` (`id`, `user_name`, `mobile`, `email`, `nationality`, `birthdate`, `gender`, `marital_status`, `image`, `points_balance`, `cash_balance`, `cash_balance_todate`, `rates`, `desc`, `call_cost`, `token`, `password`, `created_at`, `updated_at`, `is_active`, `answer_speed`, `first_name`, `last_name`, `record`) VALUES
(1, 'expert1', '0969459459', 'expert@gmail.com', 'Syrian', '2000-01-01 00:00:00', 1, 'm', '352171.webp', 0, '0.00', '0.00', '4.00', 'انا دكتور في علم الطاقةانا دكتور في علم الطاقةانا دكتور في علم الطاقةانا دكتور في علم الطاقةانا دكتور في علم الطاقةانا دكتور في علم الطاقةانا دكتور في علم الطاقةانا دكتور في علم الطاقةانا دكتور في علم الطاقةانا دكتور في علم الطاقةانا دكتور في علم الطاقةانا دكتور في علم الطاقةانا دكتور في علم الطاقةانا دكتور في علم الطاقة', 0, NULL, '$2y$12$hmb198tlznpCuj4fUy3uW.9XBUdfNdbQe7JD52ok4VN3K8G.q3uJC', NULL, '2024-02-15 14:00:42', 1, '0.00', 'محمد', 'السعيد', '15562135.mp3'),
(2, 'expert2', '0265498789', 'expert2012@gmail.com', 'Syrian', '2000-01-01 00:00:00', 1, 'm', '331772.webp', 0, '0.00', '0.00', '0.00', NULL, 0, NULL, '$2y$12$hmb198tlznpCuj4fUy3uW.9XBUdfNdbQe7JD52ok4VN3K8G.q3uJC', NULL, '2024-02-10 10:32:41', 1, '0.00', 'ahmad', 'ms', '15562135.mp3'),
(3, 'expert3', '0969459441', 'expert2011@gmail.com', 'Syrian', '2000-01-01 00:00:00', 1, 'm', '240733.webp', 0, '0.00', '0.00', '0.00', 'asc', 0, NULL, '$2y$12$hmb198tlznpCuj4fUy3uW.9XBUdfNdbQe7JD52ok4VN3K8G.q3uJC', NULL, '2024-02-04 15:30:23', 1, '0.00', 'ahmad', 'ms', NULL),
(6, 'sdvsdv', '8111123456', 'dssfvw@ononon.com', NULL, '2024-01-01 00:00:00', 2, NULL, '984116.webp', 0, '0.00', '0.00', '0.00', 'gregregfv', 0, NULL, '$2y$12$z6uPd0zfxseoukPrIAUXXub2mVSI2/8IuGcnvnXGx7GYoWXJElw3.', '2024-01-28 11:55:25', '2024-01-28 12:22:53', 1, '0.00', '1ahmad', '1ms', NULL),
(7, 'expert-4', '0956464987', 'dsssw@ononon.com', NULL, '2000-02-05 00:00:00', 1, NULL, NULL, 0, '0.00', '0.00', '0.00', NULL, 0, NULL, '$2y$12$AY0yFfKsCh1o0q/ucYa1b.Z8OsmWLWHg50H7CDTeJ6HrMUT3CRtJS', '2024-02-09 20:04:35', '2024-02-10 15:13:08', 1, '0.00', 'احمد', 'السالم', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expertsfavorites`
--

DROP TABLE IF EXISTS `expertsfavorites`;
CREATE TABLE IF NOT EXISTS `expertsfavorites` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint UNSIGNED DEFAULT NULL,
  `expert_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expertsfavorites`
--

INSERT INTO `expertsfavorites` (`id`, `client_id`, `expert_id`, `created_at`, `updated_at`) VALUES
(2, 13, 2, NULL, NULL),
(3, 13, 6, NULL, NULL),
(4, 10, 6, NULL, NULL),
(5, 13, 1, '2024-02-10 14:30:09', '2024-02-10 14:30:09');

-- --------------------------------------------------------

--
-- Table structure for table `experts_services`
--

DROP TABLE IF EXISTS `experts_services`;
CREATE TABLE IF NOT EXISTS `experts_services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `expert_id` bigint UNSIGNED DEFAULT NULL,
  `service_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `points` int DEFAULT '0',
  `expert_cost` decimal(8,2) DEFAULT '0.00',
  `cost_type` int DEFAULT '0',
  `expert_cost_value` decimal(8,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experts_services`
--

INSERT INTO `experts_services` (`id`, `expert_id`, `service_id`, `created_at`, `updated_at`, `points`, `expert_cost`, `cost_type`, `expert_cost_value`) VALUES
(1, 1, 1, NULL, NULL, 200, '50.00', 1, '50.00'),
(2, 2, 1, NULL, NULL, 300, '10.00', 2, '30.00'),
(3, 1, 20, NULL, NULL, 100, '0.00', 0, '0.00'),
(5, 2, 20, NULL, NULL, 200, '0.00', 0, '0.00'),
(6, 3, 1, NULL, NULL, 200, '0.00', 0, '0.00'),
(38, 2, 21, '2024-02-11 19:09:11', '2024-02-12 17:16:16', 700, '0.00', 0, '0.00'),
(40, 6, 21, '2024-02-11 19:12:18', '2024-02-12 14:21:19', 133, '0.00', 0, '0.00'),
(47, 1, 21, '2024-02-12 17:15:31', '2024-02-12 17:16:57', 100, '0.00', 0, '0.00'),
(48, 7, 21, '2024-02-12 17:16:31', '2024-02-12 17:17:15', 200, '0.00', 0, '0.00'),
(49, 1, 2, '2024-02-12 20:17:29', '2024-02-12 20:17:29', 0, '0.00', 0, '0.00'),
(50, 7, 2, '2024-02-12 20:22:32', '2024-02-12 20:22:32', 100, '0.00', 0, '0.00'),
(51, 2, 22, '2024-02-18 13:42:16', '2024-02-18 13:42:16', 200, '0.00', 0, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inputs`
--

DROP TABLE IF EXISTS `inputs`;
CREATE TABLE IF NOT EXISTS `inputs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tooltipe` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci,
  `ispersonal` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_count` int DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inputs`
--

INSERT INTO `inputs` (`id`, `name`, `type`, `tooltipe`, `icon`, `ispersonal`, `created_at`, `updated_at`, `image_count`, `is_active`) VALUES
(1, 'user_name', 'text', 'الاسم', 'username.svg', 1, NULL, NULL, 0, 1),
(2, 'mobile', 'text', 'الموبيل', NULL, 1, NULL, NULL, 0, 1),
(3, 'nationality', 'text', 'الجنسية', NULL, 1, NULL, NULL, 0, 1),
(4, 'birthdate', 'date', 'تاريخ الميلاد', 'birthdate.svg', 1, NULL, NULL, 0, 1),
(5, 'gender', 'text', 'الجنس', 'gender.svg', 1, NULL, NULL, 0, 1),
(6, 'marital_status', 'text', 'الحالة الاجتماعية', 'martial.svg', 1, NULL, NULL, 0, 1),
(7, 'الوضع الدراسي', 'list', 'الوضع الدراسي', NULL, 0, NULL, NULL, 0, 1),
(8, 'العمل الحالي', 'text', 'العمل الحالي', NULL, 0, NULL, NULL, 0, 1),
(9, 'هل يوجد مرض مزمن', 'bool', 'هل يوجد مرض مزمن', NULL, 0, NULL, NULL, 0, 1),
(24, 'record', 'record', '', '', 0, '2024-02-01 19:04:27', '2024-02-01 19:04:27', 0, 1),
(25, 'image', 'image', '', '', 0, '2024-02-01 19:04:27', '2024-02-01 19:04:27', 4, 1),
(48, 'record', 'record', '', '', 0, '2024-02-03 13:25:04', '2024-02-03 13:25:04', 0, 1),
(49, 'image', 'image', '', '', 0, '2024-02-03 13:25:04', '2024-02-09 11:10:49', 2, 1),
(65, 'name f', 'text', 'tooltipwww', '9455365.svg', 0, '2024-02-09 11:10:41', '2024-02-09 11:10:41', 0, 1),
(66, 'advsav', 'text', 'rrrr', NULL, 0, '2024-02-10 13:00:48', '2024-02-10 13:02:24', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inputs_services`
--

DROP TABLE IF EXISTS `inputs_services`;
CREATE TABLE IF NOT EXISTS `inputs_services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_id` bigint UNSIGNED DEFAULT NULL,
  `input_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inputs_services`
--

INSERT INTO `inputs_services` (`id`, `service_id`, `input_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 4, NULL, NULL),
(3, 1, 5, NULL, NULL),
(4, 1, 7, NULL, NULL),
(5, 1, 9, NULL, NULL),
(30, 1, 3, '2024-02-01 19:04:20', '2024-02-01 19:04:20'),
(31, 1, 6, '2024-02-01 19:04:20', '2024-02-01 19:04:20'),
(32, 1, 24, '2024-02-01 19:04:27', '2024-02-01 19:04:27'),
(33, 1, 25, '2024-02-01 19:04:27', '2024-02-01 19:04:27'),
(55, 21, 48, '2024-02-03 13:25:04', '2024-02-03 13:25:04'),
(56, 21, 49, '2024-02-03 13:25:04', '2024-02-03 13:25:04'),
(72, 21, 65, '2024-02-09 11:10:41', '2024-02-09 11:10:41'),
(73, 21, 1, '2024-02-09 11:10:58', '2024-02-09 11:10:58'),
(74, 21, 3, '2024-02-09 11:10:58', '2024-02-09 11:10:58'),
(75, 21, 5, '2024-02-09 11:10:58', '2024-02-09 11:10:58'),
(76, 21, 4, '2024-02-09 11:10:58', '2024-02-09 11:10:58'),
(77, 21, 6, '2024-02-09 11:10:58', '2024-02-09 11:10:58'),
(78, 21, 66, '2024-02-10 13:00:48', '2024-02-10 13:00:48');

-- --------------------------------------------------------

--
-- Table structure for table `inputvalues`
--

DROP TABLE IF EXISTS `inputvalues`;
CREATE TABLE IF NOT EXISTS `inputvalues` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `value` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inputvalues`
--

INSERT INTO `inputvalues` (`id`, `value`, `input_id`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'اعدادي', 7, NULL, NULL, 1),
(2, 'ثانوي', 7, NULL, NULL, 1),
(3, 'معهد', 7, NULL, NULL, 1),
(4, 'اجازة جامعية', 7, NULL, NULL, 1),
(5, 'دراسات عليا', 7, NULL, NULL, 1),
(6, 'aa', 28, '2024-02-02 16:19:29', '2024-02-02 16:19:29', 1),
(7, 'ds', 31, '2024-02-02 16:22:30', '2024-02-02 16:22:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_01_06_193109_create_experts_table', 1),
(7, '2024_01_06_193700_create_clients_table', 1),
(8, '2024_01_09_150050_create_services_table', 1),
(9, '2024_01_09_150101_create_inputs_table', 1),
(10, '2024_01_09_150108_create_inputvalues_table', 1),
(11, '2024_01_09_150128_create_selectedservices_table', 1),
(12, '2024_01_09_150156_create_points_table', 1),
(13, '2024_01_09_150206_create_pointstransfers_table', 1),
(14, '2024_01_09_150216_create_cashtransfers_table', 1),
(15, '2024_01_09_150228_create_expertsfavorites_table', 1),
(16, '2024_01_09_150239_create_servisesfavorites_table', 1),
(17, '2024_01_09_150247_create_permissions_table', 1),
(18, '2024_01_09_150254_create_reasons_table', 1),
(19, '2024_01_09_152338_create_inputs_services_table', 1),
(20, '2024_01_09_153018_create_experts_services_table', 1),
(21, '2024_01_09_153308_create_values_services_table', 1),
(22, '2024_01_13_140142_rename_servisesfavorites_table_to_servicesfavorites', 2),
(23, '2024_01_14_175619_add_is_active_to_experts_table', 3),
(24, '2024_01_14_180305_add_is_active_to_clients_table', 4),
(25, '2024_01_14_180321_add_is_active_to_services_table', 4),
(26, '2024_01_14_180347_add_is_active_to_inputs_table', 4),
(27, '2024_01_14_180410_add_is_active_to_inputvalues_table', 4),
(28, '2024_01_14_180430_add_is_active_to_points_table', 4),
(29, '2024_01_14_180449_add_is_active_to_reasons_table', 4),
(30, '2024_01_15_143333_add_comment_rate_to_selectedservices_table', 5),
(31, '2024_01_18_201734_add_is_active_to_clients_table', 6),
(32, '2024_01_18_203735_add_is_active_to_clients_table', 7),
(33, '2024_01_20_143356_add_icon_to_services_table', 8),
(34, '2024_01_20_152656_add_is_active_to_services_table', 9),
(35, '2024_01_20_165855_add_answer_speed_to_experts_table', 10),
(36, '2024_01_21_122146_add_image_to_users_table', 11),
(37, '2024_01_21_222132_add_points_to_experts_services_table', 12),
(38, '2024_01_21_223010_change_points_in_experts_services_table', 13),
(39, '2024_01_21_225228_change_cost_type_in_experts_services_table', 14),
(40, '2024_01_22_153151_add_is_active_to_users_table', 15),
(41, '2024_01_23_114747_add_first_name_to_exprts_table', 16),
(42, '2024_01_27_142243_change_value_in_values_services_table', 17),
(43, '2024_01_27_221643_add_status_to_selectedservices_table', 18),
(44, '2024_01_28_115214_add_side_to_pointstransfers_table', 19),
(45, '2024_01_28_125241_change_desc_in_services_table', 20),
(46, '2024_01_28_132233_add_record_to_experts_table', 21),
(47, '2024_01_28_132536_add_record_to_experts_table', 22),
(48, '2024_01_28_134218_add_records_to_experts_table', 23),
(49, '2024_01_28_162956_change_is_active_in_points_table', 24),
(50, '2024_01_29_151056_change_image_in_services_table', 25),
(51, '2024_01_29_201247_change_desc_in_services_table', 26),
(52, '2024_01_31_114719_add_image_count_to_inputs_table', 27),
(53, '2024_01_31_211919_add_is_callservice_to_services_table', 28),
(54, '2024_02_02_181449_add_is_active_to_inputs_table', 29),
(55, '2024_02_02_181513_add_is_active_to_inputvalues_table', 29),
(56, '2024_02_04_160634_add_expert_percent_to_services_table', 30),
(57, '2024_02_04_161836_add_name_to_values_services_table', 30),
(58, '2024_02_04_163843_change_expert_percent_to_services_table', 31),
(59, '2024_02_05_210300_change_name_in_values_services_table', 32),
(60, '2024_02_08_154224_change_token_in_clients_table', 33),
(61, '2024_02_08_154244_change_token_in_experts_table', 33),
(62, '2024_02_08_154256_change_token_in_users_table', 33),
(63, '2024_02_12_193320_create_settings_table', 34),
(64, '2024_02_12_195152_add_ar_name_to_settings_table', 35),
(65, '2024_02_13_133435_create_notifications_table', 36),
(66, '2024_02_14_214709_add_comment_date_to_selectedservices_table', 37),
(67, '2024_02_14_220716_create_answers_table', 37),
(68, '2024_02_15_115410_drop_answer2_from_selectedservices_table', 38),
(69, '2024_02_15_120613_create_companies_table', 39),
(70, '2024_02_15_120707_add_company_profit_to_selectedservices_table', 39),
(71, '2024_02_17_214543_add_form_reject_reason_to_selectedservices_table', 40),
(72, '2024_02_19_183752_add_state_to_pointstransfers_table', 41),
(73, '2024_02_20_163306_change_id_in_notifications_table', 42),
(74, '2024_02_20_163619_add_id_to_notifications_table', 43),
(75, '2024_02_20_163836_drop_notifiable_type_in_notifications_table', 44),
(76, '2024_02_20_165438_create_notifications_users_table', 45);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `side` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `createuser_id` bigint UNSIGNED DEFAULT NULL,
  `updateuser_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications_users`
--

DROP TABLE IF EXISTS `notifications_users`;
CREATE TABLE IF NOT EXISTS `notifications_users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `notification_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED DEFAULT NULL,
  `expert_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `isread` tinyint(1) DEFAULT NULL,
  `read_at` datetime DEFAULT NULL,
  `state` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `service_id` bigint UNSIGNED DEFAULT NULL,
  `allowcomment` tinyint(1) DEFAULT NULL,
  `allowanswer` tinyint(1) DEFAULT NULL,
  `allowsend` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

DROP TABLE IF EXISTS `points`;
CREATE TABLE IF NOT EXISTS `points` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `count` int DEFAULT '0',
  `price` decimal(8,2) DEFAULT '0.00',
  `pricebefor` decimal(8,2) DEFAULT '0.00',
  `countbefor` int DEFAULT '0',
  `createuser_id` bigint UNSIGNED DEFAULT NULL,
  `updateuser_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`id`, `count`, `price`, `pricebefor`, `countbefor`, `createuser_id`, `updateuser_id`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 20, '20.22', '20.22', 0, NULL, NULL, '2024-01-28 14:31:09', '2024-01-31 19:06:48', 1),
(2, 100, '100.00', '100.00', 0, NULL, NULL, '2024-01-28 19:05:30', '2024-01-31 19:07:09', 1),
(5, 110, '100.00', '100.00', 90, NULL, NULL, '2024-01-31 18:59:15', '2024-01-31 18:59:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pointstransfers`
--

DROP TABLE IF EXISTS `pointstransfers`;
CREATE TABLE IF NOT EXISTS `pointstransfers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `point_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED DEFAULT NULL,
  `expert_id` bigint UNSIGNED DEFAULT NULL,
  `service_id` bigint UNSIGNED DEFAULT NULL,
  `count` int DEFAULT '0',
  `status` int DEFAULT '0',
  `selectedservice_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `side` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pointstransfers`
--

INSERT INTO `pointstransfers` (`id`, `point_id`, `client_id`, `expert_id`, `service_id`, `count`, `status`, `selectedservice_id`, `created_at`, `updated_at`, `side`, `state`, `type`) VALUES
(21, NULL, 10, 1, 1, 200, 1, 33, '2024-02-07 14:21:33', '2024-02-07 14:21:33', 'from-client', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

DROP TABLE IF EXISTS `reasons`;
CREATE TABLE IF NOT EXISTS `reasons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reasons`
--

INSERT INTO `reasons` (`id`, `content`, `type`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'غير مطابق للشروط والاحكام', 'form', NULL, NULL, 1),
(2, 'غير مناسب', 'form', NULL, NULL, 1),
(3, 'اسباب اخرى', 'form', NULL, NULL, 1),
(4, 'غير مطابق للشروط والاحكام', 'answer', NULL, NULL, 1),
(5, 'اسباب اخرى', 'answer', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `selectedservices`
--

DROP TABLE IF EXISTS `selectedservices`;
CREATE TABLE IF NOT EXISTS `selectedservices` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint UNSIGNED NOT NULL,
  `expert_id` bigint UNSIGNED DEFAULT NULL,
  `service_id` bigint UNSIGNED DEFAULT NULL,
  `points` int DEFAULT '0',
  `rate` decimal(8,2) DEFAULT '0.00',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `comment_rate` int NOT NULL DEFAULT '0',
  `status` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expert_cost` decimal(8,2) DEFAULT '0.00',
  `cost_type` decimal(8,2) DEFAULT '0.00',
  `expert_cost_value` decimal(8,2) DEFAULT '0.00',
  `comment_date` datetime DEFAULT NULL,
  `comment_state` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_reject_reason` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_state` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_user_id` bigint UNSIGNED DEFAULT NULL,
  `company_profit` decimal(8,2) DEFAULT '0.00',
  `company_profit_percent` decimal(8,2) DEFAULT '0.00',
  `form_reject_reason` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `selectedservices`
--

INSERT INTO `selectedservices` (`id`, `client_id`, `expert_id`, `service_id`, `points`, `rate`, `comment`, `created_at`, `updated_at`, `comment_rate`, `status`, `expert_cost`, `cost_type`, `expert_cost_value`, `comment_date`, `comment_state`, `comment_reject_reason`, `form_state`, `comment_user_id`, `company_profit`, `company_profit_percent`, `form_reject_reason`) VALUES
(33, 10, 1, 1, 200, '0.00', 'الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبيرالخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبيرالخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبيرالخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبيرالخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبيرالخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبيرالخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبيرالخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير', '2024-02-07 14:21:33', '2024-02-07 14:21:33', 0, 'created', '50.00', '1.00', '50.00', '2024-02-14 14:21:33', 'agree', NULL, 'wait', NULL, '0.00', '0.00', NULL),
(34, 10, 1, 1, 200, '0.00', 'الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد ', '2024-02-07 14:21:33', '2024-02-07 14:21:33', 0, 'created', '50.00', '1.00', '50.00', '2024-02-14 18:21:33', 'wait', NULL, 'agree', NULL, '0.00', '0.00', NULL),
(35, 13, 1, 1, 200, '0.00', 'الخبير جيد الخبير الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتاز الخبير ممتازبير جيد الخبير', '2024-02-07 14:21:33', '2024-02-07 14:21:33', 0, 'created', '50.00', '1.00', '50.00', '2024-02-14 14:21:33', 'agree', NULL, 'reject', NULL, '0.00', '0.00', NULL),
(36, 10, 1, 1, 200, '0.00', 'الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد الخبير جيد ', '2024-02-07 14:21:33', '2024-02-07 14:21:33', 0, 'created', '50.00', '1.00', '50.00', '2024-02-14 18:21:33', 'wait', NULL, 'wait', NULL, '0.00', '0.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createuser_id` bigint UNSIGNED DEFAULT NULL,
  `updateuser_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `is_callservice` int DEFAULT '0',
  `expert_percent` decimal(8,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `desc`, `image`, `createuser_id`, `updateuser_id`, `created_at`, `updated_at`, `icon`, `is_active`, `is_callservice`, `expert_percent`) VALUES
(1, 'طاقة 1الشفاء', 'نارلانلامن', '895841.webp', NULL, 1, NULL, '2024-02-20 13:18:26', '879541.svg', 1, 0, '6.60'),
(2, 'الصحة', 'يري', '224572.webp', NULL, 1, NULL, '2024-02-15 14:03:26', '666872.svg', 1, 0, '15.00'),
(19, 'callservice', ' ', NULL, 1, 1, '2024-01-31 19:28:03', '2024-01-31 19:28:03', NULL, 1, 1, '0.00'),
(20, 'طاقة الشفاء', 'العلاج بالطاقة', '2383720.webp', 1, 1, '2024-01-31 19:29:36', '2024-02-11 17:30:39', '9302820.svg', 1, 0, '10.00'),
(21, 'استشارة طبية', NULL, '2821021.webp', 1, 1, '2024-01-31 19:30:52', '2024-02-17 12:59:51', '2516821.svg', 1, 0, '8.00'),
(22, 'خدمة جديدة', NULL, NULL, 1, 1, '2024-02-12 20:11:52', '2024-02-12 20:12:57', NULL, 1, 0, '6.00');

-- --------------------------------------------------------

--
-- Table structure for table `servicesfavorites`
--

DROP TABLE IF EXISTS `servicesfavorites`;
CREATE TABLE IF NOT EXISTS `servicesfavorites` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint UNSIGNED DEFAULT NULL,
  `service_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `updateuser_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ar_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence` int DEFAULT '0',
  `dept` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `type`, `notes`, `updateuser_id`, `created_at`, `updated_at`, `ar_name`, `sequence`, `dept`) VALUES
(1, 'expert_percent', '10', 'decimal', NULL, NULL, NULL, '2024-02-14 11:05:30', 'نسبة الخبير الافتراضية', 0, NULL),
(2, 'expert_service_points', '200', 'decimal', NULL, NULL, NULL, '2024-02-14 11:05:52', 'النقاط الافتراضية', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` text COLLATE utf8mb4_unicode_ci,
  `createuser_id` bigint UNSIGNED DEFAULT NULL,
  `updateuser_id` bigint UNSIGNED DEFAULT NULL,
  `mobile` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `first_name`, `last_name`, `user_name`, `role`, `token`, `createuser_id`, `updateuser_id`, `mobile`, `remember_token`, `created_at`, `updated_at`, `image`, `is_active`) VALUES
(1, 'ahmad', 'najyms@gmail.com', NULL, '$2y$12$hmb198tlznpCuj4fUy3uW.9XBUdfNdbQe7JD52ok4VN3K8G.q3uJC', 'ahmad', 'ms', NULL, 'admin', 'eZch7A-yY1DnCr9gB9cLDc:APA91bG_-cvRIB8u4agr87fXt6igOTADeBYpLP5tQisGktFat8rN4l3alTgWdUqfeShuHW5mp-R5MtBfM-1NYJrv7mRYgjGJBBubYlrzlg6sWmwEipJepOYPBdm8KoaMte1a6-DYuC_c', NULL, 1, NULL, NULL, '2024-01-11 12:47:38', '2024-02-19 10:17:19', '109301.webp', 1),
(2, 'super1', 'super@gmail.com', NULL, '$2y$12$Bhtt5mZSK0f6kkE3qc54m.C0p1YwjfNH/eBE93BV25mp1s0Om1SJG', 'super', 'super', NULL, 'super', NULL, NULL, 1, NULL, NULL, '2024-01-11 12:48:33', '2024-01-25 17:29:17', '274822.webp', 1),
(3, 'admin@gmail.com', 'jjjjjj@gmail.com', NULL, '$2y$12$CkkT3KMcnk2qq1M9HIExPOmY7JO0yJThW.9Gv08V3uPxj.aI/pY.C', 'yumyu', 'ergerg', NULL, 'super', NULL, 1, 1, '0213456789', NULL, '2024-02-18 11:28:55', '2024-02-18 11:28:55', NULL, 1),
(8, 'user', 'user@gmail.com', NULL, '$2y$12$54YLe6Epl6E0ruhQaNj6ruVe32Ll9mQsoe8evlwmf.zLXzRwPdDlG', 'casc', 'ascv', NULL, 'admin', 'cUqZTkolu1pz2-74npIClM:APA91bHIqKoY5CXg0lugNY_u7s82bRz-M8eakf_QcsNqjn7fpvMgQMVMukBIfnXF-AsyIN-F-yfL0vijm-WWD1EhMoT2OeoVSH9bi-xO8KSVQRFjZrLPXD7sBvtTK1AsVzaAbEk-tweN', 1, 1, '8111434342', NULL, '2024-01-22 13:51:09', '2024-02-19 10:34:02', NULL, 1),
(9, 'client', 'client@gmail.com', NULL, '$2y$12$t9tCCSF76pHXuuqHctkWpePmE2.Ng190NI2m0hAOLp3ZiMq8tj.XK', 'ahmad', 'ms', NULL, 'admin', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luY2xpZW50IiwiaWF0IjoxNzA3NDA3MTU3LCJuYmYiOjE3MDc0MDcxNTcsImp0aSI6IkZvUFZYMllrT2VqMHJ1TjkiLCJzdWIiOiIxMyIsInBydiI6IjQxZWZiN2JhZDdmNmY2MzJlMjQwNWJkM2E3OTNiOGE2YmRlYzY3NzcifQ.rWvpuHg5-DBfWxrubaCDIUXlBgOJcRfyhqHhZZpliXA', 1, 1, '1234123444', NULL, '2024-01-22 13:56:56', '2024-02-08 13:48:29', NULL, 1),
(10, 'ddtyhtddsw@ononon.com', 'dsdtyntdw@ononon.com', NULL, '$2y$12$CzGEYxXyluOtZobX267ub.WonqpY5D59rIbFB7yGTyUYeJRWcauii', 'ahmad', 'ms', NULL, 'super', NULL, 1, 1, '88811143434', NULL, '2024-01-22 13:57:50', '2024-01-22 13:57:50', NULL, 0),
(11, 'ahmadahmad', 'adminuser@gmail.com', NULL, '$2y$12$6BjwnUF9jB5NgFAIclCsIOlwr2CyjIuvGiORWedjX6eQKo/3q.CYa', 'احمد', 'محمد', NULL, 'admin', 'f22i4Dh75_SupfLYkUEVit:APA91bGph_GirA_BYppqL81YqLuqDsmGhC5dRf9n51XrZdRI8UAoAz9mdtRkPjwHTayvaAGnNdE65iXwhEpA1MGMx-MRFu_Yo5ce4FpovPEWgO3GcZj_HQzquCq-RUtKUiHmyanDfuxq', 1, 1, '0995959959', NULL, '2024-01-23 13:06:37', '2024-02-08 12:57:58', '2317011.webp', 1),
(12, 'ahmad11', 'dsw@ononon.com', NULL, '$2y$12$NPrwOkxJ8Ef/Ho7gWa2PkOZbptrGQFPzkYk16p0Sf/xTN6jlhtQBW', 'ahmad', 'ms', NULL, 'super', NULL, 1, 1, '1202056511', NULL, '2024-01-23 14:47:04', '2024-01-23 14:47:04', '7897012.webp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `values_services`
--

DROP TABLE IF EXISTS `values_services`;
CREATE TABLE IF NOT EXISTS `values_services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `selectedservice_id` bigint UNSIGNED DEFAULT NULL,
  `inputservice_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tooltipe` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci,
  `ispersonal` tinyint(1) DEFAULT NULL,
  `image_count` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `values_services`
--

INSERT INTO `values_services` (`id`, `value`, `selectedservice_id`, `inputservice_id`, `created_at`, `updated_at`, `name`, `type`, `tooltipe`, `icon`, `ispersonal`, `image_count`) VALUES
(129, 'احمد', 33, 1, '2024-02-07 14:21:33', '2024-02-07 14:21:33', 'user_name', 'text', 'الاسم', 'username.svg', 1, 0),
(130, '2000-01-20', 33, 2, '2024-02-07 14:21:33', '2024-02-07 14:21:33', 'birthdate', 'date', 'تاريخ الميلاد', 'birthdate.svg', 1, 0),
(131, '1', 33, 3, '2024-02-07 14:21:33', '2024-02-07 14:21:33', 'gender', 'text', 'الجنس', 'gender.svg', 1, 0),
(132, 'اجازة جامعية', 33, 4, '2024-02-07 14:21:33', '2024-02-07 14:21:33', 'الوضع الدراسي', 'list', 'الوضع الدراسي', NULL, 0, 0),
(133, '1', 33, 5, '2024-02-07 14:21:33', '2024-02-07 14:21:33', 'هل يوجد مرض مزمن', 'bool', 'هل يوجد مرض مزمن', NULL, 0, 0),
(134, '87609134.webp', 33, 33, '2024-02-07 14:32:08', '2024-02-07 14:32:08', 'image', 'image', '', '', 0, 4),
(135, '50207135.mp3', 33, 32, '2024-02-07 14:33:06', '2024-02-07 14:33:06', 'record', 'record', '', '', 0, 0),
(136, '53458136.mp3', 33, 32, '2024-02-07 15:12:04', '2024-02-07 15:12:04', 'record', 'record', '', '', 0, 0),
(137, '86364137.mp3', 33, 32, '2024-02-07 15:12:24', '2024-02-07 15:12:24', 'record', 'record', '', '', 0, 0),
(138, '46161138.mp3', 33, 32, '2024-02-07 15:17:04', '2024-02-07 15:17:04', 'record', 'record', '', '', 0, 0),
(139, '75821139.webp', 33, 33, '2024-02-07 15:17:52', '2024-02-07 15:17:52', 'image', 'image', '', '', 0, 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
