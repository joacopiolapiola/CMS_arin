<?php
include_once("conexion.php");


class Usuario{
 public $id_usuario;
 public $nombre;
 public $telefono;
 public $roles;
 public $gmail;
 public $password;
 public $permisos;
 public $institucion;
 public $rol_institucion;
 
 function guardar(){  
    
   
   $sql="insert into usuarios(nombre,telefono,roles,email,password,permisos,institucion,Rol_institucion)
   values('$this->nombre','$this->telefono','$this->roles','$this->gmail','$this->password',
   '$this->permisos','$this->institucion','$this->rol_institucion')";
   //mysql_query($sql);
   $objConn = new Conexion();
   $objConn->enlace->query($sql);
 }
  function registro(){  
    $tmp=password_hash($this->password, PASSWORD_DEFAULT);
	$sql="insert into usuarios(nombre,telefono,email,password,Institucion)
	values('$this->nombre','$this->telefono','$this->gmail','$tmp',
	'$this->institucion')";
	//mysql_query($sql);
	$objConn = new Conexion();
	$ret=$objConn->enlace->query($sql);
	return true;
  }

 function actualizar($nro=0)	// actualiza la seccion
	{
	        
			$sql="update usuarios set nombre='$this->nombre', telefono='$this->telefono'
			,roles='$this->roles',email='$this->gmail'
			,permisos='$this->permisos',Institucion='$this->institucion',
			Rol_institucion='$this->rol_institucion' where ID_usuario=$nro";
			//mysql_query($sql); // ejecuta la consulta para actualizar
			$objConn = new Conexion();
            $objConn->enlace->query($sql);
            			
	}
	
 function borrar($nro=0)	// elimina la seccion
    {
			$sql="delete from usuario where ID_usuario=$nro";
			//mysql_query($sql); // ejecuta la consulta para eliminar
			$objConn = new Conexion();
            $objConn->enlace->query($sql);
			
	
	}	
	
static function traer_datos($nro=0) // declara el constructor, si trae el numero de seccion lo busca 
	{
		if ($nro!=0)
		{
			$sql="select * from usuarios where ID_usuario = $nro";
			//$result=mysql_query($sql);
			$objConn = new Conexion();
            $result = $objConn->enlace->query($sql);
			$recs=mysqli_num_rows($result);
			$row=mysqli_fetch_array($result);
			$ID_usuario=$row['ID_usuario'];
			return $row;
		}
	}	
 
 
 static function filtrar($str='',$tipo=''){
	switch($tipo){
 	 case 'login':
		$sql="select * from usuarios where  email = '$str' ";
		break;
	 case 'buscar':	
	    $sql="select * from usuarios where nombre like '%$str%' OR email like '%$str%' 
	     OR institucion like '%$str%'  order by ID_usuario";
		 break;
	 case 'id':   
	 	$sql="select * from usuarios where ID_usuario='$str' ";
		break;
    //$rs=mysql_query($sql);
	}
	
	$objConn = new Conexion();
	$rs=$objConn->enlace->query($sql);
	$est=array();
	//while($fila=mysql_fetch_assoc($rs) > 0){
	while($fila=mysqli_fetch_assoc($rs)){
	  $est[]=$fila;
	}
	
	return $est;
 
 }

 static function buscar($str=''){
    $sql="select * from usuarios where nombre like '%$str%' OR gmail like '%$str%' 
	     OR institucion like '%$str%'  order by ID_usuario";
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
    $sql="select * from usuarios order by nombre";
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
    $sql="select distinct nombre from usuarios  order by nombre";
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
    $sql="select distinct nombre,institucion from usuarios  order by nombre";
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