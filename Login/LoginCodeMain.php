<?php
if (isset($_POST['login'])) {
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
    $ci = $_POST['ci'];
    $query->exec($conn, "INSERT INTO token VALUES ('$new_GUID' , '$ci')");

    $queryTipo = mysqli_query($conn, "SELECT tipoUsuario FROM `usuarios` WHERE ci  = '" . $ci . "' ");
    while ($row = $queryTipo->fetch_array()) {
        $key = $row[0];
    }

    $queryUsuario = mysqli_query($conn, "SELECT * FROM `Usuarios` WHERE ci  = '" . $ci . "'");
    $nrows = mysqli_num_rows($queryUsuario);
    if ($nrows == 1 &&  $key == 'Admin') {
        $_SESSION['ci'] = $ci;
        $_SESSION['chkT'] = $new_GUID;
        header("Location:../backoffice/IndexAdministrator.php");
    } elseif ($nrows == 1 && $key == 'Almacen') {
        $_SESSION['ci'] = $ci;
        $_SESSION['chkT'] = $new_GUID;
        header("location: ../FuncionarioAlmacen/Almacenes/IndexPrincipal.php");
    } elseif ($nrows == 1 && $key == 'Externo') {
        $_SESSION['ci'] = $ci;
        $_SESSION['chkT'] = $new_GUID;
        header("location: ../FuncionarioAlmacen/Almacenes/IndexPrincipal.php");
    } elseif ($nrows == 1 && $key == 'Camionero') {
        $_SESSION['ci'] = $ci;
        $_SESSION['chkT'] = $new_GUID;
        header("location:../Camionero.html");
    } elseif ($nrows == 0) {
        echo "<script>alert('Usuario inexistente ,re intente por favor!');window.location='login.php'</script>";
    }
}
