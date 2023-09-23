<?php

class modeloTokens
{
    public static function generateToken()
    {
        $token = bin2hex(random_bytes(32));
        return $token;
    }

    public static function setToken($token, $ci, $conn)
    {
        $query = "INSERT INTO tokens (ci, idToken) VALUES (?, ?)";
        $conn->execute_query($query, [$ci, $token]);
    }

    public static function chkToken($token, $conn)
    {
        $query = "SELECT * FROM tokens WHERE idToken = ? LIMIT 1";
        $result = $conn->execute_query($query, $token);
        $num = mysqli_num_rows($result);
        return $num;
    }

    public static function chkUser($ci, $conn)
    {
        $query = "SELECT * FROM tokens WHERE ci = ? LIMIT 1";
        $result = $conn->execute_query($query, [$ci]);
        $num = mysqli_num_rows($result);
        return $num;
    }
}
