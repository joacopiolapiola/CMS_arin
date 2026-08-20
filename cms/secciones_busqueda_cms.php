<?php
require_once __DIR__ . '/_cms_guard.php';
//include_once("../clases/conexion.php");
include_once "../clases/secciones.php";

$str_b =  $_POST['b'];
//echo $str_b;
$secs=Seccion::filtrar($str_b);

?>
<?php
if (isset($secs)){
?>

<div class="panel panel-default">
 
  
	<div  style="overflow: scroll;height: 350px;"> 	  
	 <table class="tabla_edicion table table-hover">
	  <thead>
			  <tr>
			  <th width="5%">Id</th>
              <th width="20%">Nombre</th>
			  <th width="5%">Id-Top</th>
			  <th width="5%">Orden</th>
			  <th width="20%">Enlace</th>
              <th width="5%">Activo</th>
			  <th width="20%">Enlace CMS</th>
			  <th width="10%"></th>
			  <th width="10%"></th>
			  
			  </tr>
		  </thead>
	   
	  <tbody>
	 
	  
	  <?php
		  foreach($secs as $sec){
		   echo "<tr>
		   <td>$sec[id_seccion]</td>
		   <td>$sec[nombre]</td>
		   <td>$sec[id_tecnologia]</td>
		   <td>$sec[orden]</td>
		   <td>$sec[enlace]</td>
           <td>$sec[Activo]</td>
		   <td>$sec[enlace_cms]</td>";
	  
      if (cms_puede_modificar()) {
	    echo '<td><button class="btn btn-primary btn-xs" onclick="editar(' . $sec['id_seccion'] . ')" >Editar</button></td>';
		echo '<td><button class="btn btn-primary btn-xs" onclick="borrar(' . $sec['id_seccion'] . ')" >Borrar</button></td>';
      } else {
        echo '<td colspan="2"><button class="btn btn-outline-secondary btn-xs" onclick="cargar(\'#Contenido\', \'ver_registro.php?tipo=seccion&id=' . $sec['id_seccion'] . '\')">Ver</button></td>';
      }
         
		  echo " </tr> ";
		   }
	  ?>
	
	  </tbody>
	  
	  </table>
  
	</div>
	
	
	  
<?php
}
?>

