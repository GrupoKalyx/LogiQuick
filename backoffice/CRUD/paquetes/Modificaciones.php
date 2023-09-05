<?php
require_once('../../sql/dbconection.php');

$numBulto = $_POST['numBulto'];
// $volumen = $_POST['vol'];
$nuevoEstado = $_POST['estado'];
$nuevoCorreo = $_POST['correo'];

$sql = "UPDATE paquetes SET /*volumen = '$volumen' , */estado = '$nuevoEstado' , gmailCliente = '$nuevoCorreo' WHERE numBulto = '$numBulto'";

if ($conn->query($sql)) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/LogiQuick/backoffice/indexAdministrator.php");
}
