-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2026 a las 15:15:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `basededatos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_mensajes`
--

CREATE TABLE `chat_mensajes` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_respuesta_a` int(11) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `creado_en` datetime NOT NULL DEFAULT current_timestamp(),
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `chat_mensajes`
--

INSERT INTO `chat_mensajes` (`id`, `id_usuario`, `id_respuesta_a`, `mensaje`, `creado_en`, `activo`) VALUES
(1, 19, NULL, 'holaa', '2026-08-20 07:59:26', 1),
(2, 25, 1, 'holaaa como estas?', '2026-08-20 08:50:57', 1),
(3, 17, NULL, 'es increible este cms', '2026-08-20 08:59:30', 1),
(4, 4, NULL, 'no habla nadie aca', '2026-08-20 09:03:45', 1),
(5, 25, 4, 'es verdad', '2026-08-20 09:05:09', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comodin`
--

CREATE TABLE `comodin` (
  `ID_comodin` int(15) NOT NULL,
  `ID_tecnologia` int(4) NOT NULL,
  `titulo` text DEFAULT NULL,
  `Contenido` text DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `link_referencia` varchar(100) DEFAULT NULL,
  `activo` int(2) NOT NULL DEFAULT 1,
  `orden` int(4) NOT NULL DEFAULT 1,
  `seccion` varchar(30) NOT NULL DEFAULT 'SABERES'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comodin`
--

INSERT INTO `comodin` (`ID_comodin`, `ID_tecnologia`, `titulo`, `Contenido`, `imagen`, `link_referencia`, `activo`, `orden`, `seccion`) VALUES
(20, 11, 'Integrantesa de the cure', '\r\n<h2>Integrantes de The Cure</h2>\r\n\r\n<p><strong>The Cure</strong> es una banda britǭnica de rock alternativo formada en 1976. A lo largo de los a??os, tuvo varios cambios en su formaci??n, pero su l??der y figura principal siempre fue <strong>Robert Smith</strong>, cantante, guitarrista y compositor.</p>\r\n\r\n<p>Entre los integrantes mǭs destacados se encuentran <strong>Simon Gallup</strong> en el bajo, conocido por su estilo s??lido y caracter??stico; <strong>Porl (Pearl) Thompson</strong> en guitarra, quien aport?? gran parte del sonido atmosfǸrico de la banda; y <strong>Lol Tolhurst</strong>, miembro fundador que particip?? en teclados y bater??a en los primeros a??os.</p>\r\n\r\n<p>Con el tiempo, otros mǧsicos se sumaron, como <strong>Jason Cooper</strong> en bater??a y <strong>Roger ODonnell</strong> en teclados, consolidando el sonido ǧnico que hizo famosa a la banda.</p>\r\n\r\n<p>The Cure es reconocida por su influencia en el rock g??tico y alternativo, y por mantener una identidad musical distintiva durante dǸcadas.</p>\r\n```\r\n', 'cure-1995.jpg', '', 1, 1, 'integrantes'),
(21, 11, 'la historia de la banda', '           <h2>Historia de The Cure</h2>\r\n\r\n<p><strong>The Cure</strong> se formo en 1976 en Inglaterra, cuando un grupo de jovenes decidio crear musica con un estilo propio. Al principio, la banda tenia un sonido mas cercano al punk, pero con el tiempo fue evolucionando hacia un estilo mas oscuro y melodico.</p>\r\n\r\n<p>Su primer album, <strong>Three Imaginary Boys</strong>, fue lanzado en 1979 y marco el inicio de su carrera. Con el paso de los a??os, la banda gano popularidad con discos como <strong>Seventeen Seconds</strong>, <strong>Faith</strong> y <strong>Pornography</strong>, que definieron su etapa mas oscura.</p>\r\n\r\n<p>En la decada de 1980, lograron un gran exito comercial con canciones mas accesibles como <strong>Just Like Heaven</strong> y <strong>Friday Im in Love</strong>, ampliando su publico a nivel mundial.</p>\r\n\r\n<p>A pesar de los cambios en su formacion, la banda continuo activa durante las siguientes decadas, manteniendo su estilo unico y consolidandose como una de las mas influyentes del rock alternativo.</p>', 'The-Cure-Credit-Vinnie-Zuffante-Michael-Ochs-Archives-Getty-Images@2000x1500.jpg', '', 1, 2, 'history'),
(22, 11, 'canciones', '           <h2>Canciones de The Cure</h2>\r\n\r\n<p><strong>The Cure</strong> tiene una gran cantidad de canciones iconicas que marcaron la historia del rock alternativo. A continuacion, algunas de las mas conocidas con enlaces para escucharlas:</p>\r\n\r\n<ul>\r\n  <li>\r\n    <strong>Just Like Heaven</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=1ASpBpT8bRQ\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Friday Im in Love</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=mGgMZpGYiy8\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Boys Dont Cry</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=9GkVhgIeGJQ\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Lovesong</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=hXCKLJGLENs\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>A Forest</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=xik-y0xlpZ0\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n</ul>\r\n\r\n<p>Estas canciones representan distintas etapas de la banda, desde su sonido mas oscuro hasta sus momentos mas melodicos y populares.</p>', 'R-2184931-1268585027.jpg', '', 1, 3, 'cancionesdethecure'),
(23, 12, 'LOs integraNTEs de lA bandaA pAVEMEnte', '           <h2>Resumen de Pavement</h2>\r\n\r\n<p><strong>Pavement</strong> fue una banda de rock indie formada en 1989 en Estados Unidos. Es conocida por su estilo relajado, letras ironicas y sonido lo fi que influyo mucho en el indie de los a??os 90.</p>\r\n\r\n<p>Su lider, <strong>Stephen Malkmus</strong>, fue clave en la identidad del grupo. Alcanzaron reconocimiento con discos como <em>Slanted and Enchanted</em> y <em>Crooked Rain, Crooked Rain</em>, que se volvieron referentes del genero.</p>\r\n\r\n<p>Aunque se separaron en 1999, la banda dejo una gran huella en la musica alternativa y volvio a reunirse en algunas ocasiones para giras.</p>', 'gettyimages-466461437-612x612.jpg', '', 1, 1, 'integrantespavement'),
(24, 12, 'Cancuines de la banda', '           <h2>Canciones de Pavement</h2>\r\n\r\n<p><strong>Pavement</strong> tiene varias canciones destacadas dentro del rock indie. A continuacion, algunas de las mas conocidas con enlaces para escucharlas:</p>\r\n\r\n<ul>\r\n  <li>\r\n    <strong>Cut Your Hair</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=QTTgpTeb0Z8\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Range Life</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=1VVj1zqbWpU\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Gold Soundz</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=lPvhKV3Yg2k\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Harness Your Hopes</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=3eFZ3b0yF9g\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Shady Lane</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=8o7V0z1vXlE\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n</ul>\r\n\r\n<p>Estas canciones reflejan el estilo relajado y experimental de la banda, convirtiendolas en referentes del indie de los a??os 90.</p>', 'pavement-tt-reissue.jpg', '', 1, 2, 'cancionesdepavement'),
(25, 12, 'LA HISToria de la BANDAAAA', '           <h2>Historia de Pavement</h2>\r\n\r\n<p><strong>Pavement</strong> se formo en 1989 en Estados Unidos por <strong>Stephen Malkmus</strong> y <strong>Scott Kannberg</strong>. En sus inicios, la banda grabo musica con un estilo lo fi y experimental, lo que rapidamente llamo la atencion dentro de la escena indie.</p>\r\n\r\n<p>Su primer album, <em>Slanted and Enchanted</em>, lanzado en 1992, fue muy bien recibido por la critica y se convirtio en un referente del genero. Luego continuaron con discos como <em>Crooked Rain, Crooked Rain</em> y <em>Wowee Zowee</em>, consolidando su estilo unico.</p>\r\n\r\n<p>Durante los a??os 90, la banda gano popularidad por su sonido relajado, letras ironicas y actitud poco convencional frente a la industria musical.</p>\r\n\r\n<p>En 1999, Pavement anuncio su separacion, pero con el tiempo volvieron a reunirse en distintas ocasiones para realizar giras y presentaciones en vivo.</p>\r\n\r\n<p>Hoy en dia, son considerados una de las bandas mas influyentes del rock indie.</p>', 'gettyimages-466461437-612x612.jpg', '', 1, 3, 'historiapavement'),
(26, 13, 'LA HISToria de la BANDAAAA', '           <h2>Historia de The Velvet Underground</h2>\r\n\r\n<p><strong>The Velvet Underground</strong> se formo en la decada de 1960 en Nueva York por <strong>Lou Reed</strong> y <strong>John Cale</strong>. Desde sus comienzos, la banda se destaco por su sonido experimental y sus letras poco convencionales, que trataban temas urbanos y realistas.</p>\r\n\r\n<p>Con el apoyo del artista <strong>Andy Warhol</strong>, lanzaron su primer album <em>The Velvet Underground and Nico</em> en 1967. Aunque en su momento no tuvo gran exito comercial, con el tiempo se convirtio en uno de los discos mas influyentes de la historia del rock.</p>\r\n\r\n<p>Tras la salida de John Cale, la banda continuo con un sonido mas accesible en albumes como <em>The Velvet Underground</em> y <em>Loaded</em>, donde lograron mayor reconocimiento.</p>\r\n\r\n<p>A pesar de su corta trayectoria y cambios en la formacion, la banda se separo a principios de los a??os 70.</p>\r\n\r\n<p>Con el paso del tiempo, su legado crecio enormemente y hoy es considerada una de las bandas mas influyentes en la musica moderna.</p>', 'Velvet_Underground_1968_by_Billy_Name.png', '', 1, 3, 'historiavu'),
(27, 13, 'LAS MEHORES canciones', '           <h2>Canciones de The Velvet Underground</h2>\r\n\r\n<p>A continuacion, una lista de 20 canciones de <strong>The Velvet Underground</strong> con enlaces para escucharlas:</p>\r\n\r\n<ul>\r\n  <li><strong>Heroin</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Heroin\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Sunday Morning</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Sunday+Morning\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Im Waiting for the Man</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Im+Waiting+for+the+Man\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Femme Fatale</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Femme+Fatale\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Venus in Furs</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Venus+in+Furs\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>All Tomorrows Parties</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+All+Tomorrows+Parties\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Pale Blue Eyes</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Pale+Blue+Eyes\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>White Light White Heat</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+White+Light+White+Heat\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Sweet Jane</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Sweet+Jane\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Rock and Roll</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Rock+and+Roll\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Oh Sweet Nuthin</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Oh+Sweet+Nuthin\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Beginning to See the Light</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Beginning+to+See+the+Light\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>I Heard Her Call My Name</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+I+Heard+Her+Call+My+Name\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>What Goes On</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+What+Goes+On\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Run Run Run</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Run+Run+Run\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Lady Godiva Operation</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Lady+Godiva+Operation\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Some Kinda Love</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Some+Kinda+Love\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>New Age</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+New+Age\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Stephanie Says</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Stephanie+Says\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>I Found a Reason</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+I+Found+a+Reason\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n</ul>', 'Velvet-Underground-Loaded-500x498.jpg', '', 1, 2, 'cancionesvu'),
(28, 14, 'INTEGRANTES DE THE STROKES', '           <h2>Integrantes de The Strokes</h2>\r\n\r\n<p><strong>The Strokes</strong> es una banda de rock formada en Nueva York, conocida por su estilo garage rock y su influencia en el indie de los a??os 2000.</p>\r\n\r\n<ul>\r\n  <li><strong>Julian Casablancas</strong>: voz principal y compositor, lider de la banda.</li>\r\n  <li><strong>Nick Valensi</strong>: guitarra, conocido por sus riffs caracteristicos.</li>\r\n  <li><strong>Albert Hammond Jr</strong>: guitarra ritmica y solista, tambien ha trabajado como solista.</li>\r\n  <li><strong>Nikolai Fraiture</strong>: bajo, aporta la base sonora del grupo.</li>\r\n  <li><strong>Fabrizio Moretti</strong>: bateria, responsable del ritmo y energia de la banda.</li>\r\n</ul>\r\n\r\n<p>Estos integrantes crearon uno de los sonidos mas influyentes del rock moderno.</p>', 'strokin.jpg', '', 1, 2, 'integrantesstr'),
(29, 14, 'CANCIONES DE LOS STROKES', '           <h2>Canciones de The Strokes</h2>\r\n\r\n<p><strong>The Strokes</strong> tiene muchas canciones importantes dentro del rock indie y garage rock. A continuacion, algunas de las mas conocidas con enlaces para escucharlas:</p>\r\n\r\n<ul>\r\n  <li>\r\n    <strong>Last Nite</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Strokes+Last+Nite\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Reptilia</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Strokes+Reptilia\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Someday</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Strokes+Someday\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Under Cover of Darkness</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Strokes+Under+Cover+of+Darkness\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Hard to Explain</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Strokes+Hard+to+Explain\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>12:51</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Strokes+1251\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Juicebox</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Strokes+Juicebox\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>New York City Cops</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Strokes+New+York+City+Cops\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>The Modern Age</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Strokes+The+Modern+Age\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Ode to the Mets</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Strokes+Ode+to+the+Mets\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n</ul>', 'isthisit.jpg', '', 1, 2, 'cancionesst');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concursos`
--

CREATE TABLE `concursos` (
  `ID_concurso` int(10) NOT NULL,
  `ID_tecnologia` int(10) NOT NULL,
  `nombre_concurso` varchar(100) NOT NULL,
  `Contenido` text NOT NULL,
  `link_referencia` varchar(100) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  `ordenamiento` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `ID_cursos` int(10) NOT NULL,
  `ID_tecnologia` int(10) NOT NULL,
  `nombre_curso` varchar(100) NOT NULL,
  `Contenido` text NOT NULL,
  `link_referencia` varchar(100) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  `ordenamiento` int(4) NOT NULL,
  `modalidad` varchar(30) NOT NULL COMMENT 'presencial-virtual-web',
  `costo` double DEFAULT 0,
  `lugar` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE `encuestas` (
  `id_encuesta` int(11) NOT NULL,
  `pregunta` text NOT NULL,
  `descripcion` text DEFAULT NULL,
  `id_tecnologia` int(11) NOT NULL DEFAULT 0,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `creado_en` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `encuestas`
--

INSERT INTO `encuestas` (`id_encuesta`, `pregunta`, `descripcion`, `id_tecnologia`, `activo`, `creado_en`) VALUES
(2, '¿Cual es tu guitarrista favorito?', 'Encuesta de preferencias', 0, 1, '2026-08-20 08:09:20'),
(3, '¿Cual es tu banda favorita', 'Encuesta preferencial', 0, 1, '2026-08-20 08:41:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta_opciones`
--

CREATE TABLE `encuesta_opciones` (
  `id_opcion` int(11) NOT NULL,
  `id_encuesta` int(11) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `orden_item` int(11) NOT NULL DEFAULT 0,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `encuesta_opciones`
--

INSERT INTO `encuesta_opciones` (`id_opcion`, `id_encuesta`, `texto`, `orden_item`, `activo`) VALUES
(5, 2, 'WALTER GIARDINO', 1, 1),
(6, 2, 'PAPP LUCAS', 2, 1),
(7, 2, 'SLASH', 3, 1),
(8, 2, 'ROBERT SMITH', 4, 1),
(9, 1, 'The Cure', 1, 1),
(10, 1, 'Pavement', 2, 1),
(11, 1, 'The Velvet Underground', 3, 1),
(12, 1, 'The Strokes', 4, 1),
(13, 3, 'The Velvet Underground', 1, 1),
(14, 3, 'The cure', 2, 1),
(15, 3, 'The strokes', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta_respuestas`
--

CREATE TABLE `encuesta_respuestas` (
  `id_respuesta` int(11) NOT NULL,
  `id_encuesta` int(11) NOT NULL,
  `id_opcion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `creado_en` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `encuesta_respuestas`
--

INSERT INTO `encuesta_respuestas` (`id_respuesta`, `id_encuesta`, `id_opcion`, `id_usuario`, `creado_en`) VALUES
(1, 1, 1, 19, '2026-08-20 08:00:06'),
(2, 2, 6, 19, '2026-08-20 08:09:31'),
(3, 3, 14, 19, '2026-08-20 08:41:57'),
(4, 3, 13, 17, '2026-08-20 09:01:27'),
(5, 2, 7, 17, '2026-08-20 09:01:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_respuestas`
--

CREATE TABLE `foro_respuestas` (
  `id_respuesta` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `creado_en` datetime NOT NULL DEFAULT current_timestamp(),
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `foro_respuestas`
--

INSERT INTO `foro_respuestas` (`id_respuesta`, `id_tema`, `id_usuario`, `contenido`, `creado_en`, `activo`) VALUES
(1, 1, 19, 'nada que ver', '2026-08-20 07:59:54', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_temas`
--

CREATE TABLE `foro_temas` (
  `id_tema` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `contenido` text NOT NULL,
  `creado_en` datetime NOT NULL DEFAULT current_timestamp(),
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `foro_temas`
--

INSERT INTO `foro_temas` (`id_tema`, `id_usuario`, `titulo`, `contenido`, `creado_en`, `activo`) VALUES
(1, 19, 'los roliiing', 'los roling son la mejor banda del roc nacional', '2026-08-20 07:59:47', 1),
(2, 17, 'El gobierno', 'Chicos, que opinan de la decision sobre vender el territorio argentino? Bancan?', '2026-08-20 09:01:11', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia`
--

CREATE TABLE `historia` (
  `ID_historia` int(15) NOT NULL,
  `ID_tecnologia` int(4) NOT NULL,
  `titulo` text DEFAULT NULL,
  `Contenido` text NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `link_referencia` varchar(100) DEFAULT NULL,
  `activo` int(2) NOT NULL DEFAULT 1,
  `orden` int(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historia`
--

INSERT INTO `historia` (`ID_historia`, `ID_tecnologia`, `titulo`, `Contenido`, `imagen`, `link_referencia`, `activo`, `orden`) VALUES
(27, 11, 'HISTORIA', '           <h2>Historia de The Cure</h2>\r\n\r\n<p><strong>The Cure</strong> se formo en 1976 en Inglaterra, cuando un grupo de jovenes decidio crear musica con un estilo propio. Al principio, la banda tenia un sonido mas cercano al punk, pero con el tiempo fue evolucionando hacia un estilo mas oscuro y melodico.</p>\r\n\r\n<p>Su primer album, <strong>Three Imaginary Boys</strong>, fue lanzado en 1979 y marco el inicio de su carrera. Con el paso de los a??os, la banda gano popularidad con discos como <strong>Seventeen Seconds</strong>, <strong>Faith</strong> y <strong>Pornography</strong>, que definieron su etapa mas oscura.</p>\r\n\r\n<p>En la decada de 1980, lograron un gran exito comercial con canciones mas accesibles como <strong>Just Like Heaven</strong> y <strong>Friday Im in Love</strong>, ampliando su publico a nivel mundial.</p>\r\n\r\n<p>A pesar de los cambios en su formacion, la banda continuo activa durante las siguientes decadas, manteniendo su estilo unico y consolidandose como una de las mas influyentes del rock alternativo.</p>', 'The-Cure-Credit-Vinnie-Zuffante-Michael-Ochs-Archives-Getty-Images@2000x1500.jpg', '', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `links`
--

CREATE TABLE `links` (
  `ID_links` int(15) NOT NULL,
  `Contenido` text NOT NULL,
  `ID_tecnologia` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `misc`
--

CREATE TABLE `misc` (
  `ID_misc` int(10) NOT NULL,
  `ID_tecnologia` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `Contenido` text NOT NULL,
  `link_referencia` varchar(100) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  `ordenamiento` int(4) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `pos_FC` varchar(6) DEFAULT 'F1C1',
  `link_local` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quees`
--

CREATE TABLE `quees` (
  `ID_quees` int(10) NOT NULL,
  `ID_tecnologia` int(10) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `Contenido` text NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `link_referencia` text NOT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  `orden` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `quees`
--

INSERT INTO `quees` (`ID_quees`, `ID_tecnologia`, `titulo`, `Contenido`, `imagen`, `link_referencia`, `activo`, `orden`) VALUES
(7, 2, 'Guitarra Electrica segun la IA', '  Una guitarra elǸctrica es un instrumento de cuerda con cuerpo s??lido o semi-s??lido (sin caja de resonancia acǧstica) que utiliza pastillas electromagnǸticas para convertir la vibraci??n de sus cuerdas de metal en se??ales elǸctricas. Estas se??ales se env??an a un amplificador externo para producir sonido. ', '', '', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raiz`
--

CREATE TABLE `raiz` (
  `ID_raiz` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `abreviatura` varchar(4) DEFAULT NULL,
  `resumen` varchar(250) DEFAULT NULL,
  `definicion` text NOT NULL,
  `logo` varchar(30) DEFAULT NULL,
  `orden` int(2) NOT NULL,
  `activo` int(2) NOT NULL DEFAULT 1,
  `color` varchar(24) NOT NULL DEFAULT 'BLACK',
  `bkg_color` varchar(24) NOT NULL DEFAULT 'WHITE',
  `nombre_sitio` text NOT NULL DEFAULT 'Nombre del Sitio',
  `nombre_institucion` text NOT NULL DEFAULT 'Nombre Institucion',
  `fuente` text NOT NULL DEFAULT 'VERDANA',
  `color_gral` varchar(24) NOT NULL DEFAULT 'BLACK',
  `bkg_color_gral` varchar(24) NOT NULL DEFAULT 'WHITE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `raiz`
--

INSERT INTO `raiz` (`ID_raiz`, `nombre`, `abreviatura`, `resumen`, `definicion`, `logo`, `orden`, `activo`, `color`, `bkg_color`, `nombre_sitio`, `nombre_institucion`, `fuente`, `color_gral`, `bkg_color_gral`) VALUES
(0, 'musica independiente', 'MI', '0', 'sitio para musica', '', 1, 1, '#ffffff', '#000000', 'musica independiente', 'E.E.S.T. N4', 'calibri', '#ffffff', '#000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `ID_recurso` int(10) NOT NULL,
  `ID_tecnologia` int(10) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `Contenido` text NOT NULL,
  `link_referencia` text NOT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  `orden` int(4) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`ID_recurso`, `ID_tecnologia`, `titulo`, `Contenido`, `link_referencia`, `activo`, `orden`, `imagen`) VALUES
(1, 2, 'Redes Neuronales', 'Las redes neuronales pueden ayudar a las computadoras a tomar decisiones inteligentes con asistencia humana limitada. Esto se debe a que pueden aprender y modelar las relaciones entre los datos de entrada y salida que no son lineales y que son complejos. Por ejemplo, pueden realizar las siguientes tareas.', 'https://aws.amazon.com/es/what-is/neural-network/', 1, 0, 'redneuronal.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id_seccion` int(4) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `orden` int(2) NOT NULL,
  `id_tecnologia` int(11) NOT NULL,
  `enlace` varchar(40) DEFAULT NULL,
  `Activo` int(5) NOT NULL,
  `enlace_cms` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id_seccion`, `nombre`, `orden`, `id_tecnologia`, `enlace`, `Activo`, `enlace_cms`) VALUES
(70, 'integrantes', 1, 11, 'comodin.php', 1, 'comodin_cms.php'),
(72, 'history', 2, 11, 'comodin.php', 1, 'comodin_cms.php'),
(73, 'cancionesdethecure', 3, 11, 'comodin.php', 1, 'comodin_cms.php'),
(74, 'integrantespavement', 1, 12, 'comodin.php', 1, 'comodin_cms.php'),
(75, 'cancionesdepavement', 2, 12, 'comodin.php', 1, 'comodin_cms.php'),
(76, 'historiapavement', 3, 12, 'comodin.php', 1, 'comodin_cms.php'),
(77, 'historiavu', 1, 13, 'comodin.php', 1, 'comodin_cms.php'),
(78, 'cancionesvu', 2, 13, 'comodin.php', 1, 'comodin_cms.php'),
(79, 'integrantesstr', 1, 14, 'comodin.php', 1, 'comodin_cms.php'),
(80, 'cancionesst', 2, 14, 'comodin.php', 1, 'comodin_cms.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnologias`
--

CREATE TABLE `tecnologias` (
  `ID_tecnologia` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `abreviatura` varchar(4) DEFAULT NULL,
  `resumen` varchar(250) DEFAULT NULL,
  `definicion` text NOT NULL,
  `logo` varchar(30) DEFAULT NULL,
  `orden` int(2) NOT NULL,
  `activo` int(2) NOT NULL DEFAULT 1,
  `color` varchar(24) NOT NULL DEFAULT 'BLACK',
  `bkg_color` varchar(24) NOT NULL DEFAULT 'WHITE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tecnologias`
--

INSERT INTO `tecnologias` (`ID_tecnologia`, `nombre`, `abreviatura`, `resumen`, `definicion`, `logo`, `orden`, `activo`, `color`, `bkg_color`) VALUES
(11, 'the cure', 'CURE', '           ', 'banda inglesa independiente', 'thecure.jpg', 1, 1, '#ffffff', '#000000'),
(12, 'pavement', 'PM', '           ', '           <h2>Resumen de Pavement</h2>\r\n\r\n<p><strong>Pavement</strong> fue una banda de rock indie formada en 1989 en Estados Unidos. Es conocida por su estilo relajado, letras ironicas y sonido lo fi que influyo mucho en el indie de los a??os 90.</p>\r\n\r\n<p>Su lider, <strong>Stephen Malkmus</strong>, fue clave en la identidad del grupo. Alcanzaron reconocimiento con discos como <em>Slanted and Enchanted</em> y <em>Crooked Rain, Crooked Rain</em>, que se volvieron referentes del genero.</p>\r\n\r\n<p>Aunque se separaron en 1999, la banda dejo una gran huella en la musica alternativa y volvio a reunirse en algunas ocasiones para giras.</p>', 'pavement.png', 2, 1, '#ffffff', '#000000'),
(13, 'The velvet underground', 'VU', '           ', '           <h2>Resumen de The Velvet Underground</h2>\r\n\r\n<p><strong>The Velvet Underground</strong> fue una banda de rock formada en la decada de 1960 en Estados Unidos. Es reconocida por su estilo innovador y experimental, que mezclaba rock con arte vanguardista.</p>\r\n\r\n<p>Estuvo liderada por <strong>Lou Reed</strong> y conto con la participacion de <strong>John Cale</strong>, quienes fueron clave en la creacion de su sonido unico. Tambien se destaco la colaboracion con el artista <strong>Andy Warhol</strong>, quien impulso su imagen y produccion.</p>\r\n\r\n<p>Aunque no tuvieron un gran exito comercial en su momento, su influencia fue enorme en generos como el punk, el rock alternativo y el indie.</p>\r\n\r\n<p>Con el paso del tiempo, la banda se convirtio en un referente fundamental de la musica moderna.</p<h2>Resumen de The Velvet Underground</h2>\r\n\r\n<p><strong>The Velvet Underground</strong> fue una banda de rock formada en la decada de 1960 en Estados Unidos. Es reconocida por su estilo innovador y experimental, que mezclaba rock con arte vanguardista.</p>\r\n\r\n<p>Estuvo liderada por <strong>Lou Reed</strong> y conto con la participacion de <strong>John Cale</strong>, quienes fueron clave en la creacion de su sonido unico. Tambien se destaco la colaboracion con el artista <strong>Andy Warhol</strong>, quien impulso su imagen y produccion.</p>\r\n\r\n<p>Aunque no tuvieron un gran exito comercial en su momento, su influencia fue enorme en generos como el punk, el rock alternativo y el indie.</p>\r\n\r\n<p>Con el paso del tiempo, la banda se convirtio en un referente fundamental de la musica moderna.</p>', 'VUlogo.png', 3, 1, '#ffffff', '#000000'),
(14, 'THESTROKESSS', 'STRO', '           ', 'los strokes', 'logo_p40.png', 4, 1, '#ffffff', '#000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `roles` varchar(200) NOT NULL DEFAULT 'Invitado' COMMENT 'Invitado,\r\nAdministrador,\r\nColaborador,\r\nModerador,\r\nSupervisor',
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Permisos` varchar(10) DEFAULT NULL COMMENT 'por cada rol que tiene el usuario ,debe ir una letra especificando los permisos que tiene dentro de ese rol \r\nT:todos,\r\nL:Leer,\r\nA: L + Agregar\r\nE: L + A + Modificar\r\nB: L + A + M + Borrar\r\n',
  `Institucion` varchar(100) DEFAULT NULL,
  `Rol_institucion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_usuario`, `nombre`, `telefono`, `roles`, `email`, `password`, `Permisos`, `Institucion`, `Rol_institucion`) VALUES
(2, 'p_luisss', '1143432121', 'administrador', 'p_luisss@yahoo.com.ar', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Docente'),
(3, 'luis perconti', '1122335566', 'usuario', 'luis.perconti@gmail.com', '$2y$10$fYNsO/2WSKUozUHRkMiDc.LI8CbG.wBOgwRAM9ke7XKa7K/RCLv2e', '', 'EEST4', ''),
(4, 'Aguilera Andres Jeremias', '1143432121', 'visitante', 'aguileraandres200097@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4', 'Estudiante'),
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
(17, 'Luna Leina', '1143432121', 'editor', 'lunaleila120@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4', 'Estudiante'),
(18, 'Martinez Sosa Marcos Uriel', '1143432121', 'administrador', 'imcrazy2208@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(19, 'Papp Lucas Ariel', '1143432121', 'administrador', 'lucasklash521@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(20, 'Pontin Ezequiel', '1143432121', 'administrador', 'pontinezequiel@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(21, 'Roa Juan Pablo', '1143432121', 'administrador', 'barikkillerbean@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(22, 'Rojas Gonzalo Valentin', '1143432121', 'administrador', 'gonzavalen19@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(23, 'Rojas Hebe Lucila', '1143432121', 'administrador', 'rojasadrianah@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(24, 'Zacarias Elias Alejo', '1143432121', 'administrador', 'alejozacarias09@gmail.com', '$2y$10$Gv0jbvQYp5wqVFl7zFJ9/Oq2hvJQvZ6gqFV/0vfnugj9QdFflLIyG', 'T', 'EEST4 ', 'Estudiante'),
(25, 'lucas prueba', '1123456789', 'usuario', 'lucas@gmail.com', '$2y$10$9qPuoPdKCuqPpIMlnODtQ.KZIE/VYH.eB9xtcxpxjT/1MgcWKU7Wu', NULL, 'eestn4', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chat_mensajes`
--
ALTER TABLE `chat_mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_chat_usuario` (`id_usuario`),
  ADD KEY `idx_chat_respuesta` (`id_respuesta_a`);

--
-- Indices de la tabla `comodin`
--
ALTER TABLE `comodin`
  ADD PRIMARY KEY (`ID_comodin`);

--
-- Indices de la tabla `concursos`
--
ALTER TABLE `concursos`
  ADD PRIMARY KEY (`ID_concurso`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`ID_cursos`);

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`id_encuesta`);

--
-- Indices de la tabla `encuesta_opciones`
--
ALTER TABLE `encuesta_opciones`
  ADD PRIMARY KEY (`id_opcion`),
  ADD KEY `idx_opciones_encuesta` (`id_encuesta`);

--
-- Indices de la tabla `encuesta_respuestas`
--
ALTER TABLE `encuesta_respuestas`
  ADD PRIMARY KEY (`id_respuesta`),
  ADD UNIQUE KEY `uq_encuesta_usuario` (`id_encuesta`,`id_usuario`),
  ADD KEY `idx_respuestas_encuesta` (`id_encuesta`),
  ADD KEY `idx_respuestas_usuario` (`id_usuario`);

--
-- Indices de la tabla `foro_respuestas`
--
ALTER TABLE `foro_respuestas`
  ADD PRIMARY KEY (`id_respuesta`),
  ADD KEY `idx_foro_respuesta_tema` (`id_tema`),
  ADD KEY `idx_foro_respuesta_usuario` (`id_usuario`);

--
-- Indices de la tabla `foro_temas`
--
ALTER TABLE `foro_temas`
  ADD PRIMARY KEY (`id_tema`),
  ADD KEY `idx_foro_tema_usuario` (`id_usuario`);

--
-- Indices de la tabla `historia`
--
ALTER TABLE `historia`
  ADD PRIMARY KEY (`ID_historia`);

--
-- Indices de la tabla `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`ID_links`);

--
-- Indices de la tabla `misc`
--
ALTER TABLE `misc`
  ADD PRIMARY KEY (`ID_misc`);

--
-- Indices de la tabla `quees`
--
ALTER TABLE `quees`
  ADD PRIMARY KEY (`ID_quees`);

--
-- Indices de la tabla `raiz`
--
ALTER TABLE `raiz`
  ADD PRIMARY KEY (`ID_raiz`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`ID_recurso`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id_seccion`);

--
-- Indices de la tabla `tecnologias`
--
ALTER TABLE `tecnologias`
  ADD PRIMARY KEY (`ID_tecnologia`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chat_mensajes`
--
ALTER TABLE `chat_mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `comodin`
--
ALTER TABLE `comodin`
  MODIFY `ID_comodin` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `concursos`
--
ALTER TABLE `concursos`
  MODIFY `ID_concurso` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `ID_cursos` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `id_encuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `encuesta_opciones`
--
ALTER TABLE `encuesta_opciones`
  MODIFY `id_opcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `encuesta_respuestas`
--
ALTER TABLE `encuesta_respuestas`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `foro_respuestas`
--
ALTER TABLE `foro_respuestas`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `foro_temas`
--
ALTER TABLE `foro_temas`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historia`
--
ALTER TABLE `historia`
  MODIFY `ID_historia` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `links`
--
ALTER TABLE `links`
  MODIFY `ID_links` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `misc`
--
ALTER TABLE `misc`
  MODIFY `ID_misc` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `quees`
--
ALTER TABLE `quees`
  MODIFY `ID_quees` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `ID_recurso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id_seccion` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `tecnologias`
--
ALTER TABLE `tecnologias`
  MODIFY `ID_tecnologia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
