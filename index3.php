<?php
/*
Exercício

Crie uma API que receba uma lista de números inteiros como parâmetro e retorne a média, o valor máximo e o valor mínimo desses números.
*/

$ch = curl_init();
curl_setopt_array($ch, [
	CURLOPT_URL => 'http://api.local/api/ex03/?' . http_build_query(['list' => [1, 10, 7, 15, 3, 9, 2]]),
	CURLOPT_RETURNTRANSFER => true,
]);

$response = curl_exec($ch);
curl_close($ch);

echo "<pre>";
print_r(json_decode($response, true));
echo "</pre>";