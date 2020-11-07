-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 04 nov. 2020 à 12:05
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mediaphoto`
--
DROP DATABASE IF EXISTS mediaphoto;

CREATE DATABASE IF NOT EXISTS mediaphoto;

USE mediaphoto;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL UNIQUE,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL UNIQUE,
  `motPasse` varchar(255) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUser`, `username`, `nom`, `prenom`, `mail`, `motPasse`) VALUES
(1, 'toufiktaha', 'TOUFIK', 'Taha', 'taha@mail.com', '12345678910'),
(2, 'souayassin', 'SOUA', 'Yassin', 'yassin@mail.com', '12345678910'),
(3, 'ramirezricardo', 'RAMIREZ', 'Ricardo', 'ricardo@mail.com', '12345678910'),
(4, 'pinonjulieta', 'PINON', 'Julieta', 'julieta@mail.com', '12345678910'),
(5, 'wintersteinantonin', 'WINTERSTEIN', 'Antonin', 'anto@mail.com', '12345678910'),
(6, 'kelmouahicham', 'KELMOUA', 'Hicham', 'hich@mail.com', '12345678910'),
(7, 'boumazaamine', 'BOUMAZA', 'Amine', 'amine@mail.com', '12345678910'),
(8, 'bonifaceyann', 'BONIFACE', 'Yann', 'yann@mail.com', '12345678910'),
(9, 'geromecanals', 'GEROME', 'Canals', 'canals@mail.com', '12345678910'),
(10, 'mahdaouihamza', 'MAHDAOUI', 'Hamza', 'hamza@mail.com', '12345678910');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `idPhoto` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `motsCles` varchar(255) NULL,
  `metaDonnees` mediumtext NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idPhoto`),
  FOREIGN KEY(`idUser`) REFERENCES utilisateur(`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`idPhoto`, `nom`, `motsCles`, `metaDonnees`, `idUser`) VALUES
(1, 'photo1', 'Nature', "", 1),
(2, 'photo2', 'Nature', "", 2),
(3, 'photo3', 'Nature', "", 3),
(4, 'photo4', 'Nature', "", 4),
(5, 'photo5', 'Sport', "", 5),
(6, 'photo6', 'Sport', "", 6),
(7, 'photo7', 'Sport', "", 7),
(8, 'photo8', 'Tech', "", 8),
(9, 'photo9', 'Tech', "", 9);

-- --------------------------------------------------------

--
-- Structure de la table `galerie`
--

CREATE TABLE `galerie` (
  `idGalerie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `motsCles` varchar(255) NULL,
  `type` int(11) NOT NULL,		-- 0 = publique | 1 = protegée | 2 = privée
  `dateCreation` date NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idGalerie`),
  FOREIGN KEY(`idUser`) REFERENCES utilisateur(`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `galerie`
--

INSERT INTO `galerie` (`idGalerie`, `nom`, `description`, `motsCles`, `type`, `dateCreation`, `idUser`) VALUES
(1, 'galerie1', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 'Nature', 0, '0000-00-00', 1),
(2, 'galerie2', 'Lorem Palamoer laNour IutNcPalamLorem PalamoerLorem Palam laNouLorem Palamr PLorem Palamalamoer laNour', 'Nature', 1, '0000-00-00', 1),
(3, 'galerie3', 'Lorem Palamoer laNour IutNcPalamLorem PalamoerLorem Palam laNouLorem Palamr PLorem Palamalamoer laNour', 'Nature', 1, '0000-00-00', 1),
(4, 'galerie4', 'Lorem Palamoer laNour IutNcPalamLorem PalamoerLorem Palam laNouLorem Palamr PLorem Palamalamoer laNour', 'Nature', 1, '0000-00-00', 1),
(5, 'galerie5', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 'Nature', 0, '0000-00-00', 2),
(6, 'galerie6', 'Lorem Palamoer laNour IutNcPalamLorem PalamoerLorem Palam laNouLorem Palamr PLorem Palamalamoer laNour', 'Sport', 1, '0000-00-00', 2),
(7, 'galerie7', 'Lorem Palamoer laNour IutNcPalamLorem PalamoerLorem Palam laNouLorem Palamr PLorem Palamalamoer laNour', 'Tech', 1, '0000-00-00', 2),
(8, 'galerie8', 'Lorem Palamoer laNour IutNcPalamLorem PalamoerLorem Palam laNouLorem Palamr PLorem Palamalamoer laNour', 'Tech', 2, '0000-00-00', 2),
(9, 'galerie9', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 'Tech', 0, '0000-00-00', 3),
(10, 'galerie10', 'Lorem Palamoer laNour IutNcPalamLorem PalamoerLorem Palam laNouLorem Palamr PLorem Palamalamoer laNour', 'Nature', 1, '0000-00-00', 3),
(11, 'galerie11', 'Lorem Palamoer laNour IutNcPalamLorem PalamoerLorem Palam laNouLorem Palamr PLorem Palamalamoer laNour', 'Sport', 1, '0000-00-00', 3),
(12, 'galerie12', 'Lorem Palamoer laNour IutNcPalamLorem PalamoerLorem Palam laNouLorem Palamr PLorem Palamalamoer laNour', 'Tech', 2, '0000-00-00', 3),
(13, 'galerie13', 'Lorem Palamoer laNour IutNcPalamLorem PalamoerLorem Palam laNouLorem Palamr PLorem Palamalamoer laNour', 'Sport', 1, '0000-00-00', 3),
(14, 'galerie14', 'DescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescription', 'Nature', 2, '0000-00-00', 3),
(15, 'galerie14', 'DescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescription', 'Nature', 0, '0000-00-00', 4),
(16, 'galerie15', 'Lorem Palamoer laNour IutNcPalamLorem PalamoerLor Palamoer laNour IutNcPalamLorem PalamoerLorem Palam laNouLorem Palamr PLorem Palamalamoer laNour Palamoer laNour IutNcPalamLorem PalamoerLorem Palam laNouLorem Palamr PLorem Palamalamoer laNourLorem Palamalamoer laNour', 'Nature', 1, '0000-00-00', 4);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `idCommentaire` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` text NOT NULL,
  `idGalerie` int(11) NULL,
  `idPhoto` int(11) NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idCommentaire`),
  FOREIGN KEY(`idGalerie`) REFERENCES galerie(`idGalerie`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(`idPhoto`) REFERENCES photo(`idPhoto`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(`idUser`) REFERENCES utilisateur(`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`idCommentaire`, `commentaire`, `idGalerie`, `idPhoto`, `idUser`) VALUES
