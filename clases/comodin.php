<?php
include_once "conexion.php";
//include_once "historia.php";


class Comodin{

    public $id_comodin;
    public $seccion;
	public $id_tecnologia;
	public $titulo;
	public $contenido;
	public $imagen;
	public $link_referencia;
	public $activo;
	public $orden;
   
    
 
 
 function guardar(){  // creae cartel
    
  
   $sql="insert into comodin(id_tecnologia,titulo,contenido,imagen,link_referencia,activo,orden,seccion)
   values('$this->id_tecnologia','$this->titulo','$this->contenido','$this->imagen','$this->link_referencia'
   ,'$this->activo','$this->orden','$this->seccion')";
   //mysql_query($sql);
   $objConn = new Conexion();
   $objConn->enlace->query($sql);
 }
 
 function actualizar($nro=0)	// actualiza cartel
	{
	        
	$sql="update comodin set id_tecnologia='$this->id_tecnologia', titulo='$this->titulo'
	,contenido='$this->contenido',imagen='$this->imagen',link_referencia='$this->link_referencia'
	,activo='$this->activo',orden='$this->orden',seccion='$this->seccion'    
	 where id_comodin = $nro";
	//mysql_query($sql); // ejecuta la consulta para actualizar
	$objConn = new Conexion();
            $objConn->enlace->query($sql);
            			
	}
	
 
 function borrar($nro=0)	
	{
	        echo $nro;
			$sql="delete from comodin where id_comodin = $nro";
			$objConn = new Conexion();
            $objConn->enlace->query($sql);
			
	
	}	
	static function traer_datos($nro=0) // declara el constructor, si trae el numero de persona lo busca 
	{
		if ($nro!=0)
		{
			$sql="select * from comodin where id_comodin = $nro";
			//$result=mysql_query($sql);
			$objConn = new Conexion();
            $result = $objConn->enlace->query($sql);
			$recs=mysqli_num_rows($result);
			$row=mysqli_fetch_array($result);
			$id=$row['ID_comodin'];
			
			return $row;
		}
	}	
	

 static function buscar($str){
    $sql="select * from comodin where titulo like '%$str%' or contenido like '%$str%' or link_referencia like '%$str%' or id_comodin='$str' or seccion like '%$str%'";
    //$rs=mysql_query($sql);
	$objConn = new Conexion();
	$rs=$objConn->enlace->query($sql);
	$est=array();
	//while($fila=mysql_fetch_assoc($rs) > 0){
	while($fila=mysqli_fetch_assoc($rs)){
	  $est[]=$fila;
	}return $est;
 
 }
 
 static function seleccionar_comodin($str,$seccion){
    $sql="select * from comodin where id_tecnologia = '$str' AND seccion= '$seccion' AND activo = 1 order by orden";

	/*
    if(is_numeric($str)){
	 $sql="select * from comodin where id_recurso = '$str' ";
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
 
  static function filtrar($str=''){
	$in=explode(" ", $str);
	$i=count($in);
	if($i==1)
	 $sql="select * from comodin where titulo like '%$in[0]%'  OR seccion like '%$in[0]%' OR  id_tecnologia='$in[0]' order by orden";
	if($i==2)
     $sql="select * from comodin where ((titulo like '%$in[0]%' OR  seccion like '%$in[0]%') AND id_tecnologia='$in[1]') 
	OR ((titulo like '%$in[1]%' OR  seccion like '%$in[1]%') AND id_tecnologia='$in[0]') order by orden";
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
