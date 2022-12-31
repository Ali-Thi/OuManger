-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql-pj-web-pb.alwaysdata.net
-- Generation Time: Dec 31, 2022 at 03:33 PM
-- Server version: 10.6.7-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pj-web-pb_database`
--

-- --------------------------------------------------------

--
-- Drop tables
--

DROP TABLE IF EXISTS commentaires;
DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS utilisateurs;
DROP TABLE IF EXISTS Commentaires;
DROP TABLE IF EXISTS Restaurants;
DROP TABLE IF EXISTS Utilisateurs;

--
-- Table structure for table `Commentaires`
--

CREATE TABLE `Commentaires` (
  `IdCommentaire` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `IdResto` int(11) NOT NULL,
  `Commentaire` text,
  `Note` int(11) NOT NULL,
  `DatePublication` date NOT NULL
) ;

--
-- Triggers `Commentaires`
--

DROP TRIGGER IF EXISTS note_restaurant_delete;
DROP TRIGGER IF EXISTS note_restaurant_insert;
DROP TRIGGER IF EXISTS note_restaurant_update;

DELIMITER $$
CREATE TRIGGER `note_restaurant_delete` AFTER DELETE ON `Commentaires` FOR EACH ROW UPDATE Restaurants
SET Note=(SELECT AVG(Note) FROM Commentaires WHERE IdResto=OLD.IdResto GROUP BY IdResto)
WHERE IdResto=OLD.IdResto
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `note_restaurant_insert` AFTER INSERT ON `Commentaires` FOR EACH ROW UPDATE Restaurants
SET Note=(SELECT AVG(Note) FROM Commentaires WHERE IdResto=NEW.IdResto GROUP BY IdResto)
WHERE IdResto=NEW.IdResto
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `note_restaurant_update` AFTER UPDATE ON `Commentaires` FOR EACH ROW UPDATE Restaurants
SET Note=(SELECT AVG(Note) FROM Commentaires WHERE IdResto=NEW.IdResto GROUP BY IdResto)
WHERE IdResto=NEW.IdResto
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Restaurants`
--

CREATE TABLE `Restaurants` (
  `IdResto` int(11) NOT NULL,
  `NomResto` varchar(50) NOT NULL,
  `Note` double DEFAULT NULL,
  `Adresse` varchar(100) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `IdUser` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `MotDePasse` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`IdUser`, `Nom`, `Prenom`, `Email`, `MotDePasse`) VALUES
(1, 'Talhaoui', 'Ali', 'ali.talhaoui@test.fr', 'testmdp'),
(2, 'Masson', 'Louis', 'louis.masson@test.fr', 'louis'),
(3, 'Albert', 'Renard', 'albert.renard@test.fr', 'testmdp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Commentaires`
--
ALTER TABLE `Commentaires`
  ADD PRIMARY KEY (`IdCommentaire`),
  ADD UNIQUE KEY `UNIQUE_COMMENTAIRE` (`IdUser`,`IdResto`,`Commentaire`) USING HASH,
  ADD KEY `FK_IdUser` (`IdUser`),
  ADD KEY `FK_IDRESTAURANT` (`IdResto`);

--
-- Indexes for table `Restaurants`
--
ALTER TABLE `Restaurants`
  ADD PRIMARY KEY (`IdResto`),
  ADD UNIQUE KEY `UNIQUE_RESTAURANT` (`NomResto`,`Adresse`) USING BTREE;

--
-- Indexes for table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`IdUser`),
  ADD UNIQUE KEY `UNIQUE_EMAIL` (`Email`),
  ADD UNIQUE KEY `UNIQUE_NOM_PRENOM` (`Nom`,`Prenom`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Commentaires`
--
ALTER TABLE `Commentaires`
  MODIFY `IdCommentaire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Restaurants`
--
ALTER TABLE `Restaurants`
  MODIFY `IdResto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for table `Restaurants`
--

ALTER TABLE `Restaurants`
  ADD CONSTRAINT `CHECK_NOTE` CHECK(Note <= 5);

--
-- Constraints for table `Commentaires`
--

ALTER TABLE `Commentaires`
  ADD CONSTRAINT `CHECK_NOTE` CHECK(Note <= 5);

ALTER TABLE `Commentaires`
  DROP CONSTRAINT IF EXISTS `FK_IDRESTAURANT`;

ALTER TABLE `Commentaires`
  DROP CONSTRAINT IF EXISTS `FK_IDRESTAURANT`;

ALTER TABLE `Commentaires`
  ADD CONSTRAINT `FK_IDRESTAURANT` FOREIGN KEY (`IdResto`) REFERENCES `Restaurants` (`IdResto`) ON DELETE CASCADE;

ALTER TABLE `Commentaires`
  ADD CONSTRAINT `FK_IdUser` FOREIGN KEY (`IdUser`) REFERENCES `Utilisateurs` (`IdUser`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
