-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 06:44 PM
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
(5, 'Tech in Agriculture', 'These are the better ways to use advanced technology in maize plantations', '2024-04-21 23:23:40', 'images (9).jpeg', 9);

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
(3, 5, 9);

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
(1, 'hello', 10, 9, '2024-04-21 20:39:14', 1),
(2, 'hi', 9, 10, '2024-04-21 20:39:48', 1),
(3, 'hello', 13, 9, '2024-04-22 00:04:42', 1),
(4, 'how are the prices on your side', 13, 9, '2024-04-22 00:05:06', 1),
(5, 'i buy 700 shs per Kg', 9, 13, '2024-04-22 00:07:10', 0),
(6, 'hello', 9, 11, '2024-04-22 00:09:26', 1),
(7, 'hello mum', 11, 9, '2024-05-15 10:10:46', 1);

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
(9, 'Ronald code', 'mutasabiti@gmail.com', 'MTIzNDU=', 'Buyer', 'download (1).jpeg', 'mutangizi', 'We are build to provide wonderful services to the people', 'coffeelogo.jpeg', 'Its okay', 'mutangizi.com', 790546246, 'Masaka', '2024-04-21 20:34:45', 1),
(10, 'Samosa', 'kagujje@gmail.com', 'MTIzNDU=', 'Service Provider', 'download (3).jpeg', 'Samosa and sons', 'This is a description', 'download (6).jpeg', 'we can', 'Samosa.com', 8767687, 'kampala', '2024-04-21 20:38:36', 1),
(11, 'Kintu Musa', 'mutasabit@gmail.com', 'MTIzNDU=', 'Seller', 'images.jpeg', 'kintu maize growers', 'We grow for the future', 'images.jpeg', 'We grow for future', 'kintumusa.com', 790546246, 'Mubende', '2024-04-21 20:45:23', 0),
(13, 'mubiru Musa', 'mubiru@gmail.com', 'MTIzNDU=', 'Buyer', 'download (4).jpeg', 'mubiru and sons maize dealers', ' We are well located in Jinja Town', 'download (4).jpeg', 'We grow for future', 'mubiru.com', 790546246, 'Jinja', '2024-04-22 00:03:09', 0);

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
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
