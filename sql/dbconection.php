<?php
$server = "127.0.0.1";
$user = "root";
$password = "";
$dbname = "logiquickbd";

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) {

    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}
?>