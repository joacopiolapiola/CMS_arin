<?php

error_reporting(E_ALL); // Reportar todos los errores
ini_set('display_errors', 1); // Mostrar errores en pantalla

header('Content-Type: application/json');
include_once "clases/conexion.php";
include_once "clases/usuarios.php";

// Obtener los datos enviados desde JavaScript
$datos = json_decode(file_get_contents('php://input'), true);

$nombre = $datos['username'];
$email = $datos['email'];
$password = $datos['password'];
$institucion = $datos['school'];
$telefono = $datos['phone'];

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

// Aquí proceso los datos (guardo en una base de datos)

   $reg = new Usuario();
   $reg->nombre=$nombre;
   $reg->telefono=$telefono;
   $reg->gmail=$email;
   $reg->password=$password;
   $reg->institucion=$institucion;
   $ret=$reg->registro();
   
  
   if($ret==true)
    echo json_encode(['success' => true, 'message' => 'Usuario registrado exitosamente.']);
   else
    echo json_encode(['success' => false, 'message' => 'Error al registrar Usuario']);
 
  

