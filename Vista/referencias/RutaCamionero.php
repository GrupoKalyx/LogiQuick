<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../estilos/style.css">
  <title>LogiQuick</title>
  <script src="Traducir.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <style>
    #map {
      height: 100%;
      width: 70%;
      margin: 5px;
     border-radius: 10px;
    }
  </style>
</head>

<body class="body">

  <header>
    <nav class="navbar">

      <div class="navbar__logo">
        <img src="assets/logo.png" alt="logo">
      </div>

      <ul class="navbar__list">
        <li class="navbar__list__item"><a href="#">Visualizar Ruta</a></li>
        <li class="navbar__list__item"><a href="#">Verificar Entrada</a></li>
        <li class="navbar__list__item"><a href="referencias/CamionesAsignados.php">Camiones Asignados</a></li>
      </ul>
      <!-- <button class="form__button" id="traductor-btn">Traducir Pagina</button> -->
      <div class="navbar__logout">
        <button class="navbar__logout__button"><a href="login.php">Cerrar Sesión</a></button>
      </div>

    </nav>
  </header>
  
  <div id="map"></div>
  <div class="espacio__blanco"></div>

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

  <script>
    // Crear un mapa en el contenedor con id 'map'
   
    var map = L.map('map').setView([-34.9036, -56.1916], 15); // Latitud y longitud de Plaza Independencia

    // Agregar una capa de mapa de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // // Crear puntos A y B (latitud, longitud)
    // var puntoA = new L.LatLng(51.505, -0.09);
    // var puntoB = new L.LatLng(51.51, -0.1);

    // // Crear una capa de marcadores y agregar los puntos A y B al mapa
    // var marcadores = L.layerGroup([L.marker(puntoA), L.marker(puntoB)]).addTo(map);

    // // Crear una capa de línea entre los puntos A y B
    // var ruta = L.polyline([puntoA, puntoB]).addTo(map);

    // // Ajustar el mapa para que se ajuste a los marcadores
    // map.fitBounds(marcadores.getBounds());
  </script>

</body>

</html>