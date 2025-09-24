-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 10:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `permission_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_department`
--

CREATE TABLE `tb_department` (
  `id_department` int(255) NOT NULL,
  `d_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_department`
--

INSERT INTO `tb_department` (`id_department`, `d_name`) VALUES
(1, '-'),
(2, 'เครื่องมือกล'),
(3, 'ก่อสร้าง'),
(4, 'ไฟฟ้ากำลัง'),
(5, 'อิเล็กทรอนิกส์'),
(6, 'เชื่อมโลหะ'),
(7, 'เครื่องกล'),
(10, 'เทคโนโลยีสารสนเทศ'),
(12, 'ไฟฟ้ากำลัง');

-- --------------------------------------------------------

--
-- Table structure for table `tb_gradelevel`
--

CREATE TABLE `tb_gradelevel` (
  `id_gradelevel` int(255) NOT NULL,
  `g_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_gradelevel`
--

INSERT INTO `tb_gradelevel` (`id_gradelevel`, `g_name`) VALUES
(13, 'ปวช.1'),
(15, 'ปวช.2'),
(16, 'ปวช.3'),
(17, 'ปวส.1'),
(18, 'ปวส.2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_personnel`
--

CREATE TABLE `tb_personnel` (
  `id_personnel` varchar(11) NOT NULL,
  `id_prefix` int(255) NOT NULL COMMENT 'prefix',
  `p_realname` varchar(255) NOT NULL,
  `p_surname` varchar(255) NOT NULL,
  `p_password` varchar(255) NOT NULL,
  `id_department` int(255) NOT NULL COMMENT 'department',
  `id_position` int(255) NOT NULL COMMENT 'position'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_personnel`
--

INSERT INTO `tb_personnel` (`id_personnel`, `id_prefix`, `p_realname`, `p_surname`, `p_password`, `id_department`, `id_position`) VALUES
                            ('64209010001', 1, 'แดง ', 'ขาว', '64209010001', 1, 5),
                            ('64209010002', 1, 'อาณาจักร', 'ดำดี', '64209010002', 2, 4),
                            ('64209010003', 1, 'จิรภา', 'บุญพาสุข', '64209010003', 2, 3),
                            ('64209010004', 1, 'พรชัย ', 'เอื้อวีระวัฒน', '64209010004', 2, 3),
                            ('64209010005', 1, 'ยรรยง  ', 'ตั้งจิตต์กุล', '64209010005', 1, 6),
                            ('64209010006', 1, 'แดง ', 'ดำดี', '64209010006', 10, 4),
                            ('64209010007', 1, 'พรชัย ', 'เอื้อวีระวัฒน', '64209010007', 10, 3),
                            ('64209010025', 1, 'คุณากร ', 'บุตรครุธ', '64209010025', 2, 3),
                            ('admin', 2, 'คุณากร', 'บุตรครุธ', '1', 1, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tb_personnel_join`
-- (See below for the actual view)
--
CREATE TABLE `tb_personnel_join` (
`id_personnel` varchar(11)
,`prefix_name` varchar(255)
,`p_realname` varchar(255)
,`p_surname` varchar(255)
,`p_password` varchar(255)
,`id_department` int(255)
,`d_name` varchar(255)
,`id_position` int(255)
,`p_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `tb_position`
--

CREATE TABLE `tb_position` (
  `id_position` int(255) NOT NULL,
  `p_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_position`
--

INSERT INTO `tb_position` (`id_position`, `p_name`) VALUES
(0, 'Admin'),
(1, 'นักเรียน'),
(2, 'นักศึกษา'),
(3, 'ครูที่ปรึกษา'),
(4, 'หัวหน้าแผนก'),
(5, 'ผู้บริหาร'),
(6, 'ผู้รักษาความปลอดภัย');

-- --------------------------------------------------------

--
-- Table structure for table `tb_prefix`
--

CREATE TABLE `tb_prefix` (
  `id_prefix` int(255) NOT NULL,
  `prefix_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_prefix`
--

INSERT INTO `tb_prefix` (`id_prefix`, `prefix_name`) VALUES
(1, 'นาย '),
(2, 'นางสาว'),
(3, 'นาง');

-- --------------------------------------------------------

--
-- Table structure for table `tb_request`
--

CREATE TABLE `tb_request` (
  `id_request` int(255) NOT NULL,
  `id_student` varchar(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `Time` varchar(255) NOT NULL,
  `id_department` int(255) NOT NULL,
  `id_requeststatus` int(11) NOT NULL DEFAULT 0,
  `r_dey` varchar(255) NOT NULL,
  `id_personnel` varchar(11) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_request`
--

INSERT INTO `tb_request` (`id_request`, `id_student`, `reason`, `Time`, `id_department`, `id_requeststatus`, `r_dey`, `id_personnel`) VALUES
(90, '66209010001', 'ออกไปรับประทานอาหารด้านนอก', '21:57 - ', 2, 4, '07-02-2024', '-'),
(91, '66209010001', 'ออกไปปริ้นงาน', '21:57 - ', 2, 4, '07-02-2024', '-'),
(92, '66209010001', 'ลืมหนังสือ/สมุด', '21:57 - ', 2, 4, '07-02-2024', '-'),
(93, '66209010001', 'วิ่งเล่น', '21:57 - ', 2, 4, '07-02-2024', '-'),
(94, '66209010001', 'ออกไปรับประทานอาหารด้านนอก', '07:35 - ', 2, 4, '11-02-2024', '-'),
(95, '66209010001', 'dd', '07:35 - ', 2, 4, '11-02-2024', '-'),
(96, '66209010001', 'ออกไปรับประทานอาหารด้านนอก', '07:48 - ', 2, 4, '11-02-2024', '-'),
(97, '66209010001', 'ลืมหนังสือ/สมุด', '16:14 - ', 2, 4, '12-02-2024', '-'),
(98, '68209010001', 'ลืมหนังสือ/สมุด', '16:29 - ', 10, 4, '12-02-2024', '-'),
(99, '68209010001', 'ออกไปปริ้นงาน', '16:29 - ', 10, 4, '12-02-2024', '-'),
(100, '66209010001', 'ออกไปรับประทานอาหารด้านนอก', '20:30 - 22:30', 2, 2, '20-02-2024', '64209010002'),
(101, '66209010001', 'ออกไปปริ้นงาน', '20:17 - 21:17', 2, 3, '20-02-2024', '64209010002'),
(102, '66209010001', 'ออกไปปริ้นงาน', '11:44 - 12:44', 2, 2, '25-02-2024', '64209010003');

-- --------------------------------------------------------

--
-- Table structure for table `tb_requeststatus`
--

CREATE TABLE `tb_requeststatus` (
  `id_requeststatus` int(255) NOT NULL,
  `requeststatus_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_requeststatus`
--

INSERT INTO `tb_requeststatus` (`id_requeststatus`, `requeststatus_name`) VALUES
(1, 'รออนุมัติ'),
(2, 'อนุมัติแล้ว'),
(3, 'ไม่อนุมัติ'),
(4, 'คำขอหมดอายุ');

-- --------------------------------------------------------

--
-- Stand-in structure for view `tb_request_join`
-- (See below for the actual view)
--
CREATE TABLE `tb_request_join` (
`id_request` int(255)
,`reason` varchar(255)
,`Time` varchar(255)
,`r_dey` varchar(255)
,`d_name` varchar(255)
,`requeststatus_name` varchar(255)
,`id_student` varchar(11)
,`id_prefix` int(255)
,`s_realname` varchar(255)
,`s_surname` varchar(255)
,`id_department` int(255)
,`id_personnel` varchar(11)
,`id_gradelevel` int(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `tb_student`
--

CREATE TABLE `tb_student` (
  `id_student` varchar(11) NOT NULL,
  `id_prefix` int(255) NOT NULL COMMENT 'tb_perfix',
  `s_realname` varchar(255) NOT NULL,
  `s_surname` varchar(255) NOT NULL,
  `s_password` varchar(255) NOT NULL,
  `id_personnel` varchar(11) NOT NULL COMMENT 'tb_personnel',
  `id_department` int(255) NOT NULL COMMENT 'tb_department',
  `id_position` int(255) NOT NULL COMMENT 'tb_position',
  `id_gradelevel` int(255) NOT NULL COMMENT 'tb_gradelevel'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_student`
--

INSERT INTO `tb_student` (`id_student`, `id_prefix`, `s_realname`, `s_surname`, `s_password`, `id_personnel`, `id_department`, `id_position`, `id_gradelevel`) VALUES
('64209010011', 2, 'คุณากร', 'แมว', '64209010011', '64209010003', 2, 1, 13),
('64209010025', 2, 'คุณากร', 'บุตรครุธ', '64209010025', '64209010004', 2, 1, 15),
('66209010001', 2, 'วิสาร ', 'ฉันท์เศรษฐ', '66209010001', '64209010003', 2, 1, 13),
('66209010002', 1, 'ศุกร์นิษา', 'เยขะจร', '66209010002', '64209010003', 2, 1, 16),
('67209010001', 1, 'กุลวัชร์', 'พุ่มเทียน', '67209010001', '64209010004', 2, 2, 13),
('67209010002', 2, 'ธีรสิทธิ์', 'ชิโนกุล', '67209010002', '64209010004', 2, 2, 13),
('68209010001', 1, 'วรรณา', 'ขาวแดง', '68209010001', '64209010007', 10, 1, 13);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tb_student_join`
-- (See below for the actual view)
--
CREATE TABLE `tb_student_join` (
`id_student` varchar(11)
,`prefix_name` varchar(255)
,`s_realname` varchar(255)
,`s_surname` varchar(255)
,`s_password` varchar(255)
,`id_personnel` varchar(11)
,`id_prefix` int(255)
,`p_realname` varchar(255)
,`p_surname` varchar(255)
,`id_department` int(255)
,`d_name` varchar(255)
,`p_name` varchar(255)
,`id_gradelevel` int(255)
,`g_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `tb_personnel_join`
--
DROP TABLE IF EXISTS `tb_personnel_join`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tb_personnel_join`  AS   (select `p`.`id_personnel` AS `id_personnel`,`pf`.`prefix_name` AS `prefix_name`,`p`.`p_realname` AS `p_realname`,`p`.`p_surname` AS `p_surname`,`p`.`p_password` AS `p_password`,`d`.`id_department` AS `id_department`,`d`.`d_name` AS `d_name`,`pt`.`id_position` AS `id_position`,`pt`.`p_name` AS `p_name` from (((`tb_personnel` `p` left join `tb_prefix` `pf` on(`p`.`id_prefix` = `pf`.`id_prefix`)) left join `tb_department` `d` on(`p`.`id_department` = `d`.`id_department`)) left join `tb_position` `pt` on(`p`.`id_position` = `pt`.`id_position`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `tb_request_join`
--
DROP TABLE IF EXISTS `tb_request_join`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tb_request_join`  AS   (select `r`.`id_request` AS `id_request`,`r`.`reason` AS `reason`,`r`.`Time` AS `Time`,`r`.`r_dey` AS `r_dey`,`d`.`d_name` AS `d_name`,`rs`.`requeststatus_name` AS `requeststatus_name`,`s`.`id_student` AS `id_student`,`s`.`id_prefix` AS `id_prefix`,`s`.`s_realname` AS `s_realname`,`s`.`s_surname` AS `s_surname`,`s`.`id_department` AS `id_department`,`r`.`id_personnel` AS `id_personnel`,`s`.`id_gradelevel` AS `id_gradelevel` from ((((`tb_request` `r` left join `tb_student` `s` on(`r`.`id_student` = `s`.`id_student`)) left join `tb_department` `d` on(`r`.`id_department` = `d`.`id_department`)) left join `tb_requeststatus` `rs` on(`r`.`id_requeststatus` = `rs`.`id_requeststatus`)) left join `tb_personnel` `p` on(`r`.`id_personnel` = `p`.`id_personnel`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `tb_student_join`
--
DROP TABLE IF EXISTS `tb_student_join`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tb_student_join`  AS   (select `s`.`id_student` AS `id_student`,`pf`.`prefix_name` AS `prefix_name`,`s`.`s_realname` AS `s_realname`,`s`.`s_surname` AS `s_surname`,`s`.`s_password` AS `s_password`,`p`.`id_personnel` AS `id_personnel`,`p`.`id_prefix` AS `id_prefix`,`p`.`p_realname` AS `p_realname`,`p`.`p_surname` AS `p_surname`,`d`.`id_department` AS `id_department`,`d`.`d_name` AS `d_name`,`ps`.`p_name` AS `p_name`,`g`.`id_gradelevel` AS `id_gradelevel`,`g`.`g_name` AS `g_name` from (((((`tb_student` `s` left join `tb_prefix` `pf` on(`s`.`id_prefix` = `pf`.`id_prefix`)) left join `tb_personnel` `p` on(`s`.`id_personnel` = `p`.`id_personnel`)) left join `tb_department` `d` on(`s`.`id_department` = `d`.`id_department`)) left join `tb_position` `ps` on(`s`.`id_position` = `ps`.`id_position`)) left join `tb_gradelevel` `g` on(`s`.`id_gradelevel` = `g`.`id_gradelevel`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_department`
--
ALTER TABLE `tb_department`
  ADD PRIMARY KEY (`id_department`);

--
-- Indexes for table `tb_gradelevel`
--
ALTER TABLE `tb_gradelevel`
  ADD PRIMARY KEY (`id_gradelevel`);

--
-- Indexes for table `tb_personnel`
--
ALTER TABLE `tb_personnel`
  ADD PRIMARY KEY (`id_personnel`);

--
-- Indexes for table `tb_position`
--
ALTER TABLE `tb_position`
  ADD PRIMARY KEY (`id_position`);

--
-- Indexes for table `tb_prefix`
--
ALTER TABLE `tb_prefix`
  ADD PRIMARY KEY (`id_prefix`);

--
-- Indexes for table `tb_request`
--
ALTER TABLE `tb_request`
  ADD PRIMARY KEY (`id_request`);

--
-- Indexes for table `tb_requeststatus`
--
ALTER TABLE `tb_requeststatus`
  ADD PRIMARY KEY (`id_requeststatus`);

--
-- Indexes for table `tb_student`
--
ALTER TABLE `tb_student`
  ADD PRIMARY KEY (`id_student`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_department`
--
ALTER TABLE `tb_department`
  MODIFY `id_department` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_gradelevel`
--
ALTER TABLE `tb_gradelevel`
  MODIFY `id_gradelevel` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_position`
--
ALTER TABLE `tb_position`
  MODIFY `id_position` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_prefix`
--
ALTER TABLE `tb_prefix`
  MODIFY `id_prefix` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_request`
--
ALTER TABLE `tb_request`
  MODIFY `id_request` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `tb_requeststatus`
--
ALTER TABLE `tb_requeststatus`
  MODIFY `id_requeststatus` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
