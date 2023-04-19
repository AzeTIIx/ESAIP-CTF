-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 19 avr. 2023 à 09:52
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ctf`
--

-- --------------------------------------------------------

--
-- Structure de la table `challenges`
--

DROP TABLE IF EXISTS `challenges`;
CREATE TABLE IF NOT EXISTS `challenges` (
  `id_challenge` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `category` varchar(30) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `decription` text,
  `flag` text,
  PRIMARY KEY (`id_challenge`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `challenges`
--

INSERT INTO `challenges` (`id_challenge`, `name`, `category`, `points`, `decription`, `flag`) VALUES
(2, 'Challenge2', 'crypto', 15, 'decription', 'flag2'),
(3, 'Crack ZIP', 'crypto', 50, 'decription', '6468e2276b9578ca91983374eb6bcea152170f958c6c4bf103680ea05453c422'),
(4, 'To be XOR or not to be ', 'crypto', 20, 'decription', 'fc7681215eefdc3b64ce777fbfe79418ca4eb4e1f23706cca80009b9f9da1d8c'),
(1, 'trop hache', 'crypto', 20, 'description', '516c73e42b40385d7a78ddcb79df195d74b847fd4f16648cb79e403536b2251f');

-- --------------------------------------------------------

--
-- Structure de la table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
CREATE TABLE IF NOT EXISTS `submissions` (
  `id_submission` int(11) NOT NULL AUTO_INCREMENT,
  `status` text NOT NULL,
  `timestamp` text,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `challenge_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_submission`),
  KEY `user_id` (`user_id`),
  KEY `challenge_id` (`challenge_id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `submissions`
--

