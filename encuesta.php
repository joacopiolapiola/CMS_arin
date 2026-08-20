<?php
session_start();
require_once __DIR__ . '/clases/encuestas.php';

$userId = $_SESSION['user']['id'] ?? $_SESSION['id_usuario'] ?? $_SESSION['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEncuesta = isset($_POST['id_encuesta']) ? (int) $_POST['id_encuesta'] : 0;
    $idOpcion = isset($_POST['id_opcion']) ? (int) $_POST['id_opcion'] : 0;

    if ($idEncuesta > 0 && $idOpcion > 0 && $userId) {
        EncuestaRespuesta::votar($idEncuesta, (int) $userId, $idOpcion);
    }

    $redirectId = $idEncuesta > 0 ? '?id=' . $idEncuesta : '';
    header('Location: encuesta.php' . $redirectId);
    exit;
}

$idTecnologiaFiltro = isset($_GET['tema']) ? (int) $_GET['tema'] : 0;
$encuestas = Encuesta::listarActivas($idTecnologiaFiltro);
$idSeleccionado = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($idSeleccionado <= 0 && !empty($encuestas)) {
    $idSeleccionado = (int) ($encuestas[0]['id_encuesta'] ?? 0);
}

$encuestaActual = $idSeleccionado > 0 ? Encuesta::traerPorId($idSeleccionado) : null;
$opciones = $encuestaActual ? Encuesta::opciones((int) $encuestaActual['id_encuesta']) : [];
$resultados = $encuestaActual ? Encuesta::resultados((int) $encuestaActual['id_encuesta']) : [];
$yaVoto = $encuestaActual && $userId ? EncuestaRespuesta::usuarioYaRespondio((int) $encuestaActual['id_encuesta'], (int) $userId) : false;
$hayEncuestas = !empty($encuestas);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Encuestas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
</head>
<body>
  <script>
    (function () {
      const key = 'site_theme';
      let savedTheme = null;
      try { savedTheme = window.localStorage.getItem(key); } catch (error) {}
      const mediaQuery = typeof window.matchMedia === 'function'
        ? window.matchMedia('(prefers-color-scheme: dark)')
        : null;
      const shouldDark = savedTheme ? savedTheme === 'dark' : Boolean(mediaQuery && mediaQuery.matches);
      document.body.setAttribute('data-theme', shouldDark ? 'dark' : 'light');
    })();
  </script>
  <div class="container encuesta-container">
    <div class="encuesta-header">
      <h3>Encuestas</h3>
      <a href="index.php" onclick="window.location.href='index.php'; return false;">Volver</a>
    </div>

    <form method="GET" class="row g-2 align-items-end mb-3">
      <div class="col-md-4">
        <label for="tema" class="form-label">Filtrar por tema</label>
        <input type="number" id="tema" name="tema" min="0" value="<?php echo htmlspecialchars((string) $idTecnologiaFiltro, ENT_QUOTES, 'UTF-8'); ?>" class="form-control" placeholder="0 = todas">
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary">Filtrar</button>
      </div>
    </form>

    <?php if (!$hayEncuestas): ?>
      <div class="alert alert-info">No hay encuestas activas por el momento.</div>
    <?php else: ?>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="list-group">
            <?php foreach ($encuestas as $encuesta): ?>
              <?php $idEnc = (int) ($encuesta['id_encuesta'] ?? 0); ?>
              <a href="encuesta.php?id=<?php echo $idEnc; ?>" class="list-group-item list-group-item-action <?php echo $idEnc === $idSeleccionado ? 'active' : ''; ?>">
                <?php echo htmlspecialchars($encuesta['pregunta'] ?? 'Encuesta', ENT_QUOTES, 'UTF-8'); ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="col-md-8">
          <?php if (!$encuestaActual): ?>
            <div class="alert alert-warning">No se encontró la encuesta seleccionada.</div>
          <?php else: ?>
            <div class="encuesta-card">
              <h4><?php echo htmlspecialchars($encuestaActual['pregunta'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h4>
              <?php if (!empty($encuestaActual['descripcion'])): ?>
                <p class="text-muted"><?php echo nl2br(htmlspecialchars($encuestaActual['descripcion'], ENT_QUOTES, 'UTF-8')); ?></p>
              <?php endif; ?>

              <?php if (!$userId): ?>
                <div class="alert alert-warning">Debes iniciar sesión para poder responder la encuesta.</div>
              <?php elseif ($yaVoto): ?>
                <div class="alert alert-success">Ya respondiste esta encuesta. Aquí podés ver el resultado.</div>
              <?php else: ?>
                <form method="POST" action="encuesta.php?id=<?php echo $idSeleccionado; ?>">
                  <input type="hidden" name="id_encuesta" value="<?php echo $idSeleccionado; ?>">
                  <?php foreach ($opciones as $opcion): ?>
                    <?php $idOpcion = (int) ($opcion['id_opcion'] ?? 0); ?>
                    <div class="form-check encuesta-option">
                      <input class="form-check-input" type="radio" name="id_opcion" id="opt_<?php echo $idOpcion; ?>" value="<?php echo $idOpcion; ?>" required>
                      <label class="form-check-label" for="opt_<?php echo $idOpcion; ?>"><?php echo htmlspecialchars($opcion['texto'] ?? '', ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                  <?php endforeach; ?>

                  <button type="submit" class="btn btn-primary mt-3">Enviar respuesta</button>
                </form>
              <?php endif; ?>

              <hr>

              <h5>Resultados</h5>
              <?php if (empty($resultados)): ?>
                <p class="text-muted">Todavía no hay votos para esta encuesta.</p>
              <?php else: ?>
                <?php $totalVotos = 0; foreach ($resultados as $resultado) { $totalVotos += (int) ($resultado['votos'] ?? 0); } ?>
                <?php foreach ($resultados as $resultado): ?>
                  <?php $votos = (int) ($resultado['votos'] ?? 0); $porcentaje = $totalVotos > 0 ? round(($votos / $totalVotos) * 100, 1) : 0; ?>
                  <div class="mb-3">
                    <div class="d-flex justify-content-between">
                      <span><?php echo htmlspecialchars($resultado['texto'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
                      <strong><?php echo $votos; ?> votos</strong>
                    </div>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: <?php echo $porcentaje; ?>%;" aria-valuenow="<?php echo $porcentaje; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $porcentaje; ?>%</div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
