<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="stylesheet" href="../estilos/mapsStyle.css">
    <link rel="icon" type="image/x-icon" href="assets/logo.png">
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
    <title>LogiQuick</title>
    <!-- <script src="Traducir.js"></script> -->
</head>

<body class="body">
    <header>
        <nav class="navbar">
            <div class="navbar__logo">
                <img src="../assets/logo.png" alt="logo">
            </div>
            <ul class="navbar__list">
                <li class="navbar__list__item">
                    <a href="#">Verificar Entrada</a>
                </li>
                <li class="navbar__list__item">
                    <a href="#">Asignación</a>
                    <ul class="navbar__submenu">
                        <li class="navbar__submenu__item">
                            <a href="../referencias/AsignacionPaquetesLotesCentral.php">Paquete a Lote</a>
                        </li>
                        <li class="navbar__submenu__item">
                            <a href="../referencias/AsignacionLotesCamiones.php">Lote a Camión</a>
                        </li>
                        <li class="navbar__submenu__item">
                            <a href="../referencias/AsignacionCamionesCamioneros.php">Camionero a Camión</a>
                        </li>
                    </ul>
                </li>
                <li class="navbar__list__item">
                    <a href="#">Seguimiento</a>
                </li>
            </ul>
            <div class="navbar__logout">
                <button class="navbar__logout__button">
                    <a href="#">Cerrar Sesión</a>
                </button>
            </div>

            <!-- <button class="form__button" id="traductor-btn">Traducir Pagina </button> -->
        </nav>
    </header>
    
    <div class="container">
    <div id="TableContainer">
      <table id="Table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Dirección</th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div>
     <div id="map"></div>
  </div>

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

    <script src="../javascript/Seguimiento.js"></script>
</body>

</html>