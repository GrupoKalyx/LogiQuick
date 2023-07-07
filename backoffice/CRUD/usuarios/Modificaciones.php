<?php
session_start();
require '../../dbconection.php';
mysqli_set_charset($conn, "utf8");

$userRecived = $_POST['user']['0'];
$newuserRecived = $_POST['newUser']['0'];
$passwordRecived = $_POST['newUser']['1'];
$sql = "UPDATE  Usuarios SET  Username = '$newuserRecived' ,  Password = '$passwordRecived'  WHERE Username = '$userRecived'";

if ($conn->query($sql)) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/LogiQuick/backoffice/indexAdministrator.php");
}
?>