-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-01-2011 a las 18:27:54
-- Versión del servidor: 5.1.36
-- Versión de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `proyecto_biblioteca2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE IF NOT EXISTS `administradores` (
  `Codigo` double NOT NULL,
  `Tipo_Documento` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Nombres` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Apellidos` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Celular` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Sexo` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `Dia` int(2) NOT NULL,
  `Mes` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `Ano` int(4) NOT NULL,
  `Edad` int(3) NOT NULL,
  `Contrasena` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`Codigo`, `Tipo_Documento`, `Nombres`, `Apellidos`, `Direccion`, `Telefono`, `Celular`, `Sexo`, `Dia`, `Mes`, `Ano`, `Edad`, `Contrasena`) VALUES
(34152895, 'Cedula de Ciudadania', 'dario alberto', 'mendieta riaÃ±o', 'diag 66 b 12-78', '2459688', '3112048577', '0', 20, 'Enero', 1986, 24, 'jkhkji'),
(39675009, 'Cedula de Ciudadania', 'katerine jimena', 'plata', 'kr 87 a 35 b 41', '4520284', '3133748492', '0', 13, 'Diciembre', 1977, 33, 'sabado'),
(1012384134, 'Cedula de Ciudadania', 'Yurany ', 'Soler Moreno ', 'Tranv 5 e No 15 A o8 ', '7818274', '3124831030', '0', 13, 'Enero', 1992, 18, 'yurany'),
(12033559874, 'Tarjeta de Identidad', 'maria eugenia', 'cano casas', 'cll 45 c 39-87', '7485966', '3107485996', '0', 28, 'Noviembre', 1985, 25, 'domingo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE IF NOT EXISTS `autores` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombres` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `Ciudad_Origen` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `autores`
--

INSERT INTO `autores` (`Codigo`, `Nombres`, `Ciudad_Origen`) VALUES
(3, 'gabriel garcia marquez', 'colombia'),
(5, 'rafael pombo', 'colombia'),
(6, 'jorge luis borguez', 'argentina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--

CREATE TABLE IF NOT EXISTS `devoluciones` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Prestamo` int(11) NOT NULL,
  `Usuario` double NOT NULL,
  `Libro` int(11) NOT NULL,
  `Bibliotecologo` double NOT NULL,
  `Sancion` int(11) NOT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `Prestamo` (`Prestamo`),
  KEY `Usuario` (`Usuario`),
  KEY `Libro` (`Libro`),
  KEY `Bibliotecologo` (`Bibliotecologo`),
  KEY `Sancion` (`Sancion`),
  KEY `Usuario_2` (`Usuario`),
  KEY `Bibliotecologo_2` (`Bibliotecologo`),
  KEY `Libro_2` (`Libro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `devoluciones`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE IF NOT EXISTS `editorial` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`Codigo`, `Nombre`) VALUES
