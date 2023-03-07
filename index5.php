<?php
/*
Exercício

Crie uma API que receba duas datas como parâmetro (no formato dd/mm/aaaa) e retorne o número de dias corridos entre essas datas.
*/

$ch = curl_init();
curl_setopt_array($ch, [
	CURLOPT_URL => 'http://api.local/api/ex05/?date1=01/01/2023&date2=07/03/2023',
	CURLOPT_RETURNTRANSFER => true,
]);

$response = curl_exec($ch);
curl_close($ch);

echo "<pre>";
print_r(json_decode($response, true));
echo "</pre>";