-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 20 avr. 2020 à 05:20
-- Version du serveur :  5.7.26
-- Version de PHP :  5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pidev`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

DROP TABLE IF EXISTS `absence`;
CREATE TABLE IF NOT EXISTS `absence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_matiere` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `Date` date NOT NULL,
  `TimeDeb` time NOT NULL,
  `TimeFin` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_matier` (`id_matiere`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `absence`
--

INSERT INTO `absence` (`id`, `id_matiere`, `id_user`, `Date`, `TimeDeb`, `TimeFin`) VALUES
(2, 5, 7, '2015-01-01', '00:00:00', '00:00:00'),
(3, 5, 7, '2015-01-01', '00:00:00', '00:00:00'),
(4, 5, 7, '2015-01-01', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `idBook` int(11) NOT NULL AUTO_INCREMENT,
  `titreBook` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nbrLike` int(11) DEFAULT NULL,
  `descriptionBook` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `etatBook` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picBook` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categorieBook` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idBook`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `calendarannuel`
--

DROP TABLE IF EXISTS `calendarannuel`;
CREATE TABLE IF NOT EXISTS `calendarannuel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `term` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DateC` date NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `calendarannuel`
--

INSERT INTO `calendarannuel` (`id`, `subject`, `term`, `DateC`, `startdate`, `enddate`) VALUES
(1, 'XD', 'xD', '2020-04-01', '2020-04-02', '2020-04-17');

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Niveau` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Spec` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Nbr_Etudiant` int(11) NOT NULL,
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`Id`, `Name`, `Niveau`, `Spec`, `Nbr_Etudiant`, `Description`) VALUES
(1, '3éme A', '3', 'A', 20, 'ahhaha');

-- --------------------------------------------------------

--
-- Structure de la table `classeenseignantmatiere`
--

DROP TABLE IF EXISTS `classeenseignantmatiere`;
CREATE TABLE IF NOT EXISTS `classeenseignantmatiere` (
  `id_user` int(11) DEFAULT NULL,
  `id_matiere` int(11) DEFAULT NULL,
  `id_class` int(11) DEFAULT NULL,
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `UNIQ_395724AE6B3CA4B` (`id_user`),
  UNIQUE KEY `UNIQ_395724AE4E89FE3A` (`id_matiere`),
  UNIQUE KEY `UNIQ_395724AE3CE58AF` (`id_class`),
  KEY `FK_classqqs` (`id_class`),
  KEY `FK_USER` (`id_user`),
  KEY `FK_Matiere` (`id_matiere`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `classeenseignantmatiere`
--

INSERT INTO `classeenseignantmatiere` (`id_user`, `id_matiere`, `id_class`, `Id`) VALUES
(8, 5, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

DROP TABLE IF EXISTS `club`;
CREATE TABLE IF NOT EXISTS `club` (
  `idClub` int(11) NOT NULL AUTO_INCREMENT,
  `nomClub` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `domaine` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `idResponsable` int(11) DEFAULT NULL,
  PRIMARY KEY (`idClub`),
  KEY `qsdqsd` (`idResponsable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ancestors` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `depth` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CE2904019` (`thread_id`),
  KEY `IDX_9474526CBDAFD8C8` (`author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demandeevenement`
--

DROP TABLE IF EXISTS `demandeevenement`;
CREATE TABLE IF NOT EXISTS `demandeevenement` (
  `idDemandeEvenement` int(11) NOT NULL AUTO_INCREMENT,
  `Description` text COLLATE utf8_unicode_ci NOT NULL,
  `DateDebut` date NOT NULL,
  `DateFin` date NOT NULL,
  `Etat` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Budget` double NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `idClub` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDemandeEvenement`),
  KEY `qsdqsdqd` (`idClub`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `emplois`
--

DROP TABLE IF EXISTS `emplois`;
CREATE TABLE IF NOT EXISTS `emplois` (
  `nameclas` int(11) DEFAULT NULL,
  `IdEmplois` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Heure` time NOT NULL,
  `Source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdEmplois`),
  KEY `IDX_461274B9B58EDEC1` (`nameclas`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `emplois`
--

INSERT INTO `emplois` (`nameclas`, `IdEmplois`, `Date`, `Heure`, `Source`) VALUES
(1, 1, '2015-01-01', '00:00:00', 'tp_web-5e9d1aa3a4b22.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `enseigner`
--

DROP TABLE IF EXISTS `enseigner`;
CREATE TABLE IF NOT EXISTS `enseigner` (
  `idMatiere` int(11) NOT NULL,
  `idEnseignant` int(11) NOT NULL,
  PRIMARY KEY (`idMatiere`,`idEnseignant`),
  UNIQUE KEY `idEnseignant` (`idEnseignant`),
  KEY `AAAAAAAAAAAA` (`idMatiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `enseigner`
--

INSERT INTO `enseigner` (`idMatiere`, `idEnseignant`) VALUES
(5, 8);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `idEvenement` int(11) NOT NULL AUTO_INCREMENT,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `idClub` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEvenement`),
  KEY `qsdqsdqsdqsd` (`idClub`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `idbook` int(11) DEFAULT NULL,
  `idetd` int(11) DEFAULT NULL,
  `idLike` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idLike`),
  KEY `FK_etudiant_like` (`idetd`),
  KEY `FK_Book_like` (`idbook`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matier`
--

DROP TABLE IF EXISTS `matier`;
CREATE TABLE IF NOT EXISTS `matier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `coef` double NOT NULL,
  `responsable` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `responsable` (`responsable`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `matier`
--

INSERT INTO `matier` (`id`, `nom`, `coef`, `responsable`) VALUES
(1, 'Java', 5, 6),
(2, 'TLA', 9, 3),
(5, 'GL', 9, 3),
(7, 'Symfony', 6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `idEtudiant` int(11) NOT NULL,
  `idMatiere` int(11) NOT NULL,
  `idEnseignant` int(11) DEFAULT NULL,
  `dateNote` date NOT NULL,
  `noteCC` double DEFAULT NULL,
  `noteDS` double DEFAULT NULL,
  `noteExam` double DEFAULT NULL,
  `Moyenne` double DEFAULT NULL,
  PRIMARY KEY (`idEtudiant`,`idMatiere`),
  KEY `idEtudiant` (`idEtudiant`),
  KEY `idEnseignant` (`idEnseignant`),
  KEY `idMatiere` (`idMatiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`idEtudiant`, `idMatiere`, `idEnseignant`, `dateNote`, `noteCC`, `noteDS`, `noteExam`, `Moyenne`) VALUES
(7, 5, 8, '2020-04-08', 2, 0, 20, 2);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `route_parameters` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `notification_date` datetime NOT NULL,
  `seen` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

DROP TABLE IF EXISTS `participation`;
CREATE TABLE IF NOT EXISTS `participation` (
  `idparticipation` int(11) NOT NULL AUTO_INCREMENT,
  `idevenement` int(11) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`idparticipation`),
  KEY `aszdzd` (`iduser`),
  KEY `ploikfdxzs` (`idevenement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `body` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `open` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id_question`),
  KEY `user` (`user_id`),
  KEY `tag` (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id_question`, `user_id`, `tag_id`, `body`, `title`, `open`, `created_at`) VALUES
(1, 4, NULL, 'blue red green person', 'html', 0, '2020-03-12 00:00:00'),
(2, 4, NULL, 'c++', 'c++', 1, '2020-03-12 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `rate`
--

DROP TABLE IF EXISTS `rate`;
CREATE TABLE IF NOT EXISTS `rate` (
  `idclub` int(11) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  `idRating` int(11) NOT NULL AUTO_INCREMENT,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`idRating`),
  KEY `resdcfs` (`iduser`),
  KEY `ploiktgvrfcedxzs` (`idclub`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `idrating` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `idClub` int(11) NOT NULL,
  `rating` double NOT NULL,
  PRIMARY KEY (`idrating`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

DROP TABLE IF EXISTS `reclamation`;
CREATE TABLE IF NOT EXISTS `reclamation` (
  `idReclamation` int(11) NOT NULL AUTO_INCREMENT,
  `sujetReclamation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptionReclamation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statutReclamation` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateCreation` date DEFAULT NULL,
  `IdEtd` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReclamation`),
  KEY `FK_etudiant` (`IdEtd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id_reponse` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `body` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vote_reponse` int(11) DEFAULT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id_reponse`),
  KEY `IDX_5FB6DEC7A76ED395` (`user_id`),
  KEY `id_question` (`id_question`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id_reponse`, `id_question`, `user_id`, `body`, `vote_reponse`, `valid`, `created_at`) VALUES
(1, 1, 3, 'blue person', 1, 1, '2020-04-01 00:00:00'),
(2, 1, 3, 'hello person', 1, 1, '2020-04-01 00:00:00'),
(3, 2, 3, 'hello person', NULL, 1, '2020-04-01 00:00:00'),
(4, 1, 7, 'hhhhh', 1, 1, '2020-04-20 02:33:38'),
(5, 1, 7, 'yellow person', 0, 1, '2020-04-20 02:33:58');

-- --------------------------------------------------------

--
-- Structure de la table `reservationbook`
--

DROP TABLE IF EXISTS `reservationbook`;
CREATE TABLE IF NOT EXISTS `reservationbook` (
  `idReservation` int(11) NOT NULL AUTO_INCREMENT,
  `dateD` date DEFAULT NULL,
  `dateF` date DEFAULT NULL,
  `idEtd` int(11) DEFAULT NULL,
  `idBook` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReservation`),
  KEY `Fk_etudiant_Reservation` (`idEtd`),
  KEY `FK_Book` (`idBook`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `resultat`
--

DROP TABLE IF EXISTS `resultat`;
CREATE TABLE IF NOT EXISTS `resultat` (
  `idEtudiant` int(11) NOT NULL,
  `dateResultat` date NOT NULL,
  `resultat` double DEFAULT NULL,
  PRIMARY KEY (`idEtudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id_tag` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `thread`
--

DROP TABLE IF EXISTS `thread`;
CREATE TABLE IF NOT EXISTS `thread` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permalink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_commentable` tinyint(1) NOT NULL,
  `num_comments` int(11) NOT NULL,
  `last_comment_at` datetime DEFAULT NULL,
  `idBook` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_31204C83B818FDAF` (`idBook`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `cinUser` int(11) DEFAULT NULL,
  `nomUser` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenomUser` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateNaissanceUser` date DEFAULT NULL,
  `sexeUser` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emailUser` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresseUser` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numTelUser` int(11) DEFAULT NULL,
  `roleUser` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateEmbaucheUser` date DEFAULT NULL,
  `motDePasseUser` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inscriptionEtd` date DEFAULT NULL,
  `nomResponsableEtd` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specialiteEtd` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statutUser` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salaireUser` double DEFAULT NULL,
  `domaineUser` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idParent` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picUser` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `classeEtd` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_1483A5E9A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_1483A5E9C05FB297` (`confirmation_token`),
  KEY `IDX_1483A5E96183EFB3` (`classeEtd`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `cinUser`, `nomUser`, `prenomUser`, `DateNaissanceUser`, `sexeUser`, `emailUser`, `adresseUser`, `numTelUser`, `roleUser`, `dateEmbaucheUser`, `motDePasseUser`, `inscriptionEtd`, `nomResponsableEtd`, `specialiteEtd`, `statutUser`, `salaireUser`, `domaineUser`, `idParent`, `picUser`, `classeEtd`) VALUES
(3, 'wajih', 'wajih', 'wajihbenslama@esprit.t', 'wajihbenslama@esprit.t', 1, NULL, '$2y$13$QtqIA1aNMICss7hwP35mE.vAiVE7AcNCoskRqKin6YcmoSxqhUkZe', '2020-03-31 15:16:29', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hello.jpg', NULL),
(4, 'user', 'user', 'user@esprit.tn', 'user@esprit.tn', 1, NULL, '$2y$13$QtqIA1aNMICss7hwP35mE.vAiVE7AcNCoskRqKin6YcmoSxqhUkZe', '2020-03-31 15:26:35', NULL, NULL, 'a:1:{i:0;s:9:\"ROLE_USER\";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hello.jpg', NULL),
(5, 'root', 'root', 'omar.jsmai@esprit.tn', 'omar.jsmai@esprit.tn', 1, NULL, '$2y$13$csetnbiSWxdbv.vkP/3PJ.nL8lC.UrkUJGnofFB/Xn34xLB13NYk2', '2020-04-20 03:32:24', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_AMDIN\";}', 123456, 'root', 'root', '1986-11-07', NULL, NULL, NULL, 123456789, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hello.jpg', NULL),
(6, 'personel', 'personel', 'Personel.jmai@esprit.tn', 'personel.jmai@esprit.tn', 1, NULL, '$2y$13$csetnbiSWxdbv.vkP/3PJ.nL8lC.UrkUJGnofFB/Xn34xLB13NYk2', '2020-04-20 02:43:02', NULL, NULL, 'a:1:{i:0;s:14:\"ROLE_PERSONNEL\";}', 123456, 'personel', 'personel', '1986-11-07', NULL, NULL, NULL, 123456789, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hello.jpg', NULL),
(7, 'etudiant', 'etudiant', 'omar.jmai@esprit.tn', 'omar.jmai@esprit.tn', 1, NULL, '$2y$13$csetnbiSWxdbv.vkP/3PJ.nL8lC.UrkUJGnofFB/Xn34xLB13NYk2', '2020-04-20 04:30:50', NULL, NULL, 'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}', 55, 'etudiant', 'etudiant', '1986-11-07', NULL, NULL, NULL, 123456789, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hello.jpg', 1),
(8, 'enseignant', 'enseignant', 'hamza.ennour@esprit.tn', 'hamza.ennour@esprit.tn', 1, NULL, '$2y$13$csetnbiSWxdbv.vkP/3PJ.nL8lC.UrkUJGnofFB/Xn34xLB13NYk2', '2020-04-20 04:49:55', NULL, NULL, 'a:1:{i:0;s:16:\"ROLE_ENSEIGNIANT\";}', 123456, 'enseignant', 'enseignant', '1986-11-07', NULL, NULL, NULL, 123456789, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hello.jpg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `wishliste`
--

DROP TABLE IF EXISTS `wishliste`;
CREATE TABLE IF NOT EXISTS `wishliste` (
  `idList` int(11) NOT NULL AUTO_INCREMENT,
  `idEtd` int(11) DEFAULT NULL,
  `idBook` int(11) DEFAULT NULL,
  PRIMARY KEY (`idList`),
  KEY `FK_etudiant_wishliste` (`idEtd`),
  KEY `FK_book_wishliste` (`idBook`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `FK_765AE0C94E89FE3A` FOREIGN KEY (`id_matiere`) REFERENCES `matier` (`id`),
  ADD CONSTRAINT `FK_765AE0C96B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `classeenseignantmatiere`
--
ALTER TABLE `classeenseignantmatiere`
  ADD CONSTRAINT `FK_395724AE3CE58AF` FOREIGN KEY (`id_class`) REFERENCES `classe` (`Id`),
  ADD CONSTRAINT `FK_395724AE4E89FE3A` FOREIGN KEY (`id_matiere`) REFERENCES `enseigner` (`idMatiere`),
  ADD CONSTRAINT `FK_395724AE6B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `enseigner` (`idEnseignant`);

--
-- Contraintes pour la table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `FK_B8EE3872120FF27F` FOREIGN KEY (`idResponsable`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CBDAFD8C8` FOREIGN KEY (`author`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_9474526CE2904019` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`id`);

--
-- Contraintes pour la table `demandeevenement`
--
ALTER TABLE `demandeevenement`
  ADD CONSTRAINT `FK_63BF64BCCB1366EC` FOREIGN KEY (`idClub`) REFERENCES `club` (`idClub`);

--
-- Contraintes pour la table `emplois`
--
ALTER TABLE `emplois`
  ADD CONSTRAINT `FK_461274B9B58EDEC1` FOREIGN KEY (`nameclas`) REFERENCES `classe` (`Id`);

--
-- Contraintes pour la table `enseigner`
--
ALTER TABLE `enseigner`
  ADD CONSTRAINT `FK_663E85CD353314B` FOREIGN KEY (`idEnseignant`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_663E85CD80AD3CB8` FOREIGN KEY (`idMatiere`) REFERENCES `matier` (`id`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `FK_B26681ECB1366EC` FOREIGN KEY (`idClub`) REFERENCES `club` (`idClub`);

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `FK_49CA4E7D182A5291` FOREIGN KEY (`idbook`) REFERENCES `books` (`idBook`),
  ADD CONSTRAINT `FK_49CA4E7DA9D4920D` FOREIGN KEY (`idetd`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `FK_AB55E24F5E5C27E9` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_AB55E24F753DC1EB` FOREIGN KEY (`idevenement`) REFERENCES `evenement` (`idEvenement`);

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_B6F7494EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_B6F7494EBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id_tag`);

--
-- Contraintes pour la table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `FK_DFEC3F395E5C27E9` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_DFEC3F396B21C9D2` FOREIGN KEY (`idclub`) REFERENCES `club` (`idClub`);

--
-- Contraintes pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `FK_CE6064045058FBE9` FOREIGN KEY (`IdEtd`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_5FB6DEC7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_5FB6DEC7E62CA5DB` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`);

--
-- Contraintes pour la table `reservationbook`
--
ALTER TABLE `reservationbook`
  ADD CONSTRAINT `FK_D38C97149199D4ED` FOREIGN KEY (`idEtd`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_D38C9714B818FDAF` FOREIGN KEY (`idBook`) REFERENCES `books` (`idBook`);

--
-- Contraintes pour la table `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `FK_31204C83B818FDAF` FOREIGN KEY (`idBook`) REFERENCES `books` (`idBook`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_1483A5E96183EFB3` FOREIGN KEY (`classeEtd`) REFERENCES `classe` (`Id`);

--
-- Contraintes pour la table `wishliste`
--
ALTER TABLE `wishliste`
  ADD CONSTRAINT `FK_BE989B4A9199D4ED` FOREIGN KEY (`idEtd`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_BE989B4AB818FDAF` FOREIGN KEY (`idBook`) REFERENCES `books` (`idBook`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
