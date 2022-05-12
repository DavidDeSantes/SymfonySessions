-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour symfonysession
CREATE DATABASE IF NOT EXISTS `symfonysession` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `symfonysession`;

-- Listage de la structure de la table symfonysession. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysession.categorie : ~3 rows (environ)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`id`, `nom_categorie`) VALUES
	(1, 'Développement web'),
	(2, 'Web Design'),
	(3, 'Bureautique'),
	(5, 'Vente');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Listage de la structure de la table symfonysession. cours
CREATE TABLE IF NOT EXISTS `cours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) NOT NULL,
  `nom_cours` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FDCA8C9CBCF5E72D` (`categorie_id`),
  CONSTRAINT `FK_FDCA8C9CBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysession.cours : ~8 rows (environ)
/*!40000 ALTER TABLE `cours` DISABLE KEYS */;
INSERT INTO `cours` (`id`, `categorie_id`, `nom_cours`) VALUES
	(1, 1, 'PHP'),
	(2, 1, 'JS'),
	(3, 1, 'HTML'),
	(4, 2, 'PhotoShop'),
	(5, 2, 'Asprite'),
	(6, 3, 'Word'),
	(7, 3, 'Excel'),
	(8, 1, 'Algo'),
	(9, 1, 'CSS');
/*!40000 ALTER TABLE `cours` ENABLE KEYS */;

-- Listage de la structure de la table symfonysession. doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table symfonysession.doctrine_migration_versions : ~0 rows (environ)
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20220506135047', '2022-05-06 13:50:59', 331);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;

-- Listage de la structure de la table symfonysession. formation
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_formation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysession.formation : ~3 rows (environ)
/*!40000 ALTER TABLE `formation` DISABLE KEYS */;
INSERT INTO `formation` (`id`, `nom_formation`) VALUES
	(1, 'Développement web'),
	(2, 'Web Designer'),
	(3, 'RAN Numérique'),
	(5, 'Conseiller Commercial');
/*!40000 ALTER TABLE `formation` ENABLE KEYS */;

-- Listage de la structure de la table symfonysession. moduler
CREATE TABLE IF NOT EXISTS `moduler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cours_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `nb_jours_cours` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_59B073417ECF78B0` (`cours_id`),
  KEY `IDX_59B07341613FECDF` (`session_id`),
  CONSTRAINT `FK_59B07341613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`),
  CONSTRAINT `FK_59B073417ECF78B0` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysession.moduler : ~14 rows (environ)
/*!40000 ALTER TABLE `moduler` DISABLE KEYS */;
INSERT INTO `moduler` (`id`, `cours_id`, `session_id`, `nb_jours_cours`) VALUES
	(2, 1, 1, 30),
	(3, 2, 1, 30),
	(4, 8, 1, 2),
	(5, 3, 1, 10),
	(6, 9, 1, 10),
	(7, 8, 2, 10),
	(8, 3, 2, 20),
	(9, 9, 2, 20),
	(10, 6, 2, 5),
	(11, 7, 2, 5),
	(12, 4, 3, 120),
	(13, 5, 3, 60),
	(14, 3, 3, 15),
	(15, 9, 3, 15);
/*!40000 ALTER TABLE `moduler` ENABLE KEYS */;

-- Listage de la structure de la table symfonysession. session
CREATE TABLE IF NOT EXISTS `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formation_id` int(11) NOT NULL,
  `nom_session` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D45200282E` (`formation_id`),
  CONSTRAINT `FK_D044D5D45200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysession.session : ~2 rows (environ)
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
INSERT INTO `session` (`id`, `formation_id`, `nom_session`, `place`, `date_debut`, `date_fin`) VALUES
	(1, 1, 'Développeur Web 1', 10, '2023-05-14', '2024-01-05'),
	(2, 3, 'RAN NUM1', 8, '2022-08-01', '2022-12-30'),
	(3, 2, 'Web Design 1', 10, '2022-06-01', '2023-02-05');
/*!40000 ALTER TABLE `session` ENABLE KEYS */;

-- Listage de la structure de la table symfonysession. session_stagiaire
CREATE TABLE IF NOT EXISTS `session_stagiaire` (
  `session_id` int(11) NOT NULL,
  `stagiaire_id` int(11) NOT NULL,
  PRIMARY KEY (`session_id`,`stagiaire_id`),
  KEY `IDX_C80B23B613FECDF` (`session_id`),
  KEY `IDX_C80B23BBBA93DD6` (`stagiaire_id`),
  CONSTRAINT `FK_C80B23B613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_C80B23BBBA93DD6` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaire` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysession.session_stagiaire : ~6 rows (environ)
/*!40000 ALTER TABLE `session_stagiaire` DISABLE KEYS */;
INSERT INTO `session_stagiaire` (`session_id`, `stagiaire_id`) VALUES
	(1, 1),
	(1, 2),
	(2, 4),
	(2, 5),
	(3, 3),
	(3, 6);
/*!40000 ALTER TABLE `session_stagiaire` ENABLE KEYS */;

-- Listage de la structure de la table symfonysession. stagiaire
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `ville` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysession.stagiaire : ~8 rows (environ)
/*!40000 ALTER TABLE `stagiaire` DISABLE KEYS */;
INSERT INTO `stagiaire` (`id`, `prenom`, `nom`, `sexe`, `date_naissance`, `ville`, `email`, `telephone`) VALUES
	(1, 'David', 'DeSantete', 'Homme', '1997-09-16', 'Strasbourg', 'david@hotmail.fr', '06.78.96.32.54'),
	(2, 'Thibault', 'Noekel', 'Homme', '2001-12-25', 'Strasbourg', 'titi.bobo@gmail.com', '06.54.36.98.74'),
	(3, 'Laura', 'Frayeur', 'Femme', '2004-05-06', 'Schernsheim', 'lolo.frayeur@orange.fr', '06.14.12.87.96'),
	(4, 'Didier', 'Fredom', 'Homme', '1968-10-12', 'Fribourg', 'dider@hotmail.com', '06.12.45.89.63'),
	(5, 'Fabienne', 'Leurre', 'Femme', '1997-12-05', 'Schiltgheim', 'Fab@orange.fr', '06.32.89.47.12'),
	(6, 'Claire', 'Fontaine', 'Femme', '1998-12-28', 'Kernersheim', 'ClaraF@gmail.com', '07.89.35.41.12'),
	(7, 'Clotilde', 'Bérange', 'Femme', '1997-08-16', 'Caen', 'Berange.clo@gmail.com', '06.78.98.45.63');
/*!40000 ALTER TABLE `stagiaire` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
