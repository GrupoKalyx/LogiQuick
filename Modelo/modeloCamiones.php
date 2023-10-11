<?php

require_once('modeloBd.php');

class modeloLotes
{
    public static function alta()
    {
        $conn = modeloBd::conexion();
        $query = "INSERT INTO lotes VALUES ();";
        $conn->execute_query($query);
        $queryLastId = "SELECT LAST_INSERT_ID();";
        $excLastId = $conn->execute_query($queryLastId);
        $fetch = $excLastId->fetch_array(MYSQLI_ASSOC);
        $result = $fetch['LAST_INSERT_ID()'];
        $conn->close();
        return json_encode($result);
    }

    public static function baja($idLote)
    {
        $conn = modeloBd::conexion();
        $query = "DELETE FROM lotes WHERE idLote = ?";
        $conn->execute_query($query, [$idLote]);
        $conn->close();
    }

    public static function listado()
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM  lotes";
        $result = $conn->execute_query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }

    public static function modificacion()
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM  lotes";
        $result = $conn->execute_query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }
}
