<?php
session_start();

if (isset($_SESSION['nombredeusuario'])) {
   header("location: http://localhost/Projectov4/Login/IndexprincipalLogin.php");
}


?>



<!DOCTYPE html>

<html lang="en">

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
                    <td>password:<input type="text" name="password"></td>
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




    if (isset($_POST['login'])) {
        $server = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "multiuser";
        $conn = new mysqli($server, $user, $pass, $dbname);
        function createGUID()
        {
        if (function_exists('com_create_guid'))
        {
        return com_create_guid();
        }
        else
        {
        mt_srand((double)microtime()*10000);
        //optional for php 4.2.0 and up.
        $set_charid = strtoupper(md5(uniqid(rand(), true)));
        $set_hyphen = chr(45);
        // "-"
        $set_uuid = chr(123)
        .substr($set_charid, 0, 8).$set_hyphen
        .substr($set_charid, 8, 4).$set_hyphen
        .substr($set_charid,12, 4).$set_hyphen
        .substr($set_charid,16, 4).$set_hyphen
        .substr($set_charid,20,12)
        .chr(125);
        // 
        return $set_uuid;
        }
        }
        $new_GUID = createGUID();
        
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $type = $_POST['type'];
       


        $query2 =mysqli_query($conn, "INSERT INTO sessiontoken VALUES ('$new_GUID' , '$username')");
        
        //$sql4 = mysqli_query($conn, "SELECT UserT FROM sessiontoken WHERE UserT = '$username'");


        $query = mysqli_query($conn, "SELECT * FROM `typeuser` WHERE type = '" . $type . "' and username  = '" . $username . "' and password = '" . $password . "' ");
        $nrows = mysqli_num_rows($query);
        //if (!isset($_SESSION['nombredeusuario'])) {


            if ($nrows == 1 && $type == 'user') {
                $_SESSION['nombredeusuario'] = $username;
                $_SESSION['chkT'] = $new_GUID;

                header("Location:/Projectov4/Almacenes/Depositos.php");
            } else if ($nrows == 1 && $type == 'admin' ) {
                $_SESSION['nombredeusuario'] = $username;
                $_SESSION['chkT'] = $new_GUID;
                header("Location:/Projectov4/backoffice/indexAdmin.php");
            } else if ($nrows == 0) {
                echo "<script>alert('usuario inexistente , re intente por favor!');window.location='IndexprincipalLogin.php' </script>";
            }

        }










    





/*if ($result) {

    while($row = mysqli_fetch_array($result)) {
        $storedPassword = $row['password'];
        $storeUser = $row['username'];




    }
    
    
        
    
    
    if ( $password==$storedPassword && $username == $storeUser) {


        if($type =='user'){
            header("Location:/Projecto/Projecto/Almacenes/Depositos.php");

        }else
            header("Location:/Projecto/Projecto/backoffice/indexAdmin.php");
        }
    }else{
        print_r("error");
    

    }
       
    }   

   */



?>