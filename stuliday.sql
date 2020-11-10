-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 10 nov. 2020 à 13:41
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stuliday`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

DROP TABLE IF EXISTS `annonces`;
CREATE TABLE IF NOT EXISTS `annonces` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `author` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`ad_id`),
  KEY `author_fk` (`author`),
  KEY `category_fk` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`ad_id`, `title`, `content`, `address`, `city`, `price`, `images`, `author`, `category_id`) VALUES
(6, 'appart t 2', ' t 2 so beautifull', 'Bordeaux', NULL, 60, NULL, 1, 2),
(8, 'versaille', 'ici c\'est pas versaille', 'paris', NULL, 1, NULL, 1, 3),
(10, 'l\'Ã®les de la reunion', 'Une superbe îles', '974', NULL, 1, NULL, 1, 4),
(12, 'Saumure', 'Un chateau de merde', 'paris', NULL, 3, NULL, 1, 3),
(18, 'la corse', 'C\'est comme la sicile mais en plus corse', 'corse', NULL, 135, NULL, 5, 4);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_name` varchar(255) NOT NULL,
  PRIMARY KEY (`categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`) VALUES
(1, 'Maison'),
(2, 'Appartement'),
(3, 'Château'),
(4, 'Plage privée');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `resa_id` int(11) NOT NULL AUTO_INCREMENT,
  `resa_user_id` int(11) NOT NULL,
  `resa_ad_id` int(11) NOT NULL,
  PRIMARY KEY (`resa_id`),
  KEY `client_fk` (`resa_user_id`),
  KEY `annonces_fk` (`resa_ad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fullname`) VALUES
(1, 'j.boussemart1@hotmail.fr', '$2y$10$1CMSw.1XdBxPJ/ddLPpkQuAF.YXatGzxwd68lc4aEsU6NY6/CFbym', NULL),
(2, 'test2@test.fr', '$2y$10$GIDFSEtfAS1x6dxX2miNq.C1oJpqeL2fZzqI2JGIjM6ZQL0m6BIFa', NULL),
(4, 'test4@test.fr', '$2y$10$kYUQTYmk.YXK4EZuRllVMu9DWVMw3G6jyizsv28BU2tjI1Qp.S77C', NULL),
(5, 'test5@test.fr', '$2y$10$AkAY6UjxlLeC0jodeFxrCO8BNoaquyOohNJViS9xOJtHG8J9r/lhq', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `author_fk` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`categories_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `annonces_fk` FOREIGN KEY (`resa_ad_id`) REFERENCES `annonces` (`ad_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `client_fk` FOREIGN KEY (`resa_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
