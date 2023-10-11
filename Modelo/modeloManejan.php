<?php

require_once('modeloBd.php');

class modeloManejan
{
        public static function alta($ci, $matricula)
        {
                $conn = modeloBd::conexion();
                $query = "INSERT INTO manejan (matricula, ci) VALUES (?, ?);";
                $conn->execute_query($query, [$ci, $matricula]);
                $conn->close();
        }

        public static function baja($ci, $matricula)
        {
                $conn = modeloBd::conexion();
                $query = "DELETE FROM manejan WHERE matricula = ? AND ci = ?";
                $conn->execute_query($query, [$ci, $matricula]);
                $conn->close();
        }

        public static function listado()
        {
                $conn = modeloBd::conexion();
                $query = "SELECT * FROM manejan";
                $result = $conn->execute_query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }
        
        public static function muestraDelivery($matricula)
        {
                $conn = modeloBd::conexion();
                $query = "SELECT d.*
                FROM deliverys d JOIN manejan m
                ON d.matricula = m.matricula
                WHERE m.matricula = ?";
                $exc = $conn->execute_query($query, [$matricula]);
                $result = $exc->fetch_array(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }

        public static function muestraPickup($ci)
        {
                $conn = modeloBd::conexion();
                $query = "SELECT p.*
                FROM pickups p JOIN manejan m
                ON p.ci = p.ci 
                WHERE m.ci = ?";
                $exc = $conn->execute_query($query, [$ci]);
                $result = $exc->fetch_array(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }
}
