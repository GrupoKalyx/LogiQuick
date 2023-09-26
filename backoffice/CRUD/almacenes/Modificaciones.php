<?php
require_once('../../sql/dbconection.php');

$idAlmacen = $_POST['idAlmacen'];
$N_puerta = $_POST['N_puerta'];
$calle = $_POST['calle'];
$localidad = $_POST['localidad'];
$departamento = $_POST['departamento'];

$ubiAlmacen = "";

$query = "UPDATE almacenes SET ubiAlmacen = ?, N_puerta = ?, calle = ?, localidad = ?,  departamento = ?  WHERE idAlmacen = ?";
$exc = $conn->execute_query($query, [$ubiAlmacen, $N_puerta, $calle, $localidad, $departamento, $idAlmacen]);

if ($exc) {
  echo "<script>alert('Almacen modificado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}