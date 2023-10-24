<?php
require_once('../../sql/dbconection.php');

$idAlmacen = $_POST['idAlmacen'];
$num = $_POST['num'];
$calle = $_POST['calle'];
$localidad = $_POST['localidad'];
$departamento = $_POST['departamento'];
$lat = $_POST['ubiAlmacenLat'];
$lng = $_POST['ubiAlmacenLng'];

$query = "UPDATE almacenes SET lat = ?, lng = ?, num = ?, calle = ?, localidad = ?,  departamento = ?  WHERE idAlmacen = ?";
$exc = $conn->execute_query($query, [$lat, $lng, $num, $calle, $localidad, $departamento, $idAlmacen]);

if ($exc) {
  echo "<script>alert('Almacen modificado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}