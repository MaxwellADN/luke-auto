-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 08 Avril 2014 à 08:51
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ppe`
--
CREATE DATABASE IF NOT EXISTS `ppe` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ppe`;

-- --------------------------------------------------------

--
-- Structure de la table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(50) NOT NULL,
  `duration` int(1) NOT NULL,
  `type` varchar(50) NOT NULL,
  `student` int(11) NOT NULL,
  `monitor` int(11) NOT NULL,
  `appreciation` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `courses`
--

INSERT INTO `courses` (`id`, `date`, `duration`, `type`, `student`, `monitor`, `appreciation`) VALUES
(1, 1397818800, 2, 'Auto', 1, 3, ''),
(2, 1388588400, 2, 'Auto', 1, 3, 'Éviter d''écraser les piétons à l''avenir !'),
(3, 1397034000, 1, 'Moto', 2, 3, ''),
(4, 1389265200, 1, 'Auto', 1, 3, '');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `access` varchar(20) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `birthday` int(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `postal` int(5) NOT NULL,
  `city` varchar(50) NOT NULL,
  `registration` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `session`, `password`, `access`, `lastname`, `firstname`, `birthday`, `mail`, `address`, `postal`, `city`, `registration`) VALUES
(1, '06046bae5b526d64c3a3129a457e1043', '5f4dcc3b5aa765d61d8327deb882cf99', 'Élève', 'FAUGERE', 'Olivier', 717897600, 'eleve@mail.fr', '25 rue de la petite fontaine', 92190, 'Meudon', 1390912561),
(2, '', '5f4dcc3b5aa765d61d8327deb882cf99', 'Élève', 'CHALUS', 'Thierry', 719193600, 'eleve2@mail.fr', '7 rue de la feuille', 92130, 'Issy-les-Moulineaux', 1390989833),
(3, '5017409ac31aa7cc8dc1f6a502d2ef3d', '5f4dcc3b5aa765d61d8327deb882cf99', 'Moniteur', 'BOURNIGAL', 'Marc', 543196800, 'moniteur@mail.fr', '230 avenue du coin', 92100, 'Boulogne-Billancourt', 1390925755),
(4, '5b12d2bfddbee88ea6802ac8a67085f5', '5f4dcc3b5aa765d61d8327deb882cf99', 'Secrétaire', 'BONNAUD', 'Laure', 569203200, 'secretaire@mail.fr', '15 rue de la roue', 92140, 'Clamart', 1390925839);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
