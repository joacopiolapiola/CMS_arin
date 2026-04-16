    <button onclick="insertarTextoEnCursor('txtContenido','<br>')">br</button>
    <button onclick="insertarTextoEnCursor('txtContenido','<b>')">b</button>
    <button onclick="insertarTextoEnCursor('txtContenido','</b>')">/b</button>
    <button onclick="insertarTextoEnCursor('txtContenido','<li>')">li</button>
    <button onclick="insertarTextoEnCursor('txtContenido','</li>')">/li</button>
    <button onclick="insertarTextoEnCursor('txtContenido','<h2>')">h2</button>
    <button onclick="insertarTextoEnCursor('txtContenido','</h2>')">/h2</button>
    <button onclick="insertarTextoEnCursor('txtContenido','<u>')">u</button>
    <button onclick="insertarTextoEnCursor('txtContenido','</u>')">/u</button>
    <button onclick="insertarTextoEnCursor('txtContenido','<i>')">i</button>
    <button onclick="insertarTextoEnCursor('txtContenido','</i>')">/i</button>
    
<?php
include_once "../clases/comodin.php";
include_once "../clases/tecnologias.php";



$comodin = new Comodin();
$cats=Tecnologia::seleccionar();

$id_comodin= '';
$titulo= '';
$id_tecnologia= '';
$contenido='';
$imagen='';
$link_referencia='';
$activo= '';
$orden= '';
$seccion= '';

//echo $_SERVER['PHP_SELF'];
//echo $_GET['operacion'];
if (!empty($_POST)) {

   $operacion = isset($_POST['operacion']) ? $_POST['operacion'] : 'actualizar' ;
	//echo $operacion;
	if ($operacion == 'edicion'){
	  
	  
	  $id=$_POST['id_comodin'];
	  
	  $A=Comodin::traer_datos($id);

    $id_comodin= $id;
    $titulo= $A['titulo'];
    $id_tecnologia= $A['ID_tecnologia'];
    $contenido=$A['Contenido'];
    $imagen=$A['imagen'];
    $link_referencia=$A['link_referencia'];
    $activo= $A['activo'];
    $orden= $A['orden'];
    $seccion= $A['seccion'];

		$accion = $_SERVER['PHP_SELF'].'?operacion=actualizar&id_comodin='. $id;
		$btn_txt='Actualizar';
		$leyenda='Modificar Comodin ';
		
	}
	
  if ($operacion == 'actualizar' && isset($_GET['id_comodin'])){
    //echo '2-actualizar';
    $comodin->titulo=$_POST['txtTitulo'];
    $comodin->id_tecnologia=$_POST['txtId_tecnologia'];
    $comodin->contenido=$_POST['txtContenido'];
    $comodin->imagen=$_POST['txtImg'];
    $comodin->orden=$_POST['txtOrden'];
    $comodin->link_referencia=$_POST['txtEnlace'];
    $comodin->activo=$_POST['txtActivo'];
    $comodin->seccion=$_POST['txtSeccion'];
 
    $comodin->actualizar($_GET['id_comodin']);
  header("Location: ".$_SERVER['HTTP_REFERER']);
}		
  

if ($operacion == 'baja'){
	  
	  
  $id=$_POST['id_comodin'];

  $A=Comodin::traer_datos($id);

$titulo= $A['titulo'];
$id_tecnologia= $A['ID_tecnologia'];
$contenido=$A['Contenido'];
$imagen=$A['imagen'];
$link_referencia=$A['link_referencia'];
$activo= $A['activo'];
$orden= $A['orden'];
$seccion= $A['seccion'];


$accion=$_SERVER['PHP_SELF'].'?operacion=borrar&id_comodin='. $id;
$btn_txt='Borrar';
$leyenda='Eliminar';
}
    
}

if (!empty($_GET)) {
  $operacion = isset($_GET['operacion']) ? $_GET['operacion'] : 'agregar' ;
  if ($operacion == 'agregar'){
      
    $comodin->titulo=$_POST['txtTitulo'];
    $comodin->id_tecnologia=$_POST['txtId_tecnologia'];
    $comodin->contenido=$_POST['txtContenido'];
    $comodin->link_referencia=$_POST['txtEnlace'];
    $comodin->activo=$_POST['txtActivo'];
    $comodin->imagen=$_POST['txtImg'];
    $comodin->orden=$_POST['txtOrden'];
    $comodin->seccion=$_POST['txtSeccion'];

  $comodin->guardar();
  header("Location: ".$_SERVER['HTTP_REFERER']);
  }
  if ($operacion == 'borrar' && isset($_GET['id_comodin'])){
    //echo '2-actualizar';
    
  
  $comodin->borrar($_GET['id_comodin']);
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
        <div class="col-sm-2">
          <label>Seccion</label>
		  <input type="text" value="<?php echo $seccion;?>" name="txtSeccion" class="form-control">
		 </div>
	    <div class="col-sm-5">
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
		   <textarea  rows="5" cols="80" name="txtContenido" id="txtContenido" class="form-control"><?php echo $contenido;?></textarea>
       
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



