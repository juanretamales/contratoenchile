-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-08-2015 a las 22:13:48
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

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
`id_bol` int(11) NOT NULL,
  `id_est` int(11) NOT NULL,
  `id_ent` int(11) NOT NULL,
  `fecha_bol` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `monto` int(11) NOT NULL,
  `id_plan` int(11) NOT NULL
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
`id_calc` int(11) NOT NULL,
  `id_con` int(11) DEFAULT NULL,
  `id_tc` int(11) DEFAULT NULL,
  `id_ec` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacionserv`
--

CREATE TABLE IF NOT EXISTS `calificacionserv` (
`id_cals` int(11) NOT NULL,
  `id_con` int(11) DEFAULT NULL,
  `id_serv` int(11) DEFAULT NULL,
  `id_tc` int(11) DEFAULT NULL,
  `id_ec` int(11) DEFAULT NULL
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
`id_cat` int(11) NOT NULL,
  `nom_cat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_cat`, `nom_cat`) VALUES
(5, 'Belleza'),
(6, 'Clases,Cursos y Capacitaciones'),
(7, 'Fiestas y Eventos'),
(8, 'Mantenimiento de VehÃ­culos'),
(9, 'Mantenimiento del Hogar'),
(10, 'Otros Servicios'),
(11, 'Profesionales'),
(12, 'RecreaciÃ³n y Ocio'),
(13, 'Servicio TÃ©cnico'),
(14, 'Servicios de Traslado'),
(15, 'Viajes y Turismo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobertura`
--

