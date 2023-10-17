<?php
require_once('../../Control/superControlador.php');
session_start();
if (isset($_SESSION['token'])) {
  $ver = superControlador('http://localhost/LogiQuick/Control/controladorToken.php', 'GET', array('function' => 'verify', 'token' => $_SESSION['token']));
  if ($ver) {
    $tipo = $_SESSION['tipo'];
    if($tipo == 'Camionero'){
      
    }
  } else {

    echo "<script>
            alert('Tipo de usuario incorrecto, no tiene permisos para ingresar a esta área.');
            window.location = 'login.php';
        </script>";
  }
} else {
  echo "<script>
            alert('Inicie sesión para ingresar.');
            window.location = 'login.php';
        </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../estilos/style.css">
  <title>LogiQuick</title>
  <!-- <script src="Traducir.js"></script> -->
</head>

<body class="body">

  <header>
    <nav class="navbar">

      <div class="navbar__logo">
        <img src="assets/logo.png" alt="logo">
      </div>

      <ul class="navbar__list">
        <li class="navbar__list__item"><a href="../referencias/RutaCamionero.php">Visualizar Ruta</a></li>
        <li class="navbar__list__item"><a href="../referencias/CamionesAsignados.php">Camiones Asignados</a></li>
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

      <div class="footer__copyright">
        <p>Copyright © 2023 Kalyx Software. Todos los derechos reservados</p>
      </div>
    </div>
  </footer>
</body>

</html>