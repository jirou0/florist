-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 11:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(6) NOT NULL,
  `name` varchar(75) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(80) NOT NULL,
  `no_hp` int(13) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `question_forgot` varchar(50) NOT NULL,
  `answer_forgot` varchar(50) NOT NULL,
  `keahlian` varchar(255) NOT NULL,
  `jabatan` char(25) NOT NULL,
  `user_type` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(129, 14, 16, 'lavendor rose', 13, 1, 'lavendor rose.jpg'),
(130, 14, 18, 'red tulipa', 11, 1, 'red tulipa.jpg'),
(131, 14, 15, 'cottage rose', 15, 1, 'cottage rose.jpg'),
(132, 15, 13, 'pink rose', 10, 1, 'pink roses.jpg'),
(133, 15, 15, 'cottage rose', 15, 1, 'cottage rose.jpg'),
(134, 15, 16, 'lavendor rose', 13, 3, 'lavendor rose.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(13, 14, 'aurisa', 'aurisarabina@gmail.com', '089532887', 'hi,i like the pink roses.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(23, 23, 'user', '0895328870832', 'user@gmail.com', 'cash on delivery', 'flat no. jl. haha hihi, blok a, Jakarta Selatan, Indonesia - 123456', ' Bunga Mawar Ungu Mixed (1)  Bunga Hydrangiea Biru (1)  Bunga Tulip Ungu (1) ', 680, '07-Nov-2023', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image`) VALUES
(13, 'Bunga Tulip Pink', 'Bunga pink tullip dengan kertas chellopane putih, bisa request jumlah bunga, 1 bunga = 10K', 78, 'https://res.cloudinary.com/duzjaxkmo/image/upload/v1694474328/tulip.jpg'),
(15, 'Bunga Pink Daisy (single)', 'Bunga Pink Daisy bisa request warna kertas chellopane (hubungi) harga untuk custom kertas = 10K', 24, 'https://res.cloudinary.com/duzjaxkmo/image/upload/v1695005581/single-daisy_t9xhfh.png'),
(16, 'Buket Mawar Pink Mixed', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rem, nobis tenetur voluptatibus officiis odit minus fugit dolore accusantium fuga ipsa!', 295, 'https://res.cloudinary.com/duzjaxkmo/image/upload/v1695005445/pinkrose.png'),
(17, 'Bunga Tulip Ungu', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque error earum quasi facere optio tenetur.', 189, 'https://res.cloudinary.com/duzjaxkmo/image/upload/v1695008127/purple-tulips_dl070n.png'),
(18, 'Bunga Hydrangea Ungu', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rem, nobis tenetur voluptatibus officiis odit minus fugit dolore accusantium fuga ipsa!', 215, 'https://res.cloudinary.com/duzjaxkmo/image/upload/v1695008014/purple-hydrangea_wbmxv9.png'),
(19, 'Bunga Mawar Ungu Mixed', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque error earum quasi facere optio tenetur.', 304, 'https://res.cloudinary.com/duzjaxkmo/image/upload/v1695006588/purple-mix-rose_akabnw.png'),
(20, 'Bunga Tulip Biru', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque error earum quasi facere optio tenetur.', 24, 'https://res.cloudinary.com/duzjaxkmo/image/upload/v1695005669/blue-tulip_dnerln.png'),
(21, 'Bunga Hydrangiea Biru', 'Blue flowers', 187, 'https://res.cloudinary.com/duzjaxkmo/image/upload/v1695005884/bluehydrangiea.png'),
(22, 'Bunga Mawar Biru Miexd', 'blue roses', 325, 'https://res.cloudinary.com/duzjaxkmo/image/upload/v1695006240/blue%20roses.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `name` varchar(75) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(50) NOT NULL,
  `question_forgot` varchar(50) NOT NULL,
  `answer_forgot` varchar(50) NOT NULL,
  `user_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(60, 14, 19, 'pink bouquet', 15, 'pink bouquet.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