(1, 'norma'),
(2, 'santillana'),
(3, 'libros & libros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE IF NOT EXISTS `libros` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `Autor` int(11) NOT NULL,
  `Editorial` int(11) NOT NULL,
  `Referencia` int(11) NOT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `Autor` (`Autor`),
  KEY `Editorial` (`Editorial`),
  KEY `Referencia` (`Referencia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `libros`
--

INSERT INTO `libros` (`Codigo`, `Nombre`, `Autor`, `Editorial`, `Referencia`) VALUES
(1, 'la hojarasca', 3, 2, 2),
(2, ' El coronel no tiene quien le escriba', 3, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE IF NOT EXISTS `prestamos` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Libro` int(11) NOT NULL,
  `Usuario` double NOT NULL,
  `Bibliotecologo` double NOT NULL,
  `Dia` int(2) NOT NULL,
  `Mes` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `Ano` int(4) NOT NULL,
  `Dia_Dev.` int(2) NOT NULL,
  `Mes_Dev` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `Ano_Dev.` int(4) NOT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `Libro` (`Libro`),
  KEY `Usuario` (`Usuario`),
  KEY `Bibliotecologo` (`Bibliotecologo`),
  KEY `Usuario_2` (`Usuario`),
  KEY `Bibliotecologo_2` (`Bibliotecologo`),
  KEY `Libro_2` (`Libro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`Codigo`, `Libro`, `Usuario`, `Bibliotecologo`, `Dia`, `Mes`, `Ano`, `Dia_Dev.`, `Mes_Dev`, `Ano_Dev.`) VALUES
(1, 2, 93062125797, 12033559874, 1, 'enero', 2010, 2, 'enero', 2010);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencias`
--

CREATE TABLE IF NOT EXISTS `referencias` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `referencias`
--

INSERT INTO `referencias` (`Codigo`, `Nombre`) VALUES
(1, 'Literatura'),
(2, 'quimica'),
(3, 'ingles'),
(4, 'fisica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE IF NOT EXISTS `reservas` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` double NOT NULL,
  `Libro` int(11) NOT NULL,
  `Dia` int(2) NOT NULL,
  `Mes` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `Ano` int(4) NOT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `Usuario` (`Usuario`),
  KEY `Libro` (`Libro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcar la base de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`Codigo`, `Usuario`, `Libro`, `Dia`, `Mes`, `Ano`) VALUES
(10, 93062125797, 1, 29, 'Enero', 2011),
(11, 93062125797, 1, 29, 'Enero', 2011);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sanciones`
--

CREATE TABLE IF NOT EXISTS `sanciones` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` double NOT NULL,
  `Valor_Sancion` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `usuario` (`usuario`),
  KEY `usuario_2` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `sanciones`
--

INSERT INTO `sanciones` (`Codigo`, `usuario`, `Valor_Sancion`) VALUES
(1, 93062125797, '1500');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `Codigo` double NOT NULL,
  `Tipo_Documento` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Nombres` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Apellidos` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Celular` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Sexo` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `Dia` int(2) NOT NULL,
  `Mes` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `Ano` int(4) NOT NULL,
  `Edad` int(3) NOT NULL,
  `Contrasena` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Codigo`, `Tipo_Documento`, `Nombres`, `Apellidos`, `Direccion`, `Telefono`, `Celular`, `Sexo`, `Dia`, `Mes`, `Ano`, `Edad`, `Contrasena`) VALUES
(45789625, 'Cedula de Ciudadania', 'carlos arturo', 'cubillos palacio', 'cll 95 f 12-45', '4589632', '3114785962', '0', 13, 'Diciembre', 1977, 33, 'te amo'),
(2147483647, 'Tarjeta de Identidad', 'Jimena ', 'Plata', 'Calle 104 No 56-89', '4520284', '3133744892', 'F', 13, 'Diciembre', 1999, 12, '92011356054'),
(15246925698, 'Tarjeta de Identidad', 'karen dayana  ', 'veloza plata', 'cll 127 -33-69', '7458962', '3104578569', '0', 8, 'Octubre', 1998, 12, 'estrellita'),
(93062125797, 'Tarjeta de Identidad', 'lina marcela', 'duran chaparro', 'calle falsa123', '7855842', '3144260672', '0', 21, 'Junio', 1993, 17, 'lindura');

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD CONSTRAINT `devoluciones_ibfk_8` FOREIGN KEY (`Libro`) REFERENCES `libros` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `devoluciones_ibfk_1` FOREIGN KEY (`Prestamo`) REFERENCES `prestamos` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `devoluciones_ibfk_5` FOREIGN KEY (`Sancion`) REFERENCES `sanciones` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `devoluciones_ibfk_6` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `devoluciones_ibfk_7` FOREIGN KEY (`Bibliotecologo`) REFERENCES `administradores` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_3` FOREIGN KEY (`Referencia`) REFERENCES `referencias` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`Autor`) REFERENCES `autores` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`Editorial`) REFERENCES `editorial` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_4` FOREIGN KEY (`Libro`) REFERENCES `libros` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamos_ibfk_3` FOREIGN KEY (`Bibliotecologo`) REFERENCES `administradores` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`Libro`) REFERENCES `libros` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sanciones`
--
ALTER TABLE `sanciones`
  ADD CONSTRAINT `sanciones_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE;


