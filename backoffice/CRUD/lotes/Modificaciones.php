<?php
session_start();
require '../../dbconection.php';
mysqli_set_charset($conn, "utf8");
$numLote = $_POST['numeroLote'];
$estadoAct = $_POST['estadoAct'];


$sql = "UPDATE lotes SET estado = '$estadoAct' WHERE numLote = $numLote";

if ($conn->query($sql)) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/LogiQuick/backoffice/indexAdministrator.php");
}
?>