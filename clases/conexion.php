<?php
if (!defined('DB_HOST')) {
    define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
}
if (!defined('DB_USER')) {
    define('DB_USER', getenv('DB_USER') ?: 'root');
}
if (!defined('DB_PASS')) {
    define('DB_PASS', getenv('DB_PASS') ?: '');
}
if (!defined('DB_NAME')) {
    define('DB_NAME', getenv('DB_NAME') ?: 'basededatos');
}

class Conexion extends mysqli
{
    public $enlace;

    public function __construct()
    {
        parent::__construct(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->enlace = $this;

        if ($this->connect_error) {
            error_log('Error de conexión a la BD: ' . $this->connect_error);
            throw new RuntimeException('No se pudo conectar a la base de datos.');
        }
    }

    public function __destruct()
    {
        if ($this->connect_errno === 0) {
            $this->close();
        }
    }
}
