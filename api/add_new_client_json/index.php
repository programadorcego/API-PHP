<?php
header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	$response['status'] = 'error';
	$response['message'] = 'Invalid HTTP Request Method!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if(!isset($data['name']))
{
	$response['status'] = 'error';
	$response['message'] = 'Client name is not defined!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

$name = $data['name'];
$file = fopen(__DIR__ . '/../data/data.txt', 'a');
fputs($file, PHP_EOL . $name);
fclose($file);

$response['status'] = 'success';
$response['message'] = "Client $name addedd successfully!";
$response['time_response'] = time();
echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);