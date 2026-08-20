<?php
session_start();
require_once __DIR__ . '/clases/permisos.php';
$n_cats=12;
$n_seccs=10;

include_once "clases/secciones.php";
include_once "clases/tecnologias.php";
//include_once "clases/miscs.php";
include_once "clases/raiz.php";

$secciones=Seccion::buscar();
$tecnologias=Tecnologia::buscar();
$raiz=Raiz::traer_datos(0);
$n_seccs=count($secciones);
$n_cats=count($tecnologias);
//$miscs=Misc::seleccionar_misc();

$sesionActiva = !empty($_SESSION['login_exitoso']) && (
  !empty($_SESSION['user']['id']) || !empty($_SESSION['id_usuario'])
);
$nombreSesion = $sesionActiva ? (string) ($_SESSION['user']['nombre'] ?? $_SESSION['nombre_usuario'] ?? $_SESSION['name_sess'] ?? '') : '';
$rolesSesion = $sesionActiva ? PermisosSistema::rolesUsuario() : [];
$rolSesion = implode(', ', $rolesSesion);
$puedeUsarCms = $sesionActiva && (
  PermisosSistema::tieneRol('administrador', 'admin', 'superadmin')
  || PermisosSistema::tienePermiso('cms:read', 'cms:write')
);

?>
<!DOCTYPE html>
<html lang="es">
 <head>
   <title>E.E.S.T N°4 de Berazategui - Plataforma 4.0 </title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!--link rel="icon" type="image/png" href="images/icono.png"-->
     <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="icon" type="image/ico" href="favicon.ico">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>    
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
<script src="js/main.js?v=<?php echo (int) filemtime(__DIR__ . '/js/main.js'); ?>"></script>
<link href="css/main.css" rel="stylesheet">

 <script>
        // Convertir array PHP a JavaScript usando json_encode
        secciones = <?php echo json_encode($secciones); ?>;

        //console.log(secciones); // Ver el array en la consola
 </script>
 <script>
        
        categorias = <?php echo json_encode($tecnologias); ?>;
        raiz = <?php echo json_encode($raiz); ?>;
 </script> 
  
   
 </head>
 
