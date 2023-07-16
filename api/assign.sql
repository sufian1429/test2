-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2023 at 10:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assign`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_ID` int(11) NOT NULL,
  `car_name` varchar(20) NOT NULL,
  `car_img` text NOT NULL,
  `car_miles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_ID` int(11) NOT NULL,
  `cus_name` varchar(50) NOT NULL,
  `cus_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_ID`, `cus_name`, `cus_type`) VALUES
(24, 'test1', 'test1'),
(25, 'test2', 'test2');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `doc_ID` int(11) NOT NULL,
  `doc_name` varchar(50) NOT NULL,
  `doc_type` varchar(250) NOT NULL,
  `doc_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`doc_ID`, `doc_name`, `doc_type`, `doc_path`) VALUES
(14, 'รายงาน1', 'รายงาน1', 'file/เอกสาร---ขอความอนุเคราะห์รับนักศึกษาเข้าฝึกงาน.pdf'),
(15, 'รายงาน2', 'รายงาน2', 'file/เอกสาร---ขอความอนุเคราะห์รับนักศึกษาเข้าฝึกงาน.pdf'),
(16, 'รายงาน3', 'รายงาน3', 'file/123.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `mem_ID` int(11) NOT NULL,
  `mem_name` varchar(50) NOT NULL,
  `mem_level` varchar(1) NOT NULL,
  `mem_img` varchar(100) NOT NULL,
  `mem_img_name` varchar(100) NOT NULL,
  `mem_status` varchar(1) NOT NULL,
  `mem_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`mem_ID`, `mem_name`, `mem_level`, `mem_img`, `mem_img_name`, `mem_status`, `mem_password`) VALUES
(1, 'ต่อศักดิ์', '1', '', '', '1', 'test'),
(2, 'Sufian(ฝึกงาน)', '3', '', '', '1', '1'),
(3, 'test', '2', '', '', '1', 'test'),
(6, 'test1', '2', '', '', '1', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `miles`
--

CREATE TABLE `miles` (
  `mil_ID` int(11) NOT NULL,
  `mil_car` int(11) NOT NULL COMMENT 'car_ID',
  `mil_task` int(11) NOT NULL COMMENT 'task_ID',
  `mil_start` int(11) NOT NULL,
  `mil_end` int(11) DEFAULT NULL,
  `mil_total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `pro_ID` int(11) NOT NULL,
  `pro_name` varchar(50) NOT NULL,
  `pro_type` varchar(250) NOT NULL,
  `pro_path` text NOT NULL,
  `pro_customer` int(11) NOT NULL COMMENT 'cus_ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`pro_ID`, `pro_name`, `pro_type`, `pro_path`, `pro_customer`) VALUES
(4, 'project1', 'project1', 'file/เอกสาร---ขอความอนุเคราะห์รับนักศึกษาเข้าฝึกงาน.pdf', 24),
(5, 'project2', 'project2', 'file/เอกสาร---ขอความอนุเคราะห์รับนักศึกษาเข้าฝึกงาน.pdf', 25),
(6, 'project3', 'project3', 'file/123.pdf', 24);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `re_name` varchar(50) NOT NULL,
  `re_type` varchar(250) NOT NULL,
  `re_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `re_name`, `re_type`, `re_path`) VALUES
(9, 'รายงานประจำสัปดาห์ที่1', 'รายงานประจำสัปดาห์ที่1', 'file/เอกสาร---ขอความอนุเคราะห์รับนักศึกษาเข้าฝึกงาน.pdf'),
(10, 'รายงานประจำสัปดาห์ที่2', 'รายงานประจำสัปดาห์ที่2', 'file/เอกสาร---ขอความอนุเคราะห์รับนักศึกษาเข้าฝึกงาน.pdf'),
(11, 'รายงานประจำสัปดาห์ที่3', 'รายงานประจำสัปดาห์ที่3', 'file/123.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_ID` int(11) NOT NULL,
  `status_name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_ID`, `status_name`) VALUES
(1, 'Pending'),
(2, 'Process'),
(3, 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_ID` int(11) NOT NULL,
  `task_name` varchar(30) NOT NULL,
  `task_detail` text NOT NULL,
  `task_customer` int(11) NOT NULL COMMENT 'cus_ID',
  `task_status` varchar(1) NOT NULL DEFAULT 'P',
  `task_project` int(11) NOT NULL COMMENT 'pro_ID',
  `task_dayS` varchar(15) NOT NULL COMMENT 'วันที่เพิ่มงาน',
  `task_dayA` varchar(15) DEFAULT NULL COMMENT 'วันที่รับงาน',
  `task_dayE` varchar(15) DEFAULT NULL COMMENT 'วันที่เสร็จงาน',
  `task_men` int(11) NOT NULL COMMENT 'mem_ID',
  `task_car` int(11) DEFAULT NULL COMMENT 'miles_ID',
  `task_img` text NOT NULL,
  `task_report` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_ID`, `task_name`, `task_detail`, `task_customer`, `task_status`, `task_project`, `task_dayS`, `task_dayA`, `task_dayE`, `task_men`, `task_car`, `task_img`, `task_report`, `created_at`) VALUES
(157, 'แผนงานเพิ่มเติมวันที่ 09/07/25', 'ซ่อมกล้องของเทศบาลกะทู้ - แยกสนามกอล์ฟ - สนามกอล์ฟส่องสามแยก - ปากทางเข้าเขื่อนส่องถนนมุ่งหน้า ม.อ. - ปากทางเข้าเขื่อนส่องถนนมุ่งหน้าสี่กอ - หน้าศาลเจ้า - ตลาดทุ่งทองมุ่งหน้าแยกสี่กอ - ซอยบางวาดมุ่งหน้าโรงเรียนบางทอง - ตลาดทุ่งทองมุ่งหน้าแยกเก็ตโฮ่  ทีมดำเนินงาน 1.พี่แบงค์ 2.ปาล์ม', 24, 'C', 0, '', NULL, NULL, 0, NULL, '', '', '2023-07-14 08:08:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file`
--

CREATE TABLE `tbl_file` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_file`
--

INSERT INTO `tbl_file` (`id`, `name`, `image`) VALUES
(1, 'sadsadasd', 'Screenshot 2023-01-10 130832.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `name`, `image`) VALUES
(1, 'David', 'tesstttttt.jpg'),
(2, 'tor', 'tesstttttt.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `fname`, `username`, `password`) VALUES
(1, '', '', 'test', 'test', '123456'),
(2, 'Sufian Maseng', 'webtech1857@gmail.com', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users1`
--

CREATE TABLE `users1` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(1024) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users1`
--

INSERT INTO `users1` (`id`, `firstname`, `lastname`, `email`, `image`, `password`, `gender`, `date`) VALUES
(0, 'Sufian', 'Maseng', 'webtech1857@gmail.com', 'uploads/1689306690273824827_269496688632665_8153959384782056025_n (2).jpg', '$2y$10$WhPIO3uAbR/LJtJsCikx.uHeqBOOsSxHooO1KwUmNgTUpQQgmIPU.', 'Male', '2023-07-14 05:51:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_ID`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`doc_ID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`mem_ID`);

--
-- Indexes for table `miles`
--
ALTER TABLE `miles`
  ADD PRIMARY KEY (`mil_ID`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`pro_ID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_ID`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_ID`);

--
-- Indexes for table `tbl_file`
--
ALTER TABLE `tbl_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `car_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `doc_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `mem_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `miles`
--
ALTER TABLE `miles`
  MODIFY `mil_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `pro_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `tbl_file`
--
ALTER TABLE `tbl_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
