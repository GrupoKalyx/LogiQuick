<?php
require_once('../../sql/dbconection.php');

$numBulto = $_POST['numBulto'];
$gmailCliente = $_POST['gmailCliente'];
$num = $_POST['num'];
$calle = $_POST['calle'];
$localidad = $_POST['localidad'];
$departamento = $_POST['departamento'];

$coordenadas = $_POST['coordModPaquete'];

$query = "UPDATE paquetes SET gmailCliente = ?, num = ?, calle = ?, localidad = ?, departamento = ?, coordenadas = ? WHERE numBulto = ?";
$exc = $conn->execute_query($query, [$gmailCliente, $num, $calle, $localidad, $departamento, $coordenadas, $numBulto]);

if ($exc) {
  echo "<script>alert('Paquete actualizado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}