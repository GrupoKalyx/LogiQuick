<?php
require_once('../../sql/dbconection.php');

$query = "SELECT * FROM rutas";
$result = mysqli_query($conn, $query);
$arrayConsulta = array();

foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
    $numRuta = $row['numRuta'];
    $departamentos = $row['departamentos'];
    array_push($arrayConsulta, ['Id de almacen: ' => $numRuta, '<br> Departamentos: ' => $departamentos . '<br><br>']);
}

foreach ($arrayConsulta as $value) {
    foreach ($value as $key => $v) {
        echo "<a class='form__viewContent'> " . $key . " " . $v . " </a>";
    }
}
