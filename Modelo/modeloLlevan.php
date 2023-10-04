<?php

require_once('modeloBd.php');

class modeloLlevan
{
        public static function alta($matricula, $idLote, $numBulto)
        {
                $conn = modeloBd::conexion();
                $query = "INSERT INTO llevan (matricula, idLote, numBulto) VALUES (?, ?, ?)";
                $conn->execute_query($query, [$matricula, $idLote, $numBulto]);
                $conn->close();
        }

        public static function baja($matricula, $idLote, $numBulto)
        {
                $conn = modeloBd::conexion();
                $query = "DELETE FROM llevan WHERE matricula = $matricula AND idLote = $idLote AND numBulto = $numBulto";
                $conn->execute_query($query, [$matricula, $idLote, $numBulto]);
                $conn->close();
        }

        public static function listado()
        {
                $conn = modeloBd::conexion();
                $query = "SELECT * FROM llevan";
                $result = $conn->execute_query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }

        public static function actualmenteEnLote()
        {
                $conn = modeloBd::conexion();
                $query = "SELECT numBulto FROM llevan WHERE fecha_llegada = NULL";
                $result = $conn->execute_query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }
}
