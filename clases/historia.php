<?php
include_once "conexion.php";

class Historia
{
    public $id_historia;
    public $id_tecnologia;
    public $titulo;
    public $contenido;
    public $imagen;
    public $link_referencia;
    public $activo;
    public $orden;

    private static function normalizar_fila($fila)
    {
        if (!is_array($fila)) {
            return [];
        }

        $normalized = [];
        foreach ($fila as $key => $value) {
            $normalized[$key] = $value;
            $normalized[strtolower($key)] = $value;
        }

        return $normalized;
    }

    private static function normalizar_resultado($result)
    {
        $est = [];
        while ($fila = $result->fetch_assoc()) {
            $est[] = self::normalizar_fila($fila);
        }

        return $est;
    }

    private static function existe_titulo_duplicado($titulo, $idTecnologia, $excludeId = null)
    {
        $titulo = trim((string) $titulo);
        if ($titulo === '') {
            return false;
        }

        $sql = "SELECT 1 FROM historia WHERE LOWER(TRIM(titulo)) = LOWER(TRIM(?)) AND id_tecnologia = ?";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        if ($excludeId !== null) {
            $sql .= " AND id_historia != ?";
            $stmt = $objConn->enlace->prepare($sql);
            if (!$stmt) {
                return false;
            }
            $stmt->bind_param('sii', $titulo, $idTecnologia, $excludeId);
        } else {
            $stmt->bind_param('si', $titulo, $idTecnologia);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() !== null;
    }

    public function guardar()
    {
        if (self::existe_titulo_duplicado($this->titulo, $this->id_tecnologia)) {
            return false;
        }

        $sql = "INSERT INTO historia (id_tecnologia, titulo, contenido, imagen, link_referencia, activo, orden) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('isssssi', $this->id_tecnologia, $this->titulo, $this->contenido, $this->imagen, $this->link_referencia, $this->activo, $this->orden);
        return $stmt->execute();
    }

    public function actualizar($nro = 0)
    {
        if (self::existe_titulo_duplicado($this->titulo, $this->id_tecnologia, $nro)) {
            return false;
        }

        $sql = "UPDATE historia SET id_tecnologia = ?, titulo = ?, contenido = ?, imagen = ?, link_referencia = ?, activo = ?, orden = ? WHERE id_historia = ?";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('isssssi', $this->id_tecnologia, $this->titulo, $this->contenido, $this->imagen, $this->link_referencia, $this->activo, $this->orden, $nro);
        return $stmt->execute();
    }

    public function borrar($nro = 0)
    {
        $sql = "DELETE FROM historia WHERE id_historia = ?";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('i', $nro);
        return $stmt->execute();
    }

    public static function traer_datos($nro = 0)
    {
        if ($nro != 0) {
            $sql = "SELECT * FROM historia WHERE id_historia = ?";
            $objConn = new Conexion();
            $stmt = $objConn->enlace->prepare($sql);
            if (!$stmt) {
                return [];
            }

            $stmt->bind_param('i', $nro);
            $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc() ?: [];
            return self::normalizar_fila($row);
        }

        return [];
    }

    public static function buscar($str)
    {
        $sql = "SELECT * FROM historia WHERE titulo LIKE ? OR contenido LIKE ? OR link_referencia LIKE ? OR id_historia = ?";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }

        $like = '%' . trim((string) $str) . '%';
        $id = is_numeric($str) ? (int) $str : 0;
        $stmt->bind_param('sssi', $like, $like, $like, $id);
        $stmt->execute();
        return self::normalizar_resultado($stmt->get_result());
    }

    public static function seleccionar($str)
    {
        $sql = "SELECT * FROM historia WHERE id_tecnologia = ? AND activo = 1 ORDER BY orden";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }

        $stmt->bind_param('i', $str);
        $stmt->execute();
        return self::normalizar_resultado($stmt->get_result());
    }

    public static function id_tecnologias()
    {
        $sql = "SELECT id_tecnologia, COUNT(id_historia) AS total FROM historia WHERE activo = 1 GROUP BY id_tecnologia";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }

        $stmt->execute();
        return self::normalizar_resultado($stmt->get_result());
    }

    public static function filtrar($str = '')
    {
        $sql = "SELECT * FROM historia WHERE titulo LIKE ? OR id_tecnologia = ? ORDER BY orden";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }

        $like = '%' . trim((string) $str) . '%';
        $id = is_numeric($str) ? (int) $str : 0;
        $stmt->bind_param('si', $like, $id);
        $stmt->execute();
        return self::normalizar_resultado($stmt->get_result());
    }
}

