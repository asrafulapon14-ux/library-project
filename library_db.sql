-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2026 at 05:39 PM
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
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_name`, `author`, `category`) VALUES
(1, 'চোখের বালি', 'রবীন্দ্রনাথ ঠাকুর', 'উপন্যাস'),
(2, 'অপেক্ষা', 'হুমায়ুন আহমেদ', 'উপন্যাস'),
(3, 'রঙ্গীন ভুবন', 'আশরাফুল ইসলাম', 'উপন্যাস'),
(4, 'বাদল দিনের্ দ্বিতীয় কদম ফুল', 'হুমায়ুন আহমেদ', 'উপন্যাস'),
(12, 'আদর্শ হিন্দু হোটেল', 'বিভুতিভূষণ বন্দোপাধ্যায়', 'উপন্যাস'),
(13, 'দেয়াল', 'হুমায়ুন আহমেদ', 'উপন্যাস'),
(14, 'বৃষ্টি-বিলাস', 'হুমায়ুন আহমেদ', 'উপন্যাস'),
(15, 'শ্রীকান্ত', 'শরৎচন্দ্র চট্টোপাধ্যায়', 'উপন্যাস'),
(16, 'নন্দিত নরকে', 'হুমায়ুন আহমেদ', 'উপন্যাস'),
(17, 'সে ও নর্তকী', 'হুমায়ুন আহমেদ', 'উপন্যাস'),
(18, 'শঙ্খনীল কারাগার', 'হুমায়ুন আহমেদ', 'উপন্যাস'),
(19, 'রুপা', 'হুমায়ুন আহমেদ', 'উপন্যাস'),
(20, 'ময়ূরাক্ষী', 'হুমায়ুন আহমেদ', 'উপন্যাস'),
(21, 'হিমু', 'হুমায়ুন আহমেদ', 'উপন্যাস'),
(22, 'পরীনিতা', 'শরৎচন্দ্র চট্টোপাধ্যায়', 'উপন্যাস'),
(23, 'আম আটির ভেঁপু', 'বিভুতিভূষণ বন্দোপাধ্যায়', 'উপন্যাস');

-- --------------------------------------------------------

--
-- Table structure for table `issue_books`
--

CREATE TABLE `issue_books` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_books`
--

INSERT INTO `issue_books` (`id`, `book_id`, `student_id`, `issue_date`, `return_date`) VALUES
(1, 3, 3, '2026-02-10', '2026-03-04'),
(2, 2, 1, '2026-03-02', '2026-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(100) NOT NULL,
  `semester` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `department`, `semester`) VALUES
(1, 'মো:আশরাফুল ইসলাম', 'কম্পিউটার', '7th'),
(2, 'জাকির হোসেন', 'ইলেকট্রনিক্স', '7th'),
(3, 'জিসান আহমেদ', 'সিভিল', '8th'),
(4, 'পরস মিয়া', 'ইলেকট্রিক্যাল', '5th'),
(5, 'আসিফ আকন্দ', 'সিভিল', '7th'),
(6, 'ইমরান আকন্দ', 'ইলেকট্রনিক্স', '7th'),
(7, 'শাহাদাত হোসেন', 'কম্পিউটার', '7th'),
(8, 'জীম মিয়া', 'কম্পিউটার', '7th'),
(9, 'শিশির আহমেদ', 'মেকানিক্যাল', '7th');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_name` (`book_name`);

--
-- Indexes for table `issue_books`
--
ALTER TABLE `issue_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `issue_books`
--
ALTER TABLE `issue_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
