<?php

require_once('modeloBd.php');

class modeloAlmacenesRutas
{
        public static function alta($numRuta, $idAlmacen)
        {
                $conn = modeloBd::conexion();
                $query = "INSERT INTO almacen_rutas (numRuta, idAlmacen) VALUES (?, ?);";
                $conn->execute_query($query, [$numRuta, $idAlmacen]);
                $conn->close();
        }

        public static function baja($numRuta, $idAlmacen)
        {
                $conn = modeloBd::conexion();
                $query = "DELETE FROM almacen_rutas WHERE numRuta = ? AND idAlmacen ?";
                $conn->execute_query($query, [$numRuta, $idAlmacen]);
                $conn->close();
        }

        public static function listado()
        {
                $conn = modeloBd::conexion();
                $query = "SELECT * FROM almacen_rutas";
                $result = $conn->execute_query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }

        public static function muestraRutaDeAlmacen($idAlmacen)
        {
                $conn = modeloBd::conexion();
                $query = "SELECT numRuta FROM almacen_rutas WHERE idAlmacen = ?";
                $result = $conn->execute_query($query, [$idAlmacen]);
                $result = $result->fetch_array(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }
}
