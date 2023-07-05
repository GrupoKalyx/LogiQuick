<?php

        function httpRequest2($url)
        {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($curl);
            return $data;
        }
        $dato = json_decode(httpRequest2("http://127.0.0.1/Projectov4/FuncionarioAlmacen/Almacenes/gencontent.php"));
        foreach ($dato as $value) {

            foreach ($value as $key => $v) {

                echo $key . $v; 
            }
        }
        ?>
        