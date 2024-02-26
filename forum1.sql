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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.post : ~20 rows (environ)
INSERT INTO `post` (`id_post`, `textcontent`, `creationdate`, `user_id`, `topic_id`) VALUES
	(1, 'Beautiful artwork !', '2024-02-21 18:59:09', 3, 1),
	(2, 'Love the colors!', '2024-02-21 18:59:40', 4, 1),
	(3, 'Amazing sculpture', '2024-02-21 19:00:42', 3, 2),
	(4, 'So detailed !', '2024-02-21 19:01:22', 4, 2),
	(5, 'Dolphins are so intelligent!', '2024-02-21 19:01:47', 3, 7),
	(6, 'Eiffel Tower is stunning!', '2024-02-21 19:02:08', 4, 3),
	(7, 'The guitar stands as an iconic instrument, weaving through genres from rock to classical, jazz to blues. Its six strings offer a palette of sounds, from deep, resonant tones to high-pitched melodies, enabling artists to express a range of emotions and stories. Whether it\'s the gentle strumming that accompanies a folk song, the electrifying solos in a rock concert, or the intricate fingerpicking of a classical piece, the guitar holds a unique place in music. It\'s not just an instrument; it\'s a companion to musicians, a tool for creativity, and a bridge between cultures, connecting listeners around the world with its universal language of rhythm and harmony.', '2024-02-21 19:02:49', 3, 4),
	(8, 'Guitar concerts are a mesmerizing showcase of talent and passion, where strings come alive under the fingers of virtuosos. These events range from intimate acoustic settings, where every pluck whispers a story, to grand electric arenas, where solos roar and resonate with the energy of the crowd. Attendees are not just spectators but part of a communal experience, united by the guitar\'s soul-stirring melodies. Each performance is a journey through emotions, genres, and cultures, making guitar concerts not merely musical events but celebrations of human expression and connection. Whether it\'s the raw emotion of blues, the sophistication of jazz, or the power of rock, guitar concerts offer an unparalleled adventure into the heart of music.', '2024-02-21 19:05:27', 4, 4),
	(9, 'Mozart\'s compositions are divine', '2024-02-21 19:05:52', 3, 5),
	(10, 'Pizza is a classic !', '2024-02-21 19:06:32', 3, 6),
	(11, 'Pasta is comforting!', '2024-02-21 19:06:56', 4, 6),
	(12, 'DNA is fascinating', '2024-02-21 19:10:39', 3, 8),
	(13, 'Evolution is amazing!', '2024-02-21 19:10:59', 3, 8),
	(14, 'Alex posted this post', '2024-02-26 00:00:00', 5, 11),
	(15, 'hello', '2024-02-26 19:22:00', 5, 11),
	(16, 'test test test', '2024-02-26 19:23:51', 5, 11),
	(17, 'Pauline Pauline ', '2024-02-26 19:35:44', 6, 1),
	(18, 'hello hello', '2024-02-26 20:45:46', 5, 12),
	(19, 'Dogs love cats', '2024-02-26 20:59:51', 5, 13),
	(20, 'I love dogs', '2024-02-26 21:01:06', 6, 13);

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.topic : ~13 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationdate`, `closed`, `user_id`, `category_id`) VALUES
	(1, 'Painting', '2024-02-21 18:52:27', 0, 1, 1),
	(2, 'Sculpture', '2022-03-21 18:52:45', 1, 2, 1),
	(3, 'Europe Trip', '2023-02-25 18:53:40', 1, 2, 3),
	(4, 'Rock Music', '2020-04-15 18:54:22', 0, 1, 6),
	(5, 'Classical Music', '2024-02-21 18:54:51', 1, 2, 6),
	(6, 'Italian Cuisine', '2022-02-21 18:55:28', 1, 1, 5),
	(7, 'Marine Life', '2022-02-21 18:56:33', 0, 1, 2),
	(8, 'Genetics', '2023-02-21 19:09:40', 1, 2, 4),
	(9, 'Photography', '2021-02-21 21:38:04', 1, 2, 1),
	(10, 'Digital Art', '2022-02-21 21:38:35', 0, 1, 1),
	(11, 'Whales', '2024-02-26 00:00:00', 1, 5, 2),
	(12, 'Rabbit', '2024-02-26 20:45:46', 1, 5, 2),
	(13, 'Dogs', '2024-02-26 20:59:51', 0, 5, 2);

-- Listage de la structure de table forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` json DEFAULT NULL,
  `is_banned` tinyint NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.user : ~7 rows (environ)
INSERT INTO `user` (`id_user`, `username`, `password`, `role`, `is_banned`) VALUES
	(1, 'ethan_carter', 'ethan_carter123', NULL, 0),
	(2, 'sophie_li', 'sophie_li123', NULL, 0),
	(3, 'noah_martinez', 'noah_martinez123', NULL, 0),
	(4, 'lily_anderson', 'lily_anderson123', NULL, 0),
	(5, 'Alex', '$2y$10$FUMK2vb8QnOo3lX8IbaEo.jU4muWZfgj2KITeL/x9V5ZA0I6jaIu2', '["ROLE_USER"]', 0),
	(6, 'Pauline', '$2y$10$gFXw4yDR.BoDXmAnWwIxcuxLZT4KqucLst5Qm.sDxk6XVW4n03lBK', '["ROLE_ADMIN"]', 0),
	(7, 'Camille', '$2y$10$ysSAYvQDmdUqiExioivhKehWTsRnBnn5RIh0FQ4JSfv6gR9H686hO', '["ROLE_ADMIN"]', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
