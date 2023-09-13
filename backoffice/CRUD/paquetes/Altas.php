<?php
require_once('../../sql/dbconection.php');

$numBulto = $_POST['numBulto'];
$gmailCliente = $_POST['gmailCliente'];
$fechaLlegada = $_POST['fechaLlegada'] . " " . $_POST['horaLlegada'] . ":00";
$num = $_POST['num'];
$calle = $_POST['calle'];
$localidad = $_POST['localidad'];
$departamento = $_POST['departamento'];

function existe($idRastreo, $conn){
    $query = "SELECT * FROM paquetes WHERE idRastreo = ?";
    $result = $conn->execute_query($query, [$idRastreo]);
    $num = mysqli_num_rows($result);
    return $num;
}

do {
    $idRastreo = "";
    for ($i = 0; $i < 16; $i++) { $idRastreo .= mt_rand(0, 9); }
} while (existe($idRastreo, $conn));

$query = "INSERT INTO paquetes (numBulto, gmailCliente, idRastreo, fechaLlegada, num, calle, localidad, departamento) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$exc = $conn->execute_query($query, [$numBulto, $gmailCliente, $idRastreo, $fechaLlegada, $num, $calle, $localidad, $departamento]);

if ($exc) {
    echo "<script>alert('Cliente actualizado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
    echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}