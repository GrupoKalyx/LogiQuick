<?php
require_once('../../sql/dbconection.php');

$numeroLote = $_POST['numeroLote'];
$numBulto = $_POST['numBulto'];
$numNuevoPaquete = $_POST['numNuevoPaquete'];

$query = "DELETE FROM lotean WHERE idLote = ? AND numBulto = ?)";
$exc = $conn->execute_query($query, [$numeroLote, $numBulto]);
$query2 = "INSERT INTO lotean (idLote, numBulto) VALUES (?, ?)";
$exc2 = $conn->execute_query($query2, [$numeroLote, $numNuevoPaquete]);
$conn->close();

if ($exc and $exc2) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/LogiQuick/backoffice/indexAdministrator.php");
}
?>