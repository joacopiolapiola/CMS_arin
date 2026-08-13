CREATE DATABASE IF NOT EXISTS `basededatos`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE `basededatos`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `encuesta_respuestas`;
DROP TABLE IF EXISTS `encuesta_opciones`;
DROP TABLE IF EXISTS `encuestas`;

DROP TABLE IF EXISTS `foro_respuestas`;
DROP TABLE IF EXISTS `foro_temas`;

DROP TABLE IF EXISTS `chat_mensajes`;

DROP TABLE IF EXISTS `usuarios`;
DROP TABLE IF EXISTS `tecnologias`;
DROP TABLE IF EXISTS `secciones`;
DROP TABLE IF EXISTS `comodin`;
DROP TABLE IF EXISTS `historia`;
DROP TABLE IF EXISTS `quees`;
DROP TABLE IF EXISTS `recursos`;
DROP TABLE IF EXISTS `misc`;
DROP TABLE IF EXISTS `links`;
DROP TABLE IF EXISTS `concursos`;
DROP TABLE IF EXISTS `cursos`;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `tecnologias` (
  `ID_tecnologia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `abreviatura` varchar(20) DEFAULT NULL,
  `resumen` text DEFAULT NULL,
  `definicion` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `orden` int(11) NOT NULL DEFAULT 1,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `color` varchar(24) NOT NULL DEFAULT '#ffffff',
  `bkg_color` varchar(24) NOT NULL DEFAULT '#000000',
  PRIMARY KEY (`ID_tecnologia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `usuarios` (
  `ID_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `roles` varchar(200) NOT NULL DEFAULT 'Invitado',
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Permisos` varchar(10) DEFAULT NULL,
  `Institucion` varchar(100) DEFAULT NULL,
  `Rol_institucion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_usuario`),
  UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `secciones` (
  `id_seccion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `id_tecnologia` int(11) NOT NULL DEFAULT 0,
  `orden` int(11) NOT NULL DEFAULT 1,
  `enlace` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `enlace_cms` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_seccion`),
  KEY `idx_secciones_tecnologia` (`id_tecnologia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `comodin` (
  `ID_comodin` int(15) NOT NULL AUTO_INCREMENT,
  `ID_tecnologia` int(11) NOT NULL,
  `titulo` text DEFAULT NULL,
  `Contenido` text DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `link_referencia` varchar(100) DEFAULT NULL,
  `activo` int(2) NOT NULL DEFAULT 1,
  `orden` int(4) NOT NULL DEFAULT 1,
  `seccion` varchar(30) NOT NULL DEFAULT 'SABERES',
  PRIMARY KEY (`ID_comodin`),
  KEY `idx_comodin_tecnologia` (`ID_tecnologia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `historia` (
  `ID_historia` int(15) NOT NULL AUTO_INCREMENT,
  `ID_tecnologia` int(11) NOT NULL,
  `titulo` text DEFAULT NULL,
  `Contenido` text NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `link_referencia` varchar(100) DEFAULT NULL,
  `activo` int(2) NOT NULL DEFAULT 1,
  `orden` int(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID_historia`),
  KEY `idx_historia_tecnologia` (`ID_tecnologia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `quees` (
  `ID_quees` int(10) NOT NULL AUTO_INCREMENT,
  `ID_tecnologia` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `Contenido` text NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `link_referencia` text NOT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  `orden` int(4) NOT NULL,
  PRIMARY KEY (`ID_quees`),
  KEY `idx_quees_tecnologia` (`ID_tecnologia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `recursos` (
  `ID_recurso` int(10) NOT NULL AUTO_INCREMENT,
  `ID_tecnologia` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `Contenido` text NOT NULL,
  `link_referencia` varchar(100) DEFAULT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  `orden` int(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID_recurso`),
  KEY `idx_recursos_tecnologia` (`ID_tecnologia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `misc` (
  `ID_misc` int(10) NOT NULL AUTO_INCREMENT,
  `ID_tecnologia` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `Contenido` text NOT NULL,
  `link_referencia` varchar(100) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  `ordenamiento` int(4) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `pos_FC` varchar(6) DEFAULT 'F1C1',
  `link_local` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_misc`),
  KEY `idx_misc_tecnologia` (`ID_tecnologia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `links` (
  `ID_links` int(15) NOT NULL AUTO_INCREMENT,
  `Contenido` text NOT NULL,
  `ID_tecnologia` int(11) NOT NULL,
  PRIMARY KEY (`ID_links`),
  KEY `idx_links_tecnologia` (`ID_tecnologia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `concursos` (
  `ID_concurso` int(10) NOT NULL AUTO_INCREMENT,
  `ID_tecnologia` int(11) NOT NULL,
  `nombre_concurso` varchar(100) NOT NULL,
  `Contenido` text NOT NULL,
  `link_referencia` varchar(100) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  `ordenamiento` int(4) NOT NULL,
  PRIMARY KEY (`ID_concurso`),
  KEY `idx_concursos_tecnologia` (`ID_tecnologia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `cursos` (
  `ID_cursos` int(10) NOT NULL AUTO_INCREMENT,
  `ID_tecnologia` int(11) NOT NULL,
  `nombre_curso` varchar(100) NOT NULL,
  `Contenido` text NOT NULL,
  `link_referencia` varchar(100) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  `ordenamiento` int(4) NOT NULL,
  `modalidad` varchar(30) NOT NULL COMMENT 'presencial-virtual-web',
  `costo` double DEFAULT 0,
  `lugar` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`ID_cursos`),
  KEY `idx_cursos_tecnologia` (`ID_tecnologia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `chat_mensajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_respuesta_a` int(11) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `creado_en` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idx_chat_usuario` (`id_usuario`),
  KEY `idx_chat_respuesta` (`id_respuesta_a`),
  CONSTRAINT `fk_chat_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`ID_usuario`) ON DELETE CASCADE,
  CONSTRAINT `fk_chat_respuesta` FOREIGN KEY (`id_respuesta_a`) REFERENCES `chat_mensajes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `foro_temas` (
  `id_tema` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `contenido` text NOT NULL,
  `creado_en` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_tema`),
  KEY `idx_foro_tema_usuario` (`id_usuario`),
  CONSTRAINT `fk_foro_tema_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`ID_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `foro_respuestas` (
  `id_respuesta` int(11) NOT NULL AUTO_INCREMENT,
  `id_tema` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `creado_en` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_respuesta`),
  KEY `idx_foro_respuesta_tema` (`id_tema`),
  KEY `idx_foro_respuesta_usuario` (`id_usuario`),
  CONSTRAINT `fk_foro_respuesta_tema` FOREIGN KEY (`id_tema`) REFERENCES `foro_temas` (`id_tema`) ON DELETE CASCADE,
  CONSTRAINT `fk_foro_respuesta_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`ID_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `encuestas` (
  `id_encuesta` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` text NOT NULL,
  `descripcion` text DEFAULT NULL,
  `id_tecnologia` int(11) NOT NULL DEFAULT 0,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `creado_en` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_encuesta`),
  KEY `idx_encuestas_activo` (`activo`),
  KEY `idx_encuestas_tecnologia` (`id_tecnologia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `encuesta_opciones` (
  `id_opcion` int(11) NOT NULL AUTO_INCREMENT,
  `id_encuesta` int(11) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `orden_item` int(11) NOT NULL DEFAULT 0,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_opcion`),
  KEY `idx_opciones_encuesta` (`id_encuesta`),
  CONSTRAINT `fk_encuesta_opcion_encuesta` FOREIGN KEY (`id_encuesta`) REFERENCES `encuestas` (`id_encuesta`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `encuesta_respuestas` (
  `id_respuesta` int(11) NOT NULL AUTO_INCREMENT,
  `id_encuesta` int(11) NOT NULL,
  `id_opcion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `creado_en` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_respuesta`),
  UNIQUE KEY `uq_encuesta_usuario` (`id_encuesta`, `id_usuario`),
  KEY `idx_respuestas_encuesta` (`id_encuesta`),
  KEY `idx_respuestas_usuario` (`id_usuario`),
  CONSTRAINT `fk_encuesta_respuesta_encuesta` FOREIGN KEY (`id_encuesta`) REFERENCES `encuestas` (`id_encuesta`) ON DELETE CASCADE,
  CONSTRAINT `fk_encuesta_respuesta_opcion` FOREIGN KEY (`id_opcion`) REFERENCES `encuesta_opciones` (`id_opcion`) ON DELETE CASCADE,
  CONSTRAINT `fk_encuesta_respuesta_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`ID_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tecnologias` (`ID_tecnologia`, `nombre`, `abreviatura`, `resumen`, `definicion`, `logo`, `orden`, `activo`, `color`, `bkg_color`) VALUES
(11, 'the cure', 'CURE', '           ', 'banda inglesa independiente', 'thecure.jpg', 1, 1, '#ffffff', '#000000'),
(12, 'pavement', 'PM', '           ', '           <h2>Resumen de Pavement</h2>\r\n\r\n<p><strong>Pavement</strong> fue una banda de rock indie formada en 1989 en Estados Unidos. Es conocida por su estilo relajado, letras ironicas y sonido lo fi que influyo mucho en el indie de los años 90.</p>\r\n\r\n<p>Su lider, <strong>Stephen Malkmus</strong>, fue clave en la identidad del grupo. Alcanzaron reconocimiento con discos como <em>Slanted and Enchanted</em> y <em>Crooked Rain, Crooked Rain</em>, que se volvieron referentes del genero.</p>\r\n\r\n<p>Aunque se separaron en 1999, la banda dejo una gran huella en la musica alternativa y volvio a reunirse en algunas ocasiones para giras.</p>', 'pavement.png', 2, 1, '#ffffff', '#000000'),
(13, 'The velvet underground', 'VU', '           ', '           <h2>Resumen de The Velvet Underground</h2>\r\n\r\n<p><strong>The Velvet Underground</strong> fue una banda de rock formada en la decada de 1960 en Estados Unidos. Es reconocida por su estilo innovador y experimental, que mezclaba rock con arte vanguardista.</p>\r\n\r\n<p>Estuvo liderada por <strong>Lou Reed</strong> y conto con la participacion de <strong>John Cale</strong>, quienes fueron clave en la creacion de su sonido unico. Tambien se destaco la colaboracion con el artista <strong>Andy Warhol</strong>, quien impulso su imagen y produccion.</p>\r\n\r\n<p>Aunque no tuvieron un gran exito comercial en su momento, su influencia fue enorme en generos como el punk, el rock alternativo y el indie.</p>\r\n\r\n<p>Con el paso del tiempo, la banda se convirtio en un referente fundamental de la musica moderna.</p>', 'VUlogo.png', 3, 1, '#ffffff', '#000000'),
(14, 'THESTROKESSS', 'STRO', '           ', 'los strokes', 'logo_p40.png', 4, 1, '#ffffff', '#000000');

INSERT INTO `usuarios` (`ID_usuario`, `nombre`, `telefono`, `roles`, `email`, `password`, `Permisos`, `Institucion`, `Rol_institucion`) VALUES
(2, 'p_luisss', '1143432121', 'administrador', 'p_luisss@yahoo.com.ar', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Docente'),
(3, 'luis perconti', '1122335566', 'Invitado', 'luis.perconti@gmail.com', '$2y$10$fYNsO/2WSKUozUHRkMiDc.LI8CbG.wBOgwRAM9ke7XKa7K/RCLv2e', '', 'EEST4 ', ''),
(4, 'Aguilera Andres Jeremias', '1143432121', 'administrador', 'aguileraandres200097@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(5, 'Alcante Rodrigo', '1143432121', 'administrador', 'rodrigoalcante360@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(6, 'Arin Britos Joaquin', '1143432121', 'administrador', 'joaquinarinbritos@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(7, 'Ayunta Fabricio Rodrigo', '1143432121', 'administrador', 'fabricoayunta@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(8, 'Caceres Lopez Ignacio', '1143432121', 'administrador', 'caceresignacio715@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(9, 'Castillo Franco Joaquin', '1143432121', 'administrador', 'joaquinfrancocastillo@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(10, 'Castro Ignacio Leonel', '1143432121', 'administrador', 'castroignacio255@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(11, 'Cejas Dylan Nahuel', '1143432121', 'administrador', 'dylancejas007@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(12, 'Dos Santos Agustin Matias', '1143432121', 'administrador', 'dossantosmati784@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(13, 'Escobar Mariano Alexander', '1143432121', 'administrador', 'Mariaanoesscobar@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(14, 'Esposito Lucas Tomas', '1143432121', 'administrador', 'lucastomasesposito@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(15, 'Galeano Lautaro Nicolas', '1143432121', 'administrador', 'LGaleano711@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(16, 'Legendre Emiliano Isaac', '1143432121', 'administrador', 'emilianolegendre@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(17, 'Luna Leina', '1143432121', 'administrador', 'lunaleila120@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(18, 'Martinez Sosa Marcos Uriel', '1143432121', 'administrador', 'imcrazy2208@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(19, 'Papp Lucas Ariel', '1143432121', 'administrador', 'lucasklash521@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(20, 'Pontin Ezequiel', '1143432121', 'administrador', 'pontinezequiel@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(21, 'Roa Juan Pablo', '1143432121', 'administrador', 'barikkillerbean@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(22, 'Rojas Gonzalo Valentin', '1143432121', 'administrador', 'gonzavalen19@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(23, 'Rojas Hebe Lucila', '1143432121', 'administrador', 'rojasadrianah@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(24, 'Zacarias Elias Alejo', '1143432121', 'administrador', 'alejozacarias09@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante');

INSERT INTO `comodin` (`ID_comodin`, `ID_tecnologia`, `titulo`, `Contenido`, `imagen`, `link_referencia`, `activo`, `orden`, `seccion`) VALUES
(20, 11, 'Integrantesa de the cure', '<h2>Integrantes de The Cure</h2><p><strong>The Cure</strong> es una banda británica ...', 'cure-1995.jpg', '', 1, 1, 'integrantes'),
(21, 11, 'la historia de la banda', '<h2>Historia de The Cure</h2><p>...</p>', 'The-Cure-Credit-Vinnie-Zuffante-Michael-Ochs-Archives-Getty-Images@2000x1500.jpg', '', 1, 2, 'history'),
(22, 11, 'canciones', '<h2>Canciones de The Cure</h2><p>...</p>', 'R-2184931-1268585027.jpg', '', 1, 3, 'cancionesdethecure'),
(23, 12, 'LOs integraNTEs de lA bandaA pAVEMEnte', '<h2>Resumen de Pavement</h2><p>...</p>', 'gettyimages-466461437-612x612.jpg', '', 1, 1, 'integrantespavement'),
(24, 12, 'Cancuines de la banda', '<h2>Canciones de Pavement</h2><p>...</p>', 'pavement-tt-reissue.jpg', '', 1, 2, 'cancionesdepavement');

INSERT INTO `historia` (`ID_historia`, `ID_tecnologia`, `titulo`, `Contenido`, `imagen`, `link_referencia`, `activo`, `orden`) VALUES
(27, 11, 'HISTORIA', '<h2>Historia de The Cure</h2><p>...</p>', 'The-Cure-Credit-Vinnie-Zuffante-Michael-Ochs-Archives-Getty-Images@2000x1500.jpg', '', 1, 2);

INSERT INTO `quees` (`ID_quees`, `ID_tecnologia`, `titulo`, `Contenido`, `imagen`, `link_referencia`, `activo`, `orden`) VALUES
(7, 2, 'Guitarra Electrica segun la IA', 'Una guitarra eléctrica es un instrumento de cuerda...', '', '', 1, 1);

INSERT INTO `encuestas` (`id_encuesta`, `pregunta`, `descripcion`, `id_tecnologia`, `activo`, `creado_en`) VALUES
(1, '¿Cuál es tu banda favorita?', 'Encuesta general de preferencias musicales', 11, 1, NOW());

INSERT INTO `encuesta_opciones` (`id_opcion`, `id_encuesta`, `texto`, `orden_item`, `activo`) VALUES
(1, 1, 'The Cure', 1, 1),
(2, 1, 'Pavement', 2, 1),
(3, 1, 'The Velvet Underground', 3, 1),
(4, 1, 'The Strokes', 4, 1);

COMMIT;