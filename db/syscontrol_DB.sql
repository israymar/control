-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 12-04-2012 a las 17:50:05
-- Versión del servidor: 5.0.51
-- Versión de PHP: 5.2.6

--SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `control`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cliente`
-- 

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL auto_increment,
  `nombreCliente` varchar(75) NOT NULL,
  `dniCliente` char(11) default NULL,
  `ciudadCliente` varchar(25) default NULL,
  `direccionCliente` varchar(75) default NULL,
  `rpmCliente` char(11) default NULL,
  `telMovilCliente` char(11) default NULL,
  `fax` char(11) default NULL,
  `emailCliente` varchar(45) default NULL,
  PRIMARY KEY  (`idCliente`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- 
-- Volcar la base de datos para la tabla `cliente`
-- 

INSERT INTO `cliente` VALUES (7, 'MUNICIPALIDAD DISTRITAL TAPUC', '46545454', 'TAPUC', 'Av. miguel grau 123', '999', '999', '999', 'sary@hotmail.com');
INSERT INTO `cliente` VALUES (8, 'MUNICIPALIDAD YANAHUANCA', '27001132', 'YANAHUANCA', 'av. sud américa 999', '999', '999', '999', 'carranza@hotmail.com');
INSERT INTO `cliente` VALUES (13, 'FISCALIA PROVINCIAL', '12456598989', 'YANAHUANCA', 'TUPAC AMARU N° 106 YANAHUANCA', '562365', '895658', '563256', 'ISRAYMAR');
INSERT INTO `cliente` VALUES (15, 'MUNICIPALIDAD VILCABAMBA', '10256598898', 'VILCABAMBA', '', '', '', '', '');
INSERT INTO `cliente` VALUES (16, 'MUNICIPALIDAD PILLAO', '10256598898', 'PILLAO', 'PILLAO', '8545', '8596', '8554', 'pilao@hotmail.com');
INSERT INTO `cliente` VALUES (17, 'RADIO ESTACION SOLAR', '99999999999', 'CERRO DE PASCO', 'CERRO DE PASCO', '*123456', '324567889', '324567889', 'ESTACION SOLAR@HOTMAIL.COM');
INSERT INTO `cliente` VALUES (18, 'RADIO CORPORACION S.A', '20489405955', 'YANAHUANCA', 'JR HUAMACHUCO N° 214 CERCADO PASCO', '#307344', '963652747', 'FM 100.5', 'tiveroavejamaya@hotmail.com');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `compra`
-- 

CREATE TABLE `compra` (
  `idCompra` char(12) NOT NULL,
  `tipoDocCompra` char(12) default NULL,
  `idProveedor` int(11) NOT NULL,
  `fechaCompra` int(11) unsigned NOT NULL,
  `chequeCompra` char(25) default NULL,
  `subTotal` float default NULL,
  `total` float default NULL,
  `idIgv` int(11) default NULL,
  `valorIgv` float default NULL,
  PRIMARY KEY  (`idCompra`),
  KEY `fk_compra_proveedor` (`idProveedor`),
  KEY `fk_compra_igv` (`idIgv`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `compra`
-- 

INSERT INTO `compra` VALUES ('11111', 'Factura', 12, 1334034000, '', 215.25, 254, 1, 38.74);
INSERT INTO `compra` VALUES ('000018', 'Boleta', 11, 1332046800, '989898', 254.24, 300, 1, 45.76);
INSERT INTO `compra` VALUES ('1111155', 'Boleta', 8, 1334206800, '5555', 275.42, 325, 1, 49.58);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `contactoproveedor`
-- 

CREATE TABLE `contactoproveedor` (
  `idContacto` int(11) NOT NULL auto_increment,
  `nombresContacto` varchar(45) NOT NULL,
  `apellidosContacto` varchar(75) NOT NULL,
  `dniContacto` char(8) NOT NULL,
  `direccionContacto` varchar(75) default NULL,
  `telContacto` char(12) default NULL,
  `movilContacto` char(12) default NULL,
  `rpmContacto` char(10) default NULL,
  `mailContacto` varchar(45) default NULL,
  `idProveedor` int(11) default NULL,
  PRIMARY KEY  (`idContacto`),
  KEY `fk_contactoProveedor_proveedor` (`idProveedor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `contactoproveedor`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cuentaempresa`
-- 

CREATE TABLE `cuentaempresa` (
  `numeroCuenta` char(16) NOT NULL,
  `modena` varchar(20) default NULL,
  `banco` varchar(30) default NULL,
  PRIMARY KEY  (`numeroCuenta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `cuentaempresa`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cuentaproveedor`
-- 

CREATE TABLE `cuentaproveedor` (
  `mumeroCuenta` char(45) NOT NULL,
  `banco` varchar(45) default NULL,
  `monedaCuenta` varchar(20) default NULL,
  `estadoCuenta` char(1) NOT NULL,
  `idProveedor` int(11) default NULL,
  PRIMARY KEY  (`mumeroCuenta`),
  KEY `fk_cuentaProveedor_proveedor` (`idProveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `cuentaproveedor`
