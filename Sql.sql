-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6365
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for andrew
CREATE DATABASE IF NOT EXISTS `AndrewBackup` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `andrew`;

-- Dumping structure for table andrew.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `addedby` varchar(200) NOT NULL DEFAULT 'Mufasa the Great',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table andrew.admins: ~2 rows (approximately)
INSERT INTO `admins` (`id`, `username`, `password`, `addedby`) VALUES
	(1, 'mufasa', 'q', 'mufasa the great'),
	(9, 'csc', 'csc', 'Mufasa the Great');

-- Dumping structure for table andrew.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` varchar(50) NOT NULL,
  `create_datetime` varchar(50) NOT NULL,
  `title` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table andrew.category: ~5 rows (approximately)
INSERT INTO `category` (`id`, `time`, `create_datetime`, `title`) VALUES
	(1, '2021-11-02 04:10:41', '0000-00-00 00:00:00', ''),
	(3, '2021-11-02 04:10:27', '2021-11-02 03:27:57', 'News'),
	(27, 'November-05-2021 13:09', 'November-05-2021 13:09', 'Football'),
	(28, 'November-05-2021 13:10', 'November-05-2021 13:10', 'Crypto'),
	(29, 'November-05-2021 13:10', 'November-05-2021 13:10', 'Politics'),
	(30, 'November-05-2021 13:10', 'November-05-2021 13:10', 'Life');

-- Dumping structure for table andrew.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `comments` varchar(250) NOT NULL,
  `approvedby` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table andrew.comments: ~3 rows (approximately)
INSERT INTO `comments` (`id`, `datetime`, `name`, `email`, `comments`, `approvedby`, `status`, `post_id`) VALUES
	(1, '04-November-2021 13:43', 'Temitope', 'kingpeace12345@gmail.com', 'Jobs jobs jiobs', '', 'ON', 1),
	(2, '05-November-2021 13:31', '', '', 'fiojrpof,er', '', 'ON', 9),
	(3, '05-November-2021 13:32', 'Faboya Temitope James', 'kingpeace12345@gmail.com', 'wsgaegregergs', '', 'ON', 9);

-- Dumping structure for table andrew.post
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(250) NOT NULL DEFAULT '',
  `category` varchar(250) NOT NULL DEFAULT '',
  `author` varchar(250) NOT NULL DEFAULT '',
  `image` varchar(250) NOT NULL DEFAULT '',
  `postcontent` longtext NOT NULL,
  `email` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table andrew.post: ~2 rows (approximately)
INSERT INTO `post` (`id`, `datetime`, `title`, `category`, `author`, `image`, `postcontent`, `email`) VALUES
	(6, 'November-05-2021 06:31', 'Front End', 'News', 'Judikay', '638.siwes.jpg', '        Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi excepturi illo maxime dignissimos soluta reprehenderit consectetur, fugiat culpa minima, quisquam id odio ea aspernatur vitae harum expedita unde laudantium deserunt nulla a repudiandae. Assumenda.\r\n', 'judikay@hk'),
	(8, 'November-05-2021 06:43', 'PHP', 'News', 'Temitope', '333.siwes.jpg', '        Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi excepturi illo maxime dignissimos soluta reprehenderit consectetur, fugiat culpa minima, quisquam id odio ea aspernatur vitae harum expedita unde laudantium deserunt nulla a repudiandae. Assumenda.\r\n', 'kingpeace12345@gmail.com'),
	(9, 'November-05-2021 07:01', 'Jobs', 'Football', 'Jacob', '391.kel.jfif', '        Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi excepturi illo maxime dignissimos soluta reprehenderit consectetur, fugiat culpa minima, quisquam id odio ea aspernatur vitae harum expedita unde laudantium deserunt nulla a repudiandae. Assumenda.\r\n', 'king@gmail.com');

-- Dumping structure for table andrew.signup
CREATE TABLE IF NOT EXISTS `signup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `datestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  `nickname` varchar(250) NOT NULL,
  `headline` varchar(250) NOT NULL,
  `bio` longtext NOT NULL,
  `image` varchar(50) NOT NULL DEFAULT 'default.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table andrew.signup: ~4 rows (approximately)
INSERT INTO `signup` (`id`, `name`, `email`, `password`, `datestamp`, `status`, `nickname`, `headline`, `bio`, `image`) VALUES
	(1, 'Temitope', 'kingpeace12345@gmail.com', '$2y$10$wa73p60kQNJo1ITL5kMte.VhmnwHw9XcWP67RRdZ.IDmeB.LVO0qe', '2021-11-05 13:35:05', 1, 'reyjames', 'Master of all', 'titlenicknametitlenicknametitlenicknametitlenicknametitlenicknametitlenicknametitlenicknametitlenicknametitlenicknametitlenicknametitlenicknametitlenicknametitlenicknametitlenickname', '622.edo-state-university.jpg'),
	(2, 'Jayjay', 'jayjay@12', '$2y$10$/0mImGActVCPEeg5jRYz.uMWgp4ZK/6XwqovB90bthhod2j4.yPY.', '2021-11-05 05:26:10', 1, '', '', '', 'default.jpg'),
	(3, 'Ayotade God\'slove Busayo', 'judikay@hk', '$2y$10$tFFt0VebmDhvu0mp4es.XOh5wjIQ4lhvfRp.7Q9.wbOn8at0CcjkC', '2021-11-05 05:30:54', 1, 'judikay', 'Programmer', '        Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi excepturi illo maxime dignissimos soluta reprehenderit consectetur, fugiat culpa minima, quisquam id odio ea aspernatur vitae harum expedita unde laudantium deserunt nulla a repudiandae. Assumenda.\r\n', '562.edo-state-university.jpg'),
	(4, 'osifo', 'king@gmail.com', '$2y$10$AqjsXJrSEOtjGXI90ntt..TSSZRNf2NjYjz9BoQ1R6p.be6NoE3ym', '2021-11-05 06:01:21', 1, 'AI', 'IT Student', '        Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi excepturi illo maxime dignissimos soluta reprehenderit consectetur, fugiat culpa minima, quisquam id odio ea aspernatur vitae harum expedita unde laudantium deserunt nulla a repudiandae. Assumenda.\r\n', '697.repository-open-graph-template.png');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
