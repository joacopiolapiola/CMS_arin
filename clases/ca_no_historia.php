<?php
include_once("conexion.php");

class historia
{
    public $id_historia;
    public $id_tecnologia;
    public $nombre;
    public $contenido;
    public $link;
    public $activo;
    public $orden;

    public function guardar()
    {
        $sql = "INSERT INTO historia (id_tecnologia, nombre, contenido, ordenamiento, activo, link_referencia) VALUES (?, ?, ?, ?, ?, ?)";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('ississ', $this->id_tecnologia, $this->nombre, $this->contenido, $this->orden, $this->activo, $this->link);
        return $stmt->execute();
    }

    public function actualizar($nro = 0)
    {
        $sql = "UPDATE historia SET id_tecnologia = ?, nombre = ?, contenido = ?, ordenamiento = ?, activo = ?, link_referencia = ? WHERE id_recurso = ?";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('issisii', $this->id_tecnologia, $this->nombre, $this->contenido, $this->orden, $this->activo, $this->link, $nro);
        return $stmt->execute();
    }

    public function borrar($nro = 0)
    {
        $sql = "DELETE FROM historia WHERE id_recurso = ?";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('i', $nro);
        return $stmt->execute();
    }

    public function traer_datos($nro = 0)
    {
        if ($nro != 0) {
            $sql = "SELECT * FROM historia WHERE id_recurso = ?";
            $objConn = new Conexion();
            $stmt = $objConn->enlace->prepare($sql);
            if (!$stmt) {
                return [];
            }

            $stmt->bind_param('i', $nro);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc() ?: [];
        }

        return [];
    }

    public static function buscar($str)
    {
        $str = trim((string) $str);
        $sql = "SELECT * FROM historia WHERE nombre LIKE ? OR contenido LIKE ? OR link_referencia LIKE ? OR CAST(id_recurso AS CHAR) = ?";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }

        $like = '%' . $str . '%';
        $stmt->bind_param('ssss', $like, $like, $like, $str);
        $stmt->execute();
        $result = $stmt->get_result();
        $est = [];
        while ($fila = $result->fetch_assoc()) {
            $est[] = $fila;
        }

        return $est;
    }

    public static function seleccionar($str)
    {
        $sql = "SELECT * FROM historia WHERE id_tecnologia = ? AND activo = 1";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }

        $stmt->bind_param('i', $str);
        $stmt->execute();
        $result = $stmt->get_result();
        $est = [];
        while ($fila = $result->fetch_assoc()) {
            $est[] = $fila;
        }

        return $est;
    }

    public static function id_tecnologias()
    {
        $sql = "SELECT id_tecnologia, COUNT(id_recurso) AS total FROM historia WHERE activo = 1 GROUP BY id_tecnologia";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $est = [];
        while ($fila = $result->fetch_assoc()) {
            $est[] = $fila;
        }

        return $est;
    }
}