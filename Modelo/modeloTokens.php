<?php
require_once 'modeloBd.php';
require_once '../vendor/autoload.php';

use Firebase\JWT\JWT;

class modeloTokens
{
    public static function generateToken($ci, $tipo)
    {
        $time = time();
        $token = array(
            "iat" => $time, //Tiempo en q inica el token
            "exp" => $time + (60 * 60 * 24),
            "data" => [
                'ci' => $ci
            ]
        );
        return $token;
    }

    public static function encodeToken($token)
    {
        $jwt = JWT::encode($token, "o^V*Ciytufd9*FDyutdf867IYTU7DF8567DytfdI8", 'HS256');
        return $jwt;
    }

    public static function setToken($ci, $jwt, $jwtExp)
    {
        $conn = modeloBd::conexion();
        $query = "INSERT INTO usuarios (ci, token, tokenExp) VALUES (?, ?, ?)";
        $conn->execute_query($query, [$ci, $jwt, $jwtExp]);
        $conn->close();
    }

    public static function updateToken($ci, $jwt, $jwtExp)
    {
        $conn = modeloBd::conexion();
        $query = "UPDATE usuarios SET token = ? AND tokenExp = ? WHERE ci = ?";
        $conn->execute_query($query, [$jwt, $jwtExp, $ci]);
        $conn->close();
    }

    public static function chkToken($token)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT token FROM usuarios WHERE token = ? LIMIT 1";
        $result = $conn->execute_query($query, $token);
        $num = mysqli_num_rows($result);
        $conn->close();
        return $num;
    }

    public static function chkExpiration($token)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT tokenExp FROM usuarios WHERE token = ? LIMIT 1";
        $result = $conn->execute_query($query, $token);
        $fetch = $result->fetch_array(MYSQLI_ASSOC);
        $expired = time() > $fetch['tokenExp'];
        $conn->close();
        return $expired;
    }

    public static function chkUser($ci)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM usuarios WHERE ci = ? LIMIT 1";
        $result = $conn->execute_query($query, [$ci]);
        $num = mysqli_num_rows($result);
        $conn->close();
        return $num;
    }

    public static function chkType($token)
    {
        list($headersB64, $payloadB64, $sig) = explode('.', $token);
        $payloadB64 = json_decode(base64_decode($payloadB64), true);
        $type = $payloadB64['type'];
        return $payloadB64;
    }
}
