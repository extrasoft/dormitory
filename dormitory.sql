-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2017 at 08:20 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dormitory`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `accs_id` smallint(4) NOT NULL,
  `accs_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accs_price` float(7,2) NOT NULL,
  `dorm_id` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_id` smallint(4) NOT NULL,
  `bank_bank` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_branch` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dorm_id` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `bill_month` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bill_water` int(6) NOT NULL,
  `bill_electric` int(6) NOT NULL,
  `bill_note` date NOT NULL,
  `bill_bank` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_branch` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_money` float(8,2) DEFAULT NULL,
  `bill_img` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bill_payment` datetime DEFAULT NULL,
  `room_id` int(10) NOT NULL,
  `dorm_id` smallint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dormitory`
--

CREATE TABLE `dormitory` (
  `dorm_id` smallint(4) NOT NULL,
  `dorm_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dorm_address` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dorm_tel` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dorm_email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dorm_class` tinyint(2) NOT NULL,
  `dorm_room` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dorm_water` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dorm_electric` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mem_id` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `electric_alert`
--

CREATE TABLE `electric_alert` (
  `aelectric_id` int(11) NOT NULL,
  `aelectric_month` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aelectric_meter` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aelectric_img` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_id` int(10) NOT NULL,
  `mem_id` smallint(4) NOT NULL,
  `dorm_id` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `electric_tariffs`
--

CREATE TABLE `electric_tariffs` (
  `electric_id` smallint(4) NOT NULL,
  `electric_type` tinyint(1) NOT NULL,
  `electric_price` float(8,2) NOT NULL,
  `dorm_id` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` smallint(4) NOT NULL,
  `emp_firstname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_lastname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_address` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_tel` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_position` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_salary` int(6) NOT NULL,
  `mem_id` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `mem_id` smallint(4) NOT NULL,
  `mem_username` varchar(30) NOT NULL,
  `mem_password` varchar(32) NOT NULL,
  `mem_firstname` varchar(30) NOT NULL,
  `mem_lastname` varchar(30) NOT NULL,
  `mem_address` varchar(256) DEFAULT NULL,
  `mem_email` varchar(50) NOT NULL,
  `mem_emailMD5` varchar(32) NOT NULL,
  `mem_tel` varchar(10) NOT NULL,
  `mem_img` varchar(100) DEFAULT NULL,
  `mem_type` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `parcel`
--

CREATE TABLE `parcel` (
  `par_id` int(7) NOT NULL,
  `par_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `par_address` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `par_date` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `par_img` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dorm_id` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `renter`
--

CREATE TABLE `renter` (
  `rent_id` smallint(4) NOT NULL,
  `rent_firstname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rent_lastname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rent_address` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rent_email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rent_tel` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mem_id` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repair`
--

CREATE TABLE `repair` (
  `rep_id` smallint(4) NOT NULL,
  `rep_topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rep_detail` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rep_img` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rep_date` datetime NOT NULL,
  `rep_status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_id` int(10) NOT NULL,
  `dorm_id` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repair_detail`
--

CREATE TABLE `repair_detail` (
  `repd_id` int(11) NOT NULL,
  `repd_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `repd_price` float(8,2) NOT NULL,
  `repd_amount` int(3) NOT NULL,
  `repd_date` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_id` smallint(4) DEFAULT NULL,
  `rep_id` smallint(4) DEFAULT NULL,
  `mem_id` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `reply_id` int(5) NOT NULL,
  `reply_detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply_img` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply_date` datetime NOT NULL,
  `topic_id` int(5) NOT NULL,
  `mem_id` smallint(4) NOT NULL,
  `dorm_id` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(10) NOT NULL,
  `room_class` int(2) NOT NULL,
  `room_name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_guest` int(2) DEFAULT NULL,
  `room_price` int(5) NOT NULL,
  `room_internet` float(7,2) DEFAULT NULL,
  `room_parking` int(4) DEFAULT NULL,
  `room_others` int(4) DEFAULT NULL,
  `room_accessories` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_discount` int(4) DEFAULT NULL,
  `room_status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_lease` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_lease_end` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_money` float(7,2) DEFAULT NULL,
  `room_water` int(6) DEFAULT NULL,
  `room_electric` int(6) DEFAULT NULL,
  `room_img` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dorm_id` smallint(4) NOT NULL,
  `rent_id` smallint(4) DEFAULT NULL,
  `mem_id` smallint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `topic_id` int(5) NOT NULL,
  `topic_topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic_detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic_img` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topic_date` datetime NOT NULL,
  `topic_view` int(7) NOT NULL,
  `topic_reply` int(7) NOT NULL,
  `mem_id` smallint(4) NOT NULL,
  `dorm_id` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `water_alert`
--

CREATE TABLE `water_alert` (
  `awater_id` int(11) NOT NULL,
  `awater_month` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `awater_meter` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `awater_img` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_id` int(10) NOT NULL,
  `mem_id` smallint(4) NOT NULL,
  `dorm_id` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `water_tariffs`
--

CREATE TABLE `water_tariffs` (
  `water_id` smallint(4) NOT NULL,
  `water_type` tinyint(1) NOT NULL,
  `water_price` float(8,2) NOT NULL,
  `dorm_id` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`accs_id`),
  ADD KEY `dorm_id` (`dorm_id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`),
  ADD KEY `dorm_id` (`dorm_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `dormitory`
--
ALTER TABLE `dormitory`
  ADD PRIMARY KEY (`dorm_id`),
  ADD KEY `mem_id` (`mem_id`);

--
-- Indexes for table `electric_alert`
--
ALTER TABLE `electric_alert`
  ADD PRIMARY KEY (`aelectric_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `mem_id` (`mem_id`),
  ADD KEY `dorm_id` (`dorm_id`);

--
-- Indexes for table `electric_tariffs`
--
ALTER TABLE `electric_tariffs`
  ADD PRIMARY KEY (`electric_id`),
  ADD KEY `dorm_id` (`dorm_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `mem_id` (`mem_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`mem_id`),
  ADD UNIQUE KEY `mem_username` (`mem_username`),
  ADD UNIQUE KEY `mem_email` (`mem_email`);

--
-- Indexes for table `parcel`
--
ALTER TABLE `parcel`
  ADD PRIMARY KEY (`par_id`),
  ADD KEY `dorm_id` (`dorm_id`);

--
-- Indexes for table `renter`
--
ALTER TABLE `renter`
  ADD PRIMARY KEY (`rent_id`),
  ADD KEY `mem_id` (`mem_id`);

--
-- Indexes for table `repair`
--
ALTER TABLE `repair`
  ADD PRIMARY KEY (`rep_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `dorm_id` (`dorm_id`);

--
-- Indexes for table `repair_detail`
--
ALTER TABLE `repair_detail`
  ADD PRIMARY KEY (`repd_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `rep_id` (`rep_id`),
  ADD KEY `mem_id` (`mem_id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `mem_id` (`mem_id`),
  ADD KEY `dorm_id` (`dorm_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `dorm_id` (`dorm_id`),
  ADD KEY `mem_id` (`mem_id`),
  ADD KEY `rent_id` (`rent_id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `dorm_id` (`dorm_id`),
  ADD KEY `mem_id` (`mem_id`);

--
-- Indexes for table `water_alert`
--
ALTER TABLE `water_alert`
  ADD PRIMARY KEY (`awater_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `mem_id` (`mem_id`),
  ADD KEY `dorm_id` (`dorm_id`);

--
-- Indexes for table `water_tariffs`
--
ALTER TABLE `water_tariffs`
  ADD PRIMARY KEY (`water_id`),
  ADD KEY `dorm_id` (`dorm_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `accs_id` smallint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` smallint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dormitory`
--
ALTER TABLE `dormitory`
  MODIFY `dorm_id` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;
--
-- AUTO_INCREMENT for table `electric_alert`
--
ALTER TABLE `electric_alert`
  MODIFY `aelectric_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `electric_tariffs`
--
ALTER TABLE `electric_tariffs`
  MODIFY `electric_id` smallint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` smallint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `mem_id` smallint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `parcel`
--
ALTER TABLE `parcel`
  MODIFY `par_id` int(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `renter`
--
ALTER TABLE `renter`
  MODIFY `rent_id` smallint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `repair`
--
ALTER TABLE `repair`
  MODIFY `rep_id` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;
--
-- AUTO_INCREMENT for table `repair_detail`
--
ALTER TABLE `repair_detail`
  MODIFY `repd_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `reply_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `topic_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `water_alert`
--
ALTER TABLE `water_alert`
  MODIFY `awater_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `water_tariffs`
--
ALTER TABLE `water_tariffs`
  MODIFY `water_id` smallint(4) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `accessories`
--
ALTER TABLE `accessories`
  ADD CONSTRAINT `accessories_ibfk_1` FOREIGN KEY (`dorm_id`) REFERENCES `dormitory` (`dorm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bank`
--
ALTER TABLE `bank`
  ADD CONSTRAINT `bank_ibfk_1` FOREIGN KEY (`dorm_id`) REFERENCES `dormitory` (`dorm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dormitory`
--
ALTER TABLE `dormitory`
  ADD CONSTRAINT `dormitory_ibfk_1` FOREIGN KEY (`mem_id`) REFERENCES `member` (`mem_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `electric_alert`
--
ALTER TABLE `electric_alert`
  ADD CONSTRAINT `electric_alert_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `electric_alert_ibfk_2` FOREIGN KEY (`mem_id`) REFERENCES `member` (`mem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `electric_alert_ibfk_3` FOREIGN KEY (`dorm_id`) REFERENCES `dormitory` (`dorm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `electric_tariffs`
--
ALTER TABLE `electric_tariffs`
  ADD CONSTRAINT `electric_tariffs_ibfk_1` FOREIGN KEY (`dorm_id`) REFERENCES `dormitory` (`dorm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`mem_id`) REFERENCES `member` (`mem_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parcel`
--
ALTER TABLE `parcel`
  ADD CONSTRAINT `parcel_ibfk_1` FOREIGN KEY (`dorm_id`) REFERENCES `dormitory` (`dorm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `renter`
--
ALTER TABLE `renter`
  ADD CONSTRAINT `renter_ibfk_1` FOREIGN KEY (`mem_id`) REFERENCES `member` (`mem_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `repair`
--
ALTER TABLE `repair`
  ADD CONSTRAINT `repair_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `repair_ibfk_2` FOREIGN KEY (`dorm_id`) REFERENCES `dormitory` (`dorm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `repair_detail`
--
ALTER TABLE `repair_detail`
  ADD CONSTRAINT `repair_detail_ibfk_3` FOREIGN KEY (`mem_id`) REFERENCES `member` (`mem_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reply_ibfk_2` FOREIGN KEY (`mem_id`) REFERENCES `member` (`mem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reply_ibfk_3` FOREIGN KEY (`dorm_id`) REFERENCES `dormitory` (`dorm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`dorm_id`) REFERENCES `dormitory` (`dorm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`dorm_id`) REFERENCES `dormitory` (`dorm_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`mem_id`) REFERENCES `member` (`mem_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `water_alert`
--
ALTER TABLE `water_alert`
  ADD CONSTRAINT `water_alert_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `water_alert_ibfk_2` FOREIGN KEY (`mem_id`) REFERENCES `member` (`mem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `water_alert_ibfk_3` FOREIGN KEY (`dorm_id`) REFERENCES `dormitory` (`dorm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `water_tariffs`
--
ALTER TABLE `water_tariffs`
  ADD CONSTRAINT `water_tariffs_ibfk_1` FOREIGN KEY (`dorm_id`) REFERENCES `dormitory` (`dorm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
