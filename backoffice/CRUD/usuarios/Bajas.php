<?php
require_once('../../sql/dbconection.php');

$ci = $_POST['ci'];
$query = "DELETE FROM usuarios WHERE ci = ?";
$exc = $conn->execute_query($query, [$ci]);
$query2 = "DELETE FROM logins WHERE idLogin = ?";
$exc2 = $conn->execute_query($query2, [$ci]);

$queryTipo
$tipo = $conn->execute_query($queryTipo, [$ci]);

if ($tipo == 'Camionero') {
    $query3 = "INSERT INTO conductores VALUES (?, ?, ?)";
    $exc3 = $conn->execute_query($query3, [$ci, $nombre, $telefono]);
    $query4 = "INSERT INTO conductores VALUES (?, ?, ?)";
    $exc4 = $conn->execute_query($query4, [$ci, $nombre, $telefono]);
  } else if ($tipo == 'Delivery') {
    $query3 = "INSERT INTO conductores VALUES (?, ?, ?)";
    $exc3 = $conn->execute_query($query3, [$ci, $nombre, $telefono]);
    $query4 = "INSERT INTO delivery VALUES (?, ?, ?)";
    $exc4 = $conn->execute_query($query4, [$ci, $nombre, $telefono]);
  }

if ($exc AND $exc2) {
    echo "<script>alert('Usuario eliminado con éxito.');window.location='../../indexAdmin.php';</script>";
} else {
    echo "<script>alert('Un error inesperado ocurrió.');window.location='../../indexAdmin.php';</script>";
}