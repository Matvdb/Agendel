-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 06 jan. 2023 à 09:49
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `agendel`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `email`, `message`) VALUES
(1, 'test', 'test@gmail.com', 'ceci est un test'),
(2, 'test', 'admin@gmail.com', 'gdvqtdqshd5151@é');

-- --------------------------------------------------------

--
-- Structure de la table `elu`
--

DROP TABLE IF EXISTS `elu`;
CREATE TABLE IF NOT EXISTS `elu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `civilite` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `tel` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `elu`
--

INSERT INTO `elu` (`id`, `nom`, `prenom`, `civilite`, `role`, `email`, `password`, `tel`) VALUES
(4, 'Vanderbregt', 'Mathieu', '', '[\'ROLE_ADMIN\']', 'mathieuvanderbregt@gmail.com', '$2y$10$s/pvgT8tptEvnmXQEHEym.//C3mG5Cz9wwzSt2axy9O4s5QsGtUBi', '0624635241'),
(16, 'test', 'test', '', '', 'test@gmail.com', '$2y$10$8xT1sC0guo5DQgSZe8MuauJCuUbWFkRtcbfbLbX/CQ1YL9P9EIaJC', '0325362541'),
(20, 'azer', 'azer', '', '', 'azer@gmail.com', '$2y$10$NdWp1Une5GjvTzvIGpjKkO7PMJ95Eyoj.qWXD.t3/DgXGsl77u5Z2', '0325415685');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_evenement` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `lieux` varchar(100) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `avis` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id`, `nom_evenement`, `description`, `date_debut`, `date_fin`, `lieux`, `commentaire`, `avis`) VALUES
(1, 'Marché de Noel', 'test', '2023-01-13 15:24:00', '0000-00-00 00:00:00', 'Arras', '', ''),
(4, 'Test', 'test', '2023-01-08 09:21:00', '2023-01-07 09:21:00', 'Beaurains', '', ''),
(5, 'Test', 'test&&&&&&&&&0', '2023-01-08 09:21:00', '2023-01-07 09:21:00', 'Beaurains', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `role`, `nom`, `email`, `password`, `create_at`) VALUES
(1, 'admin', 'admin', 'administrateur@gmail.com', '$2y$10$3ZnwXA1hl0oSTOmnRC7KRu4jh0d8eVsZfIWpT.6nPuuvpb.MU96tW', '2023-01-06 08:31:26'),
(2, 'user', '', 'utilisateur@gmail.com', '$2y$10$3ZnwXA1hl0oSTOmnRC7KRu4jh0d8eVsZfIWpT.6nPuuvpb.MU96tW', '2021-08-05 05:49:01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
