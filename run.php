<?php

require_once __DIR__.'/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;

$client = new Client();

try {
    $response = $client->get('http://server');
} catch (ServerException $e) {
    if ($e->hasResponse()) {
        $response = $e->getResponse();

        $body = \GuzzleHttp\Psr7\str($response);

        echo $body;
    }
}
