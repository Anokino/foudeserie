-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mar. 21 mars 2023 à 16:05
-- Version du serveur : 10.6.5-MariaDB
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `nloizeau-foudeserie`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20221109083601', '2022-11-09 08:38:33', 407),
('DoctrineMigrations\\Version20230308075912', '2023-03-08 07:59:34', 45),
('DoctrineMigrations\\Version20230308080212', '2023-03-08 08:02:22', 28);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `libelle`) VALUES
(1, 'Action'),
(2, 'Aventure'),
(3, 'animé'),
(4, 'romance'),
(5, 'science-fiction'),
(6, 'horeure'),
(7, 'histoire vrai'),
(8, 'comedie');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `serie`
--

DROP TABLE IF EXISTS `serie`;
CREATE TABLE IF NOT EXISTS `serie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duree` time DEFAULT NULL,
  `premiereDiffusion` date DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `serie`
--

INSERT INTO `serie` (`id`, `titre`, `resume`, `duree`, `premiereDiffusion`, `image`, `likes`) VALUES
(1, 'Dragon Ball', 'un enfant étrangement fort à la recherche de mystérieuse boules de cristale', '14:40:00', '2017-02-26', 'http://www.anime-kun.net/animes/anim_img/dragon-ball-552-475.png', 44),
(2, 'Dragon Ball Z', 'La suite des folles aventures de son Goku est de ces amis', '16:40:00', '1989-04-26', 'http://www.anime-kun.net/animes/anim_img/dragon-ball-z-297-279.png', 3),
(3, 'Dragon Ball GT', 'Une suite non canon des aventures de son goku et ces amis.', '25:59:00', '1996-02-07', 'https://img1.ak.crunchyroll.com/i/spire2/f9fb623496136ec595edb8476df6915d1647329350_main.jpg', 61),
(33, 'test1', 'resume1', '01:03:00', '2018-03-05', 'image1', 0);

-- --------------------------------------------------------

--
-- Structure de la table `serie_genre`
--

DROP TABLE IF EXISTS `serie_genre`;
CREATE TABLE IF NOT EXISTS `serie_genre` (
  `serie_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`serie_id`,`genre_id`),
  KEY `IDX_4B5C076CD94388BD` (`serie_id`),
  KEY `IDX_4B5C076C4296D31F` (`genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `serie_genre`
--

INSERT INTO `serie_genre` (`serie_id`, `genre_id`) VALUES
(1, 1),
(1, 3),
(33, 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `serie_genre`
--
ALTER TABLE `serie_genre`
  ADD CONSTRAINT `FK_4B5C076C4296D31F` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4B5C076CD94388BD` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
