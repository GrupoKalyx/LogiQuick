<?php
session_start();
require "dbconection.php";
$tokenRecived = $_SESSION['chkT'];
//echo"$tokenRecived";

if( mysqli_query($conn, "SELECT userToken FROM sessiontoken WHERE userToken = '$tokenRecived'")== true){

//if($conn->query($sql1) === TRUE) {
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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion</title>
</head>

<body>


    <h1>usuarios comunes registrados</h1>
    <?php


    function httpRequest($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        return $data;
    }


    $dato = json_decode(httpRequest("http://127.0.0.1/Projectov4/backoffice/dbconsult.php"));

    foreach ($dato as $value) {

        foreach ($value as $key => $v) {

            echo " " . $key . " " . $v;
        }
       
    }
    $_SESSION['keystored'] = $key;
    $_SESSION['vstored'] = $v;
    ?>

<div>
    <h2>Ingresar Usuarios Nuevos</h2>
    <form action="Altas.php" method="post">

        Nombre de Usuario <input type="text" name="user"><br>
        Password <input type="text" name="pass"><br>
        Tipo de usuario <input type="text" name="typeofuser" placeholder="(user or admin)"><br>
        <button type="submit">Ingresar</button>
    </form>
</div>

<div>
    <h2>Modificar Usuario</h2>
    <form action="Modificaciones.php" method="post">

        Nombre de Usuario <input type="text" name="user"><br>
        Nombre de usuario nuevo <input type="text" name="usernew"><br>
        Nueva Password <input type="text" name="pass"><br>
        <button type="submit">Modificar</button>
    </form>
</div>
<div>
    <h2>dar de baja Usuario</h2>
    <form action="Bajas.php" method="post">

        Nombre de Usuario <input type="text" name="user"><br>
        <button type="submit">Eliminar</button>
    </form>
</div>

<div>
    <form  method="post">
        <button type="submit" name="btncerrar">cerrar la sesion</button>
    </form>
</div>

</body>

</html>