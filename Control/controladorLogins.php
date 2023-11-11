<?php
session_start();
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
        $existe = superControlador('http://' . $_SERVER['HTTP_HOST'] . '/LogiQuick/Control/controladorUsuarios.php', 'GET', array('function' => 'existencia', 'ci' => $ci));
        if ($existe) {
            // Chequea la contraseña
            $contrasenia = self::contrasenia($ci, $contra);
            if ($contrasenia == 1) {
                // Busca el tipo del usuario
                $objTipo = json_decode(modeloLogins::tipo($ci), true);
                $tipo = $objTipo['tipo']; 
                // Redirige al usuario a su respectivo index
                switch ($tipo) {
                    case 'Admin':
                        header('http://' . $_SERVER['HTTP_HOST'] . '/LogiQuick/Vista/indexMains/' . $tipo . '.php');
                        echo "<script>
                        window.location='login.php';
                        alert('El acceso a administradores esta limitado al backoffice. Por favor ingrese con otro usuario.');
                        </script>";
                        break;
                    case 'Funcionario' || 'Externo' || 'Secundario' || 'Camionero' || 'Delivery':
                        //Establece en la basa de datos un nuevo token
                        $jwt = superControlador('http://' . $_SERVER['HTTP_HOST'] . '/LogiQuick/Control/controladorTokens.php', 'GET', array('function' => 'createToken', 'ci' => $ci, 'tipo' => $tipo));
                        $_SESSION['token'] = $jwt;
                        $_SESSION['ci'] = $ci;
                        echo "<script>
                        window.location='http://" . $_SERVER['HTTP_HOST'] . "/LogiQuick/Vista/indexMains/".$tipo.".php';
                        </script>";
                        break;
                        // window.location='" .$tipo . ".php';
                    default:
                        echo "<script>
                        alert('Tipo de usuario desconocido, re intente por favor!');
                        window.location='http://" . $_SERVER['HTTP_HOST'] . "/LogiQuick/Vista/indexMains/login.php';
                        </script>";
                }
            } else {
                echo "<script>
                alert('La contraseña ingresada es incorrecta, revise los datos ingresados y vuelva a intentar.');
                window.location='http://" . $_SERVER['HTTP_HOST'] . "/LogiQuick/Vista/indexMains/login.php';
                </script>";
            }
        } else {
            echo "<script>
            alert('Usuario inexistente, re intente por favor.');
            window.location='http://" . $_SERVER['HTTP_HOST'] . "/LogiQuick/Vista/indexMains/login.php';
            </script>";
        }
    }

    public static function contrasenia($ci, $contrasenia)
    {
        $result = modeloLogins::contrasenia($ci, $contrasenia);
        return $result;
    }
}
