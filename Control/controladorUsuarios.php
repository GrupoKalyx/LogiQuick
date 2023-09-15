<?php
require '../Modelo/modeloUsuarios.php';
class controladorUsuarios
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function ingresar($context)
    {
        $ci = $context['post']['ci'];
        $nombre = $context['post']['nombre'];
        $contrasenia = $context['post']['contrasenia'];
        $tipo = $context['post']['tipo'];
        modeloUsuarios::alta($ci, $nombre, $contrasenia, $tipo, $this->conn);
        header('location: ../../../Vista/indexAdministrador.php');
    }

    public function eliminar($context)
    {
        $ci = $context['post']['ci'];
        modeloUsuarios::baja($ci, $this->conn);
        header('location: ../../../Vista/indexAdministrador.php');
    }

    public function mostrar($context){
        $ci = $context;
        $result = json_decode(modeloUsuarios::muestra($ci, $this->conn), true);
        return $result;
    }

    public function listar($context)
    {
        $result = json_decode(modeloUsuarios::listado($this->conn));

        $arrayConsulta = array();

        foreach ($result as $row) {
            $ci = $row->ci;
            $nombreUsuario = $row->nombre;
            $tipoUsuario = $row->tipo;
            array_push($arrayConsulta, ['CI: ' => $ci, '<br> Nombre: ' => $nombreUsuario, '<br> Tipo: ' => $tipoUsuario . '<br><br>']);
        }

        foreach ($arrayConsulta as $value) {
            foreach ($value as $key => $v) {
                echo "<a class='form__viewContent'> " . $key . " " . $v . "</a>";
            }
        }
    }

    public function modificar($context)
    {
        $ci = $context['post']['ci'];
        $nombre = $context['post']['nombre'];
        $contrasenia = $context['post']['contrasenia'];
        modeloUsuarios::modificacion($ci, $nombre, $contrasenia, $this->conn);
        header('location: ../../../Vista/indexAdministrador.php');
    }
}
