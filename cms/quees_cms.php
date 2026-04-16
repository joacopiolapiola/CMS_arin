<?php
include_once "../clases/quees.php";

$datos = new Quees();

?>

<div class="container">
   
      <div class="row" >
	  <div class="col-5" >
	  <?php 
		//if (isset($_SESSION['username']) && $_SESSION['rol']=='administrador'){
		 echo '<button type="button" class="btn btn-primary"   onclick="cargar(\'#Contenido\',\'quees_alta.php\')">Alta</button>';
	    //}
	?>
      </div>
      
	  
	  <div class="col-1" ></div>
      <div class="col-3" >
        <input type="text"  id="txt_b_quees" placeholder="Buscar" >
	  </div>
	  <div class="col-2" >
		<button type="button" id="btn_b_quees" class="btn btn-primary" >Buscar</button>
       </div>
	 
	   </div>
     
	 </div> 
	 
  

 <script src="bootstrap/quees_f.js"></script>
 
</body>

</html>