<?php
include_once "conexion.php";

class Raiz
{
    public $id_raiz;
    public $nombre;
    public $abreviatura;
    public $resumen;
    public $logo;
    public $orden;
    public $activo;
    public $definicion;
    public $color;
    public $bkg_color;
    public $nombre_sitio;
    public $nombre_institucion;
    public $color_gral;
    public $bkg_color_gral;
    public $fuente;

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

        $sql = "SELECT 1 FROM raiz WHERE LOWER(TRIM(nombre)) = LOWER(TRIM(?))";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        if ($excludeId !== null) {
            $sql .= " AND id_raiz != ?";
            $stmt = $objConn->enlace->prepare($sql);
            if (!$stmt) {
                return false;
            }
            $stmt->bind_param('si', $nombre, $excludeId);
        } else {
            $stmt->bind_param('s', $nombre);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() !== null;
    }

    public function guardar()
    {
        if (self::existe_nombre_duplicado($this->nombre)) {
            return false;
        }

        $sql = "INSERT INTO raiz (nombre, abreviatura, resumen, definicion, logo, orden, activo, color, bkg_color, nombre_sitio, nombre_institucion, fuente, color_gral, bkg_color_gral)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('sssssiisssssss', $this->nombre, $this->abreviatura, $this->resumen, $this->definicion, $this->logo, $this->orden, $this->activo, $this->color, $this->bkg_color, $this->nombre_sitio, $this->nombre_institucion, $this->fuente, $this->color_gral, $this->bkg_color_gral);
        return $stmt->execute();
    }

    public function actualizar($nro = 0)
    {
        if (self::existe_nombre_duplicado($this->nombre, $nro)) {
            return false;
        }

        $sql = "UPDATE raiz SET nombre = ?, abreviatura = ?, definicion = ?, orden = ?, resumen = ?, logo = ?, activo = ?, color = ?, bkg_color = ?, nombre_sitio = ?, nombre_institucion = ?, fuente = ?, color_gral = ?, bkg_color_gral = ? WHERE id_raiz = ?";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('sssiisssssssssi', $this->nombre, $this->abreviatura, $this->definicion, $this->orden, $this->resumen, $this->logo, $this->activo, $this->color, $this->bkg_color, $this->nombre_sitio, $this->nombre_institucion, $this->fuente, $this->color_gral, $this->bkg_color_gral, $nro);
        return $stmt->execute();
    }

    public function borrar($nro = 0)
    {
        $sql = "DELETE FROM raiz WHERE id_raiz = ?";
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
        $objConn = new Conexion();

        if ($nro != 0) {
            $sql = "SELECT * FROM raiz WHERE id_raiz = ?";
            $stmt = $objConn->enlace->prepare($sql);
            if (!$stmt) {
                return [];
            }

            $stmt->bind_param('i', $nro);
            $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc() ?: [];
            return self::normalizar_fila($row);
        }

        $sql = "SELECT * FROM raiz WHERE activo = 1 ORDER BY orden ASC LIMIT 1";
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }

        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc() ?: [];
        return self::normalizar_fila($row);
    }

    public static function buscar()
    {
        $sql = "SELECT * FROM raiz WHERE activo = 1 ORDER BY orden";
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
        $sql = "SELECT nombre, id_raiz FROM raiz ORDER BY nombre ASC";
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
        $like = '%' . $str . '%';
        $id = is_numeric($str) ? (int) $str : 0;

        $sql = "SELECT * FROM raiz WHERE nombre LIKE ? OR abreviatura LIKE ? OR id_raiz = ? ORDER BY orden";
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }

        $stmt->bind_param('ssi', $like, $like, $id);
        $stmt->execute();
        return self::normalizar_resultado($stmt->get_result());
    }
}
