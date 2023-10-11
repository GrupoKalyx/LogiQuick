<?php

require_once('modeloBd.php');

class modeloConducen
{
        public static function alta($ci, $matricula)
        {
                $conn = modeloBd::conexion();
                $query = "INSERT INTO Conducen (matricula, ci) VALUES (?, ?);";
                $conn->execute_query($query, [$ci, $matricula]);
                $conn->close();
        }

        public static function baja($ci, $matricula)
        {
                $conn = modeloBd::conexion();
                $query = "DELETE FROM Conducen WHERE matricula = ? AND ci = ?";
                $conn->execute_query($query, [$ci, $matricula]);
                $conn->close();
        }

        public static function listado()
        {
                $conn = modeloBd::conexion();
                $query = "SELECT * FROM Conducen";
                $result = $conn->execute_query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }

        public static function muestraCamion($ci)
        {
                $conn = modeloBd::conexion();
                $query = "SELECT c.*
                FROM camiones c JOIN Conducen m
                ON c.ci = m.ci 
                WHERE c.ci = ?";
                $exc = $conn->execute_query($query, [$ci]);
                $result = $exc->fetch_array(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }

        public static function muestraCamionero($matricula)
        {
                $conn = modeloBd::conexion();
                $query = "SELECT c.*
                FROM camioneros c JOIN Conducen m
                ON c.matricula = m.matricula
                WHERE c.matricula = ?";
                $exc = $conn->execute_query($query, [$matricula]);
                $result = $exc->fetch_array(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }
}
