<?php

require_once('modeloBd.php');

class modeloConducen{



public static function camionAsignado()
{
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM  conducen";
        $result = $conn->execute_query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
}
}

