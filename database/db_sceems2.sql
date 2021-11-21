-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2021 at 09:31 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sceems2`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE `account_type` (
  `account_type_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`account_type_id`, `name`) VALUES
(1, 'Residential'),
(2, 'Commercial - Small'),
(3, 'Commercial - Medium'),
(4, 'Commercial - Large'),
(5, 'Commercial - Very Large'),
(6, 'Industrial'),
(7, 'Street Lights');

-- --------------------------------------------------------

--
-- Table structure for table `bill_cycle`
--

CREATE TABLE `bill_cycle` (
  `bill_cycle_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `previous_meter_reading` decimal(20,6) NOT NULL,
  `present_meter_reading` decimal(20,6) NOT NULL,
  `no_of_data` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` varchar(5) NOT NULL,
  `total_bill` decimal(20,6) NOT NULL,
  `payment_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_cycle`
--

INSERT INTO `bill_cycle` (`bill_cycle_id`, `account_id`, `previous_meter_reading`, `present_meter_reading`, `no_of_data`, `month`, `year`, `total_bill`, `payment_status`) VALUES
(5, 1920384, '110.000000', '230.109375', 1208, 'December', '2017', '720.609600', ''),
(6, 2106872, '110.000000', '500.000000', 0, 'November', '2017', '2340.000000', ''),
(7, 2106872, '390.000000', '590.525000', 860, 'December', '2017', '1203.150000', ''),
(28, 2106872, '200.525000', '200.587500', 100, 'January', '2018', '0.375000', ''),
(29, 1920384, '120.109375', '190.109375', 5, 'November', '2021', '350.000000', '');

-- --------------------------------------------------------

--
-- Table structure for table `budget_set`
--

CREATE TABLE `budget_set` (
  `budget_set_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `budget_set` decimal(20,6) NOT NULL,
  `budget_consumed` decimal(20,6) NOT NULL,
  `kilowatts_consumed` decimal(20,6) NOT NULL,
  `month` varchar(25) NOT NULL,
  `year` varchar(5) NOT NULL,
  `budget_set_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budget_set`
--

INSERT INTO `budget_set` (`budget_set_id`, `account_id`, `budget_set`, `budget_consumed`, `kilowatts_consumed`, `month`, `year`, `budget_set_status`) VALUES
(1, 1920384, '400.000000', '260.000000', '20.000000', 'April', '2018', 'Warning'),
(2, 1920384, '50.000000', '50.000000', '0.000000', 'November', '2021', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `notification_subject` varchar(150) NOT NULL,
  `notification_text` text NOT NULL,
  `notification_status` int(1) NOT NULL,
  `notification_seen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `account_id`, `notification_subject`, `notification_text`, `notification_status`, `notification_seen`) VALUES
(1, 1920384, 'Warning!', 'Warning!', 1, ''),
(31, 2106872, 'Bill', 'Good day! Your SCEEMS bill is on here!\r\n                    User Account No: 2106872\r\n                    Bill as of 31/12/2017\r\n                    Amount due is PHP 1203.15\r\n                    Due date is on 3/01/2018\r\n                    Cut off date is on 10/01/2018\r\n                    Thank you for keeping your bill up to date.\r\n                    This is a system generated message, do not reply. Please disregard this message if you have already settled your bill.', 1, 'hasSeen'),
(32, 1920384, 'Bill', 'Good day! Your SCEEMS bill is on here!\r\n                    User Account No: 1920384\r\n                    Bill as of 31/03/2018\r\n                    Amount due is PHP \r\n                    Due date is on 3/04/2018\r\n                    Cut off date is on 10/04/2018\r\n                    Thank you for keeping your bill up to date.\r\n                    This is a system generated message, do not reply. Please disregard this message if you have already settled your bill.', 1, 'hasSeen'),
(33, 1920384, 'Bill', 'Good day! Your SCEEMS bill is on here!\r\n                    User Account No: 1920384\r\n                    Bill as of 31/03/2018\r\n                    Amount due is PHP \r\n                    Due date is on 3/04/2018\r\n                    Cut off date is on 10/04/2018\r\n                    Thank you for keeping your bill up to date.\r\n                    This is a system generated message, do not reply. Please disregard this message if you have already settled your bill.', 1, 'hasSeen'),
(34, 1920384, 'Warning!', 'Your budget is about to finish! -SCEEMS', 1, 'hasSeen'),
(35, 1920384, 'Bill', 'Good day! Your SCEEMS bill is on here!\r\n                    User Account No: 1920384\r\n                    Bill as of 31/03/2018\r\n                    Amount due is PHP \r\n                    Due date is on 3/04/2018\r\n                    Cut off date is on 10/04/2018\r\n                    Thank you for keeping your bill up to date.\r\n                    This is a system generated message, do not reply. Please disregard this message if you have already settled your bill.', 1, 'hasSeen');

-- --------------------------------------------------------

--
-- Table structure for table `notifications_sms`
--

CREATE TABLE `notifications_sms` (
  `notification_sms_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `notification_sms_text` text NOT NULL,
  `notification_sms_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications_sms`
--

INSERT INTO `notifications_sms` (`notification_sms_id`, `account_id`, `notification_sms_text`, `notification_sms_status`) VALUES
(109, 2106872, 'Balance as of 31/12/2017 is Php 1203.15.', '1'),
(110, 2106872, 'Due on 3/01/2018.', '1'),
(111, 2106872, 'Your Acct. no. is 2106872. A message from SCEEMS. Thank you.', '1'),
(112, 1920384, 'Warning!', '1'),
(113, 1920384, 'Warning!', '1'),
(114, 1920384, 'Warning!', '1'),
(115, 1920384, 'Your Balance is Php .', '0'),
(116, 1920384, 'Your Balance is Php .', '0'),
(117, 1920384, 'Your budget is about to finish! -SCEEMS', '0'),
(118, 1920384, 'Your Balance is Php .', '0');

-- --------------------------------------------------------

--
-- Table structure for table `power_switch`
--

CREATE TABLE `power_switch` (
  `account_id` int(11) NOT NULL,
  `status` enum('ON','OFF') NOT NULL,
  `Cut` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `power_switch`
--

INSERT INTO `power_switch` (`account_id`, `status`, `Cut`) VALUES
(1920384, 'ON', 'Deactive'),
(2106872, 'ON', 'Deactive');

-- --------------------------------------------------------

--
-- Table structure for table `present_kilowatts_checker`
--

CREATE TABLE `present_kilowatts_checker` (
  `present_kilowatts_id` int(11) NOT NULL,
  `present_kilowatts` decimal(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `present_kilowatts_checker`
--

INSERT INTO `present_kilowatts_checker` (`present_kilowatts_id`, `present_kilowatts`) VALUES
(1, '20.000000'),
(2, '20.000000'),
(3, '10.000000'),
(4, '10.000000'),
(5, '10.000000');

-- --------------------------------------------------------

--
-- Table structure for table `price_rates`
--

CREATE TABLE `price_rates` (
  `price_rates_id` int(11) NOT NULL,
  `account_type_id` int(11) NOT NULL,
  `rate_name` varchar(50) NOT NULL,
  `rate` decimal(10,6) NOT NULL,
  `rate_date` date NOT NULL,
  `rate_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price_rates`
--

INSERT INTO `price_rates` (`price_rates_id`, `account_type_id`, `rate_name`, `rate`, `rate_date`, `rate_status`) VALUES
(1, 1, 'Generation Charge', '5.000000', '2018-04-22', 'old'),
(6, 1, 'Generation Charge', '5.515100', '2018-04-26', 'new'),
(7, 1, 'Power Act Reduction', '0.000000', '2018-04-26', 'new'),
(8, 1, 'Transmission Delivery Charge', '0.678300', '2018-04-27', 'new'),
(9, 1, 'System Loss', '0.637900', '2018-04-27', 'new'),
(10, 1, 'Distribution Network Charge', '1.208100', '2018-04-27', 'new'),
(11, 1, 'Retail Electric Service Charge', '0.492900', '2018-04-27', 'new'),
(12, 1, 'Metering Charge Php/kWh', '0.418900', '2018-04-27', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `account_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `account_type_id` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `contact_number2` varchar(20) NOT NULL,
  `status` enum('New','Active','Deactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`account_id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `account_type_id`, `address`, `contact_number`, `contact_number2`, `status`) VALUES
(1920384, 'Bluesho', 'sho', 'Shorouk', 'Sabry', 'El-Zeany', 1, 'Ireneville subd. Brgy. San Isidro', '9269593383', '9269593383', 'Active'),
(2106872, 'KarimSE', 'kar', 'Karim', 'Sabry', 'El-Zeany', 3, 'Quezon City, Manila', '9269593383', '', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`account_type_id`);

--
-- Indexes for table `bill_cycle`
--
ALTER TABLE `bill_cycle`
  ADD PRIMARY KEY (`bill_cycle_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `budget_set`
--
ALTER TABLE `budget_set`
  ADD PRIMARY KEY (`budget_set_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `account_id_2` (`account_id`);

--
-- Indexes for table `notifications_sms`
--
ALTER TABLE `notifications_sms`
  ADD PRIMARY KEY (`notification_sms_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `power_switch`
--
ALTER TABLE `power_switch`
  ADD KEY `account_id` (`account_id`),
  ADD KEY `account_id_2` (`account_id`);

--
-- Indexes for table `present_kilowatts_checker`
--
ALTER TABLE `present_kilowatts_checker`
  ADD PRIMARY KEY (`present_kilowatts_id`);

--
-- Indexes for table `price_rates`
--
ALTER TABLE `price_rates`
  ADD PRIMARY KEY (`price_rates_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `account_type_id` (`account_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `account_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `bill_cycle`
--
ALTER TABLE `bill_cycle`
  MODIFY `bill_cycle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `budget_set`
--
ALTER TABLE `budget_set`
  MODIFY `budget_set_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `notifications_sms`
--
ALTER TABLE `notifications_sms`
  MODIFY `notification_sms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT for table `present_kilowatts_checker`
--
ALTER TABLE `present_kilowatts_checker`
  MODIFY `present_kilowatts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `price_rates`
--
ALTER TABLE `price_rates`
  MODIFY `price_rates_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill_cycle`
--
ALTER TABLE `bill_cycle`
  ADD CONSTRAINT `bill_cycle_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `user_account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `budget_set`
--
ALTER TABLE `budget_set`
  ADD CONSTRAINT `budget_set_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `user_account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `user_account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications_sms`
--
ALTER TABLE `notifications_sms`
  ADD CONSTRAINT `notifications_sms_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `user_account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `power_switch`
--
ALTER TABLE `power_switch`
  ADD CONSTRAINT `power_switch_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `user_account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_account`
--
ALTER TABLE `user_account`
  ADD CONSTRAINT `user_account_ibfk_1` FOREIGN KEY (`account_type_id`) REFERENCES `account_type` (`account_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
