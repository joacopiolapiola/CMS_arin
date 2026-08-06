<?php
session_start();
include_once __DIR__ . '/clases/chat.php';
include_once __DIR__ . '/clases/usuarios.php';

$mensaje = trim((string) ($_POST['mensaje'] ?? ''));
$respuestaA = isset($_POST['respuesta_a']) ? (int) $_POST['respuesta_a'] : null;
$usuarioActual = $_SESSION['user']['id'] ?? $_SESSION['id_usuario'] ?? $_SESSION['id'] ?? null;
$fechaDesde = isset($_GET['fecha_desde']) ? trim((string) $_GET['fecha_desde']) : '';
$fechaHasta = isset($_GET['fecha_hasta']) ? trim((string) $_GET['fecha_hasta']) : '';
$usuarioFiltro = isset($_GET['usuario']) ? (int) $_GET['usuario'] : 0;

if ($fechaDesde === '' && $fechaHasta === '') {
    $fechaDesde = date('Y-m-d');
    $fechaHasta = date('Y-m-d');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $mensaje !== '' && $usuarioActual) {
    ChatMensaje::crear($usuarioActual, $mensaje, $respuestaA);
    header('Location: chat.php');
    exit;
}

if ($fechaDesde !== '' && $fechaHasta !== '' && $fechaDesde > $fechaHasta) {
    $tmpFecha = $fechaDesde;
    $fechaDesde = $fechaHasta;
    $fechaHasta = $tmpFecha;
}

$usuariosChat = Usuario::listar();
$mensajes = ChatMensaje::listar(
    $fechaDesde !== '' ? $fechaDesde : null,
    $fechaHasta !== '' ? $fechaHasta : null,
    $usuarioFiltro > 0 ? $usuarioFiltro : null
);
$hilos = ChatMensaje::armarHilos($mensajes);
$logueado = !empty($usuarioActual);

// Debug: volcar mensajes/hilos a archivo para inspección (temporal)
$debugDir = __DIR__ . '/tmp';
if (!is_dir($debugDir)) {
  @mkdir($debugDir, 0755, true);
}
@file_put_contents($debugDir . '/chat_debug.json', json_encode(['mensajes' => $mensajes, 'hilos' => $hilos], JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat general</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <style>
    body {
      background: #f4f7fb;
    }
    .chat-container {
      max-width: 980px;
      margin: 2rem auto;
      padding: 1.25rem;
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
    }
    .chat-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.25rem;
      padding-bottom: 0.75rem;
      border-bottom: 1px solid #e5e7eb;
    }
    .chat-form {
      background: #f8fafc;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      padding: 1rem;
      margin-bottom: 1rem;
    }
    .chat-form textarea {
      width: 100%;
      min-height: 90px;
      border: 1px solid #d1d5db;
      border-radius: 10px;
      padding: 0.75rem;
      resize: vertical;
    }
    .chat-form .btn,
    .chat-actions a {
      border-radius: 10px;
    }
    .chat-list {
      display: grid;
      gap: 1rem;
    }
    .chat-message {
      background: #f8fafc;
      border: 1px solid #e5e7eb;
      border-left: 4px solid #2563eb;
      border-radius: 12px;
      padding: 0.9rem 1rem;
    }
    .chat-message.reply {
      margin-left: 1.5rem;
      background: #eef5ff;
      border-left-color: #10b981;
    }
    .chat-meta {
      font-size: 0.82rem;
      color: #475569;
      margin-bottom: 0.5rem;
      font-weight: 600;
    }
    .chat-status,
    .chat-empty {
      padding: 0.9rem 1rem;
      border-radius: 10px;
      background: #eff6ff;
      border: 1px solid #bfdbfe;
      color: #1e3a8a;
      margin-bottom: 1rem;
    }
    .chat-actions {
      margin-top: 0.75rem;
    }
    @media (max-width: 768px) {
      .chat-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.6rem;
      }
      .chat-message.reply {
        margin-left: 0.75rem;
      }
    }
  </style>
