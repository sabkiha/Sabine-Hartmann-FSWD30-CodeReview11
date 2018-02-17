-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2018 at 03:56 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_sabine_hartmann_php_car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_id` int(11) NOT NULL,
  `car_model` varchar(255) NOT NULL,
  `car_color` varchar(255) NOT NULL,
  `car_year` int(11) NOT NULL,
  `car_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `car`:
--

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_id`, `car_model`, `car_color`, `car_year`, `car_image`) VALUES
(1, 'Fiat Uno', 'white', 2015, 'fiat-uno.jpg'),
(2, 'Ford Model T', 'black', 1925, 'ford-model-t.jpg'),
(3, 'Morris Mini', 'blue', 2016, 'morris-mini.jpg'),
(4, 'Renault Clio', 'yellow', 2013, 'renault-clio.jpg'),
(5, 'SEAT Ibiza', 'blue', 2016, 'seat-ibiza.jpg'),
(6, 'SEAT Ibiza', 'red', 2017, 'seat-ibiza2.jpg'),
(7, 'Toyota Corolla', 'red', 2018, 'toyota-corolla.jpg'),
(8, 'Volkswagen Golf', 'black', 2016, 'volskwagen-golf.jpg'),
(9, 'Volkswagen Golf', 'yellow', 2017, 'volskwagen-golf2.jpg'),
(10, 'Morris Mini', 'blue', 2018, 'morris-mini.jpg'),
(11, 'Fiat Uno', 'white', 2012, 'fiat-uno.jpg'),
(12, 'Renault Clio', 'yellow', 2016, 'renault-clio.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cars_at_offices`
--

CREATE TABLE `cars_at_offices` (
  `cars_at_office_id` int(11) NOT NULL,
  `fk_car_id` int(11) NOT NULL,
  `fk_office_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `cars_at_offices`:
--   `fk_car_id`
--       `car` -> `car_id`
--   `fk_office_id`
--       `office` -> `office_id`
--

--
-- Dumping data for table `cars_at_offices`
--

INSERT INTO `cars_at_offices` (`cars_at_office_id`, `fk_car_id`, `fk_office_id`) VALUES
(1, 1, 3),
(2, 7, 4),
(3, 2, 1),
(4, 3, 2),
(5, 10, 3),
(6, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `userID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `user_straat` varchar(255) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `customer`:
--

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`userID`, `userName`, `surname`, `userEmail`, `userPass`, `user_straat`, `user_city`, `user_dob`) VALUES
(1, 'Sabine', 'Hartmann', 'sabine@home.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Schulgasse', '1180 Wien', '1973-10-19'),
(2, 'Lotte', 'Coeckelbergh', 'lotte@home.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Schulgasse 73/15', 'Wien', '2007-10-22'),
(4, 'Jane', 'Austen', 'jane@home.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Pelikangasse', '1090 Wien', '1775-12-16'),
(5, 'Charles', 'Dickens', 'charles@home.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Park Lane', 'London NW1 2DB', '1812-02-07'),
(6, 'Harry', 'Potter', 'harry@home.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Diagon Alley', 'London NW1 2DB', '1980-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_point_in_time` time NOT NULL,
  `fk_car_id` int(11) NOT NULL,
  `location_street` varchar(255) NOT NULL,
  `location_city` varchar(255) NOT NULL,
  `location_latitude` varchar(255) NOT NULL,
  `location_longitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `location`:
--   `fk_car_id`
--       `car` -> `car_id`
--

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_point_in_time`, `fk_car_id`, `location_street`, `location_city`, `location_latitude`, `location_longitude`) VALUES
(1, '16:30:00', 9, 'Schulgasse 73', '1180 Wien', '48.226545', '16.336515'),
(2, '16:30:00', 12, 'Universit&#228;tsstra&#223;e 7', '1010 Wien', '48.214249', '16.357847'),
(3, '16:30:00', 6, 'Parkring', '1010 Wien', '48.205092', '16.378355'),
(4, '16:30:00', 5, 'Fritz-Gr&#252;nbaum-Platz 1', '1060 Wien', '48.197868', '16.352939'),
(5, '16:30:00', 4, 'Mozartplatz', '1040 Wien', '48.195433', '16.368330');

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `office_id` int(11) NOT NULL,
  `office_name` varchar(255) NOT NULL,
  `office_street` varchar(255) NOT NULL,
  `office_city` varchar(255) NOT NULL,
  `office_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `office`:
--

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`office_id`, `office_name`, `office_street`, `office_city`, `office_image`) VALUES
(1, 'Office Down Town', 'Br&#228;unerstra&#223;e 6', '1010 Wien', 'carrental01.jpg'),
(2, 'Office 09 Alsergrund', 'Porzellangasse 45', '1090 Wien', 'carrental02.jpg'),
(3, 'Office 03 Landstra&#223;e', 'Boerhaavegasse 20', '1030 Wien', 'carrental03.jpg'),
(4, 'Office 05 Margareten', 'Kettenbr&#252;ckengasse 19', '1050 Wien', 'carrental04.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `fk_car_id` int(11) NOT NULL,
  `fk_customer_id` int(11) NOT NULL,
  `fk_office_id` int(11) NOT NULL,
  `reservation_date_from` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `reservation`:
--   `fk_car_id`
--       `car` -> `car_id`
--   `fk_customer_id`
--       `customer` -> `userID`
--   `fk_office_id`
--       `office` -> `office_id`
--

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `fk_car_id`, `fk_customer_id`, `fk_office_id`, `reservation_date_from`) VALUES
(1, 1, 5, 2, '2018-02-18'),
(2, 2, 2, 1, '2018-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `users`:
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `cars_at_offices`
--
ALTER TABLE `cars_at_offices`
  ADD PRIMARY KEY (`cars_at_office_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`office_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cars_at_offices`
--
ALTER TABLE `cars_at_offices`
  MODIFY `cars_at_office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
