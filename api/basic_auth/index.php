<?php
header("Content-Type: application/json");

if(!isset($_SERVER['PHP_AUTH_USER']))
{
	$response['status'] = 'error';
	$response['message'] = 'Authentication Error!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

$credentials = [
	'willian' => 'minhasenha'
];

$user = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

if(!key_exists($user, $credentials) || $credentials[$user] != $password)
{
	$response['status'] = 'error';
	$response['message'] = 'Invalid user or password!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

$response['status'] = 'success';
$response['message'] = 'User authenticated successfully!';
$response['time_response'] = time();
echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);