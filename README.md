# Documentación sencilla del CMS 

## Qué es
Un CMS sencillo en PHP para mostrar secciones, recursos, historias y tecnologías; incluye interfaz pública (index y páginas) y un panel de administración básico en la carpeta `cms/`. Está pensado para ejecutarse en un servidor PHP con una base de datos MySQL importada desde `sql/`.

### Stack
- Language(s): PHP (principal), JavaScript, HTML, CSS
- Framework / runtime: PHP (sin framework), Bootstrap CSS (CDN)
- Notable piezas: clases PHP en `clases/` (modelo / acceso a BD), página principal `index.php`, panel de administración en `cms/`.

## Cómo está organizado
Árbol anotado (solo entradas top-level relevantes):
```
index.php                # Página pública principal (carga secciones, menús y JS)
home.php                 # Página de ejemplo / portada secundaria
login.html               # Formulario de login (cliente)
login.php                # (archivo presente) login server-side (posible UI)
procesar_login.php       # Procesa el login (verificar credenciales, iniciar sesión)
registro.html            # Formulario de registro (cliente)
procesar_registro.php    # Procesa registro de usuarios
session_out.php          # Cerrar sesión / manejo sesión

clases/                  # Clases PHP que implementan la lógica y acceso a BD
  conexion.php           # Conexión a la base de datos
  secciones.php          # CRUD y consultas para 'secciones'
  tecnologias.php        # CRUD/consultas para 'tecnologias'
  usuarios.php           # Operaciones sobre usuarios
  historia.php           # Operaciones sobre historias
  recursos.php           # Operaciones sobre recursos
  raiz.php               # Datos de configuración raíz (ej. colores, logo)
  grabar_registro.php    # Lógica para grabar registro de usuarios

cms/                     # Panel de administración (alta/edición/búsqueda)
  secciones_cms.php
  seccion_alta.php
  seccion_edit.php
  secciones_busqueda_cms.php
  historia_cms.php, historia_alta.php, historia_edit.php, historia_busqueda_cms.php
  quees_cms.php, quees_alta.php, quees_edit.php, quees_busqueda_cms.php
  recursos_cms.php, recurso_alta.php, recurso_edit.php, recurso_busqueda_cms.php
  tecnologias_cms.php, tecnologia_alta.php, tecnologia_edit.php, tecnologias_busqueda_cms.php
  usuarios_cms.php, usuario_alta.php, usuario_edit.php, usuarios_busqueda_cms.php
  subir_img.php           # Subida de imágenes (para contenidos)

css/                     # Estilos por página / componentes
js/                      # JavaScript (interacciones, carga dinámica)
images/                  # Imágenes usadas por el sitio
sql/                     # Archivo SQL con esquema y datos iniciales
README.md                # Notas del repositorio (lista de issues/limitaciones)
```

**Cómo encaja:** index.php es el punto de entrada público. Al cargarse llama a las clases (Seccion::buscar(), Tecnologia::buscar(), Raiz::traer_datos()) para obtener datos que luego el front (js/main.js) usa para construir menús y cargar contenido dinámicamente. Las operaciones de administración CRUD están agrupadas en `cms/` y usan las clases en `clases/` que ejecutan consultas SQL vía `clases/conexion.php`.

## Flujo del CMS (resumen paso a paso)
1. El visitante abre index.php.
   - index.php incluye clases: `clases/secciones.php`, `clases/tecnologias.php`, `clases/raiz.php`.
   - Llama a Seccion::buscar() y Tecnologia::buscar() para obtener arrays con contenido.
   - Pasa esos datos a JavaScript (json_encode) y renderiza menús y submenús.
2. Interacción en cliente:
   - Archivo `js/main.js` contiene funciones (por ejemplo `cargar(selector, archivo)`, `poner_p40()`, `poner_menu()`, `poner_cat()`; index.php llama a `cargar('#Contenido','login.html')` desde el enlace de ingreso).
   - Al hacer clic en un menú o submenú, JS carga la página correspondiente dentro de `#Contenido` (páginas como `historia.php`, `recursos.php`, `quees.php`, etc.) usando carga dinámica/AJAX o insertando HTML.
3. Páginas públicas:
   - `historia.php`, `recursos.php`, `quees.php`, `curiosidades.php`, `fondo.php`, `home.php` muestran contenidos consultando las clases/BD o consumiendo datos preparados en index.php.
