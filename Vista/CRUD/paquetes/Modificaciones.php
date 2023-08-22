<?php
session_start();
require '../../dbconection.php';
mysqli_set_charset($conn, "utf8");

$numBulto = $_POST['numBulto'];
// $volumen = $_POST['vol'];
$nuevoEstado = $_POST['estado'];
$nuevoCorreo = $_POST['correo'];

$sql = "UPDATE paquetes SET /*volumen = '$volumen' , */estado = '$nuevoEstado' , gmailCliente = '$nuevoCorreo' WHERE numBulto = '$numBulto'";

if ($conn->query($sql)) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/LogiQuick/backoffice/indexAdministrator.php");
}
