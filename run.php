<?php

require_once __DIR__.'/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\StreamHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;

$handler = new StreamHandler();
$stack = HandlerStack::create($handler);

$client = new Client(['handler' => $stack]);

$requestOptions = [
//    'stream' => true,
    'http' => [
        'timeout' => 55
    ],
    'ssl' => [
        'verify_peer' => false,
        'allow_self_signed' => true,
        'verify_peer_name' => false,
    ],
    'version' => '1.1',
    'headers' => [
        'Content-Type' => 'text/xml',
        'User-Agent' => 'GateA HTTP WebService',
        'Connection' => 'close',
        'Accept-Encoding' => 'gzip',
    ],
    'body' => json_encode(['key' => 'value']),
    'timeout' => 55,
    'debug' => false,
];

$request = new Request('POST', 'http://server', [], null, $requestOptions['version'] ?? '1.1');

try {
    $client->send($request, $requestOptions);
} catch (RequestException $e) {
    if ($e->hasResponse()) {
        $response = $e->getResponse();

        $body = \GuzzleHttp\Psr7\str($response);

        echo $body;
    }
}
