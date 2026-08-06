<?php
session_start();

error_reporting(E_ALL); // Reportar todos los errores
ini_set('display_errors', 1); // Mostrar errores en pantalla

header('Content-Type: application/json');
include_once "clases/conexion.php";
include_once "clases/usuarios.php";
include_once "clases/permisos.php";



// Obtener los datos enviados desde JavaScript
$datos = json_decode(file_get_contents('php://input'), true);


$email = trim((string) ($datos['email'] ?? ''));
$password = (string) ($datos['password'] ?? '');

if ($email === '' || $password === '') {
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

$ret = Usuario::filtrar($email, 'login');
if (empty($ret)) {
    echo json_encode(['success' => false, 'message' => 'Acceso Denegado.']);
    exit;
}

$usuario = $ret[0];
$nombre = $usuario['nombre'] ?? 'Usuario';
$mail = $usuario['email'] ?? $email;
$pass = $usuario['password'] ?? '';
$roles = $usuario['roles'] ?? '';
$access = $usuario['Permisos'] ?? '';
$institucion = $usuario['Institucion'] ?? '';

if (!is_string($pass) || $pass === '') {
    echo json_encode(['success' => false, 'message' => 'Acceso Denegado.']);
    exit;
}

$checkPass = password_verify($password, $pass);
if (!$checkPass) {
    echo json_encode(['success' => false, 'message' => 'Acceso Denegado.']);
    exit;
}

session_regenerate_id(true);
$perfil = [
    'id_usuario' => $usuario['id_usuario'] ?? $usuario['ID_usuario'] ?? null,
    'nombre' => $nombre,
    'email' => $mail,
    'roles' => $roles,
    'permisos' => $access,
    'institucion' => $institucion,
];

PermisosSistema::cargarDesdeUsuario($perfil);

$_SESSION['nombre_usuario'] = $nombre;
$_SESSION['name_sess'] = $nombre;
$_SESSION['email'] = $mail;
$_SESSION['institucion'] = $institucion;
$_SESSION['login_exitoso'] = true;
$_SESSION['id_usuario'] = $perfil['id_usuario'];
$_SESSION['id'] = $perfil['id_usuario'];
$_SESSION['user_id'] = $perfil['id_usuario'];
$_SESSION['last_activity'] = time();

$rolesNormalizados = PermisosSistema::rolesUsuario();
$permisosNormalizados = PermisosSistema::permisosUsuario();

echo json_encode([
    'success' => true,
    'message' => 'Login Exitoso.',
    'usuario' => $nombre,
    'roles' => $rolesNormalizados,
    'permisos' => $permisosNormalizados,
]);
