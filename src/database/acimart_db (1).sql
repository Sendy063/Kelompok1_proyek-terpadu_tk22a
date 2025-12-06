-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 06 Des 2025 pada 16.43
-- Versi server: 8.0.30
-- Versi PHP: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acimart_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1764826457),
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1764826457;', 1764826457),
('laravel-cache-admin@acimart.com|127.0.0.1', 'i:1;', 1762444796),
('laravel-cache-admin@acimart.com|127.0.0.1:timer', 'i:1762444796;', 1762444796),
('laravel-cache-budi@gmail.com|127.0.0.1', 'i:1;', 1764390966),
('laravel-cache-budi@gmail.com|127.0.0.1:timer', 'i:1764390966;', 1764390966);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_06_145833_create_produks_table', 1),
(5, '2025_11_06_151449_add_is_admin_to_users_table', 1),
(6, '2025_11_06_160155_create_produk', 2),
(7, '2025_11_23_040626_create_orders_table', 3),
(8, '2025_11_23_041512_create_orders_table', 4),
(9, '2025_12_04_032744_add_fields_to_orders_table', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` date NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `status` enum('baru','diproses','dikirim','selesai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `customer`, `order_date`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, 'fajrul', '2025-11-25', 100000.00, 'dikirim', '2025-11-22 21:25:22', '2025-11-28 22:04:10'),
(2, 'Sendy', '2025-12-04', 10000.00, 'diproses', '2025-12-03 20:37:55', '2025-12-03 21:55:14'),
(3, 'Sendy', '2025-12-04', 16000.00, 'dikirim', '2025-12-03 20:38:48', '2025-12-03 22:13:44'),
(4, 'Sendy', '2025-12-04', 0.00, 'baru', '2025-12-03 20:39:27', '2025-12-03 20:39:27'),
(5, 'Sendy', '2025-12-04', 10000.00, 'baru', '2025-12-03 20:40:04', '2025-12-03 20:40:04'),
(6, 'Sendy', '2025-12-04', 0.00, 'baru', '2025-12-03 20:43:37', '2025-12-03 20:43:37'),
(7, 'Sendy', '2025-12-04', 10000.00, 'baru', '2025-12-03 20:45:44', '2025-12-03 20:45:44'),
(8, 'Sendy', '2025-12-04', 0.00, 'baru', '2025-12-03 20:47:36', '2025-12-03 20:47:36'),
(9, 'Sendy', '2025-12-04', 10000.00, 'baru', '2025-12-03 20:48:18', '2025-12-03 20:48:18'),
(10, 'Sendy', '2025-12-04', 51000.00, 'baru', '2025-12-03 21:07:53', '2025-12-03 21:07:53'),
(11, 'Sendy', '2025-12-04', 1000.00, 'baru', '2025-12-03 21:15:59', '2025-12-03 21:15:59'),
(12, 'Sendy', '2025-12-04', 10000.00, 'baru', '2025-12-03 21:52:23', '2025-12-03 21:52:23'),
(13, 'Sendy', '2025-12-04', 16000.00, 'baru', '2025-12-03 22:14:51', '2025-12-03 22:14:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_tapioka`
--

CREATE TABLE `produk_tapioka` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metode` enum('dibakar','digoreng','direbus') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `harga` decimal(10,2) NOT NULL DEFAULT '0.00',
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promo` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produk_tapioka`
--

INSERT INTO `produk_tapioka` (`id`, `nama`, `metode`, `deskripsi`, `harga`, `gambar`, `promo`, `created_at`, `updated_at`) VALUES
(1, 'cireng', 'dibakar', 'wsqwq', 10000.00, 'tapioka/01K9CZM6E2WBE4HFSFYBT2YR7Y.png', 1, '2025-11-06 09:22:34', '2025-11-06 09:57:58'),
(2, 'Bakso Aci', 'dibakar', 'Rasanya enak', 10000.00, 'tapioka/01KBKXKJ0HXDK7448DDT2QV4H7.jpg', 1, '2025-11-16 17:25:39', '2025-12-03 22:33:20'),
(3, 'teci', 'dibakar', 'enak', 1000.00, NULL, 1, '2025-11-28 21:44:13', '2025-11-28 21:56:52'),
(4, 'cipak koceak', 'dibakar', 'enak', 5000.00, NULL, 1, '2025-11-28 21:57:28', '2025-11-28 21:57:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('O9SI3QK6wV4uWSOHly83tQQ5NxDTDnEBtsQaBLq0', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiQWQ5WlU0SFVzdWtOVU5lRGIybTVGOXh4eVVyYk5ZNjkxc2hlTTNtMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wcm9kdWstYWNpIjtzOjU6InJvdXRlIjtzOjQxOiJmaWxhbWVudC5hZG1pbi5yZXNvdXJjZXMucHJvZHVrLWFjaS5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRHSE5ZRFQ1c3JqbmdnN3Y3ZGhCVzJPaVlMOGtSTTRjcnZTdWkwWFlWQ1BuTXdMcWRTOFliQyI7czo4OiJmaWxhbWVudCI7YTowOnt9czo0OiJjYXJ0IjthOjI6e2k6MDthOjI6e3M6OToicHJvZHVrX2lkIjtzOjE6IjEiO3M6ODoicXVhbnRpdHkiO2k6MTt9aToxO2E6Mjp7czo5OiJwcm9kdWtfaWQiO3M6MToiMiI7czo4OiJxdWFudGl0eSI7aToxO319fQ==', 1764828339);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'Admin Aci', 'admin@acimart.test', NULL, '$2y$12$GHNYDT5srjngg7v7dhBW2OiYL8kRM4crvSui0XYVCPnMwLqdS8YbC', NULL, '2025-11-06 08:58:31', '2025-11-06 08:58:31', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `produk_tapioka`
--
ALTER TABLE `produk_tapioka`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `produk_tapioka`
--
ALTER TABLE `produk_tapioka`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
