<?php
require "../sql/dbconection.php";
$tokenRecieved = $_SESSION['chkT'];

if (mysqli_query($conn, "SELECT tokenUsuario FROM token WHERE tokenUsuario = '$tokenRecieved'") == true) {
    if (isset($_POST['btncerrar'])) {
        session_destroy();
        header("location: http://localhost/LogiQuick/Login/Login.php");
    }
} else {
    session_destroy();
    header("location: http://localhost/LogiQuick/Login/Login.php");
}
