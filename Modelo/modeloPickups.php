<?php

require_once('modeloBd.php');

class modeloPickups
{
        public static function alta($matricula, $disponibilidad)
        {
                $conn = modeloBd::conexion();
                $query = "INSERT INTO pickups (matricula, disponibilidad) VALUES (?, ?);";
                $conn->execute_query($query, [$matricula, $disponibilidad]);
                $conn->close();
        }

        public static function baja($matricula)
        {
                $conn = modeloBd::conexion();
                $query = "DELETE FROM pickups WHERE matricula = ?";
                $conn->execute_query($query, [$matricula]);
                $conn->close();
        }

        public static function listado()
        {
                $conn = modeloBd::conexion();
                $query = "SELECT * FROM pickups";
                $result = $conn->execute_query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }

        public static function modificacion($disponibilidad, $matricula)
        {
                $conn = modeloBd::conexion();
                $query = "UPDATE pickups SET disponibilidad = ? WHERE matricula = ?";
                $conn->execute_query($query, [$disponibilidad, $matricula]);
                $conn->close();
        }
}
