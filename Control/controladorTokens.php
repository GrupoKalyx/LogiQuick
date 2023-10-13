<?php
require '../Modelo/modeloTokens.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
    'GET' => $_GET,
    'POST' => $_POST,
    'PUT' => $_PUT,
    'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorTokens::$function($context);

class controladorTokens
{

    public static function createToken($context)
    {
        $ci = $context['ci'];
        $token = modeloTokens::generateToken($ci);
        // modeloTokens::setToken($token, $ci);
        echo $token;
    }

    public static function verify($context)
    {
        $token = $context['chkToken'];
        if (modeloTokens::chkToken($token) == 0) {
            echo "<script>alert('Hubo un error en la sesión, intente volverse a ingresar.');window.location='../../../Vista/login.php'</script>";
        }
    }

    public static function exists($context){
        $ci = $context;
        $existence = modeloTokens::chkUser($ci);
        echo $existence;
    }
}