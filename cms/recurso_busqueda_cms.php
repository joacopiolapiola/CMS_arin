<?php
//include_once("../clases/conexion.php");
include_once "../clases/recursos.php";

$str_b =  $_POST['b'];
//echo $str_b;
$hists=Recurso::filtrar($str_b);

?>
<?php
if (isset($hists)){
?>

<div class="panel panel-default">
 
  
	<div  style="overflow: scroll;height: 350px;"> 	  
	 <table class="tabla_edicion table table-hover">
	  <thead>
			  <tr>
			  <th width="5%">Id</th>
              <th width="20%">Titulo</th>
              <th width="30%">Contenido</th>
			  <th width="5%">Id-Tec</th>
			  <th width="5%">Orden</th>
			  <th width="10%">Enlace</th>
              <th width="5%">Activo</th>
			  <th width="10%"></th>
			  <th width="10%"></th>
			  
			  </tr>
		  </thead>
	   
	  <tbody>
	 
	  
	  <?php
		  foreach($hists as $sec){
		   echo "<tr>
		   <td>$sec[ID_recurso]</td>
		   <td>$sec[titulo]</td>
           <td>$sec[Contenido]</td>
		   <td>$sec[ID_tecnologia]</td>
		   <td>$sec[orden]</td>
		   <td>$sec[link_referencia]</td>;
           <td>$sec[activo]</td>";
	  
	    echo '<td><button class="btn btn-primary btn-xs" onclick="editar(' . $sec['ID_recurso'] . ')" >Editar</button></td>';
		echo '<td><button class="btn btn-primary btn-xs" onclick="borrar(' . $sec['ID_recurso'] . ')" >Borrar</button></td>';
         
		  echo " </tr> ";
		   }
	  ?>
	
	  </tbody>
	  
	  </table>
  
	</div>
	
	
	  
<?php
}
?>

