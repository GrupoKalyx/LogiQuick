<?php

session_start();



    $numero = '';
    for ($i = 0; $i < 10; $i++) {
        $numero .= mt_rand(0, 9);

    

}

require '../../dbconection.php';
mysqli_set_charset($conn, "utf8");
$numBulto = $_POST['numBulto'];
$volumen = $_POST['vol'];
$estado = $_POST['estado'];
$correo = $_POST['correo'];
//$numeroSeguiminto = $_SESSION['numSeguimiento'];
$sql = "INSERT INTO paquetes VALUES ($numBulto , $volumen , '$estado','$correo', $numero )";

if ($conn->query($sql) ===  true) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/LogiQuick/backoffice/indexAdministrator.php");
}else{
  header("location:http://localhost/LogiQuick/backoffice/indexAdministrator.php");
  echo "<script>alert('error! Complete todos los campos plis!');window.location='IndexAdministrator.php'</script>";
}
?>