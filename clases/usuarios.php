<?php
include_once "conexion.php";

class Usuario
{
    public $id_usuario;
    public $nombre;
    public $telefono;
    public $roles;
    public $gmail;
    public $password;
    public $permisos;
    public $institucion;
    public $rol_institucion;

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

    public function guardar()
    {
        $sql = "INSERT INTO usuarios (nombre, telefono, roles, email, password, permisos, institucion, Rol_institucion)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $conn = new Conexion();
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param(
            'ssssssss',
            $this->nombre,
            $this->telefono,
            $this->roles,
            $this->gmail,
            $this->password,
            $this->permisos,
            $this->institucion,
            $this->rol_institucion
        );

        return $stmt->execute();
    }

    public function registro()
    {
        $tmp = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nombre, telefono, email, password, Institucion) VALUES (?, ?, ?, ?, ?)";
        $conn = new Conexion();
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('sssss', $this->nombre, $this->telefono, $this->gmail, $tmp, $this->institucion);
        return $stmt->execute();
    }

    public function actualizar($nro = 0)
    {
        $sql = "UPDATE usuarios SET nombre = ?, telefono = ?, roles = ?, email = ?, permisos = ?, Institucion = ?, Rol_institucion = ? WHERE ID_usuario = ?";
        $conn = new Conexion();
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('sssssssi', $this->nombre, $this->telefono, $this->roles, $this->gmail, $this->permisos, $this->institucion, $this->rol_institucion, $nro);
        return $stmt->execute();
    }

    public function borrar($nro = 0)
    {
        $sql = "DELETE FROM usuarios WHERE ID_usuario = ?";
        $conn = new Conexion();
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('i', $nro);
        return $stmt->execute();
    }

    public static function traer_datos($nro = 0)
    {
        if ($nro != 0) {
            $sql = "SELECT * FROM usuarios WHERE ID_usuario = ?";
            $objConn = new Conexion();
            $stmt = $objConn->enlace->prepare($sql);
            if (!$stmt) {
                return [];
            }

            $stmt->bind_param('i', $nro);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc() ?: [];
            if (empty($row)) {
                return [];
            }

            return self::normalizar_fila($row);
        }

        return [];
    }

    public static function filtrar($str = '', $tipo = '')
    {
        $conn = new Conexion();
        $str = trim((string) $str);

        switch ($tipo) {
            case 'login':
                $sql = "SELECT * FROM usuarios WHERE email = ?";
                $stmt = $conn->enlace->prepare($sql);
                if (!$stmt) {
                    return [];
                }
                $stmt->bind_param('s', $str);
                break;
            case 'buscar':
                $like = '%' . $str . '%';
                $sql = "SELECT * FROM usuarios WHERE nombre LIKE ? OR email LIKE ? OR institucion LIKE ? ORDER BY ID_usuario";
                $stmt = $conn->enlace->prepare($sql);
                if (!$stmt) {
                    return [];
                }
                $stmt->bind_param('sss', $like, $like, $like);
                break;
            case 'id':
                $sql = "SELECT * FROM usuarios WHERE ID_usuario = ?";
                $stmt = $conn->enlace->prepare($sql);
                if (!$stmt) {
                    return [];
                }
                $stmt->bind_param('i', $str);
                break;
            default:
                $like = '%' . $str . '%';
                $sql = "SELECT * FROM usuarios WHERE nombre LIKE ? OR email LIKE ? OR institucion LIKE ? ORDER BY ID_usuario";
                $stmt = $conn->enlace->prepare($sql);
                if (!$stmt) {
                    return [];
                }
                $stmt->bind_param('sss', $like, $like, $like);
                break;
        }

        $stmt->execute();
        $result = $stmt->get_result();

        return self::normalizar_resultado($result);
    }

    public static function buscar($str = '')
    {
        $sql = "SELECT * FROM usuarios WHERE nombre LIKE ? OR email LIKE ? OR institucion LIKE ? ORDER BY ID_usuario";
        $conn = new Conexion();
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $like = '%' . trim((string) $str) . '%';
        $stmt->bind_param('sss', $like, $like, $like);
        $stmt->execute();

        $result = $stmt->get_result();
        return self::normalizar_resultado($result);
    }

    public static function listar()
    {
        $sql = "SELECT * FROM usuarios ORDER BY nombre";
        $conn = new Conexion();
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return self::normalizar_resultado($result);
    }

    public static function nombres()
    {
        $sql = "SELECT DISTINCT nombre FROM usuarios ORDER BY nombre";
        $conn = new Conexion();
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return self::normalizar_resultado($result);
    }

    public static function enumerar()
    {
        $sql = "SELECT DISTINCT nombre, institucion FROM usuarios ORDER BY nombre";
        $conn = new Conexion();
        $stmt = $conn->enlace->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return self::normalizar_resultado($result);
    }
}