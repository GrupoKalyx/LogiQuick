<?php
require_once('../../sql/dbconection.php');
echo '<link rel="stylesheet" href="../../estilos/FormStyleBackoffice.css">';

$query = "SELECT * FROM usuarios JOIN logins";
$result = $conn->execute_query($query);

$arrayConsulta = array();

foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
    $ci = $row['ci'];
    $nombre = $row['nombre'];
    $contrasenia = $row['contrasenia'];
    $tipo = $row['tipo'];
    array_push($arrayConsulta, ['ID: ' => $ci, '<br> Nombre: ' => $nombre, '<br> Contraseña: ' => $contrasenia, '<br> Tipo: ' => $tipo . '<br><br>']);
}

foreach ($arrayConsulta as $value) {
    foreach ($value as $key => $v) {
        echo "<a class='form__viewContent'> " . $key . " " . $v . "</a>";
    }
}
