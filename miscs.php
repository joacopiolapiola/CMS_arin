<?php

include_once "clases/miscs.php";

if (isset($_GET['str_b'])) {
$str_b =  $_GET['str_b'];
//echo "QUE".$_GET['str_b'];
$misc=Misc::traer_misc($str_b);
}


if (isset($misc)){
echo '<link rel="stylesheet" href="css/miscs.css">';

	  
  
		  
		   echo '<div class="plantilla">';		   
		   echo "<header><h2>".$misc['nombre']."</h2></header>";
		 
        	
			if($misc['imagen']<>""){  
				echo "<table><tr><td width='80%'style='text-align: right'>";
				echo "<article>$misc[Contenido]</article></td>";

				$img="images/".$misc['imagen'];
				echo "<td width='20%'><img src='$img'></td></tr></table>";
				} 
			else
				echo "<article>$misc[Contenido]</article>";	

				if($misc['link_referencia']<>""){   
					echo "<footer><a href='$misc[link_referencia]' target='_blank'>$misc[nombre]</a></footer>";
				} 	
	
}	  
		  
		   


	
	  
	
	
	
	  
	 
	  
