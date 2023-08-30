<?php

class modeloToken
{
    public static function generateToken()
    {
        $token = bin2hex(random_bytes(32));
        return $token;
    }

    public static function setToken($token, $ci, $conn)
    {
        $query = "INSERT INTO tokens VALUES (?, ?)";
        $result = $conn->execute_query($query, [$token, $ci]);
    }

    public static function chkToken($token, $conn)
    {
        $query = "SELECT * FROM tokens WHERE tokenUsuario = ? LIMIT 1";
        $result = $conn->execute_query($query, $token);
        $num = mysqli_num_rows($result);
        return $num;
    }
}
