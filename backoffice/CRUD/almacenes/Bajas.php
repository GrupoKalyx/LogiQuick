<?php
require_once('../../sql/dbconection.php');

$numReceived = $_POST['eliminarAlmacen'];
$sql = "DELETE FROM almacenes WHERE numAlmacen = $numReceived";

if ($conn->query($sql) === TRUE) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/LogiQuick/backoffice/IndexAdministrator.php");
} else {
  echo "<script>alert('error, usuario no encotrado u otro error !');window.location='indexAdministrator.php' </script>";
}
?>