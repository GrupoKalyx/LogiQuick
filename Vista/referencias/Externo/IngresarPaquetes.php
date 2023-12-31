<?php
session_start();
require_once('../../../Control/superControlador.php');
if (isset($_POST['valueSubmit'])) {
  $url = 'http://' . $_SERVER['HTTP_HOST'] . '/kalyx/Control/controladorPaquetes.php';
  $numBulto = superControlador($url, 'POST', array('function' => 'ingresar', 'gmailCliente' => $_POST['gmailCliente'], 'num' => $_POST['num'], 'calle' => $_POST['calle'], 'localidad' => $_POST['localidad'], 'departamento' => $_POST['departamento'], 'lat' => $_POST['lat'], 'lng' => $_POST['lng']));
  $url = 'http://' . $_SERVER['HTTP_HOST'] . '/kalyx/Control/controladorPaquetes.php';
  $infoPaquete = json_decode(superControlador($url, 'GET', array('function' => 'mostrar', 'numBulto' => $numBulto)), true);
  if (isset($infoPaquete)) {
    echo '<script>alert("El paquete se ingresó con el número de bulto '. $infoPaquete['numBulto'] .'.");</script>';
  } else {
    echo '<script>alert("Ha ocurrido un error inesperado.");</script>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../estilos/style.css">
  <link rel="stylesheet" href="../../estilos/FormStyle.css">
  <link rel="icon" type="image/x-icon" href="../../assets/logo.png">
  <title>LogiQuick</title>
  <!-- <script src="../../javascript/Traducir.js"></script> -->
</head>

<body class="body">

  <header>
    <nav class="navbar">
      <div class="navbar__logo">
        <img src="../../assets/logo.png" alt="logo">
      </div>
      <ul class="navbar__list">
        <li class="navbar__list__item"><a href="IngresarPaquetes.php">Ingreso de Paquetes</a></li>
        <li class="navbar__list__item"><a href="#">Asignación</a>
          <ul class="navbar__submenu">
            <li class="navbar__submenu__item"><a href="PaquetesLotes.php">Paquete a Lote</a></li>
            <li class="navbar__submenu__item"><a href="LotesCamiones.php">Lote a Camión</a></li>
            <li class="navbar__submenu__item"><a href="CamionesCamioneros.php">Camionero a Camión</a></li>
          </ul>
        </li>
      </ul>
      <!-- <button class="form__button" id="traductor-btn">Traducir Pagina</button> -->
      <div class="navbar__logout">
        <button class="navbar__logout__button"><a href="../../indexMains/login.php">Cerrar Sesión</a></button>
      </div>
    </nav>
  </header>

  <div class="form__container">
    <form class="form" method="POST" id="ingresarForm" action="IngresarPaquetes.php">
      <h2 class="form__text">Ingrese datos del paquete</h2>

      <div class="form__group">
        <label class="form__label" for="gmailCliente">Correo del cliente:</label>
        <input class="form__input" type="text" id="gmailCliente" name="gmailCliente" required>
      </div>

      <div class="form__group">
        <label class="form__label" for="num">Numero de puerta/KM:</label>
        <input class="form__input" type="text" id="num" name="num" required>
      </div>

      <div class="form__group">
        <label class="form__label" for="calle">Calle/Ruta:</label>
        <input class="form__input" type="text" id="calle" name="calle" required>
      </div>

      <div class="form__group">
        <label class="form__label" for="localidad">Localidad:</label>
        <input class="form__input" type="text" id="localidad" name="localidad" required>
      </div>

      <div class="form__group">
        <label class="form__label" for="departamento">Departamento:</label>
        <input class="form__input" type="text" id="departamento" name="departamento" required>
      </div>

      <input type="hidden" id="lat" name="lat">

      <input type="hidden" id="lng" name="lng">

      <input type="hidden" id="valueSubmit" name="valueSubmit">

      <button class="form__button" type="button" onclick="myFunction();">Ingresar</button>
    </form>
  </div>

  <!-- <script src="../../javascript/Traducir.js"></script> -->

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
    function myFunction() {

      var num = document.getElementById('num').value;
      var calle = document.getElementById('calle').value;
      var localidad = document.getElementById('localidad').value;
      var departamento = document.getElementById('departamento').value;

      const direccion = encodeURI(`${num}, ${calle}, ${localidad}, ${departamento}, Uruguay`);
      const apiKey = '3111bb8dce164ee18ff3bfcf4a4bfc24';
      const url = `https://api.opencagedata.com/geocode/v1/json?q=${direccion}&key=${apiKey}`;
      fetch(url)
        .then(response => response.json())
        .then(data => {
          var coordinates = data.results[0].geometry; // Obtener las coordenadas de la respuesta de la API
          var lat = coordinates.lat;
          var lng = coordinates.lng;

          document.getElementById(`lat`).value = `${lat}`;
          document.getElementById(`lng`).value = `${lng}`;
          document.getElementById(`valueSubmit`).value = `valueSubmit`;
          document.getElementById(`ingresarForm`).submit();
        })
        .catch(error => {
          console.error('Error al obtener las coordenadas:', error);
        });
    }
  </script>
</body>

</html>