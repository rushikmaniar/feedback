-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2018 at 10:12 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `feedback`
--

-- --------------------------------------------------------

--
-- Table structure for table `analysis_master`
--

CREATE TABLE IF NOT EXISTS `analysis_master` (
  `id` int(11) NOT NULL COMMENT 'row_id staff analysis',
  `entry_id` int(11) NOT NULL COMMENT 'entry_id from entry_record',
  `class_id` int(11) NOT NULL COMMENT 'class id from class master',
  `section_id` int(11) NOT NULL COMMENT 'section bifergate',
  `point_id` int(11) NOT NULL COMMENT 'point_id from criteria_master',
  `points` int(11) NOT NULL DEFAULT '0' COMMENT 'points got 0 - 5',
  `emp_code` int(11) NOT NULL COMMENT 'emp_code from employee_master',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Staff points table';

-- --------------------------------------------------------

--
-- Table structure for table `class_master`
--

CREATE TABLE IF NOT EXISTS `class_master` (
  `id` int(11) NOT NULL COMMENT 'row id class master',
  `class_id` int(11) NOT NULL COMMENT 'class_id by college',
  `class_name` varchar(255) DEFAULT NULL COMMENT 'class_name',
  `dept_id` int(11) DEFAULT NULL COMMENT 'dept_id from department_master',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Class Master Table';

--
-- Dumping data for table `class_master`
--

INSERT INTO `class_master` (`id`, `class_id`, `class_name`, `dept_id`, `created_at`, `updated_at`) VALUES
(2, 2, 'BCA', 1, '1528282824', '1528283999'),
(3, 3, 'MCA', 1, '1528367575', '1528367575'),
(4, 4, 'MsciT', 1, '1528367588', '1528367588'),
(5, 5, 'BsciT', 1, '1528367596', '1528367596');

-- --------------------------------------------------------

--
-- Table structure for table `criteria_master`
--

CREATE TABLE IF NOT EXISTS `criteria_master` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL COMMENT 'section_id from section_master',
  `point_name` varchar(255) DEFAULT NULL,
  `type_data` int(1) NOT NULL DEFAULT '0' COMMENT '0=simple,1=radio',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='Criteria Master Table';

--
-- Dumping data for table `criteria_master`
--

INSERT INTO `criteria_master` (`id`, `section_id`, `point_name`, `type_data`, `created_at`, `updated_at`) VALUES
(1, 1, 'Subject Knowlege', 0, '1528878417', '1530078002'),
(2, 1, 'Prepardness', 0, '1528878432', '1528878432'),
(3, 1, 'Regularity', 0, '1528878503', '1528878503'),
(4, 1, 'Fluency in English', 0, '1528878526', '1528878526'),
(5, 1, 'Starts class in time', 0, '1528878541', '1528878541'),
(6, 1, 'Relationship with Students', 0, '1528878562', '1528878562'),
(7, 1, 'Class Disicpline', 0, '1528878575', '1528878644'),
(8, 1, 'Periodic Class Test', 0, '1528878599', '1528878599'),
(9, 2, 'Class Rooms', 0, '1528878687', '1528878687'),
(10, 2, 'Laboratories', 0, '1528878715', '1528878722'),
(11, 2, 'Cleanliness Of College Campus', 0, '1528878751', '1528878816'),
(12, 2, 'Urinals', 0, '1528878763', '1528878763'),
(13, 2, 'Parking Facility', 0, '1528878784', '1528878784'),
(14, 3, 'Reception', 0, '1528878838', '1528878838'),
(15, 3, 'First Aid', 0, '1528878851', '1528878851'),
(16, 3, 'Do You Read Notice Board?', 1, '1528878875', '1529739198'),
(17, 3, 'Frequency Of Office Visit', 1, '1528878913', '1529739257'),
(18, 3, 'Overall', 0, '1528878954', '1528878954'),
(19, 3, 'Bonafide', 0, '1528878967', '1528878967'),
(20, 3, 'Admission', 0, '1528878976', '1528878976'),
(21, 3, 'ID Card', 0, '1528878984', '1528878984'),
(22, 3, 'Enrolment', 0, '1528879000', '1528879000'),
(23, 3, 'Uni Exam Forms', 0, '1528879015', '1528879027'),
(24, 4, 'Cooperation Of Library Staff ?', 0, '1528879081', '1528879081'),
(25, 4, 'BOOKS AND REFERENCES', 0, '1528879142', '1528879142'),
(26, 4, 'CDS', 0, '1528879151', '1528879151'),
(27, 4, 'MAGAZINES', 0, '1528879165', '1528879165'),
(28, 4, 'QUESTION PAPER', 0, '1528879175', '1528879175'),
(29, 5, 'Quality Of Food Available', 0, '1528879216', '1528879216'),
(30, 5, 'Cleanliness Of Canteen', 0, '1528879246', '1528879246'),
(31, 5, 'Cleanliness Of Surrounding Area', 0, '1528879269', '1528879269'),
(32, 5, 'Variety Of Food Available', 0, '1528879291', '1528879291'),
(33, 5, 'Pricing Of Food', 0, '1528879313', '1528879313'),
(34, 6, 'Are You a Member Of Sports club ?', 1, '1528879352', '1529739138'),
(35, 6, 'Which Sports Facility Need Importance ?', 1, '1528879403', '1529740828'),
(36, 6, 'Do college tournaments Affects Studies?', 0, '1528879433', '1528879449');

-- --------------------------------------------------------

--
-- Table structure for table `department_master`
--

CREATE TABLE IF NOT EXISTS `department_master` (
  `id` int(11) NOT NULL COMMENT 'row id department master',
  `dept_id` int(11) NOT NULL COMMENT 'dept_id',
  `dept_name` varchar(255) DEFAULT NULL COMMENT 'dept name',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Department Master Table';

--
-- Dumping data for table `department_master`
--

INSERT INTO `department_master` (`id`, `dept_id`, `dept_name`, `created_at`, `updated_at`) VALUES
(1, 0, 'No Department', NULL, NULL),
(4, 1, 'Computer', '1528099679', '1528099679');

-- --------------------------------------------------------

--
-- Table structure for table `employee_allocation`
--

CREATE TABLE IF NOT EXISTS `employee_allocation` (
  `id` int(11) NOT NULL COMMENT 'row id emloyee_allocation master',
  `class_id` int(11) NOT NULL COMMENT 'class id from class master',
  `employee_codes` int(11) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='emloyee_allocation master';

--
-- Dumping data for table `employee_allocation`
--

INSERT INTO `employee_allocation` (`id`, `class_id`, `employee_codes`, `created_at`, `updated_at`) VALUES
(15, 5, 23, NULL, NULL),
(17, 3, 23, NULL, NULL),
(18, 2, 23, NULL, NULL),
(19, 2, 5, NULL, NULL),
(20, 2, 21, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_master`
--

CREATE TABLE IF NOT EXISTS `employee_master` (
  `id` int(11) NOT NULL COMMENT 'row id employee master',
  `emp_code` int(11) NOT NULL COMMENT 'employee unique id from college',
  `emp_name` varchar(255) DEFAULT NULL,
  `emp_phone` varchar(15) DEFAULT NULL COMMENT 'employee phone',
  `emp_email` varchar(255) DEFAULT NULL COMMENT 'employee table email',
  `dept_id` int(11) DEFAULT NULL COMMENT 'dept id from department_master',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Emplyoees Master table';

--
-- Dumping data for table `employee_master`
--

INSERT INTO `employee_master` (`id`, `emp_code`, `emp_name`, `emp_phone`, `emp_email`, `dept_id`, `created_at`, `updated_at`) VALUES
(4, 23, 'rushik', '6565656565', 'rushik2@gmail.com', 0, '1528032553', '1528032553'),
(5, 5, 'meet', '9898989898', 'as@gmail.com', 0, '1528104035', '1528367615'),
(6, 21, 'rushi', '6565656562', 'rushi@gmail.com', 0, '1528367673', '1528367673');

-- --------------------------------------------------------

--
-- Table structure for table `entry_record`
--

CREATE TABLE IF NOT EXISTS `entry_record` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='counts total entry feedback';

-- --------------------------------------------------------

--
-- Table structure for table `option_master`
--

CREATE TABLE IF NOT EXISTS `option_master` (
  `id` int(11) NOT NULL,
  `criteria_id` int(11) NOT NULL,
  `option_text` varchar(255) NOT NULL,
  `option_value` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf16 COMMENT='dynamic option for criteria';

--
-- Dumping data for table `option_master`
--

INSERT INTO `option_master` (`id`, `criteria_id`, `option_text`, `option_value`, `created_at`, `updated_at`) VALUES
(45, 34, 'Yes', 'Yes', 1529739137, 1529739137),
(46, 34, 'No', 'No', 1529739138, 1529739138),
(47, 16, 'Daily', 'Daily', 1529739198, 1529739198),
(48, 16, 'Twice a week', 'Twice a week', 1529739198, 1529739198),
(49, 16, 'Thrice a week', 'Thrice a week', 1529739198, 1529739198),
(50, 17, 'Daily', 'Daily', 1529739256, 1529739256),
(51, 17, 'Once a Week', 'Once a Week', 1529739257, 1529739257),
(52, 17, 'With Reference to Notice', 'With Reference to Notice', 1529739257, 1529739257),
(59, 35, 'volley Ball', 'volley Ball', 1529740828, 1529740828),
(60, 35, 'Basket Ball', 'Basket Ball', 1529740828, 1529740828),
(61, 35, 'Kabbadi', 'Kabbadi', 1529740828, 1529740828);

-- --------------------------------------------------------

--
-- Table structure for table `remarks_master`
--

CREATE TABLE IF NOT EXISTS `remarks_master` (
  `id` int(11) NOT NULL COMMENT 'row id for remarks_master',
  `entry_id` int(11) NOT NULL COMMENT 'entry_id from entry_record',
  `section_id` int(11) NOT NULL COMMENT 'section_id from section_master',
  `remarks` text NOT NULL COMMENT 'remarks',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='remarks for all section';

-- --------------------------------------------------------

--
-- Table structure for table `section_master`
--

CREATE TABLE IF NOT EXISTS `section_master` (
  `id` int(11) NOT NULL COMMENT 'seciotn_mster id',
  `section_name` varchar(255) NOT NULL COMMENT 'section_name unique',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='section_master';

--
-- Dumping data for table `section_master`
--

INSERT INTO `section_master` (`id`, `section_name`, `created_at`, `updated_at`) VALUES
(1, 'Employee Section', 1528878251, 1528878251),
(2, 'College Campus', 1528878260, 1528878260),
(3, 'Administration Section', 1528878273, 1528878273),
(4, 'Library Section', 1528878287, 1528878287),
(5, 'Canteen And Food', 1528878298, 1528878298),
(6, 'Sports Section', 1528878307, 1528878307);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL COMMENT 'row id for user',
  `user_email` varchar(255) NOT NULL COMMENT 'user email',
  `user_type` int(1) NOT NULL COMMENT 'user type 1=admin',
  `user_password` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT '1',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='User table ';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_type`, `user_password`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'admin@feedback.com', 1, '96e79218965eb72c92a549dd5a330112', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analysis_master`
--
ALTER TABLE `analysis_master`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `entryid_link` (`entry_id`);

--
-- Indexes for table `class_master`
--
ALTER TABLE `class_master`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `class_id` (`class_id`);

--
-- Indexes for table `criteria_master`
--
ALTER TABLE `criteria_master`
  ADD PRIMARY KEY (`id`), ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `department_master`
--
ALTER TABLE `department_master`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `dept_id` (`dept_id`);

--
-- Indexes for table `employee_allocation`
--
ALTER TABLE `employee_allocation`
  ADD PRIMARY KEY (`id`), ADD KEY `class_emplyoee_allocation` (`class_id`), ADD KEY `employee_employee_allocation` (`employee_codes`);

--
-- Indexes for table `employee_master`
--
ALTER TABLE `employee_master`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `emp_code` (`emp_code`), ADD UNIQUE KEY `emp_email` (`emp_email`), ADD KEY `deparmtent id link` (`dept_id`);

--
-- Indexes for table `entry_record`
--
ALTER TABLE `entry_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `option_master`
--
ALTER TABLE `option_master`
  ADD PRIMARY KEY (`id`), ADD KEY `criteria_option_link` (`criteria_id`);

--
-- Indexes for table `remarks_master`
--
ALTER TABLE `remarks_master`
  ADD PRIMARY KEY (`id`), ADD KEY `entry_id` (`entry_id`), ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `section_master`
--
ALTER TABLE `section_master`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `sectioin_name` (`section_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analysis_master`
--
ALTER TABLE `analysis_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'row_id staff analysis';
--
-- AUTO_INCREMENT for table `class_master`
--
ALTER TABLE `class_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'row id class master',AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `criteria_master`
--
ALTER TABLE `criteria_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `department_master`
--
ALTER TABLE `department_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'row id department master',AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `employee_allocation`
--
ALTER TABLE `employee_allocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'row id emloyee_allocation master',AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `employee_master`
--
ALTER TABLE `employee_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'row id employee master',AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `entry_record`
--
ALTER TABLE `entry_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `option_master`
--
ALTER TABLE `option_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `remarks_master`
--
ALTER TABLE `remarks_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'row id for remarks_master',AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `section_master`
--
ALTER TABLE `section_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'seciotn_mster id',AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'row id for user',AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `analysis_master`
--
ALTER TABLE `analysis_master`
ADD CONSTRAINT `entry_anlaysis_link` FOREIGN KEY (`entry_id`) REFERENCES `entry_record` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `criteria_master`
--
ALTER TABLE `criteria_master`
ADD CONSTRAINT `section_criteria` FOREIGN KEY (`section_id`) REFERENCES `section_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_allocation`
--
ALTER TABLE `employee_allocation`
ADD CONSTRAINT `class_allocation_link` FOREIGN KEY (`class_id`) REFERENCES `class_master` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `employee_allocation_link` FOREIGN KEY (`employee_codes`) REFERENCES `employee_master` (`emp_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_master`
--
ALTER TABLE `employee_master`
ADD CONSTRAINT `department_employee_link` FOREIGN KEY (`dept_id`) REFERENCES `department_master` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `option_master`
--
ALTER TABLE `option_master`
ADD CONSTRAINT `option_criteria_link` FOREIGN KEY (`criteria_id`) REFERENCES `criteria_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `remarks_master`
--
ALTER TABLE `remarks_master`
ADD CONSTRAINT `entry record bind` FOREIGN KEY (`entry_id`) REFERENCES `entry_record` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `section_id_remark_id` FOREIGN KEY (`section_id`) REFERENCES `section_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
