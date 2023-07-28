<?php
session_start();
require '../../../sql/dbconection.php';
mysqli_set_charset($conn, "utf8");

$ci = $_POST['user']['0'];
$nombre = $_POST['user']['1'];
$contrasenia = $_POST['user']['2'];
$tipo = $_POST['user']['3'];
$sql = "INSERT INTO usuarios VALUES ('$ci', '$nombre', '$contrasenia', '$tipo')";

if ($conn->query($sql)) {
    echo '<p>Cliente actualizado con éxito</p>';
    header("location:http://localhost/LogiQuick/backoffice/indexAdministrator.php");
}