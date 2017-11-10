-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2017 at 11:20 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studenti`
--
CREATE DATABASE IF NOT EXISTS `studenti` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `studenti`;

-- --------------------------------------------------------

--
-- Table structure for table `kursevi`
--

DROP TABLE IF EXISTS `kursevi`;
CREATE TABLE `kursevi` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL COMMENT 'Referenca na tablu studenata',
  `predmet_id` int(11) NOT NULL COMMENT 'Referenca na tabelu  predmeta',
  `prisustvo` int(11) NOT NULL COMMENT 'U poenima',
  `broj_casova` int(11) NOT NULL COMMENT 'U danima',
  `samostalni_zadaci` int(11) NOT NULL COMMENT 'Poeni',
  `kolokvijum_1_poeni` int(11) NOT NULL COMMENT 'Poeni',
  `kolokvijum_2_poeni` int(11) NOT NULL COMMENT 'Poeni',
  `kolokvijum_1_datum` date NOT NULL COMMENT 'Datum prvog kolokvijuma',
  `kolokvijum_2_datum` date NOT NULL COMMENT 'Datum drugog kolokvijuma',
  `pismeni_datum` date NOT NULL COMMENT 'Datum pismenog dela ispita.',
  `pismeni_poeni` int(11) NOT NULL COMMENT 'Broj poena na pismenom delu ispita.',
  `usmeni_datum` date NOT NULL COMMENT 'Datum usmenog dela ispita.',
  `usmeni_poeni` int(11) NOT NULL COMMENT 'Broj poena na usmenom delu ispital',
  `poeni_ukupno_do_usmenog` int(11) NOT NULL COMMENT 'Ukupan broj poena.',
  `poeni_zbir` int(11) NOT NULL COMMENT 'Ukupan zbir poena.',
  `ocena` int(11) NOT NULL,
  `napomene` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `predmeti`
--

DROP TABLE IF EXISTS `predmeti`;
CREATE TABLE `predmeti` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `opis` text NOT NULL,
  `fond_casova` int(11) NOT NULL DEFAULT '0',
  `profesor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `predmeti`
--

INSERT INTO `predmeti` (`id`, `ime`, `opis`, `fond_casova`, `profesor`) VALUES
(1, 'Osnovi taktike i gasenja pozara.', 'Kratak opis', 123, 'Barbara Vidakovic'),
(2, 'Fizika', 'Osnove fizike', 150, 'Barbara Vidakovic');

-- --------------------------------------------------------

--
-- Table structure for table `studenti`
--

DROP TABLE IF EXISTS `studenti`;
CREATE TABLE `studenti` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `broj_indeksa` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studenti`
--

INSERT INTO `studenti` (`id`, `ime`, `prezime`, `broj_indeksa`, `email`, `image`) VALUES
(8, 'Sinisa', 'Ristic', '34234234', 'sinisa.ristic@gmail.com', '/img/studenti/mala jaza.jpg'),
(9, 'Barbara', 'Vidakovic', '3412341234', 'barbaravid@yahoo.co.uk', '/img/studenti/barbara.png'),
(13, 'Jovan', 'Jovanovic', '2342341234', 'jovanjov@gmail.com', '/img/studenti/Patrick McCutcheon.jpg'),
(14, 'Mira', 'Markovic', '2342141234', 'mmark@gmail.com', '/img/studenti/Nadja Spitzer.jpg'),
(16, 'sfasdf', 'asdfasdfa', '5234523452', 'mma@gmail.com', '/img/studenti/Viola Gauci.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `studenti1`
--

DROP TABLE IF EXISTS `studenti1`;
CREATE TABLE `studenti1` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `broj_indeksa` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studenti1`
--

INSERT INTO `studenti1` (`id`, `ime`, `prezime`, `broj_indeksa`, `email`, `image`) VALUES
(0, 'Sinisa', 'Ristic', '242344', 'sinisa.ristic@gmail.com', 'mala jaza.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kursevi`
--
ALTER TABLE `kursevi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `predmet_id` (`predmet_id`);

--
-- Indexes for table `predmeti`
--
ALTER TABLE `predmeti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studenti`
--
ALTER TABLE `studenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `br_indeksa_email_uk` (`broj_indeksa`,`email`);

--
-- Indexes for table `studenti1`
--
ALTER TABLE `studenti1`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `br_indeksa_uk` (`broj_indeksa`),
  ADD UNIQUE KEY `email_uk` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `studenti`
--
ALTER TABLE `studenti`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `kursevi`
--
ALTER TABLE `kursevi`
  ADD CONSTRAINT `kursevi_predmeti_fk` FOREIGN KEY (`predmet_id`) REFERENCES `predmeti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
