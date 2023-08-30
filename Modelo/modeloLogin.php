<?php

class modeloLogin
{
    public static function existe($ci, $conn)
    {
        $query = "SELECT * FROM `usuarios` WHERE ci = ? LIMIT 1";
        $result = $conn->execute_query($query, ['1']);
        $num = mysqli_num_rows($result);
        return $num;
    }

    public static function contrasenia($ci, $contrasenia, $conn)
    {
        $query = "SELECT * FROM `logins` WHERE id = ? AND contrasenia = ? LIMIT 1";
        $result = $conn->execute_query($query, [$ci, $contrasenia]);
        $num = mysqli_num_rows($result);
        return $num;
    }

    public static function tipo($ci, $conn)
    {
        $query = "SELECT tipo FROM `usuarios` WHERE ci = ? LIMIT 1";
        $result = $conn->execute_query($query, [$ci]);
        $fResult =  $result->fetch_array(MYSQLI_ASSOC);
        return json_encode($fResult);
    }
}
