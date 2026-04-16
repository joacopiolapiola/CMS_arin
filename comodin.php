<?php
/*
CREATE TABLE `comodin` (
 `ID_comodin` int(15) NOT NULL AUTO_INCREMENT,
 `ID_tecnologia` int(4) NOT NULL,
 `titulo` text DEFAULT NULL,
 `Contenido` text NOT NULL,
 `imagen` varchar(100) DEFAULT NULL,
 `link_referencia` varchar(100) DEFAULT NULL,
 `activo` int(2) NOT NULL DEFAULT 1,
 `orden` int(4) NOT NULL DEFAULT 1,
 PRIMARY KEY (`ID_comodin`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

 ALTER TABLE `comodin` ADD `seccion` VARCHAR(30) NOT NULL AFTER `orden`;

 CREATE TABLE `curiosidades` (
  `ID_curiosidades` int(15) NOT NULL AUTO_INCREMENT, 
  `ID_tecnologia` int(4) NOT NULL, 
  `titulo` text DEFAULT NULL, 
  `Contenido` text NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `link_referencia` varchar(100) DEFAULT NULL, 
  `activo` int(2) NOT NULL DEFAULT 1, 
  `orden` int(4) NOT NULL DEFAULT 1,
   PRIMARY KEY (`ID_curiosidades`)
 ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

*/
include_once "clases/comodin.php";
include_once "clases/tecnologias.php";

$str_b =  $_GET['str_b'];
$seccion =  $_GET['str_secc'];

//echo "QUE".$_GET['str_b'];
$recursos=Comodin::seleccionar_comodin($str_b,$seccion);


if($str_b != '0'){
	$tec=Tecnologia::traer_datos($str_b);
	echo '<H3>'.$tec['nombre'].'- '.$seccion.'</H3>';
   }
   else{
	   $raiz=Tecnologia::buscar_raiz();
	   echo '<H3>'.$raiz['nombre'].'- '.$seccion.'</H3>';
   }




if (isset($recursos)){
echo '<link rel="stylesheet" href="css/comodin.css">';
if($seccion == 'PRESENTACIONES'){   
   echo '
   <div class="carousel-container">
        <div class="carousel-slides">';
        foreach($recursos as $recurso){
            $slide='<div class="carousel-slide"><img src="images/'.$recurso['imagen'].'">'.$recurso['titulo'].'</div>';
            //<div class="carousel-slide"><img src="https://via.placeholder.com/600x300?text=Slide+1" alt="Slide 1"></div>
            
            echo $slide;
        }
             echo '</div>
        <div class="carousel-buttons">
            <button id="prevBtn">❮</button>
            <button id="nextBtn">❯</button>
        </div>
    </div>
     ';

echo '<script src="js/comodin.js"></script>';



  }
  else{
  
	foreach($recursos as $recurso){
		  
		   echo '<div class="plantilla">';		   
		   echo "<header>
               <h2>$recurso[titulo]</h2>
               </header>";
         if($recurso['imagen']<>""){   
            $img="images/".$recurso['imagen'];
            echo "<br><img src='$img'><br>";
            }    
			   
			if($recurso['link_referencia']<>""){   
			echo "<br><nav><a href='$recurso[link_referencia]' target='_blank'>$recurso[titulo]</a></nav>";
			}   
		 
        	echo "<article>$recurso[Contenido]</article>";
         echo '</div>';	
	}


  }
}	  
		  
		   


	
	  
	
	
	
	  
	 
	  
