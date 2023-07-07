<?php
// Conexión a la base de datos 
$server = "localhost";
$user = "root";
$password = "";
$dbname = "logiquickbd";

$conn = new mysqli($server, $user, $password, $dbname);
// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8");

$query = "SELECT * FROM Usuarios WHERE TipoDeUsuario ='Almacen' or TipoDeUsuario = 'Camionero' or TipoDeUsuario = 'Externo'";
$result = mysqli_query($conn, $query);
$arrayConsulta = array();

foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
    $user = $row['Username'];
    $password = $row['Password'];
    $acounttype = $row['TipoDeUsuario'];
    array_push($arrayConsulta, ['Usuario: ' => $user, '<br> password: ' => $password, '<br> type: ' => $acounttype . '<br><br>']);
}

foreach ($arrayConsulta as $value) {
    foreach ($value as $key => $v) {
        echo "<a class='form__viewContent'> " . $key . " " . $v . "</a>";
    }
}
?>