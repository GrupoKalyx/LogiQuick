<?php
require_once('../../sql/dbconection.php');

$eliminar = $_POST['eliminacion'];

$query = "DELETE FROM lotes WHERE idLote = ?";
$exc = $conn->execute_query($query, [$eliminar]);
$query2 = "DELETE FROM lotean WHERE idLote = ?";
$exc2 = $conn->execute_query($query2, [$eliminar]);

if ($exc AND $exc2) {
  echo "<script>alert('Lote eliminado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}
?>