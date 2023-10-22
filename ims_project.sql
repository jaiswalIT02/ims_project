-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2023 at 07:20 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_master`
--

CREATE TABLE `access_master` (
  `auto_id` smallint(5) NOT NULL,
  `co_id` varchar(8) NOT NULL,
  `desig_id` tinyint(3) NOT NULL,
  `dept_id` tinyint(3) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `dept_icon` varchar(50) NOT NULL,
  `dept_order_no` tinyint(3) NOT NULL,
  `module_id` tinyint(3) NOT NULL,
  `module_name` varchar(50) NOT NULL,
  `module_filename` varchar(50) NOT NULL,
  `module_order_no` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `access_master`
--

INSERT INTO `access_master` (`auto_id`, `co_id`, `desig_id`, `dept_id`, `dept_name`, `dept_icon`, `dept_order_no`, `module_id`, `module_name`, `module_filename`, `module_order_no`) VALUES
(54, 'TarunDev', 0, 1, 'Home', 'fas fa-fw fa-home', 1, 1, 'Dashboard', 'dashboard.php', 1),
(55, 'TarunDev', 0, 1, 'Home', 'fas fa-fw fa-home', 1, 2, 'Sale Master', 'sale_master.php', 2),
(92, 'VIP', 0, 1, 'Home', 'fas fa-fw fa-home', 1, 1, 'Dashboard', 'dashboard', 1),
(93, 'VIP', 0, 1, 'Home', 'fas fa-fw fa-home', 1, 4, 'Purchase Master', 'purchase_master', 4),
(94, 'VIP', 0, 1, 'Home', 'fas fa-fw fa-home', 1, 2, 'Sale Master', 'sale_master', 2),
(95, 'VIP', 0, 1, 'Home', 'fas fa-fw fa-home', 1, 3, 'Stock Master', 'stock_master', 3),
(96, 'VIP', 0, 2, 'Reports', 'fas fa-fw fa-chart-area', 2, 5, 'Sale Report', 'sale_report', 1),
(97, 'VIP', 0, 2, 'Reports', 'fas fa-fw fa-chart-area', 2, 6, 'View Bill', 'view_bill', 2),
(98, 'VIP', 0, 3, 'Settings', 'fas fa-fw fa-cog', 3, 9, 'Manage Company', 'company_info', 3),
(99, 'VIP', 0, 3, 'Settings', 'fas fa-fw fa-cog', 3, 10, 'Manage Outlet', 'outlet_details', 4),
(100, 'VIP', 0, 3, 'Settings', 'fas fa-fw fa-cog', 3, 12, 'Manage Product', 'manage_product', 6),
(101, 'VIP', 0, 3, 'Settings', 'fas fa-fw fa-cog', 3, 8, 'Manage Unit', 'add_unit', 2),
(102, 'VIP', 0, 3, 'Settings', 'fas fa-fw fa-cog', 3, 7, 'Manage User', 'add_user', 1),
(103, 'VIP', 0, 3, 'Settings', 'fas fa-fw fa-cog', 3, 11, 'Module Allocate', 'mod_alloc', 5);

-- --------------------------------------------------------

--
-- Table structure for table `bill_details`
--

CREATE TABLE `bill_details` (
  `co_id` varchar(8) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `product_company` varchar(20) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `product_unit` varchar(20) NOT NULL,
  `product_price` decimal(10,0) NOT NULL,
  `product_quantity` smallint(6) NOT NULL,
  `product_total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill_details`
--

INSERT INTO `bill_details` (`co_id`, `bill_id`, `product_company`, `product_name`, `product_unit`, `product_price`, `product_quantity`, `product_total`) VALUES
('TarunDev', 0, 'Oppp', 'Mobile', 'pcs', '28000', 1, '28000'),
('VIP', 4, 'Vivo', 'Mobile', 'pcs', '20000', 1, '20000'),
('VIP', 5, 'Vivo', 'Mobile', 'pcs', '20000', 5, '100000'),
('VIP', 6, 'Oppp', 'Mobile', 'pcs', '28000', 1, '28000'),
('VIP', 7, 'Oppp', 'Mobile', 'pcs', '28000', 2, '56000'),
('VIP', 8, 'Oppp', 'Mobile', 'pcs', '28000', 2, '56000'),
('VIP', 10, 'Oppp', 'Mobile', 'pcs', '28000', 2, '56000'),
('VIP', 11, 'Vivo', 'Mobile', 'pcs', '20000', 2, '40000');

-- --------------------------------------------------------

--
-- Table structure for table `bill_header`
--

CREATE TABLE `bill_header` (
  `id` smallint(3) NOT NULL,
  `co_id` varchar(8) NOT NULL,
  `name` varchar(20) NOT NULL,
  `bill_type` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `bill_id` smallint(2) NOT NULL,
  `product_total` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill_header`
