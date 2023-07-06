<?php
require 'SessionStartAdmin.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/FormStyle.css">
    <link rel="stylesheet" href="../estilos/Style.css">
    <title>Administracion</title>
</head>
<body>
    <header>
        <nav class="navbar">
          
          <div class="navbar__logo">
            <img src="../assets/logo.png">
            <h1 class="nav__text">Bienvenido: <?php echo $_SESSION['nombredeusuario']; ?> </h1>
          </div>
          <div class="navbar__logout">
                <form method="post">
                    <button class="navbar__logout__button" name="btncerrar" type="submit">Cerrar Sesión</button>
                </form>
            </div>

        </nav>
          
    </header>

    <div class="form__container2">

    <div class="form">
                <h2>usuarios  registrados</h2>
                <?php
                require 'ConsultaRecibida.php';
                    ?>
            </div>
    
    <div class="form">
    <h2>Ingresar Usuarios Nuevos</h2>
                <form  action="CRUD/Altas.php"  action=""  method="post">

                    Nombre de Usuario <input class="form__input" type="text" name="user"><br>
                    Password <input class="form__input" type="text" name="pass"><br><br>
                    Tipo <input class="form__input" type="text" name="type" placeholder="'Almacen' , 'Externo' o 'Camionero'"><br><br>
                    <button class="form__button" type="submit">Ingresar</button>
                    
                </form>
    
    
              </div>
            
    
    <div class="form">
                <h2>Modificar Usuario</h2>
                <form action="CRUD/Modificaciones.php" method="post">

                    Nombre de Usuario <input class="form__input" type="text" name="user"><br>
                    Nuevo Nombre de usuario  <input class="form__input" type="text" name="usernew"><br>
                    Nueva Contrasenia <input class="form__input"  type="text" name="pass"><br><br>
                    <button class="form__button" type="submit">Modificar</button>
                </form>
            </div>

            <div class="form" >
                <h2>dar de baja Usuario</h2>
                <form class="form" action="CRUD/Bajas.php" method="post">

                    Nombre de Usuario <input class="form__input" type="text" name="user"><br><br>
                    <button class="form__button" type="submit">Eliminar</button>
                </form>
            </div>
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


?>