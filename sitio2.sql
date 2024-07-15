-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-03-2024 a las 21:29:10
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sitio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `fecha` date DEFAULT NULL,
  `imagen` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `nombre`, `pais`, `fecha`, `imagen`) VALUES
(25, 'Prehistoricos', 'Chile', '2024-03-12', '1711480658_150325_166951506678520_100000910145857_332738_1708699_n.jpg'),
(26, 'Avril lavigne', 'Canada', '2024-03-01', '1711397643_avril.jpg'),
(27, 'Room on fire', 'Eu', '2024-03-10', '1711400398_Room_on_Fire_cover.jpg'),
(28, 'SuperSubmarina', 'España', '2024-03-03', '1711400416_santacruz.jpg'),
(29, 'Espectacular Oracular', 'MGMT', '2024-03-09', '1711480435_mgmt03.jpg'),
(30, 'Eagles', 'EU', '2024-03-23', '1711480926_Strokes_1.jpg'),
(31, 'is this it', 'EU', '2024-03-28', '1711481174_The_Strokes_-_Is_This_It_cover.jpg'),
(33, 'america', 'Mexico', '2024-02-09', '1711484314_familiaunida.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
