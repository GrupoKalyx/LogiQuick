<?php
require_once('../../sql/dbconection.php');

$ci = $_POST['ci'];
$nuevoNombre = $_POST['nombre'];
$nuevaContrasenia = $_POST['contrasenia'];
$query = "UPDATE usuarios SET nombre = ? WHERE ci = ?";
$exc = $conn->execute_query($query, [$nuevoNombre, $ci]);
$query2 = "UPDATE logins SET contrasenia = ? WHERE idLogin = ?";
$exc2 = $conn->execute_query($query2, [$nuevaContrasenia, $ci]);

$queryTipo = "SELECT tipo FROM `usuarios` WHERE ci = ?";
$exc = $conn->execute_query($queryTipo, [$ci]);
$tipo = $exc->fetch_array(MYSQLI_ASSOC);

if (isset($_POST['telefono']) and ($tipo == 'Camionero' or $tipo == 'Delivery')) {
    $telefono = $_POST['telefono'];
    if ($tipo == 'Camionero') {
        $query3 = "INSERT INTO conductores VALUES (?, ?, ?)";
        $exc3 = $conn->execute_query($query3, [$ci, $nombre, $telefono]);
        $query4 = "INSERT INTO conductores VALUES (?, ?, ?)";
        $exc4 = $conn->execute_query($query4, [$ci, $nombre, $telefono]);
    } else if ($tipo == 'Delivery') {
        $query3 = "INSERT INTO conductores VALUES (?, ?, ?)";
        $exc3 = $conn->execute_query($query3, [$ci, $nombre, $telefono]);
        $query4 = "INSERT INTO delivery VALUES (?, ?, ?)";
        $exc4 = $conn->execute_query($query4, [$ci, $nombre, $telefono]);
    }
}



if ($exc and $exc2) {
    echo "<script>alert('Usuario modificado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
    echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}
