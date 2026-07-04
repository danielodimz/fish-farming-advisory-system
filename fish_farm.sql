-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 20, 2025 at 04:06 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fish_farm`
--

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

DROP TABLE IF EXISTS `certificates`;
CREATE TABLE IF NOT EXISTS `certificates` (
  `user_id` int NOT NULL,
  `issued_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`user_id`, `issued_date`, `status`) VALUES
(2, '2025-08-20 01:58:26', 'pending'),
(1, '2025-08-20 02:55:00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
CREATE TABLE IF NOT EXISTS `lessons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `title`, `content`, `video_url`, `created_at`) VALUES
(1, 'Introduction to Fish Farming', 'This lesson introduces the basics of fish farming.', 'https://www.youtube.com/embed/vv6BLFsKplA', '2025-05-08 08:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `materials` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `title`, `content`, `image_url`, `materials`, `created_at`, `updated_at`) VALUES
(1, 'Introduction to Fish Farming', 'Learn the basics of fish farming in Nigeria.', NULL, 'Guide to pond setup.', '2025-08-20 03:57:35', '2025-08-20 03:57:35'),
(2, 'Catfish Pond Management', 'Techniques for managing catfish ponds in Nigeria.', NULL, 'Water quality testing manual.', '2025-08-20 03:57:35', '2025-08-20 03:57:35');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

DROP TABLE IF EXISTS `quizzes`;
CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `module_id` int NOT NULL,
  `question` text NOT NULL,
  `option_a` text NOT NULL,
  `option_b` text NOT NULL,
  `option_c` text NOT NULL,
  `option_d` text NOT NULL,
  `correct_answer` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `module_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`) VALUES
(1, 1, 'what', 'q', 'a', 'e', 'l', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

DROP TABLE IF EXISTS `quiz_results`;
CREATE TABLE IF NOT EXISTS `quiz_results` (
  `user_id` int NOT NULL,
  `quiz_id` int NOT NULL,
  `score` int NOT NULL,
  PRIMARY KEY (`user_id`,`quiz_id`),
  KEY `quiz_id` (`quiz_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`user_id`, `quiz_id`, `score`) VALUES
