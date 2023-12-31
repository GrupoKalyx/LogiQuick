<?php
require_once('../../../Control/superControlador.php');
session_start();
// if (isset($_SESSION['token'])) superControlador('http://' . $_SERVER['HTTP_HOST'] . '/Control/controladorTokens.php', 'GET', array('function' => 'verify', 'token' => $_SESSION['token'], 'tipo' => 'Funcionario'));

$url = 'http://' . $_SERVER['HTTP_HOST'] . '/kalyx/Control/controladorPickups.php';
$matriculas = json_decode(superControlador($url, 'GET', array('function' => 'listar')), true);

$url = 'http://' . $_SERVER['HTTP_HOST'] . '/kalyx/Control/controladorDeliverys.php';
$nombres = json_decode(superControlador($url, 'GET', array('function' => 'listar')), true);

if (isset($_POST['asignar'])) {
  $url = 'http://' . $_SERVER['HTTP_HOST'] . '/kalyx/Control/controladorManejan.php';
  $success = superControlador($url, 'POST', array('function' => 'ingresar', 'ci' => $_POST['ci'], 'matricula' => $_POST['matricula']));

  if ($success) {
    echo '<script>alert("Delivery asignado con éxito");</script>';
  } else {
    echo '<script>alert("Ha ocurrido un error inesperado.");</script>';
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../estilos/style.css">
  <link rel="stylesheet" href="../../estilos/FormStyle.css">
  <link rel="icon" type="image/x-icon" href="../../assets/logo.png">
  <title>LogiQuick</title>
</head>

<body class="body">

  <header>
    <nav class="navbar">
      <div class="navbar__logo">
        <img src="../../assets/logo.png" alt="logo">
      </div>
      <ul class="navbar__list">
        <li class="navbar__list__item">
          <a href="#">Asignación</a>
          <ul class="navbar__submenu">
            <li class="navbar__submenu__item">
              <a href="PaquetesPickups.php">Paquetes a Pickup</a>
            </li>
            <li class="navbar__submenu__item">
              <a href="PickupsDeliverys.php">Delivery a Pickup</a>
            </li>
          </ul>
        </li>
       
      </ul>
      <div class="navbar__logout">
        <button class="navbar__logout__button">
          <a href="login.php">Cerrar Sesión</a>
        </button>
      </div>

      <!-- <button class="form__button" id="traductor-btn">Traducir Pagina </button> -->
    </nav>
  </header>

  <div class="form__container">
    <form class="form" method="POST" action="PickupsDeliverys.php">

      <h2 class="form__text">Asignar Delivery a Pickup</h2>

      <div class="form__group">
        <label class="form__label" for="Camionero">Delivery:</label>
        <select class="form__select" id="nombre" name="ci" required>
          <option value="">Seleccionar delivery</option>
          <?php
          foreach ($nombres as $nombre) {
            echo "<option value='" . $nombre['ci'] . "'>" . $nombre['ci'] . " - " . $nombre['nombre'] . "</option>";
          }
          ?>
        </select>
      </div>

      <div class="form__group">
        <label class="form__label" for="camion">Pickup:</label>
        <select class="form__select" id="camion" name="matricula" required>
          <option value="">Seleccionar pickup</option>
          <?php
          foreach ($matriculas as $matricula) {
            echo "<option value='" . $matricula['matricula'] . "'>" . $matricula['matricula'] . "</option>";
          }
          ?>
        </select>
      </div>

      <button class="form__button" type="submit" name="asignar">Asignar</button>
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
</body>

</html>