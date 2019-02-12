-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 12 fév. 2019 à 18:01
-- Version du serveur :  10.1.33-MariaDB
-- Version de PHP :  5.6.39

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

--
-- Déchargement des données de la table `absences`
--

INSERT INTO `absences` (`id`, `fonctionnaire_id`, `duree_ab`, `cause`, `date_ab`, `time_ab`, `isvalid`) VALUES
(1, 8, 1, 'juhgfdsak', '2014-01-02', '12:30:00', 1),
(2, 14, 0.5, 'ghi bghit ', '2019-03-22', '22:31:00', 0),
(3, 14, 1, 'ghi bghit tani ', '0000-00-00', '22:31:00', 0),
(4, 14, 0.5, 'ghi bghit tani ', '2019-03-22', '22:31:00', 0);

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

--
-- Déchargement des données de la table `activites`
--

INSERT INTO `activites` (`id`, `nomActivite`, `dateDebut`, `dateFin`, `photo`) VALUES
(1, 'chi haja3', '12/11/2011', '30/11/2011', 'foru.jpg'),
(2, 'chi haja4', '13/10/2011', '14/10/2011', 'exemple.jpg'),
(3, 'os', '11/11/2011', '11/11/2011', 'foru.jpg'),
(4, 'energy', '12/12/2012', '12/12/2012', 'Forum2.jpg');

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
(1, '2018/2019', '2019-01-31'),
(2, '2', '2019-01-31');

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
  `accuse` varchar(255) NOT NULL,
  `courrier_retourne` varchar(5) DEFAULT 'Non'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `courrier_arrivees`
--

INSERT INTO `courrier_arrivees` (`date_arrivee`, `Désignation`, `expediteur_id`, `type_courrier`, `Priorité`, `date_limite_du_traitement`, `etat_du_courrier`, `service_id`, `necessité_du_traitement`, `id`, `courrier`, `accuse`, `courrier_retourne`) VALUES
('2019-01-08', 'test1', 1, 'courrier externe', 'Normal', '2024-01-01', '-', NULL, 'Non', 4, '', '', 'Oui'),
('2019-01-08', 'test2', 1, 'courrier externe', '-', NULL, '-', NULL, 'Non', 5, '', '', 'Oui'),
('2019-04-01', 'test2', 1, 'externe', 'Normal', '2019-03-23', 'interrompu', 1, 'Oui', 6, '', '', 'Non');

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
(1, 'Génie réseaux et télécoms', 2, 1),
(2, 'Génie Informatique', 1, 2),
(3, 'Génie Eléctrique', 1, 3),
(4, 'Génie des procédés', 1, 4);

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

--
-- Déchargement des données de la table `diffusions_messages`
--

INSERT INTO `diffusions_messages` (`message_id`, `user_id`, `typerecepteur`, `group_id`, `departement_id`, `date`) VALUES
(3, 4, 'profsParFiliere', 1, NULL, '2019-01-14 16:00:23'),
(9, 4, 'profs', NULL, NULL, '2019-02-03 14:20:19'),
(10, 4, 'etudiantsParFiliereSco', 1, NULL, '2019-02-03 14:29:01');

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

--
-- Déchargement des données de la table `documents`
--

INSERT INTO `documents` (`id`, `idDocument`, `nbDocument`, `nomDocument`) VALUES
(1, 1, 0, 'AttestationTravail'),
(2, 2, 0, 'FicheSalaire');

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

--
-- Déchargement des données de la table `elements`
--

INSERT INTO `elements` (`id`, `code`, `libile`, `module_id`, `CM`, `Eval`, `AP`, `TP`, `TD`) VALUES
(1, 'code', 'libile', 3, 11, 5, 7, 9, 0),
(2, 'code', 'libile', 1, 22, 5, 7, 9, 0),
(3, '12324X', 'ZDE', 1, 11, 23, 232, 223, 23);

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

--
-- Déchargement des données de la table `enseigners`
--

