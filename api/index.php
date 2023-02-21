<?php
// Definir o content type da página
header("Content-Type: application/json");

// Dados que serão convertidos para JSON
$response['status'] = 'success';
$response['message'] = 'Olá, mundo!';
$response['time_response'] = time();

// Converter o array associativo para o formato JSON e escrever o resultado na tela.
echo json_encode($response, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);