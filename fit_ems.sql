-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2021 at 07:06 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fit_ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(20) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_email` varchar(40) NOT NULL,
  `admin_pass` varchar(200) NOT NULL,
  `admin_pic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `admin_name`, `admin_username`, `admin_email`, `admin_pass`, `admin_pic`) VALUES
(8, 'Majharul', 'majharul', 'majharul347.info@gmail.com', 'f1bc07a0e1b64c4d8a5d4b9b8881e7303f4818ba', 'Image2314638.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `attend_status` varchar(20) NOT NULL,
  `present_time` varchar(25) NOT NULL,
  `today_date` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`id`, `emp_id`, `attend_status`, `present_time`, `today_date`) VALUES
(33, 3, 'h', '09:42:33 pm', '08-09-2021'),
(34, 4, 'p', '09:42:45 pm', '08-09-2021'),
(35, 5, 'p', '09:43:10 pm', '08-09-2021'),
(36, 6, 'a', '09:43:19 pm', '08-09-2021');

-- --------------------------------------------------------

--
-- Table structure for table `earning`
--

CREATE TABLE `earning` (
  `earn_id` int(100) NOT NULL,
  `earn_source` varchar(100) NOT NULL,
  `earn_amount` int(100) NOT NULL,
  `earn_date` varchar(20) NOT NULL,
  `currentdate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `earning`
--

INSERT INTO `earning` (`earn_id`, `earn_source`, `earn_amount`, `earn_date`, `currentdate`) VALUES
(1, 'Fiverr', 500, '2021-04-03', '2021-04'),
(2, 'Upwork', 550, '2021-04-21', '2021-04'),
(3, 'Local Marketplace', 500, '2021-05-18', '2021-05'),
(4, 'Freelancer', 200, '2021-04-18', '2021-04');

-- --------------------------------------------------------

--
-- Table structure for table `employee_info`
--

CREATE TABLE `employee_info` (
  `id` int(11) NOT NULL,
  `employee_id` int(50) NOT NULL,
  `emp_fullname` varchar(100) NOT NULL,
  `emp_mail` varchar(50) NOT NULL,
  `emp_phone` int(20) NOT NULL,
  `emp_designation` varchar(50) NOT NULL,
  `emp_salary` varchar(50) NOT NULL,
  `emp_address` varchar(100) NOT NULL,
  `emp_password` varchar(150) NOT NULL,
  `emp_bio` varchar(1000) NOT NULL,
  `profile_pic` varchar(50) NOT NULL,
  `register_timedate` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_salary` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`id`, `employee_id`, `emp_fullname`, `emp_mail`, `emp_phone`, `emp_designation`, `emp_salary`, `emp_address`, `emp_password`, `emp_bio`, `profile_pic`, `register_timedate`, `total_salary`) VALUES
(3, 2, 'Poritosh', 'poritosh@gmail.com', 1717977525, 'Creative Designer', '100', 'Dinajpur', '8cb2237d0679ca88db6464eac60da96345513964', 'I am Poritosh Roy and also a coding kom kom expert..', 'Image2686571.JPG', '2021-04-03 07:31:10', '4950'),
(4, 1, 'Md Majharul Islam', 'majharul@gmail.com', 1869259785, 'Developer', '120', 'Saidpur', '8cb2237d0679ca88db6464eac60da96345513964', 'Hi, I am Md Majharul Islam Ashar. I am a web & WordPress developer. Also, I am a branding design.', 'Image4906885.jpg', '2021-04-10 14:20:41', '7146'),
(5, 3, 'Mithun', 'mithun@gmail.com', 1717976105, 'Application Developer', '250', 'Dinajpur', '8cb2237d0679ca88db6464eac60da96345513964', 'Hi, I am mostakin Mithun and also i am a application developer.', 'Image3571994.jpg', '2021-04-18 09:18:30', '600'),
(6, 4, 'Ashar', 'ashar@gmai.com', 1717976105, 'Graphics Designer', '150', 'Saidpur , Nilphamary', '8cb2237d0679ca88db6464eac60da96345513964', 'HI, I am Ashar.', 'Image1605211.png', '2021-04-19 12:20:38', '120');

