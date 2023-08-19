<?php
session_start();
require '../../dbconection.php';
mysqli_set_charset($conn, "utf8");

$numReceived = $_POST['almacen']['0'];
$tipoReceived = $_POST['almacen']['1'];
$ubicacionReceived = $_POST['almacen']['2'];
$sql = "UPDATE almacenes SET tipoAlmacen = '$tipoReceived', ubicacion = '$ubicacionReceived' WHERE numAlmacen = '$numReceived'";

if ($conn->query($sql)) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/LogiQuick/backoffice/indexAdministrator.php");
}
?>