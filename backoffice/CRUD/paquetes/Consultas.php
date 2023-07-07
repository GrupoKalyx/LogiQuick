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

$query = "SELECT * FROM paquetes";
$result = mysqli_query($conn, $query);
$arrayConsulta = array();

foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
    $num = $row['numBulto'];
    $vol = $row['volumen'];
    $est = $row['estado'];
    $correo = $row['gmailCliente'];
    $idr = $row['idRastreo'];
    array_push($arrayConsulta, ['Numero de bulto : ' => $num, '<br> volmen: ' => $vol, '<br> estado: ' => $est , '<br> correo del cliente: ' => $correo, '<br> N de Seguimiento: ' => $idr .'<br><br>']);
}

foreach ($arrayConsulta as $value) {
    foreach ($value as $key => $v) {
        echo "<a class='form__viewContent'> " . $key . " " . $v . "</a>";
    }
}
?>