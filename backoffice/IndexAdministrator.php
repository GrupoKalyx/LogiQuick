<?php
require 'SessionStartAdmin.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/FormStyle2.css">
    <link rel="stylesheet" href="../estilos/Style.css">
    <title>Administracion</title>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="navbar__logo">
                <img src="../assets/logo.png">


            </div>
            <div class="navbar__logout">
                <form method="post">
                    <button class="navbar__logout__button" name="btncerrar" type="submit">Cerrar Sesión</button>
                </form>
            </div>
        </nav>
    </header>
    <div>
        <br>
        <h1 class="nav__text"> Bienvenido:
            <?php echo $_SESSION['nombredeusuario']; ?>
        </h1>
    </div>
    <div class="form__container__backoffice">
        <div class="form">
            <h2>Usuarios registrados</h2>
            <?php
            require 'CRUD/usuarios/Consultas.php';
            ?>
        </div>
        <div class="form">
            <h2>Ingresar Usuarios Nuevos</h2>
            <form action="CRUD/usuarios/Altas.php" method="post">

                Nombre de Usuario <input class="form__input" type="text" name="user[]"><br>
                Password <input class="form__input" type="text" name="user[]"><br><br>
                Tipo <input class="form__input" type="text" name="user[]"
                    placeholder="'Almacen' , 'Externo' o 'Camionero'"><br><br>
                <button class="form__button" type="submit">Ingresar</button>
            </form>
        </div>
        <div class="form">
            <h2>Modificar Usuario</h2>
            <form action="CRUD/usuarios/Modificaciones.php" method="post">

                Nombre de Usuario <input class="form__input" type="text" name="user[]"><br>
                Nuevo Nombre de usuario <input class="form__input" type="text" name="newUser[]"><br>
                Nueva Contrasenia <input class="form__input" type="text" name="newUser[]"><br><br>
                <button class="form__button" type="submit">Modificar</button>
            </form>
        </div>
        <div class="form">
            <h2>Dar de baja Usuario</h2>
            <form class="m" action="CRUD/usuarios/Bajas.php" method="post">
                Nombre de Usuario <input class="form__input" type="text" name="user[]"><br><br>
                <button class="form__button" type="submit">Eliminar</button>
            </form>
        </div>

        <div class="form">
            <h2>Almacenes registrados</h2>
            <?php
            require 'CRUD/almacenes/Consultas.php';
            ?>
        </div>
        <div class="form">
            <h2> Ingresar datos de Almacen</h2>
            <form action="CRUD/almacenes/Altas.php" method="post">
                Id de almacen <input type="text" class="form__input" name="almacen[]">
                Tipo de almacen<input class="form__input" type="text" name="almacen[]">
                Ubicacion de almacen<input class="form__input" type="text" name="almacen[]"><br><br>
                <button class="form__button" type="submit">Ingresar!</button>
            </form>
        </div>
        <div class="form">
            <h2> Ingresar datos de Almacen a modificar</h2>
            <form action="CRUD/almacenes/Modificaciones.php" method="post">
                Id de almacen<input class="form__input" type="text" name="almacen[]">
                Tipo de almacen<input class="form__input" type="text" name="almacen[]">
                Ubicacion de almacen<input class="form__input" type="text" name="almacen[]"><br><br>
                <button class="form__button" type="submit">Modificar!</button>
            </form>
        </div>
        <div class="form">
            <h2>Eliminar un almacen</h2>
            <form action="CRUD/almacenes/Bajas.php" method="post">
                Id de almacen<input class="from_input" type="text" name="eliminarAlmacen"><br><br>
                <button class="form__button" type="submit">Eliminar</button>
            </form>
        </div>
    </div>
    <div class="form__container__backoffice">
        <div class="form">
            <h2>Lista de paquetes!</h2>
            <iframe src="CRUD/paquetes/mostrarLista.php"
                style="; height: 500px;  border-radius: 5px ;border: #ffc870 3px solid;">>
            </iframe>
        </div>
        <div class="form">
            <h2>Ingresar paquete</h2>
            <form action="CRUD\paquetes\Altas.php" method="post">
                Numero de paquete<input class="from_input" type="text" name="numBulto"><br><br>
                volumen <br><input class="from_input" type="text" name="vol" placeholder="Metros Cubicos (m3)"><br><br>
                Estado actual<input class="from_input" type="text" name="estado"><br><br>
                Correo del Cliente<input class="from_input" type="text" name="correo"><br><br>
                <button type="submit"  class="form__button" name="actionbtn">Ingresar!</button>
            </form>
        </div>
        <div class="form">
            <h2>Modificar datos de paquete</h2>
            <form action="CRUD\paquetes\Modificaciones.php" method="post">
                Numero de paquete<input class="from_input" type="text" name="numBulto"><br><br>
                <h2>nuevos datos</h2>
                volumen <br><input class="from_input" type="text" name="vol" placeholder="Metros Cubicos (m3)"><br><br>
                Estado actual<input class="from_input" type="text" name="estado"><br><br>
                Correo del Cliente<input class="from_input" type="text" name="correo"><br><br>
                <button type="submit" class="form__button" name="actionbtn2">Modificar!</button>
            </form>

        </div>
        <div class="form">
            <h2>Eliminar paquete</h2>
            <form action="CRUD\paquetes\Bajas.php" method="post">
                Numero de paquete<input class="from_input" type="text" name="numBulto"><br><br>
                <button class="form__button" type="submit">Eliminar!</button>
            </form>

        </div>
    </div>

    </div>




    <footer>
        <div class="footer">
            <ul class="footer_list">
                <li class="footer__list__item"><a href="">¡Contactanos!</a></li>
                <li class="footer__list__item"><a href="">Sobre Nosotros</a></li>
            </ul>
            <div class="footer__copyright">
                <p>Copyright © 2023 Kalyx Software. Todos los derechos reservados</p>
            </div>
        </div>
    </footer>
</body>

</html>
<?php


?>