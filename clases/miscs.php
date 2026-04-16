<?php
//include_once "conexion.php";
include "recursos.php";

class Misc extends Recurso{
 public $id_misc;
 public $pos_FC;

 public $link_local;
 
 
 function guardar_misc(){  // creae cartel
    
  
   $sql="insert into misc(id_tecnologia,nombre,contenido,ordenamiento,activo,link_referencia,imagen,link_local)
   values('$this->id_tecnologia','$this->nombre','$this->contenido','$this->orden',
  '$this->activo','$this->link','$this->imagen','$this->link_local')";
   //mysql_query($sql);
   $objConn = new Conexion();
   $objConn->enlace->query($sql);
 }
 
 function actualizar_misc($nro=0)	// actualiza cartel
	{
	        
			$sql="update misc set id_tecnologia='$this->id_tecnologia', nombre='$this->nombre',contenido='$this->contenido'
			,ordenamiento='$this->orden',activo='$this->activo',link_referencia='$this->link',imagen='$this->imagen' ,link_local='$this->link_local'   
			 where id_misc = $nro";
			//mysql_query($sql); // ejecuta la consulta para actualizar
			$objConn = new Conexion();
            $objConn->enlace->query($sql);
            			
	}
	
 
 function borrar_misc($nro=0)	
	{
	        echo $nro;
			$sql="delete from misc where id_misc = $nro";
			$objConn = new Conexion();
            $objConn->enlace->query($sql);
			
	
	}	
	
function traer_datos_misc($nro=0) // declara el constructor, si trae el numero de persona lo busca 
	{
		if ($nro!=0)
		{
			$sql="select * from misc where id_misc = $nro";
			//$result=mysql_query($sql);
			$objConn = new Conexion();
            $result = $objConn->enlace->query($sql);
			$recs=mysqli_num_rows($result);
			$row=mysqli_fetch_array($result);
			$id=$row['id_misc'];
			
			return $row;
		}
	}	
 
 
 
 static function buscar_misc($str){
    $sql="select * from misc where nombre like '%$str%' or contenido like '%$str%' or link like '%$str%' or id_misc='$str' ";
    //$rs=mysql_query($sql);
	$objConn = new Conexion();
	$rs=$objConn->enlace->query($sql);
	$est=array();
	//while($fila=mysql_fetch_assoc($rs) > 0){
	while($fila=mysqli_fetch_assoc($rs)){
	  $est[]=$fila;
	}return $est;
 
 }
 
 static function seleccionar_misc(){
    $sql="select * from misc where  activo = 1 ";

	/*
    if(is_numeric($str)){
	 $sql="select * from misc where id_misc = '$str' ";
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
 
 static function traer_misc($nro=0) // declara el constructor, si trae el numero de persona lo busca 
 {
	 if ($nro!=0)
	 {
		 $sql="select * from misc where ID_misc = $nro";
		 //$result=mysql_query($sql);
		 $objConn = new Conexion();
		 $result = $objConn->enlace->query($sql);
		 $recs=mysqli_num_rows($result);
		 $row=mysqli_fetch_array($result);
		 $id=$row['ID_misc'];
		 
		 return $row;
	 }
 }	


 static function id_tecnologias_misc(){
    $sql="select id_tecnologia,count(id_misc) from misc where activo=1 group by id_tecnologia";
    
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