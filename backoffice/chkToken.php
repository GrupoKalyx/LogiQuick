<?php
// $conn = modeloBd::conexion();
// $token = $_SESSION['token'];
// $tipo = 'Admin';
//         $query = "SELECT token FROM usuarios WHERE token = ? LIMIT 1";
//         $result = $conn->execute_query($query, $token);
//         $fetch = $result->fetch_array(MYSQLI_ASSOC);
//         $bdToken = $fetch['token'];
//         $ver = ($bdToken == $token);
// $ver = modeloTokens::chkToken($token);
// if ($ver) {
//     $ver = modeloTokens::chkExpiration($token);
//     if($ver){
//         $type = modeloTokens::getType($token);
//         if ($type != $tipo) echo "<script>alert('Usted no tiene permiso para ingresar a esta página.');window.location=../Vista/indexMains.php;</script>";
//     }else{
//         echo "<script>alert('Su token ha expirado, vuelva a ingresar sesión porfavor.');window.location=../Vista/indexMains.php;</script>";
//     }            
// }else{
//     echo "<script>alert('El token es incorrecto, vuelva a ingresar sesión.');window.location=../Vista/indexMains.php;</script>";
// }
// $conn->close();