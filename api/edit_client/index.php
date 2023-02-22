<?php
header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] != 'PUT')
{
	$response['status'] = 'error';
	$response['message'] = 'Invalid HTTP Request Method!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if(!isset($data['id']) || !isset($data['name']))
{
	$response['status'] = 'error';
	$response['message'] = 'Client ID or client name is not defined!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

$new_name = $data['name'];
$id = $data['id'];
$tmp = explode(PHP_EOL, file_get_contents(__DIR__ . '/../data/data.txt'));
$index = 1;

$file = fopen(__DIR__ . "/../data/data.txt", "w");

foreach($tmp as $client)
{
	if($index == $id)
	{
		fputs($file, PHP_EOL . $new_name);
	}
	else
	{
		fputs($file, PHP_EOL . $client);
	}
	
	$index++;
}

fclose($file);

$response['status'] = 'success';
$response['message'] = "Client updated successfully! The new client name is $new_name.";
$response['time_response'] = time();
echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);