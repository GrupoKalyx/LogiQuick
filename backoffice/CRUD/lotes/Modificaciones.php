<?php
require_once('../../sql/dbconection.php');

$numLote = $_POST['numeroLote'];
$numBulto = $_POST['numBulto'];
$numNuevoPaquete = $_POST['numNuevoPaquete'];

$query = "DELETE FROM lotean WHERE idLote = ? AND numBulto = ?)";
$exc = $conn->execute_query($query, [$idLote, $numBulto]);
$query2 = "INSERT INTO lotean (idLote, numBulto) VALUES (?, ?)";
$exc2 = $conn->execute_query($query2, [$idLote, $numNuevoPaquete]);

if ($exc and $exc2) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/LogiQuick/backoffice/indexAdministrator.php");
}
?>