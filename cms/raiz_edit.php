<?php
include_once "../clases/raiz.php";

$datos = new Raiz();
$raiz = new Raiz();

$id_raiz= '';
$nombre= '';
$abreviatura= '';
$resumen='';
$definicion = '';
$logo= '';
$orden= '';
$activo= '';
$color= '';
$bkg_color= '';
$nombre_sitio= '';
$nombre_institucion= '';
$fuente= '';
$color_gral= '';
$bkg_color_gral= '';



if (!empty($_POST)) {

   $operacion = isset($_POST['operacion']) ? $_POST['operacion'] : 'actualizar' ;
	//echo $operacion;
	if ($operacion == 'edicion'){
	  
	  
	  $id=$_POST['id_raiz'];
	  
	  $A=Raiz::traer_datos($id);

    $id_raiz= $id;
    $nombre= $A['nombre'];
    $abreviatura= $A['abreviatura'];
    $resumen=$A['resumen'];
    $definicion=$A['definicion'];
    $logo=$A['logo'];
    $color=$A['color'];
    $bkg_color=$A['bkg_color'];
    $activo= $A['activo'];
    $orden= $A['orden'];
    $nombre_sitio=$A['nombre_sitio'];
    $nombre_institucion=$A['nombre_institucion'];
    $fuente= $A['fuente'];
    $color_gral=$A['color_gral'];
    $bkg_color_gral=$A['bkg_color_gral'];

		$accion = $_SERVER['PHP_SELF'].'?operacion=actualizar&id_raiz='. $id;
		$btn_txt='Actualizar';
		$leyenda='Modificar Raiz ';
		
	}
	
  if ($operacion == 'actualizar' && isset($_GET['id_raiz'])){
    //echo '2-actualizar';
    $raiz->nombre=$_POST['txtNombre'];
    $raiz->abreviatura=$_POST['txtAbreviatura'];
    $raiz->resumen=$_POST['txtResumen'];
    $raiz->definicion=$_POST['txtDefinicion'];
    $raiz->logo=$_POST['txtLogo'];
    $raiz->orden=$_POST['txtOrden'];
    $raiz->activo=$_POST['txtActivo'];
    $raiz->color=$_POST['txtColor'];
    $raiz->bkg_color=$_POST['txtBkgColor'];
    $raiz->nombre_sitio=$_POST['txt_nombre_sitio'];
    $raiz->nombre_institucion=$_POST['txt_nombre_institucion'];
    $raiz->fuente= $_POST['txt_fuente'];
    $raiz->color_gral=$_POST['txtColorGral'];
    $raiz->bkg_color_gral=$_POST['txtBkgColorGral'];
 
    $raiz->actualizar($_GET['id_raiz']);
  header("Location: ".$_SERVER['HTTP_REFERER']);
}		
  

if ($operacion == 'baja'){
	  
	  
  $id=$_POST['id_raiz'];

  $A=Raiz::traer_datos($id);

  $nombre= $A['nombre'];
  $abreviatura= $A['abreviatura'];
  $resumen=$A['resumen'];
  $definicion=$A['definicion'];
  $logo=$A['logo'];
  $color=$A['color'];
  $bkg_color=$A['bkg_color'];
  $activo= $A['activo'];
  $orden= $A['orden'];
  $nombre_sitio=$A['nombre_sitio'];
  $nombre_institucion=$A['nombre_institucion'];
  $fuente= $A['fuente'];
  $color_gral=$A['color_gral'];
  $bkg_color_gral=$A['bkg_color_gral'];


$accion=$_SERVER['PHP_SELF'].'?operacion=borrar&id_raiz='. $id;
$btn_txt='Borrar';
$leyenda='Eliminar';
}
    
}

if (!empty($_GET)) {
  $operacion = isset($_GET['operacion']) ? $_GET['operacion'] : 'agregar' ;
  if ($operacion == 'agregar'){
      
    $raiz->nombre=$_POST['txtNombre'];
    $raiz->abreviatura=$_POST['txtAbreviatura'];
    $raiz->resumen=$_POST['txtResumen'];
    $raiz->definicion=$_POST['txtDefinicion'];
    $raiz->logo=$_POST['txtLogo'];
    $raiz->orden=$_POST['txtOrden'];
    $raiz->activo=$_POST['txtActivo'];
    $raiz->color=$_POST['txtColor'];
    $raiz->bkg_color=$_POST['txtBkgColor'];
    $raiz->nombre_sitio=$_POST['txt_nombre_sitio'];
    $raiz->nombre_institucion=$_POST['txt_nombre_institucion'];
    $raiz->fuente= $_POST['txt_fuente'];
    $raiz->color_gral=$_POST['txtColorGral'];
    $raiz->bkg_color_gral=$_POST['txtBkgColorGral'];

  $raiz->guardar();
  header("Location: ".$_SERVER['HTTP_REFERER']);
  }
  if ($operacion == 'borrar' && isset($_GET['id_raiz'])){
    //echo '2-actualizar';
    
  
  $raiz->borrar($_GET['id_raiz']);
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
<div class="row" >
	   <div class="col-sm-4">
		  <label>Nombre del Sitio</label>
		  <input type="text" value="<?php echo $nombre_sitio;?>" size="20" name="txt_nombre_sitio" class="form-control" id="txt_nombre_sitio" >
		 </div>
		 
		 <div class="col-sm-4">
		   <label>Institucion</label>
		   <input type="text" value="<?php echo $nombre_institucion;?>" name="txt_nombre_institucion" class="form-control" id="txt_nombre_institucion">
		 </div>
		 
		 <div class="col-sm-2">
		   <label>Orden</label>
		   <input type="text" value="<?php echo $fuente;?>" name="txt_fuente" class="form-control" id="txt_fuente">
		</div>
	 </div>
   <div class="row">
    <div class="col-xs-4">
		   <label for="txtColorGral">Color General del sitio</label>
       <span> <input type="color" id="colorGral" value="<?php echo $color_gral;?>" onchange="PonerColorGral()"></span>
		   <input type="text" value="<?php echo $color_gral;?>" name="txtColorGral" class="form-control" id="txtColorGral">
		</div>	  
        
        <div class="col-xs-4">
		   <label for="txtBkgColorGral">BackGround Color General del sitio</label>
       <span><input type="color" id="bkgcolorGral" value="<?php echo $bkg_color_gral;?>" onchange="PonerBkgColorGral()"></span>
		   <input type="text"  value="<?php echo $bkg_color_gral;?>" name="txtBkgColorGral" class="form-control" id="txtBkgColorGral">
		</div>
   </div>

     <div class="row"> 
         <div class="col-xs-8">
		   <label for="txtDefinicion">Definicion</label>
		   <textarea  rows="4" cols="60" name="txtDefinicion" class="form-control"><?php echo $definicion;?>
           </textarea> 
		 </div>
         <div class="col-xs-4">
		   <label for="txtResumen">Resumen</label>
		   <textarea  rows="4" cols="30" name="txtResumen" id="txtResumen" class="form-control"><?php echo $resumen;?>
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



