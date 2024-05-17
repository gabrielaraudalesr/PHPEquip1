-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 17-05-2024 a les 12:34:12
-- Versió del servidor: 10.4.32-MariaDB
-- Versió de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `streameclipse`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `elementos`
--

CREATE TABLE `elementos` (
  `IDElemento` int(255) NOT NULL,
  `Titulo` mediumtext NOT NULL,
  `Tipo` enum('Serie','Película') NOT NULL,
  `Ano` year(4) NOT NULL,
  `Duracion` mediumtext NOT NULL,
  `Sinopsis` mediumtext NOT NULL,
  `Temporadas` int(255) DEFAULT NULL,
  `Direccion` mediumtext NOT NULL,
  `Interpretes` mediumtext NOT NULL,
  `Imagen` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadors `elementos`
--
DELIMITER $$
CREATE TRIGGER `log_elementosborrar` AFTER DELETE ON `elementos` FOR EACH ROW INSERT INTO logs (accion) 
    VALUES (
        CONCAT(
            'Se ha eliminado el elemento con ID: ', OLD.IDElemento, 
            ', Título: ', OLD.Titulo,
            ', Tipo: ', OLD.Tipo,
            ', Año: ', OLD.Ano,
            ', Duración: ', OLD.Duracion,
            ', Sinopsis: ', OLD.Sinopsis,
            ', Temporadas: ', OLD.Temporadas,
            ', Dirección: ', OLD.Direccion,
            ', Intérpretes: ', OLD.Interpretes,
            ', Imagen: ', OLD.Imagen
        )
    )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_elementosinsertar` AFTER INSERT ON `elementos` FOR EACH ROW INSERT INTO logs (accion) 
    VALUES (
        CONCAT(
            'Se ha insertado un nuevo elemento:',
            ' ID: ', NEW.IDElemento,
            ', Título: ', NEW.Titulo,
            ', Tipo: ', NEW.Tipo,
            ', Año: ', NEW.Ano,
            ', Duración: ', NEW.Duracion,
            ', Sinopsis: ', NEW.Sinopsis,
            ', Temporadas: ', NEW.Temporadas,
            ', Dirección: ', NEW.Direccion,
            ', Intérpretes: ', NEW.Interpretes,
            ', Imagen: ', NEW.Imagen
        )
    )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_elementosmodificar` AFTER UPDATE ON `elementos` FOR EACH ROW INSERT INTO log (accion) 
    VALUES (
        CONCAT(
            'Se ha actualizado el elemento con ID: ', OLD.IDElemento, 
            ', Titulo viejo: ', OLD.Titulo, ', Titulo nuevo: ', NEW.Titulo,
            ', Tipo viejo: ', OLD.Tipo, ', Tipo nuevo: ', NEW.Tipo,
            ', Año viejo: ', OLD.Ano, ', Año nuevo: ', NEW.Ano,
            ', Duración vieja: ', OLD.Duracion, ', Duración nueva: ', NEW.Duracion,
            ', Sinopsis vieja: ', OLD.Sinopsis, ', Sinopsis nueva: ', NEW.Sinopsis,
            ', Temporadas viejas: ', OLD.Temporadas, ', Temporadas nuevas: ', NEW.Temporadas,
            ', Dirección vieja: ', OLD.Direccion, ', Dirección nueva: ', NEW.Direccion,
            ', Intérpretes viejos: ', OLD.Interpretes, ', Intérpretes nuevos: ', NEW.Interpretes,
            ', Imagen vieja: ', OLD.Imagen, ', Imagen nueva: ', NEW.Imagen
        )
    )
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de la taula `listapersonal`
--

CREATE TABLE `listapersonal` (
  `IDUsuario` int(255) NOT NULL,
  `IDElemento` int(255) NOT NULL,
  `Titulo` mediumtext NOT NULL,
  `Tipo` enum('Serie','Película') NOT NULL,
  `Ano` year(4) NOT NULL,
  `Duracion` mediumtext NOT NULL,
  `Sinopsis` mediumtext NOT NULL,
  `Temporadas` int(255) DEFAULT NULL,
  `Direccion` mediumtext NOT NULL,
  `Interpretes` mediumtext NOT NULL,
  `Imagen` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `listapersonal`
--

INSERT INTO `listapersonal` (`IDUsuario`, `IDElemento`, `Titulo`, `Tipo`, `Ano`, `Duracion`, `Sinopsis`, `Temporadas`, `Direccion`, `Interpretes`, `Imagen`) VALUES
(0, 0, '[value-3]', '', '0000', '[value-6]', '[value-7]', 0, '[value-9]', '[value-10]', '[value-11]');

--
-- Disparadors `listapersonal`
--
DELIMITER $$
CREATE TRIGGER `log_listapersonalborrar` AFTER DELETE ON `listapersonal` FOR EACH ROW INSERT INTO logs (accion) 
    VALUES (
        CONCAT(
            'Se ha eliminado un elemento de la lista personal del usuario con ID: ', OLD.IDUsuario,
            ', ID del Elemento: ', OLD.IDElemento,
            ', Título: ', OLD.Titulo,
            ', Tipo: ', OLD.Tipo,
            ', Año: ', OLD.Ano,
            ', Duración: ', OLD.Duracion,
            ', Sinopsis: ', OLD.Sinopsis,
            ', Temporadas: ', OLD.Temporadas,
            ', Dirección: ', OLD.Direccion,
            ', Intérpretes: ', OLD.Interpretes,
            ', Imagen: ', OLD.Imagen
        )
    )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_listapersonalinsertar` AFTER INSERT ON `listapersonal` FOR EACH ROW INSERT INTO logs (accion) 
    VALUES (
        CONCAT(
            'Se ha añadido un nuevo elemento a la lista personal del usuario con ID: ', NEW.IDUsuario,
            ', ID del Elemento: ', NEW.IDElemento,
            ', Título: ', NEW.Titulo,
            ', Tipo: ', NEW.Tipo,
            ', Año: ', NEW.Ano,
            ', Duración: ', NEW.Duracion,
            ', Sinopsis: ', NEW.Sinopsis,
            ', Temporadas: ', NEW.Temporadas,
            ', Dirección: ', NEW.Direccion,
            ', Intérpretes: ', NEW.Interpretes,
            ', Imagen: ', NEW.Imagen
        )
    )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_listapersonalmodificar` AFTER UPDATE ON `listapersonal` FOR EACH ROW INSERT INTO log (accion) 
    VALUES (
        CONCAT(
            'Se ha actualizado el registro en la lista personal del usuario con ID: ', OLD.IDUsuario, 
            ', ID del Elemento viejo: ', OLD.IDElemento, ', ID del Elemento nuevo: ', NEW.IDElemento,
            ', Titulo viejo: ', OLD.Titulo, ', Titulo nuevo: ', NEW.Titulo,
            ', Tipo viejo: ', OLD.Tipo, ', Tipo nuevo: ', NEW.Tipo,
            ', Año viejo: ', OLD.Ano, ', Año nuevo: ', NEW.Ano,
            ', Duración vieja: ', OLD.Duracion, ', Duración nueva: ', NEW.Duracion,
            ', Sinopsis vieja: ', OLD.Sinopsis, ', Sinopsis nueva: ', NEW.Sinopsis,
            ', Temporadas viejas: ', OLD.Temporadas, ', Temporadas nuevas: ', NEW.Temporadas,
            ', Dirección vieja: ', OLD.Direccion, ', Dirección nueva: ', NEW.Direccion,
            ', Intérpretes viejos: ', OLD.Interpretes, ', Intérpretes nuevos: ', NEW.Interpretes,
            ', Imagen vieja: ', OLD.Imagen, ', Imagen nueva: ', NEW.Imagen
        )
    )
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de la taula `logs`
--

CREATE TABLE `logs` (
  `Id` int(255) NOT NULL,
  `Accion` mediumtext NOT NULL,
  `Fecha-Hora` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `logs`
--

INSERT INTO `logs` (`Id`, `Accion`, `Fecha-Hora`) VALUES
(4, 'Se ha insertado un nuevo elemento: ID: 1, Título: [value-2], Tipo: , Año: 0000, Duración: [value-5], Sinopsis: [value-6], Temporadas: 0, Dirección: [value-8], Intérpretes: [value-9], Imagen: [value-10]', '0000-00-00 00:00:00.000000'),
(5, 'Se ha insertado un nuevo elemento: ID: 2, Título: [value-2], Tipo: , Año: 0000, Duración: [value-5], Sinopsis: [value-6], Temporadas: 0, Dirección: [value-8], Intérpretes: [value-9], Imagen: [value-10]', '2024-05-17 12:20:40.455979'),
(6, 'Se ha insertado un nuevo elemento: ID: 6, Título: Titanic, Tipo: Película, Año: 0000, Duración: 2, Sinopsis: se hunde un barco, Temporadas: 1, Dirección: no lo se, Intérpretes: leonardo, Imagen: l.jpg', '2024-05-17 12:29:40.277230'),
(7, 'Se ha eliminado el elemento con ID: 1, Título: [value-2], Tipo: , Año: 0000, Duración: [value-5], Sinopsis: [value-6], Temporadas: 0, Dirección: [value-8], Intérpretes: [value-9], Imagen: [value-10]', '2024-05-17 12:30:27.362866'),
(8, 'Se ha eliminado el elemento con ID: 2, Título: [value-2], Tipo: , Año: 0000, Duración: [value-5], Sinopsis: [value-6], Temporadas: 0, Dirección: [value-8], Intérpretes: [value-9], Imagen: [value-10]', '2024-05-17 12:30:27.362866'),
(9, 'Se ha eliminado el elemento con ID: 6, Título: Titanic, Tipo: Película, Año: 0000, Duración: 2, Sinopsis: se hunde un barco, Temporadas: 1, Dirección: no lo se, Intérpretes: leonardo, Imagen: l.jpg', '2024-05-17 12:30:27.362866'),
(10, 'Se ha añadido un nuevo elemento a la lista personal del usuario con ID: 0, ID del Elemento: 0, Título: [value-3], Tipo: , Año: 0000, Duración: [value-6], Sinopsis: [value-7], Temporadas: 0, Dirección: [value-9], Intérpretes: [value-10], Imagen: [value-11]', '2024-05-17 12:30:42.495659');

-- --------------------------------------------------------

--
-- Estructura de la taula `mensaje`
--

CREATE TABLE `mensaje` (
  `IDMensaje` int(255) NOT NULL,
  `Texto` mediumtext NOT NULL,
  `Fecha` date NOT NULL,
  `Remitente` mediumtext NOT NULL,
  `Leido/NoLeido` int(255) NOT NULL,
  `Receptor` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadors `mensaje`
--
DELIMITER $$
CREATE TRIGGER `log_mensajeborrar` AFTER DELETE ON `mensaje` FOR EACH ROW INSERT INTO logs (accion) 
    VALUES (
        CONCAT(
            'Se ha eliminado un mensaje con ID: ', OLD.IDMensaje,
            ', Texto: ', OLD.Texto,
            ', Fecha: ', OLD.Fecha,
            ', Remitente: ', OLD.Remitente,
            ', Leído/No leído: ', OLD.`Leido/NoLeido`,
            ', Receptor: ', OLD.Receptor
        )
    )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_mensajeinsertar` AFTER INSERT ON `mensaje` FOR EACH ROW INSERT INTO logs (accion) 
    VALUES (
        CONCAT(
            'Se ha insertado un nuevo mensaje con ID: ', NEW.IDMensaje,
            ', Texto: ', NEW.Texto,
            ', Fecha: ', NEW.Fecha,
            ', Remitente: ', NEW.Remitente,
            ', Leído/No leído: ', NEW.`Leido/NoLeido`,
            ', Receptor: ', NEW.Receptor
        )
    )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_mensajemodificar` AFTER UPDATE ON `mensaje` FOR EACH ROW INSERT INTO log (accion) 
    VALUES (
        CONCAT(
            'Se ha actualizado el mensaje con ID: ', OLD.IDMensaje, 
            ', Texto viejo: ', OLD.Texto, ', Texto nuevo: ', NEW.Texto,
            ', Fecha vieja: ', OLD.Fecha, ', Fecha nueva: ', NEW.Fecha,
            ', Remitente viejo: ', OLD.Remitente, ', Remitente nuevo: ', NEW.Remitente,
            ', Leído/No Leído viejo: ', OLD.`Leido/NoLeido`, ', Leído/No Leído nuevo: ', NEW.`Leido/NoLeido`,
            ', Receptor viejo: ', OLD.Receptor, ', Receptor nuevo: ', NEW.Receptor
        )
    )
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de la taula `subidas`
--

CREATE TABLE `subidas` (
  `IDSubida` int(255) NOT NULL,
  `IDUsuario` int(255) NOT NULL,
  `IDElemento` int(255) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadors `subidas`
--
DELIMITER $$
CREATE TRIGGER `log_subidasborrar` AFTER DELETE ON `subidas` FOR EACH ROW INSERT INTO logs (accion) 
    VALUES (
        CONCAT(
            'Se ha eliminado una subida con ID: ', OLD.IDSubida,
            ', ID de usuario: ', OLD.IDUsuario,
            ', ID de elemento: ', OLD.IDElemento,
            ', Fecha: ', OLD.Fecha
        )
    )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_subidasinsertar` AFTER INSERT ON `subidas` FOR EACH ROW INSERT INTO logs (accion) 
    VALUES (
        CONCAT(
            'Se ha insertado una nueva subida con ID: ', NEW.IDSubida,
            ', ID de usuario: ', NEW.IDUsuario,
            ', ID de elemento: ', NEW.IDElemento,
            ', Fecha: ', NEW.Fecha
        )
    )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_subidasmodificar` AFTER UPDATE ON `subidas` FOR EACH ROW INSERT INTO log (accion) 
    VALUES (
        CONCAT(
            'Se ha actualizado la subida con ID: ', OLD.IDSubida, 
            ', ID de usuario viejo: ', OLD.IDUsuario, ', ID de usuario nuevo: ', NEW.IDUsuario,
            ', ID del Elemento viejo: ', OLD.IDElemento, ', ID del Elemento nuevo: ', NEW.IDElemento,
            ', Fecha vieja: ', OLD.Fecha, ', Fecha nueva: ', NEW.Fecha
        )
    )
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de la taula `usuarios`
--

CREATE TABLE `usuarios` (
  `IDUsuario` int(255) NOT NULL,
  `Nombre` mediumtext NOT NULL,
  `Apellido` mediumtext NOT NULL,
  `Contrasena` mediumtext NOT NULL,
  `Poblacion` mediumtext NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Correo` mediumtext NOT NULL,
  `ImagenPerfil` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadors `usuarios`
--
DELIMITER $$
CREATE TRIGGER `log_usuarioeliminar` AFTER DELETE ON `usuarios` FOR EACH ROW INSERT INTO logs (accion) 
    VALUES (
        CONCAT(
            'Se ha eliminado el usuario con id: ', OLD.IDUsuario, 
            ', Nombre: ', OLD.Nombre,
            ', Apellido: ', OLD.Apellido,
            ', Contraseña: ', OLD.Contrasena,
            ', Población: ', OLD.Poblacion,
            ', Fecha de Nacimiento: ', OLD.FechaNacimiento,
            ', Correo: ', OLD.Correo,
            ', Imagen de Perfil: ', OLD.ImagenPerfil
        )
    )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_usuarioinsertar` AFTER INSERT ON `usuarios` FOR EACH ROW INSERT INTO logs (accion) 
    VALUES (
        CONCAT(
            'Se ha insertado el usuario con id: ', NEW.IDUsuario, 
            ', Nombre: ', NEW.Nombre, 
            ', Apellido: ', NEW.Apellido, 
            ', Contraseña: ', NEW.Contrasena, 
            ', Población: ', NEW.Poblacion, 
            ', Fecha de Nacimiento: ', NEW.FechaNacimiento, 
            ', Correo: ', NEW.Correo, 
            ', Imagen de Perfil: ', NEW.ImagenPerfil
        )
    )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_usuariomodificar` AFTER UPDATE ON `usuarios` FOR EACH ROW INSERT INTO log (accion) 
    VALUES (
        CONCAT(
            'Se ha actualizado el usuario con ID: ', OLD.IDUsuario, 
            ', Nombre viejo: ', OLD.Nombre, ', Nombre nuevo: ', NEW.Nombre,
            ', Apellido viejo: ', OLD.Apellido, ', Apellido nuevo: ', NEW.Apellido,
            ', Contraseña vieja: ', OLD.Contrasena, ', Contraseña nueva: ', NEW.Contrasena,
            ', Población vieja: ', OLD.Poblacion, ', Población nueva: ', NEW.Poblacion,
            ', Fecha de Nacimiento vieja: ', OLD.FechaNacimiento, ', Fecha de Nacimiento nueva: ', NEW.FechaNacimiento,
            ', Correo viejo: ', OLD.Correo, ', Correo nuevo: ', NEW.Correo,
            ', Imagen de Perfil vieja: ', OLD.ImagenPerfil, ', Imagen de Perfil nueva: ', NEW.ImagenPerfil
        )
    )
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de la taula `valoracion`
--

CREATE TABLE `valoracion` (
  `IDValoracion` int(255) NOT NULL,
  `IDElemento` int(255) NOT NULL,
  `IDUsuario` int(255) NOT NULL,
  `Comentario` mediumtext NOT NULL,
  `Nota` set('0-10') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadors `valoracion`
--
DELIMITER $$
CREATE TRIGGER `log_valoraciondelete` AFTER DELETE ON `valoracion` FOR EACH ROW INSERT INTO logs (accion) 
    VALUES (
        CONCAT(
            'Se ha eliminado una valoración con ID: ', OLD.IDValoracion,
            ', ID de elemento: ', OLD.IDElemento,
            ', ID de usuario: ', OLD.IDUsuario,
            ', Comentario: ', OLD.Comentario,
            ', Nota: ', OLD.Nota
        )
    )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_valoracioninsertar` AFTER INSERT ON `valoracion` FOR EACH ROW INSERT INTO logs (accion) 
    VALUES (
        CONCAT(
            'Se ha insertado una nueva valoración con ID: ', NEW.IDValoracion,
            ', ID de elemento: ', NEW.IDElemento,
            ', ID de usuario: ', NEW.IDUsuario,
            ', Comentario: ', NEW.Comentario,
            ', Nota: ', NEW.Nota
        )
    )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_valoracionmodificar` AFTER UPDATE ON `valoracion` FOR EACH ROW INSERT INTO log (accion) 
    VALUES (
        CONCAT(
            'Se ha actualizado la valoración con ID: ', OLD.IDValoracion, 
            ', ID del Elemento viejo: ', OLD.IDElemento, ', ID del Elemento nuevo: ', NEW.IDElemento,
            ', ID de usuario viejo: ', OLD.IDUsuario, ', ID de usuario nuevo: ', NEW.IDUsuario,
            ', Comentario viejo: ', OLD.Comentario, ', Comentario nuevo: ', NEW.Comentario,
            ', Nota vieja: ', OLD.Nota, ', Nota nueva: ', NEW.Nota
        )
    )
$$
DELIMITER ;

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `elementos`
--
ALTER TABLE `elementos`
  ADD PRIMARY KEY (`IDElemento`);

--
-- Índexs per a la taula `listapersonal`
--
ALTER TABLE `listapersonal`
  ADD PRIMARY KEY (`IDUsuario`);

--
-- Índexs per a la taula `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`Id`);

--
-- Índexs per a la taula `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`IDMensaje`);

--
-- Índexs per a la taula `subidas`
--
ALTER TABLE `subidas`
  ADD PRIMARY KEY (`IDSubida`);

--
-- Índexs per a la taula `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IDUsuario`),
  ADD UNIQUE KEY `Correo` (`Correo`) USING HASH;

--
-- Índexs per a la taula `valoracion`
--
ALTER TABLE `valoracion`
  ADD PRIMARY KEY (`IDValoracion`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `elementos`
--
ALTER TABLE `elementos`
  MODIFY `IDElemento` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la taula `logs`
--
ALTER TABLE `logs`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la taula `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `IDMensaje` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `subidas`
--
ALTER TABLE `subidas`
  MODIFY `IDSubida` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IDUsuario` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la taula `valoracion`
--
ALTER TABLE `valoracion`
  MODIFY `IDValoracion` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
