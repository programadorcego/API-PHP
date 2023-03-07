<?php
/*
Exercício

Crie uma API que receba uma data como parâmetro (no formato dd/mm/aaaa) e retorne o dia da semana correspondente a essa data (segunda-feira, terça-feira, etc.).
*/

$ch = curl_init();
curl_setopt_array($ch, [
	CURLOPT_URL => 'http://api.local/api/ex04/?date=07/03/2023',
	CURLOPT_RETURNTRANSFER => true,
]);

$response = curl_exec($ch);
curl_close($ch);

echo "<pre>";
print_r(json_decode($response, true));
echo "</pre>";