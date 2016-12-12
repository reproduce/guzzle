<?php

$response = [
    'errors' => [
        'oh_my' => 'Oh my...',
    ],
];

$response = json_encode($response);

http_response_code(500);
header('Content-Type: application/json');
header('Content-Length: '.strlen($response));

echo $response;
