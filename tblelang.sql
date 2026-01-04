-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 04, 2026 at 04:31 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tblelang`
--

-- --------------------------------------------------------

--
-- Table structure for table `auctions`
--

CREATE TABLE `auctions` (
  `id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `tgl_lelang` datetime NOT NULL,
  `tgl_akhir` datetime NOT NULL,
  `harga_akhir` bigint DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `petugas_id` bigint UNSIGNED NOT NULL,
  `status` enum('dibuka','ditutup') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ditutup',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auctions`
--

INSERT INTO `auctions` (`id`, `item_id`, `tgl_lelang`, `tgl_akhir`, `harga_akhir`, `user_id`, `petugas_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 3, '2026-01-02 02:40:00', '2026-01-09 09:41:00', 120000000000, NULL, 1, 'dibuka', '2026-01-01 19:41:08', '2026-01-04 07:47:14'),
(3, 4, '2026-01-04 11:44:00', '2026-01-25 18:45:00', 7900000000, 2, 1, 'ditutup', '2026-01-04 04:45:23', '2026-01-04 06:16:12'),
(4, 5, '2026-01-04 15:07:00', '2026-01-18 22:07:00', 450000000, NULL, 1, 'dibuka', '2026-01-04 08:07:33', '2026-01-04 08:10:21'),
(6, 6, '2026-01-04 15:14:00', '2026-01-21 22:14:00', 400000000, NULL, 1, 'dibuka', '2026-01-04 08:14:31', '2026-01-04 08:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` bigint UNSIGNED NOT NULL,
  `auction_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `penawaran_harga` bigint NOT NULL,
  `tgl_penawaran` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `auction_id`, `user_id`, `penawaran_harga`, `tgl_penawaran`, `created_at`, `updated_at`) VALUES
(2, 2, 2, 100000001000, '2026-01-03 23:31:16', '2026-01-03 16:31:16', '2026-01-03 16:31:16'),
(3, 2, 2, 100000002000, '2026-01-03 23:38:25', '2026-01-03 16:38:25', '2026-01-03 16:38:25'),
(6, 3, 2, 7900000000, '2026-01-04 13:15:25', '2026-01-04 06:15:25', '2026-01-04 06:15:25'),
(7, 2, 13, 120000000000, '2026-01-04 14:47:14', '2026-01-04 07:47:14', '2026-01-04 07:47:14'),
(8, 4, 13, 410000000, '2026-01-04 15:08:12', '2026-01-04 08:08:12', '2026-01-04 08:08:12'),
(9, 4, 2, 450000000, '2026-01-04 15:10:21', '2026-01-04 08:10:21', '2026-01-04 08:10:21'),
(10, 6, 13, 400000000, '2026-01-04 15:41:38', '2026-01-04 08:41:38', '2026-01-04 08:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admin@gmail.com|127.0.0.1', 'i:2;', 1767539611),
('laravel-cache-admin@gmail.com|127.0.0.1:timer', 'i:1767539611;', 1767539611);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_barang` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `harga_awal` decimal(15,2) NOT NULL,
  `batas_waktu` datetime DEFAULT NULL,
  `status` enum('tersedia','terjual') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `nama`, `deskripsi_barang`, `harga_awal`, `batas_waktu`, `status`, `created_at`, `updated_at`, `foto`) VALUES
