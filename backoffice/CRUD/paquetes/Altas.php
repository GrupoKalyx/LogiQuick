<?php
session_start();
require '../../../sql/dbconection.php';

$idRastreo = '';
for ($i = 0; $i < 10; $i++) {
    $idRastreo .= mt_rand(0, 9);
}

mysqli_set_charset($conn, "utf8");
$numBulto = $_POST['numBulto'];
// $volumen = $_POST['vol'];
$estado = $_POST['estado'];
$correo = $_POST['correo'];

//$numeroSeguiminto = $_SESSION['numSeguimiento'];
$sql = "INSERT INTO paquetes VALUES ('$numBulto', '$estado', '$correo', '$idRastreo')";

if ($conn->query($sql) ===  true) {
    echo "<script>alert('Cliente actualizado con éxito.');window.location='IndexAdministrator.php'</script>";
} else {
    echo "<script>alert('Ha ocurrido un error inesperado.');window.location='IndexAdministrator.php'</script>";
}
header("location:http://localhost/LogiQuick/backoffice/indexAdministrator.php");
