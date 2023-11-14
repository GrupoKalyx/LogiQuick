<?php

require_once('modeloBd.php');

class modeloConducen
{
        public static function alta($matricula, $ci)
        {
                $conn = modeloBd::conexion();
                $query = "INSERT INTO `conducen` (`matricula`, `fecha_llegada`, `fecha_salida`, `ci`) VALUES (?, NULL, NULL, ?);";
                $conn->execute_query($query, [$matricula, $ci]);
                $conn->close();
        }

        public static function baja($matricula, $ci)
        {
                $conn = modeloBd::conexion();
                $query = "DELETE FROM conducen WHERE matricula = ? AND ci = ?";
                $conn->execute_query($query, [$ci, $matricula]);
                $conn->close();
        }

        public static function listado()
        {
                $conn = modeloBd::conexion();
                $query = "SELECT * FROM conducen";
                $result = $conn->execute_query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }

        public static function muestraCamion($ci)
        {
                $conn = modeloBd::conexion();
                $query = "SELECT c.*
                FROM camiones c JOIN conducen m
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
                FROM camioneros c JOIN conducen m
                ON c.matricula = m.matricula
                WHERE c.matricula = ?";
                $exc = $conn->execute_query($query, [$matricula]);
                $result = $exc->fetch_array(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }
}
