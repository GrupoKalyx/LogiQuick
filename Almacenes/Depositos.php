<?php
session_start();
require "dbconection.php";
$tokenRecived = $_SESSION['chkT'];

if( mysqli_query($conn, "SELECT userToken FROM sessiontoken WHERE userToken = '$tokenRecived'")== true){
if (isset($_SESSION['nombredeusuario'])) {
    $usuarioigresado = $_SESSION['nombredeusuario'];
    echo "<h1>Bienvenido: $usuarioigresado</h1>";

}else{
    header("location: http://localhost/Projectov4/Login/IndexprincipalLogin.php");
}
if (isset($_POST['btncerrar'])) {
    session_destroy();
    header("location: http://localhost/Projectov4/Login/IndexprincipalLogin.php");
}
}else{
    echo"ERROOOOOOOOOOOOOOOOOOOR";
    header("location: http://localhost/Projectov4/Login/IndexprincipalLogin.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estilo.css" type="text/css">
    <title>Seleccion de almacen</title>

</head>

<body>
    <div class="padre">
        <div class="formone">
            <p>
            <h2>ALmacen N1</h2>
            <form class="form" action="http://localhost/Projectov4/Almacen/index.php">
                <button type="submit">Ir a Almacen</button>
            </form>
            </p>
            </div>
        <div class="formtwo">
        <h2>Almacen N2</h2>
        <form class="form2" action="http://localhost/Projectov4/Almacen2/index.php">
            <button type="submit">ir a Almacen</button>

        </form>
    
    </div>
    </div>
    <div>
    <form  method="post">
        <button type="submit" name="btncerrar">cerrar la sesion</button>
    </form>
</div>
</body>

</html>