--

INSERT INTO `bill_header` (`id`, `co_id`, `name`, `bill_type`, `date`, `bill_id`, `product_total`) VALUES
(1, 'VIP', 'Tarun', 'card', '2023-04-28', 4, '20000.00'),
(2, 'VIP', 'Pappu', 'online', '2023-04-28', 4, '28000.00'),
(3, 'VIP', 'Krishn Jaiswal', 'card', '2023-04-28', 5, '184000.00'),
(4, 'VIP', 'pushpa', 'cash', '2023-04-28', 5, '48000.00'),
(5, 'VIP', 'MR. Vikas ', 'online', '2023-04-28', 6, '88000.00'),
(6, 'VIP', 'MR. Vikas ', 'online', '2023-04-28', 7, '136000.00'),
(7, 'VIP', 'Papa', 'card', '2023-04-28', 8, '96000.00'),
(8, 'VIP', 'rtetyryr`', 'card', '2023-04-28', 9, '56000.00'),
(9, 'VIP', 'rtetyryr`', 'card', '2023-04-28', 10, '56000.00'),
(10, 'VIP', 'Tarun Jaiswal', 'cash', '2023-05-02', 11, '40000.00'),
(11, 'VIP', 'himesh', 'card', '2023-05-02', 6, '60000.00'),
(12, 'TarunDev', '', 'cash', '2023-05-03', 0, '28000.00');

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `co_id` varchar(8) NOT NULL COMMENT 'abc1',
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `co_name` varchar(75) DEFAULT NULL COMMENT 'Vrinda Foods & Hospitality',
  `brand_name` varchar(50) NOT NULL,
  `co_add` varchar(100) DEFAULT NULL COMMENT '84 Pace City,',
  `co_city` varchar(25) DEFAULT NULL COMMENT 'Gurgaon',
  `co_pin` varchar(6) DEFAULT NULL,
  `co_state` varchar(30) DEFAULT NULL,
  `co_country` varchar(30) DEFAULT NULL,
  `co_logo` varchar(100) DEFAULT NULL,
  `co_gst` varchar(15) DEFAULT NULL,
  `full_name` varchar(50) NOT NULL,
  `OPT_mode` varchar(7) NOT NULL,
  `co_email` varchar(100) DEFAULT NULL,
  `co_phone` bigint(12) NOT NULL,
  `no_of_outlets` int(5) NOT NULL DEFAULT 0,
  `co_guest_count` int(6) NOT NULL DEFAULT 0,
  `CmpSetup` tinyint(1) DEFAULT NULL,
  `OutletSetup` tinyint(1) DEFAULT NULL,
  `co_insta` varchar(255) DEFAULT NULL,
  `co_facebook` varchar(255) DEFAULT NULL,
  `order_taking_no` bigint(12) NOT NULL DEFAULT 0,
  `currency_name` varchar(3) DEFAULT NULL COMMENT 'INR',
  `currency_symbol` varchar(80) DEFAULT NULL COMMENT 'Symbol of Currency',
  `co_order_seq` int(6) DEFAULT NULL,
  `show_logo_on_site` tinyint(1) DEFAULT NULL,
  `is_first_login` tinyint(4) NOT NULL DEFAULT 1,
  `last_login` date NOT NULL,
  `free_order_counter` smallint(5) UNSIGNED NOT NULL DEFAULT 30,
  `paid_order_counter` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `is_free_level` tinyint(2) UNSIGNED NOT NULL DEFAULT 0,
  `sms_counter` smallint(5) UNSIGNED NOT NULL DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`co_id`, `registration_date`, `co_name`, `brand_name`, `co_add`, `co_city`, `co_pin`, `co_state`, `co_country`, `co_logo`, `co_gst`, `full_name`, `OPT_mode`, `co_email`, `co_phone`, `no_of_outlets`, `co_guest_count`, `CmpSetup`, `OutletSetup`, `co_insta`, `co_facebook`, `order_taking_no`, `currency_name`, `currency_symbol`, `co_order_seq`, `show_logo_on_site`, `is_first_login`, `last_login`, `free_order_counter`, `paid_order_counter`, `is_free_level`, `sms_counter`) VALUES
