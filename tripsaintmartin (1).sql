-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2024 at 01:11 PM
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
-- Database: `tripsaintmartin`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `mainTitle` varchar(255) NOT NULL,
  `blogCategory` varchar(255) NOT NULL,
  `categoryImage` varchar(255) DEFAULT NULL,
  `blogSubCategory` varchar(255) NOT NULL,
  `subCategoryImage` varchar(255) DEFAULT NULL,
  `paragraph` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `subTitle_1` varchar(255) DEFAULT NULL,
  `paragraph_1` text DEFAULT NULL,
  `subImage_1` varchar(255) DEFAULT NULL,
  `subTitle_2` varchar(255) DEFAULT NULL,
  `paragraph_2` text DEFAULT NULL,
  `subImage_2` varchar(255) DEFAULT NULL,
  `subTitle_3` varchar(255) DEFAULT NULL,
  `paragraph_3` text DEFAULT NULL,
  `subImage_3` varchar(255) DEFAULT NULL,
  `subTitle_4` varchar(255) DEFAULT NULL,
  `paragraph_4` text DEFAULT NULL,
  `subImage_4` varchar(255) DEFAULT NULL,
  `subTitle_5` varchar(255) DEFAULT NULL,
  `paragraph_5` text DEFAULT NULL,
  `subImage_5` varchar(255) DEFAULT NULL,
  `subTitle_6` varchar(255) DEFAULT NULL,
  `paragraph_6` text DEFAULT NULL,
  `subImage_6` varchar(255) DEFAULT NULL,
  `subTitle_7` varchar(255) DEFAULT NULL,
  `paragraph_7` text DEFAULT NULL,
  `subImage_7` varchar(255) DEFAULT NULL,
  `subTitle_8` varchar(255) DEFAULT NULL,
  `paragraph_8` text DEFAULT NULL,
  `subImage_8` varchar(255) DEFAULT NULL,
  `subTitle_9` varchar(255) DEFAULT NULL,
  `paragraph_9` text DEFAULT NULL,
  `subImage_9` varchar(255) DEFAULT NULL,
  `subTitle_10` varchar(255) DEFAULT NULL,
  `paragraph_10` text DEFAULT NULL,
  `subImage_10` varchar(255) DEFAULT NULL,
  `subTitle_11` varchar(255) DEFAULT NULL,
  `paragraph_11` text DEFAULT NULL,
  `subImage_11` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `mainTitle`, `blogCategory`, `categoryImage`, `blogSubCategory`, `subCategoryImage`, `paragraph`, `image`, `subTitle_1`, `paragraph_1`, `subImage_1`, `subTitle_2`, `paragraph_2`, `subImage_2`, `subTitle_3`, `paragraph_3`, `subImage_3`, `subTitle_4`, `paragraph_4`, `subImage_4`, `subTitle_5`, `paragraph_5`, `subImage_5`, `subTitle_6`, `paragraph_6`, `subImage_6`, `subTitle_7`, `paragraph_7`, `subImage_7`, `subTitle_8`, `paragraph_8`, `subImage_8`, `subTitle_9`, `paragraph_9`, `subImage_9`, `subTitle_10`, `paragraph_10`, `subImage_10`, `subTitle_11`, `paragraph_11`, `subImage_11`, `created_at`, `updated_at`) VALUES
