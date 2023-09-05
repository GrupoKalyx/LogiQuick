-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2023 at 07:37 AM
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
  `idAlmacen` int(16) NOT NULL,
  `ubicacion` varchar(64) NOT NULL,
  `descUbi` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `almacenes`
--

INSERT INTO `almacenes` (`idAlmacen`, `ubicacion`, `descUbi`) VALUES
(0, 'Montevideo', ''),
(1, 'Paysandu', ''),
(2, 'Pando', ''),
(3, 'Shangrila', '');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `idLogin` int(9) NOT NULL,
  `contrasenia` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`idLogin`, `contrasenia`) VALUES
(1, 'root'),
(2, '2'),
(3, 'destructor'),
(5574, 'superEpicaYDificilContraseña'),
(56777777, '4s4y45y45y'),
(7, '7777777'),
(55741419, 'root');

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
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `tokenUsuario` varchar(64) NOT NULL,
  `idToken` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`tokenUsuario`, `idToken`) VALUES
('a7732fc8f71c2bf9d644bf5eb0c7a25b90616aa2e678b18a43292b1290027959', 1),
('96e74fbfd5bb57c4269c79e378c3d6053b99ed37d3a0cb1df21267f4126dc94d', 1),
('3b0dca164621d811c37cd6ad9f7a497e34433bd32b3a82b377be776bcbb0752b', 1),
('28dd6dcb764583d289da55bafa5df53c4395b42a8168cefa58f99ab063d416c4', 1),
('7382059314b9eca307ee5259269ad2bbb37e88b440943062a812eb6f8e54716c', 1),
('d2fac01c95845675d6e694cdfd34573d26c0ac6161a1e1cf9a7de34fe708c18e', 1),
('418c088984489df55ac88e5d06f414dae8b73da6de7efcc8aae7c3fd9f472592', 7),
('d471f9889622fae75ead1a6832b70cbec07d86bde467c24894d32d0294b525fd', 7),
('7508bd528de85d34c0025007e863def7960f2f60199612e535b94360357b84a1', 7),
('406f7bd2e89c7ee9d532eed620685c5a11b697488033528974bd85aec645792f', 7),
('4872af195e574219ef2564bdbe6b4bb4d360ee06706b4e0a218f763e7125793b', 7),
('ac4422a8b5370c00e496943121bf24ded19f46d6ff1039d60b84b6ef2c40cfad', 7);

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
(7, 'Séptimo', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `vehiculos`
--

CREATE TABLE `vehiculos` (
  `matricula` varchar(7) NOT NULL,
  `disponibilidad` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`idAlmacen`);

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
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ci`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
