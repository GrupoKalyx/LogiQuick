<?php
require_once 'modeloBd.php';

class modeloAlmacenes
{

    public static function alta($idAlmacen, $ubiAlmacen, $calle, $departamento, $localidad, $N_puerta)
    {
        $conn = modeloBd::conexion();
        $query = "INSERT INTO almacenes VALUES (?, ?, ?, ?, ?, ?)";
        $conn->execute_query($query, [$idAlmacen, $ubiAlmacen, $calle, $departamento, $localidad, $N_puerta]);
        $conn->close();
    }

    public static function modificacion($idAlmacen, $ubiAlmacen, $calle, $departamento, $localidad, $N_puerta)
    {
        $conn = modeloBd::conexion();
        $query = "UPDATE usuarios SET ubiAlmacen = ? AND calle = ? AND departamento = ? AND localidad = ? AND N_puerta = ? WHERE id = ?";
        $conn->execute_query($query, [$ubiAlmacen, $calle, $departamento, $localidad, $N_puerta, $idAlmacen]);
        $conn->close();
    }

    public static function baja($idAlmacen)
    {
        $conn = modeloBd::conexion();
        $query = "DELETE FROM almacenes WHERE idAlmacen = ?";
        $conn->execute_query($query, [$idAlmacen]);
        $conn->close();
    }

    public static function listado()
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM almacenes";
        $exc = $conn->execute_query($query);
        $result = $exc->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }

    public static function muestraUltimo($idRastreo)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT a.*
                    FROM Almacenes a
                    JOIN Van v ON a.idAlmacen = v.idAlmacen
                    JOIN Lotean l ON v.idLote = l.idLote
                    JOIN Paquetes p ON l.numBulto = p.numBulto
                    WHERE p.idRastreo = ?;";

        $exc = $conn->execute_query($query, [$idRastreo]);
        $result = $exc->fetch_array(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }
}
