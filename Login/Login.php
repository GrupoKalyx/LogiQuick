<?php
session_start();
if (isset($_SESSION['nombredeusuario'])) {
    header("location: http://localhost/Projectov4/Login/Login.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/FormStyle.css">
    <link rel="stylesheet" href="../estilos/Style.css">
    <title>Login Usuario</title>
</head>
<body>
    <header>
        <nav class="navbar">
          <div class="navbar__logo">
            <img src="/assets/logo.png" alt="logo">
          </div>
        </nav>
          <h1 class="nav__text">Bienvenido a LogiQuick! </h1>
    </header>

    <div class="form__container">
        <form class="form" method="POST">
    
            <h2 class="form__text">Ingrese sus Datos</h2>
    
            <div class="form__group">
              <label class="form__label" for="Usuario">Usuario:</label>
              <input class="form__input" type="text" id="Usuario" name="username" required>
            </div>
          
            <div class="form__group">
              <label class="form__label" for="Contraseña">Contraseña:</label>
              <input class="form__input" type="password" id="Contraseña" name="password" required>
            </div>
            <div class="form__group" >
              <select name="typeU" class="form_select">
                <option value="AdminAlm">Funcionario Central</option>
                <option value="Camioner">Camionero</option>
              </select>
            </div>

            <button class="form__button" name="login" type="submit">Iniciar Sesión</button>
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
        </div>
      </footer>
</body>
</html>
<?php
require 'LoginCodeMain.php';

?>