<?php
session_start();
require '../../../sql/dbconection.php';
mysqli_set_charset($conn, "utf8");

$numBulto = $_POST['numBulto'];
$sql = "DELETE FROM paquetes WHERE numBulto = $numBulto";

if ($conn->query($sql) === TRUE) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/LogiQuick/backoffice/IndexAdministrator.php");
} else {
  echo "<script>alert('Usuario no existente.');window.location='indexAdministrator.php' </script>";
}
