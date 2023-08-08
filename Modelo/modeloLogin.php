<?php
class login
{
    public static function existe($conn, $ci)
    {
        $query = "SELECT * FROM `Usuarios` WHERE ci = ? LIMIT 1";
        $result = $conn->execute_query($query, [$ci]);
        $num = mysqli_num_rows($result);
        return $num;
    }

    public static function contrasenia($conn, $ci, $contrasenia)
    {
        $query = "SELECT * FROM Logins WHERE idLogin = ?, contrasenia = ? LIMIT 1";
        $result = $conn->execute_query($query, [$ci], [$contrasenia]);
        $num = mysqli_num_rows($result);
        return $num;
    }

    public static function tipo($conn, $ci)
    {
        $query = "SELECT tipoUsuario FROM `Usuarios` WHERE ci = ? LIMIT 1";
        $result = $conn->execute_query($query, [$ci]);
        $result->fetch_array(MYSQLI_ASSOC);
        return $result;
    }
}
