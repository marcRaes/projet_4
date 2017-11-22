-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 22 Novembre 2017 à 20:10
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
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `dateTimeAdd` datetime NOT NULL,
  `idTicket` int(11) NOT NULL,
  `idMember` int(11) NOT NULL,
  `alert` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `content`, `dateTimeAdd`, `idTicket`, `idMember`, `alert`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-06 08:27:21', 1, 2, 0),
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-06 11:36:21', 2, 2, 0),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-06 15:38:42', 3, 2, 0),
(4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-06 18:25:32', 4, 2, 0),
(5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-08 03:07:10', 5, 2, 0),
(6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-07 05:35:29', 6, 2, 0),
(7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-08 06:36:32', 7, 2, 0),
(8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-08 10:23:35', 8, 2, 0),
(9, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.</p>', '2017-11-20 11:16:52', 9, 2, 0),
(10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.', '2017-11-07 11:27:27', 9, 2, 0),
(11, '<p>test</p>', '2017-11-18 13:37:16', 7, 2, 0),
(12, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus, arcu in congue finibus, orci tortor aliquam ex, a suscipit elit erat vitae nisi. Donec lacinia varius enim ut euismod. Cras ut lorem iaculis, molestie sapien id, ultrices sem. Donec eget orci convallis, eleifend nibh in, vulputate nisi. Proin lectus turpis, ultrices eu nunc non, lobortis porttitor arcu. Donec dolor ante, eleifend non risus eu, malesuada vehicula nulla. In eu nisl accumsan, consequat ex porta, efficitur nunc. Praesent a elementum mi, vulputate pellentesque purus. Nulla euismod tempor aliquam. Suspendisse nec finibus neque. Vestibulum augue quam, efficitur et aliquet sit amet, accumsan et justo. Quisque in nunc eget dui blandit lobortis. Sed molestie purus at tortor varius consectetur. Vestibulum ut arcu et urna eleifend blandit. Vestibulum sed lacus posuere lacus condimentum bibendum. Vivamus hendrerit felis a arcu pretium varius.</p>', '2017-11-20 12:09:48', 9, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `emailAdress` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `members`
--

INSERT INTO `members` (`id`, `emailAdress`, `password`, `status`) VALUES
(1, 'jean@forteroche.com', '$2y$10$3RsQ3R0KJde3fwVBXl1ufeeJi4GRY96sJWKxSUdHKzQroVsBKIwT2', 'administrateur'),
(2, 'marcus62300@gmail.com', '$2y$10$76ewzV.T84te0DGCMe2nXekvn/UofCR1ntF560v40rGLuc2p385lK', 'contributeur');

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `dateTimeAdd` datetime NOT NULL,
  `dateTimeLastModified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Contenu de la table `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `content`, `dateTimeAdd`, `dateTimeLastModified`) VALUES
(1, 'Premier chapitre', '<p>Premier <span style="color: #ff6600; background-color: #00ff00;"><strong>chapitre</strong></span> de test !</p>', '2017-11-06 07:39:04', '2017-11-06 07:46:11'),
(2, 'Second chapitre', '<p>Second chapitre de test !</p>', '2017-11-06 07:39:17', NULL),
(3, 'Troisième chapitre', '<p>Troisi&egrave;me chapitre de test !</p>', '2017-11-06 07:39:31', NULL),
(4, 'Quatrième chapitre', '<p>Quatri&egrave;me chapitre de test !</p>', '2017-11-06 07:39:45', NULL),
(5, 'Cinquième chapitre', '<p>Cinqui&egrave;me chapitre de test !</p>', '2017-11-06 07:40:03', '2017-11-06 08:09:00'),
(6, 'Sixième chapitre', '<p>Sixi&egrave;me chapitre de test !</p>', '2017-11-06 07:40:26', NULL),
(7, 'Septième chapitre', '<p>Septi&egrave;me chapitre de test !</p>', '2017-11-06 13:17:41', '2017-11-11 13:21:26'),
(8, 'huitième chapitre', '<p>Huiti&egrave;me chapitre de test !Huiti&egrave;me chapitre de test !Huiti&egrave;me chapitre de test !Huiti&egrave;me chapitre de test !Huiti&egrave;me chapitre de test !Huiti&egrave;me chapitre de test ! encore un test pour l\'affichage du chapitre, Huiti&egrave;me chapitre de test !Huiti&egrave;me chapitre de test !Huiti&egrave;me chapitre de test !Huiti&egrave;me chapitre de test !Huiti&egrave;me chapitre de test !Huiti&egrave;me chapitre de test ! encore un test pour l\'affichage du chapitre !</p>', '2017-11-06 13:18:33', '2017-11-13 19:56:11'),
(9, 'Neuvième chapitre', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi auctor odio sed lorem mattis varius. In mattis, elit sit amet tempus euismod, tellus velit lacinia risus, ut ultricies turpis odio ac quam. Integer pellentesque turpis nec libero hendrerit rutrum. Integer eleifend ornare eros, a malesuada metus eleifend a. Nulla facilisi. Nam eu gravida sem. Phasellus tempus tempus nisl, quis semper justo scelerisque a. In sit amet nisl et nisl maximus vulputate et quis odio. Nullam in elit viverra, interdum purus ullamcorper, sollicitudin lacus. Donec suscipit tellus sollicitudin justo convallis, ultrices consectetur lorem rutrum. Phasellus mollis venenatis nunc fringilla ullamcorper. Integer laoreet tortor eget consequat finibus. Nunc sagittis tortor vel felis vehicula sodales. Mauris aliquam ut metus vel dapibus.</p>\r\n<p>Fusce ut erat a nisl fringilla vestibulum. Nunc vel sapien non mi lacinia viverra. Etiam pretium dictum ligula, ac aliquet ipsum mollis sed. Nunc tincidunt nisl in egestas sodales. Curabitur cursus tincidunt dapibus. In eu urna felis. Pellentesque sit amet tellus ut ante faucibus laoreet. Praesent faucibus nibh ac elementum fringilla. Curabitur nec pretium nulla. Aenean faucibus luctus sapien, id cursus lectus iaculis eget. Etiam sed lacinia nulla. Etiam finibus ultrices justo non dictum. Pellentesque non vestibulum nulla, non scelerisque justo.</p>\r\n<p>Vivamus porta nisl ligula, et elementum dui tincidunt non. Suspendisse vitae diam non velit eleifend euismod elementum vitae lacus. Phasellus dictum accumsan dui egestas scelerisque. Donec posuere nisi accumsan elit ultrices, in vulputate erat gravida. Maecenas vel neque sagittis, sagittis sem et, blandit diam. Proin blandit interdum faucibus. Vivamus rutrum in tellus sed vestibulum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce fermentum accumsan pellentesque.</p>\r\n<p>Etiam nec risus varius, sodales urna non, gravida leo. Pellentesque sagittis sollicitudin tortor et fringilla. Ut commodo congue urna non blandit. Quisque ac elementum urna. Morbi accumsan lacus a urna laoreet, sed mattis leo scelerisque. Etiam quis dui nulla. Mauris non lacinia ante, vitae malesuada diam. Morbi venenatis neque a elit elementum rhoncus. Sed vitae purus ac lacus mattis volutpat. Sed ac nunc nec arcu mattis tempor ac sit amet lectus. Suspendisse at magna metus. Sed vehicula nibh non nibh laoreet tempor.</p>\r\n<p>Quisque pellentesque at tortor vel dictum. Nunc bibendum at elit tristique tempus. Morbi quis metus eget lacus tincidunt rutrum ut id libero. Curabitur mattis, felis non scelerisque elementum, augue ex sodales augue, a elementum mauris velit eu eros. Aenean ullamcorper venenatis ex. Aenean hendrerit mollis egestas. In sed euismod turpis, et condimentum risus. Sed malesuada congue turpis, eget fermentum quam sollicitudin quis. Duis bibendum sem vitae aliquet condimentum. Donec lobortis nulla id libero tincidunt molestie.</p>', '2017-11-06 13:20:25', '2017-11-21 20:08:44');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
