<?php

include_once "clases/quees.php";
include_once "clases/tecnologias.php";

if (isset($_GET['str_b'])) {
  $str_b =  $_GET['str_b'];

//echo "QUE".$_GET['str_b'];
$quees=Quees::seleccionar($str_b);

if($str_b != '0'){
 $tec=Tecnologia::traer_datos($str_b);
 echo '<H3>'.'Que Es '.$tec['nombre'].'</H3>';
}
else{
	$raiz=Tecnologia::buscar_raiz();
	echo '<H3>'.'Que es '.$raiz['nombre'].'</H3>';
}
 


}

if (isset($quees)){
echo '<link rel="stylesheet" href="css/quees.css">';

	  
  
	foreach($quees as $que){
		  
		   echo '<div class="plantilla">';		   
		   echo "<header>
               <h1>$que[titulo]</h1>
               </header>";
		    
			   
			 
		 
        	echo "<article>$que[Contenido]</article>";

			if($que['imagen']<>""){   
				$img="images/".$que['imagen'];
				echo "<br><img src='$img'><br>";
				} 

			if($que['link_referencia']<>""){   
			echo "<footer><a href='$que[link_referencia]' target='_blank'>$que[titulo]</a></footer>";

			echo '</div>';
			}  	
	}
}	  
