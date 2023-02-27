<?php
function jwt(array $header, array $payload, string $secret) : string {
	$header = base64UrlEncode(json_encode($header));
	$payload = base64UrlEncode(json_encode($payload));
	$signature = base64UrlEncode(hash_hmac("SHA256", "$header.$payload", $secret, true));
	
	return "$header.$payload.$signature";
}

function base64UrlEncode(string $str) : string {
	$str = base64_encode($str);
	$url = str_replace(['+', '/', '='], ['-', '_', ''], $str);
	return $url;
}