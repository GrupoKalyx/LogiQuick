<?php
require '../Modelo/modeloLogins.php';
require 'superControlador.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
    'GET' => $_GET,
    'POST' => $_POST,
    'PUT' => $_PUT,
    'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorLogins::$function($context);

echo 'z';
class controladorLogins
{
    public static function chequear($context)
    {
        echo 'a';
        $ci = $context['ci'];
        $contra = $context['contrasenia'];
        //Chequea la existencia del usuario
        $existe = superControlador('http://localhost/LogiQuick/Control/controladorUsuarios.php', 'GET', array('function' => 'existe', 'ci' => $ci));
        if ($existe != false) {
            //Chequea la contraseña
            $contrasenia = superControlador('http://localhost/LogiQuick/Control/controladorLogins.php', 'GET', array('function' => 'contrasenia', 'ci' => $ci, 'contrasenia' => $contra));
            if ($contrasenia) {
                //Chequea si ya tiene un token
                $token = superControlador('http://localhost/LogiQuick/Control/controladorTokens.php', 'GET', array('function' => 'exists', 'ci' => $ci));
                //Busca el tipo del usuario
                $objTipo = json_decode(modeloLogins::tipo($ci), true);
                $tipo = $objTipo['tipo'];
                // if ($token == false) {
                //     //Si no lo tiene crea uno nuevo y lo establece en la base de datos
                //     $jwt = superControlador('http://localhost/LogiQuick/Control/controladorTokens.php', 'POST', array('function' => 'createToken', 'ci' => $ci, 'tipo' => $tipo));
                // } else {
                //     //En caso de ya tener uno lo renueva y lo cambia en la bd
                //     $jwt = superControlador('http://localhost/LogiQuick/Control/controladorTokens.php', 'PUT', array('function' => 'updateToken', 'ci' => $ci, 'tipo' => $tipo));
                // }
                // $_SESSION['token'] = $jwt;
                //Redirige al usuario a su respectivo index
                switch ($tipo) {
                    case 'Funcionario':
                        header("location: ../../../Vista/indexMains/FunExtCentral.php");
                        break;
                    case 'Externo':
                        header("location: ../../../Vista/indexMains/FunExtCentral.php");
                        break;
                    case 'Secundario':
                        header("location: ../../../Vista/indexMains/Camionero.php");
                        break;
                    case 'Camionero':
                        header("location: ../../../Vista/indexMains/Camionero.php");
                        break;
                    case 'Delivery':
                        header("location: ../../../Vista/indexMains/Delivery.php");
                        break;
                    default:
                        echo "<script>alert('Tipo de usuario desconocido, re intente por favor!');window.location='../../../Vista/indexMains/login.php</script>";
                }
            } else {
                echo "<script>alert('La contraseña ingresada es incorrecta, revise los datos ingresados y vuelva a intentar.');window.location='../../../Vista/indexMains/login.php</script>";
            }
        } else {
            echo "<script>alert('Usuario inexistente, re intente por favor.');window.location='../../../Vista/indexMains/login.php'</script>";
        }
    }
}
