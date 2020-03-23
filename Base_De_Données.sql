-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 23, 2020 at 11:01 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pidev`
--

-- --------------------------------------------------------

--
-- Table structure for table `absence`
--

DROP TABLE IF EXISTS `absence`;
CREATE TABLE IF NOT EXISTS `absence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL,
  `Date` date NOT NULL,
  `TimeDeb` time NOT NULL,
  `TimeFin` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_matier` (`id_matiere`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absence`
--

INSERT INTO `absence` (`id`, `id_user`, `id_matiere`, `Date`, `TimeDeb`, `TimeFin`) VALUES
(6, 137, 2, '2020-02-06', '02:45:00', '03:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `calendarannuel`
--

DROP TABLE IF EXISTS `calendarannuel`;
CREATE TABLE IF NOT EXISTS `calendarannuel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `term` varchar(255) NOT NULL,
  `DateC` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calendarannuel`
--

INSERT INTO `calendarannuel` (`id`, `subject`, `term`, `DateC`) VALUES
(21, 'sdfwww', 'Results', '2020-01-09'),
(20, 'Holdiday ', 'DS', '2020-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `chapitre`
--

DROP TABLE IF EXISTS `chapitre`;
CREATE TABLE IF NOT EXISTS `chapitre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `file` varchar(255) NOT NULL,
  `matier` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `matier` (`matier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Niveau` varchar(255) NOT NULL,
  `Spec` varchar(255) NOT NULL,
  `Nbr_Etudiant` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classe`
--

INSERT INTO `classe` (`Id`, `Name`, `Niveau`, `Spec`, `Nbr_Etudiant`, `Description`) VALUES
(12, '3B1', '3', 'B', 40, 'qsdqsd'),
(13, '3A5', '3', 'A', 30, 'qsdqsd'),
(14, '3B', '3', 'TWIN', 20, 'wxc'),
(15, 'as', '1', 'B', 54, 'tgrg'),
(17, '3A55', '3', 'A', 22, 'qsd'),
(18, '3B5', '3', 'DS', 22, 'sqdfs');

-- --------------------------------------------------------

--
-- Table structure for table `classeenseignantmatiere`
--

DROP TABLE IF EXISTS `classeenseignantmatiere`;
CREATE TABLE IF NOT EXISTS `classeenseignantmatiere` (
  `id_class` int(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL,
  KEY `FK_classqqs` (`id_class`),
  KEY `FK_USER` (`id_user`),
  KEY `FK_Matiere` (`id_matiere`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classeenseignantmatiere`
--

INSERT INTO `classeenseignantmatiere` (`id_class`, `id_user`, `id_matiere`) VALUES
(12, 18, 4),
(12, 188, 2),
(12, 18, 5),
(17, 18, 5);

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

DROP TABLE IF EXISTS `club`;
CREATE TABLE IF NOT EXISTS `club` (
  `idClub` int(11) NOT NULL AUTO_INCREMENT,
  `nomClub` varchar(250) NOT NULL,
  `idResponsable` int(11) NOT NULL,
  `domaine` varchar(250) NOT NULL,
  PRIMARY KEY (`idClub`),
  KEY `qsdqsd` (`idResponsable`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`idClub`, `nomClub`, `idResponsable`, `domaine`) VALUES
(1, 'RootClub', 157, 'Responsable');

-- --------------------------------------------------------

--
-- Table structure for table `demandecreationclub`
--

DROP TABLE IF EXISTS `demandecreationclub`;
CREATE TABLE IF NOT EXISTS `demandecreationclub` (
  `idDemandeClub` int(11) NOT NULL AUTO_INCREMENT,
  `IDEtudiant` int(11) NOT NULL,
  `nomClub` varchar(250) NOT NULL,
  `domaine` varchar(250) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`idDemandeClub`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `demandeevenement`
--

DROP TABLE IF EXISTS `demandeevenement`;
CREATE TABLE IF NOT EXISTS `demandeevenement` (
  `idDemandeEvenement` int(11) NOT NULL AUTO_INCREMENT,
  `Description` text NOT NULL,
  `DateDebut` date NOT NULL,
  `DateFin` date NOT NULL,
  `Etat` varchar(250) NOT NULL,
  `idClub` int(11) NOT NULL,
  `Budget` float NOT NULL,
  `image` varchar(250) NOT NULL,
  PRIMARY KEY (`idDemandeEvenement`),
  KEY `qsdqsdqd` (`idClub`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emplois`
--

DROP TABLE IF EXISTS `emplois`;
CREATE TABLE IF NOT EXISTS `emplois` (
  `IdEmplois` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Heure` time NOT NULL,
  `Source` varchar(255) NOT NULL,
  PRIMARY KEY (`IdEmplois`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emplois`
--

INSERT INTO `emplois` (`IdEmplois`, `Date`, `Heure`, `Source`) VALUES
(4, '2020-02-06', '14:36:00', 'Calcul.txt'),
(6, '2020-02-05', '15:42:00', 'Map.pdf'),
(7, '2020-02-06', '10:47:00', 'wwww.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `enseigner`
--

DROP TABLE IF EXISTS `enseigner`;
CREATE TABLE IF NOT EXISTS `enseigner` (
  `idEnseignant` int(11) NOT NULL,
  `idMatiere` int(11) NOT NULL,
  PRIMARY KEY (`idEnseignant`,`idMatiere`),
  KEY `AAAAAAAAAAAA` (`idMatiere`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enseigner`
--

INSERT INTO `enseigner` (`idEnseignant`, `idMatiere`) VALUES
(188, 2),
(185, 3),
(18, 4),
(18, 5),
(186, 7);

-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `idEvenement` int(11) NOT NULL AUTO_INCREMENT,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `idClub` int(11) NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`idEvenement`),
  KEY `qsdqsdqsdqsd` (`idClub`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evenement`
--

INSERT INTO `evenement` (`idEvenement`, `dateDebut`, `dateFin`, `idClub`, `image`) VALUES
(3, '2020-02-13', '2020-02-20', 1, 'C:\\Users\\Neifos\\Desktop\\Weboss\\src\\weboss\\Image\\event.jfif'),
(4, '2020-02-02', '2020-02-01', 1, 'Path'),
(10, '2020-02-06', '2020-02-07', 1, 'C:\\Users\\Neifos\\Desktop\\Weboss\\src\\weboss\\Image\\f047ea5fe0d366851756138d305f4798.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) DEFAULT NULL,
  `Titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DateDebut` date NOT NULL,
  `DateFin` date NOT NULL,
  `Nbr_Participant` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_404021BF61190A32` (`club_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matier`
--

DROP TABLE IF EXISTS `matier`;
CREATE TABLE IF NOT EXISTS `matier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `coef` float NOT NULL,
  `responsable` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `responsable` (`responsable`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matier`
--

INSERT INTO `matier` (`id`, `nom`, `coef`, `responsable`) VALUES
(2, 'Finance', 1.5, 1),
(3, 'Algebre', 2, 3),
(4, 'prog c++', 2, 3),
(5, 'POO Java', 3, 3),
(6, 'TLA', 4, 6),
(7, 'droit', 1, 5),
(8, 'francais', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `idEtudiant` int(11) NOT NULL,
  `idMatiere` varchar(50) NOT NULL,
  `idEnseignant` int(11) DEFAULT NULL,
  `dateNote` date NOT NULL,
  `noteCC` double DEFAULT NULL,
  `noteDS` double DEFAULT NULL,
  `noteExam` double DEFAULT NULL,
  `Moyenne` double DEFAULT NULL,
  PRIMARY KEY (`idMatiere`,`idEtudiant`,`dateNote`),
  KEY `idEnseignant` (`idEnseignant`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`idEtudiant`, `idMatiere`, `idEnseignant`, `dateNote`, `noteCC`, `noteDS`, `noteExam`, `Moyenne`) VALUES
(15, '3', 19, '2020-02-07', 20, 10.5, 15.5, 15.85),
(18, '4', 18, '2020-02-13', 9, 7.25, 10, 9.15),
(15, '2', 18, '2020-01-29', 10.25, 10.5, 2.25, 6.3),
(25, '3', 19, '2020-02-14', 16.75, 12, 11.5, 13.175),
(1, '4', 18, '2020-02-12', 11.5, 16, 7, 10.15),
(16, '3', 19, '2020-02-05', 3.75, 9.25, 8.5, 7.225),
(15, '6', 18, '2020-01-30', 17.5, 11.75, 9.5, 12.35),
(15, '5', 18, '2020-02-06', 8.5, 13, 2.25, 6.275),
(1, '3', 18, '2020-02-13', 12, 1, 15, 11.3),
(25, '5', 19, '2020-02-05', 2.75, 3, 3, 2.925),
(2, '8', 19, '2020-02-19', 9, 9, 9, 9),
(4, '7', 19, '2020-01-14', 8.5, 5.2, 19, 13.09),
(15, '1', 188, '2020-02-27', 15, 15, 15, 15),
(15, '7', 188, '2020-02-21', 10, 10, 10, 10),
(176, '5', 18, '2020-02-05', 5.75, 3.5, 2, 3.425),
(15, '4', 18, '2020-03-18', 6.5, 7.25, 8, 7.4);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `body` varchar(100) NOT NULL,
  `vote_question` int(11) DEFAULT NULL,
  `id_tag` int(11) DEFAULT NULL,
  `id_personne` int(11) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `tag_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id_question`),
  KEY `id_personne` (`id_personne`),
  KEY `id_tag` (`id_tag`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id_question`, `body`, `vote_question`, `id_tag`, `id_personne`, `title`, `tag_name`) VALUES
(1, 'null pointer', 1, 1, 137, 'java exception', 'java'),
(2, 'herlp me', 1, 1, 137, 'error java', 'java'),
(3, 'sqd', 1, 1, 137, 'java eprobelm', 'java');

-- --------------------------------------------------------

--
-- Table structure for table `questionquizz`
--

DROP TABLE IF EXISTS `questionquizz`;
CREATE TABLE IF NOT EXISTS `questionquizz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `rep1` varchar(255) NOT NULL,
  `rep2` varchar(255) NOT NULL,
  `rep3` varchar(255) NOT NULL,
  `rep` varchar(255) NOT NULL,
  `quiz` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz` (`quiz`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quizz`
--

DROP TABLE IF EXISTS `quizz`;
CREATE TABLE IF NOT EXISTS `quizz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapitre` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `chapitre` (`chapitre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `idrating` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `idClub` int(11) NOT NULL,
  `rating` double NOT NULL,
  PRIMARY KEY (`idrating`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`idrating`, `iduser`, `idClub`, `rating`) VALUES
(6, 15, 1, 5),
(5, 131, 213, 5);

-- --------------------------------------------------------

--
-- Table structure for table `reclamation`
--

DROP TABLE IF EXISTS `reclamation`;
CREATE TABLE IF NOT EXISTS `reclamation` (
  `idReclamation` int(11) NOT NULL AUTO_INCREMENT,
  `sujetReclamation` varchar(255) NOT NULL,
  `descriptionReclamation` varchar(255) NOT NULL,
  `statutReclamation` varchar(11) NOT NULL DEFAULT 'Non Traité',
  `dateCreation` date NOT NULL,
  `IdEtd` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReclamation`),
  KEY `FK_reclamation` (`IdEtd`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reclamation`
--

INSERT INTO `reclamation` (`idReclamation`, `sujetReclamation`, `descriptionReclamation`, `statutReclamation`, `dateCreation`, `IdEtd`) VALUES
(13, 'sdf', 'sdf', 'Non Traité', '1918-07-05', 125),
(4, '', 'note', 'Non Traité', '3921-01-12', 121),
(16, 'qsdf', 'qsdqd', 'Non Traité', '2020-02-18', 106),
(15, 'sf', 'sdfsdfsdf', 'Non Traité', '3921-01-12', 106),
(17, 'note', 'qdfqsf', 'Non Traité', '2020-02-18', 117),
(24, 'error prof', 'prof', 'traite', '2020-02-26', 15),
(25, 'wxc', 'wdc', 'traite', '2020-02-26', 15);

-- --------------------------------------------------------

--
-- Table structure for table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id_reponse` int(11) NOT NULL AUTO_INCREMENT,
  `body` varchar(100) NOT NULL,
  `vote_reponse` int(11) DEFAULT NULL,
  `id_question` int(11) NOT NULL,
  PRIMARY KEY (`id_reponse`),
  KEY `id_question` (`id_question`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reponse`
--

INSERT INTO `reponse` (`id_reponse`, `body`, `vote_reponse`, `id_question`) VALUES
(1, 'import packages', 0, 1),
(2, 'qsdqs', 0, 1),
(3, 'add package', 0, 2),
(4, 'fdf', 0, 3),
(5, 'wscdwc', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `resultat`
--

DROP TABLE IF EXISTS `resultat`;
CREATE TABLE IF NOT EXISTS `resultat` (
  `idEtudiant` int(11) NOT NULL,
  `dateResultat` date NOT NULL,
  `resultat` float DEFAULT NULL,
  PRIMARY KEY (`idEtudiant`,`dateResultat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resultat`
--

INSERT INTO `resultat` (`idEtudiant`, `dateResultat`, `resultat`) VALUES
(2, '2020-03-02', 9),
(15, '2020-03-02', 10.8591),
(1, '2020-03-02', 10.725),
(16, '2020-03-02', 7.225),
(25, '2020-03-02', 7.025),
(18, '2020-03-02', 9.15),
(176, '2020-03-02', 3.425),
(4, '2020-03-02', 13.09);

-- --------------------------------------------------------

--
-- Table structure for table `sondage`
--

DROP TABLE IF EXISTS `sondage`;
CREATE TABLE IF NOT EXISTS `sondage` (
  `id_sondage` int(11) NOT NULL AUTO_INCREMENT,
  `id_club` int(11) NOT NULL,
  `titre` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `reponse` text NOT NULL,
  PRIMARY KEY (`id_sondage`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sondage`
--

INSERT INTO `sondage` (`id_sondage`, `id_club`, `titre`, `description`, `reponse`) VALUES
(1, 455, 'lll', 'dfghjk', 'Null');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id_tag` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id_tag`, `nom`, `description`) VALUES
(1, 'java', 'java'),
(2, 'mobile', 'mobile'),
(3, 'mni', 'mni'),
(4, 'probabilite', 'probabilite'),
(5, 'finance', 'finance'),
(6, 'C', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `cinUser` int(11) NOT NULL,
  `nomUser` varchar(50) DEFAULT NULL,
  `prenomUser` varchar(50) DEFAULT NULL,
  `DateNaissanceUser` date DEFAULT NULL,
  `sexeUser` varchar(10) DEFAULT NULL,
  `emailUser` varchar(100) DEFAULT NULL,
  `adresseUser` varchar(50) DEFAULT NULL,
  `numTelUser` int(8) DEFAULT NULL,
  `roleUser` varchar(50) DEFAULT NULL,
  `dateEmbaucheUser` date DEFAULT NULL,
  `motDePasseUser` varchar(100) DEFAULT NULL,
  `classeEtd` varchar(100) DEFAULT NULL,
  `inscriptionEtd` date DEFAULT NULL,
  `nomResponsableEtd` varchar(100) DEFAULT NULL,
  `specialiteEtd` varchar(100) DEFAULT NULL,
  `statutUser` varchar(50) DEFAULT NULL,
  `salaireUser` double DEFAULT NULL,
  `domaineUser` varchar(100) DEFAULT NULL,
  `idParent` varchar(30) DEFAULT NULL,
  `picUser` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `cinUser` (`cinUser`),
  KEY `idParent` (`idParent`),
  KEY `sqdsssss` (`classeEtd`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `cinUser`, `nomUser`, `prenomUser`, `DateNaissanceUser`, `sexeUser`, `emailUser`, `adresseUser`, `numTelUser`, `roleUser`, `dateEmbaucheUser`, `motDePasseUser`, `classeEtd`, `inscriptionEtd`, `nomResponsableEtd`, `specialiteEtd`, `statutUser`, `salaireUser`, `domaineUser`, `idParent`, `picUser`) VALUES
(18, 10004578, 'mohsen', 'hssino', '2020-02-12', 'Homme', 'mohsen@gmail.com', NULL, NULL, 'Enseignant', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(137, 12345600, 'Etudiant', 'Esprit', NULL, NULL, 'Etudiant@gmail.com', NULL, NULL, 'Etudiant', NULL, '1234', '3B1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(139, 13235258, NULL, NULL, NULL, NULL, 'root', NULL, NULL, 'root', NULL, '0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(140, 456456, 'sdfgsd', '', '2020-02-24', '', '', 'sdf', 456, 'Parent', NULL, '456456', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(142, 44, 'wsdqs', '', '2020-02-24', '', '', 'sdfsdf', 44444, 'Parent', NULL, '45645', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(144, 789789, 'qsd', '', '2020-02-24', '', '', 'dsf', 56456, 'Parent', NULL, '5645', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(146, 4564, 'sdfsdf', '', '2020-02-24', '', '', 'vdffg', 888, 'Parent', NULL, '9999', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(149, 78, 'sdf', '', '2020-02-24', '', '', 'qsd', 454, 'Parent', NULL, '456', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(151, 458, 'sd', '', '2020-02-24', '', '', 'qsd', 4669, 'Parent', NULL, '44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(153, 454, 'cfg', '', '2020-02-24', '', '', 'sdf', 45, 'Parent', NULL, '213', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(157, 12345611, 'aaaa', 'zzzz', '2020-02-24', 'femme', 'Personnel@gmail.com', 'ssd', 154, 'Personnel', '2020-02-24', '12345678', NULL, NULL, NULL, NULL, 'En cours', 1.11, 'Service Scolarite', NULL, NULL),
(158, 99564, 'sdgf', '', '2020-02-24', '', '', 'sdf', 888, 'Parent', NULL, '444', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(160, 358, 'dfg', '', '2020-02-24', '', '', 'sdgf', 2325, 'Parent', NULL, '1010', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(162, 2301, 'sdf', '', '2020-02-24', '', '', 'sdfs', 8889, 'Parent', NULL, '112222', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(164, 2310, 'qsdf', '', '2020-02-24', '', '', 'sdf', 8564, 'Parent', NULL, '4562', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(166, 8854, 'wdf', '', '2020-02-24', '', '', 'dsf', 456, 'Parent', NULL, '4561', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(168, 966, 'qsd', '', '2020-02-24', '', '', 'sdf', 85, 'Parent', NULL, '110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(170, 95, 'qsd', '', '2020-02-24', '', '', 'dfg', 45, 'Parent', NULL, '1112', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(172, 5245, 'fsdf', '', '2020-02-24', '', '', 'fsdfsd', 968, 'Parent', NULL, '747', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(173, 747, 'hamza', 'ennour', '2020-02-01', 'Homme', 'hamza.ennour@esprit.tn', 'fsdfsd', 7856, 'Etudiant', NULL, '747', '3A5', '2020-02-24', NULL, 'Info', NULL, NULL, NULL, '', NULL),
(174, 44428782, 'gfyhf', '', '2020-02-24', '', '', 'sdf', 45453, 'Parent', NULL, '4442124', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(175, 4442124, 'gg', 'gg', '2020-02-06', 'Homme', 'sdf', 'sdf', 5421, 'Etudiant', NULL, '4442124', '3A55', '2020-02-24', NULL, 'Info', NULL, NULL, NULL, '', NULL),
(176, 11447788, 'yasser', 'Iant', '2020-02-24', '', 'Etud@gmail.com', 'rtghyu', 1447, 'Etudiant', NULL, '1010', '3A55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(185, 4556, 'fdf', 'sbvb', '2020-02-24', 'femme', 'aaa', 'zeef', 786, 'Personnel', '2020-02-24', '1', NULL, NULL, NULL, NULL, 'En cours', 145.33, 'Math', NULL, 'hamzatahan'),
(186, 102486, 'ahmed', 'ben ali', '2020-02-24', 'Femme', 'argo', 'fffd', 4586, 'Enseignant', '2020-02-24', '102486', NULL, NULL, NULL, NULL, 'En cours', 1452.3, 'Math', NULL, 'C:\\Users\\Neifos\\Desktop\\student_PNG62542.png'),
(188, 11223344, 'malek', 'derbali', '2020-02-24', 'Homme', 'aaa', 'sdf', 896, 'Enseignant', '2020-02-24', '1045', NULL, NULL, NULL, NULL, 'Conge', 1001.2, 'Math', NULL, 'profileomar.jpg'),
(189, 12345674, 'Faouzi', '', '2020-02-26', '', '', 'hammamet', 22308390, 'Parent', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(190, 12345678, 'hamza', 'toukebri', '2020-02-12', 'Homme', 'hamza.ennour@esprit.tn', 'hammamet', 24281526, 'Etudiant', NULL, '12345678', '3A55', '2020-02-26', NULL, 'Info', NULL, NULL, NULL, '12345674', NULL),
(191, 12346876, 'taha', '', '2020-02-26', '', '', 'hammamet', 22230935, 'Parent', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(193, 25, 'ahmed', '', '2020-02-26', '', '', 'rue 27 octobre', 88965478, 'Parent', NULL, '11111114', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(194, 11111114, 'sofien', 'ben ali', '2020-02-13', 'Homme', 'sofien.argoubi@esprit.tn', 'rue 27 octobre', 12458963, 'Etudiant', NULL, '11111114', NULL, '2020-02-26', NULL, 'Info', NULL, NULL, NULL, '00000025', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `id_matierss` FOREIGN KEY (`id_matiere`) REFERENCES `matier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_userss` FOREIGN KEY (`id_user`) REFERENCES `users` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `classeenseignantmatiere`
--
ALTER TABLE `classeenseignantmatiere`
  ADD CONSTRAINT `CXCCCCCCCCCCCC` FOREIGN KEY (`id_matiere`) REFERENCES `enseigner` (`idMatiere`),
  ADD CONSTRAINT `FNBVCBV` FOREIGN KEY (`id_class`) REFERENCES `classe` (`Id`),
  ADD CONSTRAINT `sfdsqdqsdqsdXWXW` FOREIGN KEY (`id_user`) REFERENCES `enseigner` (`idEnseignant`);

--
-- Constraints for table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `qsdqsd` FOREIGN KEY (`idResponsable`) REFERENCES `users` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `demandeevenement`
--
ALTER TABLE `demandeevenement`
  ADD CONSTRAINT `qsdqsdqd` FOREIGN KEY (`idClub`) REFERENCES `club` (`idClub`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enseigner`
--
ALTER TABLE `enseigner`
  ADD CONSTRAINT `AAAAAAAAAAAA` FOREIGN KEY (`idMatiere`) REFERENCES `matier` (`id`),
  ADD CONSTRAINT `QQQQQQQQQQQQQQQQQQ` FOREIGN KEY (`idEnseignant`) REFERENCES `users` (`idUser`);

--
-- Constraints for table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `qsdqsdqsdqsd` FOREIGN KEY (`idClub`) REFERENCES `club` (`idClub`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `sqdsssss` FOREIGN KEY (`classeEtd`) REFERENCES `classe` (`Name`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
