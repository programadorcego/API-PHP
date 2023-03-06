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

if(!isset($_GET['num']))
{
	$response['status'] = 'error';
	$response['message'] = 'The parameter `num` is missing!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

if(!is_numeric($_GET['num']))
{
	$response['status'] = 'error';
	$response['message'] = 'The parameter `num` must be a number!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

$num = (int) $_GET['num'];
$i = 2;
$fibonacci = [1, 1];

while($i < $num)
{
	$fibonacci[] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
	$i++;
}

$response['status'] = 'success';
$response['message'] = 'API Running OK!';
$response['fibonacci'] = $fibonacci;
$response['time_response'] = time();
echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);