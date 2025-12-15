-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 15 Des 2025 pada 06.26
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
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1765393493),
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1765393493;', 1765393493),
('laravel-cache-admin@smknu-tulis.sch.id|127.0.0.1', 'i:1;', 1765772381),
('laravel-cache-admin@smknu-tulis.sch.id|127.0.0.1:timer', 'i:1765772381;', 1765772381);

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
(9, '2025_12_04_032744_add_fields_to_orders_table', 5),
(12, '2025_12_10_043424_add_user_id_to_orders_table', 6),
(14, '2025_12_10_055312_create_new_orders_table', 7),
(15, '2025_12_10_234000_add_payment_token_to_orders_table', 8),
(16, '2025_12_10_235500_modify_orders_table_enum_to_string', 9),
(17, '2025_12_15_022737_add_address_and_phone_to_users_table', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_date` date NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `items` json DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'baru',
  `payment_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer`, `email`, `alamat`, `telepon`, `order_date`, `total`, `items`, `payment_method`, `status`, `payment_token`, `created_at`, `updated_at`) VALUES
(26, 2, 'Sabela', 'sabel@gmail.com', 'Jl kyai surgi', '08656372623', '2025-12-10', 21000.00, '[{\"nama\": \"cireng\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 1}, {\"nama\": \"Bakso Aci\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 2}, {\"nama\": \"teci\", \"harga\": \"1000.00\", \"quantity\": 1, \"subtotal\": 1000, \"produk_id\": 3}]', 'midtrans', 'selesai', 'a11d7d38-d420-4902-8842-2dfcf9a43422', '2025-12-10 10:43:33', '2025-12-10 11:06:38'),
(27, 3, 'Falah', 'falah@gmail.com', 'kaligawe', '0876736723', '2025-12-10', 30000.00, '[{\"nama\": \"cipak koceak\", \"harga\": \"5000.00\", \"quantity\": \"6\", \"subtotal\": 30000, \"produk_id\": 4}]', 'midtrans', 'diproses', '087ca1c7-61d0-458a-ae13-c8cafa58391a', '2025-12-10 11:14:52', '2025-12-14 18:23:16'),
(28, 3, 'Falah', 'falah@gmail.com', 'kaligawe', '08656372623', '2025-12-10', 10000.00, '[{\"nama\": \"Bakso Aci\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 2}]', 'midtrans', 'diproses', '488ec272-84f6-480f-94e3-43d0d4fad262', '2025-12-10 11:15:58', '2025-12-10 11:17:28'),
(29, 3, 'Falah', 'falah@gmail.com', 'kaligawe', '08656372623', '2025-12-10', 10000.00, '[{\"nama\": \"Bakso Aci\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 2}]', 'midtrans', 'diproses', '332d8cea-0470-4eda-b867-d42a64804ffc', '2025-12-10 11:18:31', '2025-12-14 18:12:22'),
(30, 3, 'Falah', 'falah@gmail.com', 'kaligawe', '08656372623', '2025-12-10', 0.00, '[]', 'midtrans', 'pending_payment', NULL, '2025-12-10 11:20:26', '2025-12-10 11:20:26'),
(31, 3, 'Falah', 'falah@gmail.com', 'ded', '08656372623', '2025-12-10', 10000.00, '[{\"nama\": \"Bakso Aci\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 2}]', 'midtrans', 'pending_payment', 'eb5e3686-367c-4365-8f2a-a05fb127b067', '2025-12-10 11:38:31', '2025-12-10 11:38:32'),
(32, 2, 'Sabela', 'sabel@gmail.com', 'hsdjk', '08656372623', '2025-12-12', 10000.00, '[{\"nama\": \"cireng\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 1}]', 'midtrans', 'dikirim', 'cfdd1b09-072f-4754-85d4-4d141dbaf43b', '2025-12-12 07:28:26', '2025-12-14 18:23:28'),
(33, 2, 'Sabela', 'sabel@gmail.com', 'weeee', 'wewewe', '2025-12-15', 10000.00, '[{\"nama\": \"Bakso Aci\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 2}]', 'midtrans', 'selesai', '118d941e-977c-4af6-8521-c4b28debd907', '2025-12-14 18:14:32', '2025-12-14 18:15:22'),
(34, 2, 'Sabela', 'sabel@gmail.com', 'shjashajas', '0865754357', '2025-12-15', 10000.00, '[{\"nama\": \"cireng\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 1}]', 'midtrans', 'pending_payment', '856061fa-86be-40fc-9a64-7d75762004eb', '2025-12-14 18:49:26', '2025-12-14 18:49:27'),
(35, 2, 'Sabela', 'sabel@gmail.com', 'Jl kyaii', '0865754357', '2025-12-15', 10000.00, '[{\"nama\": \"Bakso Aci\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 2}]', 'midtrans', 'pending_payment', '66cea480-c597-44f0-a1b7-86162e22df3c', '2025-12-14 18:53:17', '2025-12-14 18:53:18'),
(36, 2, 'Sabela', 'sabel@gmail.com', 'Jl kyaii', '0865754357', '2025-12-15', 0.00, '[]', 'midtrans', 'pending_payment', NULL, '2025-12-14 18:53:56', '2025-12-14 18:53:56'),
(37, 2, 'Sabela', 'sabel@gmail.com', 'hajhjasja', '0865754357', '2025-12-15', 20000.00, '[{\"nama\": \"Bakso Aci\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 2}, {\"nama\": \"cireng\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 1}]', 'midtrans', 'pending_payment', 'a9951cd4-21b7-4b64-bf18-e392ccdaa9e7', '2025-12-14 18:54:24', '2025-12-14 18:54:25'),
(38, 2, 'Sabela', 'sabel@gmail.com', 'weeee', '232323', '2025-12-15', 1000.00, '[{\"nama\": \"teci\", \"harga\": \"1000.00\", \"quantity\": \"1\", \"subtotal\": 1000, \"produk_id\": 3}]', 'midtrans', 'pending_payment', '54cea369-4834-42ad-9db6-158d2111219c', '2025-12-14 18:58:53', '2025-12-14 18:58:54'),
(39, 2, 'Sabela', 'sabel@gmail.com', 'qwqqw', '0865754357', '2025-12-15', 10000.00, '[{\"nama\": \"cireng\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 1}]', 'midtrans', 'pending_payment', 'b16e1c47-fdb9-4ab5-a77e-5087f6ff5318', '2025-12-14 19:00:25', '2025-12-14 19:00:26'),
(40, 2, 'Sabela', 'sabel@gmail.com', 'qwqqw', '0865754357', '2025-12-15', 0.00, '[]', 'midtrans', 'pending_payment', NULL, '2025-12-14 19:00:54', '2025-12-14 19:00:54'),
(41, 2, 'Sabela', 'sabel@gmail.com', 'weeee', 'wewewe', '2025-12-15', 1000.00, '[{\"nama\": \"teci\", \"harga\": \"1000.00\", \"quantity\": 1, \"subtotal\": 1000, \"produk_id\": 3}]', 'midtrans', 'pending_payment', 'f109222f-62f9-457d-81b9-223d3a8c505c', '2025-12-14 19:04:54', '2025-12-14 19:04:55'),
(42, 2, 'Sabela', 'sabel@gmail.com', 'Jl kaligawe', '077378347834', '2025-12-15', 70000.00, '[{\"nama\": \"cireng\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 1}, {\"nama\": \"Bakso Aci\", \"harga\": \"10000.00\", \"quantity\": \"6\", \"subtotal\": 60000, \"produk_id\": 2}]', 'midtrans', 'pending_payment', '218342b5-2edf-4ded-b56b-9a7b8dac7fbd', '2025-12-14 19:44:54', '2025-12-14 19:44:55'),
(43, 2, 'Sabela', 'sabel@gmail.com', 'Jl kaligawe', '077378347834', '2025-12-15', 110000.00, '[{\"nama\": \"cireng\", \"harga\": \"10000.00\", \"quantity\": 5, \"subtotal\": 50000, \"produk_id\": 1}, {\"nama\": \"Bakso Aci\", \"harga\": \"10000.00\", \"quantity\": 6, \"subtotal\": 60000, \"produk_id\": 2}]', 'midtrans', 'pending_payment', 'fcb9a70d-2a90-4e4c-bcd1-f8193bc712d4', '2025-12-14 20:31:17', '2025-12-14 20:31:18'),
(44, 2, 'Sabela', 'sabel@gmail.com', 'Jl kaligawe', '077378347834', '2025-12-15', 10000.00, '[{\"nama\": \"Bakso Aci\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 2}]', 'midtrans', 'pending_payment', '794315bb-f538-4b17-9997-2121e80207e5', '2025-12-14 20:38:24', '2025-12-14 20:38:25'),
(45, 2, 'Sabela', 'sabel@gmail.com', 'Jl kaligawe', '077378347834', '2025-12-15', 5000.00, '[{\"nama\": \"cipak koceak\", \"harga\": \"5000.00\", \"quantity\": 1, \"subtotal\": 5000, \"produk_id\": 4}]', 'midtrans', 'pending_payment', '2aa978aa-17ef-45af-ba94-11fd0b1a9e91', '2025-12-14 21:03:20', '2025-12-14 21:03:21'),
(46, 2, 'Sabela', 'sabel@gmail.com', 'Jl kaligawe', '077378347834', '2025-12-15', 5000.00, '[{\"nama\": \"cipak koceak\", \"harga\": \"5000.00\", \"quantity\": 1, \"subtotal\": 5000, \"produk_id\": 4}]', 'midtrans', 'pending_payment', '757cb2cc-66f8-4143-b680-c44110a48ac9', '2025-12-14 21:04:48', '2025-12-14 21:04:49'),
(47, 6, 'Milaaa', 'miladiyah781@gmail.com', 'Pemalang', '089630379862', '2025-12-15', 20000.00, '[{\"nama\": \"cireng\", \"harga\": \"10000.00\", \"quantity\": \"2\", \"subtotal\": 20000, \"produk_id\": 1}]', 'midtrans', 'pending_payment', '6a17f3fe-7947-4fcd-b13b-561f85b28daa', '2025-12-14 21:19:42', '2025-12-14 21:19:43'),
(48, 6, 'Milaaa', 'miladiyah781@gmail.com', 'Pemalang', '089630379862', '2025-12-15', 0.00, '[]', 'midtrans', 'pending_payment', NULL, '2025-12-14 21:21:34', '2025-12-14 21:21:34'),
(49, 2, 'Sabela', 'sabel@gmail.com', 'Jl kaligawe', '077378347834', '2025-12-15', 5000.00, '[{\"nama\": \"cipak koceak\", \"harga\": \"5000.00\", \"quantity\": 1, \"subtotal\": 5000, \"produk_id\": 4}]', 'midtrans', 'pending_payment', 'de33bb8e-6758-44b1-ab2d-fb6c06225c9f', '2025-12-14 21:42:03', '2025-12-14 21:42:04'),
(50, 2, 'Sabela', 'sabel@gmail.com', 'Jl kaligawe', '077378347834', '2025-12-15', 10000.00, '[{\"nama\": \"cireng\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 1}]', 'midtrans', 'pending_payment', 'b7a1bc2e-24cf-43dd-85e5-25baa1b6e168', '2025-12-14 21:57:24', '2025-12-14 21:57:25'),
(51, 2, 'Sabela', 'sabel@gmail.com', 'Jl kaligawe', '077378347834', '2025-12-15', 10000.00, '[{\"nama\": \"Bakso Aci\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 2}]', 'midtrans', 'pending_payment', '8b7aab00-6cef-4646-b7f8-b56b672ca11c', '2025-12-14 21:58:07', '2025-12-14 21:58:08'),
(52, 2, 'Sabela', 'sabel@gmail.com', 'Jl kaligawe', '077378347834', '2025-12-15', 10000.00, '[{\"nama\": \"cireng\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 1}]', 'midtrans', 'pending_payment', '524a1684-c723-45f7-8f94-d95e56b6860a', '2025-12-14 22:01:15', '2025-12-14 22:01:16'),
(53, 2, 'Sabela', 'sabel@gmail.com', 'Jl kaligawe', '077378347834', '2025-12-15', 0.00, '[]', 'midtrans', 'pending_payment', NULL, '2025-12-14 22:01:32', '2025-12-14 22:01:32'),
(54, 2, 'Sabela', 'sabel@gmail.com', 'Jl kaligawe', '077378347834', '2025-12-15', 10000.00, '[{\"nama\": \"Bakso Aci\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 2}]', 'midtrans', 'pending_payment', 'eb18a44b-be60-409e-a962-bd718ead8560', '2025-12-14 22:01:58', '2025-12-14 22:01:58'),
(55, 2, 'Sabela', 'sabel@gmail.com', 'Jl kaligawe', '077378347834', '2025-12-15', 10000.00, '[{\"nama\": \"Bakso Aci\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 2}]', 'midtrans', 'pending_payment', '387e1ab8-6588-42fb-bdf0-52efc5d136bf', '2025-12-14 22:31:09', '2025-12-14 22:31:10'),
(56, 2, 'Sabela', 'sabel@gmail.com', 'Jl kaligawe', '077378347834', '2025-12-15', 10000.00, '[{\"nama\": \"Bakso Aci\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 2}]', 'midtrans', 'pending_payment', '2896b92a-6c75-4fdd-b879-6d4a87f39ca7', '2025-12-14 22:32:49', '2025-12-14 22:32:50'),
(57, 2, 'Sabela', 'sabel@gmail.com', 'Jl kaligawe', '077378347834', '2025-12-15', 1000.00, '[{\"nama\": \"teci\", \"harga\": \"1000.00\", \"quantity\": 1, \"subtotal\": 1000, \"produk_id\": 3}]', 'midtrans', 'pending_payment', 'e539695f-4b80-428c-a1d4-f76693258569', '2025-12-14 22:37:12', '2025-12-14 22:37:12'),
(58, 2, 'Sabela', 'sabel@gmail.com', 'Jl kaligawe', '077378347834', '2025-12-15', 260000.00, '[{\"nama\": \"cireng\", \"harga\": \"10000.00\", \"quantity\": 26, \"subtotal\": 260000, \"produk_id\": 1}]', 'midtrans', 'pending_payment', '26dea410-dd27-47d6-9e6b-e24fa4091a9d', '2025-12-14 22:38:45', '2025-12-14 22:38:45'),
(59, 2, 'Sabela', 'sabel@gmail.com', 'Jl kaligawe', '077378347834', '2025-12-15', 10000.00, '[{\"nama\": \"Bakso Aci\", \"harga\": \"10000.00\", \"quantity\": 1, \"subtotal\": 10000, \"produk_id\": 2}]', 'midtrans', 'pending_payment', '36922460-d13e-467c-809f-237fbfc41fa9', '2025-12-14 22:41:13', '2025-12-14 22:41:14');

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
(3, 'teci', 'dibakar', 'enak', 1000.00, 'tapioka/01KBT9NRNNDTTE9R2PYME327FJ.jpg', 1, '2025-11-28 21:44:13', '2025-12-06 09:59:42'),
(4, 'cipak koceak', 'dibakar', 'enak', 5000.00, 'tapioka/01KC4TC95ZQMP2KQYYQAA943VD.png', 0, '2025-11-28 21:57:28', '2025-12-10 12:04:01');

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
('4TIOyNKUl5XuZ7FSqBljNqX3zVz9XF7HCWVBR17U', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoibktGTkVDOEl3cDdvWTBWZzA3ODVDZHNvZFVzUEpkVFNldHh3amIxSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vYzcxNDE3MmQ0MjJlLm5ncm9rLWZyZWUuYXBwL2FkbWluIjtzOjU6InJvdXRlIjtzOjMwOiJmaWxhbWVudC5hZG1pbi5wYWdlcy5kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkR0hOWURUNXNyam5nZzd2N2RoQlcyT2lZTDhrUk00Y3J2U3VpMFhZVkNQbk13THFkUzhZYkMiO30=', 1765775672),
('53Et92SnmBlKrHgCVOHyi34jiaTRQmioQZUMdjzk', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36 OPR/93.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiclZYaFNqa0R1ckxzcUJKUXdTck5ZMk1rbGtqVUJXQjhXSFRHSVZnbiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNDoiaHR0cDovL2M3MTQxNzJkNDIyZS5uZ3Jvay1mcmVlLmFwcCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vYzcxNDE3MmQ0MjJlLm5ncm9rLWZyZWUuYXBwL2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765772322),
('5yIh5arnLxJD66gGWIJoNFUcx9RpBESnVXJiLqf3', 2, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiM1JjVHVQMFFyQVR5NHZZSGJWcUxldTZiV29zUFFpWHZhZVB4aFNLMyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vYzcxNDE3MmQ0MjJlLm5ncm9rLWZyZWUuYXBwL2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1765773639),
('6U4D8OV0O5Pl7egNNF2HHTqlPzEt9nNmjvaOlrz6', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRGNQRTdPRXF0S1RibEN4ZlJ1VHVUQmxXTm9aYnJKZjI3QVhqWm9VdiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNDoiaHR0cDovL2M3MTQxNzJkNDIyZS5uZ3Jvay1mcmVlLmFwcCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQzOiJodHRwOi8vYzcxNDE3MmQ0MjJlLm5ncm9rLWZyZWUuYXBwL3JlZ2lzdGVyIjtzOjU6InJvdXRlIjtzOjg6InJlZ2lzdGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765774441),
('gqbb0X7Abu6rdHmafJiZcGTCYTCLellAdHTBHkTL', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiUkVOM2pIWDNLcTBVMjZUcEwwamZRNlhVUFhpa2k1SEFsRWdDT0h0YyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vYzcxNDE3MmQ0MjJlLm5ncm9rLWZyZWUuYXBwIjtzOjU6InJvdXRlIjtOO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkZHZSQUlBWTJtV2Q3OGFTTUcvekxOdU5Bci9uM0JWdFRKS0M3RVE3MFN2V2hkRmlZNG9kbWEiO30=', 1765774979),
('hbTMoWNzhxKqECcEIzNdag4pjSPVlNfHLYS44cp9', 6, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Mobile Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQXpvazBhNzZYb0NRZ1NZZnVIbnlJQkY3d2Q4a01oc3FsQWl2WDZrNSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQzOiJodHRwOi8vYzcxNDE3MmQ0MjJlLm5ncm9rLWZyZWUuYXBwL2NoZWNrb3V0IjtzOjU6InJvdXRlIjtzOjEzOiJjYXJ0LmNoZWNrb3V0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njt9', 1765772495),
('kY9mvyA56m9EjUMe623IXAOXNEyL2HGlB0ZvDB7M', 2, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidktHYXZ5aGZXWWpGWjc0UnhERTJDYmV6ckFvV0xSVGJBTHZybUw4bSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9jNzE0MTcyZDQyMmUubmdyb2stZnJlZS5hcHAiO3M6NToicm91dGUiO047fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1765775612),
('lGJKzTefi5a1ET0Orj58pQLiPil4X5Cfclu3TE1X', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoibUhvaTJGZUNrMlIxTmVoRUJoVlk0Mm5ZNE45aWxTbXRCY1k5WHdoWiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI4OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvb3JkZXJzIjtzOjU6InJvdXRlIjtzOjEyOiJvcmRlcnMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkZHZSQUlBWTJtV2Q3OGFTTUcvekxOdU5Bci9uM0JWdFRKS0M3RVE3MFN2V2hkRmlZNG9kbWEiO30=', 1765777282),
('pHQR0cLT8wtLrf5EXPWbOo42LKnBwQsOhaD96mD2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVXRiMjJMVEx3VnJSaTVKblRheTdIeDVJVTlQbmdnZlFKTzJXaHhQaCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765776026),
('sCM6Uxl4TCbHlJ9uZVVzQs7HgjUUngkvqZAyDtoJ', NULL, '127.0.0.1', 'WhatsApp/2.23.20.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM0U5WU1nSGZOM0tDaFRnVFNRcWZNRHFXdG1aMW9nUHZ6RWdvMzhxTSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNDoiaHR0cDovL2M3MTQxNzJkNDIyZS5uZ3Jvay1mcmVlLmFwcCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vYzcxNDE3MmQ0MjJlLm5ncm9rLWZyZWUuYXBwL2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765771752),
('vg5jDEWqLaOfL1RsJWPzzH13SXhZiRBtVl7j2tgB', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiMXVITkJHWUxBaWRMVVZqMjd6Umhsb2hLYmM5UFczUk5OUGVadDkzYyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4iO3M6NToicm91dGUiO3M6MzA6ImZpbGFtZW50LmFkbWluLnBhZ2VzLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRHSE5ZRFQ1c3JqbmdnN3Y3ZGhCVzJPaVlMOGtSTTRjcnZTdWkwWFlWQ1BuTXdMcWRTOFliQyI7czo4OiJmaWxhbWVudCI7YTowOnt9fQ==', 1765779962);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `users` (`id`, `name`, `email`, `address`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'Admin Aci', 'admin@acimart.test', NULL, NULL, NULL, '$2y$12$GHNYDT5srjngg7v7dhBW2OiYL8kRM4crvSui0XYVCPnMwLqdS8YbC', NULL, '2025-11-06 08:58:31', '2025-11-06 08:58:31', 1),
(2, 'Sabela', 'sabel@gmail.com', 'Jl kaligawe', '077378347834', NULL, '$2y$12$dvRAIAY2mWd78aSMG/zLNuNAr/n3BVtTJKC7EQ70SvWhdFiY4odma', NULL, NULL, '2025-12-14 19:31:53', 0),
(3, 'Falah', 'falah@gmail.com', NULL, NULL, NULL, '$2y$12$Y3dgtJcy7Q491pXId22mjOi5bpjkt3sqMXXAypDoxkFn/aPccp0e6', NULL, NULL, '2025-12-10 11:09:51', 0),
(5, 'Sendy Setyawan', 'budi@gmail.com', NULL, NULL, NULL, '$2y$12$jccDVh2Nlo0HdKrmWvxrVODZu33qu7UKOpyFpbvp5BBzoNd1Gxtdm', NULL, '2025-12-14 17:52:53', '2025-12-14 17:52:53', 0),
(6, 'Milaaa', 'miladiyah781@gmail.com', NULL, NULL, NULL, '$2y$12$bKGToDm.UTIRgl4/YvyYUux6Xezs76bqJ9UnleatX6o7fBN/Obg4S', NULL, '2025-12-14 21:18:21', '2025-12-14 21:18:21', 0),
(7, 'T', 't@gmail.com', NULL, NULL, NULL, '$2y$12$FauHUk6fBR.OOu5Yk6lXxuTVtGNT.8WPIWqr7uuKcOdfpF9GW0RRy', NULL, '2025-12-14 21:53:53', '2025-12-14 21:53:53', 0);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `produk_tapioka`
--
ALTER TABLE `produk_tapioka`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
