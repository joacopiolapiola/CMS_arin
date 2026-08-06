<?php
include_once "conexion.php";

class Tecnologia
{
    public $id_tecnologia;
    public $nombre;
    public $abreviatura;
    public $resumen;
    public $logo;
    public $orden;
    public $activo;
    public $definicion;
    public $color;
    public $bkg_color;

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

        $sql = "SELECT 1 FROM tecnologias WHERE LOWER(TRIM(nombre)) = LOWER(TRIM(?))";
        $params = 's';
        $values = [$nombre];

        if ($excludeId !== null) {
            $sql .= " AND id_tecnologia != ?";
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

        $sql = "INSERT INTO tecnologias (nombre, abreviatura, resumen, definicion, logo, orden, activo, color, bkg_color)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('sssssisss', $this->nombre, $this->abreviatura, $this->resumen, $this->definicion, $this->logo, $this->orden, $this->activo, $this->color, $this->bkg_color);
        return $stmt->execute();
    }

    public function actualizar($nro = 0)
    {
        if (self::existe_nombre_duplicado($this->nombre, $nro)) {
            return false;
        }

        $sql = "UPDATE tecnologias SET nombre = ?, abreviatura = ?, orden = ?, resumen = ?, definicion = ?, logo = ?, activo = ?, color = ?, bkg_color = ? WHERE id_tecnologia = ?";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('ssissssssi', $this->nombre, $this->abreviatura, $this->orden, $this->resumen, $this->definicion, $this->logo, $this->activo, $this->color, $this->bkg_color, $nro);
        return $stmt->execute();
    }

    public function borrar($nro = 0)
    {
        $sql = "DELETE FROM tecnologias WHERE id_tecnologia = ?";
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
            $sql = "SELECT * FROM tecnologias WHERE id_tecnologia = ?";
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

    public static function buscar()
    {
        $sql = "SELECT * FROM tecnologias WHERE activo = 1 ORDER BY orden";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $stmt->execute();
        return self::normalizar_resultado($stmt->get_result());
    }

    public static function buscar_todas()
    {
        $sql = "SELECT * FROM tecnologias ORDER BY id_tecnologia";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $stmt->execute();
        return self::normalizar_resultado($stmt->get_result());
    }

    public static function buscar_raiz()
    {
        $sql = "SELECT * FROM raiz WHERE id_raiz = 0 AND activo = 1 ORDER BY orden";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc() ?: [];
        return self::normalizar_fila($row);
    }

    public static function seleccionar()
    {
        $sql = "SELECT nombre, id_tecnologia FROM tecnologias ORDER BY nombre ASC";
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
        $objConn = new Conexion();
        $str = trim((string) $str);

        if ($str === '') {
            return self::buscar();
        }

        $sql = "SELECT * FROM tecnologias WHERE nombre LIKE ? OR abreviatura LIKE ? OR id_tecnologia = ? ORDER BY orden";
        $like = '%' . $str . '%';
        $id = is_numeric($str) ? (int) $str : 0;
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $stmt->bind_param('ssi', $like, $like, $id);
        $stmt->execute();
        return self::normalizar_resultado($stmt->get_result());
    }
}
