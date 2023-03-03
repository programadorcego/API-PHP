<?php
header("Content-Type: application/json");

require __DIR__ . '/../functions.php';

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

$validate = base64UrlEncode(hash_hmac('SHA256', "$header.$payload", $secret, true));

if($validate !== $signature)
{
	$response['status'] = 'error';
	$response['message'] = 'Signature Error!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

$response['status'] = 'success';
$response['message'] = 'Running OK!';
$response['time_response'] = time();
echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);