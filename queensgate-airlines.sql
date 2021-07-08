-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 31, 2020 at 11:33 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `queensgate-airlines`
--

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

DROP TABLE IF EXISTS `airports`;
CREATE TABLE IF NOT EXISTS `airports` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`id`, `name`, `location`, `lat`, `lng`) VALUES
(1, 'Manchester', 'Manchester', 53.353889, -2.275000),
(2, 'Charles de Gaulle', 'Paris', 49.009724, 2.547778),
(3, 'Heathrow', 'London', 51.477501, -0.461389),
(4, 'Liverpool John Lennon', 'Liverpool', 53.333611, -2.849722),
(5, 'Schiphol', 'Amsterdam', 52.308056, 4.764167),
(6, 'Frankfurt am Main', 'Frankfurt', 50.033333, 8.570556),
(7, 'Leonardo da Vinci–Fiumicino', 'Rome', 41.800278, 12.238889),
(8, 'Václav Havel', 'Prague', 50.100834, 14.260000),
(9, 'Stockholm Arlanda', 'Stockholm', 59.651943, 17.918612),
(10, 'Barcelona–El Prat Josep Tarradellas', 'Barcelona', 41.296944, 2.078333);

-- --------------------------------------------------------

--
-- Table structure for table `crew`
--

DROP TABLE IF EXISTS `crew`;
CREATE TABLE IF NOT EXISTS `crew` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_crew_role_role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crew`
--

INSERT INTO `crew` (`id`, `first_name`, `last_name`, `role_id`) VALUES
(1, 'Rena', 'Lund', 2),
(2, 'Daisy', 'Iqbal', 1),
(3, 'Tariq', 'Osan', 1),
(4, 'Melita', 'Wisam', 2),
(5, 'Candie', 'Hurrell', 2),
(6, 'Mary', 'Hussain', 2),
(7, 'Ginger', 'Kilty', 2),
(8, 'Sofia', 'Beche', 2),
(9, 'Lamond', 'Osbiston', 2),
(10, 'Ricardo', 'Kowalski', 2),
(11, 'Turner', 'Neillans', 2),
(12, 'Ranice', 'Gerrey', 2),
(13, 'Todd', 'Habbon', 2),
(14, 'Giff', 'Ellerbeck', 2),
(15, 'Ainslee', 'Campione', 2),
(16, 'Imran', 'Leethem', 2),
(17, 'Lianne', 'Moyne', 2),
(18, 'Frankie', 'Todd', 2),
(19, 'Collen', 'McMyler', 2),
(20, 'Bunnie', 'Fabbri', 1),
(21, 'Kerry', 'Patty', 2),
(22, 'Sadia', 'Burling', 2),
(23, 'Christian', 'Scutching', 2),
(24, 'Durant', 'Pooke', 2),
(25, 'Jed', 'Rabada', 1),
(26, 'Dorie', 'Tillerton', 1),
(27, 'Angelita', 'Bartosik', 1),
(28, 'Rickey', 'Quogan', 1),
(29, 'Rosalinde', 'Lohrensen', 2),
(30, 'Ethyl', 'Glashby', 1);

-- --------------------------------------------------------

--
-- Table structure for table `crew_flight`
--

DROP TABLE IF EXISTS `crew_flight`;
CREATE TABLE IF NOT EXISTS `crew_flight` (
  `crew_id` int(10) UNSIGNED NOT NULL,
  `flight_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`crew_id`,`flight_id`),
  KEY `fk_crew_flight__flight` (`flight_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crew_flight`
--

INSERT INTO `crew_flight` (`crew_id`, `flight_id`) VALUES
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(5, 2),
(6, 2),
(7, 2),
(20, 2),
(12, 3),
(13, 3),
(29, 3),
(30, 3),
(17, 4),
(18, 4),
(25, 4),
(29, 4),
(22, 5),
(23, 5),
(27, 5),
(29, 5),
(3, 6),
(9, 6),
(10, 6),
(11, 6);

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

DROP TABLE IF EXISTS `flights`;
CREATE TABLE IF NOT EXISTS `flights` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `origin_id` int(10) UNSIGNED NOT NULL,
  `destination_id` int(10) UNSIGNED NOT NULL,
  `departure_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_date` date NOT NULL,
  `arrival_time` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_flights_airports_origin_id` (`origin_id`),
  KEY `fk_flights_airports_destination_id` (`destination_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `origin_id`, `destination_id`, `departure_date`, `departure_time`, `arrival_date`, `arrival_time`) VALUES
(1, 1, 2, '2020-06-13', '10:00:00', '2020-06-13', '11:20:00'),
(2, 3, 2, '2020-07-27', '20:00:00', '2020-07-27', '21:23:00'),
(3, 1, 2, '2020-01-15', '10:00:00', '2020-01-16', '09:09:00'),
(4, 5, 7, '2020-07-10', '23:30:00', '2020-07-11', '00:45:00'),
(5, 9, 8, '2020-08-01', '02:15:00', '2020-08-01', '04:30:00'),
(6, 4, 5, '2020-08-01', '10:00:00', '2020-08-01', '11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Pilot'),
(2, 'Flight Attendant');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kate', 'k.l.hutton@assign3.ac.uk', '$2y$10$C8RsCwFPKUbhuWU9ze4p9e1TdjJxhUVKp/IJF9kpxzul9jgmDya36', 1, NULL, NULL, NULL),
(2, 'Yousef', 'y.miandad@assign3.ac.uk', '$2y$10$x7f9igWGzIUVJ4XcGxVbmO6LHe.HwLLGqR0aA6gllxMT50.POHMM.', 2, NULL, NULL, NULL),
(3, 'Sunil', 's.laxman@assign3.ac.uk', '$2y$10$JBaf7d66ishGUwGDcgSs.uNKyqTqEcdMzZgiPBvp5034wCB.hikKS', 1, NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crew`
--
ALTER TABLE `crew`
  ADD CONSTRAINT `fk_crew_role_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `crew_flight`
--
ALTER TABLE `crew_flight`
  ADD CONSTRAINT `fk_crew_flight__crew` FOREIGN KEY (`crew_id`) REFERENCES `crew` (`id`),
  ADD CONSTRAINT `fk_crew_flight__flight` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`);

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `fk_flights_airports_destination_id` FOREIGN KEY (`destination_id`) REFERENCES `airports` (`id`),
  ADD CONSTRAINT `fk_flights_airports_origin_id` FOREIGN KEY (`origin_id`) REFERENCES `airports` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
