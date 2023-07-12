-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 02 déc. 2020 à 23:23
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `swim`
--

-- --------------------------------------------------------

--
-- Structure de la table `agend`
--

DROP TABLE IF EXISTS `agend`;
CREATE TABLE IF NOT EXISTS `agend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jour` varchar(20) NOT NULL,
  `time_strat` time NOT NULL,
  `time_end` time NOT NULL,
  `id_bloc` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `agend`
--

INSERT INTO `agend` (`id`, `jour`, `time_strat`, `time_end`, `id_bloc`, `id_user`) VALUES
(8, 'Monday', '20:00:00', '21:00:00', 1, 11),
(9, 'Tuesday', '01:00:00', '02:00:00', 1, 14),
(10, 'Monday', '15:00:00', '16:00:00', 1, 15);

-- --------------------------------------------------------

--
-- Structure de la table `bloc`
--

DROP TABLE IF EXISTS `bloc`;
CREATE TABLE IF NOT EXISTS `bloc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bloc`
--

INSERT INTO `bloc` (`id`, `label`) VALUES
(1, 'A'),
(2, 'B');

-- --------------------------------------------------------

--
-- Structure de la table `entrenement`
--

DROP TABLE IF EXISTS `entrenement`;
CREATE TABLE IF NOT EXISTS `entrenement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `date` date NOT NULL,
  `duree` varchar(5) NOT NULL,
  `id_coach` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `entrenement`
--

INSERT INTO `entrenement` (`id`, `name`, `description`, `date`, `duree`, `id_coach`) VALUES
(9, 'athlete', NULL, '2020-12-01', '00:50', 10),
(10, 'team3', NULL, '2020-11-23', '01:30', 10),
(12, 'team4', NULL, '2020-11-30', '01:30', 10);

-- --------------------------------------------------------

--
-- Structure de la table `entrenement_nagetype`
--

DROP TABLE IF EXISTS `entrenement_nagetype`;
CREATE TABLE IF NOT EXISTS `entrenement_nagetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_entrenement` int(11) NOT NULL,
  `id_nagetype` int(11) NOT NULL,
  `id_num` int(11) NOT NULL,
  `id_metre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `entrenement_nagetype`
--

INSERT INTO `entrenement_nagetype` (`id`, `id_entrenement`, `id_nagetype`, `id_num`, `id_metre`) VALUES
(1, 1, 5, 1, 3),
(2, 1, 4, 2, 2),
(3, 1, 2, 3, 4),
(4, 2, 5, 1, 1),
(5, 3, 5, 1, 1),
(6, 4, 2, 2, 3),
(7, 6, 3, 3, 3),
(8, 7, 5, 2, 3),
(9, 8, 4, 3, 3),
(10, 5, 2, 3, 4),
(11, 10, 3, 3, 2),
(12, 6, 2, 3, 2),
(13, 12, 2, 3, 3),
(14, 7, 2, 4, 2),
(15, 8, 5, 1, 1),
(25, 9, 2, 2, 2),
(17, 11, 5, 2, 2),
(18, 17, 2, 3, 3),
(19, 18, 4, 2, 2),
(20, 19, 3, 3, 4),
(21, 12, 2, 2, 3),
(22, 11, 5, 1, 2),
(23, 11, 2, 1, 2),
(24, 11, 5, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `metre`
--

DROP TABLE IF EXISTS `metre`;
CREATE TABLE IF NOT EXISTS `metre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `metre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `metre`
--

INSERT INTO `metre` (`id`, `metre`) VALUES
(1, 50),
(2, 100),
(3, 200),
(4, 400),
(5, 800);

-- --------------------------------------------------------

--
-- Structure de la table `nagetype`
--

DROP TABLE IF EXISTS `nagetype`;
CREATE TABLE IF NOT EXISTS `nagetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `nagetype`
--

INSERT INTO `nagetype` (`id`, `libelle`) VALUES
(5, 'Papillon'),
(2, 'Crawl'),
(3, '4nages'),
(4, 'Dos'),
(6, 'Bras');

-- --------------------------------------------------------

--
-- Structure de la table `nagetype_metre`
--

DROP TABLE IF EXISTS `nagetype_metre`;
CREATE TABLE IF NOT EXISTS `nagetype_metre` (
  `id_type` int(11) NOT NULL,
  `id_metre` int(11) NOT NULL,
  PRIMARY KEY (`id_type`,`id_metre`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `nagetype_metre`
--

INSERT INTO `nagetype_metre` (`id_type`, `id_metre`) VALUES
(4, 1),
(4, 2),
(4, 5),
(5, 1),
(5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `numero`
--

DROP TABLE IF EXISTS `numero`;
CREATE TABLE IF NOT EXISTS `numero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `numero`
--

INSERT INTO `numero` (`id`, `numero`) VALUES
(1, 2),
(2, 4),
(3, 8),
(4, 16);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `label`) VALUES
(1, 'ROLE_User'),
(2, 'ROLE_Coach'),
(3, 'ROLE_Admin');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_binth` date NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `role` varchar(100) NOT NULL,
  `id_coach` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `date_binth`, `first_name`, `last_name`, `gender`, `role`, `id_coach`, `deleted`) VALUES
(1, 'Admin', 'dhouibighabi.ahmed@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1991-05-27', 'islem', 'ben khaled', 'female', '3', NULL, 0),
(10, 'mycoech', 'Florence.Kyokushaba@sanofi.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-11-11', 'mycoach', '1', 'male', '2', 10, 0),
(11, 'nageur1', 'millesima.dev3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-11-03', 'nageur', '1', 'male', '1', 10, 0),
(12, 'coech1', 'what.ever@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1990-05-17', 'coach', 'pro', 'male', '2', NULL, 0),
(13, 'coech2', 'benkhaledmarwa@hotmail.fr', 'e10adc3949ba59abbe56e057f20f883e', '1989-07-12', 'coech2', 'coech2', 'female', '2', NULL, 0),
(14, 'nageur2', '54352395@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1995-05-02', 'nageur2', 'nageur2', 'male', '1', 10, 1),
(15, 'nageur3', 'achrefbenkhaled@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1995-09-25', 'nageur3', 'nageur3', 'male', '1', 10, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_entrenement`
--

DROP TABLE IF EXISTS `user_entrenement`;
CREATE TABLE IF NOT EXISTS `user_entrenement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lanes` varchar(11) NOT NULL,
  `duree` varchar(10) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_entrenement`
--

INSERT INTO `user_entrenement` (`id`, `lanes`, `duree`, `date`) VALUES
(12, 'A', '00:09:14', '2020-11-23 20:10:24'),
(11, 'A', '00:07:88', '2020-11-23 20:04:49'),
(9, 'A', '00:16:86', '2020-11-17 01:16:57'),
(10, 'A', '00:21:53', '2020-11-17 01:18:00'),
(13, 'A', '00:13:26', '2020-11-30 15:13:47'),
(14, 'A', '00:01:26', '2020-11-30 15:14:07'),
(15, 'A', '00:09:21', '2020-11-30 15:14:23'),
(16, 'A', '00:06:79', '2020-11-30 15:14:48');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
