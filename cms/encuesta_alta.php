<?php
require_once __DIR__ . '/_cms_guard.php';
include_once '../clases/encuestas.php';
?>

<div class="container mt-3">
  <h4>Nueva encuesta</h4>

  <form method="POST" action="encuesta_edit.php?operacion=agregar">
    <div class="mb-3">
      <label for="txtPregunta" class="form-label">Pregunta</label>
      <textarea id="txtPregunta" name="txtPregunta" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label for="txtDescripcion" class="form-label">Descripción</label>
      <textarea id="txtDescripcion" name="txtDescripcion" class="form-control" rows="2"></textarea>
    </div>

    <div class="row g-3">
      <div class="col-md-4">
        <label for="txtTema" class="form-label">Tema / Tecnología</label>
        <input id="txtTema" name="txtTema" type="number" min="0" value="0" class="form-control">
      </div>
      <div class="col-md-4">
        <label for="txtActivo" class="form-label">Estado</label>
        <select id="txtActivo" name="txtActivo" class="form-select">
          <option value="1" selected>Activa</option>
          <option value="0">Inactiva</option>
        </select>
      </div>
    </div>

    <div class="mb-3 mt-3">
      <label for="txtOpciones" class="form-label">Opciones (una por línea)</label>
      <textarea id="txtOpciones" name="txtOpciones" class="form-control" rows="8" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Guardar encuesta</button>
  </form>
</div>
