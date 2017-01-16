-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Dim 15 Janvier 2017 à 22:44
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `8gag`
--

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `IP` varchar(15) NOT NULL,
  `link` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `name`, `description`, `date`, `IP`, `link`) VALUES
(1, 'ababababa', 'ouioui', '2017-01-03', '127254789', 'upload/rar.jpg'),
(2, 'kjk', 'zezeez', '2017-01-13', '::1', 'upload/02_01_by_nabi3-dav7nwl.jpg'),
(3, 'dsd', 'sdfv', '2017-01-13', '::1', 'upload / panda.jpg'),
(4, 'kllklk', 'dfdfd', '2017-01-13', '::1', 'upload /Ubon-Ratchathani-o12.jpg'),
(5, 'klk', 'lklklk', '2017-01-13', '::1', 'upload /Ubon-Ratchathani-o12.jpg'),
(6, 'aqua', 'aquaboulevard', '2017-01-13', '::1', 'upload /à¸­à¸¸à¸šà¸¥.jpg');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
