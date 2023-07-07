<?php
session_start();
require '../../dbconection.php';
mysqli_set_charset($conn, "utf8");

$numRecibida = $_POST['almacen']['0'];
$tipoRecibida = $_POST['almacen']['1'];
$ubicacionRecibida = $_POST['almacen']['2'];
$sql = "INSERT INTO Almacenes VALUES ('$numRecibida' , '$tipoRecibida' , '$ubicacionRecibida')";

if ($conn->query($sql)) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/Projectov4/backoffice/indexAdministrator.php");
}
?>