(2, 1, 80),
(2, 2, 60),
(1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','student') DEFAULT 'student',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'oloyede.tony@gmail.com', 'oloyede.tony@gmail.com', '$2y$10$rVxcrTjX3fyZLkRxnYaXzOg2OZ4pV/pte5amS6nTgA1yN3rsc/fCS', 'student', '2025-05-08 08:49:51'),
(2, 'Anthony Oloyede', 'oloyede.tony@gmail.com', '$2y$10$b2tAf6e6QCNmjLB.W/s2zOod3pEz46x3JnERcmdqW012ai7qpVwmK', 'student', '2025-05-08 11:36:36'),
(3, 'Mike Pancake', 'atonyoloyede@gmail.com', '$2y$10$hxIDY5oXdHJJa1A46VOa0u550q9V5.M4/7IXBiGycOkBPrIeP0RTW', 'admin', '2025-05-08 11:48:42'),
(4, 'admin', 'admin@example.com', '$2y$10$yourhashedpassword', '', '2025-08-19 09:13:51'),
(5, 'testuser1', 'test1@example.com', '$2y$10$examplehashedpassword', '', '2025-08-20 02:24:02'),
(6, 'testadmin', 'admin@example.com', '$2y$10$examplehashedpassword', 'admin', '2025-08-20 02:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_progress`
--

DROP TABLE IF EXISTS `user_progress`;
CREATE TABLE IF NOT EXISTS `user_progress` (
  `user_id` int NOT NULL,
  `module_id` int NOT NULL,
  `completed` tinyint(1) DEFAULT '0',
  `progress_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`module_id`),
  KEY `module_id` (`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_progress`
--

INSERT INTO `user_progress` (`user_id`, `module_id`, `completed`, `progress_date`) VALUES
(2, 1, 1, '2025-08-15 09:00:00'),
(2, 2, 0, '2025-08-16 11:00:00'),
(1, 7, 0, '2025-08-20 02:29:42'),
(1, 1, 1, '2025-08-20 02:29:51'),
(1, 2, 0, '2025-08-20 02:45:22'),
(1, 3, 0, '2025-08-20 02:45:28'),
(1, 4, 0, '2025-08-20 02:45:38'),
(1, 5, 0, '2025-08-20 02:45:41'),
(1, 8, 0, '2025-08-20 03:53:10'),
(1, 9, 0, '2025-08-20 03:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `youtube_url` varchar(255) NOT NULL,
  `category` enum('backyard','catfish') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `youtube_url`, `category`, `created_at`) VALUES
(1, 'Backyard Tilapia Farming', 'https://www.youtube.com/embed/videoseries?si=fi-nWI9r4ywGuxbq&list=PLj2O9lhN5zCZB7fWEOXwanlFJJlefu5c9', 'backyard', '2025-08-20 03:13:07'),
(2, 'Farming Tilapia & Catfish in the Backyard', 'https://www.youtube.com/embed/8wfeuGqa120?si=h5Uz4s-ZOebZUKq1', 'backyard', '2025-08-20 03:13:07'),
(3, 'Backyard Tilapia & Catfish Farming: Water Quality Test & Feed', 'https://www.youtube.com/embed/tQohmU3IqYw?si=NODgO_0KedaZLm3H', 'backyard', '2025-08-20 03:13:07'),
(4, 'Why We Lost Over 70% of Our Tilapia', 'https://www.youtube.com/embed/pXv-mo2dNu8?si=9uUnUAYr_XmKoJNq', 'backyard', '2025-08-20 03:13:07'),
(5, 'Set Up Tilapia Farm & Garden', 'https://www.youtube.com/embed/M_MhuY588pA?si=_mZzjk8bbfMeN5gV', 'backyard', '2025-08-20 03:13:07'),
(6, 'Solved Losing Over 70% of Our Tilapia', 'https://www.youtube.com/embed/Y76pNX46hYE?si=TJrVPDlJG2_lEqu-', 'backyard', '2025-08-20 03:13:07'),
(7, 'Grow Fish with No Water Change', 'https://www.youtube.com/embed/JkTDgpCA0as?si=y8WE9PlSFdnkxsYv', 'backyard', '2025-08-20 03:13:07'),
(8, 'Tilapia Farming with No Water Change', 'https://www.youtube.com/embed/cC9d1wy8Dhs?si=29ctz8AqXqR0GZeu', 'backyard', '2025-08-20 03:13:07'),
(9, 'Sorting Tilapia and Cleaning Catfish Ponds', 'https://www.youtube.com/embed/SsE_RhkmJ3o?si=eVi1EZrxSPQL5w7l', 'backyard', '2025-08-20 03:13:07'),
(10, 'Catfish Farming', 'https://www.youtube.com/embed/EK4IQkIFZHQ?si=ZBqjTXFXmyy9Oik-', 'catfish', '2025-08-20 03:13:07'),
(11, 'Why It’s Advisable to Export Your Catfish', 'https://www.youtube.com/embed/w5Cd-LgaDZQ?si=7R3FjuoL9Hjv257N', 'catfish', '2025-08-20 03:13:07'),
(12, 'Large Scale Catfish Farming', 'https://www.youtube.com/embed/nvPhOmJUAm4?si=ON2AiVLT6e2N5dmw', 'catfish', '2025-08-20 03:13:07'),
(13, 'The Best Type of Fish Pond for Catfish Farming', 'https://www.youtube.com/embed/FP8PMGpqqS4?si=jvoWLJhnNmFOKB0W', 'catfish', '2025-08-20 03:13:07'),
(14, 'How to Start a Catfish Farm Using a Mud/Earthen Pond', 'https://www.youtube.com/embed/wM4Hy-da_Cw?si=EubP5s2IPYlNIAzs', 'catfish', '2025-08-20 03:13:07'),
(15, 'Meet the Marine and Fishery Graduates', 'https://www.youtube.com/embed/oqIV-Mf7Q4c?si=O1PVOgLKfujVFOvf', 'catfish', '2025-08-20 03:13:07'),
(16, 'Domestic Catfish Farming', 'https://www.youtube.com/embed/v3LTlEzyTv8?si=G8CDHNHGUnCeISZ8', 'catfish', '2025-08-20 03:13:07'),
(17, 'Weighing of a 3.5kg Catfish', 'https://www.youtube.com/embed/YfIgiZmfOFk?si=TiLQodzwVDKQANK_', 'catfish', '2025-08-20 03:13:07'),
(18, 'Sorting Tilapia and Cleaning Catfish Ponds', 'https://www.youtube.com/embed/SsE_RhkmJ3o?si=eVi1EZrxSPQL5w7l', 'catfish', '2025-08-20 03:13:07');

-- --------------------------------------------------------

--
-- Table structure for table `video_progress`
--

DROP TABLE IF EXISTS `video_progress`;
CREATE TABLE IF NOT EXISTS `video_progress` (
  `user_id` int NOT NULL,
  `video_id` int NOT NULL,
  `viewed` tinyint(1) DEFAULT '0',
  `view_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`video_id`),
  KEY `video_id` (`video_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `video_progress`
--

INSERT INTO `video_progress` (`user_id`, `video_id`, `viewed`, `view_date`) VALUES
(1, 1, 1, '2025-08-20 03:15:23'),
(1, 2, 1, '2025-08-20 03:15:23'),
(1, 3, 1, '2025-08-20 03:15:23'),
(1, 4, 1, '2025-08-20 03:15:23'),
(1, 5, 1, '2025-08-20 03:15:23'),
(1, 6, 1, '2025-08-20 03:15:23'),
(1, 7, 1, '2025-08-20 03:15:23'),
(1, 8, 1, '2025-08-20 03:15:23'),
(1, 9, 1, '2025-08-20 03:15:23'),
(1, 10, 1, '2025-08-20 03:15:40'),
(1, 11, 1, '2025-08-20 03:15:40'),
(1, 12, 1, '2025-08-20 03:15:40'),
(1, 13, 1, '2025-08-20 03:15:40'),
(1, 14, 1, '2025-08-20 03:15:40'),
(1, 15, 1, '2025-08-20 03:15:40'),
(1, 16, 1, '2025-08-20 03:15:40'),
(1, 17, 1, '2025-08-20 03:15:40'),
(1, 18, 1, '2025-08-20 03:15:40');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
