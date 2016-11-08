<?php

$response = [
    'data' => [
        'key' => str_repeat('a', 9000),
        'key2' => str_repeat('a', 9000),
    ],
];

$response = json_encode($response);

header('Content-Type: application/json');
header('Content-Length: '.strlen($response));

echo $response;
