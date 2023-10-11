<?php

require_once('modeloBd.php');

class modeloentregan
{
        public static function alta($numBulto, $matricula)
        {
                $conn = modeloBd::conexion();
                $query = "INSERT INTO entregan (matricula, numBulto) VALUES (?, ?);";
                $conn->execute_query($query, [$numBulto, $matricula]);
                $conn->close();
        }

        public static function baja($numBulto, $matricula)
        {
                $conn = modeloBd::conexion();
                $query = "DELETE FROM entregan WHERE matricula = ? AND numBulto = ?";
                $conn->execute_query($query, [$numBulto, $matricula]);
                $conn->close();
        }

        public static function listado()
        {
                $conn = modeloBd::conexion();
                $query = "SELECT * FROM entregan";
                $result = $conn->execute_query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }

        public static function muestraPickup($numBulto)
        {
                $conn = modeloBd::conexion();
                $query = "SELECT pick.*
                FROM pickups pick JOIN entregan e
                ON pick.matricula = e.matricula
                WHERE e.numBulto = ?";
                $exc = $conn->execute_query($query, [$numBulto]);
                $result = $exc->fetch_array(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }

        public static function muestraPaquetes($matricula)
        {
                $conn = modeloBd::conexion();
                $query = "SELECT paq.*
                FROM paquetes paq JOIN entregan e
                ON paq.numBulto = e.numBulto
                WHERE e.matricula = ?";
                $exc = $conn->execute_query($query, [$matricula]);
                $result = $exc->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }
}
