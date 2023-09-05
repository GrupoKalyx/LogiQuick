<?php
require_once('../../sql/dbconection.php');
echo '<link rel="stylesheet" href="../../../estilos/FormStyle2.css">';

$query = "SELECT * FROM almacenes";
$result = mysqli_query($conn, $query);
$arrayConsulta = array();

foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
    $num = $row['idAlmacen'];
    $ubi = $row['ubicacion'];
    $descUbi = $row['descUbi'];
    array_push($arrayConsulta, ['Numero: ' => $num, '<br> Ubicacion: ' => $ubi, '<br> Descprición de ubicación: ' => $descUbi . '<br><br>']);
}

foreach ($arrayConsulta as $value) {
    foreach ($value as $key => $v) {
        echo "<a class='form__viewContent'> " . $key . " " . $v . " </a>";
    }
}
