<?php

require_once('modeloBd.php');

class modeloPaquetes
{
    public static function alta($gmailCliente, $fechaLlegada, $horaLlegada, $num, $calle, $localidad, $departamento)
    {
        $fechaLlegada = $fechaLlegada . " " . $horaLlegada;
        $conn = modeloBd::conexion();
        do {
            $idRastreo = "";
            for ($i = 0; $i < 16; $i++) {
                $idRastreo .= mt_rand(0, 9);
            }
        } while (self::rastreo($idRastreo) != NULL);
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
        $query = "SELECT * FROM paquetes WHERE numBulto NOT IN (SELECT numBulto FROM lotean);";
        $result = $conn->execute_query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }

    public static function listadoYendoQc()
    {
        $conn = modeloBd::conexion();
        $query = "SELECT numBulto FROM lotean JOIN llevan WHERE "; //agregar condicion de no asignacion a otro lote
        $result = $conn->execute_query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }
    public static function listadoEnQc()
    {
        $conn = modeloBd::conexion();
        $query = "SELECT numBulto FROM () WHERE )"; //agregar condicion de no asignacion a otro lote
        $result = $conn->execute_query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }

    public static function muestra($numBulto)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM paquetes WHERE numBulto = ?";
        $exc = $conn->execute_query($query, [$numBulto]);
        $result = $exc->fetch_array(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }

    public static function rastreo($idRastreo)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM paquetes WHERE idRastreo = ?";
        $exc = $conn->execute_query($query, [$idRastreo]);
        $result = $exc->fetch_array(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
    }

    public static function existe($tipoId, $id)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT numBulto FROM paquetes WHERE $tipoId = ?";
        $exc = $conn->execute_query($query, [$id]);
        $num = mysqli_num_rows($exc);
        $conn->close();
        return json_encode($num);
    }

    public static function muestraEstado($tipoId, $id)
    {
        $conn = modeloBd::conexion();
        if ($tipoId == 'idRastreo') {
            $queryId = "SELECT numBulto FROM paquetes WHERE $tipoId = ?";
            $excId = $conn->execute_query($queryId, [$id]);
            $fetch = $excId->fetch_array(MYSQLI_ASSOC);
            $id = $fetch['numBulto'];
        }
        $queryExt = "SELECT * FROM paquetes WHERE numBulto NOT IN (SELECT numBulto FROM lotean) AND numBulto = ? LIMIT 1;";
        $excExt = $conn->execute_query($queryExt, [$id]);
        if (mysqli_num_rows($excExt)) {
            $estado = 'Aun no ha llegado a nuestra central';
        } else {
            $query = "";
        }
        $conn->close();
        return json_encode($estado);
    }
}