INSERT INTO `submissions` (`id_submission`, `status`, `timestamp`, `user_id`, `challenge_id`) VALUES
(1, 'valid', '2023-01-20 12:55:46', 10008, 1),
(2, 'valid', '2023-01-18 12:55:46', 10008, 2),
(3, 'valid', '2023-01-11 12:55:46', 10008, 3),
(4, 'valid', '2023-01-18 12:55:46', 10010, 1),
(5, 'valid', '2023-01-17 12:55:46', 10010, 2),
(6, 'valid', '2023-01-19 12:55:46', 10010, 3),
(7, 'valid', '2023-01-20 12:55:46', 10010, 4),
(9, 'valid', '2023-02-09 21:59:55', 10011, 4),
(10, 'valid', '2023-02-09 22:01:20', 10011, 2),
(11, 'valid', '2023-02-10 13:53:12', 10012, 1),
(12, 'valid', '2023-02-10 13:53:27', 10012, 2),
(13, 'valid', '2023-02-10 13:53:37', 10012, 3),
(14, 'valid', '2023-01-20 12:55:46', 10012, 4),
(15, 'valid', '2023-01-20 12:55:46', 10012, 4),
(16, 'valid', '2023-01-20 12:55:46', 10015, 1),
(17, 'valid', '2023-01-24 12:55:46', 10015, 2),
(18, 'valid', '2023-01-26 12:55:46', 10015, 3),
(19, 'valid', '2023-01-28 12:55:46', 10015, 4),
(20, 'valid', '2023-01-20 12:55:46', 10016, 1),
(21, 'valid', '2023-01-29 12:55:46', 10016, 2),
(22, 'valid', '2023-01-30 12:55:46', 10016, 3),
(23, 'valid', '2023-01-20 12:55:46', 10015, 4),
(24, 'valid', '2023-01-22 12:55:46', 10017, 2),
(25, 'valid', '2023-01-27 12:55:46', 10017, 3),
(27, 'valid', '2023-01-25 12:55:46', 10018, 1),
(28, 'valid', '2023-01-26 12:55:46', 10018, 2),
(29, 'valid', '2023-01-24 12:55:46', 10019, 1),
(30, 'valid', '2023-01-25 12:55:46', 10019, 2),
(31, 'valid', '2023-01-26 12:55:46', 10019, 3),
(32, 'valid', '2023-01-29 12:55:46', 10019, 4),
(33, 'valid', '2023-01-26 12:55:46', 10020, 1),
(34, 'valid', '2023-01-20 12:55:46', 10020, 4),
(35, 'valid', '2023-01-20 12:55:46', 10021, 2),
(36, 'valid', '2023-01-21 12:55:46', 10021, 3),
(37, 'valid', '2023-01-23 12:55:46', 10021, 1),
(38, 'valid', '2023-01-25 12:55:46', 10021, 4),
(39, 'valid', '2023-01-24 12:55:46', 10022, 4),
(40, 'valid', '2023-01-25 12:55:46', 10022, 1),
(41, 'valid', '2023-01-28 12:55:46', 10022, 2),
(42, 'valid', '2023-01-29 12:55:46', 10022, 3),
(43, 'valid', '2023-01-25 12:55:46', 10023, 4),
(44, 'valid', '2023-01-26 12:55:46', 10023, 1),
(45, 'valid', '2023-01-27 12:55:46', 10023, 3),
(87, 'valid', '2023-04-16 15:12:07', 10027, 1),
(88, 'valid', '2023-04-16 15:34:04', 10026, 1),
(89, 'valid', '2023-04-19 11:40:12', 10026, 3);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `tableaupoints`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `tableaupoints`;
CREATE TABLE IF NOT EXISTS `tableaupoints` (
`temps` text
,`id` int(10) unsigned
,`points` decimal(32,0)
,`username` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` text,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=10028 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `email`, `username`, `password`, `type`) VALUES
(10014, 'mail@esaip.org', 'kiki', '888da5db853449fff82b07cbdbf7c755ece0783aa670bb36cc5c4cc9a68fb864', 'user'),
(10017, 'user3@example.com', 'user3', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'user'),
(10016, 'user2@example.com', 'user2', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'user'),
(10015, 'user1@example.com', 'user1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'user'),
(10013, 'mail@mail.com', 'allo', 'a2d4ff9c70b7b884e04e04c184a7bf8a07dca029a68efa4d0477cea0c6f8ac2b', 'administrateur'),
(10018, 'user4@example.com', 'user4', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'user'),
(10019, 'user5@example.com', 'user5', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'user'),
(10020, 'user6@example.com', 'user6', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'user'),
(10021, 'user7@example.com', 'user7', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'user'),
(10022, 'user8@example.com', 'user8', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'user'),
(10023, 'user9@example.com', 'user9', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'user'),
(10024, 'user10@example.com', 'user10', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'user'),
(10025, 'test@test.com', 'test', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'user'),
(10026, 'zozo@zozo.com', 'zozo', '1d993cb8cd68f0e0ee19693084f94da4750907e9f8f2a3c0c199304cbbd1cb13', 'user'),
(10027, 'zaza@zaza.com', 'zaza', '9a8b64bb1668aae447964e503998fe5e9686c4101556a33edd13d826aa0b69e3', 'user');

-- --------------------------------------------------------

--
-- Structure de la vue `tableaupoints`
--
DROP TABLE IF EXISTS `tableaupoints`;

DROP VIEW IF EXISTS `tableaupoints`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tableaupoints`  AS SELECT `s`.`timestamp` AS `temps`, `s`.`user_id` AS `id`, (select sum(`c`.`points`) from (`submissions` `s1` join `challenges` `c` on((`s1`.`challenge_id` = `c`.`id_challenge`))) where ((`s1`.`user_id` = `s`.`user_id`) and (`s1`.`timestamp` <= `s`.`timestamp`))) AS `points`, `users`.`username` AS `username` FROM ((`submissions` `s` join `challenges` `c` on((`s`.`challenge_id` = `c`.`id_challenge`))) join `users` on((`users`.`id_user` = `s`.`user_id`))) ORDER BY `s`.`timestamp` ASC, `s`.`user_id` ASC ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
