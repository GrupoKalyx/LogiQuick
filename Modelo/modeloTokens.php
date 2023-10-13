<?php
require_once 'modeloBd.php';
require_once '../vendor/autoload.php';
use Firebase\JWT\JWT;

class modeloTokens
{
    public static function generateToken($ci)
    {
        $time = time();
        $token = array(
            "iat" => $time, //Tiempo en q inica el token
            "exp" => $time + (60 * 60 * 24),
            "data" => [
                'ci' => $ci
            ]
        );
        $jwt = JWT::encode($token, "423r3j34d3j3d3j383n7ud3j383n", 'HS256');
        return $jwt;
    }

    public static function setToken($token, $ci)
    {
        $conn = modeloBd::conexion();
        $query = "INSERT INTO tokens (ci, idToken) VALUES (?, ?)";
        $conn->execute_query($query, [$ci, $token]);
        $conn->close();
    }

    public static function chkToken($token)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM tokens WHERE idToken = ? LIMIT 1";
        $result = $conn->execute_query($query, $token);
        $num = mysqli_num_rows($result);
        $conn->close();
        return $num;
    }

    public static function chkUser($ci)
    {
        $conn = modeloBd::conexion();
        $query = "SELECT * FROM tokens WHERE ci = ? LIMIT 1";
        $result = $conn->execute_query($query, [$ci]);
        $num = mysqli_num_rows($result);
        $conn->close();
        return $num;
    }
}
