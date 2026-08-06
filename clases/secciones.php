<?php
include_once "conexion.php";

class Seccion
{
    public $id_seccion;
    public $nombre;
    public $id_tecnologia;
    public $orden;
    public $enlace;
    public $activo;
    public $enlace_cms;

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

    private static function existe_nombre_duplicado($nombre, $excludeId = null)
    {
        $nombre = trim((string) $nombre);
        if ($nombre === '') {
            return false;
        }

        $sql = "SELECT 1 FROM secciones WHERE LOWER(TRIM(nombre)) = LOWER(TRIM(?))";
        $params = 's';
        $values = [$nombre];

        if ($excludeId !== null) {
            $sql .= " AND id_seccion != ?";
            $params .= 'i';
            $values[] = (int) $excludeId;
        }

        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param($params, ...$values);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() !== null;
    }

    public function guardar()
    {
        if (self::existe_nombre_duplicado($this->nombre)) {
            return false;
        }

        $sql = "INSERT INTO secciones (nombre, id_tecnologia, orden, enlace, activo, enlace_cms) VALUES (?, ?, ?, ?, ?, ?)";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('siisss', $this->nombre, $this->id_tecnologia, $this->orden, $this->enlace, $this->activo, $this->enlace_cms);
        return $stmt->execute();
    }

    public function actualizar($nro = 0)
    {
        if (self::existe_nombre_duplicado($this->nombre, $nro)) {
            return false;
        }

        $sql = "UPDATE secciones SET nombre = ?, id_tecnologia = ?, orden = ?, enlace = ?, activo = ?, enlace_cms = ? WHERE id_seccion = ?";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('siisssi', $this->nombre, $this->id_tecnologia, $this->orden, $this->enlace, $this->activo, $this->enlace_cms, $nro);
        return $stmt->execute();
    }

    public function borrar($nro = 0)
    {
        $sql = "DELETE FROM secciones WHERE id_seccion = ?";
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
            $sql = "SELECT * FROM secciones WHERE id_seccion = ?";
            $objConn = new Conexion();
            $stmt = $objConn->enlace->prepare($sql);
            if (!$stmt) {
                return [];
            }

            $stmt->bind_param('i', $nro);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc() ?: [];
            return self::normalizar_fila($row);
        }

        return [];
    }

    public static function filtrar($str = '')
    {
        $objConn = new Conexion();
        $str = trim((string) $str);

        if (!is_numeric($str)) {
            $sql = "SELECT * FROM secciones WHERE nombre LIKE ? OR enlace LIKE ? ORDER BY orden";
            $like = '%' . $str . '%';
            $stmt = $objConn->enlace->prepare($sql);
            if (!$stmt) {
                return [];
            }
            $stmt->bind_param('ss', $like, $like);
        } else {
            $sql = "SELECT * FROM secciones WHERE id_tecnologia = ? ORDER BY orden";
            $stmt = $objConn->enlace->prepare($sql);
            if (!$stmt) {
                return [];
            }
            $stmt->bind_param('i', $str);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return self::normalizar_resultado($result);
    }

    public static function buscar()
    {
        $sql = "SELECT * FROM secciones WHERE activo = 1 ORDER BY orden";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return self::normalizar_resultado($result);
    }

    public static function listar()
    {
        $sql = "SELECT * FROM secciones ORDER BY orden";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return self::normalizar_resultado($result);
    }

    public static function nombres()
    {
        $sql = "SELECT DISTINCT nombre FROM secciones ORDER BY nombre";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return self::normalizar_resultado($result);
    }

    public static function enumerar()
    {
        $sql = "SELECT DISTINCT nombre, enlace_cms FROM secciones ORDER BY nombre";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return self::normalizar_resultado($result);
    }
}
