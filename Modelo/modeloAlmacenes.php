<?php

class modeloAlmacenes
{

    public static function alta($id, $ubicacion, $desc, $conn)
    {
        $query = "INSERT INTO almacenes VALUES (?, ?, ?)";
        $conn->execute_query($query, [$id, $ubicacion, $desc]);
    }

    public static function modificacion($id, $ubicacion, $desc, $conn)
    {
        $query = "UPDATE usuarios SET ubicacion = '$ubicacion' AND descUbi = '$desc' WHERE id = '$id'";
        $conn->execute_query($query, [$id, $ubicacion, $desc]);
    }

    public static function baja($ci, $conn)
    {
        $query = "DELETE FROM usuarios WHERE ci = ?";
        $conn->execute_query($query, [$ci]);
    }

    public static function listado($conn)
    {
        $query = "SELECT * FROM almacenes";
        $result = $conn->execute_query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($result);
    }
}