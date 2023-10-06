<!DOCTYPE html>
<html lang="en">

<head>
  <script src="Traducir.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../estilos/style.css">
  <link rel="icon" type="image/x-icon" href="../assets/logo.png">
  <title>LogiQuick</title>
</head>

<body class="body">

  <header>
    <nav class="navbar">

      <div class="navbar__logo">
        <img src="../assets/logo.png" alt="logo">
      </div>

      <ul class="navbar__list">
        <li class="navbar__list__item"><a href="RutaCamionero.php">Vizualizar rutas</a></li>
        <li class="navbar__list__item"><a href="CamionAsignado.php">Camion asignado</a></li>
      </ul>
      <!-- <button class="form__button" id="traductor-btn">Traducir Pagina</button> -->
      <div class="navbar__logout">
        <button class="navbar__logout__button"><a href="#">Cerrar Sesión</a></button>
      </div>

    </nav>
  </header>


  <h1>Lista de Camioneros y sus Camiones Asignado32435467890</h1>

  <?php
  $server = "127.0.0.1";
  $user = "root";
  $password = "";
  $dbname = "logiquickbd";

  $conn = new mysqli($server, $user, $password, $dbname);
  if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
  }
  ?>

  <?php
  // Consulta SQL para obtener la relación de camioneros y sus camiones asignados
  $sql = "SELECT camioneros.nombre, camiones.matricula
        FROM camioneros
        INNER JOIN conducen ON camioneros.ci = conducen.ci
        INNER JOIN camiones ON conducen.matricula = camiones.matricula";

  $result = $conn->query($sql);



  if ($result->num_rows > 0) {
    echo "<table><tr><th>Camionero</th><th>Camión Asignado (Matrícula)</th></tr>";
    while ($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["nombre"] . "</td><td>" . $row["matricula"] . "</td></tr>";
    }

    echo "</table>";
  } else {
    echo "No se encontraron registros.";
  }

  $conn->close();
  ?>

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