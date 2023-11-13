<?php
session_start();
require_once('../../../Control/superControlador.php');
// if (isset($_SESSION['token'])) superControlador('http://' . $_SERVER['HTTP_HOST'] . '/Control/controladorTokens.php', 'GET', array('function' => 'verify', 'token' => $_SESSION['token'], 'tipo' => 'Funcionario'));

$url = 'http://localhost/LogiQuick/Control/controladorCamiones.php';
$matriculas = json_decode(superControlador($url, 'GET', array('function' => 'listar')), true);

$url = 'http://localhost/LogiQuick/Control/controladorCamioneros.php';
$camioneros = json_decode(superControlador($url, 'GET', array('function' => 'listar')), true);

if (isset($_POST['asignar'])) {
  $url = 'http://localhost/LogiQuick/Control/controladorConducen.php';
  superControlador($url, 'POST', array('function' => 'ingresar', 'ci' => $ci, 'matricula' => $matricula));
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
      <button class="form__button" id="traductor-btn">Traducir Pagina </button>
      <div class="navbar__logout">
        <button class="navbar__logout__button"><a href="../../indexMains/login.php">Cerrar Sesión</a></button>
      </div>
    </nav>
  </header>

  <div class="form__container">
    <form class="form" method="POST" action="../../Control/controladorConducen.php?accion=ingresar">

      <h2 class="form__text">Asigne un conductor al camión</h2>

      <div class="form__group">
        <label class="form__label" for="Camionero">Camionero:</label>
        <select class="form__select" id="nombre" name="ci" required>
          <option value="">Seleccionar camionero</option>
          <?php
          foreach ($camioneros as $camionero) {
            echo "<option value='" . $camionero['ci'] . "'>" . $camionero['nombre'] . "</option>";
          }
          ?>
        </select>
      </div>

      <div class="form__group">
        <label class="form__label" for="camion">Camión:</label>
        <select class="form__select" id="camion" name="camion" required>
          <option value="">Seleccionar camion</option>
          <?php
          foreach ($matriculas as $matricula) {
            echo "<option value='" . $matricula['matricula'] . "'>" . $matricula['matricula'] . "</option>";
          }
          ?>
        </select>
      </div>

      <button class="form__button" type="submit">Asignar</button>
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
</body>

</html>