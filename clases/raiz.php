<?php
include_once "conexion.php";

//ESTE CODIGO FUE MIGRADO DESDE LA EXTENSION ANTIGUA MYSQL A LA NUEVA MYSQLi
//UTILIZANDO LA INTERFAZ ORIENTADA A OBJETOS (http://php.net/manual/es/mysqli.quickstart.dual-interface.php)

class Raiz{
 public $id_raiz;
 public $nombre;
 public $abreviatura;
  public $resumen;
 public $logo;
 public $orden;
 public $activo;
 public $definicion;
 public $color;
 public $bkg_color;
 public $nombre_sitio;
 public $nombre_institucion;
 public $color_gral;
 public $bkg_color_gral;

 public $fuente;
 
 
 function guardar(){  // crea la Persona
    
   
   $sql="insert into raiz(nombre,abreviatura,resumen,definicion,logo,orden,activo,color,bkg_color,nombre_sitio,nombre_institucion,fuente,color_gral,bkg_color_gral)
    values('$this->nombre','$this->abreviatura','$this->resumen','$this->definicion','$this->logo','$this->orden','$this->activo',
   '$this->color','$this->bkg_color','$this->nombre_sitio','$this->nombre_institucion','$this->fuente','$this->color_gral','$this->bkg_color_gral')";
   //mysql_query($sql);
   $objConn = new Conexion();
   $objConn->enlace->query($sql);
 }
 
 function actualizar($nro=0)	// actualiza la Persona
	{
	        
			$sql="update raiz set nombre='$this->nombre', abreviatura='$this->abreviatura', definicion='$this->definicion'
			,orden='$this->orden',resumen='$this->resumen',logo='$this->logo',activo='$this->activo',
			color='$this->color',bkg_color='$this->bkg_color',nombre_sitio='$this->nombre_sitio',nombre_institucion='$this->nombre_institucion',
			fuente='$this->fuente',	color_gral='$this->color_gral',bkg_color_gral='$this->bkg_color_gral'
             where id_raiz=$nro";
			//mysql_query($sql); // ejecuta la consulta para actualizar
			$objConn = new Conexion();
            $objConn->enlace->query($sql);
            			
	}
	
 function borrar($nro=0)	// elimina la Persona
	{
			$sql="delete from raiz where id_raiz=$nro";
			//mysql_query($sql); // ejecuta la consulta para eliminar
			$objConn = new Conexion();
            $objConn->enlace->query($sql);
			
	
	}	
	
static function traer_datos($nro=0) // declara el constructor, si trae el numero de persona lo busca 
	{
		
			$sql="select * from raiz where id_raiz = $nro";
			//$result=mysql_query($sql);
			$objConn = new Conexion();
            $result = $objConn->enlace->query($sql);
			$recs=mysqli_num_rows($result);
			$row=mysqli_fetch_array($result,MYSQLI_BOTH);
			$id_raiz=$row['ID_raiz'];
			return $row;
	
	}	
 
 
 
 static function buscar(){
    $sql="select * from raiz where activo = 1 order by orden";
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
    $sql="select nombre,id_raiz from raiz order by nombre ASC";
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
    $sql="select * from raiz where nombre like '%$str%' OR abreviatura like '%$str%' OR  id_raiz='$str' order by orden";
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