use maize;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2024 at 09:19 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maize`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `body` varchar(1000) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `image` varchar(200) DEFAULT NULL,
  `addedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `title`, `body`, `date`, `image`, `addedBy`) VALUES
(2, 'Maize', 'its okay to grow maize', '2024-03-28 11:29:50', 'abast.jpg', 2),
(3, 'iz technologies', 'always the best', '2024-04-17 20:10:24', 'iz logo1.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `blogId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `blogId`, `userId`) VALUES
(1, 3, 3),
(2, 2, 3),
(3, 3, 3),
(4, 2, 3),
(5, 2, 3),
(6, 2, 3),
(7, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `sender` int(11) DEFAULT NULL,
  `receiver` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `seen` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `sender`, `receiver`, `date`, `seen`) VALUES
(1, 'fffff', 3, 2, '2024-04-17 19:33:57', 0),
(2, 'hello mum', 3, 1, '2024-04-17 19:46:17', 0),
(3, 'jhgfd', 1, 3, '2024-04-20 16:26:15', 0),
(4, 'jhgfd', 1, 3, '2024-04-20 16:26:31', 0),
(5, 'hello', 1, 3, '2024-04-20 16:29:44', 0),
(6, 'hello', 1, 2, '2024-04-20 16:38:16', 0),
(7, '', 1, 3, '2024-04-20 16:46:22', 0),
(8, '', 3, 2, '2024-04-20 16:54:23', 0),
(9, 'muda', 3, 2, '2024-04-20 16:55:11', 0),
(10, 'muda', 3, 2, '2024-04-20 16:55:28', 0),
(11, 'kkk', 3, 1, '2024-04-20 17:00:29', 0),
(12, 'kkkh', 3, 1, '2024-04-20 17:02:40', 0),
(13, 'fffff', 3, 1, '2024-04-20 17:05:38', 0),
(14, '', 3, 1, '2024-04-20 17:15:25', 0),
(15, '', 3, 2, '2024-04-20 17:19:06', 0),
(16, '', 3, 2, '2024-04-20 17:23:05', 0),
(17, 'hello', 3, 2, '2024-04-20 17:28:31', 0),
(18, 'hello', 6, 3, '2024-04-20 19:32:32', 0),
(19, 'hello', 6, 8, '2024-04-20 19:43:39', 0),
(20, 'muda', 8, 6, '2024-04-20 19:44:00', 0),
(21, 'hello mum', 6, 8, '2024-04-20 19:44:10', 0),
(22, 'kkk', 8, 6, '2024-04-20 19:44:25', 0),
(23, 'jhgfd', 6, 8, '2024-04-20 19:44:31', 0),
(24, 'rtt', 8, 6, '2024-04-20 21:07:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `role` varchar(100) DEFAULT 'buyer',
  `image` varchar(200) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `motto` varchar(1000) DEFAULT NULL,
  `website` varchar(1000) DEFAULT NULL,
  `contact` int(11) DEFAULT NULL,
  `location` varchar(1000) DEFAULT NULL,
  `dateAdded` datetime DEFAULT current_timestamp(),
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `image`, `company`, `description`, `logo`, `motto`, `website`, `contact`, `location`, `dateAdded`, `admin`) VALUES
(2, 'Samosa', 'kagujje@gmail.com', '1234', 'Seller', 'moze1.jpg', 'zt', 'yes okay', 'whatsapp.png', 'we can', 'zt.com', 8767687, 'kampala', '2024-03-28 11:22:52', 0),
(3, 'Ronald code', 'mutasabit@gmail.com', '12345', 'Buyer', 'jamila.png', 'mutangizi', 'This is a sample description of my business', 'jamila.png', 'Its okay', 'mutangizi.com', 790546246, 'Masaka', '2024-04-17 19:26:34', 1),
(6, 'Ronald code', 'mutasabiti@gmail.com', 'MTIzNDU=', 'Buyer', 'iz logo1.png', 'Iz', 'always', 'hero-bg.jpg', 'Its okay', 'mutangizi.com', 790546246, 'kampala', '2024-04-20 17:38:08', 1),
(8, 'Samosa', 'kagujje1@gmail.com', 'MTIzNDU=', 'Seller', 'download (2).jpeg', 'zt', 'fddbfdshsfghfdgf', 'images (11).jpeg', 'Its okay', 'iz.com', 790546246, 'kampala', '2024-04-20 19:38:17', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `addedBy` (`addedBy`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogId` (`blogId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`addedBy`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`blogId`) REFERENCES `blogs` (`blog_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
