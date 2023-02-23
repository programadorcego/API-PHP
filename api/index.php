<?php
/*
CURLOPT_CUSTOM define qual é o método HTTP do request.

CURLOPT_POSTFIELDS define os dados que serão enviados na requisição.
Os dados podem ser enviados no formato de array associativo ou JSON.

CURLOPT_HTTPHEADER especifica os cabeçalhos personalizados que serão enviados na requisição.
Os cabeçalhos são enviados no formato de array: ['Content-Type: application/json']
*/

$ch = curl_init();
curl_setopt_array($ch, [
	CURLOPT_URL => 'http://api.local/api/delete_client/',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_CUSTOMREQUEST => 'DELETE',
	CURLOPT_POSTFIELDS => '{"id": 5}',
	CURLOPT_HTTPHEADER => [
		'Content-Type: application/json',
	],
]);
$response = curl_exec($ch);
curl_close($ch);

echo $response;