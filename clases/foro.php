<?php
include_once __DIR__ . '/conexion.php';

class ForoTema
{
    public static function asegurarTablas(): void
    {
        $conn = new Conexion();

        $sqlTemas = "CREATE TABLE IF NOT EXISTS foro_temas (
            id_tema INT NOT NULL AUTO_INCREMENT,
            id_usuario INT NOT NULL,
            titulo VARCHAR(150) NOT NULL,
            contenido TEXT NOT NULL,
            creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            activo TINYINT(1) NOT NULL DEFAULT 1,
            PRIMARY KEY (id_tema),
            KEY idx_foro_tema_usuario (id_usuario),
            CONSTRAINT fk_foro_tema_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(ID_usuario) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

        $sqlRespuestas = "CREATE TABLE IF NOT EXISTS foro_respuestas (
            id_respuesta INT NOT NULL AUTO_INCREMENT,
            id_tema INT NOT NULL,
            id_usuario INT NOT NULL,
            contenido TEXT NOT NULL,
            creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            activo TINYINT(1) NOT NULL DEFAULT 1,
            PRIMARY KEY (id_respuesta),
            KEY idx_foro_respuesta_tema (id_tema),
            KEY idx_foro_respuesta_usuario (id_usuario),
            CONSTRAINT fk_foro_respuesta_tema FOREIGN KEY (id_tema) REFERENCES foro_temas(id_tema) ON DELETE CASCADE,
            CONSTRAINT fk_foro_respuesta_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(ID_usuario) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

        $conn->enlace->query($sqlTemas);
        $conn->enlace->query($sqlRespuestas);
    }

    public static function crearTema(int $idUsuario, string $titulo, string $contenido): bool
    {
        self::asegurarTablas();

        $idUsuario = (int) $idUsuario;
        $titulo = trim($titulo);
        $contenido = trim($contenido);

        if ($idUsuario <= 0 || $titulo === '' || $contenido === '') {
            return false;
        }

        $conn = new Conexion();
        $sql = 'INSERT INTO foro_temas (id_usuario, titulo, contenido, creado_en, activo) VALUES (?, ?, ?, NOW(), 1)';
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('iss', $idUsuario, $titulo, $contenido);
        return $stmt->execute();
    }

    public static function listarTemas(): array
    {
        self::asegurarTablas();

        $sql = "SELECT t.id_tema, t.id_usuario, t.titulo, t.contenido, t.creado_en,
                       u.nombre AS nombre_usuario,
                       (SELECT COUNT(*) FROM foro_respuestas r WHERE r.id_tema = t.id_tema AND r.activo = 1) AS total_respuestas,
                       (SELECT MAX(r.creado_en) FROM foro_respuestas r WHERE r.id_tema = t.id_tema AND r.activo = 1) AS ultima_respuesta
                FROM foro_temas t
                INNER JOIN usuarios u ON u.ID_usuario = t.id_usuario
                WHERE t.activo = 1
                ORDER BY t.creado_en DESC";

        $conn = new Conexion();
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }

        $stmt->execute();
        $resultado = $stmt->get_result();
        $temas = [];

        while ($fila = $resultado->fetch_assoc()) {
            $temas[] = $fila;
        }

        return $temas;
    }
}

class ForoRespuesta
{
    public static function crearRespuesta(int $idTema, int $idUsuario, string $contenido): bool
    {
        ForoTema::asegurarTablas();

        $idTema = (int) $idTema;
        $idUsuario = (int) $idUsuario;
        $contenido = trim($contenido);

        if ($idTema <= 0 || $idUsuario <= 0 || $contenido === '') {
            return false;
        }

        $conn = new Conexion();
        $sql = 'INSERT INTO foro_respuestas (id_tema, id_usuario, contenido, creado_en, activo) VALUES (?, ?, ?, NOW(), 1)';
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('iis', $idTema, $idUsuario, $contenido);
        return $stmt->execute();
    }

    public static function listarPorTema(int $idTema): array
    {
        ForoTema::asegurarTablas();

        $sql = "SELECT r.id_respuesta, r.id_tema, r.id_usuario, r.contenido, r.creado_en,
                       u.nombre AS nombre_usuario
                FROM foro_respuestas r
                INNER JOIN usuarios u ON u.ID_usuario = r.id_usuario
                WHERE r.id_tema = ? AND r.activo = 1
                ORDER BY r.creado_en ASC";

        $conn = new Conexion();
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }

        $stmt->bind_param('i', $idTema);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $respuestas = [];

        while ($fila = $resultado->fetch_assoc()) {
            $respuestas[] = $fila;
        }

        return $respuestas;
    }
}
