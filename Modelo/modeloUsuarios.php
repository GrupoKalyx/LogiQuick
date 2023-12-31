<?php
require_once 'modeloBd.php';

class modeloUsuarios
{

    public static function alta($ci, $nombre, $contrasenia, $tipo)
    {
        $conn = modeloBd::conexion();
        $query = "INSERT INTO usuarios (ci, nombre, contrasenia, tipo,) VALUES (?, ?, ?, ?)";
        $conn->execute_query($query, [$ci, $nombre, $contrasenia, $tipo]);
        $conn->close();
    }

    public static function baja($ci)
    {
        $conn = modeloBd::conexion();
        $query = "DELETE FROM usuarios WHERE ci = ?";
        $conn->execute_query($query, [$ci]);
        $conn->close();
    }

    public static function muestra($ci)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM usuarios WHERE ci = ? LIMIT 1";
        $exc = $conn->execute_query($query, [$ci]);
        $fResult = $exc->fetch_array(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($fResult);
    }

    public static function existe($ci)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM `usuarios` WHERE ci = ? LIMIT 1";
        $result = $conn->execute_query($query, [$ci]);
        $num = mysqli_num_rows($result);
        $conn->close();
        return $num;
    }

    public static function listado()
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM usuarios";
        $result = $conn->execute_query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }

    public static function modificacion($ci, $nombre, $contrasenia)
    {
        $conn = modeloBd::conexion();
        $query = "UPDATE usuarios SET nombre = '$nombre' WHERE ci = '$ci'";
        $conn->execute_query($query, [$nombre, $ci]);
        $query = "UPDATE logins SET contrasenia = '$contrasenia' WHERE ci = '$ci'";
        $conn->execute_query($query, [$contrasenia, $ci]);
        $conn->close();
    }
}
