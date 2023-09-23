<?php
require_once('sql/dbconection.php');
session_start();

$ci = $_POST['ci'];
$contrasenia = $_POST['contrasenia'];

$queryUser = "SELECT * FROM `usuarios` WHERE ci = ? LIMIT 1";
$resultUser = $conn->execute_query($queryUser, [$ci]);
$existe = mysqli_num_rows($resultUser);
if ($existe) {
    $queryPasswd = "SELECT * FROM `logins` WHERE idLogin = ? AND contrasenia = ? LIMIT 1";
    $resultPasswd = $conn->execute_query($queryPasswd, [$ci, $contrasenia]);
    $contrasenia = mysqli_num_rows($resultPasswd);
    if ($contrasenia) {
        $_SESSION['ci'] = $ci;
        $queryChkToken = "SELECT * FROM `tokens` WHERE ci = ? LIMIT 1";
        $excChkToken = $conn->execute_query($queryChkToken, [$ci]);
        $tokenExists = mysqli_num_rows($excChkToken);
        if ($tokenExists == false) {
            $token = bin2hex(random_bytes(32));
            $_SESSION['token'] = $token;
            $queryToken = "INSERT INTO tokens (idToken, ci) VALUES (?, ?)";
            $conn->execute_query($queryToken, [$token, $ci]);
        } else {
            $fToken = $excChkToken->fetch_array(MYSQLI_ASSOC);
            $token = $fToken['token'];
            $_SESSION['token'] = $token;
        }
        $queryType = "SELECT tipo FROM `usuarios` WHERE ci = ? LIMIT 1";
        $resultType = $conn->execute_query($queryType, [$ci]);
        $fResult =  $resultType->fetch_array(MYSQLI_ASSOC);
        $tipo = $fResult['tipo'];
        if ($tipo === "Admin") {
            header("location: indexAdmin.php");
        } else {
            echo "<script>
            alert('Tipo de usuario incorrecto, no tiene permisos para ingresar a esta área.');
            window.location = 'loginAdmin.php';
        </script>";
        }
    } else {
        echo "<script>
                alert('La contraseña ingresada es incorrecta, revise los datos ingresados y vuelva a intentar.');
                window.location = 'loginAdmin.php';
            </script>";
    }
} else {
    echo "<script>
            alert('Usuario inexistente ,re intente por favor.');
            window.location = 'loginAdmin.php';
        </script>";
}