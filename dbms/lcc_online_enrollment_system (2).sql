-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2026 at 04:41 AM
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
-- Database: `lcc_online_enrollment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_code` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `department_id`, `course_name`, `course_code`, `created_at`) VALUES
(13, 12, 'Bachelor of Science in Information Technology', 'BSIT', '2026-05-16 22:55:18'),
(16, 14, 'Bachelor of Science in Animal Biology', 'BIO', '2026-05-18 08:05:08'),
(17, 12, 'Bachelor of Science in Computer Science', 'BSCS', '2026-05-18 23:59:29'),
(18, 14, 'Bachelor of Science in Agriculture', 'AGRI', '2026-05-19 08:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `curriculum`
--

CREATE TABLE `curriculum` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `year_level` varchar(20) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `school_year` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curriculum`
--

INSERT INTO `curriculum` (`id`, `course_id`, `year_level`, `semester`, `school_year`, `created_at`) VALUES
(4, 13, '1st Year', '2nd Semester', 'SY 2026-2027', '2026-05-17 11:30:02'),
(5, 13, '1st Year', '1st Semester', 'SY 2026-2027', '2026-05-18 23:16:14'),
(6, 16, '1st Year', '1st Semester', 'SY 2026-2027', '2026-05-18 23:16:30'),
(7, 16, '1st Year', '2nd Semester', 'SY 2026-2027', '2026-05-19 09:05:26'),
(8, 18, '1st Year', '1st Semester', 'SY 2026-2027', '2026-05-19 09:05:59'),
(9, 18, '1st Year', '2nd Semester', 'SY 2026-2027', '2026-05-19 09:06:13'),
(10, 17, '1st Year', '1st Semester', 'SY 2026-2027', '2026-05-19 09:06:42'),
(11, 17, '1st Year', '2nd Semester', 'SY 2026-2027', '2026-05-19 09:06:54'),
(12, 13, '2nd Year', '1st Semester', 'SY 2025-2026', '2026-05-19 10:49:53'),
(13, 13, '2nd Year', '2nd Semester', 'SY 2026-2027', '2026-05-19 10:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `curriculum_subjects`
--

CREATE TABLE `curriculum_subjects` (
  `id` int(11) NOT NULL,
  `curriculum_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `department_code` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `department_code`, `created_at`) VALUES
