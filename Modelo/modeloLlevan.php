<?php

require_once('modeloBd.php');

class modeloLlevan
{
        public static function alta($matricula, $idLote, $idAlmacen, $numRuta)
        {
                $conn = modeloBd::conexion();
                $query = "INSERT INTO llevan (matricula, idLote, idAlmacen, numRuta) VALUES (?, ?, ?, ?);";
                $conn->execute_query($query, [$matricula, $idLote, $idAlmacen, $numRuta]);
                $conn->close();
        }

        public static function baja($matricula, $idLote, $idAlmacen, $numRuta)
        {
                $conn = modeloBd::conexion();
                $query = "DELETE FROM llevan WHERE matricula = $matricula AND idLote = $idLote AND idAlmacen = $idAlmacen AND numRuta = $numRuta";
                $conn->execute_query($query, [$matricula, $idLote, $idAlmacen, $numRuta]);
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

//         public static function LoteDeConductor($ci)
// //         {
// //                 $conn = modeloBd::conexion();
// //                 $query = "SELECT * FROM llevan ll JOIN conducen c ON ll.matricula = c.matricula WHERE c.ci = ? AND ll.fecha_salida IS NULL;";
// //                 $exc = $conn->execute_query($query, [$ci]);
// //                 $result = $exc->fetch_all(MYSQLI_ASSOC);
// //                 $conn->close();
// //                 return json_encode($result);
// //         }
        public static function LoteDeConductor($ci)
        {
        $conn = modeloBd::conexion();
        $query = "SELECT l.*
        FROM conductores c
        JOIN conducen con ON c.ci = con.ci
        JOIN llevan lv ON con.matricula = lv.matricula
        JOIN lotes l ON lv.idLote = l.idLote
        WHERE c.ci = ?;
        ";
        $exc = $conn->execute_query($query, [$ci]);
        $result = $exc->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return json_encode($result);
        
        }


        public static function MarcarSalida($idLote)
        {
            $conn = modeloBd::conexion();
            $fechaSalida = date("Y-m-d H:i:s");
            $query = "UPDATE llevan SET fecha_salida = '$fechaSalida' WHERE idLote = ?";
            $conn->execute_query($query, [$idLote]);
            var_dump($idLote);
            $conn->close();   
        }
        


}