-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2017 at 11:43 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbhotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bsi_admin`
--

CREATE TABLE `bsi_admin` (
  `id` int(11) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT 'admin',
  `access_id` int(1) NOT NULL DEFAULT '0',
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `bsi_admin`
--

INSERT INTO `bsi_admin` (`id`, `pass`, `username`, `access_id`, `f_name`, `l_name`, `email`, `designation`, `last_login`, `status`) VALUES
(1, '21232f297a57a5a743894a0e4a801fc3', 'admin', 1, 'admin', 'admin', 'admin@example.com', 'Administrator', '2017-01-08 22:38:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bsi_adminmenu`
--

CREATE TABLE `bsi_adminmenu` (
  `id` int(4) NOT NULL,
  `name` varchar(200) NOT NULL,
  `url` varchar(200) DEFAULT NULL,
  `parent_id` int(4) DEFAULT '0',
  `status` enum('Y','N') CHARACTER SET latin1 DEFAULT 'Y',
  `ord` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `bsi_adminmenu`
--

INSERT INTO `bsi_adminmenu` (`id`, `name`, `url`, `parent_id`, `status`, `ord`) VALUES
(6, 'SETTING', '#', 0, 'Y', 9),
(31, 'Global Setting', 'global_setting.php', 6, 'Y', 1),
(33, 'HOTEL MANAGER', '#', 0, 'Y', 2),
(34, 'Room Manager', 'room_list.php', 33, 'Y', 1),
(35, 'RoomType Manager', 'roomtype.php', 33, 'Y', 2),
(36, 'PricePlan Manager', 'priceplan.php', 63, 'Y', 4),
(37, 'BOOKING MANAGER', '#', 0, 'Y', 4),
(39, 'View Booking List', 'view_bookings.php', 37, 'Y', 2),
(43, 'Payment Gateway', 'payment_gateway.php', 6, 'Y', 4),
(44, 'Email Contents', 'email_content.php', 6, 'Y', 5),
(59, 'Capacity Manager', 'admin_capacity.php', 33, 'Y', 3),
(61, 'Advance Payment', 'advance_payment.php', 63, 'Y', 6),
(63, 'PRICE MANAGER', '#', 0, 'Y', 3),
(66, 'Hotel Details', 'admin_hotel_details.php', 33, 'Y', 0),
(68, 'Room Blocking', 'admin_block_room.php', 37, 'Y', 6),
(70, 'Calendar View', 'calendar_view.php', 37, 'Y', 5),
(71, 'Customer Lookup', 'customerlookup.php', 37, 'Y', 4),
(72, 'Admin Menu Manager', 'adminmenu.list.php', 6, 'Y', 6),
(73, 'LANGUAGE MANAGER', '#', 0, 'Y', 6),
(74, 'Manage Languages', 'manage_langauge.php', 73, 'Y', 1),
(75, 'Special Offer', 'view_special_offer.php', 63, 'Y', 5),
(76, 'CURRENCY MANAGER', '#', 0, 'Y', 7),
(77, 'Manage Currency', 'currency_list.php', 76, 'Y', 1),
(78, 'Photo Gallery', 'gallery_list.php', 33, 'Y', 7);

-- --------------------------------------------------------

--
-- Table structure for table `bsi_advance_payment`
--

CREATE TABLE `bsi_advance_payment` (
  `month_num` int(11) NOT NULL,
  `month` varchar(255) NOT NULL,
  `deposit_percent` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bsi_advance_payment`
--

INSERT INTO `bsi_advance_payment` (`month_num`, `month`, `deposit_percent`) VALUES
(1, 'January', '0.00'),
(2, 'February', '0.00'),
(3, 'March', '0.00'),
(4, 'April', '0.00'),
(5, 'May', '0.00'),
(6, 'June', '0.00'),
(7, 'July', '0.00'),
(8, 'August', '0.00'),
(9, 'September', '0.00'),
(10, 'October', '0.00'),
(11, 'November', '0.00'),
(12, 'December', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `bsi_bookings`
--

CREATE TABLE `bsi_bookings` (
  `booking_id` int(10) UNSIGNED NOT NULL,
  `booking_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_date` date NOT NULL DEFAULT '0000-00-00',
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  `client_id` int(10) UNSIGNED DEFAULT NULL,
  `child_count` int(2) NOT NULL DEFAULT '0',
  `extra_guest_count` int(2) NOT NULL DEFAULT '0',
  `discount_coupon` varchar(50) DEFAULT NULL,
  `total_cost` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `payment_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payment_type` varchar(255) NOT NULL,
  `payment_success` tinyint(1) NOT NULL DEFAULT '0',
  `payment_txnid` varchar(100) DEFAULT NULL,
  `paypal_email` varchar(500) DEFAULT NULL,
  `special_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `special_requests` text,
  `is_block` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `block_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bsi_capacity`
--

CREATE TABLE `bsi_capacity` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bsi_cc_info`
--

CREATE TABLE `bsi_cc_info` (
  `booking_id` varchar(100) CHARACTER SET latin1 NOT NULL,
  `cardholder_name` varchar(255) NOT NULL,
  `card_type` varchar(50) NOT NULL,
  `card_number` blob NOT NULL,
  `expiry_date` varchar(10) CHARACTER SET latin1 NOT NULL,
  `ccv2_no` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bsi_clients`
--

CREATE TABLE `bsi_clients` (
  `client_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(64) DEFAULT NULL,
  `surname` varchar(64) DEFAULT NULL,
  `title` varchar(16) DEFAULT NULL,
  `street_addr` text,
  `city` varchar(64) DEFAULT NULL,
  `province` varchar(128) DEFAULT NULL,
  `zip` varchar(64) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `phone` varchar(64) DEFAULT NULL,
  `fax` varchar(64) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `id_type` varchar(255) NOT NULL,
  `id_number` varchar(50) NOT NULL,
  `additional_comments` text,
  `ip` varchar(32) DEFAULT NULL,
  `existing_client` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bsi_configure`
--

CREATE TABLE `bsi_configure` (
  `conf_id` int(11) NOT NULL,
  `conf_key` varchar(100) NOT NULL,
  `conf_value` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='bsi hotel configurations';

--
-- Dumping data for table `bsi_configure`
--

INSERT INTO `bsi_configure` (`conf_id`, `conf_key`, `conf_value`) VALUES
(1, 'conf_hotel_name', 'Hotel Booking System PHP MYSQL Source Code'),
(2, 'conf_hotel_streetaddr', '99 xxxxx Road'),
(3, 'conf_hotel_city', 'Your City'),
(4, 'conf_hotel_state', 'Your State'),
(5, 'conf_hotel_country', 'USA'),
(6, 'conf_hotel_zipcode', '11211'),
(7, 'conf_hotel_phone', '+18778888972'),
(8, 'conf_hotel_fax', '+18778888972'),
(9, 'conf_hotel_email', 'admin@example.com'),
(20, 'conf_tax_amount', '10'),
(21, 'conf_dateformat', 'mm/dd/yy'),
(22, 'conf_booking_exptime', '1000'),
(25, 'conf_enabled_deposit', '1'),
(26, 'conf_hotel_timezone', 'Asia/Calcutta'),
(27, 'conf_booking_turn_off', '0'),
(28, 'conf_min_night_booking', '1'),
(30, 'conf_notification_email', 'admin@example.com'),
(31, 'conf_price_with_tax', '0'),
(32, 'conf_maximum_global_years', '730'),
(33, 'conf_payment_currency', '0'),
(34, 'conf_invoice_currency', '0'),
(35, 'conf_currency_update_time', '1483915029');

-- --------------------------------------------------------

--
-- Table structure for table `bsi_currency`
--

CREATE TABLE `bsi_currency` (
  `id` int(11) NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `currency_symbl` varchar(10) NOT NULL,
  `exchange_rate` decimal(20,6) NOT NULL,
  `default_c` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bsi_currency`
--

INSERT INTO `bsi_currency` (`id`, `currency_code`, `currency_symbl`, `exchange_rate`, `default_c`) VALUES
(1, 'USD', '$', '1.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bsi_email_contents`
--

CREATE TABLE `bsi_email_contents` (
  `id` int(11) NOT NULL,
  `email_name` varchar(500) NOT NULL,
  `email_subject` varchar(500) NOT NULL,
  `email_text` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bsi_email_contents`
--

INSERT INTO `bsi_email_contents` (`id`, `email_name`, `email_subject`, `email_text`) VALUES
(1, 'Confirmation Email', 'Confirmation of your successfull booking in our hotel', '<p><strong>Text can be chnage in admin panel</strong></p>\r\n'),
(2, 'Cancellation Email ', 'Cancellation Email subject', '<p><strong>Text can be chnage in admin panel</strong></p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `bsi_gallery`
--

CREATE TABLE `bsi_gallery` (
  `pic_id` int(11) NOT NULL,
  `roomtype_id` int(11) NOT NULL,
  `capacity_id` int(11) NOT NULL,
  `img_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bsi_invoice`
--

CREATE TABLE `bsi_invoice` (
  `booking_id` int(10) NOT NULL,
  `client_name` varchar(500) NOT NULL,
  `client_email` varchar(500) NOT NULL,
  `invoice` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bsi_language`
--

CREATE TABLE `bsi_language` (
  `id` int(11) NOT NULL,
  `lang_title` varchar(255) NOT NULL,
  `lang_code` varchar(10) NOT NULL,
  `lang_file` varchar(255) NOT NULL,
  `lang_default` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bsi_language`
--

INSERT INTO `bsi_language` (`id`, `lang_title`, `lang_code`, `lang_file`, `lang_default`) VALUES
(1, 'English', 'en', 'english.php', 1),
(2, 'French', 'fr', 'french.php', 0),
(3, 'German', 'de', 'german.php', 0),
(4, 'Greek', 'el', 'greek.php', 0),
(5, 'Spanish', 'es', 'espanol.php', 0),
(6, 'Italian', 'it', 'italian.php', 0),
(7, 'Dutch', 'nl', 'dutch.php', 0),
(8, 'Polish', 'pl', 'polish.php', 0),
(9, 'Portuguese', 'pt', 'portuguese.php', 0),
(10, 'Russian', 'ru', 'russian.php', 0),
(11, 'Turkish', 'tr', 'turkish.php', 0),
(12, 'Thai', 'th', 'thai.php', 0),
(13, 'Chinese', 'zh-CN', 'chinese.php', 0),
(14, 'Indonesian', 'id', 'indonesian.php', 0),
(15, 'Romanian', 'ro', 'romanian.php', 0),
(17, 'Japanese', 'ja', 'japanese.php', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bsi_payment_gateway`
--

CREATE TABLE `bsi_payment_gateway` (
  `id` int(11) NOT NULL,
  `gateway_name` varchar(255) NOT NULL,
  `gateway_code` varchar(50) NOT NULL,
  `account` varchar(255) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bsi_payment_gateway`
--

INSERT INTO `bsi_payment_gateway` (`id`, `gateway_name`, `gateway_code`, `account`, `enabled`) VALUES
(1, 'PayPal', 'pp', 'phpdev_1330251667_biz@aol.com', 1),
(2, 'Manual', 'poa', 'null', 1),
(3, 'Credit Card (offline)', 'cc', 'null', 1),
(4, 'Authorize.Net', 'an', '8nZ8py3MY=|=6936uG8m8hKFRP6A=|=bestsoftinc', 1),
(5, '2Checkout', '2co', '2002812', 1),
(6, 'Stripe', 'st', 'sk_test_HTGxkUdVdAGd3t0dFqFomE40#pk_test_c6KEy6DebkozRP0V9ysSDwVq#1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bsi_priceplan`
--

CREATE TABLE `bsi_priceplan` (
  `plan_id` int(10) NOT NULL,
  `roomtype_id` int(10) DEFAULT NULL,
  `capacity_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `sun` decimal(10,2) DEFAULT '0.00',
  `mon` decimal(10,2) DEFAULT '0.00',
  `tue` decimal(10,2) DEFAULT '0.00',
  `wed` decimal(10,2) DEFAULT '0.00',
  `thu` decimal(10,2) DEFAULT '0.00',
  `fri` decimal(10,2) DEFAULT '0.00',
  `sat` decimal(10,2) DEFAULT '0.00',
  `default_plan` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bsi_reservation`
--

CREATE TABLE `bsi_reservation` (
  `id` int(11) NOT NULL,
  `bookings_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bsi_room`
--

CREATE TABLE `bsi_room` (
  `room_ID` int(10) NOT NULL,
  `roomtype_id` int(10) DEFAULT NULL,
  `room_no` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `capacity_id` int(10) DEFAULT NULL,
  `no_of_child` int(11) NOT NULL DEFAULT '0',
  `extra_bed` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bsi_roomtype`
--

CREATE TABLE `bsi_roomtype` (
  `roomtype_ID` int(10) NOT NULL,
  `type_name` varchar(500) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bsi_special_offer`
--

CREATE TABLE `bsi_special_offer` (
  `id` int(11) NOT NULL,
  `offer_title` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `room_type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `price_deduc` decimal(10,2) NOT NULL,
  `min_stay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bsi_admin`
--
ALTER TABLE `bsi_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bsi_adminmenu`
--
ALTER TABLE `bsi_adminmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bsi_advance_payment`
--
ALTER TABLE `bsi_advance_payment`
  ADD PRIMARY KEY (`month_num`);

--
-- Indexes for table `bsi_bookings`
--
ALTER TABLE `bsi_bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `start_date` (`start_date`),
  ADD KEY `end_date` (`end_date`),
  ADD KEY `booking_time` (`discount_coupon`);

--
-- Indexes for table `bsi_capacity`
--
ALTER TABLE `bsi_capacity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bsi_cc_info`
--
ALTER TABLE `bsi_cc_info`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `bsi_clients`
--
ALTER TABLE `bsi_clients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `bsi_configure`
--
ALTER TABLE `bsi_configure`
  ADD PRIMARY KEY (`conf_id`);

--
-- Indexes for table `bsi_currency`
--
ALTER TABLE `bsi_currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bsi_email_contents`
--
ALTER TABLE `bsi_email_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bsi_gallery`
--
ALTER TABLE `bsi_gallery`
  ADD PRIMARY KEY (`pic_id`);

--
-- Indexes for table `bsi_invoice`
--
ALTER TABLE `bsi_invoice`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `bsi_language`
--
ALTER TABLE `bsi_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bsi_payment_gateway`
--
ALTER TABLE `bsi_payment_gateway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bsi_priceplan`
--
ALTER TABLE `bsi_priceplan`
  ADD PRIMARY KEY (`plan_id`),
  ADD KEY `priceplan` (`roomtype_id`,`capacity_id`,`start_date`,`end_date`);

--
-- Indexes for table `bsi_reservation`
--
ALTER TABLE `bsi_reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bsi_room`
--
ALTER TABLE `bsi_room`
  ADD PRIMARY KEY (`room_ID`),
  ADD KEY `roomtype_id` (`roomtype_id`);

--
-- Indexes for table `bsi_roomtype`
--
ALTER TABLE `bsi_roomtype`
  ADD PRIMARY KEY (`roomtype_ID`);

--
-- Indexes for table `bsi_special_offer`
--
ALTER TABLE `bsi_special_offer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bsi_admin`
--
ALTER TABLE `bsi_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bsi_adminmenu`
--
ALTER TABLE `bsi_adminmenu`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `bsi_advance_payment`
--
ALTER TABLE `bsi_advance_payment`
  MODIFY `month_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `bsi_capacity`
--
ALTER TABLE `bsi_capacity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bsi_clients`
--
ALTER TABLE `bsi_clients`
  MODIFY `client_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bsi_configure`
--
ALTER TABLE `bsi_configure`
  MODIFY `conf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `bsi_currency`
--
ALTER TABLE `bsi_currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bsi_email_contents`
--
ALTER TABLE `bsi_email_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bsi_gallery`
--
ALTER TABLE `bsi_gallery`
  MODIFY `pic_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bsi_language`
--
ALTER TABLE `bsi_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `bsi_payment_gateway`
--
ALTER TABLE `bsi_payment_gateway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `bsi_priceplan`
--
ALTER TABLE `bsi_priceplan`
  MODIFY `plan_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bsi_reservation`
--
ALTER TABLE `bsi_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bsi_room`
--
ALTER TABLE `bsi_room`
  MODIFY `room_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bsi_roomtype`
--
ALTER TABLE `bsi_roomtype`
  MODIFY `roomtype_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bsi_special_offer`
--
ALTER TABLE `bsi_special_offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
