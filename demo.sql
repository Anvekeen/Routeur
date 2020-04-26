-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 22 avr. 2020 à 18:52
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `demo`
--

-- --------------------------------------------------------

--
-- Structure de la table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
                                     `pk` int(11) NOT NULL AUTO_INCREMENT,
                                     `action` varchar(255) NOT NULL,
                                     `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                                     PRIMARY KEY (`pk`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
                                          `pk` int(11) NOT NULL AUTO_INCREMENT,
                                          `name` varchar(255) NOT NULL,
                                          `price` float NOT NULL,
                                          `vat` int(11) NOT NULL,
                                          `price_vat` float NOT NULL,
                                          `price_total` float NOT NULL,
                                          `quantity` int(11) NOT NULL,
                                          PRIMARY KEY (`pk`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`pk`, `name`, `price`, `vat`, `price_vat`, `price_total`, `quantity`) VALUES
(1, 'Super Smash Bros Ultimate', 42, 21, 0, 42, 8),
(2, 'Tekken 4', 20, 6, 1.2, 21.2, 12),
(3, 'The Witcher 3', 100, 10, 10, 110, 2),
(4, 'World Of Warcraft', 50, 0, 0, 50, 21),
(5, 'Warcraft 3', 0, 0, 0, 0, 9),
(6, 'Farm Simulator', 0, 0, 0, 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
                                       `pk` int(11) NOT NULL AUTO_INCREMENT,
                                       `username` varchar(100) NOT NULL,
                                       `password` varchar(255) NOT NULL,
                                       `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                       `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                       PRIMARY KEY (`pk`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`pk`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'johndoe', '12345678', '2020-03-12 17:40:36', '2020-03-12 17:40:36'),
(2, 'admin', 'password123', '2020-03-11 20:30:47', '2020-03-11 20:30:47'),
(4, 'ramon', '123456', '2020-03-12 17:16:40', '2020-03-12 17:16:40');

--
-- Déclencheurs `users`
--
DROP TRIGGER IF EXISTS `log_crea_users`;
DELIMITER $$
CREATE TRIGGER `log_crea_users` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO log (action, ts) VALUES (new.username, NOW())
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trig_updateTS`;
DELIMITER $$
CREATE TRIGGER `trig_updateTS` BEFORE UPDATE ON `users` FOR EACH ROW SET NEW.updated_at = NOW()
$$
DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;