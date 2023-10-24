<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/FormStyle.css">
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="icon" type="image/x-icon" href="../assets/logo.png">
    <!-- <script src="Traducir.js"></script> -->
    <title>LogiQuick</title>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="navbar__logo">
                <img src="../assets/logo.png">
            </div>
            <div class="navbar">
                <h1 class="nav__text">Bienvenido a LogiQuick!</h1>
            </div>
            <!-- <button class="form__button" id="traductor-btn">Traducir Pagina</button> -->
        </nav>
    </header>
    <div class="form__container">
        <form class="form" method="POST" action="../../Control/controladorLogins.php">
            <input type="hidden" name="function" value="chequear">
            <h2 class="form__text">Ingrese sus Datos</h2>
            <div class="form__group">
                <label class="form__label" for="ci">CI:</label>
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