4. Login / Registro:
   - Formulario: `login.html` y `registro.html`.
   - Procesamiento: `procesar_login.php` verifica credenciales (probablemente usando `clases/usuarios.php`); `procesar_registro.php` guarda nuevo usuario (posible uso de `clases/grabar_registro.php`).
   - Cierre: `session_out.php` (y `logout.html` como enlace).
5. Administración (CMS):
   - En `cms/` están las páginas de gestión (alta, edit, búsqueda) para secciones, recursos, historias, tecnologías y usuarios.
   - Los archivos `*_alta.php` usan métodos de las clases (por ejemplo `guardar()`); `*_edit.php` usan `actualizar()`; `*_busqueda_cms.php` usan `filtrar()` o `listar()` para búsquedas.
   - `subir_img.php` gestiona la subida de imágenes para contenidos.
6. Base de datos:
   - Estructura y datos iniciales: `sql/127_0_0_1 (1).sql` — importar este SQL crea tablas y datos usados por las clases.
   - Conexión: `clases/conexion.php` contiene la configuración de conexión (host, usuario, contraseña, DB).

## Mapa de funciones principales → archivos
- Inicio y render público: index.php
- Menú dinámico y carga de contenido: js/main.js (usa los arrays pasados por index.php)
- Mostrar sección pública: clases/secciones.php (consultas) + archivos de vista (p. ej. historia.php, recursos.php, quees.php)
- Login form: login.html
- Procesar login: procesar_login.php (posible uso de clases/usuarios.php)
- Registro form: registro.html
- Procesar registro: procesar_registro.php / clases/grabar_registro.php
- Sesiones / logout: session_out.php, logout.html
- CRUD Secciones (admin): cms/seccion_alta.php, cms/seccion_edit.php, cms/secciones_cms.php, cms/secciones_busqueda_cms.php
- CRUD Historia (admin): cms/historia_alta.php, cms/historia_edit.php, cms/historia_cms.php
- CRUD Recursos (admin): cms/recurso_alta.php, cms/recurso_edit.php, cms/recursos_cms.php
- CRUD Tecnologías (admin): cms/tecnologia_alta.php, cms/tecnologia_edit.php, cms/tecnologias_cms.php
- Usuarios (admin): cms/usuario_alta.php, cms/usuario_edit.php, cms/usuarios_cms.php
- Subida de imágenes: cms/subir_img.php
- Acceso a BD y utilidades: clases/conexion.php, clases/raiz.php (datos globales)
- Estilos: css/main.css y otros CSS por página en `css/`
- Scripts cliente: js/main.js y js/comodin.js

## Cómo ejecutarlo (rápido)
1. Clonar el repositorio.
2. Importar la base de datos:
   - Renombrar si es necesario el archivo SQL (tiene espacios): por ejemplo `schema.sql`.
   - Importar:
     - mysql -u TU_USUARIO -p TU_BD < sql/schema.sql
     - o usar phpMyAdmin / Workbench para importar `sql/127_0_0_1 (1).sql`.
3. Configurar la conexión a la base de datos:
   - Editar `clases/conexion.php` para poner host, usuario, contraseña y nombre de BD.
4. Servir con PHP:
   - Con XAMPP/AMPPS: colocar la carpeta dentro de `htdocs` y abrir en el navegador.
   - O con servidor embebido de PHP:
     - php -S localhost:8000
     - Abrir http://localhost:8000/index.php
5. Acceder:
   - Página pública: `index.php`
   - Admin: abrir `cms/` y usar las páginas de alta/edición (según cómo estén protegidas; revisar `cms/` para control de sesiones).

## Limitaciones / notas (sacadas del README original)
- No hay control de duplicados de secciones desde la interfaz.
- No existe UI para cambiar color de fondo o color del CMS.
- Algunas funcionalidades (música de fondo, fotos de perfil, comentarios, búsqueda avanzada) no están implementadas.

## Preguntas útiles que podrías hacer a continuación
- ¿Dónde se validan las credenciales de usuario en el código? (buscar en `procesar_login.php` y `clases/usuarios.php`)
- ¿Cómo se almacena el logo y configuración global? (revisar `clases/raiz.php` y `raiz_cms.php`)
- ¿Qué campos tiene la tabla `secciones` en la BD y cómo mapearlos con los formularios de `cms/seccion_alta.php`? (revisar `sql/127_0_0_1 (1).sql` para el esquema)

---

Si quieres, puedo:
- Generar un archivo DOCUMENTACION.md listo para añadir al repo con este contenido.
- Hacer una lista más detallada de rutas y parámetros de cada formulario (si deseas que inspeccione archivos específicos como `procesar_login.php`, `clases/conexion.php` o `js/main.js`).
