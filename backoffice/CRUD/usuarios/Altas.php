<?php
require_once('../../sql/dbconection.php');

$ci = $_POST['ci'];
$nombre = $_POST['nombre'];
$contrasenia = $_POST['contrasenia'];
$tipo = $_POST['tipo'];
$query = "INSERT INTO usuarios VALUES (?, ?, ?)";
$exc = $conn->execute_query($query, [$ci, $nombre, $tipo]);
$query2 = "INSERT INTO logins VALUES (?, ?)";
$exc2 = $conn->execute_query($query2, [$ci, $contrasenia]);

if ($tipo == 'Camionero' or $tipo == 'Delivery') {
  $telefono = $_POST['telefono'];
  if ($tipo == 'Camionero') {
    $query3 = "INSERT INTO conductores VALUES (?, ?, ?)";
    $exc3 = $conn->execute_query($query3, [$ci, $nombre, $telefono]);
    $query4 = "INSERT INTO camioneros VALUES (?, ?, ?)";
    $exc4 = $conn->execute_query($query4, [$ci, $nombre, $telefono]);
  } else if ($tipo == 'Delivery') {
    $query3 = "INSERT INTO conductores VALUES (?, ?, ?)";
    $exc3 = $conn->execute_query($query3, [$ci, $nombre, $telefono]);
    $query4 = "INSERT INTO deliverys VALUES (?, ?, ?)";
    $exc4 = $conn->execute_query($query4, [$ci, $nombre, $telefono]);
  }
}

if ($exc and $exc2) {
  echo "<script>alert('Usuario ingresado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}
