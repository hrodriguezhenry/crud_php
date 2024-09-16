-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         8.0.33 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para db_empresa
CREATE DATABASE IF NOT EXISTS `db_empresa` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_empresa`;

-- Volcando estructura para tabla db_empresa.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nit` varchar(10) NOT NULL,
  `nombres` varchar(60) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_empresa.clientes: ~4 rows (aproximadamente)
DELETE FROM `clientes`;
INSERT INTO `clientes` (`id_cliente`, `nit`, `nombres`, `apellidos`, `direccion`, `telefono`, `fecha_nacimiento`) VALUES
	(1, '1', '1', '1', '1', '1', '2024-09-01'),
	(4, '1', '1', '1', '1', '1', '2024-09-01'),
	(5, '1', '1', '1', '1', '1', '2024-09-01'),
	(6, '1', '1', '1', '1', '1', '2024-09-01');

-- Volcando estructura para tabla db_empresa.empleado
CREATE TABLE IF NOT EXISTS `empleado` (
  `id_empleado` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nombres` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `direccion` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `id_puesto` smallint DEFAULT NULL,
  PRIMARY KEY (`id_empleado`),
  KEY `fk_empleado_puesto` (`id_puesto`),
  CONSTRAINT `fk_empleado_puesto` FOREIGN KEY (`id_puesto`) REFERENCES `puestos` (`id_puesto`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla db_empresa.empleado: ~4 rows (aproximadamente)
DELETE FROM `empleado`;
INSERT INTO `empleado` (`id_empleado`, `codigo`, `nombres`, `apellidos`, `direccion`, `telefono`, `fecha_nacimiento`, `id_puesto`) VALUES
	(1, 'E001', 'Henry Javier', 'Rodríguez Geronimo', 'Villa Canales', '54573864', '1999-10-14', 1),
	(2, 'E002', 'Luis Pablo', 'Pérez Hernández', 'Petapa', '85695235', '2002-12-22', 3),
	(3, 'E003', 'Juan Marlon', 'Menendéz Solis', 'Guatemala', '53624586', '1997-12-05', 3),
	(4, 'E004', 'Mynor Eduardo', 'Vega Sinay', 'Guatemala', '58698956', '1990-08-25', 2);

-- Volcando estructura para tabla db_empresa.puestos
CREATE TABLE IF NOT EXISTS `puestos` (
  `id_puesto` smallint NOT NULL AUTO_INCREMENT,
  `puesto` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_puesto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla db_empresa.puestos: ~3 rows (aproximadamente)
DELETE FROM `puestos`;
INSERT INTO `puestos` (`id_puesto`, `puesto`) VALUES
	(1, 'Programador'),
	(2, 'Analista'),
	(3, 'Encargado');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
