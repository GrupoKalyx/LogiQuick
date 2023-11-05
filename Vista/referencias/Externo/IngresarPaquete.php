<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../estilos/style.css">
  <link rel="stylesheet" href="../../estilos/FormStyle.css">
  <link rel="icon" type="image/x-icon" href="../../assets/logo.png">
  <title>LogiQuick</title>
  <script src="../../javascript/Traducir.js"></script>
</head>

<body class="body">

  <header>
    <nav class="navbar">
      <div class="navbar__logo">
        <img src="../../assets/logo.png" alt="logo">
      </div>
      <ul class="navbar__list">
        <li class="navbar__list__item"><a href="#">Verificar Llegadas</a></li>
        <li class="navbar__list__item"><a href="#">Ingresar Paquetes</a></li>
      </ul>
      <button class="form__button" id="traductor-btn">Traducir Pagina</button>
      <div class="navbar__logout">
        <button class="navbar__logout__button"><a href="#">Cerrar Sesión</a></button>
      </div>
    </nav>
  </header>

  <div class="form__container">
    <form class="form" method="POST" id="ingresarForm" >
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

      <button class="form__button" type="button" name="ingresar" onclick="myFunction();">Ingresar</button>
    </form>
  </div>

  <script src="../../javascript/Traducir.js"></script>

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
          document.getElementById(`ingresarForm`).submit();
        })
        .catch(error => {
          console.error('Error al obtener las coordenadas:', error);
        });
    }
  </script>
</body>

</html>