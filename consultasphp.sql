-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-08-2014 a las 21:21:55
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `consultasphp`
--
CREATE DATABASE IF NOT EXISTS `consultasphp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `consultasphp`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargac`
--

CREATE TABLE IF NOT EXISTS `cargac` (
  `idcargac` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la Carga de combustible',
  `idUnidisp` int(11) NOT NULL COMMENT 'Id de la programación de la tabla unidisp',
  `cfecha` date DEFAULT NULL COMMENT 'Fecha de la Carga de Combustible',
  `ckmtab` int(11) DEFAULT NULL COMMENT 'Kilometraje de tablero',
  `ckmhub` int(11) DEFAULT NULL COMMENT 'Kilometraje hubodometro',
  `cnivelt1` int(11) DEFAULT NULL COMMENT 'Nivel de combustible antes de la carga del tanque 1',
  `cnivelt2` int(11) DEFAULT NULL COMMENT 'Nivel de combustible antes de la carga del tanque 2',
  `clt1` float(7,3) DEFAULT NULL COMMENT 'Litros cargados en el tanque 1',
  `cprecio1` float(7,2) DEFAULT NULL COMMENT 'Precio del combustible actual',
  `ctotal1` float(7,2) DEFAULT NULL COMMENT 'Precio por cantidad de la carga en tanque 1',
  `clt2` float(7,3) DEFAULT NULL COMMENT 'Litros cargados en tanque 2',
  `cprecio2` float(7,2) DEFAULT NULL COMMENT 'Precio del combustible cargado en tanque 2',
  `ctotal2` float(7,2) DEFAULT NULL COMMENT 'Precio por cantidad de el tanque 2 cargado',
  `cbomba` tinyint(2) DEFAULT NULL COMMENT 'Numero de bomba en donde se cargó',
  `cdespa` varchar(80) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'Nombre de el despachador que atendio',
  PRIMARY KEY (`idcargac`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='Tabla para el almacenamiento de las cargas de combustible' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE IF NOT EXISTS `unidades` (
  `unoeconomico` int(11) NOT NULL,
  `ufabricante` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `umarca` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `usubmarca` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `umodelo` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `uplacas` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `utanque1` int(11) DEFAULT NULL,
  `utanque2` int(11) DEFAULT NULL,
  `ucombustible` enum('GASOLINA MAGNA','GAS L.P.','DIESEL','GASOLINA PREMIUM') COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ustatus` tinyint(4) NOT NULL,
  PRIMARY KEY (`unoeconomico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`unoeconomico`, `ufabricante`, `umarca`, `usubmarca`, `umodelo`, `uplacas`, `utanque1`, `utanque2`, `ucombustible`, `ustatus`) VALUES
(1, 'NISSAN', 'NISSAN', 'TSURU', '2004', '000AAA', 50, 0, 'GASOLINA MAGNA', 0),
(2, 'NISSAN', 'NISSAN', 'TSURU', '2012', '000AAA', 50, 0, 'GASOLINA MAGNA', 0),
(3, 'NISSAN', 'NISSAN', 'TSURU', '2012', '000AAA', 50, 0, 'GASOLINA MAGNA', 0),
(4, 'NISSAN', 'NISSAN', 'TSURU', '2012', '000AAA', 50, 0, 'GASOLINA MAGNA', 0),
(5, 'VOLVO', 'VOLVO', 'XC90', '2007', '000AAA', 77, 0, 'GASOLINA PREMIUM', 0),
(6, 'TOYOTA', 'TOYOTA', 'COROLLA', '2009', '000AAA', 50, 0, 'GASOLINA MAGNA', 0),
(7, 'TOYOTA', 'TOYOTA', 'YARIS', '2010', '000AAA', 42, 0, 'GASOLINA MAGNA', 0),
(8, 'GMC', 'GMC', 'YUKON', '2011', '000AAA', 98, 0, 'GASOLINA PREMIUM', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidisp`
--

CREATE TABLE IF NOT EXISTS `unidisp` (
  `idUnidisp` int(11) NOT NULL AUTO_INCREMENT COMMENT 'idUnidad',
  `udFecha` date NOT NULL COMMENT 'Fecha Salida',
  `udProgrec` int(11) NOT NULL COMMENT 'Programa de Recolección',
  `udUnidad` int(11) NOT NULL COMMENT 'Unidad',
  `udNChofer` int(11) NOT NULL COMMENT 'Chofer',
  `udAyudante` int(11) NOT NULL COMMENT 'Ayudante',
  `udSalida` time NOT NULL COMMENT 'Hora de Salida',
  `udCargac` tinyint(4) NOT NULL COMMENT 'Carga de Combustible',
  `udNextel` tinyint(4) NOT NULL COMMENT 'id del Radio que llevan',
  `udEfectivo` decimal(4,2) NOT NULL COMMENT 'Efectivo que se envía a los choferes',
  `udRevSalida` tinyint(4) NOT NULL COMMENT '0 no 1 si',
  `udRevLlegada` tinyint(4) NOT NULL COMMENT '0 no 1 si',
  `udSegRuta` tinyint(4) NOT NULL COMMENT '0 No 1 Si',
  PRIMARY KEY (`idUnidisp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='Tabla que Almacena las unidades Disponibles para Recolección' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuarios` int(11) NOT NULL,
  `usnombre` varchar(150) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'Nombre de el Empleado\n\n',
  `usdepto` varchar(150) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'Departemento de el empleado\n',
  `uspuesto` varchar(150) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'Puesto del Empleado\n',
  `ustatus` enum('Alta','Baja') COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'Estatus de el empleado, en Alta o Baja\n',
  `ustipo` enum('0','1') COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'Tipo de usuario\n',
  `uspass` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'PassWord\n',
  PRIMARY KEY (`idusuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `usnombre`, `usdepto`, `uspuesto`, `ustatus`, `ustipo`, `uspass`) VALUES
(0, 'USUARIO 1', 'PROGRAMACION', 'JEFE', 'Alta', '0', 'b665e217b51994789b02b1838e730d6b93baa30f'),
(2, 'OPERADOR 1', 'PROGRAMACION', 'CHOFER', 'Alta', '0', 'b665e217b51994789b02b1838e730d6b93baa30f'),
(3, 'OPERADOR 2', 'PROGRAMACION', 'CHOFER', 'Alta', '0', 'b665e217b51994789b02b1838e730d6b93baa30f'),
(4, 'OPERADOR3', 'PROGRAMACION', 'CHOFER', 'Alta', '0', 'b665e217b51994789b02b1838e730d6b93baa30f'),
(5, 'OPERADOR4', 'PROGRAMACION', 'CHOFER', 'Alta', '0', 'b665e217b51994789b02b1838e730d6b93baa30f'),
(6, 'CABINA 1', 'CABINA', 'OPERADOR TMK', 'Alta', '0', 'b665e217b51994789b02b1838e730d6b93baa30f'),
(7, 'CABINA 2', 'CABINA', 'OPERADOR TMK', 'Alta', '0', 'b665e217b51994789b02b1838e730d6b93baa30f'),
(8, 'OPERADOR1', 'CONTABILIDAD', 'AUXILIAR ADMINISTRATIVO', 'Alta', '0', 'b665e217b51994789b02b1838e730d6b93baa30f');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
