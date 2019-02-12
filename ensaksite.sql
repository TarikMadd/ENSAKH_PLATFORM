-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 03 fév. 2019 à 20:11
-- Version du serveur :  10.1.36-MariaDB
-- Version de PHP :  7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ensaksite`
--

-- --------------------------------------------------------

--
-- Structure de la table `absences`
--

CREATE TABLE `absences` (
  `id` int(11) NOT NULL,
  `fonctionnaire_id` int(11) NOT NULL,
  `duree_ab` float NOT NULL,
  `cause` varchar(255) NOT NULL,
  `date_ab` date NOT NULL,
  `time_ab` time NOT NULL,
  `isvalid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `access_admis`
--

CREATE TABLE `access_admis` (
  `id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL,
  `access` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

CREATE TABLE `activites` (
  `id` int(10) NOT NULL,
  `nomActivite` varchar(60) NOT NULL,
  `dateDebut` varchar(100) DEFAULT NULL,
  `dateFin` varchar(40) NOT NULL,
  `photo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `activitesdespreinscriptions`
--

CREATE TABLE `activitesdespreinscriptions` (
  `id` int(10) NOT NULL,
  `libile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `activitesdespreinscriptions_preinscriptions`
--

CREATE TABLE `activitesdespreinscriptions_preinscriptions` (
  `id` int(10) NOT NULL,
  `preinscription_id` int(10) NOT NULL,
  `activitesdespreinscription_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `actualiteclubs`
--

CREATE TABLE `actualiteclubs` (
  `id` int(11) NOT NULL,
  `titre` varchar(600) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `texte` text CHARACTER SET utf8 NOT NULL,
  `id_club` int(11) NOT NULL,
  `image` varchar(110) CHARACTER SET utf8 DEFAULT NULL,
  `video` varchar(110) CHARACTER SET utf8 DEFAULT NULL,
  `fichier` varchar(600) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `actualites`
--

CREATE TABLE `actualites` (
  `id` int(11) NOT NULL,
  `titre` varchar(600) CHARACTER SET latin1 NOT NULL,
  `texte` text CHARACTER SET latin1 NOT NULL,
  `date` date NOT NULL,
  `photo` varchar(600) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `annee_scolaires`
--

CREATE TABLE `annee_scolaires` (
  `id` int(10) NOT NULL,
  `libile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `annee` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `annee_scolaires`
--

INSERT INTO `annee_scolaires` (`id`, `libile`, `annee`) VALUES
(1, '2018/2019', '2019-01-01');

-- --------------------------------------------------------

--
-- Structure de la table `articleevents`
--

CREATE TABLE `articleevents` (
  `id` int(11) NOT NULL,
  `desigantion` text,
  `quantite` int(11) DEFAULT NULL,
  `prix_unitaire_ht` float DEFAULT NULL,
  `devisdemande_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `stock_categorie_id` int(11) NOT NULL,
  `label_article` varchar(50) DEFAULT NULL,
  `quantite_min` int(11) DEFAULT NULL,
  `marque` varchar(50) DEFAULT NULL,
  `utilite` tinyint(1) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `asupprimer`
--

CREATE TABLE `asupprimer` (
  `message_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `autorisations`
--

CREATE TABLE `autorisations` (
  `id` int(10) NOT NULL,
  `groupe_id` int(10) NOT NULL,
  `annee_scolaire_id` int(10) NOT NULL,
  `semestre_id` int(10) NOT NULL,
  `isnormal` int(2) DEFAULT '0',
  `isratt` int(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `boncommandes`
--

CREATE TABLE `boncommandes` (
  `id` int(11) NOT NULL,
  `exercice` int(11) DEFAULT NULL,
  `prix_total` float DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `devisdemande_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(4) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `auteur` varchar(20) NOT NULL,
  `edition` varchar(20) NOT NULL,
  `resumer` text NOT NULL,
  `image` varchar(300) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `numInventaire` varchar(7) NOT NULL,
  `nbExemplaire` int(3) NOT NULL,
  `sous_categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `calendriers`
--

CREATE TABLE `calendriers` (
  `id` int(11) NOT NULL,
  `titre` varchar(30) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fin` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `certificats`
--

CREATE TABLE `certificats` (
  `id` int(10) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `nombre_max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `certificats`
--

INSERT INTO `certificats` (`id`, `type`, `created`, `modified`, `nombre_max`) VALUES
(1, 'Certificat scolarité', NULL, NULL, 4),
(2, 'Retrait provisoire bac', NULL, NULL, 1),
(4, 'Recommandation stage', NULL, NULL, 1),
(5, 'Retrait définitive bac', NULL, NULL, 1),
(6, 'Relevé de notes', NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `certificats_etudiants`
--

CREATE TABLE `certificats_etudiants` (
  `id` int(11) NOT NULL,
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
  `profpermanent_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `certificats_etudiants`
--

INSERT INTO `certificats_etudiants` (`id`, `certificat_id`, `etudiant_id`, `etat`, `commentaire`, `created`, `modified`, `entreprise`, `raison_retrait`, `duree_stage`, `theme_stage`, `debut_stage`, `fin_stage`, `profpermanent_id`) VALUES
(3, 1, 5, 'Délivré', NULL, '2019-01-24 19:28:08', '2019-01-24 19:37:37', '-', '-', 0, '-', '0000-00-00', '0000-00-00', 0),
(4, 1, 5, 'Demande envoyé', NULL, '2019-02-03 18:37:45', '2019-02-03 18:37:45', '-', '-', 0, '-', '0000-00-00', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `nom` varchar(600) NOT NULL,
  `mission` varchar(600) NOT NULL,
  `datePost` date NOT NULL,
  `mot` text NOT NULL,
  `texte` text NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `delai_limite` date NOT NULL,
  `nom` text NOT NULL,
  `stock_categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commande_articles`
--

CREATE TABLE `commande_articles` (
  `id` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

CREATE TABLE `comptes` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` varchar(20) NOT NULL,
  `descriptions` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `concours`
--

CREATE TABLE `concours` (
  `id` int(10) NOT NULL,
  `niveaus_id` int(10) DEFAULT NULL,
  `filiere_id` int(10) DEFAULT NULL,
  `etat` int(2) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `telephone1` varchar(200) NOT NULL,
  `telephone2` varchar(200) NOT NULL,
  `telephone3` varchar(200) NOT NULL,
  `mail` varchar(300) NOT NULL,
  `adresse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `courrier_arrivees`
--

CREATE TABLE `courrier_arrivees` (
  `date_arrivee` date NOT NULL,
  `Désignation` varchar(255) NOT NULL,
  `expediteur_id` int(11) NOT NULL,
  `type_courrier` varchar(255) NOT NULL,
  `Priorité` varchar(255) NOT NULL,
  `date_limite_du_traitement` date DEFAULT NULL,
  `etat_du_courrier` varchar(255) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `necessité_du_traitement` varchar(225) NOT NULL,
  `id` int(255) NOT NULL,
  `courrier` varchar(255) NOT NULL,
  `accuse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `courrier_departs`
--

CREATE TABLE `courrier_departs` (
  `id` int(11) NOT NULL,
  `date_depart` date NOT NULL,
  `désignation` varchar(255) NOT NULL,
  `destinataire_id` varchar(255) NOT NULL,
  `type_courrier` varchar(255) NOT NULL,
  `service` varchar(255) DEFAULT NULL,
  `necessite` varchar(255) NOT NULL,
  `etat_courrier` varchar(255) NOT NULL,
  `courrier` varchar(255) NOT NULL,
  `accuse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `demande_auth`
--

CREATE TABLE `demande_auth` (
  `id` int(11) NOT NULL,
  `classe_id` int(11) NOT NULL,
  `prof_id` int(11) DEFAULT NULL,
  `pv` tinyint(1) NOT NULL DEFAULT '0',
  `state` double NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profvacataire_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

CREATE TABLE `departements` (
  `id` int(10) NOT NULL,
  `nom_departement` varchar(40) NOT NULL,
  `nb_filiere` int(11) NOT NULL,
  `refer_depart` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id`, `nom_departement`, `nb_filiere`, `refer_depart`) VALUES
(1, 'GRT', 3, 2),
(2, 'GI', 4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `destinataires`
--

CREATE TABLE `destinataires` (
  `id` int(11) NOT NULL,
  `nomComplet_destinataire` varchar(255) NOT NULL,
  `adresse_destinataire` varchar(255) NOT NULL,
  `email_destinataire` varchar(255) NOT NULL,
  `telephone_destinataire` varchar(255) NOT NULL,
  `ville_destinataire` varchar(255) NOT NULL,
  `pays_destinataire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `devisdemandes`
--

CREATE TABLE `devisdemandes` (
  `id` int(11) NOT NULL,
  `nom_devis` text,
  `nom_fournisseur` text,
  `adresse_fournisseur` text,
  `intitule` text,
  `etat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `diffusions_messages`
--

CREATE TABLE `diffusions_messages` (
  `message_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `typerecepteur` varchar(80) NOT NULL,
  `group_id` int(10) DEFAULT NULL,
  `departement_id` int(10) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `disciplines`
--

CREATE TABLE `disciplines` (
  `id` int(10) NOT NULL,
  `nom_discipline` varchar(30) NOT NULL,
  `domaine_discipline` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) NOT NULL,
  `idDocument` int(11) NOT NULL,
  `nbDocument` int(11) NOT NULL,
  `nomDocument` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `elements`
--

CREATE TABLE `elements` (
  `id` int(10) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `libile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module_id` int(10) NOT NULL,
  `CM` int(11) NOT NULL,
  `Eval` int(11) NOT NULL,
  `AP` int(11) NOT NULL,
  `TP` int(11) NOT NULL,
  `TD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `enseigners`
--

CREATE TABLE `enseigners` (
  `id` int(10) NOT NULL,
  `semestre_id` int(10) NOT NULL,
  `annee_scolaire_id` int(10) NOT NULL,
  `element_id` int(10) NOT NULL,
  `profpermanent_id` int(10) DEFAULT NULL,
  `vacataire_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `equiperecherches`
--

CREATE TABLE `equiperecherches` (
  `intitule` varchar(600) NOT NULL,
  `responsable` varchar(600) NOT NULL,
  `id_recherche` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE `etudiants` (
  `id` int(10) NOT NULL,
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
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`id`, `user_id`, `apogee`, `nom_fr`, `nom_ar`, `prenom_fr`, `prenom_ar`, `cne`, `cin`, `date_naissance`, `code_ville_naissance`, `ville_naissance_fr`, `ville_naissance_ar`, `code_pays_naissance`, `pays_naissance_fr`, `pays_naissance_ar`, `code_sexe`, `sexe_fr`, `sexe_ar`, `code_adresse_fix`, `adresse_fix_fr`, `adresse_fix_ar`, `adresse_annulle_fr`, `adresse_annulle_ar`, `annee_1er_inscription_universite`, `annee_1er_inscription_enseignement_superieur`, `annee_1er_inscription_universite_marocaine`, `code_bac`, `serie_bac_fr`, `serie_bac_ar`, `code_etablissement_bac`, `etablissement_bac_fr`, `etablissement_bac_ar`, `code_mention_bac`, `mention_bac`, `code_province_bac`, `province_bac_fr`, `province_bac_ar`, `annee_bac`, `code_type_handicap`, `type_handicap`, `code_type_hebergement`, `type_hebergement`, `code_situation_familiale`, `situation_familiale`, `situation_militaire`, `categorie_socio_professionnelle`, `domaine_activite_professionnelle`, `quatite_Travaillee`, `profession_pere_fr`, `profession_pere_ar`, `profession_mere_fr`, `profession_mere_ar`, `code_province_parents`, `province_parents_fr`, `province_parents_ar`, `annee_sortie`, `code_cite_universiatire`, `cite_universiatire`, `created`, `modified`, `photo`, `validi`, `validi_respo`, `numero_tel`, `email`) VALUES
(5, 1, '1210338001', 'Taoussi', 'الطوسي', 'Sara', 'سارة', 1210338001, 'BJ879500', '2012-06-03', NULL, 'Khouribga', NULL, NULL, 'Maroc', NULL, 'f', 'femme', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `etudiers`
--

CREATE TABLE `etudiers` (
  `id` int(10) NOT NULL,
  `etudiant_id` int(10) NOT NULL,
  `annee_scolaire_id` int(10) NOT NULL,
  `groupe_id` int(10) NOT NULL,
  `element_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `etudiers`
--

INSERT INTO `etudiers` (`id`, `etudiant_id`, `annee_scolaire_id`, `groupe_id`, `element_id`) VALUES
(1, 5, 2, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
  `id` int(11) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `adresse` varchar(600) NOT NULL,
  `tele` varchar(30) NOT NULL,
  `texte` text NOT NULL,
  `website` varchar(600) CHARACTER SET utf8 NOT NULL,
  `membre` int(11) NOT NULL,
  `invite` int(11) NOT NULL,
  `photo` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `expediteurs`
--

CREATE TABLE `expediteurs` (
  `id` int(11) NOT NULL,
  `nomComplet_expediteur` varchar(255) DEFAULT NULL,
  `adresse_expediteur` varchar(255) DEFAULT NULL,
  `email_expediteur` varchar(255) DEFAULT NULL,
  `telephone_expediteur` int(255) DEFAULT NULL,
  `ville_expediteur` varchar(255) DEFAULT NULL,
  `pays_expediteur` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `filieres`
--

CREATE TABLE `filieres` (
  `id` int(10) NOT NULL,
  `libile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `filieres`
--

INSERT INTO `filieres` (`id`, `libile`) VALUES
(1, 'GRT'),
(2, 'GI'),
(3, 'GE'),
(4, 'GPEE'),
(5, 'TC'),
(6, 'CP');

-- --------------------------------------------------------

--
-- Structure de la table `fonctionnaires`
--

CREATE TABLE `fonctionnaires` (
  `id` int(10) NOT NULL,
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
  `photo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fonctionnaires`
--

INSERT INTO `fonctionnaires` (`id`, `somme`, `date_Recrut`, `salaire`, `etat`, `user_id`, `nom_fct`, `prenom_fct`, `dateNaissance`, `lieuNaissance`, `specialite`, `situation_Familiale`, `email`, `etat_attestation`, `etat_fiche`, `phone`, `CIN`, `age`, `genre`, `nbr_enfants`, `isPassExam`, `photo`) VALUES
(3, 'somme', '2019-01-16', 250, 22, 3, 'dfg', 'ahmed', '1997-08-04', 'Khouribga', '', 'célibataire', 'ahmed@gmail.com', 0, 0, 6123456, 'Q14567', 21, 'homme', 0, 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `fonctionnaires_activites`
--

CREATE TABLE `fonctionnaires_activites` (
  `id` int(10) NOT NULL,
  `fonctionnaire_id` int(10) NOT NULL,
  `activite_id` int(10) NOT NULL,
  `poste_comite` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fonctionnaires_documents`
--

CREATE TABLE `fonctionnaires_documents` (
  `id` int(11) NOT NULL,
  `fonctionnaire_id` int(10) NOT NULL,
  `document_id` int(10) NOT NULL,
  `dateDemande` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etatdemande` varchar(30) NOT NULL DEFAULT 'Demande envoyé'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fonctionnaires_grades`
--

CREATE TABLE `fonctionnaires_grades` (
  `id` int(10) NOT NULL,
  `fonctionnaire_id` int(10) NOT NULL,
  `grade_id` int(10) NOT NULL,
  `date_grade` date NOT NULL,
  `date_echelon_rapide` date NOT NULL,
  `date_echelon_moyen` date NOT NULL,
  `date_echelon_normal` date NOT NULL,
  `echelon` int(11) NOT NULL,
  `categorie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fonctionnaires_services`
--

CREATE TABLE `fonctionnaires_services` (
  `id` int(10) NOT NULL,
  `fonctionnaire_id` int(10) NOT NULL,
  `service_id` int(10) NOT NULL,
  `date_debut` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `formationcontinues`
--

CREATE TABLE `formationcontinues` (
  `type` varchar(300) NOT NULL,
  `nomComplet` varchar(600) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `formationinitiales`
--

CREATE TABLE `formationinitiales` (
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
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
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
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` int(11) NOT NULL,
  `stock_categorie_id` int(11) NOT NULL,
  `nom_fournisseur` varchar(50) DEFAULT NULL,
  `prenom_fournisseur` varchar(50) DEFAULT NULL,
  `label_fournisseur` varchar(50) DEFAULT NULL,
  `adresse` text,
  `email` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `grades`
--

CREATE TABLE `grades` (
  `id` int(10) NOT NULL,
  `codeGrade` int(11) NOT NULL,
  `taux` float NOT NULL,
  `nomGrade` varchar(50) NOT NULL,
  `categorie` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE `groupes` (
  `id` int(10) NOT NULL,
  `niveaus_id` int(10) NOT NULL,
  `filiere_id` int(10) NOT NULL,
  `photo_emploi` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `groupes`
--

INSERT INTO `groupes` (`id`, `niveaus_id`, `filiere_id`, `photo_emploi`) VALUES
(1, 5, 2, '');

-- --------------------------------------------------------

--
-- Structure de la table `historiqueemprunte`
--

CREATE TABLE `historiqueemprunte` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `book_id` int(4) NOT NULL,
  `dateEmprunte` date NOT NULL,
  `dateRetour` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `lien` varchar(600) NOT NULL,
  `commentaire` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `laureats`
--

CREATE TABLE `laureats` (
  `id` int(11) NOT NULL,
  `annee` year(4) NOT NULL,
  `nombresTravailles` int(11) NOT NULL,
  `nombresNonTravailles` int(11) NOT NULL,
  `filieres` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `magasins`
--

CREATE TABLE `magasins` (
  `id` int(11) NOT NULL,
  `nom_magasin` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sujet` varchar(60) NOT NULL,
  `contenu` text,
  `piecejointe` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `messagesbureauordres`
--

CREATE TABLE `messagesbureauordres` (
  `id` int(11) NOT NULL,
  `contenu` text,
  `piecejointe` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `missions`
--

CREATE TABLE `missions` (
  `id` int(11) NOT NULL,
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
  `ville_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) NOT NULL,
  `libile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `groupe_id` int(10) NOT NULL,
  `semestre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `motdirecteurs`
--

CREATE TABLE `motdirecteurs` (
  `nomComplet` varchar(600) NOT NULL,
  `texte` text NOT NULL,
  `photo` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `mouvements`
--

CREATE TABLE `mouvements` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `magasin_id` int(11) NOT NULL,
  `date_mouvement` datetime DEFAULT NULL,
  `reference_entree` varchar(255) DEFAULT NULL,
  `reference_sortie` varchar(255) DEFAULT NULL,
  `quantite_entree` int(11) DEFAULT NULL,
  `quantite_sortie` int(11) DEFAULT NULL,
  `service` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `niveaus`
--

CREATE TABLE `niveaus` (
  `id` int(10) NOT NULL,
  `libile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id` int(10) NOT NULL,
  `element_id` int(10) NOT NULL,
  `etudier_id` int(10) NOT NULL,
  `note` float DEFAULT NULL,
  `note_ratt` float DEFAULT NULL,
  `confirmed` int(2) DEFAULT '0',
  `ratt_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `saved` int(2) DEFAULT '0',
  `ratt_saved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notes_auth`
--

CREATE TABLE `notes_auth` (
  `id` int(11) NOT NULL,
  `profpermanent_id` int(11) DEFAULT NULL,
  `key_module` varchar(255) NOT NULL,
  `date_valide` datetime NOT NULL,
  `for_ratt` tinyint(1) NOT NULL DEFAULT '0',
  `pv` tinyint(1) NOT NULL,
  `profvacataire_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notifications_groupe`
--

CREATE TABLE `notifications_groupe` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `principale` text NOT NULL,
  `commentaire` varchar(255) DEFAULT '---------------------',
  `lien` text NOT NULL,
  `style` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notifications_groupe`
--

INSERT INTO `notifications_groupe` (`id`, `titre`, `role`, `created`, `principale`, `commentaire`, `lien`, `style`) VALUES
(3, 'Demande', 'resposcolarite', '2019-02-03 18:37:45', 'Taoussi Sara demande: Certificat scolarité', 'Filiere: <strong>GI</strong>', 'viewCertificatsEtudiants/4', 'info');

-- --------------------------------------------------------

--
-- Structure de la table `notifications_users`
--

CREATE TABLE `notifications_users` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `principale` text NOT NULL,
  `commentaire` varchar(255) DEFAULT '---------------------',
  `lien` text NOT NULL,
  `style` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notifications_users`
--

INSERT INTO `notifications_users` (`id`, `titre`, `user_id`, `created`, `principale`, `commentaire`, `lien`, `style`) VALUES
(1, 'En cours de traitement', 5, '2019-01-24 19:37:37', 'Votre Certificat scolarité est declaré comme: En cours de traitement', NULL, 'viewCertificats/3', 'badge bg-yellow');

-- --------------------------------------------------------

--
-- Structure de la table `ordrepaiements`
--

CREATE TABLE `ordrepaiements` (
  `id` int(11) NOT NULL,
  `identificateur_fiscale` int(11) DEFAULT NULL,
  `num_compte_fournisseur` int(11) DEFAULT NULL,
  `num_compte_paiement` int(11) DEFAULT NULL,
  `num_facture` int(11) DEFAULT NULL,
  `exercice` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `devisdemande_id` int(11) DEFAULT NULL,
  `banque` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ordrevirments`
--

CREATE TABLE `ordrevirments` (
  `id` int(10) UNSIGNED NOT NULL,
  `datevairement` date NOT NULL,
  `lien` varchar(30) NOT NULL,
  `commentaire` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `organisations`
--

CREATE TABLE `organisations` (
  `activite_id` int(10) NOT NULL,
  `id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `paimentsups`
--

CREATE TABLE `paimentsups` (
  `id` int(11) UNSIGNED NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `Numero` int(11) DEFAULT NULL,
  `cheque` varchar(30) DEFAULT NULL,
  `montantBrut` float DEFAULT NULL,
  `Impot` float DEFAULT NULL,
  `MontantNet` float DEFAULT NULL,
  `prelevementsup_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `paimentvacs`
--

CREATE TABLE `paimentvacs` (
  `id` int(11) UNSIGNED NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `Numero` int(11) DEFAULT NULL,
  `cheque` varchar(30) DEFAULT NULL,
  `montantBrut` float DEFAULT NULL,
  `Impot` float DEFAULT NULL,
  `MontantNet` float DEFAULT NULL,
  `prelevement_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

CREATE TABLE `parametres` (
  `id` int(11) NOT NULL,
  `maxProfVac` int(11) NOT NULL,
  `maxProfPer` int(11) NOT NULL,
  `maxEtud` int(11) NOT NULL,
  `dureeEmprunteProf` int(11) NOT NULL,
  `dureeEmprunteEtud` int(11) NOT NULL,
  `dureeReservation` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `preinscriptions`
--

CREATE TABLE `preinscriptions` (
  `id` int(10) NOT NULL,
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
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `preinscriptions_diplomes`
--

CREATE TABLE `preinscriptions_diplomes` (
  `id` int(10) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `groupe` varchar(200) DEFAULT NULL,
  `serie_fr` varchar(50) DEFAULT NULL,
  `serie_ar` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `preinscriptions_etablissements`
--

CREATE TABLE `preinscriptions_etablissements` (
  `id` int(10) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `ville_fr` varchar(50) DEFAULT NULL,
  `ville_ar` varchar(50) DEFAULT NULL,
  `province_fr` varchar(50) DEFAULT NULL,
  `province_ar` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `preinscriptions_infos`
--

CREATE TABLE `preinscriptions_infos` (
  `id` int(10) NOT NULL,
  `preinscriptions_diplome_id` int(10) DEFAULT NULL,
  `preinscriptions_etablissement_id` int(10) DEFAULT NULL,
  `preinscription_id` int(10) DEFAULT NULL,
  `semestre_id` int(10) NOT NULL,
  `note` float NOT NULL,
  `mention` varchar(20) NOT NULL,
  `anneeObtention` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `prelevements`
--

CREATE TABLE `prelevements` (
  `id` int(11) UNSIGNED NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `prelevementsups`
--

CREATE TABLE `prelevementsups` (
  `id` int(11) UNSIGNED NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `profdepartements`
--

CREATE TABLE `profdepartements` (
  `nomComplet` varchar(600) NOT NULL,
  `mail` varchar(600) NOT NULL,
  `telephone` varchar(600) NOT NULL,
  `fax` varchar(600) NOT NULL,
  `departement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `profpermanents`
--

CREATE TABLE `profpermanents` (
  `id` int(10) NOT NULL,
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
  `genre` varchar(150) NOT NULL DEFAULT 'M'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `profpermanentsbis`
--

CREATE TABLE `profpermanentsbis` (
  `id` int(10) NOT NULL,
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
  `isValid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `profpermanents_activites`
--

CREATE TABLE `profpermanents_activites` (
  `id` int(10) NOT NULL,
  `profpermanent_id` int(10) NOT NULL,
  `activite_id` int(10) NOT NULL,
  `poste_comite` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Structure de la table `profpermanents_departements`
--

CREATE TABLE `profpermanents_departements` (
  `id` int(10) NOT NULL,
  `profpermanent_id` int(10) NOT NULL,
  `departement_id` int(10) NOT NULL,
  `Poste_Filiere` varchar(30) NOT NULL,
  `Date_Debut` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Structure de la table `profpermanents_disciplines`
--

CREATE TABLE `profpermanents_disciplines` (
  `id` int(10) NOT NULL,
  `profpermanent_id` int(10) NOT NULL,
  `discipline_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Structure de la table `profpermanents_documents`
--

CREATE TABLE `profpermanents_documents` (
  `id` int(11) NOT NULL,
  `profpermanent_id` int(10) NOT NULL,
  `document_id` int(10) NOT NULL,
  `dateDemande` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etatdemande` varchar(30) NOT NULL DEFAULT 'Demande envoyÃ©'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `profpermanents_grades`
--

CREATE TABLE `profpermanents_grades` (
  `profpermanent_id` int(10) NOT NULL,
  `grade_id` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `date_grade` date NOT NULL,
  `echelon` int(11) NOT NULL,
  `sous_grade` varchar(20) NOT NULL,
  `date_exep` date NOT NULL,
  `date_normal` date NOT NULL,
  `date_rapide` date NOT NULL,
  `date_next_echelon` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Structure de la table `proposition`
--

CREATE TABLE `proposition` (
  `id` int(11) NOT NULL,
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
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pvupdate`
--

CREATE TABLE `pvupdate` (
  `id` int(11) NOT NULL,
  `profpermanent_id` int(11) DEFAULT NULL,
  `note_id` int(11) NOT NULL,
  `date_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profvacataire_id` int(11) DEFAULT NULL,
  `note_old` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `representations`
--

CREATE TABLE `representations` (
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
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(10) NOT NULL,
  `dateReservation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delai` date NOT NULL,
  `user_id` int(10) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `semestres`
--

CREATE TABLE `semestres` (
  `id` int(10) NOT NULL,
  `libile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `niveaus_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(10) NOT NULL,
  `nom_service` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sitedepartements`
--

CREATE TABLE `sitedepartements` (
  `id` int(11) NOT NULL,
  `nom` varchar(600) NOT NULL,
  `chefDepartement` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sitedocuments`
--

CREATE TABLE `sitedocuments` (
  `id` int(11) NOT NULL,
  `titre` varchar(600) NOT NULL,
  `fichier` varchar(600) NOT NULL,
  `id_actualite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sous_categories`
--

CREATE TABLE `sous_categories` (
  `id` int(3) NOT NULL,
  `nom` varchar(15) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `stock_categories`
--

CREATE TABLE `stock_categories` (
  `id` int(11) NOT NULL,
  `label_cat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `sup_heures`
--

CREATE TABLE `sup_heures` (
  `id` int(10) UNSIGNED NOT NULL,
  `mois` int(11) NOT NULL,
  `annee` int(11) NOT NULL,
  `nbHeure` int(11) NOT NULL,
  `dateInsertion` datetime NOT NULL,
  `etat` varchar(10) NOT NULL,
  `profpermanent_id` int(10) NOT NULL,
  `paimentsup_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`) VALUES
(1, 'etudiant', '$2y$10$adq5VBfhM/VelDXJF08WseJdCgJjxXDuwIVVPSSNqk2FAPYOj7FdC', 'etudiant', NULL, NULL),
(2, 'Administrateur', '$2y$10$adq5VBfhM/VelDXJF08WseJdCgJjxXDuwIVVPSSNqk2FAPYOj7FdC', 'admin', NULL, NULL),
(3, 'resposcolarite', '$2y$10$adq5VBfhM/VelDXJF08WseJdCgJjxXDuwIVVPSSNqk2FAPYOj7FdC', 'resposcolarite', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users_books`
--

CREATE TABLE `users_books` (
  `id` int(4) NOT NULL,
  `user_id` int(10) NOT NULL,
  `book_id` int(4) NOT NULL,
  `dateEmprunte` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delai` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users_messages`
--

CREATE TABLE `users_messages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `user_idrecepteur` int(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vacataires`
--

CREATE TABLE `vacataires` (
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
  `email` varchar(20) NOT NULL,
  `nbr_enfants` int(10) NOT NULL,
  `genre` varchar(20) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vacatairesbis`
--

CREATE TABLE `vacatairesbis` (
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
-- Structure de la table `vacataires_activites`
--

CREATE TABLE `vacataires_activites` (
  `id` int(10) NOT NULL,
  `vacataire_id` int(10) NOT NULL,
  `activite_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vacataires_departements`
--

CREATE TABLE `vacataires_departements` (
  `id` int(10) NOT NULL,
  `vacataire_id` int(10) NOT NULL,
  `departement_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vacataires_disciplines`
--

CREATE TABLE `vacataires_disciplines` (
  `id` int(10) NOT NULL,
  `vacataire_id` int(10) NOT NULL,
  `discipline_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vacataires_documents`
--

CREATE TABLE `vacataires_documents` (
  `id` int(11) NOT NULL,
  `vacataire_id` int(30) NOT NULL,
  `type_document` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vacataires_grades`
--

CREATE TABLE `vacataires_grades` (
  `id` int(10) NOT NULL,
  `datedebut` date NOT NULL,
  `datefin` date NOT NULL,
  `grade_id` int(10) NOT NULL,
  `vacataire_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vacations`
--

CREATE TABLE `vacations` (
  `id` int(10) NOT NULL,
  `mois` int(11) NOT NULL,
  `annee` int(11) NOT NULL,
  `nbHeure` int(11) NOT NULL,
  `dateInsertion` datetime NOT NULL,
  `etat` varchar(10) NOT NULL,
  `vacataire_id` int(10) NOT NULL,
  `paimentvac_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `lien` varchar(600) NOT NULL,
  `commentaire` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

CREATE TABLE `villes` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `distance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `vote_books`
--

CREATE TABLE `vote_books` (
  `id_user` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `absences`
--
ALTER TABLE `absences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fonctionnaire_id` (`fonctionnaire_id`),
  ADD KEY `absences_fonctionnaires_id_foreign` (`fonctionnaire_id`);

--
-- Index pour la table `access_admis`
--
ALTER TABLE `access_admis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access_admis_groupes_id_foreign` (`groupe_id`);

--
-- Index pour la table `activites`
--
ALTER TABLE `activites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `activitesdespreinscriptions`
--
ALTER TABLE `activitesdespreinscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `activitesdespreinscriptions_preinscriptions`
--
ALTER TABLE `activitesdespreinscriptions_preinscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preinscriptions_id` (`preinscription_id`),
  ADD KEY `activitesdespreinscription_id` (`activitesdespreinscription_id`);

--
-- Index pour la table `actualiteclubs`
--
ALTER TABLE `actualiteclubs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_club` (`id_club`),
  ADD KEY `id_club_2` (`id_club`),
  ADD KEY `id_image` (`image`,`video`),
  ADD KEY `id_video` (`video`);

--
-- Index pour la table `actualites`
--
ALTER TABLE `actualites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `annee_scolaires`
--
ALTER TABLE `annee_scolaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `articleevents`
--
ALTER TABLE `articleevents`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_categorie_id` (`stock_categorie_id`);

--
-- Index pour la table `asupprimer`
--
ALTER TABLE `asupprimer`
  ADD PRIMARY KEY (`message_id`,`user_id`);

--
-- Index pour la table `autorisations`
--
ALTER TABLE `autorisations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autorisations_groupes_id_foreign` (`groupe_id`),
  ADD KEY `autorisations_annee_scolaires_id_foreign` (`annee_scolaire_id`),
  ADD KEY `autorisations_semestres_id_foreign` (`semestre_id`);

--
-- Index pour la table `boncommandes`
--
ALTER TABLE `boncommandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numInventaire` (`numInventaire`),
  ADD KEY `sous_categorie_id` (`sous_categorie_id`);

--
-- Index pour la table `calendriers`
--
ALTER TABLE `calendriers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `certificats`
--
ALTER TABLE `certificats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `certificats_etudiants`
--
ALTER TABLE `certificats_etudiants`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_id` (`stock_categorie_id`);

--
-- Index pour la table `commande_articles`
--
ALTER TABLE `commande_articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_test` (`commande_id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `article_id_2` (`article_id`);

--
-- Index pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `concours`
--
ALTER TABLE `concours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `niveaus_id` (`niveaus_id`),
  ADD KEY `filiere_id` (`filiere_id`);

--
-- Index pour la table `courrier_arrivees`
--
ALTER TABLE `courrier_arrivees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`);

--
-- Index pour la table `courrier_departs`
--
ALTER TABLE `courrier_departs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destinataire_id` (`destinataire_id`);

--
-- Index pour la table `demande_auth`
--
ALTER TABLE `demande_auth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `demande_auth_classe_id_foreign` (`classe_id`),
  ADD KEY `demande_auth_prof_id_foreign` (`prof_id`),
  ADD KEY `demande_auth_profvacataire_id_foreign` (`profvacataire_id`);

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_departement` (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `destinataires`
--
ALTER TABLE `destinataires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nomComplet_destinataire` (`nomComplet_destinataire`);

--
-- Index pour la table `devisdemandes`
--
ALTER TABLE `devisdemandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `diffusions_messages`
--
ALTER TABLE `diffusions_messages`
  ADD PRIMARY KEY (`message_id`,`user_id`),
  ADD KEY `fk_user_sender` (`user_id`);

--
-- Index pour la table `disciplines`
--
ALTER TABLE `disciplines`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `elements`
--
ALTER TABLE `elements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elements_modules_id_foreign` (`module_id`);

--
-- Index pour la table `enseigners`
--
ALTER TABLE `enseigners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enseigners_profpermanent_id_foreign` (`profpermanent_id`),
  ADD KEY `enseigners_annee_scolaires_id_foreign` (`annee_scolaire_id`),
  ADD KEY `enseigners_elements_id_foreign` (`element_id`),
  ADD KEY `enseigners_semestres_id_foreign` (`semestre_id`);

--
-- Index pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `apogee` (`apogee`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Index pour la table `etudiers`
--
ALTER TABLE `etudiers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `etudiers_etudiants_id_foreign` (`etudiant_id`),
  ADD KEY `etudiers_annee_scolaires_id_foreign` (`annee_scolaire_id`),
  ADD KEY `etudiers_classes_id_foreign` (`groupe_id`),
  ADD KEY `etudiers_elements_id_foreign` (`element_id`);

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `expediteurs`
--
ALTER TABLE `expediteurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `filieres`
--
ALTER TABLE `filieres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fonctionnaires`
--
ALTER TABLE `fonctionnaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Index pour la table `fonctionnaires_activites`
--
ALTER TABLE `fonctionnaires_activites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fonctionnaires_id` (`fonctionnaire_id`),
  ADD KEY `activites_id` (`activite_id`);

--
-- Index pour la table `fonctionnaires_documents`
--
ALTER TABLE `fonctionnaires_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fonctionnaire_id` (`fonctionnaire_id`),
  ADD KEY `document_id` (`document_id`);

--
-- Index pour la table `fonctionnaires_grades`
--
ALTER TABLE `fonctionnaires_grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fonctionnaire_id` (`fonctionnaire_id`),
  ADD KEY `grade_id` (`grade_id`);

--
-- Index pour la table `fonctionnaires_services`
--
ALTER TABLE `fonctionnaires_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fonctionnaire_id` (`fonctionnaire_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD KEY `id_document` (`id_document`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_categorie_id` (`stock_categorie_id`);

--
-- Index pour la table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classes_niveaus_id_foreign` (`niveaus_id`),
  ADD KEY `classes_filiere_id_foreign` (`filiere_id`);

--
-- Index pour la table `historiqueemprunte`
--
ALTER TABLE `historiqueemprunte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `magasins`
--
ALTER TABLE `magasins`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messagesbureauordres`
--
ALTER TABLE `messagesbureauordres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ville_id` (`ville_id`),
  ADD KEY `profpermanent_id` (`profpermanent_id`),
  ADD KEY `fonctionnaires_id` (`fonctionnaire_id`);

--
-- Index pour la table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modules_groupe_id_foreign` (`groupe_id`);

--
-- Index pour la table `mouvements`
--
ALTER TABLE `mouvements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `magasin_id` (`magasin_id`);

--
-- Index pour la table `niveaus`
--
ALTER TABLE `niveaus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notes_auth`
--
ALTER TABLE `notes_auth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_auth_profpermanent_id_foreign` (`profpermanent_id`),
  ADD KEY `notes_auth_profvacataire_id_foreign` (`profvacataire_id`);

--
-- Index pour la table `notifications_groupe`
--
ALTER TABLE `notifications_groupe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications_users`
--
ALTER TABLE `notifications_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ordrepaiements`
--
ALTER TABLE `ordrepaiements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ordrevirments`
--
ALTER TABLE `ordrevirments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `organisations`
--
ALTER TABLE `organisations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idActivite` (`activite_id`);

--
-- Index pour la table `paimentsups`
--
ALTER TABLE `paimentsups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prelevementsup_id` (`prelevementsup_id`);

--
-- Index pour la table `paimentvacs`
--
ALTER TABLE `paimentvacs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordrevairment_id` (`prelevement_id`),
  ADD KEY `ordrevirment_id` (`prelevement_id`);

--
-- Index pour la table `parametres`
--
ALTER TABLE `parametres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `preinscriptions`
--
ALTER TABLE `preinscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `concour_id` (`concour_id`);

--
-- Index pour la table `preinscriptions_diplomes`
--
ALTER TABLE `preinscriptions_diplomes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `preinscriptions_etablissements`
--
ALTER TABLE `preinscriptions_etablissements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `preinscriptions_infos`
--
ALTER TABLE `preinscriptions_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preinscriptions_diplomes_id` (`preinscriptions_diplome_id`),
  ADD KEY `preinscriptions_etablissements_id` (`preinscriptions_etablissement_id`),
  ADD KEY `preinscriptions_id` (`preinscription_id`),
  ADD KEY `semestres_id` (`semestre_id`);

--
-- Index pour la table `prelevements`
--
ALTER TABLE `prelevements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prelevementsups`
--
ALTER TABLE `prelevementsups`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profpermanents`
--
ALTER TABLE `profpermanents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `profpermanentsbis`
--
ALTER TABLE `profpermanentsbis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profpermanents_activites`
--
ALTER TABLE `profpermanents_activites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profpermanent_id` (`profpermanent_id`),
  ADD KEY `activite_id` (`activite_id`);

--
-- Index pour la table `profpermanents_departements`
--
ALTER TABLE `profpermanents_departements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profpermanent_id` (`profpermanent_id`),
  ADD KEY `departement_id` (`departement_id`);

--
-- Index pour la table `profpermanents_disciplines`
--
ALTER TABLE `profpermanents_disciplines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profpermanent_id` (`profpermanent_id`),
  ADD KEY `discipline_id` (`discipline_id`);

--
-- Index pour la table `profpermanents_documents`
--
ALTER TABLE `profpermanents_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profpermanent_id` (`profpermanent_id`),
  ADD KEY `document_id` (`document_id`);

--
-- Index pour la table `profpermanents_grades`
--
ALTER TABLE `profpermanents_grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profpermanent_id` (`profpermanent_id`),
  ADD KEY `grades_id` (`grade_id`);

--
-- Index pour la table `proposition`
--
ALTER TABLE `proposition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `pvupdate`
--
ALTER TABLE `pvupdate`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`book_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Index pour la table `semestres`
--
ALTER TABLE `semestres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semestres_niveaus_id_foreign` (`niveaus_id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sitedocuments`
--
ALTER TABLE `sitedocuments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_actualité` (`id_actualite`),
  ADD KEY `id_actualité_2` (`id_actualite`);

--
-- Index pour la table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sous_categories_ibfk_1` (`categorie_id`);

--
-- Index pour la table `stock_categories`
--
ALTER TABLE `stock_categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sup_heures`
--
ALTER TABLE `sup_heures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paiementsupo_sdsd_fk` (`paimentsup_id`),
  ADD KEY `prof_fk_suph` (`profpermanent_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users_books`
--
ALTER TABLE `users_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_books_ibfk_1` (`book_id`),
  ADD KEY `users_books_ibfk_2` (`user_id`);

--
-- Index pour la table `users_messages`
--
ALTER TABLE `users_messages`
  ADD KEY `fk_messages` (`message_id`),
  ADD KEY `fk_users_messages` (`user_id`),
  ADD KEY `fk_users_messages_recept` (`user_idrecepteur`);

--
-- Index pour la table `vacataires`
--
ALTER TABLE `vacataires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vacataires_ibfk_1` (`user_id`);

--
-- Index pour la table `vacataires_activites`
--
ALTER TABLE `vacataires_activites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vacataire_id` (`vacataire_id`),
  ADD KEY `activite_id` (`activite_id`);

--
-- Index pour la table `vacataires_departements`
--
ALTER TABLE `vacataires_departements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vacataire_id` (`vacataire_id`),
  ADD KEY `departement_id` (`departement_id`);

--
-- Index pour la table `vacataires_disciplines`
--
ALTER TABLE `vacataires_disciplines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vacataire_id` (`vacataire_id`),
  ADD KEY `discipline_id` (`discipline_id`);

--
-- Index pour la table `vacataires_documents`
--
ALTER TABLE `vacataires_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `const1` (`vacataire_id`);

--
-- Index pour la table `vacataires_grades`
--
ALTER TABLE `vacataires_grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grade_id` (`grade_id`),
  ADD KEY `vacataire_id` (`vacataire_id`);

--
-- Index pour la table `vacations`
--
ALTER TABLE `vacations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mois` (`mois`,`annee`,`vacataire_id`),
  ADD KEY `vacataire_id` (`vacataire_id`),
  ADD KEY `paimentvac_id` (`paimentvac_id`);

--
-- Index pour la table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `villes`
--
ALTER TABLE `villes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `absences`
--
ALTER TABLE `absences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `activites`
--
ALTER TABLE `activites`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `activitesdespreinscriptions`
--
ALTER TABLE `activitesdespreinscriptions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `activitesdespreinscriptions_preinscriptions`
--
ALTER TABLE `activitesdespreinscriptions_preinscriptions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `actualiteclubs`
--
ALTER TABLE `actualiteclubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `actualites`
--
ALTER TABLE `actualites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `annee_scolaires`
--
ALTER TABLE `annee_scolaires`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `articleevents`
--
ALTER TABLE `articleevents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `autorisations`
--
ALTER TABLE `autorisations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `boncommandes`
--
ALTER TABLE `boncommandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `calendriers`
--
ALTER TABLE `calendriers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `certificats`
--
ALTER TABLE `certificats`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `certificats_etudiants`
--
ALTER TABLE `certificats_etudiants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commande_articles`
--
ALTER TABLE `commande_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `concours`
--
ALTER TABLE `concours`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `courrier_arrivees`
--
ALTER TABLE `courrier_arrivees`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `courrier_departs`
--
ALTER TABLE `courrier_departs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demande_auth`
--
ALTER TABLE `demande_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `destinataires`
--
ALTER TABLE `destinataires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `devisdemandes`
--
ALTER TABLE `devisdemandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `elements`
--
ALTER TABLE `elements`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `enseigners`
--
ALTER TABLE `enseigners`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `etudiers`
--
ALTER TABLE `etudiers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `expediteurs`
--
ALTER TABLE `expediteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `filieres`
--
ALTER TABLE `filieres`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `fonctionnaires`
--
ALTER TABLE `fonctionnaires`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `fonctionnaires_activites`
--
ALTER TABLE `fonctionnaires_activites`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fonctionnaires_documents`
--
ALTER TABLE `fonctionnaires_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fonctionnaires_grades`
--
ALTER TABLE `fonctionnaires_grades`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fonctionnaires_services`
--
ALTER TABLE `fonctionnaires_services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `historiqueemprunte`
--
ALTER TABLE `historiqueemprunte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `magasins`
--
ALTER TABLE `magasins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messagesbureauordres`
--
ALTER TABLE `messagesbureauordres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `missions`
--
ALTER TABLE `missions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mouvements`
--
ALTER TABLE `mouvements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `niveaus`
--
ALTER TABLE `niveaus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notes_auth`
--
ALTER TABLE `notes_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notifications_groupe`
--
ALTER TABLE `notifications_groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `notifications_users`
--
ALTER TABLE `notifications_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ordrepaiements`
--
ALTER TABLE `ordrepaiements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ordrevirments`
--
ALTER TABLE `ordrevirments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paimentsups`
--
ALTER TABLE `paimentsups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paimentvacs`
--
ALTER TABLE `paimentvacs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `parametres`
--
ALTER TABLE `parametres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `preinscriptions`
--
ALTER TABLE `preinscriptions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `preinscriptions_diplomes`
--
ALTER TABLE `preinscriptions_diplomes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `preinscriptions_etablissements`
--
ALTER TABLE `preinscriptions_etablissements`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `preinscriptions_infos`
--
ALTER TABLE `preinscriptions_infos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `prelevements`
--
ALTER TABLE `prelevements`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
