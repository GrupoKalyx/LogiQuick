<?php
class modeloBd
{
    static $server = "127.0.0.1";
    static $user = "root";
    static $password = "";
    static $dbname = "logiquickbd";

    public static function conexion()
    {
        $conn = new mysqli(self::$server, self::$user, self::$password, self::$dbname);
        return $conn;
    }
}