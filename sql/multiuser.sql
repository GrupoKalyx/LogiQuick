-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-07-2023 a las 14:40:57
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `multiuser`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessiontoken`
--

CREATE TABLE `sessiontoken` (
  `userToken` varchar(255) NOT NULL,
  `UserT` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sessiontoken`
--

INSERT INTO `sessiontoken` (`userToken`, `UserT`) VALUES
('{0D32A768-332D-EA93-9474-E88A15C4763E}', 'admin'),
('{3C0CBCF3-9D05-D30E-1BC3-E818F7ACA125}', 'admin'),
('{482B41CB-1EC3-BEF3-5297-88B22C61698E}', 'admin'),
('{07E7880F-0F5D-B4FF-E2FE-0D385E61D196}', 'gordito'),
('{515BB0CD-7926-362F-0BBF-42248418B2F0}', 'admin'),
('{4EFA24CB-1A67-8B56-C1BF-F4E3E68AA791}', 'admin'),
('{F658F183-5962-9AF4-3993-CF3C2EC10BB1}', 'admin'),
('{6A878CA0-603B-F374-7BCA-99EE66BE23D8}', 'user'),
('{B996F4A8-D43F-AAC3-8F8C-4D13FA2FEFC4}', 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `typeuser`
--

CREATE TABLE `typeuser` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `typeuser`
--

INSERT INTO `typeuser` (`username`, `password`, `type`) VALUES
('user', 'root', 'user'),
('admin', 'admin', 'admin'),
('gordito', '12345', 'user'),
('agustin', 'men1234', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
