<?php
require_once('../../sql/dbconection.php');

$query = "SELECT * FROM almacenes";
$result = mysqli_query($conn, $query);
$arrayConsulta = array();

foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
    $numAlmacen = $row['numAlmacen'];
    $ubi = $row['ubicacion'];
    $descUbi = $row['descUbi'];
    array_push($arrayConsulta, ['Número: ' => $numAlmacen, '<br> Ubicación: ' => $ubi, '<br> Descripción de ubicación: ' => $descUbi . '<br><br>']);
}

foreach ($arrayConsulta as $value) {
    foreach ($value as $key => $v) {
        echo "<a class='form__viewContent'> " . $key . " " . $v . " </a>";
    }
}
