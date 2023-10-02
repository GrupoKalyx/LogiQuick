<?php

require_once('modeloBd.php');

class modeloLotean
{

        public static function alta($idLote, $paquetes)
        {
                $conn = modeloBd::conexion();
                $bindString = array();
                $values = array();
                foreach ($paquetes as $paquete) {
                        $bindString .= $paquete . " ," . $idLote;
                        $values .= "(?, ?)";
                }
                $impValues = implode(" ", $values);
                $impString = implode(", ", $bindString);
                $query = "INSERT INTO lotean (numBulto, idLote) VALUES " . $impValues;
                $exc = $conn->execute_query($query, [$impString]);
                $result = $exc->fetch_array(MYSQLI_ASSOC);
                $conn->close();
                return $result;
        }

        public static function modificacion($numBulto, $idLote)
        {
                $conn = modeloBd::conexion();
                $query = "";
                $conn->execute_query($query, []);
                $conn->close();
        }

        public static function baja($ci)
        {
                $conn = modeloBd::conexion();
                $query = "DELETE FROM usuarios WHERE ci = ?";
                $conn->execute_query($query, [$ci]);
                $conn->close();
        }

        public static function listado()
        {
                $conn = modeloBd::conexion();
                $query = "SELECT * FROM almacenes";
                $result = $conn->execute_query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return json_encode($result);
        }

        public static function existe($numBulto)
        {
                $conn = modeloBd::conexion();
                $query = "SELECT * FROM paquetes WHERE numBulto = ?";
                $result = $conn->execute_query($query, [$numBulto]);
                $num = mysqli_num_rows($result);
                $conn->close();
                return $num;
        }
}
