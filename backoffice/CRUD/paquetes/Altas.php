<?php
require_once('../../sql/dbconection.php');

$gmailCliente = $_POST['gmailCliente'];
$num = $_POST['num'];
$calle = $_POST['calle'];
$localidad = $_POST['localidad'];
$departamento = $_POST['departamento'];
$lat = $_POST['coordenadasLat'];
$lng = $_POST['coordenadasLng'];

function existe($idRastreo, $conn){
    $query = "SELECT * FROM paquetes WHERE idRastreo = ? LIMIT 1";
    $exc = $conn->execute_query($query, [$idRastreo]);
    $num = mysqli_num_rows($exc);
    return $num;
}

do {

    $idRastreo = "";
    for ($i = 0; $i < 9; $i++) { $idRastreo .= mt_rand(0, 9); }
    echo ".";
} while (existe($idRastreo, $conn));


$query2 = "INSERT INTO paquetes (gmailCliente, idRastreo, num, calle, localidad, departamento, lat, lng) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$exc2 = $conn->execute_query($query2, [$gmailCliente, $idRastreo, $num, $calle, $localidad, $departamento, $lat, $lng]);

if ($exc2) {
    echo "<script>alert('Paquete ingresado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
    echo "<script>alert('Ha ocurrido un error inesperado.');";
}