-- phpMyAdmin SQL Dump
-- version 4.4.15.8
-- https://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-09-2017 a las 14:01:48
-- Versión del servidor: 5.5.44-MariaDB
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `mercurio2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_archivos`
--

CREATE TABLE IF NOT EXISTS `admin_archivos` (
  `id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `arc_ref_id` int(11) NOT NULL,
  `arc_nombre` varchar(100) NOT NULL,
  `arc_fecha` datetime NOT NULL,
  `arc_deque` enum('e','m') DEFAULT NULL COMMENT 'Eventos Mensajes'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `admin_archivos`
--

INSERT INTO `admin_archivos` (`id`, `usu_id`, `arc_ref_id`, `arc_nombre`, `arc_fecha`, `arc_deque`) VALUES
(1, 1, 1, 'janos-4mar2017-1.png', '0000-00-00 00:00:00', 'e'),
(2, 1, 1, 'janos-4mar2017-2.png', '0000-00-00 00:00:00', 'e'),
(3, 1, 1, 'janos-4mar2017-3.png', '0000-00-00 00:00:00', 'e');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_locaciones`
--

CREATE TABLE IF NOT EXISTS `admin_locaciones` (
  `id` int(11) NOT NULL,
  `loc_nombre` varchar(100) NOT NULL,
  `loc_direccion` varchar(200) NOT NULL,
  `loc_telefonos` varchar(200) NOT NULL,
  `loc_coordenadas` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `admin_locaciones`
--

INSERT INTO `admin_locaciones` (`id`, `loc_nombre`, `loc_direccion`, `loc_telefonos`, `loc_coordenadas`) VALUES
(1, 'loc 1', 'santa rida', '0979032119', '-01251 y -0.1254'),
(2, 'loc2mod', 'dir2mod', '09790321118', '0.0145 y 0.0548');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_smtp`
--

CREATE TABLE IF NOT EXISTS `admin_smtp` (
  `id` int(11) NOT NULL,
  `con_smtp_auth` tinyint(1) NOT NULL DEFAULT '1',
  `con_smtp_sec` varchar(50) NOT NULL,
  `con_smtp_host` varchar(50) NOT NULL,
  `con_smtp_user` varchar(50) NOT NULL,
  `con_smtp_pass` varchar(50) NOT NULL,
  `con_smtp_port` varchar(50) NOT NULL,
  `con_smtp_from` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `admin_smtp`
--

INSERT INTO `admin_smtp` (`id`, `con_smtp_auth`, `con_smtp_sec`, `con_smtp_host`, `con_smtp_user`, `con_smtp_pass`, `con_smtp_port`, `con_smtp_from`) VALUES
(1, 1, 'ssl', 'gestionmai.com', 'notificacion1@gestionmai.com', 'Mai..2016', '465', 'notificacion1@gestionmai.com'),
(2, 1, 'ssl', 'gestionmai.com', 'notificacion2@gestionmai.com', 'Mai..2016', '465', 'notificacion2@gestionmai.com'),
(3, 1, 'ssl', 'gestionmai.com', 'notificacion3@gestionmai.com', 'Mai..2016', '465', 'notificacion3@gestionmai.com'),
(4, 1, 'ssl', 'gestionmai.com', 'notificacion4@gestionmai.com', 'Mai..2016', '465', 'notificacion4@gestionmai.com'),
(6, 1, 'ssl', 'smtp.gmail.com', 'atenea@correovirtual.com', '33atenea33', '465', 'atenea@correovirtual.com'),
(5, 1, 'ssl', 'gestionmai.com', 'notificacion5@gestionmai.com', 'Mai..2016', '465', 'notificacion4@gestionmai.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_usuarios`
--

CREATE TABLE IF NOT EXISTS `admin_usuarios` (
  `id` int(11) NOT NULL,
  `usu_nombres` varchar(100) NOT NULL,
  `usu_apellidos` varchar(100) NOT NULL,
  `usu_hojavida` text NOT NULL,
  `usu_email` varchar(200) NOT NULL,
  `usu_contrasena` varchar(200) NOT NULL,
  `usu_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usu_adm` enum('s','n') NOT NULL DEFAULT 'n',
  `usu_activo` enum('s','n') NOT NULL DEFAULT 's',
  `usu_fecha_contrasena` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `admin_usuarios`
--

INSERT INTO `admin_usuarios` (`id`, `usu_nombres`, `usu_apellidos`, `usu_hojavida`, `usu_email`, `usu_contrasena`, `usu_ingreso`, `usu_adm`, `usu_activo`, `usu_fecha_contrasena`) VALUES
(1, 'Juan Carlos', 'Villavicencio', '', 'juancarlos@correovirtual.com', 'dff37353df9ec73f7c673a50c261f2b0', '2016-01-06 14:04:27', 's', 's', '2020-10-04'),
(2, 'Cristina', 'Contreras', '', 'criscontreras82@hotmail.com', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', '2016-01-06 14:04:27', 's', 's', '2031-02-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emails_eventos`
--

CREATE TABLE IF NOT EXISTS `emails_eventos` (
  `id` int(11) NOT NULL,
  `sus_id` int(11) NOT NULL,
  `eve_id` int(11) NOT NULL,
  `evi_id` int(11) NOT NULL,
  `eml_asunto` varchar(200) NOT NULL,
  `eml_contenido` text NOT NULL,
  `eml_fecha_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `eve_fecha_programada` datetime NOT NULL,
  `eml_fecha_envio` datetime NOT NULL,
  `eml_estado` enum('e','p') NOT NULL DEFAULT 'p' COMMENT 'Enviado Pendiente',
  `eml_smtp_id` int(11) NOT NULL,
  `eml_error` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emails_mensajes`
--

CREATE TABLE IF NOT EXISTS `emails_mensajes` (
  `id` int(11) NOT NULL,
  `sus_id` int(11) NOT NULL,
  `tem_id` int(11) NOT NULL,
  `eml_asunto` varchar(200) NOT NULL,
  `eml_contenido` text NOT NULL,
  `eml_fecha` datetime NOT NULL,
  `eml_fecha_envio` datetime NOT NULL,
  `eml_estado` enum('e','p') NOT NULL DEFAULT 'p' COMMENT 'Enviado Pendiente',
  `eml_smtp_id` int(11) NOT NULL,
  `eml_error` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `tem_id` int(11) NOT NULL,
  `eve_estado` enum('p','a') NOT NULL DEFAULT 'p' COMMENT 'Pendiente Aprobado',
  `eve_activodesde` datetime NOT NULL,
  `usu_id_conferencista` int(11) NOT NULL,
  `eve_titulo` varchar(40) NOT NULL,
  `eve_subtitulo` varchar(100) NOT NULL,
  `eve_descripcion` text NOT NULL,
  `eve_contenido` text NOT NULL,
  `eve_objetivos` text NOT NULL,
  `eve_dirigido` text NOT NULL,
  `eve_duracion` varchar(100) NOT NULL,
  `eve_lugar` text NOT NULL,
  `eve_fechasHorarios` text NOT NULL,
  `eve_costo` float(15,2) NOT NULL,
  `eve_fecha_hora` datetime NOT NULL COMMENT 'fecha y hora de envio maximo de propaganda',
  `eve_observaciones` text NOT NULL COMMENT 'Info adicional de parqueaderos, coffe break, seguridad, etc.'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `loc_id`, `tem_id`, `eve_estado`, `eve_activodesde`, `usu_id_conferencista`, `eve_titulo`, `eve_subtitulo`, `eve_descripcion`, `eve_contenido`, `eve_objetivos`, `eve_dirigido`, `eve_duracion`, `eve_lugar`, `eve_fechasHorarios`, `eve_costo`, `eve_fecha_hora`, `eve_observaciones`) VALUES
(1, 0, 0, 'p', '0000-00-00 00:00:00', 0, 'titulo 1 mod', '', 'descriocion mod', '', '', '', '', '', '', 0.00, '0000-00-00 00:00:00', ''),
(3, 1, 4, 'p', '0000-00-00 00:00:00', 3, 'titulo 1', 'subtitulo2', 'decricpion', 'contenido', 'objetivos', 'dirigido', 'duracion', 'lugar', 'fechas', 20.00, '0000-00-00 00:00:00', 'observaciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eve_fechas`
--

CREATE TABLE IF NOT EXISTS `eve_fechas` (
  `id` int(11) NOT NULL,
  `eve_id` int(11) NOT NULL,
  `eve_fecha` date NOT NULL,
  `eve_inicia` time NOT NULL,
  `eve_termina` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE IF NOT EXISTS `mensajes` (
  `id` int(11) NOT NULL,
  `tem_id` int(11) NOT NULL,
  `msj_titulo` varchar(100) NOT NULL,
  `msj_descripcion` text NOT NULL,
  `msj_estado` enum('p','a') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_sus_eventos`
--

CREATE TABLE IF NOT EXISTS `rel_sus_eventos` (
  `id` int(11) NOT NULL,
  `sus_id` int(11) NOT NULL,
  `eve_id` int(11) NOT NULL,
  `rse_fecha` datetime NOT NULL,
  `rse_confirmado` enum('s','n','q','f') NOT NULL DEFAULT 'f' COMMENT 'Si No Quizas Faltaresponder',
  `rse_colabora` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_sus_temas`
--

CREATE TABLE IF NOT EXISTS `rel_sus_temas` (
  `id` int(11) NOT NULL,
  `sus_id` int(11) NOT NULL,
  `tem_id` int(11) NOT NULL,
  `tst_desde` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscriptores`
--

CREATE TABLE IF NOT EXISTS `suscriptores` (
  `id` int(11) NOT NULL,
  `sus_nombres` varchar(100) NOT NULL,
  `sus_apellidos` varchar(100) NOT NULL,
  `sus_email` varchar(200) NOT NULL,
  `sus_celular` varchar(50) NOT NULL,
  `sus_fecha` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `suscriptores`
--

INSERT INTO `suscriptores` (`id`, `sus_nombres`, `sus_apellidos`, `sus_email`, `sus_celular`, `sus_fecha`) VALUES
(1, 'suscriptor 1 mod', 'apellido2', 'cris@hotmail.com', '0979032119', '2017-02-22 15:00:08'),
(2, 'sdfsdf', 'sdfsdf', 'sdfsdf', 'sdfsdf', '2017-02-22 15:01:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscriptores_bajas`
--

CREATE TABLE IF NOT EXISTS `suscriptores_bajas` (
  `id` int(11) NOT NULL,
  `sus_nombres` varchar(100) NOT NULL,
  `sus_apellidos` varchar(100) NOT NULL,
  `sus_email` varchar(200) NOT NULL,
  `sus_celular` varchar(50) NOT NULL,
  `sus_fecha` datetime NOT NULL,
  `sus_fecha_baja` datetime NOT NULL,
  `sus_razon_baja` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE IF NOT EXISTS `temas` (
  `id` int(11) NOT NULL,
  `tem_nombre` varchar(100) NOT NULL,
  `tem_descripcion` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`id`, `tem_nombre`, `tem_descripcion`) VALUES
(4, 'tema 1', 'asdasdasd');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin_archivos`
--
ALTER TABLE `admin_archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `admin_locaciones`
--
ALTER TABLE `admin_locaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `admin_smtp`
--
ALTER TABLE `admin_smtp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `admin_usuarios`
--
ALTER TABLE `admin_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD FULLTEXT KEY `usu_nombres` (`usu_nombres`,`usu_apellidos`,`usu_email`);

--
-- Indices de la tabla `emails_eventos`
--
ALTER TABLE `emails_eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `emails_mensajes`
--
ALTER TABLE `emails_mensajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD FULLTEXT KEY `eventos_ft` (`eve_titulo`,`eve_subtitulo`,`eve_descripcion`,`eve_contenido`,`eve_objetivos`,`eve_dirigido`,`eve_duracion`,`eve_lugar`,`eve_fechasHorarios`,`eve_observaciones`);

--
-- Indices de la tabla `eve_fechas`
--
ALTER TABLE `eve_fechas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rel_sus_eventos`
--
ALTER TABLE `rel_sus_eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rel_sus_temas`
--
ALTER TABLE `rel_sus_temas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `suscriptores`
--
ALTER TABLE `suscriptores`
  ADD PRIMARY KEY (`id`),
  ADD FULLTEXT KEY `usu_nombres` (`sus_nombres`,`sus_apellidos`,`sus_email`);

--
-- Indices de la tabla `suscriptores_bajas`
--
ALTER TABLE `suscriptores_bajas`
  ADD KEY `id` (`id`),
  ADD FULLTEXT KEY `usu_nombres` (`sus_nombres`,`sus_apellidos`,`sus_email`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin_archivos`
--
ALTER TABLE `admin_archivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `admin_locaciones`
--
ALTER TABLE `admin_locaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `admin_usuarios`
--
ALTER TABLE `admin_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `emails_eventos`
--
ALTER TABLE `emails_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `emails_mensajes`
--
ALTER TABLE `emails_mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `eve_fechas`
--
ALTER TABLE `eve_fechas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rel_sus_eventos`
--
ALTER TABLE `rel_sus_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rel_sus_temas`
--
ALTER TABLE `rel_sus_temas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `suscriptores`
--
ALTER TABLE `suscriptores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;