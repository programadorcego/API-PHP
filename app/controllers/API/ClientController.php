<?php
namespace App\Controllers\API;

use App\Controllers\Controller;
use App\Utils\Session;
use App\Http\Request;
use App\Http\Response;
use App\Models\API\Client;
use Exception;

class ClientController extends Controller
{
	public function get_all_clients()
	{
		try
		{
			$response['status'] = 'success';
			$response['message'] = 'API running OK!s';
			$clients = (new Client())->all();
			$response['clients'] = $clients;
		} catch(Exception $e)
		{
			$response['status'] = 'error';
			$response['message'] = 'Error! ' . $e->getMessage();
		}
		
		$response['time_response'] = time();
		
		return (new Response(200, $response, 'application/json'))->sendResponse();
	}
	
	public function get_client($id)
	{
		try
		{
			$response['status'] = 'success';
			$response['message'] = 'API running OK!s';
			$client = (new Client())->find($id);
			$response['client'] = $client;
		} catch(Exception $e)
		{
			$response['status'] = 'error';
			$response['message'] = 'Error! ' . $e->getMessage();
		}
		
		$response['time_response'] = time();
		
		return (new Response(200, $response, 'application/json'))->sendResponse();
	}
}