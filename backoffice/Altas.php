<?php
require "dbconection.php";
mysqli_set_charset($conn, "utf8");

$userRecivedP = $_POST['user'];
$passwordRecivedP = $_POST['pass'];
$type = $_POST['typeofuser'];

$sql = "INSERT INTO typeuser VALUES ('$userRecivedP' , '$passwordRecivedP' , '$type')";
if($conn->query($sql)) {
    echo '<p>Cliente actualizado con éxito</p>';
    header("location:http://localhost/Projectov4/backoffice/indexAdmin.php");
    

  } 



?>