<?php

require_once __DIR__.'/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\StreamHandler;


$client = new Client([
    'handler' => HandlerStack::create(new StreamHandler()),
]);

// The example is copied from https://github.com/guzzle/guzzle/issues/1385

$categoryId = 3;
$pageNum = 1;

$response = $client->get(
    'https://www.aliexpress.com/api-shopping-guide.html',
    [
        'version' => '1.0', // HTTP version with chunking?
        'query' => [
            'catId' => $categoryId,
            'tagResult' => 1,
            'page' => $pageNum
        ],
    ]
);

$result = json_decode($response->getBody());

if (null === $result) {
    echo "The returned response cannot be parsed as JSON\n";
} else {
    echo "The returned response can be parsed as JSON\n";
}
