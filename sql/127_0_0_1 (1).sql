-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2026 a las 00:42:32
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
CREATE DATABASE IF NOT EXISTS `basededatos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `basededatos`;

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
(20, 11, 'Integrantesa de the cure', '\r\n<h2>Integrantes de The Cure</h2>\r\n\r\n<p><strong>The Cure</strong> es una banda británica de rock alternativo formada en 1976. A lo largo de los años, tuvo varios cambios en su formación, pero su líder y figura principal siempre fue <strong>Robert Smith</strong>, cantante, guitarrista y compositor.</p>\r\n\r\n<p>Entre los integrantes más destacados se encuentran <strong>Simon Gallup</strong> en el bajo, conocido por su estilo sólido y característico; <strong>Porl (Pearl) Thompson</strong> en guitarra, quien aportó gran parte del sonido atmosférico de la banda; y <strong>Lol Tolhurst</strong>, miembro fundador que participó en teclados y batería en los primeros años.</p>\r\n\r\n<p>Con el tiempo, otros músicos se sumaron, como <strong>Jason Cooper</strong> en batería y <strong>Roger ODonnell</strong> en teclados, consolidando el sonido único que hizo famosa a la banda.</p>\r\n\r\n<p>The Cure es reconocida por su influencia en el rock gótico y alternativo, y por mantener una identidad musical distintiva durante décadas.</p>\r\n```\r\n', 'cure-1995.jpg', '', 1, 1, 'integrantes'),
(21, 11, 'la historia de la banda', '           <h2>Historia de The Cure</h2>\r\n\r\n<p><strong>The Cure</strong> se formo en 1976 en Inglaterra, cuando un grupo de jovenes decidio crear musica con un estilo propio. Al principio, la banda tenia un sonido mas cercano al punk, pero con el tiempo fue evolucionando hacia un estilo mas oscuro y melodico.</p>\r\n\r\n<p>Su primer album, <strong>Three Imaginary Boys</strong>, fue lanzado en 1979 y marco el inicio de su carrera. Con el paso de los años, la banda gano popularidad con discos como <strong>Seventeen Seconds</strong>, <strong>Faith</strong> y <strong>Pornography</strong>, que definieron su etapa mas oscura.</p>\r\n\r\n<p>En la decada de 1980, lograron un gran exito comercial con canciones mas accesibles como <strong>Just Like Heaven</strong> y <strong>Friday Im in Love</strong>, ampliando su publico a nivel mundial.</p>\r\n\r\n<p>A pesar de los cambios en su formacion, la banda continuo activa durante las siguientes decadas, manteniendo su estilo unico y consolidandose como una de las mas influyentes del rock alternativo.</p>', 'The-Cure-Credit-Vinnie-Zuffante-Michael-Ochs-Archives-Getty-Images@2000x1500.jpg', '', 1, 2, 'history'),
(22, 11, 'canciones', '           <h2>Canciones de The Cure</h2>\r\n\r\n<p><strong>The Cure</strong> tiene una gran cantidad de canciones iconicas que marcaron la historia del rock alternativo. A continuacion, algunas de las mas conocidas con enlaces para escucharlas:</p>\r\n\r\n<ul>\r\n  <li>\r\n    <strong>Just Like Heaven</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=1ASpBpT8bRQ\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Friday Im in Love</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=mGgMZpGYiy8\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Boys Dont Cry</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=9GkVhgIeGJQ\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Lovesong</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=hXCKLJGLENs\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>A Forest</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=xik-y0xlpZ0\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n</ul>\r\n\r\n<p>Estas canciones representan distintas etapas de la banda, desde su sonido mas oscuro hasta sus momentos mas melodicos y populares.</p>', 'R-2184931-1268585027.jpg', '', 1, 3, 'cancionesdethecure'),
(23, 12, 'LOs integraNTEs de lA bandaA pAVEMEnte', '           <h2>Resumen de Pavement</h2>\r\n\r\n<p><strong>Pavement</strong> fue una banda de rock indie formada en 1989 en Estados Unidos. Es conocida por su estilo relajado, letras ironicas y sonido lo fi que influyo mucho en el indie de los años 90.</p>\r\n\r\n<p>Su lider, <strong>Stephen Malkmus</strong>, fue clave en la identidad del grupo. Alcanzaron reconocimiento con discos como <em>Slanted and Enchanted</em> y <em>Crooked Rain, Crooked Rain</em>, que se volvieron referentes del genero.</p>\r\n\r\n<p>Aunque se separaron en 1999, la banda dejo una gran huella en la musica alternativa y volvio a reunirse en algunas ocasiones para giras.</p>', 'gettyimages-466461437-612x612.jpg', '', 1, 1, 'integrantespavement'),
(24, 12, 'Cancuines de la banda', '           <h2>Canciones de Pavement</h2>\r\n\r\n<p><strong>Pavement</strong> tiene varias canciones destacadas dentro del rock indie. A continuacion, algunas de las mas conocidas con enlaces para escucharlas:</p>\r\n\r\n<ul>\r\n  <li>\r\n    <strong>Cut Your Hair</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=QTTgpTeb0Z8\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Range Life</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=1VVj1zqbWpU\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Gold Soundz</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=lPvhKV3Yg2k\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Harness Your Hopes</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=3eFZ3b0yF9g\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li>\r\n    <strong>Shady Lane</strong><br>\r\n    <a href=\"https://www.youtube.com/watch?v=8o7V0z1vXlE\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n</ul>\r\n\r\n<p>Estas canciones reflejan el estilo relajado y experimental de la banda, convirtiendolas en referentes del indie de los años 90.</p>', 'pavement-tt-reissue.jpg', '', 1, 2, 'cancionesdepavement'),
(25, 12, 'LA HISToria de la BANDAAAA', '           <h2>Historia de Pavement</h2>\r\n\r\n<p><strong>Pavement</strong> se formo en 1989 en Estados Unidos por <strong>Stephen Malkmus</strong> y <strong>Scott Kannberg</strong>. En sus inicios, la banda grabo musica con un estilo lo fi y experimental, lo que rapidamente llamo la atencion dentro de la escena indie.</p>\r\n\r\n<p>Su primer album, <em>Slanted and Enchanted</em>, lanzado en 1992, fue muy bien recibido por la critica y se convirtio en un referente del genero. Luego continuaron con discos como <em>Crooked Rain, Crooked Rain</em> y <em>Wowee Zowee</em>, consolidando su estilo unico.</p>\r\n\r\n<p>Durante los años 90, la banda gano popularidad por su sonido relajado, letras ironicas y actitud poco convencional frente a la industria musical.</p>\r\n\r\n<p>En 1999, Pavement anuncio su separacion, pero con el tiempo volvieron a reunirse en distintas ocasiones para realizar giras y presentaciones en vivo.</p>\r\n\r\n<p>Hoy en dia, son considerados una de las bandas mas influyentes del rock indie.</p>', 'gettyimages-466461437-612x612.jpg', '', 1, 3, 'historiapavement'),
(26, 13, 'LA HISToria de la BANDAAAA', '           <h2>Historia de The Velvet Underground</h2>\r\n\r\n<p><strong>The Velvet Underground</strong> se formo en la decada de 1960 en Nueva York por <strong>Lou Reed</strong> y <strong>John Cale</strong>. Desde sus comienzos, la banda se destaco por su sonido experimental y sus letras poco convencionales, que trataban temas urbanos y realistas.</p>\r\n\r\n<p>Con el apoyo del artista <strong>Andy Warhol</strong>, lanzaron su primer album <em>The Velvet Underground and Nico</em> en 1967. Aunque en su momento no tuvo gran exito comercial, con el tiempo se convirtio en uno de los discos mas influyentes de la historia del rock.</p>\r\n\r\n<p>Tras la salida de John Cale, la banda continuo con un sonido mas accesible en albumes como <em>The Velvet Underground</em> y <em>Loaded</em>, donde lograron mayor reconocimiento.</p>\r\n\r\n<p>A pesar de su corta trayectoria y cambios en la formacion, la banda se separo a principios de los años 70.</p>\r\n\r\n<p>Con el paso del tiempo, su legado crecio enormemente y hoy es considerada una de las bandas mas influyentes en la musica moderna.</p>', 'Velvet_Underground_1968_by_Billy_Name.png', '', 1, 3, 'historiavu'),
(27, 13, 'LAS MEHORES canciones', '           <h2>Canciones de The Velvet Underground</h2>\r\n\r\n<p>A continuacion, una lista de 20 canciones de <strong>The Velvet Underground</strong> con enlaces para escucharlas:</p>\r\n\r\n<ul>\r\n  <li><strong>Heroin</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Heroin\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Sunday Morning</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Sunday+Morning\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Im Waiting for the Man</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Im+Waiting+for+the+Man\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Femme Fatale</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Femme+Fatale\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Venus in Furs</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Venus+in+Furs\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>All Tomorrows Parties</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+All+Tomorrows+Parties\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Pale Blue Eyes</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Pale+Blue+Eyes\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>White Light White Heat</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+White+Light+White+Heat\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Sweet Jane</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Sweet+Jane\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Rock and Roll</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Rock+and+Roll\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Oh Sweet Nuthin</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Oh+Sweet+Nuthin\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Beginning to See the Light</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Beginning+to+See+the+Light\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>I Heard Her Call My Name</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+I+Heard+Her+Call+My+Name\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>What Goes On</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+What+Goes+On\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Run Run Run</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Run+Run+Run\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Lady Godiva Operation</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Lady+Godiva+Operation\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Some Kinda Love</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Some+Kinda+Love\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>New Age</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+New+Age\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>Stephanie Says</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+Stephanie+Says\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n\r\n  <li><strong>I Found a Reason</strong><br>\r\n    <a href=\"https://www.youtube.com/results?search_query=The+Velvet+Underground+I+Found+a+Reason\" target=\"_blank\">Escuchar en YouTube</a>\r\n  </li>\r\n</ul>', 'Velvet-Underground-Loaded-500x498.jpg', '', 1, 2, 'cancionesvu'),
(28, 14, 'INTEGRANTES DE THE STROKES', '           <h2>Integrantes de The Strokes</h2>\r\n\r\n<p><strong>The Strokes</strong> es una banda de rock formada en Nueva York, conocida por su estilo garage rock y su influencia en el indie de los años 2000.</p>\r\n\r\n<ul>\r\n  <li><strong>Julian Casablancas</strong>: voz principal y compositor, lider de la banda.</li>\r\n  <li><strong>Nick Valensi</strong>: guitarra, conocido por sus riffs caracteristicos.</li>\r\n  <li><strong>Albert Hammond Jr</strong>: guitarra ritmica y solista, tambien ha trabajado como solista.</li>\r\n  <li><strong>Nikolai Fraiture</strong>: bajo, aporta la base sonora del grupo.</li>\r\n  <li><strong>Fabrizio Moretti</strong>: bateria, responsable del ritmo y energia de la banda.</li>\r\n</ul>\r\n\r\n<p>Estos integrantes crearon uno de los sonidos mas influyentes del rock moderno.</p>', 'strokin.jpg', '', 1, 2, 'integrantesstr'),
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

