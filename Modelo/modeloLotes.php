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
        $query = "SELECT * FROM lotes";
        $result = $conn->execute_query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }

    public static function listadoEnQc()
    {
        $conn = modeloBd::conexion();
        $query = "SELECT DISTINCT * FROM llevan lv WHERE lv.idAlmacen = 0 AND lv.fecha_llegada IS NOT NULL;";
        $result = $conn->execute_query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }

    public static function listadoExterno()
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM lotes WHERE idLote NOT IN (SELECT idLote FROM llevan);";
        $result = $conn->execute_query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }
    
    public static function existe($idLote)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM lotes WHERE idLote = ?";
        $result = $conn->execute_query($query, [$idLote]);
        $num = mysqli_num_rows($result);
        $conn->close();
        return $num;
    }

    public static function paquetesAsociados($idLote)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT *
        FROM Paquetes
        JOIN Lotean ON Paquetes.numBulto = Lotean.numBulto
        WHERE Lotean.idLote = ?;";
        $exc = $conn->execute_query($query, [$idLote]);
        $result = $exc->fetch_array(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }
}
