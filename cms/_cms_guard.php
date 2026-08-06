<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../clases/permisos.php';

function cms_roles_normalizados(): array
{
    return PermisosSistema::rolesUsuario();
}

function cms_permisos_normalizados(): array
{
    return PermisosSistema::permisosUsuario();
}

function cms_permiso_por_archivo(): array
{
    $script = strtolower(basename($_SERVER['SCRIPT_FILENAME'] ?? ''));

    $mapa = [
        'usuarios_cms.php' => ['read' => 'cms:usuarios:read', 'write' => 'cms:usuarios:write'],
        'usuario_alta.php' => ['read' => 'cms:usuarios:read', 'write' => 'cms:usuarios:write'],
        'usuario_edit.php' => ['read' => 'cms:usuarios:read', 'write' => 'cms:usuarios:write'],
        'usuario_busqueda_cms.php' => ['read' => 'cms:usuarios:read', 'write' => 'cms:usuarios:write'],
        'secciones_cms.php' => ['read' => 'cms:secciones:read', 'write' => 'cms:secciones:write'],
        'seccion_alta.php' => ['read' => 'cms:secciones:read', 'write' => 'cms:secciones:write'],
        'seccion_edit.php' => ['read' => 'cms:secciones:read', 'write' => 'cms:secciones:write'],
        'tecnologias_cms.php' => ['read' => 'cms:tecnologias:read', 'write' => 'cms:tecnologias:write'],
        'tecnologia_alta.php' => ['read' => 'cms:tecnologias:read', 'write' => 'cms:tecnologias:write'],
        'tecnologia_edit.php' => ['read' => 'cms:tecnologias:read', 'write' => 'cms:tecnologias:write'],
        'recursos_cms.php' => ['read' => 'cms:recursos:read', 'write' => 'cms:recursos:write'],
        'recurso_alta.php' => ['read' => 'cms:recursos:read', 'write' => 'cms:recursos:write'],
        'recurso_edit.php' => ['read' => 'cms:recursos:read', 'write' => 'cms:recursos:write'],
        'recurso_busqueda_cms.php' => ['read' => 'cms:recursos:read', 'write' => 'cms:recursos:write'],
        'historia_cms.php' => ['read' => 'cms:historia:read', 'write' => 'cms:historia:write'],
        'historia_alta.php' => ['read' => 'cms:historia:read', 'write' => 'cms:historia:write'],
        'historia_edit.php' => ['read' => 'cms:historia:read', 'write' => 'cms:historia:write'],
        'quees_cms.php' => ['read' => 'cms:quees:read', 'write' => 'cms:quees:write'],
        'quees_alta.php' => ['read' => 'cms:quees:read', 'write' => 'cms:quees:write'],
        'quees_edit.php' => ['read' => 'cms:quees:read', 'write' => 'cms:quees:write'],
        'comodin_cms.php' => ['read' => 'cms:comodin:read', 'write' => 'cms:comodin:write'],
        'comodin_alta.php' => ['read' => 'cms:comodin:read', 'write' => 'cms:comodin:write'],
        'comodin_edit.php' => ['read' => 'cms:comodin:read', 'write' => 'cms:comodin:write'],
        'raiz_cms.php' => ['read' => 'cms:raiz:read', 'write' => 'cms:raiz:write'],
        'raiz_alta.php' => ['read' => 'cms:raiz:read', 'write' => 'cms:raiz:write'],
        'raiz_edit.php' => ['read' => 'cms:raiz:read', 'write' => 'cms:raiz:write'],
        'encuestas_cms.php' => ['read' => 'cms:encuestas:read', 'write' => 'cms:encuestas:write'],
        'encuesta_alta.php' => ['read' => 'cms:encuestas:read', 'write' => 'cms:encuestas:write'],
        'encuesta_edit.php' => ['read' => 'cms:encuestas:read', 'write' => 'cms:encuestas:write'],
        'cms_p40.php' => ['read' => 'cms:read', 'write' => 'cms:write'],
    ];

    return $mapa[$script] ?? ['read' => 'cms:read', 'write' => 'cms:write'];
}

if (isset($_SESSION['last_activity']) && (time() - (int) $_SESSION['last_activity']) > 1800) {
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    session_destroy();
    header('Location: ../index.php');
    exit;
}

$_SESSION['last_activity'] = time();

$userRoles = cms_roles_normalizados();
$userPermisos = cms_permisos_normalizados();
$isAdmin = PermisosSistema::tieneRol('administrador', 'admin', 'superadmin');
$permisosArchivo = cms_permiso_por_archivo();
$permisoLectura = $permisosArchivo['read'];
$permisoEscritura = $permisosArchivo['write'];

$canRead = $isAdmin || PermisosSistema::tienePermiso($permisoLectura, 'cms:read');
$canWrite = $isAdmin || PermisosSistema::tienePermiso($permisoEscritura, 'cms:write');

if (empty($_SESSION['email']) || (!$canRead && !$canWrite)) {
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    session_destroy();
    header('Location: ../index.php');
    exit;
}

if (!$isAdmin && strpos($_SERVER['SCRIPT_NAME'], 'alta.php') !== false && !$canWrite) {
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    session_destroy();
    header('Location: ../index.php?error=403');
    exit;
}

if (!$isAdmin && strpos($_SERVER['SCRIPT_NAME'], 'edit.php') !== false && !$canWrite) {
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    session_destroy();
    header('Location: ../index.php?error=403');
    exit;
}
