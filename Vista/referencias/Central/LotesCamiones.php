<?php
require_once('../../../Control/superControlador.php');

$url = 'http://localhost/LogiQuick/Control/controladorCamiones.php';
$matriculas = json_decode(superControlador($url, 'GET', array('function' => 'listar')), true);

$url = 'http://localhost/LogiQuick/Control/controladorLotes.php';
$idLotes = json_decode(superControlador($url, 'GET', array('function' => 'listar')), true);

if (isset($_POST['asignar'])) {
  $url = 'http://localhost/LogiQuick/Control/controladorLlevan.php';
  $json = superControlador($url, 'PUT', array('function' => 'ingresar', 'idLote' => $idLote, 'matricula' => $matricula));
}
session_start();
if (isset($_SESSION['token'])) superControlador('http://' . $_SERVER['HTTP_HOST'] . '/Control/controladorTokens.php', 'GET', array('function' => 'verify', 'token' => $_SESSION['token'], 'tipo' => 'Funcionario'));
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
        <li class="navbar__list__item"><a href="#">Verificar Entrada</a></li>
        <li class="navbar__list__item"><a href="#">Asignación</a>
          <ul class="navbar__submenu">
            <li class="navbar__submenu__item"><a href="AsignacionPaquetesLotes.php">Paquete a Lote</a></li>
            <li class="navbar__submenu__item"><a href="AsignacionLotesCamiones.php">Lote a Camión</a></li>
            <li class="navbar__submenu__item"><a href="AsignacionCamionesCamioneros.php">Camionero a Camión</a></li>
          </ul>
        </li>
        <li class="navbar__list__item"><a href="#">Seguimiento</a></li>
      </ul>
      <!-- <button class="form__button" id="traductor-btn">Traducir Pagina </button> -->
      <div class="navbar__logout">
        <button class="navbar__logout__button"><a href="../../indexMains/login.php">Cerrar Sesión</a></button>
      </div>
    </nav>
  </header>

  <div class="form__container">
    <form class="form" method="POST">
      <h2 class="form__text">Ingresar Lote a Camión</h2>
      <div class="form__group">
        <label class="form__label" for="idLote">Lote:</label>
        <select class="form__select" id="idLote" name="idLote" required>
          <option value="">Seleccionar lote</option>
          <?php
          foreach ($idLotes as $idLote) {
            echo "<option value='$idLote'>$idLote</option>";
          }
          ?>
        </select>
      </div>
      <div class="form__group">
        <label class="form__label" for="camion">Camión:</label>
        <select class="form__select" id="matricula" name="matricula" required>
          <option value="">Seleccionar camion</option>
          <?php
          foreach ($matriculas as $matricula) {
            echo "<option value='$matricula'>$matricula</option>";
          }
          ?>
        </select>
      </div>
      <button class="form__button" name="asignar" type="submit">Asignar</button>
    </form>
  </div>

  <!-- <script src="Traducir.js"></script> -->

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