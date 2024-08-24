-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2024 at 04:29 PM
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
-- Database: restaurant
--

CREATE TABLE menu (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  description text NOT NULL,
  price int(11) NOT NULL,
  category varchar(50) NOT NULL,
  status tinyint(4) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(30) NOT NULL,
  password varchar(30) NOT NULL,
  discount int(11) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE orders (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(11) DEFAULT NULL,
  order_date datetime NOT NULL DEFAULT current_timestamp(),
  total_price int(11) NOT NULL,
  payment_method varchar(50) NOT NULL,
  PRIMARY KEY (id),
  KEY user_id (user_id),
  CONSTRAINT orders_ibfk_1 FOREIGN KEY (user_id) REFERENCES users (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE order_items (
  id int(11) NOT NULL AUTO_INCREMENT,
  order_id int(11) NOT NULL,
  menu_item_id int(11) NOT NULL,
  quantity int(11) NOT NULL,
  item_price decimal(10,2) NOT NULL,
  PRIMARY KEY (id),
  KEY order_id (order_id),
  KEY menu_item_id (menu_item_id),
  CONSTRAINT order_items_ibfk_1 FOREIGN KEY (order_id) REFERENCES orders (id),
  CONSTRAINT order_items_ibfk_2 FOREIGN KEY (menu_item_id) REFERENCES menu (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table menu
--

INSERT INTO menu (id, name, description, price, category, status) VALUES
(1, 'Dim Sum Dish', 'Dim sum dumplings with crisp carrots and cool lettuce.', 200, 'appetizer', 1),
(2, 'Stuffed Mushrooms', 'Baked mushroom caps filled with cream cheese, garlic, and herbs', 120, 'appetizer', 1),
(3, 'Buffalo Wings', 'Spicy chicken wings coated in a zesty buffalo sauce.', 270, 'appetizer', 1),
(4, 'Crab Cakes', 'Golden-brown patties made from fresh crab meat, mixed with herbs and spices.', 200, 'appetizer', 1),
(5, 'Escargot', 'Tender snails cooked in a rich garlic and herb butter sauce.', 300, 'appetizer', 1),
(6, 'Mixed Sashimi Set', 'A variety of raw fish, served with dipping sauce.', 200, 'appetizer', 1),
(7, 'Beef Salad', 'Tender beef liver stir-fried with onions and tomatoes.', 200, 'main-course', 1),
(8, 'Filet Mignon', 'A tender cut of beef, seared to perfection and served with a rich red wine.', 300, 'main-course', 1),
(9, 'Ratatouille', 'Casserole of thinly sliced vegetables seasoned with herbs and olive oil.', 320, 'main-course', 1),
(10, 'Rack of Lamb', 'Tender lamb ribs crusted with herbs and breadcrumbs, roasted to perfection.', 350, 'main-course', 1),
(11, 'Beef Wellington', 'A beef tenderloin coated with pâté and duxelles, wrapped in puff pastry.', 400, 'main-course', 1),
(12, 'Grilled Salmon', 'Salmon fillet grilled and served with roasted vegetables.', 300, 'main-course', 1),
(13, 'Ice Cream Sundae', 'Creamy scoops of ice cream topped with chocolate syrup, and whipped cream.', 50, 'dessert', 1),
(14, 'Crème Brûlée', 'A rich custard topped with a layer of hard caramel.', 250, 'dessert', 1),
(15, 'Tiramisu', 'Layers of coffee-soaked ladyfingers and mascarpone cheese, dusted with cocoa powder.', 250, 'dessert', 1),
(16, 'Molten Lava Cake', 'A chocolate cake with a gooey, molten center, served with vanilla ice cream.', 180, 'dessert', 1),
(17, 'Cheesecake', 'A creamy, smooth cheese filling on a graham cracker crust, topped with fresh berries.', 170, 'dessert', 1),
(18, 'Apple Pie', 'Apple pie topped with vanilla ice cream and a drizzle of caramel sauce.', 150, 'dessert', 1);

--
-- Dumping data for table users
--

INSERT INTO users (id, username, password, discount) VALUES
(1, 'user', 'user', 10),
(2, 'user2', 'user2', 10);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;