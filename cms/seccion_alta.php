<?php
include_once "../clases/secciones.php";


$cats=Seccion::nombres();

$datos = new Seccion();
$seccion = new Seccion();

$id_seccion= '';
$nombre= '';
$id_tecnologia= '';
$orden= '';
$enlace= '';
$activo= '';
$enlace_cms= '';


?>

 
<div class="container">
  
   
  <form  role="form" method="POST" action="seccion_edit.php?operacion=agregar">
   <legend>Alta Seccion</legend>
      
	 <div class="form-group">
	 <div class="row" >
	     <div class="col-sm-6">
		  <label>Nombre</label>
		  <input type="text"  size="20" name="txtNombre" class="form-control" id="txtNombre" >
		 </div>
		 
		 <div class="col-sm-2">
		   <label>Id Tecnologia</label>
		   <input type="text" name="TxtId_tecnologia" class="form-control" id="TxtId_tecnologia">
		 </div>
		 
		 <div class="col-sm-1">
		   <label>Orden</label>
		   <input type="text" name="txtOrden" class="form-control" id="txtOrden">
		</div>
	 </div>
	 <div class="row" >	 
		<div class="col-sm-5">
		   <label>Enlace</label>
		   <input type="text"  name="txtEnlace" class="form-control" id="txtEnlace" >
		</div>
        <div class="col-sms-1">
            <label>Activo</label>
            <input type="text"  size="10" name="txtActivo" class="form-control" id="txtActivo">
        </div>
		<div class="col-xs-5">
		   <label>Enlace CMS</label>
		   <input type="text"  name="txtEnlace_cms" class="form-control" id="txtEnlace_cms">
		</div>	   
   	 </div>
	  

 <button method="post" type="submit" class="btn btn-primary btn-xs">Agregar</button>

</form>  

</div>

