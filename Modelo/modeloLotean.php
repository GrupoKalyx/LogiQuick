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

        public static function modificacion($idLote, $numBulto)
        {
                $query = "UPDATE paquetes SET gmailCliente = ? AND fechaLlegada = ? AND num = ? AND calle = ? AND localidad = ? AND departamento = ? WHERE numBulto = ?";
                $conn->execute_query($query, [$gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento, $numBulto]);
        }

        public static function baja($ci, $conn)
        {
                $query = "DELETE FROM usuarios WHERE ci = ?";
                $conn->execute_query($query, [$ci]);
        }

        public static function listado($conn)
        {
                $query = "SELECT * FROM almacenes";
                $result = $conn->execute_query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                return json_encode($result);
        }

        public static function existe($numBulto, $conn)
        {
                $query = "SELECT * FROM paquetes WHERE numBulto = ?";
                $result = $conn->execute_query($query, [$numBulto]);
                $num = mysqli_num_rows($result);
                return $num;
        }
}
