-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.5.4-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for phpmotors
DROP DATABASE IF EXISTS `phpmotors`;
CREATE DATABASE IF NOT EXISTS `phpmotors` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `phpmotors`;

-- Dumping structure for table phpmotors.carclassification
DROP TABLE IF EXISTS `carclassification`;
CREATE TABLE IF NOT EXISTS `carclassification` (
  `classificationId` int(10) NOT NULL AUTO_INCREMENT,
  `classificationName` varchar(30) NOT NULL,
  PRIMARY KEY (`classificationId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table phpmotors.carclassification: ~5 rows (approximately)
DELETE FROM `carclassification`;
/*!40000 ALTER TABLE `carclassification` DISABLE KEYS */;
INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
	(1, 'SUV'),
	(2, 'Classic'),
	(3, 'Sports'),
	(4, 'Trucks'),
	(5, 'Used');
/*!40000 ALTER TABLE `carclassification` ENABLE KEYS */;

-- Dumping structure for table phpmotors.clients
DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `clientId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL,
  PRIMARY KEY (`clientId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table phpmotors.clients: ~0 rows (approximately)
DELETE FROM `clients`;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
	(1, 'Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', '3', 'I am the real Ironman');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Dumping structure for table phpmotors.inventory
DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `invId` int(10) NOT NULL AUTO_INCREMENT,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text DEFAULT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(10) NOT NULL,
  PRIMARY KEY (`invId`),
  KEY `classificationId` (`classificationId`),
  CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table phpmotors.inventory: ~15 rows (approximately)
DELETE FROM `inventory`;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
	(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. Its great for everyday driving as well as offroading weather that be on the the rocks or in the mud!', '/images/jeep-wrangler.jpg', '/images/jeep-wrangler-tn.jpg', 28045, 4, 'Orange', 1),
	(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want as long as it\'s black.', '/images/ford-modelt.jpg', '/images/ford-modelt-tn.jpg', 30000, 2, 'Black', 2),
	(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws. ', '/images/lambo-Adve.jpg', '/images/lambo-Adve-tn.jpg', 417650, 1, 'Blue', 3),
	(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. this beast comes with 60in tires giving you tracktions needed to jump and roll in the mud.', '/images/monster.jpg', '/images/monster-tn.jpg', 150000, 3, 'purple', 4),
	(5, 'Mechanic', 'Special', 'Not sure where this car came from. however with a little tlc it will run as good a new.', '/images/ms.jpg', '/images/ms-tn.jpg', 100, 200, 'Rust', 5),
	(6, 'Batmobile', 'Custom', 'Ever want to be a super hero? now you can with the batmobile. This car allows you to switch to bike mode allowing you to easily maneuver through trafic during rush hour.', '/images/bat.jpg', '/images/bat-tn.jpg', 65000, 2, 'Black', 3),
	(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of there 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/images/mm.jpg', '/images/mm-tn.jpg', 10000, 12, 'Green', 1),
	(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000 gallon tank.', '/images/fire-truck.jpg', '/images/fire-truck-tn.jpg', 50000, 2, 'Red', 4),
	(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equiped with the siren which is convenient for college students running late to class.', '/images/crown-vic.jpg', '/images/crown-vic-tn.jpg', 10000, 5, 'White', 5),
	(10, 'Chevy', 'Camaro', 'If you want to look cool this is the ar you need! This car has great performance at an affordable price. Own it today!', '/images/camaro.jpg', '/images/camaro-tn.jpg', 25000, 10, 'Silver', 3),
	(11, 'Cadilac', 'Escalade', 'This stylin car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/images/escalade.jpg', '/images/escalade-tn.jpg', 75195, 4, 'Black', 1),
	(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go offroading? The Hummer gives you the spacious interiors with an engine to get you out of any muddy or rocky situation.', '/images/hummer.jpg', '/images/hummer-tn.jpg', 58800, 5, 'Yellow', 5),
	(13, 'Aerocar International', 'Aerocar', 'Are you sick of rushhour trafic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get them while they last!', '/images/aerocar.jpg', '/images/aerocar-tn.jpg', 1000000, 6, 'Red', 2),
	(14, 'FBI', 'Survalence Van', 'do you like police shows? You\'ll feel right at home driving this van, come complete with survalence equipments for and extra fee of $2,000 a month. ', '/images/fbi.jpg', '/images/fbi-tn.jpg', 20000, 1, 'Green', 1),
	(15, 'Dog ', 'Car', 'Do you like dogs? Well this car is for you straight from the 90s from Aspen, Colorado we have the orginal Dog Car complete with fluffy ears.  ', '/images/dog.jpg', '/images/dog-tn.jpg', 35000, 1, 'Brown', 2);
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
