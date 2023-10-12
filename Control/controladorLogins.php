<?php
require '../Modelo/modeloLogins.php';
require 'controladorTokens.php';
require 'controladorUsuarios.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
    'GET' => $_GET,
    'POST' => $_POST,
    'PUT' => $_PUT,
    'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorLogins::$function($context);

class controladorLogins
{

    public static function chequear($content)
    {
        $ci = $content['post']['ci'];
        $contrasenia = $content['post']['contrasenia'];
        if (modeloLogins::existe($ci)) {
            if (modeloLogins::contrasenia($ci, $contrasenia)) {

                $_SESSION['ci'] = $ci;
                $tokenExists = controladorTokens::exists($ci);
                if ($tokenExists == false) {
                    $_SESSION['token'] = $t->createToken($ci);
                }

                $objTipo = json_decode(modeloLogins::tipo($ci), true);
                $tipo = $objTipo['tipo'];
                switch ($tipo) {
                    case 'Funcionario':
                        header("location: ../../../Vista/FunCentral.php");
                        break;
                    case 'Externo':
                        header("location: ../../../Vista/FunExtCentral.php");
                        break;
                    case 'Secundario':
                        header("location: ../../../Vista/FunSecundario.php");
                        break;
                    case 'Camionero':
                        header("location: ../../../Vista/Camionero.php");
                        break;
                    case 'Delivery':
                        header("location: ../../../Vista/Delivery.php");
                        break;
                    default:
                        echo "<script>alert('Tipo de usuario desconocido, re intente por favor!');window.location='../../../Vista/login.php</script>";
                }
            } else {
                echo "<script>alert('La contraseña ingresada es incorrecta, revise los datos ingresados y vuelva a intentar.');window.location='../../../Vista/login.php</script>";
            }
        } else {
            echo "<script>alert('Usuario inexistente, re intente por favor.');window.location='../../../Vista/login.php'</script>";
        }
    }
}
