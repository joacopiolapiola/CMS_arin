<?php
require_once __DIR__ . '/conexion.php';

class lectura
{
    public $id_usuario;

    public function guardar_registro()
    {
        $sql = "INSERT INTO registro (id_usuario) VALUES (?)";
        $objConn = new Conexion();
        $stmt = $objConn->enlace->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('i', $this->id_usuario);
        return $stmt->execute();
    }
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método no permitido.');
}

$id_usuario = isset($_POST['id_usuario']) ? filter_var($_POST['id_usuario'], FILTER_VALIDATE_INT) : false;
if ($id_usuario === false) {
    http_response_code(400);
    exit('Parámetro id_usuario inválido.');
}

$lectura = new lectura();
$lectura->id_usuario = $id_usuario;
$lectura->guardar_registro();
?>