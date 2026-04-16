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

//echo $_SERVER['PHP_SELF'];
//echo $_GET['operacion'];
if (!empty($_POST)) {

   $operacion = isset($_POST['operacion']) ? $_POST['operacion'] : 'actualizar' ;
	//echo $operacion;
	if ($operacion == 'edicion'){
	  
	  
	  $id=$_POST['id_recurso'];
	  
	  $A=Recurso::traer_datos($id);

    $id_recurso= $id;
    $titulo= $A['titulo'];
    $id_tecnologia= $A['ID_tecnologia'];
    $contenido=$A['Contenido'];
    $imagen=$A['imagen'];
    $link_referencia=$A['link_referencia'];
    $activo= $A['activo'];
    $orden= $A['orden'];

		$accion = $_SERVER['PHP_SELF'].'?operacion=actualizar&id_recurso='. $id;
		$btn_txt='Actualizar';
		$leyenda='Modificar Recurso ';
		
	}
	
  if ($operacion == 'actualizar' && isset($_GET['id_recurso'])){
    //echo '2-actualizar';
    $recurso->titulo=$_POST['txtTitulo'];
    $recurso->id_tecnologia=$_POST['txtId_tecnologia'];
    $recurso->contenido=$_POST['txtContenido'];
    $recurso->imagen=$_POST['txtImg'];
    $recurso->orden=$_POST['txtOrden'];
    $recurso->link_referencia=$_POST['txtEnlace'];
    $recurso->activo=$_POST['txtActivo'];
 
    $recurso->actualizar($_GET['id_recurso']);
  header("Location: ".$_SERVER['HTTP_REFERER']);
}		
  

if ($operacion == 'baja'){
	  
	  
  $id=$_POST['id_recurso'];

  $A=Recurso::traer_datos($id);

$titulo= $A['titulo'];
$id_tecnologia= $A['ID_tecnologia'];
$contenido=$A['Contenido'];
$imagen=$A['imagen'];
$link_referencia=$A['link_referencia'];
$activo= $A['activo'];
$orden= $A['orden'];


$accion=$_SERVER['PHP_SELF'].'?operacion=borrar&id_recurso='. $id;
$btn_txt='Borrar';
$leyenda='Eliminar';
}
    
}

if (!empty($_GET)) {
  $operacion = isset($_GET['operacion']) ? $_GET['operacion'] : 'agregar' ;
  if ($operacion == 'agregar'){
      
    $recurso->titulo=$_POST['txtTitulo'];
    $recurso->id_tecnologia=$_POST['txtId_tecnologia'];
    $recurso->contenido=$_POST['txtContenido'];
    $recurso->link_referencia=$_POST['txtEnlace'];
    $recurso->activo=$_POST['txtActivo'];
    $recurso->imagen=$_POST['txtImg'];
    $recurso->orden=$_POST['txtOrden'];

  $recurso->guardar();
  header("Location: ".$_SERVER['HTTP_REFERER']);
  }
  if ($operacion == 'borrar' && isset($_GET['id_recurso'])){
    //echo '2-actualizar';
    
  
  $recurso->borrar($_GET['id_recurso']);
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
	  <div class="row">
	    <div class="col-sm-7">
		    <label for="txtTitulo">Titulo</label>
		    <input type="text" value="<?php echo $titulo;?>" name="txtTitulo" class="form-control" >
		  </div>
      <div class="col-sm-2">
		   <label for="txtId_tecnologia">Id Tecnologia</label>
		   <input type="text" value=<?php echo $id_tecnologia;?> name="txtId_tecnologia" id="txtId_tecnologia" class="form-control">
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
		   <label  for="txtContenido">Contenido</label>
		   <textarea  rows="5" cols="80" name="txtContenido" class="form-control"><?php echo $contenido;?></textarea>
       
		  </div>
    </div>

    <div class="row">
      <div class="col-sm-4">
         <label for="txtImg">Imagen</label>
		     <input type="text" value="<?php echo $imagen;?>"  name="txtImg" class="form-control">
  		</div>

      <div class="col-sm-4">
		   <label for="txtEnlace">Enlace Web</label>
		   <input type="text"  name="txtEnlace" class="form-control" value="<?php echo $link_referencia;?>">
		  </div>
		 
      <div class="col-sm-1">
            <label for="txtActivo">Activo</label>
            <input type="text" value=<?php echo $activo;?> size="10" name="txtActivo" class="form-control">
      </div>	  

   	  <div class="col-sm-1">
		     <label for="txtOrden">Orden</label>
		     <input type="text" value=<?php echo $orden;?> name="txtOrden" class="form-control" >
		  </div>
	  
     </div>
 <button method="post" type="submit" class="btn btn-primary btn-xs"><?php echo $btn_txt;?></button>

	 </form>  
  
</div>
 
<?php
} 
?>



