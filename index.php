<?php
session_start();

if(!isset($_SESSION['jwt']))
{
	die("JWT is missing!");
}

$ch = curl_init();
curl_setopt_array($ch, [
	CURLOPT_URL => 'http://api.local/api/jwt_auth/',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_HTTPHEADER => [
		'Authorization: Bearer ' . $_SESSION['jwt'],
	],
]);
$response = curl_exec($ch);
curl_close($ch);

echo $response;