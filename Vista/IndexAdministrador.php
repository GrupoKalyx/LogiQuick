<?php
session_start();
require '../Control/superControlador.php';
if(isset($_POST['btncerrar'])){
    session_destroy();
    header('location: login.php');
}
?>
<DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Vista/estilos/FormStyle2.css">
        <link rel="stylesheet" href="../Vista/estilos/style.css">
        <title>Administracion</title>
    </head>

    <body>
        <header>
            <nav class="navbar">
                <div class="navbar__logo">
                    <img src="../Vista/assets/logo.png">
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
                <?//$_SESSION['nombre']?>
            </h1>
        </div>
        <div class="form__container__backoffice">
            <div class="form">
                <h2>Usuarios registrados</h2><br>
                <iframe src="../Control/superControlador.php/Usuarios/mostrar" style=" width: 16em; height: 400px;  border-radius: 5px ;border: #ffc870 3px solid;">
                </iframe>
            </div>
            <div class="form">
                <h2>Ingresar Usuarios Nuevos</h2>
                <form action="../Control/superControlador.php/Usuarios/ingresar" method="post">
                    ID <input class="form__input" type="text" name="id"><br>
                    Nombre de Usuario <input class="form__input" type="text" name="nombre"><br>
                    Contraseña <input class="form__input" type="password" name="contrasenia"><br><br>
                    Tipo <input class="form__input" type="text" name="tipo" placeholder="'Almacen' , 'Externo' o 'Camionero'"><br><br>
                    <button class="form__button" type="submit">Ingresar</button>
                </form>
            </div>
            <div class="form">
                <h2>Modificar Usuario</h2>
                <form action="../Control/superControlador.php/Usuarios/modificar" method="post">
                    ID <input class="form__input" type="text" name="id"><br>
                    Nuevo nombre de usuario <input class="form__input" type="text" name="nombre"><br>
                    Nueva contraseña <input class="form__input" type="text" name="contrasenia"><br><br>
                    <button class="form__button" type="submit">Modificar</button>
                </form>
            </div>
            <div class="form">
                <h2>Dar de baja Usuario</h2>
                <form class="m" action="../Control/superControlador.php/Usuarios/eliminar" method="post">
                    ID de Usuario <input class="form__input" type="text" name="id"><br><br>
                    <button class="form__button" type="submit">Eliminar</button>
                </form>
            </div>
            <div class="form">
                <h2>Almacenes registrados</h2><br>
                <iframe src="../Control/superControlador.php/almacenes/mostrar" style="height: 400px;  width: 16em; border-radius: 5px ;border: #ffc870 3px solid;">
                </iframe>
            </div>
            <div class="form">
                <h2> Ingresar datos de Almacen</h2>
                <form action="../Control/superControlador.php/Almacenes/ingresar" method="post">
                    Id de almacen <input type="text" class="form__input" name="almacen[]">
                    Tipo de almacen<input class="form__input" type="text" name="almacen[]">
                    Ubicacion de almacen<input class="form__input" type="text" name="almacen[]"><br><br>
                    <button class="form__button" type="submit">Ingresar</button>
                </form>
            </div>
            <div class="form">
                <h2> Ingresar datos de Almacen a modificar</h2>
                <form action="../Control/superControlador.php/Almacenes/modificar" method="post">
                    Id de almacen<input class="form__input" type="text" name="almacen[]">
                    Tipo de almacen<input class="form__input" type="text" name="almacen[]">
                    Ubicacion de almacen<input class="form__input" type="text" name="almacen[]"><br><br>
                    <button class="form__button" type="submit">Modificar</button>
                </form>
            </div>
            <div class="form">
                <h2>Eliminar un almacen</h2>
                <form action="../Control/superControlador.php/Almacenes/eliminar" method="post">
                    Id de almacen<input class="form__input" type="text" name="eliminarAlmacen"><br><br>
                    <button class="form__button" type="submit">Eliminar</button>
                </form>
            </div>
        </div>
        <div class="form__container__backoffice">
            <div class="form">
                <h2>Lista de paquetes</h2><br>
                <iframe src="../Control/superControlador.php/paquetes/mostrar" style="height: 400px; width: 16em; border-radius: 5px ;border: #ffc870 3px solid;">>
                </iframe>
            </div>
            <div class="form">
                <h2>Ingresar paquete</h2>
                <form action="../Control/superControlador.php/Paquetes/ingresar" method="post">
                    Numero de Bulto<input class="form__input" type="text" name="numBulto"><br><br>
                    Estado actual<input class="form__input" type="text" name="estado"><br><br>
                    Correo del Cliente<input class="form__input" type="text" name="correo"><br><br>
                    <button type="submit" class="form__button" name="actionbtn">Ingresar</button>
                </form>
            </div>
            <div class="form">
                <h2>Modificar datos de paquete</h2>
                <form action="../Control/superControlador.php/Paquetes/modificar>
                    Numero de paquete<input class="form__input" type="text" name="numBulto"><br>
                    <h2>nuevos datos</h2>
                    volumen <br><input class="form__input" type="text" name="vol" placeholder="Metros Cubicos (m3)"><br><br>
                    Estado actual<input class="form__input" type="text" name="estado"><br><br>
                    Correo del Cliente<input class="form__input" type="text" name="correo"><br><br>
                    <button type="submit" class="form__button" name="actionbtn2">Modificar</button>
                </form>
            </div>
            <div class="form">
                <h2>Eliminar paquete</h2>
                <form action="../Control/superControlador.php/Paquetes/eliminar" method="post">
                    Numero de paquete<input class="form__input" type="text" name="numBulto"><br><br>
                    <button class="form__button" type="submit">Eliminar</button>
                </form>
            </div>
        </div>
        <div class="form__container__backoffice">
            <div class="form">
                <h2>Lista de lotes</h2><br>
                <iframe src="../Control/superControlador.php/Lotes/mostrar" style="height: 400px; width: 16em; border-radius: 5px ;border: #ffc870 3px solid;">>
                </iframe>
            </div>
            <div class="form">
                <h2>Ingresar lote</h2>
                <form action="../Control/superControlador.php/Lotes/ingresar" method="post">

                    Numero de lote<input class="form__input" type="text" name="numLote"><br><br>
                    Estado <input class="form__input" type="text" name="estado"><br><br>
                    Ingrese paquetes <br><input class="form__input" type="text" id="paquete" name="paquete"><br><br>
                    <button class="form__button" formaction="CRUD\lotes\MandarPaquetesLote.php" type="button" name="btn" id="btn">Agregar</button><br>
                    <script>
                        const button = document.getElementById("btn");

                        function pushData() {
                            const elem = document.getElementById("paquete");
                            const cambio = document.getElementById("textoRecibido").innerHTML = elem.value;
                        }
                        button.addEventListener("click", pushData);
                    </script>
                    <span>
                        Ultimo paquete ingresado (ID) : <span id="textoRecibido">#</span>
                    </span><br><br>
                    <button type="submit" class="form__button" name="actionbtn">Ingresar</button>
                </form>
            </div>
            <div class="form">
                <h2>Modificar datos del Lote</h2>
                <form action="../Control/superControlador.php/Lotes/modificar" method="post">
                    Numero de lote<input class="form__input" type="text" name="numeroLote"><br>
                    <h2>nuevos datos</h2>
                    Estado actual<input class="form__input" type="text" name="estadoAct"><br><br>
                    <button type="submit" class="form__button">Modificar</button>
                </form>
            </div>
            <div class="form">
                <h2>Eliminar Lote</h2>
                <form action="../Control/superControlador.php/Lotes/eliminar" method="post">
                    Numero de Lote<input class="form__input" type="text" name="eliminacion"><br><br>
                    <button class="form__button" type="submit">Eliminar</button>
                </form>
            </div>
        </div>
        <footer>
            <div class="footer">
                <ul class="footer_list">
                    <li class="footer__list__item"><a href="">¡Contactanos</a></li>
                    <li class="footer__list__item"><a href="">Sobre Nosotros</a></li>
                </ul>
                <div class="footer__copyright">
                    <p>Copyright © 2023 Kalyx Software. Todos los derechos reservados</p>
                </div>
            </div>
        </footer>
    </body>

    </html>