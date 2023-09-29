<?php
function superControlador($url, $metodo, $parameters)
{
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        switch ($metodo) {
                case 'GET': 
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        break;
                case 'POST':
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                        break;
                case 'PUT':
                        curl_setopt($ch, CURLOPT_PUT, 1);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                        break;
                case 'DELETE':
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                        break;
        }
        $result = curl_exec($ch);
        return $result;
}
