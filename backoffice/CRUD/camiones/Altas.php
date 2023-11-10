<?php
require_once('../../sql/dbconection.php');

$ci = $_POST['ci'];
$nombre = $_POST['nombre'];
$contrasenia = $_POST['contrasenia'];
$tipo = $_POST['tipo'];
$query = "INSERT INTO ca (ci, nombre, contrasenia, tipo) VALUES (?, ?, ?, ?)";
$exc = $conn->execute_query($query, [$ci, $nombre, $contrasenia, $tipo]);

if ($tipo == 'Camionero' or $tipo == 'Delivery') {
  $telefono = $_POST['telefono'];
  if ($tipo == 'Camionero') {
    $queryCond = "INSERT INTO conductores VALUES (?, ?, ?)";
    $excCond = $conn->execute_query($queryCond, [$ci, $nombre, $telefono]);
    $queryCam = "INSERT INTO camioneros VALUES (?, ?, ?)";
    $excCam = $conn->execute_query($queryCam, [$ci, $nombre, $telefono]);
    $exc = ($exc and $excCond and $excCam);
  } else if ($tipo == 'Delivery') {
    $queryCond = "INSERT INTO conductores VALUES (?, ?, ?)";
    $excCond = $conn->execute_query($queryCond, [$ci, $nombre, $telefono]);
    $queryDel = "INSERT INTO deliverys VALUES (?, ?, ?)";
    $excDel = $conn->execute_query($queryDel, [$ci, $nombre, $telefono]);
    $exc = ($exc and $excCond and $excDel);
  }
}

if ($exc) {
  echo "<script>alert('Usuario ingresado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}
