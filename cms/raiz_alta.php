<?php
include_once "../clases/raiz.php";

$datos = new Raiz();
$raiz = new Raiz();

$id_raiz= '';
$nombre= '';
$abreviatura= '';
$resumen='';
$definicion= '';
$logo= '';
$orden= '';
$activo= '';
$color= '';
$bkg_color= '';


?>

 
<div class="container">
  
   
  <form  role="form" method="POST" action="raiz_edit.php?operacion=agregar">
   <legend>Alta Raiz</legend>
      
	 <div class="form-group">
	 <div class="row" >
	     <div class="col-sm-6">
		  <label>Nombre</label>
		  <input type="text"  size="20" name="txtNombre" class="form-control" id="txtNombre" >
		 </div>
		 
		 <div class="col-sm-2">
		   <label>Abreviatura</label>
		   <input type="text" name="txtAbreviatura" class="form-control" id="txtAbreviatura">
		 </div>
		 
		 <div class="col-sm-1">
		   <label>Orden</label>
		   <input type="text" name="txtOrden" class="form-control" id="txtOrden">
		</div>
	 </div>
     <div class="row"> 
         <div class="col-xs-8">
		   <label>Definicion</label>
		   <textarea  rows="4" cols="60" name="txtDefinicion" class="form-control">
           </textarea> 
		 </div>
         <div class="col-xs-4">
		   <label>Resumen</label>
		   <textarea  rows="4" cols="30" name="txtResumen" class="form-control">
           </textarea> 
		 </div>
     </div>
	 <div class="row" >	 
		<div class="col-sm-3">
		   <label>Logo</label>
		   <input type="text"  name="txtLogo" class="form-control" id="txtLogo">
		</div>
        <div class="col-sms-1">
            <label>Activo</label>
            <input type="text"  size="10" name="txtActivo" class="form-control" id="tit_link">
        </div>
		<div class="col-xs-4">
		   <label for="txtColor">Color</label>
		   <span> <input type="color" id="color" value="#00ff00" onchange="PonerColor()"></span>
		   <input type="text"  name="txtColor" class="form-control" id="txtColor">
		</div>	  
        <!---div class="col-xs-1">
        <input type="color" id="color" value="#00ff00" onchange="PonerColor()">
        </div--->
        <div class="col-xs-4">
		   <label for="txtBkgColor">BackGround Color</label>
		   <span><input type="color" id="bkgcolor" value="#00ff00" onchange="PonerBkgColor()"></span>
		   <input type="text"  name="txtBkgColor" class="form-control" id="txtBkgColor">
		</div> 
        <!---div class="col-xs-1">
        <input type="color" id="bkgcolor" value="#00ff00" onchange="PonerBkgColor()">
        </div--->
   	 </div>
	  
<br>
 <button method="post" type="submit" class="btn btn-primary btn-xs">Agregar</button>

</form>  

</div>

