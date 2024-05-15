-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Temps de generació: 15-05-2024 a les 09:37:57
-- Versió del servidor: 10.4.28-MariaDB
-- Versió de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `ProyectoAplicacionCliente`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `Elementos`
--

CREATE TABLE `Elementos` (
  `ID_Elemento` int(11) NOT NULL,
  `Título` varchar(20) NOT NULL,
  `Tipo` enum('Serie, Película') NOT NULL,
  `Año` year(4) NOT NULL,
  `Duración` varchar(15) NOT NULL,
  `Sinopsis` varchar(200) NOT NULL,
  `Temporadas` int(11) DEFAULT NULL,
  `Dirección` varchar(50) NOT NULL,
  `Intérpretes` varchar(50) NOT NULL,
  `Imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `Lista Personal`
--

CREATE TABLE `Lista Personal` (
  `ID_Usuario` int(11) NOT NULL,
  `ID_Elemento` int(11) NOT NULL,
  `Título` varchar(20) NOT NULL,
  `TIpo` enum('Serie, Película') NOT NULL,
  `Año` year(4) NOT NULL,
  `Duración` varchar(15) NOT NULL,
  `Sinopsis` varchar(400) NOT NULL,
  `Temporadas` int(11) DEFAULT NULL,
  `Dirección` varchar(50) NOT NULL,
  `Intérpretes` varchar(50) NOT NULL,
  `Imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `Mensaje`
--

CREATE TABLE `Mensaje` (
  `ID_Mensaje` int(11) NOT NULL,
  `Texto` varchar(300) NOT NULL,
  `Fecha` date NOT NULL,
  `Remitente` varchar(30) NOT NULL,
  `Leído/No Leído` tinyint(1) NOT NULL,
  `Receptor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `Subidas`
--

CREATE TABLE `Subidas` (
  `ID_Subida` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `ID_Elemento` int(11) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `Usuarios`
--

CREATE TABLE `Usuarios` (
  `ID_Usuario` int(11) NOT NULL,
  `Nombre` varchar(15) NOT NULL,
  `Apellido` varchar(15) NOT NULL,
  `Contraseña` varchar(50) NOT NULL,
  `Poblacion` varchar(35) NOT NULL,
  `Fecha Nacimiento` date NOT NULL,
  `Correo` varchar(25) NOT NULL,
  `Imagen Perfil` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `Valoración`
--

CREATE TABLE `Valoración` (
  `ID_Valoracion` int(11) NOT NULL,
  `ID_Elemento` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `Comentario` varchar(400) NOT NULL,
  `Nota` set('0-10') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `Elementos`
--
ALTER TABLE `Elementos`
  ADD PRIMARY KEY (`ID_Elemento`);

--
-- Índexs per a la taula `Lista Personal`
--
ALTER TABLE `Lista Personal`
  ADD PRIMARY KEY (`ID_Usuario`);

--
-- Índexs per a la taula `Mensaje`
--
ALTER TABLE `Mensaje`
  ADD PRIMARY KEY (`ID_Mensaje`);

--
-- Índexs per a la taula `Subidas`
--
ALTER TABLE `Subidas`
  ADD PRIMARY KEY (`ID_Subida`);

--
-- Índexs per a la taula `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD UNIQUE KEY `Correo` (`Correo`);

--
-- Índexs per a la taula `Valoración`
--
ALTER TABLE `Valoración`
  ADD PRIMARY KEY (`ID_Valoracion`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `Elementos`
--
ALTER TABLE `Elementos`
  MODIFY `ID_Elemento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `Mensaje`
--
ALTER TABLE `Mensaje`
  MODIFY `ID_Mensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `Subidas`
--
ALTER TABLE `Subidas`
  MODIFY `ID_Subida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `Valoración`
--
ALTER TABLE `Valoración`
  MODIFY `ID_Valoracion` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
