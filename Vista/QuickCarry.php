<?php
require_once "../Control/superControlador.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCarry</title>
    <link rel="stylesheet" href="estilos/QuickCarryStyle.css">
    <link rel="stylesheet" href="estilos/VentanaEmergenteStyle.css">
    <meta name="title" content="QuickCarry">
</head>

<body>

    <header class="header">
        <nav class="nav container">
            <div class="nav__logo">
                <h2 class="nav__title">QuickCarry</h2>
            </div>

            <ul class="nav__links nav__links--menu">
                <li class="nav__item">
                    <a href="#" class="nav__item__link">AA</a>
                </li>
                <li class="nav__item">
                    <a href="#" class="nav__item__link">AA</a>
                </li>
                <li class="nav__item">
                    <a href="#" class="nav__item__link">AA</a>
                </li>
                <li class="nav__item">
                    <a href="#" class="nav__item__link">AA</a>
                </li>

                <img src="assets/close.svg" class="nav__close">
            </ul>

            <div class="nav__menu">
                <img src="assets/menu.svg" class="nav__img">
            </div>
        </nav>

        <section class="header__container container">
            <h1 class="header__title">Rastrea tu paquete</h1>
            <form id="tracking__form">
                <label class="tracking__id" for="idRastreo">ID de Rastreo:</label>
                <input class="tracking__text" type="text" id="idRastreo" placeholder="Ingrese su ID de Rastreo" required>
                <button class="tracking__submit" type="submit">Seguir Paquete</button>
            </form>

            <div class="ventana__emergente" id="ventanaEmergente">
                <div class="ventana__content">
                    <span class="ventana__cerrar" onclick="cerrarVentanaEmergente()">&times;</span>
                    <p id="resultado">-</p>
                </div>
            </div>
        </section>
    </header>
    <footer class="footer">
        <section class="footer__container container">
            <nav class="nav footer__nav">
                <h2 class="footer__title">QuickCarry</h2>

                <!-- <ul class="nav__links nav__links--footer">
                    <li class="nav__item">
                        <a href="#" class="nav__item__link">AA</a>
                    </li>
                    <li class="nav__items">
                        <a href="#" class="nav__item__link">AA</a>
                    </li>
                    <li class="nav__items">
                        <a href="#" class="nav__item__link">AA</a>
                    </li>
                    <li class="nav__items">
                        <a href="#" class="nav__item__link">AA</a>
                    </li>
                </ul> -->
            </nav>

            <form class="footer__form" action="aa" method="POST">
                <h2 class="footer__newsletter">Recibe nuestras noticias</h2>
                <div class="footer__inputs">
                    <input type="email" placeholder="Email:" class="footer__input" name="_replyto">
                    <input type="submit" value="Registrate" class="footer__submit">
                </div>
            </form>
            <h3 class="footer__copyright">Derechos reservados QuickCarry</h3>
        </section>
    </footer>
    <script src="VentanaEmergente.js"></script>
    <!-- <script src="../Menu.js"></script> -->
</body>

</html>