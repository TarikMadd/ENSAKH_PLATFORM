-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 23 Février 2017 à 20:10
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Structure de la table `sous_categories`
--

CREATE TABLE `sous_categories` (
  `id` int(3) NOT NULL,
  `nom` varchar(15) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sous_categories`
--

INSERT INTO `sous_categories` (`id`, `nom`, `categorie_id`) VALUES
(101, 'Analyse/Algèbre', 100),
(102, 'Analyse Numériq', 100),
(103, 'Recherche opéra', 100),
(104, 'Probabilité', 100),
(105, 'Statistique', 100),
(201, 'Electricité', 200),
(202, 'Automatique', 200),
(203, 'Thermodynamique', 200),
(204, 'Optique', 200),
(205, 'Réseau', 200),
(206, 'Télécom', 200),
(301, 'UML', 300),
(302, 'SQL', 300),
(303, 'PHP', 300),
(304, 'JAVA', 300),
(305, 'Microsoft', 300),
(306, 'C/C++', 300),
(401, 'RH', 400),
(402, 'Gestion', 400),
(403, ' Marketing', 400),
(501, 'Atomistique', 500),
(502, 'Biologie', 500),
(503, 'Sécurité ', 500),
(601, 'Francais ', 600),
(602, 'Anglais', 600),
(603, 'Entretient', 600),
(604, 'Roman', 600);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD CONSTRAINT `sous_categories_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
