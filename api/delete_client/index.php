<?php
header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] != 'DELETE')
{
	$response['status'] = 'error';
	$response['message'] = 'Invalid HTTP Request Method!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if(!isset($data['id']))
{
	$response['status'] = 'error';
	$response['message'] = 'Client ID is not defined!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

$id = $data['id'];
$tmp = explode(PHP_EOL, file_get_contents(__DIR__ . '/../data/data.txt'));
$index = 1;

$file = fopen(__DIR__ . '/../data/data.txt', 'w');

foreach($tmp as $client)
{
	if($id == $index)
	{
		$index++;
		continue;
	}
	else
	{
		fputs($file, $client . PHP_EOL);
		$index++;
	}
}

fclose($file);

$response['status'] = 'success';
$response['message'] = 'Client deleted successfully!';
$response['time_response'] = time();
echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);