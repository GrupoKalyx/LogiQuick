<?php
require_once('../../sql/dbconection.php');

$numAlmacen = $_POST['numAlmacen'];
$query = "DELETE FROM almacenes WHERE numAlmacen = ?";
$exc = $conn->execute_query($query, [$numAlmacen]);

if ($exc == true) {
  echo "<script>alert('Almacen eliminado con éxito.');window.location='../../indexAdmin.php' </script>";
} else {
  echo "<script>alert('error, usuario no encotrado u otro error !');window.location='indexAdmin.php' </script>";
}
?>