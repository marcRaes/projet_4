-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 08 Novembre 2017 à 11:26
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
  `titre` varchar(255) CHARACTER SET utf8 NOT NULL,
  `contenu` text CHARACTER SET utf8 NOT NULL,
  `dateHeureAjout` datetime NOT NULL,
  `dateHeureDerniereModification` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Contenu de la table `chapitres`
--

INSERT INTO `chapitres` (`id`, `titre`, `contenu`, `dateHeureAjout`, `dateHeureDerniereModification`) VALUES
(1, 'Premier chapitre', '<p>Premier <span style="color: #ff6600; background-color: #00ff00;"><strong>chapitre</strong></span> de test !</p>', '2017-11-06 07:39:04', '2017-11-06 07:46:11'),
(2, 'Second chapitre', '<p>Second chapitre de test !</p>', '2017-11-06 07:39:17', NULL),
(3, 'Troisième chapitre', '<p>Troisi&egrave;me chapitre de test !</p>', '2017-11-06 07:39:31', NULL),
(4, 'Quatrième chapitre', '<p>Quatri&egrave;me chapitre de test !</p>', '2017-11-06 07:39:45', NULL),
(5, 'Cinquième chapitre', '<p>Cinqui&egrave;me chapitre de test !</p>', '2017-11-06 07:40:03', '2017-11-06 08:09:00'),
(6, 'Sixième chapitre', '<p>Sixi&egrave;me chapitre de test !</p>', '2017-11-06 07:40:26', NULL),
(7, 'Septième chapitre', '<p>Septi&egrave;me chapitre pour test !</p>', '2017-11-06 13:17:41', NULL),
(8, 'huitième chapitre', '<p>huiti&egrave;me chapitre pour test !</p>', '2017-11-06 13:18:33', NULL),
(9, 'Neuvième chapitre', '<p>Neuvi&egrave;me chapitre pour <span style="color: #ff0000;">test</span> !</p>', '2017-11-06 13:20:25', '2017-11-07 16:23:53');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `commentaire` text CHARACTER SET utf8 NOT NULL,
  `dateHeureAjout` datetime NOT NULL,
  `idChapitre` int(11) NOT NULL,
  `idMembre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `dateHeureAjout`, `idChapitre`, `idMembre`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-06 08:27:21', 1, 2),
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-06 11:36:21', 2, 2),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-06 15:38:42', 3, 2),
(4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-06 18:25:32', 4, 2),
(5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-08 03:07:10', 5, 2),
(6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-07 05:35:29', 6, 2),
(7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-08 06:36:32', 7, 2),
(8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-08 10:23:35', 8, 2),
(9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-07 12:47:45', 9, 2),
(12, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-07 11:27:27', 9, 2);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
  `adresseMail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `motDePasse` varchar(255) CHARACTER SET utf8 NOT NULL,
  `statut` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `adresseMail`, `motDePasse`, `statut`) VALUES
(1, 'jean@forteroche.com', '$2y$10$3RsQ3R0KJde3fwVBXl1ufeeJi4GRY96sJWKxSUdHKzQroVsBKIwT2', 'administrateur'),
(2, 'marcus62300@gmail.com', '$2y$10$76ewzV.T84te0DGCMe2nXekvn/UofCR1ntF560v40rGLuc2p385lK', 'contributeur');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `chapitres`
--
ALTER TABLE `chapitres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `chapitres`
--
ALTER TABLE `chapitres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
