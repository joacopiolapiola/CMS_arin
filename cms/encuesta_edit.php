<?php
require_once __DIR__ . '/_cms_guard.php';
include_once '../clases/encuestas.php';

$mensaje = '';
$modo = $_GET['operacion'] ?? 'agregar';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pregunta = trim((string) ($_POST['txtPregunta'] ?? ''));
    $descripcion = trim((string) ($_POST['txtDescripcion'] ?? ''));
    $idTecnologia = (int) ($_POST['txtTema'] ?? 0);
    $activo = isset($_POST['txtActivo']) ? ((int) $_POST['txtActivo'] === 1 ? 1 : 0) : 1;
    $lineas = preg_split('/\r\n|\n|\r/', (string) ($_POST['txtOpciones'] ?? ''));
    $opciones = [];

    foreach ($lineas as $linea) {
        $texto = trim((string) $linea);
        if ($texto !== '') {
            $opciones[] = $texto;
        }
    }

    if ($pregunta !== '' && !empty($opciones)) {
        $idEncuesta = Encuesta::crear($pregunta, $descripcion, $idTecnologia, $activo);
        if ($idEncuesta) {
            EncuestaOpcion::guardar($idEncuesta, $opciones);
            $mensaje = 'Encuesta creada correctamente.';
        } else {
            $mensaje = 'No se pudo crear la encuesta.';
        }
    } else {
        $mensaje = 'La encuesta y sus opciones son obligatorias.';
    }
}

if ($modo === 'baja' && isset($_GET['id_encuesta'])) {
    $id = (int) $_GET['id_encuesta'];
    Encuesta::borrar($id);
    header('Location: encuestas_cms.php');
    exit;
}

if ($modo === 'edicion' && isset($_GET['id_encuesta'])) {
    $encuesta = Encuesta::traerPorId((int) $_GET['id_encuesta']);
    if (!$encuesta) {
        header('Location: encuestas_cms.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_encuesta'])) {
        $id = (int) $_POST['id_encuesta'];
        $pregunta = trim((string) ($_POST['txtPregunta'] ?? ''));
        $descripcion = trim((string) ($_POST['txtDescripcion'] ?? ''));
        $idTecnologia = (int) ($_POST['txtTema'] ?? 0);
        $activo = isset($_POST['txtActivo']) ? ((int) $_POST['txtActivo'] === 1 ? 1 : 0) : 1;
        $lineas = preg_split('/\r\n|\n|\r/', (string) ($_POST['txtOpciones'] ?? ''));
        $opciones = [];

        foreach ($lineas as $linea) {
            $texto = trim((string) $linea);
            if ($texto !== '') {
                $opciones[] = $texto;
            }
        }

        if ($pregunta !== '' && !empty($opciones)) {
            Encuesta::actualizar($id, $pregunta, $descripcion, $idTecnologia, $activo);
            EncuestaOpcion::reemplazar($id, $opciones);
            header('Location: encuestas_cms.php');
            exit;
        }
    }

    $opciones = Encuesta::opciones((int) $_GET['id_encuesta']);
    $optionsText = implode("\n", array_map(static function ($opcion) {
        return $opcion['texto'] ?? '';
    }, $opciones));

    echo '<div class="container mt-3">';
    echo '<h4>Editar encuesta</h4>';
    echo '<form method="POST">';
    echo '<input type="hidden" name="id_encuesta" value="' . (int) $_GET['id_encuesta'] . '">';
    echo '<div class="mb-3"><label class="form-label">Pregunta</label><textarea class="form-control" rows="3" name="txtPregunta" required>' . htmlspecialchars($encuesta['pregunta'] ?? '', ENT_QUOTES, 'UTF-8') . '</textarea></div>';
    echo '<div class="mb-3"><label class="form-label">Descripción</label><textarea class="form-control" rows="2" name="txtDescripcion">' . htmlspecialchars($encuesta['descripcion'] ?? '', ENT_QUOTES, 'UTF-8') . '</textarea></div>';
    echo '<div class="row g-3"><div class="col-md-4"><label class="form-label">Tema / Tecnología</label><input type="number" min="0" class="form-control" name="txtTema" value="' . (int) ($encuesta['id_tecnologia'] ?? 0) . '"></div><div class="col-md-4"><label class="form-label">Estado</label><select class="form-select" name="txtActivo"><option value="1" ' . (((int) ($encuesta['activo'] ?? 1)) === 1 ? 'selected' : '') . '>Activa</option><option value="0" ' . (((int) ($encuesta['activo'] ?? 1)) === 0 ? 'selected' : '') . '>Inactiva</option></select></div></div>';
    echo '<div class="mb-3 mt-3"><label class="form-label">Opciones (una por línea)</label><textarea class="form-control" rows="8" name="txtOpciones" required>' . htmlspecialchars($optionsText, ENT_QUOTES, 'UTF-8') . '</textarea></div>';
    echo '<button type="submit" class="btn btn-primary">Actualizar encuesta</button>';
    echo '</form>';
    echo '</div>';
    return;
}

if ($mensaje !== '') {
    echo '<div class="container mt-3"><div class="alert alert-info">' . htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') . '</div></div>';
}

header('Location: encuestas_cms.php');
exit;
