<?php
require_once('../../sql/dbconection.php');

$idAlmacen = $_POST['idAlmacen'];
$N_puerta = $_POST['N_puerta'];
$calle = $_POST['calle'];
$localidad = $_POST['localidad'];
$departamento = $_POST['departamento'];

// https://maps.googleapis.com/maps/api/geocode/json?place_id=ChIJeRpOeF67j4AR9ydy_PIzPuM&key=YOUR_API_KEY

$ubiAlmacen = "";

$query = "INSERT INTO almacenes (idAlmacen, N_puerta, calle, localidad, departamento, ubiAlmacen) VALUES (?, ?, ?, ?, ?, ?)";
$exc = $conn->execute_query($query, [$idAlmacen, $N_puerta, $calle, $localidad, $departamento, $ubiAlmacen]);

if ($exc) {
  echo "<script>alert('Almacen ingresado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}