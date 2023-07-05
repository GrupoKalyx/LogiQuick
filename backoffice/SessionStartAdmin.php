<?php

session_start();
require "dbconection.php";
$tokenRecived = $_SESSION['chkT'];


if( mysqli_query($conn, "SELECT userToken FROM sessiontoken WHERE userToken = '$tokenRecived'")== true){


if (isset($_SESSION['nombredeusuario'])) {
    $usuarioigresado = $_SESSION['nombredeusuario'];
    echo"<div class=div1><h1>Bienvenido: $usuarioigresado</h1></div>";

}else{
    header("location: http://localhost/Projectov4/Login/IndexprincipalLogin.php");
}
if (isset($_POST['btncerrar'])) {
    session_destroy();
    header("location: http://localhost/Projectov4/Login/IndexprincipalLogin.php");
}
}else{
    echo"ERROOOOOOOOOOOOOOOOOOOR";
    header("location: http://localhost/Projectov4/Login/IndexprincipalLogin.php");
}

?>