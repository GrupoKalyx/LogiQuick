<?php
require_once('../../sql/dbconection.php');

$numBulto = $_POST['numBulto'];
$query = "DELETE FROM paquetes WHERE numBulto = ?";
$exc = $conn->execute_query($query, [$numBulto]);

if ($exc) {
  echo "<script>alert('Paquete eliminado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}