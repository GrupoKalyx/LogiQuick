<?php
require_once "modeloBd.php";

class modeloLogin extends modeloBd
{

    // public function __construct()
    // {
    //     parent::__construct();
    // }

    public function existe($ci)
    {
        $query = "SELECT * FROM `usuarios` WHERE ci = ? LIMIT 1";
        $result = parent::conexion()->execute_query($query, ['1']);
        $num = mysqli_num_rows($result);
        return $num;
    }

    public function contrasenia($ci, $contrasenia)
    {
        $query = "SELECT * FROM Logins WHERE idLogin = ?, contrasenia = ? LIMIT 1";
        $result = parent::conexion()->execute_query($query, [$ci], [$contrasenia]);
        $num = mysqli_num_rows($result);
        return $num;
    }

    public function tipo($ci)
    {
        $query = "SELECT tipoUsuario FROM `Usuarios` WHERE ci = ? LIMIT 1";
        $result = parent::conexion()->execute_query($query, [$ci]);
        $result->fetch_array(MYSQLI_ASSOC);
        return json_encode($result);
    }
}
