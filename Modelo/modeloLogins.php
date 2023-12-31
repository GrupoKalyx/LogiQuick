<?php
require_once('modeloBd.php');

class modeloLogins
{
    public static function contrasenia($ci, $contrasenia)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM `usuarios` WHERE ci = ? AND contrasenia = ? LIMIT 1";
        $result = $conn->execute_query($query, [$ci, $contrasenia]);
        $num = $result->num_rows;
        $conn->close();
        return $num;
    }

    public static function tipo($ci)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT tipo FROM `usuarios` WHERE ci = ? LIMIT 1";
        $result = $conn->execute_query($query, [$ci]);
        $fResult =  $result->fetch_array(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($fResult);
    }
}
