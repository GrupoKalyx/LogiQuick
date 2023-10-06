<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../estilos/style.css">
  <link rel="stylesheet" href="../estilos/FormStyle.css">
  <link rel="stylesheet" href="../estilos/mapsStyle.css">
  <title>LogiQuick</title>
  <script src="Traducir.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>

<body class="body">

  <header>
    <nav class="navbar">

      <div class="navbar__logo">
        <img src="../assets/logo.png" alt="logo">
      </div>

      <ul class="navbar__list">
        <li class="navbar__list__item"><a href="#">Visualizar Ruta</a></li>
        <li class="navbar__list__item"><a href="PickupAsignado.php">Pickup Asignado</a></li>
      </ul>
      <!-- <button class="form__button" id="traductor-btn">Traducir Pagina</button> -->
      <div class="navbar__logout">
        <button class="navbar__logout__button"><a href="../login.php">Cerrar Sesión</a></button>
      </div>

    </nav>
  </header>

  <div class="container">

    <div id="map"></div>

    <div class="form__container">
      <form class="form" method="POST" action="">

        <h2 class="form__text">Almacen de Salida</h2>

        <div class="form__group">
          <label class="form__label" for="Almacen">Almacen:</label>
          <select class="form__select" id="AlmacenSalida" name="AlmacenSalida" required>
            <option value="">Seleccionar almacen</option>
            <?php
            foreach ($almacenes as $almacen) {
              echo "<option value='$almacen'>$almacen</option>";
            }
            ?>
          </select>
        </div>

        <h2 class="form__text">Almacen de Llegada</h2>

        <div class="form__group">
          <label class="form__label" for="Almacen">Almacen:</label>
          <select class="form__select" id="AlmacenSalida" name="AlmacenSalida" required>
            <option value="">Seleccionar almacen</option>
            <?php
            foreach ($almacenes as $almacen) {
              echo "<option value='$almacen'>$almacen</option>";
            }
            ?>
          </select>
        </div>

        <button class="form__button" type="submit">Mostrar Ruta</button>
      </form>
    </div>

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

  <script>
    var map = L.map('map').setView([-34.85, -56.2], 12); // Latitud y Longitud de Montevideo

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // var AlmacenOrigen = new L.LatLng(51.505, -0.09);
    // var AlmacenDestino = new L.LatLng(51.51, -0.1);
    // var marcadores = L.layerGroup([L.marker(AlmacenOrigen), L.marker(AlmacenDestino)]).addTo(map);

    // var ruta = L.polyline([AlmacenOrigen, AlmacenDestino]).addTo(map);
    // map.fitBounds(marcadores.getBounds());
  </script>
  <script>
    //     document.getElementByClass('form').addEventListener('submit', function(event) {
    //     event.preventDefault();

    //     var puntoA = document.getElementById('AlmacenSalida').value;
    //     var puntoB = document.getElementById('AlmacenLlegada').value;

    //     // Obtener coordenadas para punto A
    //     fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${puntoA}`)
    //         .then(response => response.json())
    //         .then(data => {
    //             var latitudA = parseFloat(data[0].lat);
    //             var longitudA = parseFloat(data[0].lon);

    //             // Obtener coordenadas para punto B
    //             fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${puntoB}`)
    //                 .then(response => response.json())
    //                 .then(data => {
    //                     var latitudB = parseFloat(data[0].lat);
    //                     var longitudB = parseFloat(data[0].lon);

    //                     // Crear mapa y trazar el trayecto usando Leaflet
    //                     var map = L.map('map').setView([latitudA, longitudA], 12);
    //                     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //                         attribution: '© OpenStreetMap contributors'
    //                     }).addTo(map);

    //                     // Marcadores para los puntos A y B
    //                     var markerA = L.marker([latitudA, longitudA]).addTo(map);
    //                     var markerB = L.marker([latitudB, longitudB]).addTo(map);

    //                     // Línea de trayecto
    //                     var polyline = L.polyline([[latitudA, longitudA], [latitudB, longitudB]], {color: 'blue'}).addTo(map);

    //                     // Asegurarse de que ambos marcadores sean visibles
    //                     map.fitBounds(polyline.getBounds());
    //                 })
    //                 .catch(error => {
    //                     console.error('Error al obtener las coordenadas del punto B:', error);
    //                 });
    //         })
    //         .catch(error => {
    //             console.error('Error al obtener las coordenadas del punto A:', error);
    //         });
    // });
  </script>
</body>

</html>