<?php
session_start();
require '../../dbconection.php';
mysqli_set_charset($conn, "utf8");

$ci = $_POST['user']['0'];
$nuevoNombre = $_POST['newUser']['0'];
$nuevaContrasenia = $_POST['newUser']['1'];
$sql = "UPDATE usuarios SET  nombreUsuario = '$nuevoNombre' ,  contraseniaUsuario = '$nuevaContrasenia'  WHERE ci = '$ci'";

if ($conn->query($sql)) {
    echo '<p>Cliente actualizado con éxito</p>';
    header("location:http://localhost/LogiQuick/backoffice/indexAdministrator.php");
}
