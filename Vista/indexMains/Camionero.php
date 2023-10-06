<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilos/style.css">
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
        <li class="navbar__list__item"><a href="referencias/RutaCamionero.php">Visualizar Ruta</a></li>
        <li class="navbar__list__item"><a href="referencias/CamionesAsignados.php">Camiones Asignados</a></li>
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

<!-- Puede verificar la asignación de los camiones que le correspondan, iniciando así el viaje.
Puede ver que lotes están asignados a su camión, así como sus paquetes.
Puede verificar su llegada a un almacén.
Puede ver la ruta que le fue asignada (desde el almacén origen hasta el almacén destino pasando tal vez por otros almacenes).
Delivery:
Puede verificar la asignación de los pickups que se le asignen.
Puede visualizar los paquetes de su pickup asignada.
Puede verificar su llegada a un destino, registrando la entrega de paquete correspondiente y enviando una notificación al mail del cliente dueño del paquete.
Puede ver la ruta que le fue asignada (desde el almacén de origen pasando por todos los destinos de los paquetes que lleva). -->