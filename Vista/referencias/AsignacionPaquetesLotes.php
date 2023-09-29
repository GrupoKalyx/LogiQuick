<?php
require '../../Control/superControlador.php';

$url = 'http://localhost/LogiQuick/Control/controladorPaquetes.php?method=listarSinLote';
$json = superControlador($url, 'GET', NULL);
$paquetes = json_decode($json, true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../estilos/style.css">
  <link rel="stylesheet" href="../estilos/FormStyle.css">
  <title>LogiQuick</title>
</head>

<body class="body">

  <header>
    <nav class="navbar">
      <div class="navbar__logo">
        <img src="../assets/logo.png" alt="logo">
      </div>
      <ul class="navbar__list">
        <li class="navbar__list__item"><a href="#">Verificar Entrada</a></li>
        <li class="navbar__list__item"><a href="#">Asignación</a>
          <ul class="navbar__submenu">
            <li class="navbar__submenu__item"><a href="../referencias/AsignacionPaquetesLotes.php">Paquete
                a Lote</a></li>
            <li class="navbar__submenu__item"><a href="../referencias/AsignacionLotesCamiones.php">Lote a
                Camión</a></li>
            <li class="navbar__submenu__item"><a href="../referencias/AsignacionCamionesCamioneros.php">Camionero
                a Camión</a></li>
          </ul>
        </li>
        <li class="navbar__list__item"><a href="#">Seguimiento</a></li>
      </ul>
      <!-- <button class="form__button" id="traductor-btn">Traducir Pagina </button> -->
      <div class="navbar__logout">
        <button class="navbar__logout__button"><a href="../login.php">Cerrar Sesión</a></button>
      </div>

    </nav>
  </header>

  <div class="form__container">
    <form class="form" method="POST">
      <h2 class="form__text">Genere un lote</h2>
      <div class="form__group">
        <label class="form__label" for="Paquete">Paquete:</label>
        <select class="form__select" id="bulto" name="bulto" required>
          <option value="">Seleccionar paquete</option>
          <?php
          foreach ($paquetes as $paquete) {
            echo "<option value='" . $paquete['numBulto'] . "'>" . $paquete['numBulto'] . "</option>";
          }
          ?>
        </select>
      </div>
      <div class="form__group">
        <label class="form__label" for="Paquete">Paquete:</label>
        <select class="form__select" id="bulto" name="bulto" required>
          <option value="">Seleccionar paquete</option>
          <?php
          foreach ($paquetes as $paquete) {
            echo "<option value='" . $paquete['numBulto'] . "'>" . $paquete['numBulto'] . "</option>";
          }
          ?>
        </select>
      </div>
      <div class="form__group">
        <label class="form__label" for="Paquete">Paquete:</label>
        <select class="form__select" id="bulto" name="bulto" required>
          <option value="">Seleccionar paquete</option>
          <?php
          foreach ($paquetes as $paquete) {
            echo "<option value='" . $paquete['numBulto'] . "'>" . $paquete['numBulto'] . "</option>";
          }
          ?>
        </select>
      </div>
      <div class="form__group">
        <label class="form__label" for="Paquete">Paquete:</label>
        <select class="form__select" id="bulto" name="bulto" required>
          <option value="">Seleccionar paquete</option>
          <?php
          foreach ($paquetes as $paquete) {
            echo "<option value='" . $paquete['numBulto'] . "'>" . $paquete['numBulto'] . "</option>";
          }
          ?>
        </select>
      </div>
      <div class="form__group">
        <button> //agregar codiguito javascript para crear otra opcion de paquete
      </div>

      <button class="form__button" type="submit">Generar</button>
          //agregar codigo para restringir el ingreso de paquetes cuando se repitan valores de numero de bulto
    </form>
  </div>

  <script src="Traducir.js"></script>

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