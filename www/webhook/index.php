<?php
// kvstore API url
$url = 'http://127.0.0.1:19088/verify/telegram';

// Collection object
$data = json_decode(file_get_contents('php://input'), true);
file_put_contents('./logs.txt', json_encode($data) . PHP_EOL);
// Initializes a new cURL session
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));
curl_setopt($curl, CURLOPT_HTTPHEADER, [
  'Content-Type: application/json'
]);

// Execute cURL request with all previous settings
$response = curl_exec($curl);
curl_close($curl);

echo $response . PHP_EOL;


