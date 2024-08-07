-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2024 at 01:24 PM
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
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `price`, `category`, `status`) VALUES
(1, 'Dim Sum Dish', 'Dim sum dumplings with crisp carrots and cool lettuce.', 200, 'appetizer', 1),
(2, 'Beef Salad', 'Tender beef liver stir-fried with onions and tomatoes.', 200, 'main-course', 1),
(3, 'Ice Cream Sundae', 'Creamy scoops of ice cream topped with rich chocolate syrup, whipped cream, and a cherry on top.', 50, 'dessert', 1),
(4, 'Stuffed Mushrooms', 'Baked mushroom caps filled with cream cheese, garlic, and herbs', 120, 'appetizer', 1),
(5, 'Buffalo Wings', 'Spicy chicken wings coated in a zesty buffalo sauce.', 270, 'appetizer', 1),
(6, 'Crab Cakes', 'Golden-brown patties made from fresh crab meat, mixed with herbs and spices.', 200, 'appetizer', 1),
(7, 'Escargot', 'Tender snails cooked in a rich garlic and herb butter sauce.', 300, 'appetizer', 1),
(8, 'Filet Mignon', 'A tender cut of beef, seared to perfection and served with a rich red wine.', 300, 'main-course', 1),
(9, 'Ratatouille', 'Casserole of thinly sliced vegetables seasoned with herbs and olive oil.', 320, 'main-course', 1),
(10, 'Rack of Lamb', 'Tender lamb ribs crusted with herbs and breadcrumbs, roasted to perfection.', 350, 'main-course', 1),
(11, 'Crème Brûlée', 'A rich custard topped with a layer of hard caramel.', 250, 'dessert', 1),
(12, 'Tiramisu', 'Layers of coffee-soaked ladyfingers and mascarpone cheese, dusted with cocoa powder.', 250, 'dessert', 1),
(13, 'Molten Lava Cake', 'A chocolate cake with a gooey, molten center, served warm with a scoop of vanilla ice cream.', 180, 'dessert', 1),
(14, 'Cheesecake', 'A creamy, smooth cheese filling on a graham cracker crust, topped with fresh berries.', 170, 'dessert', 1),
(15, 'Beef Wellington', 'A beef tenderloin coated with pâté and duxelles, wrapped in puff pastry.', 400, 'main-course', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `discount`) VALUES
(1, 'user', 'user', 10),
(2, 'user2', 'user2', 0),
(3, 'user3', 'user3', 0),
(4, 'user4', 'user4', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
