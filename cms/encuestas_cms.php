<?php
require_once __DIR__ . '/_cms_guard.php';
include_once '../clases/encuestas.php';

$encuestas = Encuesta::listar();
?>

<div class="container mt-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Encuestas</h4>
    <button type="button" class="btn btn-primary" onclick="cargar('#Contenido', 'encuesta_alta.php')">Nueva encuesta</button>
  </div>

  <?php if (empty($encuestas)): ?>
    <div class="alert alert-info">Todavía no hay encuestas creadas.</div>
  <?php else: ?>
    <div class="list-group">
      <?php foreach ($encuestas as $encuesta): ?>
        <?php
          $idEncuesta = (int) ($encuesta['id_encuesta'] ?? 0);
          $pregunta = $encuesta['pregunta'] ?? 'Encuesta sin pregunta';
          $activo = (int) ($encuesta['activo'] ?? 1);
          $total = (int) ($encuesta['total_votos'] ?? 0);
        ?>
        <div class="list-group-item">
          <div class="d-flex justify-content-between align-items-start gap-3">
            <div>
              <strong><?php echo htmlspecialchars($pregunta, ENT_QUOTES, 'UTF-8'); ?></strong>
              <div class="small text-muted">Estado: <?php echo $activo ? 'Activa' : 'Inactiva'; ?> · Votos: <?php echo $total; ?></div>
            </div>
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-outline-secondary" onclick="cargar('#Contenido', 'encuesta_edit.php?operacion=edicion&id_encuesta=<?php echo $idEncuesta; ?>')">Editar</button>
              <button type="button" class="btn btn-sm btn-outline-danger" onclick="if(confirm('¿Eliminar esta encuesta?')) { cargar('#Contenido', 'encuesta_edit.php?operacion=baja&id_encuesta=<?php echo $idEncuesta; ?>'); }">Eliminar</button>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
