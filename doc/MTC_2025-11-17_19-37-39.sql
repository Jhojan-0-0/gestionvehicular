# ************************************************************
# Antares - SQL Client
# Version 0.7.24
# 
# https://antares-sql.app/
# https://github.com/antares-sql/antares
# 
# Host: 127.0.0.1 (Ubuntu 22.04 10.6.22)
# Database: MTC
# Generation time: 2025-11-17T19:38:00-05:00
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table filtroPersonal
# ------------------------------------------------------------

DROP TABLE IF EXISTS `filtroPersonal`;

CREATE TABLE `filtroPersonal` (
  `idFiltro` int(11) NOT NULL AUTO_INCREMENT,
  `idpersonal` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idFiltro`),
  KEY `idpersonal` (`idpersonal`),
  CONSTRAINT `filtroPersonal_ibfk_1` FOREIGN KEY (`idpersonal`) REFERENCES `personal` (`idpersonal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





# Dump of table login
# ------------------------------------------------------------

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `idlogin` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `passwd` varchar(100) DEFAULT NULL,
  `nivusu` int(11) DEFAULT 2,
  `estado` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idlogin`),
  KEY `fk_login_usuario` (`idusuario`),
  CONSTRAINT `fk_login_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;

INSERT INTO `login` (`idlogin`, `idusuario`, `username`, `passwd`, `nivusu`, `estado`) VALUES
	(2, 1, "jhon", "123", 2, "1");

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `personal` WRITE;
/*!40000 ALTER TABLE `personal` DISABLE KEYS */;

INSERT INTO `personal` (`idpersonal`, `dni`, `nombre`, `apellido`, `catLicencia`, `fechaPsicosomatico`) VALUES
	(1, 75485124, "JOSE FERNANDO", "LEON CAHUAPAZA", "AII", "2025-11-28"),
	(2, 75485745, "AIDEE", "ANDRES JUSTO", "AII", "2025-11-18");

/*!40000 ALTER TABLE `personal` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table usuario
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `sexo` varchar(20) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;

INSERT INTO `usuario` (`idusuario`, `nombre`, `apellido`, `dni`, `sexo`, `telefono`) VALUES
	(1, "jhojan", "ichuta pacco", 78457584, "M", "978541254");

/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table verificacion1
# ------------------------------------------------------------

DROP TABLE IF EXISTS `verificacion1`;

CREATE TABLE `verificacion1` (
  `idVerificacion1` int(11) NOT NULL AUTO_INCREMENT,
  `idpersonal` int(11) DEFAULT NULL,
  `fechaVerificacion` date DEFAULT NULL,
  `placaVehiculo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idVerificacion1`),
  KEY `idpersonal` (`idpersonal`),
  CONSTRAINT `verificacion1_ibfk_1` FOREIGN KEY (`idpersonal`) REFERENCES `personal` (`idpersonal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





# Dump of views
# ------------------------------------------------------------

# Creating temporary tables to overcome VIEW dependency errors


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# Dump completed on 2025-11-17T19:38:00-05:00
