<?php
require_once('../../sql/dbconection.php');

$lote = $_POST['numLote'];
$estado = $_POST['estado'];

$query = "INSERT INTO lotes VALUES (?, ?)";
$exc = $conn->execute_query($query, [$lote, $estado]);

if ($exc === true) {
  echo "<script>alert('Cliente actualizado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}
?>