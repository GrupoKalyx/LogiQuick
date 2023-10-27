<?php
require_once('../../sql/dbconection.php');

$idAlmacen = $_POST['idAlmacen'];
$query = "DELETE FROM almacenes WHERE idAlmacen = ?";
$exc = $conn->execute_query($query, [$idAlmacen]);
$conn->close();

if ($exc) {
  echo "<script>alert('Almacen eliminado con éxito.');window.location='../../indexAdmin.php' </script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php' </script>";
}
?>