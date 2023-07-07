-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2023 at 03:21 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

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
-- Table structure for table `equipment_reservation`
--

CREATE TABLE `equipment_reservation` (
  `reservation_id` int(10) NOT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `quantity` int(6) NOT NULL,
  `place` varchar(255) NOT NULL,
  `date_needed` date DEFAULT NULL,
  `date_reserved` date DEFAULT NULL,
  `contact_person` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipment_reservation`
--

INSERT INTO `equipment_reservation` (`reservation_id`, `equipment_name`, `quantity`, `place`, `date_needed`, `date_reserved`, `contact_person`, `sector`) VALUES
(9, 'Fender', 4, 'Dance Studio', '2023-07-07', '2023-07-07', 'George', 'SHS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipment_reservation`
--
ALTER TABLE `equipment_reservation`
  ADD PRIMARY KEY (`reservation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipment_reservation`
--
ALTER TABLE `equipment_reservation`
  MODIFY `reservation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