(1, 'LoremDesp KLoremDesp KAloum lanxjdoau ssLoremDespLoremDesp KAloum lanxjdoau ss KAloum lanxjdoau ssAloum lanxjdoau ss', 1, NULL, 1),
(2, 'MOLERremDesp KAloum lanxjdoau ssLoremDespLoremDesp KAloum lanxjdoau ss KAloum lanxjdoau ssAloum lanxjdoau ss', 1, 1, 2),
(3, 'Bonjouuuuuuuuuuuur', 2, 4, 3),
(4, 'Le sport est bien pour notre santé', 6, NULL, 5),
(5, 'La nature est belle', 7, 6, 4),
(6, 'La technologie, c\'est le future', 3, 2, 2),
(7, 'Hello , thank you everyone', 8, 5, 6),
(8, 'Je vais commenté la photo 3', NULL, 3, 7),
(9, 'Je commente la galerie 4', 4, NULL, 8),
(10, 'Je commente la galerie 5', 5, NULL, 7),
(11, 'Je commente la galerie 9', 9, NULL, 7),
(12, 'encore un commentaire pour la photo 6', NULL, 6, 4),
(13, 'Et un commentaire pour la photo 7', NULL, 7, 4),
(14, 'Commentaire bien fait!', NULL, 4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `idGroupe` int(11) NOT NULL AUTO_INCREMENT,
  `idGalerie` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `typeUser` bool NOT NULL,  -- false = créateur | true = hôte 
  PRIMARY KEY (`idGroupe`),
  FOREIGN KEY(`idGalerie`) REFERENCES galerie(`idGalerie`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(`idUser`) REFERENCES utilisateur(`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`idGroupe`, `idGalerie`, `idUser`, `typeUser`) VALUES
(1, 1, 1, false),
(2, 1, 2, true),
(3, 1, 3, true),
(4, 1, 4, true),
(5, 2, 2, false),
(6, 2, 5, true),
(7, 2, 6, true),
(8, 2, 7, true),
(9, 3, 3, false),
(10, 3, 8, true),
(11, 3, 9, true),
(12, 3, 1, true),
(13, 4, 4, false),
(14, 4, 2, true),
(15, 4, 3, true),
(16, 4, 5, true),
(17, 5, 5, false),
(18, 5, 6, true),
(19, 5, 7, true),
(20, 5, 8, true),
(21, 6, 6, false),
(22, 6, 4, true),
(23, 6, 3, true),
(24, 6, 7, true),
(25, 7, 7, false),
(26, 7, 8, true),
(27, 7, 2, true),
(28, 7, 4, true),
(29, 8, 8, false),
(30, 8, 4, true),
(31, 8, 9, true),
(32, 8, 1, true);

-- --------------------------------------------------------

--
-- Structure de la table `depot`
--

CREATE TABLE `depot` (
  `idDepot` int(11) NOT NULL AUTO_INCREMENT,
  `idGalerie` int(11) NOT NULL,
  `idPhoto` int(11) NOT NULL,
  PRIMARY KEY (`idDepot`),
  FOREIGN KEY(`idGalerie`) REFERENCES galerie(`idGalerie`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(`idPhoto`) REFERENCES photo(`idPhoto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `depot`
--

INSERT INTO `depot` (`idGalerie`, `idPhoto`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(1, 2),
(3, 2),
(4, 2),
(1, 3),
(3, 3),
(1, 4),
(3, 4),
(1, 5),
(2, 5),
(3, 5),
(4, 5),
(2, 6),
(3, 6),
(4, 6),
(2, 7),
(4, 8);

-- --------------------------------------------------------



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
