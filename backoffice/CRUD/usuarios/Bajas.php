<?php
require_once('../../sql/dbconection.php');

$ci = $_POST['id'];
$query = "DELETE FROM usuarios WHERE ci = ?";
$exc = $conn->execute_query($query, [$ci]);
$query2 = "DELETE FROM logins WHERE idLogin = ?";
$exc2 = $conn->execute_query($query2, [$ci]);

if ($exc AND $exc2) {
    echo "<script>alert('Usuario eliminado con éxito.');window.location='../../indexAdmin.php';</script>";
} else {
    echo "<script>alert('Un error inesperado ocurrió.');window.location='../../indexAdmin.php';</script>";
}