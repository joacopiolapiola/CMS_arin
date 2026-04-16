<?php
include_once "../clases/recursos.php";
include_once "../clases/tecnologias.php";

$cats=Tecnologia::seleccionar();


$recurso = new Recurso();

$id_recurso= '';
$titulo= '';
$id_tecnologia= '';
$contenido='';
$imagen='';
$link_referencia='';
$activo= '';
$orden= '';



?>

 
<div class="container">
  
 
   
  <form  role="form" method="POST" action="recurso_edit.php?operacion=agregar">
   <legend>Alta Recurso</legend>
     
   
	 <div class="form-group">
	  <div class="row">
	     <div class="col-sm-7">
		  <label>Titulo</label>
		  <input type="text" name="txtTitulo" class="form-control">
		 </div>
         <div class="col-sm-2">
		   <label>Id Tecnologia</label>
		   <input type="text" name="txtId_tecnologia" id="txtId_tecnologia" class="form-control">
		 </div>
		 <div class="col-sm-3">
		 <label for="nombre">Tecnologia :</label>
			<select id="nombre" name="nombre" onchange="PonerCodigoTec();" class="form-control">
			<?php
		  foreach($cats as $cat){
           echo '<option value="'.$cat['nombre'].'" data-codigo="'.$cat['id_tecnologia'].'">'.$cat['nombre'].'</option>';
		  
          }?> 
			</select>
		 </div>
      </div>  
      <div class="row"> 
         <div class="col-xs-12">
		   <label>Contenido</label>
		   <textarea  rows="5" cols="80" name="txtContenido" class="form-control">
           </textarea> 
		 </div>
     </div>

     <div class="row">
         <div class="col-sm-4">
         <label>Imagen</label>
		   <input type="text" name="txtImg" id="txtImg" class="form-control">
		 </div>

         <div class="col-sm-4">
		   <label>Enlace Web</label>
		   <input type="text"  name="txtEnlace" class="form-control">
		 </div>
		 
         <div class="col-sm-1">
            <label>Activo</label>
            <input type="text"  size="10" name="txtActivo" class="form-control">
        </div>	  

   	    <div class="col-sm-1">
		   <label>Orden</label>
		   <input type="text" name="txtOrden" class="form-control">
		</div><br>
		<div class="row">  
    <form>		
	 <div class="col-sm-8">
	  	<label for="fileToUpload">Imagen</label>
			<input type="file"  name="fileToUpload" id="fileToUpload" onchange="upload_image();PonerNombreArchivo();" class="form-group">
	    </div>
		<div class="upload-msg">

		</div><!--Para mostrar la respuesta del archivo llamado via ajax -->
	</form>	
	 <div class="col-sm-4">
      <button method="post" type="submit" class="btn btn-primary btn-xs">Agregar</button>
     </div>
    </div>
	  
     </div>


	 </form>  
  
</div>

