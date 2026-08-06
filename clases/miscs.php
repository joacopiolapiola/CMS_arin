<?php
include "recursos.php";

class Misc extends Recurso
{
    public $id_misc;
    public $pos_FC;
    public $link_local;

    public function guardar_misc()
    {
        $sql = "INSERT INTO misc (id_tecnologia, nombre, contenido, ordenamiento, activo, link_referencia, imagen, link_local) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('ississss', $this->id_tecnologia, $this->nombre, $this->contenido, $this->orden, $this->activo, $this->link, $this->imagen, $this->link_local);
        return $stmt->execute();
    }

    public function actualizar_misc($nro = 0)
    {
        $sql = "UPDATE misc SET id_tecnologia = ?, nombre = ?, contenido = ?, ordenamiento = ?, activo = ?, link_referencia = ?, imagen = ?, link_local = ? WHERE id_misc = ?";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('ississssi', $this->id_tecnologia, $this->nombre, $this->contenido, $this->orden, $this->activo, $this->link, $this->imagen, $this->link_local, $nro);
        return $stmt->execute();
    }

    public function borrar_misc($nro = 0)
    {
        $sql = "DELETE FROM misc WHERE id_misc = ?";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('i', $nro);
        return $stmt->execute();
    }

    public function traer_datos_misc($nro = 0)
    {
        if ($nro != 0) {
            $sql = "SELECT * FROM misc WHERE id_misc = ?";
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

    public static function buscar_misc($str)
    {
        $str = trim((string) $str);
        $sql = "SELECT * FROM misc WHERE nombre LIKE ? OR contenido LIKE ? OR link_referencia LIKE ? OR CAST(id_misc AS CHAR) = ?";
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

    public static function seleccionar_misc()
    {
        $sql = "SELECT * FROM misc WHERE activo = 1";
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

    public static function traer_misc($nro = 0)
    {
        if ($nro != 0) {
            $sql = "SELECT * FROM misc WHERE ID_misc = ?";
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

    public static function id_tecnologias_misc()
    {
        $sql = "SELECT id_tecnologia, COUNT(id_misc) AS total FROM misc WHERE activo = 1 GROUP BY id_tecnologia";
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