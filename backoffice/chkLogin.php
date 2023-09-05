<?php
require_once('sql/dbconection.php');

$ci = $_POST['ci'];
$contrasenia = $_POST['contrasenia'];

$query = "SELECT * FROM `usuarios` WHERE ci = ? LIMIT 1";
$result = $conn->execute_query($query, [$ci]);
$existe = mysqli_num_rows($result);
if ($existe) {
    $query = "SELECT * FROM `logins` WHERE idLogin = ? AND contrasenia = ? LIMIT 1";
    $result = $conn->execute_query($query, [$ci, $contrasenia]);
    $contrasenia = mysqli_num_rows($result);
    if ($contrasenia) {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;
        $query = "INSERT INTO tokens VALUES (?, ?)";
        $conn->execute_query($query, [$token, $ci]);
        $query = "SELECT tipo FROM `usuarios` WHERE ci = ? LIMIT 1";
        $result = $conn->execute_query($query, [$ci]);
        $fResult =  $result->fetch_array(MYSQLI_ASSOC);
        $tipo = $fResult['tipo'];
        var_dump($tipo);
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
