-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 02 Novembre 2017 à 10:20
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_4`
--

-- --------------------------------------------------------

--
-- Structure de la table `chapitres`
--

CREATE TABLE `chapitres` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `contenu` text COLLATE latin1_general_ci NOT NULL,
  `dateHeureAjout` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Contenu de la table `chapitres`
--

INSERT INTO `chapitres` (`id`, `titre`, `contenu`, `dateHeureAjout`) VALUES
(10, 'premier chapitre', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>premier chapitre !</p>\r\n</body>\r\n</html>', '2017-11-01 10:52:10'),
(11, 'deuxième chapitre', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>deuxi&egrave;me chapitre !</p>\r\n</body>\r\n</html>', '2017-10-31 21:02:40'),
(12, 'troisième chapitre', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>troisi&egrave;me chapitre !</p>\r\n</body>\r\n</html>', '2017-10-31 21:02:34'),
(13, 'quatrième chapitre', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>quatri&egrave;me chapitre !</p>\r\n</body>\r\n</html>', '2017-10-31 21:02:28'),
(14, 'cinquième chapitre', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>cinqui&egrave;me chapitre !</p>\r\n</body>\r\n</html>', '2017-10-31 21:02:18'),
(15, 'sixième chapitre', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>sixi&egrave;me chapitre !</p>\r\n</body>\r\n</html>', '2017-10-31 21:02:11'),
(16, 'septième chapitre', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>septi&egrave;me chapitre !</p>\r\n</body>\r\n</html>', '2017-10-31 21:02:01'),
(17, 'huitième chapitre', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>huiti&egrave;me chapitre !</p>\r\n</body>\r\n</html>', '2017-10-31 21:01:54'),
(18, 'neuvième chapitre', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>neuvi&egrave;me chapitre !</p>\r\n</body>\r\n</html>', '2017-10-31 21:01:43'),
(19, 'dixième chapitre', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>dixi&egrave;me chapitre !</p>\r\n</body>\r\n</html>', '2017-10-31 21:01:37'),
(20, 'onzième chapitre', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>onzi&egrave;me chapitre !</p>\r\n</body>\r\n</html>', '2017-10-31 21:01:15');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `chapitres`
--
ALTER TABLE `chapitres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `chapitres`
--
ALTER TABLE `chapitres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
