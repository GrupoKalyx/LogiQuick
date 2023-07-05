<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Articulos</title>

</head>

<body>

    <div class="bajas">
        <h1>
            Eliminar
        </h1>
        <form action="AlmacenBajas.php" method="post">
            <label for="id2">Borrar por id</label>
            <input type="text" name="id2">
            <button type="submit">borrar articulo</button>
        </form>
    </div>

    <h1 id="h1">Registro de Articulos</h1><br><br>
    <div class="form-container">
        <form action="almacenApi.php" method="post">
            <label for="Codigo">Codigo</label>
            <input type="text" name="Codigo"><br>
            <label for="Nombre">Nombre de Producto</label>
            <input type="text" name="Nombre"><br>
            <label for="Precio">Precio</label>
            <input type="text" name="Precio"><br>
            <label for="Stock">Stock Actual</label>
            <input type="text" name="Stock"><br>

            <button type="submit">Registrar</button>
        </form>
    </div>
    <div class="modifi">
        <h1>modificar articulo</h1>
        <form action="almacenModificar.php" method="post">
            <label for="id">id</label>
            <input type="text" name="id">
            <label for="Codigo">Codigo</label>
            <input type="text" name="Codigo"><br>
            <label for="Nombre">Nombre de Producto</label>
            <input type="text" name="Nombre"><br>
            <label for="Precio">Precio</label>
            <input type="text" name="Precio"><br>
            <label for="Stock">Stock Actual</label>
            <input type="text" name="Stock"><br>
            <button type="submit">Modificar</button>

        </form>
    </div>
    <div>

    </div>
    <div class="div-container">
        <h1>Lista Almacen</h1>

        <?php
        function httpRequest($url)
        {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($curl);
            return $data;
        }
        $dato = json_decode(httpRequest("http://127.0.0.1/Projecto/Projecto/Almacen2/AlmacenLista.php"), true);
        $colores = array();


        ?>

        <table border="1">

            <thead>

                <tr>
                    <?php

                    $array = array("ID ", "Codigo ", "Nombre ", "Precio ", "Stock ");

                    foreach ($array as $valor) {

                        echo '<th>' . $valor . '</th>';

                    }

                    ?>

                </tr>

            </thead>

            <tbody>

                <?php

                // obtenemos los colores
                
                foreach ($dato as $array) {

                    echo "<tr>";

                    foreach ($array as $contenido) {

                        echo "<td>" . $contenido . "</td>";

                    }

                    echo "</tr>";

                }

                ?>

            </tbody>

        </table>
    </div>
</body>

</html>