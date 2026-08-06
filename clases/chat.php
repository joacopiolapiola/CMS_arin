<?php
include_once __DIR__ . '/conexion.php';

class ChatMensaje
{
    private static function asegurarTabla(): void
    {
        $conn = new Conexion();
        $sql = "CREATE TABLE IF NOT EXISTS chat_mensajes (
            id INT NOT NULL AUTO_INCREMENT,
            id_usuario INT NOT NULL,
            id_respuesta_a INT NULL DEFAULT NULL,
            mensaje TEXT NOT NULL,
            creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            activo TINYINT(1) NOT NULL DEFAULT 1,
            PRIMARY KEY (id),
            KEY idx_chat_usuario (id_usuario),
            KEY idx_chat_respuesta (id_respuesta_a),
            CONSTRAINT fk_chat_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(ID_usuario) ON DELETE CASCADE,
            CONSTRAINT fk_chat_respuesta FOREIGN KEY (id_respuesta_a) REFERENCES chat_mensajes(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

        $conn->enlace->query($sql);
    }

    private static function normalizarFila($fila): array
    {
        if (!is_array($fila)) {
            return [];
        }

        $resultado = [];
        foreach ($fila as $clave => $valor) {
            $resultado[$clave] = $valor;
            $resultado[strtolower((string) $clave)] = $valor;
        }

        return $resultado;
    }

    public static function crear($idUsuario, $mensaje, $idRespuestaA = null): bool
    {
        self::asegurarTabla();
        $idUsuario = (int) $idUsuario;
        $mensaje = trim((string) $mensaje);

        if ($idUsuario <= 0 || $mensaje === '') {
            return false;
        }

        $respuestaA = $idRespuestaA !== null ? (int) $idRespuestaA : null;
        if ($respuestaA !== null && $respuestaA <= 0) {
            return false;
        }

        $conn = new Conexion();

        if ($respuestaA === null) {
            $sql = 'INSERT INTO chat_mensajes (id_usuario, mensaje, creado_en, activo) VALUES (?, ?, NOW(), 1)';
            $stmt = $conn->enlace->prepare($sql);
            if (!$stmt) {
                return false;
            }

            $stmt->bind_param('is', $idUsuario, $mensaje);
            return $stmt->execute();
        }

        $sql = 'INSERT INTO chat_mensajes (id_usuario, id_respuesta_a, mensaje, creado_en, activo) VALUES (?, ?, ?, NOW(), 1)';
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('iis', $idUsuario, $respuestaA, $mensaje);
        return $stmt->execute();
    }

    public static function listar(?string $fechaDesde = null, ?string $fechaHasta = null, ?int $idUsuario = null): array
    {
        self::asegurarTabla();

        $sql = 'SELECT c.id, c.id_usuario, c.id_respuesta_a, c.mensaje, c.creado_en,
                       u.nombre AS nombre_usuario,
                       u.email AS email_usuario,
                       p.mensaje AS mensaje_padre
                FROM chat_mensajes c
                LEFT JOIN usuarios u ON u.ID_usuario = c.id_usuario
                LEFT JOIN chat_mensajes p ON p.id = c.id_respuesta_a
                WHERE c.activo = 1';

        $condiciones = [];
        $tipos = '';
        $params = [];

        if ($fechaDesde !== null && $fechaDesde !== '') {
            $condiciones[] = 'DATE(c.creado_en) >= ?';
            $tipos .= 's';
            $params[] = $fechaDesde;
        }

        if ($fechaHasta !== null && $fechaHasta !== '') {
            $condiciones[] = 'DATE(c.creado_en) <= ?';
            $tipos .= 's';
            $params[] = $fechaHasta;
        }

        if ($idUsuario !== null && (int) $idUsuario > 0) {
            $condiciones[] = 'c.id_usuario = ?';
            $tipos .= 'i';
            $params[] = (int) $idUsuario;
        }

        if (!empty($condiciones)) {
            $sql .= ' AND ' . implode(' AND ', $condiciones);
        }

        $sql .= ' ORDER BY c.id_respuesta_a IS NULL DESC, c.creado_en DESC';

        $conn = new Conexion();
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }

        if (!empty($params)) {
            $stmt->bind_param($tipos, ...$params);
        }

        $stmt->execute();
        $resultado = $stmt->get_result();
        $mensajes = [];

        while ($fila = $resultado->fetch_assoc()) {
            $mensajes[] = self::normalizarFila($fila);
        }

        return $mensajes;
    }

    public static function armarHilos(array $mensajes): array
    {
        // Primero construir un mapa por id con el campo 'respuestas' vacío
        $mapa = [];
        foreach ($mensajes as $mensaje) {
            $id = (int) ($mensaje['id'] ?? 0);
            if ($id <= 0) {
                continue;
            }

            $mensaje['respuestas'] = [];
            $mapa[$id] = $mensaje;
        }

        // Luego asociar cada mensaje como respuesta de su padre en el mapa
        foreach ($mensajes as $mensaje) {
            $id = (int) ($mensaje['id'] ?? 0);
            $padre = (int) ($mensaje['id_respuesta_a'] ?? 0);
            if ($padre > 0 && isset($mapa[$padre]) && isset($mapa[$id])) {
                $mapa[$padre]['respuestas'][] = $mapa[$id];
            }
        }

        // Finalmente construir el array de hilos (solo mensajes raíces), conservando el orden original
        $hilos = [];
        $visto = [];
        foreach ($mensajes as $mensaje) {
            $id = (int) ($mensaje['id'] ?? 0);
            $padre = (int) ($mensaje['id_respuesta_a'] ?? 0);
            if ($padre === 0 && isset($mapa[$id]) && !isset($visto[$id])) {
                $hilos[] = $mapa[$id];
                $visto[$id] = true;
            }
        }

        return $hilos;
    }
}
