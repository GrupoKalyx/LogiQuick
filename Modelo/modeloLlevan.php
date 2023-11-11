<?php

require_once('modeloBd.php');

class modeloLlevan
{
        public static function alta($matricula, $idLote, $numBulto, $numRuta)
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

        public static function baja($matricula, $idLote, $numBulto, $numRuta)
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

        public static function LoteDeConductor($ci)
        {
                $conn = modeloBd::conexion();
                $query = "SELECT ll.idLote FROM llevan ll JOIN conducen c ON ll.matricula = c.matricula WHERE c.ci = ? AND ll.fecha_llegada IS NULL;";
                $exc = $conn->execute_query($query, [$ci]);
                $result = $exc->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }
}