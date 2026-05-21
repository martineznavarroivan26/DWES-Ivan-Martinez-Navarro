-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2026 a las 19:41:25
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `saludenprimera`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `cod_participante` int(5) NOT NULL,
  `AcF1` tinyint(1) DEFAULT 0 COMMENT 'Días act. vigorosa: de 0 a 7',
  `AcF2` smallint(6) DEFAULT NULL COMMENT 'Minutos act. vigorosa: null (no responde), -1 (no sabe), 1-1440',
  `AcF3` tinyint(1) DEFAULT 0 COMMENT 'Días act. moderada: de 0 a 7',
  `AcF4` smallint(6) DEFAULT NULL COMMENT 'Minutos act. moderada: null (no responde), -1 (no sabe), 1-1440',
  `AcF5` tinyint(1) DEFAULT 0 COMMENT 'Días caminata: de 0 a 7',
  `AcF6` smallint(6) DEFAULT NULL COMMENT 'Minutos caminata: null (no responde), -1 (no sabe), 1-1440',
  `AcF7` smallint(6) DEFAULT NULL COMMENT 'Minutos sentado: -1 (no sabe), 1-1440'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`cod_participante`, `AcF1`, `AcF2`, `AcF3`, `AcF4`, `AcF5`, `AcF6`, `AcF7`) VALUES
