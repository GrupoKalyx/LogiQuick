<?php
$queryString = http_build_query([
  'access_key' => 'e4d0b2be36603ae933c8535c910c4eef',
  'query' => '1600 Pennsylvania Ave NW',
  'region' => 'Washington',
  'output' => 'json',
  'limit' => 1,
]);

$ch = curl_init(sprintf('%s?%s', 'https://api.positionstack.com/v1/forward', $queryString));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$json = curl_exec($ch);

curl_close($ch);

$apiResult = json_decode($json, true);

print_r($apiResult);