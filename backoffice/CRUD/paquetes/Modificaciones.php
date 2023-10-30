<?php
require_once('../../sql/dbconection.php');

$numBulto = $_POST['numBulto'];
$gmailCliente = $_POST['gmailCliente'];

$fechaLlegada = $context['fechaLlegada'];
$horarioLLegada = $context['horarioLLegada'];
$fechaCreacion = $fechaLlegada . ' ' . $horarioLLegada;

$num = $_POST['num'];
$calle = $_POST['calle'];
$localidad = $_POST['localidad'];
$departamento = $_POST['departamento'];
$lat = $_POST['coordenadasLat'];
$lng = $_POST['coordenadasLng'];

$query = "UPDATE paquetes SET gmailCliente = ?, fechaCreacion = ?, num = ?, calle = ?, localidad = ?, departamento = ?, lat = ?, lng = ? WHERE numBulto = ?";
$exc = $conn->execute_query($query, [$gmailCliente, $fechaCreacion, $num, $calle, $localidad, $departamento, $lat, $lng, $numBulto]);
$conn->close();

if ($exc) {
  echo "<script>alert('Paquete actualizado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}