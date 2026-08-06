<?php
session_start();
include_once __DIR__ . '/clases/foro.php';

$usuarioActual = $_SESSION['user']['id'] ?? $_SESSION['id_usuario'] ?? $_SESSION['id'] ?? null;
$logueado = !empty($usuarioActual);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === 'crear_tema' && $logueado) {
        $titulo = trim((string) ($_POST['titulo'] ?? ''));
        $contenido = trim((string) ($_POST['contenido'] ?? ''));

        if ($titulo !== '' && $contenido !== '') {
            ForoTema::crearTema((int) $usuarioActual, $titulo, $contenido);
        }
        header('Location: foro.php');
        exit;
    }

    if (isset($_POST['accion']) && $_POST['accion'] === 'crear_respuesta' && $logueado) {
        $idTema = isset($_POST['id_tema']) ? (int) $_POST['id_tema'] : 0;
        $contenido = trim((string) ($_POST['contenido'] ?? ''));

        if ($idTema > 0 && $contenido !== '') {
            ForoRespuesta::crearRespuesta($idTema, (int) $usuarioActual, $contenido);
        }
        header('Location: foro.php');
        exit;
    }
}

$temas = ForoTema::listarTemas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Foro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
</head>
<body>
  <div class="container foro-container">
    <div class="foro-header">
      <h3>Foro de la comunidad</h3>
      <a href="index.php" onclick="if(typeof cargar==='function'){cargar('#Contenido','index.php'); return false;} else { window.location.href='index.php'; }">Volver</a>
    </div>

    <?php if (!$logueado): ?>
      <div class="foro-status">Debes iniciar sesión para publicar temas o responder.</div>
    <?php else: ?>
      <form method="POST" action="foro.php" class="foro-form">
        <input type="hidden" name="accion" value="crear_tema">
        <div class="mb-3">
          <label for="titulo">Título del tema</label>
          <input type="text" id="titulo" name="titulo" maxlength="150" required>
        </div>
        <div class="mb-3">
          <label for="contenido_tema">Mensaje</label>
          <textarea id="contenido_tema" name="contenido" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Crear tema</button>
      </form>
    <?php endif; ?>

    <div class="foro-list">
      <?php if (empty($temas)): ?>
        <div class="foro-empty">Todavía no hay temas publicados.</div>
      <?php else: ?>
        <?php foreach ($temas as $tema): ?>
          <?php
          $idTema = (int) ($tema['id_tema'] ?? 0);
          $tituloTema = $tema['titulo'] ?? 'Tema sin título';
          $contenidoTema = $tema['contenido'] ?? '';
          $autorTema = $tema['nombre_usuario'] ?? 'Usuario';
          $fechaTema = $tema['creado_en'] ?? '';
          $totalRespuestas = (int) ($tema['total_respuestas'] ?? 0);
          $ultimaRespuesta = $tema['ultima_respuesta'] ?? null;
          $respuestas = ForoRespuesta::listarPorTema($idTema);
          ?>
          <div class="foro-topic">
            <div class="foro-topic-header">
              <div>
                <h4><?php echo htmlspecialchars($tituloTema, ENT_QUOTES, 'UTF-8'); ?></h4>
                <div class="foro-meta"><?php echo htmlspecialchars($autorTema, ENT_QUOTES, 'UTF-8'); ?> · <?php echo htmlspecialchars($fechaTema, ENT_QUOTES, 'UTF-8'); ?></div>
              </div>
              <div class="foro-badge"><?php echo $totalRespuestas; ?> respuesta(s)</div>
            </div>
            <div class="foro-content"><?php echo nl2br(htmlspecialchars($contenidoTema, ENT_QUOTES, 'UTF-8')); ?></div>
            <?php if ($ultimaRespuesta): ?>
              <div class="foro-last-reply">Última respuesta: <?php echo htmlspecialchars($ultimaRespuesta, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>

            <div class="foro-respuestas">
              <?php if (!empty($respuestas)): ?>
                <?php foreach ($respuestas as $respuesta): ?>
                  <?php
                  $autorRespuesta = $respuesta['nombre_usuario'] ?? 'Usuario';
                  $fechaRespuesta = $respuesta['creado_en'] ?? '';
                  $contenidoRespuesta = $respuesta['contenido'] ?? '';
                  ?>
                  <div class="foro-reply">
                    <div class="foro-meta"><?php echo htmlspecialchars($autorRespuesta, ENT_QUOTES, 'UTF-8'); ?> · <?php echo htmlspecialchars($fechaRespuesta, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div><?php echo nl2br(htmlspecialchars($contenidoRespuesta, ENT_QUOTES, 'UTF-8')); ?></div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div class="foro-empty small">Aún no hay respuestas en este tema.</div>
              <?php endif; ?>
            </div>

            <?php if ($logueado): ?>
              <form method="POST" action="foro.php" class="foro-reply-form">
                <input type="hidden" name="accion" value="crear_respuesta">
                <input type="hidden" name="id_tema" value="<?php echo $idTema; ?>">
                <textarea name="contenido" rows="3" placeholder="Escribí tu respuesta..." required></textarea>
                <button type="submit" class="btn btn-secondary">Responder</button>
              </form>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
