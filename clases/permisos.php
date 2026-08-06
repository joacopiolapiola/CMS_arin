<?php

class PermisosSistema
{
    public static function normalizarLista($valor): array
    {
        if (is_array($valor)) {
            $items = $valor;
        } elseif (is_string($valor)) {
            $items = preg_split('/[\s,;|]+/', trim($valor), -1, PREG_SPLIT_NO_EMPTY);
        } else {
            $items = [];
        }

        $lista = [];
        foreach ($items as $item) {
            $limpio = strtolower(trim((string) $item));
            if ($limpio !== '') {
                $lista[] = $limpio;
            }
        }

        return array_values(array_unique($lista));
    }

    public static function permisosPorRol(string $rol): array
    {
        $rol = strtolower(trim($rol));

        $mapa = [
            'visitante' => [
                'front:view',
            ],
            'usuario' => [
                'front:view',
                'front:profile',
            ],
            'editor' => [
                'front:view',
                'front:profile',
                'cms:read',
                'cms:content',
                'cms:usuarios:read',
                'cms:secciones:read',
                'cms:tecnologias:read',
                'cms:recursos:read',
                'cms:historia:read',
                'cms:quees:read',
                'cms:comodin:read',
                'cms:raiz:read',
            ],
            'administrador' => [
                'front:view',
                'front:profile',
                'cms:read',
                'cms:content',
                'cms:write',
                'cms:users',
                'cms:config',
                'cms:usuarios:read',
                'cms:usuarios:write',
                'cms:secciones:read',
                'cms:secciones:write',
                'cms:tecnologias:read',
                'cms:tecnologias:write',
                'cms:recursos:read',
                'cms:recursos:write',
                'cms:historia:read',
                'cms:historia:write',
                'cms:quees:read',
                'cms:quees:write',
                'cms:comodin:read',
                'cms:comodin:write',
                'cms:raiz:read',
                'cms:raiz:write',
            ],
            'admin' => [
                'front:view',
                'front:profile',
                'cms:read',
                'cms:content',
                'cms:write',
                'cms:users',
                'cms:config',
                'cms:usuarios:read',
                'cms:usuarios:write',
                'cms:secciones:read',
                'cms:secciones:write',
                'cms:tecnologias:read',
                'cms:tecnologias:write',
                'cms:recursos:read',
                'cms:recursos:write',
                'cms:historia:read',
                'cms:historia:write',
                'cms:quees:read',
                'cms:quees:write',
                'cms:comodin:read',
                'cms:comodin:write',
                'cms:raiz:read',
                'cms:raiz:write',
            ],
            'superadmin' => [
                'front:view',
                'front:profile',
                'cms:read',
                'cms:content',
                'cms:write',
                'cms:users',
                'cms:config',
                'cms:usuarios:read',
                'cms:usuarios:write',
                'cms:secciones:read',
                'cms:secciones:write',
                'cms:tecnologias:read',
                'cms:tecnologias:write',
                'cms:recursos:read',
                'cms:recursos:write',
                'cms:historia:read',
                'cms:historia:write',
                'cms:quees:read',
                'cms:quees:write',
                'cms:comodin:read',
                'cms:comodin:write',
                'cms:raiz:read',
                'cms:raiz:write',
            ],
        ];

        return $mapa[$rol] ?? [];
    }

    public static function rolesUsuario(): array
    {
        $roles = $_SESSION['user']['roles'] ?? $_SESSION['roles'] ?? [];
        return self::normalizarLista($roles);
    }

    public static function permisosUsuario(): array
    {
        $permisos = $_SESSION['user']['permisos'] ?? $_SESSION['permisos'] ?? [];
        $permisos = self::normalizarLista($permisos);

        foreach (self::rolesUsuario() as $rol) {
            foreach (self::permisosPorRol($rol) as $permiso) {
                $permisos[] = $permiso;
            }
        }

        return array_values(array_unique($permisos));
    }

    public static function tieneRol(...$rolesRequeridos): bool
    {
        $rolesUsuario = self::rolesUsuario();

        foreach ($rolesRequeridos as $rol) {
            $rolNormalizado = strtolower(trim((string) $rol));
            if ($rolNormalizado !== '' && in_array($rolNormalizado, $rolesUsuario, true)) {
                return true;
            }
        }

        return false;
    }

    public static function tienePermiso(...$permisosRequeridos): bool
    {
        $permisosUsuario = self::permisosUsuario();

        foreach ($permisosRequeridos as $permiso) {
            $permisoNormalizado = strtolower(trim((string) $permiso));
            if ($permisoNormalizado !== '' && in_array($permisoNormalizado, $permisosUsuario, true)) {
                return true;
            }
        }

        return false;
    }

    public static function requireRole(...$roles): void
    {
        if (!self::tieneRol(...$roles)) {
            self::redirigirNoAutorizado();
        }
    }

    public static function requirePermission(...$permisos): void
    {
        if (!self::tienePermiso(...$permisos)) {
            self::redirigirNoAutorizado();
        }
    }

    public static function redirigirNoAutorizado(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }

        session_destroy();
        header('Location: ../index.php?error=403');
        exit;
    }

    public static function cargarDesdeUsuario(array $usuario): array
    {
        $roles = self::normalizarLista($usuario['roles'] ?? $usuario['rol'] ?? []);
        $permisos = self::normalizarLista($usuario['permisos'] ?? $usuario['Permisos'] ?? []);

        foreach ($roles as $rol) {
            foreach (self::permisosPorRol($rol) as $permiso) {
                $permisos[] = $permiso;
            }
        }

        $permisos = array_values(array_unique($permisos));

        $userId = $usuario['id_usuario'] ?? $usuario['ID_usuario'] ?? null;

        $_SESSION['user'] = [
            'id' => $userId,
            'nombre' => $usuario['nombre'] ?? 'Usuario',
            'email' => $usuario['email'] ?? $usuario['gmail'] ?? '',
            'roles' => $roles,
            'permisos' => $permisos,
        ];

        $_SESSION['id_usuario'] = $userId;
        $_SESSION['id'] = $userId;
        $_SESSION['user_id'] = $userId;
        $_SESSION['roles'] = $roles;
        $_SESSION['permisos'] = $permisos;

        return [
            'roles' => $roles,
            'permisos' => $permisos,
        ];
    }
}
