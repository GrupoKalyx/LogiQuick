<?php
function superControlador($url, $metodo, $parameters)
{ 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        switch ($metodo) {
                case 'GET':
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        break;
                case 'POST':
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                        break;
                case 'PUT':
                        curl_setopt($ch, CURLOPT_PUT, 1);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                        break;
                case 'DELETE':
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                        break;
        }
        $result = curl_exec($ch);
        curl_close($ch);
        var_dump ($result);
        return $result;
}