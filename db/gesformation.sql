-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 08 oct. 2021 à 23:43
-- Version du serveur :  10.4.16-MariaDB
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gesformation`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE `absence` (
  `id_absence` int(11) NOT NULL,
  `date_abs` date NOT NULL,
  `id_etudiant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `absence`
--

INSERT INTO `absence` (`id_absence`, `date_abs`, `id_etudiant`) VALUES
(1, '2021-10-08', 31),
(5, '2021-10-08', 34);

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `nom`, `prenom`, `email`, `password`) VALUES
(1, 'derrari', 'chaimaa', 'chaimaa@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etudiant` int(11) NOT NULL,
  `nom` varchar(220) NOT NULL,
  `prenom` varchar(220) NOT NULL,
  `adresse` varchar(220) NOT NULL,
  `tel` int(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`, `nom`, `prenom`, `adresse`, `tel`, `email`, `cin`) VALUES
(31, 'Derrarie', 'Chaimaa', '566 bd oued sebou oulfa casa', 691653760, 'chaimaa@gmail.com', 'BK680727'),
(32, 'aline', 'ben', 'bd abdelmoumen qu des hopitaux', 609876542, 'aline@gmail.com', 'WA78765'),
(34, 'Seck', 'Matar', 'Al amria', 632305829, 'matseckserigne95@gmail.com', 'WA78765'),
(35, 'Ndiaye', 'Abdou', 'Al amria', 6358741, 'Abdou@gmail.com', 'BK680727'),
(36, 'fall', 'Fatou', 'oulfa', 772154866, 'fall@gmail.com', 'X14547');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `numero_fact` int(11) NOT NULL,
  `date` date NOT NULL,
  `id_etudiant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`numero_fact`, `date`, `id_etudiant`) VALUES
(5, '2021-10-07', 32),
(6, '2021-10-07', 31);

-- --------------------------------------------------------

--
-- Structure de la table `inscris`
--

CREATE TABLE `inscris` (
  `id_inscris` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  `date_inscris` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `inscris`
--

INSERT INTO `inscris` (`id_inscris`, `id`, `id_etudiant`, `date_inscris`) VALUES
(18, 13, 31, '2021-09-25 16:51:53'),
(19, 14, 32, '2021-10-03 15:44:19'),
(21, 12, 34, '2021-10-07 23:14:14'),
(22, 15, 35, '2021-10-07 23:16:31'),
(23, 14, 36, '2021-10-07 23:17:57');

-- --------------------------------------------------------

--
-- Structure de la table `langues`
--

CREATE TABLE `langues` (
  `id` int(11) NOT NULL,
  `nom_lang` varchar(220) NOT NULL,
  `lang_prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `langues`
--

INSERT INTO `langues` (`id`, `nom_lang`, `lang_prix`) VALUES
(1, 'francais', 3000),
(12, 'Espagnol', 5000),
(13, 'Allemand', 3000),
(14, 'turc', 2000),
(15, 'WOLOF', 4000),
(16, 'chinois', 1000);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`id_absence`),
  ADD KEY `id_etudiant` (`id_etudiant`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etudiant`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`numero_fact`),
  ADD KEY `id_etudiant` (`id_etudiant`);

--
-- Index pour la table `inscris`
--
ALTER TABLE `inscris`
  ADD PRIMARY KEY (`id_inscris`),
  ADD KEY `id` (`id`),
  ADD KEY `id_etudiant` (`id_etudiant`);

--
-- Index pour la table `langues`
--
ALTER TABLE `langues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `absence`
--
ALTER TABLE `absence`
  MODIFY `id_absence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etudiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `numero_fact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `inscris`
--
ALTER TABLE `inscris`
  MODIFY `id_inscris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `langues`
--
ALTER TABLE `langues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `absence_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`) ON DELETE CASCADE;

--
-- Contraintes pour la table `inscris`
--
ALTER TABLE `inscris`
  ADD CONSTRAINT `inscris_ibfk_1` FOREIGN KEY (`id`) REFERENCES `langues` (`id`),
  ADD CONSTRAINT `inscris_ibfk_2` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
