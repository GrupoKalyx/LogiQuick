<?php

require_once('modeloBd.php');

class modeloCamioneros
{

        public static function alta($ci, $nombre, $telefono)
        {
                $conn = modeloBd::conexion();
                $query = "INSERT INTO camioneros (ci, nombre, telefono) VALUES (?, ?, ?);";
                $conn->execute_query($query, [$ci, $nombre, $telefono]);
                $conn->close();
        }

        public static function baja($ci)
        {
                $conn = modeloBd::conexion();
                $query = "DELETE FROM camioneros WHERE ci = ?";
                $conn->execute_query($query, [$ci]);
                $conn->close();
        }

        public static function listado()
        {
                $conn = modeloBd::conexion();
                $query = "SELECT * FROM camioneros";
                $result = $conn->execute_query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }

        public static function modificacion($nombre, $telefono, $ci)
        {
                $conn = modeloBd::conexion();
                $query = "UPDATE camioneros SET nombre = ? AND telefono = ? WHERE ci = ?";
                $conn->execute_query($query, [$nombre, $telefono, $ci]);
                $conn->close();
        }
}
