-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2021 at 09:11 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `real-estate-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad_type`
--

CREATE TABLE `ad_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ad_type`
--

INSERT INTO `ad_type` (`id`, `name`) VALUES
(8, 'sale'),
(9, 'rent'),
(10, 'compensation');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Tivat'),
(2, 'Kotor'),
(4, 'Ulcinj'),
(10, 'Budva'),
(12, 'Bar'),
(14, 'Herceg Novi'),
(15, 'Podgorica'),
(16, 'Bijelo Polje'),
(17, 'Berane'),
(18, 'Kolašin'),
(19, 'Žabljak'),
(20, 'Nikšić'),
(21, 'Cetinje'),
(22, 'Mojkovac'),
(23, 'Risan'),
(24, 'Danilovgrad'),
(25, 'Šavnik'),
(26, 'Plav'),
(28, 'Perast'),
(29, 'Plužine'),
(30, 'Pljevlja'),
(38, 'Andrijevica');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `realty_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `realty_id`, `name`) VALUES
(175, 68, './images/603bf80a2b8d9.jpg'),
(176, 68, './images/603bf80a2c31f.jpg'),
(177, 69, './images/603bf811a4400.jpg'),
(178, 71, './images/603bf819d0cf8.jpg'),
(179, 70, './images/603bf822c6d25.jpg'),
(180, 70, './images/603bf822c7b22.jpg'),
(181, 70, './images/603bf822c8671.jpg'),
(182, 66, './images/603bf82b22616.jpg'),
(183, 66, './images/603bf82b22c83.jpg'),
(184, 72, './images/603bf8381c6cd.jpg'),
(185, 72, './images/603bf8381d4d8.jpg'),
(186, 65, './images/603bf83f882fe.jpg'),
(187, 73, './images/603bf84db3ae3.jpg'),
(188, 64, './images/603bf857d1afb.jpg'),
(189, 75, './images/603bf861efe70.jpg'),
(190, 75, './images/603bf861f10a6.jpg'),
(191, 67, './images/603bf86b46ea9.jpg'),
(192, 74, './images/603bf8950d702.jpg'),
(193, 74, './images/603bf8950dcfa.jpg'),
(194, 74, './images/603bf8950e462.jpg'),
(195, 74, './images/603bf8950eb8f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `realties`
--

CREATE TABLE `realties` (
  `id` int(11) NOT NULL,
  `ad_type_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `realty_type_id` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `year_of_construction` year(4) NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `status` int(1) NOT NULL,
  `date_of_sale` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `realties`
--

INSERT INTO `realties` (`id`, `ad_type_id`, `city_id`, `realty_type_id`, `size`, `price`, `year_of_construction`, `description`, `status`, `date_of_sale`) VALUES
(64, 10, 24, 4, 56, '248', 1993, 'Pariatur Blanditiis', 2, '2021-02-19'),
(65, 9, 23, 1, 56, '448', 1982, 'Ut modi sed quis fac', 2, '2021-02-16'),
(66, 8, 25, 7, 3, '779', 1992, 'Praesentium incididu', 1, NULL),
(67, 8, 4, 7, 4, '228', 1981, 'Nihil praesentium ac', 2, '2016-01-03'),
(68, 10, 12, 1, 12, '682', 1991, 'Quibusdam et dolorem', 1, NULL),
(69, 9, 16, 2, 12, '988', 1974, 'Illo sed rerum do as', 1, NULL),
(70, 10, 12, 4, 31, '845', 1982, 'Quia ea dolore cillu', 1, NULL),
(71, 9, 1, 2, 92, '965', 2010, 'Dicta voluptas nemo ', 1, NULL),
(72, 9, 1, 7, 11, '325', 2012, 'Modi rem pariatur V', 1, NULL),
(73, 10, 20, 2, 46, '859', 1985, 'Ducimus vitae aliqu', 2, '2021-02-10'),
(74, 8, 22, 7, 48, '479', 1986, 'Veniam natus pariat', 1, NULL),
(75, 8, 17, 4, 71, '358', 1992, 'Incididunt ut dolore', 2, '2021-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `realty_type`
--

CREATE TABLE `realty_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `realty_type`
--

INSERT INTO `realty_type` (`id`, `name`) VALUES
(1, 'flat'),
(2, 'house'),
(3, 'garage'),
(4, 'office premises'),
(7, 'penthouse');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'available'),
(2, 'not available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad_type`
--
ALTER TABLE `ad_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_realty_id` (`realty_id`);

--
-- Indexes for table `realties`
--
ALTER TABLE `realties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ad_type_id` (`ad_type_id`),
  ADD KEY `fk_city_id` (`city_id`),
  ADD KEY `fk_realty_type_id` (`realty_type_id`),
  ADD KEY `fk_status` (`status`);

--
-- Indexes for table `realty_type`
--
ALTER TABLE `realty_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad_type`
--
ALTER TABLE `ad_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `realties`
--
ALTER TABLE `realties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `realty_type`
--
ALTER TABLE `realty_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `fk_realty_id` FOREIGN KEY (`realty_id`) REFERENCES `realties` (`id`);

--
-- Constraints for table `realties`
--
ALTER TABLE `realties`
  ADD CONSTRAINT `fk_ad_type_id` FOREIGN KEY (`ad_type_id`) REFERENCES `ad_type` (`id`),
  ADD CONSTRAINT `fk_city_id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `fk_realty_type_id` FOREIGN KEY (`realty_type_id`) REFERENCES `realty_type` (`id`),
  ADD CONSTRAINT `fk_status` FOREIGN KEY (`status`) REFERENCES `status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
