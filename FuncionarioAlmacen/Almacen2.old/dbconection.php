<?php
$server = "localhost";
$user = "root";
$password = "";
$dbname = "almacen";

$conectionn = new mysqli($server, $user, $password, $dbname);
if ($conectionn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}




?>