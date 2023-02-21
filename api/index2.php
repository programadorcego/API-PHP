<?php
/*
Para transferirmos dados pela internent,
podemos utilizar a biblioteca curl, que também está presente no php.

1. O curl_init inicia a sessão de transferência de dados.
2. O curl_setopt_array configura várias opções de transferência de dados de uma só vez:
* CURLOPT_URL define a url para onde os dados serão enviados
* CURLOPT_RETURNTRANSFER define se o resultado deve ser exibido como uma string
ou escrito diretamente na tela.
3. curl_exec executa a requisição HTTP.
4. curl_close encerra uma sessão anteriormente iniciada pelo curl_init.
*/

$ch = curl_init();
curl_setopt_array($ch, [
	CURLOPT_URL => 'http://api.local/api/get_people/?max=1',
	CURLOPT_RETURNTRANSFER => true,
]);
$response = curl_exec($ch);
curl_close($ch);

$response = json_decode($response, true);
echo "<pre>";
print_r($response);
echo "</pre>";