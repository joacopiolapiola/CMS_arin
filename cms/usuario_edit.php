<?php
include_once "../clases/usuarios.php";


$datos = new Usuario();
$usuario = new Usuario();

$id_usuario= '';
$nombre= '';
$telefono= '';
$roles= '';
$email= '';
$password= '';
$permisos= '';
$institucion= '';
$rol_institucion= '';

//echo $_SERVER['PHP_SELF'];
//echo $_GET['operacion'];

if (!empty($_POST)) {

   $operacion = isset($_POST['operacion']) ? $_POST['operacion'] : 'actualizar' ;
	//echo $operacion;
	if ($operacion == 'edicion'){
	  
	  
	  $id=$_POST['id_usuario'];
	  
	  $A=Usuario::traer_datos($id);

	  $nombre= $A['nombre'];
      $telefono=$A['telefono'];
      $email= $A['email'];
      $roles= $A['roles'];
      $password= $A['password'];
      $permisos= $A['Permisos'];
      $institucion= $A['Institucion'];
	    $rol_institucion= $A['Rol_institucion'];
      
		
		$accion = $_SERVER['PHP_SELF'].'?operacion=actualizar&ID_usuario='. $id;
		$btn_txt='Actualizar';
		$leyenda='Modificar Usuario ';
		
	}
	
  if ($operacion == 'actualizar' && isset($_GET['ID_usuario'])){
    echo '2-actualizar';
    $usuario->nombre=$_POST['txtNombre'];
    $usuario->telefono=$_POST['txtTelefono'];
    $usuario->gmail=$_POST['txtEmail'];
    $usuario->roles=$_POST['txtRoles'];
    $usuario->permisos=$_POST['txtPermisos'];
    $usuario->institucion=$_POST['txtInstitucion'];
    $usuario->rol_institucion=$_POST['txtRolInstitucion'];
    
    
  
  
  
  
  $usuario->actualizar($_GET['ID_usuario']);
  header("Location: ".$_SERVER['HTTP_REFERER']);
}		
  

if ($operacion == 'baja'){
	  
	  
  $id=$_POST['id_usuario'];

  $A=Usuario::traer_datos($id);

      $nombre= $A['nombre'];
      $telefono=$A['telefono'];
      $gmail= $A['gmail'];
      $roles= $A['roles'];
      $password= $A['password'];
      $permisos= $A['permisos'];
      $institucion= $A['institucion'];
	    $rol_institucion= $A['Rol_institucion'];

$accion=$_SERVER['PHP_SELF'].'?operacion=borrar&id_usuario='. $id;
$btn_txt='Borrar';
$leyenda='Eliminar';
}

	

	
    
}

if (!empty($_GET)) {
  $operacion = isset($_GET['operacion']) ? $_GET['operacion'] : 'agregar' ;
  if ($operacion == 'agregar'){

    $usuario->nombre=$_POST['txtNombre'];
    $usuario->telefono=$_POST['TxtTelefono'];
    $usuario->gmail=$_POST['TxtEmail'];
    $usuario->roles=$_POST['txtRoles'];
    $usuario->permisos=$_POST['txtPermisos'];
    $usuario->institucion=$_POST['txtInstitucion'];
    $usuario->rol_institucion=$_POST['txtRolInstitucion'];
    $usuario->password=md5($_POST['txtPassword']);
      
    
      
  $usuario->guardar();
  header("Location: ".$_SERVER['HTTP_REFERER']);
  }
  if ($operacion == 'borrar' && isset($_GET['id_usuario'])){
    //echo '2-actualizar';
    
  
  $usuario->borrar($_GET['id_usuario']);
  header("Location: ".$_SERVER['HTTP_REFERER']);
  }

}

?>

<?php
if ($operacion == 'edicion' || $operacion == 'baja'){
  ?>
<div class="container">
  
   
  <form  role="form" method="POST" action=<?php echo $accion;?>>
   <legend><?php echo $leyenda;?></legend>
      
	 <div class="form-group">
	 <div class="row" >
     <div class="col-sm-2">
		   <label for="TxtId_usuario">Id Usuario</label>
		   <input type="text" value=<?php echo $id;?> name="TxtId_usuario" class="form-control" id="TxtId_usuario">
		 </div>

	     <div class="col-sm-6">
		  <label for="txtNombre">Nombre</label>
		  <input type="text"  value="<?php echo $nombre;?>" name="txtNombre" class="form-control" id="txtNombre">
		 </div>
		 
		
		 
		 <div class="col-sm-3">
		   <label for="txtTelefono">Telefono</label>
		   <input type="text" value=<?php echo $telefono;?> name="txtTelefono" class="form-control" id="txtTelefono">
		</div>
	 </div>
	 <br>
   <div class="row" >	 
		<div class="col-sm-5">
		   <label for="txtEmail">email</label>
		   <input type="text" value="<?php echo $email;?>" name="txtEmail" class="form-control" id="txtEmail">
		</div>
    <div class="col-sm-5">
            <label for="txtRoles">Roles</label>
            <input type="text" value=<?php echo $roles;?> size="10" name="txtRoles" class="form-control" id="txtRoles">
    </div>
		<div class="col-sm-2">
		   <label for="txtPermisos">Permisos</label>
		   <input type="text" value="<?php echo $permisos;?>" name="txtPermisos" class="form-control" id="txtPermisos">
		</div>	   
  </div>
    <br>
   <div class="row" >	 
		<div class="col-sm-6">
		   <label for="txtInstitucion">Institucion</label>
		   <input type="text" value="<?php echo $institucion;?>" name="txtInstitucion" class="form-control" id="txtInstitucion">
		</div>
    <div class="col-sm-6">
            <label for="txtRolInstitucion">Rol Institucional</label>
            <input type="text" value="<?php echo $rol_institucion;?>" size="10" name="txtRolInstitucion" class="form-control" id="txtRolInstitucion">
    </div>
	  
   	 </div>
	  <br>

 <button method="post" type="submit" class="btn btn-primary btn-xs"><?php echo $btn_txt;?></button>

</form>  

</div>
 <?php
} 
?>