('TarunDev', '2023-05-02 18:30:00', 'Tarun Dev World', 'Tarun Dev ', 'Hukulganj', 'Varanasi', '221002', 'Uttar Pradesh', 'India', NULL, NULL, 'Tarun Jaiswal', '', 'jaiswaltaru@gmail.com', 8081569986, 2, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2023-05-03', 30, 0, 0, 100),
('VIP', '2023-02-06 12:14:48', 'VNS IT POINT ', 'VNS', 'Sector 10 ', 'Gurgaon', '227412', 'Haryana', 'India', NULL, NULL, 'Tarun Jaiswal', '', 'jaiswaltaru@gmail.com', 8081569986, 2, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2023-05-03', 30, 0, 0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `company_name`
--

CREATE TABLE `company_name` (
  `id` int(3) NOT NULL,
  `co_id` varchar(20) DEFAULT NULL,
  `companyname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_name`
--

INSERT INTO `company_name` (`id`, `co_id`, `companyname`) VALUES
(1, 'VIP', 'Oppo'),
(2, 'VIP', 'Vivo'),
(3, 'VIP', 'Samsung');

-- --------------------------------------------------------

--
-- Table structure for table `dept_master`
--

CREATE TABLE `dept_master` (
  `co_id` varchar(8) NOT NULL,
  `dept_id` tinyint(3) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `dept_font_icon` varchar(50) NOT NULL,
  `dept_order_no` tinyint(3) NOT NULL,
  `dept_is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dept_master`
--

INSERT INTO `dept_master` (`co_id`, `dept_id`, `dept_name`, `dept_font_icon`, `dept_order_no`, `dept_is_active`) VALUES
('TarunDev', 1, 'Home', 'fas fa-fw fa-home', 1, 1),
('TarunDev', 2, 'Reports', 'fas fa-fw fa-chart', 2, 1),
('TarunDev', 3, 'Settings', 'fas fa-fw fa-cog', 3, 1),
('VIP', 1, 'Home', 'fas fa-fw fa-home', 1, 1),
('VIP', 2, 'Reports', 'fas fa-fw fa-chart', 2, 1),
('VIP', 3, 'Settings', 'fas fa-fw fa-cog', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dept_modules`
--

CREATE TABLE `dept_modules` (
  `co_id` varchar(8) NOT NULL,
  `module_id` tinyint(3) NOT NULL,
  `dept_id` tinyint(3) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `module_name` varchar(50) NOT NULL,
  `module_filename` varchar(50) NOT NULL,
  `module_order_no` tinyint(3) NOT NULL,
  `module_is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dept_modules`
--

INSERT INTO `dept_modules` (`co_id`, `module_id`, `dept_id`, `dept_name`, `module_name`, `module_filename`, `module_order_no`, `module_is_active`) VALUES
('TarunDev', 1, 1, 'Home', 'Dashboard', 'dashboard', 1, 1),
('TarunDev', 2, 1, 'Home', 'Sale Master', 'sale_master', 2, 1),
('VIP', 1, 1, 'Home', 'Dashboard', 'dashboard', 1, 1),
('VIP', 2, 1, 'Home', 'Sale Master', 'sale_master', 2, 1),
('VIP', 3, 1, 'Home', 'Stock Master', 'stock_master', 3, 1),
('VIP', 4, 1, 'Home', 'Purchase Master', 'purchase_master', 4, 1),
('VIP', 5, 2, 'Reports', 'Sale Report', 'sale_report', 1, 1),
('VIP', 6, 2, 'Reports', 'View Bill', 'view_bill', 2, 1),
('VIP', 7, 3, 'Settings', 'Manage User', 'add_user', 1, 1),
('VIP', 8, 3, 'Settings', 'Manage Unit', 'add_unit', 2, 1),
('VIP', 9, 3, 'Settings', 'Manage Company', 'company_info', 3, 1),
('VIP', 10, 3, 'Settings', 'Manage Outlet', 'outlet_details', 4, 1),
('VIP', 11, 3, 'Settings', 'Module Allocate', 'mod_alloc', 5, 1),
('VIP', 12, 3, 'Settings', 'Manage Product', 'manage_product', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `designation_master`
--

CREATE TABLE `designation_master` (
  `co_id` varchar(8) NOT NULL,
  `desig_id` tinyint(3) NOT NULL,
  `desig_name` varchar(50) NOT NULL,
  `desig_is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `designation_master`
--

INSERT INTO `designation_master` (`co_id`, `desig_id`, `desig_name`, `desig_is_active`) VALUES
('TarunDev', 0, 'Master', 1),
('VIP', 0, 'Master', 1),
('VIP', 1, 'Admin', 1),
('VIP', 2, 'Staff', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_master`
--

CREATE TABLE `login_master` (
  `co_id` varchar(8) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_login` varchar(30) NOT NULL,
  `user_password` varchar(30) NOT NULL,
  `desig_id` tinyint(3) NOT NULL COMMENT 'master alloted automatically',
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login_master`
--

INSERT INTO `login_master` (`co_id`, `user_name`, `user_login`, `user_password`, `desig_id`, `is_active`) VALUES
('TarunDev', 'Master Tarun', 'master', 'password2@', 0, 1),
('TarunDev', 'Tarun Jaiswal', 'tarundev', 'taru@302', 1, 1),
('VIP', 'Tarun Jaiswal', 'jaiswalIT', '12345', 0, 1),
('VIP', 'Rajan Kumar', 'rajantest', 'rajan', 2, 1),
('VIP', 'admin', 'tarun@tj', '12345', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_ref_nos`
--

CREATE TABLE `order_ref_nos` (
  `auto_id` smallint(6) NOT NULL,
  `co_id` varchar(8) NOT NULL,
  `UnitId` int(8) NOT NULL,
  `order_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_ref_nos`
--

INSERT INTO `order_ref_nos` (`auto_id`, `co_id`, `UnitId`, `order_id`) VALUES
(1, 'VIP', 1, 11),
(2, 'VIP', 2, 6),
(3, 'TarunDev', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `outlet_details`
--

CREATE TABLE `outlet_details` (
  `co_id` varchar(8) NOT NULL,
  `UnitId` int(5) NOT NULL,
  `ol_name` varchar(50) DEFAULT NULL,
  `ol_city` varchar(30) DEFAULT NULL,
  `ol_pin` int(6) NOT NULL DEFAULT 0,
  `ol_state` varchar(50) DEFAULT NULL,
  `ol_country` varchar(50) DEFAULT NULL,
  `has_outlet_kitchen` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `outlet_details`
--

INSERT INTO `outlet_details` (`co_id`, `UnitId`, `ol_name`, `ol_city`, `ol_pin`, `ol_state`, `ol_country`, `has_outlet_kitchen`) VALUES
('VIP', 1, 'Gurugram', 'Guragaon', 0, 'Haryana', 'India', NULL),
('VIP', 2, 'Delhi', 'New Delhi', 0, 'New Delhi', 'India', NULL),
('TarunDev', 3, 'Varanasi', 'Varanasi', 221002, 'Uttar Pradesh', 'India', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `party_info`
--

CREATE TABLE `party_info` (
  `id` bigint(10) NOT NULL,
  `coi_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `businessname` varchar(50) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE `product_info` (
  `id` smallint(3) NOT NULL,
  `co_id` varchar(20) NOT NULL,
  `companyname` varchar(20) NOT NULL,
  `productname` varchar(20) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `packing_size` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`id`, `co_id`, `companyname`, `productname`, `unit`, `packing_size`) VALUES
(2, 'VIP', 'undefined', 'Mobile Charger    ', 'PCS    ', '100    '),
(3, 'VIP', 'Samsung', 'Mobile Charger', 'PCS', '100');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_master`
--

CREATE TABLE `purchase_master` (
  `id` smallint(3) NOT NULL,
  `co_id` varchar(20) NOT NULL,
  `companyname` varchar(20) NOT NULL,
  `productname` varchar(20) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `packing_size` decimal(10,0) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `partyname` varchar(50) NOT NULL,
  `purchasetype` varchar(20) NOT NULL,
  `expirydate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_master`
--

INSERT INTO `purchase_master` (`id`, `co_id`, `companyname`, `productname`, `unit`, `quantity`, `packing_size`, `price`, `partyname`, `purchasetype`, `expirydate`) VALUES
(1, 'VIP', 'Vivo', 'Mobile', 'pcs', '20', '100', '20000', 'Online Utility Services', 'Cash', '2025-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `stock_master`
--

CREATE TABLE `stock_master` (
  `id` smallint(3) NOT NULL,
  `co_id` varchar(20) DEFAULT NULL,
  `companyname` varchar(20) NOT NULL,
  `productname` varchar(20) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_master`
--

INSERT INTO `stock_master` (`id`, `co_id`, `companyname`, `productname`, `unit`, `quantity`, `price`) VALUES
(1, NULL, 'Vivo', 'Mobile', 'pcs', '-2', '20000'),
(2, NULL, 'Oppp', 'Mobile', 'pcs', '3', '28000');

-- --------------------------------------------------------

--
-- Table structure for table `unit_master`
--

CREATE TABLE `unit_master` (
  `id` smallint(3) NOT NULL,
  `unitname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_master`
--

INSERT INTO `unit_master` (`id`, `unitname`) VALUES
(1, 'Kg'),
(2, 'PCS');

-- --------------------------------------------------------

--
-- Table structure for table `user_outlet_access`
--

CREATE TABLE `user_outlet_access` (
  `aid` int(3) NOT NULL,
  `co_id` varchar(8) NOT NULL,
  `LoginName` varchar(50) NOT NULL,
  `UserLevel` int(3) NOT NULL,
  `UnitId` int(3) NOT NULL,
  `UnitName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Here defined Which Outlet Access to particular user';

--
-- Dumping data for table `user_outlet_access`
--

INSERT INTO `user_outlet_access` (`aid`, `co_id`, `LoginName`, `UserLevel`, `UnitId`, `UnitName`) VALUES
(1, 'VIP', 'Master', 1, 1, 'Gurugram'),
(2, 'VIP', 'Master', 1, 2, 'New Delhi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_master`
--
ALTER TABLE `access_master`
  ADD PRIMARY KEY (`auto_id`),
  ADD KEY `co_id` (`co_id`);

--
-- Indexes for table `bill_details`
--
ALTER TABLE `bill_details`
  ADD PRIMARY KEY (`co_id`,`bill_id`);

--
-- Indexes for table `bill_header`
--
ALTER TABLE `bill_header`
  ADD PRIMARY KEY (`id`,`co_id`,`bill_id`);

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD UNIQUE KEY `co_id` (`co_id`);

--
-- Indexes for table `company_name`
--
ALTER TABLE `company_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dept_master`
--
ALTER TABLE `dept_master`
  ADD PRIMARY KEY (`co_id`,`dept_id`);

--
-- Indexes for table `dept_modules`
--
ALTER TABLE `dept_modules`
  ADD PRIMARY KEY (`co_id`,`module_id`);

--
-- Indexes for table `designation_master`
--
ALTER TABLE `designation_master`
  ADD PRIMARY KEY (`co_id`,`desig_id`);

--
-- Indexes for table `login_master`
--
ALTER TABLE `login_master`
  ADD PRIMARY KEY (`co_id`,`user_login`);

--
-- Indexes for table `order_ref_nos`
--
ALTER TABLE `order_ref_nos`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `outlet_details`
--
ALTER TABLE `outlet_details`
  ADD PRIMARY KEY (`UnitId`);

--
-- Indexes for table `party_info`
--
ALTER TABLE `party_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_info`
--
ALTER TABLE `product_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_master`
--
ALTER TABLE `purchase_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_master`
--
ALTER TABLE `stock_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_master`
--
ALTER TABLE `unit_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_outlet_access`
--
ALTER TABLE `user_outlet_access`
  ADD PRIMARY KEY (`aid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_master`
--
ALTER TABLE `access_master`
  MODIFY `auto_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `bill_header`
--
ALTER TABLE `bill_header`
  MODIFY `id` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `company_name`
--
ALTER TABLE `company_name`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_ref_nos`
--
ALTER TABLE `order_ref_nos`
  MODIFY `auto_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `outlet_details`
--
ALTER TABLE `outlet_details`
  MODIFY `UnitId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `party_info`
--
ALTER TABLE `party_info`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
  MODIFY `id` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_master`
--
ALTER TABLE `purchase_master`
  MODIFY `id` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_master`
--
ALTER TABLE `stock_master`
  MODIFY `id` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unit_master`
--
ALTER TABLE `unit_master`
  MODIFY `id` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_outlet_access`
--
ALTER TABLE `user_outlet_access`
  MODIFY `aid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
