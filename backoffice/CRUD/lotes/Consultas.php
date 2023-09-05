<?php
require_once('../../sql/dbconection.php');
echo '<link rel="stylesheet" href="../../estilos/FormStyleBackoffice.css">';

$conn = new mysqli($server, $user, $password, $dbname);
// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8");

$query = "SELECT * FROM lotes";
$result = mysqli_query($conn, $query);
$arrayConsulta = array();

foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
    $num = $row['numLote'];
    $estado = $row['estado'];
    array_push($arrayConsulta, ['Lote actual  : ' => $num, '<br> Estado: ' => $estado . '<br><br>']);
}

foreach ($arrayConsulta as $value) {
    foreach ($value as $key => $v) {
        echo "<a class='form__viewContent'> " . $key . " " . $v . "</a>";
    }
}
?>