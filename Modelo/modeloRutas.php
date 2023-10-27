<?php
require_once 'modeloBd.php';

class modeloRutas
{

        public static function alta($numRuta, $departamentos)
        {
                $conn = modeloBd::conexion();
                $stringDep = $departamentos[0];
                foreach ($departamentos as $dep => $nombreDep) {
                        if ($dep != 0) {
                                $stringDep .= ", " . $nombreDep;
                        }
                }
                $query = "INSERT INTO rutas (numRuta, departamentos) VALUES (?, ?)";
                $conn->execute_query($query, [$numRuta, $stringDep]);
                $conn->close();
        }

        public static function baja($numRuta)
        {
                $conn = modeloBd::conexion();
                $query = "DELETE FROM rutas WHERE numRuta = ?";
                $conn->execute_query($query, [$numRuta]);
                $conn->close();
        }

        public static function listado()
        {
                $conn = modeloBd::conexion();
                $query = "SELECT * FROM rutas";
                $exc = $conn->execute_query($query);
                $result = $exc->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }

        public static function modificacion($numRuta, $departamentos)
        {
                $conn = modeloBd::conexion();
                $stringDep = $departamentos[0];
                foreach ($departamentos as $dep => $nombreDep) {
                        if ($dep != 0) {
                                $stringDep .= ", " . $nombreDep;
                        }
                }
                $query = "UPDATE rutas SET departamentos = ? WHERE numRuta = ?";
                $conn->execute_query($query, [$stringDep, $numRuta]);
                $conn->close();
        }
}
