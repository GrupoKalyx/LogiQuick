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

                <h1 class="nav__text">Welcome:
                    <?php echo $_SESSION['nombredeusuario']; ?>
                </h1>

            </div>
            <div class="navbar__logout">
                <form method="post">
                    <button class="navbar__logout__button" name="btncerrar" type="submit">Logout</button>
                </form>
            </div>
        </nav>
    </header>
        <div class="form__container__backoffice">
            <div class="form">
                <h2>Registered Users</h2>
                <?php
                require 'CRUD/usuarios/Consultas.php';
                ?>
            </div>
            <div class="form">
                <h2>Enter New User</h2>
                <form action="CRUD/usuarios/Altas.php" method="post">

                    Username <input class="form__input" type="text" name="user[]"><br>
                    Password <input class="form__input" type="text" name="user[]"><br><br>
                    Type <input class="form__input" type="text" name="user[]"
                        placeholder="'Almacen' , 'Externo' o 'Camionero'"><br><br>
                    <button class="form__button" type="submit">Enter</button>
                </form>
            </div>
            <div class="form">
                <h2>Modify User</h2>
                <form action="CRUD/usuarios/Modificaciones.php" method="post">

                    Username <input class="form__input" type="text" name="user[]"><br>
                    New Username<input class="form__input" type="text" name="newUser[]"><br>
                    New Password <input class="form__input" type="text" name="newUser[]"><br><br>
                    <button class="form__button" type="submit">Modify</button>
                </form>
            </div>
            <div class="form">
                <h2>Delete User</h2>
                <form class="m" action="CRUD/usuarios/Bajas.php" method="post">
                    Username <input class="form__input" type="text" name="user[]"><br><br>
                    <button class="form__button" type="submit">Delete</button>
                </form>
            </div>
            
            <div class="form">
                <h2>Registered Storages</h2>
                <?php
                require 'CRUD/almacenes/Consultas.php';
                ?>
            </div>
            <div class="form">
                <h2> Enter Storage Data</h2>
                <form action="CRUD/almacenes/Altas.php" method="post">
                    Storage ID <input type="text" class="form__input" name="almacen[]">
                    Storage Type<input class="form__input" type="text" name="almacen[]">
                    Storage Location<input class="form__input" type="text" name="almacen[]"><br><br>
                    <button class="form__button" type="submit">Enter</button>
                </form>
            </div>
            <div class="form">
                <h2> Enter Storage data to modify</h2>
                <form action="CRUD/almacenes/Modificaciones.php" method="post">
                    Storage ID<input class="form__input" type="text" name="almacen[]">
                    Storage Typ<input class="form__input" type="text" name="almacen[]">
                    Storage Location<input class="form__input" type="text" name="almacen[]"><br><br>
                    <button class="form__button" type="submit">Modify</button>
                </form>
            </div>
            <div class="form">
                <h2>Delete Storage</h2>
                <form action="CRUD/almacenes/Bajas.php" method="post">
                    Storage ID<input class="from_input" type="text" name="eliminarAlmacen"><br><br>
                    <button class="form__button" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>


    <footer>
        <div class="footer">
            <ul class="footer_list">
                <li class="footer__list__item"><a href="">¡Contact us!</a></li>
                <li class="footer__list__item"><a href="">About us</a></li>
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