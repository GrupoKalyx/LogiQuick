<?php
session_start();
require '../../dbconection.php';
mysqli_set_charset($conn, "utf8");

$numBulto = $_POST['numBulto'];
$sql = "DELETE FROM paquetes WHERE numBulto = $numBulto";

if ($conn->query($sql) === TRUE) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/Projectov4/backoffice/IndexAdministrator.php");
} else {
  echo "<script>alert('error, usuario no encotrado u otro error !');window.location='indexAdministrator.php' </script>";
}
?>