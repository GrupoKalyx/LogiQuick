<?php
session_start();

require 'SessionStartFuncionario.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../estilos/style.css">
  <link rel="stylesheet" href="../../estilos/FormStyle.css">
  <title>Administracion de Almacen</title>
</head>

<body class="body">
  <header>
    <nav class="navbar">
      <div class="navbar__logo">
        <img src="../../assets/logo.png">
      </div>
      <div>
        <h2>Bienvenido:
          <?php echo " " . $usuarioigresado ?>
        </h2>
      </div>
      <ul class="navbar__list">

        <li class="navbar__list__item"><a href="#">Verificar Entrada</a></li>
        <li class="navbar__list__item"><a href="#">Asignación</a>
          <ul class="navbar__submenu">
            <li class="navbar__submenu__item"><a href="../../referencias/AsignacionDeLotes.php">Paquete a
                Lote</a></li>
            <li class="navbar__submenu__item"><a href="referencias/LoteACamion.html">Lote a Camión</a></li>
            <li class="navbar__submenu__item"><a href="referencias/CamioneroACamion.html">Camionero a
                Camión</a></li>
          </ul>
        </li>
        <li class="navbar__list__item"><a href="#">Seguimiento</a></li>
      </ul>
      <div class="navbar__logout">
        <form method="post">
          <button class="navbar__logout__button" name="btncerrar" type="submit">Cerrar Sesión</button>
        </form>
      </div>
    </nav>
  </header>
  <div class="form__container">
    <form class="form" method="POST">

      <h2 class="form__text">Genere un lote</h2>

      <div class="form__group">
        <label class="form__label" for="Paquete">Paquete:</label>
        <select class="form__select" id="Paquete" name="Paquete" required>
          <option value="">Seleccionar paquete</option>
          <option value="lote1">Paquete 1</option>
          <option value="lote2">Paquete 2</option>
          <option value="lote3">Paquete 3</option>
        </select>
      </div>
      <div class="form__group">
        <label class="form__label" for="Paquete">Paquete:</label>
        <select class="form__select" id="Paquete" name="Paquete" required>
          <option value="">Seleccionar paquete</option>
          <option value="lote1">Paquete 1</option>
          <option value="lote2">Paquete 2</option>
          <option value="lote3">Paquete 3</option>
        </select>
      </div>
      <div class="form__group">
        <label class="form__label" for="Paquete">Paquete:</label>
        <select class="form__select" id="Paquete" name="Paquete" required>
          <option value="">Seleccionar paquete</option>
          <option value="lote1">Paquete 1</option>
          <option value="lote2">Paquete 2</option>
          <option value="lote3">Paquete 3</option>
        </select>
      </div>
      <div class="form__group">
        <label class="form__label" for="Paquete">Paquete:</label>
        <select class="form__select" id="Paquete" name="Paquete" required>
          <option value="">Seleccionar paquete</option>
          <option value="lote1">Paquete 1</option>
          <option value="lote2">Paquete 2</option>
          <option value="lote3">Paquete 3</option>
        </select>
      </div>
      <div class="form__group">
        <label class="form__label" for="Paquete">Paquete:</label>
        <select class="form__select" id="Paquete" name="Paquete" required>
          <option value="">Seleccionar paquete</option>
          <option value="lote1">Paquete 1</option>
          <option value="lote2">Paquete 2</option>
          <option value="lote3">Paquete 3</option>
        </select>
      </div>

      <button class="form__button" type="submit">Generar</button>
    </form>
  </div>




  <footer>
    <div class="footer">

      <ul class="footer_list">
        <li class="footer__list__item"><a href="">¡Contactanos!</a></li>
        <li class="footer__list__item"><a href="">Sobre Nosotros</a></li>
      </ul>

      <div class="footer__copyright">
        <p>Copyright © 2023 Kalyx Software. Todos los derechos reservados</p>
      </div>

  </footer>


</body>

</html>