-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-11-2014 a las 17:26:08
-- Versión del servidor: 5.5.37-cll
-- Versión de PHP: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `contrato_en_chile`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boleta`
--

CREATE TABLE IF NOT EXISTS `boleta` (
  `id_bol` int(11) NOT NULL AUTO_INCREMENT,
  `id_est` int(11) NOT NULL,
  `id_ent` int(11) NOT NULL,
  `fecha_bol` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `monto` int(11) NOT NULL,
  `id_plan` int(11) NOT NULL,
  PRIMARY KEY (`id_bol`),
  KEY `id_est` (`id_est`),
  KEY `id_ent` (`id_ent`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `boleta`
--

INSERT INTO `boleta` (`id_bol`, `id_est`, `id_ent`, `fecha_bol`, `monto`, `id_plan`) VALUES
(2, 12, 5, '0000-00-00 00:00:00', 2, 1),
(3, 12, 4, '0000-00-00 00:00:00', 3, 5),
(4, 12, 4, '0000-00-00 00:00:00', 3, 5),
(6, 7, 5, '2014-11-12 23:48:28', 35700, 4),
(7, 7, 5, '2014-11-12 23:49:37', 35700, 4),
(8, 7, 5, '2014-11-12 23:50:30', 35700, 4),
(9, 7, 5, '2014-11-15 03:33:51', 23800, 3),
(10, 7, 5, '2014-11-15 03:34:37', 15470, 2),
(11, 7, 5, '2014-11-15 03:35:44', 35700, 4),
(12, 12, 5, '2014-11-15 03:35:55', 35700, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacionclie`
--

