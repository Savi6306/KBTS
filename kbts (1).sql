-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2025 at 01:19 PM
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
-- Database: `kbts`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Savita Yadav', 'savita123@gmail.com', '$2y$12$qwAOVAHNFOaXZEiioOgtve8pRnlzi9pNPPVV7owXg4740qzrOTCFS', '2025-12-10 06:15:00', '2025-12-10 06:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `description`, `created_at`, `updated_at`, `status`) VALUES
(1, 'technical', 'technical', 'hello', 'hello4', '2025-11-29 08:35:31', '2025-11-29 16:03:10', 'Active'),
(2, 'black shirt', 'black-shirt', 'hello', 'fgrth', '2025-12-02 05:06:52', '2025-12-02 05:06:52', 'Active');

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
-- Table structure for table `kb_articles`
--

CREATE TABLE `kb_articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `dislikes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kb_articles`
--

INSERT INTO `kb_articles` (`id`, `title`, `slug`, `content`, `views`, `is_published`, `category_id`, `created_at`, `updated_at`, `likes`, `dislikes`) VALUES
(1, 'hr', 'hr', 'hello', 20, 1, 1, '2025-11-29 09:23:46', '2025-12-15 11:08:41', 22, 6),
(2, 'IT COMPANY', 'it-company', 'dvdfvfbfgn', 17, 1, 2, '2025-12-09 11:11:38', '2025-12-15 11:29:59', 3, 0);

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
(4, '2025_11_26_155643_create_categories_table', 2),
(5, '2025_11_26_155644_create_tickets_table', 2),
(6, '2025_11_26_155645_create_ticket_replies_table', 2),
(7, '2025_11_26_160424_create_kb_articles_table', 3),
(8, '2025_11_26_160858_add_role_to_users_table', 4),
(9, '2025_11_27_101352_add_fields_to_categories_table', 5),
(10, '2025_11_27_102552_add_views_to_kb_articles', 6),
(11, '2025_11_28_051453_add_agent_id_to_tickets_table', 7),
(12, '2025_11_29_133104_add_rating_to_kb_articles_table', 8),
(13, '2025_11_29_203611_create_ticket_logs_table', 9),
(14, '2025_11_29_210544_update_status_enum_in_tickets_table', 10),
(15, '2025_11_29_214829_create_ticket_attachments_table', 11),
(16, '2025_11_29_220438_add_close_reason_to_tickets_table', 12),
(17, '2025_11_29_221742_add_status_to_categories_table', 13),
(18, '2025_12_02_152531_update_ticket_priority_enum', 14),
(19, '2025_12_10_111454_create_admins_table', 15),
(20, '2025_12_10_112011_create_admins_table', 16),
(21, '2025_12_10_112437_create_agents_table', 17),
(22, '2025_12_15_171301_add_category_id_to_tickets_table', 18);

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
('savi123@gmail.com', '$2y$12$IS3LoI8XCZT2Pc72X7./Ge1HGxWK1lFVUmWvcD5kWPcpdr/4XIuvO', '2025-12-09 10:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `agent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('New','In Progress','Resolved','Closed') NOT NULL,
  `close_reason` varchar(255) DEFAULT NULL,
  `priority` enum('Low','Medium','High') NOT NULL DEFAULT 'Low',
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `agent_id`, `subject`, `description`, `status`, `close_reason`, `priority`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 'hr plocey', 'hello', 'Resolved', NULL, 'Low', NULL, '2025-11-27 02:49:44', '2025-12-11 07:24:16'),
(2, 1, 3, 'gvg', 'hello', 'Closed', NULL, 'Low', NULL, '2025-11-29 06:55:13', '2025-11-29 15:36:17'),
(3, 1, NULL, 'hello', 'sdcdsvdvdf', 'New', NULL, 'Low', NULL, '2025-12-01 07:12:56', '2025-12-01 07:12:56'),
(4, 1, NULL, 'bb', 'dfcdvdfvdfvb', 'New', NULL, 'Low', NULL, '2025-12-01 07:21:18', '2025-12-01 07:21:18'),
(5, 1, NULL, 'hello9', 'bvghjvgfg', 'New', NULL, 'Low', NULL, '2025-12-01 09:56:10', '2025-12-01 09:56:10'),
(6, 8, NULL, 'savi', 'bye', 'New', NULL, 'Low', NULL, '2025-12-10 05:01:35', '2025-12-10 05:01:35'),
(7, 8, 3, 'savi', 'bye', 'New', NULL, 'Low', NULL, '2025-12-10 05:02:35', '2025-12-12 05:02:24'),
(8, 8, 4, 'savi', 'bye', 'In Progress', NULL, 'Low', NULL, '2025-12-10 05:02:46', '2025-12-11 07:25:46'),
(9, 1, NULL, 'IT', 'hello', 'New', NULL, 'Low', 1, '2025-12-15 11:43:44', '2025-12-15 11:43:44'),
(10, 1, NULL, 'IT', 'hello', 'New', NULL, 'Low', 1, '2025-12-15 11:44:43', '2025-12-15 11:44:43'),
(11, 1, 4, 'IT', 'hello', 'In Progress', NULL, 'Low', 1, '2025-12-15 11:52:19', '2025-12-16 07:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_attachments`
--

CREATE TABLE `ticket_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_reply_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `file_size` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_attachments`
--

INSERT INTO `ticket_attachments` (`id`, `ticket_reply_id`, `file_path`, `original_name`, `mime_type`, `file_size`, `created_at`, `updated_at`) VALUES
(1, 5, 'attachments/jSOaurV0lFNF14rsJM4zcKaI8aFM74o9iEONuOfU.png', 'Screenshot 2025-11-21 135144.png', 'image/png', 149741, '2025-12-01 09:59:12', '2025-12-01 09:59:12');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_logs`
--

CREATE TABLE `ticket_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `done_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_logs`
--

INSERT INTO `ticket_logs` (`id`, `ticket_id`, `action`, `done_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'Status changed from In Progress to Closed', 1, '2025-11-29 15:36:17', '2025-11-29 15:36:17'),
(2, 1, 'Reply added by admin', 1, '2025-11-29 16:14:07', '2025-11-29 16:14:07'),
(3, 1, 'Assigned to agent ID: 4', 4, '2025-12-02 10:09:38', '2025-12-02 10:09:38'),
(4, 1, 'Assigned to agent ID: 4', 4, '2025-12-02 10:19:54', '2025-12-02 10:19:54'),
(5, 1, 'Assigned to agent ID: 4', 4, '2025-12-02 10:21:16', '2025-12-02 10:21:16'),
(6, 1, 'Assigned to agent ID: 4', 4, '2025-12-02 10:26:34', '2025-12-02 10:26:34'),
(7, 1, 'Assigned to agent ID: 4', 4, '2025-12-02 10:35:45', '2025-12-02 10:35:45'),
(8, 1, 'Assigned to agent ID: 4', 4, '2025-12-02 10:42:09', '2025-12-02 10:42:09'),
(9, 1, 'Assigned to agent ID: 4', 4, '2025-12-02 10:52:24', '2025-12-02 10:52:24'),
(10, 1, 'Assigned to agent ID: 4', 4, '2025-12-02 10:53:10', '2025-12-02 10:53:10'),
(11, 8, 'Assigned to agent ID: 4', 1, '2025-12-10 07:34:50', '2025-12-10 07:34:50'),
(12, 7, 'Agent changed from None to 3', 1, '2025-12-12 05:02:24', '2025-12-12 05:02:24'),
(13, 11, 'Agent changed from None to 4', 1, '2025-12-16 06:51:32', '2025-12-16 06:51:32');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_replies`
--

CREATE TABLE `ticket_replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_replies`
--

INSERT INTO `ticket_replies` (`id`, `ticket_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'pleseas', '2025-11-29 06:55:28', '2025-11-29 06:55:28'),
(2, 2, 3, 'hello', '2025-11-29 12:28:51', '2025-11-29 12:28:51'),
(3, 2, 1, 'hello', '2025-11-29 13:29:48', '2025-11-29 13:29:48'),
(4, 1, 1, 'hello', '2025-11-29 16:14:07', '2025-11-29 16:14:07'),
(5, 5, 1, 'hello', '2025-12-01 09:59:12', '2025-12-01 09:59:12'),
(6, 2, 1, 'hello', '2025-12-11 06:55:34', '2025-12-11 06:55:34'),
(7, 2, 1, 'hello', '2025-12-11 07:00:30', '2025-12-11 07:00:30'),
(8, 11, 4, 'hello', '2025-12-16 07:25:09', '2025-12-16 07:25:09');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'agent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'savita yadav', 'savi123@gmail.com', NULL, '$2y$12$SYOWdrH19Htsizm7U7nBNOktQLFOaadUHpgsLJQ37ZZX0g8QYI99O', 'c91blZIIvY4MQpzuxyqv2nzrW6Nw3htvUbp5TRQqrrDqQCxoyvpM9AbroXTQ', '2025-11-27 01:17:41', '2025-11-27 01:18:30', 'user'),
(2, 'manu', 'sambhavkumar002@gmail.com', NULL, '$2y$12$S83k/GtAGR02Jc2HB6bjEu.makqVgM.1afaes4RnptT3u7I/Dv25.', 'OnY35fX44GgExAtREDjqiPaLt9XsXurC2dzLSF7AEVW0ZvI31TWRBWKEggKN', '2025-11-27 01:37:44', '2025-11-27 01:37:44', 'user'),
(3, 'savita yadav', 'savi12356@gmail.com', NULL, '$2y$12$xevXLzKqOTF08hnSMbikzeiheBGZOUbuXuIKHvpjvXMYEqHVh4bta', 'BhYxHJTrdYlxccXT1YXMYzGmY37enNkptNaBOTdSKA9ojBzfg9bnmSaI2Ku6', '2025-11-29 10:08:04', '2025-11-29 10:08:04', 'agent'),
(4, 'sandhya', 'sandhya@pushpendratechnology.com', NULL, '$2y$12$MmXoGFU493qoyELGa2QzM.yK5iGCspVBQCuYby9cB6uZeWYerrApe', 'FTnCRma1u49hYl4i3EvXKf52ec8Hln4XmD3NFYKvXng00ua8F15KtLF1jYO2', '2025-12-02 08:24:25', '2025-12-02 08:24:25', 'agent'),
(5, 'neha', 'nehu@gmail.com', NULL, '$2y$12$H5Fw9WjwGw8yVmMuqMvJSu0O75FswOJLjdzObZpH/90V0ZYt9zH3m', 'y79LzHfE5e5hBbBBJ1a0sSA9mKdvjQ4ZoADEuQMmcap1QnGkp2kTQKD6EYKq', '2025-12-08 10:30:21', '2025-12-08 10:30:21', 'admin'),
(6, 'satya', 'satya@1234gmail.com', NULL, '$2y$12$5BHFmz6WhfuTkCRpXE.FguR4WrjRQ607tm9xUD9NpiofvsV0H0Yg6', NULL, '2025-12-10 04:53:07', '2025-12-10 04:53:07', 'admin'),
(7, 'manu yadav', 'yadav123@gmail.com', NULL, '$2y$12$TKhD7blc2SU1pRzjUJqiNO5yHkUnLSmscDhO47ZTEOvLlY5ftimlS', NULL, '2025-12-10 04:56:07', '2025-12-10 04:56:07', 'admin'),
(8, 'manjeeta', 'manjeeta123@gmail.com', NULL, '$2y$12$fpi3KgYa/ft8Kkqyasccv.2BMUOUvL.XXAvPLSUXIxs4xeVI6zUUu', NULL, '2025-12-10 05:00:16', '2025-12-10 05:00:16', 'admin'),
(9, 'manoj', 'manoj@gmail.com', NULL, '$2y$12$BTJrX2fPQ.BG7UTtXDNLj.QMYY3W.5HM8O6j6nLJLSFv6G3ANWL6S', NULL, '2025-12-10 06:45:07', '2025-12-10 06:45:07', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `kb_articles`
--
ALTER TABLE `kb_articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kb_articles_slug_unique` (`slug`),
  ADD KEY `kb_articles_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`),
  ADD KEY `tickets_category_id_foreign` (`category_id`);

--
-- Indexes for table `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_attachments_ticket_reply_id_foreign` (`ticket_reply_id`);

--
-- Indexes for table `ticket_logs`
--
ALTER TABLE `ticket_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_logs_ticket_id_foreign` (`ticket_id`),
  ADD KEY `ticket_logs_done_by_foreign` (`done_by`);

--
-- Indexes for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_replies_ticket_id_foreign` (`ticket_id`),
  ADD KEY `ticket_replies_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kb_articles`
--
ALTER TABLE `kb_articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ticket_logs`
--
ALTER TABLE `ticket_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kb_articles`
--
ALTER TABLE `kb_articles`
  ADD CONSTRAINT `kb_articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  ADD CONSTRAINT `ticket_attachments_ticket_reply_id_foreign` FOREIGN KEY (`ticket_reply_id`) REFERENCES `ticket_replies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_logs`
--
ALTER TABLE `ticket_logs`
  ADD CONSTRAINT `ticket_logs_done_by_foreign` FOREIGN KEY (`done_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ticket_logs_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  ADD CONSTRAINT `ticket_replies_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ticket_replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
