<?php
require '../sql/dbconection.php';
if (isset($_POST['login'])) {

    function createGUID()
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double) microtime() * 10000);
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


    $username = $_POST['username'];
    $password = $_POST['password'];
    $typeofuser = $_POST['typeofuser'];

    $query2 = mysqli_query($conn, "INSERT INTO sessiontoken VALUES ('$new_GUID' , '$username')");


    $query = mysqli_query($conn, "SELECT * FROM `Usuarios` WHERE Username  = '" . $username . "' and Password = '" . $password . "' and TipoDeUsuario = '$typeofuser' ");

    $nrows = mysqli_num_rows($query);
    // nao funca !! $result = mysqli_query($conn, "SELECT 'TipoDeUsuario' FROM Usuarios WHERE 'Username' = '" . $username . "'");

    if ($nrows == 1 && $typeofuser === 'Admin') {
        $_SESSION['nombredeusuario'] = $username;
        $_SESSION['chkT'] = $new_GUID;
        header("Location:../backoffice/IndexAdministrator.php");
    } elseif ($nrows == 1 && $typeofuser === 'Almacen') {
        $_SESSION['nombredeusuario'] = $username;
        $_SESSION['chkT'] = $new_GUID;
        header("location: ../FuncionarioAlmacen/Almacenes/IndexPrincipal.php");
    } elseif ($nrows == 1 && $typeofuser === 'Externo') {
        $_SESSION['nombredeusuario'] = $username;
        $_SESSION['chkT'] = $new_GUID;
        header("location: ../FuncionarioAlmacen/Almacenes/IndexPrincipal.php");
    } elseif ($nrows == 1 && $typeofuser === 'Camionero') {
        $_SESSION['nombredeusuario'] = $username;
        $_SESSION['chkT'] = $new_GUID;
        header("location:../Camionero.html");
    } elseif ($nrows == 0) {
        echo "<script>alert('usuario inexistente , re intente por favor!');window.location='Login.php'</script>";
    }
}







?>