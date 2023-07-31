-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2023 at 01:35 AM
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
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `LastName` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`LastName`, `FirstName`, `UserName`, `Password`, `Email`) VALUES
('sample', 'try', 'sampletry', 'trytry', 'sampletry@gmail.com'),
('Mujal', 'Joy', 'Joy Mujal', 'sibbaluca8', 'jsmujal@ndgm63.edu.ph'),
('Isidro', 'George', 'master', 'password', 'gjgisidro@gmail.com'),
('fgdsgf', 'fdgsdgfd', 'asfda', '1234', 'fgdsdg@gmail.com'),
('asdas', 'adsada', 'wer', '12345', 'sdasd@gmail.com'),
('try', 'try', 'try', '123456', 'try@gmail.com'),
('Dela Cruz', 'Juan', 'jdc123', '12345', 'jdc@gmail.com'),
('Cruz', 'Jericho', 'admin', '12345', 'jc@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
