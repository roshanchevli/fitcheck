-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 07:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitcheck`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('unread','read','replied') DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `status`) VALUES
(1, 'Roshan Chevli', 'john@gmail.com', 'dsfs', 'dhgfhgffgh', '2025-12-02 09:33:07', 'read'),
(2, 'Roshan Chevli', 'chevlir115@gmail.com', 'dsfs', 'hello this is msg for chveking purspiose\r\n', '2025-12-02 09:34:44', 'read'),
(3, 'Roshan Chevli', 'chevlir115@gmail.com', 'dsfs', 'hello this is msg for chveking purspiose\r\n', '2025-12-02 09:35:09', 'unread'),
(6, 'raj', 'raj@gmail.com', 'product return', 'i want to return my product ', '2025-12-04 17:58:02', 'unread'),
(7, 'vanshita', 'vanshita@gmail.com', 'about shipping date', 'i want to know when will my order delivered?\r\n', '2025-12-04 18:00:42', 'unread'),
(8, 'ujval', 'ujval@gmail.com', 'product replacement', 'i want to replcae my tshirt', '2025-12-04 18:07:58', 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(70) NOT NULL,
  `cat_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_name`, `cat_pic`) VALUES
(30, 'Fitness Equipment', 'images/FITNESS AQUIPMENT 3D ICONS.jpg'),
(31, 'Supplements', 'images/Goli Supergreen Gummies are the perfect addition to your daily wellness routine 💚.jpg'),
(32, 'Health Monitoring ', 'images/Gemini_Generated_Image_xxzumfxxzumfxxzu.png'),
(33, 'Workout Wear', 'images/Gemini_Generated_Image_8e5wyy8e5wyy8e5w.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `oid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `pic` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `username` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`oid`, `pid`, `pname`, `pic`, `status`, `qty`, `price`, `username`) VALUES
(27, 20, 'Medical alert systems', 'images/68caf6b519bcc.jpg', 1, 3, 30, 'raj'),
(38, 10, 'Elliptical Trainer', 'images/68caebcf84401.png', 1, 3, 455, 'Roshan'),
(39, 22, 'Gym Bottom', 'images/68caf94a27cad.png', 1, 1, 10, 'Roshan'),
(40, 16, 'protein capsule', 'images/68caf2e79697c.jpg', 1, 1, 15, 'Roshan'),
(41, 21, 'Gym tshirt', 'images/68caf8200a18f.png', 1, 5, 10, 'Roshan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pid` int(11) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `pdesc` varchar(300) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `price` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pid`, `pname`, `pdesc`, `pic`, `price`, `category`) VALUES
(9, 'Treadmill', 'The treadmill has a digital display.', 'images/68cae96959ef4.png', '200', 'Fitness Equipment'),
(10, 'Elliptical Trainer', 'The elliptical machine with additional features', 'images/68caebcf84401.png', '455', 'Fitness Equipment'),
(11, 'Jump Rope', 'Jump Rope with best quality', 'images/68caec68daf20.jpg', '10', 'Fitness Equipment'),
(12, 'SkiErg ', 'enhance your fitness with SkiErg ', 'images/68caee138b156.jpg', '400', 'Fitness Equipment'),
(13, 'Stair Climber', 'Stair Climber with best quality', 'images/68caeef52ce82.jpg', '300', 'Fitness Equipment'),
(14, 'creatine', 'creatine for gain your muscles', 'images/68caf145cc576.jpg', '15', 'Supplements'),
(15, 'Protein', 'protein powder best quality', 'images/68caf2026af30.jpg', '30', 'Supplements'),
(16, 'protein capsule', 'protein capsule for fast gain your muscles', 'images/68caf2e79697c.jpg', '15', 'Supplements'),
(17, 'Heart Rate ban', 'Heart Rate ban with additional features', 'images/68caf4524b9b9.jpg', '15', 'Health Monitoring '),
(18, 'Blood Pressure (BP)', 'Blood Pressure (BP) machine', 'images/68caf4e2c68c6.jpg', '10', 'Health Monitoring '),
(19, 'Workout Tracking', 'Smart Workout Tracking Deivce', 'images/68caf5b6cc2ea.jpg', '30', 'Health Monitoring '),
(20, 'Medical alert systems', 'Medical alert systems', 'images/68caf6b519bcc.jpg', '30', 'Health Monitoring '),
(21, 'Gym tshirt', 'Gym tshirt with best febric', 'images/68caf8200a18f.png', '10', 'Workout Wear'),
(22, 'Gym Bottom', 'Gym Bottom best quality', 'images/68caf94a27cad.png', '10', 'Workout Wear'),
(23, 'Gym shoes', 'Gym shoes with best comfort', 'images/68caf9b4ae288.jpg', '50', 'Workout Wear'),
(24, 'Gym short', 'comfortable gym short', 'images/68cafb5583533.jpg', '20', 'Workout Wear');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobileno` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `email`, `mobileno`) VALUES
(6, 'Roshan', '123qwe', 'chevlir115@gmail.com', '1234567890'),
(7, 'sdfsdfsdf', '123qwe', 'chevlir115@gmail.com', '1234567890'),
(8, 'ruchi', '123qwe', 'ruchi@gmail.com', '1234567890'),
(9, 'raj', 'Raj123', 'raj@gmail.com', '1234567890'),
(10, 'Roshan', '123qwe', 'john@gmail.com', '1234567890'),
(11, 'jay', 'ryHF9nSs7vB4Xcc', 'jay@gmail.com', '8822993399');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `fname`, `lname`, `email`, `password`) VALUES
(1, 'roshan', 'chevli', 'r@gmail.com', 'roshan123'),
(2, 'Roshan', 'Chevli', 'roshanchevli@gmail.com', '123'),
(3, 'Roshan', 'Chevli', 'chevli@gmail.com', '$2y$10$mLTMecgyKAwab'),
(4, 'john', 'doe', 'john@gmail.com', '$2y$10$.SpXAw.52eDDj'),
(5, 'john', 'doe', 'j@gmail.com', 'john123'),
(6, 'ruchi', 'pagal', 'ruchi@gmail.com', 'ruchi123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
