<?php

require_once('modeloBd.php');

class modeloPaquetes
{
    public static function alta($gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento)
    {
        $conn = modeloBd::conexion();
        do {
            $idRastreo = "";
            for ($i = 0; $i < 16; $i++) {
                $idRastreo .= mt_rand(0, 9);
            }
        } while (self::existe($idRastreo));
        $query = "INSERT INTO paquetes (gmailCliente, idRastreo, fechaLlegada, num, calle, localidad, departamento) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $conn->execute_query($query, [$gmailCliente, $idRastreo, $fechaLlegada, $num, $calle, $localidad, $departamento]);
        $conn->close();
    }

    public static function modificacion($numBulto, $gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento)
    {
        $conn = modeloBd::conexion();
        $query = "UPDATE paquetes SET gmailCliente = ? AND fechaLlegada = ? AND num = ? AND calle = ? AND localidad = ? AND departamento = ? WHERE numBulto = ?";
        $conn->execute_query($query, [$gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento, $numBulto]);
        $conn->close();
    }

    public static function baja($ci)
    {
        $conn = modeloBd::conexion();
        $query = "DELETE FROM usuarios WHERE ci = ?";
        $conn->execute_query($query, [$ci]);
        $conn->close();
    }

    public static function listado()
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM paquetes";
        $result = $conn->execute_query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }

    public static function listadoSinLote()
    {
        $conn = modeloBd::conexion();
        $query = "SELECT numBulto FROM paquetes"; // deberia ser un left join
        $result = $conn->execute_query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }

    public static function muestra($numBulto)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM almacenes WHERE numBulto = ?";
        $result = $conn->execute_query($query, [$numBulto]);
        $result = $result->fetch_array(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }

    public static function existe($numBulto)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM paquetes WHERE numBulto = ?";
        $result = $conn->execute_query($query, [$numBulto]);
        $num = mysqli_num_rows($result);
        $conn->close();
        return $num;
    }
}