<?php
require_once('sql/dbconection.php');
session_start();
if (isset($_SESSION['token'])) {
    require_once('chkToken.php');
}
if (isset($_POST['btncerrar'])) {
    $_SESSION['token'] = null;
    header("location: loginAdmin.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/FormStyleBackoffice2.css">
    <link rel="stylesheet" href="estilos/backofficeStyle.css">
    <link rel="icon" type="image/x-icon" href="assets/logo.png">
    <title>LogiQuick</title>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="navbar__logo">
                <img src="assets/logo.png">
            </div>
            <div class="navbar__logout">
                <form method="post">
                    <button class="navbar__logout__button" name="btncerrar" type="submit">Cerrar Sesión</button>
                </form>
            </div>
        </nav>
    </header>
    <div>
        <br>
        <h1 class="nav__text"> Backoffice </h1>
    </div>

    <div class="form__container__backoffice"> <!-- CRUD de Usuarios -->
        <div class="form">
            <h2>Ingresar Usuarios Nuevos</h2>
            <form action="CRUD/usuarios/Altas.php" method="post">
                CI <input class="form__input" type="text" name="ci" required><br>
                Nombre de Usuario <input class="form__input" type="text" name="nombre"><br>
                Contraseña <input class="form__input" type="password" name="contrasenia"><br>
                Telefono <input class="form__input" type="text" name="telefono"><br><br>
                Tipo de usuario <select class="form__input" name="tipo">
                    <option value="Admin">Admin</option>
                    <option value="Funcionario">Funcionario central(QC)</option>
                    <option value="Externo">Funcionario externo</option>
                    <option value=" ">Funcionario secundario</option>
                    <option value="Camionero">Camionero</option>
                    <option value="Delivery">Delivery</option>
                </select><br><br>
                <button class="form__button" type="submit">Ingresar</button>
            </form>
        </div>
        <div class="form">
            <h2>Dar de baja Usuario</h2>
            <form class="m" action="CRUD/usuarios/Bajas.php" method="post">
                CI de usuario <input class="form__input" type="text" name="ci"><br><br>
                <button class="form__button" type="submit">Eliminar</button>
            </form>
        </div>
        <div class="form" id="list">
            <h2>Usuarios registrados</h2><br>
            <iframe src="CRUD/usuarios/Consultas.php">
            </iframe>
        </div>
        <div class="form">
            <h2>Modificar Usuario</h2>
            <form action="CRUD/usuarios/Modificaciones.php" method="post">
                CI <input class="form__input" type="text" name="ci"><br>
                <h2>Nuevos datos</h2>
                Nuevo nombre de usuario <input class="form__input" type="text" name="nombre"><br>
                Nueva contraseña <input class="form__input" type="password" name="contrasenia"><br>
                Nuevo telefono <input class="form__input" type="text" name="telefono"><br><br>
                <button class="form__button" type="submit">Modificar</button>
            </form>
        </div>
    </div>

    <div class="form__container__backoffice"> <!-- CRUD de Paquetes-->
        <div class="form">
            <h2>Ingresar paquete</h2>
            <form action="CRUD\paquetes\Altas.php" method="post" id="ingPaqueteForm">
                Correo del cliente <input class="form__input" type="text" name="gmailCliente"><br><br>
                Numero <input class="form__input" type="text" id="ingPaqueteNum" name="num"><br><br>
                Calle <input class="form__input" type="text" id="ingPaqueteCalle" name="calle"><br><br>
                Localidad <input class="form__input" type="text" id="ingPaqueteLocalidad" name="localidad"><br><br>
                Departamento <input class="form__input" type="text" id="ingPaqueteDepartamento" name="departamento"><br><br>
                <input type="hidden" name="coordenadasLat" id="ingPaqueteLat">
                <input type="hidden" name="coordenadasLng" id="ingPaqueteLng">
                <button class="form__button" id="ingPaquete" type="button" onclick="myFunction('ingPaquete');">Ingresar</button>
            </form>
        </div>
        <div class="form" id="list">
            <h2>Eliminar paquete</h2>
            <form action="CRUD\paquetes\Bajas.php" method="post">
                Numero de bulto <input class="form__input" type="text" name="numBulto"><br><br>
                <button class="form__button" type="submit">Eliminar</button>
            </form>
        </div>
        <div class="form" id="list">
            <h2>Lista de paquetes</h2><br>
            <iframe src="CRUD/paquetes/Consultas.php">
            </iframe>
        </div>
        <div class="form">
            <h2>Modificar datos de paquete</h2>
            <form action="CRUD\paquetes\Modificaciones.php" method="post" id="modPaqueteForm">
                Numero de bulto <input class="form__input" type="text" name="numBulto" required><br><br>
                Correo del cliente <input class="form__input" type="text" name="gmailCliente"><br><br>
                Fecha de creacion <input type="date" name="fechaLlegada">
                Horario de creacion <input type="time" name="horarioLlegada">
                Numero <input class="form__input" type="text" id="modPaqueteNum" name="num"><br><br>
                Calle <input class="form__input" type="text" id="modPaqueteCalle" name="calle"><br><br>
                Localidad <input class="form__input" type="text" id="modPaqueteLocalidad" name="localidad"><br><br>
                Departamento <input class="form__input" type="text" id="modPaqueteDepartamento" name="departamento"><br><br>
                <input type="hidden" name="coordenadasLat" id="modPaqueteLat">
                <input type="hidden" name="coordenadasLng" id="modPaqueteLng">
                <button class="form__button" id="modPaquete" type="button" onclick="myFunction('modPaquete');">Modificar</button>
            </form>
        </div>
    </div>

    <div class="form__container__backoffice"> <!-- CRUD de Lotes -->
        <div class="form">
            <h2>Ingresar lote</h2>
            <form action="CRUD\lotes\Altas.php" method="post">
                Paquete 1 <br><input class="form__input" type="text" id="paquete1" name="paquete1"><br><br>
                Paquete 2 <br><input class="form__input" type="text" id="paquete2" name="paquete2"><br><br>
                Paquete 3 <br><input class="form__input" type="text" id="paquete3" name="paquete3"><br><br>
                Paquete 4 <br><input class="form__input" type="text" id="paquete4" name="paquete4"><br><br>
                Paquete 5 <br><input class="form__input" type="text" id="paquete5" name="paquete5"><br><br>
                <button type="submit" class="form__button" name="actionbtn">Ingresar</button>
            </form>
        </div>
        <div class="form">
            <h2>Eliminar Lote</h2>
            <form action="CRUD\lotes\Bajas.php" method="post">
                ID de Lote<input class="form__input" type="text" name="eliminacion"><br><br>
                <button class="form__button" type="submit">Eliminar</button>
            </form>
        </div>
        <div class="form" id="list">
            <h2>Lista de lotes</h2><br>
            <iframe src="CRUD/lotes/Consultas.php">>
            </iframe>
        </div>
        <div class="form">
            <h2>Modificar datos del Lote</h2>
            <form action="CRUD\lotes\Modificaciones.php" method="post">
                <h2>Modificar datos del Lote</h2>
                Numero de lote <input class="form__input" text="text" name="numLote"><br>
                Numero de bulto <input class="form__input" text="text" name="numBulto"><br>
                <h2>Nuevo paquete</h2>
                Numero de bulto <input class="form__input" text="text" name="numNuevoPaquete">
            </form>
        </div>
    </div>

    <div class="form__container__backoffice"> <!-- CRUD de Almacenes -->
        <div class="form">
            <h2> Ingresar datos de Almacen</h2>
            <form action="CRUD/almacenes/Altas.php" method="post" id="ingAlmacenForm">
                Id de almacen <input type="text" class="form__input" name="idAlmacen"><br>
                Num <input class="form__input" type="text" id="ingAlmacenNum" name="num"><br>
                Calle <input class="form__input" type="text" id="ingAlmacenCalle" name="calle" required><br>
                Localidad <input class="form__input" type="text" id="ingAlmacenLocalidad" name="localidad"><br>
                Departamento <input class="form__input" type="text" id="ingAlmacenDepartamento" name="departamento" required><br><br>
                <input type="hidden" name="ubiAlmacenLat" id="ingAlmacenLat">
                <input type="hidden" name="ubiAlmacenLng" id="ingAlmacenLng">
                <button class="form__button" id="ingAlmacen" type="button" onclick="myFunction('ingAlmacen');">Ingresar</button>
            </form>
        </div>
        <div class="form">
            <h2>Eliminar un almacen</h2>
            <form action="CRUD/almacenes/Bajas.php" method="post">
                Id de almacen<input class="form__input" type="text" name="idAlmacen"><br><br>
                <button class="form__button" type="submit">Eliminar</button>
            </form>
        </div>
        <div class="form" id="list">
            <h2>Almacenes registrados</h2><br>
            <iframe src="CRUD/almacenes/Consultas.php">
            </iframe>
        </div>
        <div class="form">
            <h2> Ingresar datos de Almacen a modificar</h2>
            <form action="CRUD/almacenes/Modificaciones.php" method="post" id="modAlmacenForm">
                Id de almacen <input class="form__input" type="text" name="idAlmacen">
                <h2>Nuevos datos</h2>
                Num <input class="form__input" type="text" id="modAlmacenNum" name="num"><br>
                Calle / Ruta<input class="form__input" type="text" id="modAlmacenCalle" name="calle" required><br>
                Localidad <input class="form__input" type="text" id="modAlmacenLocalidad" name="localidad"><br>
                Departamento <input class="form__input" type="text" id="modAlmacenDepartamento" name="departamento" required><br><br>
                <input type="hidden" name="ubiAlmacenLat" id="modAlmacenLat">
                <input type="hidden" name="ubiAlmacenLng" id="modAlmacenLng">
                <button class="form__button" id="modAlmacen" type="button" onclick="myFunction('modAlmacen');">Modificar</button>
            </form>
        </div>
    </div>

    <div class="form__container__backoffice"> <!-- CRUD de Rutas -->
        <div class="form">
            <h2>Ingresar datos de Rutas</h2>
            <form action="CRUD/rutas/Altas.php" method="post">
                Numero de ruta <input type="text" class="form__input" name="numRuta"><br>
                <label for="depart">Departamento</label>
                <select class="form__select" id="depart" name="departamentos[]">
                    <option value="">Seleccionar departamento</option>
                    <option value="Montevideo">Montevideo</option>
                    <option value="Maldonado">Maldonado</option>
                    <option value="Canelones">Canelones</option>
                    <option value="Colonia">Colonia</option>
                    <option value="San Jose">San Jose</option>
                    <option value="Florida">Florida</option>
                    <option value="Rivera">Rivera</option>
                    <option value="Paysandu">Paysandu</option>
                    <option value="Rio Negro">Rio Negro</option>
                    <option value="Artigas">Artigas</option>
                    <option value="Durazno">Durazno</option>
                    <option value="Lavalleja">Lavalleja</option>
                    <option value="Flores">Flores</option>
                    <option value="Salto">Salto</option>
                    <option value="Soriano">Soriano</option>
                    <option value="Tacuarembo">Tacuarembo</option>
                    <option value="Treinta y Tres">Treinta y Tres</option>
                    <option value="Cerro Largo">Cerro Largo</option>
                    <option value="Rocha">Rocha</option>
                </select>
                <br><br>
                <div class="form__group" id="departamentosContainer">
                    <!-- aca van paquetes nuevos-->
                </div>
                <button class="form__button" type="submit">Ingresar</button>
            </form>
        </div>
        <div class="form">
            <h2>Eliminar una ruta</h2>
            <form action="CRUD/rutas/Bajas.php" method="post">
                Numero de ruta<input class="form__input" type="text" name="numRuta"><br><br>
                <button class="form__button" type="submit">Eliminar</button>
            </form>
        </div>
        <div class="form" id="list">
            <h2>Rutas registradas</h2><br>
            <iframe src="CRUD/rutas/Consultas.php">
            </iframe>
        </div>
        <div class="form">
            <h2>Modificar datos de ruta</h2>
            <form action="CRUD/rutas/Modificaciones.php" method="post">
                Numero de ruta <input type="text" class="form__input" name="numRuta"><br>
                <label for="departMod">Nuevos departamentos</label>
                <select class="form__select" id="departMod" name="departamentos[]">
                    <option value="">Seleccionar departamento</option>
                    <option value="Montevideo">Montevideo</option>
                    <option value="Maldonado">Maldonado</option>
                    <option value="Canelones">Canelones</option>
                    <option value="Colonia">Colonia</option>
                    <option value="San Jose">San Jose</option>
                    <option value="Florida">Florida</option>
                    <option value="Rivera">Rivera</option>
                    <option value="Paysandu">Paysandu</option>
                    <option value="Rio Negro">Rio Negro</option>
                    <option value="Artigas">Artigas</option>
                    <option value="Durazno">Durazno</option>
                    <option value="Lavalleja">Lavalleja</option>
                    <option value="Flores">Flores</option>
                    <option value="Salto">Salto</option>
                    <option value="Soriano">Soriano</option>
                    <option value="Tacuarembo">Tacuarembo</option>
                    <option value="Treinta y Tres">Treinta y Tres</option>
                    <option value="Cerro Largo">Cerro Largo</option>
                    <option value="Rocha">Rocha</option>
                </select>
                <br><br>
                <div class="form__group" id="departamentosContainer">
                    <!-- aca van paquetes nuevos-->
                </div>
                <button class="form__button" type="submit">Modificar</button>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer">
            <ul class="footer_list">
                <li class="footer__list__item"><a href="">¡Contactanos</a></li>
                <li class="footer__list__item"><a href="">Sobre Nosotros</a></li>
            </ul>
            <div class="footer__copyright">
                <p>Copyright © 2023 Kalyx Software. Todos los derechos reservados</p>
            </div>
        </div>
    </footer>

    <script>
        function myFunction(type) {
            if (`${type}` == 'ingAlmacen') {
                var num = document.getElementById('ingAlmacenNum').value;
                var calle = document.getElementById('ingAlmacenCalle').value;
                var localidad = document.getElementById('ingAlmacenLocalidad').value;
                var departamento = document.getElementById('ingAlmacenDepartamento').value;
            } else if (`${type}` == 'modAlmacen') {
                var num = document.getElementById('modAlmacenNum').value;
                var calle = document.getElementById('modAlmacenCalle').value;
                var localidad = document.getElementById('modAlmacenLocalidad').value;
                var departamento = document.getElementById('modAlmacenDepartamento').value;
            } else if (`${type}` == 'ingPaquete') {
                var num = document.getElementById('ingPaqueteNum').value;
                var calle = document.getElementById('ingPaqueteCalle').value;
                var localidad = document.getElementById('ingPaqueteLocalidad').value;
                var departamento = document.getElementById('ingPaqueteDepartamento').value;
            } else if (`${type}` == 'modPaquete') {
                var num = document.getElementById('modPaqueteNum').value;
                var calle = document.getElementById('modPaqueteCalle').value;
                var localidad = document.getElementById('modPaqueteLocalidad').value;
                var departamento = document.getElementById('modPaqueteDepartamento').value;
            }

            const direccion = encodeURI(`${num}, ${calle}, ${localidad}, ${departamento}, Uruguay`);
            const apiKey = '3111bb8dce164ee18ff3bfcf4a4bfc24';
            const url = `https://api.opencagedata.com/geocode/v1/json?q=${direccion}&key=${apiKey}`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    var coordinates = data.results[0].geometry; // Obtener las coordenadas de la respuesta de la API
                    var lat = coordinates.lat;
                    var lng = coordinates.lng;

                    document.getElementById(`${type}Lat`).value = `${lat}`;
                    document.getElementById(`${type}Lng`).value = `${lng}`;
                    document.getElementById(`${type}Form`).submit();
                })
                .catch(error => {
                    console.error('Error al obtener las coordenadas:', error);
                });
        }
    </script>
</body>

</html>