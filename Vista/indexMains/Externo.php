<?php
require_once('../../Control/superControlador.php');
session_start();
if (isset($_SESSION['token'])) superControlador('http://' . $_SERVER['HTTP_HOST'] . '/Control/controladorTokens.php', 'GET', array('function' => 'verify', 'token' => $_SESSION['token'], 'tipo' => 'Externo'));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../estilos/style.css">
    <link rel="icon" type="image/x-icon" href="../assets/logo.png">
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
        <li class="navbar__list__item"><a href="../referencias/Externo/VerificarLlegadas.php">Verificar Llegadas</a></li>
        <li class="navbar__list__item"><a href="../referencias/Externo/IngresarPaquete.php">Ingresar Paquetes</a></li>
        <li class="navbar__list__item">
          <a href="#">Asignación</a>
          <ul class="navbar__submenu">
            <li class="navbar__submenu__item">
              <a href="../referencias/Externo/AsignacionPaquetesLotesCentral.php">Paquete a Lote</a>
            </li>
            <li class="navbar__submenu__item">
              <a href="../referencias/Externo/AsignacionLotesCamiones.php">Lote a Camión</a>
            </li>
            <li class="navbar__submenu__item">
              <a href="../referencias/Externo/AsignacionCamionesCamioneros.php">Camionero a Camión</a>
            </li>
          </ul>
        </li>
      </ul>
      <!-- <button class="form__button" id="traductor-btn">Traducir Pagina</button> -->
      <div class="navbar__logout">
        <button class="navbar__logout__button"><a href="login.php">Cerrar Sesión</a></button>
      </div>
    </nav>
  </header>

  <div class="espacio__blanco"></div>

  <footer>
    <div class="footer">

      <ul class="footer_list">
        <li class="footer__list__item"><a href="">¡Contactanos!</a></li>
        <li class="footer__list__item"><a href="">Sobre Nosotros</a></li>
      </ul>

      <script src="../javascript/Traducir.js"></script>
      <div class="footer__copyright">
        <p>Copyright © 2023 Kalyx Software. Todos los derechos reservados</p>
      </div>
    </div>
  </footer>
</body>

</html>