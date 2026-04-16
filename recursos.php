<?php

include_once "clases/recursos.php";
include_once "clases/tecnologias.php";

if (isset($_GET['str_b'])) {
  $str_b =  $_GET['str_b'];

//echo "QUE".$_GET['str_b'];
$recursos=Recurso::seleccionar($str_b);

if($str_b != '0'){
 $tec=Tecnologia::traer_datos($str_b);
 echo '<H3>'.$tec['nombre'].'-RECURSOS</H3>';
}
else{
	$raiz=Tecnologia::buscar_raiz();
	echo '<H3>'.$raiz['nombre'].'-RECURSOS</H3>';
}
 


}

if (isset($recursos)){
echo '<link rel="stylesheet" href="css/recursos.css">';

	  
  
	foreach($recursos as $recurso){
		  
		   echo '<div class="plantilla">';		   
		   echo "<header>
               <h1>$recurso[titulo]</h1>
               </header>";
		    
			   
			 
		 
        	echo "<article>$recurso[Contenido]</article>";

			if($recurso['imagen']<>""){   
				$img="images/".$recurso['imagen'];
				echo "<br><img src='$img'><br>";
				} 

			if($recurso['link_referencia']<>""){   
			echo "<footer><a href='$recurso[link_referencia]' target='_blank'>$recurso[titulo]</a></footer>";
			}  	
			echo '</div>';	
	}
}	  
		  
		   


	
	  
	
	
	
	  
	 
	  
