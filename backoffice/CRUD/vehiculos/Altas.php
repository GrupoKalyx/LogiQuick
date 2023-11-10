<?php
require_once('../../sql/dbconection.php');

$matricula = $_POST['matricula'];
$disponibilidad = 'enAlmacen';
$tipo = $_POST['tipo'];

if ($tipo == 'camion') {
  $queryVehic = "INSERT INTO vehiculos VALUES (?, ?)";
  $excVehic = $conn->execute_query($queryVehic, [$matricula, $disponibilidad]);
  $queryCam = "INSERT INTO camiones VALUES (?, ?)";
  $excCam = $conn->execute_query($queryCam, [$matricula, $disponibilidad]);
  $exc = ($excVehic and $excCam);
} else if ($tipo == 'pickup') {
  $queryVehic = "INSERT INTO vehiculos VALUES (?, ?)";
  $excVehic = $conn->execute_query($queryVehic, [$matricula, $disponibilidad]);
  $queryPick = "INSERT INTO pickups VALUES (?, ?)";
  $excPick = $conn->execute_query($queryPick, [$matricula, $disponibilidad]);
  $exc = ($excVehic and $excPick);
}

if ($exc) {
  echo "<script>alert('Vehiculo ingresado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}
