<?php
$server = "127.0.0.1";
$user = "root";
$password = "";
$dbname = "logiquickbd";

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) { die("Error en la conexión a la base de datos: " . $conn->connect_error); }
?>

<?php
// ... código de conexión a la base de datos ...

$sql = "SELECT nombre FROM camioneros";
$result = $conn->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    $nombres = array();
    while ($row = $result->fetch_assoc()) {
        $nombres[] = $row["nombre"];
    }
} else {
    echo "No se encontraron datos en la tabla nombre.";
}

?>

<?php
// ... código de conexión a la base de datos ...

$sql2 = "SELECT matricula FROM camiones";
$result2 = $conn->query($sql2);

// Verificar si se obtuvieron resultados
if ($result2->num_rows > 0) {
    $matriculas = array();
    while ($row = $result2->fetch_assoc()) {
        $matriculas[] = $row["matricula"];
    }
} else {
    echo "No se encontraron datos en la tabla matricula.";
}

// Cerrar la conexión a la base de datos
$conn->close();
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
        <img src="/assets/logo.png" alt="logo">
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
        <label class="form__label" for="Camionero">Camionero:</label>
        <select class="form__select" id="nombre" name="nombre" required>
          <option value="">Seleccionar camionero</option>
            <?php
            foreach ($nombres as $nombre) {
                echo "<option value='$nombre'>$nombre</option>";
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