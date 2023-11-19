-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-11-2022 a las 13:23:00
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
-- Base de datos: `bancomunidad_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso_sistemas`
--

CREATE TABLE `acceso_sistemas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `funcionario_id` bigint(20) UNSIGNED NOT NULL,
  `sistema_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `acceso_sistemas`
--

INSERT INTO `acceso_sistemas` (`id`, `funcionario_id`, `sistema_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2022-11-30 13:22:03', '2022-11-30 13:22:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agencias`
--

CREATE TABLE `agencias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `agencias`
--

INSERT INTO `agencias` (`id`, `nombre`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'AGENCIA 1', '2022-11-03', '2022-11-03 19:10:30', '2022-11-03 19:10:30'),
(2, 'AGENCIA  2', '2022-11-03', '2022-11-03 19:10:42', '2022-11-03 19:10:42'),
(4, 'AGENCIA 3', '2022-11-03', '2022-11-03 16:10:33', '2022-11-03 16:10:33'),
(6, 'AGENCIA 11', '2022-11-13', '2022-11-14 02:45:43', '2022-11-14 02:45:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacions`
--

CREATE TABLE `asignacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `funcionario_id` bigint(20) UNSIGNED NOT NULL,
  `sistema_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_detalles`
--

CREATE TABLE `asignacion_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asignacion_id` bigint(20) UNSIGNED NOT NULL,
  `perfil_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departamento` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `nombre`, `departamento`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'CARGO 1', 'ADM Y RRHH', '2022-11-03', '2022-11-03 19:03:55', '2022-11-03 19:03:55'),
(2, 'CARGO 2', 'OPERACIONES', '2022-11-03', '2022-11-03 19:04:25', '2022-11-03 19:04:25'),
(3, 'CARGO 3', 'AUDITORÍA INTERNA', '2022-11-03', '2022-11-03 19:04:41', '2022-11-03 19:04:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formularios`
--

CREATE TABLE `formularios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo` bigint(20) NOT NULL,
  `fecha_solicitud` date DEFAULT NULL,
  `fecha_respuesta` date DEFAULT NULL,
  `hora_solicitud` time DEFAULT NULL,
  `hora_respuesta` time DEFAULT NULL,
  `funcionario_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_acceso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `agencia_origen` bigint(20) UNSIGNED DEFAULT NULL,
  `agencia_destino` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ci` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo_id` bigint(20) UNSIGNED NOT NULL,
  `regional_id` bigint(20) UNSIGNED NOT NULL,
  `agencia_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `ci`, `nombre`, `paterno`, `materno`, `cargo_id`, `regional_id`, `agencia_id`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(5, '222', 'JUAN', 'PERES', 'PERES', 1, 2, 2, '2022-11-29', '2022-11-30 01:12:59', '2022-11-30 13:18:59'),
(6, '333', 'CARLOS', 'SANCHEZ', 'SANCHEZ', 1, 1, 1, '2022-11-30', '2022-11-30 13:18:53', '2022-11-30 13:18:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2022_11_02_152307_create_cargos_table', 1),
(4, '2022_11_02_152415_create_agencias_table', 1),
(5, '2022_11_02_152436_create_regionals_table', 1),
(6, '2022_11_02_152437_create_funcionarios_table', 1),
(7, '2022_11_02_152454_create_sistemas_table', 1),
(8, '2022_11_02_152502_create_perfils_table', 1),
(9, '2022_11_02_152516_create_asignacions_table', 1),
(10, '2022_11_02_152536_create_acceso_sistemas_table', 1),
(11, '2022_11_02_152546_create_formularios_table', 1),
(12, '2022_11_02_154113_create_asignacion_detalles_table', 1),
(13, '2022_11_03_123543_create_perfil_sistemas_table', 2),
(14, '2022_11_22_190824_create_opcion_sistemas_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opcion_sistemas`
--

CREATE TABLE `opcion_sistemas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sistema_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `opcion_sistemas`
--

INSERT INTO `opcion_sistemas` (`id`, `sistema_id`, `nombre`, `created_at`, `updated_at`) VALUES
(4, 1, 'opcion sistema 1', '2022-11-22 23:36:10', '2022-11-22 23:36:10'),
(5, 1, 'opcion 2 sistema 1', '2022-11-22 23:36:10', '2022-11-22 23:36:10'),
(6, 4, 'opcion sistema 3', '2022-11-22 23:36:28', '2022-11-22 23:36:28'),
(7, 4, 'opcion 2 sistema 3', '2022-11-22 23:36:28', '2022-11-22 23:36:28'),
(20, 7, 'opcion nueva', '2022-11-22 23:41:30', '2022-11-22 23:41:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfils`
--

CREATE TABLE `perfils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `perfils`
--

INSERT INTO `perfils` (`id`, `nombre`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(3, 'PERFIL 1', '2022-11-03', '2022-11-03 16:59:07', '2022-11-03 16:59:07'),
(5, 'PERFIL 2', '2022-11-03', '2022-11-03 16:59:28', '2022-11-03 16:59:28'),
(6, 'PERFIL 3', '2022-11-03', '2022-11-03 17:56:26', '2022-11-03 17:56:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_sistemas`
--

CREATE TABLE `perfil_sistemas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `perfil_id` bigint(20) UNSIGNED NOT NULL,
  `sistema_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `perfil_sistemas`
--

INSERT INTO `perfil_sistemas` (`id`, `perfil_id`, `sistema_id`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2022-11-03', '2022-11-03 16:59:37', '2022-11-03 16:59:37'),
(2, 5, 3, '2022-11-03', '2022-11-03 17:02:53', '2022-11-03 17:02:53'),
(3, 6, 3, '2022-11-03', '2022-11-03 17:56:30', '2022-11-03 17:56:30'),
(4, 5, 7, '2022-11-22', '2022-11-22 23:48:52', '2022-11-22 23:48:52'),
(5, 5, 1, '2022-11-22', '2022-11-23 00:05:44', '2022-11-23 00:05:44'),
(6, 6, 1, '2022-11-22', '2022-11-23 00:05:49', '2022-11-23 00:05:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regionals`
--

CREATE TABLE `regionals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `regionals`
--

INSERT INTO `regionals` (`id`, `nombre`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'REGIONAL 1', '2022-11-03', '2022-11-03 19:11:29', '2022-11-03 19:11:39'),
(2, 'REGIONAL 2', '2022-11-03', '2022-11-03 19:11:42', '2022-11-03 19:11:42'),
(4, 'REGIONAL 3', '2022-11-03', '2022-11-03 19:53:17', '2022-11-03 19:53:17'),
(6, 'REGIONAL 13', '2022-11-13', '2022-11-14 02:45:41', '2022-11-14 02:46:00'),
(7, 'REGIONAL 4', '2022-11-13', '2022-11-14 03:17:44', '2022-11-14 03:17:44'),
(8, 'REGIONAL 14', '2022-11-16', '2022-11-16 18:14:06', '2022-11-16 18:14:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sistemas`
--

CREATE TABLE `sistemas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objetivo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_produccion` date NOT NULL,
  `empresa_proveedora` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sistemas`
--

INSERT INTO `sistemas` (`id`, `nombre`, `objetivo`, `version`, `tipo`, `fecha_produccion`, `empresa_proveedora`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'SISTEMA 1', 'OBJETIVO DEL SISTEMA 1', '1.0.0', 'EXTERNO', '2022-01-03', 'PROVEEDOR', '2022-11-03', '2022-11-03 16:29:03', '2022-11-03 16:29:30'),
(3, 'SISTEMA 2', 'OBJETIVO SISTEMA 2', '1.1', 'INTERNO', '2022-04-04', '', '2022-11-03', '2022-11-03 17:02:46', '2022-11-03 17:02:46'),
(4, 'SISTEMA 3', 'OBJETIVO DE PRUEBA 3', '11', 'EXTERNO', '2022-11-13', 'EMPRESA PROVEEDORA', '2022-11-13', '2022-11-14 03:36:58', '2022-11-14 03:36:58'),
(7, 'SISTEMA CON OPCIONES', 'CREAR SISTEMA CON OPCIONES', '1', 'EXTERNO', '2022-11-22', 'EMPRESA PROVEEDORA', '2022-11-22', '2022-11-22 23:38:14', '2022-11-22 23:38:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `password`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'usti', '$2y$10$5DhY.JD1Us1lKPaGrsqBP.soX4zUY6apepwbwhOVhybcVbyaVEE8.', 'TI', NULL, NULL),
(2, 'usseguridad', '$2y$10$5DhY.JD1Us1lKPaGrsqBP.soX4zUY6apepwbwhOVhybcVbyaVEE8.', 'SEGURIDAD DE LA INFORMACIÓN', NULL, NULL),
(3, 'ussistemas', '$2y$10$5DhY.JD1Us1lKPaGrsqBP.soX4zUY6apepwbwhOVhybcVbyaVEE8.', 'SISTEMAS', NULL, NULL),
(4, 'usanalista', '$2y$10$5DhY.JD1Us1lKPaGrsqBP.soX4zUY6apepwbwhOVhybcVbyaVEE8.', 'ANALISTA DE SEGURIDAD', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso_sistemas`
--
ALTER TABLE `acceso_sistemas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acceso_sistemas_funcionario_id_foreign` (`funcionario_id`),
  ADD KEY `acceso_sistemas_sistema_id_foreign` (`sistema_id`);

--
-- Indices de la tabla `agencias`
--
ALTER TABLE `agencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asignacions`
--
ALTER TABLE `asignacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asignacions_funcionario_id_foreign` (`funcionario_id`),
  ADD KEY `asignacions_sistema_id_foreign` (`sistema_id`);

--
-- Indices de la tabla `asignacion_detalles`
--
ALTER TABLE `asignacion_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asignacion_detalles_asignacion_id_foreign` (`asignacion_id`),
  ADD KEY `asignacion_detalles_perfil_id_foreign` (`perfil_id`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formularios`
--
ALTER TABLE `formularios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formularios_funcionario_id_foreign` (`funcionario_id`),
  ADD KEY `formularios_cargo_id_foreign` (`cargo_id`),
  ADD KEY `formularios_agencia_origen_foreign` (`agencia_origen`),
  ADD KEY `formularios_agencia_destino_foreign` (`agencia_destino`);

--
-- Indices de la tabla `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funcionarios_cargo_id_foreign` (`cargo_id`),
  ADD KEY `funcionarios_regional_id_foreign` (`regional_id`),
  ADD KEY `funcionarios_agencia_id_foreign` (`agencia_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `opcion_sistemas`
--
ALTER TABLE `opcion_sistemas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `opcion_sistemas_sistema_id_foreign` (`sistema_id`);

--
-- Indices de la tabla `perfils`
--
ALTER TABLE `perfils`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfil_sistemas`
--
ALTER TABLE `perfil_sistemas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perfil_sistemas_perfil_id_foreign` (`perfil_id`),
  ADD KEY `perfil_sistemas_sistema_id_foreign` (`sistema_id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `regionals`
--
ALTER TABLE `regionals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sistemas`
--
ALTER TABLE `sistemas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acceso_sistemas`
--
ALTER TABLE `acceso_sistemas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `agencias`
--
ALTER TABLE `agencias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `asignacions`
--
ALTER TABLE `asignacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asignacion_detalles`
--
ALTER TABLE `asignacion_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `formularios`
--
ALTER TABLE `formularios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `opcion_sistemas`
--
ALTER TABLE `opcion_sistemas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `perfils`
--
ALTER TABLE `perfils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `perfil_sistemas`
--
ALTER TABLE `perfil_sistemas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `regionals`
--
ALTER TABLE `regionals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `sistemas`
--
ALTER TABLE `sistemas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acceso_sistemas`
--
ALTER TABLE `acceso_sistemas`
  ADD CONSTRAINT `acceso_sistemas_funcionario_id_foreign` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`id`),
  ADD CONSTRAINT `acceso_sistemas_sistema_id_foreign` FOREIGN KEY (`sistema_id`) REFERENCES `sistemas` (`id`);

--
-- Filtros para la tabla `asignacions`
--
ALTER TABLE `asignacions`
  ADD CONSTRAINT `asignacions_funcionario_id_foreign` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`id`),
  ADD CONSTRAINT `asignacions_sistema_id_foreign` FOREIGN KEY (`sistema_id`) REFERENCES `sistemas` (`id`);

--
-- Filtros para la tabla `asignacion_detalles`
--
ALTER TABLE `asignacion_detalles`
  ADD CONSTRAINT `asignacion_detalles_asignacion_id_foreign` FOREIGN KEY (`asignacion_id`) REFERENCES `asignacions` (`id`),
  ADD CONSTRAINT `asignacion_detalles_perfil_id_foreign` FOREIGN KEY (`perfil_id`) REFERENCES `perfils` (`id`);

--
-- Filtros para la tabla `formularios`
--
ALTER TABLE `formularios`
  ADD CONSTRAINT `formularios_agencia_destino_foreign` FOREIGN KEY (`agencia_destino`) REFERENCES `agencias` (`id`),
  ADD CONSTRAINT `formularios_agencia_origen_foreign` FOREIGN KEY (`agencia_origen`) REFERENCES `agencias` (`id`),
  ADD CONSTRAINT `formularios_cargo_id_foreign` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`),
  ADD CONSTRAINT `formularios_funcionario_id_foreign` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`id`);

--
-- Filtros para la tabla `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `funcionarios_agencia_id_foreign` FOREIGN KEY (`agencia_id`) REFERENCES `agencias` (`id`),
  ADD CONSTRAINT `funcionarios_cargo_id_foreign` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`),
  ADD CONSTRAINT `funcionarios_regional_id_foreign` FOREIGN KEY (`regional_id`) REFERENCES `regionals` (`id`);

--
-- Filtros para la tabla `opcion_sistemas`
--
ALTER TABLE `opcion_sistemas`
  ADD CONSTRAINT `opcion_sistemas_sistema_id_foreign` FOREIGN KEY (`sistema_id`) REFERENCES `sistemas` (`id`);

--
-- Filtros para la tabla `perfil_sistemas`
--
ALTER TABLE `perfil_sistemas`
  ADD CONSTRAINT `perfil_sistemas_perfil_id_foreign` FOREIGN KEY (`perfil_id`) REFERENCES `perfils` (`id`),
  ADD CONSTRAINT `perfil_sistemas_sistema_id_foreign` FOREIGN KEY (`sistema_id`) REFERENCES `sistemas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
