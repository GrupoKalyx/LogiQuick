<?php
session_start();
require '../../dbconection.php';

mysqli_set_charset($conn, "utf8");
$lote = $_POST['numLote'];
$paquete = $_POST['paquete'];
$estado = $_POST['estado'];


$sql2 = "UPDATE lotes SET numLote = $lote , estado = '$estado' , idPaquete = $paquete WHERE numLote =$lote";
$sql = "INSERT INTO lotes VALUES ($lote , '$estado' , $paquete)";

if ($conn->query($sql) || $conn->query($sql2)) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/LogiQuick/backoffice/indexAdministrator.php");
}


?>