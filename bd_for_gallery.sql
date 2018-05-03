-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.46-log - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных bd_for_gallery
CREATE DATABASE IF NOT EXISTS `bd_for_gallery` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bd_for_gallery`;

-- Дамп структуры для таблица bd_for_gallery.image
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(50) NOT NULL DEFAULT '0',
  `name` char(50) NOT NULL DEFAULT '0',
  `description` char(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы bd_for_gallery.image: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` (`id`, `title`, `name`, `description`) VALUES
	(47, 'eyes.jpg', 'eyes.jpg', '0'),
	(48, 'wolf.jpg', 'wolf.jpg', '0');
/*!40000 ALTER TABLE `image` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
