<?php
session_start();
require '../../dbconection.php';
mysqli_set_charset($conn, "utf8");

$userRecived = $_POST['user']['0'];
$passwordRecived = $_POST['user']['1'];
$typeRecibed = $_POST['user']['2'];
$sql = "INSERT INTO usuarios VALUES ('$userRecived' , '$passwordRecived' , '$typeRecibed' )";

if ($conn->query($sql)) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/LogiQuick/backoffice/indexAdministrator.php");
}
?>