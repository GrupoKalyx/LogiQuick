<?php
require_once('../../sql/dbconection.php');

$query = "SELECT * FROM almacenes";
$result = mysqli_query($conn, $query);
$arrayConsulta = array();

foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
    $idAlmacen = $row['idAlmacen'];
    $ubiAlmacen = $row['ubiAlmacen'];
    $N_puerta = $row['N_puerta'];
    $calle = $row['calle'];
    $localidad = $row['localidad'];
    $departamento = $row['departamento'];
    array_push($arrayConsulta, ['Id de almacen: ' => $idAlmacen, '<br> Ubicación: ' => $ubiAlmacen, '<br> N_puerta: ' => $N_puerta, '<br> Calle: ' => $calle, '<br> Localidad: ' => $localidad, '<br> Departamento: ' => $departamento . '<br><br>']);
}

foreach ($arrayConsulta as $value) {
    foreach ($value as $key => $v) {
        echo "<a class='form__viewContent'> " . $key . " " . $v . " </a>";
    }
}
