<?php
require '../../../sql/dbconection.php';
mysqli_set_charset($conn, "utf8");

$result = mysqli_query($conn, "SELECT * FROM usuarios");
$arrayConsulta = array();

foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
    $ci = $row['ci'];
    $nombreUsuario = $row['nombreUsuario'];
    $contraseniaUsuario = $row['contraseniaUsuario'];
    $tipoUsuario = $row['tipoUsuario'];
    array_push($arrayConsulta, ['ID: ' => $ci, '<br> Nombre: ' => $nombreUsuario, '<br> Contraseña: ' => $contraseniaUsuario, '<br> Tipo: ' => $tipoUsuario . '<br><br>']);
}

foreach ($arrayConsulta as $value) {
    foreach ($value as $key => $v) {
        echo "<a class='form__viewContent'> " . $key . " " . $v . "</a>";
    }
}
