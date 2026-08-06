<?php
include_once "conexion.php";

class Comodin
{
    public $id_comodin;
    public $seccion;
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

    private static function existe_titulo_duplicado($titulo, $idTecnologia, $seccion, $excludeId = null)
    {
        $titulo = trim((string) $titulo);
        if ($titulo === '') {
            return false;
        }

        $sql = "SELECT 1 FROM comodin WHERE LOWER(TRIM(titulo)) = LOWER(TRIM(?)) AND id_tecnologia = ? AND LOWER(TRIM(seccion)) = LOWER(TRIM(?))";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        if ($excludeId !== null) {
            $sql .= " AND id_comodin != ?";
            $stmt = $objConn->enlace->prepare($sql);
            if (!$stmt) {
                return false;
            }
            $stmt->bind_param('sisi', $titulo, $idTecnologia, $seccion, $excludeId);
        } else {
            $stmt->bind_param('sis', $titulo, $idTecnologia, $seccion);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() !== null;
    }

    public function guardar()
    {
        if (self::existe_titulo_duplicado($this->titulo, $this->id_tecnologia, $this->seccion)) {
            return false;
        }

        $sql = "INSERT INTO comodin (id_tecnologia, titulo, contenido, imagen, link_referencia, activo, orden, seccion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('issssiss', $this->id_tecnologia, $this->titulo, $this->contenido, $this->imagen, $this->link_referencia, $this->activo, $this->orden, $this->seccion);
        return $stmt->execute();
    }

    public function actualizar($nro = 0)
    {
        if (self::existe_titulo_duplicado($this->titulo, $this->id_tecnologia, $this->seccion, $nro)) {
            return false;
        }

        $sql = "UPDATE comodin SET id_tecnologia = ?, titulo = ?, contenido = ?, imagen = ?, link_referencia = ?, activo = ?, orden = ?, seccion = ? WHERE id_comodin = ?";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('issssissi', $this->id_tecnologia, $this->titulo, $this->contenido, $this->imagen, $this->link_referencia, $this->activo, $this->orden, $this->seccion, $nro);
        return $stmt->execute();
    }

    public function borrar($nro = 0)
    {
        $sql = "DELETE FROM comodin WHERE id_comodin = ?";
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
            $sql = "SELECT * FROM comodin WHERE id_comodin = ?";
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
        $sql = "SELECT * FROM comodin WHERE titulo LIKE ? OR contenido LIKE ? OR link_referencia LIKE ? OR id_comodin = ? OR seccion LIKE ?";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }

        $like = '%' . trim((string) $str) . '%';
        $id = is_numeric($str) ? (int) $str : 0;
        $stmt->bind_param('sssis', $like, $like, $like, $id, $like);
        $stmt->execute();
        return self::normalizar_resultado($stmt->get_result());
    }

    public static function seleccionar_comodin($str, $seccion)
    {
        $sql = "SELECT * FROM comodin WHERE id_tecnologia = ? AND seccion = ? AND activo = 1 ORDER BY orden";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }

        $stmt->bind_param('is', $str, $seccion);
        $stmt->execute();
        return self::normalizar_resultado($stmt->get_result());
    }

    public static function filtrar($str = '')
    {
        $parts = preg_split('/\s+/', trim((string) $str), -1, PREG_SPLIT_NO_EMPTY);
        $objConn = new Conexion();

        if (count($parts) === 1) {
            $sql = "SELECT * FROM comodin WHERE titulo LIKE ? OR seccion LIKE ? OR id_tecnologia = ? ORDER BY orden";
            $like = '%' . $parts[0] . '%';
            $id = is_numeric($parts[0]) ? (int) $parts[0] : 0;
            $stmt = $objConn->enlace->prepare($sql);
            if (!$stmt) {
                return [];
            }
            $stmt->bind_param('ssi', $like, $like, $id);
            $stmt->execute();
            return self::normalizar_resultado($stmt->get_result());
        }

        $sql = "SELECT * FROM comodin WHERE ((titulo LIKE ? OR seccion LIKE ?) AND id_tecnologia = ?) OR ((titulo LIKE ? OR seccion LIKE ?) AND id_tecnologia = ?) ORDER BY orden";
        $like1 = '%' . $parts[0] . '%';
        $like2 = '%' . $parts[1] . '%';
        $id1 = is_numeric($parts[0]) ? (int) $parts[0] : 0;
        $id2 = is_numeric($parts[1]) ? (int) $parts[1] : 0;
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $stmt->bind_param('ssissi', $like1, $like1, $id2, $like2, $like2, $id1);
        $stmt->execute();
        return self::normalizar_resultado($stmt->get_result());
    }
}

