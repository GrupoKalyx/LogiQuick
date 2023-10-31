<?php

require_once('modeloBd.php');

class modeloLotesAlmacenesRutas
{
        public static function alta($idLote, $numRuta, $idAlmacen)
        {
                $conn = modeloBd::conexion();
                $query = "INSERT INTO lotes-almacen-rutas (idLote, numRuta, idAlmacen) VALUES (?, ?, ?);";
                $conn->execute_query($query, [$idLote, $numRuta, $idAlmacen]);
                $conn->close();
        }

        public static function baja($idLote, $numRuta, $idAlmacen)
        {
                $conn = modeloBd::conexion();
                $query = "DELETE FROM lotes-almacen-rutas WHERE numRuta = ? AND idAlmacen = ? AND idLote = ?";
                $conn->execute_query($query, [$idLote, $numRuta, $idAlmacen]);
                $conn->close();
        }

        public static function listado()
        {
                $conn = modeloBd::conexion();
                $query = "SELECT * FROM lotes-almacen-rutas";
                $result = $conn->execute_query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }
}
