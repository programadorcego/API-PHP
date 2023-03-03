<?php
header("Content-Type: application/json");

require __DIR__ . "/..//functions.php";

if($_SERVER['REQUEST_METHOD'] != "POST")
{
	$response['status'] = 'error';
	$response['message'] = 'Invalid HTTP Request Method';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

$users = [
	'willian' => 'minhasenha',
];

$user = $_POST['user'];
$password = $_POST['password'];

if(!isset($_POST['user']) || !isset($_POST['password']) || !key_exists($user, $users) || $users[$user] != $password)
{
	$response['status'] = 'error';
	$response['message'] = 'Error when logging in!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

$secret = "50d562ac9b624742b2b5fc30cf5d078209783f0840986499a206ed9e4e08dd85";

$payload = [
	'sub' => 1,
	'user' => $user,
	'role' => 'admin',
];

$response['status'] = 'success';
$response['message'] = 'User authenticated successfully!';
$response['jwt'] = jwt($payload, $secret);
$response['time_response'] = time();
echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);