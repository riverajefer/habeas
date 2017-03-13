-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-03-2017 a las 22:52:29
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `annet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `responsable` int(11) NOT NULL,
  `operario` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `titulo`, `user_id`, `responsable`, `operario`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Mercadeo', 2, 10, 4, 'mercadeo', '2017-03-09 21:31:18', '2017-03-13 03:43:01'),
(2, 'Financiera', 3, 2, 2, 'financiera', '2017-03-09 21:31:42', '2017-03-09 21:31:42'),
(3, 'Soporte Técnico', 2, 2, 2, 'soporte-tecnico', '2017-03-09 21:32:21', '2017-03-09 21:32:21'),
(4, 'Veterinaria', 2, 2, 2, 'veterinaria', '2017-03-09 21:32:54', '2017-03-09 21:32:54'),
(5, 'Industria', 2, 2, 2, 'industria', '2017-03-09 21:33:05', '2017-03-09 21:33:05'),
(6, 'Diagnóstica', 2, 2, 2, 'diagnostica', '2017-03-09 21:34:35', '2017-03-09 21:34:35'),
(7, 'Biología Molecular', 2, 2, 2, 'biologia-molecular', '2017-03-09 21:35:44', '2017-03-09 21:35:44'),
(8, 'Banco de Sangre', 2, 2, 2, 'banco-de-sangre', '2017-03-09 21:36:18', '2017-03-09 21:36:18'),
(9, 'prueba', 0, 5, 6, 'prueba', '2017-03-13 03:43:54', '2017-03-13 03:43:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `id` int(10) UNSIGNED NOT NULL,
  `sn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `primer_apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `segundo_apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_documento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `profesion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_corporativo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular_corporativo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_corporativo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `municipio_id` int(11) NOT NULL,
  `archivo_soporte` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area_id` int(11) NOT NULL,
  `procedencia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_cliente` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menor_de_18` tinyint(1) NOT NULL,
  `comentarios` text COLLATE utf8_unicode_ci,
  `estado` tinyint(1) NOT NULL,
  `estado_cliente` tinyint(1) NOT NULL,
  `creado_por` int(11) NOT NULL,
  `modificado_por` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`id`, `sn`, `nombre`, `primer_apellido`, `segundo_apellido`, `tipo_documento`, `doc`, `fecha_nacimiento`, `profesion`, `cargo`, `empresa`, `telefono`, `telefono_corporativo`, `celular`, `celular_corporativo`, `email`, `email_corporativo`, `direccion`, `municipio_id`, `archivo_soporte`, `area_id`, `procedencia`, `tipo_cliente`, `menor_de_18`, `comentarios`, `estado`, `estado_cliente`, `creado_por`, `modificado_por`, `created_at`, `updated_at`) VALUES
(1, '', 'Juan Andres', 'Ruiz', 'Lopez', 'Cédula de Ciudadanía', '805564873', '1971-06-11', 'Ingeniero', 'Analista', 'Annardx', '7854586', '', NULL, NULL, '', NULL, '', 525, '1489178796.PNG', 6, 'Administración', '', 0, '', 1, 0, 2, 2, '2017-03-10 20:46:36', '2017-03-10 20:47:08'),
(2, '', 'Maria', 'Castro', 'Riaño', 'Cédula de Ciudadanía', '102154414584', '1991-02-07', 'Publicista', 'Comercial', 'Annardx', '74715481', '', NULL, NULL, '', NULL, '', 525, '1489179043.pdf', 1, 'Administración', '', 0, '', 1, 0, 2, 2, '2017-03-10 20:50:43', '2017-03-10 20:53:32'),
(3, '', 'Pedro', 'Romero', 'Paez', 'Cédula de Ciudadanía', '102154240', '1985-01-30', 'Ingeniero Industrial', 'Administración', 'Annardx', '78712145', '', NULL, NULL, '', NULL, '', 70, '1489179336.png', 2, 'Administración', '', 0, '', 1, 0, 2, 0, '2017-03-10 20:55:36', '2017-03-10 20:55:36'),
(4, '', 'Andrea', 'Martinez', 'Gonzales', 'Cédula de Ciudadanía', '1021541545', '1983-02-11', 'Ingeniera Electrónica ', 'Soporte', 'Annardx', '78545868', '', NULL, NULL, '', NULL, '', 525, '1489179498.png', 3, 'Administración', '', 0, '', 1, 0, 2, 2, '2017-03-10 20:58:01', '2017-03-10 20:58:18'),
(5, '', 'Pedro', 'Doe', 'Paez', 'Cédula de Ciudadanía', '55787', '2003-01-29', 'Ingeniero', 'Analista', 'Annardx', '74715485', '', NULL, NULL, '', NULL, '', 525, NULL, 1, 'Formulario_mercadeo', '', 0, '', 1, 0, 0, 0, '2017-03-10 21:12:46', '2017-03-10 21:12:46'),
(6, '', 'Juan', 'Romero', 'Paez', 'Cédula de Ciudadanía', '4343434', '1991-12-31', 'Ingeniero', 'Analista', 'Annardx', '74715485', '', NULL, NULL, '', NULL, '', 525, NULL, 1, 'Formulario_mercadeo', '', 0, '', 1, 0, 0, 0, '2017-03-10 21:15:19', '2017-03-10 21:15:19'),
(7, '', 'Daniela', 'Diaz', 'Gonzales', 'Cédula de Ciudadanía', '3434343', '1991-12-31', 'Publicista', 'Comercial', 'Annardx', '74715485', '', NULL, NULL, '', NULL, '', 525, '', 2, 'Administración', '', 0, '', 1, 0, 0, 2, '2017-03-10 21:16:42', '2017-03-10 21:22:24'),
(9, '', 'Jose', 'Romero', 'Paez', 'Cédula de Ciudadanía', '34343453545', '1981-12-29', 'Ingeniero', 'Comercial', 'Annardx', '1234489', '', NULL, NULL, '', NULL, '', 525, '', 6, 'Administración', '', 0, '', 1, 0, 2, 0, '2017-03-10 21:26:44', '2017-03-10 21:26:44'),
(16, NULL, 'Pedro', 'Doe', 'Paez', 'Cédula de Ciudadanía', '123', '2012-12-29', 'Ingeniero', 'Analista', 'Annardx', '1234489', NULL, NULL, NULL, 'jrivera@bancoink.com', NULL, NULL, 525, '', 8, 'Administración', NULL, 1, NULL, 1, 0, 2, 0, '2017-03-13 03:59:27', '2017-03-13 03:59:27'),
(17, NULL, 'Pedro', 'Doe', 'Paez', 'Cédula de Ciudadanía', '1238', '1992-01-14', 'Ingeniero', 'Analista', 'Annardx', '1234489', NULL, NULL, NULL, 'jrivera@bancoink.com', NULL, NULL, 525, '', 8, 'Administración', NULL, 0, NULL, 1, 0, 2, 0, '2017-03-13 04:01:29', '2017-03-13 04:01:29');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registros_numero_docuemnto_unique` (`doc`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
