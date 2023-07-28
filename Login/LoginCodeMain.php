<?php
require '../sql/dbconection.php';
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

    $ciSesion = $_SESSION['ci'];
    $nombreUsuario = $_POST['nombreUsuario'];
    $contraseniaUsuario = $_POST['contraseniaUsuario'];

    // $queryToken = mysqli_query($conn, "INSERT INTO token VALUES ('$new_GUID', '$ciSesion')");
    // Query para determinar el tipo de usuario
    $queryTipo = mysqli_query($conn, "SELECT tipoUsuarios FROM `usuarios` WHERE ci  = '" . $ci . "'");
    while($row = $queryTipo->fetch_array()){
        $key = $row[0];
    } 
    // Query para determinar la cantidad de filas    
    $queryUsuario = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE ci  = '" . $ci . "'");
    $nrows = mysqli_num_rows($queryUsuario);

    if($nrows == 1){
        if ($key == 'Admin') {
            $_SESSION['ci'] = $ci;
            $_SESSION['chkToken'] = $new_GUID;
            header("Location:../backoffice/IndexAdministrator.php");
        } elseif ($key == 'Almacen') {
            $_SESSION['ci'] = $ci;
            $_SESSION['chkToken'] = $new_GUID;
            header("location: ../FuncionarioAlmacen/Almacenes/IndexPrincipal.php");
        } elseif ($key == 'Externo') {
            $_SESSION['ci'] = $ci;
            $_SESSION['chkToken'] = $new_GUID;
            header("location: ../FuncionarioAlmacen/Almacenes/IndexPrincipal.php");
        } elseif (key == 'Camionero') {
            $_SESSION['ci'] = $ci;
            $_SESSION['chkToken'] = $new_GUID;
            header("location:../Camionero.html");
        }
    } elseif ($nrows == 0) {
        var_dump($_SESSION['ci']);
        // echo "<script>alert('Nombre de usuario o contraseña incorrectos, reintente por favor.');window.location='Login.php'</script>";
    }
}