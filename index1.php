<?php
/*
Exercício

Crie uma API que receba um número inteiro como parâmetro e retorne a soma de todos os números ímpares de 1 até o número informado.
*/

$ch = curl_init();
curl_setopt_array($ch, [
	CURLOPT_URL => 'http://api.local/api/ex01/?num=10',
	CURLOPT_RETURNTRANSFER => true,
]);

$response = curl_exec($ch);
curl_close($ch);

echo "<pre>";
print_r(json_decode($response, true));
echo "</pre>";