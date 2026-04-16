<?php
include_once("conexion.php");

//ESTE CODIGO FUE MIGRADO DESDE LA EXTENSION ANTIGUA MYSQL A LA NUEVA MYSQLi
//UTILIZANDO LA INTERFAZ ORIENTADA A OBJETOS (http://php.net/manual/es/mysqli.quickstart.dual-interface.php)

class Seccion{
 public $id_seccion;
 public $nombre;
 public $id_tecnologia;
 public $orden;
 public $enlace;
 public $activo;
 public $enlace_cms;
 
 function guardar(){  // crea la seccion
    
   
   $sql="insert into secciones(nombre,id_tecnologia,orden,enlace,activo,enlace_cms)
   values('$this->nombre','$this->id_tecnologia','$this->orden','$this->enlace','$this->activo','$this->enlace_cms')";
   //mysql_query($sql);
   $objConn = new Conexion();
   $objConn->enlace->query($sql);
 }
 
 function actualizar($nro=0)	// actualiza la seccion
	{
	        
			$sql="update secciones set nombre='$this->nombre', id_tecnologia='$this->id_tecnologia'
			,orden='$this->orden',enlace='$this->enlace',activo='$this->activo'
			,enlace_cms='$this->enlace_cms' where id_seccion=$nro";
			//mysql_query($sql); // ejecuta la consulta para actualizar
			$objConn = new Conexion();
            $objConn->enlace->query($sql);
            			
	}
	
 function borrar($nro=0)	// elimina la seccion
    {
			$sql="delete from secciones where id_seccion=$nro";
			//mysql_query($sql); // ejecuta la consulta para eliminar
			$objConn = new Conexion();
            $objConn->enlace->query($sql);
			
	
	}	
	
static function traer_datos($nro=0) // declara el constructor, si trae el numero de seccion lo busca 
	{
		if ($nro!=0)
		{
			$sql="select * from secciones where id_seccion = $nro";
			//$result=mysql_query($sql);
			$objConn = new Conexion();
            $result = $objConn->enlace->query($sql);
			$recs=mysqli_num_rows($result);
			$row=mysqli_fetch_array($result);
			$id_seccion=$row['id_seccion'];
			return $row;
		}
	}	
 
 
 static function filtrar($str=''){
 	if(!is_numeric($str))
	    $sql="select * from secciones where nombre like '%$str%' OR enlace like '%$str%' 
	     order by orden";
	 else   
	 	$sql="select * from secciones where id_tecnologia='$str' order by orden";
    //$rs=mysql_query($sql);
	$objConn = new Conexion();
	$rs=$objConn->enlace->query($sql);
	$est=array();
	//while($fila=mysql_fetch_assoc($rs) > 0){
	while($fila=mysqli_fetch_assoc($rs)){
	  $est[]=$fila;
	}return $est;
 
 }

 static function buscar(){
    $sql="select * from secciones where activo = 1 order by orden";
    //$rs=mysql_query($sql);
	$objConn = new Conexion();
	$rs=$objConn->enlace->query($sql);
	$est=array();
	//while($fila=mysql_fetch_assoc($rs) > 0){
	while($fila=mysqli_fetch_assoc($rs)){
	  $est[]=$fila;
	}return $est;
 
 }

 static function listar(){
    $sql="select * from secciones order by orden";
    //$rs=mysql_query($sql);
	$objConn = new Conexion();
	$rs=$objConn->enlace->query($sql);
	$est=array();
	//while($fila=mysql_fetch_assoc($rs) > 0){
	while($fila=mysqli_fetch_assoc($rs)){
	  $est[]=$fila;
	}return $est;
 
 }

	

 static function nombres(){
    $sql="select distinct nombre from secciones  order by nombre";
    //$rs=mysql_query($sql);
	$objConn = new Conexion();
	$rs=$objConn->enlace->query($sql);
	$est=array();
	//while($fila=mysql_fetch_assoc($rs) > 0){
	while($fila=mysqli_fetch_assoc($rs)){
	  $est[]=$fila;
	}return $est;
 
 }
 
 

 static function enumerar(){
    $sql="select distinct nombre,enlace_cms from secciones  order by nombre";
    //$rs=mysql_query($sql);
	$objConn = new Conexion();
	$rs=$objConn->enlace->query($sql);
	$est=array();
	//while($fila=mysql_fetch_assoc($rs) > 0){
	while($fila=mysqli_fetch_assoc($rs)){
	  $est[]=$fila;
	}return $est;
 
 }
 
 }