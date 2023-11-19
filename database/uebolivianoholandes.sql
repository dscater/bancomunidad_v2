-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-11-2022 a las 13:23:38
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `uebolivianoholandes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(80) NOT NULL,
  `Paterno` varchar(80) NOT NULL,
  `Materno` varchar(80) NOT NULL,
  `Direccion` varchar(80) NOT NULL,
  `FechaNacimiento` varchar(80) NOT NULL,
  `LugarNacimiento` varchar(80) NOT NULL,
  `Tutor` varchar(80) NOT NULL,
  `DireccionTutor` varchar(80) NOT NULL,
  `TelefonoRef` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`ID`, `Nombre`, `Paterno`, `Materno`, `Direccion`, `FechaNacimiento`, `LugarNacimiento`, `Tutor`, `DireccionTutor`, `TelefonoRef`) VALUES
(10018493, 'Lenz', 'Callisaya', 'Cespedes', 'Satelite', '16/06/1999', 'La paz', 'Mercedes', 'Villa Copacabana', '67168945'),
(111, 'merceddes', 'arce', 'calisaya', 'villa copacabana', 'la paz', 'la pza', 'moica', 'villa copacabna', '1111111'),
(111, 'qqqq', 'qq', 'qq', 'qq', 'qq', 'qq', 'qq', 'qq', '111'),
(111, 'd', 'ad', 'ad', 'adcf', '21', 'dw', 'wfw', 'wfwf', '131313'),
(111, 'd', 'ad', 'ad', 'adcf', '21', 'dw', 'wfw', 'wfwf', '131313'),
(111, 'd', 'ad', 'ad', 'adcf', '21', 'dw', 'wfw', 'wfwf', '131313'),
(111, 'd', 'ad', 'ad', 'adcf', '21', 'dw', 'wfw', 'wfwf', '131313'),
(111, 'd', 'ad', 'ad', 'adcf', '21', 'dw', 'wfw', 'wfwf', '131313'),
(111, 'd', 'ad', 'ad', 'adcf', '21', 'dw', 'wfw', 'wfwf', '131313'),
(1113131, 'edwdwdw', 'dwdwdw', 'dwdwd', 'wdwdw', 'dwdw', 'dwdwd', 'wdwdwd', 'wdwdw', 'dwdw'),
(11233, 'wdwc', 'cwcw', 'cwc', 'cwcwe', 'c12e', 'wdw', 'xqwq', 'qcqw', 'wcwq'),
(111111111, '2', 'dqfd', 'wf', 'fw', 'fw', 'wf', 'fw', 'fw', 'wf'),
(111111111, '2', 'dqfd', 'wf', 'fw', 'fw', 'wf', 'fw', 'fw', 'wf'),
(12131331, 'Maribel', 'Arce', 'Cespedes', 'Villa Copacabana', '27/11/2000', 'La Paz', 'Monica', 'Villa Copacabana', '67149856'),
(11, '2d2', '2df2', '2e2', 'f32', '2f2', 'f32f', 'f32', '3f2', '3f23'),
(1122, 'qwas', 'asxsax', 'assa', 'saxs', 'sxs', 'sxas', 'saxs', 'saxs', 'assx'),
(1111123, 'wassac', 'asc', 'scaas', 'sca', 'sc', 'sc', 'sac', 'cas', 'asc'),
(0, 'wgweg', 'wgwegw', 'gweg', 'wegwe', 'egwegw', 'egweg', 'wegweg', 'wegweg', 'wegew'),
(0, 'qf', 'qfqwf', 'wqfqw', 'qwfqwf', 'qwfqwf', 'qwfqwf', 'qwfqfqw', 'fqwfqwf', 'qwfqwf'),
(0, 'qf', 'qfqwf', 'wqfqw', 'qwfqwf', 'qwfqwf', 'qwfqwf', 'qwfqfqw', 'fqwfqwf', 'qwfqwf'),
(0, 'qwfqw', 'qwfqwfq', 'wfqwfqw', 'fqwfqwf', 'qwfqwfqw', 'fqfqw', 'fqwfqwf', 'qwfqwf', 'qwfqf'),
(0, 'qwfqw', 'qwfqwfq', 'wfqwfqw', 'fqwfqwf', 'qwfqwfqw', 'fqfqw', 'fqwfqwf', 'qwfqwf', 'qwfqf'),
(0, 'qf', 'qfqwf', 'wqfqw', 'qwfqwf', 'qwfqwf', 'qwfqwf', 'qwfqfqw', 'fqwfqwf', 'qwfqwf'),
(0, 'wvwev', 'wvwewe', 'vwevwe', 'vwevw', 'evwewe', 'vwevw', 'evwev', 'wevwv', 'ewvew');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ci` varchar(155) NOT NULL,
  `nombre` varchar(155) NOT NULL,
  `paterno` varchar(155) NOT NULL,
  `materno` varchar(155) DEFAULT NULL,
  `cargo_id` bigint(20) UNSIGNED NOT NULL,
  `regional_id` bigint(20) UNSIGNED NOT NULL,
  `agencia_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_registro` date NOT NULL,
  `usuario` varchar(155) NOT NULL,
  `contrasenia` varchar(155) NOT NULL,
  `tipo` varchar(155) NOT NULL,
  `acceso` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `ci`, `nombre`, `paterno`, `materno`, `cargo_id`, `regional_id`, `agencia_id`, `fecha_registro`, `usuario`, `contrasenia`, `tipo`, `acceso`) VALUES
(3, '222', 'JUAN', 'PERES', 'PERES', 1, 1, 1, '2022-11-29', '222', 'JUAN', '1', '1'),
(4, '333', 'CARLOS', 'SANCHEZ', 'SANCHEZ', 1, 1, 1, '2022-11-30', '333', 'CARLOS', '1', '0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