</head>
<body>
  <style>
    /* Ensure message body is visible when chat.php is loaded via AJAX into CMS (uses cms vars if present) */
    .chat-message .message-body { color: var(--cms-text, #111827); white-space: pre-wrap; }
  </style>
  <div class="container chat-container">
    <div class="chat-header">
      <h3>Chat general</h3>
      <a href="index.php" onclick="if(typeof cargar==='function'){cargar('#Contenido','index.php'); return false;} else { window.location.href='index.php'; }">Volver</a>
    </div>

    <form method="GET" action="chat.php" class="chat-form" style="margin-bottom: 1rem;">
      <div class="row g-2 align-items-end">
        <div class="col-md-3">
          <label for="fecha_desde">Desde</label>
          <input type="date" id="fecha_desde" name="fecha_desde" class="form-control" value="<?php echo htmlspecialchars($fechaDesde, ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <div class="col-md-3">
          <label for="fecha_hasta">Hasta</label>
          <input type="date" id="fecha_hasta" name="fecha_hasta" class="form-control" value="<?php echo htmlspecialchars($fechaHasta, ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <div class="col-md-4">
          <label for="usuario">Usuario</label>
          <select id="usuario" name="usuario" class="form-control">
            <option value="0">Todos los usuarios</option>
            <?php foreach ($usuariosChat as $usuario): ?>
              <?php $idUsuarioItem = (int) ($usuario['ID_usuario'] ?? $usuario['id_usuario'] ?? 0); ?>
              <?php $nombreUsuarioItem = $usuario['nombre'] ?? 'Usuario'; ?>
              <option value="<?php echo $idUsuarioItem; ?>" <?php echo $usuarioFiltro === $idUsuarioItem ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($nombreUsuarioItem, ENT_QUOTES, 'UTF-8'); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary w-100">Ver historial</button>
        </div>
      </div>
    </form>

    <?php if (!$logueado): ?>
      <div class="chat-status">Debes iniciar sesión para participar del chat.</div>
    <?php else: ?>
      <form method="POST" action="chat.php" class="chat-form">
        <textarea name="mensaje" placeholder="Escribí tu mensaje..." required></textarea>
        <button type="submit" class="btn btn-primary mt-3">Enviar mensaje</button>
      </form>
    <?php endif; ?>

    <div class="chat-list">
      <?php if (empty($hilos)): ?>
        <div class="chat-empty">No hay mensajes para el filtro actual. Probá cambiar la fecha o elegir otro usuario.</div>
      <?php else: ?>
        <?php foreach ($hilos as $mensaje): ?>
          <?php
          $id = (int) ($mensaje['id'] ?? 0);
          $emisor = $mensaje['nombre_usuario'] ?? 'Usuario';
          $fecha = $mensaje['creado_en'] ?? '';
          $texto = $mensaje['mensaje'] ?? '';
          $respuestas = $mensaje['respuestas'] ?? [];
          ?>
          <div class="chat-message">
            <div class="chat-meta"><?php echo htmlspecialchars($emisor, ENT_QUOTES, 'UTF-8'); ?> · <?php echo htmlspecialchars($fecha, ENT_QUOTES, 'UTF-8'); ?></div>
            <div class="message-body"><?php echo nl2br(htmlspecialchars($texto, ENT_QUOTES, 'UTF-8')); ?></div>
            <?php if ($logueado): ?>
              <div class="chat-actions">
                <a class="btn btn-sm btn-outline-primary" href="#" onclick="if(typeof cargar==='function'){cargar('#Contenido','chat.php?respuesta=<?php echo $id; ?>'); return false;} else { window.location.href='chat.php?respuesta=<?php echo $id; ?>#form-responder-<?php echo $id; ?>'; }">Responder</a>
              </div>
            <?php endif; ?>

            <?php foreach ($respuestas as $respuesta): ?>
              <?php
              $respEmisor = $respuesta['nombre_usuario'] ?? 'Usuario';
              $respFecha = $respuesta['creado_en'] ?? '';
              $respTexto = $respuesta['mensaje'] ?? '';
              // Debug: si el texto de la respuesta viene vacío, mostrar estructura para diagnóstico
              if ($respTexto === '') {
                echo '<pre style="color:darkred; font-size:12px;">DEBUG-RESP: ' . htmlspecialchars(json_encode($respuesta, JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8') . '</pre>';
              }
              ?>
              <div class="chat-message reply">
                <div class="chat-meta"><?php echo htmlspecialchars($respEmisor, ENT_QUOTES, 'UTF-8'); ?> · <?php echo htmlspecialchars($respFecha, ENT_QUOTES, 'UTF-8'); ?></div>
                <div class="message-body"><?php echo nl2br(htmlspecialchars($respTexto, ENT_QUOTES, 'UTF-8')); ?></div>
              </div>
            <?php endforeach; ?>

            <?php if ($logueado && isset($_GET['respuesta']) && (int) $_GET['respuesta'] === $id): ?>
              <form method="POST" action="chat.php" id="form-responder-<?php echo $id; ?>" class="chat-form">
                <input type="hidden" name="respuesta_a" value="<?php echo $id; ?>">
                <textarea name="mensaje" placeholder="Responder al mensaje..." required></textarea>
                <button type="submit" class="btn btn-primary mt-3">Responder</button>
              </form>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
