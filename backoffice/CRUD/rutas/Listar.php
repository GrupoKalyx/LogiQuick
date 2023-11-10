<?php
require_once('../../sql/dbconection.php');

$query = "SELECT * FROM rutas";
$result = mysqli_query($conn, $query);
$rutas = $result->fetch_all(MYSQLI_ASSOC);
?>