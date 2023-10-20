<?php
require_once('sql/dbconection.php');

$query = 'SELECT * FROM usuarios WHERE ci = ? LIMIT 1';
$exc = $conn->execute_query($query, [0]);
$num = mysqli_num_rows($exc);

if($num == false){
    $time = (time() + (24*60*60));
    $queryInsert = "INSERT INTO usuarios (ci, nombre, tipo, contrasenia, token, tokenExp) VALUES (?, ?, ?, ?, ?, ?)";
    $conn->execute_query($queryInsert, [0, 'root', 'Admin', 'root', 'token', $time]);
}