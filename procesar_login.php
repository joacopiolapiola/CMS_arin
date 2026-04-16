<?php
session_start();

error_reporting(E_ALL); // Reportar todos los errores
ini_set('display_errors', 1); // Mostrar errores en pantalla

header('Content-Type: application/json');
include_once "clases/conexion.php";
include_once "clases/usuarios.php";



// Obtener los datos enviados desde JavaScript
$datos = json_decode(file_get_contents('php://input'), true);


$email = $datos['email'];
$password = $datos['password'];


// Validar los datos en el servidor (opcional, pero recomendado)
if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'El email no es válido.']);
    exit;
}

if (strlen($password) < 6) {
    echo json_encode(['success' => false, 'message' => 'La contraseña debe tener al menos 6 caracteres.']);
    exit;
}

// Aquí puedes procesar los datos (guardar en una base de datos, etc.)

   //$reg = new Usuario();
   $tmp=password_hash('$password', PASSWORD_DEFAULT);
   
   
   $ret=Usuario::filtrar($email,'login');

   $nombre=$ret[0]['nombre'];
   $mail=$ret[0]['email'];
   $pass=$ret[0]['password'];
   $roles=$ret[0]['roles'];
   $access=$ret[0]['Permisos'];
   $institucion=$ret[0]['Institucion'];
   //$reg->password=$password;
   $checkPass=password_verify($password, $pass);

   if($checkPass){
    //echo "<script>poner_username(".$nombre.");</script>";
    //aca registrar la session
    
    $_SESSION['nombre_usuario']=$nombre;
    $_SESSION['name_sess']=$nombre;
    $_SESSION['email']=$mail;
    $_SESSION['roles']=$roles;
    $_SESSION['permisos']=$access;
    $_SESSION['institucion']=$institucion;
    
    //poner_menu("cms",$roles);
    
    echo json_encode(['success' => true, 'message' => 'Login Exitoso.', 'usuario' => $nombre, 'roles' => $roles]);

    
    
    }
   else
    echo json_encode(['success' => false, 'message' => 'Acceso Denegado.']);
  
  
//echo "<script>poner_username(".$nombre.");</script>";
