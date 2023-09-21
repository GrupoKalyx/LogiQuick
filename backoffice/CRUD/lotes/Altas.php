<?php
require_once('../../sql/dbconection.php');

$paquete1 = $_POST['paquete1'];
$paquete2 = $_POST['paquete2'];
$paquete3 = $_POST['paquete3'];
$paquete4 = $_POST['paquete4'];
$paquete5 = $_POST['paquete5'];

$query = "INSERT INTO lotes VALUES (); SELECT LAST_INSERT_ID();";
$exc = $conn->execute_query($query);
$query1 = "INSERT INTO lotean VALUES (?, ?)";
$exc1 = $conn->execute_query($query1, [$lote, $paquete1]);
$query2 = "INSERT INTO lotean VALUES (?, ?)";
$exc2 = $conn->execute_query($query2, [$lote, $paquete2]);
$query3 = "INSERT INTO lotean VALUES (?, ?)";
$exc3 = $conn->execute_query($query3, [$lote, $paquete3]);
$query4 = "INSERT INTO lotean VALUES (?, ?)";
$exc4 = $conn->execute_query($query4, [$lote, $paquete4]);
$query5 = "INSERT INTO lotean VALUES (?, ?)";
$exc5 = $conn->execute_query($query5, [$lote, $paquete5]);


if ($exc AND $exc1 AND $exc2 AND $exc3 AND $exc4 AND $exc5) {
  echo "<script>alert('Cliente actualizado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}
?>