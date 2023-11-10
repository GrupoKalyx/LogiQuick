<?php
require_once('../../sql/dbconection.php');

$ci = $_POST['ci'];
$nuevoNombre = $_POST['nombre'];
$nuevaContrasenia = $_POST['contrasenia'];

$queryTipo = "SELECT tipo FROM `usuarios` WHERE ci = ?";
$exc = $conn->execute_query($queryTipo, [$ci]);
$tipo = $exc->fetch_array(MYSQLI_ASSOC);

if (isset($_POST['telefono']) and ($tipo == 'Camionero' or $tipo == 'Delivery')) {
    $telefono = $_POST['telefono'];
    if ($tipo == 'Camionero') {
        $query3 = "INSERT INTO conductores VALUES (?, ?, ?)";
        $exc3 = $conn->execute_query($query3, [$ci, $nuevoNombre, $telefono]);
        $query4 = "INSERT INTO conductores VALUES (?, ?, ?)";
        $exc4 = $conn->execute_query($query4, [$ci, $nuevoNombre, $telefono]);
        $exc = ($exc and $exc3 and $exc4);
    } else if ($tipo == 'Delivery') {
        $query3 = "INSERT INTO conductores VALUES (?, ?, ?)";
        $exc3 = $conn->execute_query($query3, [$ci, $nuevoNombre, $telefono]);
        $query4 = "INSERT INTO delivery VALUES (?, ?, ?)";
        $exc4 = $conn->execute_query($query4, [$ci, $nuevoNombre, $telefono]);
        $exc = ($exc and $exc3 and $exc4);
    }
}

$query = "UPDATE usuarios SET nombre = ? AND contrasenia = ? WHERE ci = ?";
$excUsers = $conn->execute_query($query, [$nuevoNombre, $nuevaContrasenia, $ci]);
$exc = ($exc and $excUsers);

if ($exc) {
    echo "<script>alert('Usuario modificado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
    echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}
