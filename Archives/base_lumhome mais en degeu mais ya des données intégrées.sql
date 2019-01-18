-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 17 jan. 2019 à 21:31
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `base_lumhome`
--

-- --------------------------------------------------------

--
-- Structure de la table `cemac`
--

DROP TABLE IF EXISTS `cemac`;
CREATE TABLE IF NOT EXISTS `cemac` (
  `numeroSerie` varchar(30) COLLATE utf8_bin NOT NULL,
  `adresseMac` char(12) COLLATE utf8_bin NOT NULL,
  `type` varchar(10) COLLATE utf8_bin NOT NULL,
  `panne` tinyint(1) NOT NULL,
  `fk_piece` int(11) DEFAULT NULL,
  PRIMARY KEY (`numeroSerie`),
  KEY `FK_CEMAC_PIECE` (`fk_piece`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `cemac`
--

INSERT INTO `cemac` (`numeroSerie`, `adresseMac`, `type`, `panne`, `fk_piece`) VALUES
('123456', '123456789', 'ampoule', 0, 1),
('123789', '753456', 'ampoule', 0, 2),
('5675341', '1352343', 'ampoule', 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `habitat`
--

DROP TABLE IF EXISTS `habitat`;
CREATE TABLE IF NOT EXISTS `habitat` (
  `idHabitat` int(11) NOT NULL AUTO_INCREMENT,
  `nomHabitat` varchar(20) COLLATE utf8_bin NOT NULL,
  `numero` varchar(11) COLLATE utf8_bin NOT NULL,
  `rue` varchar(50) COLLATE utf8_bin NOT NULL,
  `complement` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `ville` varchar(50) COLLATE utf8_bin NOT NULL,
  `codePostal` int(5) NOT NULL,
  `fk_proprietaire` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`idHabitat`),
  KEY `FK_HABITAT_UTILISATEUR` (`fk_proprietaire`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `habitat`
--

INSERT INTO `habitat` (`idHabitat`, `nomHabitat`, `numero`, `rue`, `complement`, `ville`, `codePostal`, `fk_proprietaire`) VALUES
(1, 'Maison de Mathieu', '12', 'rue de pierre', NULL, 'best ville', 12345, 'h.matico@mail.com'),
(2, 'Maison de Patrick', '12', 'rue du classeur', NULL, 'Didier du champs sur Marne aux fleurs', 78340, 'h.matico@mail.com');

-- --------------------------------------------------------

--
-- Structure de la table `parametre`
--

DROP TABLE IF EXISTS `parametre`;
CREATE TABLE IF NOT EXISTS `parametre` (
  `type` varchar(20) COLLATE utf8_bin NOT NULL,
  `fk_CeMAC` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `valeur` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`type`),
  KEY `FK_PARAMETRE_CEMAC` (`fk_CeMAC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

DROP TABLE IF EXISTS `piece`;
CREATE TABLE IF NOT EXISTS `piece` (
  `idPiece` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) COLLATE utf8_bin NOT NULL,
  `nom` varchar(20) COLLATE utf8_bin NOT NULL,
  `fk_habitat` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPiece`),
  KEY `FK_PIECE_HABITAT` (`fk_habitat`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `piece`
--

INSERT INTO `piece` (`idPiece`, `type`, `nom`, `fk_habitat`) VALUES
(1, 'Detente', 'Cuisine', 1),
(2, 'Noel', 'Salon', 2),
(3, 'Detente', 'Chambre de Didier', 2);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id_question` int(100) NOT NULL AUTO_INCREMENT,
  `question` longtext COLLATE utf8_bin NOT NULL,
  `reponse` longtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_question`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id_question`, `question`, `reponse`) VALUES
(1, 'Comment je peux créer mon compte ?', 'Pour créer  votre compte, vous devez renseigner votre adresse email et choisir un mot de passe respectant le format imposé. Vous devez ensuite renseigner le numéro de série du CeMAC préalablement acheté.'),
(2, 'Comment puis-je me procurer un CeMAC ?', 'Les capteurs CeMAC sont disponibles sur le site de DomISEP à l\'adresse suivante : www.domisep.fr/products/'),
(3, 'Je ne retrouve plus les identifiants de mon compte, que dois-je faire ?', 'Veuillez en informer l\'administrateur du site via l\'onglet \'Contactez-nous\'. Certaines informations personnelles seront requises pour votre identification.'),
(4, 'Comment modifier les informations de mon compte ?', 'Connectez vous avec vos identifiants actuels et allez dans l\'onglet \'Mon Compte\' afin de modifier les données de votre compte.'),
(5, 'Mon CeMAC est en panne ou cassé que faire ?', 'Veuillez en informer l\'administrateur du site via l\'onglet \'Contactez-nous\'. Un professionnel sera mis à votre disposition pour vérifier votre installation. Il effectuera les réparations nécessaires.'),
(6, 'Je suis promoteur immobilier, comment mettre en place les installations chez les locataires ?', 'Veuillez contacter l\'administrateur du site via l\'onglet \'Contactez-nous\' pour mettre en place l\'installation des produits.');

-- --------------------------------------------------------

--
-- Structure de la table `scenario`
--

DROP TABLE IF EXISTS `scenario`;
CREATE TABLE IF NOT EXISTS `scenario` (
  `nom` varchar(20) COLLATE utf8_bin NOT NULL,
  `dateDebut` timestamp NULL DEFAULT NULL,
  `dateFin` timestamp NULL DEFAULT NULL,
  `statut` tinyint(1) NOT NULL,
  `scenario` varchar(30) COLLATE utf8_bin NOT NULL,
  `type` varchar(30) COLLATE utf8_bin NOT NULL,
  `fk_proprietaire` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`nom`),
  KEY `FK_SCENARIO_UTILISATEUR` (`fk_proprietaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `scenario`
--

INSERT INTO `scenario` (`nom`, `dateDebut`, `dateFin`, `statut`, `scenario`, `type`, `fk_proprietaire`) VALUES
('Cuisine Detente', NULL, NULL, 0, 'Allume la cuisine et detente', 'Detente', 'h.matico@mail.com'),
('Noel dans le salon', NULL, NULL, 1, '', 'Noel', 'h.matico@mail.com');

-- --------------------------------------------------------

--
-- Structure de la table `scenario_cemac`
--

DROP TABLE IF EXISTS `scenario_cemac`;
CREATE TABLE IF NOT EXISTS `scenario_cemac` (
  `fk_scenario` varchar(20) COLLATE utf8_bin NOT NULL,
  `fk_CeMAC` varchar(30) COLLATE utf8_bin NOT NULL,
  `valeurIntensite` int(11) DEFAULT NULL,
  `valeurCouleur` char(6) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`fk_scenario`,`fk_CeMAC`),
  KEY `FK_SCENARIO_CEMAC_CEMAC` (`fk_CeMAC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `scenario_cemac`
--

INSERT INTO `scenario_cemac` (`fk_scenario`, `fk_CeMAC`, `valeurIntensite`, `valeurCouleur`) VALUES
('Cuisine Detente', '123456', 70, '123456'),
('Noel dans le salon', '5675341', 12, '753654');

-- --------------------------------------------------------

--
-- Structure de la table `stats`
--

DROP TABLE IF EXISTS `stats`;
CREATE TABLE IF NOT EXISTS `stats` (
  `fk_habitat` int(11) DEFAULT NULL,
  `dateStat` date DEFAULT NULL,
  `nbrHeuresInutiles` int(11) DEFAULT NULL,
  KEY `FK_STATS_HABITAT` (`fk_habitat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `adresseMail` varchar(30) COLLATE utf8_bin NOT NULL,
  `nomUser` varchar(30) COLLATE utf8_bin NOT NULL,
  `prenomUser` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `adresseFacturation` int(11) DEFAULT NULL,
  `type` varchar(20) COLLATE utf8_bin NOT NULL,
  `mdpUser` varchar(125) COLLATE utf8_bin NOT NULL,
  `pin` varchar(4) COLLATE utf8_bin NOT NULL,
  `numeroCarte` bigint(16) DEFAULT NULL,
  `cryptogramme` int(3) DEFAULT NULL,
  `dateExpiration` date DEFAULT NULL,
  PRIMARY KEY (`adresseMail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`adresseMail`, `nomUser`, `prenomUser`, `adresseFacturation`, `type`, `mdpUser`, `pin`, `numeroCarte`, `cryptogramme`, `dateExpiration`) VALUES
('h.matico@mail.com', 'Hmatico', NULL, NULL, 'admin', '$argon2i$v=19$m=1024,t=2,p=2$MFExUmJVRHlVYk1GaHNreA$7aRpebR+chLtj8IZVl+lZit/gQA9Snxz7keCVYXQVuQ', '0000', NULL, NULL, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cemac`
--
ALTER TABLE `cemac`
  ADD CONSTRAINT `FK_CEMAC_PIECE` FOREIGN KEY (`fk_piece`) REFERENCES `piece` (`idPiece`) ON DELETE CASCADE;

--
-- Contraintes pour la table `habitat`
--
ALTER TABLE `habitat`
  ADD CONSTRAINT `FK_HABITAT_UTILISATEUR` FOREIGN KEY (`fk_proprietaire`) REFERENCES `utilisateur` (`adresseMail`) ON DELETE CASCADE;

--
-- Contraintes pour la table `parametre`
--
ALTER TABLE `parametre`
  ADD CONSTRAINT `FK_PARAMETRE_CEMAC` FOREIGN KEY (`fk_CeMAC`) REFERENCES `cemac` (`numeroSerie`) ON DELETE CASCADE;

--
-- Contraintes pour la table `piece`
--
ALTER TABLE `piece`
  ADD CONSTRAINT `FK_PIECE_HABITAT` FOREIGN KEY (`fk_habitat`) REFERENCES `habitat` (`idHabitat`) ON DELETE CASCADE;

--
-- Contraintes pour la table `scenario`
--
ALTER TABLE `scenario`
  ADD CONSTRAINT `FK_SCENARIO_UTILISATEUR` FOREIGN KEY (`fk_proprietaire`) REFERENCES `utilisateur` (`adresseMail`) ON DELETE CASCADE;

--
-- Contraintes pour la table `scenario_cemac`
--
ALTER TABLE `scenario_cemac`
  ADD CONSTRAINT `FK_SCENARIO_CEMAC_CEMAC` FOREIGN KEY (`fk_CeMAC`) REFERENCES `cemac` (`numeroSerie`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_SCENARIO_CEMAC_SCENARIO` FOREIGN KEY (`fk_scenario`) REFERENCES `scenario` (`nom`) ON DELETE CASCADE;

--
-- Contraintes pour la table `stats`
--
ALTER TABLE `stats`
  ADD CONSTRAINT `FK_STATS_HABITAT` FOREIGN KEY (`fk_habitat`) REFERENCES `habitat` (`idHabitat`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
