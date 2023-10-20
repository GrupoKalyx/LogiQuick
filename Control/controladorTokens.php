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
        $ver = modeloTokens::chkToken($token);
        if ($ver) {
            $ver = modeloTokens::chkExpiration($token);
        }
        echo $ver;
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
        $existence = modeloTokens::chkUser($ci);
        echo $existence;
    }

    public static function getType($context)
    {
        $token = $context['token'];
        $tipo = modeloTokens::chkType($token);
        var_dump($tipo);
    }
}
