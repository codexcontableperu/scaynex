-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 30-08-2022 a las 13:33:07
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `planner`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adjuntos`
--

DROP TABLE IF EXISTS `adjuntos`;
CREATE TABLE IF NOT EXISTS `adjuntos` (
  `id_doc` int(11) NOT NULL AUTO_INCREMENT,
  `doc_serienum` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `doc_concepto` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `doc_importe` decimal(4,0) NOT NULL,
  `doc_adjunto` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `id_prog` int(11) NOT NULL,
  PRIMARY KEY (`id_doc`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `cte_ruc` bigint(11) NOT NULL,
  `cte_razonsocial` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `cte_nombrecomercial` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `cte_direccion` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `cte_distrito` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `cte_contacto` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `cte_logo` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT 'img/cte/ctelogo.jpg',
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `cte_ruc` (`cte_ruc`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `cte_ruc`, `cte_razonsocial`, `cte_nombrecomercial`, `cte_direccion`, `cte_distrito`, `cte_contacto`, `cte_logo`) VALUES
(1, 20556045250, 'BIOMEDICAL LOGISTICS S.A.C.', 'BOMI PERU', 'CAR.PANAMERICANA SUR NRO. 2001 (KM. 38, INTERIOR G-05B) LIMA', 'PUNTA HERMOSA', NULL, 'img/cte/bomi.png'),
(2, 20340530064, 'LABORATORIO HOFARM S.A.C.', 'HOFARM', 'AV. LOS FRUTALES NRO. 245 FND. FUNDO MONTERRICO GRANDE LIMA', 'ATE', NULL, 'img/cte/hofarm.png'),
(3, 20514302473, 'ACCORD HEALTHCARE S.A.C.', 'ACCORD', 'AV. ALFREDO BENAVIDES NRO. 1579 DPTO. 505 INT. 505 URB. SAN ANTONIO (OFICINAS 505-506) LIMA', 'MIRAFLORES', NULL, 'img/cte/accord.svg'),
(4, 20563351960, 'THEFAR S.A.C.', 'THEFAR', 'AV. ARENALES NRO. 722 (ESQ LOS ANGELES 201) LIMA', 'MIRAFLORES', NULL, 'img/cte/THEFAR.png'),
(5, 20602872417, 'QUALIS PHARMA S.A.C.', 'QUALIS PHARMA', 'CAL.GRIMALDO DEL SOLAR NRO. 162 INT. 804 URB. LEURO LIMA', 'MIRAFLORES', NULL, 'img/cte/QUALIS.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

DROP TABLE IF EXISTS `cuentas`;
CREATE TABLE IF NOT EXISTS `cuentas` (
  `id_cta` int(11) NOT NULL AUTO_INCREMENT,
  `cta_logo` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT 'img/cta/ctalogo.jpg',
  `cta_razonsocial` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `cta_nombrecomercial` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `cta_ruc` bigint(11) NOT NULL,
  `cta_contacto` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id_cta`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`id_cta`, `cta_logo`, `cta_razonsocial`, `cta_nombrecomercial`, `cta_ruc`, `cta_contacto`, `id_cliente`) VALUES
