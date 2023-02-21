<?php
header("Content-Type: application/json");

$data = require_once __DIR__ . '/../data/data.php';

if(!isset($_GET['max']) || !is_numeric($_GET['max']) || $_GET['max'] < 1 || $_GET['max'] > count($data))
{
	$response['status'] = 'error';
	$response['message'] = 'Invalid `max` argument!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
	exit;
}

$max = intval($_GET['max']);

$response['status'] = 'success';
$response['data'] = array_slice($data, 0, $max);
$response['time_response'] = time();

echo json_encode($response, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);