<body width="100%">

    <!---div class="container-fluid" >
    <table width="100%">
      <tr>  
        <td width="30%">
          <div id="hdr">  
            <H2><a href="#" onclick="poner_p40();">PLATAFORMA 4.0</a></H2>
          </div>
        </td>
        
        <td  width="50%">
           <H4>E.E.S.T N°4 de Berazategui - Ricardo Lopez</H4>
        </td>
        
      </tr>
    </table>  
        
    </div--->


    <div class="container-fluid" >
    
      <div class="row">  
        <div class="col-sm-3">
          <div id="hdr">  
            <H2><a href="#" onclick="poner_p40();" id="hdr_sitio">PLATAFORMA 4.0</a></H2>
          </div>
        </div>
        
        <div class="col-sm-6">
           <H5 id="hdr_institucion">E.E.S.T N°4 de Berazategui - Ricardo Lopez</H5>
        </div>
        <div class="col-sm-1" id="contacto" ><a href="#">CONTACTO</a></div>
        <div class="col-sm-1" id="id_cat" style=color:white;>0</div>
        <div class="col-sm-1" id="orden" style=color:white;>0</div>
      </div>
   
        
    </div>
    
    
    
    
   <div class="container-fluid">
   <div class="row">
      
      
      
      <div class="col-sm-2" id="usuario"><?php echo htmlspecialchars($nombreSesion, ENT_QUOTES, 'UTF-8'); ?></div>
      <div class="col-sm-2" id="rol_user"><?php echo htmlspecialchars($rolSesion, ENT_QUOTES, 'UTF-8'); ?></div>
      <div class="col-sm-2" id="cms_in"><?php if ($puedeUsarCms): ?><a href="./cms/cms_p40.php" target="_blank" rel="noopener">Cms</a><?php endif; ?></div>
      <div class="col-sm-2" ></div>
      <div class="col-sm-2" id="chat_general"><a href="#" onclick="cargar('#Contenido','chat.php')">Chat general</a></div>
      <div class="col-sm-2" id="foro_general"><a href="#" onclick="cargar('#Contenido','foro.php')">Foro</a></div>
      <div class="col-sm-2" id="encuestas_general"><a href="#" onclick="cargar('#Contenido','encuesta.php')">Encuestas</a></div>
      <div class="col-sm-2" id="entrar"><?php if ($sesionActiva): ?><a href="session_out.php">Cerrar sesion</a><?php else: ?><a href="#" onclick="cargar('#Contenido','login.html'); return false;">Ingreso</a><?php endif; ?></div>
      <div class="col-sm-2" id="registro"<?php if ($sesionActiva): ?> style="display: none;"<?php endif; ?>><a href="#" onclick="cargar('#Contenido','registro.html'); return false;">Registro</a></div>
   </div>  
   </div>


    <table>
    <tr>
    <div id="menu">  
           
    <?php
     for($i=0;$i<$n_cats;$i++){
        $id="M".$i+1;
            echo ('<td widht="10%" height="60px"><a href="#"><div class="i_menu " id="'.$id.'" onclick="poner_cat(\''.$id.'\')">Menu</div></a></td>');
     }
     
    ?>
    
      
    </div>
    </tr>
    </table>
    <table>
    <tr>
        <td widht="40%">  
            <div class="hdr_cat" id="hdr_cat" >
              <H4>Plataforma</H4>
            </div>
        </td>
        <td widht="5%"><div class="abreviatura" id="abreviatura" ></div></div></td>
        <td widht="50%"><div class="resumen" id="resumen" ></div></div></td>
        <td widht="5%"><div class="logo" id="logo" ></div></div></td>
    </tr>
    </table>
    <div class="row">
    <div class="col-sm-2 smenu"  id="submenu" >
     <?php
       for($i=0;$i<$n_seccs;$i++){
        $id="S".$i+1;
          echo ('<a href="#"><div class="row i_smenu" id="'.$id.'">SubMenu</div></a>');
        }
     ?>
        </div>

    <div class="col-sm-10" id="Principal">
      <div class="row">
      <div class="col-sm-10" id="Hdr_Contenido" style="text-align: right">
      <!--button class="nav-btn left" onclick="slidePrev()">Anterior</button>
      MISCELANEAS-NOTAS-CURIOSIDADES
      <button class="nav-btn right" onclick="slideNext()">Proximo</button-->
      </div>
      <div class="row">  
        <div class="col-sm-10" id="Contenido">
        <img src="images/p40_central.png" alt="">
        </div></div>
    </div>
    </div>
    
    
    <script>poner_p40();</script>
    <!--script>poner_secciones();</script--->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!---script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script--->




    </div>

    <button type="button" id="themeToggle" class="theme-toggle" aria-label="Cambiar tema">🌙 Modo oscuro</button>

    <script>
      (function () {
        const body = document.body;
        const toggle = document.getElementById('themeToggle');
        const mediaQuery = typeof window.matchMedia === 'function'
          ? window.matchMedia('(prefers-color-scheme: dark)')
          : null;

        function getSavedTheme() {
          try { return window.localStorage.getItem('site_theme'); } catch (error) { return null; }
        }

        function saveTheme(theme) {
          try { window.localStorage.setItem('site_theme', theme); } catch (error) {}
        }

        function applyTheme(theme) {
          const isDark = theme === 'dark';
          body.setAttribute('data-theme', isDark ? 'dark' : 'light');
          if (toggle) {
            toggle.textContent = isDark ? '☀️ Modo claro' : '🌙 Modo oscuro';
            toggle.setAttribute('aria-pressed', String(isDark));
          }
          saveTheme(theme);
        }

        const savedTheme = getSavedTheme();
        const initialTheme = savedTheme || (mediaQuery && mediaQuery.matches ? 'dark' : 'light');
        applyTheme(initialTheme);

        if (toggle) {
          toggle.addEventListener('click', function () {
            const currentTheme = body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            applyTheme(currentTheme);
          });
        }

        if (mediaQuery && typeof mediaQuery.addEventListener === 'function') {
          mediaQuery.addEventListener('change', function (event) {
            if (!getSavedTheme()) {
              applyTheme(event.matches ? 'dark' : 'light');
            }
          });
        } else if (mediaQuery && typeof mediaQuery.addListener === 'function') {
          mediaQuery.addListener(function (event) {
            if (!getSavedTheme()) {
              applyTheme(event.matches ? 'dark' : 'light');
            }
          });
        }
      })();
    </script>

    <?php
     for($i=0;$i<$n_cats;$i++){
        $id="#M".$i+1;
        echo'<script>poner_menu("'.$id.'",categorias['.$i.'].nombre);</script>';

     }
    ?>


</body>
