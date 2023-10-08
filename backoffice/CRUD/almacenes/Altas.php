<?php
require_once('../../sql/dbconection.php');

$idAlmacen = $_POST['idAlmacen'];
$N_puerta = $_POST['N_puerta'];
$calle = $_POST['calle'];
$localidad = $_POST['localidad'];
$departamento = $_POST['departamento'];
$pais = "Uruguay";

$apiKey = '3111bb8dce164ee18ff3bfcf4a4bfc24';
$url = "https://api.opencagedata.com/geocode/v1/json?q={$N_puerta}+{$calle}+{$departamento}+{$pais}&key={$apiKey}";

$response = file_get_contents($url);

if ($response) {
    $data = json_decode($response, true);
    $coordenadas = $data['results'][0]['geometry'];
    $ubiAlmacen = $coordenadas['lat'] . ',' . $coordenadas['lng'];

    $query = "INSERT INTO almacenes (idAlmacen, N_puerta, calle, localidad, departamento, ubiAlmacen) VALUES (?, ?, ?, ?, ?, ?)";
    $exc = $conn->execute_query($query, [$idAlmacen, $N_puerta, $calle, $localidad, $departamento, $ubiAlmacen]);

    if ($exc) {
        echo "<script>alert('Almacen ingresado con éxito.');window.location='../../indexAdmin.php'</script>";
    } else {
        echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
    }
} else {
    echo "<script>alert('Error al obtener las coordenadas.');window.location='../../indexAdmin.php'</script>";
}
?>


