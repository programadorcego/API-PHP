<?php
/*
Uma das características de uma REST API é que ela não deve salvar informações do lado do cliente.
Toda vez que o cliente fizer uma requisição a uma API,
essa requisição deve ser tratada como se fosse a primeira requisição a ser feita.

Por isso, a forma de se autenticar um usuário é passando as credenciais pelo header.

o header "Authorization: Basic" é um método de autenticação HTTP
usado para fornecer as credenciais do usuário em uma requisição HTTP.

As credenciais são codificadas em base64 no padrão usuario.senha
Essas informações podem ser recuperadas através da super global $_SERVER:

$_SERVER['PHP_AUTH_USER'] recupera o nome de usuário
$_SERVER['PHP_AUTH_PW'] recupera a senha
*/

$ch = curl_init();
curl_setopt_array($ch, [
	CURLOPT_URL => 'http://api.local/api/basic_auth/',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_HTTPHEADER => [
		'Authorization: Basic ' . base64_encode("willian:minhasenha"),
	],
]);
$response = curl_exec($ch);
curl_close($ch);

echo $response;