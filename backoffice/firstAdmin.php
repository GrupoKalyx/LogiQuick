<?php
require_once('sql/dbconection.php');

$query = 'SELECT * FROM usuarios WHERE ci = ? LIMIT 1';
$exc = $conn->execute_query($query, [0]);
$num = mysqli_num_rows($exc);

if($num == false){
    $query = "INSERT INTO usuarios VALUES (0, 'root', 'Admin')";
    $conn->execute_query($query);
    $query2 = "INSERT INTO logins VALUES (0, 'root')";
    $exc2 = $conn->execute_query($query2);
}