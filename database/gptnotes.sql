-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 10:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gptnotes`
--

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `list_id` int(11) NOT NULL,
  `list` varchar(255) NOT NULL,
  `list_content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`list_id`, `list`, `list_content`) VALUES
(7, 'Summarize the content', 'You are GPTNotes , You will be provided content, and your task is to Summarize the content you are provided.'),
(8, 'Explain the content', 'You are GPTNotes ,You will be provided content, and your task is to Explain the content in simpler terms.');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `note_title` varchar(255) NOT NULL,
  `note_details` longtext NOT NULL,
  `note_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `list` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note_id`, `note_title`, `note_details`, `note_time`, `list`, `user_id`) VALUES
(16, 'ygagahgh hsh ', 'Some quick example text to build on the card title and make up the bulk of the card\'s content. Some quick example text to build on the card title and make up the bulk of the card\'s content.\r\nSome quick example text to build on the card title and make up the bulk of the card\'s content. Some quick example text to build on the card title and make up the bulk of the card\'s content.\r\n', '2024-01-10 23:52:20', 7, 3),
(22, 'explin', 'HTML (Hypertext Markup Language) is used for creating the structure of web pages. It is the backbone of a web page and is responsible for defining the content and layout of a website.\n\nCSS (Cascading Style Sheets) is used for styling the HTML content. It adds colors, fonts, images, and other design elements to the web page. CSS allows web developers to create visually appealing and attractive web pages.\n\nPHP (Hypertext Preprocessor) is a scripting language used on the server-side for creating dynamic web content. It is used to create interactive and dynamic elements on a website such as user login systems, forums, and e-commerce sites.\n\nMySQL is a database management system used to store data on a server. It provides a way to organize, retrieve, and update data in the backend of a website. It can be used alongside PHP to create a complete web application.', '2024-01-23 20:33:56', 8, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `notes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `UserName`, `password`, `email`, `phone`, `notes`) VALUES
(1, 'tawaf', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'tawaf@gmail.com', '212212121', 1),
(2, 'samia', '8cb2237d0679ca88db6464eac60da96345513964', 'gagagg@gmail.com', '12221', 1),
(3, 'ahmed', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'tad@gmail.com', '121221121', 1),
(4, 'samiii', '1d7068e0ebba37d9b545245e781508987e0fc59a', 'tad@gmail.com', '1221221', 1),
(5, 'lkjajljdlkjk', '7d37e379b76b1a9a56eaa2104a70ceb2f9758007', 'tad@gmail.com', '2211212', 1),
(6, 'jehad', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'tad@gmail.com', '212122', 1),
(7, 'asma', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'asma@gmail.com', '6165366121', 1),
(8, 'zxczxc', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'taas@gmail.com', '22121221', 1),
(9, 'layan', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'layan@gmail.com', '12121212122', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`list_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `taskFG1` (`list`),
  ADD KEY `taskFG2` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `taskFG1` FOREIGN KEY (`list`) REFERENCES `list` (`list_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `taskFG2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
