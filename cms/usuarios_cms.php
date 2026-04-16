<?php
include_once "../clases/usuarios.php";

$datos = new Usuario();

?>

<div class="container">
   
      <div class="row" >
	  <div class="col-5" >
<?php 
		//if (isset($_SESSION['username']) && $_SESSION['rol']=='administrador'){
		 echo '<button type="button" class="btn btn-primary"   onclick="cargar(\'#Contenido\',\'usuario_alta.php\')">Alta</button>';
	    //}
?>
      </div>
      
	  
	  <div class="col-1" ></div>
      <div class="col-3" >
        <input type="text"  id="txt_b_usuario" placeholder="Buscar por nombre,e-mail,institucion" >
	  </div>
	  <div class="col-2" >
		<button type="button" id="btn_b_usuario" class="btn btn-primary" >Buscar</button>
       </div>
	 
	   </div>
     
	 </div> 
	 
  

 <script src="bootstrap/usuario_f.js"></script>
 
</body>

</html>