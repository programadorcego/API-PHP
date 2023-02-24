<?php
function generateApiKey()
{
	// Define o conjunto de caracteres possíveis na chave
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	
	// Define o tamanho da chave
	$keyLength = 32;
	
	// Gera a chave aleatória
	$apiKey = '';
	for ($i = 0; $i < $keyLength; $i++)
	{
		$randIndex = rand(0, strlen($chars) - 1);
		$apiKey .= $chars[$randIndex];
	}
	
	return $apiKey;
}