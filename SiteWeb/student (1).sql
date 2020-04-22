-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 22 avr. 2020 à 10:28
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `student`
--

-- --------------------------------------------------------

--
-- Structure de la table `questionnaire`
--

CREATE TABLE `questionnaire` (
  `idQ` int(11) NOT NULL,
  `idStudent` int(11) NOT NULL,
  `niveau` enum('Seconde','Première','Terminale') NOT NULL,
  `options` enum('Arts','Biologie et écologie','Histoire-géographie géopolitique et sciences politiques','Humanités littérature et philosophie','Langues','Littérature Langues et cultures de l''Antiquité','Mathématiques','Numérique et sciences informatiques','Physique-chimie','Sciences de la vie et de la Terre','Sciences de l''ingénieur','Sciences économiques et sociales') NOT NULL,
  `matiereP` enum('FR','HG','EMC','LV','EPS','ES','PHI') NOT NULL,
  `matiereD` enum('FR','HG','EMC','LV','EPS','ES','PHI') NOT NULL,
  `pref1` enum('Dessiner ou peindre','Jouer aux échecs ou à un jeu de réflexion','Monter un meuble en kit') NOT NULL,
  `pref2` enum('Vous inscrire à un club ou une association','Gérer votre budget','Réparer un objet') NOT NULL,
  `voyage` varchar(4) NOT NULL,
  `objectifs` varchar(145) NOT NULL,
  `interet` varchar(45) NOT NULL,
  `travailler` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `idQ` int(11) NOT NULL,
  `niveau` varchar(150) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `options` varchar(150) NOT NULL,
  `matiereP` varchar(150) NOT NULL,
  `matiereD` varchar(150) NOT NULL,
  `pref1` varchar(150) NOT NULL,
  `pref2` varchar(150) NOT NULL,
  `voyage` varchar(20) NOT NULL,
  `interet` varchar(150) NOT NULL,
  `objectifs` text NOT NULL,
  `travailler` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`idQ`, `niveau`, `options`, `matiereP`, `matiereD`, `pref1`, `pref2`, `voyage`, `interet`, `objectifs`, `travailler`) VALUES
(1, 'PremiÃ¨re', 'Histoire-gÃ©ographie, gÃ©opolitique et sciences politiques', 'EMC', 'EMC', 'Monter un meuble en kit', 'RÃ©parer un objet', 'Non', 'ThÃ©Ã¢tre', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `student`
--

INSERT INTO `student` (`id`, `firstname`, `name`, `password`, `email`) VALUES
(1, 'Calvin', 'Pierre-Joseph', 'password', 'calvin.pj@sfr.fr'),
(5, 'Calvin', 'Pierre-Joseph', 'password', 'calvin.pierre-joseph@edu.devinci.fr');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD PRIMARY KEY (`idQ`,`idStudent`) USING BTREE;

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`idQ`);

--
-- Index pour la table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `idQ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD CONSTRAINT `questionnaire_ibfk_1` FOREIGN KEY (`idQ`) REFERENCES `student` (`id`);

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`idQ`) REFERENCES `student` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
