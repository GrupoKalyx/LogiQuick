<?php
require "SessionStartAdmin.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Administracion</title>
</head>

<body>
    <div class="container">
        <div class="grupo">
            <div>
                <h2>usuarios comunes registrados</h2>
                <?php
                require "ConsultaRecibida.php"
                    ?>
            </div>
            <div>
                <h2>Ingresar Usuarios Nuevos</h2>
                <form class="form" action="CRUD/Altas.php" method="post">

                    Nombre de Usuario <input type="text" name="user"><br>
                    Password <input type="text" name="pass"><br>
                    Tipo de usuario <input type="text" name="typeofuser" placeholder="(user or admin)"><br>
                    <button type="submit">Ingresar</button>
                </form>
            </div>

            <div>
                <h2>Modificar Usuario</h2>
                <form class="form" action="CRUD/Modificaciones.php" method="post">

                    Nombre de Usuario <input type="text" name="user"><br>
                    Nombre de usuario nuevo <input type="text" name="usernew"><br>
                    Nueva Password <input type="text" name="pass"><br>
                    <button type="submit">Modificar</button>
                </form>
            </div>
            <div>
                <h2>dar de baja Usuario</h2>
                <form class="form" action="CRUD/Bajas.php" method="post">

                    Nombre de Usuario <input type="text" name="user"><br>
                    <button type="submit">Eliminar</button>
                </form>
            </div>

            <div>
                <form method="post">
                    <button type="submit" name="btncerrar">cerrar la sesion</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>