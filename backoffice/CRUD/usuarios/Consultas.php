<?php
require_once('../../sql/dbconection.php');

$query = "SELECT * FROM usuarios INNER JOIN logins WHERE usuarios.ci = logins.idLogin";
$result = $conn->execute_query($query);

$arrayConsulta = array();

foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
    $ci = $row['ci'];
    $nombre = $row['nombre'];
    $contrasenia = $row['contrasenia'];
    $tipo = $row['tipo'];
    if ($tipo == 'Camionero' or $tipo == 'Delivery') {
        $queryTelefono = "SELECT telefono FROM Conductores WHERE ci = ?";
        $exc = $conn->execute_query($queryTelefono, [$ci]);
        $telefono = $exc->fetch_array(MYSQLI_ASSOC);
    } else {
        $telefono = "-";
    }
    array_push($arrayConsulta, ['CI: ' => $ci, '<br> Nombre: ' => $nombre, '<br> Contraseña: ' => $contrasenia, '<br> Tipo: ' => $tipo, '<br> Telefono: ' => $telefono . '<br><br>']);
}

foreach ($arrayConsulta as $value) {
    foreach ($value as $key => $v) {
        echo "<a class='form__viewContent'> " . $key . " " . $v . "</a>";
    }
}