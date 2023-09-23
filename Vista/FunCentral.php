<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="icon" type="image/x-icon" href="assets/logo.png">
    <title>LogiQuick</title>
    <!-- <script src="Traducir.js"></script> -->
</head>

<body class="body">
    <header>
        <nav class="navbar">
            <div class="navbar__logo">
                <img src="assets/logo.png" alt="logo">
            </div>
            <ul class="navbar__list">
                <li class="navbar__list__item">
                    <a href="#">Verificar Entrada</a>
                </li>
                <li class="navbar__list__item">
                    <a href="#">Asignación</a>
                    <ul class="navbar__submenu">
                        <li class="navbar__submenu__item">
                            <a href="referencias/AsignacionDeLotes.html">Paquete a Lote</a>
                        </li>
                        <li class="navbar__submenu__item">
                            <a href="referencias/LoteACamion.html">Lote a Camión</a>
                        </li>
                        <li class="navbar__submenu__item">
                            <a href="referencias/CamioneroACamion.html">Camionero a Camión</a>
                        </li>
                    </ul>
                </li>
                <li class="navbar__list__item">
                    <a href="#">Seguimiento</a>
                </li>
                <li class="navbar__logout">
                <!-- <button class="form__button" id="traductor-btn">Traducir Pagina</button> -->
                    <button class="navbar__logout__button">
                        <a href="login.php">Cerrar Sesión</a>
                    </button>
                </li>
            </ul>
            <!-- <button class="form__button" id="traductor-btn">Traducir Pagina </button> -->
        </nav>
    </header>
    <div class="espacio__blanco"></div>
    <footer>
        <div class="footer">
            <ul class="footer_list">
                <li class="footer__list__item">
                    <a href="">¡Contactanos!</a>
                </li>
                <li class="footer__list__item">
                    <a href="">Sobre Nosotros</a>
                </li>
            </ul>
            <div class="footer__copyright">
                <p>Copyright © 2023 Kalyx Software. Todos los derechos reservados</p>
            </div>
        </div>
    </footer>
</body>

</html>