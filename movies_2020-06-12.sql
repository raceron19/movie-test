# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.29)
# Base de datos: movies
# Tiempo de Generación: 2020-06-12 20:46:15 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `movie_id` bigint(20) unsigned NOT NULL,
  `like` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;

INSERT INTO `likes` (`id`, `user_id`, `movie_id`, `like`)
VALUES
	(1,5,3,0);

/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `likes_movie_insert` AFTER INSERT ON `likes` FOR EACH ROW BEGIN
    update movies set likes=(select count(*) from likes where movie_id = movie_id and `like` = true) where movies.id = movie_id;
END */;;
/*!50003 SET SESSION SQL_MODE="ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `likes_movie_update` AFTER UPDATE ON `likes` FOR EACH ROW BEGIN
    update movies set likes=(select count(*) from likes where movie_id = OLD.movie_id and `like` = true) where movies.id = OLD.movie_id;
END */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Volcado de tabla migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2019_08_19_000000_create_failed_jobs_table',1),
	(3,'2020_06_07_205540_create_movies_table',1),
	(4,'2020_06_11_033854_create_likes_table',2),
	(7,'2020_06_11_053346_create_rents_table',3),
	(8,'2020_06_11_053355_create_sales_table',3),
	(9,'2020_06_12_055338_create_penalties_table',4);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla movie_updated_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `movie_updated_log`;

CREATE TABLE `movie_updated_log` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `movie_id` bigint(20) unsigned NOT NULL,
  `updated` varchar(250) NOT NULL DEFAULT '',
  `old_value` varchar(250) NOT NULL DEFAULT '',
  `new_value` varchar(250) NOT NULL DEFAULT '',
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `movie_updated_log` WRITE;
/*!40000 ALTER TABLE `movie_updated_log` DISABLE KEYS */;

INSERT INTO `movie_updated_log` (`id`, `movie_id`, `updated`, `old_value`, `new_value`, `updated_at`)
VALUES
	(1,3,'title','movie 2','my super movie yeah','2020-06-10 23:24:24'),
	(2,3,'rent price','7.57','11.99','2020-06-10 23:24:24'),
	(3,3,'sale price','10.86','33.99','2020-06-10 23:24:24'),
	(4,3,'title','my super movie yeah','cbjbcjwcwsc','2020-06-10 23:24:44');

/*!40000 ALTER TABLE `movie_updated_log` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla movies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `movies`;

CREATE TABLE `movies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` bigint(20) NOT NULL,
  `rent_price` decimal(8,2) NOT NULL,
  `sale_price` decimal(8,2) NOT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT '1',
  `likes` bigint(20) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `movies` WRITE;
/*!40000 ALTER TABLE `movies` DISABLE KEYS */;

INSERT INTO `movies` (`id`, `title`, `description`, `image`, `stock`, `rent_price`, `sale_price`, `availability`, `likes`, `created_at`, `updated_at`)
VALUES
	(1,'movie 0','this is the movie #0 and this is the description',NULL,6,19.86,8.86,1,0,'2020-06-10 04:50:26','2020-06-10 04:50:26'),
	(2,'movie 1','this is the movie #1 and this is the description',NULL,10,16.43,8.71,1,0,'2020-06-10 04:50:26','2020-06-12 05:04:56'),
	(3,'cbjbcjwcwsc','this is the movie #2 and this is the description',NULL,18,11.99,33.99,1,0,'2020-06-10 04:50:26','2020-06-11 05:24:44'),
	(4,'movie 3','this is the movie #3 and this is the description',NULL,14,18.71,12.71,1,0,'2020-06-10 04:50:26','2020-06-12 05:07:38'),
	(5,'movie 4','this is the movie #4 and this is the description',NULL,1,12.00,19.29,1,0,'2020-06-10 04:50:26','2020-06-10 04:50:26'),
	(6,'movie 5','this is the movie #5 and this is the description',NULL,16,18.43,8.71,1,0,'2020-06-10 04:50:26','2020-06-10 04:50:26'),
	(7,'movie 6','this is the movie #6 and this is the description',NULL,1,10.14,7.29,1,0,'2020-06-10 04:50:26','2020-06-10 04:50:26'),
	(8,'movie 7','this is the movie #7 and this is the description',NULL,6,17.29,11.71,1,0,'2020-06-10 04:50:26','2020-06-10 04:50:26'),
	(9,'movie 8','this is the movie #8 and this is the description',NULL,6,15.43,13.57,1,0,'2020-06-10 04:50:26','2020-06-10 04:50:26'),
	(10,'movie 9','this is the movie #9 and this is the description',NULL,10,20.71,11.71,1,0,'2020-06-10 04:50:26','2020-06-10 04:50:26');

