<?php
session_start();
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
<script src="js/main.js"></script>
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
      
      
      
      <div class="col-sm-2" id="usuario" ></div>
      <div class="col-sm-2" id="rol_user" ></div>
      <div class="col-sm-2" id="cms_in" ></div>
      <div class="col-sm-2" ></div>
      <div class="col-sm-2" id="entrar"><a href="#" onclick="cargar('#Contenido','login.html')">Ingreso</a></div>
      <div class="col-sm-2" id="registro"><a href="#" onclick="cargar('#Contenido','registro.html')">Registro</a></div>
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

    <?php
     for($i=0;$i<$n_cats;$i++){
        $id="#M".$i+1;
        echo'<script>poner_menu("'.$id.'",categorias['.$i.'].nombre);</script>';

     }
    ?>


</body>
