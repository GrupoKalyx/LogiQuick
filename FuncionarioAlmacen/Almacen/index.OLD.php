<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/estilo.css">
    <title>GEstion de Productos</title>

</head>

<body>
    <div class="padre">

    <div class="bajas">
        <h1>
            Eliminar
        </h1>
        <form action="CRUD/AlmacenBajas.php" method="post">
            <label for="id2">Borrar por id</label>
            <input type="text" name="id2">
            <button type="submit">borrar articulo</button>
        </form>
    </div>

   
    
    <div class="form-container">
    <h1 id="h1">
        Registro de Articulos
    </h1>
        <form action="CRUD/almacenAltas.php" method="post">
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
        <form action="CRUD/almacenModificar.php" method="post">
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
        require "ConsultaRecibida.php";
        ?>

        </tbody>

        </table>
    </div>
    
</div>
<br>

</body>

</html>