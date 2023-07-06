<?php
function httpRequest($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($curl);
    return $data;
}


$dato = json_decode(httpRequest("http://127.0.0.1/Projectov4/backoffice/CRUD/dbconsult.php"));

foreach ($dato as $value) {

    foreach ($value as $key => $v) {

        echo "<a class='echo1'> " . $key . " " . $v ."</a>";
    }
   
}
$_SESSION['keystored'] = $key;
$_SESSION['vstored'] = $v;
?>
