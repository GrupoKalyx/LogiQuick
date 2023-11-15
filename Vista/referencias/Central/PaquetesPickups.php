<?php
session_start();
// if (isset($_SESSION['token'])) superControlador('http://' . $_SERVER['HTTP_HOST'] . '/kalyx/Control/controladorTokens.php', 'GET', array('function' => 'verify', 'token' => $_SESSION['token'], 'tipo' => 'Funcionario'));
require_once('../../../Control/superControlador.php');

$url = 'http://' . $_SERVER['HTTP_HOST'] . '/kalyx/Control/controladorPickups.php';
$matriculas = json_decode(superControlador($url, 'GET', array('function' => 'listar')), true);

$url = 'http://' . $_SERVER['HTTP_HOST'] . '/kalyx/Control/controladorPaquetes.php';
$paquetes = json_decode(superControlador($url, 'GET', array('function' => 'listarEnQcMontevideo')), true);

if (isset($_POST['asignar'])) {
  $url = 'http://' . $_SERVER['HTTP_HOST'] . '/kalyx/Control/controladorEntregan.php';
  $success = superControlador($url, 'POST', array('function' => 'ingresar', 'bulto' => $_POST['bulto'], 'matricula' => $_POST['matricula']));

  if ($success) {
    echo '<script>alert("Paquete asignado con éxito.");</script>';
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
</head>

<body class="body">

  <header>
    <nav class="navbar">
      <div class="navbar__logo">
        <img src="../../assets/logo.png" alt="logo">
      </div>
      <ul class="navbar__list">
        <li class="navbar__list__item"><a href="#">Asignación</a>
          <ul class="navbar__submenu">
            <li class="navbar__submenu__item"><a href="PaquetesLotes.php">Paquete a Lote</a></li>
            <li class="navbar__submenu__item"><a href="LotesCamiones.php">Lote a Camión</a></li>
            <li class="navbar__submenu__item"><a href="CamionesCamioneros.php">Camionero a Camión</a></li>
            <li class="navbar__submenu__item"><a href="PaquetesPickups.php">Paquete a Pickup</a></li>
          </ul>
        </li>
        <li class="navbar__list__item"><a href="Seguimiento.php">Seguimiento</a></li>
      </ul>
      <button class="form__button" id="traductor-btn">Traducir Pagina </button>
      <div class="navbar__logout">
        <button class="navbar__logout__button"><a href="../../indexMains/login.php">Cerrar Sesión</a></button>
      </div>
    </nav>
  </header>

  <div class="form__container">
    <form class="form" method="POST" action='LotesCamiones.php'>
      <h2 class="form__text">Ingresar lote a Camión</h2>
      <div class="form__group">
        <label class="form__label" for="idLote">Lote:</label>
        <select class="form__select" id="idLote" name="idLote[]" required>
          <option value="">Seleccionar lote</option>
          <?php
          foreach ($idLotes as $idLote) {
            echo "<option value='" . $idLote['idLote'] . "'>" . $idLote['idLote'] . "</option>";
          }
          ?>
        </select>
        <div class="form__group" id="contenedor-campos">
        <!-- aca van paquetes nuevos-->
      </div>
      </div>
      <div class="form__group">
        <label class="form__label" for="camion">Camión:</label>
        <select class="form__select" id="matricula" name="matricula" required>
          <option value="">Seleccionar camion</option>
          <?php
          foreach ($matriculas as $matricula) {
            echo "<option value='" . $matricula['matricula'] . "'>" . $matricula['matricula'] . "</option>";
          }
          ?>
        </select>
      </div>
      <div class="form__group">
        <label class="form__label" for="idLote">Almacen:</label>
        <select class="form__select" id="idAlmacen" name="idAlmacen" required>
          <option value="">Seleccionar almacen</option>
          <?php
          foreach ($idAlmacenes as $idAlmacen) {
            echo "<option value='" . $idAlmacen['idAlmacen'] . "'>" . $idAlmacen['idAlmacen'] . " - " . $idAlmacen['departamento'] . "</option>";
          }
          ?>
        </select>
      </div>
     

      <button type="button" class="form__button" id="agregarCampoFuncionarioCentral">Agregar Campo</button>

      <button class="form__button" name="asignar" type="submit">Asignar</button>
    </form>
  </div>

  <script src="../../javascript/Traducir.js"></script>
  <script src="../../javascript/agregarCampoLote.js"></script>
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