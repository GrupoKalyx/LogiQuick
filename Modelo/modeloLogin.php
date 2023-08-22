<?php
require_once "modeloBd.php";

class modeloLogin extends modeloBd
{
    public function __construct()
    {
        parent::__construct();
    }

    public function existe($ci)
    {
        $query = "SELECT * FROM `Usuarios` WHERE ci = ? LIMIT 1";
        $conexion = $this->conn;
        $result = $conexion->execute_query($query, [$ci]);    //da error "Funcion inexistente mysqli::execute_query"
        $num = mysqli_num_rows($result);
        return $num;
    }

    public function contrasenia($ci, $contrasenia)
    {
        $query = "SELECT * FROM Logins WHERE idLogin = ?, contrasenia = ? LIMIT 1";
        $result = $this->conn->execute_query($query, [$ci], [$contrasenia]);
        $num = mysqli_num_rows($result);
        return $num;
    }

    public function tipo($ci)
    {
        $query = "SELECT tipoUsuario FROM `Usuarios` WHERE ci = ? LIMIT 1";
        $result = $this->conn->execute_query($query, [$ci]);
        $result->fetch_array(MYSQLI_ASSOC);
        return json_encode($result);
    }
}
