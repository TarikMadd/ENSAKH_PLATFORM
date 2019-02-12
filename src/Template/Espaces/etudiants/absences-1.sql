-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Dim 12 Mars 2017 à 10:13
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

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
-- Contenu de la table `absences`
--

INSERT INTO `absences` (`id`, `fonctionnaire_id`, `duree_ab`, `cause`, `date_ab`, `time_ab`, `isvalid`) VALUES
(1, 1, 2, '', '2017-03-05', '00:00:00', 0),
(2, 2, 4, 'maladie', '2017-03-08', '00:00:00', 0),
(3, 1, 1, 'maladie', '2015-02-14', '12:00:00', 1),
(5, 1, 1, 'maladie', '2015-02-14', '12:00:00', 1),
(6, 1, 1, 'maladie', '2015-02-14', '12:00:00', 2),
(7, 3, 4, 'null', '2017-03-08', '06:00:00', 0),
(8, 1, 1, 'maladie', '2015-02-14', '12:00:00', 1),
(9, 1, 1, 'maladie', '2015-02-14', '12:00:00', 1),
(10, 1, 1, 'maladie', '2015-02-14', '06:00:00', 2),
(11, 5, 0.5, 'testtest', '1111-11-11', '11:12:00', 0),
(12, 2, 1.5, 'Mort', '1111-11-22', '12:15:00', 0),
(13, 2, 1.5, 'Mort', '1111-11-22', '12:15:00', 0),
(14, 2, 1.5, 'Mort', '1111-11-22', '12:15:00', 0),
(15, 2, 1.5, 'Mort', '1111-11-22', '12:15:00', 0),
(16, 2, 1.5, 'Mort', '1111-11-22', '12:15:00', 0),
(23, 6, 1, 'maladie', '2017-05-08', '13:00:00', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `absences`
--
ALTER TABLE `absences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fonctionnaire_id` (`fonctionnaire_id`),
  ADD KEY `absences_fonctionnaires_id_foreign` (`fonctionnaire_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `absences`
--
ALTER TABLE `absences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `absences`
--
ALTER TABLE `absences`
  ADD CONSTRAINT `absences_ibfk_1` FOREIGN KEY (`fonctionnaire_id`) REFERENCES `fonctionnaires` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
