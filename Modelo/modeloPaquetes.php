<?php

class modeloPaquetes
{

    public static function alta($numBulto, $gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento, $conn)
    {
        do {
            $idRastreo = "";
            for ($i = 0; $i < 16; $i++) { $idRastreo .= mt_rand(0, 9); }
        } while (self::existe($idRastreo, $conn));
        $query = "INSERT INTO paquetes(numBulto, gmailCliente, idRastreo, fechaLlegada, num, calle, localidad, departamento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?))";
        $conn->execute_query($query, [$numBulto, $gmailCliente, $idRastreo, $fechaLlegada, $num, $calle, $localidad, $departamento]);
    }

    public static function modificacion($numBulto, $gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento, $conn)
    {
        $query = "UPDATE paquetes SET ubicacion = '$ubicacion' AND descUbi = '$desc' WHERE id = '$id'";
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

    public static function existe($idRastreo, $conn){
        $query = "SELECT * FROM paquetes WHERE idRastreo = ?";
        $result = $conn->execute_query($query, [$idRastreo]);
        $num =
        return $num
    }
}
