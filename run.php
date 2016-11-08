<?php

require_once __DIR__.'/vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();


$response = $client->get('http://server');
$body = (string) $response->getBody();

echo sprintf("Response length: %d\n", (int) $response->getHeaderLine('Content-Length'));
echo sprintf("Stream length: %d\n", (int) $response->getBody()->getSize());
echo sprintf("Body length: %d\n", strlen($body));
