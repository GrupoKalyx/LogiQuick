<?php
require '../../Control/superControlador.php';

$url = 'http://localhost/LogiQuick/Control/controladorLlevan.php';
$idLotes = json_decode(superControlador($url, 'GET', array('function' => 'listarConCamion', 'matricula' => $_)), true);

if (isset($_POST['generar'])) {
  $url = 'http://localhost/LogiQuick/Control/controladorLotes.php';
  $idLote = json_decode(superControlador($url, 'POST', array('function' => 'ingresar')), 1);
  $url = 'http://localhost/LogiQuick/Control/controladorLotean.php';
  superControlador($url, 'POST', array('function' => 'ingresar', 'idLote' => $idLote, 'paquetes' => $_POST['bulto']));
}
?>
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
  <script src="RoutingMachine/dist/leaflet-routing-machine.js"></script>
  <link rel="stylesheet" href="RoutingMachine/dist/leaflet-routing-machine.css">
</head>

<body class="body">

  <header>
    <nav class="navbar">

      <div class="navbar__logo">
        <img src="../assets/logo.png" alt="logo">
      </div>

      <ul class="navbar__list">
        <li class="navbar__list__item"><a href="#">Visualizar Ruta</a></li>
        <li class="navbar__list__item"><a href="CamionAsignado.php">Camiones Asignados</a></li>
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

  <script src="mapa.js"></script>
</body>

</html>