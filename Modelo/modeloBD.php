<?php
class modeloBd
{
    private static $server = "127.0.0.1";
    private static $user = "root";
    private static $password = "";
    private static $dbname = "logiquickbd";

    protected $conn;

    protected function __construct()
    {
        $conexion = new mysqli(self::$server, self::$user, self::$password, self::$dbname);
        if ($conexion->connect_error) {
            die("Error en la conexión a la base de datos: " . $conexion->connect_error);
        } else {
            $this->conn = $conexion;
        }
    }
}
