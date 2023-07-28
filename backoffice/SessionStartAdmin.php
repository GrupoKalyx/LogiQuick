<?php
require "dbconection.php";
$tokenRecibido = $_SESSION['chkToken'];
if (mysqli_query($conn, "SELECT tokenUsuario FROM token WHERE tokenUsuario = '$tokenRecibido'") == true) {
    if (isset($_POST['btnCerrar'])) {
        session_destroy();
        header("location: http://localhost/LogiQuick/Login/Login.php");
    }
} else {
    header("location: http://localhost/LogiQuick/Login/Login.php");
}