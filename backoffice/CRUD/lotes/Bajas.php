<?php
session_start();
require '../../dbconection.php';
mysqli_set_charset($conn, "utf8");

$eliminar = $_POST['eliminacion'];

$sql = "DELETE FROM lotes WHERE numLote  = $eliminar";

if ($conn->query($sql) === TRUE) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/LogiQuick/backoffice/IndexAdministrator.php");
} else {
  echo "<script>alert('error !');window.location='indexAdministrator.php' </script>";
}
?>