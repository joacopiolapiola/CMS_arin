<?php
include_once "../clases/secciones.php";

$seccion = new Seccion();
//echo '2-actualizar';
if (!empty($_POST)) {

    if ($operacion == 'actualizar' && isset($_POST['id_seccion'])){
        
        $seccion->nombre=$_POST['txtNombre'];
        $seccion->id_tecnologia=$_POST['TxtId_tecnologia'];
        $seccion->orden=$_POST['txtOrden'];
        $seccion->enlace=$_POST['txtEnlace'];
        $seccion->activo=$_POST['txtActivo'];
      
      
      
      
      $seccion->actualizar($_POST['id_seccion']);
      header("Location: seccion_edit.php");
    }	

    if ($operacion == 'agregar'){
      
      $seccion->nombre=$_POST['txtNombre'];
      $seccion->id_tecnologia=$_POST['TxtId_tecnologia'];
      $seccion->orden=$_POST['txtOrden'];
      $seccion->enlace=$_POST['txtEnlace'];
      $seccion->activo=$_POST['txtActivo'];
        
    $seccion->guardar();
    header("Location: seccion_edit.php");
  }


}