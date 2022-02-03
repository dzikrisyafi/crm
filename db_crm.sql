-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2022 at 06:42 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_schedule`
--

CREATE TABLE `activity_schedule` (
  `id` int(3) NOT NULL,
  `opportunity_id` int(4) NOT NULL,
  `activity_id` int(3) NOT NULL,
  `expected_closing` datetime NOT NULL,
  `summary` varchar(50) NOT NULL,
  `sales_person` int(3) NOT NULL,
  `note` text NOT NULL,
  `is_done` tinyint(1) NOT NULL,
  `feedback` varchar(30) NOT NULL,
  `completion_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_schedule`
--

INSERT INTO `activity_schedule` (`id`, `opportunity_id`, `activity_id`, `expected_closing`, `summary`, `sales_person`, `note`, `is_done`, `feedback`, `completion_date`) VALUES
(1, 19, 1, '2022-01-17 01:09:33', '', 1, '', 1, 'next schedule si meeting', '2022-01-18 04:14:18'),
(2, 18, 2, '2022-01-20 13:39:41', '', 1, '', 1, 'Tester12344', '2022-01-18 04:10:45'),
(3, 18, 4, '2022-01-31 14:14:23', '', 1, '', 1, 'Tester', '2022-01-18 04:06:15'),
(6, 18, 4, '2022-01-25 09:21:48', '', 1, '', 1, 'Tester', '2022-01-18 04:06:15'),
(7, 22, 2, '2022-01-24 09:22:29', '', 1, '', 1, 'tester', '2022-01-18 04:02:21'),
(8, 18, 2, '2022-01-26 10:06:19', '', 1, '', 1, 'Tester12344', '2022-01-18 04:10:45'),
(9, 18, 2, '2022-01-31 10:10:27', '', 1, '', 1, 'Tester12344', '2022-01-18 04:10:45'),
(10, 18, 3, '2022-01-25 10:13:12', '', 1, '', 1, 'Test', '2022-01-18 04:13:28'),
(11, 18, 4, '2022-01-18 10:13:28', '', 1, 'follow up quote', 0, '', NULL),
(12, 19, 3, '2022-01-31 10:14:18', '', 1, 'done', 0, '', NULL),
(13, 20, 2, '2022-01-31 03:04:39', '', 1, '', 1, 'Schedule next', '2022-01-18 09:05:10'),
(14, 20, 4, '2022-02-08 03:05:10', '', 1, 'tester note', 0, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_contact`
--

