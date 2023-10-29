<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCarry</title>
    <link rel="stylesheet" href="../estilos/QuickCarryStyle.css">
    <link rel="stylesheet" href="../estilos/VentanaEmergenteStyle.css">
    <link rel="stylesheet" href="../estilos/mapstyle2.css">
    <meta name="title" content="QuickCarry">
    <!-- Incluye Leaflet CSS y JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- Incluye Leaflet Routing Machine CSS y JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Incluye Leaflet Control Geocoder CSS y JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
</head>

<body>

    <header class="header">
        <nav class="nav container">
            <div class="nav__logo">
                <h2 class="nav__title">QuickCarry</h2>
            </div>

            <ul class="nav__links nav__links--menu">
                <li class="nav__item">
                    <a href="../indexMains/login.php" class="nav__item__link">Login</a>
                </li>
            </ul>

          
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
                    <p id="resultado2">-</p>
                </div>
            </div>
        </section>
    </header>


    <div id="map__generador">

    </div>

 


<div info__container>
    <div class="why-choose-us">
        <div class="why-choose-us__item">
            <h2 class="why-choose-us__title"><b>Por Qué Elegirnos</b></h2>
            <ul class="why-choose-us__list">
                <li class="why-choose-us__list-item"><b>Puntualidad Inquebrantable:</b> En QuickCarry, valoramos tu tiempo tanto como tú. Nos comprometemos a entregar tus mercancías de forma puntual, cada vez.</li>
                <li class="why-choose-us__list-item"><b>Flexibilidad y Adaptabilidad:</b> Entendemos que cada negocio es único. Por eso, ofrecemos soluciones logísticas flexibles y personalizadas que se adaptan a las demandas cambiantes de tu empresa.</li>
                <li class="why-choose-us__list-item"><b>Seguridad y Confianza:</b> Tu mercancía es valiosa y merece ser tratada con cuidado y seguridad. En QuickCarry, nos aseguramos de que tus envíos estén en las mejores manos en todo momento.</li>
                <li class="why-choose-us__list-item"><b>Atención al Cliente de Primera Clase:</b> Estamos aquí para ayudarte en cada paso del camino. Nuestro equipo de atención al cliente está disponible para responder a tus preguntas y resolver cualquier problema que puedas tener.</li>
            </ul>
        </div>
        <div class="why-choose-us__item">
            <h2 class="why-choose-us__title"><b>Nuestros Servicios</b></h2>
            <ul class="why-choose-us__list">
                <li class="why-choose-us__list-item"><b>Transporte Local:</b> Ofrecemos servicios de transporte confiables a nivel local. Ya sea que necesites mover productos dentro de la ciudad o a través del país, QuickCarry lo hace posible.</li>
                <li class="why-choose-us__list-item"><b>Gestión de Inventarios:</b> Optimizamos tu almacenamiento y gestión de inventarios para garantizar que siempre tengas lo que necesitas, cuando lo necesitas, sin excesos ni faltantes.</li>
                <li class="why-choose-us__list-item"><b>Rastreo en Tiempo Real:</b> Mantén el control total sobre tus envíos con nuestro sistema de rastreo en tiempo real. Sabrás exactamente dónde está tu mercancía en cualquier momento.</li>
                <li class="why-choose-us__list-item"><b>Entregas Express:</b> ¿Necesitas algo entregado rápidamente? Nuestro servicio de entregas express garantiza que tus envíos urgentes lleguen a su destino de manera segura y puntual.</li>
            </ul>
        </div>
    </div>
</div>






    <footer class="footer">

        <section class="footer__container container">
            <nav class="nav footer__nav">
                <h2 class="footer__title">QuickCarry</h2>
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
    <script src="../javascript/VentanaEmergente.js"></script>
    <script src="../javascript/Menu.js"></script>
</body>

</html>