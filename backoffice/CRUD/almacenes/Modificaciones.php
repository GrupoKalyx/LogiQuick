<?php
require_once('../../sql/dbconection.php');

$numAlmacen = $_POST['numAlmacen'];
$ubi = $_POST['ubicacion'];
$descUbi = $_POST['descUbi'];
$query = "UPDATE almacenes SET ubicacion = ?, descUbi = ? WHERE numAlmacen = ?";
$exc = $conn->execute_query($query, [$ubi, $descUbi, $numAlmacen]);

if ($exc) {
  echo "<script>alert('Almacen modificado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}