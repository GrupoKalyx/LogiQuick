<?php

class modeloPaquetes
{

    public static function alta($gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento, $conn)
    {
        do {
            $idRastreo = "";
            for ($i = 0; $i < 16; $i++) { $idRastreo .= mt_rand(0, 9); }
        } while (self::existe($idRastreo, $conn));
        $query = "INSERT INTO paquetes (gmailCliente, idRastreo, fechaLlegada, num, calle, localidad, departamento) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $conn->execute_query($query, [$gmailCliente, $idRastreo, $fechaLlegada, $num, $calle, $localidad, $departamento]);
    }

    public static function modificacion($numBulto, $gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento, $conn)
    {
        $query = "UPDATE paquetes SET gmailCliente = ? AND fechaLlegada = ? AND num = ? AND calle = ? AND localidad = ? AND departamento = ? WHERE numBulto = ?";
        $conn->execute_query($query, [$gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento, $numBulto]);
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

    public static function existe($numBulto, $conn){
        $query = "SELECT * FROM paquetes WHERE numBulto = ?";
        $result = $conn->execute_query($query, [$numBulto]);
        $num = mysqli_num_rows($result);
        return $num;
    }
}
