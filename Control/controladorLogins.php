<?php
require '../Modelo/modeloLogins.php';
require 'superControlador.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
    'GET' => $_GET,
    'POST' => $_POST,
    'PUT' => $_POST,
    'DELETE' => $_POST,
};

$function = $context['function'];
controladorLogins::$function($context);

class controladorLogins
{
    public static function chequear($context)
    {
        $ci = $context['ci'];
        $contra = $context['contrasenia'];
        // Chequea la existencia del usuario
        $existe = superControlador('http://'.$_SERVER['HTTP_HOST'].'/Control/controladorUsuarios.php', 'GET', array('function' => 'existencia', 'ci' => $ci));
        if ($existe and isset($ci)) {
            // Chequea la contraseña
            $contrasenia = modeloLogins::contrasenia($ci, $contra);
            if ($contrasenia and isset($contra)) {
                // Chequea si ya tiene un token
                $token = superControlador('http://'.$_SERVER['HTTP_HOST'].'/Control/controladorTokens.php', 'GET', array('function' => 'exists', 'ci' => $ci));
                // Busca el tipo del usuario
                $objTipo = json_decode(modeloLogins::tipo($ci), true);
                $tipo = $objTipo['tipo'];
                if ($token) {
                    // En caso de ya tener uno lo renueva y lo cambia en la bd
                    $jwt = superControlador('http://'.$_SERVER['HTTP_HOST'].'/Control/controladorTokens.php', 'GET', array('function' => 'updateToken', 'ci' => $ci, 'tipo' => $tipo));
                } else {
                    //Si no lo tiene crea uno nuevo y lo establece en la base de datos
                    $jwt = superControlador('http://'.$_SERVER['HTTP_HOST'].'/Control/controladorTokens.php', 'GET', array('function' => 'createToken', 'ci' => $ci, 'tipo' => $tipo));
                }
                $_SESSION['token'] = $token;
               // Redirige al usuario a su respectivo index
                switch ($tipo) {
                    case 'Funcionario':
                        header("location: ../Vista/indexMains/FunExtCentral.php");
                        break;
                    case 'Externo':
                        header("location: ../Vista/indexMains/FunExtCentral.php");
                        break;
                    case 'Secundario':
                        header("location: ../Vista/indexMains/Camionero.php");
                        break;
                    case 'Camionero':
                        header("location: ../Vista/indexMains/Camionero.php");
                        break;
                    case 'Delivery':
                        header("location: ../Vista/indexMains/Delivery.php");
                        break;
                    default:
                        echo '<script>window.location="../Vista/indexMains/login.php";alert("Tipo de usuario desconocido, re intente por favor!");</script>';
                }
            } else {
                echo "<script>
                window.location='../Vista/indexMains/login.php;
                alert('La contraseña ingresada es incorrecta, revise los datos ingresados y vuelva a intentar.');
                </script>";
            }
        } else {
            echo "<script>
            window.location='../Vista/indexMains/login.php';
            alert('Usuario inexistente, re intente por favor.');
            </script>";
        }
    }
}
