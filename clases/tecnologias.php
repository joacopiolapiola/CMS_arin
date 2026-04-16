<?php
include_once("conexion.php");

//ESTE CODIGO FUE MIGRADO DESDE LA EXTENSION ANTIGUA MYSQL A LA NUEVA MYSQLi
//UTILIZANDO LA INTERFAZ ORIENTADA A OBJETOS (http://php.net/manual/es/mysqli.quickstart.dual-interface.php)

class Tecnologia{
 public $id_tecnologia;
 public $nombre;
 public $abreviatura;
  public $resumen;
 public $logo;
 public $orden;
 public $activo;
 public $definicion;
 public $color;
 public $bkg_color;
 
 
 function guardar(){  // crea la Persona
    
   
   $sql="insert into tecnologias(nombre,abreviatura,resumen,definicion,logo,orden,activo,color,bkg_color)
    values('$this->nombre','$this->abreviatura','$this->resumen','$this->definicion','$this->logo','$this->orden','$this->activo',
   '$this->color','$this->bkg_color')";
   //mysql_query($sql);
   $objConn = new Conexion();
   $objConn->enlace->query($sql);
 }
 
 function actualizar($nro=0)	// actualiza la Persona
	{
	        
			$sql="update tecnologias set nombre='$this->nombre', abreviatura='$this->abreviatura'
			,orden='$this->orden',resumen='$this->resumen',definicion='$this->definicion',logo='$this->logo',activo='$this->activo',
			color='$this->color',bkg_color='$this->bkg_color'
             where id_tecnologia=$nro";
			//mysql_query($sql); // ejecuta la consulta para actualizar
			$objConn = new Conexion();
            $objConn->enlace->query($sql);
            			
	}
	
 function borrar($nro=0)	// elimina la Persona
	{
			$sql="delete from tecnologias where id_tecnologia=$nro";
			//mysql_query($sql); // ejecuta la consulta para eliminar
			$objConn = new Conexion();
            $objConn->enlace->query($sql);
			
	
	}	
	
static function traer_datos($nro=0) // declara el constructor, si trae el numero de persona lo busca 
	{
		if ($nro!=0)
		{
			$sql="select * from tecnologias where id_tecnologia = $nro";
			//$result=mysql_query($sql);
			$objConn = new Conexion();
            $result = $objConn->enlace->query($sql);
			$recs=mysqli_num_rows($result);
			$row=mysqli_fetch_array($result,MYSQLI_BOTH);
			$id_tecnologia=$row['ID_tecnologia'];
			return $row;
		}
	}	
 
 
 
 static function buscar(){
    $sql="select * from tecnologias where activo = 1 order by orden";
    //$rs=mysql_query($sql);
	$objConn = new Conexion();
	$rs=$objConn->enlace->query($sql);
	$est=array();
	//while($fila=mysql_fetch_assoc($rs) > 0){
	while($fila=mysqli_fetch_assoc($rs)){
	  $est[]=$fila;
	}return $est;
 
 }

 static function buscar_todas(){
    $sql="select * from tecnologias order by id_tecnologia";
    //$rs=mysql_query($sql);
	$objConn = new Conexion();
	$rs=$objConn->enlace->query($sql);
	$est=array();
	//while($fila=mysql_fetch_assoc($rs) > 0){
	while($fila=mysqli_fetch_assoc($rs)){
	  $est[]=$fila;
	}return $est;
 
 }

 static function buscar_raiz(){
    $sql="select * from raiz where id_raiz = 0 AND activo = 1 order by orden";
    //$rs=mysql_query($sql);
	$objConn = new Conexion();
	$result = $objConn->enlace->query($sql);
	$recs=mysqli_num_rows($result);
	$row=mysqli_fetch_array($result,MYSQLI_BOTH);
	return $row;
	/*
	$rs=$objConn->enlace->query($sql);
	$est=array();
	//while($fila=mysql_fetch_assoc($rs) > 0){
	while($fila=mysqli_fetch_assoc($rs)){
	  $est[]=$fila;
	}return $est;
	*/
 
 }

 static function seleccionar(){
    $sql="select nombre,id_tecnologia from tecnologias order by nombre ASC";
    //$rs=mysql_query($sql);
	$objConn = new Conexion();
	$rs=$objConn->enlace->query($sql);
	$est=array();
	//while($fila=mysql_fetch_assoc($rs) > 0){
	while($fila=mysqli_fetch_assoc($rs)){
	  $est[]=$fila;
	}return $est;
 
 }

 static function filtrar($str=''){
    $sql="select * from tecnologias where nombre like '%$str%' OR abreviatura like '%$str%' OR  id_tecnologia='$str' order by orden";
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