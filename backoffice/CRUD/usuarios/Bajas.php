<?php
require_once('../../sql/dbconection.php');

$ci = $_POST['ci'];
$queryTipo = "SELECT tipo FROM `usuarios` WHERE ci = ?";
$exc = $conn->execute_query($queryTipo, [$ci]);
$objTipo = $excTipo->fetch_array(MYSQLI_ASSOC);
$tipo = $objTipo["tipo"];

if ($tipo == 'Camionero') {
  $queryCam = "DELETE FROM camioneros WHERE ci = ?";
  $excCam = $conn->execute_query($queryCam, [$ci]);
  $queryCond = "DELETE FROM conductores WHERE ci = ?";
  $excCond = $conn->execute_query($queryCond, [$ci]);
  $exc = ($exc and $excCond and $excCam);
} else if ($tipo == 'Delivery') {
  $queryDel = "DELETE FROM deliverys WHERE ci = ?";
  $excDel = $conn->execute_query($queryDel, [$ci]);
  $queryCond = "DELETE FROM conductores WHERE ci = ?";
  $excCond = $conn->execute_query($queryCond, [$ci]);
  $exc = ($exc and $excCond and $excDel);
}

$query = "DELETE FROM usuarios WHERE ci = ?";
$excUser = $conn->execute_query($query, [$ci]);
$exc = ($excUser and $exc);

if ($exc) {
  echo "<script>alert('Usuario eliminado con éxito.');window.location='../../indexAdmin.php';</script>";
} else {
  echo "<script>alert('Un error inesperado ocurrió.');window.location='../../indexAdmin.php';</script>";
}