CREATE TABLE IF NOT EXISTS `cobertura` (
  `id_serv` int(11) NOT NULL,
  `id_com` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

CREATE TABLE IF NOT EXISTS `comuna` (
`id_com` int(11) NOT NULL,
  `nom_com` varchar(255) DEFAULT NULL,
  `id_prov` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=349 ;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`id_com`, `nom_com`, `id_prov`) VALUES
(1, 'Conchali', 1),
(2, 'Arica', 2),
(3, 'Camarones', 2),
(4, 'Putre', 3),
(5, 'General Lagos', 3),
(6, 'Iquique', 4),
(7, 'Alto Hospicio', 4),
(8, 'Pozo Almonte', 5),
(9, 'Camiña', 5),
(10, 'Colchane', 5),
(11, 'Huara', 5),
(12, 'Pica', 5),
(13, 'Antofagasta', 6),
(14, 'Mejillones', 6),
(15, 'Sierra Gorda', 6),
(16, 'Taltal', 6),
(17, 'Calama', 7),
(18, 'Ollagüe', 7),
(19, 'San Pedro de Atacama', 7),
(20, 'Tocopilla', 8),
(21, 'María Elena', 8),
(22, 'Copiapó', 9),
(23, 'Caldera', 9),
(24, 'Tierra Amarilla', 9),
(25, 'Chañaral', 10),
(26, 'Diego de Almagro', 10),
(27, 'Vallenar', 11),
(28, 'Alto del Carmen', 11),
(29, 'Freirina', 11),
(30, 'Huasco', 11),
(31, 'La Serena', 12),
(32, 'Coquimbo', 12),
(33, 'Andacollo', 12),
(34, 'La Higuera', 12),
(35, 'Paiguano', 12),
(36, 'Vicuña', 12),
(37, 'Illapel', 13),
(38, 'Canela', 13),
(39, 'Los Vilos', 13),
(40, 'Salamanca', 13),
(41, 'Ovalle', 14),
(42, 'Combarbalá', 14),
(43, 'Monte Patria', 14),
(44, 'Punitaqui', 14),
(45, 'Río Hurtado', 14),
(46, 'Valparaíso', 15),
(47, 'Casablanca', 15),
(48, 'Concón', 15),
(49, 'Juan Fernández', 15),
(50, 'Puchuncaví', 15),
(51, 'Quintero', 15),
(52, 'Viña del Mar', 15),
(53, 'Isla de Pascua', 16),
(54, 'Los Andes', 17),
(55, 'Calle Larga', 17),
(56, 'Rinconada', 17),
(57, 'Rinconada', 17),
(58, 'Rinconada', 17),
(59, 'La Ligua', 18),
(60, 'Cabildo', 18),
(61, 'Papudo', 18),
(62, 'Petorca', 18),
(63, 'Zapallar', 18),
(64, 'Quillota', 19),
(65, 'Calera', 19),
(66, 'Hijuelas', 19),
(67, 'La Cruz', 19),
(68, 'Nogales', 19),
(69, 'San Antonio', 20),
(70, 'Algarrobo', 20),
(71, 'Cartagena', 20),
(72, 'El Quisco', 20),
(73, 'El Tabo', 20),
(74, 'Santo Domingo', 20),
(75, 'San Felipe', 21),
(76, 'Catemu', 21),
(77, 'Llaillay', 21),
(78, 'Panquehue', 21),
(79, 'Putaendo', 21),
(80, 'Santa María', 21),
(81, 'Limache', 22),
(82, 'Quilpué', 22),
(83, 'Villa Alemana', 22),
(84, 'Olmué', 22),
(85, 'Rancagua', 23),
(86, 'Codegua', 23),
(87, 'Coinco', 23),
(88, 'Coltauco', 23),
(89, 'Doñihue', 23),
(90, 'Graneros', 23),
(91, 'Las Cabras', 23),
(92, 'Machalí', 23),
(93, 'Malloa', 23),
(94, 'Mostazal', 23),
(95, 'Olivar', 23),
(96, 'Peumo', 23),
(97, 'Pichidegua', 23),
(98, 'Quinta de Tilcoco', 23),
(99, 'Rengo', 23),
(100, 'Requínoa', 23),
(101, 'San Vicente', 23),
(102, 'Pichilemu', 24),
(103, 'La Estrella', 24),
(104, 'Litueche', 24),
(105, 'Marchihue', 24),
(106, 'Navidad', 24),
(107, 'Paredones', 24),
(108, 'San Fernando', 25),
(109, 'Chépica', 25),
(110, 'Chimbarongo', 25),
(111, 'Lolol', 25),
(112, 'Nancagua', 25),
(113, 'Palmilla', 25),
(114, 'Peralillo', 25),
(115, 'Placilla', 25),
(116, 'Pumanque', 25),
(117, 'Santa Cruz', 25),
(118, 'Talca', 26),
(119, 'Constitución', 26),
(120, 'Curepto', 26),
(121, 'Empedrado', 26),
(122, 'Maule', 26),
(123, 'Pelarco', 26),
(124, 'Pencahue', 26),
(125, 'Río Claro', 26),
(126, 'San Clemente', 26),
(127, 'San Rafael', 26),
(128, 'Cauquenes', 27),
(129, 'Chanco', 27),
(130, 'Pelluhue', 27),
(131, 'Curicó', 28),
(132, 'Hualañé', 28),
(133, 'Licantén', 28),
(134, 'Molina', 28),
(135, 'Rauco', 28),
(136, 'Romeral', 28),
(137, 'Sagrada Familia', 28),
(138, 'Teno', 28),
(139, 'Vichuquén', 28),
(140, 'Linares', 29),
(141, 'Colbún', 29),
(142, 'Longaví', 29),
(143, 'Longaví', 29),
(144, 'Retiro', 29),
(145, 'San Javier', 29),
(146, 'Villa Alegre', 29),
(147, 'Yerbas Buenas', 29),
(148, 'Concepción', 30),
(149, 'Concepción', 30),
(150, 'Chiguayante', 30),
(151, 'Florida', 30),
(152, 'Hualqui', 30),
(153, 'Lota', 30),
(154, 'Penco', 30),
(155, 'San Pedro de la Paz', 30),
(156, 'Santa Juana', 30),
(157, 'Talcahuano', 30),
(158, 'Tomé', 30),
(159, 'Hualpén', 30),
(160, 'Lebu', 31),
(161, 'Arauco', 31),
(162, 'Cañete', 31),
(163, 'Contulmo', 31),
(164, 'Curanilahue', 31),
(165, 'Los Alamos', 31),
(166, 'Tirúa', 31),
(167, 'Los Angeles', 32),
(168, 'Antuco', 32),
(169, 'Cabrero', 32),
(170, 'Laja', 32),
(171, 'Mulchén', 32),
(172, 'Nacimiento', 32),
(173, 'Negrete', 32),
(174, 'Quilaco', 32),
(175, 'Quilleco', 32),
(176, 'San Rosendo', 32),
(177, 'Santa Bárbara', 32),
(178, 'Tucapel', 32),
(179, 'Yumbel', 32),
(180, 'Alto Biobío', 32),
(181, 'Chillán', 33),
(182, 'Bulnes', 33),
(183, 'Cobquecura', 33),
(184, 'Coelemu', 33),
(185, 'Coihueco', 33),
(186, 'Chillán Viejo', 33),
(187, 'El Carmen', 33),
(188, 'Ninhue', 33),
(189, 'Ñiquén', 33),
(190, 'Pemuco', 33),
(191, 'Pinto', 33),
(192, 'Portezuelo', 33),
(193, 'Quillón', 33),
(194, 'Quirihue', 33),
(195, 'Ránquil', 33),
(196, 'San Carlos', 33),
(197, 'San Fabián', 33),
(198, 'San Ignacio', 33),
(199, 'San Nicolás', 33),
(200, 'Treguaco', 33),
(201, 'Yungay', 33),
(202, 'Temuco', 34),
(203, 'Carahue', 34),
(204, 'Cunco', 34),
(205, 'Curarrehue', 34),
(206, 'Freire', 34),
(207, 'Galvarino', 34),
(208, 'Gorbea', 34),
(209, 'Lautaro', 34),
(210, 'Loncoche', 34),
(211, 'Melipeuco', 34),
(212, 'Nueva Imperial', 34),
(213, 'Padre Las Casas', 34),
(214, 'Perquenco', 34),
(215, 'Pitrufquén', 34),
(216, 'Pucón', 34),
(217, 'Saavedra', 34),
(218, 'Teodoro Schmidt', 34),
(219, 'Toltén', 34),
(220, 'Vilcún', 34),
(221, 'Villarrica', 34),
(222, 'Cholchol', 34),
(223, 'Angol', 35),
(224, 'Collipulli', 35),
(225, 'Curacautín', 35),
(226, 'Ercilla', 35),
(227, 'Lonquimay', 35),
(228, 'Los Sauces', 35),
(229, 'Lumaco', 35),
(230, 'Purén', 35),
(231, 'Renaico', 35),
(232, '\r\nTraiguén', 35),
(233, 'Victoria', 35),
(234, 'Valdivia', 36),
(235, 'Corral', 36),
(236, 'Lanco', 36),
(237, 'Los Lagos', 36),
(238, 'Máfil', 36),
(239, 'Mariquina', 36),
(240, 'Paillaco', 36),
(241, 'Panguipulli', 36),
(242, 'La Unión', 37),
(243, 'Futrono', 37),
(244, 'Lago Ranco', 37),
(245, 'Río Bueno', 37),
(246, 'Puerto Montt', 38),
(247, 'Calbuco', 38),
(248, 'Cochamó', 38),
(249, 'Fresia', 38),
(250, 'Frutillar', 38),
(251, 'Los Muermos', 38),
(252, 'Llanquihue', 38),
(253, 'Maullín', 38),
(254, 'Puerto Varas', 38),
(255, 'Castro', 39),
(256, 'Ancud', 39),
(257, 'Chonchi', 39),
(258, 'Curaco de Vélez', 39),
(259, 'Dalcahue', 39),
(260, 'Puqueldón', 39),
(261, 'Queilén', 39),
(262, 'Quellón', 39),
(263, 'Quemchi', 39),
(264, 'Quinchao', 39),
(265, 'Osorno', 40),
(266, 'Puerto Octay', 40),
(267, 'Purranque', 40),
(268, 'Puyehue', 40),
(269, 'Río Negro', 40),
(270, 'San Juan de la Costa', 40),
(271, 'San Pablo', 40),
(272, 'Chaitén', 41),
(273, 'Futaleufú', 41),
(274, 'Hualaihué', 41),
(275, 'Palena', 41),
(276, 'Coihaique', 42),
(277, 'Lago Verde', 42),
(278, 'Aisén', 43),
(279, 'Cisnes', 43),
(280, 'Guaitecas', 43),
(281, 'Cochrane', 44),
(282, 'O''Higgins', 44),
(283, 'Tortel', 44),
(284, 'Chile Chico', 45),
(285, 'Río Ibáñez', 45),
(286, 'Punta Arenas', 46),
(287, 'Laguna Blanca', 46),
(288, 'Río Verde', 46),
(289, 'San Gregorio', 46),
(290, 'Cabo de Hornos (Ex-Navarino)', 47),
(291, 'Antártica', 47),
(292, 'Porvenir', 48),
(293, 'Primavera', 48),
(294, 'Timaukel', 48),
(295, 'Natales', 49),
(296, 'Torres del Paine', 49),
(297, 'Santiago', 1),
(298, 'Cerrillos', 1),
(299, 'Cerro Navia', 1),
(300, 'Conchalí', 1),
(301, 'El Bosque', 1),
(302, 'Estación Central', 1),
(303, 'Huechuraba', 1),
(304, 'Independencia', 1),
(305, 'La Cisterna', 1),
(306, 'La Florida', 1),
(307, 'La Granja', 1),
(308, 'La Pintana', 1),
(309, 'La Reina', 1),
(310, 'Las Condes', 1),
(311, 'Lo Barnechea', 1),
(312, 'Lo Espejo', 1),
(313, 'Lo Prado', 1),
(314, 'Macul', 1),
(315, 'Maipú', 1),
(316, 'Ñuñoa', 1),
(317, 'Pedro Aguirre Cerda', 1),
(318, 'Peñalolén', 1),
(319, 'Providencia', 1),
(320, 'Pudahuel', 1),
(321, 'Quilicura', 1),
(322, 'Quinta Normal', 1),
(323, 'Recoleta', 1),
(324, 'Renca', 1),
(325, 'San Joaquín', 1),
(326, 'San Miguel', 1),
(327, 'San Ramón', 1),
(328, 'Vitacura', 1),
(329, 'Puente Alto', 50),
(330, 'Pirque', 50),
(331, 'San José de Maipo', 50),
(332, 'Colina', 51),
(333, 'Lampa', 51),
(334, 'Tiltil', 51),
(335, 'San Bernardo', 52),
(336, 'Buin', 52),
(337, 'Calera de Tango', 52),
(338, 'Paine', 52),
(339, 'Melipilla', 53),
(340, 'Alhué', 53),
(341, 'Curacaví', 53),
(342, 'María Pinto', 53),
(343, 'San Pedro', 53),
(344, 'Talagante', 54),
(345, 'El Monte', 54),
(346, 'Isla de Maipo', 54),
(347, 'Padre Hurtado', 54),
(348, 'Peñaflor', 54);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE IF NOT EXISTS `contacto` (
`id_con` int(11) NOT NULL,
  `rut` varchar(255) DEFAULT NULL,
  `id_est` int(11) DEFAULT NULL,
  `fecha_con` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id_con`, `rut`, `id_est`, `fecha_con`) VALUES
(14, '18.293.138-1', 11, '2014-10-26 21:29:38'),
(15, '18.293.138-1', 7, '2014-11-16 15:31:14'),
(16, '18.293.138-1', 7, '2014-11-16 15:36:27'),
(17, '18.293.138-1', 8, '2015-07-26 16:34:12'),
(18, '18.293.138-1', 8, '2015-07-28 16:34:15'),
(19, '18.293.138-1', 9, '2015-07-28 16:34:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidad`
--

CREATE TABLE IF NOT EXISTS `entidad` (
`id_ent` int(11) NOT NULL,
  `id_est` int(11) DEFAULT NULL,
  `subscripcion` date DEFAULT NULL,
  `rut_sii` varchar(255) DEFAULT NULL,
  `nom_ent` varchar(255) DEFAULT NULL,
  `sitio` varchar(255) DEFAULT NULL,
  `desc_ent` varchar(255) DEFAULT NULL,
  `email_ent` varchar(255) DEFAULT NULL,
  `tel_ent` varchar(255) DEFAULT NULL,
  `auth_key` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `entidad`
--

INSERT INTO `entidad` (`id_ent`, `id_est`, `subscripcion`, `rut_sii`, `nom_ent`, `sitio`, `desc_ent`, `email_ent`, `tel_ent`, `auth_key`) VALUES
(4, 5, '0000-00-00', '18.293.138-1', 'Contrato en Chile2', 'contratoenchile', 'descripcion contrato en chile', 'test2@contratoenchile.cl', '51170428', '3eab2dfc052c5830a73125c7967616c7'),
(5, 5, '2015-10-08', '18.293.138-1', 'hola empresa', 'hola+empresa', 'descripcion empresa', 'contacto@empresa.cl', '51170428', '154756c68ccd33b841b91da2dd89fa68'),
(6, 2, '0000-00-00', '18.293.138-2', 'modificado2', 'modificado', 'descripcion empresa', 'test2@contratoenchile.cl', '51170428', '63ea1bd80bd0c43cc15b36f669573cc5'),
(8, 5, '2014-12-10', '15.159.951-1', 'sinaptico', 'sinaptico', 'hola sinaptico', 'asdfer@hotmail.cl', '51170428', 'eb2d8e52541b7974127ad6ac63a2edba'),
(9, 5, NULL, NULL, 'Pasteleria Eliza', 'pasteleria+eliza', NULL, NULL, NULL, ''),
(10, NULL, NULL, NULL, 'RobertoMusik', 'robertomusik', NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escalacal`
--

CREATE TABLE IF NOT EXISTS `escalacal` (
`id_ec` int(11) NOT NULL,
  `nom_ec` varchar(255) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL
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
`id_est` int(11) NOT NULL,
  `nom_est` varchar(255) DEFAULT NULL
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
  `id_pag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`id_menu`, `id_pag`) VALUES
(5, 22),
(5, 24),
(5, 32),
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
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE IF NOT EXISTS `log` (
`id_log` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(20) DEFAULT NULL,
  `id_pag` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `id_tu` int(11) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=497 ;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`id_log`, `fecha`, `ip`, `id_pag`, `url`, `id_tu`, `usuario`) VALUES
(14, '2015-07-29 21:19:53', '127.0.0.1', 135, 'servicios/Belleza/Todos', 1, '18.293.138-1'),
(15, '2015-07-29 21:19:56', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(16, '2015-07-29 21:19:57', '127.0.0.1', 136, 'detalle/hola empresa/url media', 1, '18.293.138-1'),
(17, '2015-07-29 21:27:17', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(18, '2015-07-29 21:27:59', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(19, '2015-07-29 21:28:33', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(20, '2015-07-29 21:31:26', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(21, '2015-07-29 21:32:47', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(22, '2015-07-29 21:32:48', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(23, '2015-07-29 21:33:21', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(24, '2015-07-29 21:33:47', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(25, '2015-07-29 21:37:36', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(26, '2015-07-29 21:37:44', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(27, '2015-07-29 21:40:18', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(28, '2015-07-29 21:43:30', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(29, '2015-07-29 21:44:36', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(30, '2015-07-29 21:45:51', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(31, '2015-07-29 21:45:52', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(32, '2015-07-29 21:47:34', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(33, '2015-07-29 21:57:35', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(34, '2015-07-29 21:58:24', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(35, '2015-07-29 21:58:36', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(36, '2015-07-29 21:59:45', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(37, '2015-07-29 22:00:48', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(38, '2015-07-29 22:01:37', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(39, '2015-07-29 22:01:39', '127.0.0.1', 135, 'servicios/Belleza/Todos', 1, '18.293.138-1'),
(40, '2015-07-29 22:01:47', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(41, '2015-07-29 22:01:48', '127.0.0.1', 136, 'detalle/hola empresa/url media', 1, '18.293.138-1'),
(42, '2015-07-30 03:17:59', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(43, '2015-07-30 03:18:18', '127.0.0.1', 85, 'administracion/multimedia', 1, '18.293.138-1'),
(44, '2015-07-30 19:07:33', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(45, '2015-07-30 19:08:20', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(46, '2015-07-30 19:08:26', '127.0.0.1', 82, 'administracion/servicios', 1, '18.293.138-1'),
(47, '2015-07-30 19:08:58', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(48, '2015-07-30 19:09:11', '127.0.0.1', 82, 'administracion/servicios', 1, '18.293.138-1'),
(49, '2015-07-30 19:14:11', '127.0.0.1', 82, 'administracion/servicios', 1, '18.293.138-1'),
(50, '2015-07-30 19:40:14', '127.0.0.1', 82, 'administracion/servicios', 1, '18.293.138-1'),
(51, '2015-07-30 19:43:30', '127.0.0.1', 82, 'administracion/servicios', 1, '18.293.138-1'),
(52, '2015-07-30 19:54:25', '127.0.0.1', 82, 'administracion/servicios', 1, '18.293.138-1'),
(53, '2015-07-30 23:22:09', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(54, '2015-07-31 04:02:29', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(55, '2015-07-31 04:07:34', '127.0.0.1', 85, 'administracion/multimedia', 1, '18.293.138-1'),
(56, '2015-07-31 04:08:35', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(57, '2015-07-31 04:08:37', '127.0.0.1', 135, 'servicios/Belleza/Todos', 1, '18.293.138-1'),
(58, '2015-07-31 04:08:47', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(59, '2015-07-31 04:08:48', '127.0.0.1', 136, 'detalle/hola empresa/url media', 1, '18.293.138-1'),
(60, '2015-07-31 04:08:51', '127.0.0.1', 135, 'servicios/Belleza/Todos', 1, '18.293.138-1'),
(61, '2015-08-02 23:46:01', '127.0.0.1', 9, '', 0, 'Anonimo'),
(62, '2015-08-02 23:46:04', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(63, '2015-08-02 23:46:14', '127.0.0.1', 9, '', 3, '18.293.138-3'),
(64, '2015-08-02 23:46:18', '127.0.0.1', 9, '', 0, 'Anonimo'),
(65, '2015-08-02 23:46:19', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(66, '2015-08-02 23:46:27', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(67, '2015-08-02 23:48:39', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(68, '2015-08-02 23:48:49', '127.0.0.1', 82, 'administracion/servicios', 1, '18.293.138-1'),
(69, '2015-08-02 23:48:55', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(70, '2015-08-02 23:49:00', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(71, '2015-08-02 23:49:02', '127.0.0.1', 135, 'servicios/Belleza/Todos', 1, '18.293.138-1'),
(72, '2015-08-02 23:53:20', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(73, '2015-08-03 19:37:27', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(74, '2015-08-03 19:38:31', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(75, '2015-08-03 19:38:57', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(76, '2015-08-03 19:45:04', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(77, '2015-08-03 19:46:47', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(78, '2015-08-03 19:46:53', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(79, '2015-08-03 19:46:55', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(80, '2015-08-03 19:47:03', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(81, '2015-08-03 19:47:19', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(82, '2015-08-03 19:47:22', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(83, '2015-08-03 19:48:09', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(84, '2015-08-03 20:08:56', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(85, '2015-08-03 20:09:32', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(86, '2015-08-03 20:09:42', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(87, '2015-08-03 20:10:14', '127.0.0.1', 82, 'administracion/servicios', 1, '18.293.138-1'),
(88, '2015-08-03 20:10:16', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(89, '2015-08-03 20:26:05', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(90, '2015-08-03 20:33:13', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(91, '2015-08-03 20:41:14', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(92, '2015-08-03 20:41:27', '127.0.0.1', 135, 'servicios/Belleza/Todos', 1, '18.293.138-1'),
(93, '2015-08-03 20:41:30', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(94, '2015-08-03 20:41:32', '127.0.0.1', 136, 'detalle/hola empresa/url media', 1, '18.293.138-1'),
(95, '2015-08-03 20:41:41', '127.0.0.1', 135, 'servicios/Belleza/Todos', 1, '18.293.138-1'),
(96, '2015-08-03 20:42:17', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(97, '2015-08-03 20:42:22', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(98, '2015-08-03 20:42:26', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(99, '2015-08-03 20:43:46', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(100, '2015-08-03 20:45:28', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(101, '2015-08-04 19:23:19', '127.0.0.1', 9, '', 0, 'Anonimo'),
(102, '2015-08-05 00:31:12', '127.0.0.1', 9, '', 0, 'Anonimo'),
(103, '2015-08-05 00:31:18', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(104, '2015-08-05 00:31:40', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(105, '2015-08-05 00:31:42', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(106, '2015-08-05 00:32:07', '127.0.0.1', 82, 'administracion/servicios', 1, '18.293.138-1'),
(107, '2015-08-05 00:32:10', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(108, '2015-08-05 00:46:14', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(109, '2015-08-05 00:48:18', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(110, '2015-08-05 00:49:13', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(111, '2015-08-05 00:49:49', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(112, '2015-08-05 00:52:43', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(113, '2015-08-05 00:55:37', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(114, '2015-08-05 00:55:43', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(115, '2015-08-05 01:03:58', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(116, '2015-08-05 01:06:50', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(117, '2015-08-05 02:00:35', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(118, '2015-08-05 02:05:49', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(119, '2015-08-05 02:06:02', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(120, '2015-08-05 02:06:11', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(121, '2015-08-05 02:06:24', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(122, '2015-08-05 02:07:40', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(123, '2015-08-05 02:07:50', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(124, '2015-08-05 02:08:34', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(125, '2015-08-05 02:08:46', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(126, '2015-08-05 02:10:30', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(127, '2015-08-05 02:28:00', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(128, '2015-08-05 02:29:44', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(129, '2015-08-05 02:30:20', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(130, '2015-08-05 02:30:21', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(131, '2015-08-05 03:10:32', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(132, '2015-08-05 03:11:41', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(133, '2015-08-05 03:15:16', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(134, '2015-08-05 03:15:43', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(135, '2015-08-05 03:17:28', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(136, '2015-08-05 03:17:32', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(137, '2015-08-05 03:18:02', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(138, '2015-08-05 03:23:02', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(139, '2015-08-05 03:23:42', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(140, '2015-08-05 03:24:28', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(141, '2015-08-05 03:24:46', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(142, '2015-08-05 03:25:12', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(143, '2015-08-05 03:26:51', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(144, '2015-08-05 03:28:45', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(145, '2015-08-05 03:29:13', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(146, '2015-08-05 03:31:20', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(147, '2015-08-05 03:32:43', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(148, '2015-08-05 03:35:06', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(149, '2015-08-05 03:35:45', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(150, '2015-08-05 03:35:53', '127.0.0.1', 82, 'administracion/servicios', 1, '18.293.138-1'),
(151, '2015-08-05 03:36:50', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(152, '2015-08-05 03:38:23', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(153, '2015-08-05 03:57:34', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(154, '2015-08-05 04:02:20', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(155, '2015-08-05 04:03:09', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(156, '2015-08-05 04:03:27', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(157, '2015-08-05 04:04:04', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(158, '2015-08-05 04:06:06', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(159, '2015-08-05 04:06:29', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(160, '2015-08-05 04:06:53', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(161, '2015-08-05 04:06:55', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(162, '2015-08-05 04:07:30', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(163, '2015-08-05 04:07:33', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(164, '2015-08-05 04:10:55', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(165, '2015-08-05 04:11:11', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(166, '2015-08-05 04:25:18', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(167, '2015-08-05 04:25:21', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(168, '2015-08-05 04:25:51', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(169, '2015-08-05 04:27:10', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(170, '2015-08-05 04:27:24', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(171, '2015-08-05 15:30:43', '127.0.0.1', 9, '', 0, 'Anonimo'),
(172, '2015-08-05 15:31:05', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(173, '2015-08-05 15:31:21', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(174, '2015-08-05 15:31:48', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(175, '2015-08-05 15:31:57', '127.0.0.1', 82, 'administracion/servicios', 1, '18.293.138-1'),
(176, '2015-08-05 15:32:10', '127.0.0.1', 82, 'administracion/servicios', 1, '18.293.138-1'),
(177, '2015-08-05 15:32:13', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(178, '2015-08-05 15:32:52', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(179, '2015-08-05 15:39:13', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(180, '2015-08-05 15:39:53', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(181, '2015-08-05 15:41:40', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(182, '2015-08-05 20:35:43', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(183, '2015-08-05 20:36:06', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(184, '2015-08-05 20:38:45', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(185, '2015-08-05 20:42:54', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(186, '2015-08-05 22:30:30', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(187, '2015-08-05 22:31:34', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(188, '2015-08-05 22:31:38', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(189, '2015-08-05 22:32:37', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(190, '2015-08-05 22:32:39', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(191, '2015-08-05 22:35:34', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(192, '2015-08-05 22:35:37', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(193, '2015-08-05 22:36:30', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(194, '2015-08-05 22:36:33', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(195, '2015-08-05 22:36:52', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(196, '2015-08-05 22:38:34', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(197, '2015-08-05 23:31:03', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(198, '2015-08-05 23:33:59', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(199, '2015-08-05 23:34:32', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(200, '2015-08-05 23:35:29', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(201, '2015-08-05 23:36:00', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(202, '2015-08-05 23:37:03', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(203, '2015-08-05 23:37:51', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(204, '2015-08-05 23:38:11', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(205, '2015-08-05 23:38:45', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(206, '2015-08-05 23:38:48', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(207, '2015-08-05 23:39:27', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(208, '2015-08-05 23:39:29', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(209, '2015-08-05 23:40:34', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(210, '2015-08-05 23:40:37', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(211, '2015-08-05 23:41:40', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(212, '2015-08-05 23:41:42', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(213, '2015-08-05 23:42:11', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(214, '2015-08-05 23:42:18', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(215, '2015-08-05 23:43:32', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(216, '2015-08-05 23:43:34', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(217, '2015-08-05 23:44:04', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(218, '2015-08-05 23:44:09', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(219, '2015-08-06 23:27:57', '127.0.0.1', 9, '', 0, 'Anonimo'),
(220, '2015-08-06 23:29:10', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(221, '2015-08-06 23:29:20', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(222, '2015-08-06 23:29:23', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(223, '2015-08-06 23:29:29', '127.0.0.1', 82, 'administracion/servicios', 1, '18.293.138-1'),
(224, '2015-08-06 23:29:35', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(225, '2015-08-06 23:32:39', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(226, '2015-08-06 23:33:52', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(227, '2015-08-06 23:37:06', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(228, '2015-08-06 23:37:24', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(229, '2015-08-06 23:37:58', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(230, '2015-08-06 23:38:40', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(231, '2015-08-06 23:39:25', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(232, '2015-08-07 03:21:04', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(233, '2015-08-07 03:21:39', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(234, '2015-08-07 03:22:46', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(235, '2015-08-07 03:23:35', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(236, '2015-08-07 03:24:24', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(237, '2015-08-07 21:15:05', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(238, '2015-08-07 21:15:15', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(239, '2015-08-07 21:15:27', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(240, '2015-08-07 21:15:30', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(241, '2015-08-07 21:15:33', '127.0.0.1', 135, 'servicios/Clases,Cursos y Capacitaciones/Todos', 1, '18.293.138-1'),
(242, '2015-08-07 21:15:35', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(243, '2015-08-07 21:15:37', '127.0.0.1', 135, 'servicios/Belleza/Todos', 1, '18.293.138-1'),
(244, '2015-08-07 21:15:43', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(245, '2015-08-07 21:15:45', '127.0.0.1', 136, 'detalle/hola empresa/url media', 1, '18.293.138-1'),
(246, '2015-08-07 21:16:12', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(247, '2015-08-07 21:16:12', '127.0.0.1', 136, 'detalle/hola empresa/url media', 1, '18.293.138-1'),
(248, '2015-08-07 21:23:05', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(249, '2015-08-07 21:23:05', '127.0.0.1', 136, 'detalle/hola empresa/url media', 1, '18.293.138-1'),
(250, '2015-08-07 21:25:50', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(251, '2015-08-07 21:26:09', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(252, '2015-08-07 21:27:56', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(253, '2015-08-07 21:27:59', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(254, '2015-08-07 21:28:01', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(255, '2015-08-07 21:28:03', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(256, '2015-08-07 21:45:17', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(257, '2015-08-07 21:45:25', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 0, 'Anonimo'),
(258, '2015-08-07 21:47:12', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(259, '2015-08-07 21:47:50', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(260, '2015-08-07 21:48:16', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(261, '2015-08-07 21:48:22', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(262, '2015-08-07 21:49:57', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(263, '2015-08-07 21:50:01', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(264, '2015-08-07 21:55:42', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(265, '2015-08-07 22:36:17', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(266, '2015-08-08 00:45:48', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(267, '2015-08-08 00:46:00', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(268, '2015-08-08 00:46:27', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(269, '2015-08-09 17:28:34', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(270, '2015-08-09 17:32:43', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(271, '2015-08-09 22:58:09', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(272, '2015-08-10 18:52:06', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(273, '2015-08-10 18:52:10', '127.0.0.1', 135, 'servicios/Belleza/Todos', 1, '18.293.138-1'),
(274, '2015-08-10 19:14:11', '127.0.0.1', 9, '', 0, 'Anonimo'),
(275, '2015-08-10 19:23:03', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(276, '2015-08-10 19:24:19', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(277, '2015-08-10 19:25:39', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(278, '2015-08-10 19:26:29', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(279, '2015-08-11 18:27:46', '127.0.0.1', 9, '', 0, 'Anonimo'),
(280, '2015-08-11 18:27:51', '127.0.0.1', 135, 'servicios/Belleza/Todos', 0, 'Anonimo'),
(281, '2015-08-11 18:43:06', '127.0.0.1', 135, 'servicios/Belleza/Todos', 0, 'Anonimo'),
(282, '2015-08-11 18:44:30', '127.0.0.1', 135, 'servicios/Belleza/Todos', 0, 'Anonimo'),
(283, '2015-08-11 22:22:24', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 0, 'Anonimo'),
(284, '2015-08-11 22:22:38', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 0, 'Anonimo'),
(285, '2015-08-11 22:25:12', '127.0.0.1', 135, 'servicios/Belleza/Todos', 0, 'Anonimo'),
(286, '2015-08-11 22:30:03', '127.0.0.1', 135, 'servicios/Belleza/Todos', 0, 'Anonimo'),
(287, '2015-08-11 22:30:58', '127.0.0.1', 135, 'servicios/Belleza/Todos', 0, 'Anonimo'),
(288, '2015-08-12 02:54:34', '127.0.0.1', 135, 'servicios/Belleza/Todos', 0, 'Anonimo'),
(289, '2015-08-12 02:54:56', '127.0.0.1', 135, 'servicios/Belleza/Todos', 0, 'Anonimo'),
(290, '2015-08-12 02:56:26', '127.0.0.1', 135, 'servicios/Belleza/Todos', 0, 'Anonimo'),
(291, '2015-08-12 02:56:47', '127.0.0.1', 135, 'servicios/Belleza/Todos', 0, 'Anonimo'),
(292, '2015-08-12 02:57:00', '127.0.0.1', 135, 'servicios/Belleza/Todos', 0, 'Anonimo'),
(293, '2015-08-12 02:57:38', '127.0.0.1', 135, 'servicios/Belleza/Todos', 0, 'Anonimo'),
(294, '2015-08-12 02:57:50', '127.0.0.1', 135, 'servicios/Belleza/Todos', 0, 'Anonimo'),
(295, '2015-08-12 03:21:06', '127.0.0.1', 0, 'servicios/Belleza/Todos', 0, 'Anonimo'),
(296, '2015-08-12 03:21:18', '127.0.0.1', 0, 'servicios/Belleza/Todos/Presencial y Online', 0, 'Anonimo'),
(297, '2015-08-12 03:21:24', '127.0.0.1', 0, 'servicios/Belleza/Todos', 0, 'Anonimo'),
(298, '2015-08-12 03:21:54', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos/1', 0, 'Anonimo'),
(299, '2015-08-12 03:22:44', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos/1', 0, 'Anonimo'),
(300, '2015-08-12 03:41:54', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos/1', 0, 'Anonimo'),
(301, '2015-08-12 03:42:55', '127.0.0.1', 0, 'servicios/Belleza/Todos', 0, 'Anonimo'),
(302, '2015-08-12 03:57:42', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos/1', 0, 'Anonimo'),
(303, '2015-08-12 17:33:36', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos/1', 0, 'Anonimo'),
(304, '2015-08-12 17:55:04', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos/1', 0, 'Anonimo'),
(305, '2015-08-12 18:51:31', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos/1', 0, 'Anonimo'),
(306, '2015-08-12 18:52:02', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos/1', 0, 'Anonimo'),
(307, '2015-08-12 18:52:57', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos/1', 0, 'Anonimo'),
(308, '2015-08-12 18:59:52', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos/1', 0, 'Anonimo'),
(309, '2015-08-12 19:04:20', '127.0.0.1', 0, 'servicios/Belleza/CosmetologÃ­a/', 0, 'Anonimo'),
(310, '2015-08-12 19:04:22', '127.0.0.1', 0, 'servicios/Belleza/DepilaciÃ³n/', 0, 'Anonimo'),
(311, '2015-08-12 19:06:28', '127.0.0.1', 0, 'servicios/Belleza/DepilaciÃ³n/', 0, 'Anonimo'),
(312, '2015-08-12 19:06:39', '127.0.0.1', 0, 'servicios/Belleza/DepilaciÃ³n/Solo Presencial', 0, 'Anonimo'),
(313, '2015-08-12 19:28:05', '127.0.0.1', 0, 'servicios/Belleza/DepilaciÃ³n/Solo Presencial', 0, 'Anonimo'),
(314, '2015-08-12 19:28:19', '127.0.0.1', 0, 'servicios/Belleza/DepilaciÃ³n/Todos', 0, 'Anonimo'),
(315, '2015-08-12 19:28:22', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos', 0, 'Anonimo'),
(316, '2015-08-12 19:28:29', '127.0.0.1', 0, 'servicios/Belleza/Todos/Solo Online', 0, 'Anonimo'),
(317, '2015-08-12 19:28:31', '127.0.0.1', 0, 'servicios/Belleza/Otros/Solo Online', 0, 'Anonimo'),
(318, '2015-08-12 20:40:51', '127.0.0.1', 0, 'servicios/Belleza/Otros/Solo Online', 0, 'Anonimo'),
(319, '2015-08-13 00:03:15', '127.0.0.1', 0, 'servicios/Belleza/Todos/Solo Online', 0, 'Anonimo'),
(320, '2015-08-13 00:03:17', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos', 0, 'Anonimo'),
(321, '2015-08-13 00:03:23', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos/1', 0, 'Anonimo'),
(322, '2015-08-13 20:15:09', '127.0.0.1', 9, '', 0, 'Anonimo'),
(323, '2015-08-13 21:06:53', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos/1', 0, 'Anonimo'),
(324, '2015-08-14 20:49:32', '127.0.0.1', 9, '', 0, 'Anonimo'),
(325, '2015-08-14 21:04:30', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(326, '2015-08-14 21:04:43', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(327, '2015-08-14 23:08:11', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(328, '2015-08-14 23:56:26', '127.0.0.1', 82, 'administracion/servicios', 1, '18.293.138-1'),
(329, '2015-08-14 23:56:30', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(330, '2015-08-14 23:58:39', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(331, '2015-08-16 21:30:24', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(332, '2015-08-17 00:34:31', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(333, '2015-08-17 16:12:06', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(334, '2015-08-17 16:21:33', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(335, '2015-08-17 16:25:58', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(336, '2015-08-17 16:27:57', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(337, '2015-08-17 16:30:51', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(338, '2015-08-17 17:11:02', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(339, '2015-08-17 18:59:24', '127.0.0.1', 82, 'administracion/servicios', 1, '18.293.138-1'),
(340, '2015-08-17 18:59:36', '127.0.0.1', 83, 'administracion/servicios/agregar', 1, '18.293.138-1'),
(341, '2015-08-17 19:34:10', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(342, '2015-08-17 19:34:17', '127.0.0.1', 0, 'servicios/Fiestas y Eventos/Todos/Todos', 1, '18.293.138-1'),
(343, '2015-08-17 19:34:21', '127.0.0.1', 0, 'servicios/Fiestas y Eventos/AmbientaciÃ³n y DecoraciÃ³n/Todos', 1, '18.293.138-1'),
(344, '2015-08-17 19:34:25', '127.0.0.1', 0, 'servicios/Fiestas y Eventos/Arriendo de Disfraces/Todos', 1, '18.293.138-1'),
(345, '2015-08-17 19:34:29', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(346, '2015-08-17 19:50:32', '127.0.0.1', 17, 'administracion', 1, '18.293.138-1'),
(347, '2015-08-17 19:50:37', '127.0.0.1', 85, 'administracion/multimedia', 1, '18.293.138-1'),
(348, '2015-08-17 19:50:41', '127.0.0.1', 86, 'administracion/multimedia/agregar', 1, '18.293.138-1'),
(349, '2015-08-18 18:32:24', '127.0.0.1', 9, '', 0, 'Anonimo'),
(350, '2015-08-18 18:32:37', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(351, '2015-08-18 18:32:49', '127.0.0.1', 9, '', 3, '18.293.138-3'),
(352, '2015-08-18 18:33:08', '127.0.0.1', 15, 'administracion', 3, '18.293.138-3'),
(353, '2015-08-18 18:45:36', '127.0.0.1', 24, 'administracion/seguridad/permiso', 3, '18.293.138-3'),
(354, '2015-08-18 19:36:27', '127.0.0.1', 9, '', 3, '18.293.138-3'),
(355, '2015-08-18 19:41:00', '127.0.0.1', 9, '', 3, '18.293.138-3'),
(356, '2015-08-18 19:41:28', '127.0.0.1', 9, '', 3, '18.293.138-3'),
(357, '2015-08-18 19:58:44', '127.0.0.1', 9, '', 3, '18.293.138-3'),
(358, '2015-08-18 20:00:43', '127.0.0.1', 9, '', 3, '18.293.138-3'),
(359, '2015-08-18 20:04:41', '127.0.0.1', 9, '', 3, '18.293.138-3'),
(360, '2015-08-18 20:05:41', '127.0.0.1', 9, '', 3, '18.293.138-3'),
(361, '2015-08-18 20:07:43', '127.0.0.1', 9, '', 3, '18.293.138-3'),
(362, '2015-08-18 20:09:05', '127.0.0.1', 9, '', 3, '18.293.138-3'),
(363, '2015-08-18 20:25:22', '127.0.0.1', 9, '', 3, '18.293.138-3'),
(364, '2015-08-18 20:26:42', '127.0.0.1', 9, '', 3, '18.293.138-3'),
(365, '2015-08-19 18:59:49', '127.0.0.1', 9, '', 0, 'Anonimo'),
(366, '2015-08-19 19:04:40', '127.0.0.1', 9, '', 0, 'Anonimo'),
(367, '2015-08-19 19:05:46', '127.0.0.1', 9, '', 0, 'Anonimo'),
(368, '2015-08-19 19:33:31', '127.0.0.1', 9, '', 0, 'Anonimo'),
(369, '2015-08-19 19:34:18', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(370, '2015-08-19 19:34:29', '127.0.0.1', 9, '', 3, '18.293.138-3'),
(371, '2015-08-19 19:35:18', '127.0.0.1', 15, 'administracion', 3, '18.293.138-3'),
(372, '2015-08-19 19:36:02', '127.0.0.1', 116, 'administracion/Repertorio/menu', 3, '18.293.138-3'),
(373, '2015-08-19 19:36:10', '127.0.0.1', 118, 'Array', 3, '18.293.138-3'),
(374, '2015-08-19 19:37:11', '127.0.0.1', 118, 'Array', 3, '18.293.138-3'),
(375, '2015-08-19 19:37:42', '127.0.0.1', 118, 'Array', 3, '18.293.138-3'),
(376, '2015-08-19 19:37:58', '127.0.0.1', 118, 'Array', 3, '18.293.138-3'),
(377, '2015-08-19 19:38:11', '127.0.0.1', 118, 'Array', 3, '18.293.138-3'),
(378, '2015-08-19 19:38:51', '127.0.0.1', 118, 'Array', 3, '18.293.138-3'),
(379, '2015-08-19 19:39:20', '127.0.0.1', 118, 'Array', 3, '18.293.138-3'),
(380, '2015-08-19 19:39:29', '127.0.0.1', 46, 'administracion/posicionamiento/comunas', 3, '18.293.138-3'),
(381, '2015-08-19 19:39:58', '127.0.0.1', 2, 'administracion/contenido/pagina', 3, '18.293.138-3'),
(382, '2015-08-19 19:40:39', '127.0.0.1', 38, 'Array', 3, '18.293.138-3'),
(383, '2015-08-19 19:40:49', '127.0.0.1', 2, 'administracion/contenido/pagina', 3, '18.293.138-3'),
(384, '2015-08-19 19:41:00', '127.0.0.1', 38, 'Array', 3, '18.293.138-3'),
(385, '2015-08-19 19:43:53', '127.0.0.1', 38, 'Array', 3, '18.293.138-3'),
(386, '2015-08-19 19:45:51', '127.0.0.1', 38, 'Array', 3, '18.293.138-3'),
(387, '2015-08-19 19:48:01', '127.0.0.1', 2, 'administracion/contenido/pagina', 3, '18.293.138-3'),
(388, '2015-08-19 19:48:04', '127.0.0.1', 27, 'administracion/contenido/pagina/agregar', 3, '18.293.138-3'),
(389, '2015-08-19 20:13:01', '127.0.0.1', 27, 'administracion/contenido/pagina/agregar', 3, '18.293.138-3'),
(390, '2015-08-19 20:14:33', '127.0.0.1', 27, 'administracion/contenido/pagina/agregar', 3, '18.293.138-3'),
(391, '2015-08-19 20:16:36', '127.0.0.1', 27, 'administracion/contenido/pagina/agregar', 3, '18.293.138-3'),
(392, '2015-08-19 20:21:27', '127.0.0.1', 27, 'administracion/contenido/pagina/agregar', 3, '18.293.138-3'),
(393, '2015-08-19 20:22:25', '127.0.0.1', 27, 'administracion/contenido/pagina/agregar', 3, '18.293.138-3'),
(394, '2015-08-19 21:45:04', '127.0.0.1', 2, 'administracion/contenido/pagina', 3, '18.293.138-3'),
(395, '2015-08-19 21:45:19', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(396, '2015-08-19 21:47:52', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(397, '2015-08-19 21:48:59', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(398, '2015-08-19 21:50:03', '127.0.0.1', 105, 'administracion/multimedia/agregar', 3, '18.293.138-3'),
(399, '2015-08-19 21:51:04', '127.0.0.1', 105, 'administracion/multimedia/agregar', 3, '18.293.138-3'),
(400, '2015-08-19 21:51:46', '127.0.0.1', 105, 'administracion/multimedia/agregar', 3, '18.293.138-3'),
(401, '2015-08-19 21:57:58', '127.0.0.1', 105, 'administracion/multimedia/agregar', 3, '18.293.138-3'),
(402, '2015-08-19 21:58:20', '127.0.0.1', 105, 'administracion/multimedia/agregar', 3, '18.293.138-3'),
(403, '2015-08-19 21:58:44', '127.0.0.1', 105, 'administracion/multimedia/agregar', 3, '18.293.138-3'),
(404, '2015-08-19 22:00:35', '127.0.0.1', 105, 'administracion/multimedia/agregar', 3, '18.293.138-3'),
(405, '2015-08-19 22:08:22', '127.0.0.1', 105, 'administracion/multimedia/agregar', 3, '18.293.138-3'),
(406, '2015-08-19 22:08:56', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(407, '2015-08-19 22:11:27', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(408, '2015-08-19 22:12:35', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(409, '2015-08-19 22:13:21', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(410, '2015-08-19 22:13:46', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(411, '2015-08-19 22:14:00', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(412, '2015-08-19 22:15:23', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(413, '2015-08-19 22:16:07', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(414, '2015-08-19 22:16:57', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(415, '2015-08-19 22:18:29', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(416, '2015-08-19 22:18:37', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(417, '2015-08-19 22:19:00', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(418, '2015-08-19 22:20:21', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(419, '2015-08-19 22:21:30', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(420, '2015-08-19 22:21:56', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(421, '2015-08-19 22:22:42', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(422, '2015-08-19 22:23:03', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(423, '2015-08-19 22:23:24', '127.0.0.1', 106, 'administracion/multimedia/modificar', 3, '18.293.138-3'),
(424, '2015-08-19 22:30:53', '127.0.0.1', 106, 'administracion/multimedia/modificar', 3, '18.293.138-3'),
(425, '2015-08-19 22:31:44', '127.0.0.1', 106, 'administracion/multimedia/modificar', 3, '18.293.138-3'),
(426, '2015-08-19 22:32:18', '127.0.0.1', 106, 'administracion/multimedia/modificar', 3, '18.293.138-3'),
(427, '2015-08-19 22:32:51', '127.0.0.1', 106, 'administracion/multimedia/modificar', 3, '18.293.138-3'),
(428, '2015-08-19 22:40:41', '127.0.0.1', 106, 'administracion/multimedia/modificar', 3, '18.293.138-3'),
(429, '2015-08-19 22:41:12', '127.0.0.1', 106, 'administracion/multimedia/modificar', 3, '18.293.138-3'),
(430, '2015-08-19 22:42:47', '127.0.0.1', 106, 'administracion/multimedia/modificar', 3, '18.293.138-3'),
(431, '2015-08-19 22:46:24', '127.0.0.1', 51, 'administracion/contenido/multimedia', 3, '18.293.138-3'),
(432, '2015-08-20 19:10:07', '127.0.0.1', 9, '', 0, 'Anonimo'),
(433, '2015-08-20 19:10:41', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(434, '2015-08-20 19:14:44', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(435, '2015-08-20 19:18:58', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(436, '2015-08-20 19:19:16', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(437, '2015-08-20 19:28:03', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(438, '2015-08-21 18:24:57', '127.0.0.1', 9, '', 0, 'Anonimo'),
(439, '2015-08-21 18:26:13', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(440, '2015-08-21 18:26:52', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos', 0, 'Anonimo'),
(441, '2015-08-21 19:40:50', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(442, '2015-08-21 19:41:03', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(443, '2015-08-21 19:41:09', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos', 1, '18.293.138-1'),
(444, '2015-08-21 19:43:27', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(445, '2015-08-21 19:44:58', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(446, '2015-08-21 21:00:29', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos', 1, '18.293.138-1'),
(447, '2015-08-21 21:00:31', '127.0.0.1', 9, '', 1, '18.293.138-1'),
(448, '2015-08-21 21:00:36', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos', 1, '18.293.138-1'),
(449, '2015-08-21 21:02:06', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(450, '2015-08-21 21:02:25', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(451, '2015-08-21 21:02:50', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(452, '2015-08-21 21:03:59', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos', 1, '18.293.138-1'),
(453, '2015-08-21 21:05:17', '127.0.0.1', 0, 'servicios/Belleza/Todos/Todos', 1, '18.293.138-1'),
(454, '2015-08-21 21:05:29', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(455, '2015-08-21 21:09:46', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(456, '2015-08-22 00:21:56', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(457, '2015-08-22 00:22:45', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(458, '2015-08-22 00:24:45', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(459, '2015-08-22 00:25:20', '127.0.0.1', 136, 'detalle/hola empresa/hola servicio', 1, '18.293.138-1'),
(460, '2015-08-24 18:29:10', '127.0.0.1', 9, '', 0, 'Anonimo'),
(461, '2015-08-24 18:34:05', '127.0.0.1', 3, 'registrar', 0, 'Anonimo'),
(462, '2015-08-24 18:37:36', '127.0.0.1', 3, 'registrar', 0, 'Anonimo'),
(463, '2015-08-24 19:04:50', '127.0.0.1', 9, '', 0, 'Anonimo'),
(464, '2015-08-24 19:08:59', '127.0.0.1', 142, 'preguntas_frecuentes', 0, 'Anonimo'),
(465, '2015-08-24 19:10:25', '127.0.0.1', 142, 'preguntas_frecuentes', 0, 'Anonimo'),
(466, '2015-08-24 19:17:20', '127.0.0.1', 142, 'preguntas_frecuentes', 0, 'Anonimo'),
(467, '2015-08-24 19:18:12', '127.0.0.1', 140, 'sobre_nosotros', 0, 'Anonimo'),
(468, '2015-08-24 19:19:09', '127.0.0.1', 140, 'sobre_nosotros', 0, 'Anonimo'),
(469, '2015-08-24 19:19:20', '127.0.0.1', 140, 'sobre_nosotros', 0, 'Anonimo'),
(470, '2015-08-24 19:22:01', '127.0.0.1', 140, 'sobre_nosotros', 0, 'Anonimo'),
(471, '2015-08-24 19:22:24', '127.0.0.1', 140, 'sobre_nosotros', 0, 'Anonimo'),
(472, '2015-08-24 19:23:25', '127.0.0.1', 140, 'sobre_nosotros', 0, 'Anonimo'),
(473, '2015-08-24 19:23:46', '127.0.0.1', 140, 'sobre_nosotros', 0, 'Anonimo'),
(474, '2015-08-24 19:26:32', '127.0.0.1', 140, 'sobre_nosotros', 0, 'Anonimo'),
(475, '2015-08-24 19:26:59', '127.0.0.1', 140, 'sobre_nosotros', 0, 'Anonimo'),
(476, '2015-08-24 19:27:29', '127.0.0.1', 140, 'sobre_nosotros', 0, 'Anonimo'),
(477, '2015-08-24 19:36:30', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(478, '2015-08-24 19:36:42', '127.0.0.1', 9, '', 3, '18.293.138-3'),
(479, '2015-08-24 19:36:50', '127.0.0.1', 15, 'administracion', 3, '18.293.138-3'),
(480, '2015-08-24 19:37:00', '127.0.0.1', 24, 'administracion/seguridad/permiso', 3, '18.293.138-3'),
(481, '2015-08-24 20:43:24', '127.0.0.1', 24, 'administracion/seguridad/permiso', 3, '18.293.138-3'),
(482, '2015-08-24 20:45:30', '127.0.0.1', 24, 'administracion/seguridad/permiso', 3, '18.293.138-3'),
(483, '2015-08-25 19:09:38', '127.0.0.1', 9, '', 0, 'Anonimo'),
(484, '2015-08-25 19:09:45', '127.0.0.1', 9, '', 0, 'Anonimo'),
(485, '2015-08-25 19:17:47', '127.0.0.1', 3, 'registrar', 0, 'Anonimo'),
(486, '2015-08-25 19:46:48', '127.0.0.1', 3, 'registrar', 0, 'Anonimo'),
(487, '2015-08-25 20:03:10', '127.0.0.1', 2, 'identificarse', 0, 'Anonimo'),
(488, '2015-08-25 20:03:19', '127.0.0.1', 9, '', 3, '18.293.138-3'),
(489, '2015-08-25 20:03:22', '127.0.0.1', 15, 'administracion', 3, '18.293.138-3'),
(490, '2015-08-25 20:03:28', '127.0.0.1', 24, 'administracion/seguridad/permiso', 3, '18.293.138-3'),
(491, '2015-08-25 20:04:21', '127.0.0.1', 150, 'politicas_de_privacidad', 3, '18.293.138-3'),
(492, '2015-08-25 20:05:13', '127.0.0.1', 150, 'politicas_de_privacidad', 3, '18.293.138-3'),
(493, '2015-08-25 20:05:24', '127.0.0.1', 149, 'ayuda', 3, '18.293.138-3'),
(494, '2015-08-25 20:05:31', '127.0.0.1', 154, 'tutoriales', 3, '18.293.138-3'),
(495, '2015-08-25 20:05:39', '127.0.0.1', 152, 'subscripciones', 3, '18.293.138-3'),
(496, '2015-08-25 20:05:47', '127.0.0.1', 156, 'comprar', 3, '18.293.138-3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE IF NOT EXISTS `media` (
`id_med` int(11) NOT NULL,
  `id_ent` int(11) DEFAULT NULL,
  `id_tm` int(11) DEFAULT NULL,
  `nom_med` varchar(255) DEFAULT NULL,
  `url_med` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `media`
--

INSERT INTO `media` (`id_med`, `id_ent`, `id_tm`, `nom_med`, `url_med`, `size`) VALUES
(3, 5, 1, 'hola media modificado', 'url media', NULL),
(4, 5, 4, 'imagen', 'http://vignette4.wikia.nocookie.net/fantasy-life/images/c/c2/Castele.png', NULL),
(5, 5, 3, 'png', 'http://www.baka-tsuki.org/project/images/2/23/Mushoku3_01.jpg', NULL),
(6, 5, 4, 'asd', 'http://cdn.animeflv.net/img/mini/1897.jpg', NULL),
(7, 5, 4, 'fdg', 'http://cdn.animeflv.net/img/mini/1838.jpg', NULL),
(8, 5, 4, 'Epic clase de just dance 2', 'http://lkimg.zamimg.com/images/v2/champions/icons/size64x64/157.png;;', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE IF NOT EXISTS `mensajes` (
`id_men` int(11) NOT NULL,
  `id_con` int(11) DEFAULT NULL,
  `fecha_men` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emisor` varchar(255) DEFAULT NULL,
  `mensaje` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_men`, `id_con`, `fecha_men`, `emisor`, `mensaje`) VALUES
(1, 14, '2014-10-29 20:04:42', '18.293.138-3', 'hola test'),
(2, 16, '2015-03-20 16:04:10', '18.293.138-1', 'test desde db'),
(3, 16, '2015-07-08 20:31:34', '18.293.138-1', 'test desde web 1'),
(4, 16, '2015-07-09 20:49:26', '18.293.138-1', 'test desde chat'),
(5, 16, '2015-07-11 00:58:41', '18.293.138-1', 'test 2 desde chat'),
(6, 16, '2015-07-11 00:58:56', '18.293.138-1', 'test 2 desde chat'),
(7, 16, '2015-07-13 18:49:01', '18.293.138-1', 'test 3 desde chat'),
(8, 16, '2015-07-13 19:15:45', '18.293.138-1', 'test 4'),
(9, 16, '2015-07-14 18:07:14', '18.293.138-1', 'asdf'),
(10, 16, '2015-07-22 20:19:07', '18.293.138-1', 'test4'),
(11, 16, '2015-07-22 20:19:59', '18.293.138-1', 'test5'),
(12, 16, '2015-07-24 16:50:15', '18.293.138-1', 'test6'),
(13, 16, '2015-07-24 16:51:01', '18.293.138-1', 'wtf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`id_menu` int(11) NOT NULL,
  `nom_menu` varchar(255) DEFAULT NULL,
  `desc_menu` varchar(255) DEFAULT 'custom menu',
  `id_tu` int(11) NOT NULL
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
-- Estructura de tabla para la tabla `pagina`
--

CREATE TABLE IF NOT EXISTS `pagina` (
`id_pag` int(11) NOT NULL,
  `id_tp` int(11) DEFAULT NULL,
  `nom_pag` varchar(255) DEFAULT NULL,
  `url_pag` varchar(255) DEFAULT NULL,
  `url_real` varchar(255) NOT NULL,
  `desc_pag` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=159 ;

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
(27, 3, 'Agregar Pagina', 'administracion/contenido/pagina/agregar', 'includes/paginas/panelAdministracion/Contenido/agregarPagina.php', ''),
(29, 3, 'Agregar Tipo de multimedia', 'administracion/contenido/tipomultimedia/agregar', 'includes/paginas/panelAdministracion/Contenido/agregarTipomedia.php', ''),
(30, 3, 'Agregar Tipo de pagina', 'administracion/contenido/tipopagina/agregar', 'includes/paginas/panelAdministracion/Contenido/agregarTipopagina.php', ''),
(32, 5, 'Paginas', 'administracion/contenido/pagina', 'includes/paginas/panelAdministracion/Contenido/listarPaginas.php', ''),
(34, 5, 'Tipo de multimedia', 'administracion/contenido/tipomultimedia', 'includes/paginas/panelAdministracion/Contenido/listarTipomedia.php', ''),
(35, 5, 'Tipo de pagina', 'administracion/contenido/tipopagina', 'includes/paginas/panelAdministracion/Contenido/listarTipopagina.php', ''),
(36, 3, 'Modificar Tipo de usuario', 'administracion/seguridad/tipousuario/modificar', 'includes/paginas/panelAdministracion/Seguridad/modificarTipousuario.php', ''),
(37, 1, 'registrarse-paso2', 'registrarse-paso2', 'includes/paginas/registrarpaso2.php', ''),
(38, 5, 'Modificar Pagina', 'administracion/contenido/pagina/modificar', 'includes/paginas/panelAdministracion/Contenido/modificarPaginas.php', ''),
(39, 2, 'registrarse-paso2', 'registrarse-paso2/Empresa', 'includes/paginas/registrarpaso2Entidad.php', ''),
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
(69, 5, 'Modificar Pagina', 'administracion/contenido/pagina/modificar', 'includes/paginas/panelAdministracion/Contenido/modificarPaginas.php', ''),
(71, 5, 'Modificar Tipo Multimedia', 'administracion/contenido/tipomultimedia/modificar', 'includes/paginas/panelAdministracion/Contenido/modificarTipomedia.php', ''),
(72, 5, 'Modificar Tipo Pagina', 'administracion/contenido/tipopagina/modificar', 'includes/paginas/panelAdministracion/Contenido/modificarTipopagina.php', ''),
(73, 9, 'Agregar Categorias', 'administracion/Repertorio/categorias/agregar', 'includes/paginas/panelAdministracion/Repertorio/agregarCategorias.php', 'Pagina de administracion'),
(74, 9, 'Agregar Servicio', 'administracion/Repertorio/servicios/agregar', 'includes/paginas/panelAdministracion/Repertorio/agregarServicios.php', 'Pagina de moderador'),
(75, 9, 'Agregar Subcategoria', 'administracion/Repertorio/subcategorias/agregar', 'includes/paginas/panelAdministracion/Repertorio/agregarSubcategorias.php', 'Pagina de administracion'),
(76, 9, 'Agregar Tipo Servicio', 'administracion/Repertorio/tiposervicios/agregar', 'includes/paginas/panelAdministracion/Repertorio/agregarTiposervicio.php', 'Pagina de administracion'),
(77, 9, 'Agregar Usuario', 'administracion/seguridad/usuario/agregar', 'includes/paginas/panelAdministracion/Repertorio/agregarUsuario.php', 'Pagina de administracion'),
(79, 5, 'Modificar Pagina', 'administracion/contenido/pagina/modificar', 'includes/paginas/panelAdministracion/Contenido/modificarPaginas.php', 'modificar pagina'),
(81, 5, 'Listar Multimedia', 'administracion/servicios/listarServicio/multimedia', 'includes/paginas/panelUsuario/Contenidos/listarMultimedia.php', 'pagina de usuario'),
(82, 9, 'Listar Servicios', 'administracion/servicios', 'includes/paginas/panelUsuario/Repertorio/listarServicios.php', 'pagina de usuario'),
(83, 9, 'Agregar Servicio', 'administracion/servicios/agregar', 'includes/paginas/panelUsuario/Repertorio/agregarServicios.php', 'pagina de usuario'),
(84, 9, 'Modificar Servicio', 'administracion/servicios/modificar', 'includes/paginas/panelUsuario/Repertorio/modificarServicios.php', 'pagina de usuario'),
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
(142, 1, 'preguntas_frecuentes', 'preguntas_frecuentes', 'includes/paginas/preguntasfrecuentes.php', 'pagina publica'),
(143, 1, 'detalle empresa', 'detalle/entidad', 'includes/paginas/entidadDetalle.php', 'pagina publica'),
(144, 12, 'Hojas de Codigo', 'administracion/Sitios/Codigo', 'includes/paginas/panelAdministracion/Sitios/listarCodigo.php', 'pagina de administracion'),
(145, 12, 'Tipo de Codigo', 'administracion/Sitios/TipoCodigo', 'includes/paginas/panelAdministracion/Sitios/listarTipoCod.php', 'pagina de administracion'),
(146, 12, 'Funcion de Codigo', 'administracion/Sitios/FuncionCodigo', 'includes/paginas/panelAdministracion/Sitios/listarFuncionCod.php', 'pagina de administracion'),
(147, 12, 'agregar Hoja de codigo', 'administracion/Sitios/Codigo/agregar', 'includes/paginas/panelAdministracion/Sitios/agregarCodigo.php', 'pagina de administracion'),
(148, 12, 'Paginas de Empresas', 'administracion/Sitios/Paginas', 'includes/paginas/panelAdministracion/Sitios/listarPagEnt.php', 'Listar paginas de el sitio de empresa'),
(149, 1, 'Ayuda', 'ayuda', 'includes/paginas/contacto.php', 'pagina publica'),
(150, 1, 'politicas de privacidad', 'politicas_de_privacidad', 'includes/paginas/politicas_de_privacidad.php', 'pagina publica'),
(151, 1, 'relaciones con los usuarios', 'relaciones', 'includes/paginas/relaciones.php', 'pagina publica'),
(152, 1, 'subscripciones', 'subscripciones', 'includes/paginas/subscripciones.php', 'pagina publica'),
(153, 1, 'multimedia', 'multimedia', 'includes/paginas/multimedia.php', 'pagina publica'),
(154, 1, 'tutoriales', 'tutoriales', 'includes/paginas/tutoriales.php', 'pagina publica'),
(155, 1, 'desarrolladores', 'desarrolladores', 'includes/paginas/desarrolladores.php', 'pagina publica'),
(156, 1, 'contratacion', 'contratacion', 'includes/paginas/contratacion.php', 'pagina publica'),
(157, 1, 'publicacion', 'publicacion', 'includes/paginas/publicacion.php', 'pagina publica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
`id_pais` int(11) NOT NULL,
  `nom_pais` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id_pais`, `nom_pais`) VALUES
(1, 'Chile');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `id_pag` int(11) NOT NULL,
  `id_tu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_pag`, `id_tu`) VALUES
(2, 0),
(3, 0),
(9, 0),
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
(149, 0),
(150, 0),
(151, 0),
(152, 0),
(153, 0),
(154, 0),
(155, 0),
(156, 0),
(157, 0),
(9, 1),
(16, 1),
(17, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
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
(143, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(154, 1),
(155, 1),
(156, 1),
(157, 1),
(9, 3),
(10, 3),
(11, 3),
(15, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(27, 3),
(29, 3),
(30, 3),
(32, 3),
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
(69, 3),
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
(142, 3),
(143, 3),
(144, 3),
(145, 3),
(146, 3),
(147, 3),
(148, 3),
(149, 3),
(150, 3),
(151, 3),
(152, 3),
(153, 3),
(154, 3),
(155, 3),
(156, 3),
(157, 3);

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
  `contrasena` varchar(255) DEFAULT NULL
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
  `rut` varchar(255) NOT NULL
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
`id_plan` int(11) NOT NULL,
  `nom_plan` varchar(255) NOT NULL,
  `valor_plan` int(11) NOT NULL,
  `id_est` int(11) NOT NULL,
  `dias` int(11) NOT NULL
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
`id_prov` int(11) NOT NULL,
  `nom_prov` varchar(255) DEFAULT NULL,
  `id_reg` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id_prov`, `nom_prov`, `id_reg`) VALUES
(1, 'Santiago', 1),
(2, 'Arica', 2),
(3, 'Parinacota', 2),
(4, 'Iquique', 3),
(5, 'Tamarugal', 3),
(6, 'Antofagasta', 4),
(7, 'El Loa', 4),
(8, 'Tocopilla', 4),
(9, 'Copiapó', 5),
(10, 'Chañaral', 5),
(11, 'Huasco', 5),
(12, 'Elqui', 6),
(13, 'Choapa', 6),
(14, 'Limarí', 6),
(15, 'Valparaíso', 7),
(16, 'Isla de Pascua', 7),
(17, 'Los Andes', 7),
(18, 'Petorca', 7),
(19, 'Quillota', 7),
(20, 'San Antonio', 7),
(21, 'San Felipe de Aconcagua', 7),
(22, 'Marga Marga', 7),
(23, 'Cachapoal', 8),
(24, 'Cardenal Caro', 8),
(25, 'Colchagua', 8),
(26, 'Talca', 9),
(27, 'Cauquenes', 9),
(28, 'Curicó', 9),
(29, 'Linares', 9),
(30, 'Concepción', 10),
(31, 'Arauco', 10),
(32, 'Biobío', 10),
(33, 'Ñuble', 10),
(34, 'Cautín', 11),
(35, 'Malleco', 11),
(36, 'Valdivia', 12),
(37, 'Ranco', 12),
(38, 'Llanquihue', 13),
(39, 'Chiloé', 13),
(40, 'Osorno', 13),
(41, 'Palena', 13),
(42, 'Coihaique', 14),
(43, 'Aisén', 14),
(44, 'Capitán Prat', 14),
(45, 'General Carrera', 14),
(46, 'Magallanes', 15),
(47, 'Antártica Chilena', 15),
(48, 'Antártica Chilena', 15),
(49, 'Ultima Esperanza', 15),
(50, 'CORDILLERA', 1),
(51, 'Chacabuco', 1),
(52, 'Maipo', 1),
(53, 'Melipilla', 1),
(54, 'Talagante', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE IF NOT EXISTS `region` (
`id_reg` int(11) NOT NULL,
  `nom_reg` varchar(255) DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`id_reg`, `nom_reg`, `id_pais`) VALUES
(1, 'REGIÓN METROPOLITANA DE SANTIAGO', 1),
(2, 'ARICA Y PARINACOTA', 1),
(3, 'TARAPACÁ', 1),
(4, 'ANTOFAGASTA', 1),
(5, 'ATACAMA', 1),
(6, 'COQUIMBO', 1),
(7, 'VALPARAÍSO', 1),
(8, 'DEL LIBERTADOR GRAL. BERNARDO O''HIGGINS', 1),
(9, 'DEL MAULE', 1),
(10, 'DEL BIOBÍO', 1),
(11, 'DE LA ARAUCANÍA', 1),
(12, 'DE LOS RÍOS', 1),
(13, 'DE LOS LAGOS', 1),
(14, 'AISÉN DEL GRAL. CARLOS IBAÑEZ DEL CAMPO', 1),
(15, 'MAGALLANES Y DE LA ANTÁRTICA CHILENA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servcon`
--

CREATE TABLE IF NOT EXISTS `servcon` (
  `id_con` int(11) NOT NULL,
  `id_serv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servcon`
--

INSERT INTO `servcon` (`id_con`, `id_serv`) VALUES
(14, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(18, 2),
(19, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE IF NOT EXISTS `servicio` (
`id_serv` int(11) NOT NULL,
  `id_scat` int(11) DEFAULT NULL,
  `id_ent` int(11) DEFAULT NULL,
  `id_est` int(11) DEFAULT NULL,
  `nom_serv` varchar(255) DEFAULT NULL,
  `desc_serv` text,
  `seo_serv` varchar(255) DEFAULT NULL,
  `id_ts` int(11) DEFAULT NULL,
  `desc_img` int(11) DEFAULT NULL COMMENT 'vincula una imagen de multimedia a servicio',
  `puntaje` int(11) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_serv`, `id_scat`, `id_ent`, `id_est`, `nom_serv`, `desc_serv`, `seo_serv`, `id_ts`, `desc_img`, `puntaje`) VALUES
(1, 3, 5, 5, 'hola servicio', 'probando metodo', '', 2, 5, 0),
(2, 48, 8, 5, 'PÃ¡gina Web Para Pymes', 'Realizo pÃ¡ginas web para negocios locales en su fase de inicio o que aÃºn no tengan su sitio en la red:\r\n\r\n    DiseÃ±o simple, funcional, informativo y econÃ³mico basado en las herramientas de Wordpress.\r\n    Tiene correo propio (contacto@misitio.cl)\r\n    El sitio es autoadministrable.\r\n    El precio incluye dominio propio de nic chile (midominio.cl) y hosting.\r\n    El producto se entrega subido a la web.\r\n    Incluye correcciÃ³n ortogrÃ¡fica.', '', 3, 6, 0),
(3, 21, 5, 5, 'test', '%3Cdiv+class%3D%22ql-multi-cursor%22%3E%3C%2Fdiv%3E%3Cdiv+id%3D%22ql-editor-1%22+class%3D%22ql-editor%22+contenteditable%3D%22true%22%3E%3Cdiv%3Emodifico%3Cspan+style%3D%22background-color%3A+rgb%28255%2C+153%2C+0%29%3B%22%3E+su+auto+para%3C%2Fspan%3E%3Cb%3E%3Cspan+style%3D%22background-color%3A+rgb%28255%2C+153%2C+0%29%3B%22%3E+su+%3C%2Fspan%3Ematrionio+co%3C%2Fb%3En+los+mejor%3Ci%3Ees+gra%3C%2Fi%3Efitis%3C%2Fdiv%3E%3C%2Fdiv%3E%3Cdiv+style%3D%22left%3A+-10000px%3B%22+class%3D%22ql-tooltip+ql-link-tooltip%22%3E%3Cspan+class%3D%22title%22%3EVisit+URL%3A%C2%A0%3C%2Fspan%3E+%3Ca+href%3D%22%23%22+class%3D%22url%22+target%3D%22_blank%22%3E%3C%2Fa%3E+%3Cinput+class%3D%22input%22+type%3D%22text%22%3E+%3Cspan%3E%C2%A0-%C2%A0%3C%2Fspan%3E+%3Ca+href%3D%22javascript%3A%3B%22+class%3D%22change%22%3EChange%3C%2Fa%3E+%3Ca+href%3D%22javascript%3A%3B%22+class%3D%22remove%22%3ERemove%3C%2Fa%3E+%3Ca+href%3D%22javascript%3A%3B%22+class%3D%22done%22%3EDone%3C%2Fa%3E%3C%2Fdiv%3E%3Cdiv+class%3D%22ql-paste-manager%22+contenteditable%3D%22true%22%3E%3C%2Fdiv%3E', '', 3, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE IF NOT EXISTS `subcategoria` (
`id_scat` int(11) NOT NULL,
  `id_cat` int(11) DEFAULT NULL,
  `nom_scat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id_scat`, `id_cat`, `nom_scat`) VALUES
(3, 5, 'CosmetologÃ­a'),
(4, 5, 'DepilaciÃ³n'),
(5, 5, 'ManicurÃ­a y PedicurÃ­a'),
(6, 5, 'Maquillaje'),
(7, 5, 'PeluquerÃ­a'),
(8, 5, 'Spa'),
(9, 5, 'Otros'),
(10, 6, 'Apoyo Escolar'),
(11, 6, 'Apoyo Universitario'),
(12, 6, 'Bailes y Danzas'),
(13, 6, 'Deportes'),
(14, 6, 'Idiomas'),
(15, 6, 'InformÃ¡tica'),
(16, 6, 'Instrumentos Musicales'),
(17, 6, 'Otros'),
(18, 7, 'AmbientaciÃ³n y DecoraciÃ³n'),
(19, 7, 'Arriendo de Disfraces'),
(20, 7, 'Arriendo de Equipamiento'),
(21, 7, 'Autos para Matrimonio'),
(22, 7, 'Catering y Bebidas'),
(23, 7, 'Centro de eventos'),
(24, 7, 'DJ, Audio e IluminaciÃ³n'),
(25, 7, 'Entretenimiento'),
(26, 7, 'Fotos y Video'),
(27, 7, 'Otros'),
(28, 8, 'Reparacion'),
(29, 8, 'Mantenimiento'),
(30, 8, 'Otros'),
(31, 9, 'AlbaÃ±ilerÃ­a'),
(32, 9, 'CarpinterÃ­a'),
(33, 9, 'CerrajerÃ­a'),
(34, 9, 'Electricidad'),
(35, 9, 'Gas'),
(36, 9, 'HerrerÃ­a'),
(37, 9, 'JardinerÃ­a'),
(38, 9, 'Pintura'),
(39, 9, 'Piscinas'),
(40, 9, 'Pisos'),
(41, 9, 'PlomerÃ­a'),
(42, 9, 'TapicerÃ­a'),
(43, 9, 'Techados'),
(44, 9, 'Otros'),
(45, 11, 'Ingeniería'),
(46, 11, 'Salud'),
(47, 11, 'Diseño'),
(48, 11, 'Informatica'),
(49, 11, 'Consultorias y Asesorias'),
(50, 11, 'Derecho'),
(51, 11, 'Contabilidad'),
(52, 11, 'Traductores'),
(53, 11, 'Educacion'),
(54, 11, 'Comercio'),
(55, 11, 'Comunicacion'),
(56, 11, 'Administracion'),
(57, 11, 'Investifacion'),
(58, 11, 'Auditorias'),
(59, 11, 'Filosofia y Letras'),
(60, 11, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocal`
--

CREATE TABLE IF NOT EXISTS `tipocal` (
`id_tc` int(11) NOT NULL,
  `nom_tc` varchar(255) DEFAULT NULL,
  `desc_tc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

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
(9, 'Facturas a tiempo', 'La facturacion y notas de credito se realizan en tiempo y forma'),
(10, 'nuevapregunta', 'nuevapregunta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomedia`
--

CREATE TABLE IF NOT EXISTS `tipomedia` (
`id_tm` int(11) NOT NULL,
  `nom_tm` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tipomedia`
--

INSERT INTO `tipomedia` (`id_tm`, `nom_tm`) VALUES
(1, 'audio/mpeg'),
(2, 'video/mp4'),
(3, 'image/jpeg'),
(4, 'image/png'),
(5, 'video/youtube');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopagina`
--

CREATE TABLE IF NOT EXISTS `tipopagina` (
`id_tp` int(11) NOT NULL,
  `nom_tp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

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
(7, 'Localizacion'),
(8, 'Calificaciones'),
(9, 'Repertorio'),
(10, 'Perfil'),
(11, 'Subscriptores'),
(12, 'Sitios'),
(13, 'Apariencia'),
(14, 'Paginas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposervicio`
--

CREATE TABLE IF NOT EXISTS `tiposervicio` (
`id_ts` int(11) NOT NULL,
  `nom_ts` varchar(255) DEFAULT NULL
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
`id_tu` int(11) NOT NULL,
  `nom_tu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`id_tu`, `nom_tu`) VALUES
(0, 'Visitante'),
(1, 'Cliente'),
(3, 'Moderador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boleta`
--
ALTER TABLE `boleta`
 ADD PRIMARY KEY (`id_bol`), ADD KEY `id_est` (`id_est`), ADD KEY `id_ent` (`id_ent`);

--
-- Indices de la tabla `calificacionclie`
--
ALTER TABLE `calificacionclie`
 ADD PRIMARY KEY (`id_calc`), ADD KEY `id_con` (`id_con`), ADD KEY `id_ec` (`id_ec`), ADD KEY `id_tc` (`id_tc`);

--
-- Indices de la tabla `calificacionserv`
--
ALTER TABLE `calificacionserv`
 ADD PRIMARY KEY (`id_cals`), ADD KEY `calificacionserv_ibfk_1` (`id_con`,`id_serv`), ADD KEY `id_ec` (`id_ec`), ADD KEY `id_tc` (`id_tc`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
 ADD PRIMARY KEY (`id_cat`);

--
-- Indices de la tabla `cobertura`
--
ALTER TABLE `cobertura`
 ADD PRIMARY KEY (`id_com`,`id_serv`), ADD KEY `id_serv` (`id_serv`);

--
-- Indices de la tabla `comuna`
--
ALTER TABLE `comuna`
 ADD PRIMARY KEY (`id_com`), ADD KEY `id_prov` (`id_prov`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
 ADD PRIMARY KEY (`id_con`), ADD KEY `id_est` (`id_est`), ADD KEY `rut` (`rut`);

--
-- Indices de la tabla `entidad`
--
ALTER TABLE `entidad`
 ADD PRIMARY KEY (`id_ent`), ADD KEY `id_est` (`id_est`);

--
-- Indices de la tabla `escalacal`
--
ALTER TABLE `escalacal`
 ADD PRIMARY KEY (`id_ec`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
 ADD PRIMARY KEY (`id_est`);

--
-- Indices de la tabla `item`
--
ALTER TABLE `item`
 ADD PRIMARY KEY (`id_menu`,`id_pag`), ADD KEY `id_pag` (`id_pag`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
 ADD PRIMARY KEY (`id_log`);

--
-- Indices de la tabla `media`
--
ALTER TABLE `media`
 ADD PRIMARY KEY (`id_med`), ADD KEY `id_tm` (`id_tm`), ADD KEY `id_ent` (`id_ent`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
 ADD PRIMARY KEY (`id_men`), ADD KEY `id_con` (`id_con`), ADD KEY `emisor` (`emisor`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`id_menu`), ADD KEY `id_tu` (`id_tu`);

--
-- Indices de la tabla `pagina`
--
ALTER TABLE `pagina`
 ADD PRIMARY KEY (`id_pag`), ADD KEY `id_tp` (`id_tp`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
 ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
 ADD PRIMARY KEY (`id_pag`,`id_tu`), ADD KEY `id_tu` (`id_tu`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
 ADD PRIMARY KEY (`rut`), ADD KEY `id_tu` (`id_tu`), ADD KEY `id_com` (`id_com`), ADD KEY `id_est` (`id_est`);

--
-- Indices de la tabla `per_ent`
--
ALTER TABLE `per_ent`
 ADD PRIMARY KEY (`id_ent`,`rut`), ADD KEY `rut` (`rut`), ADD KEY `id_ent` (`id_ent`);

--
-- Indices de la tabla `plan`
--
ALTER TABLE `plan`
 ADD PRIMARY KEY (`id_plan`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
 ADD PRIMARY KEY (`id_prov`), ADD KEY `id_reg` (`id_reg`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
 ADD PRIMARY KEY (`id_reg`), ADD KEY `id_pais` (`id_pais`);

--
-- Indices de la tabla `servcon`
--
ALTER TABLE `servcon`
 ADD PRIMARY KEY (`id_con`,`id_serv`), ADD KEY `id_serv` (`id_serv`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
 ADD PRIMARY KEY (`id_serv`), ADD KEY `id_ent` (`id_ent`), ADD KEY `id_est` (`id_est`), ADD KEY `is_scat` (`id_scat`), ADD KEY `id_ts` (`id_ts`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
 ADD PRIMARY KEY (`id_scat`), ADD KEY `id_cat` (`id_cat`);

--
-- Indices de la tabla `tipocal`
--
ALTER TABLE `tipocal`
 ADD PRIMARY KEY (`id_tc`);

--
-- Indices de la tabla `tipomedia`
--
ALTER TABLE `tipomedia`
 ADD PRIMARY KEY (`id_tm`);

--
-- Indices de la tabla `tipopagina`
--
ALTER TABLE `tipopagina`
 ADD PRIMARY KEY (`id_tp`);

--
-- Indices de la tabla `tiposervicio`
--
ALTER TABLE `tiposervicio`
 ADD PRIMARY KEY (`id_ts`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
 ADD PRIMARY KEY (`id_tu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `boleta`
--
ALTER TABLE `boleta`
MODIFY `id_bol` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `calificacionclie`
--
ALTER TABLE `calificacionclie`
MODIFY `id_calc` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `calificacionserv`
--
ALTER TABLE `calificacionserv`
MODIFY `id_cals` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=349;
--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
MODIFY `id_con` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `entidad`
--
ALTER TABLE `entidad`
MODIFY `id_ent` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `escalacal`
--
ALTER TABLE `escalacal`
MODIFY `id_ec` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
MODIFY `id_est` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=497;
--
-- AUTO_INCREMENT de la tabla `media`
--
ALTER TABLE `media`
MODIFY `id_med` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
MODIFY `id_men` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `pagina`
--
ALTER TABLE `pagina`
MODIFY `id_pag` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `plan`
--
ALTER TABLE `plan`
MODIFY `id_plan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
MODIFY `id_prov` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
MODIFY `id_reg` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
MODIFY `id_serv` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
MODIFY `id_scat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT de la tabla `tipocal`
--
ALTER TABLE `tipocal`
MODIFY `id_tc` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `tipomedia`
--
ALTER TABLE `tipomedia`
MODIFY `id_tm` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tipopagina`
--
ALTER TABLE `tipopagina`
MODIFY `id_tp` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `tiposervicio`
--
ALTER TABLE `tiposervicio`
MODIFY `id_ts` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
MODIFY `id_tu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
-- Filtros para la tabla `entidad`
--
ALTER TABLE `entidad`
ADD CONSTRAINT `entidad_ibfk_2` FOREIGN KEY (`id_est`) REFERENCES `estado` (`id_est`);

--
-- Filtros para la tabla `item`
--
ALTER TABLE `item`
ADD CONSTRAINT `MENU_ASDF` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`),
ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`id_pag`) REFERENCES `pagina` (`id_pag`);

--
-- Filtros para la tabla `media`
--
ALTER TABLE `media`
ADD CONSTRAINT `media_ent` FOREIGN KEY (`id_ent`) REFERENCES `entidad` (`id_ent`),
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
