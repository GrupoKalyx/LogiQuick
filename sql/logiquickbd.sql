-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2023 at 07:29 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logiquickbd`
--

-- --------------------------------------------------------

--
-- Table structure for table `almacenes`
--

CREATE TABLE `almacenes` (
  `numAlmacen` int(255) NOT NULL,
  `tipoAlmacen` varchar(255) NOT NULL,
  `ubicacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `almacenes`
--

INSERT INTO `almacenes` (`numAlmacen`, `tipoAlmacen`, `ubicacion`) VALUES
(0, 'central ', 'Montevideo'),
(1, 'externo', 'Paysandu'),
(2, 'externo', 'Pando'),
(3, 'externo', 'Shangrila');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `id` int(9) NOT NULL,
  `contrasenia` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`id`, `contrasenia`) VALUES
(1, 'root'),
(2, '2');

-- --------------------------------------------------------

--
-- Table structure for table `lotes`
--

CREATE TABLE `lotes` (
  `numLote` int(20) NOT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'En Almacen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lotes`
--

INSERT INTO `lotes` (`numLote`, `estado`) VALUES
(4, 'en calle');

-- --------------------------------------------------------

--
-- Table structure for table `paquetes`
--

CREATE TABLE `paquetes` (
  `numBulto` int(20) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `gmailCliente` varchar(255) NOT NULL,
  `idRastreo` bigint(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paquetes`
--

INSERT INTO `paquetes` (`numBulto`, `estado`, `gmailCliente`, `idRastreo`) VALUES
(1, 'enDestino', 'example@hotmail.com ', 8334095785),
(2, 'enDestino', 'example@gmail.com', 8530122412),
(3, 'enDestino', 'elpepetilin@gmail.com', 3381331158);

-- --------------------------------------------------------

--
-- Table structure for table `pickups`
--

CREATE TABLE `pickups` (
  `matricula` varchar(8) NOT NULL DEFAULT 'ABC 1234'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `tokenUsuario` varchar(255) NOT NULL,
  `ci` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`tokenUsuario`, `ci`) VALUES
('{44DFB69C-E036-123E-06B7-8E8FC24E8F42}', 1),
('{CFCD6641-BB0A-3443-574A-23AC16257BC2}', 1),
('{7CB26EAD-5688-6EFC-8D9E-8B6EBC8297E8}', 1),
('{4394D6D0-8281-5268-67E0-1A1DD5CF312C}', 1),
('{72C4312E-C274-82D7-A3C0-B8BBC804E57C}', 1),
('{6736564A-D5D0-9F4D-FD65-E26735361AC2}', 1),
('{5880162F-0885-8119-095F-1D099B156A87}', 1),
('{8BA60926-0D79-ADA2-405C-2B66A555573C}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `ci` int(8) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`ci`, `nombre`, `tipo`) VALUES
(1, 'AdminNahue', 'Admin'),
(2, 'Elpepe', 'Camionero');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`numAlmacen`);

--
-- Indexes for table `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`numLote`);

--
-- Indexes for table `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`numBulto`);

--
-- Indexes for table `pickups`
--
ALTER TABLE `pickups`
  ADD PRIMARY KEY (`matricula`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ci`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
