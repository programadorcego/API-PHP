<?php
header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] != 'GET')
{
	$response['status'] = 'error';
	$response['message'] = 'Invalid HTTP Request Method!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

if(!isset($_GET['date']))
{
	$response['status'] = 'error';
	$response['message'] = 'The parameter `date` is missing!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

if(!preg_match("/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/", $_GET['date']))
{
	$response['status'] = 'error';
	$response['message'] = 'The parameter `date` must be in the format `dd/mm/YYYY`!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

$date = DateTime::createFromFormat('d/m/Y', $_GET['date']);
$week = $date->format('w');
$week_array = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];

$response['status'] = 'success';
$response['message'] = 'API running OK!';
$response['week'] = $week_array[$week];
$response['time_response'] = time();
echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);