(1, 'hello', 'মেয়েরা কিভাবে সলো ট্রাভেল করবেন', 'images/categories/solo.jpeg', 'সেন্ট মার্টিনে একজন নারীর জন্য নিরাপদ ভ্রমণ: করণীয় ও সতর্কতা', 'images/subcategories/solo.jpeg', 'asdfasdfasdfsadfsda', 'freepik__candid-image-photography-natural-textures-highly-r__44004.jpeg', 'asfdasdfsadf', 'asdfasdfasdfasdf', 'freepik__candid-image-photography-natural-textures-highly-r__44004.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-17 11:02:14', '2024-10-17 11:02:14'),
(2, 'asgsdfgsdg', 'মেয়েরা কিভাবে সলো ট্রাভেল করবেন', 'images/categories/solo.jpeg', 'asdfasdfadsfasdfasdf', 'images/subcategories/freepik__candid-image-photography-natural-textures-highly-r__44004.jpeg', 'sfgsdfgsdfgsfdg', 'freepik__candid-image-photography-natural-textures-highly-r__44004.jpeg', 'sgsdgsdfgs', 'sdgfsdgfd', 'IMG-20240201-WA0018-01 (2).jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-17 11:03:59', '2024-10-17 11:03:59'),
(3, 'sdfgsdfg', 'মেয়েরা কিভাবে সলো ট্রাভেল করবেন', 'images/categories/solo.jpeg', 'asdfasdfadsfasdfasdf', 'images/subcategories/freepik__candid-image-photography-natural-textures-highly-r__44004.jpeg', 'sdfgsdfgsdfgsdfg', 'freepik__candid-image-photography-natural-textures-highly-r__44004.jpeg', 'sdgsdfgdg', 'sgsdfgsdg', 'IMG-20240201-WA0018-01.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-17 11:05:20', '2024-10-17 11:05:20'),
(4, 'sdgsdfgfsdg', 'মেয়েরা কিভাবে সলো ট্রাভেল করবেন', 'images/categories/solo.jpeg', 'asdfasdfadsfasdfasdf', 'images/subcategories/freepik__candid-image-photography-natural-textures-highly-r__44004.jpeg', 'sdgsdgdfs', 'freepik__candid-image-photography-natural-textures-highly-r__44004.jpeg', 'asfdasdfsadf', 'sgsdfgfsdgsdfg', 'IMG-20240201-WA0018-01 (2).jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-17 11:09:09', '2024-10-17 11:09:09'),
(5, 'sdgdfgsfdg', 'মেয়েরা কিভাবে সলো ট্রাভেল করবেন', 'images/categories/solo.jpeg', 'সেন্ট মার্টিনে একজন নারীর জন্য নিরাপদ ভ্রমণ: করণীয় ও সতর্কতা', 'images/subcategories/solo.jpeg', 'sdfgsdfgsdfg', 'freepik__candid-image-photography-natural-textures-highly-r__44004.jpeg', 'sgsdfgsfdg', 'sgsdfgsdfg', '20240203_121040-01.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-17 11:10:57', '2024-10-17 11:10:57');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `image`, `category`, `created_at`, `updated_at`) VALUES
(17, 'images/categories/solo.jpeg', 'মেয়েরা কিভাবে সলো ট্রাভেল করবেন', '2024-10-16 08:45:38', '2024-10-16 08:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `photo`, `created_at`, `updated_at`) VALUES
(2, 'images/photos/solo.jpeg', '2024-10-16 08:38:09', '2024-10-16 08:38:09'),
(3, 'images/photos/safety.jpeg', '2024-10-16 08:40:35', '2024-10-16 08:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `subImage` varchar(255) NOT NULL,
  `subCategory` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `subImage`, `subCategory`, `created_at`, `updated_at`) VALUES
(4, 'images/subcategories/solo.jpeg', 'সেন্ট মার্টিনে একজন নারীর জন্য নিরাপদ ভ্রমণ: করণীয় ও সতর্কতা', '2024-10-16 08:46:07', '2024-10-16 08:46:07'),
(5, 'images/subcategories/freepik__candid-image-photography-natural-textures-highly-r__44004.jpeg', 'asdfasdfadsfasdfasdf', '2024-10-17 11:03:14', '2024-10-17 11:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `position` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `phone`, `position`, `password`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Rakib Gazi', 'obeo', 'webobeorooms@gmail.com', '01876987622', 'Senior Executive', 'Pass@12345', 'images/profile/gazi.png', '2024-05-13 12:41:17', '2024-07-22 06:20:05'),
(2, 'Md Gias Uddin', 'g4gias', 'g4gias@gmail.com', '01810004180', 'CEO', 'Pass@12345', 'images/profile/Gias_Anondo Color_May23 (2).jpg', '2024-05-14 12:30:18', '2024-07-22 06:07:52'),
(4, 'Ruqaiyah', '', 'rukiah@gmail.com', '01234567891', 'Senior Executive', 'Pass@12345', NULL, '2024-07-25 09:43:51', '2024-07-25 09:43:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
