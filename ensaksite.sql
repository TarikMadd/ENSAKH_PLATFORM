-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 10, 2019 at 10:04 PM
-- Server version: 5.7.23
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ensaksite`
--

-- --------------------------------------------------------

--
-- Table structure for table `absences`
--

DROP TABLE IF EXISTS `absences`;
CREATE TABLE IF NOT EXISTS `absences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fonctionnaire_id` int(11) NOT NULL,
  `duree_ab` float NOT NULL,
  `cause` varchar(255) NOT NULL,
  `date_ab` date NOT NULL,
  `time_ab` time NOT NULL,
  `isvalid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fonctionnaire_id` (`fonctionnaire_id`),
  KEY `absences_fonctionnaires_id_foreign` (`fonctionnaire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `access_admis`
--

DROP TABLE IF EXISTS `access_admis`;
CREATE TABLE IF NOT EXISTS `access_admis` (
  `id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL,
  `access` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `access_admis_groupes_id_foreign` (`groupe_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `activites`
--

DROP TABLE IF EXISTS `activites`;
CREATE TABLE IF NOT EXISTS `activites` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nomActivite` varchar(60) NOT NULL,
  `dateDebut` varchar(100) DEFAULT NULL,
  `dateFin` varchar(40) NOT NULL,
  `photo` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `activitesdespreinscriptions`
--

DROP TABLE IF EXISTS `activitesdespreinscriptions`;
CREATE TABLE IF NOT EXISTS `activitesdespreinscriptions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `libile` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `activitesdespreinscriptions_preinscriptions`
--

DROP TABLE IF EXISTS `activitesdespreinscriptions_preinscriptions`;
CREATE TABLE IF NOT EXISTS `activitesdespreinscriptions_preinscriptions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `preinscription_id` int(10) NOT NULL,
  `activitesdespreinscription_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `preinscriptions_id` (`preinscription_id`),
  KEY `activitesdespreinscription_id` (`activitesdespreinscription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `actualiteclubs`
--

DROP TABLE IF EXISTS `actualiteclubs`;
CREATE TABLE IF NOT EXISTS `actualiteclubs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(600) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `texte` text CHARACTER SET utf8 NOT NULL,
  `id_club` int(11) NOT NULL,
  `image` varchar(110) CHARACTER SET utf8 DEFAULT NULL,
  `video` varchar(110) CHARACTER SET utf8 DEFAULT NULL,
  `fichier` varchar(600) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_club` (`id_club`),
  KEY `id_club_2` (`id_club`),
  KEY `id_image` (`image`,`video`),
  KEY `id_video` (`video`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `actualites`
--

DROP TABLE IF EXISTS `actualites`;
CREATE TABLE IF NOT EXISTS `actualites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(600) CHARACTER SET latin1 NOT NULL,
  `texte` text CHARACTER SET latin1 NOT NULL,
  `date` date NOT NULL,
  `photo` varchar(600) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `annee_scolaires`
--

DROP TABLE IF EXISTS `annee_scolaires`;
CREATE TABLE IF NOT EXISTS `annee_scolaires` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `libile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `annee` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `annee_scolaires`
--

INSERT INTO `annee_scolaires` (`id`, `libile`, `annee`) VALUES
(1, '2018/2019', '2019-01-31'),
(2, '2', '2019-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `articleevents`
--

DROP TABLE IF EXISTS `articleevents`;
CREATE TABLE IF NOT EXISTS `articleevents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desigantion` text,
  `quantite` int(11) DEFAULT NULL,
  `prix_unitaire_ht` float DEFAULT NULL,
  `devisdemande_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_categorie_id` int(11) NOT NULL,
  `label_article` varchar(50) DEFAULT NULL,
  `quantite_min` int(11) DEFAULT NULL,
  `marque` varchar(50) DEFAULT NULL,
  `utilite` tinyint(1) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `date_article` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `stock_categorie_id` (`stock_categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `stock_categorie_id`, `label_article`, `quantite_min`, `marque`, `utilite`, `quantite`, `date_article`) VALUES
(2, 1, 'table', 120, 'Ikea', NULL, 95, '2019-02-10 19:04:20'),
(3, 1, 'fenetre', 120, 'Ikea', NULL, 100, '2019-02-10 19:07:44'),
(4, 2, 'Ballons', 50, 'Mikasa', NULL, 100, '2019-02-10 19:16:07'),
(5, 2, 'Halteres', 50, 'allFit', NULL, 100, '2019-02-10 19:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `asupprimer`
--

DROP TABLE IF EXISTS `asupprimer`;
CREATE TABLE IF NOT EXISTS `asupprimer` (
  `message_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`message_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `autorisations`
--

DROP TABLE IF EXISTS `autorisations`;
CREATE TABLE IF NOT EXISTS `autorisations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `groupe_id` int(10) NOT NULL,
  `annee_scolaire_id` int(10) NOT NULL,
  `semestre_id` int(10) NOT NULL,
  `isnormal` int(2) DEFAULT '0',
  `isratt` int(2) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `autorisations_groupes_id_foreign` (`groupe_id`),
  KEY `autorisations_annee_scolaires_id_foreign` (`annee_scolaire_id`),
  KEY `autorisations_semestres_id_foreign` (`semestre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `boncommandes`
--

DROP TABLE IF EXISTS `boncommandes`;
CREATE TABLE IF NOT EXISTS `boncommandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exercice` int(11) DEFAULT NULL,
  `prix_total` float DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `devisdemande_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `auteur` varchar(20) NOT NULL,
  `edition` varchar(20) NOT NULL,
  `resumer` text NOT NULL,
  `image` varchar(300) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `numInventaire` varchar(7) NOT NULL,
  `nbExemplaire` int(3) NOT NULL,
  `sous_categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numInventaire` (`numInventaire`),
  KEY `sous_categorie_id` (`sous_categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `calendriers`
--

DROP TABLE IF EXISTS `calendriers`;
CREATE TABLE IF NOT EXISTS `calendriers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(30) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `certificats`
--

DROP TABLE IF EXISTS `certificats`;
CREATE TABLE IF NOT EXISTS `certificats` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `nombre_max` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `certificats_etudiants`
--

DROP TABLE IF EXISTS `certificats_etudiants`;
CREATE TABLE IF NOT EXISTS `certificats_etudiants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `certificat_id` int(11) NOT NULL,
  `etudiant_id` int(11) NOT NULL,
  `etat` enum('Demande envoyé','En cours de traitement','Rejeter','Prête','Délivré') NOT NULL,
  `commentaire` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `entreprise` varchar(255) DEFAULT NULL,
  `raison_retrait` text,
  `duree_stage` int(11) NOT NULL,
  `theme_stage` varchar(255) DEFAULT NULL,
  `debut_stage` date NOT NULL,
  `fin_stage` date NOT NULL,
  `profpermanent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

DROP TABLE IF EXISTS `clubs`;
CREATE TABLE IF NOT EXISTS `clubs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(600) NOT NULL,
  `mission` varchar(600) NOT NULL,
  `datePost` date NOT NULL,
  `mot` text NOT NULL,
  `texte` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delai_limite` date NOT NULL,
  `nom` text NOT NULL,
  `stock_categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categorie_id` (`stock_categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`id`, `delai_limite`, `nom`, `stock_categorie_id`) VALUES
(1, '2024-01-01', 'Equipements info', 1);

-- --------------------------------------------------------

--
-- Table structure for table `commande_articles`
--

DROP TABLE IF EXISTS `commande_articles`;
CREATE TABLE IF NOT EXISTS `commande_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commande_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_test` (`commande_id`),
  KEY `article_id` (`article_id`),
  KEY `article_id_2` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comptes`
--

DROP TABLE IF EXISTS `comptes`;
CREATE TABLE IF NOT EXISTS `comptes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `numero` varchar(20) NOT NULL,
  `descriptions` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `concours`
--

DROP TABLE IF EXISTS `concours`;
CREATE TABLE IF NOT EXISTS `concours` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `niveaus_id` int(10) DEFAULT NULL,
  `filiere_id` int(10) DEFAULT NULL,
  `etat` int(2) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `niveaus_id` (`niveaus_id`),
  KEY `filiere_id` (`filiere_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `telephone1` varchar(200) NOT NULL,
  `telephone2` varchar(200) NOT NULL,
  `telephone3` varchar(200) NOT NULL,
  `mail` varchar(300) NOT NULL,
  `adresse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courrier_arrivees`
--

DROP TABLE IF EXISTS `courrier_arrivees`;
CREATE TABLE IF NOT EXISTS `courrier_arrivees` (
  `date_arrivee` date NOT NULL,
  `Désignation` varchar(255) NOT NULL,
  `expediteur_id` int(11) NOT NULL,
  `type_courrier` varchar(255) NOT NULL,
  `Priorité` varchar(255) NOT NULL,
  `date_limite_du_traitement` date DEFAULT NULL,
  `etat_du_courrier` varchar(255) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `necessité_du_traitement` varchar(225) NOT NULL,
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `courrier` varchar(255) NOT NULL,
  `accuse` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courrier_departs`
--

DROP TABLE IF EXISTS `courrier_departs`;
CREATE TABLE IF NOT EXISTS `courrier_departs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_depart` date NOT NULL,
  `désignation` varchar(255) NOT NULL,
  `destinataire_id` varchar(255) NOT NULL,
  `type_courrier` varchar(255) NOT NULL,
  `service` varchar(255) DEFAULT NULL,
  `necessite` varchar(255) NOT NULL,
  `etat_courrier` varchar(255) NOT NULL,
  `courrier` varchar(255) NOT NULL,
  `accuse` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `destinataire_id` (`destinataire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `demande_auth`
--

DROP TABLE IF EXISTS `demande_auth`;
CREATE TABLE IF NOT EXISTS `demande_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classe_id` int(11) NOT NULL,
  `prof_id` int(11) DEFAULT NULL,
  `pv` tinyint(1) NOT NULL DEFAULT '0',
  `state` double NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profvacataire_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `demande_auth_classe_id_foreign` (`classe_id`),
  KEY `demande_auth_prof_id_foreign` (`prof_id`),
  KEY `demande_auth_profvacataire_id_foreign` (`profvacataire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `departements`
--

DROP TABLE IF EXISTS `departements`;
CREATE TABLE IF NOT EXISTS `departements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom_departement` varchar(40) NOT NULL,
  `nb_filiere` int(11) NOT NULL,
  `refer_depart` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_departement` (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departements`
--

INSERT INTO `departements` (`id`, `nom_departement`, `nb_filiere`, `refer_depart`) VALUES
(1, 'gi', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `destinataires`
--

DROP TABLE IF EXISTS `destinataires`;
CREATE TABLE IF NOT EXISTS `destinataires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomComplet_destinataire` varchar(255) NOT NULL,
  `adresse_destinataire` varchar(255) NOT NULL,
  `email_destinataire` varchar(255) NOT NULL,
  `telephone_destinataire` varchar(255) NOT NULL,
  `ville_destinataire` varchar(255) NOT NULL,
  `pays_destinataire` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nomComplet_destinataire` (`nomComplet_destinataire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `devisdemandes`
--

DROP TABLE IF EXISTS `devisdemandes`;
CREATE TABLE IF NOT EXISTS `devisdemandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_devis` text,
  `nom_fournisseur` text,
  `adresse_fournisseur` text,
  `intitule` text,
  `etat` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `diffusions_messages`
--

DROP TABLE IF EXISTS `diffusions_messages`;
CREATE TABLE IF NOT EXISTS `diffusions_messages` (
  `message_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `typerecepteur` varchar(80) NOT NULL,
  `group_id` int(10) DEFAULT NULL,
  `departement_id` int(10) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`message_id`,`user_id`),
  KEY `fk_user_sender` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diffusions_messages`
--

INSERT INTO `diffusions_messages` (`message_id`, `user_id`, `typerecepteur`, `group_id`, `departement_id`, `date`) VALUES
(3, 4, 'profsParFiliere', 1, NULL, '2019-01-14 16:00:23'),
(9, 4, 'profs', NULL, NULL, '2019-02-03 14:20:19'),
(10, 4, 'etudiantsParFiliereSco', 1, NULL, '2019-02-03 14:29:01');

-- --------------------------------------------------------

--
-- Table structure for table `disciplines`
--

DROP TABLE IF EXISTS `disciplines`;
CREATE TABLE IF NOT EXISTS `disciplines` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom_discipline` varchar(30) NOT NULL,
  `domaine_discipline` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idDocument` int(11) NOT NULL,
  `nbDocument` int(11) NOT NULL,
  `nomDocument` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `elements`
--

DROP TABLE IF EXISTS `elements`;
CREATE TABLE IF NOT EXISTS `elements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `libile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module_id` int(10) NOT NULL,
  `CM` int(11) NOT NULL,
  `Eval` int(11) NOT NULL,
  `AP` int(11) NOT NULL,
  `TP` int(11) NOT NULL,
  `TD` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `elements_modules_id_foreign` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elements`
--

INSERT INTO `elements` (`id`, `code`, `libile`, `module_id`, `CM`, `Eval`, `AP`, `TP`, `TD`) VALUES
(1, 'code', 'libile', 3, 11, 5, 7, 9, 0),
(2, 'code', 'libile', 1, 22, 5, 7, 9, 0),
(3, '12324X', 'ZDE', 1, 11, 23, 232, 223, 23);

-- --------------------------------------------------------

--
-- Table structure for table `enseigners`
--

DROP TABLE IF EXISTS `enseigners`;
CREATE TABLE IF NOT EXISTS `enseigners` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `semestre_id` int(10) NOT NULL,
  `annee_scolaire_id` int(10) NOT NULL,
  `element_id` int(10) NOT NULL,
  `profpermanent_id` int(10) DEFAULT NULL,
  `vacataire_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enseigners_profpermanent_id_foreign` (`profpermanent_id`),
  KEY `enseigners_annee_scolaires_id_foreign` (`annee_scolaire_id`),
  KEY `enseigners_elements_id_foreign` (`element_id`),
  KEY `enseigners_semestres_id_foreign` (`semestre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `enseigners`
--

INSERT INTO `enseigners` (`id`, `semestre_id`, `annee_scolaire_id`, `element_id`, `profpermanent_id`, `vacataire_id`) VALUES
(1, 1, 1, 2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `equiperecherches`
--

DROP TABLE IF EXISTS `equiperecherches`;
CREATE TABLE IF NOT EXISTS `equiperecherches` (
  `intitule` varchar(600) NOT NULL,
  `responsable` varchar(600) NOT NULL,
  `id_recherche` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `apogee` varchar(50) DEFAULT NULL,
  `nom_fr` varchar(50) DEFAULT NULL,
  `nom_ar` varchar(50) DEFAULT NULL,
  `prenom_fr` varchar(50) DEFAULT NULL,
  `prenom_ar` varchar(50) DEFAULT NULL,
  `cne` int(20) DEFAULT NULL,
  `cin` varchar(50) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `code_ville_naissance` varchar(50) DEFAULT NULL,
  `ville_naissance_fr` varchar(50) DEFAULT NULL,
  `ville_naissance_ar` varchar(50) DEFAULT NULL,
  `code_pays_naissance` varchar(50) DEFAULT NULL,
  `pays_naissance_fr` varchar(50) DEFAULT NULL,
  `pays_naissance_ar` varchar(50) DEFAULT NULL,
  `code_sexe` enum('m','f') DEFAULT NULL,
  `sexe_fr` varchar(50) DEFAULT NULL,
  `sexe_ar` varchar(50) DEFAULT NULL,
  `code_adresse_fix` text,
  `adresse_fix_fr` text,
  `adresse_fix_ar` text,
  `adresse_annulle_fr` text,
  `adresse_annulle_ar` text,
  `annee_1er_inscription_universite` varchar(50) DEFAULT NULL,
  `annee_1er_inscription_enseignement_superieur` varchar(50) DEFAULT NULL,
  `annee_1er_inscription_universite_marocaine` varchar(50) DEFAULT NULL,
  `code_bac` varchar(50) DEFAULT NULL,
  `serie_bac_fr` varchar(50) DEFAULT NULL,
  `serie_bac_ar` varchar(50) DEFAULT NULL,
  `code_etablissement_bac` varchar(50) DEFAULT NULL,
  `etablissement_bac_fr` varchar(50) DEFAULT NULL,
  `etablissement_bac_ar` varchar(50) DEFAULT NULL,
  `code_mention_bac` varchar(50) DEFAULT NULL,
  `mention_bac` varchar(50) DEFAULT NULL,
  `code_province_bac` varchar(50) DEFAULT NULL,
  `province_bac_fr` varchar(50) DEFAULT NULL,
  `province_bac_ar` varchar(50) DEFAULT NULL,
  `annee_bac` varchar(50) DEFAULT NULL,
  `code_type_handicap` varchar(50) DEFAULT NULL,
  `type_handicap` varchar(50) DEFAULT NULL,
  `code_type_hebergement` varchar(50) DEFAULT NULL,
  `type_hebergement` varchar(50) DEFAULT NULL,
  `code_situation_familiale` varchar(50) DEFAULT NULL,
  `situation_familiale` varchar(50) DEFAULT NULL,
  `situation_militaire` varchar(50) DEFAULT NULL,
  `categorie_socio_professionnelle` varchar(50) DEFAULT NULL,
  `domaine_activite_professionnelle` varchar(50) DEFAULT NULL,
  `quatite_Travaillee` varchar(50) DEFAULT NULL,
  `profession_pere_fr` varchar(50) DEFAULT NULL,
  `profession_pere_ar` varchar(50) DEFAULT NULL,
  `profession_mere_fr` varchar(50) DEFAULT NULL,
  `profession_mere_ar` varchar(50) DEFAULT NULL,
  `code_province_parents` varchar(50) DEFAULT NULL,
  `province_parents_fr` varchar(50) DEFAULT NULL,
  `province_parents_ar` varchar(50) DEFAULT NULL,
  `annee_sortie` varchar(50) DEFAULT NULL,
  `code_cite_universiatire` varchar(50) DEFAULT NULL,
  `cite_universiatire` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `validi` int(2) DEFAULT '0',
  `validi_respo` int(2) DEFAULT '0',
  `numero_tel` varchar(600) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `apogee` (`apogee`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `etudiants`
--

INSERT INTO `etudiants` (`id`, `user_id`, `apogee`, `nom_fr`, `nom_ar`, `prenom_fr`, `prenom_ar`, `cne`, `cin`, `date_naissance`, `code_ville_naissance`, `ville_naissance_fr`, `ville_naissance_ar`, `code_pays_naissance`, `pays_naissance_fr`, `pays_naissance_ar`, `code_sexe`, `sexe_fr`, `sexe_ar`, `code_adresse_fix`, `adresse_fix_fr`, `adresse_fix_ar`, `adresse_annulle_fr`, `adresse_annulle_ar`, `annee_1er_inscription_universite`, `annee_1er_inscription_enseignement_superieur`, `annee_1er_inscription_universite_marocaine`, `code_bac`, `serie_bac_fr`, `serie_bac_ar`, `code_etablissement_bac`, `etablissement_bac_fr`, `etablissement_bac_ar`, `code_mention_bac`, `mention_bac`, `code_province_bac`, `province_bac_fr`, `province_bac_ar`, `annee_bac`, `code_type_handicap`, `type_handicap`, `code_type_hebergement`, `type_hebergement`, `code_situation_familiale`, `situation_familiale`, `situation_militaire`, `categorie_socio_professionnelle`, `domaine_activite_professionnelle`, `quatite_Travaillee`, `profession_pere_fr`, `profession_pere_ar`, `profession_mere_fr`, `profession_mere_ar`, `code_province_parents`, `province_parents_fr`, `province_parents_ar`, `annee_sortie`, `code_cite_universiatire`, `cite_universiatire`, `created`, `modified`, `photo`, `validi`, `validi_respo`, `numero_tel`, `email`) VALUES
(1, 3, 'apogee', 'hasnae', 'hasnae', 'hasnae', 'hasnae', 544545, 'aef44', '2019-01-02', NULL, NULL, NULL, NULL, NULL, NULL, 'f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `etudiers`
--

DROP TABLE IF EXISTS `etudiers`;
CREATE TABLE IF NOT EXISTS `etudiers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `etudiant_id` int(10) NOT NULL,
  `annee_scolaire_id` int(10) NOT NULL,
  `groupe_id` int(10) NOT NULL,
  `element_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `etudiers_etudiants_id_foreign` (`etudiant_id`),
  KEY `etudiers_annee_scolaires_id_foreign` (`annee_scolaire_id`),
  KEY `etudiers_classes_id_foreign` (`groupe_id`),
  KEY `etudiers_elements_id_foreign` (`element_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `etudiers`
--

INSERT INTO `etudiers` (`id`, `etudiant_id`, `annee_scolaire_id`, `groupe_id`, `element_id`) VALUES
(1, 1, 1, 2, 2),
(2, 1, 1, 2, 1),
(3, 1, 1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `adresse` varchar(600) NOT NULL,
  `tele` varchar(30) NOT NULL,
  `texte` text NOT NULL,
  `website` varchar(600) CHARACTER SET utf8 NOT NULL,
  `membre` int(11) NOT NULL,
  `invite` int(11) NOT NULL,
  `photo` varchar(600) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expediteurs`
--

DROP TABLE IF EXISTS `expediteurs`;
CREATE TABLE IF NOT EXISTS `expediteurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomComplet_expediteur` varchar(255) DEFAULT NULL,
  `adresse_expediteur` varchar(255) DEFAULT NULL,
  `email_expediteur` varchar(255) DEFAULT NULL,
  `telephone_expediteur` int(255) DEFAULT NULL,
  `ville_expediteur` varchar(255) DEFAULT NULL,
  `pays_expediteur` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `filieres`
--

DROP TABLE IF EXISTS `filieres`;
CREATE TABLE IF NOT EXISTS `filieres` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `libile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `filieres`
--

INSERT INTO `filieres` (`id`, `libile`) VALUES
(1, 'gi'),
(2, 'ge');

-- --------------------------------------------------------

--
-- Table structure for table `fonctionnaires`
--

DROP TABLE IF EXISTS `fonctionnaires`;
CREATE TABLE IF NOT EXISTS `fonctionnaires` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `somme` varchar(30) NOT NULL,
  `date_Recrut` date NOT NULL,
  `salaire` float NOT NULL,
  `etat` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `nom_fct` varchar(30) NOT NULL,
  `prenom_fct` varchar(30) NOT NULL,
  `dateNaissance` date NOT NULL,
  `lieuNaissance` varchar(40) NOT NULL,
  `specialite` varchar(20) NOT NULL,
  `situation_Familiale` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `etat_attestation` int(11) NOT NULL DEFAULT '0',
  `etat_fiche` int(11) DEFAULT '0',
  `phone` int(25) NOT NULL,
  `CIN` varchar(11) NOT NULL,
  `age` int(3) NOT NULL,
  `genre` varchar(10) NOT NULL,
  `nbr_enfants` int(11) NOT NULL,
  `isPassExam` int(11) NOT NULL DEFAULT '0',
  `photo` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fonctionnaires`
--

INSERT INTO `fonctionnaires` (`id`, `somme`, `date_Recrut`, `salaire`, `etat`, `user_id`, `nom_fct`, `prenom_fct`, `dateNaissance`, `lieuNaissance`, `specialite`, `situation_Familiale`, `email`, `etat_attestation`, `etat_fiche`, `phone`, `CIN`, `age`, `genre`, `nbr_enfants`, `isPassExam`, `photo`) VALUES
(1, '20000', '2019-02-04', 10000, 1, 10, 'molStock', 'prenom', '1997-01-15', 'CASA', 'Fournitures', 'Marrie', 'stock@gmail.com', 0, 0, 123456, 'BL1234', 44, 'Mr', 3, 1, '12344433444');

-- --------------------------------------------------------

--
-- Table structure for table `fonctionnaires_activites`
--

DROP TABLE IF EXISTS `fonctionnaires_activites`;
CREATE TABLE IF NOT EXISTS `fonctionnaires_activites` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fonctionnaire_id` int(10) NOT NULL,
  `activite_id` int(10) NOT NULL,
  `poste_comite` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fonctionnaires_id` (`fonctionnaire_id`),
  KEY `activites_id` (`activite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fonctionnaires_documents`
--

DROP TABLE IF EXISTS `fonctionnaires_documents`;
CREATE TABLE IF NOT EXISTS `fonctionnaires_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fonctionnaire_id` int(10) NOT NULL,
  `document_id` int(10) NOT NULL,
  `dateDemande` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etatdemande` varchar(30) NOT NULL DEFAULT 'Demande envoyé',
  PRIMARY KEY (`id`),
  KEY `fonctionnaire_id` (`fonctionnaire_id`),
  KEY `document_id` (`document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fonctionnaires_grades`
--

DROP TABLE IF EXISTS `fonctionnaires_grades`;
CREATE TABLE IF NOT EXISTS `fonctionnaires_grades` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fonctionnaire_id` int(10) NOT NULL,
  `grade_id` int(10) NOT NULL,
  `date_grade` date NOT NULL,
  `date_echelon_rapide` date NOT NULL,
  `date_echelon_moyen` date NOT NULL,
  `date_echelon_normal` date NOT NULL,
  `echelon` int(11) NOT NULL,
  `categorie` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fonctionnaire_id` (`fonctionnaire_id`),
  KEY `grade_id` (`grade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fonctionnaires_services`
--

DROP TABLE IF EXISTS `fonctionnaires_services`;
CREATE TABLE IF NOT EXISTS `fonctionnaires_services` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fonctionnaire_id` int(10) NOT NULL,
  `service_id` int(10) NOT NULL,
  `date_debut` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fonctionnaire_id` (`fonctionnaire_id`),
  KEY `service_id` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `formationcontinues`
--

DROP TABLE IF EXISTS `formationcontinues`;
CREATE TABLE IF NOT EXISTS `formationcontinues` (
  `type` varchar(300) NOT NULL,
  `nomComplet` varchar(600) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `formationinitiales`
--

DROP TABLE IF EXISTS `formationinitiales`;
CREATE TABLE IF NOT EXISTS `formationinitiales` (
  `titre` varchar(600) NOT NULL,
  `presentation` text NOT NULL,
  `objectif` text NOT NULL,
  `debouchet` text NOT NULL,
  `condidat` text NOT NULL,
  `processus` text NOT NULL,
  `organisation` text NOT NULL,
  `id_document` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `formations`
--

DROP TABLE IF EXISTS `formations`;
CREATE TABLE IF NOT EXISTS `formations` (
  `titre` varchar(600) NOT NULL,
  `presentation` text NOT NULL,
  `objectif` text NOT NULL,
  `debouchet` text NOT NULL,
  `condidat` text NOT NULL,
  `processus` text NOT NULL,
  `organisation` text NOT NULL,
  `id_document` int(11) DEFAULT NULL,
  KEY `id_document` (`id_document`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fournisseurs`
--

DROP TABLE IF EXISTS `fournisseurs`;
CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_categorie_id` int(11) NOT NULL,
  `nom_fournisseur` varchar(50) DEFAULT NULL,
  `prenom_fournisseur` varchar(50) DEFAULT NULL,
  `label_fournisseur` varchar(50) DEFAULT NULL,
  `adresse` text,
  `email` text,
  PRIMARY KEY (`id`),
  KEY `stock_categorie_id` (`stock_categorie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
CREATE TABLE IF NOT EXISTS `grades` (
  `id` int(10) NOT NULL,
  `codeGrade` int(11) NOT NULL,
  `taux` float NOT NULL,
  `nomGrade` varchar(50) NOT NULL,
  `categorie` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groupes`
--

DROP TABLE IF EXISTS `groupes`;
CREATE TABLE IF NOT EXISTS `groupes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `niveaus_id` int(10) NOT NULL,
  `filiere_id` int(10) NOT NULL,
  `photo_emploi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `classes_niveaus_id_foreign` (`niveaus_id`),
  KEY `classes_filiere_id_foreign` (`filiere_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groupes`
--

INSERT INTO `groupes` (`id`, `niveaus_id`, `filiere_id`, `photo_emploi`) VALUES
(1, 1, 2, ''),
(2, 1, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `historiqueemprunte`
--

DROP TABLE IF EXISTS `historiqueemprunte`;
CREATE TABLE IF NOT EXISTS `historiqueemprunte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `book_id` int(4) NOT NULL,
  `dateEmprunte` date NOT NULL,
  `dateRetour` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lien` varchar(600) NOT NULL,
  `commentaire` varchar(600) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laureats`
--

DROP TABLE IF EXISTS `laureats`;
CREATE TABLE IF NOT EXISTS `laureats` (
  `id` int(11) NOT NULL,
  `annee` year(4) NOT NULL,
  `nombresTravailles` int(11) NOT NULL,
  `nombresNonTravailles` int(11) NOT NULL,
  `filieres` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `magasins`
--

DROP TABLE IF EXISTS `magasins`;
CREATE TABLE IF NOT EXISTS `magasins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_magasin` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `magasins`
--

INSERT INTO `magasins` (`id`, `nom_magasin`) VALUES
(9, 'magasin2');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sujet` varchar(60) NOT NULL,
  `contenu` text,
  `piecejointe` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sujet`, `contenu`, `piecejointe`) VALUES
(1, 'hhhh', '\r\n                    ', ''),
(2, 'hhh', '\r\n                    ', ''),
(3, 'hhh', '\r\n                    ', ''),
(4, 'hhh', '\r\n                    ', ''),
(5, 'azerty', '\r\n                    ', ''),
(6, 'aeryu', '\r\n                    ', ''),
(7, 'tp unix', '\r\n                    ', '/Ensaksite/Ensaksite/webroot/messageriesFiles/6azerty.docx'),
(8, 'tp unix', '\r\n                    ', ''),
(9, 'hhh', '\r\n                    ', ''),
(10, 'hasna test', '\r\n                    ', ''),
(11, 'oumaima', '\r\n                    ', ''),
(12, 'hhh', '\r\n                    ', ''),
(13, 'hhh', '\r\n                    ', ''),
(14, 'dsxds', 'dsdvdfdf\r\n                    ', ''),
(15, 'xgvQ', 'XSJHVCDSHV\r\n                    ', '');

-- --------------------------------------------------------

--
-- Table structure for table `messagesbureauordres`
--

DROP TABLE IF EXISTS `messagesbureauordres`;
CREATE TABLE IF NOT EXISTS `messagesbureauordres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` text,
  `piecejointe` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `missions`
--

DROP TABLE IF EXISTS `missions`;
CREATE TABLE IF NOT EXISTS `missions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_depart` date NOT NULL,
  `date_arrivee` date NOT NULL,
  `mode_transport` varchar(255) NOT NULL,
  `nbr_nuit` int(11) NOT NULL,
  `taux` int(11) NOT NULL,
  `indemnite_kilometrique` float NOT NULL,
  `indemnite_appliquee` int(11) NOT NULL,
  `montant_indemnite` float NOT NULL,
  `Motif` text NOT NULL,
  `total` float NOT NULL,
  `fonctionnaire_id` int(11) DEFAULT NULL,
  `profpermanent_id` int(11) DEFAULT NULL,
  `ville_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ville_id` (`ville_id`),
  KEY `profpermanent_id` (`profpermanent_id`),
  KEY `fonctionnaires_id` (`fonctionnaire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `libile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `groupe_id` int(10) NOT NULL,
  `semestre_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `modules_groupe_id_foreign` (`groupe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `libile`, `groupe_id`, `semestre_id`) VALUES
(1, 'php', 2, 1),
(2, 'hh', 1, 2),
(3, 'uml', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `motdirecteurs`
--

DROP TABLE IF EXISTS `motdirecteurs`;
CREATE TABLE IF NOT EXISTS `motdirecteurs` (
  `nomComplet` varchar(600) NOT NULL,
  `texte` text NOT NULL,
  `photo` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mouvements`
--

DROP TABLE IF EXISTS `mouvements`;
CREATE TABLE IF NOT EXISTS `mouvements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `magasin_id` int(11) NOT NULL,
  `date_mouvement` datetime DEFAULT NULL,
  `reference_entree` varchar(255) DEFAULT NULL,
  `reference_sortie` varchar(255) DEFAULT NULL,
  `quantite_entree` int(11) DEFAULT NULL,
  `quantite_sortie` int(11) DEFAULT NULL,
  `service` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  KEY `magasin_id` (`magasin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mouvements`
--

INSERT INTO `mouvements` (`id`, `article_id`, `magasin_id`, `date_mouvement`, `reference_entree`, `reference_sortie`, `quantite_entree`, `quantite_sortie`, `service`) VALUES
(36, 2, 9, '2019-02-10 19:53:00', NULL, 'ref1', NULL, 10, 'Transport'),
(39, 2, 9, '2019-02-10 20:07:00', NULL, 'ref2', NULL, 20, 'BLA'),
(38, 2, 9, '2019-02-10 19:53:00', '12', 'ref1', 5, 10, 'Transport');

-- --------------------------------------------------------

--
-- Table structure for table `niveaus`
--

DROP TABLE IF EXISTS `niveaus`;
CREATE TABLE IF NOT EXISTS `niveaus` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `libile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `niveaus`
--

INSERT INTO `niveaus` (`id`, `libile`) VALUES
(1, '11'),
(2, '22');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `element_id` int(10) NOT NULL,
  `etudier_id` int(10) NOT NULL,
  `note` float DEFAULT NULL,
  `note_ratt` float DEFAULT NULL,
  `confirmed` int(2) DEFAULT '0',
  `ratt_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `saved` int(2) DEFAULT '0',
  `ratt_saved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `element_id`, `etudier_id`, `note`, `note_ratt`, `confirmed`, `ratt_confirmed`, `saved`, `ratt_saved`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 10, NULL, 0, 0, 0, 0, '2005-02-19 11:02:00', '2005-02-19 11:02:00'),
(2, 2, 1, 12, NULL, 0, 0, 0, 0, '2005-02-19 11:02:00', '2005-02-19 11:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `notes_auth`
--

DROP TABLE IF EXISTS `notes_auth`;
CREATE TABLE IF NOT EXISTS `notes_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profpermanent_id` int(11) DEFAULT NULL,
  `key_module` varchar(255) NOT NULL,
  `date_valide` datetime NOT NULL,
  `for_ratt` tinyint(1) NOT NULL DEFAULT '0',
  `pv` tinyint(1) NOT NULL,
  `profvacataire_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notes_auth_profpermanent_id_foreign` (`profpermanent_id`),
  KEY `notes_auth_profvacataire_id_foreign` (`profvacataire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notifications_groupe`
--

DROP TABLE IF EXISTS `notifications_groupe`;
CREATE TABLE IF NOT EXISTS `notifications_groupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `principale` text NOT NULL,
  `commentaire` varchar(255) DEFAULT '---------------------',
  `lien` text NOT NULL,
  `style` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications_users`
--

DROP TABLE IF EXISTS `notifications_users`;
CREATE TABLE IF NOT EXISTS `notifications_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `principale` text NOT NULL,
  `commentaire` varchar(255) DEFAULT '---------------------',
  `lien` text NOT NULL,
  `style` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ordrepaiements`
--

DROP TABLE IF EXISTS `ordrepaiements`;
CREATE TABLE IF NOT EXISTS `ordrepaiements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificateur_fiscale` int(11) DEFAULT NULL,
  `num_compte_fournisseur` int(11) DEFAULT NULL,
  `num_compte_paiement` int(11) DEFAULT NULL,
  `num_facture` int(11) DEFAULT NULL,
  `exercice` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `devisdemande_id` int(11) DEFAULT NULL,
  `banque` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ordrevirments`
--

DROP TABLE IF EXISTS `ordrevirments`;
CREATE TABLE IF NOT EXISTS `ordrevirments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `datevairement` date NOT NULL,
  `lien` varchar(30) NOT NULL,
  `commentaire` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `organisations`
--

DROP TABLE IF EXISTS `organisations`;
CREATE TABLE IF NOT EXISTS `organisations` (
  `activite_id` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idActivite` (`activite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paimentsups`
--

DROP TABLE IF EXISTS `paimentsups`;
CREATE TABLE IF NOT EXISTS `paimentsups` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `Numero` int(11) DEFAULT NULL,
  `cheque` varchar(30) DEFAULT NULL,
  `montantBrut` float DEFAULT NULL,
  `Impot` float DEFAULT NULL,
  `MontantNet` float DEFAULT NULL,
  `prelevementsup_id` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prelevementsup_id` (`prelevementsup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paimentvacs`
--

DROP TABLE IF EXISTS `paimentvacs`;
CREATE TABLE IF NOT EXISTS `paimentvacs` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `Numero` int(11) DEFAULT NULL,
  `cheque` varchar(30) DEFAULT NULL,
  `montantBrut` float DEFAULT NULL,
  `Impot` float DEFAULT NULL,
  `MontantNet` float DEFAULT NULL,
  `prelevement_id` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ordrevairment_id` (`prelevement_id`),
  KEY `ordrevirment_id` (`prelevement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parametres`
--

DROP TABLE IF EXISTS `parametres`;
CREATE TABLE IF NOT EXISTS `parametres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maxProfVac` int(11) NOT NULL,
  `maxProfPer` int(11) NOT NULL,
  `maxEtud` int(11) NOT NULL,
  `dureeEmprunteProf` int(11) NOT NULL,
  `dureeEmprunteEtud` int(11) NOT NULL,
  `dureeReservation` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `preinscriptions`
--

DROP TABLE IF EXISTS `preinscriptions`;
CREATE TABLE IF NOT EXISTS `preinscriptions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `preselection` int(2) DEFAULT '0',
  `admis` int(2) DEFAULT '0',
  `listeAttente` int(2) DEFAULT '0',
  `concour_id` int(10) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nom_fr` varchar(50) DEFAULT NULL,
  `nom_ar` varchar(50) DEFAULT NULL,
  `prenom_fr` varchar(50) DEFAULT NULL,
  `prenom_ar` varchar(50) DEFAULT NULL,
  `cne` varchar(50) DEFAULT NULL,
  `cin` varchar(50) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `code_ville_naissance` varchar(50) DEFAULT NULL,
  `ville_naissance_fr` varchar(50) DEFAULT NULL,
  `ville_naissance_ar` varchar(50) DEFAULT NULL,
  `code_pays_naissance` varchar(50) DEFAULT NULL,
  `pays_naissance_fr` varchar(50) DEFAULT NULL,
  `pays_naissance_ar` varchar(50) DEFAULT NULL,
  `code_sexe` varchar(50) DEFAULT NULL,
  `sexe_fr` varchar(50) DEFAULT NULL,
  `sexe_ar` varchar(50) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `fichierNotes` varchar(200) DEFAULT NULL,
  `annee_obtention_bac` varchar(100) DEFAULT NULL,
  `serie_bac` varchar(100) DEFAULT NULL,
  `etablissement_bac` varchar(200) DEFAULT NULL,
  `code_adresse_fix` text,
  `adresse_fix_fr` text,
  `adresse_fix_ar` text,
  `adresse_annulle_fr` text,
  `adresse_annulle_ar` text,
  `annee_1er_inscription_universite` varchar(50) DEFAULT NULL,
  `annee_1er_inscription_enseignement_superieur` varchar(50) DEFAULT NULL,
  `annee_1er_inscription_universite_marocaine` varchar(50) DEFAULT NULL,
  `code_type_handicap` varchar(50) DEFAULT NULL,
  `type_handicap` varchar(50) DEFAULT NULL,
  `code_type_hebergement` varchar(50) DEFAULT NULL,
  `type_hebergement` varchar(50) DEFAULT NULL,
  `code_situation_familiale` varchar(50) DEFAULT NULL,
  `situation_familiale` varchar(50) DEFAULT NULL,
  `situation_militaire` varchar(50) DEFAULT NULL,
  `categorie_socio_professionnelle` varchar(50) DEFAULT NULL,
  `domaine_activite_professionnelle` varchar(50) DEFAULT NULL,
  `quantite_Travaillee` varchar(50) DEFAULT NULL,
  `profession_pere_fr` varchar(50) DEFAULT NULL,
  `profession_pere_ar` varchar(50) DEFAULT NULL,
  `profession_mere_fr` varchar(50) DEFAULT NULL,
  `profession_mere_ar` varchar(50) DEFAULT NULL,
  `code_province_parents` varchar(50) DEFAULT NULL,
  `province_parents_fr` varchar(50) DEFAULT NULL,
  `province_parents_ar` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `concour_id` (`concour_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `preinscriptions_diplomes`
--

DROP TABLE IF EXISTS `preinscriptions_diplomes`;
CREATE TABLE IF NOT EXISTS `preinscriptions_diplomes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `groupe` varchar(200) DEFAULT NULL,
  `serie_fr` varchar(50) DEFAULT NULL,
  `serie_ar` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `preinscriptions_etablissements`
--

DROP TABLE IF EXISTS `preinscriptions_etablissements`;
CREATE TABLE IF NOT EXISTS `preinscriptions_etablissements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `ville_fr` varchar(50) DEFAULT NULL,
  `ville_ar` varchar(50) DEFAULT NULL,
  `province_fr` varchar(50) DEFAULT NULL,
  `province_ar` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `preinscriptions_infos`
--

DROP TABLE IF EXISTS `preinscriptions_infos`;
CREATE TABLE IF NOT EXISTS `preinscriptions_infos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `preinscriptions_diplome_id` int(10) DEFAULT NULL,
  `preinscriptions_etablissement_id` int(10) DEFAULT NULL,
  `preinscription_id` int(10) DEFAULT NULL,
  `semestre_id` int(10) NOT NULL,
  `note` float NOT NULL,
  `mention` varchar(20) NOT NULL,
  `anneeObtention` year(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `preinscriptions_diplomes_id` (`preinscriptions_diplome_id`),
  KEY `preinscriptions_etablissements_id` (`preinscriptions_etablissement_id`),
  KEY `preinscriptions_id` (`preinscription_id`),
  KEY `semestres_id` (`semestre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prelevements`
--

DROP TABLE IF EXISTS `prelevements`;
CREATE TABLE IF NOT EXISTS `prelevements` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prelevementsups`
--

DROP TABLE IF EXISTS `prelevementsups`;
CREATE TABLE IF NOT EXISTS `prelevementsups` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profdepartements`
--

DROP TABLE IF EXISTS `profdepartements`;
CREATE TABLE IF NOT EXISTS `profdepartements` (
  `nomComplet` varchar(600) NOT NULL,
  `mail` varchar(600) NOT NULL,
  `telephone` varchar(600) NOT NULL,
  `fax` varchar(600) NOT NULL,
  `departement` int(11) NOT NULL,
  KEY `departement` (`departement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profdepartements`
--

INSERT INTO `profdepartements` (`nomComplet`, `mail`, `telephone`, `fax`, `departement`) VALUES
('zerty', 'hasna@gmqil.com', '', '', 1),
('meriem mandar', 'mandar@gmail', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profpermanents`
--

DROP TABLE IF EXISTS `profpermanents`;
CREATE TABLE IF NOT EXISTS `profpermanents` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `somme` varchar(20) NOT NULL,
  `salaire` float NOT NULL,
  `etat` varchar(30) NOT NULL,
  `date_Recrut` datetime NOT NULL,
  `nom_prof` varchar(30) NOT NULL,
  `prenom_prof` varchar(30) NOT NULL,
  `age` int(11) NOT NULL,
  `diplome` varchar(20) NOT NULL,
  `specialite` varchar(40) NOT NULL,
  `universite` text NOT NULL,
  `autresdiplomes` text NOT NULL,
  `situation_familiale` varchar(50) NOT NULL,
  `dateNaissance` date NOT NULL,
  `Lieu_Naissance` varchar(255) NOT NULL,
  `CIN` int(11) NOT NULL,
  `email_prof` varchar(50) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `etat_attestation` int(11) DEFAULT '0',
  `etatdemande` int(11) DEFAULT '0',
  `photo` varchar(100) NOT NULL,
  `etat_fichesalaire` int(11) NOT NULL DEFAULT '0',
  `genre` varchar(150) NOT NULL DEFAULT 'M',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profpermanents`
--

INSERT INTO `profpermanents` (`id`, `user_id`, `somme`, `salaire`, `etat`, `date_Recrut`, `nom_prof`, `prenom_prof`, `age`, `diplome`, `specialite`, `universite`, `autresdiplomes`, `situation_familiale`, `dateNaissance`, `Lieu_Naissance`, `CIN`, `email_prof`, `phone`, `etat_attestation`, `etatdemande`, `photo`, `etat_fichesalaire`, `genre`) VALUES
(2, 5, 'some', 10000, 'etat', '2019-01-01 00:00:00', 'prof', 'prof', 22, 'diplome', 'GI', 'ENSA', 'RIEN', 'situation', '2019-01-09', 'CASA', 55, 'email@gmail.com', '08876', 3, 2, '', 4, 'MYU'),
(3, 6, '1234', 666666, 'etat', '2019-01-01 00:00:00', 'bennay', 'bennay', 22, 'diplome', 'GI', 'bgggggg', 'nnnnnnnnn', 'situation', '2019-01-09', 'cqsq', 55, 'email@gmail.com', '08876', 0, 0, '', 0, 'M');

-- --------------------------------------------------------

--
-- Table structure for table `profpermanentsbis`
--

DROP TABLE IF EXISTS `profpermanentsbis`;
CREATE TABLE IF NOT EXISTS `profpermanentsbis` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `somme` varchar(20) NOT NULL,
  `salaire` float NOT NULL,
  `etat` varchar(30) NOT NULL,
  `date_Recrut` varchar(60) NOT NULL,
  `nom_prof` varchar(30) NOT NULL,
  `prenom_prof` varchar(30) NOT NULL,
  `age` int(11) NOT NULL,
  `diplome` varchar(20) NOT NULL,
  `specialite` varchar(40) NOT NULL,
  `universite` text NOT NULL,
  `autresdiplomes` text NOT NULL,
  `situation_familiale` varchar(50) NOT NULL,
  `Lieu_Naissance` varchar(255) NOT NULL,
  `CIN` int(11) NOT NULL,
  `email_prof` varchar(50) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `etat_attestation` int(11) DEFAULT '0',
  `etatdemande` int(11) DEFAULT '0',
  `photo` varchar(100) NOT NULL,
  `etat_fichesalaire` int(11) NOT NULL DEFAULT '0',
  `date_envoi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isValid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profpermanents_activites`
--

DROP TABLE IF EXISTS `profpermanents_activites`;
CREATE TABLE IF NOT EXISTS `profpermanents_activites` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `profpermanent_id` int(10) NOT NULL,
  `activite_id` int(10) NOT NULL,
  `poste_comite` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profpermanent_id` (`profpermanent_id`),
  KEY `activite_id` (`activite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `profpermanents_departements`
--

DROP TABLE IF EXISTS `profpermanents_departements`;
CREATE TABLE IF NOT EXISTS `profpermanents_departements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `profpermanent_id` int(10) NOT NULL,
  `departement_id` int(10) NOT NULL,
  `Poste_Filiere` varchar(30) NOT NULL,
  `Date_Debut` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profpermanent_id` (`profpermanent_id`),
  KEY `departement_id` (`departement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `profpermanents_departements`
--

INSERT INTO `profpermanents_departements` (`id`, `profpermanent_id`, `departement_id`, `Poste_Filiere`, `Date_Debut`) VALUES
(1, 3, 1, 'gi', '');

-- --------------------------------------------------------

--
-- Table structure for table `profpermanents_disciplines`
--

DROP TABLE IF EXISTS `profpermanents_disciplines`;
CREATE TABLE IF NOT EXISTS `profpermanents_disciplines` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `profpermanent_id` int(10) NOT NULL,
  `discipline_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profpermanent_id` (`profpermanent_id`),
  KEY `discipline_id` (`discipline_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `profpermanents_documents`
--

DROP TABLE IF EXISTS `profpermanents_documents`;
CREATE TABLE IF NOT EXISTS `profpermanents_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profpermanent_id` int(10) NOT NULL,
  `document_id` int(10) NOT NULL,
  `dateDemande` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etatdemande` varchar(30) NOT NULL DEFAULT 'Demande envoyÃ©',
  PRIMARY KEY (`id`),
  KEY `profpermanent_id` (`profpermanent_id`),
  KEY `document_id` (`document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profpermanents_grades`
--

DROP TABLE IF EXISTS `profpermanents_grades`;
CREATE TABLE IF NOT EXISTS `profpermanents_grades` (
  `profpermanent_id` int(10) NOT NULL,
  `grade_id` int(10) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date_grade` date NOT NULL,
  `echelon` int(11) NOT NULL,
  `sous_grade` varchar(20) NOT NULL,
  `date_exep` date NOT NULL,
  `date_normal` date NOT NULL,
  `date_rapide` date NOT NULL,
  `date_next_echelon` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profpermanent_id` (`profpermanent_id`),
  KEY `grades_id` (`grade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `proposition`
--

DROP TABLE IF EXISTS `proposition`;
CREATE TABLE IF NOT EXISTS `proposition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `code` varchar(14) NOT NULL,
  `role` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `resumer` varchar(100) NOT NULL,
  `fichier` varchar(20) NOT NULL,
  `jugement` text NOT NULL,
  `etat` varchar(20) NOT NULL DEFAULT 'valider/ignorer',
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pvupdate`
--

DROP TABLE IF EXISTS `pvupdate`;
CREATE TABLE IF NOT EXISTS `pvupdate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profpermanent_id` int(11) DEFAULT NULL,
  `note_id` int(11) NOT NULL,
  `date_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profvacataire_id` int(11) DEFAULT NULL,
  `note_old` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `representations`
--

DROP TABLE IF EXISTS `representations`;
CREATE TABLE IF NOT EXISTS `representations` (
  `poste` varchar(600) NOT NULL,
  `nom` varchar(600) NOT NULL,
  `prenom` varchar(600) NOT NULL,
  `tele` varchar(600) NOT NULL,
  `fax` varchar(600) NOT NULL,
  `mail` varchar(600) NOT NULL,
  `presentation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `dateReservation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delai` date NOT NULL,
  `user_id` int(10) NOT NULL,
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`book_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `semestres`
--

DROP TABLE IF EXISTS `semestres`;
CREATE TABLE IF NOT EXISTS `semestres` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `libile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `niveaus_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `semestres_niveaus_id_foreign` (`niveaus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `semestres`
--

INSERT INTO `semestres` (`id`, `libile`, `niveaus_id`) VALUES
(1, 's1', 1),
(2, 'S2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom_service` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sitedepartements`
--

DROP TABLE IF EXISTS `sitedepartements`;
CREATE TABLE IF NOT EXISTS `sitedepartements` (
  `id` int(11) NOT NULL,
  `nom` varchar(600) NOT NULL,
  `chefDepartement` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sitedocuments`
--

DROP TABLE IF EXISTS `sitedocuments`;
CREATE TABLE IF NOT EXISTS `sitedocuments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(600) NOT NULL,
  `fichier` varchar(600) NOT NULL,
  `id_actualite` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_actualité` (`id_actualite`),
  KEY `id_actualité_2` (`id_actualite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sous_categories`
--

DROP TABLE IF EXISTS `sous_categories`;
CREATE TABLE IF NOT EXISTS `sous_categories` (
  `id` int(3) NOT NULL,
  `nom` varchar(15) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sous_categories_ibfk_1` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_categories`
--

DROP TABLE IF EXISTS `stock_categories`;
CREATE TABLE IF NOT EXISTS `stock_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label_cat` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `stock_categories`
--

INSERT INTO `stock_categories` (`id`, `label_cat`) VALUES
(1, 'Matieres premiers'),
(2, 'Sport');

-- --------------------------------------------------------

--
-- Table structure for table `sup_heures`
--

DROP TABLE IF EXISTS `sup_heures`;
CREATE TABLE IF NOT EXISTS `sup_heures` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mois` int(11) NOT NULL,
  `annee` int(11) NOT NULL,
  `nbHeure` int(11) NOT NULL,
  `dateInsertion` datetime NOT NULL,
  `etat` varchar(10) NOT NULL,
  `profpermanent_id` int(10) NOT NULL,
  `paimentsup_id` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paiementsupo_sdsd_fk` (`paimentsup_id`),
  KEY `prof_fk_suph` (`profpermanent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`) VALUES
(2, 'Administrateur', '$2y$10$wF1NactKVrbA.o52AbV7sOjVxPcc0feHir1RO71elcrYn1JIfL/gq', 'admin', NULL, NULL),
(3, 'etudiant', '$2y$10$wF1NactKVrbA.o52AbV7sOjVxPcc0feHir1RO71elcrYn1JIfL/gq', 'etudiant', NULL, NULL),
(4, 'respo', '$2y$10$wF1NactKVrbA.o52AbV7sOjVxPcc0feHir1RO71elcrYn1JIfL/gq', 'resposcolarite', NULL, NULL),
(5, 'professeur', '$2y$10$adq5VBfhM/VelDXJF08WseJdCgJjxXDuwIVVPSSNqk2FAPYOj7FdC', 'profpermanent', NULL, NULL),
(6, 'amnai', '$2y$10$wF1NactKVrbA.o52AbV7sOjVxPcc0feHir1RO71elcrYn1JIfL/gq', 'profpermanent', NULL, NULL),
(7, 'bennay', '$2y$10$adq5VBfhM/VelDXJF08WseJdCgJjxXDuwIVVPSSNqk2FAPYOj7FdC', 'profpermanent', NULL, NULL),
(8, 'jerradi', '$2y$10$adq5VBfhM/VelDXJF08WseJdCgJjxXDuwIVVPSSNqk2FAPYOj7FdC', 'profpermanent', NULL, NULL),
(9, 'mandar', '$2y$10$adq5VBfhM/VelDXJF08WseJdCgJjxXDuwIVVPSSNqk2FAPYOj7FdC', 'profvacataire', NULL, NULL),
(10, 'respostock', '$2y$10$wF1NactKVrbA.o52AbV7sOjVxPcc0feHir1RO71elcrYn1JIfL/gq', 'respostock', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_books`
--

DROP TABLE IF EXISTS `users_books`;
CREATE TABLE IF NOT EXISTS `users_books` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `book_id` int(4) NOT NULL,
  `dateEmprunte` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delai` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `users_books_ibfk_1` (`book_id`),
  KEY `users_books_ibfk_2` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_messages`
--

DROP TABLE IF EXISTS `users_messages`;
CREATE TABLE IF NOT EXISTS `users_messages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `user_idrecepteur` int(10) NOT NULL,
  `date` datetime NOT NULL,
  KEY `fk_messages` (`message_id`),
  KEY `fk_users_messages` (`user_id`),
  KEY `fk_users_messages_recept` (`user_idrecepteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_messages`
--

INSERT INTO `users_messages` (`message_id`, `user_id`, `user_idrecepteur`, `date`) VALUES
(1, 3, 4, '2019-01-13 20:55:36'),
(5, 3, 4, '2019-01-15 09:37:32'),
(6, 3, 6, '2019-02-03 13:55:55'),
(7, 3, 6, '2019-02-03 14:05:31'),
(8, 3, 4, '2019-02-03 14:07:26'),
(11, 3, 6, '2019-02-03 17:25:25'),
(12, 6, 4, '2019-02-03 17:37:55'),
(13, 6, 4, '2019-02-03 17:45:30'),
(14, 4, 6, '2019-02-05 01:52:24'),
(15, 4, 6, '2019-02-06 01:03:50');

-- --------------------------------------------------------

--
-- Table structure for table `vacataires`
--

DROP TABLE IF EXISTS `vacataires`;
CREATE TABLE IF NOT EXISTS `vacataires` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `somme` varchar(20) NOT NULL,
  `nom_vacataire` varchar(30) NOT NULL,
  `prenom_vacataire` varchar(30) NOT NULL,
  `nb_heures` int(11) NOT NULL,
  `echelle` int(11) NOT NULL,
  `echelon` int(11) NOT NULL,
  `dateRecrut` datetime NOT NULL,
  `dateNaissance` date NOT NULL,
  `LieuNaissance` varchar(20) NOT NULL,
  `diplome` varchar(40) NOT NULL,
  `universite` varchar(50) NOT NULL,
  `specialite` varchar(50) NOT NULL,
  `CIN` varchar(15) NOT NULL,
  `situationFamiliale` varchar(15) NOT NULL,
  `codeSituation` varchar(20) NOT NULL,
  `dateAffectation` date NOT NULL,
  `email` varchar(20) NOT NULL,
  `nbr_enfants` int(10) NOT NULL,
  `genre` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vacataires_ibfk_1` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vacataires`
--

INSERT INTO `vacataires` (`id`, `user_id`, `somme`, `nom_vacataire`, `prenom_vacataire`, `nb_heures`, `echelle`, `echelon`, `dateRecrut`, `dateNaissance`, `LieuNaissance`, `diplome`, `universite`, `specialite`, `CIN`, `situationFamiliale`, `codeSituation`, `dateAffectation`, `email`, `nbr_enfants`, `genre`, `age`) VALUES
(1, 9, '5R5T', '44RR4', 'RRR', 4, 4, 4, '2019-01-23 00:00:00', '2019-01-01', 'CSA', 'diplome', 'UH1', 'GI', '55', 'MARIE', '1', '2019-01-24', 'mandar@gmail.cim', 1, 'FFF', 12);

-- --------------------------------------------------------

--
-- Table structure for table `vacatairesbis`
--

DROP TABLE IF EXISTS `vacatairesbis`;
CREATE TABLE IF NOT EXISTS `vacatairesbis` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `somme` varchar(20) NOT NULL,
  `nom_vacataire` varchar(30) NOT NULL,
  `prenom_vacataire` varchar(30) NOT NULL,
  `nb_heures` int(11) NOT NULL,
  `echelle` int(11) NOT NULL,
  `echelon` int(11) NOT NULL,
  `dateRecrut` datetime NOT NULL,
  `dateNaissance` date NOT NULL,
  `LieuNaissance` varchar(20) NOT NULL,
  `diplome` varchar(40) NOT NULL,
  `universite` varchar(50) NOT NULL,
  `specialite` varchar(50) NOT NULL,
  `CIN` varchar(15) NOT NULL,
  `situationFamiliale` varchar(15) NOT NULL,
  `codeSituation` varchar(20) NOT NULL,
  `dateAffectation` date NOT NULL,
  `date_envoi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isValid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vacataires_activites`
--

DROP TABLE IF EXISTS `vacataires_activites`;
CREATE TABLE IF NOT EXISTS `vacataires_activites` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `vacataire_id` int(10) NOT NULL,
  `activite_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vacataire_id` (`vacataire_id`),
  KEY `activite_id` (`activite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vacataires_departements`
--

DROP TABLE IF EXISTS `vacataires_departements`;
CREATE TABLE IF NOT EXISTS `vacataires_departements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `vacataire_id` int(10) NOT NULL,
  `departement_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vacataire_id` (`vacataire_id`),
  KEY `departement_id` (`departement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vacataires_disciplines`
--

DROP TABLE IF EXISTS `vacataires_disciplines`;
CREATE TABLE IF NOT EXISTS `vacataires_disciplines` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `vacataire_id` int(10) NOT NULL,
  `discipline_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vacataire_id` (`vacataire_id`),
  KEY `discipline_id` (`discipline_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vacataires_documents`
--

DROP TABLE IF EXISTS `vacataires_documents`;
CREATE TABLE IF NOT EXISTS `vacataires_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vacataire_id` int(30) NOT NULL,
  `type_document` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `const1` (`vacataire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vacataires_grades`
--

DROP TABLE IF EXISTS `vacataires_grades`;
CREATE TABLE IF NOT EXISTS `vacataires_grades` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `datedebut` date NOT NULL,
  `datefin` date NOT NULL,
  `grade_id` int(10) NOT NULL,
  `vacataire_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `grade_id` (`grade_id`),
  KEY `vacataire_id` (`vacataire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vacations`
--

DROP TABLE IF EXISTS `vacations`;
CREATE TABLE IF NOT EXISTS `vacations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mois` int(11) NOT NULL,
  `annee` int(11) NOT NULL,
  `nbHeure` int(11) NOT NULL,
  `dateInsertion` datetime NOT NULL,
  `etat` varchar(10) NOT NULL,
  `vacataire_id` int(10) NOT NULL,
  `paimentvac_id` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mois` (`mois`,`annee`,`vacataire_id`),
  KEY `vacataire_id` (`vacataire_id`),
  KEY `paimentvac_id` (`paimentvac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lien` varchar(600) NOT NULL,
  `commentaire` varchar(600) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `villes`
--

DROP TABLE IF EXISTS `villes`;
CREATE TABLE IF NOT EXISTS `villes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `distance` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vote_books`
--

DROP TABLE IF EXISTS `vote_books`;
CREATE TABLE IF NOT EXISTS `vote_books` (
  `id_user` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`sous_categorie_id`) REFERENCES `sous_categories` (`id`);

--
-- Constraints for table `concours`
--
ALTER TABLE `concours`
  ADD CONSTRAINT `concours_ibfk_1` FOREIGN KEY (`niveaus_id`) REFERENCES `niveaus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `concours_ibfk_2` FOREIGN KEY (`filiere_id`) REFERENCES `filieres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courrier_arrivees`
--
ALTER TABLE `courrier_arrivees`
  ADD CONSTRAINT `courrier_arrivees_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `demande_auth`
--
ALTER TABLE `demande_auth`
  ADD CONSTRAINT `demande_auth_classe_id_foreign` FOREIGN KEY (`classe_id`) REFERENCES `groupes` (`id`),
  ADD CONSTRAINT `demande_auth_prof_id_foreign` FOREIGN KEY (`prof_id`) REFERENCES `profpermanents` (`id`),
  ADD CONSTRAINT `demande_auth_profvacataire_id_foreign` FOREIGN KEY (`profvacataire_id`) REFERENCES `vacataires` (`id`);

--
-- Constraints for table `diffusions_messages`
--
ALTER TABLE `diffusions_messages`
  ADD CONSTRAINT `fk_msgs` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_sender` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `elements`
--
ALTER TABLE `elements`
  ADD CONSTRAINT `elements_modules_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`);

--
-- Constraints for table `enseigners`
--
ALTER TABLE `enseigners`
  ADD CONSTRAINT `enseigners_annee_scolaires_id_foreign` FOREIGN KEY (`annee_scolaire_id`) REFERENCES `annee_scolaires` (`id`),
  ADD CONSTRAINT `enseigners_elements_id_foreign` FOREIGN KEY (`element_id`) REFERENCES `elements` (`id`),
  ADD CONSTRAINT `enseigners_profpermanent_id_foreign` FOREIGN KEY (`profpermanent_id`) REFERENCES `profpermanents` (`id`),
  ADD CONSTRAINT `enseigners_semestres_id_foreign` FOREIGN KEY (`semestre_id`) REFERENCES `semestres` (`id`);

--
-- Constraints for table `etudiants`
--
ALTER TABLE `etudiants`
  ADD CONSTRAINT `etudiants_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `etudiers`
--
ALTER TABLE `etudiers`
  ADD CONSTRAINT `etudiers_annee_scolaires_id_foreign` FOREIGN KEY (`annee_scolaire_id`) REFERENCES `annee_scolaires` (`id`),
  ADD CONSTRAINT `etudiers_classes_id_foreign` FOREIGN KEY (`groupe_id`) REFERENCES `groupes` (`id`),
  ADD CONSTRAINT `etudiers_elements_id_foreign` FOREIGN KEY (`element_id`) REFERENCES `elements` (`id`),
  ADD CONSTRAINT `etudiers_etudiants_id_foreign` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants` (`id`);

--
-- Constraints for table `fonctionnaires`
--
ALTER TABLE `fonctionnaires`
  ADD CONSTRAINT `fk_user_Fct` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `fonctionnaires_activites`
--
ALTER TABLE `fonctionnaires_activites`
  ADD CONSTRAINT `fk_ac` FOREIGN KEY (`activite_id`) REFERENCES `activites` (`id`),
  ADD CONSTRAINT `fk_fonctionnaireee` FOREIGN KEY (`fonctionnaire_id`) REFERENCES `fonctionnaires` (`id`);

--
-- Constraints for table `fonctionnaires_documents`
--
ALTER TABLE `fonctionnaires_documents`
  ADD CONSTRAINT `fk_document_fonctionnaire` FOREIGN KEY (`fonctionnaire_id`) REFERENCES `fonctionnaires` (`id`),
  ADD CONSTRAINT `fk_document_fonctionnaire_bis` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`);

--
-- Constraints for table `fonctionnaires_grades`
--
ALTER TABLE `fonctionnaires_grades`
  ADD CONSTRAINT `fk_fct` FOREIGN KEY (`fonctionnaire_id`) REFERENCES `fonctionnaires` (`id`),
  ADD CONSTRAINT `fk_graaadde` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`);

--
-- Constraints for table `fonctionnaires_services`
--
ALTER TABLE `fonctionnaires_services`
  ADD CONSTRAINT `fk_fonctionnaire` FOREIGN KEY (`fonctionnaire_id`) REFERENCES `fonctionnaires` (`id`),
  ADD CONSTRAINT `fk_service` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `fonctionnaires_services_ibfk_1` FOREIGN KEY (`fonctionnaire_id`) REFERENCES `fonctionnaires` (`id`);

--
-- Constraints for table `groupes`
--
ALTER TABLE `groupes`
  ADD CONSTRAINT `classes_filieres_id_foreign` FOREIGN KEY (`filiere_id`) REFERENCES `filieres` (`id`),
  ADD CONSTRAINT `classes_niveaus_id_foreign` FOREIGN KEY (`niveaus_id`) REFERENCES `niveaus` (`id`);

--
-- Constraints for table `missions`
--
ALTER TABLE `missions`
  ADD CONSTRAINT `missions_ibfk_1` FOREIGN KEY (`ville_id`) REFERENCES `villes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `missions_ibfk_3` FOREIGN KEY (`profpermanent_id`) REFERENCES `profpermanents` (`id`),
  ADD CONSTRAINT `missions_ibfk_4` FOREIGN KEY (`fonctionnaire_id`) REFERENCES `fonctionnaires` (`id`);

--
-- Constraints for table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_classes_id_foreign` FOREIGN KEY (`groupe_id`) REFERENCES `groupes` (`id`);

--
-- Constraints for table `notes_auth`
--
ALTER TABLE `notes_auth`
  ADD CONSTRAINT `notes_auth_profpermanent_id_foreign` FOREIGN KEY (`profpermanent_id`) REFERENCES `profpermanents` (`id`),
  ADD CONSTRAINT `notes_auth_profvacataire_id_foreign` FOREIGN KEY (`profvacataire_id`) REFERENCES `vacataires` (`id`);

--
-- Constraints for table `organisations`
--
ALTER TABLE `organisations`
  ADD CONSTRAINT `fk_activite` FOREIGN KEY (`activite_id`) REFERENCES `activites` (`id`);

--
-- Constraints for table `paimentsups`
--
ALTER TABLE `paimentsups`
  ADD CONSTRAINT `prelev_sup_fk` FOREIGN KEY (`prelevementsup_id`) REFERENCES `prelevementsups` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `paimentvacs`
--
ALTER TABLE `paimentvacs`
  ADD CONSTRAINT `fk_comtes_reste_opjj` FOREIGN KEY (`prelevement_id`) REFERENCES `prelevements` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `preinscriptions`
--
ALTER TABLE `preinscriptions`
  ADD CONSTRAINT `preinscriptions_ibfk_1` FOREIGN KEY (`concour_id`) REFERENCES `concours` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `preinscriptions_infos`
--
ALTER TABLE `preinscriptions_infos`
  ADD CONSTRAINT `preinscriptions_infos_ibfk_1` FOREIGN KEY (`preinscription_id`) REFERENCES `preinscriptions` (`id`),
  ADD CONSTRAINT `preinscriptions_infos_ibfk_2` FOREIGN KEY (`preinscriptions_etablissement_id`) REFERENCES `preinscriptions_etablissements` (`id`),
  ADD CONSTRAINT `preinscriptions_infos_ibfk_3` FOREIGN KEY (`preinscriptions_diplome_id`) REFERENCES `preinscriptions_diplomes` (`id`),
  ADD CONSTRAINT `preinscriptions_infos_ibfk_4` FOREIGN KEY (`semestre_id`) REFERENCES `semestres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profpermanents`
--
ALTER TABLE `profpermanents`
  ADD CONSTRAINT `profpermanents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profpermanents_activites`
--
ALTER TABLE `profpermanents_activites`
  ADD CONSTRAINT `fk_activites` FOREIGN KEY (`activite_id`) REFERENCES `activites` (`id`),
  ADD CONSTRAINT `fk_profess` FOREIGN KEY (`profpermanent_id`) REFERENCES `profpermanents` (`id`);

--
-- Constraints for table `profpermanents_departements`
--
ALTER TABLE `profpermanents_departements`
  ADD CONSTRAINT `fk_departement` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`),
  ADD CONSTRAINT `fk_professeur` FOREIGN KEY (`profpermanent_id`) REFERENCES `profpermanents` (`id`);

--
-- Constraints for table `profpermanents_disciplines`
--
ALTER TABLE `profpermanents_disciplines`
  ADD CONSTRAINT `fk_disci` FOREIGN KEY (`discipline_id`) REFERENCES `disciplines` (`id`),
  ADD CONSTRAINT `fk_professeurss` FOREIGN KEY (`profpermanent_id`) REFERENCES `profpermanents` (`id`);

--
-- Constraints for table `profpermanents_documents`
--
ALTER TABLE `profpermanents_documents`
  ADD CONSTRAINT `fk_document_professeur` FOREIGN KEY (`profpermanent_id`) REFERENCES `profpermanents` (`id`),
  ADD CONSTRAINT `fk_document_professeur_bis` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`);

--
-- Constraints for table `profpermanents_grades`
--
ALTER TABLE `profpermanents_grades`
  ADD CONSTRAINT `fk_prof` FOREIGN KEY (`profpermanent_id`) REFERENCES `profpermanents` (`id`),
  ADD CONSTRAINT `profpermanents_grades_ibfk_1` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`);

--
-- Constraints for table `proposition`
--
ALTER TABLE `proposition`
  ADD CONSTRAINT `proposition_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `semestres`
--
ALTER TABLE `semestres`
  ADD CONSTRAINT `semestres_niveaus_id_foreign` FOREIGN KEY (`niveaus_id`) REFERENCES `niveaus` (`id`);

--
-- Constraints for table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD CONSTRAINT `sous_categories_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `sup_heures`
--
ALTER TABLE `sup_heures`
  ADD CONSTRAINT `paiementsupo_sdsd_fk` FOREIGN KEY (`paimentsup_id`) REFERENCES `paimentsups` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `prof_fk_suph` FOREIGN KEY (`profpermanent_id`) REFERENCES `profpermanents` (`id`);

--
-- Constraints for table `users_books`
--
ALTER TABLE `users_books`
  ADD CONSTRAINT `users_books_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `users_books_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users_messages`
--
ALTER TABLE `users_messages`
  ADD CONSTRAINT `fk_messages` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_messages` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_messages_recept` FOREIGN KEY (`user_idrecepteur`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vacataires`
--
ALTER TABLE `vacataires`
  ADD CONSTRAINT `vacataires_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `vacataires_activites`
--
ALTER TABLE `vacataires_activites`
  ADD CONSTRAINT `fk_act` FOREIGN KEY (`activite_id`) REFERENCES `activites` (`id`),
  ADD CONSTRAINT `fk_vacataire` FOREIGN KEY (`vacataire_id`) REFERENCES `vacataires` (`id`);

--
-- Constraints for table `vacataires_departements`
--
ALTER TABLE `vacataires_departements`
  ADD CONSTRAINT `fk_depart` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`),
  ADD CONSTRAINT `fk_vaca` FOREIGN KEY (`vacataire_id`) REFERENCES `vacataires` (`id`);

--
-- Constraints for table `vacataires_disciplines`
--
ALTER TABLE `vacataires_disciplines`
  ADD CONSTRAINT `fk_disciplines` FOREIGN KEY (`discipline_id`) REFERENCES `disciplines` (`id`),
  ADD CONSTRAINT `fk_vacaaaa` FOREIGN KEY (`vacataire_id`) REFERENCES `vacataires` (`id`);

--
-- Constraints for table `vacataires_documents`
--
ALTER TABLE `vacataires_documents`
  ADD CONSTRAINT `const1` FOREIGN KEY (`vacataire_id`) REFERENCES `vacataires` (`id`);

--
-- Constraints for table `vacataires_grades`
--
ALTER TABLE `vacataires_grades`
  ADD CONSTRAINT `vacataires_grades_ibfk_1` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`);

--
-- Constraints for table `vacations`
--
ALTER TABLE `vacations`
  ADD CONSTRAINT `hghghgh` FOREIGN KEY (`vacataire_id`) REFERENCES `vacataires` (`id`),
  ADD CONSTRAINT `jnjjbj,j` FOREIGN KEY (`paimentvac_id`) REFERENCES `paimentvacs` (`id`) ON DELETE SET NULL;

DELIMITER $$
--
-- Events
--
DROP EVENT `supprimerreservation`$$
CREATE DEFINER=`root`@`localhost` EVENT `supprimerreservation` ON SCHEDULE EVERY 1 SECOND STARTS '2017-03-20 21:43:48' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM reservations WHERE delai <= now()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
