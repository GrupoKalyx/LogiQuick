<?php

class modeloTokens
{
    public static function generateToken()
    {
        $token = bin2hex(random_bytes(32));
        return $token;
    }

    public static function setToken($ci, $token, $conn)
    {
        $query = "INSERT INTO tokens (ci, token) VALUES (?, ?)";
        $result = $conn->execute_query($query, [$ci, $token]);
    }

    public static function chkToken($token, $conn)
    {
        $query = "SELECT * FROM tokens WHERE token = ? LIMIT 1";
        $result = $conn->execute_query($query, $token);
        $num = mysqli_num_rows($result);
        return $num;
    }
}