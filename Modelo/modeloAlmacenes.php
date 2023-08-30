<?php

class modeloAlmacenes
{

    public static function alta($id, $ubicacion, $desc, $conn)
    {
        $query = "INSERT INTO almacenes VALUES (?, ?, ?)";
        $conn->execute_query($query, [$id, $ubicacion, $desc]);
    }

    public static function modificacion($ci, $nombre, $contrasenia, $conn)
    {
        $query = "UPDATE usuarios SET nombre = '$nombre' WHERE ci = '$ci'";
        $conn->execute_query($query, [$nombre, $ci]);
        $query = "UPDATE logins SET contrasenia = '$contrasenia' WHERE ci = '$ci'";
        $conn->execute_query($query, [$contrasenia, $ci]);
    }

    public static function baja($ci, $conn)
    {
        $query = "DELETE FROM usuarios WHERE ci = ?";
        $conn->execute_query($query, [$ci]);
    }

    public static function listado($conn)
    {
        $query = "SELECT * FROM usuarios";
        $result = $conn->execute_query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($result);
    }
}
