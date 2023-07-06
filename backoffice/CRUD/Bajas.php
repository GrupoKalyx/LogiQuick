<?php
session_start();
require '../dbconection.php';
mysqli_set_charset($conn, "utf8");

$userRecivedP = $_POST['user'];
$tipo = $_SESSION['typeRecibed'];

$sql = "DELETE FROM usuarios WHERE Username = '$userRecivedP' ";
if($conn->query($sql) === TRUE) {
    echo '<p>Cliente actualizado con éxito</p>';
    header("location:http://localhost/Projectov4/backoffice/IndexAdministrator.php");
    

  }else{ echo "<script>alert('error, usuario no encotrado u otro error !');window.location='indexAdministrator.php' </script>";
  }
?>