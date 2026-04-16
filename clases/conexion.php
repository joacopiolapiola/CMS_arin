<?php
define ('DB_HOST','localhost');
define ('DB_USER','root');
define ('DB_PASS','');
define ('DB_NAME','basededatos');
//PRODUCCION
//define ('DB_HOST','db.tecnica4berazategui.edu.ar');
//define ('DB_USER','lperconti_p40');
//define ('DB_PASS','BdPla40..');
//define ('DB_NAME','lperconti_p40');
class Conexion extends mysqli{

 public $enlace;
 
 function __construct(){
     $this->enlace=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
 }
 function __destruct(){
     mysqli_close($this->enlace);
 }
}


$objConexion = new Conexion();
