<?php
require_once('../../sql/dbconection.php');

$idRastreo = '';
for ($i = 0; $i < 10; $i++) {
    $idRastreo .= mt_rand(0, 9);
}
$numBulto = $_POST['numBulto'];
$estado = $_POST['estado'];
$correo = $_POST['correo'];

$query = "INSERT INTO paquetes VALUES (?, ?, ?, ?)";
$exc = $conn->execute_query($query, [$numBulto, $estado, $correo, $idRastreo]);

if ($exc === true) {
    echo "<script>alert('Cliente actualizado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
    echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}