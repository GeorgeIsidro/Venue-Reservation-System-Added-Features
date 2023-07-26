-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2023 at 09:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `databasendgm`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `name` varchar(50) NOT NULL,
  `available_quantity` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`name`, `available_quantity`) VALUES
('Fender', 2),
('Podium', 4),
('Round Table', 40),
('Long Rectangular Table', 6),
('Monoblock Chairs', 1300),
('Wireless Microphone', 4),
('Wired Microphone', 6),
('Gooseneck Microphone', 4),
('Circular Platform', 2),
('Square Platform', 9),
('LED Lights', 10),
('RGB Lights', 8),
('Red Carpet', 4),
('Green Carpet', 2),
('Moving Heads', 4),
('Small Monoblock Table', 4),
('Big Monoblock Table', 6),
('Loose Board', 9),
('Big Movable White Board', 1),
('Small Movable White Board', 2),
('Brown Round Table Cloth', 36),
('White Round Table Cloth', 10),
('Monoblock Seat Cover', 370);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