-- 

INSERT INTO `cuentaproveedor` VALUES ('89565898', 'nacion', 'Nuevos Soles', '1', 1);
INSERT INTO `cuentaproveedor` VALUES ('00 - 068 - 23885', 'BANCO DE LA NACION', 'Nuevos Soles', '1', 7);
INSERT INTO `cuentaproveedor` VALUES ('365-19420937-055', 'BCP', 'Nuevos Soles', '1', 11);
INSERT INTO `cuentaproveedor` VALUES ('0011021027020053', 'CONTINENTAL 00110210270200534281', 'Nuevos Soles', '1', 12);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `detallecompra`
-- 

CREATE TABLE `detallecompra` (
  `item` int(11) NOT NULL,
  `idCompra` char(12) NOT NULL,
  `detalle` char(150) default NULL,
  `idTipoCuenta` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `peso` float NOT NULL,
  `precioUnitario` float NOT NULL,
  `subTotal` float NOT NULL,
  PRIMARY KEY  (`item`,`idCompra`),
  KEY `fk_detalleCompra_compra` (`idCompra`),
  KEY `fk_detalleCompra_tipocuenta` (`idTipoCuenta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `detallecompra`
-- 

INSERT INTO `detallecompra` VALUES (1, '11111', '9999999', 42, 0, 1, 254, 254);
INSERT INTO `detallecompra` VALUES (1, '000018', 'pago luzzzzzz', 23, 0, 1, 300, 300);
INSERT INTO `detallecompra` VALUES (1, '1111155', 'el detalleu', 29, 0, 5, 65, 325);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `detalledeposito`
-- 

CREATE TABLE `detalledeposito` (
  `item` int(11) NOT NULL,
  `idDeposito` int(11) NOT NULL,
  `cantidad` int(11) default NULL,
  `pesoBruto` float default NULL,
  `pesoJava` float default NULL,
  `pesoNeto` float default NULL,
  `idProveedor` int(11) default NULL,
  `idTipoCuenta` int(11) default NULL,
  PRIMARY KEY  (`item`,`idDeposito`),
  KEY `fk_detalleDeposito_deposito` (`idDeposito`),
  KEY `fk_detalledeposito_proveedor` (`idProveedor`),
  KEY `fk_detalledeposito_tipocuenta` (`idTipoCuenta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `detalledeposito`
-- 

INSERT INTO `detalledeposito` VALUES (1, 1, 30, 80, 10, 70, 1, 1);
INSERT INTO `detalledeposito` VALUES (1, 2, 30, 80, 10, 70, 1, 1);
INSERT INTO `detalledeposito` VALUES (1, 3, 25, 75, 8, 67, 1, 1);
INSERT INTO `detalledeposito` VALUES (2, 1, 25, 70, 10, 60, 1, 2);
INSERT INTO `detalledeposito` VALUES (2, 2, 30, 78, 10, 68, 1, 2);
INSERT INTO `detalledeposito` VALUES (2, 3, 25, 70, 8, 62, 1, 2);
INSERT INTO `detalledeposito` VALUES (3, 1, 30, 78, 10, 68, 1, 3);
INSERT INTO `detalledeposito` VALUES (3, 2, 28, 75, 10, 65, 1, 3);
INSERT INTO `detalledeposito` VALUES (3, 3, 20, 60, 7, 53, 1, 3);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `detalleventa`
-- 

CREATE TABLE `detalleventa` (
  `idVenta` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `detalle` char(150) default NULL,
  `cantidad` int(11) NOT NULL,
  `monto` float NOT NULL,
  `idTipoCuenta` int(11) NOT NULL,
  `subtotal` float NOT NULL,
  PRIMARY KEY  (`idVenta`,`item`),
  KEY `fk_detalleVenta_venta` (`idVenta`),
  KEY `fk_detalleVenta_tipoPollo` (`idTipoCuenta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `detalleventa`
-- 

INSERT INTO `detalleventa` VALUES (165, 1, '2014 pillaoooo', 1, 2000, 30, 2000);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `empleado`
-- 

CREATE TABLE `empleado` (
  `idEmpleado` int(11) NOT NULL auto_increment,
  `nombres` varchar(45) character set latin1 NOT NULL,
  `apellidos` varchar(45) character set latin1 NOT NULL,
  `dni` char(8) character set latin1 default NULL,
  `sueldo` float NOT NULL,
  `direccion` varchar(75) character set latin1 default NULL,
  `telefono` char(11) character set latin1 default NULL,
  `movil` char(12) character set latin1 default NULL,
  `rpm` varchar(11) character set latin1 default NULL,
  PRIMARY KEY  (`idEmpleado`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=5 ;

-- 
-- Volcar la base de datos para la tabla `empleado`
-- 

INSERT INTO `empleado` VALUES (1, 'WILSON RAUL GRADOS LOYOLA', 'MARKETING', '40452320', 750, 'T. Amaru', '9889344810', '9889344810', '#9889344810');
INSERT INTO `empleado` VALUES (2, 'MISAEL CERRON ACHAHUANCO', 'ADMINISTRADOR', '41036473', 600, 'TUPAC AMARU S/N', '963500022', '949846647', '#949846647');
INSERT INTO `empleado` VALUES (3, 'ELEAZAR DIOGENES TARAZONA CRISTOBAL', 'NN', '41624348', 600, 'JR. JORGE CHAVEZ', '998072761', '998072761', '2222');
INSERT INTO `empleado` VALUES (4, 'RONALD JOEL VALLE LOYOLA', 'GERENTE', '04222828', 400, 'JR. MORALES JANAMPA N° 103 YANAHUANCA', '985132828', '985132828', '*5132828');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `igv`
-- 

CREATE TABLE `igv` (
  `idIgv` int(11) NOT NULL auto_increment,
  `valor` float NOT NULL,
  `estadoIgv` char(1) NOT NULL,
  PRIMARY KEY  (`idIgv`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `igv`
-- 

INSERT INTO `igv` VALUES (1, 0.18, '1');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `lugar`
-- 

CREATE TABLE `lugar` (
  `idLugar` int(11) NOT NULL auto_increment,
  `nombreLugar` varchar(45) character set latin1 collate latin1_spanish_ci NOT NULL,
  `direccionLugar` varchar(75) character set latin1 collate latin1_spanish_ci NOT NULL,
  `descripcion` varchar(100) character set latin1 collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`idLugar`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Volcar la base de datos para la tabla `lugar`
-- 

INSERT INTO `lugar` VALUES (5, 'PANAO', 'PANAO', 'PANAO');
INSERT INTO `lugar` VALUES (6, 'YANAHUANCA', 'YANAHUANCA', 'YANAHUANCA');
INSERT INTO `lugar` VALUES (7, 'VILCABAMBA', 'VILCABAMBA', '');
INSERT INTO `lugar` VALUES (8, 'PILLAO', 'PILLAO', '');
INSERT INTO `lugar` VALUES (9, 'TAPUC', 'TAPUC', '');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `pagoempleado`
-- 

CREATE TABLE `pagoempleado` (
  `idPagoEmpleado` int(10) unsigned NOT NULL auto_increment,
  `periodoLaboral` varchar(45) collate utf8_spanish_ci NOT NULL,
  `fechaPago` int(11) NOT NULL,
  `monto` float NOT NULL,
  `observacion` varchar(100) collate utf8_spanish_ci default NULL,
  `idEmpleado` int(11) NOT NULL,
  PRIMARY KEY  (`idPagoEmpleado`),
  KEY `indexEmpleado` (`idEmpleado`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `pagoempleado`
-- 

INSERT INTO `pagoempleado` VALUES (3, '2 - 2012', 1330609199, 500, 'PAGO POR HABERES DEL MES DE FEBRERO', 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `pagoproveedor`
-- 

CREATE TABLE `pagoproveedor` (
  `idPagoProveedor` int(11) NOT NULL auto_increment,
  `fechaDeposito` float default NULL,
  `monto` float default NULL,
  `mumeroCuenta` char(16) default NULL,
  PRIMARY KEY  (`idPagoProveedor`),
  KEY `fk_pagoProveedor_cuentaProveedor` (`mumeroCuenta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `pagoproveedor`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `pagoventa`
-- 

CREATE TABLE `pagoventa` (
  `idPagoVenta` int(11) NOT NULL auto_increment,
  `idDocVenta` char(12) NOT NULL,
  `fecha` int(11) default NULL,
  `monto` float default NULL,
  `numeroCuenta` char(16) default NULL,
  `idUsuario` int(11) default NULL,
  PRIMARY KEY  (`idPagoVenta`),
  KEY `fk_pagoVenta_documentoVenta` (`idDocVenta`),
  KEY `fk_pagoVenta_cuentaEmpresa` (`numeroCuenta`),
  KEY `fk_pagoVenta_usuario` (`idUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Volcar la base de datos para la tabla `pagoventa`
-- 

INSERT INTO `pagoventa` VALUES (2, '001-00001', 1265231444, 383.6, NULL, NULL);
INSERT INTO `pagoventa` VALUES (3, '001-00002', 1265231458, 411, NULL, NULL);
INSERT INTO `pagoventa` VALUES (4, '001-00003', 1265231474, 350, NULL, NULL);
INSERT INTO `pagoventa` VALUES (5, '001-00004', 1265231487, 380, NULL, NULL);
INSERT INTO `pagoventa` VALUES (6, '001-00005', 1265317909, 486.8, NULL, NULL);
INSERT INTO `pagoventa` VALUES (7, '001-00006', 1265317928, 430, NULL, NULL);
INSERT INTO `pagoventa` VALUES (8, '001-00007', 1265317944, 450, NULL, NULL);
INSERT INTO `pagoventa` VALUES (9, '001-00008', 1265317954, 440, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `proveedor`
-- 

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL auto_increment,
  `RUC` char(11) NOT NULL,
  `razonSocial` varchar(75) NOT NULL,
  `direccion` varchar(75) default NULL,
  `ciudad` varchar(45) default NULL,
  `telefono` char(45) default NULL,
  `fax` char(13) default NULL,
  PRIMARY KEY  (`idProveedor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- 
-- Volcar la base de datos para la tabla `proveedor`
-- 

INSERT INTO `proveedor` VALUES (11, '10224673324', 'BERROSPI CUSTODIO, JUAN ', 'HUAMPARAY', 'HUANUCO', '962798116', '962798116');
INSERT INTO `proveedor` VALUES (10, '20529097591', 'GRIFO SOTO', 'JR. DANIEL A CARRION 548 - 560', 'YANAHUANCA', '963652695', '#307179');
INSERT INTO `proveedor` VALUES (12, '10224216357', 'ELIAS ROMERO LOYOLA', 'JR. AGUILAR ', 'HUANUCO', '#0137838', '#0137838');
INSERT INTO `proveedor` VALUES (7, '20493006895', 'COMUNICACIONES Y TELEMATICA SAC', 'JR. PARURO N° 1401 INT. 133', 'LIMA', '7924393', '4283656');
INSERT INTO `proveedor` VALUES (8, '10192001591', 'PCENTER PERU -LILIA Y. GALVEZ NUÑEZ', 'PROLONGACION LETICIA 929 0F. 04', 'LIMA', '01-4262759', '7158700');
INSERT INTO `proveedor` VALUES (9, '10033595536', 'M & M TELECOMUNICACIONES - MONGE LOPEZ MERCEDES', 'JR. PARURO 1369 ', 'LIMA', '4265614', '4265614');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `recibocompra`
-- 

CREATE TABLE `recibocompra` (
  `idReciboCompra` varchar(11) collate utf8_unicode_ci NOT NULL,
  `fechaReciboCompra` int(11) NOT NULL,
  `montoReciboCompra` float NOT NULL,
  `idProveedor` int(11) default NULL,
  PRIMARY KEY  (`idReciboCompra`),
  KEY `fk_reciboCompra_proveedor` (`idProveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Volcar la base de datos para la tabla `recibocompra`
-- 

INSERT INTO `recibocompra` VALUES ('45454', 1328850000, 100, 1);
INSERT INTO `recibocompra` VALUES ('1111111111', 1330146000, 200, 2);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rubro`
-- 

CREATE TABLE `rubro` (
  `idRubro` int(11) NOT NULL auto_increment,
  `nomRubro` varchar(75) NOT NULL,
  PRIMARY KEY  (`idRubro`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Volcar la base de datos para la tabla `rubro`
-- 

INSERT INTO `rubro` VALUES (1, '1265173200');
INSERT INTO `rubro` VALUES (2, '1265259600');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `tipocuenta`
-- 

CREATE TABLE `tipocuenta` (
  `idRubro` int(11) NOT NULL,
  `idTipoCuenta` int(11) NOT NULL auto_increment,
  `nombreTipoCuenta` varchar(75) NOT NULL,
  PRIMARY KEY  (`idTipoCuenta`),
  KEY `fk_tipocuenta_rubro` (`idRubro`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

-- 
-- Volcar la base de datos para la tabla `tipocuenta`
-- 

INSERT INTO `tipocuenta` VALUES (0, 29, 'PAGO ESPACIO CORNEJO YANAHUANCA');
INSERT INTO `tipocuenta` VALUES (0, 28, 'PAGOS DE PERSONAL');
INSERT INTO `tipocuenta` VALUES (0, 25, 'COMPRA DE EQUIPOS');
INSERT INTO `tipocuenta` VALUES (0, 24, 'PAGOS DE ENERGIA ELECTRICA CABINA - YANAHUANCA');
INSERT INTO `tipocuenta` VALUES (0, 23, 'PAGOS DE ENERGIA ELECTRICA TAPUC');
INSERT INTO `tipocuenta` VALUES (0, 30, 'SERVICIO DE INTERNET');
INSERT INTO `tipocuenta` VALUES (0, 31, 'CABINAS DE INTERNET');
INSERT INTO `tipocuenta` VALUES (0, 41, 'GASTOS DE REPRESENTACION');
INSERT INTO `tipocuenta` VALUES (0, 42, 'VIATICOS');
INSERT INTO `tipocuenta` VALUES (0, 44, 'INSTALACION DE SERVICIO DE INTERNET');
INSERT INTO `tipocuenta` VALUES (0, 45, 'PAGO ALQUILER ESPACIO SAN JUAN');
INSERT INTO `tipocuenta` VALUES (0, 46, 'PAGO ESPACIO ULIACHIN');
INSERT INTO `tipocuenta` VALUES (0, 47, 'PAGO CUIDADOR HUANCAYAN');
INSERT INTO `tipocuenta` VALUES (0, 48, 'PAGO ESPACIO AGUILAR - HUANUCO');
INSERT INTO `tipocuenta` VALUES (0, 49, 'PAGO ESPACIO PUELLES - HUANUCO');
INSERT INTO `tipocuenta` VALUES (0, 50, 'PAGO CUIDADOR HUAMPARAY HUANUCO ');
INSERT INTO `tipocuenta` VALUES (0, 51, 'PAGO ESPACIO PUNTA - HUANUCO');
INSERT INTO `tipocuenta` VALUES (0, 52, 'PAGO TELF - 421212');
INSERT INTO `tipocuenta` VALUES (0, 53, 'PAGO TELF - 421616');
INSERT INTO `tipocuenta` VALUES (0, 54, 'COMBUSTIBLE');
INSERT INTO `tipocuenta` VALUES (0, 55, 'PAGO TELF - 510151');
INSERT INTO `tipocuenta` VALUES (0, 56, 'PAGO TELF - 514924');
INSERT INTO `tipocuenta` VALUES (0, 57, 'PAGO TELF - 510159');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuario`
-- 

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL auto_increment,
  `userName` varchar(10) NOT NULL,
  `password` varchar(55) default NULL,
  PRIMARY KEY  (`idUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `usuario`
-- 

INSERT INTO `usuario` VALUES (1, 'israymar', '57de58eab425551c05b4db9628b82086');
INSERT INTO `usuario` VALUES (2, 'docto', 'marcas');
INSERT INTO `usuario` VALUES (4, 'Gerencia', '5ca08bc4ade3d9bc5874bcb39b7a5c25');
INSERT INTO `usuario` VALUES (5, 'Usuario', 'b11d30e1e266da9bd30c95994e60c733');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `venta`
-- 

CREATE TABLE `venta` (
  `idVenta` int(11) NOT NULL auto_increment,
  `idDocVenta` char(12) default NULL,
  `tipoDocVenta` char(10) default NULL,
  `fechaVenta` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idLugar` int(11) NOT NULL,
  `notas` text,
  `idIgv` int(11) default NULL,
  `valorIgv` float default NULL,
  `subtotal` float default NULL,
  `total` float default NULL,
  `idUsuario` int(11) default NULL,
  PRIMARY KEY  (`idVenta`),
  KEY `fk_venta_cliente` (`idCliente`),
  KEY `fk_venta_usuario` (`idUsuario`),
  KEY `fk_venta_lugar` (`idLugar`),
  KEY `fk_venta_igv` (`idIgv`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=166 ;

-- 
-- Volcar la base de datos para la tabla `venta`
-- 

INSERT INTO `venta` VALUES (165, '000001', 'Factura', 1332219600, 16, 8, 'rerererrerer', 1, 305.09, 1694.92, 2000, NULL);