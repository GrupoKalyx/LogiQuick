<?php

require_once('modeloBd.php');

class modeloVan
{
        public static function alta($idLote, $idAlmacen)
        {
                $conn = modeloBd::conexion();
                $query = "INSERT INTO van (idLote, idAlmacen) VALUES (?, ?);";
                $conn->execute_query($query, [$idLote, $idAlmacen]);
                $conn->close();
        }

        public static function baja($idLote, $idAlmacen)
        {
                $conn = modeloBd::conexion();
                $query = "DELETE FROM van WHERE idLote = ? AND idAlmacen ?";
                $conn->execute_query($query, [$idLote, $idAlmacen]);
                $conn->close();
        }

        public static function listado()
        {
                $conn = modeloBd::conexion();
                $query = "SELECT * FROM van";
                $result = $conn->execute_query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }

        public static function muestraAlmacenDeLote($idLote)
        {
                $conn = modeloBd::conexion();
                $query = "SELECT a.*
                FROM Almacenes a
                JOIN Van v ON a.idAlmacen = v.idAlmacen
                WHERE v.idLote = ?";
                $exc = $conn->execute_query($query, [$idLote]);
                $result = $exc->fetch_array(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }
}
