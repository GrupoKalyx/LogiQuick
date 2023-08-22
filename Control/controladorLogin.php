<?php
require '../Modelo/modeloLogin.php';
require '../Modelo/modeloToken.php';

class controladorLogin
{
    public static function chequear($content)
    {
        $ci = $content['post']['ci'];
        $contrasenia = $content['post']['contrasenia'];
        $l = new modeloLogin();
        if ($l->existe($ci)) {
            if ($l->contrasenia($ci, $contrasenia)) {
                $_SESSION['ci'] = $ci;
                $t = new modeloToken();
                $_SESSION['chkT'] = $t->generateToken();
                $tipo = json_decode($l->tipo($ci));
                var_dump($tipo);
                // switch ($tipo) {
                //     case 'Admin':
                //         header("Location: ../../../backoffice/IndexAdministrator.php");
                //         break;
                //     case 'Almacen':
                //         header("location: ../../../Vista/FunCentral.php");
                //         break;
                //     case 'Externo':
                //         header("location: ../../../Vista/FunExternoCentral.php");
                //         break;
                //     case 'Camionero':
                //         header("location: ../../../Vista/Camionero.html");
                //         break;
                //     default:
                //         echo "<script>alert('Tipo de usuario desconocido, re intente por favor!');window.location='../../../Vista/login.php'</script>";
                //         break;
                // }
            } else {
                echo "<script>alert('La contraseña ingresada es incorrecta, revise los datos ingresados y vuelva a intentar.');window.location='../Vista/login.php'</script>";
            }
        } else {
            echo "<script>alert('Usuario inexistente ,re intente por favor.');window.location='../Vista/login.php'</script>";
        }
    }
}