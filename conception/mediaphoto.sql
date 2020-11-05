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
drop database mediaphoto;

CREATE DATABASE IF NOT EXISTS mediaphoto;

USE mediaphoto;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `courrier` varchar(255) NOT NULL,
  `motPasse` varchar(255) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `idPhoto` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `motsCles` varchar(255) NULL,
  `metaDonnees` blob NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idPhoto`),
  FOREIGN KEY(`idUser`) REFERENCES utilisateur(`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


--
-- Structure de la table `galerie`
--

CREATE TABLE `galerie` (
  `idGalerie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `motsCles` varchar(255) NULL,
  `type` int(11) NOT NULL,
  `dateCreation` date NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idGalerie`),
  FOREIGN KEY(`idUser`) REFERENCES utilisateur(`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `idCommentaire` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` text NOT NULL,
  `idGalerie` int(11) NOT NULL,
  `idPhoto` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idCommentaire`),
  FOREIGN KEY(`idGalerie`) REFERENCES galerie(`idGalerie`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(`idPhoto`) REFERENCES photo(`idPhoto`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(`idUser`) REFERENCES utilisateur(`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `idGroupe` int(11) NOT NULL AUTO_INCREMENT,
  `idGalerie` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `typeUser` boolean NOT NULL,
  PRIMARY KEY (`idGroupe`),
  FOREIGN KEY(`idGalerie`) REFERENCES galerie(`idGalerie`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(`idUser`) REFERENCES utilisateur(`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `depot` (
  `idGalerie` int(11) NOT NULL,
  `idPhoto` int(11) NOT NULL,
  PRIMARY KEY (`idGalerie`,`idPhoto`),
  FOREIGN KEY(`idGalerie`) REFERENCES galerie(`idGalerie`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(`idPhoto`) REFERENCES photo(`idPhoto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
