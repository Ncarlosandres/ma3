-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-02-2021 a las 00:08:30
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `excel_horario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos_justificativos`
--

CREATE TABLE `articulos_justificativos` (
  `id` int(11) NOT NULL,
  `numero_articulo` int(4) NOT NULL,
  `dias_justificados` int(3) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `articulos_justificativos`
--

INSERT INTO `articulos_justificativos` (`id`, `numero_articulo`, `dias_justificados`, `descripcion`) VALUES
(1, 1212, 1, 'lalala'),
(2, 312, 3, '100 de salame'),
(3, 1268, 9, 'rataloca'),
(4, 124, 14, 'San Patricio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ausentes`
--

CREATE TABLE `ausentes` (
  `id` int(11) NOT NULL,
  `Legajo` int(5) NOT NULL,
  `Fecha` date NOT NULL,
  `Estado` varchar(15) NOT NULL,
  `Obsevaciones` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ausentes`
--

INSERT INTO `ausentes` (`id`, `Legajo`, `Fecha`, `Estado`, `Obsevaciones`) VALUES
(1, 1002, '2020-02-04', 'Injustificado', ''),
(2, 1004, '2020-02-04', 'Injustificado', ''),
(3, 1010, '2020-02-04', 'Injustificado', ''),
(4, 1013, '2020-02-04', 'Injustificado', ''),
(5, 1016, '2020-02-04', 'Injustificado', ''),
(6, 1000, '2020-02-06', 'Injustificado', ''),
(7, 1001, '2020-02-06', 'Injustificado', ''),
(8, 1002, '2020-02-06', 'Injustificado', ''),
(9, 1003, '2020-02-06', 'Injustificado', ''),
(10, 1004, '2020-02-06', 'Injustificado', ''),
(11, 1005, '2020-02-06', 'Injustificado', ''),
(12, 1006, '2020-02-06', 'Injustificado', ''),
(13, 1007, '2020-02-06', 'Injustificado', ''),
(14, 1009, '2020-02-06', 'Injustificado', ''),
(15, 1010, '2020-02-06', 'Injustificado', ''),
(16, 1011, '2020-02-06', 'Injustificado', ''),
(17, 1012, '2020-02-06', 'Injustificado', ''),
(18, 1013, '2020-02-06', 'Injustificado', ''),
(19, 1014, '2020-02-06', 'Injustificado', ''),
(20, 1015, '2020-02-06', 'Injustificado', ''),
(21, 1000, '2020-02-05', 'Injustificado', ''),
(22, 1001, '2020-02-05', 'Injustificado', ''),
(23, 1002, '2020-02-05', 'Injustificado', ''),
(24, 1003, '2020-02-05', 'Injustificado', ''),
(25, 1004, '2020-02-05', 'Injustificado', ''),
(26, 1005, '2020-02-05', 'Injustificado', ''),
(27, 1006, '2020-02-05', 'Injustificado', ''),
(28, 1007, '2020-02-05', 'Injustificado', ''),
(29, 1009, '2020-02-05', 'Injustificado', ''),
(30, 1010, '2020-02-05', 'Injustificado', ''),
(31, 1011, '2020-02-05', 'Injustificado', ''),
(32, 1012, '2020-02-05', 'Injustificado', ''),
(33, 1013, '2020-02-05', 'Injustificado', ''),
(34, 1014, '2020-02-05', 'Injustificado', ''),
(35, 1015, '2020-02-05', 'Injustificado', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias_cargados`
--

CREATE TABLE `dias_cargados` (
  `fecha` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dias_cargados`
--

INSERT INTO `dias_cargados` (`fecha`) VALUES
('2020-02-04'),
('2020-02-05'),
('2020-02-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llegadas_tardes`
--

CREATE TABLE `llegadas_tardes` (
  `id` int(3) NOT NULL,
  `legajo` int(4) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `llegadas_tardes`
--

INSERT INTO `llegadas_tardes` (`id`, `legajo`, `fecha`, `hora`) VALUES
(1, 1005, '2020-02-04', '07:57:00'),
(2, 1006, '2020-02-04', '07:55:00'),
(3, 1014, '2020-02-04', '07:06:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `legajo` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `horaentrada` time NOT NULL,
  `horasalida` time NOT NULL,
  `Lun` tinyint(1) NOT NULL,
  `Mar` tinyint(1) NOT NULL,
  `Mie` tinyint(1) NOT NULL,
  `Jue` tinyint(1) NOT NULL,
  `Vie` tinyint(1) NOT NULL,
  `asistencia` int(2) NOT NULL,
  `tarde` int(2) NOT NULL,
  `falta` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `legajo`, `nombre`, `horaentrada`, `horasalida`, `Lun`, `Mar`, `Mie`, `Jue`, `Vie`, `asistencia`, `tarde`, `falta`) VALUES
(1, 1000, 'Adrian Fernandez', '14:00:00', '18:20:00', 0, 0, 0, 0, 0, 1, 0, 2),
(2, 1001, 'Luis Puertas', '07:45:00', '12:05:00', 0, 0, 0, 0, 0, 1, 0, 2),
(3, 1002, 'Sergio Acuta', '07:45:00', '12:45:00', 0, 0, 0, 0, 0, 0, 0, 3),
(4, 1003, 'Angel Villa', '07:45:00', '12:05:00', 0, 0, 0, 0, 0, 1, 0, 2),
(5, 1004, 'Raul Hilario Martinez', '07:45:00', '12:05:00', 0, 0, 0, 0, 0, 0, 0, 3),
(6, 1005, 'Emilia Lopez Mezansa', '07:45:00', '12:05:00', 0, 0, 0, 0, 0, 1, 1, 2),
(7, 1006, 'Margarita Romero', '07:45:00', '12:05:00', 0, 0, 0, 0, 0, 1, 1, 2),
(8, 1007, 'Monica Isabel Barrionuevo', '07:45:00', '12:05:00', 0, 0, 0, 0, 0, 1, 0, 2),
(9, 1009, 'Silveria Gaspar', '14:00:00', '18:20:00', 0, 0, 0, 0, 0, 1, 0, 2),
(10, 1010, 'Lidia Elizabeth Posta', '14:00:00', '18:20:00', 0, 0, 0, 0, 0, 0, 0, 3),
(11, 1011, 'Leticia Elizabeth Guzman', '07:45:00', '12:05:00', 0, 0, 0, 0, 0, 1, 0, 2),
(12, 1012, 'Sebastian Dario Zerda', '07:00:00', '13:00:00', 0, 0, 0, 0, 0, 1, 0, 2),
(13, 1013, 'Rosa Malvina Villagrand Martinez', '13:00:00', '19:00:00', 0, 0, 0, 0, 0, 0, 0, 3),
(14, 1014, 'Beatriz Salva', '07:00:00', '13:00:00', 0, 0, 0, 0, 0, 1, 1, 2),
(15, 1015, 'Olga Noemi Yapura', '13:00:00', '19:00:00', 0, 0, 0, 0, 0, 1, 0, 2),
(16, 1016, 'Maria Elena Choque', '14:00:00', '18:20:00', 0, 0, 0, 0, 0, 2, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentes`
--

CREATE TABLE `presentes` (
  `ID` int(11) NOT NULL,
  `Legajo` int(5) NOT NULL,
  `Fecha` varchar(15) NOT NULL,
  `Hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `presentes`
--

INSERT INTO `presentes` (`ID`, `Legajo`, `Fecha`, `Hora`) VALUES
(1, 1000, '2020-02-04', '07:56:00'),
(2, 1001, '2020-02-04', '07:46:00'),
(3, 1003, '2020-02-04', '07:38:00'),
(4, 1005, '2020-02-04', '07:57:00'),
(5, 1006, '2020-02-04', '07:55:00'),
(6, 1007, '2020-02-04', '07:48:00'),
(7, 1009, '2020-02-04', '08:03:00'),
(8, 1011, '2020-02-04', '07:27:00'),
(9, 1012, '2020-02-04', '07:02:00'),
(10, 1014, '2020-02-04', '07:06:00'),
(11, 1015, '2020-02-04', '07:05:00'),
(12, 1016, '2020-02-06', '07:49:00'),
(13, 1016, '2020-02-05', '07:49:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporal`
--

CREATE TABLE `temporal` (
  `id` int(5) NOT NULL,
  `legajo` int(5) NOT NULL,
  `fecha` varchar(15) NOT NULL,
  `hora` time NOT NULL,
  `suceso` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos_justificativos`
--
ALTER TABLE `articulos_justificativos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ausentes`
--
ALTER TABLE `ausentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dias_cargados`
--
ALTER TABLE `dias_cargados`
  ADD PRIMARY KEY (`fecha`);

--
-- Indices de la tabla `llegadas_tardes`
--
ALTER TABLE `llegadas_tardes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `presentes`
--
ALTER TABLE `presentes`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `temporal`
--
ALTER TABLE `temporal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos_justificativos`
--
ALTER TABLE `articulos_justificativos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ausentes`
--
ALTER TABLE `ausentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `llegadas_tardes`
--
ALTER TABLE `llegadas_tardes`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT de la tabla `presentes`
--
ALTER TABLE `presentes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `temporal`
--
ALTER TABLE `temporal`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
