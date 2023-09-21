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
        <li class="navbar__list__item"><a href="#">Ingresar Paquete</a></li>
      </ul>
      <!-- <button class="form__button" id="traductor-btn">Traducir Pagina </button> -->
      <div class="navbar__logout"> 
        <button class="navbar__logout__button"><a href="#">Cerrar Sesión</a></button>
      </div>
    </nav>
  </header>

  <div class="form__container">
    <form class="form" method="POST">

        <h2 class="form__text">Ingrese datos del paquete</h2>

        <div class="form__group">
          <label class="form__label" for="destino">Destino:</label>
          <input class="form__input" type="text" id="destino" name="destino" required>
        </div>
      
        <div class="form__group">
          <label class="form__label" for="ciudad">Ciudad:</label>
          <input class="form__input" type="text" id="ciudad" name="ciudad" required>
        </div>
      
        <div class="form__group">
          <label class="form__label" for="direccion">Dirección:</label>
          <input class="form__input" type="text" id="direccion" name="direccion" required>
        </div>

        <div class="form__group">
            <label class="form__label" for="Volumen">Volumen (M3):</label>
            <input class="form__input" type="number" id="Volumen" name="Volumen" required>
          </div>
      
        <button class="form__button" type="submit">Enviar</button>
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