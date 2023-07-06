<?php
session_start();

require '../dbconection.php';
mysqli_set_charset($conn, "utf8");

$userRecivedP = $_POST['user'];
$passwordRecivedP = $_POST['pass'];
$newuserRecivedP = $_POST['usernew'];


$sql = "UPDATE  Usuarios SET  Username = '$newuserRecivedP' ,  Password = '$passwordRecivedP'  WHERE Username = '$userRecivedP'";

if($conn->query($sql)) {
    echo '<p>Cliente actualizado con éxito</p>';
    header("location:http://localhost/Projectov4/backoffice/indexAdministrator.php");
  } 
  ?>