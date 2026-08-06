<?php
include_once __DIR__ . '/conexion.php';

class Encuesta
{
    public static function asegurarTablas(): void
    {
        $conn = new Conexion();

        $sqlEncuestas = "CREATE TABLE IF NOT EXISTS encuestas (
            id_encuesta INT NOT NULL AUTO_INCREMENT,
            pregunta TEXT NOT NULL,
            descripcion TEXT NULL,
            id_tecnologia INT NOT NULL DEFAULT 0,
            activo TINYINT(1) NOT NULL DEFAULT 1,
            creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id_encuesta),
            KEY idx_encuestas_activo (activo),
            KEY idx_encuestas_tecnologia (id_tecnologia)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

        $sqlOpciones = "CREATE TABLE IF NOT EXISTS encuesta_opciones (
            id_opcion INT NOT NULL AUTO_INCREMENT,
            id_encuesta INT NOT NULL,
            texto VARCHAR(255) NOT NULL,
            orden_item INT NOT NULL DEFAULT 0,
            activo TINYINT(1) NOT NULL DEFAULT 1,
            PRIMARY KEY (id_opcion),
            KEY idx_opciones_encuesta (id_encuesta),
            CONSTRAINT fk_encuesta_opcion_encuesta FOREIGN KEY (id_encuesta) REFERENCES encuestas(id_encuesta) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

        $sqlRespuestas = "CREATE TABLE IF NOT EXISTS encuesta_respuestas (
            id_respuesta INT NOT NULL AUTO_INCREMENT,
            id_encuesta INT NOT NULL,
            id_opcion INT NOT NULL,
            id_usuario INT NOT NULL,
            creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id_respuesta),
            UNIQUE KEY uq_encuesta_usuario (id_encuesta, id_usuario),
            KEY idx_respuestas_encuesta (id_encuesta),
            KEY idx_respuestas_usuario (id_usuario),
            CONSTRAINT fk_encuesta_respuesta_encuesta FOREIGN KEY (id_encuesta) REFERENCES encuestas(id_encuesta) ON DELETE CASCADE,
            CONSTRAINT fk_encuesta_respuesta_opcion FOREIGN KEY (id_opcion) REFERENCES encuesta_opciones(id_opcion) ON DELETE CASCADE,
            CONSTRAINT fk_encuesta_respuesta_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(ID_usuario) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

        $conn->enlace->query($sqlEncuestas);
        $conn->enlace->query($sqlOpciones);
        $conn->enlace->query($sqlRespuestas);
    }

    public static function listar(): array
    {
        self::asegurarTablas();

        $sql = "SELECT e.*, COUNT(DISTINCT r.id_respuesta) AS total_votos
                FROM encuestas e
                LEFT JOIN encuesta_opciones o ON o.id_encuesta = e.id_encuesta AND o.activo = 1
                LEFT JOIN encuesta_respuestas r ON r.id_opcion = o.id_opcion
                GROUP BY e.id_encuesta
                ORDER BY e.creado_en DESC";

        $conn = new Conexion();
        $resultado = $conn->enlace->query($sql);
        if (!$resultado) {
            return [];
        }

        $filas = [];
        while ($fila = $resultado->fetch_assoc()) {
            $filas[] = $fila;
        }

        return $filas;
    }

    public static function listarActivas(int $idTecnologia = 0): array
    {
        self::asegurarTablas();

        $sql = "SELECT * FROM encuestas WHERE activo = 1";
        $params = [];

        if ($idTecnologia > 0) {
            $sql .= " AND id_tecnologia = ?";
            $params[] = $idTecnologia;
        }

        $sql .= " ORDER BY creado_en DESC";

        $conn = new Conexion();
        if (!empty($params)) {
            $stmt = $conn->enlace->prepare($sql);
            if (!$stmt) {
                return [];
            }
            $stmt->bind_param('i', ...$params);
            $stmt->execute();
            $resultado = $stmt->get_result();
        } else {
            $resultado = $conn->enlace->query($sql);
        }

        if (!$resultado) {
            return [];
        }

        $filas = [];
        while ($fila = $resultado->fetch_assoc()) {
            $filas[] = $fila;
        }

        return $filas;
    }

    public static function traerPorId(int $id): ?array
    {
        self::asegurarTablas();

        $sql = "SELECT * FROM encuestas WHERE id_encuesta = ? LIMIT 1";
        $conn = new Conexion();
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return null;
        }

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();
        return $fila ?: null;
    }

    public static function crear(string $pregunta, string $descripcion = '', int $idTecnologia = 0, int $activo = 1): ?int
    {
        self::asegurarTablas();

        $pregunta = trim($pregunta);
        $descripcion = trim($descripcion);
        if ($pregunta === '') {
            return null;
        }

        $activo = $activo ? 1 : 0;

        $conn = new Conexion();
        $sql = "INSERT INTO encuestas (pregunta, descripcion, id_tecnologia, activo, creado_en) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return null;
        }

        $stmt->bind_param('ssii', $pregunta, $descripcion, $idTecnologia, $activo);
        if (!$stmt->execute()) {
            return null;
        }

        return (int) $conn->enlace->insert_id;
    }

    public static function actualizar(int $idEncuesta, string $pregunta, string $descripcion = '', int $idTecnologia = 0, int $activo = 1): bool
    {
        self::asegurarTablas();

        $pregunta = trim($pregunta);
        if ($pregunta === '') {
            return false;
        }

        $conn = new Conexion();
        $sql = "UPDATE encuestas SET pregunta = ?, descripcion = ?, id_tecnologia = ?, activo = ? WHERE id_encuesta = ?";
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('ssiii', $pregunta, $descripcion, $idTecnologia, $activo, $idEncuesta);
        return $stmt->execute();
    }

    public static function borrar(int $idEncuesta): bool
    {
        self::asegurarTablas();

        $conn = new Conexion();
        $sql = "DELETE FROM encuestas WHERE id_encuesta = ?";
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('i', $idEncuesta);
        return $stmt->execute();
    }

    public static function opciones(int $idEncuesta): array
    {
        self::asegurarTablas();

        $sql = "SELECT * FROM encuesta_opciones WHERE id_encuesta = ? AND activo = 1 ORDER BY orden_item, id_opcion ASC";
        $conn = new Conexion();
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }

        $stmt->bind_param('i', $idEncuesta);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $opciones = [];
        while ($fila = $resultado->fetch_assoc()) {
            $opciones[] = $fila;
        }

        return $opciones;
    }

    public static function resultados(int $idEncuesta): array
    {
        self::asegurarTablas();

        $sql = "SELECT o.id_opcion, o.texto, COUNT(r.id_respuesta) AS votos
                FROM encuesta_opciones o
                LEFT JOIN encuesta_respuestas r ON r.id_opcion = o.id_opcion
                WHERE o.id_encuesta = ? AND o.activo = 1
                GROUP BY o.id_opcion, o.texto
                ORDER BY o.orden_item, o.id_opcion";

        $conn = new Conexion();
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }

        $stmt->bind_param('i', $idEncuesta);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $filas = [];
        while ($fila = $resultado->fetch_assoc()) {
            $filas[] = $fila;
        }

        return $filas;
    }
}

