<?php
$server = "localhost";
$user = "root";
$password = "";
$dbname = "multiuser";

$conn = new mysqli ($server, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}
?>