<?php
include_once("conexion.php");


class Historia{
 public $id_historia;
 public $id_tecnologia;
 public $titulo;
 public $contenido;
 public $imagen;
 public $link_referencia;
 public $activo;
 public $orden;

 
 function guardar(){  // creae cartel
    
  
   $sql="insert into historia(id_tecnologia,titulo,contenido,imagen,link_referencia,activo,orden)
   values('$this->id_tecnologia','$this->titulo','$this->contenido','$this->imagen','$this->link_referencia'
   ,'$this->activo','$this->orden')";
   //mysql_query($sql);
   $objConn = new Conexion();
   $objConn->enlace->query($sql);
 }
 
 function actualizar($nro=0)	// actualiza cartel
	{
	        
	$sql="update historia set id_tecnologia='$this->id_tecnologia', titulo='$this->titulo'
	,contenido='$this->contenido',imagen='$this->imagen',link_referencia='$this->link_referencia'
	,activo='$this->activo',orden='$this->orden'   
	 where id_historia = $nro";
	//mysql_query($sql); // ejecuta la consulta para actualizar
	$objConn = new Conexion();
            $objConn->enlace->query($sql);
            			
	}
	
 
 function borrar($nro=0)	
	{
	        echo $nro;
			$sql="delete from historia where id_historia = $nro";
			$objConn = new Conexion();
            $objConn->enlace->query($sql);
			
	
	}	
	
static function traer_datos($nro=0) // declara el constructor, si trae el numero de persona lo busca 
	{
		if ($nro!=0)
		{
			$sql="select * from historia where id_historia = $nro";
			//$result=mysql_query($sql);
			$objConn = new Conexion();
            $result = $objConn->enlace->query($sql);
			$recs=mysqli_num_rows($result);
			$row=mysqli_fetch_array($result);
			$id=$row['ID_historia'];
			
			return $row;
		}
	}	
 
 
 
 static function buscar($str){
    $sql="select * from historia where titulo like '%$str%' or contenido like '%$str%' or link_referencia like '%$str%' or id_historia='$str' ";
    //$rs=mysql_query($sql);
	$objConn = new Conexion();
	$rs=$objConn->enlace->query($sql);
	$est=array();
	//while($fila=mysql_fetch_assoc($rs) > 0){
	while($fila=mysqli_fetch_assoc($rs)){
	  $est[]=$fila;
	}return $est;
 
 }
 
 static function seleccionar($str){
    $sql="select * from historia where id_tecnologia = '$str' AND activo = 1 order by orden";

	/*
    if(is_numeric($str)){
	 $sql="select * from historias where id_recurso = '$str' ";
	}
	 */
	//echo $sql;
    
    //$rs=mysql_query($sql);
	$objConn = new Conexion();
	$rs=$objConn->enlace->query($sql);
	$est=array();
	//while($fila=mysql_fetch_assoc($rs) > 0){
	while($fila=mysqli_fetch_assoc($rs)){
	  $est[]=$fila;
	}return $est;
 
 }
 
 static function id_tecnologias(){
    $sql="select id_tecnologia,count(id_historia) from historia where activo=1 group by id_tecnologia";
    
	//echo $sql;
    
    $objConn = new Conexion();
	$rs=$objConn->enlace->query($sql);
	$est=array();
	//while($fila=mysql_fetch_assoc($rs) > 0){
	while($fila=mysqli_fetch_assoc($rs)){
	  $est[]=$fila;
	}return $est;
 
 }

 static function filtrar($str=''){
    $sql="select * from historia where titulo like '%$str%' OR  id_tecnologia='$str' order by orden";
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