CREATE TABLE `encuesta_opciones` (
  `id_opcion` int(11) NOT NULL,
  `id_encuesta` int(11) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `orden_item` int(11) NOT NULL DEFAULT 0,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `encuesta_respuestas` (
  `id_respuesta` int(11) NOT NULL,
  `id_encuesta` int(11) NOT NULL,
  `id_opcion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `creado_en` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `foro_respuestas` (
  `id_respuesta` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `creado_en` datetime NOT NULL DEFAULT current_timestamp(),
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(27, 11, 'HISTORIA', '           <h2>Historia de The Cure</h2>\r\n\r\n<p><strong>The Cure</strong> se formo en 1976 en Inglaterra, cuando un grupo de jovenes decidio crear musica con un estilo propio. Al principio, la banda tenia un sonido mas cercano al punk, pero con el tiempo fue evolucionando hacia un estilo mas oscuro y melodico.</p>\r\n\r\n<p>Su primer album, <strong>Three Imaginary Boys</strong>, fue lanzado en 1979 y marco el inicio de su carrera. Con el paso de los años, la banda gano popularidad con discos como <strong>Seventeen Seconds</strong>, <strong>Faith</strong> y <strong>Pornography</strong>, que definieron su etapa mas oscura.</p>\r\n\r\n<p>En la decada de 1980, lograron un gran exito comercial con canciones mas accesibles como <strong>Just Like Heaven</strong> y <strong>Friday Im in Love</strong>, ampliando su publico a nivel mundial.</p>\r\n\r\n<p>A pesar de los cambios en su formacion, la banda continuo activa durante las siguientes decadas, manteniendo su estilo unico y consolidandose como una de las mas influyentes del rock alternativo.</p>', 'The-Cure-Credit-Vinnie-Zuffante-Michael-Ochs-Archives-Getty-Images@2000x1500.jpg', '', 1, 2);

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
(7, 2, 'Guitarra Electrica segun la IA', '  Una guitarra eléctrica es un instrumento de cuerda con cuerpo sólido o semi-sólido (sin caja de resonancia acústica) que utiliza pastillas electromagnéticas para convertir la vibración de sus cuerdas de metal en señales eléctricas. Estas señales se envían a un amplificador externo para producir sonido. ', '', '', 1, 1);

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
(0, 'musica independiente', 'MI', '                                                                                                                                                                                        ', 'sitio para musica                                                                                                                                                                                                                                                                                                                               ', '', 1, 1, '#ffffff', '#000000', 'musica independiente', 'arin', 'calibri', '#ffffff', '#000000');

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
(12, 'pavement', 'PM', '           ', '           <h2>Resumen de Pavement</h2>\r\n\r\n<p><strong>Pavement</strong> fue una banda de rock indie formada en 1989 en Estados Unidos. Es conocida por su estilo relajado, letras ironicas y sonido lo fi que influyo mucho en el indie de los años 90.</p>\r\n\r\n<p>Su lider, <strong>Stephen Malkmus</strong>, fue clave en la identidad del grupo. Alcanzaron reconocimiento con discos como <em>Slanted and Enchanted</em> y <em>Crooked Rain, Crooked Rain</em>, que se volvieron referentes del genero.</p>\r\n\r\n<p>Aunque se separaron en 1999, la banda dejo una gran huella en la musica alternativa y volvio a reunirse en algunas ocasiones para giras.</p>', 'pavement.png', 2, 1, '#ffffff', '#000000'),
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

--
-- Índices para tablas volcadas
--

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

ALTER TABLE `encuesta_opciones`
  ADD PRIMARY KEY (`id_opcion`),
  ADD KEY `idx_opciones_encuesta` (`id_encuesta`);

ALTER TABLE `encuesta_respuestas`
  ADD PRIMARY KEY (`id_respuesta`),
  ADD UNIQUE KEY `uq_encuesta_usuario` (`id_encuesta`, `id_usuario`),
  ADD KEY `idx_respuestas_encuesta` (`id_encuesta`),
  ADD KEY `idx_respuestas_usuario` (`id_usuario`);

--
-- Indices de la tabla `chat_mensajes`
--
ALTER TABLE `chat_mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_chat_usuario` (`id_usuario`),
  ADD KEY `idx_chat_respuesta` (`id_respuesta_a`);

--
-- Indices de la tabla `foro_temas`
--
ALTER TABLE `foro_temas`
  ADD PRIMARY KEY (`id_tema`),
  ADD KEY `idx_foro_tema_usuario` (`id_usuario`);

--
-- Indices de la tabla `foro_respuestas`
--
ALTER TABLE `foro_respuestas`
  ADD PRIMARY KEY (`id_respuesta`),
  ADD KEY `idx_foro_respuesta_tema` (`id_tema`),
  ADD KEY `idx_foro_respuesta_usuario` (`id_usuario`);

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
  MODIFY `id_encuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encuesta_opciones`
--
ALTER TABLE `encuesta_opciones`
  MODIFY `id_opcion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encuesta_respuestas`
--
ALTER TABLE `encuesta_respuestas`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `chat_mensajes`
--
ALTER TABLE `chat_mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foro_temas`
--
ALTER TABLE `foro_temas`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foro_respuestas`
--
ALTER TABLE `foro_respuestas`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `ID_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Base de datos: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Volcado de datos para la tabla `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"basededatos\",\"table\":\"raiz\"},{\"db\":\"basededatos\",\"table\":\"usuarios\"},{\"db\":\"basededatos\",\"table\":\"comodin\"},{\"db\":\"basededatos\",\"table\":\"secciones\"},{\"db\":\"basededatos\",\"table\":\"tecnologias\"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Volcado de datos para la tabla `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2026-04-09 23:35:00', '{\"Console\\/Mode\":\"collapse\",\"lang\":\"es\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indices de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indices de la tabla `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indices de la tabla `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indices de la tabla `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indices de la tabla `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indices de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indices de la tabla `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indices de la tabla `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indices de la tabla `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indices de la tabla `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indices de la tabla `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Base de datos: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
