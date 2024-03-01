-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum`;

-- Listage de la structure de table forum. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.category : ~6 rows (environ)
INSERT INTO `category` (`id_category`, `title`) VALUES
	(1, 'Art'),
	(2, 'Wild Life'),
	(3, 'Travel'),
	(4, 'Science'),
	(5, 'Food'),
	(6, 'Music');

-- Listage de la structure de table forum. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `textcontent` text NOT NULL,
  `creationdate` datetime NOT NULL,
  `user_id` int NOT NULL,
  `topic_id` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `FK_post_user` (`user_id`),
  KEY `FK_post_topic` (`topic_id`),
  CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.post : ~25 rows (environ)
INSERT INTO `post` (`id_post`, `textcontent`, `creationdate`, `user_id`, `topic_id`) VALUES
	(14, 'Alex posted this post', '2024-02-26 00:00:00', 5, 11),
	(15, 'hello', '2024-02-26 19:22:00', 5, 11),
	(16, 'test test test', '2024-02-26 19:23:51', 5, 11),
	(18, 'hello hello', '2024-02-26 20:45:46', 5, 12),
	(19, 'Dogs love cats', '2024-02-26 20:59:51', 5, 13),
	(20, 'I love dogs', '2024-02-26 21:01:06', 6, 13),
	(21, 'blabla cats', '2024-02-27 00:00:00', 6, 14),
	(22, 'Text Content snake', '2024-02-27 00:00:00', 5, 15),
	(23, 'hello wolrd', '2024-02-28 22:35:12', 8, 16),
	(24, 'web design is amazing', '2024-02-29 17:00:52', 6, 17),
	(25, 'Yes it ssss\r\n', '2024-02-29 17:02:02', 6, 17);

-- Listage de la structure de table forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `creationdate` datetime NOT NULL,
  `closed` tinyint(1) NOT NULL,
  `user_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `FK_topic_user` (`user_id`),
  KEY `FK_topic_category` (`category_id`),
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.topic : ~17 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationdate`, `closed`, `user_id`, `category_id`) VALUES
	(11, 'Whales', '2024-02-26 00:00:00', 1, 5, 2),
	(12, 'Rabbit', '2024-02-26 20:45:46', 1, 5, 2),
	(13, 'Dogs', '2024-02-26 20:59:51', 0, 5, 2),
	(14, 'Cats', '2024-02-27 00:00:00', 1, 6, 2),
	(15, 'Snake', '2024-02-27 00:00:00', 0, 5, 2),
	(16, 'Justine', '2024-02-28 22:35:12', 1, 8, 2),
	(17, 'Web Design', '2024-02-29 17:00:52', 0, 6, 2);

-- Listage de la structure de table forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` json NOT NULL,
  `banned` tinyint NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.user : ~5 rows (environ)
INSERT INTO `user` (`id_user`, `username`, `password`, `role`, `banned`, `avatar`) VALUES
	(5, 'Alex', '$2y$10$FUMK2vb8QnOo3lX8IbaEo.jU4muWZfgj2KITeL/x9V5ZA0I6jaIu2', '["ROLE_USER"]', 0, 'avatar3.jpg'),
	(6, 'Pauline', '$2y$10$PYw7yrmXdykshDvtQLyj3u0b9Z6Es4c6204zIVjUvC.ydQi5ykL7q', '["ROLE_ADMIN"]', 0, 'avatar2.jpg'),
	(7, 'Camille', '$2y$10$ysSAYvQDmdUqiExioivhKehWTsRnBnn5RIh0FQ4JSfv6gR9H686hO', '["ROLE_USER"]', 0, 'avatar1.jpg'),
	(8, 'Justine', '$2y$10$pFtZ4Y15sZIQUoKTwtyLsOys.yxjQeAri98eeUTYV/7hKexqlArbW', '["ROLE_USER"]', 0, '1709154593avatar4.jpg'),
	(9, 'Robby', 'Alexandre1604', '["ROLE_USER"]', 0, 'avatar5.jpg');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
