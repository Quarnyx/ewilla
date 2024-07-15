-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2024 at 07:44 PM
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
-- Database: `ewilla`
--

-- --------------------------------------------------------

--
-- Table structure for table `lp_accounts`
--

CREATE TABLE `lp_accounts` (
  `account_id` int(11) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_type` enum('Aktiva Lancar','Aktiva Tetap','Modal','Utang Lancar','Pendapatan','Beban','Pengeluaran') NOT NULL,
  `balance` decimal(15,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lp_accounts`
--

INSERT INTO `lp_accounts` (`account_id`, `account_name`, `account_type`, `balance`) VALUES
(1, 'Kas', 'Aktiva Lancar', 0.00),
(2, 'Piutang', 'Aktiva Lancar', 0.00),
(3, 'Perlengkapan', 'Aktiva Lancar', 0.00),
(4, 'Peralatan', 'Aktiva Tetap', 0.00),
(5, 'Akum Peny Peralatan', 'Aktiva Lancar', 0.00),
(6, 'Utang Usaha', 'Utang Lancar', 0.00),
(7, 'Utang Gaji', 'Utang Lancar', 0.00),
(8, 'Modal Pemilik', 'Modal', 0.00),
(10, 'Beban Gaji', 'Beban', 0.00),
(11, 'Beban Listrik', 'Beban', 0.00),
(12, 'Beban Perlengkapan', 'Beban', 0.00),
(14, 'Beban Sewa', 'Beban', 0.00),
(20, 'Pendapatan', 'Pendapatan', 0.00),
(21, 'Persediaan', 'Aktiva Lancar', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `lp_cart`
--

CREATE TABLE `lp_cart` (
  `cart_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `qty` int(5) NOT NULL,
  `variation_id` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lp_category`
--

CREATE TABLE `lp_category` (
  `category_id` int(5) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lp_category`
--

INSERT INTO `lp_category` (`category_id`, `category_name`) VALUES
(1, 'Kerudung'),
(2, 'Kemeja'),
(3, 'Dress'),
(4, 'Blouse'),
(5, 'Rok');

-- --------------------------------------------------------

--
-- Table structure for table `lp_customers`
--

CREATE TABLE `lp_customers` (
  `customer_id` int(5) NOT NULL,
  `user_id` int(5) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `province_id` int(5) NOT NULL,
  `city_id` int(5) NOT NULL,
  `post_code` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lp_customers`
--

INSERT INTO `lp_customers` (`customer_id`, `user_id`, `customer_name`, `address`, `phone_number`, `province_id`, `city_id`, `post_code`) VALUES
(3, 7, 'customer', 'Jl. Sari Agung No. 57. Cepiring, Kendal', '0856431804932', 10, 181, 51353);

-- --------------------------------------------------------

--
-- Table structure for table `lp_custom_order`
--

CREATE TABLE `lp_custom_order` (
  `custom_product_id` int(5) NOT NULL,
  `product_code` varchar(15) DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lp_inventory_transaction`
--

CREATE TABLE `lp_inventory_transaction` (
  `inventory_transactions_id` int(11) NOT NULL,
  `product_price` decimal(15,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `transaction_type` enum('In','Out') DEFAULT NULL,
  `variation_id` int(5) DEFAULT NULL,
  `product_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lp_inventory_transaction`
--

INSERT INTO `lp_inventory_transaction` (`inventory_transactions_id`, `product_price`, `quantity`, `created_at`, `transaction_id`, `transaction_type`, `variation_id`, `product_id`) VALUES
(24, 200000.00, 21, '2023-04-01', '24', 'In', NULL, 8),
(25, 228000.00, 1, '2024-07-15', '25', 'Out', 28, 11),
(26, 200000.00, 1, '2024-07-15', '26', 'Out', 22, 8);

-- --------------------------------------------------------

--
-- Table structure for table `lp_invoices`
--

CREATE TABLE `lp_invoices` (
  `invoice_id` int(5) NOT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `order_id` int(5) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `payment` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lp_invoices`
--

INSERT INTO `lp_invoices` (`invoice_id`, `invoice_number`, `order_id`, `status`, `payment`) VALUES
(12, 'INV-15-4374', 15, 'Proses', 'bri');

-- --------------------------------------------------------

--
-- Table structure for table `lp_orders`
--

CREATE TABLE `lp_orders` (
  `order_id` int(5) NOT NULL,
  `customer_id` int(5) DEFAULT NULL,
  `order_total` int(12) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lp_orders`
--

INSERT INTO `lp_orders` (`order_id`, `customer_id`, `order_total`, `status`, `timestamp`) VALUES
(15, 3, 439000, 'pending', '2024-07-15 11:25:15');

-- --------------------------------------------------------

--
-- Table structure for table `lp_order_details`
--

CREATE TABLE `lp_order_details` (
  `order_detail_id` int(5) NOT NULL,
  `order_id` int(5) DEFAULT NULL,
  `variation_id` int(5) DEFAULT NULL,
  `custom_order_id` int(5) DEFAULT NULL,
  `quantity` int(5) DEFAULT NULL,
  `total` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lp_order_details`
--

INSERT INTO `lp_order_details` (`order_detail_id`, `order_id`, `variation_id`, `custom_order_id`, `quantity`, `total`) VALUES
(20, 15, 28, NULL, 1, 228000),
(21, 15, 22, NULL, 1, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `lp_payment_confirm`
--

CREATE TABLE `lp_payment_confirm` (
  `confirm_id` int(5) NOT NULL,
  `created_at` date DEFAULT NULL,
  `invoice_id` int(5) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `cust_bank` varchar(20) DEFAULT NULL,
  `cust_bank_name` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `proof` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lp_payment_confirm`
--

INSERT INTO `lp_payment_confirm` (`confirm_id`, `created_at`, `invoice_id`, `payment_method`, `cust_bank`, `cust_bank_name`, `amount`, `proof`) VALUES
(2, '2024-07-15', 8, 'Dana', 'BRI', 'Nama Orang', 434000.00, '168129.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `lp_products`
--

CREATE TABLE `lp_products` (
  `product_id` int(11) NOT NULL,
  `product_code` varchar(50) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `category` enum('product','material') DEFAULT NULL,
  `product_price` decimal(15,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `category_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lp_products`
--

INSERT INTO `lp_products` (`product_id`, `product_code`, `product_name`, `category`, `product_price`, `description`, `unit`, `updated_at`, `category_id`) VALUES
(8, 'SKU 0001', 'HYERI DRESS', 'product', 200000.00, '<p><strong>&bull; &nbsp; &nbsp;Ukuran :&nbsp;</strong><br>M &nbsp; &nbsp; = LD 100, PB 127 cm, Panjang Lengan 48 cm<br>L &nbsp; &nbsp; = LD 110, PB 130 cm, Panjang Lengan 51 cm<br>XL &nbsp; &nbsp; = LD 115, PB 135 cm, Panjang Lengan 53 cm<br>&bull; &nbsp; &nbsp;<strong>Warna </strong>: CHOCO<br>&bull; &nbsp; &nbsp;<strong>Informasi Produk :&nbsp;</strong><br>Dress yang cocok untuk acara party, bahannya silky, jatuh dan mewah banget.<br>Looknya elegant kalau pakai hyeri dress ini 🎀<br>Detail Produk :<br>Bahan silk, brukat bunga, tile<br>Terdapat payet dibagian leher dan didepan<br>Kancing dilengan baju<br>Kerah sanghai<br>Material : premium silk<br>Recommended untuk kamu yang mau tampil elegant, mewah tapi simple!<br>💖hope u all like this pretty dress💖<br>Happy Shopping ^^</p>', 'pcs', '2024-07-15 17:03:55', 3),
(9, 'SKU 0002', 'HYUNA DRESS', 'product', 150000.00, '<p>&bull; &nbsp; &nbsp;Ukuran :&nbsp;<br>M &nbsp; &nbsp; = LD 100, PB 127 cm, Panjang Lengan 48 cm<br>L &nbsp; &nbsp; = LD 110, PB 130 cm, Panjang Lengan 51 cm<br>XL &nbsp; &nbsp; = LD 115, PB 135 cm, Panjang Lengan 53 cm<br>&bull; &nbsp; &nbsp;Warna : MAUVE<br>&bull; &nbsp; &nbsp;Informasi Produk :<br>Dress dengan warna yang soft kalem, look bahan satin mengkilap cocok banget buat dress ke Kondangan, bisa juga dipakai untuk Bridemaid karena mewah banget looknya bikin terlihat lebih eyecatching😍<br>Detail Produk :<br>Bahan satin dan tile<br>Aksen payet di kerah sanghai, ujung lengan baju, bagian tengah baju<br>Dilapisi kain tile pada lengan<br>Bagian samping kanan sedikit kerut yang bagian atas ada aksen payet<br>💖hope u all like this pretty dress💖<br>Happy Shopping ^^</p>', 'pcs', '2024-07-15 17:06:12', 3),
(10, 'SKU 0003', 'NAIMA DRESS', 'product', 120000.00, '<p>&bull; &nbsp; &nbsp;Ukuran :&nbsp;<br>M &nbsp; &nbsp; = LD 100, PB 127 cm, Panjang Lengan 48 cm<br>L &nbsp; &nbsp; = LD 110, PB 130 cm, Panjang Lengan 51 cm<br>XL &nbsp; &nbsp; = LD 115, PB 135 cm, Panjang Lengan 53 cm<br>&bull; &nbsp; &nbsp;Warna : NAVY<br>&bull; &nbsp; &nbsp;Informasi Produk :<br>Model Dress yang simple dan luar biasa yang akan membuat kamu semakin cantik saat memakainya🎀<br>Detail Produk :<br>Bahan satin yang lembut dan anti kusut<br>terdapat sedikit payet dibagian leher dan bagian tengah<br>Kerut pada pergelangan tangan baju<br>💖hope u all like this pretty dress💖<br>Happy Shopping^^</p>', 'pcs', '2024-07-15 17:08:59', 3),
(11, 'SKU 0004', 'SEORI DRESS', 'product', 228000.00, '<p>&bull; &nbsp; &nbsp;Ukuran :&nbsp;<br>M &nbsp; &nbsp; = LD 100, PB 127 cm, Panjang Lengan 48 cm<br>L &nbsp; &nbsp; = LD 110, PB 130 cm, Panjang Lengan 51 cm<br>XL &nbsp; &nbsp; = LD 115, PB 135 cm, Panjang Lengan 53 cm<br>&bull; &nbsp; &nbsp;Warna : Mocca<br>&bull; &nbsp; &nbsp;Informasi Produk :<br>Dress yang satu ini, comfortable, simple dan styles lhoo yang bikin penampilanmu makin cakep😍<br>Detail Produk :<br>Bahan satin dan brukat bunga<br>Tali bisa lepas pasang<br>Aksen payet di kerah sanghainya<br>Kancing ujung lengan baju dan ada sedikit payet<br>💖hope u all like this pretty dress💖<br>Happy Shopping ^^</p>', 'pcs', '2024-07-15 17:11:02', 3),
(12, 'SKU 0005', 'SEULBI DRESS', 'product', 130000.00, '<p>&bull; &nbsp; &nbsp;Ukuran :&nbsp;<br>M &nbsp; &nbsp; = LD 100, PB 127 cm, Panjang Lengan 48 cm<br>L &nbsp; &nbsp; = LD 110, PB 130 cm, Panjang Lengan 51 cm<br>XL &nbsp; &nbsp; = LD 115, PB 135 cm, Panjang Lengan 53 cm<br>&bull; &nbsp; &nbsp;Warna : SAGE<br>&bull; &nbsp; &nbsp;Informasi Produk :<br>Dress dengan bahan yang halus dan lembut, anti kusut.<br>Detail Produk :<br>Bahan satin<br>Kerah sanghai<br>Payet dibagian tengah<br>Aksen kerut dibagian tengah hingga ke bawah<br>💖hope u all like this pretty dress💖<br>Happy Shopping ^^</p>', 'pcs', '2024-07-15 17:14:37', 3),
(13, 'SKU 0006', 'SUZY DRESS', 'product', 172000.00, '<p>&bull; &nbsp; &nbsp;Ukuran :&nbsp;<br>M &nbsp; &nbsp; = LD 100, PB 127 cm, Panjang Lengan 48 cm<br>L &nbsp; &nbsp; = LD 110, PB 130 cm, Panjang Lengan 51 cm<br>XL &nbsp; &nbsp; = LD 115, PB 135 cm, Panjang Lengan 53 cm<br>&bull; &nbsp; &nbsp;Warna : DUSTY PINK<br>&bull; &nbsp; &nbsp;Informasi Produk :<br>Dress ini cocok buat kalian ke kondangan, mewah banget looknya 🎀<br>Detail produk :<br>Bahan katun satin<br>Kerah sanghai dan sedikit payet dibagian kerah<br>Kerut dan payet dibagian tengah<br>Payet dibagian ujung lengan<br>💖hope u all like this pretty dress💖<br>Happy Shopping ^^</p>', 'pcs', '2024-07-15 17:17:48', 3),
(14, 'SKU 0007', 'YAEJI DRESS', 'product', 100000.00, '<p>&bull; &nbsp; &nbsp;Ukuran :&nbsp;<br>S &nbsp; &nbsp;= LD 98, PB 125 cm, Panjang Lengan 45 cm<br>M &nbsp; &nbsp; = LD 100, PB 127 cm, Panjang Lengan 48 cm<br>L &nbsp; &nbsp; = LD 110, PB 130 cm, Panjang Lengan 51 cm<br>XL &nbsp; &nbsp; = LD 115, PB 135 cm, Panjang Lengan 53 cm<br>XXL &nbsp; &nbsp;= LD 120, PB 138 cm, Panjang Lengan 55 cm<br>&bull; &nbsp; &nbsp;Warna : KHAKI<br>&bull; &nbsp; &nbsp;Informasi Produk :<br>Dress yang cantik dan menawan. Kesan simpel dan elegan juga melekat pada dress ini.<br>DETAIL PRODUK :<br>Bahan satin<br>Terdapat 3 payet pada bagian leher<br>Tali bisa lepas pasang<br>Kerut pada bagian pergelangan tangan<br>Menyetel ulang bagian belakang<br>💖hope u all like this pretty dress💖<br>Happy Shopping ^^</p>', 'pcs', '2024-07-15 17:21:49', 3),
(15, 'SKU-20192', 'DITSY BLOUSE', 'product', 60000.00, '<p>&bull; &nbsp; &nbsp;Ukuran :&nbsp;<br>S &nbsp; &nbsp;= LD 98, PB 125 cm, Panjang Lengan 45 cm<br>M &nbsp; &nbsp; = LD 100, PB 127 cm, Panjang Lengan 48 cm<br>L &nbsp; &nbsp; = LD 110, PB 130 cm, Panjang Lengan 51 cm<br>&bull; &nbsp; &nbsp;Warna : DARK MILO<br>&bull; &nbsp; &nbsp;Informasi Produk :<br>Detail Produk :<br>Bahan Satin, yang pastinya anti kusut, nyaman dipakai<br>Terdapat kancing dibagian ujung lengan<br>Tambahan tali dibagian tengah<br>NOTED:<br>Akan ada sedikit perbedaan warna akibat cahaya dan kamera<br>Akan ada sedikit perbedaan pada ukuran 1-3 cm karena pengukuran secara normal<br>Perfect banget buat dinner, acara formal maupun buat OOTD an🎀<br>Happy Shopping ^^</p>', 'pcs', '2024-07-15 17:29:01', 4),
(16, 'SKU-28983', 'KANESYA BLOUSE', 'product', 150000.00, '<p>&bull; &nbsp; &nbsp;Ukuran :&nbsp;<br>M &nbsp; &nbsp; = LD 100, PB 127 cm, Panjang Lengan 48 cm<br>L &nbsp; &nbsp; = LD 110, PB 130 cm, Panjang Lengan 51 cm<br>XL &nbsp; &nbsp; = LD 115, PB 135 cm, Panjang Lengan 53 cm<br>&bull; &nbsp; &nbsp;Warna : HITAM CREAM<br>&bull; &nbsp; &nbsp;Informasi Produk :<br>Blouse simple, elegant cocok dipakai buat OOTDan atau ke kondangan 😍<br>Detail Produk :<br>Bagian dalam bahan sutra bagian luar bahan motif tile<br>Lengan balon<br>Bagian tengah ada aksen payet<br>NOTED: Dikarenakan bentuk dan ukuran setiap orang berbeda-beda, jadi silahkan diukur untuk menyesuaikan dengan ukuran produknya ya.</p>', 'pcs', '2024-07-15 17:32:53', 4),
(17, 'SKU-2019267', 'RUFFLE BLOUSE', 'product', 45000.00, '<p>&bull; &nbsp; &nbsp;Ukuran :&nbsp;<br>M &nbsp; &nbsp; = LD 100, PB 127 cm, Panjang Lengan 48 cm<br>L &nbsp; &nbsp; = LD 110, PB 130 cm, Panjang Lengan 51 cm<br>XL &nbsp; &nbsp; = LD 115, PB 135 cm, Panjang Lengan 53 cm<br>&bull; &nbsp; &nbsp;Warna : HITAM, PINK<br>&bull; &nbsp; &nbsp;Informasi Produk :<br>Tidak nerawang, nyaman sekali dipakai, lembut dan bikin kalian cutie karena ada rufflenya🎀<br>Detail Produk :<br>Bahan katun<br>Variasi ruffle depan<br>Kerah Pita<br>Happy Shopping ^^</p>', 'pcs', '2024-07-15 17:36:38', 4),
(18, 'SKU-28123', 'YOONA SHIRT', 'product', 55000.00, '<p>&bull; &nbsp; &nbsp;Ukuran :&nbsp;<br>S &nbsp; &nbsp;= LD 98, PB 125 cm, Panjang Lengan 45 cm<br>M &nbsp; &nbsp; = LD 100, PB 127 cm, Panjang Lengan 48 cm<br>L &nbsp; &nbsp; = LD 110, PB 130 cm, Panjang Lengan 51 cm<br>XL &nbsp; &nbsp; = LD 115, PB 135 cm, Panjang Lengan 53 cm<br>XXL &nbsp; &nbsp;= LD 120, PB 138 cm, Panjang Lengan 55 cm<br>&bull; &nbsp; &nbsp;Warna : MERAH, PUTIH, SALEM&nbsp;<br>&bull; &nbsp; &nbsp;Informasi Produk :<br>Kemeja basic ini kita hadirkan dengan cuttingan longgar, kemeja ini tidak terlihat oversize namun ketika dipakai serasa pakai kemeja oversize. Cocok banget dipakai acara formal seperti buat kerja, kuliah atau daily kalian 🎀<br>Material yang dipakai sangat lembut dan cukup adem cocok untuk iklim di Indonesia.<br>Detail Produk :<br>Bahan rayon<br>Saku dibagian depan kiri<br>Kerah kemeja<br>Kancing didepan<br>Kancing dibagian ujung lengan<br>Happy shopping ^^</p>', 'pcs', '2024-07-15 17:41:15', 1),
(19, 'SKU-2232', 'YURI SHIRT', 'product', 55000.00, '<p>&bull; &nbsp; &nbsp;Ukuran :&nbsp;<br>S &nbsp; &nbsp;= LD 98, PB 125 cm, Panjang Lengan 45 cm<br>M &nbsp; &nbsp; = LD 100, PB 127 cm, Panjang Lengan 48 cm<br>L &nbsp; &nbsp; = LD 110, PB 130 cm, Panjang Lengan 51 cm<br>XL &nbsp; &nbsp; = LD 115, PB 135 cm, Panjang Lengan 53 cm<br>XXL &nbsp; &nbsp;= LD 120, PB 138 cm, Panjang Lengan 55 cm<br>&bull; &nbsp; &nbsp;Warna : GREY<br>&bull; &nbsp; &nbsp;Informasi Produk :<br>Kemeja dengan motif kotak, simple, nyaman dipakai, dan oversize. Cocok untuk acara formal seperti buat ke kantor, kuliah ataupun buat sekedar OOTD an 🎀<br>Detail produk :<br>Bahan katun premium<br>Kancing didepan<br>Kerut dibagian ujung lengan<br>Happy shopping ^</p>', 'pcs', '2024-07-15 18:00:35', 2),
(20, 'SKU-5454', 'NAVA SKIRT', 'product', 150000.00, '<p>&bull; &nbsp; &nbsp;Ukuran :&nbsp;<br>L &nbsp; &nbsp;&nbsp;<br>Lingkar Pinggang : 70-86 cm<br>Lingkar Pinggul : 100 cm<br>Panjang Rok : 92 cm<br>XL &nbsp; &nbsp;&nbsp;<br>Lingkar Pinggang : 87-102 cm<br>Lingkar Pinggul : 105 cm<br>Panjang Rok : 92 cm<br>&bull; &nbsp; &nbsp;Warna : KHAKI, HITAM<br>&bull; &nbsp; &nbsp;Informasi Produk :<br>Karakteristik bahan tebal, tidak terawang, halus, stretch dan pastinya nyaman digunakan🎀<br>Detail Produk :<br>Bahan premium katun sweding<br>Dua saku bagian depan<br>Bukaan resleting dan kancing pada bagian depan rok<br>Terdapat karet pada sisi pinggang rok<br>Belahan -/+ 20 cm pada bagian belakang tengah rok untuk memudahkan langkah saat pemakaian<br>Happy shopping ^^</p>', 'pcs', '2024-07-15 18:04:55', 5),
(21, 'SKU-1231', 'SONGKET SKIRT', 'product', 100000.00, '<p>L &nbsp; &nbsp;&nbsp;<br>Lingkar Pinggang : 70-86 cm<br>Lingkar Pinggul : 100 cm<br>Panjang Rok : 92 cm<br>XL &nbsp; &nbsp;&nbsp;<br>Lingkar Pinggang : 87-102 cm<br>Lingkar Pinggul : 105 cm<br>Panjang Rok : 92 cm<br>&bull; &nbsp; &nbsp;Warna : CHOCO<br>&bull; &nbsp; &nbsp;Informasi Produk :<br>Cocok untuk dijadikan bawahan acara formal seperti resepsi pernikahan, tunangan, kondangan atau wisuda. Dengan bahan anti kusut dan nyaman dipakai 😍🎀<br>Detail Produk :<br>Bahan songket berkualitas<br>Karet pada pinggang<br>Belahan disamping kiri -/+ 20 cm<br>Happy shopping ^^</p>', 'pcs', '2024-07-15 18:08:30', 5),
(22, 'SKU 9298', 'JILBAB PARIS PERSEGI', 'product', 20000.00, '<p>&bull; &nbsp; &nbsp;Ukuran : Ukuran 115 x 115 cm<br>&bull; &nbsp; &nbsp;Warna : BIRU, CHOCO, CREAM, GREY, HITAM, MERAH, PUTIH&nbsp;<br>&bull; &nbsp; &nbsp;Informasi Produk :<br>Dengan bahan yang tidak mudah kusut dan mudah tegak sangat cocok untuk kamu yang mencari hijab sat set daily 😍🎀<br>o &nbsp; &nbsp;Hijab Nyaman dan Terjangkau<br>o &nbsp; &nbsp;Finishing Neci Rapih<br>o &nbsp; &nbsp;Kemasan Premium<br>Catatan :<br>Ada kemungkinan sedikit perbedaan warna produk asli dengan warna produk yang ditampilkan di layar, akibat perbedaan spesifikasi gadget yang digunakan.</p>', 'pcs', '2024-07-15 18:15:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lp_return`
--

CREATE TABLE `lp_return` (
  `return_id` int(5) NOT NULL,
  `product_id` int(5) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `qty` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lp_shipping`
--

CREATE TABLE `lp_shipping` (
  `shipping_id` int(5) NOT NULL,
  `courier` varchar(50) DEFAULT NULL,
  `service` varchar(50) DEFAULT NULL,
  `invoice_id` int(5) DEFAULT NULL,
  `receipt_number` varchar(50) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lp_shipping`
--

INSERT INTO `lp_shipping` (`shipping_id`, `courier`, `service`, `invoice_id`, `receipt_number`, `cost`) VALUES
(9, 'JNE', 'REG', 12, 'LV890721544CN', 11000.00);

-- --------------------------------------------------------

--
-- Table structure for table `lp_transactions`
--

CREATE TABLE `lp_transactions` (
  `transaction_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `debit_account_id` int(11) DEFAULT NULL,
  `credit_account_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lp_transactions`
--

INSERT INTO `lp_transactions` (`transaction_id`, `transaction_date`, `amount`, `description`, `debit_account_id`, `credit_account_id`) VALUES
(24, '2023-04-01', 4200000.00, 'Penambahan Stok', 21, 1),
(25, '2024-07-15', 228000.00, 'Penjualan Produk SEORI DRESS', 1, 20),
(26, '2024-07-15', 200000.00, 'Penjualan Produk HYERI DRESS', 1, 20),
(27, '2023-03-01', 50000000.00, 'Modal Awal', 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `lp_users`
--

CREATE TABLE `lp_users` (
  `user_id` int(5) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lp_users`
--

INSERT INTO `lp_users` (`user_id`, `email`, `name`, `level`, `password`) VALUES
(1, 'admin@local.com', 'Admin', 'Admin', '0192023a7bbd73250516f069df18b500'),
(7, 'customer@gmail.com', 'customer', 'Customer', 'f4ad231214cb99a985dff0f056a36242');

-- --------------------------------------------------------

--
-- Table structure for table `lp_variations`
--

CREATE TABLE `lp_variations` (
  `variation_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size` varchar(18) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lp_variations`
--

INSERT INTO `lp_variations` (`variation_id`, `product_id`, `size`, `color`, `image_url`) VALUES
(20, 8, 'M', 'CHOCO', '137193.jpg'),
(21, 8, 'L', 'CHOCO', '303253.'),
(22, 8, 'XL', 'CHOCO', '320551.'),
(23, 9, 'M', 'Mauve', '962875.jpg'),
(24, 9, 'L', 'Mauve', '253688.jpg'),
(25, 9, 'XL', 'Mauve', '263348.jpg'),
(26, 11, 'M', 'Mocca', '390824.jpg'),
(27, 11, 'L', 'Mocca', '910876.jpg'),
(28, 11, 'XL', 'Mocca', '996656.jpg'),
(29, 12, 'M', 'Sage', '529186.jpg'),
(30, 12, 'L', 'Sage', '221291.jpg'),
(31, 12, 'XL', 'Sage', '228070.jpg'),
(32, 13, 'M', 'Dusty Pink', '23257.jpg'),
(33, 13, 'L', 'Dusty Pink', '230433.jpg'),
(35, 13, 'XL', 'Dusty Pink', '693466.jpg'),
(36, 14, 'S', 'Khaki', '181563.jpg'),
(37, 14, 'M', 'Khaki', '332618.jpg'),
(38, 14, 'L', 'Khaki', '290481.jpg'),
(39, 14, 'XL', 'Khaki', '324658.jpg'),
(40, 14, 'XXL', 'Khaki', '107977.jpg'),
(41, 15, 'S', 'Dark Milo', '68549.jpg'),
(42, 15, 'M', 'Dark Milo', '680634.jpg'),
(43, 15, 'L', 'Dark Milo', '905783.jpg'),
(44, 16, 'M', 'Hitam Cream', '671049.jpg'),
(45, 16, 'L', 'Hitam Cream', '582613.jpg'),
(46, 16, 'XL', 'Hitam Cream', '369194.jpg'),
(48, 17, 'L', 'Hitam Pink', '169865.jpg'),
(49, 17, 'M', 'Hitam Pink', '932347.jpg'),
(50, 17, 'XL', 'Hitam Pink', '782215.jpg'),
(51, 18, 'S', 'Merah', '512113.jpg'),
(52, 18, 'M', 'Merah', '369363.jpg'),
(53, 18, 'L', 'Merah', '62422.jpg'),
(54, 18, 'XL', 'Merah', '377623.jpg'),
(55, 18, 'XXL', 'Merah', '126081.jpg'),
(56, 18, 'S', 'Putih', '72931.jpg'),
(57, 18, 'M', 'Putih', '752921.jpg'),
(58, 18, 'L', 'Putih', '356308.jpg'),
(59, 18, 'XL', 'Putih', '382323.jpg'),
(60, 18, 'XXL', 'Putih', '152371.jpg'),
(61, 18, 'S', 'Salem', '68929.jpg'),
(62, 18, 'M', 'Salem', '931545.jpg'),
(63, 18, 'L', 'Salem', '889941.jpg'),
(64, 18, 'XL', 'Salem', '431472.jpg'),
(65, 18, 'XXL', 'Salem', '846657.jpg'),
(66, 19, 'S', 'Grey', '310367.jpg'),
(67, 19, 'M', 'Grey', '663121.jpg'),
(69, 19, 'L', 'Grey', '761371.jpg'),
(70, 19, 'XL', 'Grey', '670404.jpg'),
(71, 19, 'XXL', 'Grey', '514165.jpg'),
(72, 20, 'L', 'Khaki', '414727.jpg'),
(73, 20, 'XL', 'Khaki', '193105.jpg'),
(74, 20, 'L', 'Hitam', '707784.jpg'),
(75, 20, 'XL', 'Hitam', '513335.jpg'),
(76, 21, 'L', 'CHOCO', '168278.jpg'),
(77, 21, 'XL', 'CHOCO', '353051.jpg'),
(78, 22, '115 x 115 cm', 'BIRU', '701928.jpg'),
(79, 22, '115 x 115 cm', 'CHOCO', '712354.jpg'),
(80, 22, '115 x 115 cm', 'CREAM', '710452.jpg'),
(81, 22, '115 x 115 cm', 'Grey', '956463.jpg'),
(82, 22, '115 x 115 cm', 'Hitam', '194686.jpg'),
(83, 22, '115 x 115 cm', 'Merah', '254134.jpg'),
(84, 22, '115 x 115 cm', 'Putih', '67715.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_pro_cat`
-- (See below for the actual view)
--
CREATE TABLE `view_pro_cat` (
`product_id` int(11)
,`product_code` varchar(50)
,`product_name` varchar(255)
,`category` enum('product','material')
,`product_price` decimal(15,2)
,`unit` varchar(10)
,`category_name` varchar(255)
,`description` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_cart`
-- (See below for the actual view)
--
CREATE TABLE `v_cart` (
`cart_id` int(5)
,`user_id` int(5)
,`qty` int(5)
,`variation_id` int(5)
,`created_at` timestamp
,`size` varchar(18)
,`color` varchar(20)
,`product_name` varchar(255)
,`image_url` varchar(255)
,`product_price` decimal(15,2)
,`product_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_courier`
-- (See below for the actual view)
--
CREATE TABLE `v_courier` (
`shipping_id` int(5)
,`courier` varchar(50)
,`service` varchar(50)
,`receipt_number` varchar(50)
,`cost` decimal(10,2)
,`invoice_id` int(5)
,`status` varchar(15)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_custaccount`
-- (See below for the actual view)
--
CREATE TABLE `v_custaccount` (
`user_id` int(5)
,`email` varchar(255)
,`name` varchar(255)
,`level` varchar(20)
,`password` varchar(255)
,`customer_id` int(5)
,`customer_name` varchar(255)
,`address` varchar(255)
,`phone_number` varchar(20)
,`province_id` int(5)
,`city_id` int(5)
,`post_code` int(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_imagesingle`
-- (See below for the actual view)
--
CREATE TABLE `v_imagesingle` (
`image_url` varchar(255)
,`product_id` int(11)
,`size` varchar(18)
,`color` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_imagethumbnail`
-- (See below for the actual view)
--
CREATE TABLE `v_imagethumbnail` (
`image_url` varchar(255)
,`product_id` int(11)
,`size` varchar(18)
,`color` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_inven_trans`
-- (See below for the actual view)
--
CREATE TABLE `v_inven_trans` (
`product_name` varchar(255)
,`category` enum('product','material')
,`product_price` decimal(15,2)
,`quantity` int(11)
,`transaction_type` enum('In','Out')
,`created_at` date
,`product_code` varchar(50)
,`inventory_transactions_id` int(11)
,`transaction_id` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_invoicelist`
-- (See below for the actual view)
--
CREATE TABLE `v_invoicelist` (
`invoice_id` int(5)
,`invoice_number` varchar(255)
,`order_id` int(5)
,`user_id` int(5)
,`name` varchar(255)
,`status` varchar(15)
,`timestamp` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_journal`
-- (See below for the actual view)
--
CREATE TABLE `v_journal` (
`transaction_date` date
,`description` varchar(255)
,`account` varchar(100)
,`account_type` enum('Aktiva Lancar','Aktiva Tetap','Modal','Utang Lancar','Pendapatan','Beban','Pengeluaran')
,`transaction_id` int(11)
,`debit` decimal(15,2)
,`credit` decimal(15,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_newpro`
-- (See below for the actual view)
--
CREATE TABLE `v_newpro` (
`product_name` varchar(255)
,`category` enum('product','material')
,`product_price` decimal(15,2)
,`size` varchar(18)
,`color` varchar(20)
,`image_url` varchar(255)
,`product_id` int(11)
,`category_name` varchar(255)
,`description` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_notification`
-- (See below for the actual view)
--
CREATE TABLE `v_notification` (
`status` varchar(15)
,`customer_name` varchar(255)
,`product_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_order_detail`
-- (See below for the actual view)
--
CREATE TABLE `v_order_detail` (
`order_detail_id` int(5)
,`order_id` int(5)
,`variation_id` int(5)
,`quantity` int(5)
,`total` int(10)
,`size` varchar(18)
,`color` varchar(20)
,`image_url` varchar(255)
,`product_code` varchar(50)
,`product_name` varchar(255)
,`category` enum('product','material')
,`product_price` decimal(15,2)
,`invoice_id` int(5)
,`invoice_number` varchar(255)
,`product_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_paymentconfirm`
-- (See below for the actual view)
--
CREATE TABLE `v_paymentconfirm` (
`confirm_id` int(5)
,`created_at` date
,`invoice_id` int(5)
,`payment_method` varchar(50)
,`cust_bank` varchar(20)
,`cust_bank_name` varchar(100)
,`amount` decimal(10,2)
,`proof` varchar(255)
,`invoice_number` varchar(255)
,`customer_id` int(5)
,`customer_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_realstock`
-- (See below for the actual view)
--
CREATE TABLE `v_realstock` (
`product_name` varchar(255)
,`product_id` int(11)
,`product_code` varchar(50)
,`stock_level` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_return`
-- (See below for the actual view)
--
CREATE TABLE `v_return` (
`product_id` int(5)
,`return_id` int(5)
,`desc` text
,`qty` int(5)
,`product_name` varchar(255)
,`product_code` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_singlepro`
-- (See below for the actual view)
--
CREATE TABLE `v_singlepro` (
`product_name` varchar(255)
,`category` enum('product','material')
,`product_price` decimal(15,2)
,`size` varchar(18)
,`color` varchar(20)
,`image_url` varchar(255)
,`product_id` int(11)
,`category_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_varpro`
-- (See below for the actual view)
--
CREATE TABLE `v_varpro` (
`product_id` int(11)
,`product_code` varchar(50)
,`product_name` varchar(255)
,`size` varchar(18)
,`color` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `view_pro_cat`
--
DROP TABLE IF EXISTS `view_pro_cat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pro_cat`  AS SELECT `lp_products`.`product_id` AS `product_id`, `lp_products`.`product_code` AS `product_code`, `lp_products`.`product_name` AS `product_name`, `lp_products`.`category` AS `category`, `lp_products`.`product_price` AS `product_price`, `lp_products`.`unit` AS `unit`, `lp_category`.`category_name` AS `category_name`, `lp_products`.`description` AS `description` FROM (`lp_products` join `lp_category` on(`lp_products`.`category_id` = `lp_category`.`category_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_cart`
--
DROP TABLE IF EXISTS `v_cart`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_cart`  AS SELECT `lp_cart`.`cart_id` AS `cart_id`, `lp_cart`.`user_id` AS `user_id`, `lp_cart`.`qty` AS `qty`, `lp_cart`.`variation_id` AS `variation_id`, `lp_cart`.`created_at` AS `created_at`, `lp_variations`.`size` AS `size`, `lp_variations`.`color` AS `color`, `lp_products`.`product_name` AS `product_name`, `lp_variations`.`image_url` AS `image_url`, `lp_products`.`product_price` AS `product_price`, `lp_variations`.`product_id` AS `product_id` FROM ((`lp_cart` join `lp_variations` on(`lp_cart`.`variation_id` = `lp_variations`.`variation_id`)) join `lp_products` on(`lp_variations`.`product_id` = `lp_products`.`product_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_courier`
--
DROP TABLE IF EXISTS `v_courier`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_courier`  AS SELECT `lp_shipping`.`shipping_id` AS `shipping_id`, `lp_shipping`.`courier` AS `courier`, `lp_shipping`.`service` AS `service`, `lp_shipping`.`receipt_number` AS `receipt_number`, `lp_shipping`.`cost` AS `cost`, `lp_invoices`.`invoice_id` AS `invoice_id`, `lp_invoices`.`status` AS `status` FROM (`lp_shipping` join `lp_invoices` on(`lp_shipping`.`invoice_id` = `lp_invoices`.`invoice_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_custaccount`
--
DROP TABLE IF EXISTS `v_custaccount`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_custaccount`  AS SELECT `lp_users`.`user_id` AS `user_id`, `lp_users`.`email` AS `email`, `lp_users`.`name` AS `name`, `lp_users`.`level` AS `level`, `lp_users`.`password` AS `password`, `lp_customers`.`customer_id` AS `customer_id`, `lp_customers`.`customer_name` AS `customer_name`, `lp_customers`.`address` AS `address`, `lp_customers`.`phone_number` AS `phone_number`, `lp_customers`.`province_id` AS `province_id`, `lp_customers`.`city_id` AS `city_id`, `lp_customers`.`post_code` AS `post_code` FROM (`lp_users` join `lp_customers` on(`lp_customers`.`user_id` = `lp_users`.`user_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_imagesingle`
--
DROP TABLE IF EXISTS `v_imagesingle`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_imagesingle`  AS SELECT `lp_variations`.`image_url` AS `image_url`, `lp_products`.`product_id` AS `product_id`, `lp_variations`.`size` AS `size`, `lp_variations`.`color` AS `color` FROM (`lp_variations` left join `lp_products` on(`lp_variations`.`product_id` = `lp_products`.`product_id`)) WHERE `lp_variations`.`image_url` <> '' ;

-- --------------------------------------------------------

--
-- Structure for view `v_imagethumbnail`
--
DROP TABLE IF EXISTS `v_imagethumbnail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_imagethumbnail`  AS SELECT `lp_variations`.`image_url` AS `image_url`, `lp_products`.`product_id` AS `product_id`, `lp_variations`.`size` AS `size`, `lp_variations`.`color` AS `color` FROM (`lp_variations` left join `lp_products` on(`lp_variations`.`product_id` = `lp_products`.`product_id`)) WHERE `lp_variations`.`image_url` <> '' ;

-- --------------------------------------------------------

--
-- Structure for view `v_inven_trans`
--
DROP TABLE IF EXISTS `v_inven_trans`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_inven_trans`  AS SELECT `lp_products`.`product_name` AS `product_name`, `lp_products`.`category` AS `category`, `lp_inventory_transaction`.`product_price` AS `product_price`, `lp_inventory_transaction`.`quantity` AS `quantity`, `lp_inventory_transaction`.`transaction_type` AS `transaction_type`, `lp_inventory_transaction`.`created_at` AS `created_at`, `lp_products`.`product_code` AS `product_code`, `lp_inventory_transaction`.`inventory_transactions_id` AS `inventory_transactions_id`, `lp_inventory_transaction`.`transaction_id` AS `transaction_id` FROM (`lp_inventory_transaction` join `lp_products` on(`lp_inventory_transaction`.`product_id` = `lp_products`.`product_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_invoicelist`
--
DROP TABLE IF EXISTS `v_invoicelist`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_invoicelist`  AS SELECT `lp_invoices`.`invoice_id` AS `invoice_id`, `lp_invoices`.`invoice_number` AS `invoice_number`, `lp_invoices`.`order_id` AS `order_id`, `lp_users`.`user_id` AS `user_id`, `lp_users`.`name` AS `name`, `lp_invoices`.`status` AS `status`, `lp_orders`.`timestamp` AS `timestamp` FROM ((((`lp_orders` join `lp_order_details` on(`lp_order_details`.`order_id` = `lp_orders`.`order_id`)) join `lp_invoices` on(`lp_invoices`.`order_id` = `lp_orders`.`order_id`)) join `lp_customers` on(`lp_orders`.`customer_id` = `lp_customers`.`customer_id`)) join `lp_users` on(`lp_customers`.`user_id` = `lp_users`.`user_id`)) GROUP BY `lp_invoices`.`invoice_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_journal`
--
DROP TABLE IF EXISTS `v_journal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_journal`  AS SELECT `t`.`transaction_date` AS `transaction_date`, `t`.`description` AS `description`, `a1`.`account_name` AS `account`, `a1`.`account_type` AS `account_type`, `t`.`transaction_id` AS `transaction_id`, CASE WHEN `t`.`debit_account_id` = `a1`.`account_id` THEN `t`.`amount` ELSE 0 END AS `debit`, CASE WHEN `t`.`credit_account_id` = `a1`.`account_id` THEN `t`.`amount` ELSE 0 END AS `credit` FROM (`lp_transactions` `t` join `lp_accounts` `a1` on(`t`.`debit_account_id` = `a1`.`account_id` or `t`.`credit_account_id` = `a1`.`account_id`)) ORDER BY `t`.`transaction_date` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `v_newpro`
--
DROP TABLE IF EXISTS `v_newpro`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_newpro`  AS SELECT `lp_products`.`product_name` AS `product_name`, `lp_products`.`category` AS `category`, `lp_products`.`product_price` AS `product_price`, `lp_variations`.`size` AS `size`, `lp_variations`.`color` AS `color`, `lp_variations`.`image_url` AS `image_url`, `lp_products`.`product_id` AS `product_id`, `lp_category`.`category_name` AS `category_name`, `lp_products`.`description` AS `description` FROM ((`lp_products` join `lp_variations` on(`lp_variations`.`product_id` = `lp_products`.`product_id`)) join `lp_category` on(`lp_products`.`category_id` = `lp_category`.`category_id`)) GROUP BY `lp_variations`.`product_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_notification`
--
DROP TABLE IF EXISTS `v_notification`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_notification`  AS SELECT `lp_invoices`.`status` AS `status`, `lp_customers`.`customer_name` AS `customer_name`, `lp_products`.`product_name` AS `product_name` FROM (((((`lp_invoices` join `lp_orders` on(`lp_invoices`.`order_id` = `lp_orders`.`order_id`)) join `lp_customers` on(`lp_orders`.`customer_id` = `lp_customers`.`customer_id`)) join `lp_order_details` on(`lp_order_details`.`order_id` = `lp_orders`.`order_id`)) join `lp_variations` on(`lp_order_details`.`variation_id` = `lp_variations`.`variation_id`)) join `lp_products` on(`lp_variations`.`product_id` = `lp_products`.`product_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_order_detail`
--
DROP TABLE IF EXISTS `v_order_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_order_detail`  AS SELECT `lp_order_details`.`order_detail_id` AS `order_detail_id`, `lp_order_details`.`order_id` AS `order_id`, `lp_order_details`.`variation_id` AS `variation_id`, `lp_order_details`.`quantity` AS `quantity`, `lp_order_details`.`total` AS `total`, `lp_variations`.`size` AS `size`, `lp_variations`.`color` AS `color`, `lp_variations`.`image_url` AS `image_url`, `lp_products`.`product_code` AS `product_code`, `lp_products`.`product_name` AS `product_name`, `lp_products`.`category` AS `category`, `lp_products`.`product_price` AS `product_price`, `lp_invoices`.`invoice_id` AS `invoice_id`, `lp_invoices`.`invoice_number` AS `invoice_number`, `lp_products`.`product_id` AS `product_id` FROM (((`lp_order_details` join `lp_variations` on(`lp_order_details`.`variation_id` = `lp_variations`.`variation_id`)) join `lp_products` on(`lp_variations`.`product_id` = `lp_products`.`product_id`)) join `lp_invoices` on(`lp_order_details`.`order_id` = `lp_invoices`.`order_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_paymentconfirm`
--
DROP TABLE IF EXISTS `v_paymentconfirm`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_paymentconfirm`  AS SELECT `lp_payment_confirm`.`confirm_id` AS `confirm_id`, `lp_payment_confirm`.`created_at` AS `created_at`, `lp_payment_confirm`.`invoice_id` AS `invoice_id`, `lp_payment_confirm`.`payment_method` AS `payment_method`, `lp_payment_confirm`.`cust_bank` AS `cust_bank`, `lp_payment_confirm`.`cust_bank_name` AS `cust_bank_name`, `lp_payment_confirm`.`amount` AS `amount`, `lp_payment_confirm`.`proof` AS `proof`, `lp_invoices`.`invoice_number` AS `invoice_number`, `lp_orders`.`customer_id` AS `customer_id`, `lp_customers`.`customer_name` AS `customer_name` FROM (((`lp_payment_confirm` join `lp_invoices` on(`lp_payment_confirm`.`invoice_id` = `lp_invoices`.`invoice_id`)) join `lp_orders` on(`lp_invoices`.`order_id` = `lp_orders`.`order_id`)) join `lp_customers` on(`lp_orders`.`customer_id` = `lp_customers`.`customer_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_realstock`
--
DROP TABLE IF EXISTS `v_realstock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_realstock`  AS SELECT `p`.`product_name` AS `product_name`, `p`.`product_id` AS `product_id`, `p`.`product_code` AS `product_code`, sum(case when `it`.`transaction_type` = 'In' then `it`.`quantity` else 0 end) - sum(case when `it`.`transaction_type` = 'Out' then `it`.`quantity` else 0 end) AS `stock_level` FROM (`lp_inventory_transaction` `it` join `lp_products` `p` on(`it`.`product_id` = `p`.`product_id`)) WHERE `p`.`category` = 'product' GROUP BY `p`.`product_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_return`
--
DROP TABLE IF EXISTS `v_return`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_return`  AS SELECT `lp_return`.`product_id` AS `product_id`, `lp_return`.`return_id` AS `return_id`, `lp_return`.`desc` AS `desc`, `lp_return`.`qty` AS `qty`, `lp_products`.`product_name` AS `product_name`, `lp_products`.`product_code` AS `product_code` FROM (`lp_products` join `lp_return` on(`lp_return`.`product_id` = `lp_products`.`product_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_singlepro`
--
DROP TABLE IF EXISTS `v_singlepro`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_singlepro`  AS SELECT `lp_products`.`product_name` AS `product_name`, `lp_products`.`category` AS `category`, `lp_products`.`product_price` AS `product_price`, `lp_variations`.`size` AS `size`, `lp_variations`.`color` AS `color`, `lp_variations`.`image_url` AS `image_url`, `lp_products`.`product_id` AS `product_id`, `lp_category`.`category_name` AS `category_name` FROM ((`lp_products` join `lp_variations` on(`lp_variations`.`product_id` = `lp_products`.`product_id`)) join `lp_category` on(`lp_products`.`category_id` = `lp_category`.`category_id`)) WHERE `lp_products`.`product_id` = '2' ;

-- --------------------------------------------------------

--
-- Structure for view `v_varpro`
--
DROP TABLE IF EXISTS `v_varpro`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_varpro`  AS SELECT `lp_products`.`product_id` AS `product_id`, `lp_products`.`product_code` AS `product_code`, `lp_products`.`product_name` AS `product_name`, `lp_variations`.`size` AS `size`, `lp_variations`.`color` AS `color` FROM (`lp_products` join `lp_variations` on(`lp_variations`.`product_id` = `lp_products`.`product_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lp_accounts`
--
ALTER TABLE `lp_accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `lp_cart`
--
ALTER TABLE `lp_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_lp_cart_lp_users_1` (`user_id`),
  ADD KEY `fk_lp_cart_lp_products_1` (`variation_id`);

--
-- Indexes for table `lp_category`
--
ALTER TABLE `lp_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `lp_customers`
--
ALTER TABLE `lp_customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `fk_lp_customers_lp_users_1` (`user_id`);

--
-- Indexes for table `lp_custom_order`
--
ALTER TABLE `lp_custom_order`
  ADD PRIMARY KEY (`custom_product_id`);

--
-- Indexes for table `lp_inventory_transaction`
--
ALTER TABLE `lp_inventory_transaction`
  ADD PRIMARY KEY (`inventory_transactions_id`),
  ADD KEY `fk_lp_inventory_transaction_lp_variations_1` (`variation_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `lp_invoices`
--
ALTER TABLE `lp_invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `fk_lp_invoices_lp_orders_1` (`order_id`);

--
-- Indexes for table `lp_orders`
--
ALTER TABLE `lp_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_lp_orders_lp_customers_1` (`customer_id`);

--
-- Indexes for table `lp_order_details`
--
ALTER TABLE `lp_order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `fk_lp_order_details_lp_orders_1` (`order_id`);

--
-- Indexes for table `lp_payment_confirm`
--
ALTER TABLE `lp_payment_confirm`
  ADD PRIMARY KEY (`confirm_id`);

--
-- Indexes for table `lp_products`
--
ALTER TABLE `lp_products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_lp_products_lp_category_1` (`category_id`);

--
-- Indexes for table `lp_return`
--
ALTER TABLE `lp_return`
  ADD PRIMARY KEY (`return_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `lp_shipping`
--
ALTER TABLE `lp_shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `lp_transactions`
--
ALTER TABLE `lp_transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `debit_account_id` (`debit_account_id`),
  ADD KEY `credit_account_id` (`credit_account_id`);

--
-- Indexes for table `lp_users`
--
ALTER TABLE `lp_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `lp_variations`
--
ALTER TABLE `lp_variations`
  ADD PRIMARY KEY (`variation_id`),
  ADD KEY `fk_lp_variations_lp_inventory_1` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lp_accounts`
--
ALTER TABLE `lp_accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `lp_cart`
--
ALTER TABLE `lp_cart`
  MODIFY `cart_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `lp_category`
--
ALTER TABLE `lp_category`
  MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lp_customers`
--
ALTER TABLE `lp_customers`
  MODIFY `customer_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lp_custom_order`
--
ALTER TABLE `lp_custom_order`
  MODIFY `custom_product_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lp_inventory_transaction`
--
ALTER TABLE `lp_inventory_transaction`
  MODIFY `inventory_transactions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `lp_invoices`
--
ALTER TABLE `lp_invoices`
  MODIFY `invoice_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lp_orders`
--
ALTER TABLE `lp_orders`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `lp_order_details`
--
ALTER TABLE `lp_order_details`
  MODIFY `order_detail_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `lp_payment_confirm`
--
ALTER TABLE `lp_payment_confirm`
  MODIFY `confirm_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lp_products`
--
ALTER TABLE `lp_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `lp_return`
--
ALTER TABLE `lp_return`
  MODIFY `return_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lp_shipping`
--
ALTER TABLE `lp_shipping`
  MODIFY `shipping_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lp_transactions`
--
ALTER TABLE `lp_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `lp_users`
--
ALTER TABLE `lp_users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lp_variations`
--
ALTER TABLE `lp_variations`
  MODIFY `variation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lp_cart`
--
ALTER TABLE `lp_cart`
  ADD CONSTRAINT `fk_lp_cart_lp_products_1` FOREIGN KEY (`variation_id`) REFERENCES `lp_variations` (`variation_id`),
  ADD CONSTRAINT `fk_lp_cart_lp_users_1` FOREIGN KEY (`user_id`) REFERENCES `lp_users` (`user_id`);

--
-- Constraints for table `lp_customers`
--
ALTER TABLE `lp_customers`
  ADD CONSTRAINT `fk_lp_customers_lp_users_1` FOREIGN KEY (`user_id`) REFERENCES `lp_users` (`user_id`);

--
-- Constraints for table `lp_inventory_transaction`
--
ALTER TABLE `lp_inventory_transaction`
  ADD CONSTRAINT `fk_lp_inventory_transaction_lp_variations_1` FOREIGN KEY (`variation_id`) REFERENCES `lp_variations` (`variation_id`),
  ADD CONSTRAINT `lp_inventory_transaction_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `lp_products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lp_invoices`
--
ALTER TABLE `lp_invoices`
  ADD CONSTRAINT `fk_lp_invoices_lp_orders_1` FOREIGN KEY (`order_id`) REFERENCES `lp_orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lp_orders`
--
ALTER TABLE `lp_orders`
  ADD CONSTRAINT `fk_lp_orders_lp_customers_1` FOREIGN KEY (`customer_id`) REFERENCES `lp_customers` (`customer_id`);

--
-- Constraints for table `lp_order_details`
--
ALTER TABLE `lp_order_details`
  ADD CONSTRAINT `fk_lp_order_details_lp_orders_1` FOREIGN KEY (`order_id`) REFERENCES `lp_orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lp_products`
--
ALTER TABLE `lp_products`
  ADD CONSTRAINT `fk_lp_products_lp_category_1` FOREIGN KEY (`category_id`) REFERENCES `lp_category` (`category_id`);

--
-- Constraints for table `lp_return`
--
ALTER TABLE `lp_return`
  ADD CONSTRAINT `lp_return_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `lp_products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lp_transactions`
--
ALTER TABLE `lp_transactions`
  ADD CONSTRAINT `lp_transactions_ibfk_1` FOREIGN KEY (`debit_account_id`) REFERENCES `lp_accounts` (`account_id`),
  ADD CONSTRAINT `lp_transactions_ibfk_2` FOREIGN KEY (`credit_account_id`) REFERENCES `lp_accounts` (`account_id`);

--
-- Constraints for table `lp_variations`
--
ALTER TABLE `lp_variations`
  ADD CONSTRAINT `fk_lp_variations_lp_inventory_1` FOREIGN KEY (`product_id`) REFERENCES `lp_products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
