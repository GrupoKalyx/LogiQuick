<?php

require_once('modeloBd.php');

class modeloLlevan
{
        public static function alta($matricula, $idLote, $numBulto)
        {
                $conn = modeloBd::conexion();
                $queryValues = array();
                $bindParams = array();
                foreach ($numBulto as $key => $value) {
                        array_push($queryValues,  '(?, ?, ?)');
                        array_push($bindParams, $matricula);
                        array_push($bindParams, $idLote);
                        array_push($bindParams, $value);
                        echo $value;
                }
                $queryValues = implode(', ', $queryValues);
                $query = "INSERT INTO llevan (matricula, idLote, numBulto) VALUES " . $queryValues;
                $conn->execute_query($query, $bindParams);
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


        public static function LoteDeConductor($ci)
        {
            $conn = modeloBd::conexion();
            $query = "SELECT l.idLote, lr.idAlmacen, lr.numRuta, lr.fecha_salida, lr.fecha_llegada
                      FROM llevan lr
                      JOIN camioneros c ON lr.matricula = c.ci
                      JOIN lotes_almacen_rutas l ON lr.idLote = l.idLote AND lr.idAlmacen = l.idAlmacen AND lr.numRuta = l.numRuta
                      WHERE c.ci = ?";
        
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $ci); // Cambiado "i" por "s" para CI (que generalmente es un string)
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            $conn->close();
            return json_encode($result);
        }
        

    // Otras funciones del modelo...

}
