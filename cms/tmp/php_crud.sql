-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-02-2019 a las 14:23:00
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `php_crud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_asistencia`
--

CREATE TABLE `tbl_asistencia` (
  `id` int(11) NOT NULL,
  `presente` tinyint(4) NOT NULL,
  `ausente` tinyint(4) NOT NULL,
  `asistencia_fecha` date NOT NULL,
  `estudiante_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla Asistencia';

--
-- Volcado de datos para la tabla `tbl_asistencia`
--

INSERT INTO `tbl_asistencia` (`id`, `presente`, `ausente`, `asistencia_fecha`, `estudiante_id`) VALUES
(4, 0, 1, '2019-12-01', 11),
(5, 0, 1, '2019-12-01', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estudiante`
--

CREATE TABLE `tbl_estudiante` (
  `id` int(11) NOT NULL,
  `nombres` varchar(55) CHARACTER SET latin1 NOT NULL,
  `rol_numero` int(11) NOT NULL,
  `fecha_estudiante` date NOT NULL,
  `clase` varchar(55) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla Estudiante';

--
-- Volcado de datos para la tabla `tbl_estudiante`
--

INSERT INTO `tbl_estudiante` (`id`, `nombres`, `rol_numero`, `fecha_estudiante`, `clase`) VALUES
(11, 'Pedro', 5, '2001-12-11', 'PHP'),
(12, 'Juan', 6, '2019-01-27', 'PHP');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_asistencia`
--
ALTER TABLE `tbl_asistencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`estudiante_id`);

--
-- Indices de la tabla `tbl_estudiante`
--
ALTER TABLE `tbl_estudiante`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_asistencia`
--
ALTER TABLE `tbl_asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_estudiante`
--
ALTER TABLE `tbl_estudiante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_asistencia`
--
ALTER TABLE `tbl_asistencia`
  ADD CONSTRAINT `tbl_asistencia_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `tbl_estudiante` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
