-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2025 a las 18:17:32
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
-- Base de datos: `dihaus`
--
CREATE DATABASE IF NOT EXISTS `dihaus` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dihaus`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artistas`
--

CREATE TABLE `artistas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `slug` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL COMMENT 'Usado para URL: gropius, breuer, etc.',
  `area` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT 'Ej: Arquitectura, Fotografía, Pintura',
  `resumen_bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT 'Breve resumen para el buscador o listados',
  `imagen_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT 'Ruta a la imagen del artista',
  `anio_nacimiento` int(4) DEFAULT NULL,
  `anio_muerte` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `artistas`
--

INSERT INTO `artistas` (`id`, `nombre`, `slug`, `area`, `resumen_bio`, `imagen_url`, `anio_nacimiento`, `anio_muerte`) VALUES
(1, 'Walter Gropius', 'gropius', 'Arquitectura y Dirección', 'Fundador de la Bauhaus y pionero de la arquitectura moderna. Enfatizó la unión de arte y técnica.', 'gropius-1.jpg', 1883, 1969),
(2, 'Marcel Breuer', 'breuer', 'Diseño de Muebles y Arquitectura', 'Diseñador húngaro conocido por sus innovadores muebles tubulares de acero, como la silla Wassily.', 'breuer-1.jpg', 1902, 1981),
(3, 'Marianne Brandt', 'brandt', 'Diseño Industrial y Metales', 'Única mujer en dirigir el taller de metal de la Bauhaus. Sus diseños de lámparas y ceniceros son íconos del funcionalismo.', 'brandt-1.jpg', 1893, 1983),
(4, 'László Moholy-Nagy', 'moholy', 'Fotografía, Pintura y Tipografía', 'Artista húngaro que experimentó con luz y movimiento. Jugó un papel clave en la expansión de la Bauhaus en la fotografía.', 'moholy-nagy-1.jpg', 1895, 1946),
(5, 'Paul Klee', 'klee', 'Pintura y Pedagogía', 'Maestro fundamental que influyó en la teoría del color y la relación entre arte abstracto y naturaleza. Famoso por su estilo lírico y abstracto.', 'klee-1.jpg', 1879, 1940);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` int(8) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `nombre`, `email`, `mensaje`, `fecha_envio`) VALUES
(1, 'agustina', 'agustina@test.com', 'Hola!', '2025-11-17 19:57:53'),
(2, 'Agustina', 'agus@ejemplo.com', 'Hola de nuevo!!', '2025-11-17 20:16:54'),
(3, 'Alejo', 'alejo@test.com', 'Hola!!', '2025-11-17 20:31:37'),
(4, 'Alejo', 'alejo@test.com', 'Hola!!', '2025-11-17 20:35:10'),
(5, 'Alejo', 'alejo@test.com', 'Hola!!', '2025-11-17 20:35:43'),
(6, 'Agustina', 'agustina@ejemplo.com', 'Hola!', '2025-11-17 20:36:48'),
(7, 'Agus', 'agustina@ejemplo.com', 'Hola!', '2025-11-18 02:34:53'),
(8, 'Benja', 'benjap@test.com', 'Hola!', '2025-11-18 12:50:10'),
(9, 'Benja', 'benjap@test.com', 'Hola!', '2025-11-18 12:56:45'),
(10, 'Agus', 'agustina@ejemplo.com', 'Hola!', '2025-11-18 12:57:14'),
(11, 'Agus', 'agustina@ejemplo.com', 'Hola!', '2025-11-18 13:00:20'),
(12, 'Agus', 'agustina@ejemplo.com', 'Hola!', '2025-11-18 13:02:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `remember_token` varchar(64) DEFAULT NULL,
  `remember_token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `usuario`, `password`, `fecha_registro`, `remember_token`, `remember_token_expiry`) VALUES
(1, 'Agustina', 'Machado', 'agustina@ejemplo.com', 'agustina', '$2y$10$dtSNVjoRmNye8nwJdURqsuybp.53M4aMPtAeocSNRe09KFwOmlUFe', '2025-11-18 13:16:30', 'c9b183bec65ebd7cb97665686df92bea9f035b6df46e2bb105182a4f1225abb5', '2025-12-18 15:02:42');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `artistas`
--
ALTER TABLE `artistas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `artistas`
--
ALTER TABLE `artistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
