<?php
// Conexión a la base de datos 
$server = "localhost";
$user = "root";
$password = "";
$dbname = "administrar";

$conn = new mysqli ($server, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}
?>