(9, 'img/cta/ctalogo.jpg ', 'OPELLA HEALTHCARE DEL PERU S.A.C', 'OPELLA', 20606567759, '1', 2),
(7, 'img/cta/ctalogo.jpg ', 'BOEHRINGER INGELHEIM PERU S.A.C', 'BOEHRINGER ', 20523163320, '1', 1),
(6, 'img/cta/sanofi.png ', 'SANOFI-AVENTIS DEL PERU S.A', 'SANOFI', 20100096855, '1', 2),
(5, 'img/cta/roche.jpg ', 'ROCHE FARMA (PERU) S.A.', 'ROCHE ', 20556799327, '1', 1),
(4, 'img/cta/pfizer.jpg ', 'PFIZER S A', 'PFIZER', 20100127670, '1', 1),
(3, 'img/cta/lukoll.jpg ', 'LUKOLL S.A.C.', 'LUKOLL S.A.C.', 20507062653, '1', 2),
(2, 'img/cta/fenzyme.jpg ', 'GENZYME DEL PERU S.A.C.', 'GENZYME', 20492919145, '1', 1),
(1, 'img/cta/abbott.jpg ', 'ABBOTT LABORATORIOS SA', 'ABBOTT', 20100096936, '1', 2),
(10, 'img/cta/ctalogo.jpg ', 'ACCORD HEALTHCARE S.A.C.', 'ACCORD', 20514302473, '1', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `id_emp` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `ruc_emp` bigint(11) NOT NULL,
  PRIMARY KEY (`id_emp`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_emp`, `razon_social`, `ruc_emp`) VALUES
(1, 'CORPORACIÓN JSA LLANOS S.A.C', 20604344710),
(2, 'TRANSPORTES JS GREGORI SAC', 20478065184);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_prog`
--

DROP TABLE IF EXISTS `estado_prog`;
CREATE TABLE IF NOT EXISTS `estado_prog` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(10) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `estado_prog`
--

INSERT INTO `estado_prog` (`id_estado`, `estado`) VALUES
(1, 'Programado'),
(2, 'En proceso'),
(3, 'Finalizado'),
(4, 'disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guias_remitente`
--

DROP TABLE IF EXISTS `guias_remitente`;
CREATE TABLE IF NOT EXISTS `guias_remitente` (
  `id_guiar` int(11) NOT NULL AUTO_INCREMENT,
  `id_prog` int(11) NOT NULL,
  `gr_serienum` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `gr_origen` int(11) NOT NULL,
  `gr_destino` int(11) NOT NULL,
  `origen_distrito` int(11) DEFAULT NULL,
  `destino_distrito` int(11) DEFAULT NULL,
  `fact_cliente` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `gr_bultos` int(11) DEFAULT NULL,
  `gr_peso` int(11) DEFAULT NULL,
  `gr_carga` int(11) DEFAULT NULL,
  `gr_obs` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_guiar`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `head_programaciones`
--

DROP TABLE IF EXISTS `head_programaciones`;
CREATE TABLE IF NOT EXISTS `head_programaciones` (
  `id_head` int(11) NOT NULL AUTO_INCREMENT,
  `id_emp` int(11) NOT NULL,
  `head_fecha` date NOT NULL,
  `head_nombre` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `fechareg` date NOT NULL COMMENT 'guarda la fecha del sistema ',
  `head_habilidad` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_head`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `head_programaciones`
--

INSERT INTO `head_programaciones` (`id_head`, `id_emp`, `head_fecha`, `head_nombre`, `id_cliente`, `id_user`, `fechareg`, `head_habilidad`) VALUES
(18, 1, '2022-08-29', 'PRIERA PROGRAMACION', 3, 1, '2022-08-28', 'SECO'),
(17, 1, '2022-08-29', 'envio de retorno', 2, 1, '2022-08-28', 'CLIMATIZADO'),
(16, 1, '2022-08-29', 'caraga camara seca', 1, 1, '2022-08-28', 'SECO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hruta`
--

DROP TABLE IF EXISTS `hruta`;
CREATE TABLE IF NOT EXISTS `hruta` (
  `id_ruta` int(11) NOT NULL AUTO_INCREMENT,
  `ruta_glosa` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `t_inicio` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `h_inicio` time DEFAULT NULL,
  `t_salidabase` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `h_salidabase` time DEFAULT NULL,
  `t_llegadaorigen` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `h_llegadaorigen` time DEFAULT NULL,
  `t_iniciocarga` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `h_iniciocarga` time DEFAULT NULL,
  `t_salidaorigen` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `h_salidaorigen` time DEFAULT NULL,
  `t_llegadadestino` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `h_llegadadestino` time DEFAULT NULL,
  `t_iniciodescarga` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `h_iniciodescarga` time DEFAULT NULL,
  `t_retorno` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `h_retorno` time DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `fechahr` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_prog` int(11) NOT NULL,
  `ruta_obs` text COLLATE latin1_general_ci,
  `serie_guiatrans` int(2) DEFAULT NULL,
  `num_guiatrans` int(10) DEFAULT NULL,
  `k_salidabase` bigint(20) DEFAULT NULL,
  `k_llegadaorigen` bigint(20) DEFAULT NULL,
  `k_llegadadestino` bigint(20) DEFAULT NULL,
  `k_retorno` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_ruta`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `hruta`
--

INSERT INTO `hruta` (`id_ruta`, `ruta_glosa`, `t_inicio`, `h_inicio`, `t_salidabase`, `h_salidabase`, `t_llegadaorigen`, `h_llegadaorigen`, `t_iniciocarga`, `h_iniciocarga`, `t_salidaorigen`, `h_salidaorigen`, `t_llegadadestino`, `h_llegadadestino`, `t_iniciodescarga`, `h_iniciodescarga`, `t_retorno`, `h_retorno`, `id_user`, `fechahr`, `id_prog`, `ruta_obs`, `serie_guiatrans`, `num_guiatrans`, `k_salidabase`, `k_llegadaorigen`, `k_llegadadestino`, `k_retorno`) VALUES
(16, 'OTR 55 - PFIZER ', '00.0', '08:28:34', '00.0', NULL, '00.0', '08:15:55', '00.0', '08:14:21', '00.0', '08:14:24', '00.00', '08:14:26', '00.0', '08:14:29', '00.0', '08:14:31', 1, '2022-08-28 18:35:55', 55, NULL, NULL, NULL, 0, 0, 0, 0),
(15, 'OTR 53 - SANOFI ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-08-28 18:24:04', 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lecturas`
--

DROP TABLE IF EXISTS `lecturas`;
CREATE TABLE IF NOT EXISTS `lecturas` (
  `id_lectura` int(11) NOT NULL AUTO_INCREMENT,
  `id_prog` int(11) NOT NULL,
  `k_salida` int(11) DEFAULT NULL,
  `k_evento` int(11) DEFAULT NULL,
  `k_abastece` int(11) DEFAULT NULL,
  `lec_responsable` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `lec_supervisor` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `lec_observaciones` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `h_llegada` int(11) DEFAULT NULL,
  `t_llegada` int(11) DEFAULT NULL,
  `h_entrega` int(11) DEFAULT NULL,
  `h_salida` int(11) DEFAULT NULL,
  `lec_contacto` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_lectura`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programaciones`
--

DROP TABLE IF EXISTS `programaciones`;
CREATE TABLE IF NOT EXISTS `programaciones` (
  `id_prog` int(11) NOT NULL AUTO_INCREMENT,
  `id_head` int(11) NOT NULL,
  `id_cta` int(11) NOT NULL,
  `vh_asignado` int(11) DEFAULT NULL,
  `vh_reportado` int(11) DEFAULT NULL,
  `id_conductor` int(11) NOT NULL,
  `id_ayudante` int(11) NOT NULL,
  `cant_estiva` int(2) NOT NULL,
  `id_tprog` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL DEFAULT '1',
  `serie_guiatrans` int(3) DEFAULT NULL,
  `num_guiatrans` int(5) DEFAULT NULL,
  `obs_prog` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `habilidad` varchar(15) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'seco o climatizado',
  PRIMARY KEY (`id_prog`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `programaciones`
--

INSERT INTO `programaciones` (`id_prog`, `id_head`, `id_cta`, `vh_asignado`, `vh_reportado`, `id_conductor`, `id_ayudante`, `cant_estiva`, `id_tprog`, `id_estado`, `serie_guiatrans`, `num_guiatrans`, `obs_prog`, `habilidad`) VALUES
(55, 18, 4, 12, 12, 3, 2, 2, 3, 1, NULL, NULL, 'caerga coca', NULL),
(54, 16, 9, 6, 6, 19, 19, 6, 1, 1, NULL, NULL, 'operacion obser datio', NULL),
(53, 16, 6, 2, 2, 8, 11, 2, 1, 1, NULL, NULL, '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `punto_destino`
--

DROP TABLE IF EXISTS `punto_destino`;
CREATE TABLE IF NOT EXISTS `punto_destino` (
  `id_pto` int(11) NOT NULL AUTO_INCREMENT,
  `id_guiar` int(11) NOT NULL,
  `h_llegada` int(11) DEFAULT NULL,
  `t_llegada` int(11) DEFAULT NULL,
  `h_entrega` int(11) DEFAULT NULL,
  `h_salida` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `contacto` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `observaciones` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_pto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `punto_origen`
--

DROP TABLE IF EXISTS `punto_origen`;
CREATE TABLE IF NOT EXISTS `punto_origen` (
  `id_pto` int(11) NOT NULL AUTO_INCREMENT,
  `id_guiar` int(11) NOT NULL,
  `h_llegada` int(11) DEFAULT NULL,
  `t_llegada` int(11) DEFAULT NULL,
  `h_entrega` int(11) DEFAULT NULL,
  `h_salida` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `contacto` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `observaciones` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_pto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_prog`
--

DROP TABLE IF EXISTS `tipo_prog`;
CREATE TABLE IF NOT EXISTS `tipo_prog` (
  `id_tprog` int(11) NOT NULL AUTO_INCREMENT,
  `tprog_nombre` varchar(30) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_tprog`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `tipo_prog`
--

INSERT INTO `tipo_prog` (`id_tprog`, `tprog_nombre`) VALUES
(1, 'RECOJO'),
(2, 'DESPACHO'),
(3, 'MANOAMANO'),
(4, 'DEVOLUCION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

DROP TABLE IF EXISTS `ubicaciones`;
CREATE TABLE IF NOT EXISTS `ubicaciones` (
  `id_ubica` int(11) NOT NULL AUTO_INCREMENT,
  `id_cta` int(11) NOT NULL,
  `ubica_razonsocial` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `ubica_ruc` bigint(11) NOT NULL,
  `ubica_direccion` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `ubica_distrito` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `ubica_gps` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `ubica_contacto` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `ubica_alcance` varchar(30) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'almacen, despaco, sucursal, etc',
  `ubica_propio` varchar(2) COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id_ubica`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`id_ubica`, `id_cta`, `ubica_razonsocial`, `ubica_ruc`, `ubica_direccion`, `ubica_distrito`, `ubica_gps`, `ubica_contacto`, `ubica_alcance`, `ubica_propio`) VALUES
(2, 6, 'Boticas y Salud S.A.C', 20384891943, NULL, 'Surco', NULL, NULL, NULL, 'no'),
(3, 6, 'Corporación Boticas Perú S.A.C', 20515346113, NULL, 'S.J.M', NULL, NULL, NULL, 'no'),
(4, 6, 'Corporación Moderna S.A.C', 20505579799, NULL, 'S.M.P', NULL, NULL, NULL, 'no'),
(5, 6, 'Disdroa E.I.R.L', 20519382831, NULL, 'Ancón', NULL, NULL, NULL, 'no'),
(6, 6, 'Drogueria Inretail Pharma S.A.C', 20604890617, NULL, 'Chorrillos', NULL, NULL, NULL, 'no'),
(7, 6, 'Drogueria Inretail Pharma S.A.C', 20604890617, NULL, 'Santa Anita', NULL, NULL, NULL, 'no'),
(8, 6, 'Drogueria y Distribuidora Dicar S.A', 20492307883, NULL, 'Chorrillos', NULL, NULL, NULL, 'no'),
(9, 6, 'Drogueria y Distribuidora Dicar S.A', 20492307883, NULL, 'Santa Anita', NULL, NULL, NULL, 'no'),
(10, 6, 'Farmacia Universal S.A.C', 20100025168, NULL, 'Cercado de Lima', NULL, NULL, NULL, 'no'),
(11, 6, 'Farmacia Universal S.A.C', 20100025168, NULL, 'Lima', NULL, NULL, NULL, 'no'),
(12, 6, 'Heidy UF Peru S.A.C', 20522322521, NULL, 'Ventanilla', NULL, NULL, NULL, 'no'),
(13, 6, 'IBT Health S.A.C', 20556281140, NULL, 'Punta Hermosa', NULL, NULL, NULL, 'no'),
(14, 6, 'Lider Pharma S.A', 20478203676, NULL, 'Comas', NULL, NULL, NULL, 'no'),
(15, 6, 'Quimica Suiza S.A.C', 20100085225, NULL, 'Santa Anita', NULL, NULL, NULL, 'no'),
(16, 6, 'Representaciones Deco S.A.C', 20100061474, NULL, 'Surco', NULL, NULL, NULL, 'no'),
(17, 6, 'Tomografía Medica S.A.C', 20502454111, NULL, 'Surco', NULL, NULL, NULL, 'no'),
(18, 6, 'Vanttive S.A.C', 20547141068, NULL, 'La Victoria', NULL, NULL, NULL, 'no'),
(19, 4, 'PFIZER S A', 20100127670, 'CAL.LAS ORQUIDEAS NRO. 585 INT. 701 URB. JARDIN', 'San isidro', NULL, NULL, 'Domicilio Fiscal', 'si'),
(20, 4, 'Clinica San Pablo S.A.C', 20107463705, 'CAL.LA CONQUISTA NRO. 145 URB. EL DERBY (CON AV EL POLO NRO 780)', 'Surco', NULL, NULL, NULL, 'no'),
(21, 9, 'OPELLA HEALTHCARE DEL PERU S.A.C', 20606567759, 'AV. JAVIER PRADO ESTE NRO. 444 INT. 1401 URB. JARDÍN ', 'San isidro', NULL, NULL, 'Domicilio Fiscal', 'si'),
(22, 9, 'Distribuidora Droguería Alfaro S.A.C', 20108983583, NULL, 'Callao', NULL, NULL, NULL, 'no'),
(23, 9, 'Perufarma S.A.', 20100052050, NULL, 'Lima', NULL, NULL, NULL, 'no'),
(24, 9, 'Quimica Suiza S.A.C', 20100085225, NULL, 'Santa Anita', NULL, NULL, NULL, 'no'),
(25, 3, 'LUKOLL S.A.C.', 20507062653, 'AV. ALBERTO DEL CAMPO NRO. 411 INT. P10', 'Magdalena', NULL, NULL, 'Domicilio Fiscal', 'si'),
(26, 3, 'LUKOLL S.A.C.', 20507062653, 'AV. INDUSTRIAL MZA. A LOTE. 16 Z.I. LAS PRADERAS DE LURIN', 'Lurin', NULL, NULL, 'DEPOSITO', 'si'),
(27, 3, 'Cosmograce S.A.C', 20601888271, NULL, 'Chorrillos', NULL, NULL, NULL, 'no'),
(29, 3, 'Distribuidora Continental  S.A', 20100067081, NULL, 'Ate', NULL, NULL, NULL, 'no'),
(30, 3, 'Distribuidora Continental  S.A', 20100067081, NULL, 'Santa Anita', NULL, NULL, NULL, 'no'),
(31, 3, 'Drogueria Inretail Pharma S.A.C', 20604890617, NULL, 'Santa Anita', NULL, NULL, NULL, 'no'),
(32, 3, 'Drogueria Inretail Pharma S.A.C', 20604890617, NULL, 'Chorrillos', NULL, NULL, NULL, 'no'),
(33, 3, 'Representaciones Deco S.A.C', 20100061474, NULL, 'Surco', NULL, NULL, NULL, 'no'),
(34, 3, 'Yargo Internacional EIRL', 20519131243, NULL, 'Callao', NULL, NULL, NULL, 'no'),
(35, 3, 'Yargo International EIRL', 20519131243, NULL, 'Callao', NULL, NULL, NULL, 'no'),
(36, 1, 'ABBOTT LABORATORIOS SA', 20100096936, 'AV. REPUBLICA DE PANAMA NRO. 3591 INT. PS 7', 'San isidro', NULL, NULL, 'Domicilio Fiscal', 'si'),
(37, 1, 'ABBOTT LABORATORIOS SA', 20100096936, 'MZA. A LOTE. 16 URB. INDUSTRIAL LAS PRADERAS', 'Lurin', NULL, NULL, 'DEPOSITO', 'si'),
(38, 1, 'ABBOTT LABORATORIOS SA', 20100096936, 'JR. LOS MIRTOS NRO. 120 URB. SAN EUGENIO', 'Lince', NULL, NULL, 'DEPOSITO', 'si'),
(39, 1, 'Clinica San Pablo S.A.C', 20107463705, NULL, 'Surco', NULL, NULL, NULL, 'no'),
(40, 1, 'Dinet S.A', 20427919111, NULL, 'Lurigancho', NULL, NULL, NULL, 'no'),
(41, 1, 'Neosalud S.A:C', 20514196428, 'JR. CARLOS ALAYZA Y ROEL NRO. 2180', 'Lince', NULL, NULL, 'OF.ADMINIST.', 'no'),
(42, 1, 'Neosalud S.A:C', 20514196428, 'JR. LAS HIGUERAS NRO. 349 URB. RESIDENCIAL MONTERRICO', 'La Molina', NULL, NULL, 'COMERCIAL', 'no'),
(43, 1, 'Neosalud S.A:C', 20514196428, 'CAL.CARLOS AUGUSTO SALAVERRY NRO. 3860 URB. PANAMERICANA NORTE', 'Los Olivos', NULL, NULL, 'COMERCIAL', 'no'),
(44, 1, 'Sistemas Analiticos S.R.L', 20155695901, 'CAL.DOMINGO CUETO NRO. 327', 'Lince', NULL, NULL, 'DEPOSITO', 'no'),
(1, 6, 'SANOFI-AVENTIS DEL PERU S.A', 20100096855, 'AV. JAVIER PRADO ESTE NRO. 444 INT. 1501 URB. JARDÍN', 'San isidro', NULL, NULL, 'Domicilio Fiscal', 'si'),
(28, 3, 'Dimexa S.A', 20100220700, NULL, 'Callao', NULL, NULL, NULL, 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

DROP TABLE IF EXISTS `unidades`;
CREATE TABLE IF NOT EXISTS `unidades` (
  `id_vh` int(11) NOT NULL AUTO_INCREMENT,
  `vh_avatar` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT 'img/und/vhavatar.png',
  `vh_placa` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `vh_nick` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `vh_marca` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `vh_modelo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `vh_Partidarrpp` int(20) DEFAULT NULL,
  `vh_año` int(4) DEFAULT NULL,
  `vh_config` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `vh_capacidad` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `vh_conductor` int(11) DEFAULT NULL,
  `vh_ayudante` int(11) DEFAULT NULL,
  `vh_tercero` varchar(2) COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `vh_activo` varchar(2) COLLATE latin1_general_ci NOT NULL DEFAULT 'si',
  `vh_disponible` varchar(2) COLLATE latin1_general_ci NOT NULL DEFAULT 'si',
  PRIMARY KEY (`id_vh`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id_vh`, `vh_avatar`, `vh_placa`, `vh_nick`, `vh_marca`, `vh_modelo`, `vh_Partidarrpp`, `vh_año`, `vh_config`, `vh_capacidad`, `vh_conductor`, `vh_ayudante`, `vh_tercero`, `vh_activo`, `vh_disponible`) VALUES
(1, 'img/und/4tn.png', 'A4Q-829', 'HYUNDAI', 'HYUNDAI', 'HD 65', 51917126, 2012, 'Climatizado', '4 TN', 1, 1, 'no', 'si', 'no'),
(2, 'img/und/1.5tn.png', 'AVH-922', 'KIA', 'KIA', 'K2700', 53750914, 2012, 'Climatizado', '1.5 TN', 1, 1, 'no', 'si', 'no'),
(3, 'img/und/1.5tn.png', 'AXN-798', 'HYUNDAI', 'HYUNDAI', 'H100 TRUCK', 53881144, 2012, 'Climatizado', '1.5 TN', 1, 1, 'no', 'si', 'no'),
(4, 'img/und/1.5tn.png', 'BHZ-800', 'CHEVROLET', 'CHEVROLET', 'N300 WORK', 54423709, 2012, 'Climatizado', '1.5 TN', 1, 1, 'no', 'si', 'si'),
(5, 'img/und/1.5tn.png', 'BJK-835', 'KIA', 'KIA', 'K2500', 54449251, 2012, 'Climatizado', '1.5 TN', 1, 1, 'no', 'si', 'si'),
(6, 'img/und/1.5tn.png', 'BJL-718', 'KIA', 'KIA', 'K2500', 54450778, 2012, 'Climatizado', '1.5 TN', 1, 1, 'no', 'si', 'no'),
(7, 'img/und/1.5tn.png', 'BJL-880', 'KIA', 'KIA', 'K2500', 54452528, 2012, 'Climatizado', '1.5 TN', 1, 1, 'no', 'si', 'si'),
(8, 'img/und/10tn.png', 'C7X-786', 'DONG FENG', 'DONG FENG', 'DFA1065TZ5BD3/2009', 51743747, 2012, 'Climatizado', '10 TN', 1, 1, 'no', 'si', 'si'),
(9, 'img/und/1.5tn.png', 'C7Z-755', 'HYUNDAI', 'HYUNDAI', 'H-100 TRUCK', 51652337, 2012, 'Climatizado', '1.5 TN', 1, 1, 'no', 'si', 'no'),
(10, 'img/und/1.5tn.png', 'D4U-810', 'YUEJIN', 'YUEJIN', 'NJ1020DF', 52292670, 2012, 'Climatizado', '1.5 TN', 1, 1, 'no', 'si', 'no'),
(11, 'img/und/1.5tn.png', 'Z7Q-926', 'KIA', 'KIA', 'K2500', 60578814, 2012, 'Climatizado', '1.5 TN', 1, 1, 'no', 'si', 'no'),
(12, 'img/und/1.5tn.png', 'Z7Q-928', 'KIA', 'KIA', 'K2500', 60578831, 2012, 'Climatizado', '1.5 TN', 1, 1, 'no', 'si', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `user_dni` varchar(8) COLLATE latin1_general_ci NOT NULL,
  `user_avatar` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'img/user/user.jpg',
  `user_nombre` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `user_nick` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `user_telefono` int(12) DEFAULT NULL,
  `user_mail` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `user_cargo` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `user_clave` varchar(8) COLLATE latin1_general_ci NOT NULL,
  `user_perfil` int(11) NOT NULL,
  `user_activo` varchar(2) COLLATE latin1_general_ci NOT NULL DEFAULT 'si',
  `user_disponible` varchar(2) COLLATE latin1_general_ci NOT NULL DEFAULT 'si',
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `user_dni`, `user_avatar`, `user_nombre`, `user_nick`, `user_telefono`, `user_mail`, `user_cargo`, `user_clave`, `user_perfil`, `user_activo`, `user_disponible`) VALUES
(2, '80846280', 'img/user/user.jpg', 'ARIAS ARCE JOSE BRAULIO', 'JOSE', 969742362, 'ariasarce96@gmail.com', 'obrero', '123', 2, 'si', 'no'),
(3, '44258779', 'img/user/user.jpg', 'CARHUAS ARCE YESSICA NELSI', 'YESSICA', 960928925, 'yessi.1987arce@gmail.com', 'obrero', '123', 2, 'si', 'no'),
(4, '73707178', 'img/user/user.jpg', 'CONDOR FIGUEROA CRISTIAN EMMANUEL', 'CRISTIAN', 916215434, 'capricornio5.tlv@hotmail.com', 'obrero', '123', 2, 'si', 'si'),
(5, '75837516', 'img/user/user.jpg', 'LLANOS ARCE SAMIR BERNABE ', 'SAMIR', 939272139, 'samir_capricornio18@hotmail.com', 'obrero', '123', 2, 'si', 'si'),
(7, '45100370', 'img/user/user.jpg', 'CAMPOS ARIAS NICKER NILTON', 'NICKER', 963239320, 'camposariasnick@gmail.com', 'obrero', '123', 2, 'si', 'si'),
(8, '75837515', 'img/user/user.jpg', 'LLANOS ARCE GREGORY ANDRE', 'GREGORY', 981500904, NULL, 'obrero', '123', 2, 'si', 'si'),
(9, '10252068', 'img/user/user.jpg', 'LLANOS VASQUEZ AMERICO', 'AMERICO', 926082151, NULL, 'obrero', '123', 2, 'si', 'no'),
(10, '21283717', 'img/user/user.jpg', 'MORENO CALERO ANGEL MANUEL', 'ANGEL', 987216534, 'manuelmorenocalero2017@gmail,com', 'obrero', '123', 2, 'si', 'no'),
(11, '46346280', 'img/user/user.jpg', 'PALACIOS MOLINA FRANK EDINSON', 'FRANK', 912842166, NULL, 'obrero', '123', 2, 'si', 'no'),
(12, '76342585', 'img/user/user.jpg', 'PANDURO QUIQUIA ELVIS EDISON', 'ELVIS', 979542294, NULL, 'obrero', '123', 2, 'si', 'no'),
(13, '45525666', 'img/user/user.jpg', 'ANCO SACCACO RAUL LINO', 'RAUL', 992577974, NULL, 'obrero', '123', 2, 'si', 'no'),
(14, '77079456', 'img/user/user.jpg', 'ARANDA BAYONA EMILIANO ROY', 'EMILIANO', 933571359, 'emiliano.aranda@tecsup.edu.pe', 'obrero', '123', 2, 'si', 'no'),
(15, '20902088', 'img/user/user.jpg', 'ARCE ARZAPALO AMANDA DORIS', 'AMANDA', 976525981, NULL, 'obrero', '123', 2, 'si', 'no'),
(16, '75728664', 'img/user/user.jpg', 'CAMPOS CIRINEO SHARMELY JHAYSSA', 'SHARMELY', 973074316, 'sharmelycampos1@gmail.com', 'obrero', '123', 2, 'si', 'no'),
(17, '73190972', 'img/user/user.jpg', 'CORDOVA MONTES JORGE MAXIMO', 'JORGE', 949075171, 'jakcm97@gmail.com', 'obrero', '123', 2, 'si', 'no'),
(19, '44810718', 'img/user/user.jpg', 'HUAPAYA ORTEGA CARLOS BENJAMIN', 'CARLOS', 969227892, 'benjaminhuapaya45@gmail.com', 'obrero', '123', 2, 'si', 'no'),
(20, '70608119', 'img/user/user.jpg', 'LLANOS PAREDES FRANS BASILIO', 'FRANS', 902481357, 'frans.llanos@tecsup.edu.pe', 'obrero', '123', 2, 'si', 'no'),
(21, '46321176', 'img/user/user.jpg', 'PALACIOS MOLINA GIOVANI JAVIER', 'GIOVANI', 991017717, 'giovanijavierp@gmail.com', 'obrero', '123', 2, 'si', 'no'),
(22, '76346209', 'img/user/user.jpg', 'RODRIGUEZ LOPES GUSTAVO AARON', 'GUSTAVO', 901031457, 'gustavo_rl799@gmail.com', 'obrero', '123', 2, 'si', 'no'),
(23, '70979459', 'img/user/user.jpg', 'TORRES ILLATOPA RICHARD JOEL', 'RICHARD', 989618845, 'hebbyboss1999@gmail.com', 'obrero', '123', 2, 'si', 'no'),
(1, '41592972', 'img/user/user.jpg', 'CRISTIAN', 'CRICRI', 953724690, NULL, 'ADMIN', '123', 1, 'si', 'no'),
(6, '04075799', 'img/user/user.jpg', 'CAMPOS ARIAS DAVID ALEX', 'DAVID', 937179963, 'alexcampos4646@gmail.com', 'obrero', '123', 2, 'si', 'no'),
(18, '04357156', 'img/user/user.jpg', 'HERRERA GONZALEZ DENNYS EDUARDO', 'DENNYS', 918079754, 'dennys.95.herrera.g@gmail.com', 'obrero', '123', 2, 'si', 'no');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
