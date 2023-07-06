<?php
require '../sql/dbconection.php';
$username = isset($_POST['username']);
$query = "SELECT FROM typeuser WHERE username = '$username'";
$result = ($conn->query($query));





?>