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
  <script src="../javascript/Seguimiento.js"></script>
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

  </footer>


</body>

</html>