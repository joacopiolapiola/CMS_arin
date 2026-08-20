<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/clases/permisos.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, private');

$activa = !empty($_SESSION['login_exitoso']) && (
    !empty($_SESSION['user']['id']) || !empty($_SESSION['id_usuario'])
);

if (!$activa) {
    echo json_encode(['activa' => false]);
    exit;
}

$roles = PermisosSistema::rolesUsuario();
$puedeCms = PermisosSistema::tieneRol('administrador', 'admin', 'superadmin')
    || PermisosSistema::tienePermiso('cms:read', 'cms:write');

echo json_encode([
    'activa' => true,
    'nombre' => (string) ($_SESSION['user']['nombre'] ?? $_SESSION['nombre_usuario'] ?? $_SESSION['name_sess'] ?? ''),
    'rol' => implode(', ', $roles),
    'puede_cms' => $puedeCms,
]);
