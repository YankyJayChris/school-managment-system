-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2019 at 06:44 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `classid` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `term` int(11) NOT NULL,
  `sy` varchar(50) NOT NULL,
  `teacherid` varchar(30) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `classid`, `course`, `year`, `section`, `term`, `sy`, `teacherid`, `subject`, `createdon`) VALUES
(1, 'ADC-I-D-1-2018-2019-IT001', 'ADC', 'I', 'D', 1, '2018-2019', 'chris321', 'IT001', '2019-03-12 10:00:15'),
(2, 'ADC-I-D-1-2018-2019-IT002', 'ADC', 'I', 'D', 1, '2018-2019', 'chris321', 'IT002', '2019-03-12 10:03:10'),
(3, 'ADC-I-D-1-2018-2019-IT003', 'ADC', 'I', 'D', 1, '2018-2019', 'chris321', 'IT003', '2019-03-12 10:23:43'),
(9, 'MBA-III-N-1-2018-2019-IT003', 'MBA', 'III', 'N', 1, '2018-2019', 'chris321', 'IT003', '2019-03-15 11:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course` varchar(150) NOT NULL,
  `title` varchar(250) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course`, `title`, `createdon`) VALUES
(1, 'ADC', 'Advanced Diploma In Cloud computing', '2019-02-14 11:11:49'),
(2, 'MBA', 'Masters Business Administration', '2019-02-14 11:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `examname` varchar(250) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `examtype` varchar(50) NOT NULL,
  `classid` varchar(50) NOT NULL,
  `course` varchar(30) NOT NULL,
  `year` varchar(10) NOT NULL,
  `section` varchar(150) NOT NULL,
  `term` int(11) NOT NULL,
  `teacherid` varchar(30) NOT NULL,
  `sy` varchar(30) NOT NULL,
  `maxmarks` int(11) NOT NULL,
  `marksadded` int(11) DEFAULT '0',
  `aproved` int(11) NOT NULL DEFAULT '0',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `examname`, `subject`, `examtype`, `classid`, `course`, `year`, `section`, `term`, `teacherid`, `sy`, `maxmarks`, `marksadded`, `aproved`, `createdon`) VALUES
(2, 'exam2', 'IT003', 'Exam', 'ADC-I-D-1-2018-2019-IT001', 'ADC', 'I', 'D', 1, 'chris321', '2018-2019', 100, 1, 0, '2019-03-15 16:09:46'),
(6, 'quiz1', 'IT001', 'Quiz', 'ADC-I-D-1-2018-2019-IT001', 'ADC', 'I', 'D', 1, 'chris321', '2018-2019', 30, 1, 0, '2019-03-31 10:58:51'),
(7, 'assn1', 'IT001', 'Assignement', 'ADC-I-D-1-2018-2019-IT001', 'ADC', 'I', 'D', 1, 'chris321', '2018-2019', 20, 1, 0, '2019-03-31 11:10:37'),
(8, 'quiz2', 'IT001', 'Quiz', 'ADC-I-D-1-2018-2019-IT001', 'ADC', 'I', 'D', 1, 'chris321', '2018-2019', 50, 1, 0, '2019-03-31 12:03:28'),
(9, 'assn2', 'IT001', 'Assignement', 'ADC-I-D-1-2018-2019-IT001', 'ADC', 'I', 'D', 1, 'chris321', '2018-2019', 50, 1, 0, '2019-03-31 12:11:58'),
(10, 'exam1', 'IT002', 'Exam', 'ADC-I-D-1-2018-2019-IT002', 'ADC', 'I', 'D', 1, 'chris321', '2018-2019', 60, 1, 0, '2019-04-01 09:05:25'),
(11, 'quiz1', 'IT002', 'Quiz', 'ADC-I-D-1-2018-2019-IT002', 'ADC', 'I', 'D', 1, 'chris321', '2018-2019', 10, 1, 0, '2019-04-01 09:46:55'),
(12, 'assn1', 'IT002', 'Assignement', 'ADC-I-D-1-2018-2019-IT002', 'ADC', 'I', 'D', 1, 'chris321', '2018-2019', 100, 1, 0, '2019-04-01 09:49:36'),
(13, 'assn2', 'IT002', 'Assignement', 'ADC-I-D-1-2018-2019-IT002', 'ADC', 'I', 'D', 1, 'chris321', '2018-2019', 30, 1, 0, '2019-04-01 10:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `userid` varchar(150) NOT NULL,
  `activity` varchar(250) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `subjectid` varchar(30) NOT NULL,
  `examtype` varchar(50) NOT NULL,
  `classid` varchar(30) NOT NULL,
  `sy` varchar(50) NOT NULL,
  `year` varchar(11) NOT NULL,
  `term` int(11) NOT NULL,
  `examid` varchar(30) NOT NULL,
  `studentid` varchar(250) NOT NULL,
  `marks` int(11) NOT NULL DEFAULT '0',
  `secmarks` int(11) NOT NULL DEFAULT '-1',
  `maxmarks` int(11) NOT NULL,
  `teacherid` varchar(250) NOT NULL,
  `aproved` int(11) NOT NULL DEFAULT '0',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`id`, `subjectid`, `examtype`, `classid`, `sy`, `year`, `term`, `examid`, `studentid`, `marks`, `secmarks`, `maxmarks`, `teacherid`, `aproved`, `createdon`) VALUES
(9, 'ADC', 'Exam', 'ADC-I-D-1-2018-2019-IT001', '2018-2019', 'I', 1, 'exam2', 'dan1234', 88, -1, 100, 'chris321', 0, '2019-03-29 01:48:53'),
(10, 'ADC', 'Exam', 'ADC-I-D-1-2018-2019-IT001', '2018-2019', 'I', 1, 'exam2', 'chris098', 88, -1, 100, 'chris321', 0, '2019-03-29 01:48:53'),
(11, 'ADC', 'Quiz', 'ADC-I-D-1-2018-2019-IT001', '2018-2019', 'I', 1, 'quiz1', 'dan1234', 20, -1, 30, 'chris321', 0, '2019-03-31 11:07:44'),
(12, 'ADC', 'Quiz', 'ADC-I-D-1-2018-2019-IT001', '2018-2019', 'I', 1, 'quiz1', 'chris098', 18, -1, 30, 'chris321', 0, '2019-03-31 11:07:44'),
(13, 'ADC', 'Assignement', 'ADC-I-D-1-2018-2019-IT001', '2018-2019', 'I', 1, 'assn1', 'dan1234', 20, -1, 20, 'chris321', 0, '2019-03-31 11:10:59'),
(14, 'ADC', 'Assignement', 'ADC-I-D-1-2018-2019-IT001', '2018-2019', 'I', 1, 'assn1', 'chris098', 20, -1, 20, 'chris321', 0, '2019-03-31 11:10:59'),
(15, 'ADC', 'Quiz', 'ADC-I-D-1-2018-2019-IT001', '2018-2019', 'I', 1, 'quiz2', 'dan1234', 40, -1, 50, 'chris321', 0, '2019-03-31 12:07:09'),
(16, 'ADC', 'Quiz', 'ADC-I-D-1-2018-2019-IT001', '2018-2019', 'I', 1, 'quiz2', 'chris098', 50, -1, 50, 'chris321', 0, '2019-03-31 12:07:09'),
(21, 'ADC', 'Assignement', 'ADC-I-D-1-2018-2019-IT001', '2018-2019', 'I', 1, 'assn2', 'dan1234', 40, -1, 50, 'chris321', 0, '2019-03-31 14:12:14'),
(22, 'ADC', 'Assignement', 'ADC-I-D-1-2018-2019-IT001', '2018-2019', 'I', 1, 'assn2', 'chris098', 48, -1, 50, 'chris321', 0, '2019-03-31 14:12:14'),
(31, 'ADC', 'Exam', 'ADC-I-D-1-2018-2019-IT002', '2018-2019', 'I', 1, 'exam1', 'dan1234', 59, -1, 60, 'chris321', 0, '2019-04-01 09:20:45'),
(32, 'ADC', 'Exam', 'ADC-I-D-1-2018-2019-IT002', '2018-2019', 'I', 1, 'exam1', 'chris098', 0, -1, 60, 'chris321', 0, '2019-04-01 09:20:45'),
(33, 'ADC', 'Quiz', 'ADC-I-D-1-2018-2019-IT002', '2018-2019', 'I', 1, 'quiz1', 'dan1234', 10, -1, 10, 'chris321', 0, '2019-04-01 09:47:15'),
(34, 'ADC', 'Quiz', 'ADC-I-D-1-2018-2019-IT002', '2018-2019', 'I', 1, 'quiz1', 'chris098', 10, -1, 10, 'chris321', 0, '2019-04-01 09:47:15'),
(35, 'ADC', 'Assignement', 'ADC-I-D-1-2018-2019-IT002', '2018-2019', 'I', 1, 'assn1', 'dan1234', 10, -1, 100, 'chris321', 0, '2019-04-01 09:50:00'),
(36, 'ADC', 'Assignement', 'ADC-I-D-1-2018-2019-IT002', '2018-2019', 'I', 1, 'assn1', 'chris098', 100, -1, 100, 'chris321', 0, '2019-04-01 09:50:00'),
(37, 'ADC', 'Assignement', 'ADC-I-D-1-2018-2019-IT002', '2018-2019', 'I', 1, 'assn2', 'dan1234', 20, -1, 30, 'chris321', 0, '2019-04-01 10:26:07'),
(38, 'ADC', 'Assignement', 'ADC-I-D-1-2018-2019-IT002', '2018-2019', 'I', 1, 'assn2', 'chris098', 15, -1, 30, 'chris321', 0, '2019-04-01 10:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `marksseting`
--

CREATE TABLE `marksseting` (
  `id` int(11) NOT NULL,
  `exam` int(11) NOT NULL,
  `quiz` int(11) NOT NULL,
  `assin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marksseting`
--

INSERT INTO `marksseting` (`id`, `exam`, `quiz`, `assin`) VALUES
(0, 50, 30, 20);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `sectionname` varchar(30) NOT NULL,
  `shortname` varchar(20) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `sectionname`, `shortname`, `createdon`) VALUES
(4, 'Day Program', 'D', '2019-02-14 11:25:08'),
(5, 'Night Program', 'N', '2019-02-14 11:25:08'),
(6, 'Weekend Program', 'W', '2019-02-14 11:25:08');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `studentid` varchar(150) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `course` varchar(30) NOT NULL,
  `section` varchar(30) NOT NULL,
  `sy` varchar(20) NOT NULL,
  `year` varchar(11) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `studentid`, `fname`, `lname`, `course`, `section`, `sy`, `year`, `createdon`) VALUES
(1, 'kar123', 'khizz', 'Me', 'ADC', 'D', '2019-2020', 'I', '2019-03-14 21:33:09'),
(2, 'hass123', 'hassan', 'you', 'ADC', 'D', '2019-2020', 'I', '2019-03-14 21:44:11'),
(3, 'dan1234', 'danny', 'he', 'ADC', 'D', '2018-2019', 'I', '2019-03-14 21:56:43'),
(4, 'chris098', 'christian', 'jean', 'ADC', 'D', '2018-2019', 'I', '2019-03-15 14:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `title` varchar(250) NOT NULL,
  `course` varchar(30) NOT NULL,
  `units` int(11) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `code`, `title`, `course`, `units`, `createdon`) VALUES
(1, 'IT001', 'Programing 1', 'ADC', 12, '2019-02-14 11:17:29'),
(2, 'IT002', 'cloude based', 'ADC', 12, '2019-02-14 11:17:29'),
(3, 'IT003', 'web app desgni', 'ADC', 12, '2019-02-14 11:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `teacherid` varchar(150) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `teacherid`, `fname`, `lname`, `createdon`) VALUES
(1, 'chris321', 'karim', 'khizz', '2019-03-14 16:54:19'),
(2, 'hassan123', 'hassan', 'assasin', '2019-03-14 17:17:24'),
(3, 'teacher111', 'teacher', 'teach', '2019-03-15 14:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `username`, `password`, `fname`, `lname`, `level`) VALUES
(1, 'chris123', '123', 'chris', 'jay', 'admin'),
(2, 'chris321', '123', 'john', 'christian', 'teacher'),
(3, 'karim123', '123', 'karim', 'khizz', 'student'),
(4, 'dan1234', '123', 'danny', 'he', 'student'),
(5, 'chris098', '123', 'christian', 'jean', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
