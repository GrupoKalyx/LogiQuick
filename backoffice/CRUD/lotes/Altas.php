<?php
require_once('../../sql/dbconection.php');

$paquetes = $_POST['paquete'];

$query = "INSERT INTO lotes VALUES ();";
$exc = $conn->execute_query($query);
$queryId = "SELECT LAST_INSERT_ID();";
$excId = $conn->execute_query($queryId);
$fExcId = $excId->fetch_array(MYSQLI_ASSOC);
$idLote = $fExcId['LAST_INSERT_ID()'];

if ($paquetes != NULL) {
  foreach ($paquetes as $paquete) {
    $queryPaquete = "INSERT INTO lotean (idLote, numBulto) VALUES (?, ?)";
    $excPaquete = $conn->execute_query($queryPaquete, [$idLote, $paquete]);
  }
}

$conn->close();

if ($exc) {
  echo "<script>alert('Lote ingresado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}
