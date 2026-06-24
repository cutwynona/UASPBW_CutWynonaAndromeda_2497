-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2026 at 12:26 PM
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
-- Database: `stagepass`
--

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
-- Table structure for table `concerts`
--

CREATE TABLE `concerts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `venue` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `quota` int(11) NOT NULL,
  `sold` int(11) NOT NULL DEFAULT 0,
  `bg_color` varchar(255) NOT NULL DEFAULT '#6B21A8',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `poster_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `concerts`
--

INSERT INTO `concerts` (`id`, `title`, `artist`, `description`, `venue`, `city`, `event_date`, `event_time`, `genre`, `price`, `quota`, `sold`, `bg_color`, `is_active`, `created_at`, `updated_at`, `poster_image`) VALUES
(1, 'Guts World Tour.', 'Olivia Rodrigo', 'Grab your tickets now for Olivia Rodrigo\'s GUTS World Tour!', 'Gelora Bung Karno', 'Jakarta, Indonesia', '2026-09-02', '16:00:00', 'Pop', 5000000, 1000, 17, '#a705c7', 1, '2026-06-20 01:25:10', '2026-06-23 14:01:49', 'posters/almpM3LTRERhMjPDsFJvGF5TrKORgMZrWrTejNrU.jpg'),
(2, 'BORN PINK World Tour', 'Black Pink', 'Get ready for an unforgettable night at the BORN PINK World Tour! Experience stunning performances, spectacular visuals, and the biggest hits from BLACKPINK. Join thousands of fans for an electrifying concert filled with energy and excitement. Grab your tickets now and be part of this incredible live experience before they sell out!', 'Gocheok Sky Dome', 'Seoul, South Korea', '2026-12-25', '12:00:00', 'K-Pop', 8000000, 10000, 1, '#ffc2fd', 1, '2026-06-23 09:55:51', '2026-06-23 14:21:48', 'posters/ZvscZftmZbr1UqAgsduqpD76AUtVfaJOaaYL5xR4.jpg'),
(3, 'After Hours Til Dawn Tour', 'The Weeknd', 'Experience The Weeknd live at the After Hours Til Dawn Tour. Enjoy an incredible performance featuring his biggest hits and outstanding stage production. Grab your tickets now before they sell out.', 'Jakarta International Stadium', 'Jakarta, Indonesia', '2026-10-15', '04:00:00', 'R&B / Pop', 6000000, 5000, 1, '#94000f', 1, '2026-06-23 10:00:43', '2026-06-23 12:36:55', 'posters/ItX1KZofURPw2dXNe19iRYV9tpwSoOsRk9lIHM0J.jpg'),
(4, 'Oasis Live \'25', 'Oasis', 'Join Oasis for the Oasis Live \'25 Tour and experience their legendary music live on stage. Don\'t miss this special event featuring timeless hits and an unforgettable concert experience. Grab your tickets now before they sell out.', 'Wembley Stadium', 'London, England', '2027-01-02', '15:00:00', 'Rock', 4000000, 10000, 0, '#292929', 1, '2026-06-23 10:05:03', '2026-06-23 10:05:22', 'posters/JZdc6C2ldhN6DXIoGoCk89O0shP8QKkJRYjqoUZe.jpg'),
(5, 'THE ERAS TOUR', 'Taylor Swift', 'Join Taylor Swift on The Eras Tour and experience an unforgettable night of live music, iconic performances, and chart-topping hits. Grab your tickets now before they sell out.', 'SoFi Stadium', 'Los Angeles, California, USA', '2027-02-28', '12:00:00', 'Pop', 8000000, 10000, 0, '#6c22ec', 1, '2026-06-23 10:08:21', '2026-06-23 10:08:44', 'posters/6aOV1r3z5gV0P9xRLe2rGdXW8J5zsnTmb6RVCIS2.jpg'),
(6, 'COLOR OUTSIDE THE LINES Tour', 'Cortis', 'Experience CORTIS live on the COLOR OUTSIDE THE LINES Tour. Enjoy powerful performances, fan-favorite songs, and an unforgettable concert atmosphere. Grab your tickets now and secure your spot before tickets sell out.', 'Seoul Sky Dome', 'Seoul, South Korea', '2027-01-04', '11:00:00', 'K-Pop', 5000000, 10000, 0, '#275d30', 1, '2026-06-23 10:12:32', '2026-06-23 10:12:42', 'posters/X8TXhYBHxmovneYIXylx0OZ1IF0ishz9S1XEXSwI.jpg'),
(7, 'The Car World Tour', 'Arctic Monkeys', 'Experience Arctic Monkeys live on The Car  World Tour. Enjoy their biggest hits, incredible performances, and an unforgettable concert atmosphere. Grab your tickets now and secure your place at this exciting live music event', 'AO Arena', 'Manchester, England, United Kingdom', '2026-11-02', '12:00:00', 'Rock', 6000000, 10000, 0, '#000000', 1, '2026-06-23 10:16:45', '2026-06-23 10:17:06', 'posters/mtiFLgoDqMQxANAyXmWvv8KhvdN5CO7cYpCRjULL.jpg'),
(8, 'Bunnies Camp', 'Newjeans', 'Experience NewJeans live at Bunnies Camp in Tokyo. Enjoy their biggest hits, captivating performances, and a memorable concert atmosphere. Grab your tickets now and be part of this exciting live music event.', 'Tokyo Dome', 'Tokyo, Japan', '2026-12-31', '14:00:00', 'K-Pop', 5000000, 8000, 0, '#5c7cff', 1, '2026-06-23 12:27:46', '2026-06-23 12:28:05', 'posters/K3ICBYOLlN0H4tj9fkfBtkB5AGIrBA8rCJTv1TK5.jpg'),
(9, '24K Magic World Tour', 'Bruno Mars', 'Experience Bruno Mars live on the 24K Magic World Tour. Enjoy an incredible performance featuring his biggest hits, outstanding stage production, and an unforgettable concert atmosphere. Grab your tickets now and secure your spot before they sell out.', 'Madison Square Garden', 'New York City, New York, USA', '2027-01-07', '16:30:00', 'R&B / Pop', 8000000, 10000, 0, '#ae820a', 1, '2026-06-23 12:32:45', '2026-06-23 12:33:00', 'posters/BXwPv3cncAwwisjklbYgLRcbwYT6OjsZVytI2wEl.jpg'),
(10, 'Roman Picisan Tour', 'Dewa 19', 'Experience Dewa 19 live on the Roman Picisan Tour. Enjoy legendary hits, powerful performances, and an unforgettable concert atmosphere. Grab your tickets now and secure your spot before they sell out.', 'Gelora Bung Karno', 'Jakarta, Indonesia', '2026-08-07', '20:00:00', 'Rock', 3000000, 5000, 0, '#1d1b1b', 1, '2026-06-23 13:00:03', '2026-06-23 13:00:28', 'posters/JvXFy82OLnKJ77lfE9FCK61rdCdgExG0VkAJLFoe.jpg'),
(11, 'Orchids Tour', 'No Na', 'Experience No Na live on the Orchids Tour. Enjoy captivating performances, fan-favorite songs, and an unforgettable concert atmosphere. Grab your tickets now and be part of this exciting live music experience.', 'Gelora Bung Karno', 'Jakarta, Indonesia', '2027-02-08', '19:30:00', 'R&B / Pop', 4000000, 5000, 0, '#fe9162', 1, '2026-06-23 13:07:48', '2026-06-23 13:07:57', 'posters/NcQNkWgRndbF43I7tiZB3cXl2bIvqwxynh7hoEJ2.jpg'),
(12, 'Short n\' Sweet Tour', 'Sabrina Carpenter', 'Experience Sabrina Carpenter live on the Short n\' Sweet Tour. Enjoy an unforgettable performance featuring her biggest hits, stunning stage production, and an exciting concert atmosphere. Grab your tickets now and secure your spot before they sell out.', 'Jakarta International Stadium', 'Jakarta, Indonesia', '2027-01-27', '15:00:00', 'Pop', 4000000, 10000, 0, '#f5bdd0', 1, '2026-06-23 13:15:41', '2026-06-23 13:16:18', 'posters/exEhw0dN07KbBkOH8xrClqik19BnAVdJEDRkFMM5.jpg'),
(13, 'Manusia Tour', 'Tulus', 'Experience Tulus live on the Manusia Tour. Enjoy heartfelt performances, meaningful lyrics, and an unforgettable concert atmosphere featuring his most beloved songs. Grab your tickets now and secure your spot before they sell out.', 'Jakarta International Stadium', 'Jakarta, Indonesia', '2026-08-20', '20:00:00', 'Pop', 300000, 2000, 0, '#454545', 1, '2026-06-23 13:23:15', '2026-06-23 13:30:54', 'posters/YBvASe9kYjlSRkRyUBTnI9WgZ7P0fK97qiG48JJR.jpg'),
(14, 'Tunggu Aku Di Tour', 'Sheila On 7', 'Experience Sheila On 7 live on the Tunggu Aku Di Tour. Enjoy an unforgettable night featuring their greatest hits, energetic performances, and a memorable concert atmosphere. Grab your tickets now and secure your spot before they sell out.', 'Gelora Bung Karno', 'Jakarta, Indonesia', '2026-11-01', '16:00:00', 'Pop', 250000, 4000, 0, '#d30909', 1, '2026-06-23 13:30:39', '2026-06-23 13:30:39', 'posters/Au106cmnSGClzhW9QP8hrfFJxflqzD4UyKFPGV3I.jpg');

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
(4, '2024_01_01_000002_create_concerts_table', 1),
(5, '2024_01_01_000003_create_orders_table', 1),
(6, '2026_06_03_170852_add_poster_image_to_concerts_table', 1),
(7, '2026_06_03_191820_add_profile_photo_to_users_table', 1),
(8, '2026_06_20_075802_add_details_to_orders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `concert_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `ticket_code` varchar(255) NOT NULL,
  `status` enum('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `concert_id`, `qty`, `total_price`, `ticket_code`, `status`, `created_at`, `updated_at`, `name`, `nik`, `payment_method`, `phone`) VALUES
(1, 1, 1, 1, 5000000, 'TKT-XVIFCV9U', 'confirmed', '2026-06-23 12:34:50', '2026-06-23 12:35:04', 'wyna', '098765432112345', 'BCA', '081234567890'),
(2, 1, 3, 1, 6000000, 'TKT-61MTBLMR', 'confirmed', '2026-06-23 12:36:55', '2026-06-23 12:37:09', 'wyna', '098765432112345', 'BSI', '081234567890'),
(3, 1, 2, 1, 8000000, 'TKT-7E18SOGM', 'confirmed', '2026-06-23 14:21:48', '2026-06-23 14:21:56', 'wyna', '098765432112345', 'MANDIRI', '081234567890');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('kymCvRfS7sUDNwERymn4FOQrrTMQICwrrEItKXkT', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieHJ1cEhtRXlJT1RudTluVjlEWWJ4ZUYzU05mcElZNmhRWnhQdWdJSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1782242528),
('mbfDRK2G2oDLnpa9jcb1VMOgKCpIFfulRw3t9L21', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUGRuc3dRajNUbHh5WDRocVFnQXIxdDlKTkNSNVFrWnZhb09zUFpUaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1782243385),
('Nt6kQquDTX7Sa2elKbfx4H3JHZ5QEwsdVRby2Hbi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVThucFkyYjJSbUxpRnRNcnFrcUNhUVdrZk43N0U1YWlINnRObFJmMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1782249741);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'customer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `profile_photo`) VALUES
(1, 'wyna', 'wynaa@gmail.com', '082165354647', 'customer', NULL, '$2y$12$3c99L/gU5Qi9LEA6tZmMKeMPGtZl5fMUnUeuNIVEYstyzhYEXUaoC', NULL, '2026-06-20 01:05:03', '2026-06-20 01:05:03', NULL),
(2, 'Admin', 'admin@stagepass.com', '000000000000', 'admin', NULL, '$2y$12$UfBdP7BtErdGAswcGg11ZuEnBP6ZvNS4Eeo8rC5HakBFPK5395ALO', NULL, '2026-06-20 01:13:21', '2026-06-20 01:22:04', NULL),
(3, 'tania', 'tania@gmail.com', '081234555674', 'customer', NULL, '$2y$12$1CppIP1TJWuCd7d30XQOHuuRLkCvM53sK4N4e1HNvBBLyOhdTrWUu', NULL, '2026-06-20 01:26:05', '2026-06-20 01:26:05', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `concerts`
--
ALTER TABLE `concerts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_ticket_code_unique` (`ticket_code`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_concert_id_foreign` (`concert_id`);

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
-- AUTO_INCREMENT for table `concerts`
--
ALTER TABLE `concerts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_concert_id_foreign` FOREIGN KEY (`concert_id`) REFERENCES `concerts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
