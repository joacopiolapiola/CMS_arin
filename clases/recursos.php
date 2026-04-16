<?php
include_once "conexion.php";


class Recurso{
 public $id_recurso;
 public $id_tecnologia;
 public $titulo;
 public $contenido;
 public $link_referencia;
  public $activo;

  public $orden;
  public $imagen;

 
 function guardar(){  // creae cartel
    
  
   $sql="insert into recursos(id_tecnologia,titulo,contenido,orden,activo,link_referencia,imagen)
   values('$this->id_tecnologia','$this->titulo','$this->contenido','$this->orden',
  '$this->activo','$this->link_referencia','$this->imagen')";
   //mysql_query($sql);
   $objConn = new Conexion();
   $objConn->enlace->query($sql);
 }
 
 function actualizar($nro=0)	// actualiza cartel
	{
	        
			$sql="update recursos set id_tecnologia='$this->id_tecnologia', titulo='$this->titulo',contenido='$this->contenido'
			,orden='$this->orden',activo='$this->activo',link_referencia='$this->link_referencia',imagen='$this->imagen'
			 where id_recurso = $nro";
			//mysql_query($sql); // ejecuta la consulta para actualizar
			$objConn = new Conexion();
            $objConn->enlace->query($sql);
            			
	}
	
 
 function borrar($nro=0)	
	{
	        echo $nro;
			$sql="delete from recursos where id_recurso = $nro";
			$objConn = new Conexion();
            $objConn->enlace->query($sql);
			
	
	}	
	
static function traer_datos($nro=0) // declara el constructor, si trae el numero de persona lo busca 
	{
		if ($nro!=0)
		{
			$sql="select * from recursos where id_recurso = $nro";
			//$result=mysql_query($sql);
			$objConn = new Conexion();
            $result = $objConn->enlace->query($sql);
			$recs=mysqli_num_rows($result);
			$row=mysqli_fetch_array($result);
			$id=$row['ID_recurso'];
			
			return $row;
		}
	}	
 
 
 
 static function buscar($str){
    $sql="select * from recursos where titulo like '%$str%' or contenido like '%$str%' or link_referencia like '%$str%' or id_recurso='$str' ";
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
    $sql="select * from recursos where id_tecnologia = '$str' AND activo = 1 ";

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
 
 static function filtrar($str=''){
    $sql="select * from recursos where titulo like '%$str%' OR  id_tecnologia='$str' order by orden";
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