<?php
require 'dbconection.php';
mysqli_set_charset($conn, "utf8");

$userRecivedP = $_POST['user'];


$sql = "DELETE FROM typeuser WHERE username = '$userRecivedP' and type = 'user'";
if($conn->query($sql) === TRUE) {
    echo '<p>Cliente actualizado con éxito</p>';
    header("location:http://localhost/Projectov4/backoffice/indexAdmin.php");
    

  } else{ echo "<script>alert('error, usuario no encotrado u otro error !');window.location='Bajas.phpppppp' </script>";
  }
?>