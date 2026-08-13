# Sistema de permisos del CMS

## Roles

- visitante
- usuario
- editor
- administrador

## Permisos por módulo

- cms:usuarios:read
- cms:usuarios:write
- cms:secciones:read
- cms:secciones:write
- cms:tecnologias:read
- cms:tecnologias:write
- cms:recursos:read
- cms:recursos:write
- cms:historia:read
- cms:historia:write
- cms:quees:read
- cms:quees:write
- cms:comodin:read
- cms:comodin:write
- cms:raiz:read
- cms:raiz:write

## Regla base

- visitante: solo vista pública
- usuario: vista pública + perfil
- editor: lectura del CMS y edición de contenido
- administrador: acceso completo al CMS

## Validación

Usar siempre:

```php
require_once __DIR__ . '/../clases/permisos.php';
PermisosSistema::requirePermission('cms:usuarios:write');
```

o

```php
PermisosSistema::requireRole('administrador', 'admin', 'superadmin');
```

## Recomendación

No confiar en ocultar botones solamente. El backend debe validar siempre el permiso real antes de ejecutar cualquier operación.
