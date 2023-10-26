<?php
require_once('../../sql/dbconection.php');

$idAlmacen = $_POST['idAlmacen'];
$num = $_POST['num'];
$calle = $_POST['calle'];
$localidad = $_POST['localidad'];
$departamento = $_POST['departamento'];
$lat = $_POST['ubiAlmacenLat'];
$lng = $_POST['ubiAlmacenLng'];

$query = "INSERT INTO almacenes (idAlmacen, num, calle, localidad, departamento, lat, lng) VALUES (?, ?, ?, ?, ?, ?, ?)";
$exc = $conn->execute_query($query, [$idAlmacen, $num, $calle, $localidad, $departamento, $lat, $lng]);

if ($exc) {
  echo "<script>alert('Almacen ingresado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}