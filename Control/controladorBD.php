<?php
require '../Modelo/modeloBD.php';
class controladorBD
{
    public static function conectar()
    {
        $conn = dbconection::conexion();
        return $conn;
    }
}