CREATE TABLE IF NOT EXISTS `calificacionclie` (
  `id_calc` int(11) NOT NULL AUTO_INCREMENT,
  `id_con` int(11) DEFAULT NULL,
  `id_tc` int(11) DEFAULT NULL,
  `id_ec` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_calc`),
  KEY `id_con` (`id_con`),
  KEY `id_ec` (`id_ec`),
  KEY `id_tc` (`id_tc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacionserv`
--

CREATE TABLE IF NOT EXISTS `calificacionserv` (
  `id_cals` int(11) NOT NULL AUTO_INCREMENT,
  `id_con` int(11) DEFAULT NULL,
  `id_serv` int(11) DEFAULT NULL,
  `id_tc` int(11) DEFAULT NULL,
  `id_ec` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cals`),
  KEY `calificacionserv_ibfk_1` (`id_con`,`id_serv`),
  KEY `id_ec` (`id_ec`),
  KEY `id_tc` (`id_tc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Volcado de datos para la tabla `calificacionserv`
--

INSERT INTO `calificacionserv` (`id_cals`, `id_con`, `id_serv`, `id_tc`, `id_ec`) VALUES
(45, 14, 1, 2, 3),
(46, 14, 1, 3, 2),
(47, 14, 1, 4, 1),
(48, 14, 1, 5, 1),
(49, 14, 1, 6, 3),
(50, 14, 1, 7, 1),
(51, 14, 1, 8, 1),
(52, 14, 1, 9, 4),
(53, 14, 1, 2, 5),
(54, 14, 1, 3, 1),
(55, 14, 1, 4, 4),
(56, 14, 1, 5, 1),
(57, 14, 1, 6, 1),
(58, 14, 1, 7, 1),
(59, 14, 1, 8, 1),
(60, 14, 1, 9, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`nom_cat`) VALUES
('Belleza'),
('Clases y Capacitaciones'),
('Fiestas y Eventos'),
('Para el Vehículo'),
('Para el Hogar'),
('Otros servicios'),
('Profesionales'),
('Recreación y Ocio'),
('Servicio Técnico'),
('Servicios de Traslado'),
('Viajes y Turismo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobertura`
--

CREATE TABLE IF NOT EXISTS `cobertura` (
  `id_serv` int(11) NOT NULL,
  `id_com` int(11) NOT NULL,
  PRIMARY KEY (`id_com`,`id_serv`),
  KEY `id_serv` (`id_serv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

CREATE TABLE IF NOT EXISTS `comuna` (
  `id_com` int(11) NOT NULL AUTO_INCREMENT,
  `nom_com` varchar(255) DEFAULT NULL,
  `id_prov` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_com`),
  KEY `id_prov` (`id_prov`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`id_com`, `nom_com`, `id_prov`) VALUES
(1, 'Conchali', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE IF NOT EXISTS `contacto` (
  `id_con` int(11) NOT NULL AUTO_INCREMENT,
  `rut` varchar(255) DEFAULT NULL,
  `id_est` int(11) DEFAULT NULL,
  `fecha_con` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_con`),
  KEY `id_est` (`id_est`),
  KEY `rut` (`rut`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id_con`, `rut`, `id_est`, `fecha_con`) VALUES
(14, '18.293.138-1', 11, '2014-10-26 21:29:38'),
(15, '18.293.138-1', 7, '2014-11-16 15:31:14'),
(16, '18.293.138-1', 7, '2014-11-16 15:36:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `css`
--

CREATE TABLE IF NOT EXISTS `css` (
  `id_css` int(11) NOT NULL AUTO_INCREMENT,
  `id_tcss` int(11) NOT NULL,
  `url_css` varchar(255) NOT NULL,
  `codigo` text NOT NULL,
  PRIMARY KEY (`id_css`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE IF NOT EXISTS `documento` (
  `id_doc` int(11) NOT NULL AUTO_INCREMENT,
  `id_ent` int(11) DEFAULT NULL,
  `id_td` int(11) DEFAULT NULL,
  `nom_doc` varchar(255) DEFAULT NULL,
  `url_doc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_doc`),
  KEY `id_td` (`id_td`),
  KEY `id_ent` (`id_ent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`id_doc`, `id_ent`, `id_td`, `nom_doc`, `url_doc`) VALUES
(1, 4, 2, 'hola mundo', 'url otro'),
(2, 5, 2, 'hola doc modificado', 'http://www.contratoenchile.cl/administracion/documentos/agregar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidad`
--

CREATE TABLE IF NOT EXISTS `entidad` (
  `id_ent` int(11) NOT NULL AUTO_INCREMENT,
  `id_est` int(11) DEFAULT NULL,
  `subscripcion` date DEFAULT NULL,
  `rut_sii` varchar(255) DEFAULT NULL,
  `nom_ent` varchar(255) DEFAULT NULL,
  `sitio` varchar(255) DEFAULT NULL,
  `seo_ent` varchar(255) DEFAULT NULL,
  `desc_ent` varchar(255) DEFAULT NULL,
  `email_ent` varchar(255) DEFAULT NULL,
  `tel_ent` varchar(255) DEFAULT NULL,
  `auth_key` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `cssmenu` int(11) NOT NULL,
  `csscontacto` int(11) NOT NULL,
  `footer` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ent`),
  KEY `id_est` (`id_est`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `entidad`
--

INSERT INTO `entidad` (`id_ent`, `id_est`, `subscripcion`, `rut_sii`, `nom_ent`, `sitio`, `seo_ent`, `desc_ent`, `email_ent`, `tel_ent`, `auth_key`, `banner`, `cssmenu`, `csscontacto`, `footer`) VALUES
(4, 5, '0000-00-00', '18.293.138-1', 'Contrato en Chile2', 'contratoenchile', 'seo', 'descripcion contrato en chile', 'test2@contratoenchile.cl', '51170428', '3eab2dfc052c5830a73125c7967616c7', '', 0, 0, ''),
(5, 5, '2015-10-08', '18.293.138-1', 'hola empresa', 'hola+empresa', '', 'descripcion empresa', 'contacto@empresa.cl', '51170428', '154756c68ccd33b841b91da2dd89fa68', '', 0, 0, ''),
(6, 2, '0000-00-00', '18.293.138-2', 'modificado2', 'modificado', 'asdasd', 'descripcion empresa', 'test2@contratoenchile.cl', '51170428', '63ea1bd80bd0c43cc15b36f669573cc5', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escalacal`
--

CREATE TABLE IF NOT EXISTS `escalacal` (
  `id_ec` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ec` varchar(255) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ec`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `escalacal`
--

INSERT INTO `escalacal` (`id_ec`, `nom_ec`, `valor`) VALUES
(1, 'No calificable', 0),
(2, 'Deficiente', 1),
(3, 'Aceptable', 2),
(4, 'Bueno', 3),
(5, 'Muy bueno', 4),
(6, 'Excelente', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `id_est` int(11) NOT NULL AUTO_INCREMENT,
  `nom_est` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_est`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_est`, `nom_est`) VALUES
(1, 'Validado'),
(2, 'Blockeado'),
(4, 'Baneado'),
(5, 'Habilitado'),
(6, 'Deshabilitado'),
(7, 'Vigente'),
(8, 'Cancelado'),
(9, 'Terminado'),
(10, 'Borrado'),
(11, 'Calificado'),
(12, 'Pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id_menu` int(11) NOT NULL,
  `id_pag` int(11) NOT NULL,
  PRIMARY KEY (`id_menu`,`id_pag`),
  KEY `id_pag` (`id_pag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`id_menu`, `id_pag`) VALUES
(5, 22),
(5, 24),
(5, 31),
(5, 32),
(5, 33),
(5, 34),
(5, 35),
(5, 41),
(5, 43),
(5, 44),
(5, 45),
(5, 46),
(5, 47),
(5, 48),
(5, 49),
(5, 50),
(5, 51),
(5, 52),
(5, 53),
(5, 54),
(5, 55),
(6, 57),
(7, 57),
(6, 58),
(7, 58),
(6, 59),
(7, 59),
(4, 80),
(4, 82),
(4, 85),
(5, 93),
(5, 99),
(5, 100),
(5, 113),
(5, 116),
(5, 118),
(4, 123),
(4, 124),
(4, 125),
(4, 126),
(4, 127),
(5, 128),
(5, 129),
(5, 130),
(5, 138);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id_med` int(11) NOT NULL AUTO_INCREMENT,
  `id_tm` int(11) DEFAULT NULL,
  `id_serv` int(11) DEFAULT NULL,
  `nom_med` varchar(255) DEFAULT NULL,
  `url_med` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_med`),
  KEY `id_serv` (`id_serv`),
  KEY `id_tm` (`id_tm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `media`
--

INSERT INTO `media` (`id_med`, `id_tm`, `id_serv`, `nom_med`, `url_med`) VALUES
(3, 1, 1, 'hola media modificado', 'url media'),
(4, 3, 1, 'imagen', 'http://vignette4.wikia.nocookie.net/fantasy-life/images/c/c2/Castele.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE IF NOT EXISTS `mensajes` (
  `id_men` int(11) NOT NULL AUTO_INCREMENT,
  `id_con` int(11) DEFAULT NULL,
  `fecha_men` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emisor` varchar(255) DEFAULT NULL,
  `mensaje` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_men`),
  KEY `id_con` (`id_con`),
  KEY `emisor` (`emisor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_men`, `id_con`, `fecha_men`, `emisor`, `mensaje`) VALUES
(1, 14, '2014-10-29 20:04:42', '18.293.138-3', 'hola test');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nom_menu` varchar(255) DEFAULT NULL,
  `desc_menu` varchar(255) DEFAULT 'custom menu',
  `id_tu` int(11) NOT NULL,
  PRIMARY KEY (`id_menu`),
  KEY `id_tu` (`id_tu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id_menu`, `nom_menu`, `desc_menu`, `id_tu`) VALUES
(3, 'menuDefault', 'http://www.contratoenchile.cl/administracion/', 1),
(4, 'Administracion', 'http://www.contratoenchile.cl/administracion/', 1),
(5, 'Administracion', 'http://www.contratoenchile.cl/administracion/', 3),
(6, 'Perfil', 'http://www.contratoenchile.cl/administracion/', 1),
(7, 'Perfil', 'http://www.contratoenchile.cl/administracion/', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagEnt`
--

CREATE TABLE IF NOT EXISTS `pagEnt` (
  `id_pe` int(11) NOT NULL AUTO_INCREMENT,
  `id_ent` int(11) NOT NULL,
  `nom_pe` varchar(255) NOT NULL,
  `posicion` int(11) NOT NULL,
  `contenido` text NOT NULL,
  PRIMARY KEY (`id_pe`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagina`
--

CREATE TABLE IF NOT EXISTS `pagina` (
  `id_pag` int(11) NOT NULL AUTO_INCREMENT,
  `id_tp` int(11) DEFAULT NULL,
  `nom_pag` varchar(255) DEFAULT NULL,
  `url_pag` varchar(255) DEFAULT NULL,
  `url_real` varchar(255) NOT NULL,
  `desc_pag` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pag`),
  KEY `id_tp` (`id_tp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=143 ;

--
-- Volcado de datos para la tabla `pagina`
--

INSERT INTO `pagina` (`id_pag`, `id_tp`, `nom_pag`, `url_pag`, `url_real`, `desc_pag`) VALUES
(2, 1, 'identificarse', 'identificarse', 'includes/paginas/identificar.php', ''),
(3, 1, 'registrar', 'registrar', 'includes/paginas/registrar.php', ''),
(4, 1, 'registrarse-paso2', 'registrarse-paso2/Cliente', 'includes/paginas/registrarpaso2Cliente.php', ''),
(5, 1, 'registrarse-paso2', 'registrarse-paso2/Empresa', 'includes/paginas/registrarpaso2Entidad.php', ''),
(8, 1, 'Agregar Permiso', 'administracion/seguridad/permisos/agregar', 'includes/paginas/panelAdministracion/Seguridad/agregarPermisos.php', ''),
(9, 1, 'inicio', '', 'includes/paginas/inicio.php', ''),
(10, 1, 'moderadores', 'administracion/comunidad/moderadores', 'includes/paginas/panelAdministracion/Comunidad/listarModeradores.php', ''),
(11, 1, 'agregar moderador', 'administracion/comunidad/moderadores/agregar', 'includes/paginas/panelAdministracion/Comunidad/agregarModeradores.php', ''),
(12, 1, 'error 404', 'error/404', 'includes/paginas/error/404.php', ''),
(13, 1, 'Terminos y condiciones', 'terminos_y_condiciones', 'includes/paginas/terminos_y_condiciones.php', ''),
(14, 1, 'Politicas de privacidad', 'politicas_de_privacidad', 'includes/paginas/politica_privacidad.php', ''),
(15, 1, 'administracion', 'administracion', 'includes/paginas/panelAdministracion/inicio.php', ''),
(16, 1, 'administracion', 'administracion', 'includes/paginas/panelEmpresa/inicio.php', ''),
(17, 1, 'administracion', 'administracion', 'includes/paginas/panelUsuario/inicio.php', ''),
(20, 1, 'recuperar-contrasena', 'recuperar-contrasena', 'includes/paginas/recuperarContrasena.php', ''),
(21, 1, 'recuperar-contrasena2', 'recuperar-contrasena2', 'includes/paginas/recuperarContrasena2.php', ''),
(22, 4, 'Tipo de usuario', 'administracion/seguridad/tipousuario', 'includes/paginas/panelAdministracion/Seguridad/listarTipousuario.php', ''),
(23, 1, 'Agregar Tipo de usuario', 'administracion/seguridad/tipousuario/agregar', 'includes/paginas/panelAdministracion/Seguridad/agregarTipousuario.php', ''),
(24, 4, 'Permisos', 'administracion/seguridad/permiso', 'includes/paginas/panelAdministracion/Seguridad/listarPermisos.php', ''),
(25, 1, 'Agregar permiso', 'administracion/seguridad/permiso/agregar', 'includes/paginas/panelAdministracion/Seguridad/agregarPermisos.php', ''),
(26, 3, 'Agregar Documento', 'administracion/contenido/documento/agregar', 'includes/paginas/panelAdministracion/Contenido/agregarDocumento.php', 'Pagina de moderador'),
(27, 3, 'Agregar Pagina', 'administracion/contenido/pagina/agregar', 'includes/paginas/panelAdministracion/Contenido/agregarPagina.php', ''),
(28, 3, 'Agregar Tipo de documento', 'administracion/contenido/tipodocumento/agregar', 'includes/paginas/panelAdministracion/Contenido/agregarTipodocumento.php', ''),
(29, 3, 'Agregar Tipo de multimedia', 'administracion/contenido/tipomultimedia/agregar', 'includes/paginas/panelAdministracion/Contenido/agregarTipomedia.php', ''),
(30, 3, 'Agregar Tipo de pagina', 'administracion/contenido/tipopagina/agregar', 'includes/paginas/panelAdministracion/Contenido/agregarTipopagina.php', ''),
(31, 5, 'Documentos', 'administracion/contenido/documento', 'includes/paginas/panelAdministracion/Contenido/listarDocumentos.php', 'Pagina de moderador'),
(32, 5, 'Paginas', 'administracion/contenido/pagina', 'includes/paginas/panelAdministracion/Contenido/listarPaginas.php', ''),
(33, 5, 'Tipo de documentos', 'administracion/contenido/tipodocumento', 'includes/paginas/panelAdministracion/Contenido/listarTipodocumento.php', ''),
(34, 5, 'Tipo de multimedia', 'administracion/contenido/tipomultimedia', 'includes/paginas/panelAdministracion/Contenido/listarTipomedia.php', ''),
(35, 5, 'Tipo de pagina', 'administracion/contenido/tipopagina', 'includes/paginas/panelAdministracion/Contenido/listarTipopagina.php', ''),
(36, 3, 'Modificar Tipo de usuario', 'administracion/seguridad/tipousuario/modificar', 'includes/paginas/panelAdministracion/Seguridad/modificarTipousuario.php', ''),
(37, 1, 'registrarse-paso2', 'registrarse-paso2', 'includes/paginas/registrarpaso2.php', ''),
(38, 5, 'Modificar Pagina', 'administracion/contenido/pagina/modificar', 'includes/paginas/panelAdministracion/Contenido/modificarPaginas.php', ''),
(39, 2, 'registrarse-paso2', 'registrarse-paso2/Empresa', 'includes/paginas/registrarpaso2Entidad.php', ''),
(40, 5, 'Agregar Tipo de documento', 'administracion/contenido/tipodocumento/agregar', 'includes/paginas/panelAdministracion/Contenido/agregarTipodocumento.php', ''),
(41, 9, 'Usuarios', 'administracion/seguridad/usuario', 'includes/paginas/panelAdministracion/Comunidad/listarUsuarios.php', ''),
(43, 7, 'Paises', 'administracion/posicionamiento/paises', 'includes/paginas/panelAdministracion/Posicionamiento/listarPaises.php', ''),
(44, 7, 'Regiones', 'administracion/posicionamiento/regiones', 'includes/paginas/panelAdministracion/Posicionamiento/listarRegion.php', ''),
(45, 7, 'Provincias', 'administracion/posicionamiento/provincias', 'includes/paginas/panelAdministracion/Posicionamiento/listarProvincia.php', ''),
(46, 7, 'Comunas', 'administracion/posicionamiento/comunas', 'includes/paginas/panelAdministracion/Posicionamiento/listarComuna.php', ''),
(47, 9, 'Categorias', 'administracion/Repertorio/categorias', 'includes/paginas/panelAdministracion/Repertorio/listarCategorias.php', ''),
(48, 9, 'Subcategorias', 'administracion/Repertorio/subcategorias', 'includes/paginas/panelAdministracion/Repertorio/listarSubcategorias.php', ''),
(49, 9, 'Servicios', 'administracion/Repertorio/servicios', 'includes/paginas/panelAdministracion/Repertorio/listarServicios.php', ''),
(50, 9, 'Tipo servicio', 'administracion/Repertorio/tiposervicios', 'includes/paginas/panelAdministracion/Repertorio/listarTiposervicio.php', ''),
(51, 5, 'Multimedia', 'administracion/contenido/multimedia', 'includes/paginas/panelAdministracion/Contenido/listarMedia.php', 'Pagina de moderador'),
(52, 6, 'Contratos Cancelados', 'administracion/contratos/cancelados', 'includes/paginas/panelAdministracion/Contratos/listarContratoscancelados.php', 'Pagina de moderador'),
(53, 6, 'Contratos', 'administracion/contratos/historial', 'includes/paginas/panelAdministracion/Contratos/listarContratoshistorial.php', 'Pagina de moderador'),
(54, 6, 'Contratos Vigentes', 'administracion/contratos/vigentes', 'includes/paginas/panelAdministracion/Contratos/listarContratosvigentes.php', 'Pagina de moderador'),
(55, 6, 'Contratos Finalizados', 'administracion/contratos/finalizados', 'includes/paginas/panelAdministracion/Contratos/listarContratosfinalizados.php', 'Pagina de moderador'),
(56, 1, 'Registrar Empresa', 'administracion/registrar/empresa', 'includes/paginas/panelUsuario/crearEmpresa.php', 'Pagina de moderador'),
(57, 10, 'Mi Perfil', 'administracion/mi_perfil', 'includes/paginas/panelUsuario/modificarPerfil.php', 'Pagina de usuario y moderador'),
(58, 10, 'Cambiar Contraseña', 'administracion/cambiar_contrasena', 'includes/paginas/panelUsuario/modificarContrasena.php', 'Pagina de usuario y moderador'),
(59, 10, 'Mis Contratos', 'administracion/mis_contratos', 'includes/paginas/panelUsuario/listarContratosvigentes.php', 'Pagina de usuario y moderador'),
(60, 7, 'Agregar Paises', 'administracion/posicionamiento/paises/agregar', 'includes/paginas/panelAdministracion/Posicionamiento/agregarPaises.php', 'Agregar un pais'),
(61, 7, 'Agregar Regiones', 'administracion/posicionamiento/regiones/agregar', 'includes/paginas/panelAdministracion/Posicionamiento/agregarRegiones.php', 'Agregar Regiones'),
(62, 7, 'Agregar Provincias', 'administracion/posicionamiento/provincias/agregar', 'includes/paginas/panelAdministracion/Posicionamiento/agregarProvincia.php', 'Agregar Provincias'),
(63, 7, 'Agregar Comunas', 'administracion/posicionamiento/comunas/agregar', 'includes/paginas/panelAdministracion/Posicionamiento/agregarComuna.php', 'Agregar Comunas'),
(64, 7, 'Modificar paises', 'administracion/posicionamiento/paises/modificar', 'includes/paginas/panelAdministracion/Posicionamiento/modificarPais.php', 'Modificar paises'),
(65, 7, 'Modificar Region', 'administracion/posicionamiento/regiones/modificar', 'includes/paginas/panelAdministracion/Posicionamiento/modificarRegion.php', ''),
(66, 7, 'Modificar Provincia', 'administracion/posicionamiento/provincias/modificar', 'includes/paginas/panelAdministracion/Posicionamiento/modificarProvincia.php', ''),
(67, 7, 'Modificar Comuna', 'administracion/posicionamiento/comunas/modificar', 'includes/paginas/panelAdministracion/Posicionamiento/modificarComuna.php', ''),
(68, 5, 'Modificar Documento', 'administracion/contenido/documento/modificar', 'includes/paginas/panelAdministracion/Contenido/modificarDocumentos.php', 'Pagina de moderador'),
(69, 5, 'Modificar Pagina', 'administracion/contenido/pagina/modificar', 'includes/paginas/panelAdministracion/Contenido/modificarPaginas.php', ''),
(70, 5, 'Modificar Tipo Documento', 'administracion/contenido/tipodocumento/modificar', 'includes/paginas/panelAdministracion/Contenido/modificarTipodocumento.php', ''),
(71, 5, 'Modificar Tipo Multimedia', 'administracion/contenido/tipomultimedia/modificar', 'includes/paginas/panelAdministracion/Contenido/modificarTipomedia.php', ''),
(72, 5, 'Modificar Tipo Pagina', 'administracion/contenido/tipopagina/modificar', 'includes/paginas/panelAdministracion/Contenido/modificarTipopagina.php', ''),
(73, 9, 'Agregar Categorias', 'administracion/Repertorio/categorias/agregar', 'includes/paginas/panelAdministracion/Repertorio/agregarCategorias.php', 'Pagina de administracion'),
(74, 9, 'Agregar Servicio', 'administracion/Repertorio/servicios/agregar', 'includes/paginas/panelAdministracion/Repertorio/agregarServicios.php', 'Pagina de moderador'),
(75, 9, 'Agregar Subcategoria', 'administracion/Repertorio/subcategorias/agregar', 'includes/paginas/panelAdministracion/Repertorio/agregarSubcategorias.php', 'Pagina de administracion'),
(76, 9, 'Agregar Tipo Servicio', 'administracion/Repertorio/tiposervicios/agregar', 'includes/paginas/panelAdministracion/Repertorio/agregarTiposervicio.php', 'Pagina de administracion'),
(77, 9, 'Agregar Usuario', 'administracion/seguridad/usuario/agregar', 'includes/paginas/panelAdministracion/Repertorio/agregarUsuario.php', 'Pagina de administracion'),
(79, 5, 'Modificar Pagina', 'administracion/contenido/pagina/modificar', 'includes/paginas/panelAdministracion/Contenido/modificarPaginas.php', 'modificar pagina'),
(80, 5, 'Listar Documentos', 'administracion/documentos', 'includes/paginas/panelUsuario/Contenidos/listarDocumentos.php', 'pagina de usuario'),
(81, 5, 'Listar Multimedia', 'administracion/servicios/listarServicio/multimedia', 'includes/paginas/panelUsuario/Contenidos/listarMultimedia.php', 'pagina de usuario'),
(82, 9, 'Listar Servicios', 'administracion/servicios', 'includes/paginas/panelUsuario/Repertorio/listarServicios.php', 'pagina de usuario'),
(83, 9, 'Agregar Servicio', 'administracion/servicios/agregar', 'includes/paginas/panelUsuario/Repertorio/agregarServicios.php', 'pagina de usuario'),
(84, 9, 'Modificar Servicio', 'administracion/servicios/modificar', 'includes/paginas/panelUsuario/Repertorio/agregarServicios.php', 'pagina de usuario'),
(85, 9, 'Listar Multimedia', 'administracion/multimedia', 'includes/paginas/panelUsuario/Contenidos/listarMultimedia.php', 'pagina de usuario directo del menu'),
(86, 9, 'agregar Multimedia', 'administracion/multimedia/agregar', 'includes/paginas/panelUsuario/Contenidos/agregarMultimedia.php', 'pagina de usuario'),
(87, 9, 'Modificar Multimedia', 'administracion/multimedia/modificar', 'includes/paginas/panelUsuario/Contenidos/modificarMultimedia.php', 'pagina de usuario'),
(88, 5, 'Agregar Documento', 'administracion/documentos/agregar', 'includes/paginas/panelUsuario/Contenidos/agregarDocumentos.php', 'pagina de usuario'),
(89, 5, 'Modificar Documento', 'administracion/documentos/modificar', 'includes/paginas/panelUsuario/Contenidos/modificarDocumentos.php', 'pagina de usuario'),
(90, 9, 'Agregar Usuario', 'administracion/seguridad/usuario/agregar', 'includes/paginas/panelAdministracion/Comunidad/agregarUsuario.php', 'Pagina de moderador'),
(91, 4, 'Registro paso 3', 'registrar-paso3', 'includes/paginas/registrarpaso3.php', 'Pagina publica'),
(92, 9, 'Modificar Usuario', 'administracion/seguridad/usuario/modificar', 'includes/paginas/panelAdministracion/Comunidad/modificarUsuario.php', 'Pagina de moderadores'),
(93, 9, 'Empresas', 'administracion/empresas', 'includes/paginas/panelAdministracion/Repertorio/listarEmpresas.php', 'Pagina de moderador'),
(94, 9, 'modificar pagina', 'administracion/empresas/modificar', 'includes/paginas/panelAdministracion/Repertorio/modificarEmpresas.php', 'Pagina de moderador'),
(95, 1, 'Pagina de canasta', 'canasta', 'includes/paginas/panelUsuario/canasta.php', 'pagina de usuario'),
(96, 1, 'Pagina de comparacion', 'comparacion', 'includes/paginas/panelUsuario/comparar.php', 'pagina de usuario'),
(97, 6, 'Modificar Contratos', 'administracion/contratos/modificar', 'includes/paginas/panelAdministracion/Contratos/modificarContratos.php', 'pagina de moderador'),
(98, 6, 'Leer Mensajes', 'administracion/contratos/mensajes', 'includes/paginas/panelAdministracion/Contratos/listarMensajes.php', 'pagina de moderador'),
(99, 8, 'Metricas', 'administracion/calificacion/metricas', 'includes/paginas/panelAdministracion/Calificaion/listarMetricas.php', 'pagina de moderador'),
(100, 8, 'Preguntas', 'administracion/calificacion/preguntas', 'includes/paginas/panelAdministracion/Calificaion/listarPreguntas.php', 'pagina de moderador'),
(101, 8, 'Agregar metricas', 'administracion/calificacion/metricas/agregar', 'includes/paginas/panelAdministracion/Calificaion/agregarMetricas.php', 'pagina de moderador'),
(102, 8, 'agregar preguntas', 'administracion/calificacion/preguntas/agregar', 'includes/paginas/panelAdministracion/Calificaion/agregarPreguntas.php', 'pagina de moderador'),
(103, 8, 'Modificar Metricas', 'administracion/calificacion/metricas/modificar', 'includes/paginas/panelAdministracion/Calificaion/modificarMetricas.php', 'pagina de moderador'),
(104, 8, 'Modificar Preguntas', 'administracion/calificacion/preguntas/modificar', 'includes/paginas/panelAdministracion/Calificaion/modificarPreguntas.php', 'pagina de moderador'),
(105, 5, 'Agregar Multimedia', 'administracion/multimedia/agregar', 'includes/paginas/panelAdministracion/Contenido/agregarMedia.php', 'pagina moderador'),
(106, 5, 'modificar multimedia', 'administracion/multimedia/modificar', 'includes/paginas/panelAdministracion/Contenido/modificarMedia.php', 'pagina de moderador'),
(108, 9, 'Modificar Categorias', 'administracion/Repertorio/categorias/modificar', 'includes/paginas/panelAdministracion/Repertorio/modificarCategorias.php', 'pagina de moderador'),
(109, 9, 'modificar Subcategoria', 'administracion/Repertorio/subcategorias/modificar', 'includes/paginas/panelAdministracion/Repertorio/modificarSubcategorias.php', 'pagina de moderador'),
(110, 9, 'modificar servicios', 'administracion/Repertorio/servicios/modificar', 'includes/paginas/panelAdministracion/Repertorio/modificarServicios.php', 'pagina de moderador'),
(111, 9, 'modificar tipo servicio', 'administracion/Repertorio/tiposervicios/modificar', 'includes/paginas/panelAdministracion/Repertorio/modificarTiposervicio.php', 'pagina de moderador'),
(112, 9, 'agregar empresa', 'administracion/empresas/agregar', 'includes/paginas/panelAdministracion/Repertorio/agregarEmpresas.php', 'pagina de moderador'),
(113, 4, 'Autoridades', 'administracion/seguridad/autoridades', 'includes/paginas/panelAdministracion/Seguridad/listarAutoridad.php', 'pagina de moderador'),
(114, 4, 'Agregar Autoridad', 'administracion/seguridad/autoridades/agregar', 'includes/paginas/panelAdministracion/Seguridad/agregarAutoridad.php', 'pagina de moderador'),
(115, 9, 'agregar Menu', 'administracion/Repertorio/menu/agregar', 'includes/paginas/panelAdministracion/Repertorio/agregarMenus.php', 'pagina de moderador'),
(116, 9, 'Menus', 'administracion/Repertorio/menu', 'includes/paginas/panelAdministracion/Repertorio/listarMenus.php', 'pagina de moderador'),
(117, 9, 'modificar menu', 'administracion/Repertorio/menu/modificar', 'includes/paginas/panelAdministracion/Repertorio/modificarMenus.php', 'pagina de moderador'),
(118, 9, 'Items', 'administracion/Repertorio/item', 'includes/paginas/panelAdministracion/Repertorio/listarItems.php', 'pagina de moderador'),
(119, 9, 'agregar Item', 'administracion/Repertorio/item/agregar', 'includes/paginas/panelAdministracion/Repertorio/agregarItems.php', 'pagina de moderador'),
(120, 8, 'Mensajes', 'administracion/contratos/mensajes', 'includes/paginas/panelUsuario/contratos/listarMensajes.php', 'pagina de usuario'),
(121, 8, 'Calificar Contrato', 'administracion/contratos/calificar', 'includes/paginas/panelUsuario/contratos/calificarContrato.php', 'pagina de usuario'),
(122, 8, 'detalle contrato', 'administracion/contratos/detalle', 'includes/paginas/panelUsuario/contratos/detalleContrato.php', 'pagina de usuario'),
(123, 6, 'Contratos', 'administracion/contratos', 'includes/paginas/panelUsuario/contratos/listarContratos.php', 'pagina de usuario'),
(124, 11, 'Comprar Dias', 'administracion/subscriptores/comprar', 'includes/paginas/panelEmpresa/premium/comprarDias.php', 'pagina de subscriptores'),
(125, 11, 'Calificaciones', 'administracion/subscriptores/calificaciones', 'includes/paginas/panelEmpresa/premium/listarAnalisis.php', 'pagina de subscriptores'),
(126, 11, 'Boletas', 'administracion/subscriptores/boletas', 'includes/paginas/panelEmpresa/premium/listarBoletas.php', 'pagina de subscriptores'),
(127, 11, 'Historial Contratos', 'administracion/subscriptores/contratos', 'includes/paginas/panelEmpresa/premium/listarHistorialContratos.php', 'pagina de subscriptores'),
(128, 4, 'configuracion', 'administracion/seguridad/configuracion', 'includes/paginas/panelAdministracion/Seguridad/configuracionweb.php', 'pagina de administracion'),
(129, 11, 'Boletas', 'administracion/subscriptores/boletas', 'includes/paginas/panelAdministracion/Subscriptores/listarBoletas.php', 'pagina de moderador'),
(130, 11, 'Planes', 'administracion/subscriptores/planes', 'includes/paginas/panelAdministracion/Subscriptores/listarPlan.php', 'pagina de moderador'),
(131, 11, 'Agregar Planes', 'administracion/subscriptores/planes/agregar', 'includes/paginas/panelAdministracion/Subscriptores/agregarPlan.php', 'pagina de moderador'),
(132, 11, 'Agregar Boleta', 'administracion/subscriptores/boletas/agregar', 'includes/paginas/panelAdministracion/Subscriptores/agregarBoleta.php', 'pagina de moderador'),
(133, 11, 'Modificar Boleta', 'administracion/subscriptores/boletas/modificar', 'includes/paginas/panelAdministracion/Subscriptores/modificarBoleta.php', 'pagina de moderador'),
(134, 11, 'Modificar Planes', 'administracion/subscriptores/planes/modificar', 'includes/paginas/panelAdministracion/Subscriptores/modificarPlan.php', 'pagina de moderador'),
(135, 1, 'listar servicios', 'servicios', 'includes/paginas/servicios.php', 'pagina publica'),
(136, 1, 'Detalle de servicios', 'detalle', 'includes/paginas/servicioDetalle.php', 'pagina publica'),
(137, 1, 'Pagina de empresas', 'in', 'includes/in/paginaEmpresa.php', 'pagina de empresas'),
(138, 11, 'Simular Pago', 'administracion/subscriptores/simular', 'includes/paginas/panelAdministracion/Subscriptores/simularPagomaster.php', 'pagina de administracion'),
(139, 1, 'formulario', 'formulario', 'includes/paginas/contacto.php', 'pagina publica'),
(140, 1, 'sobre_nosotros', 'sobre_nosotros', 'includes/paginas/sobre_nosotros.php', 'pagina publica'),
(141, 1, 'terminos_y_condiciones', 'terminos_y_condiciones', 'includes/paginas/terminos_y_condiciones.php', 'pagina publica'),
(142, 1, 'preguntas_frecuentes', 'preguntas_frecuentes', 'includes/paginas/preguntasfrecuentes.php', 'pagina publica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `id_pais` int(11) NOT NULL AUTO_INCREMENT,
  `nom_pais` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id_pais`, `nom_pais`) VALUES
(1, 'Chile'),
(2, 'Argentina'),
(10, 'hola mundo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `id_pag` int(11) NOT NULL,
  `id_tu` int(11) NOT NULL,
  PRIMARY KEY (`id_pag`,`id_tu`),
  KEY `id_tu` (`id_tu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_pag`, `id_tu`) VALUES
(2, 0),
(3, 0),
(9, 0),
(12, 0),
(20, 0),
(21, 0),
(37, 0),
(91, 0),
(135, 0),
(136, 0),
(137, 0),
(139, 0),
(140, 0),
(141, 0),
(142, 0),
(9, 1),
(12, 1),
(17, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(95, 1),
(96, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(135, 1),
(136, 1),
(137, 1),
(139, 1),
(140, 1),
(141, 1),
(142, 1),
(11, 2),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(15, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(34, 3),
(35, 3),
(36, 3),
(38, 3),
(41, 3),
(43, 3),
(44, 3),
(45, 3),
(46, 3),
(47, 3),
(48, 3),
(49, 3),
(50, 3),
(51, 3),
(52, 3),
(53, 3),
(54, 3),
(55, 3),
(57, 3),
(58, 3),
(59, 3),
(60, 3),
(61, 3),
(62, 3),
(63, 3),
(64, 3),
(65, 3),
(66, 3),
(67, 3),
(68, 3),
(69, 3),
(70, 3),
(71, 3),
(72, 3),
(73, 3),
(74, 3),
(75, 3),
(76, 3),
(90, 3),
(92, 3),
(93, 3),
(94, 3),
(97, 3),
(98, 3),
(99, 3),
(100, 3),
(101, 3),
(102, 3),
(103, 3),
(104, 3),
(105, 3),
(106, 3),
(108, 3),
(109, 3),
(110, 3),
(111, 3),
(112, 3),
(113, 3),
(114, 3),
(115, 3),
(116, 3),
(117, 3),
(118, 3),
(119, 3),
(128, 3),
(129, 3),
(130, 3),
(131, 3),
(132, 3),
(133, 3),
(134, 3),
(135, 3),
(136, 3),
(137, 3),
(138, 3),
(139, 3),
(140, 3),
(141, 3),
(142, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `rut` varchar(255) NOT NULL,
  `id_com` int(11) DEFAULT NULL,
  `id_est` int(11) DEFAULT NULL,
  `id_tu` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `tel_per` varchar(255) DEFAULT NULL,
  `email_per` varchar(255) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`rut`),
  KEY `id_tu` (`id_tu`),
  KEY `id_com` (`id_com`),
  KEY `id_est` (`id_est`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`rut`, `id_com`, `id_est`, `id_tu`, `nombre`, `apellido`, `direccion`, `fecha_nac`, `tel_per`, `email_per`, `contrasena`) VALUES
('18.293.138-1', 1, 1, 1, 'juan pablo', 'retamales lepe', 'descripcion', '0000-00-00', '', 'test2@contratoenchile.cl', 'e35ee65e2d18185dd790c7f34bf0a615'),
('18.293.138-2', 1, 2, 0, 'test', 'creado', 'asdasd', '0000-00-00', '4567891', 'test@contratoenchile.cl', '477d628eb43bfbd2dcb905e20cb1d5bd'),
('18.293.138-3', 1, 1, 3, 'admin2', 'admin', 'asdasd', '0000-00-00', '51170428', 'cheshire.darkness@gmail.com', 'e35ee65e2d18185dd790c7f34bf0a615');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `per_ent`
--

CREATE TABLE IF NOT EXISTS `per_ent` (
  `id_ent` int(11) NOT NULL,
  `rut` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ent`,`rut`),
  KEY `rut` (`rut`),
  KEY `id_ent` (`id_ent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `per_ent`
--

INSERT INTO `per_ent` (`id_ent`, `rut`) VALUES
(5, '18.293.138-1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan`
--

CREATE TABLE IF NOT EXISTS `plan` (
  `id_plan` int(11) NOT NULL AUTO_INCREMENT,
  `nom_plan` varchar(255) NOT NULL,
  `valor_plan` int(11) NOT NULL,
  `id_est` int(11) NOT NULL,
  `dias` int(11) NOT NULL,
  PRIMARY KEY (`id_plan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `plan`
--

INSERT INTO `plan` (`id_plan`, `nom_plan`, `valor_plan`, `id_est`, `dias`) VALUES
(1, 'Plan basico por 30 dias', 5000, 7, 30),
(2, 'Plan por 90 dias', 13000, 7, 90),
(3, 'Plan por 180 dias', 20000, 7, 180),
(4, 'Plan por 365 dias', 30000, 7, 365),
(5, 'Plan Inauguracion', 15000, 9, 180);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE IF NOT EXISTS `provincia` (
  `id_prov` int(11) NOT NULL AUTO_INCREMENT,
  `nom_prov` varchar(255) DEFAULT NULL,
  `id_reg` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_prov`),
  KEY `id_reg` (`id_reg`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id_prov`, `nom_prov`, `id_reg`) VALUES
(1, 'Santiago', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id_reg` int(11) NOT NULL AUTO_INCREMENT,
  `nom_reg` varchar(255) DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_reg`),
  KEY `id_pais` (`id_pais`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`id_reg`, `nom_reg`, `id_pais`) VALUES
(1, 'Metropolitana', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servcon`
--

CREATE TABLE IF NOT EXISTS `servcon` (
  `id_con` int(11) NOT NULL,
  `id_serv` int(11) NOT NULL,
  PRIMARY KEY (`id_con`,`id_serv`),
  KEY `id_serv` (`id_serv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servcon`
--

INSERT INTO `servcon` (`id_con`, `id_serv`) VALUES
(14, 1),
(16, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE IF NOT EXISTS `servicio` (
  `id_serv` int(11) NOT NULL AUTO_INCREMENT,
  `id_scat` int(11) DEFAULT NULL,
  `id_ent` int(11) DEFAULT NULL,
  `id_est` int(11) DEFAULT NULL,
  `nom_serv` varchar(255) DEFAULT NULL,
  `desc_serv` varchar(255) DEFAULT NULL,
  `seo_serv` varchar(255) DEFAULT NULL,
  `id_ts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_serv`),
  KEY `id_ent` (`id_ent`),
  KEY `id_est` (`id_est`),
  KEY `is_scat` (`id_scat`),
  KEY `id_ts` (`id_ts`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_serv`, `id_scat`, `id_ent`, `id_est`, `nom_serv`, `desc_serv`, `seo_serv`, `id_ts`) VALUES
(1, 1, 5, 5, 'hola servicio', 'probando metodo', '', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE IF NOT EXISTS `subcategoria` (
  `id_scat` int(11) NOT NULL AUTO_INCREMENT,
  `id_cat` int(11) DEFAULT NULL,
  `nom_scat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_scat`),
  KEY `id_cat` (`id_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id_scat`, `id_cat`, `nom_scat`) VALUES
(1, 1, '1'),
(2, 2, '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocal`
--

CREATE TABLE IF NOT EXISTS `tipocal` (
  `id_tc` int(11) NOT NULL AUTO_INCREMENT,
  `nom_tc` varchar(255) DEFAULT NULL,
  `desc_tc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `tipocal`
--

INSERT INTO `tipocal` (`id_tc`, `nom_tc`, `desc_tc`) VALUES
(2, 'Calidad', 'En general la calidad del servicio que presta es?'),
(3, 'Respuesta a consultas', 'brinda respuesta adecuada a sus consultas tÃ©cnicas en relacion al servicio?'),
(4, 'respuesta adecuada', 'brinda respuesta adecuada a sus consultas comerciales y administrativas'),
(5, 'responde ante urgencias', 'Ante muestras urgentes respondemos en tiempo y forma'),
(6, 'cumplimiento', 'Cumplimos con los plazos de entrega de informes y/o resultados'),
(7, 'Sin errores', 'No cometemos errores en los informes y/o resultados'),
(8, 'Precios', 'En general los precios son'),
(9, 'La facturacion y notas tiempo', 'La facturacion y notas de credito se realizan en tiempo y forma');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoCSS`
--

CREATE TABLE IF NOT EXISTS `tipoCSS` (
  `id_tcss` int(11) NOT NULL AUTO_INCREMENT,
  `nom_tcss` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tcss`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tipoCSS`
--

INSERT INTO `tipoCSS` (`id_tcss`, `nom_tcss`) VALUES
(1, 'Menu'),
(2, 'Contacto'),
(3, 'Cuerpo'),
(4, 'Puro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodoc`
--

CREATE TABLE IF NOT EXISTS `tipodoc` (
  `id_td` int(11) NOT NULL AUTO_INCREMENT,
  `nom_td` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_td`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipodoc`
--

INSERT INTO `tipodoc` (`id_td`, `nom_td`) VALUES
(1, 'Certificado'),
(2, 'Otro'),
(3, 'asdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomedia`
--

CREATE TABLE IF NOT EXISTS `tipomedia` (
  `id_tm` int(11) NOT NULL AUTO_INCREMENT,
  `nom_tm` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tipomedia`
--

INSERT INTO `tipomedia` (`id_tm`, `nom_tm`) VALUES
(1, 'Audio'),
(2, 'Video'),
(3, 'Imagen'),
(4, 'PDF'),
(5, 'Youtube Video');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopagina`
--

CREATE TABLE IF NOT EXISTS `tipopagina` (
  `id_tp` int(11) NOT NULL AUTO_INCREMENT,
  `nom_tp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `tipopagina`
--

INSERT INTO `tipopagina` (`id_tp`, `nom_tp`) VALUES
(1, 'Informativa'),
(2, 'Modulo'),
(3, 'Administrativa'),
(4, 'seguridad'),
(5, 'Contenido'),
(6, 'Contratos'),
(7, 'Posicionamiento'),
(8, 'Calificaciones'),
(9, 'Repertorio'),
(10, 'Perfil'),
(11, 'Subscriptores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposervicio`
--

CREATE TABLE IF NOT EXISTS `tiposervicio` (
  `id_ts` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ts` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_ts`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tiposervicio`
--

INSERT INTO `tiposervicio` (`id_ts`, `nom_ts`) VALUES
(2, 'Solo Presencial'),
(3, 'Solo Online'),
(4, 'Presencial y Online');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE IF NOT EXISTS `tipousuario` (
  `id_tu` int(11) NOT NULL AUTO_INCREMENT,
  `nom_tu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`id_tu`, `nom_tu`) VALUES
(0, 'Visitante'),
(1, 'Cliente'),
(2, 'Empresa'),
(3, 'Moderador'),
(4, 'hola tp'),
(5, 'profe');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificacionclie`
--
ALTER TABLE `calificacionclie`
  ADD CONSTRAINT `calificacionclie_ibfk_1` FOREIGN KEY (`id_con`) REFERENCES `contacto` (`id_con`),
  ADD CONSTRAINT `calificacionclie_ibfk_2` FOREIGN KEY (`id_ec`) REFERENCES `escalacal` (`id_ec`),
  ADD CONSTRAINT `calificacionclie_ibfk_3` FOREIGN KEY (`id_tc`) REFERENCES `tipocal` (`id_tc`);

--
-- Filtros para la tabla `calificacionserv`
--
ALTER TABLE `calificacionserv`
  ADD CONSTRAINT `calificacionserv_ibfk_1` FOREIGN KEY (`id_con`, `id_serv`) REFERENCES `servcon` (`id_con`, `id_serv`),
  ADD CONSTRAINT `calificacionserv_ibfk_2` FOREIGN KEY (`id_ec`) REFERENCES `escalacal` (`id_ec`),
  ADD CONSTRAINT `calificacionserv_ibfk_3` FOREIGN KEY (`id_tc`) REFERENCES `tipocal` (`id_tc`);

--
-- Filtros para la tabla `cobertura`
--
ALTER TABLE `cobertura`
  ADD CONSTRAINT `cobertura_ibfk_1` FOREIGN KEY (`id_com`) REFERENCES `comuna` (`id_com`),
  ADD CONSTRAINT `cobertura_ibfk_2` FOREIGN KEY (`id_serv`) REFERENCES `servicio` (`id_serv`);

--
-- Filtros para la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD CONSTRAINT `comuna_ibfk_1` FOREIGN KEY (`id_prov`) REFERENCES `provincia` (`id_prov`);

--
-- Filtros para la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `contacto_ibfk_1` FOREIGN KEY (`id_est`) REFERENCES `estado` (`id_est`),
  ADD CONSTRAINT `contacto_ibfk_3` FOREIGN KEY (`rut`) REFERENCES `persona` (`rut`);

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`id_td`) REFERENCES `tipodoc` (`id_td`),
  ADD CONSTRAINT `documento_ibfk_2` FOREIGN KEY (`id_ent`) REFERENCES `entidad` (`id_ent`);

--
-- Filtros para la tabla `entidad`
--
ALTER TABLE `entidad`
  ADD CONSTRAINT `entidad_ibfk_2` FOREIGN KEY (`id_est`) REFERENCES `estado` (`id_est`);

--
-- Filtros para la tabla `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`id_pag`) REFERENCES `pagina` (`id_pag`),
  ADD CONSTRAINT `MENU_ASDF` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);

--
-- Filtros para la tabla `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`id_serv`) REFERENCES `servicio` (`id_serv`),
  ADD CONSTRAINT `media_ibfk_2` FOREIGN KEY (`id_tm`) REFERENCES `tipomedia` (`id_tm`);

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `emisor_persona` FOREIGN KEY (`emisor`) REFERENCES `persona` (`rut`),
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`id_con`) REFERENCES `contacto` (`id_con`);

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menuparausuario` FOREIGN KEY (`id_tu`) REFERENCES `tipousuario` (`id_tu`);

--
-- Filtros para la tabla `pagina`
--
ALTER TABLE `pagina`
  ADD CONSTRAINT `pagina_ibfk_1` FOREIGN KEY (`id_tp`) REFERENCES `tipopagina` (`id_tp`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`id_pag`) REFERENCES `pagina` (`id_pag`),
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`id_tu`) REFERENCES `tipousuario` (`id_tu`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`id_tu`) REFERENCES `tipousuario` (`id_tu`),
  ADD CONSTRAINT `persona_ibfk_2` FOREIGN KEY (`id_com`) REFERENCES `comuna` (`id_com`),
  ADD CONSTRAINT `persona_ibfk_3` FOREIGN KEY (`id_est`) REFERENCES `estado` (`id_est`);

--
-- Filtros para la tabla `per_ent`
--
ALTER TABLE `per_ent`
  ADD CONSTRAINT `per_ent2` FOREIGN KEY (`id_ent`) REFERENCES `entidad` (`id_ent`),
  ADD CONSTRAINT `per_ent_ibfk_1` FOREIGN KEY (`rut`) REFERENCES `persona` (`rut`);

--
-- Filtros para la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`id_reg`) REFERENCES `region` (`id_reg`);

--
-- Filtros para la tabla `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `region_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_pais`);

--
-- Filtros para la tabla `servcon`
--
ALTER TABLE `servcon`
  ADD CONSTRAINT `servcon_ibfk_1` FOREIGN KEY (`id_con`) REFERENCES `contacto` (`id_con`),
  ADD CONSTRAINT `servcon_ibfk_2` FOREIGN KEY (`id_serv`) REFERENCES `servicio` (`id_serv`);

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`id_ent`) REFERENCES `entidad` (`id_ent`),
  ADD CONSTRAINT `servicio_ibfk_2` FOREIGN KEY (`id_est`) REFERENCES `estado` (`id_est`),
  ADD CONSTRAINT `servicio_ibfk_4` FOREIGN KEY (`id_ts`) REFERENCES `tiposervicio` (`id_ts`),
  ADD CONSTRAINT `servicio_ibfk_serv_scat` FOREIGN KEY (`id_scat`) REFERENCES `subcategoria` (`id_scat`);

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `subcategoria_ibfk_2` FOREIGN KEY (`id_cat`) REFERENCES `categoria` (`id_cat`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
