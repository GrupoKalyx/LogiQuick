<?php

require_once('modeloBd.php');

class modeloDeliverys
{

        public static function alta($ci, $nombre, $telefono)
        {
                $conn = modeloBd::conexion();
                $query = "INSERT INTO deliverys (ci, nombre, telefono) VALUES (?, ?, ?);";
                $conn->execute_query($query, [$ci, $nombre, $telefono]);
                $conn->close();
        }

        public static function baja($ci)
        {
                $conn = modeloBd::conexion();
                $query = "DELETE FROM deliverys WHERE ci = ?";
                $conn->execute_query($query, [$ci]);
                $conn->close();
        }

        public static function listado()
        {
                $conn = modeloBd::conexion();
                $query = "SELECT * FROM deliverys";
                $result = $conn->execute_query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }

        public static function modificacion($nombre, $telefono, $ci)
        {
                $conn = modeloBd::conexion();
                $query = "UPDATE deliverys SET nombre = ? AND telefono = ? WHERE ci = ?";
                $conn->execute_query($query, [$nombre, $telefono, $ci]);
                $conn->close();
        }
}
