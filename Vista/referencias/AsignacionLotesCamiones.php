<?php
require '../../Control/superControlador.php';

$url = 'http://localhost/LogiQuick/Control/controladorCamiones.php?method=listar';
$json = superControlador($url, 'GET', NULL);
$camiones = json_decode($json, true);

$url2 = 'http://localhost/LogiQuick/Control/controladorLotes.php?method=listar';
$json2 = superControlador($url2, 'GET', NULL);
$lotes = json_decode($json2, true);
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
            <li class="navbar__submenu__item"><a href="../referencias/AsignacionLotes.php">Paquete a Lote</a></li>
            <li class="navbar__submenu__item"><a href="../referencias/AsignacionCamion.php">Lote a Camión</a></li>
            <li class="navbar__submenu__item"><a href="../referencias/AsignacionCamionero.php">Camionero a Camión</a></li>
          </ul>
        </li>
        <li class="navbar__list__item"><a href="#">Seguimiento</a></li>
      </ul>
      <!-- <button class="form__button" id="traductor-btn">Traducir Pagina </button> -->
      <div class="navbar__logout"> 
        <button class="navbar__logout__button"><a href="#">Cerrar Sesión</a></button>
      </div>
    </nav>
  </header>

  <div class="form__container">
  <form class="form" method="POST">

    <h2 class="form__text">Ingresar Lote a Camión</h2>

    <div class="form__group">
      <label class="form__label" for="lote">Lote:</label>
      <select class="form__select" id="lote" name="lote" required>
          <option value="">Seleccionar lote</option>
            <?php
            foreach ($lotes as $lote) {
                echo "<option value='$lote'>$lote</option>";
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
                echo "<option value='$matricula'>$matricula</option>";
            }
            ?>
        </select>
    </div>
  
    <button class="form__button" type="submit">Ingresar</button>
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