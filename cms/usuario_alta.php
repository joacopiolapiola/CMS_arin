<?php
require_once __DIR__ . '/_cms_guard.php';
include_once "../clases/usuarios.php";


//$cats=usuario::nombres();

$datos = new Usuario();
$usuario = new Usuario();

$id_usuario= '';
$nombre= '';
$telefono= '';
$roles= '';
$gmail= '';
$password= '';
$permisos= '';
$institucion= '';
$rol_institucion= '';
 

?>

 
<div class="container">
  
   
  <form  id="FormUser" role="form" method="POST" action="usuario_edit.php?operacion=agregar">
   <legend>Alta usuario</legend>
      
	 <div class="form-group">
	 <div class="row" >
	     <div class="col-sm-6">
		  <label>Nombre</label>
		  <input type="text"  size="20" name="txtNombre" class="form-control" id="txtNombre" >
		 </div>
		 
		 <div class="col-sm-2">
		   <label>Tel. Movil</label>
		   <input type="text" name="TxtTelefono" class="form-control" id="TxtTelefono">
		 </div>
		 
		 <div class="col-sm-3">
		   <label>e-mail</label>
		   <input type="text" name="txtEmail" class="form-control" id="txtEmail">
		</div>
	 </div><br>
     <div class="row" >	 
		<div class="col-sm-5">
		   <label>Institucion</label>
		   <input type="text"  name="txtInstitucion" class="form-control" id="txtInstitucion" >
		</div>
        <div class="col-sm-5">
		   <label>Rol Institucional</label>
		   <input type="text"  name="txtRolInstitucion" class="form-control" id="txtRolInstitucion">
		</div>	   
   	 </div><br>

	 <div class="row" >	 
		
        <div class="col-sm-2">
            <label>Password</label>
            <input type="password"  size="10" name="txtPassword" class="form-control" id="txtPassword">
        </div>
        <div class="col-sm-2">
            <label>Repetir Password</label>
            <input type="password"  size="10" name="txtPasswordRepetir" class="form-control" id="txtPasswordRepetir">
        </div>
        <div class="col-sm-4">
		   <label for="txtRoles">Rol Usuario</label>
		   <select name="txtRoles" class="form-select" id="txtRoles" required>
             <option value="">Seleccionar rol</option>
             <?php foreach (PermisosSistema::rolesDisponibles() as $valorRol => $etiquetaRol): ?>
               <option value="<?php echo htmlspecialchars($valorRol, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($etiquetaRol, ENT_QUOTES, 'UTF-8'); ?></option>
             <?php endforeach; ?>
           </select>
		</div>
		<input type="hidden" name="txtPermisos" value="">
   	 </div>
	  

 <button method="post" type="submit"  class="btn btn-primary btn-xs">Agregar</button>
 <div id="DataError" class="error"></div>
</form>  
<script>VerificarCampos()</script>
</div>

