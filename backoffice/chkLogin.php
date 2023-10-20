<?php
require_once('sql/dbconection.php');
require_once('vendor/autoload.php');
USE Firebase\JWT\JWT;
session_start();

$ci = $_POST['ci'];
$contrasenia = $_POST['contrasenia'];
//Chuequea si el usuario existe
$queryUser = "SELECT * FROM `usuarios` WHERE ci = ? LIMIT 1";
$resultUser = $conn->execute_query($queryUser, [$ci]);
$existe = mysqli_num_rows($resultUser);
if ($existe) {
    //Chequea si la contraseña es correcta
    $queryPasswd = "SELECT * FROM `usuarios` WHERE ci = ? AND contrasenia = ? LIMIT 1";
    $resultPasswd = $conn->execute_query($queryPasswd, [$ci, $contrasenia]);
    $contrasenia = mysqli_num_rows($resultPasswd);
    if ($contrasenia) {
        //Chequea si el usuario es un admin
        $queryType = "SELECT tipo FROM `usuarios` WHERE ci = ? LIMIT 1";
        $resultType = $conn->execute_query($queryType, [$ci]);
        $fResult =  $resultType->fetch_array(MYSQLI_ASSOC);
        $tipo = $fResult['tipo'];
        if ($tipo == "Admin") {
            //Genera un token
            $time = time();
            $token = array("iat" => $time, "exp" => $time + (60 * 60 * 24), "data" => ['ci' => $ci, 'tipo' => 'Admin']);
            $jwt = JWT::encode($token, "o^V*Ciytufd9*FDyutdf867IYTU7DF8567DytfdI8", 'HS256');
            //Chequea si el usuario tiene un token asignado
            $_SESSION['ci'] = $ci;
            $queryChkToken = "SELECT token FROM `usuarios` WHERE ci = ? AND token IS NOT NULL LIMIT 1";
            $excChkToken = $conn->execute_query($queryChkToken, [$ci]);
            $tokenExists = mysqli_num_rows($excChkToken);
            if ($tokenExists) {
                //Actualiza el token en la bd
                $queryToken = "UPDATE usuarios SET token = ? AND tokenExp = ?";
                $conn->execute_query($queryToken, [$jwt, $token['exp']]);
            } else {
                //Inserta el token en la bd
                $queryToken = "INSERT INTO usuarios (token, tokenExp) VALUES (?, ?)";
                $conn->execute_query($queryToken, [$jwt, $token['exp']]);
            }
            $_SESSION['token'] = $token;
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
$conn->close();