<?php

require_once __DIR__.'/vendor/autoload.php';

use GuzzleHttp\Client;

if (isset($argv[1]) && 'fail' === $argv[1]) {
    define('PROXY', 'invalid_proxy:3128');
    echo "Using invalid proxy (everything should fail)\n\n";
} else {
    define('PROXY', 'proxy:3128');
    echo "Using proxy (everything should be ok)\n\n";
}


$client = new Client([
    'defaults' => [
        'proxy' => 'http://'.PROXY,
    ],
]);

try {
    $response = $client->get('http://google.com');
    $result = $response->getStatusCode() === 200 ? 'OK' : 'ERROR';
} catch (\GuzzleHttp\Exception\TransferException $e) {
    $result = 'ERROR';
}

echo sprintf("Using default proxy [%s]\n", $result);


$client = new Client();

try {
    $response = $client->get('http://google.com', [
        'proxy' => 'http://'.PROXY,
    ]);
    $result = $response->getStatusCode() === 200 ? 'OK' : 'ERROR';
} catch (\GuzzleHttp\Exception\TransferException $e) {
    $result = 'ERROR';
}

echo sprintf("Using HTTP proxy [%s]\n", $result);


try {
    $response = $client->get('http://google.com', [
        'proxy' => 'https://'.PROXY,
    ]);
    $result = $response->getStatusCode() === 200 ? 'OK' : 'ERROR';
} catch (\GuzzleHttp\Exception\TransferException $e) {
    $result = 'ERROR';
}

echo sprintf("Using HTTPS proxy [%s]\n", $result);


try {
    $response = $client->get('http://google.com', [
        'proxy' => 'https://'.PROXY,
    ]);
    $result = $response->getStatusCode() === 200 ? 'OK' : 'ERROR';
} catch (\GuzzleHttp\Exception\TransferException $e) {
    $result = 'ERROR';
}

echo sprintf("Using TCP proxy [%s]\n", $result);


putenv('HTTP_PROXY='.PROXY);

$client = new Client();

try {
    $response = $client->get('http://google.com');
    $result = $response->getStatusCode() === 200 ? 'OK' : 'ERROR';
} catch (\GuzzleHttp\Exception\TransferException $e) {
    $result = 'ERROR';
}

echo sprintf("Using HTTP proxy from env var [%s]\n", $result);
