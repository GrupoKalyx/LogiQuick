<?php
require "../sql/dbconection.php";
var_dump($_SESSION);
$tokenRecibido = $_SESSION['chkToken'];
if (mysqli_query($conn, "SELECT tokenUsuario FROM token WHERE tokenUsuario = '$tokenRecibido'")) {
    if (isset($_POST['btnCerrar'])) {
        session_destroy();
        header("location: http://localhost/LogiQuick/Login/Login.php");
    }
} else {
    header("location: http://localhost/LogiQuick/Login/Login.php");
}
