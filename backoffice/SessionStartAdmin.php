<?php

require "dbconection.php";
$tokenRecived = $_SESSION['chkT'];


if (mysqli_query($conn, "SELECT userToken FROM sessiontoken WHERE userToken = '$tokenRecived'") == true) {
    if (isset($_SESSION['nombredeusuario'])) {
        $usuarioigresado = $_SESSION['nombredeusuario'];
    } else {
        header("location: http://localhost/LogiQuick/Login/Login.php");
    }
    if (isset($_POST['btncerrar'])) {
        session_destroy();
        header("location: http://localhost/LogiQuick/Login/Login.php");
    }
} else {
    echo "ERROOOOOOOOOOOOOOOOOOOR";
    header("location: http://localhost/LogiQuick/Login/Login.php");
}
?>