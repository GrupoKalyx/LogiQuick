<?php
session_start();
require '../../dbconection.php';
mysqli_set_charset($conn, "utf8");

$numBulto = $_POST['numBulto'];
$volumen = $_POST['vol'];
$estado = $_POST['estado'];
$correo = $_POST['correo'];

$sql = "UPDATE paquetes SET volumen = '$volumen' , estado = '$estado' , gmailCliente = '$correo' WHERE numBulto = '$numBulto'";

if ($conn->query($sql)) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/Projectov4/backoffice/indexAdministrator.php");
}
?>