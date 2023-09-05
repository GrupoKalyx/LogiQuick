<? if (isset($_POST['btncerrar'])) {
    header('location: loginAdmin.php');
} ?>
<DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="estilos/FormStyleBackoffice2.css">
        <link rel="stylesheet" href="estilos/backofficeStyle.css">
        <title>Backoffice</title>
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
                <?php // echo $_SESSION['nombre']; 
                ?>
            </h1>
        </div>
        <div class="form__container__backoffice">
            <div class="form">
                <h2>Usuarios registrados</h2><br>
                <iframe src="CRUD/usuarios/Consultas.php" style="height: 400px;  border-radius: 5px ;border: #ffc870 3px solid;">
                </iframe>
            </div>
            <div class="form">
                <h2>Ingresar Usuarios Nuevos</h2>
                <form action="CRUD/usuarios/Altas.php" method="post">
                    ID <input class="form__input" type="text" name="id"><br>
                    Nombre de Usuario <input class="form__input" type="text" name="nombre"><br>
                    Contraseña <input class="form__input" type="password" name="contrasenia"><br><br>
                    Tipo de usuario<input class="form__input" type="text" name="tipo" placeholder="'Admin', 'Almacen', 'Externo' o 'Camionero'"><br><br>
                    <button class="form__button" type="submit">Ingresar</button>
                </form>
            </div>
            <div class="form">
                <h2>Modificar Usuario</h2>
                <form action="CRUD/usuarios/Modificaciones.php" method="post">
                    ID <input class="form__input" type="text" name="id"><br>
                    <h2>Nuevos datos</h2>
                    Nuevo nombre de usuario <input class="form__input" type="text" name="nombre"><br>
                    Nueva contraseña <input class="form__input" type="password" name="contrasenia"><br><br>
                    <button class="form__button" type="submit">Modificar</button>
                </form>
            </div>
            <div class="form">
                <h2>Dar de baja Usuario</h2>
                <form class="m" action="CRUD/usuarios/Bajas.php" method="post">
                    ID de usuario <input class="form__input" type="text" name="id"><br><br>
                    <button class="form__button" type="submit">Eliminar</button>
                </form>
            </div>
        </div>
        <div class="form__container__backoffice">
            <div class="form">
                <h2>Almacenes registrados</h2><br>
                <iframe src="CRUD/almacenes/Consultas.php" style="height: 400px;  border-radius: 5px ;border: #ffc870 3px solid;">
                </iframe>
            </div>
            <div class="form">
                <h2> Ingresar datos de Almacen</h2>
                <form action="CRUD/almacenes/Altas.php" method="post">
                    Id de almacen <input type="text" class="form__input" name="idAlmacen">
                    Ubicacion de almacen<input class="form__input" type="text" name="ubiAlmacen">
                    Desc. de ubicación del almacen<input class="form__input" type="text" name="descUbiAlmacen"><br><br>
                    <button class="form__button" type="submit">Ingresar</button>
                </form>
            </div>
            <div class="form">
                <h2> Ingresar datos de Almacen a modificar</h2>
                <form action="CRUD/almacenes/Modificaciones.php" method="post">
                    Id de almacen<input class="form__input" type="text" name="almacen[]">
                    <h2>Nuevos datos</h2>
                    Tipo de almacen<input class="form__input" type="text" name="almacen[]">
                    Ubicacion de almacen<input class="form__input" type="text" name="almacen[]"><br><br>
                    <button class="form__button" type="submit">Modificar</button>
                </form>
            </div>
            <div class="form">
                <h2>Eliminar un almacen</h2>
                <form action="CRUD/almacenes/Bajas.php" method="post">
                    Id de almacen<input class="form__input" type="text" name="eliminarAlmacen"><br><br>
                    <button class="form__button" type="submit">Eliminar</button>
                </form>
            </div>
        </div>
        <div class="form__container__backoffice">
            <div class="form">
                <h2>Lista de paquetes</h2><br>
                <iframe src="CRUD/paquetes/Consultas.php" style="height: 400px;  border-radius: 5px ;border: #ffc870 3px solid;">>
                </iframe>
            </div>
            <div class="form">
                <h2>Ingresar paquete</h2>
                <form action="CRUD\paquetes\Altas.php" method="post">
                    Numero de Bulto<input class="form__input" type="text" name="numBulto"><br><br>
                    Estado actual<input class="form__input" type="text" name="estado"><br><br>
                    Correo del Cliente<input class="form__input" type="text" name="correo"><br><br>
                    <button type="submit" class="form__button" name="actionbtn">Ingresar</button>
                </form>
            </div>
            <div class="form">
                <h2>Modificar datos de paquete</h2>
                <form action="CRUD\paquetes\Modificaciones.php" method="post">
                    Numero de paquete<input class="form__input" type="text" name="numBulto"><br>
                    <h2>Nuevos datos</h2>
                    Estado actual<input class="form__input" type="text" name="estado"><br><br>
                    Correo del Cliente<input class="form__input" type="text" name="correo"><br><br>
                    <button type="submit" class="form__button" name="actionbtn2">Modificar</button>
                </form>
            </div>
            <div class="form">
                <h2>Eliminar paquete</h2>
                <form action="CRUD\paquetes\Bajas.php" method="post">
                    Numero de paquete<input class="form__input" type="text" name="numBulto"><br><br>
                    <button class="form__button" type="submit">Eliminar</button>
                </form>
            </div>
        </div>
        <div class="form__container__backoffice">
            <div class="form">
                <h2>Lista de lotes</h2><br>
                <iframe src="CRUD/lotes/Consultas.php" style="height: 400px;  border-radius: 5px ;border: #ffc870 3px solid;">>
                </iframe>
            </div>
            <div class="form">
                <h2>Ingresar lote</h2>
                <form action="CRUD\lotes\Altas.php" method="post">
                    Numero de lote<input class="form__input" type="text" name="numLote"><br><br>
                    Estado <input class="form__input" type="text" name="estado"><br><br>
                <button type="submit" class="form__button" name="actionbtn">Crear</button>
                </form>
                <!-- <form action="CRUD\lotes\AltasPaquete.php" method="post">
                Agregar paquete <br><input class="form__input" type="text" id="paquete" name="paquete"><br><br>
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
                </form>-->
            </div>
            <div class="form">
                <h2>Modificar datos del Lote</h2>
                <form action="CRUD\lotes\Modificaciones.php" method="post">
                    Numero de lote <input class="form__input" type="text" name="numeroLote"><br>
                    <h2>Nuevos datos</h2>
                    Estado actual <input class="form__input" type="text" name="estadoAct"><br><br>
                    <button type="submit" class="form__button">Modificar</button>
                </form>
            </div>
            <div class="form">
                <h2>Eliminar Lote</h2>
                <form action="CRUD\lotes\Bajas.php" method="post">
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