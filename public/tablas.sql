-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2017 a las 06:08:50
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
  `responsable` int(11) NOT NULL,
  `operario` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `titulo`, `responsable`, `operario`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Mercadeo', 3, 3, 'mercadeo', '2017-03-09 21:31:18', '2017-03-30 19:38:02'),
(2, 'Financiera', 3, 3, 'financiera', '2017-03-09 21:31:42', '2017-03-09 21:31:42'),
(3, 'Soporte Técnico', 3, 3, 'soporte-tecnico', '2017-03-09 21:32:21', '2017-03-09 21:32:21'),
(4, 'Veterinaria', 3, 3, 'veterinaria', '2017-03-09 21:32:54', '2017-03-09 21:32:54'),
(5, 'Industria', 3, 3, 'industria', '2017-03-09 21:33:05', '2017-03-09 21:33:05'),
(6, 'Diagnóstica', 3, 3, 'diagnostica', '2017-03-09 21:34:35', '2017-03-09 21:34:35'),
(7, 'Biología Molecular', 3, 3, 'biologia-molecular', '2017-03-09 21:35:44', '2017-03-24 00:45:17'),
(8, 'Banco de Sangre', 3, 3, 'banco-de-sangre', '2017-03-09 21:36:18', '2017-03-09 21:36:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas_users`
--

CREATE TABLE `areas_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `area_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `areas_users`
--

INSERT INTO `areas_users` (`id`, `area_id`, `user_id`, `created_at`, `updated_at`) VALUES
(23, 8, 87, '2017-05-02 00:24:43', '2017-05-02 00:24:43'),
(25, 1, 87, '2017-05-02 00:24:52', '2017-05-02 00:24:52'),
(27, 4, 87, '2017-05-02 00:26:25', '2017-05-02 00:26:25'),
(28, 1, 2, '2017-05-02 00:27:08', '2017-05-02 00:27:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audits`
--

CREATE TABLE `audits` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `event` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auditable_id` int(10) UNSIGNED NOT NULL,
  `auditable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `old_values` text COLLATE utf8_unicode_ci,
  `new_values` text COLLATE utf8_unicode_ci,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `audits`
--

INSERT INTO `audits` (`id`, `user_id`, `event`, `auditable_id`, `auditable_type`, `old_values`, `new_values`, `url`, `ip_address`, `created_at`) VALUES
(1, 2, 'created', 13, 'App\\Models\\Areas', '[]', '{\"titulo\":\"Comercial r\",\"responsable\":\"4\",\"operario\":\"1\",\"slug\":\"comercial-r\",\"id\":13}', 'http://localhost/habeas/public/areas', '::1', '2017-03-22 21:00:06'),
(2, 2, 'created', 34, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniela\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Perez\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"3433444444\",\"email\":\"jefersonpatino@yahoo.es\",\"fecha_nacimiento\":\"1992-01-20\",\"profesion\":\"Publicista\",\"cargo\":\"Administraci\\u00f3n\",\"empresa\":\"Annardx\",\"telefono_personal\":\"32324454\",\"archivo_soporte\":\"\",\"municipio_id\":\"138\",\"area_id\":\"8\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":2,\"menor_de_18\":false,\"sn\":\"1212\",\"telefono_corporativo\":\"2334455\",\"celular\":\"32121212\",\"celular_corporativo\":\"12132343\",\"email_corporativo\":\"jrivera@bancoink.com\",\"direccion\":\"Calle 57 # 70-15\",\"comentarios\":\"Hola\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"2\",\"estado\":1,\"id\":34}', 'http://localhost/habeas/public/registros', '::1', '2017-03-22 21:01:47'),
(3, 2, 'updated', 34, 'App\\Models\\Registros', '{\"email\":\"jefersonpatino@yahoo.es\",\"menor_de_18\":0,\"modificado_por\":0}', '{\"email\":\"riverajefer@gmail.com\",\"menor_de_18\":false,\"modificado_por\":2}', 'http://localhost/habeas/public/registros/34', '::1', '2017-03-22 21:04:09'),
(4, 2, 'updated', 34, 'App\\Models\\Registros', '{\"direccion\":\"Calle 57 # 70-15\"}', '{\"direccion\":\"Calle falsa 123\"}', 'http://localhost:81/habeas/public/registros/34', '::1', '2017-03-23 18:09:15'),
(5, 2, 'updated', 34, 'App\\Models\\Registros', '{\"celular_corporativo\":\"12132343\",\"comentarios\":\"Hola\"}', '{\"celular_corporativo\":\"3119978734\",\"comentarios\":\"Hola, mundo\"}', 'http://localhost:81/habeas/public/registros/34', '::1', '2017-03-23 18:29:46'),
(6, 2, 'updated', 34, 'App\\Models\\Registros', '{\"direccion\":\"Calle falsa 123\"}', '{\"direccion\":\"Calle 57 # 70-180\"}', 'http://localhost:81/habeas/public/registros/34', '::1', '2017-03-23 18:31:48'),
(7, 2, 'updated', 34, 'App\\Models\\Registros', '{\"sn\":\"1212\",\"nombre\":\"Daniela\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Perez\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"3433444444\",\"fecha_nacimiento\":\"1992-01-20\",\"profesion\":\"Publicista\",\"cargo\":\"Administraci\\u00f3n\",\"empresa\":\"Annardx\",\"telefono_personal\":\"32324454\",\"telefono_corporativo\":\"2334455\",\"celular\":\"32121212\",\"celular_corporativo\":\"3119978734\",\"email\":\"riverajefer@gmail.com\",\"email_corporativo\":\"jrivera@bancoink.com\",\"direccion\":\"Calle 57 # 70-180\",\"municipio_id\":138,\"area_id\":8,\"tipo_registro\":2,\"comentarios\":\"Hola, mundo\",\"estado\":1,\"estado_cliente\":\"Cliente Activo\"}', '{\"sn\":\"121200\",\"nombre\":\"Daniela M\",\"primer_apellido\":\"Perez M\",\"segundo_apellido\":\"Perez M\",\"tipo_documento\":\"Tarjeta de Identidad\",\"doc\":\"343344444400\",\"fecha_nacimiento\":\"1993-07-15\",\"profesion\":\"Publicista M\",\"cargo\":\"Administraci\\u00f3n M\",\"empresa\":\"Annardx M\",\"telefono_personal\":\"3232445400\",\"telefono_corporativo\":\"233445500\",\"celular\":\"3212121200\",\"celular_corporativo\":\"311997873400\",\"email\":\"riverajefer@gmail.com8\",\"email_corporativo\":\"jrivera@bancoink.comm\",\"direccion\":\"Calle 57 # 70-180-00\",\"municipio_id\":\"525\",\"area_id\":\"7\",\"tipo_registro\":\"1\",\"comentarios\":\"Hola, mundo MM\",\"estado\":\"0\",\"estado_cliente\":\"Cliente Inactivo\"}', 'http://localhost:81/habeas/public/registros/34', '::1', '2017-03-23 23:25:38'),
(8, 2, 'updated', 34, 'App\\Models\\Registros', '{\"archivo_soporte\":\"\",\"estado\":0}', '{\"archivo_soporte\":\"1490315467.png\",\"estado\":\"1\"}', 'http://localhost:81/habeas/public/registros/34', '::1', '2017-03-24 00:31:07'),
(9, 2, 'updated', 34, 'App\\Models\\Registros', '{\"archivo_soporte\":\"1490315467.png\"}', '{\"archivo_soporte\":\"1490316150.png\"}', 'http://localhost:81/habeas/public/registros/34', '::1', '2017-03-24 00:42:30'),
(10, 4, 'updated', 1, 'App\\Models\\Areas', '{\"operario\":2}', '{\"operario\":\"4\"}', 'http://localhost:81/habeas/public/areas/1', '::1', '2017-03-24 00:44:46'),
(11, 4, 'updated', 7, 'App\\Models\\Areas', '{\"operario\":2}', '{\"operario\":\"4\"}', 'http://localhost:81/habeas/public/areas/7', '::1', '2017-03-24 00:45:17'),
(12, 4, 'updated', 34, 'App\\Models\\Registros', '{\"tipo_documento\":\"Tarjeta de Identidad\",\"direccion\":\"Calle 57 # 70-180-00\",\"modificado_por\":2}', '{\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"direccion\":\"Calle 57 # 70-180\",\"modificado_por\":4}', 'http://localhost:81/habeas/public/registros/34', '::1', '2017-03-24 00:45:59'),
(13, 4, 'updated', 33, 'App\\Models\\Registros', '{\"modificado_por\":0}', '{\"modificado_por\":4}', 'http://localhost:81/habeas/public/registros/33', '::1', '2017-03-24 01:05:50'),
(14, 4, 'updated', 33, 'App\\Models\\Registros', '{\"tipo_registro\":2,\"estado_cliente\":\"Cliente Activo\"}', '{\"tipo_registro\":\"1\",\"estado_cliente\":\"Cliente Inactivo\"}', 'http://localhost:81/habeas/public/registros/33', '::1', '2017-03-24 01:06:36'),
(15, 4, 'created', 35, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniela\",\"primer_apellido\":\"Doe\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"232323\",\"email\":\"jrivera@bancoink.com\",\"fecha_nacimiento\":\"2002-01-01\",\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"empresa\":\"Annardx m\",\"telefono_personal\":\"74715485\",\"celular\":\"3100287372\",\"municipio_id\":\"525\",\"procedencia\":\"Formulario_soporte-tecnico\",\"creado_por\":\"Usuario_Formulario_soporte-tecnico\",\"area_id\":\"3\",\"menor_de_18\":true,\"estado\":1,\"id\":35}', 'http://localhost:81/habeas/public/formulario/guardar', '::1', '2017-03-24 01:57:15'),
(16, 4, 'created', 36, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniela\",\"primer_apellido\":\"Doe\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"232323111\",\"email\":\"jrivera@bancoink.com\",\"fecha_nacimiento\":\"2002-01-01\",\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"empresa\":\"Annardx m\",\"telefono_personal\":\"74715485\",\"celular\":\"3100287372\",\"municipio_id\":\"525\",\"procedencia\":\"Formulario_soporte-tecnico\",\"creado_por\":\"Usuario_Formulario_soporte-tecnico\",\"area_id\":\"3\",\"menor_de_18\":true,\"estado\":1,\"id\":36}', 'http://localhost:81/habeas/public/formulario/guardar', '::1', '2017-03-24 01:58:41'),
(17, 4, 'created', 37, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniela\",\"primer_apellido\":\"Doe\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"232323111000\",\"email\":\"jrivera@bancoink.com\",\"fecha_nacimiento\":\"2002-01-01\",\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"empresa\":\"Annardx m\",\"telefono_personal\":\"74715485\",\"celular\":\"3100287372\",\"municipio_id\":\"525\",\"procedencia\":\"Formulario_soporte-tecnico\",\"creado_por\":\"Usuario_Formulario_soporte-tecnico\",\"area_id\":\"3\",\"menor_de_18\":true,\"estado\":1,\"id\":37}', 'http://localhost:81/habeas/public/formulario/guardar', '::1', '2017-03-24 01:59:20'),
(18, 2, 'created', 38, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniela\",\"primer_apellido\":\"Doe\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"232323111000\",\"email\":\"jrivera@bancoink.com\",\"fecha_nacimiento\":\"2002-01-01\",\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"empresa\":\"Annardx m\",\"telefono_personal\":\"74715485\",\"celular\":\"3100287372\",\"municipio_id\":\"525\",\"procedencia\":\"Formulario_soporte-tecnico\",\"area_id\":\"3\",\"menor_de_18\":true,\"estado\":1,\"id\":38}', 'http://localhost:81/habeas/public/formulario/guardar', '::1', '2017-03-24 02:06:43'),
(19, 2, 'created', 39, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniela\",\"primer_apellido\":\"Doe\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"000222\",\"email\":\"jrivera@bancoink.com\",\"fecha_nacimiento\":\"2002-01-01\",\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"empresa\":\"Annardx m\",\"telefono_personal\":\"74715485\",\"celular\":\"3100287372\",\"municipio_id\":\"525\",\"procedencia\":\"Formulario_soporte-tecnico\",\"area_id\":\"3\",\"menor_de_18\":true,\"estado\":1,\"id\":39}', 'http://localhost:81/habeas/public/formulario/guardar', '::1', '2017-03-24 02:09:25'),
(20, 2, 'created', 40, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniela\",\"primer_apellido\":\"Doe\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"00022211\",\"email\":\"jrivera@bancoink.com\",\"fecha_nacimiento\":\"2002-01-01\",\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"empresa\":\"Annardx m\",\"telefono_personal\":\"74715485\",\"celular\":\"3100287372\",\"municipio_id\":\"525\",\"procedencia\":\"Formulario_soporte-tecnico\",\"area_id\":\"3\",\"menor_de_18\":true,\"estado\":1,\"id\":40}', 'http://localhost:81/habeas/public/formulario/guardar', '::1', '2017-03-24 02:12:19'),
(21, 2, 'created', 41, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Doe\",\"segundo_apellido\":\"Perez\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"43434\",\"email\":\"jrivera@bancoink.com\",\"fecha_nacimiento\":\"2012-01-02\",\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Analista\",\"empresa\":\"Annardx m\",\"telefono_personal\":\"74715485\",\"celular\":\"3100287372\",\"municipio_id\":\"634\",\"procedencia\":\"Formulario_prueba\",\"area_id\":\"9\",\"menor_de_18\":true,\"estado\":1,\"id\":41}', 'http://localhost:81/habeas/public/formulario/guardar', '::1', '2017-03-24 02:18:58'),
(22, 2, 'updated', 40, 'App\\Models\\Registros', '{\"estado\":1,\"baja_por\":\"0\"}', '{\"estado\":0,\"baja_por\":\"Mismo usuario\"}', 'http://localhost:81/habeas/public/formulario/baja', '::1', '2017-03-25 17:53:06'),
(23, 2, 'updated', 40, 'App\\Models\\Registros', '{\"sn\":null,\"telefono_personal\":null,\"telefono_corporativo\":null,\"email_corporativo\":null,\"direccion\":null,\"archivo_soporte\":null,\"tipo_registro\":null,\"comentarios\":null,\"estado\":1,\"estado_cliente\":\"\",\"modificado_por\":0}', '{\"sn\":\"123\",\"telefono_personal\":\"1122\",\"telefono_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"archivo_soporte\":\"\",\"tipo_registro\":\"2\",\"comentarios\":\"\",\"estado\":\"0\",\"estado_cliente\":\"Cliente Activo\",\"modificado_por\":2}', 'http://localhost:81/habeas/public/registros/40', '::1', '2017-03-25 18:07:26'),
(24, 2, 'updated', 40, 'App\\Models\\Registros', '{\"comentarios\":\"\"}', '{\"comentarios\":\"qq\"}', 'http://localhost:81/habeas/public/registros/40', '::1', '2017-03-25 18:08:18'),
(25, 2, 'updated', 40, 'App\\Models\\Registros', '{\"estado\":0}', '{\"estado\":\"1\"}', 'http://localhost:81/habeas/public/registros/40', '::1', '2017-03-25 18:12:15'),
(26, 2, 'updated', 40, 'App\\Models\\Registros', '{\"estado\":1,\"baja_por\":0}', '{\"estado\":\"0\",\"baja_por\":2}', 'http://localhost:81/habeas/public/registros/40', '::1', '2017-03-25 18:12:30'),
(27, 2, 'updated', 40, 'App\\Models\\Registros', '{\"baja_por\":2}', '{\"baja_por\":0}', 'http://localhost:81/habeas/public/formulario/baja', '::1', '2017-03-25 18:12:56'),
(28, 2, 'updated', 40, 'App\\Models\\Registros', '{\"estado\":0}', '{\"estado\":\"1\"}', 'http://localhost:81/habeas/public/registros/40', '::1', '2017-03-25 18:16:53'),
(29, 2, 'updated', 40, 'App\\Models\\Registros', '{\"estado\":1,\"baja_por\":0}', '{\"estado\":\"0\",\"baja_por\":2}', 'http://localhost:81/habeas/public/registros/40', '::1', '2017-03-25 18:21:16'),
(30, 2, 'updated', 40, 'App\\Models\\Registros', '{\"estado\":0,\"baja_por\":2}', '{\"estado\":\"1\",\"baja_por\":0}', 'http://localhost:81/habeas/public/registros/40', '::1', '2017-03-26 01:23:31'),
(31, 2, 'updated', 40, 'App\\Models\\Registros', '{\"estado\":1,\"baja_por\":0}', '{\"estado\":0,\"baja_por\":2}', 'http://localhost:81/habeas/public/registros/baja', '::1', '2017-03-26 01:28:45'),
(32, 2, 'updated', 39, 'App\\Models\\Registros', '{\"estado\":1,\"baja_por\":0}', '{\"estado\":0,\"baja_por\":2}', 'http://localhost:81/habeas/public/registros/baja', '::1', '2017-03-26 02:31:57'),
(33, 2, 'updated', 38, 'App\\Models\\Registros', '{\"estado\":1,\"baja_por\":0}', '{\"estado\":0,\"baja_por\":2}', 'http://localhost:81/habeas/public/registros/baja', '::1', '2017-03-26 02:33:36'),
(34, 2, 'updated', 31, 'App\\Models\\Registros', '{\"estado\":1,\"baja_por\":0}', '{\"estado\":0,\"baja_por\":2}', 'http://localhost:81/habeas/public/registros/baja', '::1', '2017-03-26 02:35:12'),
(35, 2, 'created', 42, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"id\":42}', 'http://localhost:81/habeas/public/reg/subida_masiva_test', '::1', '2017-03-29 04:57:56'),
(36, 2, 'created', 43, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Jos\\u00e9\",\"primer_apellido\":\"Rodriguez\",\"segundo_apellido\":\"Gil\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"152416549432\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":\"1991-12-31\",\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"empresa\":\"Annardx\",\"telefono_personal\":\"32324454\",\"archivo_soporte\":\"1490798639.png\",\"municipio_id\":\"525\",\"area_id\":\"8\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":2,\"menor_de_18\":0,\"sn\":\"1234\",\"telefono_corporativo\":\"2334455\",\"celular\":\"3100287372\",\"celular_corporativo\":\"12132343\",\"email_corporativo\":\"jrivera@bancoink.com\",\"direccion\":\"Calle 57 # 70-15\",\"comentarios\":\"Holaaa\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"2\",\"estado\":1,\"id\":43}', 'http://localhost/habeas/public/registros', '::1', '2017-03-29 14:43:59'),
(37, 2, 'updated', 43, 'App\\Models\\Registros', '{\"direccion\":\"Calle 57 # 70-15\",\"modificado_por\":0,\"baja_por\":null}', '{\"direccion\":\"Calle 57 # 70-180\",\"modificado_por\":2,\"baja_por\":0}', 'http://localhost/habeas/public/registros/43', '::1', '2017-03-29 14:46:32'),
(38, 2, 'created', 44, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":102154240777,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Pedro\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":1,\"id\":44}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 17:55:16'),
(39, 2, 'created', 45, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":78787,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Pedro\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":11,\"id\":45}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 19:29:57'),
(40, 2, 'created', 46, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":202020,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Pedro\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":12,\"id\":46}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 19:31:22'),
(41, 2, 'created', 47, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":20202000,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Pedro\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":13,\"id\":47}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 19:37:08'),
(42, 2, 'created', 48, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":20202011,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Pedro\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":14,\"id\":48}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 19:37:54'),
(43, 2, 'created', 49, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniel\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Ruiz\",\"tipo_documento\":\"NIT\",\"doc\":7474700,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Daniel\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":14,\"id\":49}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 19:37:55'),
(44, 2, 'created', 50, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":20202088,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Pedro\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":15,\"id\":50}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 19:42:02'),
(45, 2, 'created', 51, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniel\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Ruiz\",\"tipo_documento\":\"NIT\",\"doc\":7474777,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Daniel\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":15,\"id\":51}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 19:42:03'),
(46, 2, 'created', 52, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":787878,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Pedro\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":16,\"id\":52}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 21:55:28'),
(47, 2, 'created', 53, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniel\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Ruiz\",\"tipo_documento\":\"NIT\",\"doc\":545446,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Daniel\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":16,\"id\":53}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 21:55:28'),
(48, 2, 'created', 54, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":7787878,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Pedro\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":17,\"id\":54}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 21:56:28'),
(49, 2, 'created', 55, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniel\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Ruiz\",\"tipo_documento\":\"NIT\",\"doc\":1111111,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Daniel\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":17,\"id\":55}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 21:56:29'),
(50, 2, 'created', 56, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":57474747474,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Pedro\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":18,\"id\":56}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 21:57:25'),
(51, 2, 'created', 57, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniel\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Ruiz\",\"tipo_documento\":\"NIT\",\"doc\":85888,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Daniel\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":18,\"id\":57}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 21:57:25'),
(52, 2, 'created', 58, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":77774444,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Pedro\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":19,\"id\":58}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 22:01:24'),
(53, 2, 'created', 59, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniel\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Ruiz\",\"tipo_documento\":\"NIT\",\"doc\":8850225,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Daniel\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":19,\"id\":59}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 22:01:24'),
(54, 2, 'created', 60, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":25259710,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Pedro\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":20,\"id\":60}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 22:01:55'),
(55, 2, 'created', 61, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniel\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Ruiz\",\"tipo_documento\":\"NIT\",\"doc\":54878797,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":\"Daniel\",\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":\"Cliente\",\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado\":1,\"estado_cliente\":1,\"creado_por\":2,\"subida_masiva_id\":20,\"id\":61}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-29 22:01:55'),
(56, 2, 'created', 62, 'App\\Models\\Registros', '[]', '{\"nombre\":\"David\",\"primer_apellido\":\"Lopez\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"65434434\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":\"2002-01-01\",\"profesion\":\"Publicista\",\"cargo\":\"Administraci\\u00f3n\",\"empresa\":\"Annardx\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"525\",\"area_id\":\"8\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":2,\"menor_de_18\":1,\"sn\":\"\",\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"2\",\"estado\":1,\"id\":62}', 'http://localhost/habeas/public/registros', '::1', '2017-03-30 19:28:12'),
(57, 2, 'updated', 62, 'App\\Models\\Registros', '{\"modificado_por\":0,\"baja_por\":null}', '{\"modificado_por\":2,\"baja_por\":0}', 'http://localhost/habeas/public/registros/62', '::1', '2017-03-30 19:33:06'),
(58, 2, 'created', 63, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":787457,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":78712145,\"empresa\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":3167890235,\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":2,\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado_cliente\":\"Cliente Activo\",\"creado_por\":2,\"estado\":1,\"subida_masiva_id\":21,\"id\":63}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-30 19:36:10'),
(59, 2, 'created', 64, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniel\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Ruiz\",\"tipo_documento\":\"NIT\",\"doc\":100248,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":78712145,\"empresa\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":3167890235,\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":2,\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado_cliente\":\"Cliente Activo\",\"creado_por\":2,\"estado\":1,\"subida_masiva_id\":21,\"id\":64}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-30 19:36:10'),
(60, 2, 'updated', 1, 'App\\Models\\Areas', '{\"responsable\":4,\"operario\":4}', '{\"responsable\":\"2\",\"operario\":\"2\"}', 'http://localhost/habeas/public/areas/1', '::1', '2017-03-30 19:38:02'),
(61, 2, 'updated', 64, 'App\\Models\\Registros', '{\"sn\":null,\"modificado_por\":0,\"baja_por\":null}', '{\"sn\":\"\",\"modificado_por\":2,\"baja_por\":0}', 'http://localhost/habeas/public/registros/64', '::1', '2017-03-30 19:39:16'),
(62, 2, 'updated', 64, 'App\\Models\\Registros', '{\"sn\":\"\"}', '{\"sn\":\"1234\"}', 'http://localhost/habeas/public/registros/64', '::1', '2017-03-30 19:39:51'),
(63, 2, 'updated', 63, 'App\\Models\\Registros', '{\"modificado_por\":0,\"baja_por\":null}', '{\"modificado_por\":2,\"baja_por\":0}', 'http://localhost/habeas/public/registros/63', '::1', '2017-03-30 19:46:48'),
(64, 2, 'created', 65, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Lina\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"NIT\",\"doc\":\"32323256\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":\"\",\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"empresa\":\"Annardx\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"525\",\"area_id\":\"8\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":2,\"menor_de_18\":0,\"sn\":\"\",\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"estado\":1,\"id\":65}', 'http://localhost/habeas/public/registros', '::1', '2017-03-30 19:48:17'),
(65, 2, 'updated', 65, 'App\\Models\\Registros', '{\"sn\":\"\",\"fecha_nacimiento\":\"0000-00-00\",\"tipo_registro\":0,\"modificado_por\":0,\"baja_por\":null}', '{\"sn\":null,\"fecha_nacimiento\":\"\",\"tipo_registro\":\"2\",\"modificado_por\":2,\"baja_por\":0}', 'http://localhost/habeas/public/registros/65', '::1', '2017-03-30 19:48:30'),
(66, 2, 'created', 66, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Lucas\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"21212121334\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":\"\",\"profesion\":\"Publicista\",\"cargo\":\"Administraci\\u00f3n\",\"empresa\":\"Annardx\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"634\",\"area_id\":\"8\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":2,\"menor_de_18\":0,\"sn\":\"\",\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"estado\":1,\"id\":66}', 'http://localhost/habeas/public/registros', '::1', '2017-03-30 19:50:01'),
(67, 2, 'created', 67, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Lina\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"454532322322\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":null,\"profesion\":\"Ingeniero\",\"cargo\":\"Administraci\\u00f3n\",\"empresa\":\"Annardx\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"1\",\"area_id\":\"8\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":2,\"menor_de_18\":0,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"estado\":1,\"id\":67}', 'http://localhost/habeas/public/registros', '::1', '2017-03-30 19:59:51'),
(68, 2, 'updated', 67, 'App\\Models\\Registros', '{\"sn\":null,\"fecha_nacimiento\":null,\"tipo_registro\":0,\"modificado_por\":0,\"baja_por\":null}', '{\"sn\":\"\",\"fecha_nacimiento\":\"\",\"tipo_registro\":\"2\",\"modificado_por\":2,\"baja_por\":0}', 'http://localhost/habeas/public/registros/67', '::1', '2017-03-30 20:00:17'),
(69, 2, 'created', 68, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Andres\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"123567322\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":null,\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"empresa\":\"Annardx\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"3\",\"area_id\":\"8\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":2,\"menor_de_18\":0,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"estado\":1,\"id\":68}', 'http://localhost/habeas/public/registros', '::1', '2017-03-30 20:03:46'),
(70, 2, 'updated', 68, 'App\\Models\\Registros', '{\"sn\":null,\"fecha_nacimiento\":null,\"tipo_registro\":0,\"modificado_por\":0,\"baja_por\":null}', '{\"sn\":\"\",\"fecha_nacimiento\":\"\",\"tipo_registro\":\"2\",\"modificado_por\":2,\"baja_por\":0}', 'http://localhost/habeas/public/registros/68', '::1', '2017-03-30 20:03:55'),
(71, 2, 'created', 69, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"2322323\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":null,\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"empresa\":\"Annardx\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"3\",\"area_id\":\"8\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":2,\"menor_de_18\":0,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"estado\":1,\"id\":69}', 'http://localhost/habeas/public/registros', '::1', '2017-03-30 20:06:22'),
(72, 2, 'updated', 69, 'App\\Models\\Registros', '{\"tipo_registro\":0,\"modificado_por\":0,\"baja_por\":null}', '{\"tipo_registro\":\"2\",\"modificado_por\":2,\"baja_por\":0}', 'http://localhost/habeas/public/registros/69', '::1', '2017-03-30 20:06:31'),
(73, 2, 'created', 70, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Carlos\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":\"2232658765\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":null,\"profesion\":\"Ingeniero\",\"cargo\":\"Analista\",\"empresa\":\"Annardx m\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"128\",\"area_id\":\"6\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":2,\"menor_de_18\":0,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"estado\":1,\"id\":70}', 'http://localhost/habeas/public/registros', '::1', '2017-03-30 20:08:30'),
(74, 2, 'updated', 70, 'App\\Models\\Registros', '{\"tipo_registro\":0,\"modificado_por\":0,\"baja_por\":null}', '{\"tipo_registro\":\"\",\"modificado_por\":2,\"baja_por\":0}', 'http://localhost/habeas/public/registros/70', '::1', '2017-03-30 20:08:40'),
(75, 2, 'created', 71, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Camilo\",\"primer_apellido\":\"Lopez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"Tarjeta de Identidad\",\"doc\":\"121212145677\",\"email\":\"soporte@sionica.net\",\"fecha_nacimiento\":null,\"profesion\":\"Publicista\",\"cargo\":\"Administraci\\u00f3n\",\"empresa\":\"Annardx m\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"3\",\"area_id\":\"6\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":2,\"menor_de_18\":0,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"estado\":1,\"id\":71}', 'http://localhost/habeas/public/registros', '::1', '2017-03-30 20:13:45'),
(76, 2, 'updated', 71, 'App\\Models\\Registros', '{\"modificado_por\":0,\"baja_por\":null}', '{\"modificado_por\":2,\"baja_por\":0}', 'http://localhost/habeas/public/registros/71', '::1', '2017-03-30 20:16:40'),
(77, 2, 'created', 72, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Jorge\",\"primer_apellido\":\"Lopez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"NIT\",\"doc\":\"121212\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":null,\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"empresa\":\"Annardx m\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"1\",\"area_id\":\"8\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":2,\"menor_de_18\":0,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"estado\":1,\"id\":72}', 'http://localhost/habeas/public/registros', '::1', '2017-03-30 20:20:58'),
(78, 2, 'updated', 72, 'App\\Models\\Registros', '{\"modificado_por\":0}', '{\"modificado_por\":2}', 'http://localhost/habeas/public/registros/72', '::1', '2017-03-30 20:22:06'),
(79, 2, 'updated', 72, 'App\\Models\\Registros', '{\"direccion\":\"\",\"tipo_registro\":0}', '{\"direccion\":\"Calle 57 # 70-15\",\"tipo_registro\":\"1\"}', 'http://localhost/habeas/public/registros/72', '::1', '2017-03-30 20:25:22'),
(80, 2, 'updated', 72, 'App\\Models\\Registros', '{\"sn\":null}', '{\"sn\":\"123\"}', 'http://localhost/habeas/public/registros/72', '::1', '2017-03-30 20:26:32'),
(81, 2, 'created', 73, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":85874266,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":78712145,\"empresa\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":3167890235,\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":2,\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado_cliente\":\"Cliente Activo\",\"creado_por\":2,\"estado\":1,\"subida_masiva_id\":22,\"id\":73}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-30 20:27:42'),
(82, 2, 'created', 74, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniel\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Ruiz\",\"tipo_documento\":\"NIT\",\"doc\":1023684,\"fecha_nacimiento\":{\"date\":\"1985-01-30 00:00:00.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":78712145,\"empresa\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":3167890235,\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":2,\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"estado_cliente\":\"Cliente Activo\",\"creado_por\":2,\"estado\":1,\"subida_masiva_id\":22,\"id\":74}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-03-30 20:27:42'),
(83, 2, 'updated', 73, 'App\\Models\\Registros', '{\"modificado_por\":0}', '{\"modificado_por\":2}', 'http://localhost/habeas/public/registros/73', '::1', '2017-03-30 20:27:52'),
(84, 2, 'updated', 74, 'App\\Models\\Registros', '{\"sn\":null,\"modificado_por\":0}', '{\"sn\":\"333\",\"modificado_por\":2}', 'http://localhost/habeas/public/registros/74', '::1', '2017-03-30 20:28:21'),
(85, 2, 'updated', 74, 'App\\Models\\Registros', '{\"estado\":1,\"baja_por\":null}', '{\"estado\":0,\"baja_por\":2}', 'http://localhost/habeas/public/registros/baja', '::1', '2017-03-30 20:30:15'),
(86, 2, 'updated', 74, 'App\\Models\\Registros', '{\"estado\":0,\"baja_por\":2}', '{\"estado\":\"1\",\"baja_por\":null}', 'http://localhost/habeas/public/registros/74', '::1', '2017-03-30 20:34:57'),
(87, 2, 'updated', 74, 'App\\Models\\Registros', '{\"estado\":1,\"baja_por\":null}', '{\"estado\":0,\"baja_por\":2}', 'http://localhost/habeas/public/registros/baja', '::1', '2017-03-30 20:45:06'),
(88, 2, 'updated', 74, 'App\\Models\\Registros', '{\"estado\":0,\"baja_por\":2}', '{\"estado\":\"1\",\"baja_por\":null}', 'http://localhost/habeas/public/registros/74', '::1', '2017-03-30 20:46:01'),
(89, 2, 'updated', 74, 'App\\Models\\Registros', '{\"estado\":1,\"baja_por\":null}', '{\"estado\":0,\"baja_por\":2}', 'http://localhost/habeas/public/registros/baja', '::1', '2017-03-30 20:46:09'),
(90, 2, 'updated', 12, 'App\\Models\\Areas', '{\"operario\":1}', '{\"operario\":\"4\"}', 'http://localhost/habeas/public/areas/12', '::1', '2017-03-30 20:48:13'),
(91, 1, 'updated', 13, 'App\\Models\\Areas', '{\"operario\":1}', '{\"operario\":\"2\"}', 'http://localhost/habeas/public/areas/13', '::1', '2017-03-30 20:49:32'),
(92, 1, 'created', 75, 'App\\Models\\Registros', '[]', '{\"nombre\":\"juan\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"3333\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":\"2002-01-09\",\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"empresa\":\"Annardx\",\"telefono_personal\":\"1234489\",\"celular\":\"32121212\",\"municipio_id\":\"525\",\"procedencia\":\"Formulario_mercadeo\",\"area_id\":\"1\",\"menor_de_18\":true,\"estado\":1,\"id\":75}', 'http://localhost/habeas/public/formulario/guardar', '::1', '2017-04-03 17:52:51');
INSERT INTO `audits` (`id`, `user_id`, `event`, `auditable_id`, `auditable_type`, `old_values`, `new_values`, `url`, `ip_address`, `created_at`) VALUES
(93, 2, 'created', 76, 'App\\Models\\Registros', '[]', '{\"nombre\":\"juan\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"7412\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":null,\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"empresa\":\"Annardx\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"135\",\"area_id\":\"8\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":2,\"menor_de_18\":0,\"sn\":null,\"telefono_corporativo\":\"2334455\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"2\",\"asesor_comercial\":\"JEIMY ROJAS\",\"estado\":1,\"id\":76}', 'http://localhost/habeas/public/registros', '::1', '2017-04-05 19:43:19'),
(94, 2, 'updated', 76, 'App\\Models\\Registros', '{\"asesor_comercial\":\"JEIMY ROJAS\",\"modificado_por\":0}', '{\"asesor_comercial\":\"COLCAN\",\"modificado_por\":2}', 'http://localhost/habeas/public/registros/76', '::1', '2017-04-05 19:52:39'),
(95, 4, 'created', 77, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Carlos\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":325610,\"fecha_nacimiento\":\"1985-01-30\",\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":78712145,\"empresa\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":3167890235,\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":3,\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"asesor_comercial\":\"COLCAN\",\"estado_cliente\":\"Cliente Activo\",\"creado_por\":4,\"estado\":1,\"sn\":123,\"subida_masiva_id\":23,\"id\":77}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-04-05 20:02:39'),
(96, 4, 'created', 78, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Carlos\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":858585220,\"fecha_nacimiento\":\"1985-01-30\",\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":78712145,\"empresa\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":3167890235,\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":3,\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"asesor_comercial\":\"COLCAN\",\"estado_cliente\":\"Cliente Activo\",\"creado_por\":4,\"estado\":1,\"sn\":123,\"subida_masiva_id\":24,\"id\":78}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-04-05 21:43:20'),
(97, 4, 'created', 79, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Carlos\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":858585228,\"fecha_nacimiento\":\"1985-01-30\",\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":78712145,\"empresa\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":3167890235,\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":3,\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"asesor_comercial\":\"COLCAN\",\"estado_cliente\":\"Cliente Activo\",\"creado_por\":4,\"estado\":1,\"sn\":123,\"subida_masiva_id\":25,\"id\":79}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-04-05 21:46:08'),
(98, 2, 'updated', 16, 'App\\Models\\Registros', '{\"telefono_corporativo\":null,\"celular\":null,\"celular_corporativo\":null,\"email_corporativo\":null,\"direccion\":null,\"archivo_soporte\":\"\",\"tipo_registro\":null,\"comentarios\":null,\"asesor_comercial\":\"0\",\"estado_cliente\":\"0\",\"modificado_por\":0,\"baja_por\":0}', '{\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"12345\",\"email_corporativo\":\"\",\"direccion\":\"\",\"archivo_soporte\":null,\"tipo_registro\":0,\"comentarios\":\"\",\"asesor_comercial\":\"VARIOS\",\"estado_cliente\":\"Cliente Activo\",\"modificado_por\":2,\"baja_por\":null}', 'http://192.168.0.12/habeas/public/registros/16', '192.168.0.3', '2017-04-06 21:42:46'),
(99, 2, 'updated', 70, 'App\\Models\\Registros', '{\"estado\":1,\"baja_por\":0}', '{\"estado\":0,\"baja_por\":2}', 'http://192.168.0.12/habeas/public/registros/baja', '192.168.0.3', '2017-04-06 21:54:48'),
(100, 2, 'created', 80, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Carlos\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"doc\":85000529,\"fecha_nacimiento\":\"1985-01-30\",\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":78712145,\"empresa\":\"Annardx\",\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":3167890235,\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-15\",\"municipio_id\":525,\"area_id\":1,\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":3,\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"asesor_comercial\":\"COLCAN\",\"estado_cliente\":\"Cliente Activo\",\"creado_por\":2,\"estado\":1,\"sn\":123,\"subida_masiva_id\":26,\"id\":80}', 'http://192.168.0.12/habeas/public/reg/subida_masiva', '192.168.0.3', '2017-04-06 21:59:57'),
(101, 2, 'updated', 80, 'App\\Models\\Registros', '{\"fecha_nacimiento\":\"1985-01-30\",\"municipio_id\":525,\"modificado_por\":0}', '{\"fecha_nacimiento\":\"1986-10-21\",\"municipio_id\":\"855\",\"modificado_por\":2}', 'http://192.168.0.12/habeas/public/registros/80', '192.168.0.3', '2017-04-06 22:01:01'),
(102, 2, 'updated', 49, 'App\\Models\\Registros', '{\"estado\":1,\"baja_por\":null}', '{\"estado\":0,\"baja_por\":2}', 'http://192.168.0.12/habeas/public/registros/baja', '192.168.0.3', '2017-04-06 22:01:27'),
(103, 2, 'created', 81, 'App\\Models\\Registros', '[]', '{\"nombre\":\"prueba\",\"primer_apellido\":\"Gil\",\"segundo_apellido\":\"Oerez\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"12366\",\"email\":\"jrivera@bancoink.com\",\"fecha_nacimiento\":\"1992-01-21\",\"profesion\":\"Dd\",\"cargo\":\"Nn\",\"empresa\":\"Nn\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"525\",\"area_id\":\"6\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":2,\"menor_de_18\":0,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"1\",\"asesor_comercial\":\"ANDREA PERDOMO\",\"estado\":1,\"id\":81}', 'http://192.168.0.12/habeas/public/registros', '192.168.0.3', '2017-04-06 22:03:19'),
(104, 2, 'updated', 16, 'App\\Models\\Registros', '{\"celular\":\"\"}', '{\"celular\":\"25555002\"}', 'http://localhost/habeas/public/test', '::1', '2017-04-07 14:35:22'),
(105, 4, 'updated', 79, 'App\\Models\\Registros', '{\"direccion\":\"Calle 65 # 60-15\",\"subida_masiva_id\":25}', '{\"direccion\":\"Calle 65 # 60-18\",\"subida_masiva_id\":27}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-04-07 15:01:07'),
(106, 4, 'updated', 75, 'App\\Models\\Registros', '{\"sn\":null,\"nombre\":\"juan\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"fecha_nacimiento\":\"2002-01-09\",\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"telefono_personal\":\"1234489\",\"telefono_corporativo\":null,\"celular\":\"32121212\",\"celular_corporativo\":null,\"email\":\"riverajefer@gmail.com\",\"email_corporativo\":null,\"direccion\":null,\"procedencia\":\"Formulario_mercadeo\",\"tipo_registro\":null,\"menor_de_18\":1,\"comentarios\":null,\"asesor_comercial\":\"0\",\"estado_cliente\":null,\"creado_por\":0}', '{\"sn\":123,\"nombre\":\"Carlos\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"NIT\",\"fecha_nacimiento\":\"1985-01-30\",\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Administraci\\u00f3n\",\"telefono_personal\":78712145,\"telefono_corporativo\":7848817,\"celular\":3167890235,\"celular_corporativo\":3167890235,\"email\":\"email@example.com\",\"email_corporativo\":\"email@example.com\",\"direccion\":\"Calle 65 # 60-18\",\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"tipo_registro\":3,\"menor_de_18\":0,\"comentarios\":\"Sin comentarios\",\"asesor_comercial\":\"COLCAN\",\"estado_cliente\":\"Cliente Activo\",\"creado_por\":4}', 'http://localhost/habeas/public/reg/subida_masiva', '::1', '2017-04-07 15:05:50'),
(107, 4, 'created', 82, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Paez\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"888777\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":null,\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"empresa\":\"Annardx m\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"327\",\"area_id\":\"7\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":4,\"menor_de_18\":0,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"asesor_comercial\":\"\",\"estado\":1,\"id\":82}', 'http://localhost/habeas/public/registros', '::1', '2017-04-07 16:45:10'),
(108, 4, 'created', 83, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Lucas\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"5887745\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":\"2011-12-27\",\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"empresa\":\"Annardx\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"135\",\"area_id\":\"8\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":4,\"menor_de_18\":1,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"asesor_comercial\":\"\",\"estado\":1,\"id\":83}', 'http://localhost/habeas/public/registros', '::1', '2017-04-07 16:49:11'),
(109, 4, 'created', 84, 'App\\Models\\Registros', '[]', '{\"nombre\":\"juan m\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"787852544\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":null,\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"empresa\":\"Annardx\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"128\",\"area_id\":\"3\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":4,\"menor_de_18\":0,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"asesor_comercial\":\"\",\"estado\":1,\"id\":84}', 'http://localhost/habeas/public/registros', '::1', '2017-04-07 16:50:36'),
(110, 4, 'created', 85, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Diana\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"87542360\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":null,\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"empresa\":\"Annardx\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"3\",\"area_id\":\"3\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":4,\"menor_de_18\":0,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"asesor_comercial\":\"\",\"estado\":1,\"id\":85}', 'http://localhost/habeas/public/registros', '::1', '2017-04-07 16:58:03'),
(111, 4, 'created', 86, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"7863100\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":null,\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"empresa\":\"Annardx\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"487\",\"area_id\":\"6\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":4,\"menor_de_18\":0,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"asesor_comercial\":\"\",\"estado\":1,\"id\":86}', 'http://localhost/habeas/public/registros', '::1', '2017-04-07 17:23:44'),
(112, 4, 'created', 87, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"7863107\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":null,\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"empresa\":\"Annardx\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"128\",\"area_id\":\"6\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":4,\"menor_de_18\":0,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"asesor_comercial\":\"\",\"estado\":1,\"id\":87}', 'http://localhost/habeas/public/registros', '::1', '2017-04-07 17:27:00'),
(113, 4, 'created', 88, 'App\\Models\\Registros', '[]', '{\"nombre\":\"juan\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"454543343\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":null,\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"empresa\":\"Annardx\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"128\",\"area_id\":\"7\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":4,\"menor_de_18\":0,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"asesor_comercial\":\"\",\"estado\":1,\"id\":88}', 'http://localhost/habeas/public/registros', '::1', '2017-04-07 17:32:08'),
(114, 4, 'created', 89, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Pedro\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"23223232\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":null,\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"empresa\":\"Annardx\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"3\",\"area_id\":\"8\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":4,\"menor_de_18\":0,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"asesor_comercial\":\"\",\"estado\":1,\"id\":89}', 'http://localhost/habeas/public/registros', '::1', '2017-04-07 17:33:16'),
(115, 4, 'created', 90, 'App\\Models\\Registros', '[]', '{\"nombre\":\"juan\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"34343222\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":null,\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"empresa\":\"Annardx\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"128\",\"area_id\":\"8\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":4,\"menor_de_18\":0,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"asesor_comercial\":\"\",\"estado\":1,\"id\":90}', 'http://localhost/habeas/public/registros', '::1', '2017-04-07 17:53:48'),
(116, 4, 'updated', 90, 'App\\Models\\Registros', '{\"municipio_id\":128,\"asesor_comercial\":\"\",\"modificado_por\":0}', '{\"municipio_id\":\"517\",\"asesor_comercial\":\"VARIOS\",\"modificado_por\":4}', 'http://localhost/habeas/public/registros/90', '::1', '2017-04-07 17:55:20'),
(117, 4, 'updated', 90, 'App\\Models\\Registros', '{\"municipio_id\":517}', '{\"municipio_id\":\"354\"}', 'http://localhost/habeas/public/registros/90', '::1', '2017-04-07 18:15:40'),
(118, 4, 'updated', 90, 'App\\Models\\Registros', '{\"estado\":1,\"baja_por\":null}', '{\"estado\":0,\"baja_por\":4}', 'http://localhost/habeas/public/registros/baja', '::1', '2017-04-07 18:19:25'),
(119, 4, 'created', 91, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Lina\",\"primer_apellido\":\"Perez\",\"segundo_apellido\":\"Gonzales\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"22221113\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":\"2011-12-27\",\"profesion\":\"Publicista\",\"cargo\":\"Comercial\",\"empresa\":\"Annardx\",\"telefono_personal\":\"1234489\",\"celular\":\"32121212\",\"municipio_id\":\"634\",\"procedencia\":\"Formulario_mercadeo\",\"area_id\":\"1\",\"menor_de_18\":true,\"estado\":1,\"id\":91}', 'http://localhost/habeas/public/formulario/guardar', '::1', '2017-04-07 18:32:06'),
(120, 4, 'updated', 91, 'App\\Models\\Registros', '{\"estado\":1,\"baja_por\":null}', '{\"estado\":0,\"baja_por\":0}', 'http://localhost/habeas/public/formulario/baja', '::1', '2017-04-07 18:36:13'),
(121, 2, 'created', 92, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniela\",\"primer_apellido\":\"Doe\",\"segundo_apellido\":\"Perez\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"10272522\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":null,\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Analista\",\"empresa\":\"Annardx\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"525\",\"area_id\":\"8\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":2,\"menor_de_18\":0,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"asesor_comercial\":\"ANNAR\",\"estado\":1,\"id\":92}', 'http://190.145.89.228/habeas/public/registros', '192.168.3.1', '2017-04-15 17:11:20'),
(122, 2, 'updated', 92, 'App\\Models\\Registros', '{\"fecha_nacimiento\":null,\"celular_corporativo\":\"\",\"tipo_registro\":0,\"modificado_por\":0}', '{\"fecha_nacimiento\":\"1990-07-19\",\"celular_corporativo\":\"1213234000\",\"tipo_registro\":\"2\",\"modificado_por\":2}', 'http://190.145.89.228/habeas/public/registros/92', '192.168.3.1', '2017-04-15 17:12:03'),
(123, 2, 'updated', 92, 'App\\Models\\Registros', '{\"sn\":null}', '{\"sn\":\"123\"}', 'http://localhost/habeas/public/registros/92', '::1', '2017-04-20 19:26:47'),
(124, 2, 'created', 9, 'App\\Models\\Areas', '[]', '{\"titulo\":\"Comercial Dep\",\"slug\":\"comercial-dep\",\"id\":9}', 'http://localhost/habeas/public/areas', '::1', '2017-04-27 21:21:03'),
(125, 2, 'updated', 91, 'App\\Models\\Registros', '{\"telefono_corporativo\":null,\"celular_corporativo\":null,\"email_corporativo\":null,\"direccion\":null,\"tipo_registro\":null,\"comentarios\":null,\"asesor_comercial\":null,\"estado\":0,\"estado_cliente\":null,\"modificado_por\":0,\"baja_por\":0}', '{\"telefono_corporativo\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"tipo_registro\":0,\"comentarios\":\"\",\"asesor_comercial\":\"VARIOS\",\"estado\":\"1\",\"estado_cliente\":\"Cliente Activo\",\"modificado_por\":2,\"baja_por\":null}', 'http://localhost/habeas/public/registros/91', '::1', '2017-04-28 20:32:46'),
(126, 2, 'created', 10, 'App\\Models\\Areas', '[]', '{\"titulo\":\"Nueva\",\"slug\":\"nueva\",\"id\":10}', 'http://localhost:81/habeas/public/areas', '::1', '2017-05-01 22:40:59'),
(127, 2, 'created', 11, 'App\\Models\\Areas', '[]', '{\"titulo\":\"Nueva B\",\"slug\":\"nueva-b\",\"id\":11}', 'http://localhost:81/habeas/public/areas', '::1', '2017-05-01 22:50:10'),
(128, 2, 'updated', 16, 'App\\Models\\Registros', '{\"nombre\":\"Pedro\",\"segundo_apellido\":\"Paez\",\"fecha_nacimiento\":\"2012-12-29\",\"profesion\":\"Ingeniero\",\"telefono_personal\":\"1234489\",\"celular\":\"25555002\",\"municipio_id\":525,\"area_id\":8,\"procedencia\":\"Administraci\\u00f3n\",\"menor_de_18\":1}', '{\"nombre\":\"Daniela\",\"segundo_apellido\":\"Perez\",\"fecha_nacimiento\":\"2012-01-03\",\"profesion\":\"Ingeniero Industrial\",\"telefono_personal\":\"74715485\",\"celular\":\"3118765\",\"municipio_id\":\"517\",\"area_id\":\"1\",\"procedencia\":\"Formulario_mercadeo\",\"menor_de_18\":true}', 'http://localhost:81/habeas/public/formulario/guardar', '::1', '2017-05-02 00:47:36'),
(129, 2, 'updated', 16, 'App\\Models\\Registros', '{\"fecha_nacimiento\":\"2012-01-03\",\"celular\":\"3118765\",\"municipio_id\":517,\"menor_de_18\":1}', '{\"fecha_nacimiento\":\"1992-01-07\",\"celular\":\"3100287372\",\"municipio_id\":\"491\",\"menor_de_18\":false}', 'http://localhost:81/habeas/public/formulario/guardar', '::1', '2017-05-02 01:12:10'),
(130, 2, 'updated', 16, 'App\\Models\\Registros', '{\"nombre\":\"Daniela\",\"celular\":\"3100287372\",\"email\":\"jrivera@bancoink.com\",\"municipio_id\":491,\"menor_de_18\":0}', '{\"nombre\":\"Carlos\",\"celular\":\"3118765\",\"email\":\"riverajefer@gmail.com\",\"municipio_id\":\"522\",\"menor_de_18\":false}', 'http://localhost:81/habeas/public/formulario/guardar', '::1', '2017-05-02 01:12:58'),
(131, 2, 'updated', 16, 'App\\Models\\Registros', '{\"nombre\":\"Carlos\",\"primer_apellido\":\"Doe\",\"fecha_nacimiento\":\"1992-01-07\",\"empresa\":\"Annardx\",\"celular\":\"3118765\",\"email\":\"riverajefer@gmail.com\",\"municipio_id\":522,\"menor_de_18\":0}', '{\"nombre\":\"Daniela\",\"primer_apellido\":\"Romero\",\"fecha_nacimiento\":\"2016-05-10\",\"empresa\":\"Annardx m\",\"celular\":\"3100287372\",\"email\":\"jrivera@bancoink.com\",\"municipio_id\":\"525\",\"menor_de_18\":true}', 'http://localhost:81/habeas/public/formulario/guardar', '::1', '2017-05-02 01:17:13'),
(132, 2, 'updated', 16, 'App\\Models\\Registros', '{\"primer_apellido\":\"Romero\",\"fecha_nacimiento\":\"2016-05-10\",\"empresa\":\"Annardx m\",\"telefono_personal\":\"74715485\",\"menor_de_18\":1}', '{\"primer_apellido\":\"Doe\",\"fecha_nacimiento\":\"2001-12-31\",\"empresa\":\"Annardx\",\"telefono_personal\":\"1234489\",\"menor_de_18\":true}', 'http://localhost:81/habeas/public/formulario/guardar', '::1', '2017-05-02 01:18:16'),
(133, 2, 'created', 93, 'App\\Models\\Registros', '[]', '{\"nombre\":\"Daniela\",\"primer_apellido\":\"Romero\",\"segundo_apellido\":\"Perez\",\"tipo_documento\":\"C\\u00e9dula de Ciudadan\\u00eda\",\"doc\":\"12343\",\"email\":\"riverajefer@gmail.com\",\"fecha_nacimiento\":\"2011-12-26\",\"profesion\":\"Ingeniero Industrial\",\"cargo\":\"Analista\",\"empresa\":\"Annardx\",\"telefono_personal\":\"\",\"archivo_soporte\":null,\"municipio_id\":\"366\",\"area_id\":\"6\",\"procedencia\":\"Panel de administraci\\u00f3n\",\"creado_por\":2,\"menor_de_18\":1,\"sn\":null,\"telefono_corporativo\":\"\",\"celular\":\"\",\"celular_corporativo\":\"\",\"email_corporativo\":\"\",\"direccion\":\"\",\"comentarios\":\"\",\"estado_cliente\":\"Cliente Activo\",\"tipo_registro\":\"\",\"asesor_comercial\":\"\",\"estado\":1,\"id\":93}', 'http://localhost:81/habeas/public/registros', '::1', '2017-05-02 01:23:17'),
(134, 2, 'updated', 93, 'App\\Models\\Registros', '{\"direccion\":\"\",\"municipio_id\":366,\"tipo_registro\":0,\"asesor_comercial\":\"\",\"modificado_por\":0}', '{\"direccion\":\"Calle 57 # 70-180\",\"municipio_id\":\"370\",\"tipo_registro\":\"2\",\"asesor_comercial\":\"VARIOS\",\"modificado_por\":2}', 'http://localhost:81/habeas/public/registros/93', '::1', '2017-05-02 01:24:01'),
(135, 2, 'updated', 49, 'App\\Models\\Registros', '{\"empresa\":null,\"telefono_personal\":\"Annardx\",\"celular_corporativo\":\"Daniel\",\"asesor_comercial\":\"0\",\"estado_cliente\":\"1\",\"modificado_por\":0}', '{\"empresa\":\"Annardx\",\"telefono_personal\":\"78787\",\"celular_corporativo\":\"787878\",\"asesor_comercial\":\"VARIOS\",\"estado_cliente\":\"Cliente Activo\",\"modificado_por\":2}', 'http://localhost:81/habeas/public/registros/49', '::1', '2017-05-02 03:32:05'),
(136, 2, 'updated', 49, 'App\\Models\\Registros', '{\"sn\":null,\"telefono_personal\":\"78787\"}', '{\"sn\":\"12233\",\"telefono_personal\":\"32324454\"}', 'http://localhost:81/habeas/public/registros/49', '::1', '2017-05-03 01:07:09'),
(137, 2, 'updated', 75, 'App\\Models\\Registros', '{\"procedencia\":\"Panel de administraci\\u00f3n Subida masiva\",\"creado_por\":4}', '{\"procedencia\":\"Subida masiva\",\"creado_por\":2}', 'http://localhost:81/habeas/public/reg/subida_masiva', '::1', '2017-05-03 04:07:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`) VALUES
(1, 'Amazonas'),
(2, 'Antioquia'),
(3, 'Arauca'),
(4, 'Atlántico'),
(5, 'Bolívar'),
(6, 'Boyacá'),
(7, 'Caldas'),
(8, 'Caquetá'),
(9, 'Casanare'),
(10, 'Cauca'),
(11, 'Cesar'),
(12, 'Chocó'),
(13, 'Córdoba'),
(14, 'Cundinamarca'),
(15, 'Güainia'),
(16, 'Guaviare'),
(17, 'Huila'),
(18, 'La Guajira'),
(19, 'Magdalena'),
(20, 'Meta'),
(21, 'Nariño'),
(22, 'Norte de Santander'),
(23, 'Putumayo'),
(24, 'Quindio'),
(25, 'Risaralda'),
(26, 'San Andrés y Providencia'),
(27, 'Santander'),
(28, 'Sucre'),
(29, 'Tolima'),
(30, 'Valle del Cauca'),
(31, 'Vaupés'),
(32, 'Vichada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `device_registros`
--

CREATE TABLE `device_registros` (
  `id` int(10) UNSIGNED NOT NULL,
  `registro_id` int(11) NOT NULL,
  `SO` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SO_version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `device` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `browser` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_device` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pais` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `departamento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ciudad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ubicacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `device_registros`
--

INSERT INTO `device_registros` (`id`, `registro_id`, `SO`, `SO_version`, `device`, `browser`, `ip`, `tipo_device`, `pais`, `departamento`, `ciudad`, `ubicacion`, `created_at`, `updated_at`) VALUES
(1, 0, '', '', '', '', '', '', '', '', '', '', '2017-03-16 22:18:35', '2017-03-16 22:18:35'),
(2, 26, 'Windows', '10.0', 'WebKit', 'Chrome', '::1', 'Desktop', 'United States', 'Connecticut', 'New Haven', '41.31', '2017-03-16 23:42:16', '2017-03-16 23:42:16'),
(3, 29, 'Windows', '10.0', 'WebKit', 'Chrome', '::1', 'Desktop', 'United States', 'Connecticut', 'New Haven', '41.31', '2017-03-17 00:51:47', '2017-03-17 00:51:47'),
(4, 30, 'Windows', '10.0', 'WebKit', 'Chrome', '::1', 'Desktop', 'United States', 'Connecticut', 'New Haven', '41.31', '2017-03-18 19:39:33', '2017-03-18 19:39:33'),
(5, 32, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-03-22 19:40:11', '2017-03-22 19:40:11'),
(6, 34, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-03-22 21:01:47', '2017-03-22 21:01:47'),
(7, 36, 'Windows', '10.0', 'WebKit', 'Chrome', '::1', 'Desktop', 'United States', 'Connecticut', 'New Haven', '41.31, -72.92', '2017-03-24 01:58:42', '2017-03-24 01:58:42'),
(8, 37, 'Windows', '10.0', 'WebKit', 'Chrome', '::1', 'Desktop', 'United States', 'Connecticut', 'New Haven', '41.31, -72.92', '2017-03-24 01:59:21', '2017-03-24 01:59:21'),
(9, 38, 'Windows', '10.0', 'WebKit', 'Chrome', '::1', 'Desktop', 'United States', 'Connecticut', 'New Haven', '41.31, -72.92', '2017-03-24 02:06:44', '2017-03-24 02:06:44'),
(10, 39, 'Windows', '10.0', 'WebKit', 'Chrome', '::1', 'Desktop', 'United States', 'Connecticut', 'New Haven', '41.31, -72.92', '2017-03-24 02:09:26', '2017-03-24 02:09:26'),
(11, 40, 'Windows', '10.0', 'WebKit', 'Chrome', '::1', 'Desktop', 'United States', 'Connecticut', 'New Haven', '41.31, -72.92', '2017-03-24 02:12:20', '2017-03-24 02:12:20'),
(12, 41, 'Windows', '10.0', 'WebKit', 'Chrome', '::1', 'Desktop', 'United States', 'Connecticut', 'New Haven', '41.31, -72.92', '2017-03-24 02:18:59', '2017-03-24 02:18:59'),
(13, 43, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-03-29 14:44:00', '2017-03-29 14:44:00'),
(14, 62, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-03-30 19:28:13', '2017-03-30 19:28:13'),
(15, 65, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-03-30 19:48:17', '2017-03-30 19:48:17'),
(16, 66, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-03-30 19:50:01', '2017-03-30 19:50:01'),
(17, 67, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-03-30 19:59:52', '2017-03-30 19:59:52'),
(18, 68, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-03-30 20:03:46', '2017-03-30 20:03:46'),
(19, 69, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-03-30 20:06:22', '2017-03-30 20:06:22'),
(20, 70, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-03-30 20:08:30', '2017-03-30 20:08:30'),
(21, 71, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-03-30 20:13:45', '2017-03-30 20:13:45'),
(22, 72, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-03-30 20:20:58', '2017-03-30 20:20:58'),
(23, 75, 'Windows', '10.0', 'WebKit', 'Chrome', '::1', 'Desktop', 'United States', 'Connecticut', 'New Haven', '41.31, -72.92', '2017-04-03 17:52:52', '2017-04-03 17:52:52'),
(24, 76, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-04-05 19:43:20', '2017-04-05 19:43:20'),
(25, 81, 'AndroidOS', '6.0', 'HTC', 'Chrome', '190.93.151.78', 'Mobile', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-04-06 22:03:20', '2017-04-06 22:03:20'),
(26, 82, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-04-07 16:45:11', '2017-04-07 16:45:11'),
(27, 83, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-04-07 16:49:11', '2017-04-07 16:49:11'),
(28, 84, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-04-07 16:50:37', '2017-04-07 16:50:37'),
(29, 85, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-04-07 16:58:04', '2017-04-07 16:58:04'),
(30, 86, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-04-07 17:23:45', '2017-04-07 17:23:45'),
(31, 87, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-04-07 17:27:01', '2017-04-07 17:27:01'),
(32, 88, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-04-07 17:32:08', '2017-04-07 17:32:08'),
(33, 89, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-04-07 17:33:16', '2017-04-07 17:33:16'),
(34, 90, 'Windows', '10.0', 'WebKit', 'Chrome', '190.93.151.78', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-04-07 17:53:51', '2017-04-07 17:53:51'),
(35, 91, 'Windows', '10.0', 'WebKit', 'Chrome', '::1', 'Desktop', 'United States', 'Connecticut', 'New Haven', '41.31, -72.92', '2017-04-07 18:32:07', '2017-04-07 18:32:07'),
(36, 92, 'Windows', '10.0', 'WebKit', 'Chrome', '181.49.66.55', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.71099, -74.0721', '2017-04-15 17:11:21', '2017-04-15 17:11:21'),
(37, 16, 'Windows', '10.0', 'WebKit', 'Chrome', '::1', 'Desktop', 'United States', 'Connecticut', 'New Haven', '41.31, -72.92', '2017-05-02 00:47:38', '2017-05-02 00:47:38'),
(38, 16, 'Windows', '10.0', 'WebKit', 'Chrome', '::1', 'Desktop', 'United States', 'Connecticut', 'New Haven', '41.31, -72.92', '2017-05-02 01:12:11', '2017-05-02 01:12:11'),
(39, 16, 'Windows', '10.0', 'WebKit', 'Chrome', '::1', 'Desktop', 'United States', 'Connecticut', 'New Haven', '41.31, -72.92', '2017-05-02 01:12:59', '2017-05-02 01:12:59'),
(40, 16, 'Windows', '10.0', 'WebKit', 'Chrome', '::1', 'Desktop', 'United States', 'Connecticut', 'New Haven', '41.31, -72.92', '2017-05-02 01:17:14', '2017-05-02 01:17:14'),
(41, 16, 'Windows', '10.0', 'WebKit', 'Chrome', '::1', 'Desktop', 'United States', 'Connecticut', 'New Haven', '41.31, -72.92', '2017-05-02 01:18:17', '2017-05-02 01:18:17'),
(42, 93, 'Windows', '10.0', 'WebKit', 'Chrome', '181.49.71.55', 'Desktop', 'Colombia', 'Bogota D.C.', 'Bogotá', '4.6492, -74.0628', '2017-05-02 01:23:18', '2017-05-02 01:23:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_03_01_152428_create_registros_table', 2),
('2017_03_06_095203_create_areas_table', 3),
('2017_03_13_221127_create_tipo_registros_table', 4),
('2017_03_16_131318_create_device_registros_table', 5),
('2017_03_22_153216_create_audits_table', 6),
('2017_04_25_183526_create_permission_tables', 7),
('2017_04_25_221405_create_areas_users_table', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` int(10) NOT NULL,
  `nombre_municipio` varchar(50) NOT NULL,
  `departamento` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `nombre_municipio`, `departamento`) VALUES
(1, 'Leticia', 1),
(2, 'Puerto Nariño', 1),
(3, 'Abejorral', 2),
(4, 'Abriaquí', 2),
(5, 'Alejandria', 2),
(6, 'Amagá', 2),
(7, 'Amalfi', 2),
(8, 'Andes', 2),
(9, 'Angelópolis', 2),
(10, 'Angostura', 2),
(11, 'Anorí', 2),
(12, 'Anzá', 2),
(13, 'Apartadó', 2),
(14, 'Arboletes', 2),
(15, 'Argelia', 2),
(16, 'Armenia', 2),
(17, 'Barbosa', 2),
(18, 'Bello', 2),
(19, 'Belmira', 2),
(20, 'Betania', 2),
(21, 'Betulia', 2),
(22, 'Bolívar', 2),
(23, 'Briceño', 2),
(24, 'Burítica', 2),
(25, 'Caicedo', 2),
(26, 'Caldas', 2),
(27, 'Campamento', 2),
(28, 'Caracolí', 2),
(29, 'Caramanta', 2),
(30, 'Carepa', 2),
(31, 'Carmen de Viboral', 2),
(32, 'Carolina', 2),
(33, 'Caucasia', 2),
(34, 'Cañasgordas', 2),
(35, 'Chigorodó', 2),
(36, 'Cisneros', 2),
(37, 'Cocorná', 2),
(38, 'Concepción', 2),
(39, 'Concordia', 2),
(40, 'Copacabana', 2),
(41, 'Cáceres', 2),
(42, 'Dabeiba', 2),
(43, 'Don Matías', 2),
(44, 'Ebéjico', 2),
(45, 'El Bagre', 2),
(46, 'Entrerríos', 2),
(47, 'Envigado', 2),
(48, 'Fredonia', 2),
(49, 'Frontino', 2),
(50, 'Giraldo', 2),
(51, 'Girardota', 2),
(52, 'Granada', 2),
(53, 'Guadalupe', 2),
(54, 'Guarne', 2),
(55, 'Guatapé', 2),
(56, 'Gómez Plata', 2),
(57, 'Heliconia', 2),
(58, 'Hispania', 2),
(59, 'Itagüí', 2),
(60, 'Ituango', 2),
(61, 'Jardín', 2),
(62, 'Jericó', 2),
(63, 'La Ceja', 2),
(64, 'La Estrella', 2),
(65, 'La Pintada', 2),
(66, 'La Unión', 2),
(67, 'Liborina', 2),
(68, 'Maceo', 2),
(69, 'Marinilla', 2),
(70, 'Medellín', 2),
(71, 'Montebello', 2),
(72, 'Murindó', 2),
(73, 'Mutatá', 2),
(74, 'Nariño', 2),
(75, 'Nechí', 2),
(76, 'Necoclí', 2),
(77, 'Olaya', 2),
(78, 'Peque', 2),
(79, 'Peñol', 2),
(80, 'Pueblorrico', 2),
(81, 'Puerto Berrío', 2),
(82, 'Puerto Nare', 2),
(83, 'Puerto Triunfo', 2),
(84, 'Remedios', 2),
(85, 'Retiro', 2),
(86, 'Ríonegro', 2),
(87, 'Sabanalarga', 2),
(88, 'Sabaneta', 2),
(89, 'Salgar', 2),
(90, 'San Andrés de Cuerquía', 2),
(91, 'San Carlos', 2),
(92, 'San Francisco', 2),
(93, 'San Jerónimo', 2),
(94, 'San José de Montaña', 2),
(95, 'San Juan de Urabá', 2),
(96, 'San Luís', 2),
(97, 'San Pedro', 2),
(98, 'San Pedro de Urabá', 2),
(99, 'San Rafael', 2),
(100, 'San Roque', 2),
(101, 'San Vicente', 2),
(102, 'Santa Bárbara', 2),
(103, 'Santa Fé de Antioquia', 2),
(104, 'Santa Rosa de Osos', 2),
(105, 'Santo Domingo', 2),
(106, 'Santuario', 2),
(107, 'Segovia', 2),
(108, 'Sonsón', 2),
(109, 'Sopetrán', 2),
(110, 'Tarazá', 2),
(111, 'Tarso', 2),
(112, 'Titiribí', 2),
(113, 'Toledo', 2),
(114, 'Turbo', 2),
(115, 'Támesis', 2),
(116, 'Uramita', 2),
(117, 'Urrao', 2),
(118, 'Valdivia', 2),
(119, 'Valparaiso', 2),
(120, 'Vegachí', 2),
(121, 'Venecia', 2),
(122, 'Vigía del Fuerte', 2),
(123, 'Yalí', 2),
(124, 'Yarumal', 2),
(125, 'Yolombó', 2),
(126, 'Yondó (Casabe)', 2),
(127, 'Zaragoza', 2),
(128, 'Arauca', 3),
(129, 'Arauquita', 3),
(130, 'Cravo Norte', 3),
(131, 'Fortúl', 3),
(132, 'Puerto Rondón', 3),
(133, 'Saravena', 3),
(134, 'Tame', 3),
(135, 'Baranoa', 4),
(136, 'Barranquilla', 4),
(137, 'Campo de la Cruz', 4),
(138, 'Candelaria', 4),
(139, 'Galapa', 4),
(140, 'Juan de Acosta', 4),
(141, 'Luruaco', 4),
(142, 'Malambo', 4),
(143, 'Manatí', 4),
(144, 'Palmar de Varela', 4),
(145, 'Piojo', 4),
(146, 'Polonuevo', 4),
(147, 'Ponedera', 4),
(148, 'Puerto Colombia', 4),
(149, 'Repelón', 4),
(150, 'Sabanagrande', 4),
(151, 'Sabanalarga', 4),
(152, 'Santa Lucía', 4),
(153, 'Santo Tomás', 4),
(154, 'Soledad', 4),
(155, 'Suan', 4),
(156, 'Tubará', 4),
(157, 'Usiacuri', 4),
(158, 'Achí', 5),
(159, 'Altos del Rosario', 5),
(160, 'Arenal', 5),
(161, 'Arjona', 5),
(162, 'Arroyohondo', 5),
(163, 'Barranco de Loba', 5),
(164, 'Calamar', 5),
(165, 'Cantagallo', 5),
(166, 'Cartagena', 5),
(167, 'Cicuco', 5),
(168, 'Clemencia', 5),
(169, 'Córdoba', 5),
(170, 'El Carmen de Bolívar', 5),
(171, 'El Guamo', 5),
(172, 'El Peñon', 5),
(173, 'Hatillo de Loba', 5),
(174, 'Magangué', 5),
(175, 'Mahates', 5),
(176, 'Margarita', 5),
(177, 'María la Baja', 5),
(178, 'Mompós', 5),
(179, 'Montecristo', 5),
(180, 'Morales', 5),
(181, 'Norosí', 5),
(182, 'Pinillos', 5),
(183, 'Regidor', 5),
(184, 'Río Viejo', 5),
(185, 'San Cristobal', 5),
(186, 'San Estanislao', 5),
(187, 'San Fernando', 5),
(188, 'San Jacinto', 5),
(189, 'San Jacinto del Cauca', 5),
(190, 'San Juan de Nepomuceno', 5),
(191, 'San Martín de Loba', 5),
(192, 'San Pablo', 5),
(193, 'Santa Catalina', 5),
(194, 'Santa Rosa ', 5),
(195, 'Santa Rosa del Sur', 5),
(196, 'Simití', 5),
(197, 'Soplaviento', 5),
(198, 'Talaigua Nuevo', 5),
(199, 'Tiquisio (Puerto Rico)', 5),
(200, 'Turbaco', 5),
(201, 'Turbaná', 5),
(202, 'Villanueva', 5),
(203, 'Zambrano', 5),
(204, 'Almeida', 6),
(205, 'Aquitania', 6),
(206, 'Arcabuco', 6),
(207, 'Belén', 6),
(208, 'Berbeo', 6),
(209, 'Beteitiva', 6),
(210, 'Boavita', 6),
(211, 'Boyacá', 6),
(212, 'Briceño', 6),
(213, 'Buenavista', 6),
(214, 'Busbanza', 6),
(215, 'Caldas', 6),
(216, 'Campohermoso', 6),
(217, 'Cerinza', 6),
(218, 'Chinavita', 6),
(219, 'Chiquinquirá', 6),
(220, 'Chiscas', 6),
(221, 'Chita', 6),
(222, 'Chitaraque', 6),
(223, 'Chivatá', 6),
(224, 'Chíquiza', 6),
(225, 'Chívor', 6),
(226, 'Ciénaga', 6),
(227, 'Coper', 6),
(228, 'Corrales', 6),
(229, 'Covarachía', 6),
(230, 'Cubará', 6),
(231, 'Cucaita', 6),
(232, 'Cuitiva', 6),
(233, 'Cómbita', 6),
(234, 'Duitama', 6),
(235, 'El Cocuy', 6),
(236, 'El Espino', 6),
(237, 'Firavitoba', 6),
(238, 'Floresta', 6),
(239, 'Gachantivá', 6),
(240, 'Garagoa', 6),
(241, 'Guacamayas', 6),
(242, 'Guateque', 6),
(243, 'Guayatá', 6),
(244, 'Guicán', 6),
(245, 'Gámeza', 6),
(246, 'Izá', 6),
(247, 'Jenesano', 6),
(248, 'Jericó', 6),
(249, 'La Capilla', 6),
(250, 'La Uvita', 6),
(251, 'La Victoria', 6),
(252, 'Labranzagrande', 6),
(253, 'Macanal', 6),
(254, 'Maripí', 6),
(255, 'Miraflores', 6),
(256, 'Mongua', 6),
(257, 'Monguí', 6),
(258, 'Moniquirá', 6),
(259, 'Motavita', 6),
(260, 'Muzo', 6),
(261, 'Nobsa', 6),
(262, 'Nuevo Colón', 6),
(263, 'Oicatá', 6),
(264, 'Otanche', 6),
(265, 'Pachavita', 6),
(266, 'Paipa', 6),
(267, 'Pajarito', 6),
(268, 'Panqueba', 6),
(269, 'Pauna', 6),
(270, 'Paya', 6),
(271, 'Paz de Río', 6),
(272, 'Pesca', 6),
(273, 'Pisva', 6),
(274, 'Puerto Boyacá', 6),
(275, 'Páez', 6),
(276, 'Quipama', 6),
(277, 'Ramiriquí', 6),
(278, 'Rondón', 6),
(279, 'Ráquira', 6),
(280, 'Saboyá', 6),
(281, 'Samacá', 6),
(282, 'San Eduardo', 6),
(283, 'San José de Pare', 6),
(284, 'San Luís de Gaceno', 6),
(285, 'San Mateo', 6),
(286, 'San Miguel de Sema', 6),
(287, 'San Pablo de Borbur', 6),
(288, 'Santa María', 6),
(289, 'Santa Rosa de Viterbo', 6),
(290, 'Santa Sofía', 6),
(291, 'Santana', 6),
(292, 'Sativanorte', 6),
(293, 'Sativasur', 6),
(294, 'Siachoque', 6),
(295, 'Soatá', 6),
(296, 'Socha', 6),
(297, 'Socotá', 6),
(298, 'Sogamoso', 6),
(299, 'Somondoco', 6),
(300, 'Sora', 6),
(301, 'Soracá', 6),
(302, 'Sotaquirá', 6),
(303, 'Susacón', 6),
(304, 'Sutamarchán', 6),
(305, 'Sutatenza', 6),
(306, 'Sáchica', 6),
(307, 'Tasco', 6),
(308, 'Tenza', 6),
(309, 'Tibaná', 6),
(310, 'Tibasosa', 6),
(311, 'Tinjacá', 6),
(312, 'Tipacoque', 6),
(313, 'Toca', 6),
(314, 'Toguí', 6),
(315, 'Topagá', 6),
(316, 'Tota', 6),
(317, 'Tunja', 6),
(318, 'Tunungua', 6),
(319, 'Turmequé', 6),
(320, 'Tuta', 6),
(321, 'Tutasá', 6),
(322, 'Ventaquemada', 6),
(323, 'Villa de Leiva', 6),
(324, 'Viracachá', 6),
(325, 'Zetaquirá', 6),
(326, 'Úmbita', 6),
(327, 'Aguadas', 7),
(328, 'Anserma', 7),
(329, 'Aranzazu', 7),
(330, 'Belalcázar', 7),
(331, 'Chinchiná', 7),
(332, 'Filadelfia', 7),
(333, 'La Dorada', 7),
(334, 'La Merced', 7),
(335, 'La Victoria', 7),
(336, 'Manizales', 7),
(337, 'Manzanares', 7),
(338, 'Marmato', 7),
(339, 'Marquetalia', 7),
(340, 'Marulanda', 7),
(341, 'Neira', 7),
(342, 'Norcasia', 7),
(343, 'Palestina', 7),
(344, 'Pensilvania', 7),
(345, 'Pácora', 7),
(346, 'Risaralda', 7),
(347, 'Río Sucio', 7),
(348, 'Salamina', 7),
(349, 'Samaná', 7),
(350, 'San José', 7),
(351, 'Supía', 7),
(352, 'Villamaría', 7),
(353, 'Viterbo', 7),
(354, 'Albania', 8),
(355, 'Belén de los Andaquíes', 8),
(356, 'Cartagena del Chairá', 8),
(357, 'Curillo', 8),
(358, 'El Doncello', 8),
(359, 'El Paujil', 8),
(360, 'Florencia', 8),
(361, 'La Montañita', 8),
(362, 'Milán', 8),
(363, 'Morelia', 8),
(364, 'Puerto Rico', 8),
(365, 'San José del Fragua', 8),
(366, 'San Vicente del Caguán', 8),
(367, 'Solano', 8),
(368, 'Solita', 8),
(369, 'Valparaiso', 8),
(370, 'Aguazul', 9),
(371, 'Chámeza', 9),
(372, 'Hato Corozal', 9),
(373, 'La Salina', 9),
(374, 'Maní', 9),
(375, 'Monterrey', 9),
(376, 'Nunchía', 9),
(377, 'Orocué', 9),
(378, 'Paz de Ariporo', 9),
(379, 'Pore', 9),
(380, 'Recetor', 9),
(381, 'Sabanalarga', 9),
(382, 'San Luís de Palenque', 9),
(383, 'Sácama', 9),
(384, 'Tauramena', 9),
(385, 'Trinidad', 9),
(386, 'Támara', 9),
(387, 'Villanueva', 9),
(388, 'Yopal', 9),
(389, 'Almaguer', 10),
(390, 'Argelia', 10),
(391, 'Balboa', 10),
(392, 'Bolívar', 10),
(393, 'Buenos Aires', 10),
(394, 'Cajibío', 10),
(395, 'Caldono', 10),
(396, 'Caloto', 10),
(397, 'Corinto', 10),
(398, 'El Tambo', 10),
(399, 'Florencia', 10),
(400, 'Guachené', 10),
(401, 'Guapí', 10),
(402, 'Inzá', 10),
(403, 'Jambaló', 10),
(404, 'La Sierra', 10),
(405, 'La Vega', 10),
(406, 'López (Micay)', 10),
(407, 'Mercaderes', 10),
(408, 'Miranda', 10),
(409, 'Morales', 10),
(410, 'Padilla', 10),
(411, 'Patía (El Bordo)', 10),
(412, 'Piamonte', 10),
(413, 'Piendamó', 10),
(414, 'Popayán', 10),
(415, 'Puerto Tejada', 10),
(416, 'Puracé (Coconuco)', 10),
(417, 'Páez (Belalcazar)', 10),
(418, 'Rosas', 10),
(419, 'San Sebastián', 10),
(420, 'Santa Rosa', 10),
(421, 'Santander de Quilichao', 10),
(422, 'Silvia', 10),
(423, 'Sotara (Paispamba)', 10),
(424, 'Sucre', 10),
(425, 'Suárez', 10),
(426, 'Timbiquí', 10),
(427, 'Timbío', 10),
(428, 'Toribío', 10),
(429, 'Totoró', 10),
(430, 'Villa Rica', 10),
(431, 'Aguachica', 11),
(432, 'Agustín Codazzi', 11),
(433, 'Astrea', 11),
(434, 'Becerríl', 11),
(435, 'Bosconia', 11),
(436, 'Chimichagua', 11),
(437, 'Chiriguaná', 11),
(438, 'Curumaní', 11),
(439, 'El Copey', 11),
(440, 'El Paso', 11),
(441, 'Gamarra', 11),
(442, 'Gonzalez', 11),
(443, 'La Gloria', 11),
(444, 'La Jagua de Ibirico', 11),
(445, 'La Paz (Robles)', 11),
(446, 'Manaure Balcón del Cesar', 11),
(447, 'Pailitas', 11),
(448, 'Pelaya', 11),
(449, 'Pueblo Bello', 11),
(450, 'Río de oro', 11),
(451, 'San Alberto', 11),
(452, 'San Diego', 11),
(453, 'San Martín', 11),
(454, 'Tamalameque', 11),
(455, 'Valledupar', 11),
(456, 'Acandí', 12),
(457, 'Alto Baudó (Pie de Pato)', 12),
(458, 'Atrato (Yuto)', 12),
(459, 'Bagadó', 12),
(460, 'Bahía Solano (Mútis)', 12),
(461, 'Bajo Baudó (Pizarro)', 12),
(462, 'Belén de Bajirá', 12),
(463, 'Bojayá (Bellavista)', 12),
(464, 'Cantón de San Pablo', 12),
(465, 'Carmen del Darién (CURBARADÓ)', 12),
(466, 'Condoto', 12),
(467, 'Cértegui', 12),
(468, 'El Carmen de Atrato', 12),
(469, 'Istmina', 12),
(470, 'Juradó', 12),
(471, 'Lloró', 12),
(472, 'Medio Atrato', 12),
(473, 'Medio Baudó', 12),
(474, 'Medio San Juan (ANDAGOYA)', 12),
(475, 'Novita', 12),
(476, 'Nuquí', 12),
(477, 'Quibdó', 12),
(478, 'Río Iró', 12),
(479, 'Río Quito', 12),
(480, 'Ríosucio', 12),
(481, 'San José del Palmar', 12),
(482, 'Santa Genoveva de Docorodó', 12),
(483, 'Sipí', 12),
(484, 'Tadó', 12),
(485, 'Unguía', 12),
(486, 'Unión Panamericana (ÁNIMAS)', 12),
(487, 'Ayapel', 13),
(488, 'Buenavista', 13),
(489, 'Canalete', 13),
(490, 'Cereté', 13),
(491, 'Chimá', 13),
(492, 'Chinú', 13),
(493, 'Ciénaga de Oro', 13),
(494, 'Cotorra', 13),
(495, 'La Apartada y La Frontera', 13),
(496, 'Lorica', 13),
(497, 'Los Córdobas', 13),
(498, 'Momil', 13),
(499, 'Montelíbano', 13),
(500, 'Monteria', 13),
(501, 'Moñitos', 13),
(502, 'Planeta Rica', 13),
(503, 'Pueblo Nuevo', 13),
(504, 'Puerto Escondido', 13),
(505, 'Puerto Libertador', 13),
(506, 'Purísima', 13),
(507, 'Sahagún', 13),
(508, 'San Andrés Sotavento', 13),
(509, 'San Antero', 13),
(510, 'San Bernardo del Viento', 13),
(511, 'San Carlos', 13),
(512, 'San José de Uré', 13),
(513, 'San Pelayo', 13),
(514, 'Tierralta', 13),
(515, 'Tuchín', 13),
(516, 'Valencia', 13),
(517, 'Agua de Dios', 14),
(518, 'Albán', 14),
(519, 'Anapoima', 14),
(520, 'Anolaima', 14),
(521, 'Apulo', 14),
(522, 'Arbeláez', 14),
(523, 'Beltrán', 14),
(524, 'Bituima', 14),
(525, 'Bogotá D.C.', 14),
(526, 'Bojacá', 14),
(527, 'Cabrera', 14),
(528, 'Cachipay', 14),
(529, 'Cajicá', 14),
(530, 'Caparrapí', 14),
(531, 'Carmen de Carupa', 14),
(532, 'Chaguaní', 14),
(533, 'Chipaque', 14),
(534, 'Choachí', 14),
(535, 'Chocontá', 14),
(536, 'Chía', 14),
(537, 'Cogua', 14),
(538, 'Cota', 14),
(539, 'Cucunubá', 14),
(540, 'Cáqueza', 14),
(541, 'El Colegio', 14),
(542, 'El Peñón', 14),
(543, 'El Rosal', 14),
(544, 'Facatativá', 14),
(545, 'Fosca', 14),
(546, 'Funza', 14),
(547, 'Fusagasugá', 14),
(548, 'Fómeque', 14),
(549, 'Fúquene', 14),
(550, 'Gachalá', 14),
(551, 'Gachancipá', 14),
(552, 'Gachetá', 14),
(553, 'Gama', 14),
(554, 'Girardot', 14),
(555, 'Granada', 14),
(556, 'Guachetá', 14),
(557, 'Guaduas', 14),
(558, 'Guasca', 14),
(559, 'Guataquí', 14),
(560, 'Guatavita', 14),
(561, 'Guayabal de Siquima', 14),
(562, 'Guayabetal', 14),
(563, 'Gutiérrez', 14),
(564, 'Jerusalén', 14),
(565, 'Junín', 14),
(566, 'La Calera', 14),
(567, 'La Mesa', 14),
(568, 'La Palma', 14),
(569, 'La Peña', 14),
(570, 'La Vega', 14),
(571, 'Lenguazaque', 14),
(572, 'Machetá', 14),
(573, 'Madrid', 14),
(574, 'Manta', 14),
(575, 'Medina', 14),
(576, 'Mosquera', 14),
(577, 'Nariño', 14),
(578, 'Nemocón', 14),
(579, 'Nilo', 14),
(580, 'Nimaima', 14),
(581, 'Nocaima', 14),
(582, 'Pacho', 14),
(583, 'Paime', 14),
(584, 'Pandi', 14),
(585, 'Paratebueno', 14),
(586, 'Pasca', 14),
(587, 'Puerto Salgar', 14),
(588, 'Pulí', 14),
(589, 'Quebradanegra', 14),
(590, 'Quetame', 14),
(591, 'Quipile', 14),
(592, 'Ricaurte', 14),
(593, 'San Antonio de Tequendama', 14),
(594, 'San Bernardo', 14),
(595, 'San Cayetano', 14),
(596, 'San Francisco', 14),
(597, 'San Juan de Río Seco', 14),
(598, 'Sasaima', 14),
(599, 'Sesquilé', 14),
(600, 'Sibaté', 14),
(601, 'Silvania', 14),
(602, 'Simijaca', 14),
(603, 'Soacha', 14),
(604, 'Sopó', 14),
(605, 'Subachoque', 14),
(606, 'Suesca', 14),
(607, 'Supatá', 14),
(608, 'Susa', 14),
(609, 'Sutatausa', 14),
(610, 'Tabio', 14),
(611, 'Tausa', 14),
(612, 'Tena', 14),
(613, 'Tenjo', 14),
(614, 'Tibacuy', 14),
(615, 'Tibirita', 14),
(616, 'Tocaima', 14),
(617, 'Tocancipá', 14),
(618, 'Topaipí', 14),
(619, 'Ubalá', 14),
(620, 'Ubaque', 14),
(621, 'Ubaté', 14),
(622, 'Une', 14),
(623, 'Venecia (Ospina Pérez)', 14),
(624, 'Vergara', 14),
(625, 'Viani', 14),
(626, 'Villagómez', 14),
(627, 'Villapinzón', 14),
(628, 'Villeta', 14),
(629, 'Viotá', 14),
(630, 'Yacopí', 14),
(631, 'Zipacón', 14),
(632, 'Zipaquirá', 14),
(633, 'Útica', 14),
(634, 'Inírida', 15),
(635, 'Calamar', 16),
(636, 'El Retorno', 16),
(637, 'Miraflores', 16),
(638, 'San José del Guaviare', 16),
(639, 'Acevedo', 17),
(640, 'Agrado', 17),
(641, 'Aipe', 17),
(642, 'Algeciras', 17),
(643, 'Altamira', 17),
(644, 'Baraya', 17),
(645, 'Campoalegre', 17),
(646, 'Colombia', 17),
(647, 'Elías', 17),
(648, 'Garzón', 17),
(649, 'Gigante', 17),
(650, 'Guadalupe', 17),
(651, 'Hobo', 17),
(652, 'Isnos', 17),
(653, 'La Argentina', 17),
(654, 'La Plata', 17),
(655, 'Neiva', 17),
(656, 'Nátaga', 17),
(657, 'Oporapa', 17),
(658, 'Paicol', 17),
(659, 'Palermo', 17),
(660, 'Palestina', 17),
(661, 'Pital', 17),
(662, 'Pitalito', 17),
(663, 'Rivera', 17),
(664, 'Saladoblanco', 17),
(665, 'San Agustín', 17),
(666, 'Santa María', 17),
(667, 'Suaza', 17),
(668, 'Tarqui', 17),
(669, 'Tello', 17),
(670, 'Teruel', 17),
(671, 'Tesalia', 17),
(672, 'Timaná', 17),
(673, 'Villavieja', 17),
(674, 'Yaguará', 17),
(675, 'Íquira', 17),
(676, 'Albania', 18),
(677, 'Barrancas', 18),
(678, 'Dibulla', 18),
(679, 'Distracción', 18),
(680, 'El Molino', 18),
(681, 'Fonseca', 18),
(682, 'Hatonuevo', 18),
(683, 'La Jagua del Pilar', 18),
(684, 'Maicao', 18),
(685, 'Manaure', 18),
(686, 'Riohacha', 18),
(687, 'San Juan del Cesar', 18),
(688, 'Uribia', 18),
(689, 'Urumita', 18),
(690, 'Villanueva', 18),
(691, 'Algarrobo', 19),
(692, 'Aracataca', 19),
(693, 'Ariguaní (El Difícil)', 19),
(694, 'Cerro San Antonio', 19),
(695, 'Chivolo', 19),
(696, 'Ciénaga', 19),
(697, 'Concordia', 19),
(698, 'El Banco', 19),
(699, 'El Piñon', 19),
(700, 'El Retén', 19),
(701, 'Fundación', 19),
(702, 'Guamal', 19),
(703, 'Nueva Granada', 19),
(704, 'Pedraza', 19),
(705, 'Pijiño', 19),
(706, 'Pivijay', 19),
(707, 'Plato', 19),
(708, 'Puebloviejo', 19),
(709, 'Remolino', 19),
(710, 'Sabanas de San Angel (SAN ANGEL)', 19),
(711, 'Salamina', 19),
(712, 'San Sebastián de Buenavista', 19),
(713, 'San Zenón', 19),
(714, 'Santa Ana', 19),
(715, 'Santa Bárbara de Pinto', 19),
(716, 'Santa Marta', 19),
(717, 'Sitionuevo', 19),
(718, 'Tenerife', 19),
(719, 'Zapayán (PUNTA DE PIEDRAS)', 19),
(720, 'Zona Bananera (PRADO - SEVILLA)', 19),
(721, 'Acacías', 20),
(722, 'Barranca de Upía', 20),
(723, 'Cabuyaro', 20),
(724, 'Castilla la Nueva', 20),
(725, 'Cubarral', 20),
(726, 'Cumaral', 20),
(727, 'El Calvario', 20),
(728, 'El Castillo', 20),
(729, 'El Dorado', 20),
(730, 'Fuente de Oro', 20),
(731, 'Granada', 20),
(732, 'Guamal', 20),
(733, 'La Macarena', 20),
(734, 'Lejanías', 20),
(735, 'Mapiripan', 20),
(736, 'Mesetas', 20),
(737, 'Puerto Concordia', 20),
(738, 'Puerto Gaitán', 20),
(739, 'Puerto Lleras', 20),
(740, 'Puerto López', 20),
(741, 'Puerto Rico', 20),
(742, 'Restrepo', 20),
(743, 'San Carlos de Guaroa', 20),
(744, 'San Juan de Arama', 20),
(745, 'San Juanito', 20),
(746, 'San Martín', 20),
(747, 'Uribe', 20),
(748, 'Villavicencio', 20),
(749, 'Vista Hermosa', 20),
(750, 'Albán (San José)', 21),
(751, 'Aldana', 21),
(752, 'Ancuya', 21),
(753, 'Arboleda (Berruecos)', 21),
(754, 'Barbacoas', 21),
(755, 'Belén', 21),
(756, 'Buesaco', 21),
(757, 'Chachaguí', 21),
(758, 'Colón (Génova)', 21),
(759, 'Consaca', 21),
(760, 'Contadero', 21),
(761, 'Cuaspud (Carlosama)', 21),
(762, 'Cumbal', 21),
(763, 'Cumbitara', 21),
(764, 'Córdoba', 21),
(765, 'El Charco', 21),
(766, 'El Peñol', 21),
(767, 'El Rosario', 21),
(768, 'El Tablón de Gómez', 21),
(769, 'El Tambo', 21),
(770, 'Francisco Pizarro', 21),
(771, 'Funes', 21),
(772, 'Guachavés', 21),
(773, 'Guachucal', 21),
(774, 'Guaitarilla', 21),
(775, 'Gualmatán', 21),
(776, 'Iles', 21),
(777, 'Imúes', 21),
(778, 'Ipiales', 21),
(779, 'La Cruz', 21),
(780, 'La Florida', 21),
(781, 'La Llanada', 21),
(782, 'La Tola', 21),
(783, 'La Unión', 21),
(784, 'Leiva', 21),
(785, 'Linares', 21),
(786, 'Magüi (Payán)', 21),
(787, 'Mallama (Piedrancha)', 21),
(788, 'Mosquera', 21),
(789, 'Nariño', 21),
(790, 'Olaya Herrera', 21),
(791, 'Ospina', 21),
(792, 'Policarpa', 21),
(793, 'Potosí', 21),
(794, 'Providencia', 21),
(795, 'Puerres', 21),
(796, 'Pupiales', 21),
(797, 'Ricaurte', 21),
(798, 'Roberto Payán (San José)', 21),
(799, 'Samaniego', 21),
(800, 'San Bernardo', 21),
(801, 'San Juan de Pasto', 21),
(802, 'San Lorenzo', 21),
(803, 'San Pablo', 21),
(804, 'San Pedro de Cartago', 21),
(805, 'Sandoná', 21),
(806, 'Santa Bárbara (Iscuandé)', 21),
(807, 'Sapuyes', 21),
(808, 'Sotomayor (Los Andes)', 21),
(809, 'Taminango', 21),
(810, 'Tangua', 21),
(811, 'Tumaco', 21),
(812, 'Túquerres', 21),
(813, 'Yacuanquer', 21),
(814, 'Arboledas', 22),
(815, 'Bochalema', 22),
(816, 'Bucarasica', 22),
(817, 'Chinácota', 22),
(818, 'Chitagá', 22),
(819, 'Convención', 22),
(820, 'Cucutilla', 22),
(821, 'Cáchira', 22),
(822, 'Cácota', 22),
(823, 'Cúcuta', 22),
(824, 'Durania', 22),
(825, 'El Carmen', 22),
(826, 'El Tarra', 22),
(827, 'El Zulia', 22),
(828, 'Gramalote', 22),
(829, 'Hacarí', 22),
(830, 'Herrán', 22),
(831, 'La Esperanza', 22),
(832, 'La Playa', 22),
(833, 'Labateca', 22),
(834, 'Los Patios', 22),
(835, 'Lourdes', 22),
(836, 'Mutiscua', 22),
(837, 'Ocaña', 22),
(838, 'Pamplona', 22),
(839, 'Pamplonita', 22),
(840, 'Puerto Santander', 22),
(841, 'Ragonvalia', 22),
(842, 'Salazar', 22),
(843, 'San Calixto', 22),
(844, 'San Cayetano', 22),
(845, 'Santiago', 22),
(846, 'Sardinata', 22),
(847, 'Silos', 22),
(848, 'Teorama', 22),
(849, 'Tibú', 22),
(850, 'Toledo', 22),
(851, 'Villa Caro', 22),
(852, 'Villa del Rosario', 22),
(853, 'Ábrego', 22),
(854, 'Colón', 23),
(855, 'Mocoa', 23),
(856, 'Orito', 23),
(857, 'Puerto Asís', 23),
(858, 'Puerto Caicedo', 23),
(859, 'Puerto Guzmán', 23),
(860, 'Puerto Leguízamo', 23),
(861, 'San Francisco', 23),
(862, 'San Miguel', 23),
(863, 'Santiago', 23),
(864, 'Sibundoy', 23),
(865, 'Valle del Guamuez', 23),
(866, 'Villagarzón', 23),
(867, 'Armenia', 24),
(868, 'Buenavista', 24),
(869, 'Calarcá', 24),
(870, 'Circasia', 24),
(871, 'Cordobá', 24),
(872, 'Filandia', 24),
(873, 'Génova', 24),
(874, 'La Tebaida', 24),
(875, 'Montenegro', 24),
(876, 'Pijao', 24),
(877, 'Quimbaya', 24),
(878, 'Salento', 24),
(879, 'Apía', 25),
(880, 'Balboa', 25),
(881, 'Belén de Umbría', 25),
(882, 'Dos Quebradas', 25),
(883, 'Guática', 25),
(884, 'La Celia', 25),
(885, 'La Virginia', 25),
(886, 'Marsella', 25),
(887, 'Mistrató', 25),
(888, 'Pereira', 25),
(889, 'Pueblo Rico', 25),
(890, 'Quinchía', 25),
(891, 'Santa Rosa de Cabal', 25),
(892, 'Santuario', 25),
(893, 'Providencia', 26),
(894, 'Aguada', 27),
(895, 'Albania', 27),
(896, 'Aratoca', 27),
(897, 'Barbosa', 27),
(898, 'Barichara', 27),
(899, 'Barrancabermeja', 27),
(900, 'Betulia', 27),
(901, 'Bolívar', 27),
(902, 'Bucaramanga', 27),
(903, 'Cabrera', 27),
(904, 'California', 27),
(905, 'Capitanejo', 27),
(906, 'Carcasí', 27),
(907, 'Cepita', 27),
(908, 'Cerrito', 27),
(909, 'Charalá', 27),
(910, 'Charta', 27),
(911, 'Chima', 27),
(912, 'Chipatá', 27),
(913, 'Cimitarra', 27),
(914, 'Concepción', 27),
(915, 'Confines', 27),
(916, 'Contratación', 27),
(917, 'Coromoro', 27),
(918, 'Curití', 27),
(919, 'El Carmen', 27),
(920, 'El Guacamayo', 27),
(921, 'El Peñon', 27),
(922, 'El Playón', 27),
(923, 'Encino', 27),
(924, 'Enciso', 27),
(925, 'Floridablanca', 27),
(926, 'Florián', 27),
(927, 'Galán', 27),
(928, 'Girón', 27),
(929, 'Guaca', 27),
(930, 'Guadalupe', 27),
(931, 'Guapota', 27),
(932, 'Guavatá', 27),
(933, 'Guepsa', 27),
(934, 'Gámbita', 27),
(935, 'Hato', 27),
(936, 'Jesús María', 27),
(937, 'Jordán', 27),
(938, 'La Belleza', 27),
(939, 'La Paz', 27),
(940, 'Landázuri', 27),
(941, 'Lebrija', 27),
(942, 'Los Santos', 27),
(943, 'Macaravita', 27),
(944, 'Matanza', 27),
(945, 'Mogotes', 27),
(946, 'Molagavita', 27),
(947, 'Málaga', 27),
(948, 'Ocamonte', 27),
(949, 'Oiba', 27),
(950, 'Onzaga', 27),
(951, 'Palmar', 27),
(952, 'Palmas del Socorro', 27),
(953, 'Pie de Cuesta', 27),
(954, 'Pinchote', 27),
(955, 'Puente Nacional', 27),
(956, 'Puerto Parra', 27),
(957, 'Puerto Wilches', 27),
(958, 'Páramo', 27),
(959, 'Rio Negro', 27),
(960, 'Sabana de Torres', 27),
(961, 'San Andrés', 27),
(962, 'San Benito', 27),
(963, 'San Gíl', 27),
(964, 'San Joaquín', 27),
(965, 'San José de Miranda', 27),
(966, 'San Miguel', 27),
(967, 'San Vicente del Chucurí', 27),
(968, 'Santa Bárbara', 27),
(969, 'Santa Helena del Opón', 27),
(970, 'Simacota', 27),
(971, 'Socorro', 27),
(972, 'Suaita', 27),
(973, 'Sucre', 27),
(974, 'Suratá', 27),
(975, 'Tona', 27),
(976, 'Valle de San José', 27),
(977, 'Vetas', 27),
(978, 'Villanueva', 27),
(979, 'Vélez', 27),
(980, 'Zapatoca', 27),
(981, 'Buenavista', 28),
(982, 'Caimito', 28),
(983, 'Chalán', 28),
(984, 'Colosó (Ricaurte)', 28),
(985, 'Corozal', 28),
(986, 'Coveñas', 28),
(987, 'El Roble', 28),
(988, 'Galeras (Nueva Granada)', 28),
(989, 'Guaranda', 28),
(990, 'La Unión', 28),
(991, 'Los Palmitos', 28),
(992, 'Majagual', 28),
(993, 'Morroa', 28),
(994, 'Ovejas', 28),
(995, 'Palmito', 28),
(996, 'Sampués', 28),
(997, 'San Benito Abad', 28),
(998, 'San Juan de Betulia', 28),
(999, 'San Marcos', 28),
(1000, 'San Onofre', 28),
(1001, 'San Pedro', 28),
(1002, 'Sincelejo', 28),
(1003, 'Sincé', 28),
(1004, 'Sucre', 28),
(1005, 'Tolú', 28),
(1006, 'Tolú Viejo', 28),
(1007, 'Alpujarra', 29),
(1008, 'Alvarado', 29),
(1009, 'Ambalema', 29),
(1010, 'Anzoátegui', 29),
(1011, 'Armero (Guayabal)', 29),
(1012, 'Ataco', 29),
(1013, 'Cajamarca', 29),
(1014, 'Carmen de Apicalá', 29),
(1015, 'Casabianca', 29),
(1016, 'Chaparral', 29),
(1017, 'Coello', 29),
(1018, 'Coyaima', 29),
(1019, 'Cunday', 29),
(1020, 'Dolores', 29),
(1021, 'Espinal', 29),
(1022, 'Falan', 29),
(1023, 'Flandes', 29),
(1024, 'Fresno', 29),
(1025, 'Guamo', 29),
(1026, 'Herveo', 29),
(1027, 'Honda', 29),
(1028, 'Ibagué', 29),
(1029, 'Icononzo', 29),
(1030, 'Lérida', 29),
(1031, 'Líbano', 29),
(1032, 'Mariquita', 29),
(1033, 'Melgar', 29),
(1034, 'Murillo', 29),
(1035, 'Natagaima', 29),
(1036, 'Ortega', 29),
(1037, 'Palocabildo', 29),
(1038, 'Piedras', 29),
(1039, 'Planadas', 29),
(1040, 'Prado', 29),
(1041, 'Purificación', 29),
(1042, 'Rioblanco', 29),
(1043, 'Roncesvalles', 29),
(1044, 'Rovira', 29),
(1045, 'Saldaña', 29),
(1046, 'San Antonio', 29),
(1047, 'San Luis', 29),
(1048, 'Santa Isabel', 29),
(1049, 'Suárez', 29),
(1050, 'Valle de San Juan', 29),
(1051, 'Venadillo', 29),
(1052, 'Villahermosa', 29),
(1053, 'Villarrica', 29),
(1054, 'Alcalá', 30),
(1055, 'Andalucía', 30),
(1056, 'Ansermanuevo', 30),
(1057, 'Argelia', 30),
(1058, 'Bolívar', 30),
(1059, 'Buenaventura', 30),
(1060, 'Buga', 30),
(1061, 'Bugalagrande', 30),
(1062, 'Caicedonia', 30),
(1063, 'Calima (Darién)', 30),
(1064, 'Calí', 30),
(1065, 'Candelaria', 30),
(1066, 'Cartago', 30),
(1067, 'Dagua', 30),
(1068, 'El Cairo', 30),
(1069, 'El Cerrito', 30),
(1070, 'El Dovio', 30),
(1071, 'El Águila', 30),
(1072, 'Florida', 30),
(1073, 'Ginebra', 30),
(1074, 'Guacarí', 30),
(1075, 'Jamundí', 30),
(1076, 'La Cumbre', 30),
(1077, 'La Unión', 30),
(1078, 'La Victoria', 30),
(1079, 'Obando', 30),
(1080, 'Palmira', 30),
(1081, 'Pradera', 30),
(1082, 'Restrepo', 30),
(1083, 'Riofrío', 30),
(1084, 'Roldanillo', 30),
(1085, 'San Pedro', 30),
(1086, 'Sevilla', 30),
(1087, 'Toro', 30),
(1088, 'Trujillo', 30),
(1089, 'Tulúa', 30),
(1090, 'Ulloa', 30),
(1091, 'Versalles', 30),
(1092, 'Vijes', 30),
(1093, 'Yotoco', 30),
(1094, 'Yumbo', 30),
(1095, 'Zarzal', 30),
(1096, 'Carurú', 31),
(1097, 'Mitú', 31),
(1098, 'Taraira', 31),
(1099, 'Cumaribo', 32),
(1100, 'La Primavera', 32),
(1101, 'Puerto Carreño', 32),
(1102, 'Santa Rosalía', 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('maribel.rodriguez@annardx.com', 'dc447413058e5dfd31683b08254ec0a87ccb8ffd418ecd9556799509649b4150', '2017-04-15 16:47:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'crear registros', '2017-04-26 03:35:08', '2017-04-26 03:35:08'),
(2, 'modificar registros', '2017-04-26 03:35:44', '2017-04-26 03:35:44'),
(3, 'baja', '2017-04-26 03:35:53', '2017-04-26 03:35:53'),
(4, 'ver registros', '2017-04-26 03:36:02', '2017-04-26 03:36:02'),
(5, 'subida masiva', '2017-04-26 03:36:19', '2017-04-26 03:36:19'),
(6, 'reportes', '2017-04-26 03:36:34', '2017-04-26 03:36:34'),
(9, 'areas', '2017-04-28 21:02:10', '2017-04-28 21:02:10'),
(10, 'roles y permisos', '2017-04-28 21:02:27', '2017-04-28 21:02:27');

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
  `telefono_personal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_corporativo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular_corporativo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_corporativo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `municipio_id` int(11) NOT NULL,
  `archivo_soporte` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area_id` int(11) UNSIGNED NOT NULL,
  `procedencia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_registro` int(11) DEFAULT NULL,
  `menor_de_18` tinyint(1) NOT NULL,
  `comentarios` text COLLATE utf8_unicode_ci,
  `asesor_comercial` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `estado_cliente` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creado_por` int(11) NOT NULL,
  `modificado_por` int(11) NOT NULL,
  `baja_por` int(11) DEFAULT NULL,
  `subida_masiva_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`id`, `sn`, `nombre`, `primer_apellido`, `segundo_apellido`, `tipo_documento`, `doc`, `fecha_nacimiento`, `profesion`, `cargo`, `empresa`, `telefono_personal`, `telefono_corporativo`, `celular`, `celular_corporativo`, `email`, `email_corporativo`, `direccion`, `municipio_id`, `archivo_soporte`, `area_id`, `procedencia`, `tipo_registro`, `menor_de_18`, `comentarios`, `asesor_comercial`, `estado`, `estado_cliente`, `creado_por`, `modificado_por`, `baja_por`, `subida_masiva_id`, `created_at`, `updated_at`) VALUES
(1, '', 'Juan Andres', 'Ruiz', 'Lopez', 'Cédula de Ciudadanía', '805564873', '1971-06-11', 'Ingeniero', 'Analista', 'Annardx', '7854586', '', NULL, NULL, '', NULL, '', 525, '1489178796.PNG', 6, 'Administración', 0, 0, NULL, '0', 1, '0', 2, 2, 0, 0, '2017-03-10 20:46:36', '2017-03-10 20:47:08'),
(2, '', 'Maria', 'Castro', 'Riaño', 'Cédula de Ciudadanía', '102154414584', '1991-02-07', 'Publicista', 'Comercial', 'Annardx', '74715481', '', NULL, NULL, '', NULL, '', 525, '1489179043.pdf', 1, 'Administración', 0, 0, NULL, '0', 1, '0', 2, 2, 0, 0, '2017-03-10 20:50:43', '2017-03-10 20:53:32'),
(3, '', 'Pedro', 'Romero', 'Paez', 'Cédula de Ciudadanía', '102154240', '1985-01-30', 'Ingeniero Industrial', 'Administración', 'Annardx', '78712145', '', NULL, NULL, '', NULL, '', 70, '1489179336.png', 2, 'Administración', 0, 0, NULL, '0', 1, '0', 2, 0, 0, 0, '2017-03-10 20:55:36', '2017-03-10 20:55:36'),
(4, '', 'Andrea', 'Martinez', 'Gonzales', 'Cédula de Ciudadanía', '1021541545', '1983-02-11', 'Ingeniera Electrónica ', 'Soporte', 'Annardx', '78545868', '', NULL, NULL, '', NULL, '', 525, '1489179498.png', 3, 'Administración', 0, 0, NULL, '0', 1, '0', 2, 2, 0, 0, '2017-03-10 20:58:01', '2017-03-10 20:58:18'),
(5, '', 'Pedro', 'Doe', 'Paez', 'Cédula de Ciudadanía', '55787', '2003-01-29', 'Ingeniero', 'Analista', 'Annardx', '74715485', '', NULL, NULL, '', NULL, '', 525, NULL, 1, 'Formulario_mercadeo', 0, 0, NULL, '0', 1, '0', 0, 0, 0, 0, '2017-03-10 21:12:46', '2017-03-10 21:12:46'),
(6, '', 'Juan', 'Romero', 'Paez', 'Cédula de Ciudadanía', '4343434', '1991-12-31', 'Ingeniero', 'Analista', 'Annardx', '74715485', '', NULL, NULL, '', NULL, '', 525, NULL, 1, 'Formulario_mercadeo', 0, 0, NULL, '0', 1, '0', 0, 0, 0, 0, '2017-03-10 21:15:19', '2017-03-10 21:15:19'),
(7, '', 'Daniela', 'Diaz', 'Gonzales', 'Cédula de Ciudadanía', '3434343', '1991-12-31', 'Publicista', 'Comercial', 'Annardx', '74715485', '', NULL, NULL, '', NULL, '', 525, '', 2, 'Administración', 0, 0, NULL, '0', 1, '0', 0, 2, 0, 0, '2017-03-10 21:16:42', '2017-03-10 21:22:24'),
(9, '', 'Jose', 'Romero', 'Paez', 'Cédula de Ciudadanía', '34343453545', '1981-12-29', 'Ingeniero', 'Comercial', 'Annardx', '1234489', '', NULL, NULL, '', NULL, '', 525, '', 6, 'Administración', 0, 0, NULL, '0', 1, '0', 2, 0, 0, 0, '2017-03-10 21:26:44', '2017-03-10 21:26:44'),
(16, NULL, 'Daniela', 'Doe', 'Perez', 'Cédula de Ciudadanía', '123', '2001-12-31', 'Ingeniero Industrial', 'Analista', 'Annardx', '1234489', '', '3100287372', '12345', 'jrivera@bancoink.com', '', '', 525, NULL, 1, 'Formulario_mercadeo', 0, 1, '', 'VARIOS', 1, 'Cliente Activo', 2, 2, NULL, 0, '2017-03-13 03:59:27', '2017-05-02 01:18:16'),
(17, NULL, 'Pedro', 'Doe', 'Paez', 'Cédula de Ciudadanía', '1238', '1992-01-14', 'Ingeniero', 'Analista', 'Annardx', '1234489', NULL, NULL, NULL, 'jrivera@bancoink.com', NULL, NULL, 525, '', 8, 'Administración', NULL, 0, NULL, '0', 1, '0', 2, 0, 0, 0, '2017-03-13 04:01:29', '2017-03-13 04:01:29'),
(18, '1234', 'Pedro', 'Doe', 'Paez', 'Cédula de Ciudadanía', '11121', '1999-12-28', 'Ingeniero', 'Analista', 'Annardx', '74715485', NULL, '32121212', '12132343', 'jrivera@bancoink.com', 'jrivera@bancoink.com', 'Calle falsa 123', 525, '1489460418.png', 8, 'Administración', 1, 1, 'Hola mundo', '0', 0, 'Cliente Activo', 2, 0, 0, 0, '2017-03-14 03:00:18', '2017-03-14 03:00:18'),
(20, '12123600', 'Danielm', 'Romerom', 'Ariasm', 'Cédula de Ciudadanía', '7638238200', '1993-10-28', 'Ingeniero Industrial m', 'Administración m', 'Annardx m', '3232445400', '233445500', '310028737200', '1213234000', 'jriveramm@bancoink.com', 'jriveramc@bancoink.com', 'Calle 57 # 70-180', 70, '1489679807.png', 6, 'Administración', 3, 0, 'No tengo comentaros mod00', '0', 0, 'Cliente Inactivo', 2, 2, 0, 0, '2017-03-16 14:33:32', '2017-03-16 16:23:16'),
(21, '1212', 'Lina', 'Pineda', 'Gonzales', 'Cédula de Ciudadanía', '8787', '1986-05-13', 'Ingeniero', 'Analista', 'Annardx', '1234489', '', '1212', '', 'jrivera@bancoink.com', '', '', 525, '', 1, 'Administración', 1, 0, 'Actualización', '0', 1, 'Cliente Activo', 2, 2, 0, 0, '2017-03-16 17:05:32', '2017-03-16 17:09:59'),
(22, '2323', 'Juan', 'Doe', 'Gonzales', 'Cédula de Ciudadanía', '767676', '1957-08-10', 'Ingeniero', 'Analista', 'Annardx m', '7848816', '', '3343565656', '', 'jrivera@bancoink.com', '', '', 525, '', 4, 'Formulario_veterinaria', 2, 0, '', '0', 1, 'Cliente Activo', 2, 2, 0, 0, '2017-03-16 17:16:01', '2017-03-16 17:17:19'),
(23, '1212', 'Pedro', 'Doe', 'Paez', 'Cédula de Ciudadanía', '34334', '2000-01-04', 'Ingeniero', 'Analista', 'Annardx', '74715485', '', '32121212', '', 'jrivera@bancoink.com', '', '', 525, '', 5, 'Formulario_industria', 2, 1, '', '0', 1, 'Cliente Activo', 2, 2, 0, 0, '2017-03-16 17:19:26', '2017-03-16 17:20:02'),
(24, '1234', 'Pedro', 'Doe', 'Gonzales', 'Cédula de Ciudadanía', '76767', '1990-01-02', 'Ingeniero Industrial', 'Analista', 'Annardx', '32324454', '2334455', '3100287372', '12132343', 'jrivera@bancoink.com', 'jrivera@bancoink.com', 'Calle falsa 123', 525, '1489706968.PNG', 6, 'Panel de administración', 2, 0, 'Comentarios', '0', 1, 'Cliente Activo', 2, 0, 0, 0, '2017-03-16 23:29:28', '2017-03-16 23:29:28'),
(25, '12123', 'Pedro', 'Doe', 'Paez', 'Cédula de Ciudadanía', '123111', '1992-02-04', 'Ingeniero', 'Administración', 'Annardx m', '32324454', '2334455', '3100287372', '12132340', 'jrivera@bancoink.com', 'jrivera@bancoink.com', 'Calle falsa 123', 525, '', 8, 'Panel de administración', 2, 0, 'cometartsas', '0', 1, 'Cliente Activo', 2, 0, 0, 0, '2017-03-16 23:32:59', '2017-03-16 23:32:59'),
(27, NULL, 'Pedro', 'Doe', 'Paez', 'Cédula de Ciudadanía', '12121212', '2001-12-31', 'Ingeniero', 'Analista', 'Annardx', '1234489', NULL, '3100287372', NULL, 'jrivera@bancoink.com', NULL, NULL, 525, NULL, 3, 'Formulario_soporte-tecnico', NULL, 1, NULL, '0', 1, '', 0, 0, 0, 0, '2017-03-17 00:48:15', '2017-03-17 00:48:15'),
(29, NULL, 'Pedro', 'Doe', 'Paez', 'Cédula de Ciudadanía', '121212121', '2001-12-31', 'Ingeniero', 'Analista', 'Annardx', '1234489', NULL, '3100287372', NULL, 'jrivera@bancoink.com', NULL, NULL, 525, NULL, 3, 'Formulario_soporte-tecnico', NULL, 1, NULL, '0', 1, '', 0, 0, 0, 0, '2017-03-17 00:51:46', '2017-03-17 00:51:46'),
(31, '12123', 'juan', 'Perez', 'Perez', 'Cédula de Ciudadanía', '454545', '2011-12-27', 'Ingeniero', 'Comercial', 'Annardx', '32324454', '2334455', '32121212', '12132343', 'jefersonpatino@yahoo.es', 'jrivera@bancoink.com', 'Calle 57 # 70-15', 524, '', 8, 'Panel de administración', 2, 1, '', '0', 0, 'Cliente Activo', 2, 0, 2, 0, '2017-03-22 19:39:12', '2017-03-26 02:35:12'),
(33, '12123', 'Lina', 'Perez', 'Perez', 'Cédula de Ciudadanía', '454545666', '1981-12-29', 'Publicista', 'Comercial', 'Annardx', '32324454', '2334455', '32121212', '12132343', 'jefersonpatino@yahoo.es', 'jrivera@bancoink.com', 'Calle 57 # 70-15', 525, '', 1, 'Panel de administración', 1, 0, 'Hola', '0', 1, 'Cliente Inactivo', 2, 4, 0, 0, '2017-03-22 20:34:49', '2017-03-24 01:06:36'),
(34, '121200', 'Daniela M', 'Perez M', 'Perez M', 'Cédula de Ciudadanía', '343344444400', '1993-07-15', 'Publicista M', 'Administración M', 'Annardx M', '3232445400', '233445500', '3212121200', '311997873400', 'riverajefer@gmail.com8', 'jrivera@bancoink.comm', 'Calle 57 # 70-180', 525, '1490316150.png', 7, 'Panel de administración', 1, 0, 'Hola, mundo MM', '0', 1, 'Cliente Inactivo', 2, 4, 0, 0, '2017-03-22 21:01:47', '2017-03-24 00:45:59'),
(38, NULL, 'Daniela', 'Doe', 'Paez', 'Cédula de Ciudadanía', '232323111000', '2002-01-01', 'Ingeniero Industrial', 'Administración', 'Annardx m', '74715485', NULL, '3100287372', NULL, 'jrivera@bancoink.com', NULL, NULL, 525, NULL, 3, 'Formulario_soporte-tecnico', NULL, 1, NULL, '0', 0, '', 0, 0, 2, 0, '2017-03-24 02:06:43', '2017-03-26 02:33:36'),
(39, NULL, 'Daniela', 'Doe', 'Paez', 'Cédula de Ciudadanía', '000222', '2002-01-01', 'Ingeniero Industrial', 'Administración', 'Annardx m', '74715485', NULL, '3100287372', NULL, 'jrivera@bancoink.com', NULL, NULL, 525, NULL, 3, 'Formulario_soporte-tecnico', NULL, 1, NULL, '0', 0, '', 0, 0, 2, 0, '2017-03-24 02:09:25', '2017-03-26 02:31:57'),
(40, '123', 'Daniela', 'Doe', 'Paez', 'Cédula de Ciudadanía', '00022211', '2002-01-01', 'Ingeniero Industrial', 'Administración', 'Annardx m', '1122', '', '3118765', '34343434', 'jrivera@bancoink.com', '', '', 525, '', 3, 'Formulario_soporte-tecnico', 2, 1, 'qq', '0', 0, 'Cliente Activo', 0, 2, 2, 0, '2017-03-24 02:12:19', '2017-03-26 01:28:45'),
(41, NULL, 'Pedro', 'Doe', 'Perez', 'Cédula de Ciudadanía', '43434', '2012-01-02', 'Ingeniero Industrial', 'Analista', 'Annardx m', '74715485', NULL, '3100287372', NULL, 'jrivera@bancoink.com', NULL, NULL, 634, NULL, 9, 'Formulario_prueba', NULL, 1, NULL, '0', 1, '', 0, 0, 0, 0, '2017-03-24 02:18:58', '2017-03-24 02:18:58'),
(42, NULL, 'Pedro', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 0, NULL, 0, '', NULL, 0, NULL, '0', 0, NULL, 0, 0, NULL, 10, '2017-03-29 04:57:56', '2017-03-29 04:57:56'),
(43, '1234', 'José', 'Rodriguez', 'Gil', 'Cédula de Ciudadanía', '152416549432', '1991-12-31', 'Publicista', 'Comercial', 'Annardx', '32324454', '2334455', '3100287372', '12132343', 'riverajefer@gmail.com', 'jrivera@bancoink.com', 'Calle 57 # 70-180', 525, '1490798639.png', 8, 'Panel de administración', 2, 0, 'Holaaa', '0', 1, 'Cliente Activo', 2, 2, 0, 0, '2017-03-29 14:43:59', '2017-03-29 14:46:32'),
(44, NULL, 'Pedro', 'Romero', 'Paez', 'NIT', '102154240777', '1985-01-30', 'Ingeniero Industrial', 'Administración', NULL, 'Annardx', '7848817', '3167890235', 'Pedro', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', '0', 1, '1', 2, 0, NULL, 8, '2017-03-29 17:55:16', '2017-03-29 17:55:16'),
(45, NULL, 'Pedro', 'Romero', 'Paez', 'NIT', '78787', '1985-01-30', 'Ingeniero Industrial', 'Administración', NULL, 'Annardx', '7848817', '3167890235', 'Pedro', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', '0', 1, '1', 2, 0, NULL, 11, '2017-03-29 19:29:57', '2017-03-29 19:29:57'),
(46, NULL, 'Pedro', 'Romero', 'Paez', 'NIT', '202020', '1985-01-30', 'Ingeniero Industrial', 'Administración', NULL, 'Annardx', '7848817', '3167890235', 'Pedro', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', '0', 1, '1', 2, 0, NULL, 12, '2017-03-29 19:31:22', '2017-03-29 19:31:22'),
(47, NULL, 'Pedro', 'Romero', 'Paez', 'NIT', '20202000', '1985-01-30', 'Ingeniero Industrial', 'Administración', NULL, 'Annardx', '7848817', '3167890235', 'Pedro', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', '0', 1, '1', 2, 0, NULL, 13, '2017-03-29 19:37:08', '2017-03-29 19:37:08'),
(48, NULL, 'Pedro', 'Romero', 'Paez', 'NIT', '20202011', '1985-01-30', 'Ingeniero Industrial', 'Administración', NULL, 'Annardx', '7848817', '3167890235', 'Pedro', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', '0', 1, '1', 2, 0, NULL, 14, '2017-03-29 19:37:54', '2017-03-29 19:37:54'),
(49, '12233', 'Daniel', 'Romero', 'Ruiz', 'NIT', '7474700', '1985-01-30', 'Ingeniero Industrial', 'Administración', 'Annardx', '32324454', '7848817', '3167890235', '787878', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', 'VARIOS', 0, 'Cliente Activo', 2, 2, 2, 14, '2017-03-29 19:37:54', '2017-05-03 01:07:09'),
(50, NULL, 'Pedro', 'Romero', 'Paez', 'NIT', '20202088', '1985-01-30', 'Ingeniero Industrial', 'Administración', NULL, 'Annardx', '7848817', '3167890235', 'Pedro', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', '0', 1, '1', 2, 0, NULL, 15, '2017-03-29 19:42:02', '2017-03-29 19:42:02'),
(51, NULL, 'Daniel', 'Romero', 'Ruiz', 'NIT', '7474777', '1985-01-30', 'Ingeniero Industrial', 'Administración', NULL, 'Annardx', '7848817', '3167890235', 'Daniel', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', '0', 1, '1', 2, 0, NULL, 15, '2017-03-29 19:42:03', '2017-03-29 19:42:03'),
(52, NULL, 'Pedro', 'Romero', 'Paez', 'NIT', '787878', '1985-01-30', 'Ingeniero Industrial', 'Administración', NULL, 'Annardx', '7848817', '3167890235', 'Pedro', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', '0', 1, '1', 2, 0, NULL, 16, '2017-03-29 21:55:28', '2017-03-29 21:55:28'),
(53, NULL, 'Daniel', 'Romero', 'Ruiz', 'NIT', '545446', '1985-01-30', 'Ingeniero Industrial', 'Administración', NULL, 'Annardx', '7848817', '3167890235', 'Daniel', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', '0', 1, '1', 2, 0, NULL, 16, '2017-03-29 21:55:28', '2017-03-29 21:55:28'),
(54, NULL, 'Pedro', 'Romero', 'Paez', 'NIT', '7787878', '1985-01-30', 'Ingeniero Industrial', 'Administración', NULL, 'Annardx', '7848817', '3167890235', 'Pedro', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', '0', 1, '1', 2, 0, NULL, 17, '2017-03-29 21:56:28', '2017-03-29 21:56:28'),
(55, NULL, 'Daniel', 'Romero', 'Ruiz', 'NIT', '1111111', '1985-01-30', 'Ingeniero Industrial', 'Administración', NULL, 'Annardx', '7848817', '3167890235', 'Daniel', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', '0', 1, '1', 2, 0, NULL, 17, '2017-03-29 21:56:28', '2017-03-29 21:56:28'),
(56, NULL, 'Pedro', 'Romero', 'Paez', 'NIT', '57474747474', '1985-01-30', 'Ingeniero Industrial', 'Administración', NULL, 'Annardx', '7848817', '3167890235', 'Pedro', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', '0', 1, '1', 2, 0, NULL, 18, '2017-03-29 21:57:25', '2017-03-29 21:57:25'),
(57, NULL, 'Daniel', 'Romero', 'Ruiz', 'NIT', '85888', '1985-01-30', 'Ingeniero Industrial', 'Administración', NULL, 'Annardx', '7848817', '3167890235', 'Daniel', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', '0', 1, '1', 2, 0, NULL, 18, '2017-03-29 21:57:25', '2017-03-29 21:57:25'),
(58, NULL, 'Pedro', 'Romero', 'Paez', 'NIT', '77774444', '1985-01-30', 'Ingeniero Industrial', 'Administración', NULL, 'Annardx', '7848817', '3167890235', 'Pedro', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', '0', 1, '1', 2, 0, NULL, 19, '2017-03-29 22:01:23', '2017-03-29 22:01:23'),
(59, NULL, 'Daniel', 'Romero', 'Ruiz', 'NIT', '8850225', '1985-01-30', 'Ingeniero Industrial', 'Administración', NULL, 'Annardx', '7848817', '3167890235', 'Daniel', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', '0', 1, '1', 2, 0, NULL, 19, '2017-03-29 22:01:24', '2017-03-29 22:01:24'),
(60, NULL, 'Pedro', 'Romero', 'Paez', 'NIT', '25259710', '1985-01-30', 'Ingeniero Industrial', 'Administración', NULL, 'Annardx', '7848817', '3167890235', 'Pedro', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', '0', 1, '1', 2, 0, NULL, 20, '2017-03-29 22:01:55', '2017-03-29 22:01:55'),
(61, NULL, 'Daniel', 'Romero', 'Ruiz', 'NIT', '54878797', '1985-01-30', 'Ingeniero Industrial', 'Administración', NULL, 'Annardx', '7848817', '3167890235', 'Daniel', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 0, 0, 'Sin comentarios', '0', 1, '1', 2, 0, NULL, 20, '2017-03-29 22:01:55', '2017-03-29 22:01:55'),
(62, '', 'David', 'Lopez', 'Paez', 'Cédula de Ciudadanía', '65434434', '2002-01-01', 'Publicista', 'Administración', 'Annardx', '', '', '', '', 'riverajefer@gmail.com', '', '', 525, NULL, 8, 'Panel de administración', 2, 1, '', '0', 1, 'Cliente Activo', 2, 2, 0, 0, '2017-03-30 19:28:12', '2017-03-30 19:33:06'),
(63, NULL, 'Pedro', 'Romero', 'Paez', 'NIT', '787457', '1985-01-30', 'Ingeniero Industrial', 'Administración', 'Annardx', '78712145', '7848817', '3167890235', '3167890235', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 2, 0, 'Sin comentarios', '0', 1, 'Cliente Activo', 2, 2, 0, 21, '2017-03-30 19:36:10', '2017-03-30 19:46:48'),
(64, '1234', 'Daniel', 'Romero', 'Ruiz', 'NIT', '100248', '1985-01-30', 'Ingeniero Industrial', 'Administración', 'Annardx', '78712145', '7848817', '3167890235', '3167890235', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 2, 0, 'Sin comentarios', '0', 1, 'Cliente Activo', 2, 2, 0, 21, '2017-03-30 19:36:10', '2017-03-30 19:39:50'),
(65, NULL, 'Lina', 'Perez', 'Gonzales', 'NIT', '32323256', '0000-00-00', 'Publicista', 'Comercial', 'Annardx', '', '', '', '', 'riverajefer@gmail.com', '', '', 525, NULL, 8, 'Panel de administración', 2, 0, '', '0', 1, 'Cliente Activo', 2, 2, 0, 0, '2017-03-30 19:48:17', '2017-03-30 19:48:30'),
(66, '', 'Lucas', 'Perez', 'Gonzales', 'Cédula de Ciudadanía', '21212121334', '0000-00-00', 'Publicista', 'Administración', 'Annardx', '', '', '', '', 'riverajefer@gmail.com', '', '', 634, NULL, 8, 'Panel de administración', 0, 0, '', '0', 1, 'Cliente Activo', 2, 0, NULL, 0, '2017-03-30 19:50:01', '2017-03-30 19:50:01'),
(67, '', 'Lina', 'Perez', 'Gonzales', 'Cédula de Ciudadanía', '454532322322', '0000-00-00', 'Ingeniero', 'Administración', 'Annardx', '', '', '', '', 'riverajefer@gmail.com', '', '', 1, NULL, 8, 'Panel de administración', 2, 0, '', '0', 1, 'Cliente Activo', 2, 2, 0, 0, '2017-03-30 19:59:51', '2017-03-30 20:00:17'),
(68, '', 'Andres', 'Perez', 'Gonzales', 'Cédula de Ciudadanía', '123567322', '0000-00-00', 'Publicista', 'Comercial', 'Annardx', '', '', '', '', 'riverajefer@gmail.com', '', '', 3, NULL, 8, 'Panel de administración', 2, 0, '', '0', 1, 'Cliente Activo', 2, 2, 0, 0, '2017-03-30 20:03:46', '2017-03-30 20:03:55'),
(69, NULL, 'Pedro', 'Perez', 'Paez', 'Cédula de Ciudadanía', '2322323', NULL, 'Publicista', 'Comercial', 'Annardx', '', '', '', '', 'riverajefer@gmail.com', '', '', 3, NULL, 8, 'Panel de administración', 2, 0, '', '0', 1, 'Cliente Activo', 2, 2, 0, 0, '2017-03-30 20:06:22', '2017-03-30 20:06:31'),
(70, NULL, 'Carlos', 'Perez', 'Paez', 'NIT', '2232658765', NULL, 'Ingeniero', 'Analista', 'Annardx m', '', '', '', '', 'riverajefer@gmail.com', '', '', 128, NULL, 6, 'Panel de administración', 0, 0, '', '0', 0, 'Cliente Activo', 2, 2, 2, 0, '2017-03-30 20:08:30', '2017-04-06 21:54:48'),
(71, NULL, 'Camilo', 'Lopez', 'Gonzales', 'Tarjeta de Identidad', '121212145677', NULL, 'Publicista', 'Administración', 'Annardx m', '', '', '', '', 'soporte@sionica.net', '', '', 3, NULL, 6, 'Panel de administración', 0, 0, '', '0', 1, 'Cliente Activo', 2, 2, 0, 0, '2017-03-30 20:13:45', '2017-03-30 20:16:40'),
(72, '123', 'Jorge', 'Lopez', 'Gonzales', 'NIT', '121212', NULL, 'Publicista', 'Comercial', 'Annardx m', '', '', '', '', 'riverajefer@gmail.com', '', 'Calle 57 # 70-15', 1, NULL, 8, 'Panel de administración', 1, 0, '', '0', 1, 'Cliente Activo', 2, 2, NULL, 0, '2017-03-30 20:20:58', '2017-03-30 20:26:32'),
(73, NULL, 'Pedro', 'Romero', 'Paez', 'NIT', '85874266', '1985-01-30', 'Ingeniero Industrial', 'Administración', 'Annardx', '78712145', '7848817', '3167890235', '3167890235', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 2, 0, 'Sin comentarios', '0', 1, 'Cliente Activo', 2, 2, NULL, 22, '2017-03-30 20:27:42', '2017-03-30 20:27:52'),
(74, '333', 'Daniel', 'Romero', 'Ruiz', 'NIT', '1023684', '1985-01-30', 'Ingeniero Industrial', 'Administración', 'Annardx', '78712145', '7848817', '3167890235', '3167890235', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 2, 0, 'Sin comentarios', '0', 0, 'Cliente Activo', 2, 2, 2, 22, '2017-03-30 20:27:42', '2017-03-30 20:46:09'),
(75, '123', 'Carlos', 'Romero', 'Paez', 'NIT', '3333', '1985-01-30', 'Ingeniero Industrial', 'Administración', 'Annardx', '78712145', '7848817', '3167890235', '3167890235', 'email@example.com', 'email@example.com', 'Calle 65 # 60-18', 525, NULL, 1, 'Subida masiva', 3, 0, 'Sin comentarios', 'COLCAN', 1, 'Cliente Activo', 2, 0, NULL, 29, '2017-04-03 17:52:51', '2017-05-03 04:07:15'),
(76, NULL, 'juan', 'Perez', 'Gonzales', 'Cédula de Ciudadanía', '7412', NULL, 'Publicista', 'Comercial', 'Annardx', '', '2334455', '', '', 'riverajefer@gmail.com', '', '', 135, NULL, 8, 'Panel de administración', 2, 0, '', 'COLCAN', 1, 'Cliente Activo', 2, 2, NULL, 0, '2017-04-05 19:43:19', '2017-04-05 19:52:39'),
(77, '123', 'Carlos', 'Romero', 'Paez', 'NIT', '325610', '1985-01-30', 'Ingeniero Industrial', 'Administración', 'Annardx', '78712145', '7848817', '3167890235', '3167890235', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 3, 0, 'Sin comentarios', 'COLCANp', 1, 'Cliente Activo', 4, 0, NULL, 23, '2017-04-05 20:02:39', '2017-04-05 20:02:39'),
(78, '123', 'Carlos', 'Romero', 'Paez', 'NIT', '858585220', '1985-01-30', 'Ingeniero Industrial', 'Administración', 'Annardx', '78712145', '7848817', '3167890235', '3167890235', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 525, NULL, 1, 'Panel de administración Subida masiva', 3, 0, 'Sin comentarios', 'COLCAN', 1, 'Cliente Activo', 4, 0, NULL, 24, '2017-04-05 21:43:19', '2017-04-05 21:43:19'),
(79, '123', 'Carlos', 'Romero', 'Paez', 'NIT', '858585228', '1985-01-30', 'Ingeniero Industrial', 'Administración', 'Annardx', '78712145', '7848817', '3167890235', '3167890235', 'email@example.com', 'email@example.com', 'Calle 65 # 60-18', 525, NULL, 1, 'Panel de administración Subida masiva', 3, 0, 'Sin comentarios', 'COLCAN', 1, 'Cliente Activo', 4, 0, NULL, 27, '2017-04-05 21:46:08', '2017-04-07 15:01:07'),
(80, '123', 'Carlos', 'Romero', 'Paez', 'NIT', '85000529', '1986-10-21', 'Ingeniero Industrial', 'Administración', 'Annardx', '78712145', '7848817', '3167890235', '3167890235', 'email@example.com', 'email@example.com', 'Calle 65 # 60-15', 855, NULL, 1, 'Panel de administración Subida masiva', 3, 0, 'Sin comentarios', 'COLCAN', 1, 'Cliente Activo', 2, 2, NULL, 26, '2017-04-06 21:59:56', '2017-04-06 22:01:01'),
(81, NULL, 'prueba', 'Gil', 'Oerez', 'Cédula de Ciudadanía', '12366', '1992-01-21', 'Dd', 'Nn', 'Nn', '', '', '', '', 'jrivera@bancoink.com', '', '', 525, NULL, 6, 'Panel de administración', 1, 0, '', 'ANDREA PERDOMO', 1, 'Cliente Activo', 2, 0, NULL, 0, '2017-04-06 22:03:19', '2017-04-06 22:03:19'),
(82, NULL, 'Pedro', 'Perez', 'Paez', 'Cédula de Ciudadanía', '888777', NULL, 'Publicista', 'Comercial', 'Annardx m', '', '', '', '', 'riverajefer@gmail.com', '', '', 327, NULL, 7, 'Panel de administración', 0, 0, '', '', 1, 'Cliente Activo', 4, 0, NULL, 0, '2017-04-07 16:45:10', '2017-04-07 16:45:10'),
(83, NULL, 'Lucas', 'Perez', 'Gonzales', 'Cédula de Ciudadanía', '5887745', '2011-12-27', 'Publicista', 'Comercial', 'Annardx', '', '', '', '', 'riverajefer@gmail.com', '', '', 135, NULL, 8, 'Panel de administración', 0, 1, '', '', 1, 'Cliente Activo', 4, 0, NULL, 0, '2017-04-07 16:49:11', '2017-04-07 16:49:11'),
(84, NULL, 'juan m', 'Perez', 'Gonzales', 'Cédula de Ciudadanía', '787852544', NULL, 'Publicista', 'Comercial', 'Annardx', '', '', '', '', 'riverajefer@gmail.com', '', '', 128, NULL, 3, 'Panel de administración', 0, 0, '', '', 1, 'Cliente Activo', 4, 0, NULL, 0, '2017-04-07 16:50:36', '2017-04-07 16:50:36'),
(85, NULL, 'Diana', 'Perez', 'Gonzales', 'Cédula de Ciudadanía', '87542360', NULL, 'Publicista', 'Comercial', 'Annardx', '', '', '', '', 'riverajefer@gmail.com', '', '', 3, NULL, 3, 'Panel de administración', 0, 0, '', '', 1, 'Cliente Activo', 4, 0, NULL, 0, '2017-04-07 16:58:03', '2017-04-07 16:58:03'),
(86, NULL, 'Pedro', 'Perez', 'Gonzales', 'Cédula de Ciudadanía', '7863100', NULL, 'Publicista', 'Comercial', 'Annardx', '', '', '', '', 'riverajefer@gmail.com', '', '', 487, NULL, 6, 'Panel de administración', 0, 0, '', '', 1, 'Cliente Activo', 4, 0, NULL, 0, '2017-04-07 17:23:43', '2017-04-07 17:23:43'),
(87, NULL, 'Pedro', 'Perez', 'Gonzales', 'Cédula de Ciudadanía', '7863107', NULL, 'Publicista', 'Comercial', 'Annardx', '', '', '', '', 'riverajefer@gmail.com', '', '', 128, NULL, 6, 'Panel de administración', 0, 0, '', '', 1, 'Cliente Activo', 4, 0, NULL, 0, '2017-04-07 17:27:00', '2017-04-07 17:27:00'),
(88, NULL, 'juan', 'Perez', 'Gonzales', 'Cédula de Ciudadanía', '454543343', NULL, 'Publicista', 'Comercial', 'Annardx', '', '', '', '', 'riverajefer@gmail.com', '', '', 128, NULL, 7, 'Panel de administración', 0, 0, '', '', 1, 'Cliente Activo', 4, 0, NULL, 0, '2017-04-07 17:32:08', '2017-04-07 17:32:08'),
(89, NULL, 'Pedro', 'Perez', 'Gonzales', 'Cédula de Ciudadanía', '23223232', NULL, 'Publicista', 'Comercial', 'Annardx', '', '', '', '', 'riverajefer@gmail.com', '', '', 3, NULL, 8, 'Panel de administración', 0, 0, '', '', 1, 'Cliente Activo', 4, 0, NULL, 0, '2017-04-07 17:33:16', '2017-04-07 17:33:16'),
(90, NULL, 'juan', 'Perez', 'Gonzales', 'Cédula de Ciudadanía', '34343222', NULL, 'Publicista', 'Comercial', 'Annardx', '', '', '', '', 'riverajefer@gmail.com', '', '', 354, NULL, 8, 'Panel de administración', 0, 0, '', 'VARIOS', 0, 'Cliente Activo', 4, 4, 4, 0, '2017-04-07 17:53:48', '2017-04-07 18:19:24'),
(91, NULL, 'Lina', 'Perez', 'Gonzales', 'Cédula de Ciudadanía', '22221113', '2011-12-27', 'Publicista', 'Comercial', 'Annardx', '1234489', '', '32121212', '', 'riverajefer@gmail.com', '', '', 634, NULL, 1, 'Formulario_mercadeo', 0, 1, '', 'VARIOS', 1, 'Cliente Activo', 0, 2, NULL, 0, '2017-04-07 18:32:06', '2017-04-28 20:32:46'),
(92, '123', 'Daniela', 'Doe', 'Perez', 'Cédula de Ciudadanía', '10272522', '1990-07-19', 'Ingeniero Industrial', 'Analista', 'Annardx', '', '', '', '1213234000', 'riverajefer@gmail.com', '', '', 525, NULL, 8, 'Panel de administración', 2, 0, '', 'ANNAR', 1, 'Cliente Activo', 2, 2, NULL, 0, '2017-04-15 17:11:20', '2017-04-20 19:26:47'),
(93, NULL, 'Daniela', 'Romero', 'Perez', 'Cédula de Ciudadanía', '12343', '2011-12-26', 'Ingeniero Industrial', 'Analista', 'Annardx', '', '', '', '', 'riverajefer@gmail.com', '', 'Calle 57 # 70-180', 370, NULL, 6, 'Panel de administración', 2, 1, '', 'VARIOS', 1, 'Cliente Activo', 2, 2, NULL, 0, '2017-05-02 01:23:17', '2017-05-02 01:24:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'responsable', '2017-04-26 03:32:08', '2017-04-26 03:32:08'),
(2, 'operario', '2017-04-26 03:32:53', '2017-04-26 03:32:53'),
(3, 'admin', '2017-04-26 03:52:54', '2017-04-26 03:52:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(5, 3),
(6, 1),
(6, 3),
(9, 1),
(10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_registros`
--

CREATE TABLE `tipo_registros` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_registros`
--

INSERT INTO `tipo_registros` (`id`, `titulo`, `created_at`, `updated_at`) VALUES
(1, 'Colaborador', '2017-03-13 12:19:28', '2017-03-13 12:19:28'),
(2, 'Cliente', '2017-03-13 12:19:28', '2017-03-13 12:19:28'),
(3, 'Proveedor', '2017-03-13 12:19:28', '2017-03-13 12:19:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_has_permissions`
--

CREATE TABLE `user_has_permissions` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user_has_permissions`
--

INSERT INTO `user_has_permissions` (`user_id`, `permission_id`) VALUES
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_has_roles`
--

CREATE TABLE `user_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user_has_roles`
--

INSERT INTO `user_has_roles` (`role_id`, `user_id`) VALUES
(1, 2),
(2, 87);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `areas_users`
--
ALTER TABLE `areas_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audits_auditable_id_auditable_type_index` (`auditable_id`,`auditable_type`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `device_registros`
--
ALTER TABLE `device_registros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departamento` (`departamento`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registros_numero_docuemnto_unique` (`doc`),
  ADD KEY `area_id` (`area_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `tipo_registros`
--
ALTER TABLE `tipo_registros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_has_permissions`
--
ALTER TABLE `user_has_permissions`
  ADD PRIMARY KEY (`user_id`,`permission_id`),
  ADD KEY `user_has_permissions_permission_id_foreign` (`permission_id`);

--
-- Indices de la tabla `user_has_roles`
--
ALTER TABLE `user_has_roles`
  ADD PRIMARY KEY (`role_id`,`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `areas_users`
--
ALTER TABLE `areas_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `audits`
--
ALTER TABLE `audits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;
--
-- AUTO_INCREMENT de la tabla `device_registros`
--
ALTER TABLE `device_registros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipo_registros`
--
ALTER TABLE `tipo_registros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`departamento`) REFERENCES `departamentos` (`id`);

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_has_permissions`
--
ALTER TABLE `user_has_permissions`
  ADD CONSTRAINT `user_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_has_roles`
--
ALTER TABLE `user_has_roles`
  ADD CONSTRAINT `user_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