INSERT INTO `enseigners` (`id`, `semestre_id`, `annee_scolaire_id`, `element_id`, `profpermanent_id`, `vacataire_id`) VALUES
(1, 1, 1, 2, 3, 1);

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
(1, 3, 'apogee', 'hasnae', 'hasnae', 'hasnae', 'hasnae', 544545, 'aef44', '2019-01-02', NULL, NULL, NULL, NULL, NULL, NULL, 'f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL);

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
(1, 1, 1, 2, 2),
(2, 1, 1, 2, 1),
(3, 1, 1, 2, 3);

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
(4, 'GPE'),
(5, 'CP'),
(6, 'TC');

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
(1, 'Voluptatem deleniti ', '0000-00-00', 0, 0, 31, 'Nesciunt et magni c', 'Fugiat quos aut quia', '0000-00-00', 'Animi molestiae lau', 'Dolor fugit tempora', 'marié', 'kysiz@mailinator.com', 0, 0, 1, 'Sunt quis c', 0, 'M', 0, 0, ''),
(2, 'Obcaecati animi aut', '0000-00-00', 0, 0, 32, 'Sint amet ullam dol', 'Eiusmod quasi aliqua', '0000-00-00', 'Voluptates quis qui ', 'Laudantium minus li', 'marié', 'fugi@mailinator.net', 0, 0, 1, 'Iure velit ', 0, 'M', 0, 0, ''),
(3, 'Pariatur Sint qui e', '0000-00-00', 0, 0, 33, 'Magna commodo rerum ', 'Maxime saepe obcaeca', '0000-00-00', 'Anim adipisci dolore', 'Est provident volup', 'marié', 'ceky@mailinator.net', 0, 0, 1, 'Id quis rer', 0, 'M', 0, 0, ''),
(4, 'Suscipit omnis conse', '0000-00-00', 0, 0, 34, 'Assumenda quia sed r', 'Et facere provident', '0000-00-00', 'Optio ipsa exercit', 'Velit cupiditate ill', 'Veuf', 'sylugicif@mailinator.net', 0, 0, 1, 'In quia ad ', 0, 'M', 0, 0, ''),
(5, 'Est fugiat aut quide', '0000-00-00', 0, 0, 57, 'Reprehenderit ut ali', 'Sint alias eaque qu', '0000-00-00', 'Architecto consectet', 'Velit voluptatibus a', 'Veuf', 'halemah@mailinator.net', 0, 0, 1, 'Dicta expli', 23, 'M', 0, 0, 'admin.png'),
(6, 'Velit Nam amet mol', '0000-00-00', 0, 0, 68, 'Id tempor velit vel', 'Blanditiis est nesci', '0000-00-00', 'Unde dolor accusanti', 'Ex architecto dolore', 'marié', 'cyho@mailinator.net', 0, 0, 1, 'Dicta dolor', 0, 'M', 0, 0, ''),
(7, 'Quos in et tempore ', '2022-02-22', 0, 0, 69, 'Nihil perferendis oc', 'Sed dolores aliqua ', '2022-02-22', 'Dolore accusantium l', 'Quis minus tenetur e', 'marié', 'lyvu@mailinator.net', 0, 0, 1, 'Sed velit p', 0, 'M', 0, 0, ''),
(8, 'Consequatur dolorum ', '2022-02-22', 0, 0, 70, 'Officiis provident ', 'Et beatae quia dicta', '2022-02-22', 'Sequi quam tenetur q', 'Eaque voluptatem id', 'marié', 'cylop@mailinator.net', 0, 0, 1, '1344', 0, 'M', 0, 0, ''),
(9, 'Aut commodo temporib', '2011-11-11', 0, 0, 71, 'Ipsam sint quia et q', 'Ipsum qui repellendu', '2011-11-11', 'Reiciendis ut accusa', 'In libero consequat', 'marié', 'suqasa@mailinator.com', 1, 0, 135435, '354', 0, 'M', 0, 0, ''),
(10, '45665', '2011-11-11', 4455, 0, 72, 'Karim', 'Said', '1982-12-22', 'Khouribga', 'technicien', 'marié', 'fonc@gmail.com', 0, 0, 612454565, 'Q55555', 36, 'M', 3, 0, ''),
(11, 'Reiciendis magni fug', '2022-02-22', 0, 0, 75, 'Culpa nobis incidun', 'Consequatur Quia de', '2022-02-22', 'Quas magna aut est ', 'Perferendis occaecat', 'Veuf', 'gikotag@mailinator.net', 0, 0, 1, 'Enim iusto ', 0, 'femelle', 0, 0, ''),
(12, 'Nam alias suscipit a', '2011-11-11', 14, 0, 99, 'At dolor aperiam vol', 'Dolor est tempor es', '2011-11-11', 'Ad adipisci itaque v', 'Sint dolor aut volup', 'Divorcé', 'gody@mailinator.com', 0, 0, 1, 'Esse non ul', 65, 'femelle', 76, 0, ''),
(13, 'Nostrum officia moll', '2011-11-11', 53, 0, 100, 'Nesciunt itaque des', 'Consequuntur libero ', '2011-11-11', 'Rerum autem omnis od', 'Esse sint nostrud vo', 'Célibataire ', 'rejatehyt@mailinator.com', 0, 0, 1, 'Eiusmod qua', 51, 'femelle', 84, 0, ''),
(14, 'toto tiiti', '2054-04-05', 20000, 0, 104, 'salihi', 'yassine', '2045-04-06', 'berrechid', 'info', 'Célibataire ', 'yassinesalihi4@gmail.com', 0, 0, 607497140, 'w4242424242', 33, 'male', 0, 0, 'Koala.jpg'),
(15, 'toto tiiti', '2045-05-04', 20000, 0, 105, 'fonction', 'yassine', '2055-04-30', 'berrechid', 'info', 'marié', 'yassinesalihi4@gmail.com', 0, 0, 607497140, 'w4242424242', 33, 'male', 0, 0, ''),
(16, 'toto tiiti', '2045-03-04', 20000, 0, 106, 'salihi', 'yassinefonct', '2043-05-31', 'berrechid', 'electrique', 'Célibataire ', 'yassinesalihi4@gmail.com', 0, 0, 607497140, 'w4242424242', 33, 'male', 0, 0, ''),
(17, 'toto tiiti', '2043-05-04', 20000, 0, 107, 'salihi', 'yassinefonct', '2045-03-05', 'berrechid', 'electrique', 'marié', 'yassinesalihi4@gmail.com', 0, 0, 607497140, 'w4242424242', 33, 'male', 0, 0, ''),
(18, 'toto tiiti', '2045-04-05', 20000, 0, 108, 'salihi', 'yassinefonct', '2043-05-04', 'berrechid', 'electrique', 'marié', 'yassinesalihi4@gmail.com', 0, 0, 607497140, 'w4242424242', 33, 'male', 0, 0, ''),
(19, 'toto tiiti', '2056-04-05', 20000, 0, 109, 'salihi', 'yassine', '2045-04-06', 'berrechid', 'info', 'marié', 'yassinesalihi4@gmail.com', 0, 0, 607497140, 'w4242424242', 33, 'male', 0, 0, ''),
(20, 'toto tiiti', '2056-06-06', 20000, 0, 110, 'salihi', 'yassine', '2045-06-04', 'berrechid', 'info', 'marié', 'yassinesalihi4@gmail.com', 0, 0, 607497140, 'w4242424242', 33, 'male', 0, 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `fonctionnairesbis`
--

CREATE TABLE `fonctionnairesbis` (
  `id` int(11) NOT NULL,
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
  `date_envoi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isValid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Déchargement des données de la table `fonctionnaires_activites`
--

INSERT INTO `fonctionnaires_activites` (`id`, `fonctionnaire_id`, `activite_id`, `poste_comite`) VALUES
(1, 11, 4, 'Assistant'),
(2, 10, 1, 'Chef'),
(3, 9, 4, 'president');

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

--
-- Déchargement des données de la table `fonctionnaires_documents`
--

INSERT INTO `fonctionnaires_documents` (`id`, `fonctionnaire_id`, `document_id`, `dateDemande`, `etatdemande`) VALUES
(1, 9, 1, '2019-02-07 20:34:29', 'Prete');

-- --------------------------------------------------------

--
-- Structure de la table `fonctionnaires_grades`
--

CREATE TABLE `fonctionnaires_grades` (
  `id` int(10) NOT NULL,
  `fonctionnaire_id` int(10) DEFAULT NULL,
  `grade_id` int(10) DEFAULT NULL,
  `date_grade` date DEFAULT NULL,
  `date_echelon_rapide` date DEFAULT NULL,
  `date_echelon_moyen` date DEFAULT NULL,
  `date_echelon_normal` date DEFAULT NULL,
  `echelon` int(11) DEFAULT NULL,
  `categorie` varchar(100) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fonctionnaires_grades`
--

INSERT INTO `fonctionnaires_grades` (`id`, `fonctionnaire_id`, `grade_id`, `date_grade`, `date_echelon_rapide`, `date_echelon_moyen`, `date_echelon_normal`, `echelon`, `categorie`, `grade`) VALUES
(2, 2, 4, '2011-11-11', '2014-11-11', '2015-05-11', '2015-11-11', 6, '0', 1),
(3, 3, 1, '2011-11-11', '2013-11-11', '2014-05-11', '2015-05-11', 5, '2', 0),
(4, 4, 1, '2011-11-11', '2013-11-11', '2014-05-11', '2014-11-11', 4, '4', 1),
(5, 5, 1, '2000-02-02', '2003-02-02', '2004-02-02', '2004-02-02', 6, '6', 4),
(6, 6, 1, '2011-11-11', '2011-11-11', '2011-11-11', '2011-11-11', 2, '8', 1),
(7, 7, 4, '2011-11-11', '2012-11-11', '2012-11-11', '2012-11-11', 1, '0', 1),
(8, 8, 1, '2022-02-22', '2022-02-22', '2022-02-22', '2022-02-22', 2, '8', 1),
(9, 9, 1, '2011-11-11', '2011-11-11', '2011-11-11', '2011-11-11', 2, '8', 1),
(10, 10, 1, '2011-11-11', '2014-11-11', '2015-05-11', '2016-05-11', 9, '0', 2),
(11, 11, 1, '2022-02-22', '2024-02-22', '2024-08-22', '2025-08-22', 5, '2', 3),
(12, 12, 1, '2011-11-11', '2011-11-11', '2011-11-11', '2011-11-11', 11, '3', 2),
(13, 13, 1, '2011-11-11', '2013-11-11', '2014-05-11', '2015-05-11', 5, '5', 2),
(14, 20, 1, '2046-06-05', '2047-06-05', '2047-06-05', '2047-06-05', 2, '1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `fonctionnaires_services`
--

CREATE TABLE `fonctionnaires_services` (
  `id` int(10) NOT NULL,
  `fonctionnaire_id` int(10) NOT NULL,
  `service_id` int(10) NOT NULL,
  `date_debut` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fonctionnaires_services`
--

INSERT INTO `fonctionnaires_services` (`id`, `fonctionnaire_id`, `service_id`, `date_debut`) VALUES
(1, 11, 1, '2022-02-22'),
(2, 8, 1, '1999-02-04');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `grades`
--

INSERT INTO `grades` (`id`, `codeGrade`, `taux`, `nomGrade`, `categorie`) VALUES
(1, 1337, 19.4444, 'rouzi', 'B');

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
(1, 1, 2, ''),
(2, 1, 2, '');

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
-- Structure de la table `infosgradesprofs`
--

CREATE TABLE `infosgradesprofs` (
  `id` int(11) NOT NULL,
  `indice` int(11) NOT NULL,
  `cadre` varchar(4) NOT NULL,
  `grade` varchar(2) NOT NULL,
  `echelon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='infosgradesprofs' ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `infosgradesprofs`
--

INSERT INTO `infosgradesprofs` (`id`, `indice`, `cadre`, `grade`, `echelon`) VALUES
(1, 509, 'A', 'A', 1),
(2, 542, 'A', 'A', 2),
(3, 574, 'A', 'A', 3),
(4, 580, 'H', 'A', 1),
(5, 606, 'A', 'A', 4),
(6, 620, 'H', 'A', 2),
(7, 639, 'A', 'B', 1),
(8, 660, 'H', 'A', 3),
(9, 704, 'A', 'B', 2),
(10, 720, 'H', 'A', 4),
(11, 746, 'A', 'B', 3),
(12, 760, 'PES', 'A', 1),
(13, 779, 'H', 'B', 1),
(14, 785, 'PES', 'A', 2),
(15, 810, 'PES', 'A', 3),
(16, 812, 'H', 'B', 2),
(17, 835, 'PES', 'A', 4),
(18, 840, 'H', 'B', 3),
(19, 860, 'PES', 'B', 1),
(20, 870, 'H', 'B', 4),
(21, 885, 'PES', 'B', 2),
(22, 900, 'H', 'C', 1),
(23, 915, 'PES', 'B', 3),
(24, 930, 'H', 'C', 2),
(25, 945, 'PES', 'B', 4),
(26, 960, 'H', 'C', 3),
(27, 975, 'PES', 'C', 1),
(28, 990, 'H', 'C', 4),
(29, 1005, 'PES', 'C', 2),
(30, 1020, 'H', 'C', 5),
(31, 1035, 'PES', 'C', 3),
(32, 1065, 'PES', 'C', 4),
(33, 1095, 'PES', 'C', 5),
(34, 779, 'A', 'B', 4),
(35, 812, 'A', 'C', 1),
(36, 840, 'A', 'C', 2),
(37, 870, 'A', 'C', 3),
(38, 900, 'A', 'C', 4),
(39, 930, 'A', 'D', 1),
(40, 960, 'A', 'D', 2),
(41, 990, 'A', 'D', 3),
(42, 1020, 'A', 'D', 4);

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

--
-- Déchargement des données de la table `messages`
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

--
-- Déchargement des données de la table `modules`
--

INSERT INTO `modules` (`id`, `libile`, `groupe_id`, `semestre_id`) VALUES
(1, 'php', 2, 1),
(2, 'hh', 1, 2),
(3, 'uml', 1, 1);

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

--
-- Déchargement des données de la table `niveaus`
--

INSERT INTO `niveaus` (`id`, `libile`) VALUES
(1, 'premiere annee'),
(2, 'deuxieme annee'),
(3, 'troisieme annee'),
(4, 'quatrieme annee annee'),
(5, 'cinquieme annee');

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

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`id`, `element_id`, `etudier_id`, `note`, `note_ratt`, `confirmed`, `ratt_confirmed`, `saved`, `ratt_saved`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 10, NULL, 0, 0, 0, 0, '2005-02-19 11:02:00', '2005-02-19 11:02:00'),
(2, 2, 1, 12, NULL, 0, 0, 0, 0, '2005-02-19 11:02:00', '2005-02-19 11:02:00');

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

--
-- Déchargement des données de la table `profdepartements`
--

INSERT INTO `profdepartements` (`nomComplet`, `mail`, `telephone`, `fax`, `departement`) VALUES
('zerty', 'hasna@gmqil.com', '', '', 1),
('meriem mandar', 'mandar@gmail', '', '', 1);

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
  `CIN` varchar(30) NOT NULL,
  `email_prof` varchar(50) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `etat_attestation` int(11) DEFAULT '0',
  `etatdemande` int(11) DEFAULT '0',
  `photo` varchar(100) NOT NULL,
  `etat_fichesalaire` int(11) NOT NULL DEFAULT '0',
  `genre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `profpermanents`
--

INSERT INTO `profpermanents` (`id`, `user_id`, `somme`, `salaire`, `etat`, `date_Recrut`, `nom_prof`, `prenom_prof`, `age`, `diplome`, `specialite`, `universite`, `autresdiplomes`, `situation_familiale`, `dateNaissance`, `Lieu_Naissance`, `CIN`, `email_prof`, `phone`, `etat_attestation`, `etatdemande`, `photo`, `etat_fichesalaire`, `genre`) VALUES
(22, 26, '125', 0, 'Actif', '0000-00-00 00:00:00', 'Ratione maiores offi', 'Dignissimos totam be', 0, 'Quidem aliquam est ', 'Animi anim ea eos ', 'Ut velit enim omnis ', 'Laborum Vero quidem', 'Veuf', '0000-00-00', 'Aliquam aut veritati', '0', 'xasun@mailinator.net', '+1 (453) 354-', 0, 0, '', 0, 'M'),
(23, 27, 'Omnis necessitatibus', 0, 'Actif', '0000-00-00 00:00:00', 'Proident duis verit', 'Nam dolor qui ea dol', 0, 'Adipisicing nostrum ', 'Elit deleniti nobis', 'Voluptate minima ist', 'Animi dolore conseq', 'Divorcé', '0000-00-00', 'Et inventore eius si', '0', 'xitedeh@mailinator.com', '+1 (972) 203-', 0, 0, '', 0, 'M'),
(24, 28, 'Et distinctio Asper', 0, 'Actif', '0000-00-00 00:00:00', 'Commodi dolore autem', 'Natus consequatur as', 0, 'In lorem iusto at ni', 'Aliquid dolor duis a', 'Est modi laudantium', 'Sit voluptates eu ul', 'Divorcé', '0000-00-00', 'Natus deserunt labor', '0', 'qufowas@mailinator.net', '+1 (607) 796-', 0, 0, '', 0, 'M'),
(25, 29, 'Corrupti aliquid mo', 0, 'Actif', '0000-00-00 00:00:00', 'Doloremque cupidatat', 'Fugiat aliquid qui ', 0, 'Dicta enim quis et e', 'Et quis nobis commod', 'Laborum rem dolor qu', 'Suscipit dolor sit m', 'Veuf', '0000-00-00', 'Qui est amet est qu', '0', 'lewoki@mailinator.com', '+1 (961) 466-', 0, 0, '', 0, 'M'),
(26, 44, 'Nihil in officiis ea', 0, 'Actif', '2022-02-22 00:00:00', 'Sed debitis aut blan', 'Reprehenderit dolor ', 0, 'Quo mollitia aliquip', 'Id sint tempore qu', 'Ex reprehenderit ob', 'Ut iste omnis irure ', 'Divorcé', '2022-02-22', 'Tenetur sunt nisi p', '0', 'qiwyfenah@mailinator.com', '+1 (915) 922-', 0, 0, '', 0, 'M'),
(27, 51, 'Consequat Explicabo', 0, 'Actif', '0000-00-00 00:00:00', 'Tenetur laboris et e', 'Amet dicta id qui e', 5, 'Est sint perferendis', 'Officia dolorum dolo', 'Sit esse placeat v', 'Aut id reprehenderit', 'Célibataire ', '2022-02-22', 'Quo ullam amet eos', '0', 'xakuber@mailinator.com', '+1 (544) 352-', 0, 0, '', 0, 'M'),
(28, 53, 'Corrupti animi rec', 0, 'Perspiciatis id labore perspi', '2016-06-23 12:36:00', 'Quis beatae atque et fugiat a', 'Reprehenderit aut praesentium', 66, 'Sed soluta necessita', 'Labore nostrud aut est dolor amet quia', 'Corporis non commodi', 'Reprehenderit ea vol', 'Esse ullamco non dicta qui qui eveniet quisquam ', '1975-12-15', 'berlin', '15', 'wugos@mailinator.net', '+1 (265) 743-', 88, 96, '585e4bcdcb11b227491c3396.png', 2, ''),
(29, 56, 'SD0432', 50000, 'Actif', '2000-02-20 00:00:00', 'Mandar', 'Meriem', 30, 'Doctora', 'web', 'Faculté', '', 'marié', '1980-02-02', 'Casablanca', 'DE39483', 'rilipyset@mailinator.com', '+212-69-33529', 2, 0, 'avatar3.png', 2, ''),
(30, 62, 'Dolorem nulla evenie', 0, 'Actif', '0000-00-00 00:00:00', 'Cupiditate modi adip', 'Temporibus aut eveni', 0, 'Quibusdam et molesti', 'Et inventore aut qui', 'Consectetur autem do', 'Officia non enim dol', 'Divorcé', '0000-00-00', 'Ducimus porro ducim', 'Quo provident autem', 'tymoc@mailinator.net', '+1 (838) 551-', 0, 0, 'dawdi.png', 0, ''),
(31, 63, 'Ut corporis dolore u', 0, 'Actif', '2000-02-02 00:00:00', 'In irure vitae maxim', 'Sint dolorem illo re', 32, 'Quis quasi fugiat ex', 'Iste culpa dolor nul', 'Nihil perspiciatis ', 'Itaque impedit elit', 'Célibataire ', '1900-02-02', 'Sit est eveniet m', 'BD345038', 'senujyhij@mailinator.net', '+1 (561) 994-', 0, 0, 'dawdi.png', 0, ''),
(32, 64, 'A sit reprehenderit', 0, 'Actif', '0000-00-00 00:00:00', 'Minima sunt volupta', 'Ullam non aliquam ea', 0, 'Officiis minus conse', 'Iure temporibus reru', 'Ullamco consequat C', 'Error in minima ut s', 'Veuf', '0000-00-00', 'Laborum illum quide', 'Anim ipsum ipsa rat', 'sezodylefi@mailinator.com', '+1 (303) 479-', 0, 0, 'Bundesarchiv_Bild_183-H01757,_Erich_von_Manstein.jpg', 0, ''),
(33, 65, 'Quia consequuntur ne', 0, 'Actif', '2011-11-11 00:00:00', 'Id voluptas sit culp', 'Anim corporis quam e', 0, 'Corporis ut consecte', 'Et iste quis fuga M', 'Ut ad qui qui omnis ', 'Esse rerum amet de', 'Célibataire ', '2011-11-11', 'In rerum qui debitis', 'Quae sapiente ipsa ', 'lujapyp@mailinator.net', '+1 (873) 911-', 0, 0, '', 0, ''),
(34, 73, 'Corrupti quisquam r', 0, 'Actif', '2011-11-11 00:00:00', 'Ipsum eligendi nostr', 'Adipisci commodi ull', 0, 'Pariatur Qui pariat', 'Nobis culpa non occ', 'Dicta qui fugiat di', 'Iure enim dolorem of', 'Célibataire ', '2011-11-11', 'Quas doloremque eum ', 'Velit sit ex quae a', 'fucytud@mailinator.net', '+1 (838) 146-', 0, 0, '', 0, ''),
(35, 74, 'Minim et tempor moll', 0, 'Actif', '2011-11-11 00:00:00', 'salihi', 'yassine', 0, 'Sed voluptas deserun', 'Voluptas ullam sunt ', 'Sequi porro tempor r', 'Porro at autem ipsa', 'Veuf', '2011-11-11', 'Reiciendis consectet', 'Aliquip aliquip ulla', 'xafidy@mailinator.net', '+1 (355) 449-', 0, 0, '', 0, 'femelle'),
(37, 78, 'Esse magni nulla mai', 66, 'Actif', '0000-00-00 00:00:00', 'Nulla enim est nulla', 'Dolor magna recusand', 58, '', '', '', '', 'Divorcé', '0000-00-00', 'Doloribus nulla nihi', 'Quibusdam ducimus n', 'jocu@mailinator.com', '+1 (194) 249-', 0, 0, '', 0, 'femelle'),
(38, 79, 'Officia et eos qui ', 69, 'Actif', '2011-11-11 00:00:00', 'Et rerum minus ut se', 'Velit quia dolores i', 78, 'Sunt corrupti magna', 'Ut voluptatum volupt', 'Dolor quasi ut sit q', 'Voluptatem fuga Fac', 'Célibataire ', '2016-11-11', 'Rerum ad alias disti', 'Quas quibusdam sequi', 'xisyqije@mailinator.net', '+1 (288) 879-', 0, 0, '', 0, 'femelle'),
(39, 87, 'Fugiat perferendis ', 12, 'Actif', '2011-11-11 00:00:00', 'Et est ut dolorem en', 'Consequatur enim ips', 97, 'Ut enim error quos e', 'Atque sit voluptas ', 'Proident sit quis ', 'Sapiente quaerat dol', 'Veuf', '2011-11-11', 'Sed minima quod id u', 'Vero aperiam adipisi', 'cysiba@mailinator.net', '+1 (136) 879-', 0, 0, '', 0, 'femelle'),
(40, 88, 'Odio sed quasi aut p', 56, 'Actif', '2011-11-11 00:00:00', 'Et sunt voluptatem ', 'Magni rerum natus Na', 15, 'Veritatis illum qui', 'Eligendi voluptates ', 'Sint magni ut nulla ', 'Est est voluptatem ', 'Célibataire ', '2011-11-11', 'Obcaecati in adipisi', 'Consequatur Enim bl', 'pyzeliqy@mailinator.net', '+1 (231) 767-', 0, 0, '', 0, 'femelle'),
(41, 89, 'Distinctio Minus do', 48, 'Actif', '2011-11-11 00:00:00', 'Dolores adipisicing ', 'Pariatur Vel praese', 28, 'Iure eos in quas est', 'Quae qui dolor offic', 'Voluptates et eiusmo', 'Dolores amet repell', 'Divorcé', '2011-11-11', 'Officiis eligendi la', 'Similique ut amet a', 'zuguwibyje@mailinator.net', '+1 (615) 653-', 0, 0, '', 0, 'femelle'),
(42, 90, 'Cillum voluptates ex', 94, 'Actif', '2011-11-11 00:00:00', 'Nisi quas deserunt a', 'Nostrud ex sit eius ', 1, 'Temporibus aut nihil', 'Eos quidem quae volu', 'Excepteur distinctio', 'Omnis nostrud exerci', 'Divorcé', '2011-11-11', 'Veniam necessitatib', 'Ipsam ullamco corrup', 'hesopohyga@mailinator.net', '+1 (216) 422-', 0, 0, '', 0, 'femelle'),
(43, 101, 'toto tiiti', 20000, 'Actif', '2012-04-30 00:00:00', 'mehdi', 'hasseni', 33, 'ing', 'electrique', 'ensa', 'no', 'Célibataire', '2034-03-24', 'casa', 'w4242424242', 'yassinesalihi4@gmail.com', '0607497140', 0, 0, 'Jellyfish.jpg', 0, 'male'),
(44, 102, 'test', 20000, 'Actif', '2033-02-13 00:00:00', 'salihi', 'yassine', 33, 'ing', 'info', 'ensa', 'no', 'marié', '2023-03-31', 'rabat', '0', 'yassinesalihi4@gmail.com', '0607497140', 0, 0, 'Lighthouse.jpg', 2, 'male');

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
  `date_Recrut` datetime NOT NULL,
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

--
-- Déchargement des données de la table `profpermanents_activites`
--

INSERT INTO `profpermanents_activites` (`id`, `profpermanent_id`, `activite_id`, `poste_comite`) VALUES
(1, 29, 2, 'Chef'),
(2, 33, 3, 'president'),
(3, 35, 4, 'president'),
(4, 29, 4, 'Chef');

-- --------------------------------------------------------

--
-- Structure de la table `profpermanents_departements`
--

CREATE TABLE `profpermanents_departements` (
  `id` int(10) NOT NULL,
  `profpermanent_id` int(10) NOT NULL,
  `departement_id` int(10) NOT NULL,
  `Poste_Filiere` varchar(30) NOT NULL,
  `Date_Debut` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `profpermanents_departements`
--

INSERT INTO `profpermanents_departements` (`id`, `profpermanent_id`, `departement_id`, `Poste_Filiere`, `Date_Debut`) VALUES
(1, 29, 1, 'cheff', '2011-11-11'),
(3, 35, 4, 'cheff', '2010-10-10'),
(4, 41, 4, 'Minus nulla enim vit', '0000-00-00'),
(5, 42, 4, 'Consequatur Sequi d', '2011-11-11'),
(6, 33, 4, '', '2011-11-11'),
(7, 34, 4, '', '2011-11-11'),
(8, 35, 4, '', '2011-11-11'),
(9, 43, 4, 'chef', '2032-04-04'),
(10, 44, 4, 'etudiant', '2013-12-31'),
(11, 44, 2, 'chef', '2043-03-31');

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
  `etatdemande` varchar(30) NOT NULL DEFAULT 'Demande envoyé'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `profpermanents_documents`
--

INSERT INTO `profpermanents_documents` (`id`, `profpermanent_id`, `document_id`, `dateDemande`, `etatdemande`) VALUES
(8, 29, 1, '2019-02-02 16:40:47', 'Delivré'),
(9, 29, 2, '2019-02-02 16:40:58', 'Delivré'),
(10, 29, 2, '2019-02-02 16:46:17', 'Delivré'),
(12, 28, 2, '2019-02-07 19:19:21', 'Delivré'),
(13, 44, 2, '2019-02-12 10:38:39', 'Delivré');

-- --------------------------------------------------------

--
-- Structure de la table `profpermanents_grades`
--

CREATE TABLE `profpermanents_grades` (
  `profpermanent_id` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `date_grade` date NOT NULL,
  `cadre` varchar(4) NOT NULL,
  `echelon` int(11) NOT NULL,
  `sous_grade` varchar(20) NOT NULL,
  `date_exep` date NOT NULL,
  `date_normal` date NOT NULL,
  `date_rapide` date NOT NULL,
  `date_next_echelon` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `profpermanents_grades`
--

INSERT INTO `profpermanents_grades` (`profpermanent_id`, `id`, `grade_id`, `date_grade`, `cadre`, `echelon`, `sous_grade`, `date_exep`, `date_normal`, `date_rapide`, `date_next_echelon`) VALUES
(22, 4, 26, '2011-11-11', 'H', 3, 'C', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(23, 5, 28, '2011-11-11', 'PES', 4, 'C', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(24, 6, 42, '2012-12-12', 'A', 4, 'D', '2018-12-12', '2020-12-12', '2019-12-12', '2014-12-12'),
(25, 7, 20, '2018-10-10', 'H', 4, 'B', '2024-10-10', '2026-10-10', '2025-10-10', '2020-10-10'),
(26, 8, 14, '2012-12-12', 'PES', 2, 'A', '2018-12-12', '2020-12-12', '2019-12-12', '2014-12-12'),
(27, 9, 21, '2011-11-11', 'PES', 2, 'B', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(28, 10, 2, '2020-02-02', 'A', 2, 'A', '2026-02-02', '2028-02-02', '2027-02-02', '2022-02-02'),
(29, 11, 17, '2019-02-02', 'PES', 4, 'A', '2025-02-02', '2027-02-02', '2026-02-02', '2021-02-02'),
(30, 12, 20, '0000-00-00', 'H', 4, 'B', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(31, 13, 9, '2020-02-02', 'A', 2, 'B', '2026-02-02', '2028-02-02', '2027-02-02', '2022-02-02'),
(32, 14, 15, '2019-09-09', 'PES', 3, 'A', '2025-09-09', '2027-09-09', '2026-09-09', '2021-09-09'),
(33, 15, 12, '2011-11-11', 'PES', 1, 'A', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(34, 16, 38, '2011-11-11', 'A', 4, 'C', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(35, 17, 42, '2033-12-31', 'A', 4, 'D', '2039-12-31', '2041-12-31', '2040-12-31', '2035-12-31'),
(37, 19, 24, '0000-00-00', 'H', 2, 'C', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(39, 20, 22, '0000-00-00', 'H', 1, 'C', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(40, 21, 10, '2011-11-11', 'H', 4, 'A', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(41, 22, 13, '2011-11-11', 'H', 1, 'B', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(42, 23, 32, '2011-11-11', 'PES', 4, 'C', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(43, 24, 12, '2033-12-31', 'PES', 1, 'A', '2039-12-31', '2041-12-31', '2040-12-31', '2035-12-31'),
(44, 25, 28, '2054-05-31', 'H', 4, 'C', '2060-05-31', '2062-05-31', '2061-05-31', '2056-05-31');

-- --------------------------------------------------------

--
-- Structure de la table `profperm_absences`
--

CREATE TABLE `profperm_absences` (
  `id` int(11) NOT NULL,
  `profpermanent_id` int(11) NOT NULL,
  `duree_ab` float NOT NULL,
  `cause` varchar(255) NOT NULL,
  `date_ab` date NOT NULL,
  `time_ab` time NOT NULL,
  `isvalid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `profperm_absences`
--

INSERT INTO `profperm_absences` (`id`, `profpermanent_id`, `duree_ab`, `cause`, `date_ab`, `time_ab`, `isvalid`) VALUES
(1, 29, 1, 'ksjnfweij', '2019-02-28', '12:00:00', 1),
(2, 44, 1, 'ghi bghit', '0000-00-00', '22:31:00', 1);

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

--
-- Déchargement des données de la table `semestres`
--

INSERT INTO `semestres` (`id`, `libile`, `niveaus_id`) VALUES
(1, 's1', 1),
(2, 'S2', 2);

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(10) NOT NULL,
  `nom_service` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `nom_service`) VALUES
(1, 'informatic');

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
(2, 'Administrateur', '$2y$10$adq5VBfhM/VelDXJF08WseJdCgJjxXDuwIVVPSSNqk2FAPYOj7FdC', 'admin', NULL, NULL),
(3, 'test', '$2y$10$adq5VBfhM/VelDXJF08WseJdCgJjxXDuwIVVPSSNqk2FAPYOj7FdC', 'respopersonel', NULL, NULL),
(4, 'testprof', '$2y$10$gjtlFcfyT8MwuX5bCW/DEOS4wkJIenQsdrVGxeW4VqwC0iYILtHqW', 'profpermanent', '2019-01-03 21:39:41', '2019-01-03 21:39:41'),
(5, 'zenadifo', '$2y$10$0zAStBqiTgPKnU7JM80gU.Ut8EkgtnXbvJ8XiMKG3aasfmGbVJFXG', 'profpermanent', '2019-01-03 22:38:45', '2019-01-03 22:38:45'),
(6, 'resposcolarite', '$2y$10$AiBOMmzIyFmv9ea3EepDT.8IWtRSVhLY1cBUOIU28.Kiu.c5m7TcS', 'resposcolarite', NULL, NULL),
(7, 'respopersonel', '$2y$10$YaJyTou.VdJ1fZS7yKMlcuGSjBQlk4AQPAYHvAeK/h4wmvd0x3pw2', 'respopersonel', NULL, NULL),
(8, 'respobiblio', '$2y$10$/.STzSL/3KApo28YyTYpBuFg3yy0Rdt2P4./9agz5yla7uy8cZSvS', 'respobiblio', NULL, NULL),
(9, 'respobureauordre', '$2y$10$U7bKjn0rNPUX09YCUahD5.gEcRLRTsr9J6J1FwHJq6eLuNLIOkTwe', 'respobureauordre', NULL, NULL),
(10, 'respofinance', '$2y$10$X4E1bqcLix7J768Cjdc1y.vFkjQQznWBm9SYEdyzA7lrG3q4yootS', 'respofinance', NULL, NULL),
(11, 'respostock', '$2y$10$QUVJgk81uO8HDLARU.LaiuhzZj7HdGRfyzjHMNVr3rUrSYx.mFCwO', 'respostock', NULL, NULL),
(12, 'etudiant', '$2y$10$a0xANP7DJCrH0VnqRpqNTuJnvdSOFLDrYiDa/IiK/x12PhieHKbVS', 'etudiant', NULL, NULL),
(13, 'jyfih', '$2y$10$3dgKTlllC3d8FOtyYWN2qur3PifJy08.O6vaMs8ByeRT6k.Zz7916', 'profpermanent', '2019-01-24 23:07:06', '2019-01-24 23:07:06'),
(14, 'qirafu', '$2y$10$yNBcidayklW0bu/xOzDxMO1ecOjRvLoabZTs8kyN3hnkUaddxwAX6', 'profpermanent', '2019-01-24 23:10:52', '2019-01-24 23:10:52'),
(15, 'higymu', '$2y$10$QX2FNgCGTNqEZFa99vjBpeONe02Wc7CbGDClMYtjNmKBSWMA1DWaC', 'profpermanent', '2019-01-24 23:12:00', '2019-01-24 23:12:00'),
(16, 'lydit', '$2y$10$dVU46GwhdQ5P0RVU/aSAHexZUBC.ebyUETj.51h23ejFO.O9Dcx1.', 'profpermanent', '2019-01-24 23:18:28', '2019-01-24 23:18:28'),
(17, 'xepyvis', '$2y$10$2v0Ijg88MNdmn8YCx86YjOhFjfHNkrl9je9blMZ5EV7DrdGR4NmZK', 'profpermanent', '2019-01-24 23:19:53', '2019-01-24 23:19:53'),
(18, 'qilonaqyxi', '$2y$10$3ZgTpQom8jguIoK.7.RHw.HArH6xgOvsV43RTr9v/faZClPffdVcW', 'profpermanent', '2019-01-24 23:29:52', '2019-01-24 23:29:52'),
(19, 'relyrozy', '$2y$10$fz3tUEFomDLc6sCdpyfbv.UNKNc3WcP6qsvKNm6j4LNaA7i95MgXO', 'profpermanent', '2019-01-24 23:31:30', '2019-01-24 23:31:30'),
(20, 'fosepysyde', '$2y$10$M/hv4WGtYhlVh5pF0VIZs.WOCdJZgp/YK2q/HDceZaCtPCguBtQw6', 'profpermanent', '2019-01-24 23:49:54', '2019-01-24 23:49:54'),
(21, 'fypubelupi', '$2y$10$.RoFCc4kecZx9TEIpMoalOlMyMyMaN14Hk841Hf76/g5Nzxu0WG62', 'profpermanent', '2019-01-24 23:52:54', '2019-01-24 23:52:54'),
(22, 'pycehumujy', '$2y$10$BT4EKxbGL/fGCaqKWaxMUOkXQqhqAHg/qLsN6uEWkkRCK4ieAnK5i', 'profpermanent', '2019-01-25 12:21:35', '2019-01-25 12:21:35'),
(23, 'gyfoxez', '$2y$10$k51cyYGMLT.ASDkwlgoQuO8QRSRJ0DlmPjnaKJBG0MKPNLgc1JBES', 'profpermanent', '2019-01-25 12:24:02', '2019-01-25 12:24:02'),
(24, 'boselahe', '$2y$10$HBfR/RzG7sajHXksIzfdJuvefTsXJSyo.JtlZsJbzHiGPmQxh7BlG', 'profpermanent', '2019-01-25 12:35:10', '2019-01-25 12:35:10'),
(25, 'kyfemasy', '$2y$10$RZgCjjinnLipVCaNOM/oJOc7zlay8T1Rw7TModg/a5itmHS7MjI0i', 'profpermanent', '2019-01-25 12:45:17', '2019-01-25 12:45:17'),
(26, 'zidolub', '$2y$10$pHXG6dzoAVBdyg0zrkDL0ebiiQMiIeJx45w9Tny7ETREY5GdQjg6K', 'profpermanent', '2019-01-25 12:57:46', '2019-01-25 12:57:46'),
(27, 'cyfijahiz', '$2y$10$ongfnEGBtTBSlS9viogq1uXgM1gw5Si1shJR0TniiJk8uKR97VlSe', 'profpermanent', '2019-01-25 13:14:27', '2019-01-25 13:14:27'),
(28, 'jezeqy', '$2y$10$NTwK1LkRVoIAkmTiZ0Ftqu5X4iaHbnwJTq.lbyqnziJowsa7dW2rO', 'profpermanent', '2019-01-25 14:14:58', '2019-01-25 14:14:58'),
(29, 'gofyt', '$2y$10$aLnPHp0EK5piXLQBwqvD0OokB1c0IH/8BU2AByYzgnv4pEjMxH7iy', 'profpermanent', '2019-01-25 15:33:21', '2019-01-25 15:33:21'),
(30, 'qufaz', '$2y$10$T53TqPNf6DjRf.XB5qT9PuGyepjghVOwdVrxvQqWaw1f9/WhWC9BK', 'fonctionnaire', '2019-01-26 12:22:11', '2019-01-26 12:22:11'),
(31, 'zopen', '$2y$10$tbiGN9Djiwuz7gARnNalzedGg4kY3gOyGugV/DF7/uMDmHfWKdjzG', 'fonctionnaire', '2019-01-26 12:26:51', '2019-01-26 12:26:51'),
(32, 'vomolyvel', '$2y$10$rL53Q58lHVij84QieBcoleBFk14QgwRQkTBI2tHFr0dNzsvUIJ8sm', 'fonctionnaire', '2019-01-26 13:11:13', '2019-01-26 13:11:13'),
(33, 'qaxydehof', '$2y$10$.BlRwOwvxqGhwY2Ow1UOzOdg2BGYDzJPrDNnKx0sBiP2GU27Hkmy.', 'fonctionnaire', '2019-01-29 18:01:30', '2019-01-29 18:01:30'),
(34, 'risyvin', '$2y$10$NiDrzY0kvZqT0XOWSWWDwuUVuPpC7vB2Hgldqtchl0SXIWLrqEsIy', 'fonctionnaire', '2019-01-29 18:04:02', '2019-01-29 18:04:02'),
(43, 'kypydivyd', '$2y$10$twJgKoTajKaDC//a6gkf3e1IoOmQT5KRBXm1Q5CV8r8s/lYBuhDBm', 'profvacataire', '2019-01-30 13:17:44', '2019-01-30 13:17:44'),
(44, 'pelem', '$2y$10$KmZZrvcPI/Ckk3eVNeKpVegzUSMnHZ3BxSpJ8gnDBzUyrAn9LICp.', 'profpermanent', '2019-01-31 12:15:47', '2019-01-31 12:15:47'),
(45, 'qibumatoj', '$2y$10$ydABUc5Ae2yMjDRD2eRGYuIKkP0HDU.h4mpcxDbl7jgLrIt7PXuKm', 'profvacataire', '2019-01-31 12:18:26', '2019-01-31 12:18:26'),
(46, 'sopaw', '$2y$10$hCtu5AJRGfhh/FXZoaKQleTvF2zKWxRcozwczJOb.AF5SplzrB0GC', 'profvacataire', '2019-01-31 12:22:46', '2019-01-31 12:22:46'),
(47, 'xicatul', '$2y$10$T9JrviA3rnB6XR0OQ8hoXOR6T8nlHY3lWpqEcKhcW3M5ZMYijaJ4.', 'profvacataire', '2019-01-31 12:37:45', '2019-01-31 12:37:45'),
(48, 'locawoqihu', '$2y$10$5OZfu38jzBTUTPVUpkLqX.XguYSjzUPjLiWDN6oW09LFA6/q3ciEa', 'profvacataire', '2019-01-31 12:40:27', '2019-01-31 12:40:27'),
(49, 'sufovir', '$2y$10$yi6Hok1R2evQZx0aSzfsR.0j7KYQzjRxTnlCpFSiMV8miLONEgTMm', 'profvacataire', '2019-01-31 12:42:20', '2019-01-31 12:42:20'),
(50, 'qajeho', '$2y$10$Qrp16uMvueEilx1e/h5DOOt/bevCZTJtRD6aKS7Op.HsGyx/AcQWa', 'profvacataire', '2019-01-31 12:46:07', '2019-01-31 12:46:07'),
(51, 'bywihub', '$2y$10$Jc37LU0fw80zDa2MVI6SJOgCZV6oG4XWplwz9K3VYIpjwvY25LFeS', 'profpermanent', '2019-01-31 16:27:35', '2019-01-31 16:27:35'),
(52, 'lydatog', '$2y$10$qzZvykNrd.Xa1sYkx/9Q/eBvgcDaxmjZgxZl0SGECzmjc.AJ9pJ6a', 'profvacataire', '2019-01-31 16:44:46', '2019-01-31 16:44:46'),
(53, 'profperm', '$2y$10$HweDCctn0M7UB47mwH9EQeV5L5gT7OHaSWYEWU9Ae5oH8mTjoSdpy', 'profpermanent', '2019-02-01 20:27:43', '2019-02-01 20:27:43'),
(54, 'profvac', '$2y$10$XH/zCl.OZKHuqMujKFUuh.lKgrffRvrv.Rk8RlINCg2j2SE.HNisS', 'profvacataire', '2019-02-01 20:29:55', '2019-02-01 20:29:55'),
(55, 'vac', '$2y$10$5iiEErYNIV1ULEgwQylph.Da00ARPtHBdK2j1tsyz1/NXShYqCvf.', 'profvacataire', '2019-02-01 20:51:35', '2019-02-01 20:51:35'),
(56, 'proofperm', '$2y$10$PiZXIRKc.wUlcI4.rc0wuuVeil3M7CNdwG492/IC4zy/BqL7HIyQu', 'profpermanent', '2019-02-02 16:23:00', '2019-02-02 16:23:00'),
(57, 'fonct', '$2y$10$n0xqjKX0ypXX6poq6Vd4VusT4g19Ivr3D84xptxEffUeXQFyA6tFK', 'fonctionnaire', '2019-02-02 17:49:35', '2019-02-02 17:49:35'),
(58, 'proofvac', '$2y$10$ZhXul955utQQD4M0gJKC9.UGdGU0hfhsUnRj1lGajBfOaZc1kYPWu', 'profvacataire', '2019-02-02 18:55:08', '2019-02-02 18:55:08'),
(59, 'vaac', '$2y$10$3NMdWXAMGyCUrhb7aaUXkOdKe2Hn4NnYo31g40z6qX4DiDlEAPWM6', 'profvacataire', '2019-02-02 18:58:21', '2019-02-02 18:58:21'),
(60, 'tolupiduqy', '$2y$10$Y5h8j3ycVF6.htRFeaQkJeIXxan4bHIvYyKXmaLs1nPf/vjIIVDye', 'profvacataire', '2019-02-02 19:01:00', '2019-02-02 19:01:00'),
(61, 'vameqa', '$2y$10$IOWux986PIZElE3BDNTSxOr0AwAIX52glY47TBmp47zM7iA5pt44C', 'profvacataire', '2019-02-02 19:10:01', '2019-02-02 19:10:01'),
(62, 'tanekux', '$2y$10$um.WHGH6cQpiPJsKOrpAIuFUd6vc0NHbkwnNJEbUzY/ngMIKhyhfq', 'profpermanent', '2019-02-02 19:16:33', '2019-02-02 19:16:33'),
(63, 'perm', '$2y$10$eyMDH13Q.eoVb3fR3BGpiuLLWAzSrDx07cRPug3C8NCpkspoSJQoe', 'profpermanent', '2019-02-02 19:20:25', '2019-02-02 19:20:25'),
(64, 'lonegynit', '$2y$10$NRY4qLIMu9bg3sVlswMLGurTXhjUdy3d1..eBrVqbuubjJQVeNFiW', 'profpermanent', '2019-02-02 19:25:13', '2019-02-02 19:25:13'),
(65, 'kutyp', '$2y$10$mVp.GrrJ6g7psU03qs3DWO0sArMb/kah7dhfTUuUJycCG5lF2c5XG', 'profpermanent', '2019-02-02 22:20:48', '2019-02-02 22:20:48'),
(66, 'kagazejyk', '$2y$10$AoGLsvcdt2t0MIv7/8U1RO4LZmtM8r/o7KZ4zV9Loma8f0K1hbTDS', 'profvacataire', '2019-02-02 22:43:29', '2019-02-02 22:43:29'),
(67, 'xosobypo', '$2y$10$5x1arp3zLHONEU6DAEyO3OCbSm1CkIuyNgPpQ6B8/zhRlM8j1b6ba', 'profvacataire', '2019-02-02 22:47:13', '2019-02-02 22:47:13'),
(68, 'mupovun', '$2y$10$3HvkB7jNy5WZo03zLSnSSetg/8TjjqmkF6WGM74DlIULQszFlNf4i', 'respopersonel', '2019-02-02 23:56:44', '2019-02-02 23:56:44'),
(69, 'qeher', '$2y$10$seQlT0qKOV74P3E3zQcLzOfUaMkpIKoj18DLO9t1h5.cgRmN2cc2u', 'respobiblio', '2019-02-03 00:05:23', '2019-02-03 00:05:23'),
(70, 'zusyseqiz', '$2y$10$g4TBufx49pj.JAB2BDkzw.Iof2c0w9xuCTdHCzkaJ1xrrClM3a0hC', 'respofinance', '2019-02-03 00:34:24', '2019-02-03 00:34:24'),
(71, 'balimyv', '$2y$10$4e7/J/VC8ARztHQ5uHmqH.jd5qr/OKZF575LkDseM8esvOkgyz0yC', 'fonctionnaire', '2019-02-03 01:18:10', '2019-02-03 01:18:10'),
(72, 'fonctionnaire', '$2y$10$sNyLXt3grCp.2EEVhCjpUOmxYqJqPtMcEEyatOlRxYk/PyOc9JCMW', 'fonctionnaire', '2019-02-03 01:25:24', '2019-02-03 01:25:24'),
(73, 'wosekonygu', '$2y$10$OlvSmds61nQvs64w5nJXXuul3KOwiad18VEUwZfbO5Et6xv2iBzy6', 'profpermanent', '2019-02-03 14:20:07', '2019-02-03 14:20:07'),
(74, 'sumyt', '$2y$10$E2oO3NBaIekZWdOavrD3yu6PwcBc5e.Hc/0CN7qZKbWetZAWosHPq', 'profpermanent', '2019-02-03 14:24:56', '2019-02-03 14:24:56'),
(75, 'wicyjyd', '$2y$10$7Hxio.0cX5tvqtW7TPeS7ujQn4xsch3ij7HtZFK6ItJ0x623MxPWm', 'ingenieur', '2019-02-03 14:27:16', '2019-02-03 14:27:16'),
(76, 'subafyzujo', '$2y$10$dfB2xx3z1nnd9d4LT80.4.mwqSzSGxoc/L61WXo7L5kWMyvRwvNyG', 'profpermanent', '2019-02-07 18:38:39', '2019-02-07 18:38:39'),
(77, '', NULL, 'profpermanent', '2019-02-09 23:15:07', '2019-02-09 23:15:07'),
(78, 'tuwuly', '$2y$10$TPu2GMNKws0i24VAaYsz5OGw6iIaSGrRrv18HUmGNNBPI4tho2i4K', 'profpermanent', '2019-02-10 11:44:04', '2019-02-10 11:44:04'),
(79, 'cifujivi', '$2y$10$670WXzErfJnbablfrXjaJO/69ZIa9m6EDbT6gPwhaT06pd52PeTK6', 'profpermanent', '2019-02-10 16:09:24', '2019-02-10 16:09:24'),
(80, 'vunydyqa', '$2y$10$Ryap7NewRRSi3A02Nk5jEOyN.890QXvtykr/K3GqGp73SxpjN6BUm', 'profvacataire', '2019-02-10 16:19:56', '2019-02-10 16:19:56'),
(81, 'begus', '$2y$10$C0daQSDqXLbX8XwuTSQvhuYFjHNxziQjkZonUltwY50pd0odNCcr2', 'profvacataire', '2019-02-10 16:27:11', '2019-02-10 16:27:11'),
(82, 'wiwehunes', '$2y$10$EqvKX4koIr0.kZ75T01oeeqH5wMYPdwSxqceLjiluUmWYfe/GuRf2', 'profvacataire', '2019-02-10 16:28:32', '2019-02-10 16:28:32'),
(83, 'jesacyxyka', '$2y$10$g9gaJkddyHbYilaI/URxcum6FSiVrsX/0Lvfw6OL0vZB4d9UBYtLS', 'profvacataire', '2019-02-10 16:29:46', '2019-02-10 16:29:46'),
(84, 'sololeno', '$2y$10$oUNCrPd7WWIz0jjpbNN6cOdLxWdBvfC6Vjve6sOiPrFS8qQjSM2.e', 'profvacataire', '2019-02-10 16:34:19', '2019-02-10 16:34:19'),
(85, 'hevujo', '$2y$10$UJ8RMTBJ21OP/a8zj3lysuB51nLf1.wqQMkGjcncIiXBM8K/rrd1O', 'profvacataire', '2019-02-10 16:37:02', '2019-02-10 16:37:02'),
(86, 'nixyxox', '$2y$10$bHXcBaUQKQb7nw3GL7VkheXSc9x1AuzyPREWgM/8lpW43p0YLP.6O', 'profvacataire', '2019-02-10 16:38:01', '2019-02-10 16:38:01'),
(87, 'vicyma', '$2y$10$9A2qz/DgLQTXEPWNurPRpeHe6lKYxUt.GqCy7iehyeDhnAzmXn4ou', 'profpermanent', '2019-02-10 16:42:07', '2019-02-10 16:42:07'),
(88, 'botagy', '$2y$10$GicKolJHtE1CCVWRV0syBu3RgqWfjoNIzm8tusecxEqYLETbNl4lu', 'profpermanent', '2019-02-10 16:43:20', '2019-02-10 16:43:20'),
(89, 'piwygup', '$2y$10$tGrywxlyaKLc7l4rnW0oUeP97kfSaxZmxDs3oIXn5OsFrxOqcWDcm', 'profpermanent', '2019-02-10 16:48:32', '2019-02-10 16:48:32'),
(90, 'rupepy', '$2y$10$R5zgCLNfDGDyBMNlIEwOt.LKf2o.i1/.5BKyjgO9Awgf4amXhBM1a', 'profpermanent', '2019-02-10 16:50:01', '2019-02-10 16:50:01'),
(91, 'komiwikise', '$2y$10$pkQIU6yNdyVF1io3OZYloO1MNtHOlaZPyjIyfRFchrdpx.Ra.Jr2K', 'profvacataire', '2019-02-10 17:01:20', '2019-02-10 17:01:20'),
(92, 'ricyziny', '$2y$10$uCnmayhDbalYWPq7umRQZOT6Gs5MZn2CfTX6he69ZP9R7Qg3eBdT.', 'profvacataire', '2019-02-10 17:02:01', '2019-02-10 17:02:01'),
(93, 'nobata', '$2y$10$Q7XAkKfoONoed5CkUWgfReb2Z6Sevto9f6gZ.Xlf0/mh1YgbzMAFS', 'profvacataire', '2019-02-10 17:04:36', '2019-02-10 17:04:36'),
(94, 'jojem', '$2y$10$XpaIkfUaiohdUY04fSzaFOCfx.IXHtAmuMwM8liidlqLrYCJw6g4S', 'profvacataire', '2019-02-10 17:07:55', '2019-02-10 17:07:55'),
(95, 'bobideb', '$2y$10$iPQyiimRvbkBHA2MMGbzM.1Uj9O7I1smNMQ8d2PQ//IU4qMQY1VEi', 'profvacataire', '2019-02-10 17:09:44', '2019-02-10 17:09:44'),
(96, 'favalete', '$2y$10$LgfrLyaZvZ2JGhq6Mz6Z9e6jU3xZ6Nr1KAoSTIqrK87K5Df2Bn9vu', 'profvacataire', '2019-02-10 17:10:49', '2019-02-10 17:10:49'),
(97, 'rutipitu', '$2y$10$QCGPo6B9kO.xAuI3TBo/xeQh0HxcY1m3AaI3Q3K4.kdqyK71.oBl2', 'profvacataire', '2019-02-10 17:13:48', '2019-02-10 17:13:48'),
(98, 'lykasa', '$2y$10$.gvkmD7XkNUy5fZovLuUHu5fgUQGIJeCo0cjHJ4V9Rn95U1F4/5qu', 'profvacataire', '2019-02-10 17:15:03', '2019-02-10 17:15:03'),
(99, 'naqahac', '$2y$10$MZGyhsH.0q.sg9NXu3EIdOitl8XDpTCsEnFruLXPgOGtn4SYuoE82', 'respofinance', '2019-02-10 17:19:54', '2019-02-10 17:19:54'),
(100, 'vumetijito', '$2y$10$TCn8yB2C7Rqc7Q8.tydMjObJJ48WcIBMx33BdxKWlLmDt1OMQAtzy', 'ingenieur', '2019-02-10 17:21:30', '2019-02-10 17:21:30'),
(101, 'profperm1', '$2y$10$AGWbDIOROC2rvU223C5c0Owk/XsfrdR4KTTHwD.rLPTGvDYLyEpou', 'profpermanent', '2019-02-12 10:31:49', '2019-02-12 10:31:49'),
(102, 'mehdi2', '$2y$10$FCWK0FiMYPUZ.pouA.ThuecuFfh2Uo7l6Y.xFVrp94Yy5d0LET5Yy', 'profpermanent', '2019-02-12 10:36:44', '2019-02-12 10:36:44'),
(103, 'vacyassine', '$2y$10$9sUlkpoBojIAkWzfoK93kuT/Qo3JiOqlEj9lZZ2zQuPRL0C7pYp6G', 'profvacataire', '2019-02-12 10:51:35', '2019-02-12 10:51:35'),
(104, 'fonctyassine', '$2y$10$Wg7KgvKifPf85fJAMehLj.L8DCN9.wgT4/2viiQ1rc9jzNsAbTe7i', 'ingenieur', '2019-02-12 11:11:57', '2019-02-12 11:11:57'),
(105, 'testfonct', '$2y$10$3x0HDWddKlg1/VjwKNVh2.ETS6aa9fNWtS/jQBLcX6IXVxqdYTfKW', 'fonctionnaire', '2019-02-12 11:19:20', '2019-02-12 11:19:20'),
(106, 'fonct1', '$2y$10$howZgcBSBhWqltI21q5zEOBdIdcPsOprWUc/S/WG.WujpAh4Yza2K', 'fonctionnaire', '2019-02-12 11:31:46', '2019-02-12 11:31:46'),
(107, 'fonct12', '$2y$10$qdqkW6z9nEKP..CEUIi0.uV9BBkFl4uBaOQ6FNs86GWj9vAUB/N8C', 'fonctionnaire', '2019-02-12 11:39:16', '2019-02-12 11:39:16'),
(108, 'fonct13', '$2y$10$HQ/uPDDUHvWVKwqW8ZKD4ud3.Ez2dUThUmeYes9AEJ2MTARmZboYO', 'fonctionnaire', '2019-02-12 11:43:11', '2019-02-12 11:43:11'),
(109, 'test_ok', '$2y$10$ySMyzzoR/6GLGAjOw5O3Eu0WcOO76GDCqV5wlyVINieGypGaLzOva', 'fonctionnaire', '2019-02-12 12:26:29', '2019-02-12 12:26:29'),
(110, 'test_last', '$2y$10$MN4REyEVS8dy5VE4pzO5GO/egrwx3fF0Y.9JC8LnVqheztIaSrUrm', 'fonctionnaire', '2019-02-12 12:53:51', '2019-02-12 12:53:51');

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

--
-- Déchargement des données de la table `users_messages`
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
  `age` int(11) NOT NULL,
  `etat_attestation` int(11) NOT NULL DEFAULT '0',
  `etat_fiche` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vacataires`
--

INSERT INTO `vacataires` (`id`, `user_id`, `somme`, `nom_vacataire`, `prenom_vacataire`, `nb_heures`, `echelle`, `echelon`, `dateRecrut`, `dateNaissance`, `LieuNaissance`, `diplome`, `universite`, `specialite`, `CIN`, `situationFamiliale`, `codeSituation`, `dateAffectation`, `email`, `nbr_enfants`, `genre`, `age`, `etat_attestation`, `etat_fiche`) VALUES
(9, 43, 'Et minus qui invento', 'Laboriosam deserunt', 'Eligendi enim doloru', 0, 0, 4, '2022-02-22 00:00:00', '2022-02-22', 'Quo aspernatur recus', 'Sit et quisquam corp', 'Beatae laborum Ea e', 'Cumque reiciendis in', 'Quidem non nemo', 'Célibataire ', '1', '2022-02-22', 'cavyzydu@mailinator.', 0, 'F', 0, 0, 0),
(10, 45, 'Est eos consequuntu', 'Dolore adipisicing i', 'Ut deserunt possimus', 0, 0, 4, '2022-02-22 00:00:00', '2022-02-22', 'Est eiusmod perfere', 'Anim dolor qui magna', 'Non error animi imp', 'Saepe amet at et su', 'Asperiores quib', 'Divorcé', '1', '2022-02-22', 'jimocop@mailinator.c', 0, 'F', 0, 0, 0),
(11, 46, 'Ab aut ullamco ad ei', 'Ipsum sint mollitia', 'Voluptas natus harum', 0, 0, 2, '2011-11-11 00:00:00', '2011-11-11', 'Dolores veritatis eu', 'Vel eiusmod molestia', 'Anim irure dicta ess', 'Eligendi velit vel u', 'Sapiente veniam', 'Célibataire ', '1', '2011-11-11', 'jaba@mailinator.com', 0, 'F', 0, 0, 0),
(12, 47, 'Assumenda perspiciat', 'Laboriosam recusand', 'Nam elit et laudant', 0, 0, 2, '2011-11-11 00:00:00', '2011-11-11', 'Anim facere repellen', 'Nihil aliquip consec', 'Quod ea omnis odit f', 'Ad molestias atque a', 'Aliqua Exercita', 'Divorcé', '1', '2011-11-11', 'jakuvex@mailinator.n', 0, 'F', 0, 0, 0),
(13, 48, 'Totam reiciendis do ', 'Qui repellendus Bla', 'Velit aut aut qui o', 0, 0, 1, '2011-11-11 00:00:00', '2011-11-11', 'Magnam occaecat reru', 'Dolorum sed molestia', 'Amet magnam ducimus', 'Tempore qui numquam', 'Excepturi et te', 'Veuf', '1', '2011-11-11', 'dugaxy@mailinator.ne', 0, 'F', 0, 0, 0),
(14, 49, 'Alias voluptas ratio', 'Atque hic doloremque', 'In ullamco aut animi', 0, 0, 1, '2011-11-11 00:00:00', '2011-11-11', 'Sit beatae esse vol', 'Ut tempor earum mole', 'Sed amet aliquip un', 'Veniam id aut dele', 'Excepturi est s', 'Divorcé', '1', '2011-11-11', 'vukadawyre@mailinato', 0, 'F', 0, 0, 0),
(15, 50, 'Molestiae officiis q', 'Deserunt et soluta d', 'Error est vel omnis', 0, 0, 4, '2022-02-22 00:00:00', '2022-02-22', 'Amet exercitationem', 'Pariatur Expedita n', 'Sunt iusto fuga No', 'Reiciendis alias et ', 'Vel fugit magna', 'Célibataire ', '1', '2022-02-22', 'xipuvat@mailinator.c', 0, 'F', 0, 0, 0),
(16, 52, 'Duis blanditiis ut i', 'Quasi qui in omnis a', 'Ad vel odit rerum ir', 0, 0, 2, '2022-02-22 00:00:00', '2022-02-22', 'Nam placeat nobis l', 'Nulla sint at ullam', 'Dolor aut fugiat ill', 'Aliquam dolor ullamc', 'Dolor ducimus a', 'Veuf', '1', '2022-02-22', 'vezokubyw@mailinator', 0, 'F', 0, 0, 0),
(17, 54, 'Ut sed ullamco culpa', 'Eum illo elit volup', 'Proident illum ut ', 2, 0, 1, '0000-00-00 00:00:00', '0000-00-00', 'Ex nulla est laudan', 'Labore mollit commod', 'Veniam exercitation', 'Sed sint omnis reici', 'Sint enim sed a', 'Veuf', '1', '0000-00-00', 'zinil@mailinator.net', 0, 'F', 0, 4, 2),
(18, 55, 'Velit laudantium sa', 'Eveniet in enim quo', 'Doloremque ut qui a ', 0, 0, 3, '2020-03-03 00:00:00', '2020-02-02', 'Voluptatem Totam qu', 'Ipsam voluptatum dol', 'Architecto eius ea m', 'Quia nihil suscipit ', 'Natus officia e', 'Célibataire ', '1', '2020-02-02', 'myparuzoba@mailinato', 2, 'F', 0, 0, 0),
(19, 58, 'SOD3942', 'Laboris enim saepe s', 'Quo rerum eos ducim', 0, 0, 1, '2000-02-02 00:00:00', '2000-02-02', 'Minim perferendis ea', 'Est asperiores ea an', 'Quo adipisci hic ali', 'Ut consequatur in op', 'Voluptatem assu', 'Veuf', '1', '2002-02-02', 'jybudav@mailinator.n', 0, 'F', 0, 0, 0),
(20, 59, 'SD02428', 'ben', 'ahmed', 0, 0, 1, '2000-02-02 00:00:00', '1980-02-03', 'Iure minus irure id ', 'Praesentium mollit d', 'Reiciendis neque fug', 'Est porro eos est p', 'SD34972', 'Divorcé', '1', '2003-04-05', 'nivudajero@mailinato', 0, 'F', 0, 0, 0),
(21, 60, 'Voluptate ducimus t', 'Anim sit numquam vol', 'Deserunt quam culpa', 5, 0, 4, '0000-00-00 00:00:00', '0000-00-00', 'Quidem voluptatem n', 'Voluptas consequatur', 'Tenetur ipsum alias ', 'Enim sit doloribus i', 'Qui tempor Nam ', 'Veuf', '1', '0000-00-00', 'qemere@mailinator.co', 0, 'F', 20, 0, 0),
(22, 61, 'Sapiente nihil illum', 'Molestias itaque ven', 'Neque adipisci sint', 0, 0, 4, '0000-00-00 00:00:00', '0000-00-00', 'Provident ducimus ', 'Quo reiciendis simil', 'Ratione rerum esse ', 'In explicabo Soluta', 'Ut commodo aut ', 'Veuf', '1', '0000-00-00', 'kynutoked@mailinator', 0, 'femelle', 0, 0, 0),
(23, 66, 'Ut odit exercitation', 'Optio iure et liber', 'Incididunt illo sit', 0, 0, 3, '2011-11-11 00:00:00', '2011-11-11', 'Culpa eos rerum volu', 'Quia anim velit nisi', 'Eum voluptatem ea sa', 'Dignissimos distinct', 'Voluptatem Aut ', 'Divorcé', '1', '2011-11-11', 'gubikumas@mailinator', 0, 'femelle', 0, 0, 0),
(24, 67, '7578', 'Ut repellendus In a', 'Lorem corporis accus', 20, 0, 3, '2011-11-11 00:00:00', '2011-11-11', 'Porro laborum Simil', 'Reiciendis culpa err', 'Quia perspiciatis a', 'Dolores omnis earum ', '0', 'Veuf', '1', '2011-11-11', '0', 0, '0', 0, 1, 0),
(25, 80, 'Nostrum id ut debiti', 'Similique ullam labo', 'Ea est ut dolor quam', 79, 0, 3, '2011-11-11 00:00:00', '2011-11-11', 'Nesciunt consectetu', 'Qui rerum eu tenetur', 'Placeat quibusdam a', 'Corporis ipsam tenet', 'Fugit ea maxime', 'Divorcé', '1', '2011-11-11', 'mycuwagem@mailinator', 11, 'femelle', 97, 0, 0),
(26, 81, 'Qui consequat Conse', 'Amet architecto ips', 'Facilis id proident', 19, 0, 1, '2011-11-11 00:00:00', '2011-11-11', 'Repudiandae voluptat', 'Dolore et esse amet', 'Ut corrupti tenetur', 'Est dolor labore eu ', 'Voluptate minim', 'Veuf', '1', '2011-11-11', 'jywyl@mailinator.com', 25, 'femelle', 16, 0, 0),
(27, 82, 'Culpa recusandae Ni', 'Illo et qui asperior', 'Inventore in et aliq', 98, 0, 3, '2011-11-11 00:00:00', '2011-11-11', 'Non assumenda esse ', 'Sapiente quaerat sin', 'Cupidatat in ipsum ', 'Dolor quo Nam offici', 'Iusto labore la', 'Divorcé', '1', '2011-11-11', 'wexilanega@mailinato', 53, 'femelle', 41, 0, 0),
(28, 83, 'Optio ut sint atque', 'Est adipisicing at v', 'Laborum Quibusdam u', 76, 0, 1, '2011-11-11 00:00:00', '2011-11-11', 'Anim dolorum expedit', 'Aut pariatur Quis i', 'Optio laudantium s', 'Qui porro aut maxime', 'Sed amet velit ', 'Veuf', '1', '2011-11-11', 'kujuro@mailinator.co', 2, 'femelle', 31, 0, 0),
(29, 84, 'Est porro tempor in ', 'Ducimus sunt eum e', 'Fuga Occaecat fugia', 39, 0, 1, '2011-11-11 00:00:00', '2011-11-11', 'Facere repudiandae e', 'Qui amet aut incidu', 'Atque possimus dele', 'Beatae consequatur ', 'Voluptas elit t', 'Divorcé', '1', '2011-11-11', 'pijexi@mailinator.ne', 96, 'femelle', 4, 0, 0),
(30, 85, 'Commodo voluptatem o', 'Ducimus autem autem', 'Deserunt omnis asper', 15, 0, 2, '2011-11-11 00:00:00', '2011-11-11', 'Eiusmod nostrum ea e', 'Est omnis itaque qui', 'Provident labore as', 'Deleniti repudiandae', 'Reiciendis omni', 'Veuf', '1', '2011-11-11', 'napiqu@mailinator.co', 34, 'femelle', 59, 0, 0),
(31, 86, 'Quis deserunt beatae', 'Harum nostrum veniam', 'Quia et ratione saep', 35, 0, 1, '2011-11-11 00:00:00', '2011-11-11', 'Id doloremque possim', 'Adipisicing tenetur ', 'Duis hic sed eligend', 'Ea perspiciatis asp', 'At assumenda ul', 'Veuf', '1', '2011-11-11', 'wiwygedaxi@mailinato', 32, 'femelle', 81, 0, 0),
(32, 91, 'Fugiat repellendus', 'Vero iusto eaque del', 'Labore commodo volup', 96, 0, 4, '2011-11-11 00:00:00', '2011-11-11', 'Ipsa exercitation t', 'Velit dignissimos d', 'Eos in reiciendis e', 'Quis est et tempore', 'Quasi saepe et ', 'Célibataire ', '1', '2011-11-11', 'zeqolap@mailinator.n', 4, 'femelle', 21, 0, 0),
(33, 92, 'Debitis exercitation', 'Eos ullam ad aut non', 'Amet cupidatat eius', 38, 0, 1, '2011-11-11 00:00:00', '2011-11-11', 'Quos ut dolores volu', 'Quam enim blanditiis', 'Eu reiciendis minus ', 'Ex adipisci sint a ', 'Veniam quibusda', 'Divorcé', '1', '2011-11-11', 'maluxol@mailinator.n', 12, 'femelle', 63, 0, 0),
(34, 93, 'Sed eveniet quo ill', 'Lorem inventore sed ', 'Et provident labori', 8, 0, 2, '2011-11-11 00:00:00', '2011-11-11', 'Facilis deserunt ten', 'Consequatur Perspic', 'Nostrud nisi labore ', 'Rem at mollit nihil ', 'Ad ipsam offici', 'Divorcé', '1', '2011-11-11', 'qoqufexoxi@mailinato', 95, 'femelle', 32, 0, 0),
(35, 94, 'Soluta enim perspici', 'Dolor quia ex commod', 'Quasi sint molestias', 11, 0, 3, '2011-11-11 00:00:00', '2011-11-11', 'Sunt aperiam qui cum', 'Nemo debitis officia', 'Sed qui voluptatem q', 'Facere sunt iusto en', 'Enim fugit quas', 'Célibataire ', '1', '2011-11-11', 'jevylalot@mailinator', 5, 'femelle', 7, 0, 0),
(36, 95, 'Ea mollitia providen', 'Non in corporis dolo', 'Aut nihil rerum quae', 36, 0, 2, '2011-11-11 00:00:00', '2011-11-11', 'Velit est odio est ', 'Est qui optio nobis', 'Dolore ullamco volup', 'Ea est commodo quod', 'Necessitatibus ', 'Divorcé', '1', '2011-11-11', 'geqes@mailinator.net', 62, 'femelle', 46, 0, 0),
(37, 96, 'Molestiae nemo et of', 'In ea harum tenetur ', 'Et doloribus quis fu', 56, 0, 4, '2011-11-11 00:00:00', '2011-11-11', 'Fugiat beatae est ', 'Omnis exercitationem', 'Fugit perferendis c', 'In sit harum fugiat', 'Labore reprehen', 'Célibataire ', '1', '2011-11-11', 'nawatydu@mailinator.', 89, 'femelle', 52, 0, 0),
(38, 97, '20202020', 'Assumenda porro volu', 'Molestiae et tempor ', 15, 0, 3, '2011-11-11 00:00:00', '2011-11-11', 'Exercitationem ut si', 'Amet consequatur d', 'Ut rerum natus enim ', 'Deserunt eaque aliqu', 'male', '0', '1', '2011-11-11', 'kezocujo@mailinato.d', 17, 'male', 71, 0, 0),
(39, 98, 'Est quidem nesciunt', 'Dicta reiciendis eum', 'Anim rerum non eum i', 12, 0, 2, '2011-11-11 00:00:00', '2011-11-11', 'Ipsum ea ducimus m', 'Nisi anim non culpa', 'Maiores rem labore e', 'Dolore cupidatat neq', 'Reprehenderit m', 'Célibataire ', '1', '2011-11-11', 'curyv@mailinator.net', 91, 'femelle', 57, 0, 0),
(40, 103, 'toto tiiti', 'vacyasine', 'salihi', 22, 0, 1, '2034-03-05 00:00:00', '2032-04-30', 'rabat', 'ing', 'ensa', 'info', 'femelle', 'Célibataire', '1', '2033-04-30', 'yassinesalihi4@gmail', 12, 'femelle', 33, 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `vacatairesbis`
--

CREATE TABLE `vacatairesbis` (
  `id` int(11) NOT NULL,
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
  `isValid` int(11) NOT NULL DEFAULT '0',
  `email` varchar(20) NOT NULL,
  `nbr_enfants` int(11) NOT NULL,
  `genre` varchar(20) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vacatairesbis`
--

INSERT INTO `vacatairesbis` (`id`, `user_id`, `somme`, `nom_vacataire`, `prenom_vacataire`, `nb_heures`, `echelle`, `echelon`, `dateRecrut`, `dateNaissance`, `LieuNaissance`, `diplome`, `universite`, `specialite`, `CIN`, `situationFamiliale`, `codeSituation`, `dateAffectation`, `date_envoi`, `isValid`, `email`, `nbr_enfants`, `genre`, `age`) VALUES
(17, 103, 'toto tiiti', 'vacyasine', 'salihi', 22, 0, 1, '2034-03-05 00:00:00', '2032-04-30', 'rabat', 'ing', 'ensa', 'info', 'w4242424242', 'Célibataire', '1', '2033-04-30', '2019-02-12 11:00:18', 0, 'yassinesalihi4@gmail', 12, 'male', 33);

-- --------------------------------------------------------

--
-- Structure de la table `vacataires_absences`
--

CREATE TABLE `vacataires_absences` (
  `id` int(11) NOT NULL,
  `vacataire_id` int(11) NOT NULL,
  `duree_ab` float NOT NULL,
  `cause` varchar(255) NOT NULL,
  `date_ab` date NOT NULL,
  `time_ab` time NOT NULL,
  `isvalid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `vacataires_absences`
--

INSERT INTO `vacataires_absences` (`id`, `vacataire_id`, `duree_ab`, `cause`, `date_ab`, `time_ab`, `isvalid`) VALUES
(1, 9, 2, 'ejrfknnnerijf', '2019-02-28', '03:00:00', 1),
(2, 40, 0.5, 'ghi bghit', '0000-00-00', '22:44:00', 1),
(3, 40, 1.5, 'ghi bghit tani ', '0000-00-00', '22:44:00', 0);

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
  `departement_id` int(10) NOT NULL,
  `Date_Debut` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vacataires_departements`
--

INSERT INTO `vacataires_departements` (`id`, `vacataire_id`, `departement_id`, `Date_Debut`) VALUES
(6, 39, 4, '2011-11-11'),
(7, 40, 4, '2033-04-30'),
(8, 40, 2, '0000-00-00'),
(9, 40, 3, '0000-00-00');

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
  `document_id` int(10) NOT NULL,
  `dateDemande` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etatdemande` varchar(30) NOT NULL DEFAULT 'Demande envoyé'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vacataires_documents`
--

INSERT INTO `vacataires_documents` (`id`, `vacataire_id`, `document_id`, `dateDemande`, `etatdemande`) VALUES
(0, 40, 2, '2019-02-12 11:04:32', 'Delivré'),
(5, 17, 1, '2019-02-02 17:06:29', 'En cours de traitement'),
(6, 17, 1, '2019-02-02 18:09:40', 'Demande envoyé'),
(7, 17, 2, '2019-02-02 18:09:57', 'En cours de traitement'),
(8, 24, 1, '2019-02-07 20:10:36', 'Delivré');

-- --------------------------------------------------------

--
-- Structure de la table `vacataires_grades`
--

CREATE TABLE `vacataires_grades` (
  `id` int(10) NOT NULL,
  `datedebut` date NOT NULL,
  `datefin` date NOT NULL,
  `grade_id` int(10) NOT NULL,
  `vacataire_id` int(10) NOT NULL,
  `date_grade` date NOT NULL,
  `cadre` varchar(4) NOT NULL,
  `echelon` int(11) NOT NULL,
  `sous_grade` varchar(20) NOT NULL,
  `date_exep` date NOT NULL,
  `date_normal` date NOT NULL,
  `date_rapide` date NOT NULL,
  `date_next_echelon` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vacataires_grades`
--

INSERT INTO `vacataires_grades` (`id`, `datedebut`, `datefin`, `grade_id`, `vacataire_id`, `date_grade`, `cadre`, `echelon`, `sous_grade`, `date_exep`, `date_normal`, `date_rapide`, `date_next_echelon`) VALUES
(0, '2036-04-23', '2036-04-23', 19, 40, '2034-04-23', 'PES', 1, 'B', '2040-04-23', '2042-04-23', '2041-04-23', '2036-04-23'),
(5, '0000-00-00', '0000-00-00', 32, 6, '2022-02-22', 'H', 2, 'B', '2017-11-11', '2019-11-11', '2018-11-11', '2024-02-22'),
(7, '0000-00-00', '0000-00-00', 35, 8, '2022-02-22', 'A', 1, 'C', '2028-02-22', '2030-02-22', '2029-02-22', '2024-02-22'),
(8, '0000-00-00', '0000-00-00', 0, 9, '2012-12-12', 'PES', 2, 'B', '2028-02-22', '2030-02-22', '2029-02-22', '2014-12-12'),
(9, '2024-02-22', '2024-02-22', 0, 15, '2012-12-12', 'H', 4, 'B', '2028-02-22', '2030-02-22', '2029-02-22', '2014-12-12'),
(10, '2024-02-12', '2024-02-12', 6, 16, '2022-02-12', 'H', 2, 'A', '2028-02-12', '2030-02-12', '2029-02-12', '2024-02-12'),
(12, '2022-02-02', '2022-02-02', 11, 18, '2020-02-02', 'A', 3, 'B', '2026-02-02', '2028-02-02', '2027-02-02', '2022-02-02'),
(13, '2022-02-02', '2022-02-02', 4, 19, '2020-02-02', 'H', 1, 'A', '2026-02-02', '2028-02-02', '2027-02-02', '2022-02-02'),
(14, '2022-02-02', '2022-02-02', 14, 20, '2019-09-09', 'PES', 2, 'A', '2025-09-09', '2027-09-09', '2026-09-09', '2021-09-09'),
(17, '2013-11-11', '2013-11-11', 23, 23, '2011-11-11', 'PES', 3, 'B', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(18, '2013-11-11', '2013-11-11', 16, 24, '2014-12-11', 'H', 2, 'B', '2020-12-11', '2022-12-11', '2021-12-11', '2016-12-11'),
(19, '2013-11-11', '2013-11-11', 26, 25, '2011-11-11', 'H', 3, 'C', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(20, '2013-11-11', '2013-11-11', 13, 26, '2011-11-11', 'H', 1, 'B', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(21, '2013-11-11', '2013-11-11', 15, 27, '2011-11-11', 'PES', 3, 'A', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(22, '2013-11-11', '2013-11-11', 27, 28, '2011-11-11', 'PES', 1, 'C', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(23, '2013-11-11', '2013-11-11', 7, 29, '2011-11-11', 'A', 1, 'B', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(24, '2013-11-11', '2013-11-11', 2, 30, '2011-11-11', 'A', 2, 'A', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(25, '2013-11-11', '2013-11-11', 19, 31, '2011-11-11', 'PES', 1, 'B', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(26, '2013-11-11', '2013-11-11', 34, 32, '2011-11-11', 'A', 4, 'B', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(27, '2013-11-11', '2013-11-11', 4, 33, '2011-11-11', 'H', 1, 'A', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(28, '2013-11-11', '2013-11-11', 29, 34, '2011-11-11', 'PES', 2, 'C', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(29, '2013-11-11', '2013-11-11', 23, 35, '2011-11-11', 'PES', 3, 'B', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(30, '2013-11-11', '2013-11-11', 9, 36, '2011-11-11', 'A', 2, 'B', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(31, '2013-11-11', '2013-11-11', 17, 37, '2011-11-11', 'PES', 4, 'A', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(32, '2013-11-11', '2013-11-11', 8, 38, '2011-11-11', 'H', 3, 'A', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11'),
(33, '2013-11-11', '2013-11-11', 36, 39, '2011-11-11', 'A', 2, 'C', '2017-11-11', '2019-11-11', '2018-11-11', '2013-11-11');

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
  `etat` varchar(10) NOT NULL DEFAULT 'non validé',
  `vacataire_id` int(10) NOT NULL,
  `paimentvac_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vacations`
--

INSERT INTO `vacations` (`id`, `mois`, `annee`, `nbHeure`, `dateInsertion`, `etat`, `vacataire_id`, `paimentvac_id`) VALUES
(1, 2, 2019, 44, '2019-02-12 10:56:53', 'non validé', 40, NULL),
(2, 1, 2019, 22, '2019-02-12 10:57:17', 'non validé', 40, NULL);

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
-- Index pour la table `fonctionnairesbis`
--
ALTER TABLE `fonctionnairesbis`
  ADD PRIMARY KEY (`id`);

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
-- Index pour la table `infosgradesprofs`
--
ALTER TABLE `infosgradesprofs`
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
-- Index pour la table `profdepartements`
--
ALTER TABLE `profdepartements`
  ADD KEY `departement` (`departement`);

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
  ADD KEY `profpermanents_grades_ibfk_1` (`grade_id`);

--
-- Index pour la table `profperm_absences`
--
ALTER TABLE `profperm_absences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profpermanent_id` (`profpermanent_id`);

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
-- Index pour la table `vacatairesbis`
--
ALTER TABLE `vacatairesbis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vacataires_absences`
--
ALTER TABLE `vacataires_absences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vacataire_id` (`vacataire_id`);

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
  ADD KEY `const1` (`vacataire_id`),
  ADD KEY `const2` (`document_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `activites`
--
ALTER TABLE `activites`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `certificats_etudiants`
--
ALTER TABLE `certificats_etudiants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `elements`
--
ALTER TABLE `elements`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `enseigners`
--
ALTER TABLE `enseigners`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `etudiers`
--
ALTER TABLE `etudiers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `fonctionnairesbis`
--
ALTER TABLE `fonctionnairesbis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `fonctionnaires_activites`
--
ALTER TABLE `fonctionnaires_activites`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `fonctionnaires_documents`
--
ALTER TABLE `fonctionnaires_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `fonctionnaires_grades`
--
ALTER TABLE `fonctionnaires_grades`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `fonctionnaires_services`
--
ALTER TABLE `fonctionnaires_services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT pour la table `infosgradesprofs`
--
ALTER TABLE `infosgradesprofs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `magasins`
--
ALTER TABLE `magasins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `mouvements`
--
ALTER TABLE `mouvements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `niveaus`
--
ALTER TABLE `niveaus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `notes_auth`
--
ALTER TABLE `notes_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notifications_groupe`
--
ALTER TABLE `notifications_groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notifications_users`
--
ALTER TABLE `notifications_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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

--
-- AUTO_INCREMENT pour la table `prelevementsups`
--
ALTER TABLE `prelevementsups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `profpermanents`
--
ALTER TABLE `profpermanents`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `profpermanentsbis`
--
ALTER TABLE `profpermanentsbis`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `profpermanents_activites`
--
ALTER TABLE `profpermanents_activites`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `profpermanents_departements`
--
ALTER TABLE `profpermanents_departements`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `profpermanents_disciplines`
--
ALTER TABLE `profpermanents_disciplines`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `profpermanents_documents`
--
ALTER TABLE `profpermanents_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `profpermanents_grades`
--
ALTER TABLE `profpermanents_grades`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `profperm_absences`
--
ALTER TABLE `profperm_absences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `proposition`
--
ALTER TABLE `proposition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pvupdate`
--
ALTER TABLE `pvupdate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `semestres`
--
ALTER TABLE `semestres`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `sitedocuments`
--
ALTER TABLE `sitedocuments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stock_categories`
--
ALTER TABLE `stock_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sup_heures`
--
ALTER TABLE `sup_heures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT pour la table `users_books`
--
ALTER TABLE `users_books`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vacataires`
--
ALTER TABLE `vacataires`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `vacatairesbis`
--
ALTER TABLE `vacatairesbis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `vacataires_absences`
--
ALTER TABLE `vacataires_absences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `vacataires_activites`
--
ALTER TABLE `vacataires_activites`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vacataires_departements`
--
ALTER TABLE `vacataires_departements`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `vacations`
--
ALTER TABLE `vacations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