CREATE TABLE `customer_contact` (
  `id` int(5) NOT NULL,
  `company_id` int(4) DEFAULT NULL,
  `contact_id` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_contact`
--

INSERT INTO `customer_contact` (`id`, `company_id`, `contact_id`) VALUES
(1, 1, 3),
(2, 2, 2),
(3, 5, NULL),
(5, 5, 2),
(6, 5, 3),
(7, 1, NULL),
(8, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_activity`
--

CREATE TABLE `m_activity` (
  `activity_id` int(3) NOT NULL,
  `activity_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_activity`
--

INSERT INTO `m_activity` (`activity_id`, `activity_type`) VALUES
(1, 'Email'),
(2, 'Call'),
(3, 'Meeting'),
(4, 'Follow-up Quote'),
(5, 'Make Quote'),
(6, 'Call for Demo'),
(7, 'Email: Welcome Demo'),
(8, 'To Do'),
(9, 'Upload Document');

-- --------------------------------------------------------

--
-- Table structure for table `m_company`
--

CREATE TABLE `m_company` (
  `company_id` int(4) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `street` varchar(60) NOT NULL,
  `street2` varchar(60) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state_id` int(3) DEFAULT NULL,
  `zip_code` char(5) NOT NULL,
  `country_id` int(4) DEFAULT NULL,
  `tax_id` char(12) DEFAULT NULL,
  `phone` char(12) NOT NULL,
  `mobile` char(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `website` varchar(50) NOT NULL,
  `tag_id` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_company`
--

INSERT INTO `m_company` (`company_id`, `company_name`, `street`, `street2`, `city`, `state_id`, `zip_code`, `country_id`, `tax_id`, `phone`, `mobile`, `email`, `website`, `tag_id`) VALUES
(1, 'Azure Interior', '', '', '', NULL, '', NULL, '', '', '', 'azureinterior@azure.com', '', NULL),
(2, 'PT. Teknologi Karya', '', '', '', NULL, '', NULL, NULL, '', '', 'admin@innovation-projects.com', '', NULL),
(5, 'Inovasi Informatika', 'Rasuna', '', 'Jakarta Selatan', 1, '16320', 1, 'BE04212BA', '081289889201', '081289889201', 'admin@i3.com', 'https://inovasi-informatika.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_country`
--

CREATE TABLE `m_country` (
  `country_id` int(4) NOT NULL,
  `country` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_country`
--

INSERT INTO `m_country` (`country_id`, `country`) VALUES
(1, 'Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `m_individual`
--

CREATE TABLE `m_individual` (
  `contact_id` int(4) NOT NULL,
  `contact_name` varchar(40) NOT NULL,
  `street` varchar(60) NOT NULL,
  `street2` varchar(60) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state_id` int(3) DEFAULT NULL,
  `zip_code` int(5) NOT NULL,
  `country_id` int(4) DEFAULT NULL,
  `tax_id` char(12) NOT NULL,
  `job_position` varchar(30) NOT NULL,
  `phone` char(12) NOT NULL,
  `mobile` char(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `website` varchar(50) NOT NULL,
  `title_id` int(2) DEFAULT NULL,
  `tag_id` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_individual`
--

INSERT INTO `m_individual` (`contact_id`, `contact_name`, `street`, `street2`, `city`, `state_id`, `zip_code`, `country_id`, `tax_id`, `job_position`, `phone`, `mobile`, `email`, `website`, `title_id`, `tag_id`) VALUES
(2, 'Dzikri', '', '', '', 1, 0, 1, '', 'Software Developer', '', '081289889201', 'dzikriauliya@gmail.com', '', 1, 1),
(3, 'Gilar Ginanjar', '', '', '', 1, 0, 1, '', 'Project Manager', '', '081292839021', 'gilarginanjar@gmail.com', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_opportunity`
--

CREATE TABLE `m_opportunity` (
  `opportunity_id` int(4) NOT NULL,
  `stage_id` int(3) NOT NULL,
  `contact_id` int(4) NOT NULL,
  `opportunity` varchar(30) NOT NULL,
  `revenue` double NOT NULL,
  `priority_id` int(1) NOT NULL,
  `expected_closing` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_opportunity`
--

INSERT INTO `m_opportunity` (`opportunity_id`, `stage_id`, `contact_id`, `opportunity`, `revenue`, `priority_id`, `expected_closing`) VALUES
(18, 8, 1, 'Office design and architecture', 300000, 2, '2022-01-21 11:04:33'),
(19, 13, 7, 'Azure opportunity', 20000, 2, '2022-01-21 11:14:15'),
(20, 15, 5, 'Tester opportunity', 20000, 2, '2022-01-31 02:38:19'),
(21, 13, 2, 'Tes123', 200000, 3, '2022-01-31 08:19:07'),
(23, 15, 1, 'Tester123', 200000, 2, '2022-01-31 03:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `m_priority`
--

CREATE TABLE `m_priority` (
  `priority_id` int(1) NOT NULL,
  `priority` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_priority`
--

INSERT INTO `m_priority` (`priority_id`, `priority`) VALUES
(1, 'Medium'),
(2, 'High'),
(3, 'Very High');

-- --------------------------------------------------------

--
-- Table structure for table `m_sales_team`
--

CREATE TABLE `m_sales_team` (
  `sales_team_id` int(3) NOT NULL,
  `sales_team` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_sales_team`
--

INSERT INTO `m_sales_team` (`sales_team_id`, `sales_team`) VALUES
(1, 'Sales'),
(2, 'Pre-Sales');

-- --------------------------------------------------------

--
-- Table structure for table `m_service`
--

CREATE TABLE `m_service` (
  `service_id` int(4) NOT NULL,
  `service` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_service`
--

INSERT INTO `m_service` (`service_id`, `service`) VALUES
(1, 'Consulting Services'),
(2, 'Vendor / Desk Manufacturers'),
(3, 'Employees');

-- --------------------------------------------------------

--
-- Table structure for table `m_stage`
--

CREATE TABLE `m_stage` (
  `stage_id` int(3) NOT NULL,
  `order_num` int(2) NOT NULL,
  `stage` varchar(30) NOT NULL,
  `is_won` tinyint(1) NOT NULL,
  `sales_team_id` int(3) NOT NULL,
  `requirements` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_stage`
--

INSERT INTO `m_stage` (`stage_id`, `order_num`, `stage`, `is_won`, `sales_team_id`, `requirements`) VALUES
(8, 1, 'Prospect', 0, 0, ''),
(9, 3, 'Approach User', 0, 0, ''),
(12, 4, 'Expected Close', 0, 0, ''),
(13, 5, 'Closed', 0, 0, ''),
(15, 2, 'Ongoing', 0, 0, ''),
(21, 6, 'Stage test', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `m_state`
--

CREATE TABLE `m_state` (
  `state_id` int(4) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_state`
--

INSERT INTO `m_state` (`state_id`, `state`, `country_id`) VALUES
(1, 'Jawa Barat', 1),
(2, 'Jawa Tengah', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_title`
--

CREATE TABLE `m_title` (
  `title_id` int(2) NOT NULL,
  `title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_title`
--

INSERT INTO `m_title` (`title_id`, `title`) VALUES
(1, 'Miss'),
(2, 'Mister');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_schedule`
--
ALTER TABLE `activity_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_contact`
--
ALTER TABLE `customer_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_activity`
--
ALTER TABLE `m_activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `m_company`
--
ALTER TABLE `m_company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `m_country`
--
ALTER TABLE `m_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `m_individual`
--
ALTER TABLE `m_individual`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `m_opportunity`
--
ALTER TABLE `m_opportunity`
  ADD PRIMARY KEY (`opportunity_id`),
  ADD KEY `stage_id` (`stage_id`);

--
-- Indexes for table `m_priority`
--
ALTER TABLE `m_priority`
  ADD PRIMARY KEY (`priority_id`);

--
-- Indexes for table `m_sales_team`
--
ALTER TABLE `m_sales_team`
  ADD PRIMARY KEY (`sales_team_id`);

--
-- Indexes for table `m_service`
--
ALTER TABLE `m_service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `m_stage`
--
ALTER TABLE `m_stage`
  ADD PRIMARY KEY (`stage_id`);

--
-- Indexes for table `m_state`
--
ALTER TABLE `m_state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `m_title`
--
ALTER TABLE `m_title`
  ADD PRIMARY KEY (`title_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_schedule`
--
ALTER TABLE `activity_schedule`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customer_contact`
--
ALTER TABLE `customer_contact`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `m_activity`
--
ALTER TABLE `m_activity`
  MODIFY `activity_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `m_company`
--
ALTER TABLE `m_company`
  MODIFY `company_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_country`
--
ALTER TABLE `m_country`
  MODIFY `country_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `m_individual`
--
ALTER TABLE `m_individual`
  MODIFY `contact_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_opportunity`
--
ALTER TABLE `m_opportunity`
  MODIFY `opportunity_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `m_priority`
--
ALTER TABLE `m_priority`
  MODIFY `priority_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_sales_team`
--
ALTER TABLE `m_sales_team`
  MODIFY `sales_team_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_service`
--
ALTER TABLE `m_service`
  MODIFY `service_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_stage`
--
ALTER TABLE `m_stage`
  MODIFY `stage_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `m_state`
--
ALTER TABLE `m_state`
  MODIFY `state_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_title`
--
ALTER TABLE `m_title`
  MODIFY `title_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_opportunity`
--
ALTER TABLE `m_opportunity`
  ADD CONSTRAINT `m_opportunity_ibfk_1` FOREIGN KEY (`stage_id`) REFERENCES `m_stage` (`stage_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
