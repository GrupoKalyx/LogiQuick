<?php

require_once('modeloBd.php');

class modeloLotes
{
    public static function alta()
    {
        $conn = modeloBd::conexion();
        $query = "INSERT INTO lotes VALUES (); SELECT LAST_INSERT_ID();";
        $exc = $conn->execute_query($query);
        $result = $exc->fetch_array(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }

    public static function modificacion($numBulto, $gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento, $conn)
    {
        $conn = modeloBd::conexion();
        $query = "UPDATE paquetes SET gmailCliente = ? AND fechaLlegada = ? AND num = ? AND calle = ? AND localidad = ? AND departamento = ? WHERE numBulto = ?";
        $conn->execute_query($query, [$gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento, $numBulto]);
        $conn->close();
    }

    public static function baja($ci, $conn)
    {
        $conn = modeloBd::conexion();
        $query = "DELETE FROM usuarios WHERE ci = ?";
        $conn->execute_query($query, [$ci]);
        $conn->close();
    }

    public static function listado($conn)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM almacenes";
        $result = $conn->execute_query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }

    public static function existe($numBulto, $conn)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM paquetes WHERE numBulto = ?";
        $result = $conn->execute_query($query, [$numBulto]);
        $num = mysqli_num_rows($result);
        $conn->close();
        return $num;
    }
}
