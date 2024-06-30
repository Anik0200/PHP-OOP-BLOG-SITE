-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 21, 2023 at 01:07 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oop_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_table`
--

CREATE TABLE `category_table` (
  `cid` int NOT NULL,
  `cname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category_table`
--

INSERT INTO `category_table` (`cid`, `cname`) VALUES
(1, 'Travel'),
(2, 'Food'),
(3, 'Music'),
(4, 'Nature');

-- --------------------------------------------------------

--
-- Table structure for table `comment_table`
--

CREATE TABLE `comment_table` (
  `cmtId` int NOT NULL,
  `userId` int DEFAULT NULL,
  `postId` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `admin_reply` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status` int NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comment_table`
--

INSERT INTO `comment_table` (`cmtId`, `userId`, `postId`, `name`, `email`, `message`, `admin_reply`, `status`, `create_time`) VALUES
(2, 2, 2, 'Anik', 'anik@gmail.com', 'HiIm Anik', 'Hey Bro', 1, '2023-10-14 16:20:36'),
(3, 2, 2, 'Ayanna Mckinney', 'zofohaq@mailinator.com', 'Tempora et perspicia', NULL, 1, '2023-10-14 16:44:17'),
(6, 1, 1, 'Keefe Montoya', 'jigehaj@mailinator.com', 'Consequatur ad qui', 'zdfgawrg', 1, '2023-10-15 10:22:25'),
(7, 1, 1, 'Juliet Kim', 'poqynawevu@mailinator.com', 'Odit rerum ea unde p', 'Hello', 1, '2023-10-15 10:22:29'),
(12, 1, 5, 'Buckminster Long', 'tazyleg@mailinator.com', 'Sed mollitia beatae', NULL, 1, '2023-10-16 16:20:59'),
(13, 1, 4, 'Quamar Beasley', 'sigefyse@mailinator.com', 'Magna rem dolorum ma', 'asdasd', 1, '2023-10-16 16:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `post_table`
--

CREATE TABLE `post_table` (
  `postid` int NOT NULL,
  `userid` int DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `catId` int DEFAULT NULL,
  `imgOne` varchar(200) NOT NULL,
  `descOne` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `imgTwo` varchar(200) NOT NULL,
  `descTwo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `postType` int NOT NULL DEFAULT '0',
  `tags` varchar(50) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post_table`
--

INSERT INTO `post_table` (`postid`, `userid`, `title`, `catId`, `imgOne`, `descOne`, `imgTwo`, `descTwo`, `postType`, `tags`, `status`, `create_time`) VALUES
(1, 1, 'Blythe', 1, '5fa8247ee2.jpg', 'Culpa ipsam nihil e', 'e43dc1b638.jpg', 'Sed hic qui fugiat e', 1, 'Keelie', 1, '2023-10-12 06:49:21'),
(2, 2, 'Barbara', 1, '3a78b1f887.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias similique nisi eos accusantium, incidunt, architecto dolorem, magnam rerum dolores nobis recusandae ea? Libero nihil, neque fugiat ullam magni, voluptatem obcaecati ipsum quisquam, perferendis dolores quod iste eaque numquam suscipit? Ad modi veritatis incidunt nostrum error voluptatum nulla porro ex laboriosam quo quibusdam facilis alias, nobis ut mollitia recusandae provident molestias laborum! Distinctio autem quibusdam quod quia ipsam harum inventore magnam voluptate et quis nemo, omnis molestiae, dolor nulla culpa sequi expedita cupiditate, tenetur natus adipisci eaque dolorem quos molestias? Magnam deleniti animi ea? Fugiat ea minus itaque saepe nihil nobis.', 'b5682b0f7a.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias similique nisi eos accusantium, incidunt, architecto dolorem, magnam rerum dolores nobis recusandae ea? Libero nihil, neque fugiat ullam magni, voluptatem obcaecati ipsum quisquam, perferendis dolores quod iste eaque numquam suscipit? Ad modi veritatis incidunt nostrum error voluptatum nulla porro ex laboriosam quo quibusdam facilis alias, nobis ut mollitia recusandae provident molestias laborum! Distinctio autem quibusdam quod quia ipsam harum inventore magnam voluptate et quis nemo, omnis molestiae, dolor nulla culpa sequi expedita cupiditate, tenetur natus adipisci eaque dolorem quos molestias? Magnam deleniti animi ea? Fugiat ea minus itaque saepe nihil nobis.', 1, 'Nevada', 1, '2023-10-12 06:56:55'),
(4, 1, 'Graham', 2, 'd4e7319286.jpg', 'Nemo sit dolor nihil', '3d0295f7af.jpg', 'Enim debitis qui pra', 0, 'Lucian', 1, '2023-10-16 14:03:17'),
(5, 1, 'Nissim', 3, 'f7aca9d377.jpg', 'Corporis maxime et v', '140edcebfc.jpg', 'In ex ut et anim lab', 1, 'Desirae', 1, '2023-10-16 14:04:05'),
(6, 1, 'Pamela', 4, '316b17746d.jpg', 'Temporibus facere qu', '589d72c416.jpg', 'Neque illo ullam dui', 0, 'Garrison', 0, '2023-10-16 14:04:50'),
(7, 2, 'Lee', 2, '837f2e0b31.png', 'Quo ullam consectetu', '9967c2c572.png', 'Reprehenderit quia', 0, 'Vladimir', 1, '2023-10-16 14:06:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `name`, `phone`, `email`, `password`) VALUES
(1, 'tajbin anik', '1729101989', 'tajbinanik02@gmail.com', '1234'),
(2, 'nafiz', '185-8736', 'nafiz@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `comment_table`
--
ALTER TABLE `comment_table`
  ADD PRIMARY KEY (`cmtId`);

--
-- Indexes for table `post_table`
--
ALTER TABLE `post_table`
  ADD PRIMARY KEY (`postid`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_table`
--
ALTER TABLE `category_table`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment_table`
--
ALTER TABLE `comment_table`
  MODIFY `cmtId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `post_table`
--
ALTER TABLE `post_table`
  MODIFY `postid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
