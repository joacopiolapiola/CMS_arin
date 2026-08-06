<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json');
include_once "clases/conexion.php";
include_once "clases/usuarios.php";

$rawInput = file_get_contents('php://input');
$datos = json_decode($rawInput, true);

if (!is_array($datos)) {
    echo json_encode(['success' => false, 'message' => 'Datos de entrada inválidos.']);
    exit;
}

$nombre = trim((string) ($datos['username'] ?? ''));
$email = trim((string) ($datos['email'] ?? ''));
$password = (string) ($datos['password'] ?? '');
$institucion = trim((string) ($datos['school'] ?? ''));
$telefono = trim((string) ($datos['phone'] ?? ''));

if ($nombre === '' || $email === '' || $password === '' || $institucion === '' || $telefono === '') {
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

if (!preg_match('/^[0-9]{10}$/', $telefono)) {
    echo json_encode(['success' => false, 'message' => 'El teléfono debe contener 10 dígitos numéricos.']);
    exit;
}

$reg = new Usuario();
$reg->nombre = $nombre;
$reg->telefono = $telefono;
$reg->gmail = $email;
$reg->password = $password;
$reg->institucion = $institucion;

$ret = $reg->registro();

if ($ret === true) {
    echo json_encode(['success' => true, 'message' => 'Usuario registrado exitosamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al registrar usuario. Verifique los datos e intente nuevamente.']);
}

