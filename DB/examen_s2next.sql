# SQL-Front 5.1  (Build 4.16)

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;


# Host: localhost    Database: examen_db
# ------------------------------------------------------
# Server version 5.5.5-10.4.11-MariaDB

#
# Source for table cat_menu
#

DROP TABLE IF EXISTS `cat_menu`;
CREATE TABLE `cat_menu` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL DEFAULT '' COMMENT 'Nombre del menu',
  `descripcion` varchar(255) NOT NULL DEFAULT '' COMMENT 'Descripcion del menu',
  `fch_creacion` datetime NOT NULL DEFAULT '2021-06-13 00:00:00' COMMENT 'fecha en la que se creo el menu/submenu',
  `fch_modificacion` datetime DEFAULT '2021-06-13 00:00:00' COMMENT 'fecha de la ultima modificacion',
  `id_menu_padre` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `id_menu_padre_fk` (`id_menu_padre`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COMMENT='Catalogo de Menus disponibles';

#
# Dumping data for table cat_menu
#

LOCK TABLES `cat_menu` WRITE;
/*!40000 ALTER TABLE `cat_menu` DISABLE KEYS */;
INSERT INTO `cat_menu` VALUES (76,'Primer Menu','En este menu no se puede hacer referencia porque no exite ninguno en la base','2021-06-14 11:54:41','2021-06-14 11:54:41',NULL);
INSERT INTO `cat_menu` VALUES (77,'Segundo Menu','En este si se puede seleccionar un padre porque hay al menos un registro en db','2021-06-14 11:55:49','2021-06-14 11:55:49',76);
INSERT INTO `cat_menu` VALUES (78,'Tercer Menu','Sin padre','2021-06-14 11:57:54','2021-06-14 11:57:54',NULL);
/*!40000 ALTER TABLE `cat_menu` ENABLE KEYS */;
UNLOCK TABLES;

#
#  Foreign keys for table cat_menu
#

ALTER TABLE `cat_menu`
ADD CONSTRAINT `id_menu_padre_fk` FOREIGN KEY (`id_menu_padre`) REFERENCES `cat_menu` (`Id`);


/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
