<?php
require_once('../../sql/dbconection.php');

$idAlmacen = $_POST['idAlmacen'];
$ubiAlmacen = $_POST['ubiAlmacen'];
$descUbiAlmacen = $_POST['descUbiAlmacen'];
$query = "INSERT INTO almacenes VALUES (?, ?, ?)";
$exc = $conn->execute_query($query, [$idAlmacen, $ubiAlmacen, $descUbiAlmacen]);

if ($exc) {
  echo "<script>alert('Almacen ingresado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}