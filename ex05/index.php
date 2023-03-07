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

if(!isset($_GET['date1']) || !isset($_GET['date2']))
{
	$response['status'] = 'error';
	$response['message'] = 'The parameter `date1` or `date2`is missing!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

if(!preg_match("/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/", $_GET['date1']) || !preg_match("/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/", $_GET['date2']))
{
	$response['status'] = 'error';
	$response['message'] = 'The parameter `date1` and `date2` must be in the format `dd/mm/YYYY`!';
	$response['time_response'] = time();
	echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

$date1 = DateTime::createFromFormat('d/m/Y', $_GET['date1']);
$date2 = DateTime::createFromFormat('d/m/Y', $_GET['date2']);
$interval = $date1->diff($date2);

$response['status'] = 'success';
$response['message'] = 'API running OK!';
$response['days'] = $interval->days;
$response['time_response'] = time();
echo json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);