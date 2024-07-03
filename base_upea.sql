-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-07-2023 a las 15:02:36
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `base_upea`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `ci` char(15) DEFAULT NULL,
  `expedido` enum('LP','OR','CBBA','PT','SC','BN','TR','PN','CH') DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `nombre` char(50) DEFAULT NULL,
  `paterno` char(20) DEFAULT NULL,
  `materno` char(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `celular` int(8) DEFAULT NULL,
  `estados` enum('A','I') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `ci`, `expedido`, `fecha_nac`, `nombre`, `paterno`, `materno`, `email`, `celular`, `estados`) VALUES
(1, '9205705', 'LP', '2022-08-18', 'Edwin', 'Alanoca', 'Ramirez', 'persona1@gmail.com', 67109724, '1'),
(2, '10000002', 'OR', '2022-08-18', 'Juan', 'Paterno2', 'Materno2', 'persona2@gmail.com', 22222222, '1'),
(3, '10000003', 'CBBA', '2022-08-18', 'Maria', 'Paterno3', 'Materno3', 'persona3@gmail.com', 33333333, '1'),
(4, '10000004', 'PT', '2022-08-18', 'Luis', 'Paterno4', 'Materno4', 'persona4@gmail.com', 44444444, '1'),
(5, '10000005', 'SC', '2022-08-18', 'Pedro', 'Paterno5', 'Materno5', 'persona5@gmail.com', 55555555, '1'),
(6, '10000006', 'BN', '2022-08-18', 'Ximena', 'Paterno6', 'Materno6', 'persona6@gmail.com', 66666666, '1'),
(7, '10000007', 'TR', '2022-08-18', 'Laura', 'Paterno7', 'Materno7', 'persona7@gmail.com', 77777777, '1'),
(8, '10000008', 'PN', '2022-08-18', 'Anai', 'Paterno8', 'Materno8', 'persona8@gmail.com', 88888888, '1'),
(9, '10000009', 'TR', '2022-08-18', 'Rita', 'Paterno9', 'Materno9', 'persona9@gmail.com', 99999999, '1'),
(10, '10000010', 'PN', '2022-08-18', 'Ramon', 'Paterno10', 'Materno10', 'persona10@gmail.com', 12121212, '1');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_persona`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_persona` (
`id` int(11)
,`ci` char(15)
,`expedido` enum('LP','OR','CBBA','PT','SC','BN','TR','PN','CH')
,`fecha_nac` date
,`nombre` char(50)
,`paterno` char(20)
,`materno` char(30)
,`email` varchar(50)
,`celular` int(8)
,`estados` enum('A','I')
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_persona`
--
DROP TABLE IF EXISTS `vista_persona`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_persona`  AS SELECT `persona`.`id` AS `id`, `persona`.`ci` AS `ci`, `persona`.`expedido` AS `expedido`, `persona`.`fecha_nac` AS `fecha_nac`, `persona`.`nombre` AS `nombre`, `persona`.`paterno` AS `paterno`, `persona`.`materno` AS `materno`, `persona`.`email` AS `email`, `persona`.`celular` AS `celular`, `persona`.`estados` AS `estados` FROM `persona``persona`  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
