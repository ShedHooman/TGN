-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 03:49 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(26, 7, 2, 'Zera Chocolate', 75000, 1, 'menu-parfum2.png\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(100) NOT NULL,
  `fullname` varchar(26) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(18) NOT NULL,
  `status` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL,
  `about` text DEFAULT '',
  `job` varchar(20) DEFAULT NULL,
  `country` varchar(16) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `fullname`, `name`, `email`, `phone`, `status`, `password`, `level`, `about`, `job`, `country`, `address`, `profile_image`) VALUES
(3, 'Putra Ardiasnyah', 'gweh', 'email.putra@gmail.com', '041522010256', 'Active', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Customer Service', 'Karyawan Staff', 'staff', 'Indonesia', 'Jl. Buncit Raya No.98, RT.1/RW.7, Pejaten Bar., Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12510', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`, `timestamp`) VALUES
(1, 1, 'gweh', 'asdDs@asda.com', '0825806137', 'puh, ajarannya puhh', '2023-11-14 00:12:18');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(18) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(500) NOT NULL,
  `address` varchar(500) NOT NULL,
  `address2` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `categories` varchar(50) NOT NULL,
  `ingredient` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  `sold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `categories`, `ingredient`, `price`, `image`, `sold`) VALUES
(1, 'Blue Seduction', 'The initial impression upon spraying Blue Seduction is characterized by the top notes, introducing a refreshing', 'male', 'Alcohol and Parfum (Fragrance)', 50000, 'menu-parfum1.png\r\n', 3),
(2, 'Zera Chocolate', 'all other notes gradually fade away, the base notes in Zera Chocolate may encompass deeper and long-lasting elements such as wood or musk', 'male', 'Aqua (Water) and Benzyl Salicylate', 75000, 'menu-parfum2.png\r\n', 1),
(3, 'Versace Eros', 'Versace Eros aims to provide an enticing freshness with a touch of a striking and captivating aroma.', 'male', 'Linalool and Limonene', 85000, 'menu-parfum3.png\r\n', 0),
(4, 'H. Boss Orange', 'This fragrance is designed to reflect the courage and masculinity of the modern man.', 'male', 'Butyl and Limonene', 40000, 'menu-parfum4.png\r\n', 0),
(5, 'Cheese Cake', 'Cheese Cake aims to offer a captivating allure, grabbing attention with its distinctive and sensual aroma.', 'male', 'Geraniol and Coumarin', 70000, 'menu-parfum5.png', 0),
(6, 'Sauvage', 'Sauvage is chosen as a suitable option for various occasions, be it formal events or daily wear.', 'male', 'Butyl and Hydroxycitronellal', 60000, 'menu-parfum6.png', 0),
(7, 'Caramel Popcorn', 'Creating a sweet, warm, and enticing aroma reminiscent of caramel and popcorn.', 'female', 'Benzyl Benzoate and Pentaerythrityl', 50000, 'menu-parfum7.png\r\n', 33),
(8, 'BVL Extreme', 'Bvlgari (BVL) Extreme aims to provide an intense, captivating, and long-lasting olfactory experience.', 'female', 'Geraniol and Coumarin', 75000, 'menu-parfum8.png', 0),
(9, 'Eternity Women', 'Eternity Women is renowned for its elegant and contemporary fragrance, characterized by a blend of floral and oriental elements.', 'female', 'Benzyl Alcohol and Triethyl Citrate', 85000, 'menu-parfum9.png', 0),
(10, 'Black XS', 'Black XS is often used to boost self-confidence and enhance the mood of the wearer.', 'female', 'Farnesol and Benzyl Alcohol', 40000, 'menu-parfum10.png', 3),
(11, 'Kenzo Bali', 'Kenzo Bali can enhance confidence by providing a comforting and pleasing scent that makes individuals feel better about themselves.', 'female', 'Coumarin and Citral', 70000, 'menu-parfum11.png', 20),
(12, 'Creed Aventus', 'Creed Aventus is designed to provide a distinctive and unique aromatic experience with oriental woody undertones.', 'female', 'Anise Alcohol and Citronellol', 40000, 'menu-parfum12.png', 6);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `review` text NOT NULL,
  `rating` int(1) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `pid`, `user_id`, `name`, `username`, `review`, `rating`, `date_added`) VALUES
(1, 7, 7, 'Caramel Popcorn', 'admin', 'tes1', 4, '2024-07-08 08:19:22'),
(2, 7, 7, 'Caramel Popcorn', 'admin', 'tes2', 3, '2024-07-08 20:09:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fullname` varchar(64) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(18) NOT NULL,
  `status` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL,
  `about` text DEFAULT NULL,
  `job` varchar(20) DEFAULT NULL,
  `country` varchar(16) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `phone`, `status`, `password`, `level`, `about`, `job`, `country`, `address`, `profile_image`) VALUES
(6, 'kriss', 'krisna aprian', 'krisnawirawan57@gmail.com', '08158061371', 'Active', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'consument', NULL, NULL, NULL, NULL, NULL),
(7, 'admin', 'admin', 'admin@gmail.com', '123', 'Active', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Super Admin', '', NULL, NULL, '', NULL),
(8, 'tes2', 'tes2', 'tes2@gmail.com', '123', 'Active', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Marketing', '', NULL, NULL, '', NULL),
(9, 'tes3', 'tes3', 'tes3@gmail.com', '123', 'Disabled', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'consument', NULL, NULL, NULL, NULL, NULL),
(10, '123', '123', '123@123', '123', '', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'consument', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
