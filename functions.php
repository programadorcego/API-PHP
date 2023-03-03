<?php
function jwt(array $payload, string $secret) : string {
	$header = base64UrlEncode(json_encode([
		'alg' => 'HS256',
		'type' => 'JWT',
	]));
	$payload = base64UrlEncode(json_encode($payload));
	$signature = base64UrlEncode(hash_hmac("SHA256", "$header.$payload", $secret, true));
	
	return "$header.$payload.$signature";
}

function base64UrlEncode(string $str) : string {
	$str = base64_encode($str);
	$url = str_replace(['+', '/', '='], ['-', '_', ''], $str);
	return $url;
}

function login($user, $password)
{
	$ch = curl_init();
	curl_setopt_array($ch, [
		CURLOPT_URL => 'http://api.local/api/login/',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => ['user' => $user, 'password' => $password],
	]);
	$response = curl_exec($ch);
	curl_close($ch);
	
	return json_decode($response, true);
}