<?php
require 'SessionStartFuncionario.php';
?>
<!DOCTYPE html>
<html lang="en">

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
                <img src="assets/logo.png" alt="logo">
            </div>
            <ul class="navbar__list">
                <li class="navbar__list__item"><a href="">Bienvenido
                        <?php echo $usuarioigresado ?>
                <li class="navbar__list__item"><a href="#">Verificar Entrada</a></li>
                <li class="navbar__list__item"><a href="#">Asignación</a>
                    <ul class="navbar__submenu">
                        <li class="navbar__submenu__item"><a href="referencias/AsignacionDeLotes.html">Paquete a
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
    <div class="divTableAltas">
        <div class="form">
            <form action="" method="POST">

                <h3 class="form__text">Generar un Paquete</h3>
                <h4>ID del nuevo paquete :</h4><input type="text" name="paquete" placeholder="ID del paquete">
                <br><br>
                <h4>Contenido</h4>

                
                <input type="text" id="cont" name="contenido[]" placeholder="ingrese id de articulo">
          
                <input type="text" id="cont" name="contenido[]" placeholder="ingrese id de articulo">
              
                <input type="text" id="cont" name="contenido[]" placeholder="ingrese id de articulo">
          
                <input type="text" id="cont" name="contenido[]" placeholder="ingrese id de articulo">
             
                <input type="text" id="cont" name="contenido[]" placeholder="ingrese id de articulo">
                
                <p>articulos agregados : <span id="mostrar"></span> </p>
                <?php include'gencontent.php';?>



                <button type="submit" name="enviarDatosPaquete">Empaquetar!</button>
                

        </div>

        <div>

            <?php require '../Almacen/ConsultaRecibida.php'; ?>



            <div>
                <table class="tableAltas">
                    <h2 class="form__text">Lista de Articulos</h2>

                    <thead>
                        <tr>
                            <?php
                            $array = array(" ID ", " Codigo ", " Nombre ", " Precio ", " Stock ");
                            foreach ($array as $valor) {
                                echo '<th>' . $valor . '</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        <?php
                        foreach ($dato as $array) {

                            echo "<tr>";

                            foreach ($array as $contenido) {

                                echo "<td>" . $contenido . "</td>";

                            }

                            echo "</tr>";

                        }

                        ?>
            </div>



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

    </footer>


</body>

</html>