class EncuestaOpcion
{
    public static function guardar(int $idEncuesta, array $opciones): bool
    {
        if ($idEncuesta <= 0 || empty($opciones)) {
            return false;
        }

        $conn = new Conexion();
        $sql = "INSERT INTO encuesta_opciones (id_encuesta, texto, orden_item, activo) VALUES (?, ?, ?, 1)";
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $orden = 0;
        foreach ($opciones as $texto) {
            $texto = trim((string) $texto);
            if ($texto === '') {
                continue;
            }

            $orden++;
            $stmt->bind_param('isi', $idEncuesta, $texto, $orden);
            if (!$stmt->execute()) {
                return false;
            }
        }

        return true;
    }

    public static function reemplazar(int $idEncuesta, array $opciones): bool
    {
        $conn = new Conexion();
        $sqlDelete = "DELETE FROM encuesta_opciones WHERE id_encuesta = ?";
        $stmtDelete = $conn->enlace->prepare($sqlDelete);
        if (!$stmtDelete) {
            return false;
        }

        $stmtDelete->bind_param('i', $idEncuesta);
        if (!$stmtDelete->execute()) {
            return false;
        }

        return self::guardar($idEncuesta, $opciones);
    }
}

class EncuestaRespuesta
{
    public static function usuarioYaRespondio(int $idEncuesta, int $idUsuario): bool
    {
        $conn = new Conexion();
        $sql = "SELECT 1 FROM encuesta_respuestas WHERE id_encuesta = ? AND id_usuario = ? LIMIT 1";
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return true;
        }

        $stmt->bind_param('ii', $idEncuesta, $idUsuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc() !== null;
    }

    public static function votar(int $idEncuesta, int $idUsuario, int $idOpcion): bool
    {
        if ($idEncuesta <= 0 || $idUsuario <= 0 || $idOpcion <= 0) {
            return false;
        }

        if (self::usuarioYaRespondio($idEncuesta, $idUsuario)) {
            return false;
        }

        $conn = new Conexion();
        $sql = "INSERT INTO encuesta_respuestas (id_encuesta, id_opcion, id_usuario, creado_en) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('iii', $idEncuesta, $idOpcion, $idUsuario);
        return $stmt->execute();
    }
}
