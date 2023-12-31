-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2023 at 01:52 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `innovius_db_sudokugame`
--

-- --------------------------------------------------------

--
-- Table structure for table `current_best_win_streak`
--

CREATE TABLE `current_best_win_streak` (
  `user_id` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'foreign key of user_registration table user_id',
  `game_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `game_win_date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `current_best_win_streak`
--

INSERT INTO `current_best_win_streak` (`user_id`, `game_id`, `game_win_date_time`) VALUES
('0001', 'game001', '2021-06-24 12:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `game_cancel`
--

CREATE TABLE `game_cancel` (
  `user_id` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'foreign key of user_registration table user_id	',
  `game_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `time` varchar(255) NOT NULL,
  `difficulty` varchar(255) CHARACTER SET utf8 NOT NULL,
  `game_state` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game_cancel`
--

INSERT INTO `game_cancel` (`user_id`, `game_id`, `time`, `difficulty`, `game_state`, `created_at`, `updated_at`) VALUES
('0001', 'game001', '20', 'not so much', 'ok', '2021-06-24 11:44:07', '2021-06-24 11:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `game_cancel_bkp23jun2021`
--

CREATE TABLE `game_cancel_bkp23jun2021` (
  `user_id` int(11) NOT NULL COMMENT 'foreign key of user_registration table user_id	',
  `game_id` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `difficulty` varchar(255) NOT NULL,
  `game_state` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `game_finalised`
--

CREATE TABLE `game_finalised` (
  `user_id` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'foreign key of user_registration table user_id',
  `game_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `board_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mode` enum('0','1','2') CHARACTER SET utf8 NOT NULL COMMENT '0=>easy,1=>medium,2=>hard',
  `per_board_time` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `num_mistakes` int(11) NOT NULL,
  `game_state` enum('0','1','2') CHARACTER SET utf8 NOT NULL DEFAULT '0' COMMENT '0=>continue,1=>win,2=>lost',
  `game_completed_marks` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game_finalised`
--

INSERT INTO `game_finalised` (`user_id`, `game_id`, `board_id`, `mode`, `per_board_time`, `score`, `num_mistakes`, `game_state`, `game_completed_marks`, `created_at`, `updated_at`) VALUES
('0001', 'game001', 'board22', '0', '30 min', 5, 1, '1', 50, '2021-06-24 10:33:08', '2021-06-24 12:50:20'),
('0002', 'game002', 'board25', '0', '30 min', 2, 10, '2', 5, '2021-06-24 13:08:46', '2021-06-24 13:14:52');

-- --------------------------------------------------------

--
-- Table structure for table `game_finalised_bkp23jun2021`
--

CREATE TABLE `game_finalised_bkp23jun2021` (
  `user_id` int(11) NOT NULL COMMENT 'foreign key of user_registration table user_id',
  `game_id` varchar(255) NOT NULL,
  `mode` enum('0','1','2') NOT NULL COMMENT '0=>easy,1=>medium,2=>hard',
  `per_board_time` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `num_mistakes` int(11) NOT NULL,
  `game_state` enum('0','1','2') NOT NULL COMMENT '0=>continue,1=>win,2=>lost',
  `game_completed_marks` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_registration`
--

CREATE TABLE `user_registration` (
  `user_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `contact_no` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`user_id`, `name`, `email`, `contact_no`, `password`, `status`, `created_at`, `updated_at`) VALUES
('0001', 'Rahul Sen', 'rahul@gmail.com', '8745022440', 'MTIzNA==', 1, '2021-06-23 10:52:33', '2021-06-23 10:52:33'),
('00010', 'Basudev Chatterjee', 'basudev@gmail.com', '8456088220', 'MTIzNA==', 1, '2021-06-28 07:35:49', '2021-06-28 07:35:49'),
('00016', 'Balaram Roy', 'balaram@gmail.com', '7632441100', 'MTIzNA==', 1, '2022-01-17 07:00:03', '2022-01-17 07:00:03'),
('00017', 'Samik Sinha', 'samik@gmail.com', '7632441144', 'MTIzNA==', 1, '2022-01-17 07:05:35', '2022-01-17 07:05:35'),
('0002', 'Sujoy Dasgupta', 'sujoy@gmail.com', '8745022442', 'MTIzNA==', 1, '2021-06-23 10:54:18', '2021-06-23 10:54:18'),
('0003', 'Ayan Biswas', 'ayan@gmail.com', '8745022445', 'MTIzNA==', 1, '2021-06-23 10:58:06', '2021-06-23 10:58:06'),
('0004', 'Dhiman Chakroborty', 'dhiman@gmail.com', '8745022456', 'MTIzNDU2', 1, '2021-06-23 11:54:20', '2021-06-23 11:54:20'),
('0005', 'Sumit Roy', 'sumit@gmail.com', '8745022458', 'MTIzNDU2', 1, '2021-06-23 14:02:40', '2021-06-23 14:02:40'),
('0007', 'Rajsekhar Panda', 'rajsekhar@gmail.com', '8456088770', 'MTIzNA==', 1, '2021-06-24 07:41:54', '2021-06-24 07:41:54'),
('0008', 'Rajsekhar Shaw', 'rajsekhar1234@gmail.com', '8456088780', 'MTIzNA==', 1, '2021-06-24 08:46:56', '2021-06-24 08:46:56'),
('0009', 'Sekhar Sen', 'sekhar@gmail.com', '8456088785', 'MTIzNA==', 1, '2021-06-28 07:09:17', '2021-06-28 07:09:17'),
('0015', 'Bholanath Roy', 'bholanath@gmail.com', '7894562244', 'MTIzNA==', 1, '2021-07-22 17:33:54', '2021-07-22 17:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration_bkp23jun2021`
--

CREATE TABLE `user_registration_bkp23jun2021` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `current_best_win_streak`
--
ALTER TABLE `current_best_win_streak`
  ADD PRIMARY KEY (`user_id`,`game_id`);

--
-- Indexes for table `game_cancel`
--
ALTER TABLE `game_cancel`
  ADD PRIMARY KEY (`user_id`,`game_id`);

--
-- Indexes for table `game_cancel_bkp23jun2021`
--
ALTER TABLE `game_cancel_bkp23jun2021`
  ADD PRIMARY KEY (`user_id`,`game_id`);

--
-- Indexes for table `game_finalised`
--
ALTER TABLE `game_finalised`
  ADD PRIMARY KEY (`user_id`,`game_id`);

--
-- Indexes for table `game_finalised_bkp23jun2021`
--
ALTER TABLE `game_finalised_bkp23jun2021`
  ADD PRIMARY KEY (`user_id`,`game_id`);

--
-- Indexes for table `user_registration`
--
ALTER TABLE `user_registration`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_registration_bkp23jun2021`
--
ALTER TABLE `user_registration_bkp23jun2021`
  ADD PRIMARY KEY (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
