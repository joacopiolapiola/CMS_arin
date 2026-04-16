<?php
//include_once("../clases/conexion.php");
include_once "../clases/usuarios.php";

$str_b =  $_POST['b'];
//echo $str_b;
$secs=Usuario::filtrar($str_b,"buscar");

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
			  <th width="15%">Institucion</th>
			  <th width="10%">Roles</th>
			  <th width="10%">Permisos</th>
              <th width="20%">email</th>
			  <th width="10%"></th>
			  <th width="5%"></th>
			  <th width="5%"></th>
			  
			  </tr>
		  </thead>
	   
	  <tbody>
	 
	  
	  <?php
		  foreach($secs as $sec){
		   echo "<tr>
		   <td>$sec[ID_usuario]</td>
		   <td>$sec[nombre]</td>
		   <td>$sec[Institucion]</td>
		   <td>$sec[roles]</td>
		   <td>$sec[Permisos]</td>
           <td>$sec[email]</td>";
	  
	    echo '<td><button class="btn btn-primary btn-xs" onclick="editar(' . $sec['ID_usuario'] . ')" >Editar</button></td>';
		echo '<td><button class="btn btn-primary btn-xs" onclick="borrar(' . $sec['ID_usuario'] . ')" >Borrar</button></td>';
         
		  echo " </tr> ";
		   }
	  ?>
	
	  </tbody>
	  
	  </table>
  
	</div>
	
	
	  
<?php
}
?>

