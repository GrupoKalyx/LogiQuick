<?php
session_start();
if (isset($_SESSION['nombredeusuario'])) {
    header("location: http://localhost/Projectov4/Login/IndexprincipalLogin.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login de usuarios</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <div class="login-container">
        <form method="post">
            <table>
                <tr>
                    <td>username:<input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>password:<input type="password" name="password"></td>
                </tr>
                <tr>
                    <td>usertype<br><select name="type" id="">
                            <option value="user">user</option>
                            <option value="admin">admin</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="submit" id="sub1" name="login" value="login">login</button>
                    </td>
                </tr>
        </form>

    </div>
</body>
</html>
<?php
require "LoginCodeMain.php";
?>