(12, 'College of Arts and Sciences', 'CAS', '2026-05-16 22:53:59'),
(14, 'Department of Agriculture and Natural Sciences', 'AGRI-BIO', '2026-05-18 08:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `curriculum_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `year_level` varchar(20) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `enrollment_status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`id`, `student_id`, `curriculum_id`, `section_id`, `year_level`, `semester`, `enrollment_status`, `created_at`) VALUES
(10, 8, 4, 17, '1st Year', '2nd Semester', 'Pending', '2026-05-19 10:48:19'),
(11, 8, 12, 22, '2nd Year', '1st Semester', 'Pending', '2026-05-19 10:51:59'),
(12, 10, 6, 9, '1st Year', '1st Semester', 'Approved', '2026-05-19 14:26:54');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_subjects`
--

CREATE TABLE `enrollment_subjects` (
  `id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_passers`
--

CREATE TABLE `exam_passers` (
  `id` int(11) NOT NULL,
  `applicant_no` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `exam_status` enum('Passed','Failed') DEFAULT 'Passed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_passers`
--

INSERT INTO `exam_passers` (`id`, `applicant_no`, `first_name`, `middle_name`, `last_name`, `email`, `exam_status`, `created_at`) VALUES
(5, '2026-2000', 'PAULO EMMANUEL', 'GORNEZ', 'SERNAL', 'paulosernal@gmail.com', 'Passed', '2026-05-17 23:06:53'),
(7, '123456', 'marinelle', 'paciente', 'cadapan', 'manel@gmail.com', 'Passed', '2026-05-19 05:20:19'),
(8, '678201', 'ANALISA', 'YBANEZ', 'PILONGO', 'analisa@gmail.com', 'Passed', '2026-05-19 14:24:41'),
(9, '0997', 'RHANDOLF', 'M', 'CADELINA', 'rhandolf@gmail.com', 'Passed', '2026-05-20 02:14:03'),
(10, '2468', 'SARAH JEAN', 'B', 'BALASABAS', 'sarah@gmail.com', 'Passed', '2026-05-20 02:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `section_name` varchar(50) NOT NULL,
  `year_level` varchar(20) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `course_id`, `section_name`, `year_level`, `semester`, `created_at`) VALUES
(6, 13, 'A', '1st Year', '1st Semester', '2026-05-17 15:00:13'),
(8, 13, 'B', '1st Year', '1st Semester', '2026-05-18 23:16:51'),
(9, 16, 'A', '1st Year', '1st Semester', '2026-05-18 23:17:30'),
(11, 18, 'A', '1st Year', '2nd Semester', '2026-05-19 09:08:24'),
(12, 18, 'B', '1st Year', '2nd Semester', '2026-05-19 09:08:51'),
(13, 18, 'A', '1st Year', '1st Semester', '2026-05-19 09:09:04'),
(14, 18, 'B', '1st Year', '1st Semester', '2026-05-19 09:09:13'),
(15, 16, 'A', '1st Year', '2nd Semester', '2026-05-19 09:09:29'),
(16, 16, 'B', '1st Year', '2nd Semester', '2026-05-19 09:09:42'),
(17, 13, 'A', '1st Year', '2nd Semester', '2026-05-19 09:09:56'),
(18, 13, 'B', '1st Year', '2nd Semester', '2026-05-19 09:10:06'),
(19, 17, 'A', '1st Year', '2nd Semester', '2026-05-19 09:10:19'),
(20, 17, 'B', '1st Year', '2nd Semester', '2026-05-19 09:10:35'),
(21, 16, 'B', '1st Year', '1st Semester', '2026-05-19 09:14:34'),
(22, 13, 'A', '2nd Year', '1st Semester', '2026-05-19 10:51:14'),
(23, 13, 'B', '2nd Year', '1st Semester', '2026-05-19 10:51:29'),
(24, 13, 'A', '2nd Year', '2nd Semester', '2026-05-19 10:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `section_subjects`
--

CREATE TABLE `section_subjects` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `schedule` varchar(100) DEFAULT NULL,
  `room` varchar(100) DEFAULT NULL,
  `instructor` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section_subjects`
--

INSERT INTO `section_subjects` (`id`, `section_id`, `subject_id`, `schedule`, `room`, `instructor`, `created_at`) VALUES
(5, 6, 8, 'TBA', 'TBA', 'TBA', '2026-05-19 09:11:35'),
(6, 8, 8, 'TBA', 'TBA', 'TBA', '2026-05-19 09:12:23'),
(7, 9, 11, 'TBA', 'TBA', 'TBA', '2026-05-19 09:12:47'),
(8, 21, 11, 'TBA', 'TBA', 'TBA', '2026-05-19 09:14:54'),
(9, 13, 13, 'TBA', 'TBA', 'TBA', '2026-05-19 09:16:13'),
(10, 14, 13, 'TBA', 'TBA', 'TBA', '2026-05-19 09:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `student_no` varchar(50) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `current_year_level` enum('1st Year','2nd Year','3rd Year','4th Year') DEFAULT '1st Year',
  `current_semester` enum('1st Semester','2nd Semester','Summer') DEFAULT '1st Semester',
  `student_status` enum('Regular','Irregular','Graduated','Dropped','Transferred') DEFAULT 'Regular',
  `enrollment_status` enum('Pending','Approved','Rejected','Not Enrolled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `student_no`, `first_name`, `middle_name`, `last_name`, `gender`, `birthdate`, `contact_no`, `address`, `department_id`, `course_id`, `current_year_level`, `current_semester`, `student_status`, `enrollment_status`, `created_at`) VALUES
(8, 2, '2026050001', 'PAULO EMMANUEL', 'GORNEZ', 'SERNAL', 'Male', '2005-10-10', '09494830165', 'BRGY, MANLIPAC, BAIS CITY', 12, 13, '2nd Year', '1st Semester', 'Regular', 'Pending', '2026-05-18 23:39:40'),
(9, 16, '2026050002', 'Marinelle', 'Paciente', 'Cadapan', 'Female', '2005-10-10', '0910385470', 'Bais City', 14, 16, '1st Year', '1st Semester', 'Regular', 'Approved', '2026-05-19 06:10:45'),
(10, 18, '2026050003', 'Analisa', 'Ybanez', 'Pilongo', 'Female', '2005-10-10', '09233820134', 'Bais City', 14, 16, '1st Year', '1st Semester', 'Regular', 'Approved', '2026-05-19 14:26:54');

-- --------------------------------------------------------

--
-- Table structure for table `student_grades`
--

CREATE TABLE `student_grades` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `year_level` varchar(50) NOT NULL,
  `grade` decimal(5,2) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `encoded_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_grades`
--

INSERT INTO `student_grades` (`id`, `student_id`, `subject_id`, `section_id`, `enrollment_id`, `semester`, `year_level`, `grade`, `remarks`, `encoded_by`, `created_at`, `updated_at`) VALUES
(1, 8, 9, 6, 3, '', '', 1.00, 'Passed', NULL, '2026-05-19 07:38:19', '2026-05-19 07:38:19'),
(2, 9, 11, 9, 4, '', '', 1.00, 'Passed', NULL, '2026-05-19 09:17:27', '2026-05-19 09:17:27'),
(3, 10, 11, 9, 12, '', '', 1.00, 'Passed', NULL, '2026-05-20 01:31:43', '2026-05-20 01:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `lecture_units` int(11) DEFAULT 0,
  `lab_units` int(11) DEFAULT 0,
  `year_level` varchar(20) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `course_id`, `subject_code`, `subject_name`, `lecture_units`, `lab_units`, `year_level`, `semester`, `created_at`) VALUES
(8, 13, 'ITS 100', 'Programming 1', 3, 1, '1st Year', '1st Semester', '2026-05-16 22:56:50'),
(9, 13, 'ITS 101', 'Introduction to Computing', 3, 0, '1st Year', '1st Semester', '2026-05-17 11:29:25'),
(11, 16, 'BIO 100', 'Biology 1', 3, 0, '1st Year', '1st Semester', '2026-05-18 08:05:51'),
(12, 16, 'BIO 102', 'Biology 2', 2, 1, '1st Year', '2nd Semester', '2026-05-18 08:06:23'),
(13, 18, 'AGR 100', 'Agriculture 1', 3, 0, '1st Year', '1st Semester', '2026-05-19 09:00:12'),
(14, 18, 'AGR 101', 'Agriculture 2', 2, 1, '1st Year', '2nd Semester', '2026-05-19 09:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `subject_prerequisites`
--

CREATE TABLE `subject_prerequisites` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `prerequisite_subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject_prerequisites`
--

INSERT INTO `subject_prerequisites` (`id`, `subject_id`, `prerequisite_subject_id`) VALUES
(1, 9, 8),
(4, 11, 12),
(5, 13, 14);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `applicant_no` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `applicant_no`, `name`, `email`, `password`, `role`, `status`, `verification_token`, `email_verified`) VALUES
(1, '', 'asdwasd', 'paulosernal15@gmail.com', '$2y$10$GSslNbPdIQqmChKlrHsn4ur1JR8lXchgDRWFHVd7qROBx.kMpP4Wy', 'student', 'active', NULL, 0),
(2, '', 'Paulo Sernal', 'sernalemmanuel@gmail.com', '$2y$10$0oigYfYZyZ3S62x8nJm32eL79yEjQlCgkEgVMdGIvLMI2I1L9PBXG', 'student', 'active', NULL, 0),
(4, '', 'Diongie Fundador', 'junzfundz@gmail.com', '$2y$10$PA4vy2i5kK/UQxkNzxXUqOKTM3Br1zdaj1QtuLWqZizxeKZPpSXP.', 'admin', 'active', NULL, 0),
(9, '', 'Marinelle Cadapan', 'marinelle@gmail.com', '$2y$10$Lu5.sTIX24GfyxKnsiZ5.uLPWXSxOJd91TQu8kcSPi/rnt0njNtMm', 'admin', 'active', NULL, 0),
(10, '', 'Paulo Emmanuel Sernal', 'paulosernal14@gmail.com', '$2y$10$sPK1ti.g3JECwROGgwj9eOjr/e2DtV5f7IY1OI9n27mjh9LzNSuVu', 'registrar', 'active', NULL, 0),
(13, '2026-2000', 'slkgne', 'Paulo@gmail.com', '$2y$10$0kVEgrarhHQVNbKnfw3Jte1nVLxPs4.wzODcgpfME1mdt3ELrkdmC', 'student', 'active', NULL, 0),
(15, '2026-3000', 'marinelle cadapan', 'marinelles@gmail.com', '$2y$10$pQys6fd6ABIReDNlTfxFNeznfeSMnsvcskAwW88GsyjlO6qqy8zou', 'student', 'active', NULL, 0),
(16, '123456', 'marinelle cadapan', 'manel@gmail.com', '$2y$10$Vx4A808OptbW20NTPzvbMOe.MtVsRlhI5Fgte42QVipkOLFL8Q2BG', 'student', 'active', NULL, 0),
(17, '', 'Analisa Pilongo', 'pilongo@gmail.com', '$2y$10$06zvzeQ5PCmcbRgvyt.faOhokhe7fZwRSxZSBBdOfgP3w6bl3OAEy', 'registrar', 'active', NULL, 0),
(18, '678201', 'Analisa Pilongo', 'analisa@gmail.com', '$2y$10$q05LCnCJs88x98AGUnqRgOMxVDkqPa/iL96FY4zjoCbGrdEeOGxxu', 'student', 'active', NULL, 0),
(19, '0997', 'Rhandolf Cadelina', 'rhandolf@gmail.com', '$2y$10$Inrbg7QDpG34aRBhvoamxukhWIeX.uUPeNugRQN8PXatZFD/AfZb2', 'student', 'active', NULL, 0),
(20, '2468', 'Sarah Jean Balasabas', 'sarah@gmail.com', '$2y$10$hRMlfkbdQqwJxn/70AHm9.giGS.gZwUD0KKlH6GOetWKSOtZ7jcGS', 'student', 'pending', 'fa03aa42d41b971f6e9135347247d80e1caa72c8e62ae8ce85c26efba26fdbb9', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_ibfk_1` (`department_id`);

--
-- Indexes for table `curriculum`
--
ALTER TABLE `curriculum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `curriculum_subjects`
--
ALTER TABLE `curriculum_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curriculum_id` (`curriculum_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curriculum_id` (`curriculum_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `enrollment_ibfk_1` (`student_id`);

--
-- Indexes for table `enrollment_subjects`
--
ALTER TABLE `enrollment_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_passers`
--
ALTER TABLE `exam_passers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `applicant_no` (`applicant_no`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `section_subjects`
--
ALTER TABLE `section_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `student_no` (`student_no`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `student_grades`
--
ALTER TABLE `student_grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subject_course` (`course_id`);

--
-- Indexes for table `subject_prerequisites`
--
ALTER TABLE `subject_prerequisites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `prerequisite_subject_id` (`prerequisite_subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `curriculum`
--
ALTER TABLE `curriculum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `curriculum_subjects`
--
ALTER TABLE `curriculum_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `enrollment_subjects`
--
ALTER TABLE `enrollment_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_passers`
--
ALTER TABLE `exam_passers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `section_subjects`
--
ALTER TABLE `section_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student_grades`
--
ALTER TABLE `student_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subject_prerequisites`
--
ALTER TABLE `subject_prerequisites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `curriculum`
--
ALTER TABLE `curriculum`
  ADD CONSTRAINT `curriculum_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `curriculum_subjects`
--
ALTER TABLE `curriculum_subjects`
  ADD CONSTRAINT `curriculum_subjects_ibfk_1` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `curriculum_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`id`),
  ADD CONSTRAINT `enrollment_ibfk_3` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `section_subjects`
--
ALTER TABLE `section_subjects`
  ADD CONSTRAINT `section_subjects_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `section_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `fk_subject_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subject_prerequisites`
--
ALTER TABLE `subject_prerequisites`
  ADD CONSTRAINT `subject_prerequisites_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_prerequisites_ibfk_2` FOREIGN KEY (`prerequisite_subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
