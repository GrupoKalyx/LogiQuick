<?php
require_once('../../sql/dbconection.php');

$ci = $_POST['id'];
$nombre = $_POST['nombre'];
$contrasenia = $_POST['contrasenia'];
$tipo = $_POST['tipo'];
$query = "INSERT INTO usuarios VALUES (?, ?, ?)";
$exc = $conn->execute_query($query, [$ci, $nombre, $tipo]);
$query2 = "INSERT INTO logins VALUES (?, ?)";
$exc2 = $conn->execute_query($query2, [$ci, $contrasenia]);

if ($exc and $exc2) {
  echo "<script>alert('Usuario ingresado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}
