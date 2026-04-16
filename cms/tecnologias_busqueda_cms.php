<?php
include_once "../clases/tecnologias.php";

$str_b =  $_POST['b'];
//echo $str_b;
$tecs=Tecnologia::filtrar($str_b);

?>
<?php
if (isset($tecs)){
?>

<div class="panel panel-default">
 
  
	<div  style="overflow: scroll;height: 350px;"> 	  
	 <table class="tabla_edicion table table-hover">
	  <thead>
			  <tr>
			  <th width="5%">Id</th>
              <th width="10%">Nombre</th>
              <th width="5%">Abrev.</th>
              <th width="15%">Resumen</th>
			  <th width="20%">Definicion</th>
			  <th width="5%">Orden</th>
			  <th width="5%">Activo</th>
              <th width="6%">Logo</th>
              <th width="6%">Color</th>
              <th width="6%">Bkg Color</th>
			  <th width="6%"></th>
			  <th width="6%"></th>
			  
			  </tr>
		  </thead>
	   
	  <tbody>
	 
	  
	  <?php
		  foreach($tecs as $sec){
		   echo "<tr>
		   <td>$sec[ID_tecnologia]</td>
		   <td>$sec[nombre]</td>
           <td>$sec[abreviatura]</td>
		   <td>$sec[resumen]</td>
           <td>$sec[definicion]</td>
		   <td>$sec[orden]</td>
		   <td>$sec[activo]</td>
           <td>$sec[logo]</td>
           <td>$sec[color]</td>
           <td>$sec[bkg_color]</td>";
	  
	    echo '<td><button class="btn btn-primary btn-xs" onclick="editar(' . $sec['ID_tecnologia'] . ')" >Editar</button></td>';
		echo '<td><button class="btn btn-primary btn-xs" onclick="borrar(' . $sec['ID_tecnologia'] . ')" >Borrar</button></td>';
         
		  echo " </tr> ";
		   }
	  ?>
	
	  </tbody>
	  
	  </table>
  
	</div>
	
	
	  
<?php
}
?>

