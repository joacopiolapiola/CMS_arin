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
$accion='';
$enlace_cms= '';
$leyenda='';

//echo $_SERVER['PHP_SELF'];
//echo $_GET['operacion'];

if (!empty($_POST)) {

   $operacion = isset($_POST['operacion']) ? $_POST['operacion'] : 'actualizar' ;
	//echo $operacion;
	if ($operacion == 'edicion'){
	  
	  
	  $id=$_POST['id_seccion'];
	  
	  $A=Seccion::traer_datos($id);

	    $nombre= $A['nombre'];
      $id_tecnologia=$A['id_tecnologia'];
      $orden= $A['orden'];
      $enlace= $A['enlace'];
      $activo= $A['Activo'];
      $enlace_cms= $A['enlace_cms'];
	  
      
		
		$accion = $_SERVER['PHP_SELF'].'?operacion=actualizar&id_seccion='. $id;
		$btn_txt='Actualizar';
		$leyenda='Modificar Seccion ';
		
	}
	
  if ($operacion == 'actualizar' && isset($_GET['id_seccion'])){
    //echo '2-actualizar';
    $seccion->nombre=$_POST['txtNombre'];
    $seccion->id_tecnologia=$_POST['TxtId_tecnologia'];
    $seccion->orden=$_POST['txtOrden'];
    $seccion->enlace=$_POST['txtEnlace'];
    $seccion->activo=$_POST['txtActivo'];
    $seccion->enlace_cms=$_POST['txtEnlace_cms'];
  
  
  
  
  $seccion->actualizar($_GET['id_seccion']);
  
  header("Location: ".$_SERVER['HTTP_REFERER']);
  //echo "<script>preparar('#hdr_menu','secciones_cms.php','#id_hdr','SECCIONES');</script>";
  //
}		
  

if ($operacion == 'baja'){
	  
	  
  $id=$_POST['id_seccion'];

  $A=Seccion::traer_datos($id);

  $nombre= $A['nombre'];
  $id_tecnologia=$A['id_tecnologia'];
  $orden= $A['orden'];
  $enlace= $A['enlace'];
  $activo= $A['Activo'];
  $enlace_cms= $A['enlace_cms'];

$accion=$_SERVER['PHP_SELF'].'?operacion=borrar&id_seccion='. $id;
$btn_txt='Borrar';
$leyenda='Eliminar';
}

	

	
    
}

if (!empty($_GET)) {
  $operacion = isset($_GET['operacion']) ? $_GET['operacion'] : 'agregar' ;
  if ($operacion == 'agregar'){
      
    $seccion->nombre=$_POST['txtNombre'];
    $seccion->id_tecnologia=$_POST['TxtId_tecnologia'];
    $seccion->orden=$_POST['txtOrden'];
    $seccion->enlace=$_POST['txtEnlace'];
    $seccion->activo=$_POST['txtActivo'];
    $seccion->enlace_cms=$_POST['txtEnlace_cms'];
      
  $seccion->guardar();
  header("Location: ".$_SERVER['HTTP_REFERER']);
  }
  if ($operacion == 'borrar' && isset($_GET['id_seccion'])){
    //echo '2-actualizar';
    
  
  $seccion->borrar($_GET['id_seccion']);
  header("Location: ".$_SERVER['HTTP_REFERER']);
  }

}

?>

<?php
if ($operacion == 'edicion' || $operacion == 'baja'){
  ?>
<div class="container">
  
   
  <form  role="form" method="POST" action=<?php echo $accion;?>>
   <legend><?php echo $leyenda;?></legend>
      
	 <div class="form-group">
	 <div class="row" >
	     <div class="col-sm-6">
		  <label for="txtNombre">Nombre</label>
		  <input type="text"  value="<?php echo $nombre;?>" name="txtNombre" class="form-control" id="txtNombre">
		 </div>
		 
		 <div class="col-sm-2">
		   <label for="TxtId_tecnologia">Id Tecnologia</label>
		   <input type="text" value=<?php echo $id_tecnologia;?> name="TxtId_tecnologia" class="form-control" id="TxtId_tecnologia">
		 </div>
		 
		 <div class="col-sm-1">
		   <label for="txtOrden">Orden</label>
		   <input type="text" value=<?php echo $orden;?> name="txtOrden" class="form-control" id="txtOrden">
		</div>
	 </div>
	 <div class="row" >	 
		<div class="col-sm-5">
		   <label for="txtEnlace">Enlace</label>
		   <input type="text" value="<?php echo $enlace;?>" name="txtEnlace" class="form-control" id="txtEnlace">
		</div>
        <div class="col-sms-1">
            <label for="txtActivo">Activo</label>
            <input type="text" value=<?php echo $activo;?> size="10" name="txtActivo" class="form-control" id="txtActivo">
        </div>
		<div class="col-xs-5">
		   <label for="txtEnlace_cms">Enlace CMS</label>
		   <input type="text" value="<?php echo $enlace_cms;?>" name="txtEnlace_cms" class="form-control" id="txtEnlace_cms">
		</div>	   
   	 </div>
	  

 <button method="post" type="submit" class="btn btn-primary btn-xs"><?php echo $btn_txt;?></button>

</form>  

</div>
 <?php
} 
?>



