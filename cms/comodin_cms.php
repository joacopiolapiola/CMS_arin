<?php
include_once "../clases/comodin.php";

$datos = new Comodin();

?>

<div class="container">
   
      <div class="row" >
	  <div class="col-5" >
	  <?php 
		//if (isset($_SESSION['username']) && $_SESSION['rol']=='administrador'){
		 echo '<button type="button" class="btn btn-primary"   onclick="cargar(\'#Contenido\',\'comodin_alta.php\')">Alta</button>';
	    //}
	?>
      </div>
      
	  
	  <div class="col-1" ></div>
      <div class="col-3" >
        <input type="text"  id="txt_b_comodin" placeholder="Buscar" >
	  </div>
	  <div class="col-2" >
		<button type="button" id="btn_b_comodin" class="btn btn-primary" >Buscar</button>
       </div>
	 
	   </div>
     
	 </div> 
	 
  

 <script src="bootstrap/comodin_f.js"></script>
 
</body>

</html>