(10001, 0, 0, 0, 0, 0, 0, -1),
(10021, 1, 84, 0, NULL, 3, 99, 249),
(10022, 0, NULL, 3, 74, 7, 96, 326),
(10023, 1, 57, 6, 93, 3, 174, 381),
(10024, 5, 82, 2, 47, 1, 118, 134),
(10025, 4, 80, 5, -1, 7, 47, 271),
(10026, 4, -1, 6, 59, 7, 145, 222),
(10027, 5, 84, 5, 74, 7, 150, 556),
(10028, 3, 72, 1, 84, 1, 105, 132),
(10029, 5, 68, 7, 30, 2, 149, 145),
(10030, 2, 37, 1, 67, 2, 145, 487),
(10031, 0, NULL, 3, 73, 2, -1, 549),
(10032, 0, NULL, 4, 37, 3, 91, 557),
(10033, 2, -1, 7, 69, 7, 30, 205),
(10034, 4, 29, 6, 58, 3, 66, 496),
(10035, 1, 71, 7, 40, 3, 80, 587),
(10036, 3, 30, 4, -1, 7, 81, 320),
(10037, 5, 24, 6, 55, 3, 180, 199),
(10038, 2, 84, 0, NULL, 3, 55, 579),
(10039, 4, 66, 7, 68, 7, 73, 266),
(10040, 0, NULL, 3, -1, 7, 36, 514),
(10041, 0, NULL, 1, 77, 5, 124, 302),
(10042, 3, 87, 1, -1, 5, 133, 306),
(10043, 2, 30, 0, NULL, 2, 158, 593),
(10044, 0, NULL, 7, 101, 3, 169, 120),
(10045, 4, 78, 2, 38, 3, -1, 299),
(10046, 3, 77, 2, 87, 6, 108, 364),
(10047, 4, 83, 0, NULL, 7, 73, 270),
(10048, 5, 37, 3, 119, 4, 24, 481),
(10049, 0, NULL, 4, -1, 7, 76, 303),
(10050, 5, 75, 5, 116, 6, 66, 131),
(12000, 1, 1, 1, 11, 1, -1, 1),
(12003, 1, 1, 1, 1, 1, 1, 1),
(2147483647, 0, 0, 2, -1, 0, 0, -1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimentacion`
--

CREATE TABLE `alimentacion` (
  `cod_participante` int(5) NOT NULL,
  `Ali1` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Valores admitidos: 0 o 1',
  `Ali2` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Valores admitidos: 0 o 1',
  `Ali3` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Valores admitidos: 0 o 1',
  `Ali4` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Valores admitidos: 0 o 1',
  `Ali5` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Valores admitidos: 0 o 1',
  `Ali6` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Valores admitidos: 0 o 1',
  `Ali7` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Valores admitidos: 0 o 1',
  `Ali8` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Valores admitidos: 0 o 1',
  `Ali9` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Valores admitidos: 0 o 1',
  `Ali10` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Valores admitidos: 0 o 1',
  `Ali11` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Valores admitidos: 0 o 1',
  `Ali12` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Valores admitidos: 0 o 1',
  `Ali13` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Valores admitidos: 0 o 1',
  `Ali14` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Valores admitidos: 0 o 1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alimentacion`
--

INSERT INTO `alimentacion` (`cod_participante`, `Ali1`, `Ali2`, `Ali3`, `Ali4`, `Ali5`, `Ali6`, `Ali7`, `Ali8`, `Ali9`, `Ali10`, `Ali11`, `Ali12`, `Ali13`, `Ali14`) VALUES
(10001, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(10011, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 0, 1, 1, 0),
(10012, 0, 1, 1, 1, 1, 1, 0, 0, 1, 1, 0, 1, 0, 0),
(10013, 0, 1, 0, 0, 1, 0, 1, 1, 0, 1, 1, 1, 0, 0),
(10014, 1, 0, 1, 0, 0, 1, 0, 1, 1, 0, 0, 1, 1, 0),
(10015, 1, 0, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 1, 0),
(10016, 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 1, 1, 0, 1),
(10017, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 0, 0, 0, 0),
(10018, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1),
(10019, 1, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 1, 0, 0),
(10020, 1, 0, 1, 0, 1, 0, 1, 1, 0, 0, 0, 0, 1, 1),
(10021, 0, 0, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, 0),
(10022, 0, 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, 0, 1, 1),
(10023, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 1, 1, 1, 1),
(10024, 1, 1, 1, 1, 0, 1, 0, 0, 1, 0, 0, 0, 1, 1),
(10025, 1, 0, 0, 0, 1, 1, 0, 0, 1, 0, 1, 0, 1, 1),
(10026, 1, 0, 1, 1, 1, 1, 0, 0, 1, 0, 1, 0, 0, 1),
(10027, 1, 0, 1, 1, 0, 1, 0, 1, 0, 1, 1, 1, 0, 0),
(10028, 0, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 1, 0, 1),
(10029, 1, 0, 0, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1),
(10030, 0, 1, 1, 0, 0, 1, 0, 1, 0, 1, 0, 0, 0, 0),
(10031, 1, 1, 1, 0, 0, 1, 1, 1, 0, 1, 0, 1, 0, 1),
(10032, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 1),
(10033, 0, 1, 0, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 0),
(10034, 1, 0, 0, 0, 0, 1, 0, 0, 1, 0, 1, 1, 1, 0),
(10035, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 1, 1, 0, 1),
(10036, 1, 1, 1, 1, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0),
(10037, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 1, 0, 1),
(10038, 0, 0, 0, 1, 0, 1, 1, 0, 0, 1, 1, 1, 1, 0),
(10039, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0),
(10040, 1, 1, 1, 1, 0, 0, 1, 1, 0, 0, 0, 1, 0, 1),
(12000, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1),
(12003, 1, 1, 1, 1, 0, 0, 1, 1, 1, 0, 0, 1, 0, 1),
(2147483647, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antropometrico`
--

CREATE TABLE `antropometrico` (
  `cod_participante` int(5) NOT NULL,
  `Ant1` decimal(5,2) DEFAULT NULL COMMENT 'Peso corporal (kg)',
  `Ant2` decimal(5,2) DEFAULT NULL COMMENT 'Talla (cm)',
  `Ant3` decimal(4,2) DEFAULT NULL COMMENT 'Índice de Masa Corporal (IMC)',
  `Ant4` enum('Bajo peso','Normopeso','Sobrepeso','Obesidad') DEFAULT NULL,
  `Ant5` decimal(5,2) DEFAULT NULL COMMENT 'Perímetro de cintura (cm)',
  `Ant6` decimal(5,2) DEFAULT NULL COMMENT 'Perímetro de cadera (cm)',
  `Ant7` decimal(4,2) DEFAULT NULL COMMENT 'Índice cintura-cadera (ICC)',
  `Ant8` decimal(4,2) DEFAULT NULL COMMENT 'Índice cintura-altura',
  `Ant9` decimal(5,2) DEFAULT NULL COMMENT 'Pliegue cutáneo tricipital (mm)',
  `Ant10` decimal(5,2) DEFAULT NULL COMMENT 'Perímetro del brazo relajado (cm)',
  `Ant11` decimal(5,2) DEFAULT NULL COMMENT 'Perímetro muscular del brazo (PMB) (cm)',
  `Ant12` decimal(5,2) DEFAULT NULL COMMENT 'Masa muscular total (%/Kg)',
  `Ant13` decimal(4,2) DEFAULT NULL COMMENT 'Grasa corporal total (%)',
  `Ant14` decimal(4,2) DEFAULT NULL COMMENT 'Hidratación corporal (%)',
  `Ant15` tinyint(4) DEFAULT NULL COMMENT 'Grasa visceral (nivel o índice)',
  `Ant16` decimal(4,2) DEFAULT NULL COMMENT 'Masa ósea (kg)',
  `Ant17` tinyint(4) DEFAULT NULL COMMENT 'Edad metabólica',
  `Ant18_BD` decimal(5,2) DEFAULT NULL COMMENT 'Muscular: Brazo derecho',
  `Ant18_BI` decimal(5,2) DEFAULT NULL COMMENT 'Muscular: Brazo izquierdo',
  `Ant18_PD` decimal(5,2) DEFAULT NULL COMMENT 'Muscular: Pierna derecha',
  `Ant18_PI` decimal(5,2) DEFAULT NULL COMMENT 'Muscular: Pierna izquierda',
  `Ant19_BD` decimal(5,2) DEFAULT NULL COMMENT 'Grasa: Brazo derecho',
  `Ant19_BI` decimal(5,2) DEFAULT NULL COMMENT 'Grasa: Brazo izquierdo',
  `Ant19_PD` decimal(5,2) DEFAULT NULL COMMENT 'Grasa: Pierna derecha',
  `Ant19_PI` decimal(5,2) DEFAULT NULL COMMENT 'Grasa: Pierna izquierda',
  `Ant20` tinyint(4) DEFAULT NULL COMMENT 'Frecuencia cardíaca en reposo (lpm)',
  `Ant21` text DEFAULT NULL COMMENT 'Observaciones'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `antropometrico`
--

INSERT INTO `antropometrico` (`cod_participante`, `Ant1`, `Ant2`, `Ant3`, `Ant4`, `Ant5`, `Ant6`, `Ant7`, `Ant8`, `Ant9`, `Ant10`, `Ant11`, `Ant12`, `Ant13`, `Ant14`, `Ant15`, `Ant16`, `Ant17`, `Ant18_BD`, `Ant18_BI`, `Ant18_PD`, `Ant18_PI`, `Ant19_BD`, `Ant19_BI`, `Ant19_PD`, `Ant19_PI`, `Ant20`, `Ant21`) VALUES
(10001, 168.87, 70.53, 24.73, 'Normopeso', 63.66, 82.67, 0.77, 0.38, 10.57, 29.07, 24.31, 35.84, 28.04, 55.91, 7, 2.35, 24, 3.33, 2.61, 9.08, 9.77, 23.55, 16.54, 22.08, 15.78, 85, 'Registro de prueba automatizado'),
(10002, 157.09, 84.61, 34.29, 'Obesidad', 86.67, 80.79, 1.07, 0.55, 9.98, 28.97, 25.08, 41.94, 24.16, 64.01, 2, 3.42, 21, 3.82, 3.00, 10.05, 8.25, 14.22, 17.02, 22.43, 16.08, 86, 'Registro de prueba automatizado'),
(10003, 160.52, 57.39, 22.27, 'Normopeso', 73.93, 87.45, 0.85, 0.46, 10.96, 24.90, 26.18, 35.45, 34.26, 62.24, 9, 2.74, 20, 3.60, 2.47, 10.13, 7.82, 20.08, 21.22, 25.87, 20.70, 81, 'Registro de prueba automatizado'),
(10004, 172.17, 62.31, 21.02, 'Normopeso', 95.86, 99.84, 0.96, 0.56, 17.26, 23.23, 26.60, 44.92, 34.82, 64.71, 11, 2.74, 26, 3.35, 3.75, 8.41, 7.53, 19.17, 19.86, 21.80, 19.40, 63, 'Registro de prueba automatizado'),
(10005, 178.10, 93.89, 29.60, 'Sobrepeso', 95.87, 96.74, 0.99, 0.54, 9.49, 31.88, 28.17, 39.21, 27.43, 57.64, 6, 2.73, 18, 3.84, 2.74, 7.33, 8.24, 14.45, 18.35, 28.38, 26.84, 68, 'Registro de prueba automatizado'),
(10006, 189.49, 55.20, 15.37, 'Bajo peso', 84.87, 102.85, 0.83, 0.45, 22.15, 27.19, 23.32, 35.46, 31.43, 55.17, 8, 2.06, 21, 3.25, 2.16, 9.07, 8.40, 13.04, 24.41, 17.91, 16.34, 85, 'Registro de prueba automatizado'),
(10007, 156.87, 80.36, 32.66, 'Obesidad', 68.52, 81.24, 0.84, 0.44, 16.51, 30.55, 28.60, 32.47, 19.87, 62.22, 11, 2.35, 23, 3.89, 2.25, 10.23, 9.64, 23.18, 16.16, 21.26, 27.82, 60, 'Registro de prueba automatizado'),
(10008, 174.13, 79.96, 26.37, 'Sobrepeso', 87.58, 93.50, 0.94, 0.50, 10.72, 28.68, 22.39, 37.86, 33.08, 64.49, 1, 2.47, 22, 2.78, 3.11, 9.45, 8.59, 12.16, 17.92, 18.12, 21.85, 79, 'Registro de prueba automatizado'),
(10009, 187.32, 78.85, 22.47, 'Normopeso', 77.40, 87.57, 0.88, 0.41, 22.34, 22.27, 22.46, 32.40, 16.24, 63.31, 12, 2.53, 26, 2.43, 3.02, 10.63, 7.04, 14.85, 18.83, 29.61, 16.54, 77, 'Registro de prueba automatizado'),
(10010, 177.82, 71.78, 22.70, 'Normopeso', 78.56, 106.04, 0.74, 0.44, 22.23, 23.65, 28.43, 42.04, 24.70, 55.17, 8, 2.15, 24, 3.43, 3.53, 9.69, 7.31, 15.59, 19.41, 15.30, 18.26, 60, 'Registro de prueba automatizado'),
(10011, 171.99, 65.47, 22.13, 'Normopeso', 70.52, 88.51, 0.80, 0.41, 17.44, 25.54, 25.86, 30.71, 24.57, 57.51, 10, 2.51, 20, 2.43, 2.68, 7.16, 7.74, 22.14, 17.36, 15.37, 24.76, 65, 'Registro de prueba automatizado'),
(10012, 187.98, 57.90, 16.38, 'Bajo peso', 62.01, 101.75, 0.61, 0.33, 15.12, 24.37, 25.65, 33.46, 24.16, 60.98, 8, 2.43, 23, 2.01, 2.62, 9.12, 9.88, 10.21, 23.63, 22.53, 26.78, 72, 'Registro de prueba automatizado'),
(10013, 180.78, 69.23, 21.18, 'Normopeso', 97.10, 90.67, 1.07, 0.54, 22.92, 32.90, 25.57, 30.88, 27.44, 64.35, 10, 2.36, 25, 2.17, 2.31, 9.02, 7.28, 22.43, 24.04, 17.93, 17.50, 67, 'Registro de prueba automatizado'),
(10014, 180.80, 92.44, 28.28, 'Sobrepeso', 80.20, 100.87, 0.80, 0.44, 22.45, 30.74, 27.53, 38.67, 27.63, 59.25, 3, 3.31, 24, 3.46, 3.27, 10.96, 7.19, 13.95, 12.65, 16.41, 29.10, 72, 'Registro de prueba automatizado'),
(10015, 164.34, 53.71, 19.89, 'Normopeso', 84.46, 104.30, 0.81, 0.51, 11.23, 29.77, 25.91, 30.20, 20.84, 59.21, 3, 3.31, 24, 3.64, 2.05, 9.67, 8.07, 15.08, 23.31, 21.33, 21.70, 88, 'Registro de prueba automatizado'),
(10016, 172.23, 75.31, 25.39, 'Sobrepeso', 73.40, 109.65, 0.67, 0.43, 22.05, 30.63, 27.85, 41.50, 24.55, 55.89, 1, 3.19, 27, 2.49, 2.92, 9.26, 8.78, 17.94, 14.64, 29.39, 28.02, 73, 'Registro de prueba automatizado'),
(10017, 179.94, 57.79, 17.85, 'Bajo peso', 89.09, 83.50, 1.07, 0.50, 14.04, 29.94, 21.02, 37.87, 21.33, 55.10, 2, 2.69, 18, 3.35, 2.70, 9.83, 8.99, 15.52, 15.16, 24.22, 15.66, 71, 'Registro de prueba automatizado'),
(10018, 180.79, 75.38, 23.06, 'Normopeso', 84.35, 90.56, 0.93, 0.47, 22.01, 29.36, 22.67, 37.38, 28.21, 63.26, 2, 2.39, 26, 3.01, 3.91, 8.07, 8.88, 18.24, 15.03, 15.42, 16.99, 77, 'Registro de prueba automatizado'),
(10019, 172.40, 83.73, 28.17, 'Sobrepeso', 70.26, 81.00, 0.87, 0.41, 13.96, 32.65, 22.44, 38.36, 16.08, 61.00, 11, 2.57, 21, 3.56, 3.49, 8.56, 9.87, 16.31, 24.22, 22.15, 23.08, 67, 'Registro de prueba automatizado'),
(10020, 179.72, 83.23, 25.77, 'Sobrepeso', 82.93, 99.53, 0.83, 0.46, 16.02, 30.66, 20.04, 42.80, 20.14, 62.24, 11, 2.10, 25, 3.44, 2.48, 7.22, 9.19, 18.63, 13.51, 21.64, 22.69, 67, 'Registro de prueba automatizado'),
(10021, 177.36, 71.98, 22.88, 'Normopeso', 80.99, 84.77, 0.96, 0.46, 11.32, 29.54, 24.78, 37.61, 17.00, 64.80, 8, 2.07, 22, 2.18, 2.22, 8.13, 7.32, 18.31, 17.93, 29.72, 19.83, 79, 'Registro de prueba automatizado'),
(10022, 167.46, 85.43, 30.46, 'Obesidad', 94.75, 109.44, 0.87, 0.57, 12.50, 28.68, 28.83, 41.17, 16.51, 56.44, 6, 2.04, 24, 2.44, 2.25, 10.88, 8.86, 16.32, 20.64, 19.25, 19.32, 77, 'Registro de prueba automatizado'),
(10023, 158.00, 79.66, 31.91, 'Obesidad', 61.52, 86.40, 0.71, 0.39, 22.28, 23.45, 27.47, 35.62, 27.63, 55.33, 4, 2.38, 22, 2.99, 2.26, 7.60, 8.49, 16.08, 23.67, 20.09, 29.48, 84, 'Registro de prueba automatizado'),
(10024, 159.84, 62.18, 24.34, 'Normopeso', 97.56, 106.50, 0.92, 0.61, 17.00, 26.18, 29.44, 40.12, 25.82, 61.82, 10, 3.32, 18, 3.27, 4.00, 7.36, 8.82, 10.11, 20.05, 19.92, 24.47, 65, 'Registro de prueba automatizado'),
(10025, 188.98, 65.08, 18.22, 'Bajo peso', 90.49, 104.20, 0.87, 0.48, 19.20, 25.77, 23.31, 40.65, 26.19, 61.66, 8, 2.41, 21, 2.29, 3.12, 8.44, 7.49, 17.93, 14.17, 27.06, 17.78, 75, 'Registro de prueba automatizado'),
(10026, 155.52, 73.96, 30.58, 'Obesidad', 84.68, 94.65, 0.89, 0.54, 16.86, 27.86, 26.68, 43.15, 22.57, 57.62, 3, 2.13, 27, 2.69, 3.92, 10.09, 10.90, 18.37, 22.96, 24.70, 24.63, 68, 'Registro de prueba automatizado'),
(10027, 169.97, 64.67, 22.39, 'Normopeso', 73.88, 102.71, 0.72, 0.43, 19.16, 27.39, 20.13, 40.78, 26.06, 61.10, 5, 2.19, 22, 3.88, 2.61, 9.85, 9.59, 11.45, 18.09, 21.12, 21.33, 86, 'Registro de prueba automatizado'),
(10028, 160.53, 56.14, 21.78, 'Normopeso', 68.32, 98.91, 0.69, 0.43, 15.91, 30.96, 21.49, 37.60, 16.74, 64.14, 4, 3.19, 18, 3.77, 2.54, 9.72, 9.41, 24.46, 10.24, 17.82, 28.38, 86, 'Registro de prueba automatizado'),
(10029, 182.91, 63.67, 19.03, 'Normopeso', 65.07, 101.66, 0.64, 0.36, 11.44, 33.78, 22.21, 32.36, 17.48, 56.49, 5, 2.62, 27, 3.02, 3.38, 10.73, 9.35, 12.11, 24.10, 19.17, 23.55, 60, 'Registro de prueba automatizado'),
(10030, 168.21, 87.55, 30.94, 'Obesidad', 61.58, 100.82, 0.61, 0.37, 13.29, 30.15, 23.40, 39.96, 20.95, 59.95, 8, 2.66, 22, 3.71, 3.96, 8.33, 9.87, 18.91, 22.25, 19.53, 15.91, 71, 'Registro de prueba automatizado'),
(10031, 182.91, 85.97, 25.70, 'Sobrepeso', 84.20, 98.80, 0.85, 0.46, 12.78, 30.54, 26.04, 43.27, 27.22, 59.02, 3, 3.02, 26, 2.53, 3.50, 10.84, 9.18, 22.73, 19.09, 22.26, 24.04, 76, 'Registro de prueba automatizado'),
(10032, 155.03, 64.34, 26.77, 'Sobrepeso', 83.62, 109.91, 0.76, 0.54, 11.20, 22.92, 27.44, 37.32, 19.15, 60.74, 3, 2.79, 26, 3.55, 2.54, 7.12, 8.35, 19.02, 24.85, 17.21, 26.50, 71, 'Registro de prueba automatizado'),
(10033, 178.08, 55.46, 17.49, 'Bajo peso', 85.14, 103.34, 0.82, 0.48, 8.08, 30.30, 24.44, 32.14, 22.63, 59.80, 4, 3.24, 21, 2.88, 2.07, 10.41, 7.65, 13.80, 21.72, 17.20, 20.84, 75, 'Registro de prueba automatizado'),
(10034, 167.91, 64.50, 22.88, 'Normopeso', 80.16, 96.59, 0.83, 0.48, 11.81, 29.32, 22.90, 39.26, 19.37, 57.41, 7, 2.03, 22, 2.37, 3.16, 8.42, 7.11, 11.07, 14.13, 17.45, 29.84, 73, 'Registro de prueba automatizado'),
(10035, 166.08, 59.55, 21.59, 'Normopeso', 64.45, 107.58, 0.60, 0.39, 11.95, 28.70, 20.03, 35.07, 28.63, 58.94, 12, 2.66, 22, 3.58, 3.37, 7.20, 7.79, 22.52, 18.74, 21.16, 19.55, 68, 'Registro de prueba automatizado'),
(10036, 173.23, 83.56, 27.85, 'Sobrepeso', 66.65, 97.83, 0.68, 0.38, 15.09, 28.96, 24.83, 40.12, 33.50, 61.01, 3, 2.53, 18, 2.52, 2.23, 10.21, 9.63, 23.20, 16.46, 22.67, 18.98, 83, 'Registro de prueba automatizado'),
(10037, 160.93, 71.03, 27.43, 'Sobrepeso', 93.14, 102.21, 0.91, 0.58, 11.25, 32.35, 26.64, 40.94, 28.12, 55.93, 6, 2.29, 22, 3.68, 3.50, 7.94, 10.70, 23.72, 22.00, 18.83, 28.15, 78, 'Registro de prueba automatizado'),
(10038, 171.13, 70.24, 23.98, 'Normopeso', 94.64, 109.44, 0.86, 0.55, 12.62, 29.15, 20.54, 37.24, 20.05, 63.15, 4, 2.21, 25, 2.73, 3.09, 9.53, 9.10, 20.99, 11.28, 18.44, 28.36, 82, 'Registro de prueba automatizado'),
(10039, 160.30, 70.83, 27.57, 'Sobrepeso', 94.43, 107.43, 0.88, 0.59, 22.85, 24.50, 20.71, 40.91, 23.53, 64.50, 6, 2.75, 19, 2.01, 3.41, 9.11, 9.05, 24.80, 15.89, 15.03, 27.50, 64, 'Registro de prueba automatizado'),
(10040, 165.74, 52.26, 19.02, 'Normopeso', 73.21, 95.02, 0.77, 0.44, 15.68, 22.71, 27.60, 39.35, 31.73, 58.12, 1, 2.47, 22, 2.39, 3.36, 10.28, 7.25, 22.84, 11.36, 28.24, 17.16, 62, 'Registro de prueba automatizado'),
(12000, 1.00, 1.00, 1.00, 'Bajo peso', 0.01, 1.00, 1.00, 1.00, 1.00, 1.00, 1.00, 1.00, 1.00, 1.00, 1, 1.00, 1, 1.00, 1.00, 1.00, 1.00, 1.00, 1.00, 1.00, 11.00, 1, ''),
(12003, 1.00, 1.00, 1.00, 'Normopeso', 1.00, 1.00, 1.00, 11.00, 1.00, 1.00, 1.00, 1.00, 1.00, 1.00, 1, 1.00, 1, 1.00, 1.00, 1.00, 1.00, 1.00, 1.00, 1.00, 1.00, 1, ''),
(2147483647, 21.00, 12.00, 99.99, 'Obesidad', 12.00, 21.00, 0.57, 1.00, 21.00, 21.00, 21.00, 20.99, 21.00, 21.00, 21, 21.00, 12, 20.99, 21.00, 21.00, 21.00, 12.00, 21.00, 21.00, 21.00, 12, '21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante`
--

CREATE TABLE `participante` (
  `cod_participante` int(5) NOT NULL,
  `centro_educativo` varchar(30) NOT NULL,
  `familia_profesional` varchar(30) NOT NULL,
  `edad` int(3) NOT NULL,
  `sexo` enum('Mujer','Hombre','Prefiere no indicar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `participante`
--

INSERT INTO `participante` (`cod_participante`, `centro_educativo`, `familia_profesional`, `edad`, `sexo`) VALUES
(10001, 'IES Fernando Zóbel', 'Sanidad', 20, 'Mujer'),
(10002, 'CIFP N1', 'Salud', 19, 'Hombre'),
(10003, 'IES Lorenzo Hervás y Panduro', 'Informática y Comunicaciones', 21, 'Mujer'),
(10004, 'IES Fernando Zóbel', 'Seguridad y Medio Ambiente', 22, 'Hombre'),
(10005, 'CIFP N1', 'Sanidad', 20, 'Mujer'),
(10006, 'IES Lorenzo Hervás y Panduro', 'Salud', 18, 'Hombre'),
(10007, 'IES Fernando Zóbel', 'Informática y Comunicaciones', 23, 'Mujer'),
(10008, 'CIFP N1', 'Seguridad y Medio Ambiente', 19, 'Hombre'),
(10009, 'IES Lorenzo Hervás y Panduro', 'Sanidad', 25, 'Mujer'),
(10010, 'IES Fernando Zóbel', 'Salud', 20, 'Hombre'),
(10011, 'CIFP N1', 'Informática y Comunicaciones', 21, 'Hombre'),
(10012, 'IES Lorenzo Hervás y Panduro', 'Sanidad', 19, 'Mujer'),
(10013, 'IES Fernando Zóbel', 'Seguridad y Medio Ambiente', 24, 'Mujer'),
(10014, 'CIFP N1', 'Salud', 22, 'Hombre'),
(10015, 'IES Lorenzo Hervás y Panduro', 'Sanidad', 21, 'Mujer'),
(10016, 'IES Fernando Zóbel', 'Informática y Comunicaciones', 20, 'Hombre'),
(10017, 'CIFP N1', 'Salud', 19, 'Mujer'),
(10018, 'IES Lorenzo Hervás y Panduro', 'Seguridad y Medio Ambiente', 18, 'Hombre'),
(10019, 'IES Fernando Zóbel', 'Sanidad', 20, 'Prefiere no indicar'),
(10020, 'CIFP N1', 'Informática y Comunicaciones', 22, 'Mujer'),
(10021, 'IES Lorenzo Hervás y Panduro', 'Salud', 21, 'Hombre'),
(10022, 'IES Fernando Zóbel', 'Sanidad', 23, 'Mujer'),
(10023, 'CIFP N1', 'Informática y Comunicaciones', 19, 'Hombre'),
(10024, 'IES Lorenzo Hervás y Panduro', 'Seguridad y Medio Ambiente', 20, 'Mujer'),
(10025, 'IES Fernando Zóbel', 'Salud', 25, 'Hombre'),
(10026, 'CIFP N1', 'Sanidad', 24, 'Mujer'),
(10027, 'IES Lorenzo Hervás y Panduro', 'Informática y Comunicaciones', 18, 'Hombre'),
(10028, 'IES Fernando Zóbel', 'Seguridad y Medio Ambiente', 21, 'Mujer'),
(10029, 'CIFP N1', 'Salud', 20, 'Hombre'),
(10030, 'IES Lorenzo Hervás y Panduro', 'Sanidad', 22, 'Mujer'),
(10031, 'IES Fernando Zóbel', 'Informática y Comunicaciones', 23, 'Hombre'),
(10032, 'CIFP N1', 'Seguridad y Medio Ambiente', 19, 'Mujer'),
(10033, 'IES Lorenzo Hervás y Panduro', 'Salud', 20, 'Hombre'),
(10034, 'IES Fernando Zóbel', 'Sanidad', 21, 'Mujer'),
(10035, 'CIFP N1', 'Informática y Comunicaciones', 24, 'Hombre'),
(10036, 'IES Lorenzo Hervás y Panduro', 'Seguridad y Medio Ambiente', 22, 'Mujer'),
(10037, 'IES Fernando Zóbel', 'Salud', 19, 'Hombre'),
(10038, 'CIFP N1', 'Sanidad', 18, 'Mujer'),
(10039, 'IES Lorenzo Hervás y Panduro', 'Informática y Comunicaciones', 20, 'Hombre'),
(10040, 'IES Fernando Zóbel', 'Seguridad y Medio Ambiente', 25, 'Mujer'),
(10041, 'CIFP N1', 'Salud', 21, 'Hombre'),
(10042, 'IES Lorenzo Hervás y Panduro', 'Sanidad', 23, 'Mujer'),
(10043, 'IES Fernando Zóbel', 'Informática y Comunicaciones', 22, 'Hombre'),
(10044, 'CIFP N1', 'Seguridad y Medio Ambiente', 20, 'Mujer'),
(10045, 'IES Lorenzo Hervás y Panduro', 'Salud', 24, 'Hombre'),
(10046, 'IES Fernando Zóbel', 'Sanidad', 19, 'Mujer'),
(10047, 'CIFP N1', 'Informática y Comunicaciones', 21, 'Hombre'),
(10048, 'IES Lorenzo Hervás y Panduro', 'Seguridad y Medio Ambiente', 18, 'Mujer'),
(10049, 'IES Fernando Zóbel', 'Salud', 20, 'Hombre'),
(10050, 'CIFP N1', 'Sanidad', 23, 'Mujer'),
(10051, 'IES Lorenzo Hervás y Panduro', 'Informática y Comunicaciones', 22, 'Hombre'),
(10052, 'IES Fernando Zóbel', 'Seguridad y Medio Ambiente', 19, 'Mujer'),
(10053, 'CIFP N1', 'Salud', 25, 'Hombre'),
(10054, 'IES Lorenzo Hervás y Panduro', 'Sanidad', 24, 'Mujer'),
(10055, 'IES Fernando Zóbel', 'Informática y Comunicaciones', 20, 'Hombre'),
(10056, 'CIFP N1', 'Seguridad y Medio Ambiente', 21, 'Mujer'),
(10057, 'IES Lorenzo Hervás y Panduro', 'Salud', 18, 'Hombre'),
(10058, 'IES Fernando Zóbel', 'Sanidad', 19, 'Mujer'),
(10059, 'CIFP N1', 'Informática y Comunicaciones', 23, 'Hombre'),
(10060, 'IES Lorenzo Hervás y Panduro', 'Salud', 22, 'Mujer'),
(12000, 'CIFP N1', 'No especificada', 1, 'Mujer'),
(12003, 'IES Fernando Zobel', 'Sanidad', 20, 'Hombre'),
(1001111, 'IES Fernando Zobel', 'Salud', 9, 'Mujer'),
(2147483647, 'IES Fernando Zobel', 'Sanidad', 14, 'Hombre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rolname` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rolname`) VALUES
(1, 'administrador'),
(2, 'participante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sueno`
--

CREATE TABLE `sueno` (
  `cod_participante` int(5) NOT NULL,
  `Sue1` time DEFAULT NULL COMMENT 'Hora habitual de acostarse',
  `Sue2` tinyint(1) DEFAULT NULL COMMENT 'Minutos que tarda en dormirse (Valores 0-3)',
  `Sue3` time DEFAULT NULL COMMENT 'Hora habitual de levantarse',
  `Sue4` decimal(3,1) DEFAULT NULL COMMENT 'Horas dormidas reales por noche',
  `Sue5a` tinyint(1) DEFAULT NULL COMMENT 'No poder conciliar el sueño en < 30 min (0-3)',
  `Sue5b` tinyint(1) DEFAULT NULL COMMENT 'Despertarse durante la noche o madrugada (0-3)',
  `Sue5c` tinyint(1) DEFAULT NULL COMMENT 'Tener que levantarse para ir al baño (0-3)',
  `Sue5d` tinyint(1) DEFAULT NULL COMMENT 'No poder respirar bien (0-3)',
  `Sue5e` tinyint(1) DEFAULT NULL COMMENT 'Toser o roncar ruidosamente (0-3)',
  `Sue5f` tinyint(1) DEFAULT NULL COMMENT 'Sentir frío (0-3)',
  `Sue5g` tinyint(1) DEFAULT NULL COMMENT 'Sentir demasiado calor (0-3)',
  `Sue5h` tinyint(1) DEFAULT NULL COMMENT 'Tener pesadillas (0-3)',
  `Sue5i` tinyint(1) DEFAULT NULL COMMENT 'Sufrir dolores (0-3)',
  `Sue5j` tinyint(1) DEFAULT NULL COMMENT 'Otras razones (Frecuencia) (0-3)',
  `Sue5j_Desc` varchar(255) DEFAULT NULL COMMENT 'Descripción de otras razones',
  `Sue6` tinyint(1) DEFAULT NULL COMMENT 'Calidad subjetiva (0: Muy buena a 3: Muy mala)',
  `Sue7` tinyint(1) DEFAULT NULL COMMENT 'Uso de medicación para dormir (0 a 3)',
  `Sue8` tinyint(1) DEFAULT NULL COMMENT 'Somnolencia diurna (0 a 3)',
  `Sue9` tinyint(1) DEFAULT NULL COMMENT 'Problemas para mantener el entusiasmo (0: Ninguno a 3: Grave)',
  `Sue10` tinyint(1) DEFAULT NULL COMMENT 'Compañero/a de cama (0: No tiene a 3: Misma habitación)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sueno`
--

INSERT INTO `sueno` (`cod_participante`, `Sue1`, `Sue2`, `Sue3`, `Sue4`, `Sue5a`, `Sue5b`, `Sue5c`, `Sue5d`, `Sue5e`, `Sue5f`, `Sue5g`, `Sue5h`, `Sue5i`, `Sue5j`, `Sue5j_Desc`, `Sue6`, `Sue7`, `Sue8`, `Sue9`, `Sue10`) VALUES
(10021, '00:18:02', 33, '08:58:48', 6.3, 0, 3, 1, 0, 1, 0, 1, 0, 1, 0, NULL, 0, 1, 0, 1, 1),
(10022, '23:47:00', 57, '07:38:04', 5.4, 3, 3, 0, 1, 0, 0, 0, 1, 0, 0, NULL, 3, 0, 2, 0, 3),
(10023, '00:54:14', 54, '07:10:23', 4.1, 3, 1, 3, 0, 0, 1, 1, 0, 0, 0, NULL, 3, 0, 2, 2, 2),
(10024, '23:17:26', 51, '06:47:02', 6.5, 1, 3, 2, 1, 1, 1, 1, 1, 1, 0, NULL, 3, 0, 1, 0, 2),
(10025, '01:22:58', 33, '06:02:58', 9.9, 2, 2, 1, 1, 0, 1, 0, 0, 0, 0, NULL, 2, 0, 0, 2, 1),
(10026, '01:05:50', 30, '06:01:32', 8.0, 0, 3, 0, 0, 1, 1, 1, 0, 0, 0, NULL, 0, 0, 1, 2, 1),
(10027, '01:43:45', 46, '09:18:51', 6.5, 2, 2, 3, 1, 0, 0, 1, 0, 1, 0, NULL, 1, 0, 2, 2, 2),
(10028, '22:28:05', 50, '08:36:45', 4.2, 0, 3, 3, 0, 0, 1, 1, 1, 1, 0, NULL, 3, 0, 1, 1, 1),
(10029, '00:27:56', 7, '07:19:19', 9.8, 2, 3, 2, 0, 1, 0, 1, 1, 0, 0, NULL, 2, 0, 2, 2, 2),
(10030, '23:08:55', 45, '08:47:59', 8.4, 2, 2, 1, 0, 0, 1, 1, 1, 0, 0, NULL, 0, 1, 0, 1, 2),
(10031, '22:02:13', 50, '06:18:45', 8.4, 2, 0, 3, 1, 1, 1, 1, 0, 0, 0, NULL, 0, 0, 2, 1, 3),
(10032, '01:52:59', 11, '08:29:42', 6.9, 3, 1, 3, 0, 1, 0, 0, 0, 0, 0, NULL, 3, 1, 0, 1, 0),
(10033, '23:07:44', 25, '06:08:45', 5.3, 1, 0, 1, 1, 0, 0, 0, 0, 1, 0, NULL, 2, 1, 1, 0, 3),
(10034, '00:53:06', 19, '06:32:31', 7.9, 1, 1, 0, 0, 1, 0, 1, 0, 1, 0, NULL, 1, 0, 2, 0, 3),
(10035, '22:35:46', 30, '08:57:29', 7.4, 2, 0, 0, 1, 1, 1, 1, 1, 1, 0, NULL, 2, 0, 0, 1, 2),
(10036, '01:12:47', 30, '09:03:09', 9.6, 1, 2, 2, 1, 1, 1, 1, 0, 1, 0, NULL, 1, 0, 2, 0, 3),
(10037, '23:12:01', 42, '07:38:06', 9.6, 0, 3, 0, 1, 0, 1, 0, 1, 0, 0, NULL, 0, 1, 0, 1, 0),
(10038, '00:10:30', 24, '06:38:48', 9.4, 2, 2, 0, 0, 0, 0, 1, 0, 1, 0, NULL, 2, 1, 2, 1, 0),
(10039, '01:08:23', 54, '06:39:33', 8.1, 2, 3, 0, 1, 1, 1, 1, 0, 1, 0, NULL, 0, 0, 1, 0, 1),
(10040, '23:22:38', 45, '08:10:32', 8.3, 2, 3, 3, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 1, 2, 0, 0),
(10041, '23:56:46', 59, '07:45:27', 7.3, 0, 0, 2, 0, 0, 0, 0, 1, 0, 0, NULL, 0, 0, 0, 1, 2),
(10042, '22:25:29', 22, '06:56:27', 7.4, 0, 2, 1, 1, 1, 0, 0, 0, 1, 0, NULL, 2, 0, 0, 1, 0),
(10043, '01:04:17', 49, '08:44:52', 5.1, 0, 2, 0, 0, 0, 0, 1, 0, 0, 0, NULL, 2, 1, 1, 2, 3),
(10044, '01:08:02', 57, '07:35:34', 5.2, 2, 3, 0, 1, 1, 1, 1, 1, 0, 0, NULL, 0, 1, 1, 2, 0),
(10045, '23:10:28', 21, '08:07:58', 7.0, 3, 0, 1, 1, 0, 0, 0, 1, 1, 0, NULL, 2, 1, 0, 1, 3),
(10046, '23:36:21', 41, '06:26:48', 9.4, 3, 0, 1, 1, 0, 1, 1, 1, 1, 0, NULL, 2, 1, 1, 1, 2),
(10047, '23:38:21', 10, '06:52:36', 9.7, 0, 1, 0, 0, 0, 0, 1, 1, 0, 0, NULL, 3, 1, 0, 2, 2),
(10048, '22:54:27', 55, '09:14:21', 4.5, 2, 0, 3, 1, 1, 0, 0, 1, 1, 0, NULL, 2, 0, 0, 0, 3),
(10049, '22:56:05', 53, '08:21:17', 7.3, 2, 0, 3, 1, 0, 1, 0, 1, 0, 0, NULL, 2, 1, 0, 1, 2),
(10050, '22:31:14', 8, '09:20:24', 6.9, 3, 0, 2, 1, 1, 1, 1, 1, 0, 0, NULL, 0, 0, 0, 0, 3),
(12000, '20:18:00', 0, '19:19:00', 1.0, 0, 0, 0, 0, 3, 0, 0, 2, 0, 1, '', 3, 2, 2, 1, 1),
(12003, '21:51:00', 0, '20:53:00', 1.0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, '', 1, 2, 2, 1, 0),
(1001111, '11:07:00', 0, '11:07:00', 0.1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, '1', 3, 2, 2, 1, 1),
(2147483647, '21:06:00', 1, '19:09:00', 12.0, 0, 0, 1, 1, 0, 0, 2, 1, 0, 0, '12', 0, 1, 0, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_rol`
--

CREATE TABLE `user_rol` (
  `id_user` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_rol`
--

INSERT INTO `user_rol` (`id_user`, `id_rol`) VALUES
(1, 1),
(2, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_user`, `username`, `password`) VALUES
(1, 'Marco', 'marco1234'),
(2, 'Carlos', 'carlos1234'),
(3, 'encuesta', 'encuestado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`cod_participante`);

--
-- Indices de la tabla `alimentacion`
--
ALTER TABLE `alimentacion`
  ADD PRIMARY KEY (`cod_participante`);

--
-- Indices de la tabla `antropometrico`
--
ALTER TABLE `antropometrico`
  ADD PRIMARY KEY (`cod_participante`);

--
-- Indices de la tabla `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`cod_participante`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `sueno`
--
ALTER TABLE `sueno`
  ADD PRIMARY KEY (`cod_participante`);

--
-- Indices de la tabla `user_rol`
--
ALTER TABLE `user_rol`
  ADD PRIMARY KEY (`id_user`,`id_rol`),
  ADD KEY `fk_rol_user` (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `fk_part_actividad` FOREIGN KEY (`cod_participante`) REFERENCES `participante` (`cod_participante`);

--
-- Filtros para la tabla `alimentacion`
--
ALTER TABLE `alimentacion`
  ADD CONSTRAINT `fk_part_alimentacion` FOREIGN KEY (`cod_participante`) REFERENCES `participante` (`cod_participante`);

--
-- Filtros para la tabla `antropometrico`
--
ALTER TABLE `antropometrico`
  ADD CONSTRAINT `fk_part_antropometrico` FOREIGN KEY (`cod_participante`) REFERENCES `participante` (`cod_participante`);

--
-- Filtros para la tabla `sueno`
--
ALTER TABLE `sueno`
  ADD CONSTRAINT `fk_part_sueno` FOREIGN KEY (`cod_participante`) REFERENCES `participante` (`cod_participante`);

--
-- Filtros para la tabla `user_rol`
--
ALTER TABLE `user_rol`
  ADD CONSTRAINT `fk_rol_user` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_rol` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
