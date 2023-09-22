<?php
require_once('../../sql/dbconection.php');

$conn = new mysqli($server, $user, $password, $dbname);
// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8");

$query = "SELECT * FROM lotes";
$result = $conn->execute_query($query);
$arrayConsulta = array();

foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
    $num = $row['id_Lote'];
    array_push($arrayConsulta, ['Lote actual  : ' => $num . '<br>']);
    $queryLotean = "SELECT * FROM lotean WHERE id_Lote = ?";
    $excLotean = $conn->execute_query($queryLotean, [$num]);
    foreach ($excLotean->fetch_all(MYSQLI_ASSOC) as $row) {
        $num = $row['id_Paquete'];
        array_push($arrayConsulta, [' Paquete : ' => $paquete. '<br>']);
    }
}

foreach ($arrayConsulta as $value) {
    foreach ($value as $key => $v) {
        echo "<a class='form__viewContent'> " . $key . " " . $v . "</a>";
    }
}
?>