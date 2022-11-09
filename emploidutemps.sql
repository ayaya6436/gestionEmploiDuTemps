-- phpMyAdmin SQL Dump
-- version 5.2.0-1.fc36
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 18 juin 2022 à 23:44
-- Version du serveur : 8.0.27
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `emploidutemps`
--

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `enseignant_cours`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `enseignant_cours` (
`classe` varchar(30)
,`contact` varchar(100)
,`heure` varchar(30)
,`id` int
,`jour` varchar(30)
,`matiere` varchar(30)
,`matricule` int
,`nom` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure de la table `tb_cours`
--

CREATE TABLE `tb_cours` (
  `id` int NOT NULL,
  `classe` varchar(30) NOT NULL,
  `matiere` varchar(30) NOT NULL,
  `jour` varchar(30) NOT NULL,
  `heure` varchar(30) NOT NULL,
  `matriculeEns` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tb_cours`
--

INSERT INTO `tb_cours` (`id`, `classe`, `matiere`, `jour`, `heure`, `matriculeEns`) VALUES
(17, '3', 'histoire', 'jeudi', '9-h-11h', 3),
(19, '2', 'ALGO', 'lundi', '9h-14h', 2),
(20, '4', 'bio', 'mardi', '5h-6h', 1),
(21, '1', 'dessin', 'lundi', '7h-14h', 1),
(22, '2', 'chimie', 'mardi', '4h-5h', 2),
(23, '3', 'math', 'mercredi', '8h-9h', 3),
(24, '4', 'histoire', 'jeudi', '5h-7h', 4),
(26, '2', 'BIO', 'MARDI', '11h', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tb_enseignant`
--

CREATE TABLE `tb_enseignant` (
  `matricule` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tb_enseignant`
--

INSERT INTO `tb_enseignant` (`matricule`, `nom`, `contact`) VALUES
(1, 'DIAKITE', '732812182'),
(2, 'SAMASSEKOU', '6236587128'),
(3, 'YATTARA', '34567890'),
(4, 'TRAORE', '6328768329');

-- --------------------------------------------------------

--
-- Structure de la vue `enseignant_cours`
--
DROP TABLE IF EXISTS `enseignant_cours`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `enseignant_cours`  AS SELECT `tb_enseignant`.`matricule` AS `matricule`, `tb_enseignant`.`nom` AS `nom`, `tb_enseignant`.`contact` AS `contact`, `tb_cours`.`id` AS `id`, `tb_cours`.`classe` AS `classe`, `tb_cours`.`matiere` AS `matiere`, `tb_cours`.`jour` AS `jour`, `tb_cours`.`heure` AS `heure` FROM (`tb_enseignant` join `tb_cours` on((`tb_enseignant`.`matricule` = `tb_cours`.`matriculeEns`)))  ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tb_cours`
--
ALTER TABLE `tb_cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matriculeEns` (`matriculeEns`);

--
-- Index pour la table `tb_enseignant`
--
ALTER TABLE `tb_enseignant`
  ADD PRIMARY KEY (`matricule`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tb_cours`
--
ALTER TABLE `tb_cours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `tb_enseignant`
--
ALTER TABLE `tb_enseignant`
  MODIFY `matricule` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tb_cours`
--
ALTER TABLE `tb_cours`
  ADD CONSTRAINT `tb_cours_ibfk_1` FOREIGN KEY (`matriculeEns`) REFERENCES `tb_enseignant` (`matricule`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
