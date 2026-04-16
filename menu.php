<?php
session_start();
$n_cats=11;
$n_seccs=9;
?>
<!DOCTYPE html>
<html lang="es">
 <head>
   <title>E.S.E.T N°4 de Berazategui - Plataforma 4.0 </title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>    
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
 <script>
  let categorias = [
    {id:"2", logo:"white", abrev:"IA", nombre:"INTELIGENCIA ARTIFICIAL"},
    {id:"1", logo:"pink", abrev:"IoT", nombre:"INTERNET de las COSAS"},
    {id:"3", logo:"yellow", abrev:"EC", nombre:"Computación de Borde"},
    {id:"5", logo:"green", abrev:"LM", nombre:"LEARNING MACHINE"},
    {id:"6", logo:"white", abrev:"RUR", nombre:"ROBOTICA"},
    {id:"7", logo:"green", abrev:"BD", nombre:"Big Data"},
    {id:"8", logo:"pink", abrev:"IC", nombre:"INTEGRACION CONTINUA"},
    {id:"4", logo:"blue", abrev:"CL", nombre:"Computación en la NUBE"},
    {id:"9", logo:"blue", abrev:"RA", nombre:"Realidad AUMENTADA"},
    {id:"10", logo:"blue", abrev:"I3D", nombre:"Impresion ADITIVA"},
    {id:"11", logo:"gray", abrev:"CS", nombre:"Cyberseguridad"}

         ];
    let secciones = [
    {id:"2",  nombre:"QUE ES"},
    {id:"1",  nombre:"HISTORIA"},
    {id:"3",  nombre:"CURSOS"},
    {id:"5",  nombre:"ENLACES"},
    {id:"6",  nombre:"RECURSOS"},
    {id:"7",  nombre:"FORO"},
    {id:"8",  nombre:"ENCUESTAS"},
    {id:"4",  nombre:"NOVEDADES"},
    {id:"9",  nombre:"EVENTOS"}
    

         ];

  </script>
  
  <script> 
  function cargar(div,desde)
   {
   $(div).load(desde);
   } 
   </script>
  
  <script>
   function poner_nombre(div,nombre)
   {
   $(div).text(nombre);
   } 
   </script>
  
  <script>
   function poner_menu(div,nombre)
   {
   let ix=div.slice(1);
   $(div).text(nombre);
   //$(div).attr.bk_color(categorias[ix-1].bk_color);
   //document.getElementById(div).style.backgroundColor =categorias[ix-1].bk_color;

   } 
   </script>

  

  <script>
   function poner_cat(div)
   {
   let ix=div.slice(1);
   
   let nombre=document.getElementById(div).innerHTML;
   document.getElementById("hdr_cat").innerHTML='<H3>'+categorias[ix-1].nombre+'</H3>';
   //toggleVis('submenu');
   //poner_secciones();
   } 
   function poner_p40()
   {
      document.getElementById("hdr_cat").innerHTML='<H3>Plataforma</H3>';
   //toggleVis('submenu');
   //poner_secciones();
   } 


   </script>

<script>
   function poner_secciones()
   {
        
    let id;
     
      
    for(i=0;i<secciones.length;i++){
      id="S"+(i+1);
      //$(id).text(secciones[i].nombre);
      document.getElementById(id).innerHTML=secciones[i].nombre;
      

    }
   
   } 
   </script>

   <script>
    function toggleVis(div) {
        const elemento = document.getElementById(div);
        if (elemento.style.visibility === 'hidden') {
            elemento.style.visibility = 'visible';
        } else {
            elemento.style.visibility = 'hidden';
        }
    }
</script>
   <style>
    .i_menu {
      background-color: lightgrey;
      border: 0px solid green;
      padding: 5px;
      margin: 2px;
      opacity: 0.9;
      border-radius: 0px;
    }
    .i_smenu{
      background-color: lightblue;
      border: 1px solid green;
      padding: 5px;
      margin: 2px;
      opacity: 0.7;
      border-radius: 12px;
    }
    .smenu{visibility:visible;}
    #hdr_cat{background-color: blue;
            width:85%;
          }
   </style>
 </head>
 
<body width="100%">
    <div class="container-fluid" >
      <div class="row">  
        <div class="col-xs-12 col-sm-3" id="hdr">  
          <H2>PLATAFORMA 4.0</H2>
        </div>
        
        <div class="col-xs-12 col-sm-9"> 
        <div class="row"> 
          <H4>Escuela de Educacion Técnica N°4 de Berazategui - Ricardo Lopez</H4>
        </div>
        <div id="entrar" class="row">
        <span> 
        <form method="get" action="">
            
            Usuario: <input type="text" name="login_username" id="login_username" />
            
            Contraseña:<input type="password" name="login_userpass" id="login_userpass" />
            <button id="login_userbttn">Ingresar</button>      
        </form>
        <a href="#" onclick="cargar('#Contenido','home.php')">REGISTRO</a>
        </span> 
        </div>
        </div>
      
        
      </div>
    
    

    <div id="menu">  
      <div class="row">
      
    <?php
     for($i=0;$i<$n_cats;$i++){
        $id="M".$i+1;
            echo ('<div class="col-sm-2 i_menu " id="'.$id.'" onclick="poner_cat(\''.$id.'\')">Menu</div>');
     }
     
    ?>
    
      </div>  
    </div>

    <div class="row">
          
            <div id="hdr_cat" >
              <H3>Plataforma 4.0</H3>
            </div>
    </div>
    <div class="row">
    <div class="col-sm-2 smenu"  id="submenu" >
     <?php
       for($i=0;$i<$n_seccs;$i++){
        $id="S".$i+1;
          echo ('<a href="#"><div class="row i_smenu " id="'.$id.'" onclick="cargar('.'\'#Contenido\''.','.'\'home.php\''.');">SubMenu</div></a>');
        }
    ?>
        </div>
<script>poner_secciones();</script>
        

        <div class="col-sm-10" id="Contenido">
        </div>
    </div>
    
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
