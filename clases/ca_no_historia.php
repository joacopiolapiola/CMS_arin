<?php
include_once("conexion.php");


class historia{
 public $id_historia;
 public $id_tecnologia;
 public $nombre;
 public $contenido;
 public $link;
  public $activo;

  public $orden;

 
 function guardar(){  // creae cartel
    
  
   $sql="insert into historia(id_tecnologia,nombre,contenido,ordenamiento,activo,link_referencia)
   values('$this->id_tecnologia','$this->nombre','$this->contenido','$this->orden',
  '$this->activo','$this->link')";
   //mysql_query($sql);
   $objConn = new Conexion();
   $objConn->enlace->query($sql);
 }
 
 function actualizar($nro=0)	// actualiza cartel
	{
	        
			$sql="update historia set id_tecnologia='$this->id_tecnologia', nombre='$this->nombre',contenido='$this->contenido'
			,ordenamiento='$this->orden',activo='$this->activo',link_referencia='$this->link'  
			 where id_recurso = $nro";
			//mysql_query($sql); // ejecuta la consulta para actualizar
			$objConn = new Conexion();
            $objConn->enlace->query($sql);
            			
	}
	
 
 function borrar($nro=0)	
	{
	        echo $nro;
			$sql="delete from historia where id_recurso = $nro";
			$objConn = new Conexion();
            $objConn->enlace->query($sql);
			
	
	}	
	
function traer_datos($nro=0) // declara el constructor, si trae el numero de persona lo busca 
	{
		if ($nro!=0)
		{
			$sql="select * from historia where id_recurso = $nro";
			//$result=mysql_query($sql);
			$objConn = new Conexion();
            $result = $objConn->enlace->query($sql);
			$recs=mysqli_num_rows($result);
			$row=mysqli_fetch_array($result);
			$id=$row['id_recurso'];
			
			return $row;
		}
	}	
 
 
 
 static function buscar($str){
    $sql="select * from historias where nombre like '%$str%' or contenido like '%$str%' or link like '%$str%' or id_recurso='$str' ";
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
    $sql="select * from historias where id_tecnologia = '$str' AND activo = 1 ";

	/*
    if(is_numeric($str)){
	 $sql="select * from recursos where id_recurso = '$str' ";
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
    $sql="select id_tecnologia,count(id_recurso) from recursos where activo=1 group by id_tecnologia";
    
	//echo $sql;
    
    $objConn = new Conexion();
	$rs=$objConn->enlace->query($sql);
	$est=array();
	//while($fila=mysql_fetch_assoc($rs) > 0){
	while($fila=mysqli_fetch_assoc($rs)){
	  $est[]=$fila;
	}return $est;
 
 }
 
 
}