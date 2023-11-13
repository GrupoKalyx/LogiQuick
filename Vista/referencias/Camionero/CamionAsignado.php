<?php
require_once('../../../Control/superControlador.php');
session_start();
// if (isset($_SESSION['token'])) superControlador('http://'.$_SERVER['HTTP_HOST'].'/Control/controladorTokens.php', 'GET', array('function' => 'verify', 'token' => $_SESSION['token'], 'tipo' => 'Camionero'));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script src="Traducir.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../estilos/style.css">
  <link rel="icon" type="image/x-icon" href="../../assets/logo.png">
  <title>LogiQuick</title>
  <script src="../../javascript/camioneroAsignado.js"></script>
</head>

<body class="body">

  <header>
    <nav class="navbar">

      <div class="navbar__logo">
        <img src="../../assets/logo.png" alt="logo">
      </div>

      <ul class="navbar__list">
        <li class="navbar__list__item"><a href="RutaCamionero.php">Visualizar rutas</a></li>
        <li class="navbar__list__item"><a href="CamionAsignado.php">Camion asignado</a></li>
      </ul>
      <!-- <button class="form__button" id="traductor-btn">Traducir Pagina</button> -->
      <div class="navbar__logout">
        <button class="navbar__logout__button"><a href="../../indexMains/login.php">Cerrar Sesión</a></button>
      </div>

    </nav>
  </header>


  <h1>Lista de Camioneros y sus Camiones Asignado</h1>

  <div class="container">
    <div id="TableContainer">
      <table id="Table">
        <thead>
          <tr>
            <th>CI Camionero</th>
            <th>Matricula</th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div>
  </div>

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
</body>

</html>