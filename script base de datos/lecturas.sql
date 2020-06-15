-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-06-2020 a las 02:03:48
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id13866308_baselecturas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lecturas`
--

CREATE TABLE `lecturas` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `anterior` double(8,2) NOT NULL,
  `actual` double(8,2) NOT NULL,
  `consumo` double(8,2) NOT NULL,
  `basico` double(8,2) NOT NULL,
  `exceso` double(8,2) NOT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitud` double(10,6) DEFAULT NULL,
  `longitud` double(10,6) DEFAULT NULL,
  `estado` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medidor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lecturas`
--

INSERT INTO `lecturas` (`id`, `fecha`, `anterior`, `actual`, `consumo`, `basico`, `exceso`, `observacion`, `imagen`, `latitud`, `longitud`, `estado`, `medidor_id`, `user_id`, `created_at`, `updated_at`) VALUES
(25, '2020-06-03', 0.00, 4.00, 4.00, 4.00, 0.00, 'consumo de mayo', '/storage/emulated/0/Android/data/com.jaapsaz.applecturas/files/Pictures/temp/IMG_20200529_164123.jpg', -2.957834, -78.989726, 'A', 36, 4, '2020-06-03 00:00:00', '2020-06-03 00:00:00'),
(27, '2020-06-09', 0.00, 6.00, 6.00, 4.00, 5.00, 'consumo da mayo', '/storage/emulated/0/Android/data/com.jaapsaz.applecturas/files/Pictures/temp/IMG_20200529_164123_1.jpg', -2.957820, -78.989781, 'A', 4, 2, '2020-06-09 00:00:00', '2020-06-09 00:00:00'),
(28, '2020-06-09', 0.00, 5.00, 5.00, 4.00, 0.00, 'consumo', '/storage/emulated/0/Android/data/com.jaapsaz.applecturas/files/Pictures/temp/IMG_20200529_164123_2.jpg', -2.957908, -78.989749, 'A', 5, 2, '2020-06-09 00:00:00', '2020-06-09 00:00:00'),
(29, '2020-06-11', 0.00, 3.00, 3.00, 4.00, 0.00, 'registro consumo de mayo', '', -2.834150, -78.904850, 'A', 1, 2, '2020-06-11 00:00:00', '2020-06-11 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lecturas`
--
ALTER TABLE `lecturas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lecturas`
--
ALTER TABLE `lecturas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
