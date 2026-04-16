<?php


define ('DB_HOST','db.tecnica4berazategui.edu.ar');
define ('DB_USER','lperconti_rfid');
define ('DB_PASS','PpRfId24');
define ('DB_NAME','lperconti_rfid');

class Conexion extends mysqli{

 public $enlace;
 
 function __construct(){
   //$this->enlace=mysql_connect(DB_HOST,DB_USER,DB_PASS);
   //mysql_select_db(DB_NAME,$this->enlace);
   $this->enlace=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    
  
 }
 function __destruct(){
   //mysql_close($this->enlace);
   mysqli_close($this->enlace);
 }
}


$objConexion = new Conexion();


class lectura{
 public $id_usuario;
// public $nombre;
//  public $valor;
// public $fecha;
//  public $nro_canal;
 
 
 function guardar_registro(){  
    
 
   $sql="insert into registro(id_usuario)
   values('$this->id_usuario')";

   //mysql_query($sql);

echo $sql;

   $objConn = new Conexion();
   $objConn->enlace->query($sql);
 }
}

 $lectura = new lectura();

$id_usuario = $_POST["id_usuario"];

echo $id_usuario;
//$nombre = htmlspecialchars($_GET["nombre"],ENT_QUOTES);
//$fecha = htmlspecialchars($_GET["fecha"],ENT_QUOTES);
//echo ("nro_canal ".$nro_canal);
// Valida que esten presente todos los parametros
//if ( ($nombre!=) and ($valor!="") and ($nro_canal!="")) {
	    $lectura->id_usuario=$id_usuario;
		//$lectura->nombre=$nombre;
		//$lectura->fecha=$fecha;
		
		$lectura->guardar_registro();
			
		
//}
?>