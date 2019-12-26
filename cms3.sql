-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2019 at 06:47 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms3`
--

-- --------------------------------------------------------

--
-- Table structure for table `catagories`
--

CREATE TABLE `catagories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catagories`
--

INSERT INTO `catagories` (`cat_id`, `cat_title`) VALUES
(3, 'PHP'),
(4, 'Java'),
(5, 'Dart'),
(88, 'Nodejs'),
(89, 'React'),
(90, 'Flutter'),
(98, 'django'),
(99, 'Dart'),
(100, 'samin');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(30, 58, 'Samin Yeaser', 'saminyeaser1@gmail.com', 'asdasdertwegsd', 'unapprove', '2019-11-09'),
(31, 58, 'Samin Yeaser', 'saminyeaser1@gmail.com', 'aSDWEQWEASDAS', 'approve', '2019-11-09');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(16, 57, 61),
(18, 36, 61),
(19, 37, 61),
(21, 36, 64);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_catagory_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tag` varchar(255) NOT NULL,
  `post_comment_count` int(255) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_view_count` int(100) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_catagory_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tag`, `post_comment_count`, `post_status`, `post_view_count`, `likes`) VALUES
(61, 4, 'Ai tehnology', 'Minhaj', '2019-11-27', 'Iqr8lBQ.jpg', '<p>awesome</p>', 'machine,neural, network,intelligence', 0, 'published', 2, 8),
(64, 3, 'Dart', 'samin', '2019-12-08', 'aa353bc5b436e430ad49115b7249a96a.jpg', '            hello world    ', 'dart, flutter, android, programming', 0, 'draft', 8, 1),
(65, 98, 'c programme', 'Arnisha', '2019-12-08', 'aa353bc5b436e430ad49115b7249a96a.jpg', 'programe based content', 'c, programming, android', 0, 'published', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomethinginteresti'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(36, 'samin', '$2y$12$TfdeaCGjINtolWRFMwGwS.SoSTjA9Q3tPhL59ncZbdzMOOHCoSgV.', 'Nehal', 'Neel', 'asd@g.com', '', 'Admin', '$2y$10$iusesomethinginteresti'),
(37, 'ujan', '$2y$12$4ttdzBUi7bpxZSdLRhRJ3.froLhAoANapLk4ZyrJjLNS6l6NUlJx.', 'irteza', 'uddin', 'asd@g.com', '', 'Subscriber', '$2y$10$iusesomethinginteresti'),
(38, 'inju', '$2y$10$hUNUNMaRoYvZY9eivlNVTezsy1S8tEhyZmSqF35snfdh6B4aUfvWO', '', '', 'inj@g.com', '', 'Subscriber', '$2y$10$iusesomethinginteresti'),
(39, 'Abid', '$2y$10$CFVSBQTyNtt5fKq07LhX0.U2ztvNquBsDJsAhm4xes/pANbPBCv7C', '', '', 'abid@gmail.com', '', 'Subscriber', '$2y$10$iusesomethinginteresti'),
(57, 'sazid', '$2y$10$8lMcUrmVYXnTChXN2KwNVuuqPPk9sCm4QFvz49eDAcrLhosTrhx6m', '', '', 'sa@gmail.com', '', 'Subscriber', '$2y$10$iusesomethinginteresti'),
(59, 'abdullah', '$2y$10$/NBMTHapGdkC3xHE7aOWceRERmttygn0UQsEC6ANXn024LIXMfQn6', '', '', 'sabdullah1@isrt.ac.bd', '', 'Subscriber', '$2y$10$iusesomethinginteresti'),
(60, 'tanvir', '$2y$10$4QdJlOYhs8bXyFENGFPDtu4MN8HbyUeHZC5DagGwaFLTy/d6DqeLe', '', '', 'mstanvir55@gmail.com', '', 'Subscriber', '$2y$10$iusesomethinginteresti'),
(61, 'BRACU', '$2y$10$Ga4fsGvF9P1rJL/BKlmLXu.JH0LZ9hBTsyAbnySibZBmwXabJsfsu', '', '', 'cse@bracu.com', '', 'Subscriber', '$2y$10$iusesomethinginteresti');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, 'ahlv63l0lcai98k1o6tevld9ad', 1572695721),
(2, 'g00q02ct60t6o3gm0nmm1eohbl', 1572693227),
(3, 'ub460c1vgsppeke6h9te1tlh2o', 1573286633),
(4, '60su3lp62ggresfdvh9dd7ftgt', 1573070522),
(5, 'fdq10ivbecl9ajjmrat0j16uhs', 1573070646),
(6, 'ourfd5fm2ui2mu1ej36uhs52cp', 1573070915),
(7, 'co93ahv5s1t8p84h1ecbc0otoi', 1573320480),
(8, 'po6te2pvk54qt8t5g8vj77bike', 1573586094),
(9, 'eitfahiq511rgob82m2ku907td', 1573758853),
(10, 'i9v1m5gsmgg82rdaboaav8vaca', 1574062607),
(11, 'bbalnq5hg3pu5qu8l8g9h2014l', 1575761959),
(12, 'fqepdblfj3863697fjatoiph88', 1574584326),
(13, 'lr89df6a1vrvevjg0j8k6c320f', 1574953760);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catagories`
--
ALTER TABLE `catagories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catagories`
--
ALTER TABLE `catagories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
