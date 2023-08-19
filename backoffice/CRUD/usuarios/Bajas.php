<?php
session_start();
require '../../dbconection.php';
mysqli_set_charset($conn, "utf8");

$ci = $_POST['user']['0'];
$sql = "DELETE FROM usuarios WHERE ci = '$ci'";

if ($conn->query($sql) === TRUE) {
    echo '<p>Cliente actualizado con éxito</p>';
    header("location:http://localhost/LogiQuick/backoffice/IndexAdministrator.php");
} else {
    echo "<script>alert('Usuario no encontrado.');window.location='indexAdministrator.php' </script>";
}
