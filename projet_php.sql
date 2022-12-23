-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 23 déc. 2022 à 15:18
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `pseudo` varchar(30) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `motDePasse` varchar(100) NOT NULL,
  `nmbCommentairesEcrits` int(11) DEFAULT NULL,
  PRIMARY KEY (`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`pseudo`, `nom`, `prenom`, `motDePasse`, `nmbCommentairesEcrits`) VALUES
('alcarreau', 'Carreau', 'Alexis', '$2y$10$4SkVI4FiSQrjLI6TgugR/ujDF5TSYPhnXfCUeYWFMTPEMapdCAxTu', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `date` date NOT NULL,
  `titre` varchar(50) NOT NULL,
  `contenu` varchar(250) NOT NULL,
  `image` varchar(50) NOT NULL,
  `nmbCommentaires` int(11) DEFAULT '0',
  PRIMARY KEY (`date`,`titre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`date`, `titre`, `contenu`, `image`, `nmbCommentaires`) VALUES
('2022-11-18', 'P1-J5 Departemental', 'Les resultats des championnats par equipe senior du jour !', '2022-11-18.jpg', 8),
('2022-11-12', 'P1-J4 National & Regional', 'Les resultats des championnats par equipe senior du jour !', '2022-11-12.jpg', 0),
('2022-11-11', 'P1-J4 Departemental', 'Les resultats des championnats par equipe senior du jour !', '2022-11-11.jpg', 0),
('2022-10-22', 'P1-J3 National & Regional', 'Les resultats des championnats par equipe senior du jour !', '2022-10-22.jpg', 1),
('2022-10-21', 'P1-J3 Departemental', 'Les resultats des championnats par equipe senior du jour !', '2022-10-21.jpg', 0),
('2022-10-07', 'P1-J2 Departemental', 'Les resultats des championnats par equipe senior du jour !', '2022-10-07.jpg', 0),
('2022-10-08', 'P1-J2 National & Regional', 'Les resultats des championnats par equipe senior du jour !', '2022-10-08.jpg', 0),
('2022-09-24', 'P1-J1 National & Regional', 'Les resultats des championnats par equipe senior du jour !', '2022-09-24.jpg', 0),
('2022-09-23', 'P1-J1 Departemental', 'Les resultats des championnats par equipe senior du jour !', '2022-09-23.jpg', 0),
('2022-11-26', 'P1-J6 National & Regional', 'Les resultats des championnats par equipe senior du jour !', '2022-11-26.jpg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `dateArticle` date NOT NULL,
  `titreArticle` varchar(50) NOT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `pseudo` varchar(30) NOT NULL,
  `contenu` varchar(250) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`dateArticle`,`titreArticle`,`pseudo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
