<?php
/*
Outra forma de autenticação de uma API é a API Key, ou chave de API.

Uma API key é um código alfanumérico que identifica um aplicativo, cliente ou usuário autorizado a acessar uma determinada API.

Ao solicitar uma API key, o desenvolvedor normalmente recebe um código exclusivo que deve ser incluído em todas as solicitações feitas à API.
Isso permite que o proprietário da API monitore e controle o acesso à API, bem como rastreie o uso da mesma pelos desenvolvedores e clientes.
*/

$ch = curl_init();
curl_setopt_array($ch, [
	CURLOPT_URL => 'http://api.local/api/api_key_auth/',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_HTTPHEADER => [
		'X-Api-Key: 7ad4ca4b-4f09-4c55-a132-b91f9eac67f7',
	],
]);
$response = curl_exec($ch);
curl_close($ch);

echo $response;