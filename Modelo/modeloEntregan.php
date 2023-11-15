<?php

require_once('modeloBd.php');

class modeloentregan
{
        public static function alta($numBulto, $matricula)
        {
                
                $conn = modeloBd::conexion();
                $bindArray = array();
                $values = array();
                foreach ($numBulto as $paquete) {
                        array_push($bindArray, $paquete);
                        array_push($bindArray, $matricula);
                        array_push($values, "(?, ?)");
                }
                $impValues = implode(", ", $values);
                $query = "INSERT INTO entregan (numBulto, matricula) VALUES " . $impValues;
                echo $query;
                $success = $conn->execute_query($query, $bindArray);
                $conn->close();
                return $success;
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

        public static function MarcarSalida($numBulto)
        {
            $conn = modeloBd::conexion();
            $fechaSalida = date("Y-m-d H:i:s");
            $query = "UPDATE entregan SET fecha_salida = '$fechaSalida' WHERE numBulto = ? 
            /* AND fecha_salida IS NOT NULL */
            ";
            $conn->execute_query($query, [$numBulto]);
            var_dump($numBulto);
            $conn->close();   
        }

        public static function MarcarLlegada($numBulto)
        {
            $conn = modeloBd::conexion();
            $fechaLlegada = date("Y-m-d H:i:s");
        
            // Actualizar 'entregan'
            $queryEntregan = "UPDATE entregan SET fecha_llegada = '$fechaLlegada' WHERE numBulto = ?";
            $successEntregan = $conn->execute_query($queryEntregan, [$numBulto]);
        
            var_dump($numBulto);
        
            // Si la primera actualización fue exitosa, actualizar 'paquetes'
            if ($successEntregan) {
                $queryPaquetes = "UPDATE paquetes SET fechaEntrega = '$fechaLlegada' WHERE numBulto = ?";
                $conn->execute_query($queryPaquetes, [$numBulto]);
            }
        
            $conn->close();
        }
        
}
