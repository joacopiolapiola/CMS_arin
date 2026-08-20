<?php
require_once __DIR__ . '/_cms_guard.php';

$tipo = strtolower(trim((string) ($_GET['tipo'] ?? '')));
$id = (int) ($_GET['id'] ?? 0);

$origenes = [
    'raiz' => ['archivo' => '../clases/raiz.php', 'clase' => 'Raiz', 'metodo' => 'traer_datos'],
    'tecnologia' => ['archivo' => '../clases/tecnologias.php', 'clase' => 'Tecnologia', 'metodo' => 'traer_datos'],
    'seccion' => ['archivo' => '../clases/secciones.php', 'clase' => 'Seccion', 'metodo' => 'traer_datos'],
    'usuario' => ['archivo' => '../clases/usuarios.php', 'clase' => 'Usuario', 'metodo' => 'traer_datos'],
    'historia' => ['archivo' => '../clases/historia.php', 'clase' => 'Historia', 'metodo' => 'traer_datos'],
    'quees' => ['archivo' => '../clases/quees.php', 'clase' => 'Quees', 'metodo' => 'traer_datos'],
    'recurso' => ['archivo' => '../clases/recursos.php', 'clase' => 'Recurso', 'metodo' => 'traer_datos'],
    'comodin' => ['archivo' => '../clases/comodin.php', 'clase' => 'Comodin', 'metodo' => 'traer_datos'],
];

if ($tipo === 'encuesta') {
    require_once __DIR__ . '/../clases/encuestas.php';
    $registro = Encuesta::traerPorId($id);
    if ($registro) {
        $registro['opciones'] = implode("\n", array_column(Encuesta::opciones($id), 'texto'));
    }
} elseif (isset($origenes[$tipo])) {
    $origen = $origenes[$tipo];
    require_once __DIR__ . '/' . $origen['archivo'];
    $registro = call_user_func([$origen['clase'], $origen['metodo']], $id);
} else {
    http_response_code(404);
    exit('Registro no encontrado.');
}

if (!$registro) {
    echo '<div class="alert alert-warning m-3">Registro no encontrado.</div>';
    exit;
}

$ocultos = ['password'];
?>
<div class="container mt-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Ver registro</h4>
    <button type="button" class="btn btn-outline-secondary" onclick="cargar('#Contenido', 'blanco.php')">Volver</button>
  </div>
  <dl class="row">
    <?php foreach ($registro as $campo => $valor): ?>
      <?php if (!in_array(strtolower((string) $campo), $ocultos, true)): ?>
        <dt class="col-sm-3 text-break"><?php echo htmlspecialchars((string) $campo, ENT_QUOTES, 'UTF-8'); ?></dt>
        <dd class="col-sm-9"><pre class="mb-3 text-wrap"><?php echo htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8'); ?></pre></dd>
      <?php endif; ?>
    <?php endforeach; ?>
  </dl>
</div>