-- --------------------------------------------------------

--
-- Table structure for table `empsalary`
--

CREATE TABLE `empsalary` (
  `salaryid` int(100) NOT NULL,
  `emp_id` int(100) NOT NULL,
  `amount` int(50) NOT NULL,
  `send_date` varchar(40) NOT NULL,
  `currentdate` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `empsalary`
--

INSERT INTO `empsalary` (`salaryid`, `emp_id`, `amount`, `send_date`, `currentdate`) VALUES
(4, 3, 100, '2021-04-10', '2021-04'),
(5, 4, 200, '2021-04-09', '2021-04'),
(6, 4, 6546, '2021-05-14', '2021-05'),
(7, 5, 150, '2021-04-18', '2021-04'),
(8, 3, 100, '2021-05-18', '2021-05'),
(9, 3, 3560, '2021-03-16', '2021-03'),
(10, 6, 120, '2021-07-21', '2021-07'),
(11, 5, 200, '2021-01-19', '2021-01'),
(12, 3, 400, '2021-02-21', '2021-02'),
(13, 5, 250, '2021-03-14', '2021-03'),
(14, 4, 200, '2020-12-21', '2020-12'),
(15, 3, 450, '2020-12-29', '2020-12'),
(16, 3, 100, '2020-08-05', '2020-08'),
(17, 4, 200, '2021-12-15', '2021-12');

-- --------------------------------------------------------

--
-- Table structure for table `emp_costs`
--

CREATE TABLE `emp_costs` (
  `cost_id` int(11) NOT NULL,
  `emp_id` int(50) NOT NULL,
  `cost_amount` int(200) NOT NULL,
  `cost_reason` varchar(500) NOT NULL,
  `cost_date` datetime NOT NULL DEFAULT current_timestamp(),
  `monthly_cost_date` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_costs`
--

INSERT INTO `emp_costs` (`cost_id`, `emp_id`, `cost_amount`, `cost_reason`, `cost_date`, `monthly_cost_date`) VALUES
(3, 4, 100, 'Tupi Kinchi', '2021-04-23 14:36:36', '2021-04'),
(4, 3, 300, 'Bazar Khoroc', '2021-04-23 14:49:32', '2021-04');

-- --------------------------------------------------------

--
-- Table structure for table `leaving`
--

CREATE TABLE `leaving` (
  `left_id` int(100) NOT NULL,
  `left_emp` varchar(100) NOT NULL,
  `left_empid` int(50) NOT NULL,
  `company` varchar(100) NOT NULL,
  `left_report` varchar(100) NOT NULL,
  `left_day` int(50) NOT NULL,
  `left_from` varchar(20) NOT NULL,
  `left_to` varchar(20) NOT NULL,
  `left_desc` varchar(255) NOT NULL,
  `left_reason` varchar(100) NOT NULL,
  `app_sign` varchar(100) NOT NULL,
  `app_date` varchar(20) NOT NULL,
  `left_accept` varchar(50) NOT NULL,
  `approve_by` varchar(100) NOT NULL,
  `approve_date` varchar(20) NOT NULL,
  `approval` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaving`
--

INSERT INTO `leaving` (`left_id`, `left_emp`, `left_empid`, `company`, `left_report`, `left_day`, `left_from`, `left_to`, `left_desc`, `left_reason`, `app_sign`, `app_date`, `left_accept`, `approve_by`, `approve_date`, `approval`) VALUES
(1, 'Md. Majharul Islam', 1, 'Friends It Point', 'Majharul', 3, '2021-04-05', '2021-04-07', 'I am very sick', 'sick', 'majharul', '2021-04-05', 'Rejected', 'Mithun Sir', '2021-04-05', 1),
(2, 'Sayed Rony', 2, 'Friends It Point', 'Majharul', 5, '2021-04-06', '2021-04-11', 'I am very sick', 'Annual', 'sayed rony', '2021-04-06', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(11) NOT NULL,
  `notice_title` varchar(200) NOT NULL,
  `notice_desc` varchar(255) NOT NULL,
  `notice_datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `notice_title`, `notice_desc`, `notice_datetime`) VALUES
(5, 'Eid Ul Fetor', '<p>Pobittro eid-ul-fitor upolokke agami 12-05-2021 theke 18-05-2021 Porjnoto Fit bondho ghosna kora holo.And jothariti 19-05-2021 sokol ke punoray nij nij kaje join korar jnno bola hoilo.</p>\r\n\r\n<p>Thanks for All Fiteyan.</p>\r\n', '2021-Apr-21 // 9:35:34 pm');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `emp_id`, `type`, `status`, `date`) VALUES
(1, 6, 'salary', 'unread', '2021-04-21 14:44:34'),
(5, 4, 'salary', 'read', '2021-04-21 14:44:34'),
(6, 4, 'notice', 'read', '2021-04-21 16:26:39'),
(7, 3, 'salary', 'read', '2021-04-21 16:32:07'),
(9, 0, 'notice', 'read', '2021-04-21 21:39:46'),
(10, 0, 'notice', 'read', '2021-04-23 07:55:44'),
(11, 3, 'salary', 'unread', '2021-05-03 16:57:54'),
(12, 4, 'salary', 'read', '2021-07-12 15:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(50) NOT NULL,
  `client_name` varchar(200) NOT NULL,
  `budget` int(100) NOT NULL,
  `project_assign` varchar(200) NOT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `completed` int(10) NOT NULL,
  `monthly_project_date` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `client_name`, `budget`, `project_assign`, `start_date`, `end_date`, `completed`, `monthly_project_date`) VALUES
(4, 'Hanslaliberte46', 175, 'Poritosh', '2021-04-18', '2021-04-21', 0, '2021-04'),
(5, 'smrony541', 420, 'Mithun', '2021-04-18', '2021-05-18', 1, '2021-05'),
(6, 'mbbreakout', 4545, 'Md Majharul Islam', '2021-04-20', '2021-05-19', 0, '2021-05'),
(7, 'Hanslaliberte46', 565, 'Md Majharul Islam', '2021-03-11', '2021-03-17', 1, '2021-04');

-- --------------------------------------------------------

--
-- Table structure for table `spending`
--

CREATE TABLE `spending` (
  `spend_id` int(50) NOT NULL,
  `spend_source` varchar(255) NOT NULL,
  `spend_amount` int(100) NOT NULL,
  `spend_date` varchar(40) NOT NULL,
  `spend_month` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spending`
--

INSERT INTO `spending` (`spend_id`, `spend_source`, `spend_amount`, `spend_date`, `spend_month`) VALUES
(1, 'Bazar Khoroc', 200, '2021-04-03', '2021-04'),
(2, 'Chiken Fry', 180, '2021-04-10', '2021-04'),
(3, 'Chiken Fry', 545, '2021-04-29', '2021-05'),
(4, 'Test', 450, '2021-03-10', '2021-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earning`
--
ALTER TABLE `earning`
  ADD PRIMARY KEY (`earn_id`);

--
-- Indexes for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empsalary`
--
ALTER TABLE `empsalary`
  ADD PRIMARY KEY (`salaryid`);

--
-- Indexes for table `emp_costs`
--
ALTER TABLE `emp_costs`
  ADD PRIMARY KEY (`cost_id`);

--
-- Indexes for table `leaving`
--
ALTER TABLE `leaving`
  ADD PRIMARY KEY (`left_id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `spending`
--
ALTER TABLE `spending`
  ADD PRIMARY KEY (`spend_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `attendence`
--
ALTER TABLE `attendence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `earning`
--
ALTER TABLE `earning`
  MODIFY `earn_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `empsalary`
--
ALTER TABLE `empsalary`
  MODIFY `salaryid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `emp_costs`
--
ALTER TABLE `emp_costs`
  MODIFY `cost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leaving`
--
ALTER TABLE `leaving`
  MODIFY `left_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `spending`
--
ALTER TABLE `spending`
  MODIFY `spend_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
