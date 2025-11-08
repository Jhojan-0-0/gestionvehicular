# ************************************************************
# Antares - SQL Client
# Version 0.7.24
# 
# https://antares-sql.app/
# https://github.com/antares-sql/antares
# 
# Host: 127.0.0.1 (Ubuntu 22.04 10.6.22)
# Database: MTC
# Generation time: 2025-11-07T22:05:37-05:00
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table login
# ------------------------------------------------------------

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `idlogin` int(11) NOT NULL AUTO_INCREMENT,
  `idpersonal` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `passwd` varchar(100) DEFAULT NULL,
  `nivusu` int(11) DEFAULT 2,
  `estado` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idlogin`),
  KEY `fk_login_personal` (`idpersonal`),
  CONSTRAINT `fk_login_personal` FOREIGN KEY (`idpersonal`) REFERENCES `personal` (`idpersonal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;

INSERT INTO `login` (`idlogin`, `idpersonal`, `username`, `passwd`, `nivusu`, `estado`) VALUES
	(1, 1, "jhon", "123", 2, "2");

/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table personal
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personal`;

CREATE TABLE `personal` (
  `idpersonal` int(11) NOT NULL AUTO_INCREMENT,
  `dni` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `catLicencia` varchar(20) DEFAULT NULL,
  `fechaPsicosomatico` date DEFAULT NULL,
  PRIMARY KEY (`idpersonal`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `personal` WRITE;
/*!40000 ALTER TABLE `personal` DISABLE KEYS */;

INSERT INTO `personal` (`idpersonal`, `dni`, `nombre`, `apellido`, `catLicencia`, `fechaPsicosomatico`) VALUES
	(1, 75645348, "Jhojan", "Ichuta Pacco", "ad", "2025-11-16"),
	(2, 23432345, "jose", "fat", "c", "2025-11-29"),
	(3, 65456789, "mat", "mat", "ww", "2025-12-06"),
	(4, 76565434, "mat1", "mat1", "we", "2025-11-28"),
	(5, 234567564, "mat2", "mat2", "er", "2025-11-27"),
	(6, 34565434, "jot", "jot", "rt", "2025-11-20"),
	(7, 23244534, "alan", "mit", "ll", "2025-12-05"),
	(8, 23536346, "jose jose", "ster", "ff", "2025-11-26"),
	(9, 23536364, "GET", "GERT", "DD", "2025-11-28");

/*!40000 ALTER TABLE `personal` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of views
# ------------------------------------------------------------

# Creating temporary tables to overcome VIEW dependency errors


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# Dump completed on 2025-11-07T22:05:37-05:00
