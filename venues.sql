-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2023 at 09:55 AM
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
-- Database: `database1`
--

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `Name` varchar(255) NOT NULL,
  `Capacity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`Name`, `Capacity`) VALUES
('Main Gym', '1000'),
('Notre Dame Center for Performing Arts (NDCPA)', '300'),
('Barangay Court', '150'),
('SHS Covered Court', '150'),
('Dining Hall\r\n', '60'),
('De Mazenod Function Hall', '50'),
('Dance Studio', '30'),
('ES Basketball Court', 'To be confirmed'),
('Badminton Court', 'To be confirmed'),
('TLE Laboratory', 'To be confirmed'),
('Chapel', 'To be confirmed'),
('Business Office Lobby', 'To be confirmed'),
('ES Flagpole Area', 'To be confirmed'),
('Student\'s Lounge', 'To be confirmed'),
('Cookery', 'To be confirmed'),
('Jose Ante Lounge ', 'To be confirmed'),
('Kinder Playground', 'To be confirmed');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
