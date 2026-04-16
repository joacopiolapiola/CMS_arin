<?php
include_once "../clases/tecnologias.php";

$datos = new Tecnologia();
$tecnologia = new Tecnologia();

$id_tecnologia= '';
$nombre= '';
$abreviatura= '';
$resumen='';
$definicion= '';
$logo= '';
$orden= '';
$activo= '';
$color= '';
$bkg_color= '';



if (!empty($_POST)) {

   $operacion = isset($_POST['operacion']) ? $_POST['operacion'] : 'actualizar' ;
	//echo $operacion;
	if ($operacion == 'edicion'){
	  
	  
	  $id=$_POST['id_tecnologia'];
	  
	  $A=Tecnologia::traer_datos($id);

    $id_tecnologia= $id;
    $nombre= $A['nombre'];
    $abreviatura= $A['abreviatura'];
    $resumen=$A['resumen'];
    $definicion=$A['definicion'];
    $logo=$A['logo'];
    $color=$A['color'];
    $bkg_color=$A['bkg_color'];
    $activo= $A['activo'];
    $orden= $A['orden'];

		$accion = $_SERVER['PHP_SELF'].'?operacion=actualizar&id_tecnologia='. $id;
		$btn_txt='Actualizar';
		$leyenda='Modificar Topico ';
		
	}
	
  if ($operacion == 'actualizar' && isset($_GET['id_tecnologia'])){
    //echo '2-actualizar';
    $tecnologia->nombre=$_POST['txtNombre'];
    $tecnologia->abreviatura=$_POST['txtAbreviatura'];
    $tecnologia->resumen=$_POST['txtResumen'];
    $tecnologia->definicion=$_POST['txtDefinicion'];
    $tecnologia->logo=$_POST['txtLogo'];
    $tecnologia->orden=$_POST['txtOrden'];
    $tecnologia->activo=$_POST['txtActivo'];
    $tecnologia->color=$_POST['txtColor'];
    $tecnologia->bkg_color=$_POST['txtBkgColor'];
 
    $tecnologia->actualizar($_GET['id_tecnologia']);
  header("Location: ".$_SERVER['HTTP_REFERER']);
}		
  

if ($operacion == 'baja'){
	  
	  
  $id=$_POST['id_tecnologia'];

  $A=Tecnologia::traer_datos($id);

  $nombre= $A['nombre'];
  $abreviatura= $A['abreviatura'];
  $resumen=$A['resumen'];
  $definicion=$A['definicion'];
  $logo=$A['logo'];
  $color=$A['color'];
  $bkg_color=$A['bkg_color'];
  $activo= $A['activo'];
  $orden= $A['orden'];


$accion=$_SERVER['PHP_SELF'].'?operacion=borrar&id_tecnologia='. $id;
$btn_txt='Borrar';
$leyenda='Eliminar';
}
    
}

if (!empty($_GET)) {
  $operacion = isset($_GET['operacion']) ? $_GET['operacion'] : 'agregar' ;
  if ($operacion == 'agregar'){
      
    $tecnologia->nombre=$_POST['txtNombre'];
    $tecnologia->abreviatura=$_POST['txtAbreviatura'];
    $tecnologia->resumen=$_POST['txtResumen'];
    $tecnologia->definicion=$_POST['txtDefinicion'];
    $tecnologia->logo=$_POST['txtLogo'];
    $tecnologia->orden=$_POST['txtOrden'];
    $tecnologia->activo=$_POST['txtActivo'];
    $tecnologia->color=$_POST['txtColor'];
    $tecnologia->bkg_color=$_POST['txtBkgColor'];

  $tecnologia->guardar();
  header("Location: ".$_SERVER['HTTP_REFERER']);
  }
  if ($operacion == 'borrar' && isset($_GET['id_tecnologia'])){
    //echo '2-actualizar';
    
  
  $tecnologia->borrar($_GET['id_tecnologia']);
  header("Location: ".$_SERVER['HTTP_REFERER']);
  }

}

?>

<?php
if ($operacion == 'edicion' || $operacion == 'baja'){
?>

<div class="container">
  
   
  <form  role="form" method="POST" action="<?php echo $accion;?>">
   <legend><?php echo $leyenda;?></legend>
      
	 <div class="form-group">
	 <div class="row" >
	     <div class="col-sm-6">
		  <label>Nombre</label>
		  <input type="text" value="<?php echo $nombre;?>" size="20" name="txtNombre" class="form-control" id="txtNombre" >
		 </div>
		 
		 <div class="col-sm-2">
		   <label>Abreviatura</label>
		   <input type="text" value="<?php echo $abreviatura;?>" name="txtAbreviatura" class="form-control" id="txtAbreviatura">
		 </div>
		 
		 <div class="col-sm-1">
		   <label>Orden</label>
		   <input type="text" value="<?php echo $orden;?>" name="txtOrden" class="form-control" id="txtOrden">
		</div>
	 </div>
     <div class="row"> 
         <div class="col-xs-8">
		   <label>Definicion</label>
		   <textarea  rows="4" cols="60" name="txtDefinicion" class="form-control"><?php echo $definicion;?>
           </textarea> 
		 </div>
         <div class="col-xs-4">
		   <label>Resumen</label>
		   <textarea  rows="4" cols="30" name="txtResumen" class="form-control"><?php echo $resumen;?>
           </textarea> 
		 </div>
     </div>
	 <div class="row" >	 
		<div class="col-sm-3">
		   <label>Logo</label>
		   <input type="text" value="<?php echo $logo;?>" name="txtLogo" class="form-control" id="txtLogo">
		</div>
        <div class="col-sms-1">
            <label>Activo</label>
            <input type="text" value="<?php echo $activo;?>" size="10" name="txtActivo" class="form-control" id="tit_link">
        </div>
		<div class="col-xs-4">
		   <label for="txtColor">Color</label>
       <span> <input type="color" id="color" value="<?php echo $color;?>" onchange="PonerColor()"></span>
		   <input type="text" value="<?php echo $color;?>" name="txtColor" class="form-control" id="txtColor">
		</div>	  
        
        <div class="col-xs-4">
		   <label for="txtBkgColor">BackGround Color</label>
       <span><input type="color" id="bkgcolor" value="<?php echo $bkg_color;?>" onchange="PonerBkgColor()"></span>
		   <input type="text"  value="<?php echo $bkg_color;?>" name="txtBkgColor" class="form-control" id="txtBkgColor">
		</div> 
       
   	 </div>
	  
<br>
 <button method="post" type="submit" class="btn btn-primary btn-xs"><?php echo $btn_txt;?></button>

</form>  

</div>
 
<?php
} 
?>



