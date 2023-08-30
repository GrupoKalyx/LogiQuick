<?php
require '../Modelo/modeloBd.php';
require '../Modelo/modeloLogin.php';
require '../Modelo/modeloToken.php';
class controladorLogin
{
    public static function chequear($content)
    {
        $conn = modeloBd::conexion();
        $ci = $content['post']['ci'];
        $contrasenia = $content['post']['contrasenia'];
        if (modeloLogin::existe($ci, $conn)) {
            if (modeloLogin::contrasenia($ci, $contrasenia, $conn)) {
                $_SESSION['ci'] = $ci;
                $_SESSION['token'] = self::createToken($ci);
                $objTipo = json_decode(modeloLogin::tipo($ci, $conn), true);
                $tipo = $objTipo['tipo'];
                switch ($tipo) {
                    case 'Admin':
                        header("Location: ../../../Vista/IndexAdministrator.php");
                        break;
                    case 'Almacen':
                        header("location: ../../../Vista/FunCentral.php");
                        break;
                    case 'Externo':
                        header("location: ../../../Vista/FunExternoCentral.php");
                        break;
                    case 'Camionero':
                        header("location: ../../../Vista/Camionero.html");
                        break;
                    default:
                        echo "<script>alert('Tipo de usuario desconocido, re intente por favor!');window.location='../../../Vista/login.php'</script>";
                        break;
                }
            } else {
                echo "<script>alert('La contraseña ingresada es incorrecta, revise los datos ingresados y vuelva a intentar.');window.location='../Vista/login.php'</script>";
            }
        } else {
            echo "<script>alert('Usuario inexistente ,re intente por favor.');window.location='../Vista/login.php'</script>";
        }
    }

    public static function createToken($ci)
    {
        $conn = modeloBd::conexion();
        $token = modeloToken::generateToken();
        modeloToken::setToken($token, $ci, $conn);
        return $token;
    }

    public static function verify($content)
    {
        $conn = modeloBd::conexion();
        $token = $content['post']['chkToken'];
        if (modeloToken::chkToken($token,  $conn) == 0) {
            echo "<script>alert('Hubo un error en la sesión, intente volverse a ingresar.');window.location='../../../Vista/login.php'</script>";
        }
    }
}
