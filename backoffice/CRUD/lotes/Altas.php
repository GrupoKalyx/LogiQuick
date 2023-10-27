<?php
require_once('../../sql/dbconection.php');

$paquete1 = $_POST['paquete1'];
$paquete2 = $_POST['paquete2'];
$paquete3 = $_POST['paquete3'];
$paquete4 = $_POST['paquete4'];
$paquete5 = $_POST['paquete5'];

$query = "INSERT INTO lotes VALUES ();";
$exc = $conn->execute_query($query);
$queryId = "SELECT LAST_INSERT_ID();";
$excId = $conn->execute_query($queryId);
$fExcId = $excId->fetch_array(MYSQLI_ASSOC);
$idLote = $fExcId['LAST_INSERT_ID()'];

if ($paquete1 != NULL) {
  $query1 = "INSERT INTO lotean (idLote, numBulto) VALUES (?, ?)";
  $exc1 = $conn->execute_query($query1, [$idLote, $paquete1]);
}

if ($paquete2 != NULL) {
  $query2 = "INSERT INTO lotean (idLote, numBulto) VALUES (?, ?)";
  $exc2 = $conn->execute_query($query2, [$idLote, $paquete2]);
}

if ($paquete3 != NULL) {

  $query3 = "INSERT INTO lotean (idLote, numBulto) VALUES (?, ?)";
  $exc3 = $conn->execute_query($query3, [$idLote, $paquete3]);
}

if ($paquete4 != NULL) {
  $query4 = "INSERT INTO lotean (idLote, numBulto) VALUES (?, ?)";
  $exc4 = $conn->execute_query($query4, [$idLote, $paquete4]);
}

if ($paquete5 != NULL) {
  $query5 = "INSERT INTO lotean (idLote, numBulto) VALUES (?, ?)";
  $exc5 = $conn->execute_query($query5, [$idLote, $paquete5]);
}
$conn->close();

if ($exc) {
  echo "<script>alert('Lote ingresado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}
