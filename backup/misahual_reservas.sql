-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-10-2017 a las 19:21:54
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `misahual_reservas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_web`
--

CREATE TABLE `config_web` (
  `id` int(10) UNSIGNED NOT NULL,
  `slide_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slide_pic` blob NOT NULL,
  `logo_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo_pic` blob NOT NULL,
  `galeria_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `galeria_pic` blob NOT NULL,
  `test_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `test_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `test_pic` blob NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `email`, `created_at`, `updated_at`) VALUES
(1, 'jesus', 'vasquez', 'jesussvasquezg@gmail.com', '2017-10-12', '2017-10-12'),
(2, 'j', 'u', 'h', '2017-10-12', '2017-10-12'),
(3, 'Leonardo', 'Barroeta', 'barroetaleonardo@hotmail.com', '2017-10-12', '2017-10-12'),
(4, 'Edgar', 'Mejias', 'emejias80@gmail.com', '2017-10-12', '2017-10-12'),
(5, 'jose', 'fernandez', 'jafp20@gmail.com', '2017-10-16', '2017-10-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservations`
--

CREATE TABLE `reservations` (
  `id` int(10) UNSIGNED NOT NULL,
  `total_price` double(8,2) NOT NULL,
  `occupancy` int(11) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `payment_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reservations`
--

INSERT INTO `reservations` (`id`, `total_price`, `occupancy`, `checkin`, `checkout`, `customer_id`, `payment_type`, `payment_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 25.00, 6, '2017-10-13', '2017-10-14', 1, 'TRANSFERENCIA', NULL, '0', '2017-10-12', '2017-10-12'),
(2, 50.00, 2, '2017-10-13', '2017-10-15', 1, 'TRANSFERENCIA', NULL, '0', '2017-10-12', '2017-10-12'),
(3, 10.00, 3, '2017-10-20', '2017-10-22', 2, 'TRANSFERENCIA', NULL, '0', '2017-10-12', '2017-10-12'),
(4, 5.00, 3, '2017-10-13', '2017-10-14', 1, 'TRANSFERENCIA', NULL, '0', '2017-10-12', '2017-10-12'),
(5, 25.00, 4, '2017-10-13', '2017-10-14', 1, 'TRANSFERENCIA', NULL, '0', '2017-10-12', '2017-10-12'),
(6, 130.00, 2, '2017-10-13', '2017-10-20', 3, 'TRANSFERENCIA', NULL, '0', '2017-10-12', '2017-10-12'),
(7, 30.00, 1, '2017-10-12', '2017-10-13', 4, 'TRANSFERENCIA', NULL, '0', '2017-10-12', '2017-10-12'),
(8, 10.00, 2, '2017-10-12', '2017-10-13', 4, 'TRANSFERENCIA', NULL, '0', '2017-10-12', '2017-10-12'),
(9, 125.00, 2, '2017-10-17', '2017-10-22', 3, 'TRANSFERENCIA', NULL, '0', '2017-10-16', '2017-10-16'),
(10, 30.00, 2, '2017-10-16', '2017-10-19', 5, 'TRANSFERENCIA', NULL, '0', '2017-10-16', '2017-10-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation_nights`
--

CREATE TABLE `reservation_nights` (
  `id` int(10) UNSIGNED NOT NULL,
  `rate` double(8,2) NOT NULL,
  `day` date NOT NULL,
  `room_type_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `reservation_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reservation_nights`
--

INSERT INTO `reservation_nights` (`id`, `rate`, `day`, `room_type_id`, `reservation_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 25.00, '2017-10-13', 1, 1, '0', '0000-00-00', '0000-00-00'),
(2, 25.00, '2017-10-13', 1, 2, '0', '0000-00-00', '0000-00-00'),
(3, 25.00, '2017-10-14', 1, 2, '0', '0000-00-00', '0000-00-00'),
(4, 5.00, '2017-10-20', 2, 3, '0', '0000-00-00', '0000-00-00'),
(5, 5.00, '2017-10-21', 2, 3, '0', '0000-00-00', '0000-00-00'),
(6, 5.00, '2017-10-13', 2, 4, '0', '0000-00-00', '0000-00-00'),
(7, 25.00, '2017-10-13', 1, 5, '0', '0000-00-00', '0000-00-00'),
(8, 30.00, '2017-10-13', 3, 6, '0', '0000-00-00', '0000-00-00'),
(9, 30.00, '2017-10-14', 3, 6, '0', '0000-00-00', '0000-00-00'),
(10, 30.00, '2017-10-15', 3, 6, '0', '0000-00-00', '0000-00-00'),
(11, 10.00, '2017-10-16', 3, 6, '0', '0000-00-00', '0000-00-00'),
(12, 10.00, '2017-10-17', 3, 6, '0', '0000-00-00', '0000-00-00'),
(13, 10.00, '2017-10-18', 3, 6, '0', '0000-00-00', '0000-00-00'),
(14, 10.00, '2017-10-19', 3, 6, '0', '0000-00-00', '0000-00-00'),
(15, 30.00, '2017-10-12', 3, 7, '0', '0000-00-00', '0000-00-00'),
(16, 10.00, '2017-10-12', 1, 8, '0', '0000-00-00', '0000-00-00'),
(17, 25.00, '2017-10-17', 1, 9, '0', '0000-00-00', '0000-00-00'),
(18, 25.00, '2017-10-18', 1, 9, '0', '0000-00-00', '0000-00-00'),
(19, 25.00, '2017-10-19', 1, 9, '0', '0000-00-00', '0000-00-00'),
(20, 25.00, '2017-10-20', 1, 9, '0', '0000-00-00', '0000-00-00'),
(21, 25.00, '2017-10-21', 1, 9, '0', '0000-00-00', '0000-00-00'),
(22, 10.00, '2017-10-16', 3, 10, '0', '0000-00-00', '0000-00-00'),
(23, 10.00, '2017-10-17', 3, 10, '0', '0000-00-00', '0000-00-00'),
(24, 10.00, '2017-10-18', 3, 10, '0', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `room_calendars`
--

CREATE TABLE `room_calendars` (
  `id` int(11) UNSIGNED NOT NULL,
  `master_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `room_type_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `rate` double(8,2) NOT NULL,
  `day` date NOT NULL,
  `deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `room_calendars`
--

INSERT INTO `room_calendars` (`id`, `master_id`, `room_type_id`, `rate`, `day`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 30.00, '2017-10-12', 0, '2017-10-12 20:10:52', '2017-10-12 20:10:52'),
(2, 1, 3, 30.00, '2017-10-13', 0, '2017-10-12 20:10:52', '2017-10-12 20:10:52'),
(3, 1, 3, 30.00, '2017-10-14', 0, '2017-10-12 20:10:52', '2017-10-12 20:10:52'),
(4, 1, 3, 30.00, '2017-10-15', 0, '2017-10-12 20:10:52', '2017-10-12 20:10:52'),
(5, 2, 1, 10.00, '2017-10-12', 1, '2017-10-12 20:10:53', '2017-10-12 20:10:55'),
(6, 2, 1, 10.00, '2017-10-13', 1, '2017-10-12 20:10:53', '2017-10-12 20:10:55'),
(7, 2, 1, 10.00, '2017-10-14', 1, '2017-10-12 20:10:53', '2017-10-12 20:10:55'),
(8, 2, 1, 10.00, '2017-10-15', 1, '2017-10-12 20:10:53', '2017-10-12 20:10:55'),
(9, 2, 1, 10.00, '2017-10-16', 1, '2017-10-12 20:10:53', '2017-10-12 20:10:55'),
(10, 3, 3, 10.00, '2017-10-16', 0, '2017-10-12 20:10:55', '2017-10-12 20:10:55'),
(11, 3, 3, 10.00, '2017-10-17', 0, '2017-10-12 20:10:55', '2017-10-12 20:10:55'),
(12, 3, 3, 10.00, '2017-10-18', 0, '2017-10-12 20:10:55', '2017-10-12 20:10:55'),
(13, 3, 3, 10.00, '2017-10-19', 0, '2017-10-12 20:10:55', '2017-10-12 20:10:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `room_calendars_master`
--

CREATE TABLE `room_calendars_master` (
  `id` int(11) UNSIGNED NOT NULL,
  `room_type_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `date_from` date NOT NULL DEFAULT '0000-00-00',
  `date_to` date NOT NULL DEFAULT '0000-00-00',
  `rate` double(8,2) NOT NULL DEFAULT '0.00',
  `deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `room_calendars_master`
--

INSERT INTO `room_calendars_master` (`id`, `room_type_id`, `date_from`, `date_to`, `rate`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 3, '2017-10-12', '2017-10-15', 30.00, 0, '2017-10-12 20:10:52', '2017-10-12 20:10:52'),
(2, 1, '2017-10-12', '2017-10-16', 10.00, 1, '2017-10-12 20:10:53', '2017-10-12 20:10:55'),
(3, 3, '2017-10-16', '2017-10-19', 10.00, 0, '2017-10-12 20:10:55', '2017-10-12 20:10:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `room_types`
--

CREATE TABLE `room_types` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `short_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `base_price` double(8,2) NOT NULL,
  `base_availability` int(11) NOT NULL,
  `max_occupancy` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `terms` text COLLATE utf8_unicode_ci NOT NULL,
  `main_picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `deleted` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `short_name`, `base_price`, `base_availability`, `max_occupancy`, `description`, `terms`, `main_picture`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'Ecologica', 'Eco1', 25.00, 7, 6, '<p>dsc</p>\r\n', '<p>terms</p>\r\n', 'Eco1_1.jpg', 0, '2017-10-12 15:10:23', '2017-10-12 17:10:29'),
(2, 'rt', 'ty', 5.00, 1, 3, '<p>desc</p>\r\n', '<p>terms</p>\r\n', 'ty_1.jpg', 1, '2017-10-12 16:10:21', '2017-10-12 20:10:51'),
(3, 'Matrimonial', 'MAT', 20.00, 10, 2, '<p>Prueba de texto descripcion.</p>\r\n', '<p>Prueba de terminos y condiciones</p>\r\n', 'MAT_1.jpg', 0, '2017-10-12 20:10:50', '2017-10-12 20:10:51');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `config_web`
--
ALTER TABLE `config_web`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indices de la tabla `reservation_nights`
--
ALTER TABLE `reservation_nights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_type_id` (`room_type_id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Indices de la tabla `room_calendars`
--
ALTER TABLE `room_calendars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_calendars_ibfk_1` (`master_id`),
  ADD KEY `room_calendars_ibfk_2` (`room_type_id`);

--
-- Indices de la tabla `room_calendars_master`
--
ALTER TABLE `room_calendars_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_type_id` (`room_type_id`);

--
-- Indices de la tabla `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `config_web`
--
ALTER TABLE `config_web`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `reservation_nights`
--
ALTER TABLE `reservation_nights`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `room_calendars`
--
ALTER TABLE `room_calendars`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `room_calendars_master`
--
ALTER TABLE `room_calendars_master`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservation_nights`
--
ALTER TABLE `reservation_nights`
  ADD CONSTRAINT `reservation_nights_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_nights_ibfk_2` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `room_calendars`
--
ALTER TABLE `room_calendars`
  ADD CONSTRAINT `room_calendars_ibfk_1` FOREIGN KEY (`master_id`) REFERENCES `room_calendars_master` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `room_calendars_ibfk_2` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `room_calendars_master`
--
ALTER TABLE `room_calendars_master`
  ADD CONSTRAINT `room_calendars_master_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
