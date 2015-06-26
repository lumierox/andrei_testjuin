-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 26 Juin 2015 à 16:01
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `andrei_testjuin`
--
CREATE DATABASE IF NOT EXISTS `andrei_testjuin` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `andrei_testjuin`;

-- --------------------------------------------------------

--
-- Structure de la table `permit`
--

CREATE TABLE IF NOT EXISTS `permit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `perm` smallint(5) unsigned DEFAULT '2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `permit`
--

INSERT INTO `permit` (`id`, `name`, `perm`) VALUES
(1, 'Administrateur', 0),
(2, 'Modérateur', 1),
(3, 'Utilisateur', 2);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `extention` char(3) DEFAULT NULL,
  `weight` int(10) unsigned DEFAULT NULL,
  `width` int(10) unsigned DEFAULT NULL,
  `height` int(10) unsigned DEFAULT NULL,
  `title` varchar(60) DEFAULT NULL,
  `text` varchar(500) DEFAULT NULL,
  `show` smallint(5) unsigned DEFAULT '1',
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_photo_user1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Contenu de la table `photo`
--

INSERT INTO `photo` (`id`, `name`, `extention`, `weight`, `width`, `height`, `title`, `text`, `show`, `user_id`) VALUES
(15, '20150626095854kc785bnjg4q4aijko3jhlr3jh15c48ap1jrk', 'jpg', 51562, 900, 600, 'une photo', 'Une photo de carte graphique', 1, 1),
(16, '20150626103012nmoboon9j84ndahki2jjchepb62jj9mogho1', 'jpg', 13637, 275, 183, 'une photo', 'belle carte mere', 1, 3),
(18, '201506261145426lo6krfqq5kradpf7gjdbncol20og02n30ro', 'jpg', 14974, 350, 350, 'une photo', 'une photo', 1, 2),
(19, '20150626114554qep060eml1eb0araj4aj7932iimmaqfalh2e', 'jpg', 16739, 960, 352, 'une photo', 'une photo', 1, 2),
(20, '20150626114610plodinfo9l982d6gb72pobe91q63p2m4ep5o', 'jpg', 30856, 700, 700, 'une photo', 'une photo', 1, 2),
(21, '20150626114621gf9b5j5e30c499hg6456bp12q4h3594boibo', 'jpg', 80998, 300, 300, 'une photo', 'une photo', 1, 2),
(23, '20150626114639ird2k2fheh5bjjrdbrb60lelmca4rlj5am2l', 'jpg', 337799, 800, 600, 'une photo', 'une photo', 1, 2),
(24, '201506261146495b4p6g7cc7j7lbmk5f9dirgnc44lic94ifhg', 'jpg', 13637, 275, 183, 'une photo', 'une photo', 1, 2),
(25, '20150626115010p22arcb31abhrcf0gm1qg53h4e4qfp5poof8', 'jpg', 699378, 2560, 1600, 'une photo', 'une photo', 1, 2),
(26, '20150626115022966br8ddk21qlm51rki36hb9jqodm4aigrnr', 'jpg', 1617042, 1920, 1080, 'une photo', 'une photo', 1, 2),
(27, '201506261150291m6fb0a22i8hehlq4m76eec4pceb1607g7n0', 'jpg', 1310545, 1920, 1200, 'une photo', 'une photo', 1, 2),
(28, '20150626115036641jroa7cl9b1c2nod7r9i5ebgi877dl1nfd', 'jpg', 1292553, 1920, 1200, 'une photo', 'une photo', 1, 2),
(29, '201506261150465bnaeaqhj475dlj843dd4md8er4l1hapkbl3', 'jpg', 661362, 1920, 1200, 'une photo', 'une photo', 1, 2),
(30, '20150626115053apjfkn7bcfqlm79mk7n0dhr7q5d82dk4427i', 'jpg', 1277131, 2560, 1440, 'une photo', 'une photo', 1, 2),
(31, '20150626115106k13eh3m6ao7q56fhgbrn2kinmck4e05j4350', 'jpg', 439474, 2560, 1600, 'une photo', 'une photo', 1, 2),
(32, '2015062611513663o7nk2arqg96fj1qidgr6594h4da2cr6rjd', 'jpg', 681560, 1920, 1080, 'une photo', 'une photo', 1, 2),
(33, '20150626115232r6e349jomf8l9gdc1515pikan0idclqho169', 'jpg', 437994, 1680, 1050, 'une photo', 'une photo', 1, 2),
(34, '20150626115245b4ple7crnf6oje2dnbonap3hmog1273b1m3q', 'jpg', 1080551, 2560, 1440, 'une photo', 'une photo', 1, 2),
(35, '20150626115258kfdcbgj29ka8ip6a99lkeldf0adljdmcq3ol', 'jpg', 1124636, 2560, 1440, 'une photo', 'une photo', 1, 2),
(36, '20150626115308j3b9arjo0f7d37n0fngmi2bi9r5j5r5o82d8', 'jpg', 827669, 1920, 1080, 'une photo', 'une photo', 1, 2),
(37, '20150626115320e2jra39q864f665pp86l66djomnmmm1d8j6g', 'jpg', 342765, 1920, 1200, 'une photo', 'une photo', 1, 2),
(38, '20150626115506n6opoeqqc68o056m5igher02611h4rblkqa3', 'jpg', 851822, 1920, 1080, 'une photo', 'une photo', 1, 2),
(39, '2015062611551730p1a5m5lgaem4oj0f100gg0n1pn3ap34aim', 'jpg', 1855287, 2560, 1600, 'une photo', 'une photo', 1, 2),
(40, '20150626115656f9im6colcaonoofrj4qrfdrlood04eipdfrp', 'jpg', 1546488, 1920, 1080, 'une photo', 'une photo', 1, 2),
(41, '20150626115707j7pgm49crkf9ho2naaphhhaoj7m263gaf7pr', 'jpg', 372421, 1920, 1200, 'une photo', 'une photo', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `rubric`
--

CREATE TABLE IF NOT EXISTS `rubric` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) DEFAULT NULL,
  `url` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `rubric`
--

INSERT INTO `rubric` (`id`, `title`, `url`) VALUES
(1, 'Animaux', 'animaux'),
(2, 'Architectures', 'architectures'),
(3, 'Artistiques', 'artistiques'),
(4, 'Personnes', 'personnes'),
(5, 'Paysages', 'paysages'),
(6, 'Sports', 'sports'),
(7, 'Technologies', 'technologies'),
(8, 'Transports', 'transports'),
(9, 'Divers', 'divers');

-- --------------------------------------------------------

--
-- Structure de la table `rubric_has_photo`
--

CREATE TABLE IF NOT EXISTS `rubric_has_photo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `photo_id` int(10) unsigned NOT NULL,
  `rubric_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rubric_has_photo_photo_idx` (`photo_id`),
  KEY `fk_rubric_has_photo_rubric1_idx` (`rubric_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Contenu de la table `rubric_has_photo`
--

INSERT INTO `rubric_has_photo` (`id`, `photo_id`, `rubric_id`) VALUES
(26, 15, 1),
(27, 15, 2),
(28, 15, 9),
(29, 16, 9),
(31, 18, 1),
(32, 19, 1),
(33, 20, 1),
(34, 21, 1),
(36, 23, 1),
(37, 24, 1),
(38, 25, 1),
(39, 26, 1),
(40, 27, 1),
(41, 28, 1),
(42, 29, 1),
(43, 30, 1),
(44, 31, 1),
(45, 31, 9),
(46, 32, 1),
(47, 32, 3),
(48, 33, 1),
(49, 33, 9),
(50, 34, 1),
(51, 34, 9),
(52, 35, 1),
(53, 35, 9),
(54, 36, 1),
(55, 36, 9),
(56, 37, 1),
(57, 37, 9),
(58, 38, 1),
(59, 38, 9),
(60, 39, 1),
(61, 39, 9),
(62, 40, 1),
(63, 40, 9),
(64, 41, 1),
(65, 41, 9);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(100) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `valid` int(10) unsigned DEFAULT '1',
  `permit_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `fk_user_permit1_idx` (`permit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `email`, `name`, `valid`, `permit_id`) VALUES
(1, 'admin', 'admin', 'andrei.pastrama@gmail.com', 'Super Admin', 1, 1),
(2, 'modo', 'modo', 'modo@truc.be', 'MR le modo', 1, 2),
(3, 'util1', 'util1', 'util1@truc.be', 'utilisateur1', 1, 3),
(4, 'util2', 'util2', 'util2@truc.be', 'utilisateur 2', 1, 3);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `fk_photo_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `rubric_has_photo`
--
ALTER TABLE `rubric_has_photo`
  ADD CONSTRAINT `fk_rubric_has_photo_photo` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rubric_has_photo_rubric1` FOREIGN KEY (`rubric_id`) REFERENCES `rubric` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_permit1` FOREIGN KEY (`permit_id`) REFERENCES `permit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
