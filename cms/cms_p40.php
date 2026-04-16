<?php
session_start();
$n_cats=4;
$n_seccs=9;
include_once "../clases/secciones.php";
include_once "../clases/tecnologias.php";

$tecnos=Tecnologia::buscar_todas();
$secciones=Seccion::enumerar();
$n_seccs=count($secciones);
?>
<!DOCTYPE html>
<html lang="es">
 <head>
   <title>E.S.E.T N°4 de Berazategui - Plataforma 4.0 - CMS</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
     <!-- Latest compiled and minified CSS -->
<!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<!-- Latest compiled JavaScript -->
<!--script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script--->   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>



  <script src="bootstrap/cms.js"></script>
  <!--script src="bootstrap/historia_f.js"></script--->
  
<link href="bootstrap/cms.css" rel="stylesheet">

 
  <script>
        // Convertir array PHP a JavaScript usando json_encode
        secciones = <?php echo json_encode($secciones); ?>;
        tecnos = <?php echo json_encode($tecnos); ?>;
        //console.log(secciones); // Ver el array en la consola
   </script>
  
      
 </head>
 
<body width="100%">
    <div class="container-fluid" >
      <div class="row">  
        <div class="col-xs-12 col-sm-3" id="hdr">  
          <H2>CMS P4.0</H2>
        </div>
        
        <div class="col-xs-12 col-sm-9" id="hdr_tecs"> 
        <div class="row"> 
        <div id="id_cat" style=color:black;></div>
        </div>
        
        </div>
      
        
      </div>
    
      

    <div id="menu">  
      <div class="row">
      
    <?php
     for($i=0;$i<$n_cats;$i++){
        $id="M".$i+1;
       
        echo ('<div class="col-sm-2 i_menu " id="'.$id.'">Menu</div>');
     }
     
    ?>
    
      </div>  
    </div>

    <div id="smenu">  
      <div class="row">
      
    <?php
     for($i=0;$i<$n_seccs;$i++){
        $id="S".$i+1;
       
        echo ('<div class="col-sm i_smenu " id="'.$id.'">SubMenu</div>');
     }
     
    ?>
    
      </div>  
    </div>

    <div class="row">
      <div class="col-12">
        <div class="hdr_cont" id="hdr_cont" >
            <div id="id_hdr"></div>
            <div id="hdr_menu"></div>
        </div>
      </div>
    </div>
        

        <div class="row" id="Contenido">
        </div>
    </div>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!---script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script--->




    </>

    <?php
     for($i=0;$i<$n_cats;$i++){
        $id="#M".$i+1;
        echo '<script>poner_menu("'.$id.'",categorias['.$i.'].nombre);</script>';

     }
    ?>
    <script>poner_submenu();</script>
    <script>poner_tecnos();</script>
    <!--script src="bootstrap/seccion_f.js"></script--->
    <!--script>cargar("#hdr_cont","cms_hdr.php");</script-->
</body>
