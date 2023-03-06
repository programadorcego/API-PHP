<?php
header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] != 'GET')
{
	$response['status'] = 'error';
	$response['message'] = 'Invalid HTTP Request Method!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

if(!isset($_GET['list']))
{
	$response['status'] = 'error';
	$response['message'] = 'The parameter `list` is missing!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

if(!is_array($_GET['list']))
{
	$response['status'] = 'error';
	$response['message'] = 'The parameter `list` must be an array!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

$list = $_GET['list'];

$response['status'] = 'success';
$response['message'] = 'API running OK!';
$response['average'] = array_sum($list) / count($list);
$response['min'] = min($list);
$response['max'] = max($list);
$response['time_response'] = time();
echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);