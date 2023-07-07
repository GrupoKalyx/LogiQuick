<?php
session_start();
require '../../dbconection.php';
mysqli_set_charset($conn, "utf8");

$userRecived = $_POST['user']['0'];
$sql = "DELETE FROM usuarios WHERE Username = '$userRecived'";

if ($conn->query($sql) === TRUE) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/LogiQuick/backoffice/IndexAdministrator.php");
} else {
  echo "<script>alert('error, usuario no encotrado u otro error !');window.location='indexAdministrator.php' </script>";
}
?>