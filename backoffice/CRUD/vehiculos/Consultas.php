<?php
require_once('../../sql/dbconection.php');

$query = "SELECT * FROM camiones";
$result = $conn->execute_query($query);

$arrayCamiones = array();

foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
    $matricula = $row['matricula'];
    $disponibilidad = $row['disponibilidad'];
    array_push($arrayCamiones
, ['Matricula: ' => $matricula, '<br> Disponibilidad: ' => $disponibilidad . '<br><br>']);
}

echo "<h3>Camiones:</h3>";
foreach ($arrayCamiones as $value) {
    foreach ($value as $key => $v) {
        echo "<a class='form__viewContent'> " . $key . " " . $v . "</a>";
    }
}

$query = "SELECT * FROM pickups";
$result = $conn->execute_query($query);

$arrayPickups = array();

foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
    $matricula = $row['matricula'];
    $disponibilidad = $row['disponibilidad'];
    array_push($arrayPickups
, ['Matricula: ' => $matricula, '<br> Disponibilidad: ' => $disponibilidad . '<br><br>']);
}

echo "<h3>Pickups:</h3>";
foreach ($arrayPickups as $value) {
    foreach ($value as $key => $v) {
        echo "<a class='form__viewContent'> " . $key . " " . $v . "</a>";
    }
}