(1, 'Mobil Mahal sekali', 'Mobil Bekas Banjir', '10000000000.00', NULL, 'tersedia', '2026-01-01 07:53:35', '2026-01-01 08:59:17', NULL),
(3, 'Mobil Mahal 3', NULL, '100000000000.00', NULL, 'tersedia', '2026-01-01 08:00:34', '2026-01-01 08:00:34', '1767279634_mobil-lelang-jakarta-2-3091.jpg'),
(4, 'Hermès Birkin Himalaya', 'tas tangan Hermès Birkin yang ikonis, terbuat dari kulit buaya. Tas Birkin, dinamai berdasarkan aktris Inggris Jane Birkin, pertama kali diluncurkan pada tahun 1984 dan dengan cepat menjadi simbol status mewah.', '7500000000.00', NULL, 'tersedia', '2026-01-04 04:44:42', '2026-01-04 04:44:42', '1767527082_hermes.jpg'),
(5, 'Mobil Honda HR-V RS', 'tipe tertinggi dari HR-V yang menawarkan desain sporty dengan RS Aero Kit, interior mewah dengan Panoramic Glass Roof, dan teknologi canggih seperti Honda Sensing (ADAS) untuk keselamatan, serta pilihan mesin yang bertenaga (Turbo atau Hybrid e:HEV) untuk performa efisien, menjadikannya crossover premium dengan fitur lengkap untuk gaya hidup aktif.', '400000000.00', NULL, 'tersedia', '2026-01-04 08:07:07', '2026-01-04 08:07:07', '1767539227_hrv.jpg'),
(6, 'Birkin 25 Blue Tie Togo PHW K', 'The Hermes Birkin 25 Blue Tie Togo PHW K is crafted from Togo leather in Blue Tie—a combination of navy and bright blue—featuring palladium hardware and marked with a \"K\" stamp (2025). It has tonal stitching, a front flap, two straps with a central toggle closure, a clochette with a lock and two keys, and double-rolled handles. The interior is lined with chevre leather and includes one zip pocket with an Hermes-engraved zipper pull, as well as one open pocket on the opposite side.\r\n\r\nDimensions: (L) 25 × (H) 20 × (D) 13 cm', '385000000.00', NULL, 'tersedia', '2026-01-04 08:14:11', '2026-01-04 08:14:11', '1767539651_hermes birkin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(19, '0001_01_01_000000_create_users_table', 1),
(20, '0001_01_01_000001_create_cache_table', 1),
(21, '0001_01_01_000002_create_jobs_table', 1),
(22, '2026_01_01_032535_add_role_to_users_table', 1),
(23, '2026_01_01_034523_create_items_table', 1),
(25, '2026_01_01_144727_add_foto_to_items_table', 2),
(26, '2026_01_01_160834_create_auctions_table', 3),
(27, '2026_01_01_034632_create_bids_table', 4),
(28, '2026_01_04_032837_add_phone_address_to_users_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('45AEtye4DcRXGYta7hkNXN1gfcEkQOAzupJpEz33', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiUUtmZWoyZW9uaVBwb0JQZW5lZkNWWHRSQ3AwcmxIR0Rsbk5tY0xpaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767541328),
('jeR12GNe93NpQILkagaWH31JM1USjOc3HdEynPfB', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUWl4WUxheGFYcjk2V1ZtMHJnZUxBR0FNamJSR2Rac3VQVUtzckNWbSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly90YmxlbGFuZy50ZXN0L2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTM7fQ==', 1767541322),
('k5f08bURN5lM3dJ67qxN8DqBrFsBatmjhzis7aW7', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidnlZWW5DM0xHZVZXVm5IRE5LZFQxNXZrYVJHYzNRTEF1Wm9NVURhcyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1767537883),
('uLEiKVn14Rh03W41yk9bESqgoA32b2DVeKr9Avp1', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMTBqaG1wSzc2MXpqenRmUTlldjlDQnpSa1oxdzNOYzV0QUlNVGpYeSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1767541438);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Utama', 'admin@example.com', NULL, NULL, NULL, '$2y$12$asjWVDdoY/abZLtPn5mjh.EEct1ltAC9VTg1HT1JTZLGGu76MP7xe', 'admin', 'KTG6uIZWUE0hB4JdjsH269NoyrFeUfLWBnajSERR40vHUOnDIS77A70k6IDD', '2026-01-01 01:47:14', '2026-01-01 01:47:14'),
(2, 'contoh', 'contoh@gmail.com', '083139056910', 'JLn jalan dengan selingkuhan', NULL, '$2y$12$ABMbXKcbp1ZakNYeHCBHZ.wV9hZPPRWF3dVluIkqzsVcI7oDXn2/e', 'user', NULL, '2026-01-01 20:14:06', '2026-01-04 00:13:18'),
(13, 'Jule Anj', 'jule@gmail.com', '00000000000', 'kampungan', NULL, '$2y$12$bkwIVX9o6kYbDxMRCulBKeedaSjb3fQFBYLZwbPzT0PKaVUcjzPb2', 'user', NULL, '2026-01-04 07:46:52', '2026-01-04 07:46:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auctions`
--
ALTER TABLE `auctions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auctions_item_id_foreign` (`item_id`),
  ADD KEY `auctions_user_id_foreign` (`user_id`),
  ADD KEY `auctions_petugas_id_foreign` (`petugas_id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bids_auction_id_foreign` (`auction_id`),
  ADD KEY `bids_user_id_foreign` (`user_id`);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auctions`
--
ALTER TABLE `auctions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auctions`
--
ALTER TABLE `auctions`
  ADD CONSTRAINT `auctions_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auctions_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `auctions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `bids_auction_id_foreign` FOREIGN KEY (`auction_id`) REFERENCES `auctions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bids_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
