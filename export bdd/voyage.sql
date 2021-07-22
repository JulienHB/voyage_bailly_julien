-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 22 juil. 2021 à 13:55
-- Version du serveur :  5.7.31
-- Version de PHP : 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `voyage`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `description`) VALUES
(1, 'Montagne', 'Bon air pur'),
(2, 'Mer', 'C\'est bleu'),
(3, 'Campagne', 'Ca change'),
(4, 'Etranger', 'Fait un test PCR !'),
(5, 'Capitales', 'Ca décoiffe');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210722081628', '2021-07-22 08:16:53', 47),
('DoctrineMigrations\\Version20210722082643', '2021-07-22 08:26:48', 401),
('DoctrineMigrations\\Version20210722115044', '2021-07-22 11:51:04', 48);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id`, `nom`) VALUES
(1, 'Aventure'),
(2, 'Famille'),
(3, 'Paysage'),
(4, 'Fête'),
(5, 'Visite'),
(6, 'Sport'),
(7, 'Randonnée');

-- --------------------------------------------------------

--
-- Structure de la table `tag_voyage`
--

DROP TABLE IF EXISTS `tag_voyage`;
CREATE TABLE IF NOT EXISTS `tag_voyage` (
  `tag_id` int(11) NOT NULL,
  `voyage_id` int(11) NOT NULL,
  PRIMARY KEY (`tag_id`,`voyage_id`),
  KEY `IDX_D6DCC079BAD26311` (`tag_id`),
  KEY `IDX_D6DCC07968C9E5AF` (`voyage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'root@root', '[\"ROLE_ADMIN\"]', '$2y$13$lQjFJvFfk0Wd9/yyFbFExOE7OLBu21M4ibppukWKmmPrxDzgONhgC');

-- --------------------------------------------------------

--
-- Structure de la table `voyage`
--

DROP TABLE IF EXISTS `voyage`;
CREATE TABLE IF NOT EXISTS `voyage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accroche` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `duree` int(11) NOT NULL,
  `image1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brochure` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_cat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3F9D8955C09A1CAE` (`id_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `voyage`
--

INSERT INTO `voyage` (`id`, `nom`, `accroche`, `description`, `prix`, `duree`, `image1`, `image2`, `image3`, `brochure`, `id_cat_id`) VALUES
(6, 'Les montagnes des Alpes', 'Vraiment dépaysant avec une odeur de Beaufort !', 'A ne surtout pas manquer, cette escapade est exceptionnelle', 1050, 6, '03-vans-Chamrousse-60f96e286ea6d.jpg', 'Boutique-PV-C-Peignee-Verticale-8860-600x400-60f96e286f606.jpg', 'Mountains-60f96e286fdf2.jpg', 'Eval-TD-Symfony-60f96e28704d7.pdf', 1),
(7, 'Les plus belles villes d\'Europe', 'Bar et teufs', 'Tout simplement Magique!!', 980, 4, 'ville-futur-19-6093059-60f96e66bb4a2.jpg', 'verdir-villes-meilleure-sante-60f96e66bb9d1.jpg', 'i14702p65-voyage1-60f96e66bbf37.jpg', 'Eval-TD-Symfony-60f96e66bc50e.pdf', 5),
(8, 'qsf', 'qsf', 'qsfqsf', 452, 5, 'Mountains-60f97507e7498.jpg', 'ville-futur-19-6093059-60f97507e89de.jpg', '03-vans-Chamrousse-60f97507e9665.jpg', 'Eval-TD-Symfony-60f97507eb69c.pdf', 1),
(9, 'sdg', 'sdgs', 'sdgsdgsgsddggggggggggggggggg', 12356, 8, 'i14702p65-voyage1-60f975e6cac9d.jpg', 'verdir-villes-meilleure-sante-60f975e6cb4da.jpg', 'i14702p65-voyage1-60f975e6cbd1d.jpg', 'Eval-TD-Symfony-60f975e6cc530.pdf', 1),
(10, 'fqdfd', 'qfdgq', 'qeggggggggggggggggggggggggggg', 450, 5, 'i14702p65-voyage1-60f9777baf329.jpg', 'ville-futur-19-6093059-60f9777bafceb.jpg', 'Mountains-60f9777bb06a8.jpg', 'Eval-TD-Symfony-60f9777bb18bf.pdf', 4);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tag_voyage`
--
ALTER TABLE `tag_voyage`
  ADD CONSTRAINT `FK_D6DCC07968C9E5AF` FOREIGN KEY (`voyage_id`) REFERENCES `voyage` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D6DCC079BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `voyage`
--
ALTER TABLE `voyage`
  ADD CONSTRAINT `FK_3F9D8955C09A1CAE` FOREIGN KEY (`id_cat_id`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
