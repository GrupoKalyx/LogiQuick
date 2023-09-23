<?php
require_once('sql/dbconection.php');

$query = 'SELECT * FROM usuarios WHERE ci = ? LIMIT 1';
$exc = $conn->execute_query($query, [0]);
$num = mysqli_num_rows($exc);

if($num == false){
    $query2 = "INSERT INTO usuarios VALUES (0, 'root', 'Admin')";
    $conn->execute_query($query2);
}

$query3 = 'SELECT * FROM logins WHERE idLogin = ? LIMIT 1';
$exc3 = $conn->execute_query($query3, [0]);
$num3 = mysqli_num_rows($exc3);

if($num3 == false){
    $query4 = "INSERT INTO logins VALUES (0, 'root')";
    $conn->execute_query($query4);
}