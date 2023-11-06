<?php

require_once('modeloBd.php');

class modeloLotean
{

        public static function alta($idLote, $paquetes)
        {
                $conn = modeloBd::conexion();
                $bindArray = array();
                $values = array();
                foreach ($paquetes as $paquete) {
                        array_push($bindArray, $paquete);
                        array_push($bindArray, $idLote);
                        array_push($values, "(?, ?)");
                }
                $impValues = implode(", ", $values);
                $query = "INSERT INTO lotean (numBulto, idLote) VALUES " . $impValues;
                $conn->execute_query($query, $bindArray);
                $conn->close();
        }

        public static function modificacion($idLote, $numBulto, $nuevoNumBulto)
        {
                $conn = modeloBd::conexion();
                $query = "DELETE FROM lotean WHERE idLote = ? AND numBulto = ?; INSERT INTO lotes(idLote, numBulto) VALUES (?, ?);";
                $conn->execute_query($query, [$idLote, $numBulto, $idLote, $nuevoNumBulto]);
                $conn->close();
        }

        public static function baja($idLote)
        {
                $conn = modeloBd::conexion();
                $query = "DELETE FROM lotean WHERE idLote = ?";
                $conn->execute_query($query, [$idLote]);
                $conn->close();
        }

        public static function listado()
        {
                $conn = modeloBd::conexion();
                $query = "SELECT * FROM lotean";
                $result = $conn->execute_query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }

        public static function listadoLote($idLote)
        {
                $conn = modeloBd::conexion();
                $query = "SELECT numBulto FROM lotean WHERE idLote = ?";
                $result = $conn->execute_query($query, [$idLote]);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }

        public static function existe($idLote, $numBulto)
        {
                $conn = modeloBd::conexion();
                $query = "SELECT * FROM lotean WHERE idLote = ? AND numBUlto = ?";
                $result = $conn->execute_query($query, [$idLote, $numBulto]);
                $num = mysqli_num_rows($result);
                $conn->close();
                return $num;
        }
}
