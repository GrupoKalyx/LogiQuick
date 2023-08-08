<?php
class dbconection
{
    private static $server = "127.0.0.1";
    private static $user = "root";
    private static $password = "";
    private static $dbname = "logiquickbd";

    public static function conexion()
    {
        $conn = new mysqli(self::$server, self::$user, self::$password, self::$dbname);
        if ($conn->connect_error) {
            die("Error en la conexión a la base de datos: " . $conn->connect_error);
        } else {
            return json_encode($conn);
        }
    }
}
