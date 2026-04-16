<?php
session_start();
$n_misc=4;


include_once("clases/miscs.php");


$miscs=Misc::seleccionar_misc();
$n_misc=count($miscs);

?>
<!DOCTYPE html>
<html lang="es">
 <head>
 <script>
        // Convertir array PHP a JavaScript usando json_encode
        miscs = <?php echo json_encode($miscs); ?>;

        //console.log(secciones); // Ver el array en la consola
   </script>
 </head>
 <body>
    <!---img src="images/p40_central.png" alt="" style="opacity: 0.2"-->
    <!--div class="bg-image" 
     style="background-image: url('images/p40_central_1.png');
                height: 100vh"-->
      
 <!--div style="background-color: lightgrey;width:100% ;"-->   
    <div class="container" style="opacity: 1.0;">
    <div class="row">
    <div id="RAIZ" class="col-sm Fondo"></div>
    </div>
      <div class="row">
        <div id="F1C1" class="col-sm Fondo"></div>
        <div  id="F1C2" class="col-sm Fondo"></div>
        <div  id="F1C3" class="col-sm Fondo"></div>
        <div  id="F1C4" class="col-sm Fondo"></div>
      </div>
      <div class="row">
         <div id="F2C1" class="col-sm Fondo"></div>
         <div  id="F2C2" class="col-sm Fondo"></div>
         <div  id="F2C3" class="col-sm Fondo"></div>
         <div  id="F2C4" class="col-sm Fondo"></div>
      </div>
      <div class="row">
         <div id="F3C1" class="col-sm Fondo"></div>
         <div  id="F3C2" class="col-sm Fondo"></div>
         <div  id="F3C3" class="col-sm Fondo"></div>
         <div  id="F3C4" class="col-sm Fondo"></div>
     </div>    
    
     <div class="row">
      <div id="F4C1" class="col-sm Fondo"></div>
      <div  id="F4C2" class="col-sm Fondo"></div>
      <div  id="F4C3" class="col-sm Fondo"></div>
      <div  id="F4C4" class="col-sm Fondo"></div>
  </div>
  <div class="row">
   <div id="F5C1" class="col-sm Fondo"></div>
   <div  id="F5C2" class="col-sm Fondo"></div>
   <div  id="F5C3" class="col-sm Fondo"></div>
   <div  id="F5C4" class="col-sm Fondo"></div>
</div>   

</div>
   
   <!--/div-->

   <script>poner_raiz();</script>

   </body>
 </html>