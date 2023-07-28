<?php
require '../sql/dbconection.php';
function createGUID()
{
    if (function_exists('com_create_guid')) {
        return com_create_guid();
    } else {
        mt_srand((float) microtime() * 10000);
        //optional for php 4.2.0 and up.
        $set_charid = strtoupper(md5(uniqid(rand(), true)));
        $set_hyphen = chr(45);
        // "-"
        $set_uuid = chr(123)
            . substr($set_charid, 0, 8) . $set_hyphen
            . substr($set_charid, 8, 4) . $set_hyphen
            . substr($set_charid, 12, 4) . $set_hyphen
            . substr($set_charid, 16, 4) . $set_hyphen
            . substr($set_charid, 20, 12)
            . chr(125);
        // 
        return $set_uuid;
    }
}
$new_GUID = createGUID();
// Baja de datos de POST
$ciSesion = $_POST["ciUsuario"];
$contraseniaUsuario = $_POST['contraseniaUsuario'];
// Query para determinar el tipo de usuario
$queryTipo = mysqli_query($conn, "SELECT tipoUsuario FROM `usuarios` WHERE ci  = '" . $ciSesion . "'");
while ($row = $queryTipo->fetch_array()) {
    $key = $row[0];
}
// Query para determinar la cantidad de filas    
$queryUsuario = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE ci  = '" . $ciSesion . "'");
$nrows = mysqli_num_rows($queryUsuario);
// Se determina la página a la que enviar al usuario segun su tipo
if ($nrows == 1) {
    if ($key == 'Admin') {
        $_SESSION['ciSesion'] = $ciSesion;
        $_SESSION['chkToken'] = $new_GUID;
        header("Location:../backoffice/IndexAdministrator.php");
    } elseif ($key == 'Almacen') {
        $_SESSION['ciSesion'] = $ciSesion;
        $_SESSION['chkToken'] = $new_GUID;
        header("location: ../FuncionarioAlmacen/Almacenes/IndexPrincipal.php");
    } elseif ($key == 'Externo') {
        $_SESSION['ciSesion'] = $ciSesion;
        $_SESSION['chkToken'] = $new_GUID;
        header("location: ../FuncionarioAlmacen/Almacenes/IndexPrincipal.php");
    } elseif ($key == 'Camionero') {
        $_SESSION['ciSesion'] = $ciSesion;
        $_SESSION['chkToken'] = $new_GUID;
        header("location:../Camionero.html");
    }
} elseif ($nrows == 0) {
    echo "<script>alert('Nombre de usuario o contraseña incorrectos, reintente por favor.');window.location='Login.php'</script>";
}
