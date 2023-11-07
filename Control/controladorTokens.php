<?php
require '../Modelo/modeloTokens.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
    'GET' => $_GET,
    'POST' => $_POST,
    'PUT' => $_POST,
    'DELETE' => $_POST
};

$function = $context['function'];
controladorTokens::$function($context);

class controladorTokens
{

    public static function createToken($context)
    {
        $ci = $context['ci'];
        $tipo = $context['tipo'];
        $token = modeloTokens::generateToken($ci, $tipo);
        $jwtExp = $token['iat'];
        $jwt = modeloTokens::encodeToken($token);
        modeloTokens::setToken($ci, $jwt, $jwtExp);
        echo $jwt;
    }

    public static function updateToken($context)
    {
        $ci = $context['ci'];
        $tipo = $context['tipo'];
        $token = modeloTokens::generateToken($ci, $tipo);
        $jwtExp = $token['iat'];
        $jwt = modeloTokens::encodeToken($token);
        modeloTokens::updateToken($ci, $jwt, $jwtExp);
        echo $jwt;
    }

    public static function verify($context)
    {
        $token = $context['token'];
        $tipo = $context['tipo'];
        $ver = modeloTokens::chkToken($token);
        if ($ver) {
            $ver = modeloTokens::chkExpiration($token);
            if($ver){
                $type = modeloTokens::getType($token);
                if ($type != $tipo) echo "<script>alert('Usted no tiene permiso para ingresar a esta página.');window.location=../Vista/indexMains.php;</script>";
            }else{
                echo "<script>alert('Su token ha expirado, vuelva a ingresar sesión porfavor.');window.location=../Vista/indexMains.php;</script>";
            }            
        }else{
            echo "<script>alert('El token es incorrecto, vuelva a ingresar sesión.');window.location=../Vista/indexMains.php;</script>";
        }
    }

    public static function expired($context)
    {
        $token = $context['token'];
        $expiration = modeloTokens::chkExpiration($token);
        echo $expiration;
    }

    public static function exists($context)
    {
        $ci = $context['ci'];
        $existence = modeloTokens::chkTokenExistence($ci);
        echo $existence;
    }

    public static function getType($context)
    {
        $token = $context['token'];
        $tipo = modeloTokens::getType($token);
        echo $tipo;
    }

    public static function getCi($context)
    {
        $token = $context['token'];
        $tipo = modeloTokens::getCi($token);
        echo $tipo;
    }
}
