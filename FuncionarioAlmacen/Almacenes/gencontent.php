<?php
require 'dbconectionArticulos.php';
if (isset($_POST['enviarDatosPaquete'])){
               
    $idRecibed1 = $_POST['contenido'];
    $Recibedlote = $_POST['paquete'];
  
    foreach ($idRecibed1 as  $value) {
       
    
       $sql = "SELECT Nombre  FROM articulos WHERE ID = '$value'";
       $result =$conectionn->query($sql);
       while($row = mysqli_fetch_array($result)){
      
        echo $row['Nombre']. "<br>";
   
       }
    }
       foreach ($idRecibed1 as  $value2) {
        //$sql2 = "SELECT Nombre  FROM articulos WHERE ID = '$value2'";
        $sql5 = "SELECT Nombre  FROM articulos WHERE ID = '$value2'";
        $sql2y5 = "SELECT ID  FROM articulos WHERE ID = '$value2'";
        $result5 =$conectionn->query($sql5);
        $result3 =$conectionn->query($sql2y5);
        while ($rows = mysqli_fetch_array($result3) and $rowsN=mysqli_fetch_array($result5) ) {
            $rowXD = $rows['ID'];
            $rown = $rowsN['Nombre'];
            
            $sql3 = "INSERT INTO lote (idLote, idPaquete , ArticulosLote) VALUES ($Recibedlote , $rowXD, '$rown'  )";
            $result2 =$conectionn->query($sql3);
            if( $result2 ===true){
            
            }else{
             echo "fail";
            }
        }
      
          
   
       
      
       
    }
    echo "<script>alert('Paquete armando con exito!');window.location='IndexPrincipal.php'</script>";
}


        








?>