/*!40000 ALTER TABLE `movies` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `after_movie_update` AFTER UPDATE ON `movies` FOR EACH ROW BEGIN
    IF OLD.title <> new.title THEN
        INSERT INTO movie_updated_log(movie_id,updated,old_value,new_value,updated_at)
        VALUES(OLD.id, 'title', old.title, new.title, now());
    END IF;
    
    IF OLD.rent_price <> new.rent_price THEN
        INSERT INTO movie_updated_log(movie_id,updated,old_value,new_value,updated_at)
        VALUES(OLD.id, 'rent price', old.rent_price, new.rent_price, now());
    END IF;
    
     IF OLD.sale_price <> new.sale_price THEN
        INSERT INTO movie_updated_log(movie_id,updated,old_value,new_value,updated_at)
        VALUES(OLD.id, 'sale price', old.sale_price, new.sale_price, now());
    END IF;
END */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Volcado de tabla penalties
# ------------------------------------------------------------

DROP TABLE IF EXISTS `penalties`;

CREATE TABLE `penalties` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rent_id` bigint(20) unsigned NOT NULL,
  `penalty` decimal(8,2) NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `penalties` WRITE;
/*!40000 ALTER TABLE `penalties` DISABLE KEYS */;

INSERT INTO `penalties` (`id`, `rent_id`, `penalty`, `paid`, `created_at`, `updated_at`)
VALUES
	(1,4,30.00,0,'2020-06-12 18:40:35','2020-06-12 18:42:19'),
	(2,5,4.00,0,'2020-06-12 18:40:35','2020-06-12 18:42:19');

/*!40000 ALTER TABLE `penalties` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla rents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rents`;

CREATE TABLE `rents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `movie_id` bigint(20) unsigned NOT NULL,
  `quantity` bigint(20) unsigned NOT NULL,
  `returned` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `rents` WRITE;
/*!40000 ALTER TABLE `rents` DISABLE KEYS */;

INSERT INTO `rents` (`id`, `user_id`, `movie_id`, `quantity`, `returned`, `created_at`, `updated_at`)
VALUES
	(1,5,2,3,1,'2020-06-12 04:31:56','2020-06-12 05:01:42'),
	(2,4,2,3,1,'2020-06-12 05:02:08','2020-06-12 05:04:56'),
	(3,4,4,3,1,'2020-06-12 05:07:20','2020-06-12 05:07:38'),
	(4,5,1,3,0,'2020-05-20 00:00:00',NULL),
	(5,5,6,2,0,'2020-05-28 00:00:00',NULL);

/*!40000 ALTER TABLE `rents` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla sales
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sales`;

CREATE TABLE `sales` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `movie_id` bigint(20) unsigned NOT NULL,
  `quantity` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;

INSERT INTO `sales` (`id`, `user_id`, `movie_id`, `quantity`, `created_at`, `updated_at`)
VALUES
	(1,5,4,10,'2020-06-12 03:36:03','2020-06-12 03:36:03'),
	(9,5,2,2,'2020-06-12 04:10:07','2020-06-12 04:10:07'),
	(10,5,2,2,'2020-06-12 04:20:55','2020-06-12 04:20:55'),
	(11,5,2,5,'2020-06-12 04:21:39','2020-06-12 04:21:39'),
	(12,4,4,1,'2020-06-12 05:07:09','2020-06-12 05:07:09');

/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `admin`, `created_at`, `updated_at`)
VALUES
	(4,'rodrigo','rac@gmail.com',NULL,'$2y$10$yH.bvAJtHPU1hDAcTItuN.Uy6/iJL7eNpp/6RbPZZZvdyrp/KRXee',NULL,1,'2020-06-10 04:53:44','2020-06-10 04:53:44'),
	(5,'rodrigo','rac3@gmail.com',NULL,'$2y$10$pVw1nP07z3ksjaba4KHbRe2LWZ.Vi6Dd10AVNuJZbH7A4BiOP0QE6',NULL,0,'2020-06-11 04:41:58','2020-06-11 04:41:58');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
