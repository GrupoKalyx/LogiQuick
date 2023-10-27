<?php
require_once('../../sql/dbconection.php');

$numRuta = $_POST['numRuta'];
$query = "DELETE FROM rutas WHERE numRuta = ?";
$exc = $conn->execute_query($query, [$numRuta]);
$conn->close();

if ($exc) {
  echo "<script>alert('Almacen eliminado con éxito.');window.location='../../indexAdmin.php' </script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php' </script>";
}
?>