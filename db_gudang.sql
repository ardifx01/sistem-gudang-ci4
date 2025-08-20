-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2025 at 12:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gudang`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(12, 'IT EQUIPMENTS', '2025-08-21 04:54:41', '2025-08-21 04:54:41'),
(13, 'OFFICE EQUIPMENTS', '2025-08-21 04:55:03', '2025-08-21 04:55:03'),
(14, 'SPARE PART', '2025-08-21 04:55:16', '2025-08-21 04:55:16'),
(15, 'KENDARAAN & ALAT BERAT', '2025-08-21 04:55:28', '2025-08-21 04:55:28'),
(16, 'PERALATAN ELEKTRONIK', '2025-08-21 04:55:51', '2025-08-21 04:55:51'),
(17, 'ALAT KESELAMATAN KERJA (K3)', '2025-08-21 05:08:07', '2025-08-21 05:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `incoming_transactions`
--

CREATE TABLE `incoming_transactions` (
  `id` int(11) UNSIGNED NOT NULL,
  `purchase_id` int(11) UNSIGNED DEFAULT NULL,
  `product_id` int(5) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `incoming_date` date NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `incoming_transactions`
--

INSERT INTO `incoming_transactions` (`id`, `purchase_id`, `product_id`, `quantity`, `incoming_date`, `created_at`) VALUES
(1, 18, 11, 10, '2025-08-21', '2025-08-21 05:26:02'),
(2, 18, 45, 34, '2025-08-21', '2025-08-21 05:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-08-19-155437', 'App\\Database\\Migrations\\CreateCategoriesTable', 'default', 'App', 1755620008, 1),
(2, '2025-08-19-155453', 'App\\Database\\Migrations\\CreateVendorsTable', 'default', 'App', 1755620008, 1),
(3, '2025-08-19-155505', 'App\\Database\\Migrations\\CreateProductsTable', 'default', 'App', 1755620008, 1),
(4, '2025-08-19-155521', 'App\\Database\\Migrations\\CreatePurchasesTable', 'default', 'App', 1755620008, 1),
(5, '2025-08-19-155539', 'App\\Database\\Migrations\\CreatePurchaseDetailsTable', 'default', 'App', 1755620008, 1),
(6, '2025-08-19-155550', 'App\\Database\\Migrations\\CreateIncomingTransactionsTable', 'default', 'App', 1755620008, 1),
(7, '2025-08-19-155559', 'App\\Database\\Migrations\\CreateOutgoingTransactionsTable', 'default', 'App', 1755620008, 1),
(8, '2025-08-19-183711', 'App\\Database\\Migrations\\AddStatusToPurchases', 'default', 'App', 1755628691, 2);

-- --------------------------------------------------------

--
-- Table structure for table `outgoing_transactions`
--

CREATE TABLE `outgoing_transactions` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(5) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `outgoing_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `outgoing_transactions`
--

INSERT INTO `outgoing_transactions` (`id`, `product_id`, `quantity`, `outgoing_date`, `description`, `created_at`) VALUES
(1, 46, 5, '2025-08-21', 'Perbaikan Logistik', '2025-08-21 05:27:22');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(5) UNSIGNED NOT NULL,
  `category_id` int(5) UNSIGNED NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `code`, `name`, `unit`, `stock`, `created_at`, `updated_at`) VALUES
