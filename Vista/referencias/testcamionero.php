<?php
$server = "127.0.0.1";
$user = "root";
$password = "";
$dbname = "logiquickbd";

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) { die("Error en la conexión a la base de datos: " . $conn->connect_error); }
?>

<?php 
$nombre = $_POST['nombre'];
$matricula = $_POST['camion'];

// Buscar el "ci" del camionero usando su nombre
$sql1 = "SELECT ci FROM camioneros WHERE nombre = '$nombre'";
$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // Encontrar el "ci" del camionero
    $row = $result->fetch_assoc();
    $ci = $row['ci'];

    // Verificar si el camionero ya está asignado
$sql_verificar = "SELECT * FROM conducen WHERE ci = $ci AND matricula = '$matricula'";

$result_verificar = $conn->query($sql_verificar);

if ($result_verificar->num_rows > 0) {
    echo "El camionero ya está asignado al camión.";
} else { $sql2 = "INSERT INTO conducen (ci, matricula) VALUES ('$ci', '$matricula')";
}

    if ($conn->query($sql2) === TRUE) {
        echo "Relación creada correctamente.";
    } else {
        echo "Error al crear la relación: " . $conn->error;
    }
    
}
// Cerrar la conexión
$conn->close();
?>





