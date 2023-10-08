<?php
require_once('../../sql/dbconection.php');

$idAlmacen = $_POST['idAlmacen'];
$N_puerta = $_POST['N_puerta'];
$calle = $_POST['calle'];
$localidad = $_POST['localidad'];
$departamento = $_POST['departamento'];

// Obtener la dirección completa
$direccion = $N_puerta . ', ' . $calle . ', ' . $localidad . ', ' . $departamento;

// Obtener coordenadas usando la API de OpenCage Data
$apiKey = '3111bb8dce164ee18ff3bfcf4a4bfc24'; // Reemplaza con tu clave de API de OpenCage Data
$url = "https://api.opencagedata.com/geocode/v1/json?q=" . urlencode($direccion) . "&key=" . $apiKey;

$response = file_get_contents($url);
$data = json_decode($response);

if ($data->results && count($data->results) > 0) {
    // Obtener las coordenadas
    $latitud = $data->results[0]->geometry->lat;
    $longitud = $data->results[0]->geometry->lng;

    // Formatear las coordenadas en el formato correcto para el tipo POINT de MySQL
    $ubiAlmacen = "POINT($latitud $longitud)";
    var_dump($ubiAlmacen);

    // Insertar los datos en la base de datos
    $query = "INSERT INTO almacenes (idAlmacen, N_puerta, calle, localidad, departamento, coordenadas) VALUES (?, ?, ?, ?, ?, GeomFromText(?))";
    $exc = $conn->execute_query($query, [$idAlmacen, $N_puerta, $calle, $localidad, $departamento, $ubiAlmacen]);

    if ($exc) {
        echo "<script>alert('Almacen ingresado con éxito.');window.location='../../indexAdmin.php'</script>";
    } else {
        echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
    }
} else {
    echo "<script>alert('No se encontraron coordenadas para la dirección proporcionada.');window.location='../../indexAdmin.php'</script>";
}
?>

