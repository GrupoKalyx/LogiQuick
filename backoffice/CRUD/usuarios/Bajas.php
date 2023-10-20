<?php
require_once('../../sql/dbconection.php');

$ci = $_POST['ci'];
$query = "DELETE FROM usuarios WHERE ci = ?";
$exc = $conn->execute_query($query, [$ci]);

$queryTipo = "SELECT tipo FROM `usuarios` WHERE ci = ?";
$excTipo = $conn->execute_query($queryTipo, [$ci]);
$tipo = $excTipo->fetch_array(MYSQLI_ASSOC);

if ($tipo == 'Camionero' or $tipo == 'Delivery') {
  if ($tipo == 'Camionero') {
    $query3 = "DELETE FROM conductores VALUES (?)";
    $exc3 = $conn->execute_query($query3, [$ci]);
    $query4 = "DELETE FROM camioneros VALUES (?)";
    $exc4 = $conn->execute_query($query4, [$ci]);
  } else if ($tipo == 'Delivery') {
    $query3 = "DELETE FROM conductores VALUES (?)";
    $exc3 = $conn->execute_query($query3, [$ci]);
    $query4 = "DELETE FROM deliverys VALUES (?)";
    $exc4 = $conn->execute_query($query4, [$ci]);
  }
}

if ($exc and $exc2) {
  echo "<script>alert('Usuario eliminado con éxito.');window.location='../../indexAdmin.php';</script>";
} else {
  echo "<script>alert('Un error inesperado ocurrió.');window.location='../../indexAdmin.php';</script>";
}
