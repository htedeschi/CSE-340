-- --------------------------------------------------------
-- Host:                         127.0.0.1
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
  `classificationId` int(11) NOT NULL AUTO_INCREMENT,
  `classificationName` varchar(30) NOT NULL,
  PRIMARY KEY (`classificationId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table phpmotors.carclassification: ~7 rows (approximately)
DELETE FROM `carclassification`;
/*!40000 ALTER TABLE `carclassification` DISABLE KEYS */;
INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
	(1, 'SUV'),
	(2, 'Classic'),
	(3, 'Sports'),
	(4, 'Trucks'),
	(5, 'Used'),
	(12, 'High Class'),
	(13, 'Low Class');
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
  PRIMARY KEY (`clientId`),
  UNIQUE KEY `clientEmail` (`clientEmail`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table phpmotors.clients: ~0 rows (approximately)
DELETE FROM `clients`;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
	(1, 'Henrique', 'Tedeschi', 'henrique.tedeschi@gmail.com', '$2y$10$p.ZcSNMFizJ5yO3Od3S4MO3ei8tRt5fRHF2.r1zX/bV/m/xP.cKCq', '3', NULL);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Dumping structure for table phpmotors.images
DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `imgId` int(11) NOT NULL AUTO_INCREMENT,
  `invId` int(11) NOT NULL,
  `imgName` varchar(100) NOT NULL,
  `imgPath` varchar(150) NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`imgId`),
  KEY `FK__inventory` (`invId`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- Dumping data for table phpmotors.images: 36 rows
DELETE FROM `images`;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
	(1, 13, 'aerocar.jpg', '/phpmotors/assets/images/vehicles/aerocar.jpg', '2020-11-25 21:57:36', 1),
	(2, 13, 'aerocar-tn.jpg', '/phpmotors/assets/images/vehicles/aerocar-tn.jpg', '2020-11-25 21:57:36', 1),
	(3, 6, 'batmobile.jpg', '/phpmotors/assets/images/vehicles/batmobile.jpg', '2020-11-25 21:57:52', 1),
	(4, 6, 'batmobile-tn.jpg', '/phpmotors/assets/images/vehicles/batmobile-tn.jpg', '2020-11-25 21:57:52', 1),
	(5, 10, 'camaro.jpg', '/phpmotors/assets/images/vehicles/camaro.jpg', '2020-11-25 21:58:07', 1),
	(6, 10, 'camaro-tn.jpg', '/phpmotors/assets/images/vehicles/camaro-tn.jpg', '2020-11-25 21:58:07', 1),
	(7, 9, 'crwn-vic.jpg', '/phpmotors/assets/images/vehicles/crwn-vic.jpg', '2020-11-25 21:58:31', 1),
	(8, 9, 'crwn-vic-tn.jpg', '/phpmotors/assets/images/vehicles/crwn-vic-tn.jpg', '2020-11-25 21:58:31', 1),
	(9, 15, 'dog.jpg', '/phpmotors/assets/images/vehicles/dog.jpg', '2020-11-25 21:59:09', 1),
	(10, 15, 'dog-tn.jpg', '/phpmotors/assets/images/vehicles/dog-tn.jpg', '2020-11-25 21:59:09', 1),
	(11, 11, 'escalade.jpg', '/phpmotors/assets/images/vehicles/escalade.jpg', '2020-11-25 21:59:29', 1),
	(12, 11, 'escalade-tn.jpg', '/phpmotors/assets/images/vehicles/escalade-tn.jpg', '2020-11-25 21:59:29', 1),
	(13, 8, 'fire-truck.jpg', '/phpmotors/assets/images/vehicles/fire-truck.jpg', '2020-11-25 21:59:48', 1),
	(14, 8, 'fire-truck-tn.jpg', '/phpmotors/assets/images/vehicles/fire-truck-tn.jpg', '2020-11-25 21:59:48', 1),
	(15, 12, 'hummer.jpg', '/phpmotors/assets/images/vehicles/hummer.jpg', '2020-11-25 22:00:01', 1),
	(16, 12, 'hummer-tn.jpg', '/phpmotors/assets/images/vehicles/hummer-tn.jpg', '2020-11-25 22:00:01', 1),
	(17, 3, 'lambo-Adve.jpg', '/phpmotors/assets/images/vehicles/lambo-Adve.jpg', '2020-11-25 22:00:12', 1),
	(18, 3, 'lambo-Adve-tn.jpg', '/phpmotors/assets/images/vehicles/lambo-Adve-tn.jpg', '2020-11-25 22:00:12', 1),
	(19, 5, 'mechanic.jpg', '/phpmotors/assets/images/vehicles/mechanic.jpg', '2020-11-25 22:00:21', 1),
	(20, 5, 'mechanic-tn.jpg', '/phpmotors/assets/images/vehicles/mechanic-tn.jpg', '2020-11-25 22:00:21', 1),
	(21, 2, 'model-t.jpg', '/phpmotors/assets/images/vehicles/model-t.jpg', '2020-11-25 22:00:35', 1),
	(22, 2, 'model-t-tn.jpg', '/phpmotors/assets/images/vehicles/model-t-tn.jpg', '2020-11-25 22:00:35', 1),
	(23, 4, 'monster-truck.jpg', '/phpmotors/assets/images/vehicles/monster-truck.jpg', '2020-11-25 22:00:55', 1),
	(24, 4, 'monster-truck-tn.jpg', '/phpmotors/assets/images/vehicles/monster-truck-tn.jpg', '2020-11-25 22:00:55', 1),
	(25, 7, 'mystery-van.jpg', '/phpmotors/assets/images/vehicles/mystery-van.jpg', '2020-11-25 22:01:07', 1),
	(26, 7, 'mystery-van-tn.jpg', '/phpmotors/assets/images/vehicles/mystery-van-tn.jpg', '2020-11-25 22:01:07', 1),
	(27, 14, 'van.jpg', '/phpmotors/assets/images/vehicles/van.jpg', '2020-11-25 22:01:19', 1),
	(28, 14, 'van-tn.jpg', '/phpmotors/assets/images/vehicles/van-tn.jpg', '2020-11-25 22:01:19', 1),
	(29, 1, 'wrangler.jpg', '/phpmotors/assets/images/vehicles/wrangler.jpg', '2020-11-25 22:01:31', 1),
	(30, 1, 'wrangler-tn.jpg', '/phpmotors/assets/images/vehicles/wrangler-tn.jpg', '2020-11-25 22:01:31', 1),
	(31, 3, 'lambo-s.jpg', '/phpmotors/assets/images/vehicles/lambo-s.jpg', '2020-11-26 11:06:23', 0),
	(32, 3, 'lambo-s-tn.jpg', '/phpmotors/assets/images/vehicles/lambo-s-tn.jpg', '2020-11-26 11:06:23', 0),
	(33, 1, 'jeep.png', '/phpmotors/assets/images/vehicles/jeep.png', '2020-11-26 13:34:14', 0),
	(34, 1, 'jeep-tn.png', '/phpmotors/assets/images/vehicles/jeep-tn.png', '2020-11-26 13:34:14', 0),
	(35, 4, 'monster.jpg', '/phpmotors/assets/images/vehicles/monster.jpg', '2020-11-26 13:34:51', 0),
	(36, 4, 'monster-tn.jpg', '/phpmotors/assets/images/vehicles/monster-tn.jpg', '2020-11-26 13:34:51', 0);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

-- Dumping structure for table phpmotors.inventory
DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `invId` int(11) NOT NULL AUTO_INCREMENT,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text DEFAULT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL,
  PRIMARY KEY (`invId`),
  KEY `classificationId` (`classificationId`),
  CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table phpmotors.inventory: ~16 rows (approximately)
DELETE FROM `inventory`;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
	(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. Its great for everyday driving as well as offroading weather that be on the the rocks or in the mud!', '/assets/images/wrangler.jpg', '/assets/images/wrangler-tn.jpg', 28045, 4, 'Orange', 1),
	(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want as long as it\'s black.', '/assets/images/model-t.jpg', '/assets/images/model-t-tn.jpg', 30000, 2, 'Black', 2),
	(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws. ', '/assets/images/lambo-Adve.jpg', '/assets/images/lambo-Adve-tn.jpg', 417650, 1, 'Blue', 3),
	(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. this beast comes with 60in tires giving you tracktions needed to jump and roll in the mud.', '/assets/images/monster-truck.jpg', '/assets/images/monster-truck-tn.jpg', 150000, 3, 'purple', 4),
	(5, 'Mechanic', 'Special', 'Not sure where this car came from. however with a little tlc it will run as good a new.', '/assets/images/mechanic.jpg', '/assets/images/mechanic-tn.jpg', 100, 200, 'Rust', 5),
	(6, 'Batmobile', 'Custom', 'Ever want to be a super hero? now you can with the batmobile. This car allows you to switch to bike mode allowing you to easily maneuver through trafic during rush hour.', '/assets/images/batmobile.jpg', '/assets/images/batmobile-tn.jpg', 65000, 2, 'Black', 3),
	(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of there 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/assets/images/mystery-van.jpg', '/assets/images/mystery-van-tn.jpg', 10000, 12, 'Green', 1),
	(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000 gallon tank.', '/assets/images/fire-truck.jpg', '/assets/images/fire-truck-tn.jpg', 50000, 2, 'Red', 4),
	(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equiped with the siren which is convenient for college students running late to class.', '/assets/images/crwn-vic.jpg', '/assets/images/crwn-vic-tn.jpg', 10000, 5, 'White', 5),
	(10, 'Chevy', 'Camaro', 'If you want to look cool this is the ar you need! This car has great performance at an affordable price. Own it today!', '/assets/images/camaro.jpg', '/assets/images/camaro-tn.jpg', 25000, 10, 'Silver', 3),
	(11, 'Cadilac', 'Escalade', 'This stylin car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/assets/images/escalade.jpg', '/assets/images/escalade-tn.jpg', 75195, 4, 'Black', 1),
	(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go offroading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/assets/images/hummer.jpg', '/assets/images/hummer-tn.jpg', 58800, 5, 'Yellow', 5),
	(13, 'Aerocar International', 'Aerocar', 'Are you sick of rushhour trafic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get them while they last!', '/assets/images/aerocar.jpg', '/assets/images/aerocar-tn.jpg', 1000000, 6, 'Red', 2),
	(14, 'FBI', 'Survalence Van', 'do you like police shows? You\'ll feel right at home driving this van, come complete with survalence equipments for and extra fee of $2,000 a month. ', '/assets/images/van.jpg', '/assets/images/van-tn.jpg', 20000, 1, 'Green', 1),
	(15, 'Dog ', 'Car', 'Do you like dogs? Well this car is for you straight from the 90s from Aspen, Colorado we have the orginal Dog Car complete with fluffy ears.  ', '/assets/images/dog.jpg', '/assets/images/dog-tn.jpg', 35000, 1, 'Brown', 2),
	(27, 'VolksWagen', 'Buggy', 'BUGGY combines a 62-kWh battery pack with a 201-hp electric motor driving the rear wheels. On the road, the ID. BUGGY can reach 62 mph from rest in 7.2 seconds and travel up to an estimated 155 miles. ', '/assets/images/no-image.png', '/assets/images/no-image.png', 25000, 1, 'Green', 12);
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;

-- Dumping structure for table phpmotors.reviews
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `reviewId` int(11) NOT NULL AUTO_INCREMENT,
  `reviewText` text NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(11) NOT NULL,
  `clientId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`reviewId`),
  KEY `FK__inventory` (`invId`),
  KEY `FK__clients` (`clientId`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table phpmotors.reviews: 0 rows
DELETE FROM `reviews`;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
