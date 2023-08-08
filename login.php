<?php
session_start();
require 'Control/superControlador.php';
if (isset($_POST['login'])) {
    superControlador::controladorLogin();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Vista/estilos/FormStyle.css">
    <link rel="stylesheet" href="Vista/estilos/Style.css">
    <title>Ingresar a LogiQuick!</title>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="navbar__logo">
                <img src="assets/logo.png">
            </div>
            <div class="navbar">
                <h1 class="nav__text">Bienvenido a LogiQuick! </h1>
            </div>
        </nav>
    </header>
    <div class="form__container">
        <form class="form" method="POST" action="">
            <h2 class="form__text">Ingrese sus Datos</h2>
            <div class="form__group">
                <label class="form__label" for="ci">Id:</label>
                <input class="form__input" type="text" id="ci" name="ci" required>
            </div>
            <div class="form__group">
                <label class="form__label" for="contrasenia">Contraseña:</label>
                <input class="form__input" type="password" id="contrasenia" name="contrasenia" required>
            </div>
            <br>
            <button class="form__button" name="login" type="submit">Iniciar Sesión</button>
        </form>
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