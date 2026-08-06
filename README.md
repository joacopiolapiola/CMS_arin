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


# Documentación de Archivos en la Carpeta /cms

## Tabla de Contenidos
1. [Archivos de ABM (Alta, Baja, Modificación)](#archivos-de-abm)
2. [Archivos de Búsqueda](#archivos-de-búsqueda)
3. [Archivos de Visualización](#archivos-de-visualización)
4. [Archivos de Utilidad](#archivos-de-utilidad)

---

## Archivos de ABM

### 1. **___abm_seccion___.php**
**Descripción:** Archivo de procesamiento para el ABM (Alta, Baja, Modificación) de secciones.

**Funciones:**
- Incluye la clase `Seccion` desde `../clases/secciones.php`
- **`actualizar($id_seccion)`** - Actualiza los datos de una sección existente
  - Recibe: nombre, id_tecnologia, orden, enlace, activo
  - Realiza redirección a `seccion_edit.php` tras actualizar
- **`agregar()`** - Agrega una nueva sección a la base de datos
  - Recibe: nombre, id_tecnologia, orden, enlace, activo
  - Realiza redirección a `seccion_edit.php` tras guardar

---

### 2. **tecnologia_alta.php**
**Descripción:** Formulario para dar de alta (crear) nuevos tópicos/tecnologías.

**Funciones:**
- Muestra un formulario HTML con los campos para crear un nuevo tópico
- Campos del formulario:
  - Nombre del tópico
  - Abreviatura
  - Orden
  - Definición (textarea)
  - Resumen (textarea)
  - Logo
  - Color
  - BackGround Color
  - Activo
- Envía datos a `tecnologia_edit.php` con operación "agregar"

---

### 3. **tecnologia_edit.php**
**Descripción:** Procesa la edición, actualización y eliminación de tópicos/tecnologías.

**Funciones:**
- **`traer_datos($id)`** - Obtiene los datos de un tópico específico
- **`actualizar($id_tecnologia)`** - Actualiza un tópico existente con:
  - nombre, abreviatura, resumen, definición, logo, orden, activo, color, bkg_color
- **`guardar()`** - Guarda un nuevo tópico en la base de datos
- **`borrar($id_tecnologia)`** - Elimina un tópico de la base de datos
- Maneja operaciones: 'agregar', 'edicion', 'actualizar', 'baja', 'borrar'

---

### 4. **historia_alta.php**
**Descripción:** Formulario para dar de alta nuevas historias relacionadas a tópicos.

**Funciones:**
- Inicializa variables para los campos del formulario
- Incluye clases `Historia` y `Tecnologia`
- Obtiene lista de tópicos con `Tecnologia::seleccionar()`
- Campos:
  - Título
  - ID Tópico / Selector de Tópico
  - Contenido (textarea)
  - Imagen
  - Enlace Web
  - Activo
  - Orden
  - Carga de archivo de imagen

---

### 5. **historia_edit.php**
**Descripción:** Procesa la edición, actualización y eliminación de historias.

**Funciones:**
- **`traer_datos($id)`** - Obtiene datos de una historia específica
- **`actualizar($id_historia)`** - Actualiza:
  - titulo, id_tecnologia, contenido, imagen, orden, link_referencia, activo
- **`guardar()`** - Guarda una nueva historia
- **`borrar($id_historia)`** - Elimina una historia
- Maneja operaciones: 'agregar', 'edicion', 'actualizar', 'baja', 'borrar'

---

### 6. **raiz_alta.php**
**Descripción:** Formulario para dar de alta nuevas "raíces" (categorías principales).

**Funciones:**
- Inicializa la clase `Raiz`
- Campos:
  - Nombre
  - Abreviatura
  - Orden
  - Definición
  - Resumen
  - Logo
  - Activo
  - Color y BackGround Color (con selectores de color HTML5)
- Envía datos a `raiz_edit.php`

---

### 7. **raiz_edit.php**
**Descripción:** No se recuperó completamente, pero sigue el patrón de procesamiento de ABM para raíces.

---

### 8. **recurso_alta.php**
**Descripción:** Formulario para dar de alta nuevos recursos.

**Funciones:**
- Incluye clases `Recurso` y `Tecnologia`
- Obtiene lista de tópicos
- Campos similares a Historia:
  - Título
  - ID Tópico / Selector
  - Contenido
  - Imagen
  - Enlace Web
  - Activo
  - Orden
  - Carga de imagen

---

### 9. **recurso_edit.php**
**Descripción:** Procesa ABM de recursos.

**Funciones:**
- **`traer_datos($id)`** - Obtiene datos de un recurso
- **`actualizar($id_recurso)`** - Actualiza recurso
- **`guardar()`** - Guarda nuevo recurso
- **`borrar($id_recurso)`** - Elimina recurso
- Operaciones: 'agregar', 'edicion', 'actualizar', 'baja', 'borrar'

---

### 10. **seccion_alta.php**
**Descripción:** Formulario para dar de alta nuevas secciones.

**Funciones:**
- Incluye clase `Seccion`
- Llama a `Seccion::nombres()` para obtener lista de secciones
- Campos:
  - Nombre (sin espacios)
  - ID Tópico
  - Orden
  - Enlace
  - Activo
  - Enlace CMS

---

### 11. **seccion_edit.php**
**Descripción:** Procesa ABM de secciones.

**Funciones:**
- **`traer_datos($id)`** - Obtiene datos de una sección
- **`actualizar($id_seccion)`** - Actualiza sección
- **`guardar()`** - Guarda nueva sección
- **`borrar($id_seccion)`** - Elimina sección
- Validación: El nombre de la sección no puede contener espacios

---

### 12. **usuario_alta.php**
**Descripción:** Formulario para dar de alta nuevos usuarios del sistema.

**Funciones:**
- Incluye clase `Usuario`
- Campos:
  - Nombre
  - Teléfono Móvil
  - E-mail
  - Institución
  - Rol Institucional
  - Password (con confirmación)
  - Rol Usuario
  - Permisos
- Llamadas a validación con `VerificarCampos()`

---

### 13. **usuario_edit.php**
**Descripción:** Procesa ABM de usuarios.

**Funciones:**
- **`traer_datos($id)`** - Obtiene datos de un usuario
- **`actualizar($id_usuario)`** - Actualiza usuario
- **`guardar()`** - Guarda nuevo usuario con contraseña encriptada (MD5)
- **`borrar($id_usuario)`** - Elimina usuario
- Operaciones: 'agregar', 'edicion', 'actualizar', 'baja', 'borrar'

---

### 14. **quees_alta.php**
**Descripción:** Formulario para dar de alta nuevas definiciones "¿Qué es?".

**Funciones:**
- Incluye clases `Quees` y `Tecnologia`
- Obtiene lista de tópicos
- Campos similares a Historia y Recursos:
  - Título
  - ID Tópico / Selector
  - Contenido
  - Imagen
  - Enlace Web
  - Activo
  - Orden
  - Carga de imagen

---

### 15. **quees_edit.php**
**Descripción:** Procesa ABM de definiciones "¿Qué es?".

**Funciones:**
- **`traer_datos($id)`** - Obtiene datos de una definición
- **`actualizar($id_quees)`** - Actualiza definición
- **`guardar()`** - Guarda nueva definición
- **`borrar($id_quees)`** - Elimina definición
- Operaciones: 'agregar', 'edicion', 'actualizar', 'baja', 'borrar'

---

## Archivos de Búsqueda

### 16. **comodin_busqueda_cms.php**
**Descripción:** Genera una tabla con resultados de búsqueda de "comodines".

**Funciones:**
- Recibe: `$_POST['b']` (término de búsqueda)
- **`Comodin::filtrar($str_b)`** - Busca y filtra comodines
- Muestra tabla con columnas: Id, Seccion, Titulo, Contenido, Id-Top, Orden, Enlace, Activo
- Botones: Editar y Borrar para cada resultado

---

### 17. **historia_busqueda_cms.php**
**Descripción:** Genera tabla de resultados para búsqueda de historias.

**Funciones:**
- Recibe: `$_POST['b']` (término de búsqueda)
- **`Historia::filtrar($str_b)`** - Filtra historias
- Muestra tabla con: Id, Titulo, Contenido, Id-Top, Orden, Enlace, Activo
- Botones: Editar y Borrar

---

### 18. **raiz_busqueda_cms.php**
**Descripción:** Genera tabla de resultados para búsqueda de raíces.

**Funciones:**
- Recibe: `$_POST['b']`
- **`Raiz::filtrar($str_b)`** - Filtra raíces
- Muestra tabla con: Id, Nombre, Abreviatura, Resumen, Definición, Orden, Activo, Logo, Color, Bkg Color
- Botones: Editar y Borrar

---

### 19. **recurso_busqueda_cms.php**
**Descripción:** Genera tabla de resultados para búsqueda de recursos.

**Funciones:**
- Recibe: `$_POST['b']`
- **`Recurso::filtrar($str_b)`** - Filtra recursos
- Muestra tabla con resultados similar a Historia
- Botones: Editar y Borrar

---

### 20. **secciones_busqueda_cms.php**
**Descripción:** Genera tabla de resultados para búsqueda de secciones.

**Funciones:**
- Recibe: `$_POST['b']`
- **`Seccion::filtrar($str_b)`** - Filtra secciones
- Muestra tabla con: Id, Nombre, Id-Top, Orden, Enlace, Activo, Enlace CMS
- Botones: Editar y Borrar

---

### 21. **tecnologias_busqueda_cms.php**
**Descripción:** Genera tabla de resultados para búsqueda de tópicos/tecnologías.

**Funciones:**
- Recibe: `$_POST['b']`
- **`Tecnologia::filtrar($str_b)`** - Filtra tecnologías
- Muestra tabla completa con todos los campos: Id, Nombre, Abreviatura, Resumen, Definición, Orden, Activo, Logo, Color, Bkg Color
- Botones: Editar y Borrar

---

### 22. **usuarios_busqueda_cms.php**
**Descripción:** Genera tabla de resultados para búsqueda de usuarios.

**Funciones:**
- Recibe: `$_POST['b']`
- **`Usuario::filtrar($str_b, "buscar")`** - Filtra usuarios
- Muestra tabla con: Id, Nombre, Institución, Roles, Permisos, Email
- Botones: Editar y Borrar

---

### 23. **quees_busqueda_cms.php**
**Descripción:** Genera tabla de resultados para búsqueda de definiciones "¿Qué es?".

**Funciones:**
- Recibe: `$_POST['b']`
- **`Quees::filtrar($str_b)`** - Filtra definiciones
- Muestra tabla con: Id, Titulo, Contenido, Id-Top, Orden, Enlace, Activo
- Botones: Editar y Borrar

---

## Archivos de Visualización

### 24. **comodin_cms.php**
**Descripción:** Página principal para gestión de "comodines". Muestra interfaz de búsqueda y botón de alta.

**Funciones:**
- Inicializa clase `Comodin`
- Botón para ir al formulario de alta: `cargar('#Contenido','comodin_alta.php')`
- Input de búsqueda con ID: `txt_b_comodin`
- Botón de búsqueda con ID: `btn_b_comodin`
- Carga script: `bootstrap/comodin_f.js`

---

### 25. **historia_cms.php**
**Descripción:** Página principal para gestión de historias.

**Funciones:**
- Inicializa clase `Historia`
- Botón Alta: `cargar('#Contenido','historia_alta.php')`
- Input de búsqueda: `txt_b_historia`
- Botón de búsqueda: `btn_b_historia`
- Carga script: `bootstrap/historia_f.js`

---

### 26. **raiz_cms.php**
**Descripción:** Página principal para gestión de raíces.

**Funciones:**
- Inicializa clase `Raiz`
- Botón Alta: `cargar('#Contenido','raiz_alta.php')`
- Input de búsqueda: `txt_b_raiz`
- Botón de búsqueda: `btn_b_raiz`
- Carga script: `bootstrap/raiz_f.js`

---

### 27. **recursos_cms.php**
**Descripción:** Página principal para gestión de recursos.

**Funciones:**
- Inicializa clase `Recurso`
- Botón Alta: `cargar('#Contenido','recurso_alta.php')`
- Input de búsqueda: `txt_b_recurso`
- Botón de búsqueda: `btn_b_recurso`
- Carga script: `bootstrap/recurso_f.js`

---

### 28. **secciones_cms.php**
**Descripción:** Página principal para gestión de secciones.

**Funciones:**
- Inicializa clase `Seccion`
- Botón Alta: `cargar('#Contenido','seccion_alta.php')`
- Input de búsqueda (placeholder): "Buscar por nombre, id_tecnologia ó enlace"
- Botón de búsqueda: `btn_b_seccion`
- Carga script: `bootstrap/seccion_f.js`

---

### 29. **tecnologias_cms.php**
**Descripción:** Página principal para gestión de tópicos/tecnologías.

**Funciones:**
- Inicializa clase `Tecnologia`
- Botón Alta: `cargar('#Contenido','tecnologia_alta.php')`
- Input de búsqueda: `txt_b_tecnologia`
- Botón de búsqueda: `btn_b_tecnologia`
- Carga script: `bootstrap/tecnologia_f.js`

---

### 30. **usuarios_cms.php**
**Descripción:** Página principal para gestión de usuarios.

**Funciones:**
- Inicializa clase `Usuario`
- Botón Alta: `cargar('#Contenido','usuario_alta.php')`
- Input de búsqueda (placeholder): "Buscar por nombre, e-mail, institucion"
- Botón de búsqueda: `btn_b_usuario`
- Carga script: `bootstrap/usuario_f.js`

---

### 31. **quees_cms.php**
**Descripción:** Página principal para gestión de definiciones "¿Qué es?".

**Funciones:**
- Inicializa clase `Quees`
- Botón Alta: `cargar('#Contenido','quees_alta.php')`
- Input de búsqueda: `txt_b_quees`
- Botón de búsqueda: `btn_b_quees`
- Carga script: `bootstrap/quees_f.js`

---

## Archivos de Utilidad

### 32. **cms_p40.php**
**Descripción:** Página principal del CMS 4.0. Interface dinámica del panel de administración.

**Funciones:**
- **`session_start()`** - Inicia sesión
- Inicializa variables: `$n_cats=4`, `$n_seccs=9`
- Incluye clases `Seccion` y `Tecnologia`
- **`Tecnologia::buscar_todas()`** - Obtiene todas las tecnologías
- **`Seccion::enumerar()`** - Obtiene todas las secciones
- Genera dinámicamente elementos de menú
- Convierte arrays PHP a JSON para JavaScript: `json_encode($secciones)`, `json_encode($tecnos)`
- Carga scripts:
  - `bootstrap/cms.js`
  - `bootstrap/cms.css`
  - jQuery 3.7.1
  - Bootstrap 4.6.2
- Maneja eventos del menú: `poner_menu()`, `poner_submenu()`, `poner_tecnos()`

---

### 33. **subir_img.php**
**Descripción:** Procesa la carga de archivos de imagen.

**Funciones:**
- **Validación de archivo:**
  - Verifica si es imagen real con `getimagesize()`
  - Comprueba si ya existe con `file_exists()`
  - Valida tamaño máximo: 0.5 MB (524288 bytes)
  - Formatos permitidos: JPG, JPEG, PNG, GIF
- **Carga de archivo:**
  - **`move_uploaded_file()`** - Mueve archivo a directorio `../images/`
  - Crea directorio si no existe con `mkdir()`
- Muestra mensajes de error en alertas Bootstrap (alert-danger)
- Muestra mensajes de éxito en alertas Bootstrap (alert-success)

---

### 34. **query_ex.php**
**Descripción:** Herramienta ejecutor de consultas SQL MySQL (para propósitos de desarrollo/administración).

**Funciones:**
- Incluye conexión desde `../clases/conexion.php`
- **`$conn->query($query)`** - Ejecuta consulta SQL
- **`$result->fetch_fields()`** - Obtiene encabezados de columnas
- **`$result->fetch_assoc()`** - Obtiene filas de datos
- Muestra resultados en tabla HTML
- Maneja SELECT, INSERT, UPDATE, DELETE
- Muestra cantidad de filas afectadas
- Muestra errores de consulta
- Estilos CSS para tabla, errores (rojo) y éxito (verde)

---

### 35. **edit_cms.html**
**Descripción:** Herramienta auxiliar para insertar etiquetas HTML en textareas.

**Funciones:**
- **`insertarTextoEnCursor(div, etiq)`** - Inserta etiqueta HTML en la posición del cursor
  - Obtiene posición del cursor: `selectionStart`, `selectionEnd`
  - Reconstruye el texto: antes + etiqueta + después
  - Repositiciona el cursor tras la etiqueta insertada
- Botones para insertar:
  - `<br>` - Salto de línea
  - `<b>` y `</b>` - Negrita
  - `<li>` y `</li>` - Elemento de lista
  - `<h2>` y `</h2>` - Encabezado nivel 2

---

### 36. **___abm_seccion___.php** (mencionado antes, incluido)
Ya documentado en la sección de ABM.

---

### 37. **blanco.php**
**Descripción:** Archivo vacío. Probablemente utilizado como template o placeholder.

**Funciones:** Ninguna

---

### 38. **n.txt**
**Descripción:** Archivo de texto con un solo carácter.

**Funciones:** Ninguna identificable

---

## Directorios en /cms

- **`bootstrap/`** - Contiene archivos JavaScript y CSS del framework
- **`images/`** - Directorio para almacenar imágenes subidas
- **`tmp/`** - Directorio temporal

---

## Patrones Identificados

### Patrón ABM (Alta, Baja, Modificación)
La mayoría de entidades (Tecnología, Historia, Recurso, Sección, Usuario, Quees) siguen este patrón:
1. `*_alta.php` - Formulario para crear
2. `*_edit.php` - Procesa CREATE, READ, UPDATE, DELETE
3. `*_busqueda_cms.php` - Muestra resultados de búsqueda
4. `*_cms.php` - Panel de control/gestión

### Clases utilizadas (en ../clases/):
- `Tecnologia` - Gestión de tópicos
- `Seccion` - Gestión de secciones
- `Historia` - Gestión de historias
- `Recurso` - Gestión de recursos
- `Quees` - Gestión de definiciones
- `Usuario` - Gestión de usuarios
- `Comodin` - Gestión de comodines
- `Raiz` - Gestión de raíces/categorías
- `Conexion` - Conexión a base de datos

### Métodos comunes en las clases:
- `guardar()` - Inserta nuevo registro
- `actualizar($id)` - Actualiza registro existente
- `borrar($id)` - Elimina registro
- `traer_datos($id)` - Obtiene datos de un registro
- `filtrar($busqueda)` - Busca registros
- `seleccionar()` / `buscar_todas()` / `enumerar()` - Obtiene lista de registros

---

## Flujo General de Operaciones

1. **Visualización**: Usuario accede a `*_cms.php` (ej: `tecnologia_cms.php`)
2. **Alta**: Clic en botón "Alta" → Carga `*_alta.php` en AJAX
3. **Formulario**: Usuario completa datos en `*_alta.php`
4. **Procesamiento**: Form envía a `*_edit.php` con `operacion=agregar`
5. **Búsqueda**: Usuario ingresa término → JavaScript envía AJAX a `*_busqueda_cms.php`
6. **Edición/Eliminación**: Clic en botón Editar/Borrar → Datos se procesan en `*_edit.php`
7. **Redirección**: Tras operación, redirecciona a página anterior



Si quieres, puedo:
- Generar un archivo DOCUMENTACION.md listo para añadir al repo con este contenido.
- Hacer una lista más detallada de rutas y parámetros de cada formulario (si deseas que inspeccione archivos específicos como `procesar_login.php`, `clases/conexion.php` o `js/main.js`).
