-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2024 at 08:54 AM
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
-- Database: `playquest`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `question_id` int(11) DEFAULT NULL,
  `correct_answer` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`question_id`, `correct_answer`, `created_at`) VALUES
(1, 3, '2024-03-19 20:03:28'),
(1, 4, '2024-03-19 20:03:28'),
(1, 3, '2024-03-19 20:06:31'),
(1, 4, '2024-03-19 20:06:31'),
(1, 3, '2024-03-19 20:08:07'),
(1, 4, '2024-03-19 20:08:07'),
(1, 3, '2024-03-19 20:13:06'),
(1, 4, '2024-03-19 20:13:06'),
(1, 3, '2024-03-19 20:15:46'),
(1, 4, '2024-03-19 20:15:46'),
(6, 1, '2024-03-19 20:57:31'),
(6, 4, '2024-03-19 20:57:31'),
(NULL, 1, '2024-03-20 21:07:57'),
(NULL, 2, '2024-03-20 21:07:57'),
(NULL, 1, '2024-03-20 21:10:00'),
(NULL, 2, '2024-03-20 21:10:00'),
(NULL, 1, '2024-03-20 21:10:10'),
(NULL, 2, '2024-03-20 21:10:10'),
(NULL, 1, '2024-03-20 21:12:00'),
(NULL, 1, '2024-03-20 21:15:04'),
(NULL, 4, '2024-03-20 21:16:33'),
(13, 4, '2024-03-20 21:17:36'),
(13, 4, '2024-03-20 21:23:48'),
(15, 1, '2024-03-20 21:24:55'),
(15, 4, '2024-03-20 21:24:55'),
(15, 1, '2024-03-20 21:26:31'),
(15, 4, '2024-03-20 21:26:31'),
(15, 1, '2024-03-20 21:27:51'),
(15, 4, '2024-03-20 21:27:51'),
(18, 1, '2024-03-20 21:29:22'),
(18, 3, '2024-03-20 21:29:22'),
(18, 1, '2024-03-20 21:33:39'),
(18, 3, '2024-03-20 21:33:39'),
(18, 1, '2024-03-20 21:34:44'),
(18, 3, '2024-03-20 21:34:44'),
(18, 1, '2024-03-20 21:38:42'),
(18, 3, '2024-03-20 21:38:42'),
(18, 1, '2024-03-20 21:43:19'),
(18, 3, '2024-03-20 21:43:19'),
(18, 1, '2024-03-20 21:47:49'),
(18, 3, '2024-03-20 21:47:49'),
(18, 1, '2024-03-20 21:48:29'),
(18, 3, '2024-03-20 21:48:29'),
(18, 1, '2024-03-20 21:48:40'),
(18, 3, '2024-03-20 21:48:40'),
(29, 4, '2024-03-21 07:07:23'),
(30, 2, '2024-03-21 12:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `created_at`) VALUES
(1, 'Science', '2024-03-19 19:42:48'),
(2, 'Programming', '2024-03-19 19:43:18');

-- --------------------------------------------------------

--
-- Table structure for table `championship`
--

CREATE TABLE `championship` (
  `champ_id` int(11) NOT NULL,
  `champ_name` varchar(50) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `championship`
--

INSERT INTO `championship` (`champ_id`, `champ_name`, `category_id`, `teacher_id`, `start_date`, `end_date`, `start_time`, `end_time`, `created_at`) VALUES
(1, 'Mind Marathon', 1, NULL, '2024-03-20', '2024-03-21', '14:00:00', '16:00:00', '2024-03-19 20:19:18'),
(3, 'Code-Nation', 2, NULL, '2024-04-08', '2024-04-09', '11:06:00', '11:06:00', '2024-04-07 05:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `change_password`
--

CREATE TABLE `change_password` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `new_password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chosen_questions`
--

CREATE TABLE `chosen_questions` (
  `label_id` int(11) DEFAULT NULL,
  `mode_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chosen_questions`
--

INSERT INTO `chosen_questions` (`label_id`, `mode_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `institute_name` varchar(50) DEFAULT NULL,
  `department_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game_mode`
--

CREATE TABLE `game_mode` (
  `mode_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `mode_name` varchar(50) DEFAULT NULL,
  `tot_coins` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `no_of_question` int(11) DEFAULT NULL,
  `time_minutes` int(11) DEFAULT NULL,
  `champ_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_qualification` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game_mode`
--

INSERT INTO `game_mode` (`mode_id`, `teacher_id`, `mode_name`, `tot_coins`, `description`, `no_of_question`, `time_minutes`, `champ_id`, `user_id`, `user_qualification`, `created_at`) VALUES
(1, NULL, 'quick_hit', NULL, 'Attempt all questions', 3, 5, 1, NULL, 'Under_Graduate', '2024-03-19 20:20:30');

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `institute_id` int(11) NOT NULL,
  `institute_name` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `label`
--

CREATE TABLE `label` (
  `label_id` int(11) NOT NULL,
  `label_name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `label`
--

INSERT INTO `label` (`label_id`, `label_name`, `created_at`) VALUES
(1, 'L1', '2024-03-19 19:54:12'),
(2, 'L2', '2024-03-19 20:20:45'),
(3, 'L3', '2024-03-19 20:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `participated`
--

CREATE TABLE `participated` (
  `user_id` int(11) DEFAULT NULL,
  `mode_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `label_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `question_text` text DEFAULT NULL,
  `question_image` longblob DEFAULT NULL,
  `option1_text` text DEFAULT NULL,
  `option2_text` text DEFAULT NULL,
  `option3_text` text DEFAULT NULL,
  `option4_text` text DEFAULT NULL,
  `option1_img` longblob DEFAULT NULL,
  `option2_img` longblob DEFAULT NULL,
  `option3_img` longblob DEFAULT NULL,
  `option4_img` longblob DEFAULT NULL,
  `total_coins` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `label_id`, `teacher_id`, `question_text`, `question_image`, `option1_text`, `option2_text`, `option3_text`, `option4_text`, `option1_img`, `option2_img`, `option3_img`, `option4_img`, `total_coins`, `created_at`) VALUES
(1, 1, NULL, 'When the charged particles move in a combined magnetic and electric field, then the force acting is known as _________', '', 'Centripetal force', 'Centrifugal force', 'Lorentz force', 'Orbital force', '', '', '', '', 0, '2024-03-19 20:03:28'),
(6, 1, NULL, 'Cyclotron is a device used to _________', '', 'Slow down charged particles', 'Accelerate the positively charged particles', 'Stop the charged particles', 'None of the options', '', '', '', '', 0, '2024-03-19 20:57:31'),
(7, NULL, NULL, 'Which of the following is correct about JavaScript?', '', 'JavaScript is an Object-Based language', 'JavaScript is Assembly-language', 'JavaScript is an Object-Oriented language', 'JavaScript is a High-level language', '', '', '', '', 0, '2024-03-20 21:07:57'),
(8, NULL, NULL, 'Which of the following is correct about JavaScript?', '', 'JavaScript is an Object-Based language', 'JavaScript is Assembly-language', 'JavaScript is an Object-Oriented language', 'JavaScript is a High-level language', '', '', '', '', 0, '2024-03-20 21:10:00'),
(9, NULL, NULL, 'Which of the following is correct about JavaScript?', '', 'JavaScript is an Object-Based language', 'JavaScript is Assembly-language', 'JavaScript is an Object-Oriented language', 'JavaScript is a High-level language', '', '', '', '', 0, '2024-03-20 21:10:10'),
(10, NULL, NULL, 'What will be the output of the following JavaScript code snippet?\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n// JavaScript Equalto Operators\r\nfunction equalto()\r\n{\r\n    let num=10;\r\n    if(num===\"10\")\r\n        return true;\r\n    else\r\n        return false;\r\n}\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '', 'false', 'true', 'compile error', 'runtime error', '', '', '', '', 0, '2024-03-20 21:12:00'),
(11, NULL, NULL, 'What will be the output of the following JavaScript code snippet?\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n// JavaScript Equalto Operators\r\nfunction equalto()\r\n{\r\n    let num=10;\r\n    if(num===\"10\")\r\n        return true;\r\n    else\r\n        return false;\r\n}\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '', 'false', 'true', 'compile error', 'runtime error', '', '', '', '', 0, '2024-03-20 21:15:04'),
(12, NULL, NULL, 'Which of the following is not javascript data types?', '', 'Null type', 'Undefined type', 'Number type', 'all', '', '', '', '', 0, '2024-03-20 21:16:33'),
(13, 1, NULL, 'Which of the following is not javascript data types?', '', 'Null type', 'Undefined type', 'Number type', 'all', '', '', '', '', 0, '2024-03-20 21:17:36'),
(14, 1, NULL, 'Which of the following is not javascript data types?', '', 'Null type', 'Undefined type', 'Number type', 'all', '', '', '', '', 0, '2024-03-20 21:23:48'),
(15, 1, NULL, 'Which of the following object is the main entry point to all client-side JavaScript features and APIs?', '', 'Pos', 'Win', 'Std', 'loc', '', '', '', '', 0, '2024-03-20 21:24:55'),
(16, 1, NULL, 'Which of the following object is the main entry point to all client-side JavaScript features and APIs?', '', 'Pos', 'Win', 'Std', 'loc', '', '', '', '', 0, '2024-03-20 21:26:31'),
(17, 1, NULL, 'Which of the following object is the main entry point to all client-side JavaScript features and APIs?', '', 'Pos', 'Win', 'Std', 'loc', '', '', '', '', 0, '2024-03-20 21:27:51'),
(18, 1, NULL, 'Which of the following can be used to call a JavaScript Code Snippet?', '', 'Function/Method', 'Preprocessor', 'Triggering Event', 'RMI', '', '', '', '', 0, '2024-03-20 21:29:22'),
(19, 1, NULL, 'Which of the following can be used to call a JavaScript Code Snippet?', '', 'Function/Method', 'Preprocessor', 'Triggering Event', 'RMI', '', '', '', '', 0, '2024-03-20 21:33:39'),
(20, 1, NULL, 'Which of the following can be used to call a JavaScript Code Snippet?', '', 'Function/Method', 'Preprocessor', 'Triggering Event', 'RMI', '', '', '', '', 0, '2024-03-20 21:34:44'),
(21, 1, NULL, 'Which of the following can be used to call a JavaScript Code Snippet?', '', 'Function/Method', 'Preprocessor', 'Triggering Event', 'RMI', '', '', '', '', 0, '2024-03-20 21:38:42'),
(25, 1, NULL, 'Which of the following can be used to call a JavaScript Code Snippet?', '', 'Function/Method', 'Preprocessor', 'Triggering Event', 'RMI', '', '', '', '', 0, '2024-03-20 21:43:19'),
(26, 1, NULL, 'Which of the following can be used to call a JavaScript Code Snippet?', '', 'Function/Method', 'Preprocessor', 'Triggering Event', 'RMI', '', '', '', '', 0, '2024-03-20 21:47:49'),
(27, 1, NULL, 'Which of the following can be used to call a JavaScript Code Snippet?', '', 'Function/Method', 'Preprocessor', 'Triggering Event', 'RMI', '', '', '', '', 0, '2024-03-20 21:48:29'),
(28, 1, NULL, 'Which of the following can be used to call a JavaScript Code Snippet?', '', 'Function/Method', 'Preprocessor', 'Triggering Event', 'RMI', '', '', '', '', 0, '2024-03-20 21:48:40'),
(29, 1, NULL, 'The study of reaction kinetics is called __________', '', 'Rate of reaction', 'Mechanism of reaction', 'Factors which affect the rate of reaction', '&nbsp;All of the mentioned', '', '', '', '', 0, '2024-03-21 07:07:23'),
(30, 1, NULL, 'The reaction rate constant can be defined as the rate of reaction when each reactant&rsquo;s concentration is ___________', '', 'zero', 'unity', '2x', 'infinite', '', '', '', '', 0, '2024-03-21 12:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `department` varchar(255) NOT NULL,
  `verify_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `teacher_name`, `email`, `password`, `phone`, `department`, `verify_token`, `created_at`) VALUES
(8, 'Prasad Nathe', 'prasadnathe2018@gmail.com', '9898', '72398470173', 'IT', 'e9658643e57736da21137a8d70b4a7a4', '2024-04-07 06:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_qualification` varchar(50) DEFAULT NULL,
  `user_key` varchar(50) DEFAULT NULL,
  `user_year` int(11) DEFAULT NULL,
  `phone_no` varchar(12) DEFAULT NULL,
  `first_login` date DEFAULT NULL,
  `recent_login` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `department` varchar(255) NOT NULL,
  `verify_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_points`
--

CREATE TABLE `user_points` (
  `user_id` int(11) DEFAULT NULL,
  `mode_id` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `reward` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wrong_question`
--

CREATE TABLE `wrong_question` (
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `championship`
--
ALTER TABLE `championship`
  ADD PRIMARY KEY (`champ_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `change_password`
--
ALTER TABLE `change_password`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `chosen_questions`
--
ALTER TABLE `chosen_questions`
  ADD KEY `label_id` (`label_id`),
  ADD KEY `mode_id` (`mode_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `institute_id` (`institute_id`);

--
-- Indexes for table `game_mode`
--
ALTER TABLE `game_mode`
  ADD PRIMARY KEY (`mode_id`),
  ADD KEY `champ_id` (`champ_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`institute_id`);

--
-- Indexes for table `label`
--
ALTER TABLE `label`
  ADD PRIMARY KEY (`label_id`);

--
-- Indexes for table `participated`
--
ALTER TABLE `participated`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `mode_id` (`mode_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `label_id` (`label_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_points`
--
ALTER TABLE `user_points`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `mode_id` (`mode_id`);

--
-- Indexes for table `wrong_question`
--
ALTER TABLE `wrong_question`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `championship`
--
ALTER TABLE `championship`
  MODIFY `champ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `change_password`
--
ALTER TABLE `change_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game_mode`
--
ALTER TABLE `game_mode`
  MODIFY `mode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `institute_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `label`
--
ALTER TABLE `label`
  MODIFY `label_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`);

--
-- Constraints for table `championship`
--
ALTER TABLE `championship`
  ADD CONSTRAINT `championship_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `championship_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`);

--
-- Constraints for table `change_password`
--
ALTER TABLE `change_password`
  ADD CONSTRAINT `change_password_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`);

--
-- Constraints for table `chosen_questions`
--
ALTER TABLE `chosen_questions`
  ADD CONSTRAINT `chosen_questions_ibfk_1` FOREIGN KEY (`label_id`) REFERENCES `label` (`label_id`),
  ADD CONSTRAINT `chosen_questions_ibfk_2` FOREIGN KEY (`mode_id`) REFERENCES `game_mode` (`mode_id`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`institute_id`) REFERENCES `institute` (`institute_id`);

--
-- Constraints for table `game_mode`
--
ALTER TABLE `game_mode`
  ADD CONSTRAINT `game_mode_ibfk_1` FOREIGN KEY (`champ_id`) REFERENCES `championship` (`champ_id`),
  ADD CONSTRAINT `game_mode_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `game_mode_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`);

--
-- Constraints for table `participated`
--
ALTER TABLE `participated`
  ADD CONSTRAINT `participated_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `participated_ibfk_2` FOREIGN KEY (`mode_id`) REFERENCES `game_mode` (`mode_id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`label_id`) REFERENCES `label` (`label_id`),
  ADD CONSTRAINT `question_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`);

--
-- Constraints for table `user_points`
--
ALTER TABLE `user_points`
  ADD CONSTRAINT `user_points_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `user_points_ibfk_2` FOREIGN KEY (`mode_id`) REFERENCES `game_mode` (`mode_id`);

--
-- Constraints for table `wrong_question`
--
ALTER TABLE `wrong_question`
  ADD CONSTRAINT `wrong_question_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `wrong_question_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