(7, 12, 'IT001', 'Monitor LED 24 inch', 'Unit', 15, '2025-08-21 04:59:47', '2025-08-21 04:59:47'),
(9, 13, 'OE001', 'Pulpen Gel Hitam', 'Pcs', 50, '2025-08-21 05:00:55', '2025-08-21 05:00:55'),
(11, 14, 'SP001', 'Busi Mesin V6', 'Pcs', 20, '2025-08-21 05:02:25', '2025-08-21 05:26:02'),
(42, 13, 'OFF001', 'Kursi Kantor Ergonomis', 'Unit', 5, '2025-08-21 05:16:22', '2025-08-21 05:16:22'),
(43, 13, 'OFF002', 'Mesin Fotokopi Multifungsi', 'Unit', 2, '2025-08-21 05:16:53', '2025-08-21 05:16:53'),
(44, 14, 'SP002', 'Bearing 6205Z', 'Pcs', 50, '2025-08-21 05:17:31', '2025-08-21 05:17:31'),
(45, 15, 'KA001', 'Hydraulic Jack 10 Ton', 'Unit', 36, '2025-08-21 05:18:09', '2025-08-21 05:26:02'),
(46, 15, 'KA002', 'Ban Truk 1000R20\'', 'Pcs', 5, '2025-08-21 05:18:45', '2025-08-21 05:27:22'),
(47, 16, 'EL001', 'Multimeter Digital', 'Unit', 7, '2025-08-21 05:19:29', '2025-08-21 05:19:29'),
(48, 16, 'EL002', 'Kabel LAN Cat6 50m', 'Roll', 12, '2025-08-21 05:19:56', '2025-08-21 05:19:56'),
(49, 17, 'AK001', 'Helm Safety Proyek', 'Pcs', 25, '2025-08-21 05:20:37', '2025-08-21 05:20:37'),
(50, 17, 'AK002', 'Rompi Reflektor', 'Pcs', 40, '2025-08-21 05:21:16', '2025-08-21 05:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) UNSIGNED NOT NULL,
  `vendor_id` int(5) UNSIGNED NOT NULL,
  `purchase_date` date NOT NULL,
  `total_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `buyer_name` varchar(100) NOT NULL,
  `status` enum('Pending','Selesai') DEFAULT 'Pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `vendor_id`, `purchase_date`, `total_amount`, `buyer_name`, `status`, `created_at`, `updated_at`) VALUES
(18, 10, '2025-08-21', 27000000.00, 'Admin', 'Selesai', '2025-08-21 05:23:49', '2025-08-21 05:26:02'),
(19, 7, '2025-08-21', 42800000.00, 'Staff Gudang', 'Pending', '2025-08-21 05:25:03', '2025-08-21 05:25:03'),
(20, 9, '2025-08-21', 1500000000.00, 'Manajer Logistik', 'Pending', '2025-08-21 05:25:33', '2025-08-21 05:25:33');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `purchase_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(5) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `purchase_id`, `product_id`, `quantity`, `price`) VALUES
(1, 18, 11, 10, 1000000.00),
(2, 18, 45, 34, 500000.00),
(3, 19, 49, 108, 350000.00),
(4, 19, 50, 20, 250000.00),
(5, 20, 46, 1000, 1500000.00);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(6, 'PT. Elektrindo Raya', 'Jl. Jenderal Sudirman No. 10, Jakarta', '081234567890', '2025-08-21 04:56:42', '2025-08-21 04:56:42'),
(7, 'CV. Sinergi Mandiri', 'Jl. Merdeka Raya No. 5, Bandung', '085678901234', '2025-08-21 04:57:59', '2025-08-21 04:57:59'),
(8, 'Toko Sparepart Utama', 'Jl. Pahlawan No. 20, Surabaya', '087812345678', '2025-08-21 04:58:24', '2025-08-21 04:58:24'),
(9, 'Global Logistik Indonesia', 'Jl. Gatot Subroto No. 30', '081122334455', '2025-08-21 04:58:58', '2025-08-21 04:58:58'),
(10, 'CV. Suku Cadang Mesin Diesel', 'Jl. Industri No. 50, Cikarang', '085678901234', '2025-08-21 05:06:50', '2025-08-21 05:06:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incoming_transactions`
--
ALTER TABLE `incoming_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incoming_transactions_purchase_id_foreign` (`purchase_id`),
  ADD KEY `incoming_transactions_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outgoing_transactions`
--
ALTER TABLE `outgoing_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `outgoing_transactions_product_id_foreign` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_details_purchase_id_foreign` (`purchase_id`),
  ADD KEY `purchase_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `incoming_transactions`
--
ALTER TABLE `incoming_transactions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `outgoing_transactions`
--
ALTER TABLE `outgoing_transactions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incoming_transactions`
--
ALTER TABLE `incoming_transactions`
  ADD CONSTRAINT `incoming_transactions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `incoming_transactions_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `outgoing_transactions`
--
ALTER TABLE `outgoing_transactions`
  ADD CONSTRAINT `outgoing_transactions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `purchase_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_details_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
