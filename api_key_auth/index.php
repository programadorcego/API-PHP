<?php
header('Content-Type: application/json');

$users = [
	'Cliente 1' => '2e37f38c-e6dc-4c1d-ae7a-68c5f06e5d8f',
	'Cliente 2' => '7ad4ca4b-4f09-4c55-a132-b91f9eac67f7',
	'Cliente 3' => '3e3e3d39-c74a-4e68-8d29-53e28c40e9b1',
	'Cliente 4' => 'bddbd78a-6431-4bb3-aa17-8c8d82d94f9c',
];

$headers = getallheaders();

if(!isset($headers['X-Api-Key']))
{
	$response['status'] = 'error';
	$response['message'] = 'Invalid Access!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
	exit;
}

if(!in_array($headers['X-Api-Key'], $users))
{
	$response['status'] = 'error';
	$response['message'] = 'Invalid API Key!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
	exit;
}

$client = array_search($headers['X-Api-Key'], $users);

$response['status'] = 'success';
$response['message'] = "You were authenticated successfully! You are the client `$client`.";
$response['time_response'] = time();
echo json_encode($response, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);