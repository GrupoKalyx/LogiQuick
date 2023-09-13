<?php
require_once('../../sql/dbconection.php');

$ci = $_POST['id'];
$nuevoNombre = $_POST['nombre'];
$nuevaContrasenia = $_POST['contrasenia'];
$query = "UPDATE usuarios SET nombre = ? WHERE ci = ?";
$exc = $conn->execute_query($query, [$nuevoNombre, $ci]);
$query2 = "UPDATE logins SET contrasenia = ? WHERE idLogin = ?";
$exc2 = $conn->execute_query($query2, [$nuevaContrasenia, $ci]);


if ($exc and $exc2) {
    echo "<script>alert('Usuario modificado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
    echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}