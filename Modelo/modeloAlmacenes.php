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
        $query = "UPDATE almacenes SET ubiAlmacen = ? AND calle = ? AND departamento = ? AND localidad = ? AND N_puerta = ? WHERE idAlmacen = ?";
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
        FROM almacenes a
        JOIN llevan lv ON a.idAlmacen = lv.idAlmacen
        JOIN lotes_almacen_rutas lar ON lv.idLote = lar.idLote AND lv.idAlmacen = lar.idAlmacen AND lv.numRuta = lar.numRuta
        JOIN lotean l ON lar.idLote = l.idLote
        JOIN paquetes p ON l.numBulto = p.numBulto
        WHERE p.idRastreo = ? 
        ORDER BY lv.fecha_llegada DESC
        LIMIT 1; ";

        $exc = $conn->execute_query($query, [$idRastreo]);
        $result = $exc->fetch_array(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }

    public static function obtenerDetallesAlmacen($idLote)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT a.*
        FROM almacenes a
        JOIN lotes_almacen_rutas lar ON a.idAlmacen = lar.idAlmacen
        WHERE lar.idLote = ?;";
        $exc = $conn->execute_query($query, [$idLote]);
        $result = $exc->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }

    public static function obtenerAlmacenAsociadoRuta($idAlmacen, $numRuta)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * 
        FROM almacenes AS a
        JOIN Almacen_Rutas AS ar ON a.idAlmacen = ar.idAlmacen
        JOIN Rutas AS r ON ar.numRuta = r.numRuta
        WHERE a.idAlmacen = $idAlmacen AND r.numRuta = $numRuta;";
        $exc = $conn->execute_query($query, [$idAlmacen, $numRuta]);
        $result = $exc->fetch_all(MYSQLI_ASSOC);
        return json_encode($result);
    }

    public static function obtenerAlmacenPorDepartamento($departamento)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM almacenes WHERE departamento = ?";
        $exc = $conn->execute_query($query, [$departamento]);
        $result = $exc->fetch_all(MYSQLI_ASSOC);
        return json_encode($result);
    }
}
