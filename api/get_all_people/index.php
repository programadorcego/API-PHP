<?php
header("Content-Type: application/json");

$response['status'] = 'success';
$response['data'] = require_once __DIR__ . '/../data/data.php';
$response['time_response'] = time();

echo json_encode($response, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);