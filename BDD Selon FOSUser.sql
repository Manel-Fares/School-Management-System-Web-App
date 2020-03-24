-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 24 mars 2020 à 17:09
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `school`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `calendarannuel`
--

DROP TABLE IF EXISTS `calendarannuel`;
CREATE TABLE IF NOT EXISTS `calendarannuel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `term` varchar(255) NOT NULL,
  `DateC` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `chapitre`
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
-- Structure de la table `classe`
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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `classe`
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
-- Structure de la table `classeenseignantmatiere`
--

DROP TABLE IF EXISTS `classeenseignantmatiere`;
CREATE TABLE IF NOT EXISTS `classeenseignantmatiere` (
  `id_class` int(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL,
  PRIMARY KEY (`id_class`,`id_user`,`id_matiere`),
  KEY `FK_classqqs` (`id_class`),
  KEY `FK_USER` (`id_user`),
  KEY `FK_Matiere` (`id_matiere`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `classeenseignantmatiere`
--

INSERT INTO `classeenseignantmatiere` (`id_class`, `id_user`, `id_matiere`) VALUES
(12, 18, 4),
(12, 18, 5),
(12, 188, 2),
(17, 18, 5);

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

DROP TABLE IF EXISTS `club`;
CREATE TABLE IF NOT EXISTS `club` (
  `idClub` int(11) NOT NULL AUTO_INCREMENT,
  `nomClub` varchar(250) NOT NULL,
  `idResponsable` int(11) NOT NULL,
  `domaine` varchar(250) NOT NULL,
  PRIMARY KEY (`idClub`),
  KEY `qsdqsd` (`idResponsable`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `club`
--

INSERT INTO `club` (`idClub`, `nomClub`, `idResponsable`, `domaine`) VALUES
(1, 'RootClub', 157, 'Responsable');

-- --------------------------------------------------------

--
-- Structure de la table `demandecreationclub`
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
-- Structure de la table `demandeevenement`
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `emplois`
--

DROP TABLE IF EXISTS `emplois`;
CREATE TABLE IF NOT EXISTS `emplois` (
  `IdEmplois` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Heure` time NOT NULL,
  `Source` varchar(255) NOT NULL,
  PRIMARY KEY (`IdEmplois`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emplois`
--

INSERT INTO `emplois` (`IdEmplois`, `Date`, `Heure`, `Source`) VALUES
(4, '2020-02-06', '14:36:00', 'Calcul.txt'),
(6, '2020-02-05', '15:42:00', 'Map.pdf'),
(7, '2020-02-06', '10:47:00', 'wwww.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `enseigner`
--

DROP TABLE IF EXISTS `enseigner`;
CREATE TABLE IF NOT EXISTS `enseigner` (
  `idEnseignant` int(11) NOT NULL,
  `idMatiere` int(11) NOT NULL,
  PRIMARY KEY (`idEnseignant`,`idMatiere`),
  KEY `AAAAAAAAAAAA` (`idMatiere`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `enseigner`
--

INSERT INTO `enseigner` (`idEnseignant`, `idMatiere`) VALUES
(18, 4),
(18, 5);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`idEvenement`, `dateDebut`, `dateFin`, `idClub`, `image`) VALUES
(3, '2020-02-13', '2020-02-20', 1, 'C:\\Users\\Neifos\\Desktop\\Weboss\\src\\weboss\\Image\\event.jfif'),
(4, '2020-02-02', '2020-02-01', 1, 'Path'),
(10, '2020-02-06', '2020-02-07', 1, 'C:\\Users\\Neifos\\Desktop\\Weboss\\src\\weboss\\Image\\f047ea5fe0d366851756138d305f4798.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `matier`
--

DROP TABLE IF EXISTS `matier`;
CREATE TABLE IF NOT EXISTS `matier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `coef` float NOT NULL,
  `responsable` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `responsable` (`responsable`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `matier`
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
-- Structure de la table `note`
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
  PRIMARY KEY (`idEtudiant`,`idMatiere`,`dateNote`),
  KEY `idEnseignant` (`idEnseignant`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `note`
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
-- Structure de la table `question`
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
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id_question`, `body`, `vote_question`, `id_tag`, `id_personne`, `title`, `tag_name`) VALUES
(1, 'null pointer', 1, 1, 137, 'java exception', 'java'),
(2, 'herlp me', 1, 1, 137, 'error java', 'java'),
(3, 'sqd', 1, 1, 137, 'java eprobelm', 'java');

-- --------------------------------------------------------

--
-- Structure de la table `questionquizz`
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
-- Structure de la table `quizz`
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
-- Structure de la table `rating`
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
-- Déchargement des données de la table `rating`
--

INSERT INTO `rating` (`idrating`, `iduser`, `idClub`, `rating`) VALUES
(6, 15, 1, 5),
(5, 131, 213, 5);

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

DROP TABLE IF EXISTS `reclamation`;
CREATE TABLE IF NOT EXISTS `reclamation` (
  `idReclamation` int(11) NOT NULL AUTO_INCREMENT,
  `sujetReclamation` varchar(255) NOT NULL,
  `descriptionReclamation` varchar(255) NOT NULL,
  `statutReclamation` varchar(11) NOT NULL,
  `dateCreation` date NOT NULL,
  `IdEtd` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReclamation`),
  KEY `FK_reclamation` (`IdEtd`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reclamation`
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
-- Structure de la table `reponse`
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
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id_reponse`, `body`, `vote_reponse`, `id_question`) VALUES
(1, 'import packages', 0, 1),
(2, 'qsdqs', 0, 1),
(3, 'add package', 0, 2),
(4, 'fdf', 0, 3),
(5, 'wscdwc', 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `resultat`
--

DROP TABLE IF EXISTS `resultat`;
CREATE TABLE IF NOT EXISTS `resultat` (
  `idEtudiant` int(11) NOT NULL,
  `dateResultat` date NOT NULL,
  `resultat` float DEFAULT NULL,
  PRIMARY KEY (`idEtudiant`,`dateResultat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `resultat`
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
-- Structure de la table `sondage`
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
-- Déchargement des données de la table `sondage`
--

INSERT INTO `sondage` (`id_sondage`, `id_club`, `titre`, `description`, `reponse`) VALUES
(1, 455, 'lll', 'dfghjk', 'Null');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id_tag` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tag`
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
  `classeEtd` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inscriptionEtd` date DEFAULT NULL,
  `nomResponsableEtd` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specialiteEtd` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statutUser` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salaireUser` double DEFAULT NULL,
  `domaineUser` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idParent` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picUser` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_1483A5E9A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_1483A5E9C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `cinUser`, `nomUser`, `prenomUser`, `DateNaissanceUser`, `sexeUser`, `emailUser`, `adresseUser`, `numTelUser`, `roleUser`, `dateEmbaucheUser`, `motDePasseUser`, `classeEtd`, `inscriptionEtd`, `nomResponsableEtd`, `specialiteEtd`, `statutUser`, `salaireUser`, `domaineUser`, `idParent`, `picUser`) VALUES
(1, 'manel', 'manel', 'manel@gmail.com', 'manel@gmail.com', 1, NULL, '$2y$13$EF7QV5pwqNJEwDwqtviMwe/CXNG4kLt3FDan6UsZ6pk6qdGC5WbQu', '2020-03-24 17:07:42', NULL, NULL, 'a:0:{}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
