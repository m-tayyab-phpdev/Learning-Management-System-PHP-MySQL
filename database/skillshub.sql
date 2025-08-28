-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2024 at 06:28 PM
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
-- Database: `skillshub`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `ass_id` int(20) NOT NULL,
  `ass_title` varchar(255) NOT NULL,
  `ass_start` date NOT NULL,
  `ass_expire` date NOT NULL,
  `ass_file` text NOT NULL,
  `course_id` int(20) NOT NULL,
  `teacher_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignment_grades`
--

CREATE TABLE `assignment_grades` (
  `grade_id` int(30) NOT NULL,
  `sol_id` int(30) NOT NULL,
  `marks` varchar(30) NOT NULL,
  `ass_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignment_solutions`
--

CREATE TABLE `assignment_solutions` (
  `sol_id` int(30) NOT NULL,
  `ass_id` int(30) NOT NULL,
  `teacher_id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL,
  `course_id` int(30) NOT NULL,
  `file_path` text NOT NULL,
  `result_status` varchar(30) NOT NULL DEFAULT 'unchecked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(20) NOT NULL,
  `course_title` varchar(50) NOT NULL,
  `course_duration` varchar(30) NOT NULL,
  `course_price` int(30) NOT NULL,
  `course_thumbnail` varchar(100) NOT NULL,
  `course_category` int(20) NOT NULL,
  `course_exams` varchar(30) NOT NULL,
  `course_detail` text NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_category`
--

CREATE TABLE `course_category` (
  `cat_id` int(20) NOT NULL,
  `cat_title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_category`
--

INSERT INTO `course_category` (`cat_id`, `cat_title`) VALUES
(12, 'Programming'),
(13, 'Graphics Designing'),
(14, 'Digital Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `course_enrollments`
--

CREATE TABLE `course_enrollments` (
  `enroll_id` int(30) NOT NULL,
  `course_id` int(30) NOT NULL,
  `teacher_id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL,
  `cat_id` int(30) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `challan` int(10) NOT NULL,
  `payment` varchar(20) NOT NULL DEFAULT 'unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `exam_id` int(20) NOT NULL,
  `course_id` int(20) NOT NULL,
  `teacher_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_answers`
--

CREATE TABLE `exam_answers` (
  `ans_id` int(30) NOT NULL,
  `exam_id` int(30) NOT NULL,
  `exam_bank_id` int(30) NOT NULL,
  `teacher_id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_bank`
--

CREATE TABLE `exam_bank` (
  `exam_bank_id` int(30) NOT NULL,
  `Quiz` text NOT NULL,
  `option_a` text NOT NULL,
  `option_b` text NOT NULL,
  `option_c` text NOT NULL,
  `option_d` text NOT NULL,
  `course_id` int(30) NOT NULL,
  `teacher_id` int(30) NOT NULL,
  `exam_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_grades`
--

CREATE TABLE `exam_grades` (
  `exam_grade_id` int(30) NOT NULL,
  `exam_id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL,
  `teacher_id` int(30) NOT NULL,
  `marks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `lec_id` int(30) NOT NULL,
  `teacher_id` int(30) NOT NULL,
  `course_id` int(30) NOT NULL,
  `lec_path` text NOT NULL,
  `lec_title` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `quiz_id` int(20) NOT NULL,
  `quiz_title` varchar(50) NOT NULL,
  `course_id` int(20) NOT NULL,
  `teacher_id` int(20) NOT NULL,
  `start_date` date NOT NULL,
  `expire_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_answers`
--

CREATE TABLE `quiz_answers` (
  `ans_id` int(30) NOT NULL,
  `quiz_id` int(30) NOT NULL,
  `bank_id` int(30) NOT NULL,
  `teacher_id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_bank`
--

CREATE TABLE `quiz_bank` (
  `bank_id` int(20) NOT NULL,
  `course_id` int(20) NOT NULL,
  `teacher_id` int(20) NOT NULL,
  `question` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `quiz_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_grades`
--

CREATE TABLE `quiz_grades` (
  `quiz_grade_id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL,
  `quiz_id` int(30) NOT NULL,
  `teacher_id` int(30) NOT NULL,
  `marks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(20) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_type` varchar(30) NOT NULL,
  `user_acc_status` varchar(20) NOT NULL DEFAULT 'Unverified',
  `user_activity_status` varchar(50) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_phone`, `user_type`, `user_acc_status`, `user_activity_status`) VALUES
(17, 'Tayyaba', 'tayyaba209rajput@gmail.com', '$2y$10$qRRPIHp.ThPqsuoG/TZa9O7ujGiSrXLFrw4elrZovD27K81CUTW5S', '+923146045696', 'Admin', 'Verified', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`ass_id`),
  ADD KEY `fk_03` (`course_id`),
  ADD KEY `fk_50` (`teacher_id`);

--
-- Indexes for table `assignment_grades`
--
ALTER TABLE `assignment_grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `fk_55` (`sol_id`),
  ADD KEY `fk_65` (`ass_id`);

--
-- Indexes for table `assignment_solutions`
--
ALTER TABLE `assignment_solutions`
  ADD PRIMARY KEY (`sol_id`),
  ADD KEY `fk_30` (`ass_id`),
  ADD KEY `fk_31` (`course_id`),
  ADD KEY `fk_32` (`student_id`),
  ADD KEY `fk_33` (`teacher_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `fk_01` (`course_category`),
  ADD KEY `fk_02` (`teacher_id`);

--
-- Indexes for table `course_category`
--
ALTER TABLE `course_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `course_enrollments`
--
ALTER TABLE `course_enrollments`
  ADD PRIMARY KEY (`enroll_id`),
  ADD KEY `fk_19` (`course_id`),
  ADD KEY `fk_20` (`student_id`),
  ADD KEY `fk_21` (`teacher_id`),
  ADD KEY `fk_22` (`cat_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `fk_17` (`course_id`),
  ADD KEY `fk_18` (`teacher_id`);

--
-- Indexes for table `exam_answers`
--
ALTER TABLE `exam_answers`
  ADD PRIMARY KEY (`ans_id`),
  ADD KEY `fk_40` (`exam_bank_id`),
  ADD KEY `fk_41` (`exam_id`),
  ADD KEY `fk_42` (`student_id`),
  ADD KEY `fk_43` (`teacher_id`);

--
-- Indexes for table `exam_bank`
--
ALTER TABLE `exam_bank`
  ADD PRIMARY KEY (`exam_bank_id`),
  ADD KEY `fk_10` (`course_id`),
  ADD KEY `fk_11` (`teacher_id`),
  ADD KEY `fk_12` (`exam_id`);

--
-- Indexes for table `exam_grades`
--
ALTER TABLE `exam_grades`
  ADD PRIMARY KEY (`exam_grade_id`),
  ADD KEY `fk_60` (`exam_id`),
  ADD KEY `fk_61` (`student_id`),
  ADD KEY `fk_62` (`teacher_id`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`lec_id`),
  ADD KEY `fk_26` (`course_id`),
  ADD KEY `fk_27` (`teacher_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`quiz_id`),
  ADD KEY `fk_04` (`course_id`),
  ADD KEY `fk_07` (`teacher_id`);

--
-- Indexes for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD PRIMARY KEY (`ans_id`),
  ADD KEY `fk_34` (`bank_id`),
  ADD KEY `fk_35` (`quiz_id`),
  ADD KEY `fk_36` (`student_id`),
  ADD KEY `fk_37` (`teacher_id`);

--
-- Indexes for table `quiz_bank`
--
ALTER TABLE `quiz_bank`
  ADD PRIMARY KEY (`bank_id`),
  ADD KEY `fk_05` (`course_id`),
  ADD KEY `fk_06` (`teacher_id`),
  ADD KEY `fk_08` (`quiz_id`);

--
-- Indexes for table `quiz_grades`
--
ALTER TABLE `quiz_grades`
  ADD PRIMARY KEY (`quiz_grade_id`),
  ADD KEY `fk_56` (`student_id`),
  ADD KEY `fk_57` (`teacher_id`),
  ADD KEY `fk_58` (`quiz_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `ass_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `assignment_grades`
--
ALTER TABLE `assignment_grades`
  MODIFY `grade_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `assignment_solutions`
--
ALTER TABLE `assignment_solutions`
  MODIFY `sol_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `course_category`
--
ALTER TABLE `course_category`
  MODIFY `cat_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `course_enrollments`
--
ALTER TABLE `course_enrollments`
  MODIFY `enroll_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `exam_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exam_answers`
--
ALTER TABLE `exam_answers`
  MODIFY `ans_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `exam_bank`
--
ALTER TABLE `exam_bank`
  MODIFY `exam_bank_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `exam_grades`
--
ALTER TABLE `exam_grades`
  MODIFY `exam_grade_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `lec_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `quiz_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `ans_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `quiz_bank`
--
ALTER TABLE `quiz_bank`
  MODIFY `bank_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `quiz_grades`
--
ALTER TABLE `quiz_grades`
  MODIFY `quiz_grade_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `fk_03` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `fk_50` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `assignment_grades`
--
ALTER TABLE `assignment_grades`
  ADD CONSTRAINT `fk_55` FOREIGN KEY (`sol_id`) REFERENCES `assignment_solutions` (`sol_id`),
  ADD CONSTRAINT `fk_65` FOREIGN KEY (`ass_id`) REFERENCES `assignments` (`ass_id`);

--
-- Constraints for table `assignment_solutions`
--
ALTER TABLE `assignment_solutions`
  ADD CONSTRAINT `fk_30` FOREIGN KEY (`ass_id`) REFERENCES `assignments` (`ass_id`),
  ADD CONSTRAINT `fk_31` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `fk_32` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_33` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_01` FOREIGN KEY (`course_category`) REFERENCES `course_category` (`cat_id`),
  ADD CONSTRAINT `fk_02` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `course_enrollments`
--
ALTER TABLE `course_enrollments`
  ADD CONSTRAINT `fk_19` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `fk_20` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_21` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_22` FOREIGN KEY (`cat_id`) REFERENCES `course_category` (`cat_id`);

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `fk_17` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `fk_18` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `exam_answers`
--
ALTER TABLE `exam_answers`
  ADD CONSTRAINT `fk_40` FOREIGN KEY (`exam_bank_id`) REFERENCES `exam_bank` (`exam_bank_id`),
  ADD CONSTRAINT `fk_41` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`exam_id`),
  ADD CONSTRAINT `fk_42` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_43` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `exam_bank`
--
ALTER TABLE `exam_bank`
  ADD CONSTRAINT `fk_10` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `fk_11` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_12` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`exam_id`);

--
-- Constraints for table `exam_grades`
--
ALTER TABLE `exam_grades`
  ADD CONSTRAINT `fk_60` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`exam_id`),
  ADD CONSTRAINT `fk_61` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_62` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `lectures`
--
ALTER TABLE `lectures`
  ADD CONSTRAINT `fk_26` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `fk_27` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `fk_04` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `fk_07` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD CONSTRAINT `fk_34` FOREIGN KEY (`bank_id`) REFERENCES `quiz_bank` (`bank_id`),
  ADD CONSTRAINT `fk_35` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`),
  ADD CONSTRAINT `fk_36` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_37` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `quiz_bank`
--
ALTER TABLE `quiz_bank`
  ADD CONSTRAINT `fk_05` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `fk_06` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_08` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`);

--
-- Constraints for table `quiz_grades`
--
ALTER TABLE `quiz_grades`
  ADD CONSTRAINT `fk_56` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_57` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_58` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
