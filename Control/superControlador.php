<?php
function superControlador($url, $metodo, $parameters)
{
        $ch = curl_init();
        $parameters = http_build_query($parameters);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $metodo);
        switch ($metodo) {
                case 'GET':
                        curl_setopt($ch, CURLOPT_URL, $url . "?" . $parameters);
                        break;
                case 'POST' or 'PUT' or 'DELETE':
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                        break;
        }
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
}
