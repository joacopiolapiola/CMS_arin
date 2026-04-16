<?php
include_once "../clases/secciones.php";

$datos = new Seccion();

?>

<div class="container">
   
      <div class="row" >
	  <div class="col-5" >
	  <?php 
		//if (isset($_SESSION['username']) && $_SESSION['rol']=='administrador'){
		 echo '<button type="button" class="btn btn-primary"   onclick="cargar(\'#Contenido\',\'seccion_alta.php\')">Alta</button>';
	    //}
	?>
      </div>
      
	  
	  <div class="col-1" ></div>
      <div class="col-3" >
        <input type="text"  id="txt_b_seccion" placeholder="Buscar por nombre,id_tecnologia ó enlace" >
	  </div>
	  <div class="col-2" >
		<button type="button" id="btn_b_seccion" class="btn btn-primary" >Buscar</button>
       </div>
	 
	   </div>
     
	 </div> 
	 
  

 <script src="bootstrap/seccion_f.js"></script>
 
</body>

</html>