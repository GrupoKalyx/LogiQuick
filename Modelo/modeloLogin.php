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
        $query = "SELECT * FROM `usuarios` WHERE ci = ? LIMIT 1";
        $result = $this->conn->execute_query($query, ['1']);
        $num = mysqli_num_rows($result);
        return $num;
    }

    public function contrasenia($ci, $contrasenia)
    {
        $query = "SELECT * FROM `logins` WHERE id = ? AND contrasenia = ? LIMIT 1";
        $result = $this->conn->execute_query($query, [$ci, $contrasenia]);
        $num = mysqli_num_rows($result);
        return $num;
    }

    public function tipo($ci)
    {
        $query = "SELECT tipo FROM `usuarios` WHERE ci = ? LIMIT 1";
        $result = $this->conn->execute_query($query, [$ci]);
        $fResult =  $result->fetch_array(MYSQLI_ASSOC);
        return json_encode($fResult);
    }
}
