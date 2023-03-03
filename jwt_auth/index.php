<?php
header("Content-Type: application/json");

require __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$headers = getallheaders();

if(!isset($headers['Authorization']))
{
	$response['status'] = 'error';
	$response['message'] = 'Authorization Error!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

$jwt = substr($headers['Authorization'], 7);

list($header, $payload, $signature) = explode('.', $jwt);

$secret = "50d562ac9b624742b2b5fc30cf5d078209783f0840986499a206ed9e4e08dd85";

try
{
	$decoded = JWT::decode($jwt, new Key($secret, 'HS256'));
	
	$response['status'] = 'success';
	$response['message'] = 'Running OK!';
} catch(\Exception $e)
{
	$response['status'] = 'error';
	$response['message'] = $e->getMessage();
}

$response['time_response'] = time();
echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);