<?php
require __DIR__ . "/functions.php";

$secret = "50d562ac9b624742b2b5fc30cf5d078209783f0840986499a206ed9e4e08dd85";

$header = [
	"alg" => "HS256",
	"type" => "JWT",
];

$payload = [
	"sub" => 1,
	"username" => "willian",
	"role" => "admin"
];

echo jwt($header, $payload, $secret);