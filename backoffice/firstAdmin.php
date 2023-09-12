<?php
require 'sql/dbconection.php';

$query = 'SELECT * FROM usuarios WHERE ci = "0" LIMIT 1';
$result = mysqli_execute_query($conn, $query);
$num = mysqli_num_rows($result);

if($num == false){
    $query = "INSERT INTO usuarios VALUES (0, 'root', 'Admin')";
    $conn->execute_query($query);
    $query2 = "INSERT INTO logins VALUES (0, 'root')";
    $exc2 = $conn->execute_query($query2);
}